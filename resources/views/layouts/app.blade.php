<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link href="css/tailwind.css" rel="stylesheet">

    </head>
    <body>
        @yield('body')
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
