<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::post('add-to-cart', function(Request $request) {
    session()->push('items',['name' => $request->name, 'amount' => $request->amount]);
    flash($request->name . " is added to Cart!", 'alert alert-success');
    return back();
})->name('add-to-cart');
Route::get('clear-cart', function() {
    session()->flush();
    return back();
});

Route::get('web/checkout', [HomeController::class, 'webCheckout']);

Route::get('api/checkout', [HomeController::class, 'apiCheckout']);
Route::post('api/checkout', [HomeController::class, 'postApiCheckout']);

Route::any("callback", [HomeController::class, 'callback']);

