@extends('layouts.app')

@section('body')
    <div>
        <h1>Products display</h1>
        @if ($products->count())
            @foreach ($products as $product)
                <h3>{{ $product->title }}</h3>
                <p>{{ $product->price }}$</p>
            @endforeach
        @endif
    </div>
@endsection