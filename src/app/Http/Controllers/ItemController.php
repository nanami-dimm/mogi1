<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Exhibition;
use App\Models\Category;
use App\Models\Productcondition;
use App\Models\ExhibitionCategory;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Comment;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    public function index()
    {
        $exhibitions = Exhibition::all();
        //dd('$exhibitions');
        return view('index',compact('exhibitions'));
    }

    public function mylist()
    {
        return view('');
    }

    public function sell()
    {   
       
        $categories = Category::all();
        $productconditions = Productcondition::all();
        return view('sell', compact('categories', 'productconditions'));
    }

    public function create(ExhibitionRequest $request)
    {
         $dir = 'img';
        $file_name = $request->file('product_image')->getClientOriginalName();
        $request->file('product_image')->storeAs('public/' .$dir,$file_name);


        $form = $request->all();
       // dd($form);
        Exhibition::create($form);
        return redirect('/');
    }

    public function detail($exhibitions_id)
    {
        $exhibitions = Exhibition::find($exhibitions_id);
       
       $categories = Category::find($exhibitions_id);
        
       $condition = Exhibition::with('productCondition')->findOrFail($exhibitions_id);
        //$productconditions = Productcondition::find($exhibitions_id);
        
        $users = User::latest()->first();
        
        
        return view('detail',compact('exhibitions','categories', 'condition','users',));

    }

    public function buy($exhibitions_id)
    {   
       //$exhibitions = Exhibition::all();
       $exhibitions = Exhibition::find($exhibitions_id);
        //dd($exhibitions);
       
       $users = Auth::user();
       //dd($users);
      
        return view('buy',compact('exhibitions','users'));
    }

    public function search(Request $request){
       $keyword = $request->input('keyword');

       $query = Exhibition::query();

       if(!empty($keyword)) {
        $query->where('product_name','LIKE',"%{$keyword}%");
       }

       $exhibitions = $query->get();
        return view('index',compact('exhibitions','keyword'));
}



    public function comment(Request $request){
        $form = $request->all();
        Comment::create($form);
        return view('detail');
    }

    public function postbuy(Request $request)
{
    $form = $request->all();
    $userId = Auth::id();

    $exhibition = Exhibition::findOrFail($form['exhibition_id']);

    // 出品者自身は購入不可
    if ($exhibition->user_id === $userId) {
        return redirect()->back()->with('error', '自分が出品した商品は購入できません。');
    }

    // すでにこの商品に対する取引が存在するか
    $existingTransaction = Transaction::where('exhibition_id', $exhibition->id)
        ->where('status', 'trading')
        ->first();

    if ($existingTransaction) {
        // 自分が関係者ならそのままチャットへ
        if ($existingTransaction->buyer_id === $userId || $existingTransaction->seller_id === $userId) {
            return redirect()->route('transaction.message', ['transactionId' => $existingTransaction->id]);
        }

        // 他のユーザーがすでに取引中なら購入不可
        return redirect()->back()->with('error', 'この商品はすでに他のユーザーと取引中です。');
    }

    // 取引を新規作成
    $transaction = Transaction::create([
        'exhibition_id' => $exhibition->id,
        'buyer_id' => $userId,
        'seller_id' => $exhibition->user_id,
        'status' => 'trading',
    ]);

    // 出品ステータス更新
    $exhibition->status = 'trading';
    $exhibition->save();

    return redirect()->route('transaction.message', ['transactionId' => $transaction->id]);
}
    

}