const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue();
mix.sass('resources/sass/app.sass', 'public/css');
mix.postCss('resources/css/tailwind.css', 'public/css');