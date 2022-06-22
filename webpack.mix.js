const mix = require("laravel-mix");
require("laravel-mix-purgecss");

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
    // .extract()
    .sass("resources/scss/app.scss", "public/css/app.css")
    .sass("resources/scss/app-992.scss", "public/css/app-992.css")
    .sass("resources/scss/admin.scss", "public/css/admin.css")
    // .purgeCss()
    .copyDirectory("resources/images", "public/images")
    .copyDirectory("resources/images/webp", "public/images/webp")
    // .sourceMaps(true, "source-map")
    .version();
