<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exhibition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use App\Models\Transaction;



class ProfileController extends Controller
{   
    public function index(Request $request)
{
    $users = Auth::user();
    $status = $request->query('status'); // ?status=apply を取得

    // 出品商品
    $exhibitions = Exhibition::where('user_id', $users->id)
        ->when($status, fn($q) => $q->where('status', $status))
        ->get();

    if ($status === 'buy') {
    
    $purchases = Purchase::where('user_id', $users->id)
        ->whereHas('transaction', function ($query) {
            $query->where('status', 'completed'); // 取引が完了している商品だけを取得
        })
        ->with('exhibition') // 出品商品情報を一緒に取得
        ->get();
} else {
    $purchases = collect();  // 空のコレクション
}
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

    return view('profile', compact('users', 'exhibitions', 'purchases', 'transactions', 'status'));
}

    

    public function edit()
    {
        $id = Auth::id();
      //$users = Auth::user($id);
       //dd($users);
       $users = User::latest()->first();
        return view('profileedit',compact('users'));
    }

    public function postedit(Request $request)
    {   
        $form = $request->all();
        //dd($form);
        unset($form['_token']);
        $user = User::find($request->id);

    // プロフィール画像の処理
        if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $path;
        }

        // フォームから受け取った情報を代入
        $user->name = $request->name;
        $user->post_code = $request->post_code;
        $user->address = $request->address;
        $user->building = $request->building;

    
        $user->save();

        
        

        return redirect('/');
    }

    public function change(){
        return view('change');
    }

    public function postchange(Request $request)
    {
        $form = $request->all();
        Changeaddress::find($request->id);
        Changeaddress::create($form);
        return redirect('/purchasse/address/{item_id}');
    }
}
