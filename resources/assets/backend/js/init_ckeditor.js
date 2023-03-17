$(document).ready(function () {
    var routePrefix = '/laravel-filemanager';
    var config        = {
        filebrowserImageBrowseUrl: routePrefix + '?type=Images',
        filebrowserImageUploadUrl: routePrefix + '/upload?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
        filebrowserBrowseUrl     : routePrefix + '?type=Files',
        filebrowserUploadUrl     : routePrefix + '/upload?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content'),
        extraAllowedContent: 'iframe[*]',
        allowedContent: true,
        language: $('html').attr('lang'),
        fillEmptyBlocks: false
    };
    $('.ck-editor').ckeditor(config);
});
