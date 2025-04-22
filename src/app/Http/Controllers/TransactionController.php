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


class TransactionController extends Controller
{
    
    
    public function message(Request $request, $transactionId)
    {   
        $user = auth()->user();
        $status = $request->query('status');
        if ($status === 'trading') {
        $transactions = Transaction::where('status', 'trading')
        ->where(function ($q) use ($users) {
            $q->where('buyer_id', $users->id)
              ->orWhere('seller_id', $users->id); 
        })
        ->with('exhibition') 
        ->get();
        } else {
            $transactions = collect();  
        }

        

        $transaction = Transaction::with(['exhibition']) 
        ->findOrFail($transactionId);

        $messages = TransactionMessage::where('transaction_id', $transactionId)
        ->with('user')
        ->orderBy('created_at', 'asc')
        ->get();

    // 未読メッセージを既読に変更（相手から来た分のみ）
        TransactionMessage::where('transaction_id', $transactionId)
        ->where('user_id', '!=', $user->id)
        ->where('is_read', false)
        ->update(['is_read' => true]);


        return view('message',compact('transactions','transaction','status','messages'));
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

    // 取引ステータスを完了にする
    $transaction->status = 'completed';
    $transaction->save();

    // 評価を保存する（既に評価があるか確認してから）
    $transaction->rating()->create([
        'user_id' => auth()->id(),
        'rating' => $request->input('rating'),
       
    ]);

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

    
}

