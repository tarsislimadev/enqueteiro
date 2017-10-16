let mix = require('laravel-mix');

mix.disableNotifications();

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

var scripts = [
    'vendor/jquery.js', 
    'vendor/knockout.js', 
    'app.js'
];

mix.scripts(scripts.map(function (js) { return 'resources/assets/js/' + js }), 'public/js/app.js')
   .sass('resources/assets/sass/app.scss', 'public/css');
