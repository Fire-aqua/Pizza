<?php

use App\Http\Controllers\{
    AuthController,
    IngredientController,
    ToppingController,
    GoodController,
    OrderController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::get('/goods', [GoodController::class, 'getGoods']);
Route::get('/ingredients', [IngredientController::class, 'getIngredients']);
Route::get('/toppings', [ToppingController::class, 'getToppings']);
Route::post('/send-order', [OrderController::class, 'receiveOrder']);

Route::group([
    'middleware' => 'auth:sanctum',
], function() {
    Route::get('/orders', [OrderController::class, 'list']);    
    Route::post('/delete-order', [OrderController::class, 'deleteOrder']);
    Route::get('/download-order', [OrderController::class, 'downloadOrder']);
});