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

Route::get('/', [App\Http\Controllers\MainController::class, 'main'])->name('main');

Route::get('/about',[App\Http\Controllers\MainController::class, 'about'])->name('about');

Route::get('/addwine',[App\Http\Controllers\MainController::class, 'addwine'])->name('addwine');

Route::post('/addwine/check',[App\Http\Controllers\MainController::class, 'addwine_check'])->name('addwine_check');

Route::get('/moredetalis',[App\Http\Controllers\MainController::class, 'moredetalis'])->name('moredetalis');

Route::get('/moredetalis/{id}',[App\Http\Controllers\MainController::class, 'moredetalis_id'])->name('moredetalis_id');

Route::get('/search',[App\Http\Controllers\MainController::class, 'search'])->name('search');

Route::get('/basket',[App\Http\Controllers\MainController::class, 'basket'])->name('basket');

Route::get('/deleteBasket/{id}',[App\Http\Controllers\BasketController::class, 'deleteBasket'])->name('deleteBasket');

Route::post('/addToBasket/{id}',[App\Http\Controllers\BasketController::class, 'addToBasket'])->name('addToBasket');

Route::get('/ToOrder',[App\Http\Controllers\MainController::class, 'ToOrder'])->name('ToOrder');

Route::get('/UpdateInfo/{id}',[App\Http\Controllers\MainController::class, 'UpdateInfo'])->name('UpdateInfo');

Route::post('/UpdateInfo/{id}',[App\Http\Controllers\MainController::class, 'UpdateWine'])->name('UpdateWine');

Route::get('/UpdateInfo/delete/{id}',[App\Http\Controllers\MainController::class, 'deleteWine'])->name('deleteWine');

Route::post('/ToOrder',[App\Http\Controllers\BasketController::class, 'orderview'])->name('orderview');

Route::get('/Orders',[App\Http\Controllers\MainController::class, 'Orders'])->name('Orders');

Route::get('/deleteOrders/{id}',[App\Http\Controllers\MainController::class, 'deleteOrders'])->name('deleteOrders');

Route::resource('WineModels', 'App\Http\Controllers\ProductController');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('Корзина');