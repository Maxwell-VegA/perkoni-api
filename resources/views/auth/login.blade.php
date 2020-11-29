@extends('layouts.app')


@section('body')
    <div class="">
        @if (session('status'))
            {{ session('status') }} 
        @endif
        <form action="{{ route('login') }}" method="POST" class="">
            @csrf
            <div class="mb-4">
                <input
                    type="email"
                    name="email"
                    id="email"
                    value=""
                    placeholder="email"
                    class="bg-gray-100 border-2 w-full rounded-lg 
                    @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <input type="password" name="password" id="password" value="" placeholder="password" class="bg-gray-100 border-2 w-full rounded-lg">
            </div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
            <button type="submit" class="bg-blue-600 text-white px-4 py-3 rounded font-medium w-full">Login</button>
        </form>
    </div>
@endsection