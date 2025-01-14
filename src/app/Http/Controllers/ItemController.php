<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Exhibition;
use App\Models\Category;
use App\Models\Productcondition;
use App\Models\ExhibitionCategory;
use App\Models\Paymethod;
use App\Models\User;
use App\Models\Comment;
use App\Models\Changeaddress;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{
    public function index()
    {
        $exhibitions = Exhibition::all();

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
        
        $productconditions = Productcondition::find($exhibitions_id);
        
        $users = User::latest()->first();

        $comments = Comment::all();
        return view('detail',compact('exhibitions','categories', 'productconditions','users','comments'));

    }

    public function buy($exhibitions_id)
    {   
       //$exhibitions = Exhibition::all();
       $exhibitions = Exhibition::find($exhibitions_id);
        //dd($exhibitions);
       $paymethods = Paymethod::all();
       $users = User::latest()->first();
       //dd($users);
       $newaddress = Changeaddress::latest()->first();
        return view('buy',compact('exhibitions','paymethods','users','newaddress'));
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

    public function postbuy(Request $request){
        $form = $request->all();
        Buyproduct::create($form);
        return redirect('/');
    }

}