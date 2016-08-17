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
    mix.sass(['app.scss', 'other.scss']);

    mix.babel(['main.js']);

    var bowerDir = './bower_components/'

    mix.scripts([
        'jquery/dist/jquery.min.js',
        'typeahead.js/dist/typeahead.bundle.min.js'
    ], 'public/js/all.js', bowerDir)
});
