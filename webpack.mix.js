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

mix.js('resources/js/app.js',
      'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/mapa.scss', 'public/css');

mix.styles([
    'resources/vendor/toastr/toastr.css',

    'resources/vendor/select2/css/select2.css',
    

    'resources/vendor/select2/css/select2.min.css',
    'resources/vendor/sweetalert2/sweetalert2.min.css'

], 'public/css/plugins.css');


 mix.scripts([
    'resources/vendor/toastr/toastr.min.js',
    
    'resources/vendor/select2/js/select2.full.min.js',
    'resources/vendor/datatables/jquery.dataTables.js',


    'resources/vendor/select2/js/select2.min.js',
    'resources/vendor/sweetalert2/sweetalert2.min.js',
    'resources/vendor/bootstrap-switch/js/bootstrap-switch.min.js'
], 'public/js/plugins.js').sourceMaps();

 mix.js('resources/js/tallercontabilidad.js', 'public/js');



