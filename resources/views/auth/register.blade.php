@extends('layouts.app')


@section('body')
    <div class="">
        <form action="{{ route('register') }}" method="POST" class="">
            @csrf
            <div class="mb-4">
                <input 
                    type="text"
                    name="username"
                    id="username"
                    value="{{ old('username') }}"
                    placeholder="Username"
                    class="bg-gray-100 border-2 w-full rounded-lg 
                    @error('username') border-red-500 @enderror"
                >
                @error('username')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
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
            <div class="mb-4">
                <input type="password" name="password_confirmation" id="password-confirmation" value="" placeholder="confirm password" class="bg-gray-100 border-2 w-full rounded-lg">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-3 rounded font-medium w-full">Register</button>
        </form>
    </div>
@endsection