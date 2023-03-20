window.$ = window.jQuery = require('jquery');
window.Slick = require('slick-carousel/slick/slick.js');
window.Swal = require('sweetalert2');
require('bootstrap');
require('popper.js');
require('select2/dist/js/select2.full.min');
require('@fancyapps/fancybox');
require('raty-js');
require('malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar');
require('jquery.mmenu/dist/jquery.mmenu.all.js');
require('jquery-lazy/jquery.lazy');
require('./elements/tabs');
require('./elements/selectQwProd');
require('./libs/jquery.maskedinput');
require('./elements/common');
require('./main/index');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
