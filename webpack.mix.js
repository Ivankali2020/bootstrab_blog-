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

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/theme.js', 'public/js/theme.js')
    .sass('resources/sass/app.scss', 'public/css').js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps()
    .sass('resources/sass/theme.scss', 'public/css').js('node_modules/popper.js/dist/popper.js', 'public/js/theme.css').sourceMaps();

mix.copy('vendor/proengsoft/laravel-jsvalidation/resources/views', 'resources/views/vendor/jsvalidation')
    .copy('vendor/proengsoft/laravel-jsvalidation/public', 'public/vendor/jsvalidation');
