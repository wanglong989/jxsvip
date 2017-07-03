let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/ajaxfileupload.js', 'public/js')
    .js('resources/assets/js/modal_build.js', 'public/js')
    .js('resources/assets/js/modal_student.js', 'public/js')
    .js('resources/assets/js/m/every.js', 'public/js/m')
    .sass('resources/assets/sass/vip.scss', 'public/css')
    .sass('resources/assets/sass/vip2.scss', 'public/css')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/m/every.scss', 'public/css/m')
    .version()
    .disableNotifications();
