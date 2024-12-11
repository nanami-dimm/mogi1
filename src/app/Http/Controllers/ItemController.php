<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exhibition;
use App\Models\Category;
use App\Models\Productcondition;

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

    public function create(Request $request)
    {
        $form = $request->all();
       // dd($form);
        Exhibition::create($form);
        return redirect('/');
    }

    public function detail($exhibitions_id)
    {
        $exhibitions = Exhibition::find($exhibitions_id);
       //dd($exhibitions);
        $categories = Category::all();
       //dd($categories);
        $productconditions = Productcondition::all();
        return view('detail',compact('exhibitions','categories', 'productconditions'));

    }
}
