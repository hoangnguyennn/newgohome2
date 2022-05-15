const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/scss/app.scss", "public/css/app.css")
    .sass("resources/scss/app-992.scss", "public/css/app-992.css")
    .copyDirectory("resources/images", "public/images")
    .sourceMaps(true, "source-map")
    .version();
