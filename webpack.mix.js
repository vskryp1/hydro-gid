const mix = require('laravel-mix');
const webpack = require('webpack');
/*
 |--------------------------------------------------------------------------
 | Auth
 |--------------------------------------------------------------------------
 |
 */
function login(mix) {
    mix.styles([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        'node_modules/gentelella/vendors/animate.css/animate.css',
        'node_modules/gentelella/build/css/custom.css',
        'resources/assets/auth/css/login.css',
    ], 'public/assets/auth/css/auth.css');
}

/*
 |--------------------------------------------------------------------------
 | Backend
 |--------------------------------------------------------------------------
 |
 */
function backend(mix) {
    mix.scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/pace-progress/pace.js',
        'resources/assets/backend/libs/bootstrap-3.4.1-dist/js/bootstrap.min.js',
        'node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
        'node_modules/gentelella/vendors/switchery/dist/switchery.min.js',
        'node_modules/gentelella/vendors/pnotify/dist/pnotify.js',
        'node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.js',
        'resources/assets/backend/js/init_ckeditor.js',
        'node_modules/bootstrap-toggle/js/bootstrap-toggle.min.js',
        'resources/assets/backend/js/ckeditor_adapter.js',
        'node_modules/gentelella/production/js/moment/moment.min.js',
        'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js',
        'node_modules/gentelella/vendors/nprogress/nprogress.js',
        'node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
        'resources/assets/backend/js/custom.js',
        'node_modules/jquery-validation/dist/jquery.validate.js',
        'resources/assets/backend/js/jquery-laravel.js',
        'node_modules/select2/dist/js/select2.js',
    ], 'public/assets/backend/js/backend.js');

    mix.styles([
        'node_modules/font-awesome/css/font-awesome.css',
        'node_modules/pace-progress/themes/blue/pace-theme-minimal.css',
        'resources/assets/backend/libs/bootstrap-3.4.1-dist/css/bootstrap.css',
        'node_modules/gentelella/vendors/animate.css/animate.css',
        'node_modules/gentelella/vendors/switchery/dist/switchery.min.css',
        'node_modules/gentelella/vendors/pnotify/dist/pnotify.css',
        'node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.css',
        'resources/assets/backend/css/*.css',
        'node_modules/bootstrap-toggle/css/bootstrap-toggle.min.css',
        'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css',
        'node_modules/gentelella/vendors/nprogress/nprogress.css',
        'node_modules/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
        'node_modules/gentelella/build/css/custom.css',
        'node_modules/select2/dist/css/select2.css',
    ], 'public/assets/backend/css/backend.css');

    mix.copy('node_modules/ckeditor', 'public/assets/backend/modules/ckeditor');
    mix.copy('node_modules/gentelella/vendors/iCheck/', 'public/assets/backend/modules/iCheck');
    mix.copy('node_modules/jstree/', 'public/assets/backend/modules/jstree');
    mix.copy('node_modules/gentelella/vendors/mjolnic-bootstrap-colorpicker/dist', 'public/assets/backend/modules/bootstrap-colorpicker');

    mix.copy('resources/assets/backend/images', 'public/assets/backend/images');

    mix.copy([
        'node_modules/jstree/dist/themes/default/32px.png',
        'node_modules/jstree/dist/themes/default/40px.png',
        'node_modules/jstree/dist/themes/default/throbber.gif',
        'resources/assets/backend/images/no_avatar.png',
        'resources/assets/backend/images/no_image.png',
    ], 'public/assets/backend/images');

    mix.copy([
        'node_modules/font-awesome/fonts',
        'node_modules/gentelella/vendors/bootstrap/dist/fonts',
    ], 'public/assets/backend/fonts');

    mix.scripts([
        'node_modules/X-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js',
        'resources/assets/backend/js/translations.js',
    ], 'public/assets/backend/js/translations.js');

    mix.styles([
        'node_modules/X-editable/dist/bootstrap3-editable/css/bootstrap-editable.css',
    ], 'public/assets/backend/css/translations.css');

    mix.scripts([
        'node_modules/gentelella/vendors/Flot/jquery.flot.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.time.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.pie.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.stack.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.resize.js',
        'node_modules/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js',
        'node_modules/gentelella/vendors/DateJS/build/date.js',
        'node_modules/gentelella/vendors/flot.curvedlines/curvedLines.js',
        'node_modules/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js',
        'node_modules/gentelella/vendors/Chart.js/dist/Chart.js',
        'node_modules/jcarousel/dist/jquery.jcarousel.min.js',
        'resources/assets/backend/js/dashboard.js',
    ], 'public/assets/backend/js/dashboard.js');

    mix.styles([
        'resources/assets/backend/css/dashboard.css',
    ], 'public/assets/backend/css/dashboard.css');

    mix.scripts([
        'node_modules/sortablejs/Sortable.min.js',
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
        'node_modules/gentelella/vendors/dropzone/dist/min/dropzone.min.js',
        'resources/assets/backend/js/product.js',
        'vendor/alexusmai/laravel-file-manager/resources/assets/js/file-manager.js'
    ], 'public/assets/backend/js/product.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css',
        'node_modules/gentelella/vendors/dropzone/dist/min/dropzone.min.css',
        'vendor/alexusmai/laravel-file-manager/resources/assets/css/file-manager.css',
    ], 'public/assets/backend/css/products.css');

    mix.scripts([
        'vendor/unisharp/laravel-filemanager/public/js/script.js',
        'vendor/unisharp/laravel-filemanager/public/js/cropper.min.js',
        'vendor/unisharp/laravel-filemanager/public/js/dropzone.min.js',
    ], 'public/assets/backend/js/cropper_dropzone.js');

    mix.scripts([
        'vendor/unisharp/laravel-filemanager/public/css/lfm.css',
        'vendor/unisharp/laravel-filemanager/public/css/cropper.min.css',
        'vendor/unisharp/laravel-filemanager/public/css/dropzone.min.css',
    ], 'public/assets/backend/css/cropper_dropzone.css');

    mix.scripts([
        'node_modules/sortablejs/Sortable.min.js',
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
        'resources/assets/backend/js/product_group.js'
    ], 'public/assets/backend/js/product_group.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css',
    ], 'public/assets/backend/css/products_group.css');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
        'resources/assets/backend/js/search_model.js'
    ], 'public/assets/backend/js/reviews.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css',
    ], 'public/assets/backend/css/reviews.css');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
        'resources/assets/backend/js/search_model.js'
    ], 'public/assets/backend/js/stocks.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css',
    ], 'public/assets/backend/css/stocks.css');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
        'resources/assets/backend/js/search_model.js',
    ], 'public/assets/backend/js/menu_items.js');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
        'resources/assets/backend/js/jstree_init.js',
        'resources/assets/backend/js/menus.js'
    ], 'public/assets/backend/js/menus.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css',
    ], 'public/assets/backend/css/menu_items.css');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
    ], 'public/assets/backend/js/promocodes.js');

    mix.styles(['node_modules/select2/dist/css/select2.css'], 'public/assets/backend/css/promocodes.css');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
        'resources/assets/backend/js/order.js'
    ], 'public/assets/backend/js/order.js');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
        'resources/assets/backend/js/review.js'
    ], 'public/assets/backend/js/review.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css'
    ], 'public/assets/backend/css/orders.css');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
    ], 'public/assets/backend/js/filters.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css'
    ], 'public/assets/backend/css/filters.css');

    mix.scripts([
        'resources/assets/backend/js/pages/jstree_init.js'
    ], 'public/assets/backend/js/pages/jstree_init.js');

    mix.scripts([
        'node_modules/sortablejs/Sortable.min.js',
        'resources/assets/backend/js/pages/edit.js',
    ], 'public/assets/backend/js/pages/edit.js');

    mix.scripts([
        'node_modules/sortablejs/Sortable.min.js',
        'resources/assets/backend/js/pages/products_sort.js',
    ], 'public/assets/backend/js/pages/products_sort.js');

    mix.scripts([
        'resources/assets/backend/js/pages/create.js'
    ], 'public/assets/backend/js/pages/create.js');

    mix.scripts([
        'resources/assets/backend/js/pages/index.js'
    ], 'public/assets/backend/js/pages/index.js');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
    ], 'public/assets/backend/js/payments.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css'
    ], 'public/assets/backend/css/payments.css');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
    ], 'public/assets/backend/js/deliveries.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css'
    ], 'public/assets/backend/css/deliveries.css');

    mix.scripts([
        'node_modules/select2/dist/js/select2.js',
        'resources/assets/backend/js/select2.js',
    ], 'public/assets/backend/js/regions.js');

    mix.styles([
        'node_modules/select2/dist/css/select2.css'
    ], 'public/assets/backend/css/regions.css');

    mix.scripts([
        'resources/assets/backend/js/clients.js'
    ], 'public/assets/backend/js/clients.js');

    mix.scripts([
        'node_modules/sortablejs/Sortable.js',
        'resources/assets/backend/js/import.js'
    ], 'public/assets/backend/js/import.js');
}

/*
 |--------------------------------------------------------------------------
 | Frontend
 |--------------------------------------------------------------------------
 |
 */
function frontend(mix) {
    const WebfontPlugin = require('webfont-webpack-plugin').default;

    mix.options({
                    cssNano: {
                        discardComments: {
                            removeAll: true,
                        },
                    },
                });

    mix.autoload({
                     jquery: ['$', 'window.jQuery', 'jquery']
                 });

    mix.webpackConfig({
                          resolve: {
                              modules: [
                                  'node_modules',
                                  path.resolve(__dirname, 'resources/assets/frontend/js/libs/')
                              ]
                          },
                          plugins: [
                              new WebfontPlugin({
                                                    files:             'resources/assets/frontend/icons/**/*.svg',
                                                    dest:              'resources/assets/frontend/fonts/iconfont',
                                                    bail:              true,
                                                    css:               true,
                                                    cssFormat:         'scss',
                                                    templateClassName: 'icon',
                                                    fontName:          'iconfont',
                                                    templateFontPath:  '../fonts/iconfont',
                                                    templateFontName:  'iconfont',
                                                    template:          'resources/assets/frontend/sass/global-style/iconfont.scss.njk',
                                                    destTemplate:      'resources/assets/frontend/sass/global-style',
                                                    normalize:         true,
                                                    fontHeight:        600
                                                }),
                              new webpack.ProvidePlugin({
                                                            $:               'jquery',
                                                            jQuery:          'jquery',
                                                            'window.jQuery': 'jquery'
                                                        })
                          ]
                      });

    const options = {
        processCssUrls: false
    };
    /* SASS */
    mix.sass('resources/assets/frontend/sass/main.scss', 'public/assets/frontend/css/main.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/basket.scss', 'public/assets/frontend/css/basket.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/category.scss', 'public/assets/frontend/css/category.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/personal.scss', 'public/assets/frontend/css/personal.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/stock.scss', 'public/assets/frontend/css/stock.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/compare.scss', 'public/assets/frontend/css/compare.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/searchresult.scss', 'public/assets/frontend/css/searchresult.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/product.scss', 'public/assets/frontend/css/product.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/stock-page.scss', 'public/assets/frontend/css/stock-page.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/blog.scss', 'public/assets/frontend/css/blog.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/blog-one.scss', 'public/assets/frontend/css/blog-one.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/reviews.scss', 'public/assets/frontend/css/reviews.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/questions.scss', 'public/assets/frontend/css/questions.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/about.scss', 'public/assets/frontend/css/about.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/certificates.scss', 'public/assets/frontend/css/certificates.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/contacts.scss', 'public/assets/frontend/css/contacts.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/service.scss', 'public/assets/frontend/css/service.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/success-order.scss', 'public/assets/frontend/css/success-order.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/calculator.scss', 'public/assets/frontend/css/calculator.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/404-page.scss', 'public/assets/frontend/css/404-page.min.css').options(options);
    mix.sass('resources/assets/frontend/sass/checkout.scss', 'public/assets/frontend/css/checkout.min.css').options(options);

    /* JS */
    mix.js('resources/assets/frontend/js/main.js', 'public/assets/frontend/js');
    mix.js('resources/assets/frontend/js/product.js', 'public/assets/frontend/js');
    mix.js('resources/assets/frontend/js/category.js', 'public/assets/frontend/js');
    mix.js('resources/assets/frontend/js/compare.js', 'public/assets/frontend/js');
    mix.js('resources/assets/frontend/js/searchresult.js', 'public/assets/frontend/js');
    mix.js('resources/assets/frontend/js/personal.js', 'public/assets/frontend/js');

    /* IMAGES */
    mix.copy('resources/assets/frontend/images', 'public/assets/frontend/images');

    /* FONTS */
    mix.copy('resources/assets/frontend/fonts', 'public/assets/frontend/fonts');

    /* CSS LIBS */
    mix.copy('resources/assets/frontend/css/libs', 'public/assets/frontend/css/libs');

    /* JS LIBS */
    mix.copy('resources/assets/frontend/js/libs', 'public/assets/frontend/js/libs');
}

/*
 |--------------------------------------------------------------------------
 | Vue
 |--------------------------------------------------------------------------
 |
 */
function vue(mix) {
    mix.js('resources/assets/vue/calculators/Hydraulic/index.js', 'public/assets/vue/calculators/Hydraulic');
    mix.js('resources/assets/vue/calculators/Drive/index.js', 'public/assets/vue/calculators/Drive');
}

login(mix);
backend(mix);
frontend(mix);
vue(mix);
