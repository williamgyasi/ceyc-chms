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


mix.js('resources/js/core/app-menu.js', 'public/js/core')
    .js('resources/js/core/app.js', 'public/js/core')
    .js('resources/js/scripts/components.js', 'public/js/scripts')
    .js('resources/js/scripts/footer.js', 'public/js/scripts')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/bootstrap.scss', 'public/css')
    .sass('resources/sass/bootstrap-extended.scss', 'public/css')
    .sass('resources/sass/colors.scss', 'public/css')
    .sass('resources/sass/components.scss', 'public/css')
    .sass('resources/sass/themes/dark-layout.scss', 'public/css/themes')
    .sass('resources/sass/themes/semi-dark-layout.scss', 'public/css/themes')
    .sass('resources/sass/pages/authentication.scss', 'public/css/pages')
    .sass('resources/sass/pages/dashboard-analytics.scss', 'public/css/pages')
    .sass('resources/sass/core/menu/menu-types/vertical-menu.scss', 'public/css/core/menu/menu-types')
    .sass('resources/sass/core/core.scss', 'public/css/core');
    // .browserSync('http://127.0.0.1:8000/');
