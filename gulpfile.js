const elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');
require('hexavel-elixir-config');

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

elixir(mix => {
    mix.sass('app.scss')
    .webpack('app.js');
});

/*
 |--------------------------------------------------------------------------
 | Elixir Test Management
 |--------------------------------------------------------------------------
 |
 | Beyond just assets you can use Elixir to monitor for code changes which
 | will check tests and provide notifications for when your application has
 | breaking changes.
 |
 */

elixir(mix => {
    mix.phpSpec();
});

elixir(mix => {
    mix.behat();
});