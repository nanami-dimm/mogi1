<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware('auth')->group(function(){

    

    Route::get('/mypage/profile', [ProfileController::class,'edit']);

    Route::post('/', [ProfileController::class,'postedit']);

    Route::get('/search',[ItemController::class,'search']);

    Route::get('/', [ItemController::class, 'index']);

    Route::get('/sell', [ItemController::class,'sell']);

    Route::post('/mypage',[ItemController::class,'create']);

    Route::get('/mypage', [ProfileController::class,'index']);
    
    Route::get('/item/{item_id}',[ItemController::class,'detail']);
    
    Route::get('/item/purchase/{item_id}',[ItemController::class,'buy']);

    Route::get('/purchase/address/{item_id}',[ProfileController::class,'change']);

    Route::post('/purchase/address/{item_id}',[ProfileController::class,'postchange']);

    Route::post('/item/{item_id}',[ItemController::class,'comment']);

    Route::post('/',[ItemController::class,'postbuy']);
});

