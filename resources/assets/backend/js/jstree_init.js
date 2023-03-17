var settings = {
    "core": {
        "animation": 0,
        "check_callback": true,
        "themes": {"stripes": true},
        'data': window.pages.jstreeData.pages,
        'deselect_all': false,
        "multiple": window.pages.jstreeData.multiple,
    },
    "types": {
        "#": {
            "max_children": 1,
            "max_depth": 5,
            "valid_children": ["root"],
        },
        "root": {
            "icon": "/static/3.3.4/assets/images/tree_icon.png",
            "valid_children": ["default"],
        },
        "default": {
            "valid_children": ["default", "file"],
        },
        "file": {
            "icon": "glyphicon glyphicon-file",
            "valid_children": []
        }
    },
    "plugins": [
        "types", "wholerow", "search", "dnd"
    ]
};

if (window.pages.jstreeData.enableCheckbox) {
    settings.checkbox = {"three_state": false};
    settings.core.three_state = false;
    settings.core.two_state = true;
    settings.plugins.push('checkbox');
}

var jsTree = $('#js_tree').jstree(settings);