Sortable.create(document.getElementById('category_sorts'), {
    animation: 150,
    handle: "tr",
    onUpdate: function( evt) {
        $.each($('#category_sorts tr'), function (i, el){
            $(this).find('.js_position').val(i);
        })
    }
});