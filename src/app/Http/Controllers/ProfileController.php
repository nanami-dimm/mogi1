<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exhibition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ProfileController extends Controller
{
    public function index(){
        $users = Auth::user();
        $exhibitions = Exhibition::all();
        return view('profile',compact('users', 'exhibitions'));
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
        User::find($request->id);
        
        

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
