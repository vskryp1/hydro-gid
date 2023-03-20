var _index = $('.dz-preview').length;
Dropzone.options.galleries = {
    maxFilesize: window.custom_var.image_size,
    previewTemplate: window.custom_var.previewTemplate,
    previewsContainer: '#gallery_wrapper',
    addedfiles: function () {
        $('#upload-image-modal').modal('hide');
    },
    success: function (file, done) {
        _index++;
        $(file.previewElement).html($(file.previewElement).html().replace(/(<index>|&lt;index&gt;)/gm, _index));
        $(file.previewElement).find('[data-image-name]').val(done.file_name)
    },
    error: function (file, done) {
        new PNotify({
            title: done && done.message ? done.message : done,
            text: done.errors && done.errors.file ? done.errors.file[0] : '',
            type: 'error',
            styling: 'bootstrap3'
        });
    }
};

function formatState(state) {
    if (!state.id || state.cover === undefined) {
        return state.text;
    } else {
        return $('<span><img src="/cache/prod_sm/' + (state.cover.image !== undefined ? state.cover.image : '') + '" width="40px" class="" /> ' + state.text + '</span>');
    }
}

if(document.getElementById('gallery_wrapper')){
    Sortable.create(document.getElementById('gallery_wrapper'), {
        animation: 150,
        handle: ".dz-hover"
    });
}


$(document).ready(function () {
    $(document).on('click', '[data-dz-remove]', function (e) {
        $(this).parents('.dz-preview').remove();
    });

    var _product_search = $('.js_product_search');
    var _product_list = {};
    _product_search.select2({
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        templateResult: formatState,
        placeholder: {
            id: "-1",
            text: window.custom_var.search_placeholder
        },
        ajax: {
            url: window.custom_var.model_search_url,
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term,
                    id: window.custom_var.product_id,
                    model: window.custom_var.product_model
                };
            },
            processResults: function (data) {
                data.map(function (item, i) {
                    data[i].text = item.name;
                    data[i].id = item.id;
                });
                return {
                    results: data
                };
            }

        }
    });

    var _parent_search = $('.js_parent_search');
    var _parents_list = {};
    _parent_search.select2({
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        templateResult: formatState,
        placeholder: {
            id: "-1",
            text: window.custom_var.placeholder_products
        },
        ajax: {
            url: window.custom_var.product_search_url,
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term,
                    type: 'parent'
                };
            },
            delay: 250,
            processResults: function (data) {
                data.map(function (item, i) {
                    data[i].text = item.full_name;
                    _parents_list[item.id] = item;
                });
                return {
                    results: data
                };
            }

        }
    });
    _parent_search.on('change.select2', function (e) {
        var _btn = $('.js_manage_group_btn');
        _btn.on('click', function () {
            return false;
        })
        _btn.attr('disabled', true);
        _btn.removeAttr('data-dialog');
        _btn.find('span').text(window.custom_var.text_manage_group_btn);
    });

    var _filters = $('.js_filters');
    var _categories = $('.js_categories');
    var _main_category = $('.js_main_category');
    _filters.html(window.custom_var.text_least_category);
    _main_category.html(window.custom_var.text_least_category);
    _categories.on('change.select2', function (e) {
        var _old_main = window.custom_var.old_main != '' ? window.custom_var.old_main : $('[name="main_category"]:checked').val();
        _filters.html('');
        _main_category.html('');
        if ($(this).val().length > 0) {
            $(this).val().map(function (val) {
                var title = _categories.find('option[value="' + val + '"]').text();
                _main_category.append('' +
                    '<div class="radio">' +
                    '<label>' +
                    '<input type="radio" class="flat" name="main_category" value="' + val + '"> ' + title +
                    '</label>' +
                    '</div>');
            });
            $.ajax({
                url: window.custom_var.url_filters_category,
                method: 'post',
                data: {
                    categories: $(this).val(),
                    product: window.custom_var.product_id
                },
                success: function (data) {
                    _filters.html(data.filters != '' ? data.filters : window.custom_var.text_nothing_found);
                    $('.filter_select2').select2({
                        width: '100%',
                        tags: true,
                        placeholder: {
                            id: "-1",
                            text: '---select value or create new filter value---'
                        }
                    });
                }
            });
        } else {
            _main_category.append(window.custom_var.text_least_category);
            _filters.html(window.custom_var.text_least_category);
        }
        _main_category.find('[value="' + _old_main + '"]').prop('checked', true);
        if (_old_main == undefined || _old_main == '' || $('[name="main_category"]:checked').length == 0) {
            _main_category.find('input:first').prop('checked', true)
        }
        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
    _categories.trigger('change.select2');

    $('#availability').change(function() {
        if($(this).val() === $('#under_order_weeks').attr('data-product-availability'))
        {
            $("#under_order_weeks").show();
        }
        else
        {
            $("#under_order_weeks").hide();
            $("#under_order_weeks").find('input').val(null);
        }
    });

    $(document).on('click', '[data-tech-doc]', function (e) {
        $(this).parents('.tech-doc').remove();
        $('#technical_doc').val('');
    });
});