<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exhibition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use Illuminate\Support\Collection;



class ProfileController extends Controller
{   
    public function index(Request $request)
{
    $users = Auth::user();
    $status = $request->query('status'); 
    $exhibitions = Exhibition::with(['transactionMessages' => function ($q) use ($users) {
    $q->where('is_read', false)
      ->where('user_id', '!=', $users->id);
}])
->where('user_id', $users->id)
->when($status, fn($q) => $q->where('status', $status))
->get();

    if ($status === 'buy') {
    
    $purchases = Purchase::where('user_id', $users->id)
        ->whereHas('transaction', function ($query) {
            $query->where('status', 'completed'); 
        })
        ->with('exhibition') 
        ->get();
    } else {
    $purchases = collect();  
    }
    if ($status === 'trading') {
        $transactions = Transaction::where('status', 'trading')
    ->where(function ($q) use ($users) {
        $q->where('buyer_id', $users->id)
          ->orWhere('seller_id', $users->id);
    })
    ->with([
        'exhibition',
        'exhibition.transactionMessages' => function ($q) {
            $q->orderByDesc('created_at'); 
        }
    ])
    ->get();


$transactions = $transactions->sortByDesc(function ($transaction) {
    return optional($transaction->exhibition->transactionMessages->first())->created_at
        ?? $transaction->updated_at;
});
        //dd($transactions);
        
        $unreadMessagesCount = $transactions->reduce(function ($carry, $transaction) use ($users) {
    $unreadMessages = $transaction->exhibition->transactionMessages
        ->where('is_read', false)
        ->where('user_id', '!=', $users->id); // 自分が送ったものは除外
    return $carry + $unreadMessages->count();
    
}, 0);
    } else {
    
    $transactions = collect();
    $unreadMessagesCount = 0;
}
    
    $unreadCount = TransactionMessage::where('is_read', false)
    ->where('user_id', '!=', $users->id)
    ->whereHas('transaction', function ($q) use ($users) {
        $q->where('buyer_id', $users->id)
          ->orWhere('seller_id', $users->id);
    })
    ->count();
    

    return view('profile', compact('users', 'exhibitions', 'purchases', 'transactions', 'status','unreadCount','unreadMessagesCount'));
    }
    
    

    public function edit()
    {
        $id = Auth::id();
      
        $users = Auth::user();
        return view('profileedit',compact('users'));
    }

    public function postedit(Request $request)
    {   
        $form = $request->all();
        //dd($form);
        unset($form['_token']);
        $user = User::find($request->id);

    
        if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $path;
        }

        
        $user->name = $request->name;
        $user->post_code = $request->post_code;
        $user->address = $request->address;
        $user->building = $request->building;

    
        $user->save();

        
        

        return redirect('/');
    }

    
}

