<?php

use Illuminate\Routing\RouteUri;
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

Route::get('', 'ItemController@showItems')->name('top');

Auth::routes();

Route::get('items/{item}', 'ItemController@showItemDetail')->name('item');

Route::middleware('auth')
    ->group(function () {
        Route::get('items/{item}/buy', 'ItemController@showBuyItemForm')->name('item.buy');
        Route::post('items/{item}/buy', 'ItemController@buyItem')->name('item.buy');
        Route::get('sell', 'SellController@showSellForm')->name('sell');
        Route::post('sell', 'SellController@sellItem')->name('sell');
    });

Route::prefix('mypage')
    ->namespace('Mypage')
    ->middleware('auth')
    ->group(function () {
        Route::get('edit-profile', 'ProfileController@showProfileEditForm')->name('mypage.edit-profile');
        Route::post('edit-profile', 'ProfileController@editProfile')->name('mypage.edit-profile');
        Route::get('bought-items', 'BoughtItemsController@showBoughtItems')->name('mypage.bought-items');
        Route::get('sold-items', 'SoldItemsController@showSoldItems')->name('mypage.sold-items');
    });