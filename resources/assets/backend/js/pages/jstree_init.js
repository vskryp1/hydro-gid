var settings = {
    "core"   : {
        "animation"     : 0,
        "check_callback": true,
        "themes"        : {"stripes": true},
        'data'          : window.pages.jstreeData.pages,
        'deselect_all'  : false,
        "multiple"      : window.pages.jstreeData.multiple,
    },
    "types"  : {
        "#"      : {
            "max_children"  : 1,
            "max_depth"     : 5,
            "valid_children": ["root"],
        },
        "root"   : {
            "icon"          : "/static/3.3.4/assets/images/tree_icon.png",
            "valid_children": ["default"],
        },
        "default": {
            "valid_children": ["default", "file"],
        },
        "file"   : {
            "icon"          : "glyphicon glyphicon-file",
            "valid_children": []
        }
    },
    "plugins": [
        "types", "wholerow", "search", "dnd"
    ]
};

if (window.pages.jstreeData.enableCheckbox) {
    settings.checkbox         = {"three_state": false};
    settings.core.three_state = false;
    settings.core.two_state   = true;
    settings.plugins.push('checkbox');
}

var jsTree = $('#js_tree').jstree(settings);




function formatState(state) {
    if (!state.id || state.cover === undefined) {
        return state.text;
    } else {
        return $('<span><img src="/cache/prod_sm/' + (state.cover.image !== undefined ? state.cover.image : '') + '" width="40px" class="" /> ' + state.text + '</span>');
    }
}

$(document).ready(function () {
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

    var _page_search = $('.js_page_search');
    _page_search.select2({
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
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
                    model: window.custom_var.page_model
                };
            },
            delay: 250,
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

    var _tag_search = $('.js_tag_search');
    _tag_search.select2({
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
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
                    model: window.custom_var.tag_model
                };
            },
            delay: 250,
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
});