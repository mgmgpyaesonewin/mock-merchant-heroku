<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function checkout()
    {
        $sum = collect(session()->get('items'))->pluck('amount')->sum();

        $items = session()->get('items', []);

        $data = [
            'merchant_id' => config('wppg.merchant_id'),
            'order_id' => rand(100, 999),
            'amount' => $sum,
            'backend_result_url' => config('wppg.backend_result_url'),
            'merchant_reference_id' => "wave-" . rand(1000000, 9999999)
        ];

        $hash = $this->hash($data, config('wppg.secret_key'));

        return view('checkout', ['hash' => $hash, 'data' => $data, 'items' => $items]);
    }

    private function hash($data, $key)
    {
        return hash_hmac('sha256', join("", $data), $key);
    }
}
