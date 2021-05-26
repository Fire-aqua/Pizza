<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pdf', function () {
    $orders = Order::with([
        'orderElements.good',
        'orderElements.ingredients',
        'customer'
        ])
        ->get();
    return view('orders', compact('orders'));
});
