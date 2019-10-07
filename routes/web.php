<?php

use Illuminate\Http\Request;

Route::post('add-to-cart', function(Request $request) {
    session()->push('items',['name' => $request->name, 'amount' => $request->amount]);
    flash($request->name . " is added to Cart!", 'alert alert-success');
    return back();
})->name('add-to-cart');

Route::get('clear-cart', function(Request $request) {
    session()->flush();
    return back();
});

Route::get('checkout', "HomeController@checkout");

Route::get('dd', function() {
    dd(session()->all());
    session()->flush();
});

Route::get('/', 'HomeController@index')->name('home');
