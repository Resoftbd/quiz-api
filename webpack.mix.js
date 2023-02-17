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

// global resource css
mix.styles([
    'public/assets/template/app-assets/vendors/css/vendors.min.css',
    'public/assets/template/app-assets/vendors/css/extensions/nouislider.min.css',
    'public/assets/app-assets/vendors/css/extensions/toastr.min.css',
    'public/assets/template/app-assets/css/bootstrap.css',
    'public/assets/template/app-assets/css/bootstrap-extended.css',
    'public/assets/template/app-assets/css/colors.css',
    'public/assets/template/app-assets/css/components.css',
    'public/assets/template/app-assets/css/themes/dark-layout.css',
    'public/assets/template/app-assets/css/themes/bordered-layout.css',
    'public/assets/template/app-assets/css/core/menu/menu-types/horizontal-menu.css',
    'public/assets/template/app-assets/css/plugins/extensions/ext-component-sliders.css',
    'public/assets/template/app-assets/css/pages/app-ecommerce.css',
    'public/assets/template/app-assets/css/plugins/extensions/ext-component-toastr.css',
    'public/assets/template/assets/css/style.css',
],'public/mix/css/resources.css').version();

// global resource js
mix.scripts([
    'public/assets/template/app-assets/vendors/js/vendors.min.js',
    'public/assets/template/app-assets/vendors/js/ui/jquery.sticky.js',
    'public/assets/template/app-assets/vendors/js/extensions/wNumb.min.js',
    'public/assets/template/app-assets/vendors/js/extensions/nouislider.min.js',
    'public/assets/template/app-assets/vendors/js/extensions/toastr.min.js',
    'public/assets/template/app-assets/js/core/app-menu.js',
    'public/assets/template/app-assets/js/core/app.js',
    'public/assets/template/app-assets/js/scripts/pages/app-ecommerce.js',
    'public/assets/js/mustache.js',
],'public/mix/js/resources.js').version();

// marketplace js
mix.js('resources/js/marketplace/marketplace.js', 'public/mix/js/marketplace.js').version();
