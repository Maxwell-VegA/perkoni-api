@extends('layouts.app')

@section('body')
    <div>
        <form action="{{ route('products') }}" method="post">
            @csrf
            <input type="text" name="title" id="title">
            <input type="number" name="price" id="price">
            <button type="submit">Create Product</button>
        </form>
    </div>
@endsection