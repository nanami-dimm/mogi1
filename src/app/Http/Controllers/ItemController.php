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
        $conditions = Productcondition::all();
        return view('sell', compact('categories', 'conditions'));
    }

}
