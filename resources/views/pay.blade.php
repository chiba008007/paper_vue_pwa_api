@extends('layout.default')

@section('content')
    <a href="https://buy.stripe.com/test_28odTbeyYd2o1Q43cc">stripe</a>
    <p>{{ $hello }}</p>
    @foreach ($hello_array as $hello_word)
        {{ $hello_word }}<br>
    @endforeach
@endsection
