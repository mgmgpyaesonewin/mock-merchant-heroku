<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class HomeController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('home');
    }

    public function webCheckout(): Factory|View|Application
    {
        $amount = collect(session()->get('items'))->pluck('amount')->sum();

        $items = session()->get('items', []);

        $data = [
            'time_to_live_in_seconds' => config('wppg.timeout'),
            'merchant_id' => config('wppg.merchant_id'),
            'order_id' => rand(100, 999),
            'amount' => $amount,
            'backend_result_url' => config('wppg.backend_result_url'),
            'merchant_reference_id' => "wave-" . rand(1000000, 9999999)
        ];

        $hash = $this->hash($data, config('wppg.secret_key'));

        return view('web-checkout', ['hash' => $hash, 'data' => $data, 'items' => $items]);
    }

    public function apiCheckout(): Factory|\Illuminate\Contracts\View\View|Application
    {
        $amount = collect(session()->get('items'))->pluck('amount')->sum();

        $items = session()->get('items', []);

        return view('api-checkout', ['amount' => $amount, 'items' => $items]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws GuzzleException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function postApiCheckout(Request $request): Redirector|RedirectResponse|Application
    {

        $amount = collect(session()->get('items'))->pluck('amount')->sum();

        $data = [
            'time_to_live_in_seconds' => config('wppg.timeout'),
            'merchant_id' => config('wppg.merchant_id'),
            'order_id' => rand(10000, 99999),
            'amount' => $amount,
            'backend_result_url' => config('wppg.backend_result_url'),
            'merchant_reference_id' => "wave-" . rand(1000000, 9999999)
        ];

        $hash = $this->hash($data, config('wppg.secret_key'));

        $client = new Client([
            'http_errors' => false,
            'verify' => false
        ]);

        $response = $client->request('post', config('wppg.url') . "/payment", [
            'headers' => [
                'Accept' => "application/json",
            ],
            'form_params' => [
                "time_to_live_in_seconds" => $data['time_to_live_in_seconds'],
                "merchant_id" => $data['merchant_id'],
                "order_id" => $data['order_id'],
                "merchant_reference_id" => $data['merchant_reference_id'],
                "frontend_result_url" => config('wppg.frontend_result_url'),
                "backend_result_url" => $data['backend_result_url'],
                "amount" => $data['amount'],
                "payment_description" => "Order From Wave Merchant",
                "merchant_name" => config('app.name'),
                "items" => json_encode(session()->get('items')),
                "hash" => $hash
            ]
        ]);

        $result = json_decode($response->getBody()->getContents());

        if ($response->getStatusCode() === 200) {
            $url = config('wppg.redirect_url') . '/authenticate?transaction_id=' . $result->transaction_id;
            if (!empty($request->get('msisdn'))) {
                $url = $url . '&msisdn=' . $request->get('msisdn');
            }
            return redirect($url);
        }
        if ($response->getStatusCode() != 200) {
            abort(503, "Service Unavailable");
        }

        session()->flash('result', $result);

        return redirect()->back();
    }

    public function callback(Request $request)
    {
        $client = new Client();
        $client->post(config('wppg.ms_team_callback_log_channel'), [
            'json' => [
                'type' => 'message',
                'text' => json_encode($request->all())
            ]
        ]);
    }


    public function hash($data, $key): string
    {
        return hash_hmac('sha256', join("", $data), $key);
    }
}
