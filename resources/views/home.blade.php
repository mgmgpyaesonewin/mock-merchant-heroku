@extends('layouts.app')

@section('content')
    <h3>Wave Merchant Website - Mock Merchant Data</h3>

    @if (flash()->message)
        <div class="{{ flash()->class }}">
            {{ flash()->message }}
        </div>
    @endif

    @php
        $mockItems = [
            ['name' => 'Macbook Pro', 'amount' => 50],
            ['name' => 'iPad Not Pro', 'amount' => 30],
            ['name' => 'iPad Pro', 'amount' => 60],
            ['name' => 'Test Item 1', 'amount' => 20.01],
            ['name' => 'Test Item 2', 'amount' => 20.10],
            ['name' => 'Test Item 3', 'amount' => 20],
            ['name' => 'Test Item 4', 'amount' => 20.499],
            ['name' => 'Test Item 4', 'amount' => 20.444]
        ];
    @endphp

    <div class="container">
        <div class="row">
            @foreach ($mockItems as $item)
                <div class="col-md-4 col-lg-3">
                    <div class="card mb-4">
                        <img src="{{ asset('mac.png') }}" class="card-img-top" alt="{{ $item['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['name'] }}</h5>
                            <p class="card-text">This is a test item: {{ $item['name'] }}.</p>
                            <p class="card-text"><strong>${{ $item['amount'] }}</strong></p>
                            <form action="{{ route('add-to-cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="{{ $item['name'] }}">
                                <input type="hidden" name="amount" value="{{ $item['amount'] }}">
                                <button class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ url('web/checkout') }}" class="btn btn-outline-success">Web Checkout</a>
        <a href="{{ url('api/checkout') }}" class="btn btn-outline-primary">API Checkout</a>
        <a href="{{ url('clear-cart') }}" class="btn btn-outline-danger">Clear Cart</a>
    </div>

    <payment-from></payment-from>
@endsection
