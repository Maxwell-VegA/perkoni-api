<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>

    <body class="bg-gray-100">
        <nav class="mb-12 bg-white flex justify-between">
            <ul class="flex items-center">
                <li>
                    <a href="{{ route('home') }}" class="p-3">Home</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
                </li>
            </ul>
            <ul class="flex items-center">
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                    <li>
                        <a class="p-3">{{ auth()->user()->username }}</a>
                    </li>    
                @endauth
                @guest
                    <li>
                        <a href="{{ route('register') }}" class="p-3">Register</a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}"class="p-3">Login</a>
                    </li>
                @endguest
            </ul>
        </nav>
        
        @yield('body')

    </body>
</html>
