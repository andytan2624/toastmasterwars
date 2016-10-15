var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss', './public/css/app.css');
    mix
        .copy('bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js', 'public/js/bootstrap-timepicker.js')
    ;

    mix.less('./bower_components/bootstrap-timepicker/css/timepicker.less', 'public/css/timepicker.css');


});
