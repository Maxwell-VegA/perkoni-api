const mix = require('laravel-mix');

// mix.options({
//     hmrOptions: {
//         host: '127.0.0.1',
//         port: 8080
//     }
// })

mix.js('resources/js/app.js', 'public/js').vue();
mix.sass('resources/sass/app.scss', 'public/css');
mix.postCss('resources/css/tailwind.css', 'public/css');