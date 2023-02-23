@extends('layouts.app')

@section('content')
    <h3>Wave Merchant Website</h3>

    @if (flash()->message)
        <div class="{{ flash()->class }}">
            {{ flash()->message }}
        </div>
    @endif

    <div class="card-group">
        <div class="card">
            <img src="{{ asset('mac.png') }}" class="card-img-top" alt="Macbook Pro">
            <div class="card-body">
                <h5 class="card-title">Macbook Pro</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><strong>$50</strong></p>
                <form action="{{ route('add-to-cart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Macbook Pro">
                    <input type="hidden" name="amount" value="50">
                    <button class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('ipad.webp') }}" class="card-img-top" alt="Macbook Pro">
            <div class="card-body">
                <h5 class="card-title">iPad Not Pro</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><strong>$30</strong></p>
                <form action="{{ route('add-to-cart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="iPad Not Pro">
                    <input type="hidden" name="amount" value="30">
                    <button class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('ipad.webp') }}" class="card-img-top" alt="Macbook Pro" >
            <div class="card-body">
                <h5 class="card-title">iPad Pro</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><strong>$60</strong></p>
                <form action="{{ route('add-to-cart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="iPad Pro">
                    <input type="hidden" name="amount" value="60">
                    <button class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ url('web/checkout') }}" class="btn btn-outline-success">Web Checkout</a>
        <a href="{{ url('api/checkout') }}" class="btn btn-outline-primary">API Checkout</a>
        <a href="{{ url('clear-cart') }}" class="btn btn-outline-danger">Clear Cart</a>
    </div>

    <payment-from></payment-from>
@endsection
