@extends('layout')

@section('content')
    <h3>Checkout</h3>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Quality</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>

        <tbody>
        @forelse($items as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>1</td>
                <td>{{ $item['amount'] }}</td>
            </tr>

        @empty
            <tr>
                <td colspan="3">No Items in Cart</td>
            </tr>
        @endforelse
        </tbody>

        <tr>
            <td></td>
            <td>Total</td>
            <td>{{ $data['amount'] }}</td>
        </tr>
    </table>

    <form action="{{ config('wppg.url') }}" method="POST" id="pww-form">
        <input type="hidden" name="merchant_id" value="{{ $data['merchant_id'] }}">
        <input type="hidden" name="order_id" value="{{ $data['order_id'] }}">
        <input type="hidden" name="merchant_reference_id" value="{{ $data['merchant_reference_id'] }}">
        <input type="hidden" name="frontend_result_url" value="{{ config('wppg.frontend_result_url') }}">
        <input type="hidden" name="backend_result_url" value="{{ $data['backend_result_url'] }}">
        <input type="hidden" name="amount" value="{{ $data['amount'] }}">
        <input type="hidden" name="payment_description" value="Order From Wave Merchant">
        <input type="hidden" name="merchant_name" value="{{ config('app.name') }}">
        <input type="hidden" name="items" value="{{ json_encode(session()->get('items')) }}">
        <input type="hidden" name="hash" value="{{ $hash }}">

        <div class="d-flex">
            <div class="align-self-end">
                <a href="{{ url('clear-cart') }}" class="btn btn-outline-danger">Clear Cart</a>
            </div>

            <div class="ml-4">
                <a href="#" onclick="event.preventDefault(); document.getElementById('pww-form').submit();">
                    <img src="{{ asset('pww.svg') }}" alt="Pay with Wave Logo" class="pww-logo">
                </a>
            </div>
        </div>
    </form>
@endsection
