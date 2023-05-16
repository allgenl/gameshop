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
Route::get('/order/completed', [App\Http\Controllers\OrderController::class, 'myOrders'])->name('order.completed');
Route::get('/news', [App\Http\Controllers\HomeController::class, 'news'])->name('news');
Route::get('/news/{id}', [App\Http\Controllers\HomeController::class, 'oneNews'])->name('oneNews');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

Route::group(['middleware' => \App\Http\Middleware\AdminMiddleware::class], function () {
    Route::get('/admin/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/email', [App\Http\Controllers\AdminController::class, 'email'])->name('admin.email');
    Route::post('/admin/email/edit', [App\Http\Controllers\AdminController::class, 'editEmail'])->name('email.edit');
});
