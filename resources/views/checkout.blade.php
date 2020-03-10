@extends('layout')

@section('content')

    @if(session()->has('error'))
        <div class="alert alert-error">
            <p>{{ $error }}</p>
        </div>
    @endif

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

    <form action="{{ url('checkout') }}" method="POST" id="pww-form">

        @csrf

        <div class="d-flex">
            <div class="align-self-end mr-4">
                <a href="{{ url('/') }}" class="btn btn-primary">Home</a>
            </div>

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
