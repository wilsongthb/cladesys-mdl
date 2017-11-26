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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

// mix.sass('resources/assets/sass/app.scss', 'public/css');
// mix.sass([
//     'resources/assets/sass/app.scss',
//     'resources/assets/sass/_bootswatch.scss'
// ], 'public/css/logistic.min.css')

mix.scripts([
    'public/bower_components/angular/angular.js',
    'public/bower_components/angular-route/angular-route.js',
    'public/bower_components/angular-bootstrap/ui-bootstrap.js',
    'public/bower_components/angular-bootstrap/ui-bootstrap-tpls.js',
    'public/bower_components/angular-ui-select/dist/select.js',
    'public/bower_components/money-formatter/dist/money-formatter.min.js',
    'public/bower_components/number-format.js/lib/format.min.js',
    'public/bower_components/moment/min/moment.min.js',
    'public/bower_components/js-xlsx/dist/cpexcel.js',
    'public/bower_components/js-xlsx/shim.js',
    'public/bower_components/js-xlsx/jszip.js',
    'public/bower_components/js-xlsx/xlsx.js',
    'public/bower_components/file-saver/FileSaver.js',
    'public/bower_components/angular-ui-uploader/dist/uploader.js',
    'public/bower_components/jquery.floatThead/dist/jquery.floatThead.min.js',
], 'public/js/logistic.vendor.min.js');