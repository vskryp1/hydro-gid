$('#js_tree').jstree({
    "core": {
        "animation": 0,
        "check_callback": true,
        "themes": {"stripes": true},
        'data': window.custom_var.pages,
        'deselect_all': false,
        "multiple": true,
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
}).on('move_node.jstree', function (e, data) {

    $.post(window.custom_var.sort_pages_url,
        {
            "_token": window.custom_var.token,
            'id': data.node.id,
            'parent_id': data.parent,
            'position': data.position,
            'old_position': data.old_position,
            'old_parent': data.old_parent
        })
        .fail(function () {
            data.instance.refresh();
        });
});

$('#js_tree').on("changed.jstree", function (e, data) {
    window.location.href = window.custom_var.edit_url + data.node.id;
});