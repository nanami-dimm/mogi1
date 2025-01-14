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
      $users = Auth::user($id);
       //dd($users);
        return view('profileedit',compact('users'));
    }

    public function postedit(Request $request)
    {   
        $form = $request->all();
        User::find($request->id);
        User::create($form);
        

        return redirect('/');
    }
}
