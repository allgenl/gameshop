<?php

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
    return view('home', ['goods' => \App\Models\Good::query()->paginate(6)]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/good/{id}', [App\Http\Controllers\GoodController::class, 'good'])->name('good');
Route::get('/category/{id}', [App\Http\Controllers\GoodController::class, 'category'])->name('category');
Route::get('/order/buy/{id}', [App\Http\Controllers\OrderController::class, 'buy'])->name('buy');
Route::get('/order/current', [App\Http\Controllers\OrderController::class, 'current'])->name('order.current');
Route::get('/order/process', [App\Http\Controllers\OrderController::class, 'process'])->name('order.process');
