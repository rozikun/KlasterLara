const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.scripts(['resources/js/jquery.min.js',
             'resources/js/popper.min.js',
             'resources/js/bootstrap.min.js'],'public/js/my-app.js');

mix.styles('resources/css/simple-sidebar.css', 'public/css/sidebar.css');
mix.styles('resources/css/bootstrap.min.css','public/css/style.css');
