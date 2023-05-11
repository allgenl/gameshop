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
