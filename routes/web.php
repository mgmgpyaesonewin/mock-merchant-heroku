<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::any("callback", function(Request $request) {
    Storage::append('callback.log', json_encode($request->all()));
});

Route::post('add-to-cart', function(Request $request) {
    session()->push('items',['name' => $request->name, 'amount' => $request->amount]);
    flash($request->name . " is added to Cart!", 'alert alert-success');
    return back();
})->name('add-to-cart');

Route::get('clear-cart', function(Request $request) {
    session()->flush();
    return back();
});

Route::post('checkout', "HomeController@postCheckout");
Route::get('checkout', "HomeController@checkout");


Route::get('/', 'HomeController@index')->name('home');
