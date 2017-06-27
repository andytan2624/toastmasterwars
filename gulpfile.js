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
    mix.sass('application.scss', './public/css/application.css');

    mix.scripts('meetings.js', 'public/js/meetings.js');

    mix.scripts('reporting.js', 'public/js/reporting.js');
});
