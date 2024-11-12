<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exhibition;

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
        $category = Category::all();
        return view('sell', compact('category'));
    }

}
