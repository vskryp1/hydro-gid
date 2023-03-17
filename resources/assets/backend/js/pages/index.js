jsTree.on('move_node.jstree', function (e, data) {

    $.post(window.pages.jstreeData.sort_pages_url,
        {
            "_token"      : window.pages.jstreeData.token,
            'id'          : data.node.id,
            'parent_id'   : data.parent,
            'position'    : data.position,
            'old_position': data.old_position,
            'old_parent'  : data.old_parent
        })
        .fail(function () {
            data.instance.refresh();
        });
}).on("changed.jstree", function (e, data) {
    window.location.href = window.pages.jstreeData.edit_url + data.node.id;
});