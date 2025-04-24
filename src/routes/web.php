<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;


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

    Route::get('/transactions/{transactionId}',[TransactionController::class,'index']);

    Route::post('/start-transaction/{exhibitionId}', [TransactionController::class, 'startTransaction'])->name('startTransaction');

    Route::get('item/{transactionId}/message', [TransactionController::class, 'message'])->name('message');

    Route::post('item/{transactionId}/message',[TransactionController::class,'send']);

    Route::post('/transaction/{id}/complete', [TransactionController::class, 'complete'])->name('transaction.complete');

    Route::post('/messages/save-draft', function (\Illuminate\Http\Request $request) {
    session()->put('form_input.content', $request->input('content'));
    return response()->json(['status' => 'saved']);
    });
    
    Route::post('/messages/{id}/edit', [TransactionController::class, 'edit']);

    Route::delete('/messages/{id}', [TransactionController::class, 'destroy']);

    


});

