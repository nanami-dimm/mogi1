<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionMessage;
use App\Models\Transaction;
use App\Events\MessageSent;
use App\Mail\PurchaseCompletedMail;
use Illuminate\Support\Facades\Mail;



class TransactionController extends Controller
{
    
    
    public function message(Request $request, $transactionId)
    {   
        $user = auth()->user();
        $status = $request->query('status','trading');
        if ($request->has('content')) {
        session(['content' => $request->input('content')]);
        }
        
        if ($status === 'trading') {
        // 特定の取引IDに基づいて取引を取得
        $transactions = Transaction::where('id', $transactionId) // 取引IDで絞り込む
            ->where(function ($q) use ($user) {
                $q->where('buyer_id', $user->id)
                  ->orWhere('seller_id', $user->id);
            })
            ->with('exhibition')  // exhibition情報も取得
            ->get();
    } else {
        $transactions = collect();  // `trading` 以外のステータスの場合は空のコレクション
    }

       
        //dd($transactions);


        $transaction = Transaction::with(['exhibition']) 
        ->findOrFail($transactionId);

        $messages = TransactionMessage::where('transaction_id', $transactionId)
        ->with('user')
        ->orderBy('created_at', 'asc')
        ->get();

         $otherTransactions = Transaction::where('status', 'trading')
        ->where(function ($q) use ($user) {
            $q->where('buyer_id', $user->id)
              ->orWhere('seller_id', $user->id);
        })
        ->where('id', '!=', $transactionId) // 現在の取引を除外
        ->with('exhibition')
        ->get();
    
        $savedMessage = session('content', '');

        TransactionMessage::where('transaction_id', $transactionId)
    ->where('user_id', '!=', $user->id)
    ->where('is_read', false)
    ->update(['is_read' => true]);
    
        return view('message',compact('transactions','transaction','status','messages','otherTransactions','savedMessage'));
    }

   
    public function send (MessageRequest $request)
{   
    session()->put('form_input.content', $request->input('content'));


    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('messages', 'public');
    }

    $message=TransactionMessage::create([
        'user_id' => auth()->id(),
        'transaction_id' => $request->input('transaction_id'),
        'content' => $request->input('content'),
        'image' => $imagePath,
        'is_read' => false,
    ]);

    broadcast(new MessageSent($message))->toOthers();
    
    session()->forget('form_input.content');
    

     return redirect()->back();
}

  public function complete(Request $request, $id)
{
    $transaction = Transaction::findOrFail($id);

    if (auth()->id() !== $transaction->buyer_id && auth()->id() !== $transaction->seller_id) {
        abort(403);
    }

    $myId = auth()->id();
    $targetId = $myId === $transaction->buyer_id
        ? $transaction->seller_id
        : $transaction->buyer_id;

    // ✅ 出品者の場合、購入者が評価済みでなければ完了させない
    if ($myId === $transaction->seller_id) {
        $buyerRated = $transaction->rating()
            ->where('user_id', $transaction->buyer_id)
            ->exists();

        if (!$buyerRated) {
            return back()->with('error', '購入者の評価が完了するまで取引を完了できません。');
        }
    }

    // ✅ すでに評価済みか確認
    $alreadyRated = $transaction->rating()
        ->where('user_id', $myId)
        ->where('target_user_id', $targetId)
        ->exists();

    if (!$alreadyRated) {
        $transaction->rating()->create([
            'user_id' => $myId,
            'target_user_id' => $targetId,
            'rating' => $request->input('rating'),
        ]);
    }

    // ✅ 両者評価済みなら取引完了にする
    $ratingCount = $transaction->rating()->count();
    if ($ratingCount >= 2) {
        $transaction->status = 'completed';
        $transaction->save();
    }
    $exhibition = $transaction->exhibition;
    //dd($exhibition);
    $buyer = auth()->user();
    $seller = $exhibition->user;

    Mail::to($seller->email)->send(new PurchaseCompletedMail($exhibition, $buyer));

    return redirect('/');
}
    public function saveDraft(Request $request)
{
    $request->validate([
        'content' => 'required|string|max:255',  // 必要に応じてバリデーションを追加
    ]);

    // セッションに入力内容を保存
    session()->put('form_input.content', $request->input('content'));

    return response()->json(['status' => 'success']);
}

    public function edit(Request $request, $id)
{
    $message = TransactionMessage::findOrFail($id);

    // 自分のメッセージのみ編集できるように
    if ($message->user_id !== auth()->id()) {
        return response()->json(['status' => 'unauthorized'], 403);
    }

    $message->content = $request->input('content');
    $message->save();

    return response()->json(['status' => 'success']);
}

// 削除
public function destroy($id)
{
    $message = TransactionMessage::findOrFail($id);

    // 自分のメッセージのみ削除できるように
    if ($message->user_id !== auth()->id()) {
        return response()->json(['status' => 'unauthorized'], 403);
    }

    $message->delete();

    return response()->json(['status' => 'deleted']);
}
}
