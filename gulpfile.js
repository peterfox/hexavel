var elixir = require('laravel-elixir');
elixir.config.appPath = "src";
elixir.config.viewPath = "support/resources/views";
elixir.config.phpBinPath = "bin";
elixir.config.assetsPath = "support/resources/assets/";
elixir.config.testing.phpSpec.path = "support/spec";
elixir.config.testing.behat.path = "support/features";

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
    mix.sass('app.scss');
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

elixir(function(mix) {
    mix.phpSpec();
});

elixir(function(mix) {
    mix.behat();
});