function setModelName(_value){
    var model_results = $('#modelResults');
    model_results.prop("disabled", false);
    if(_value === ''){
        model_results.prop("disabled", true);
    }
}

$(document).ready(function () {
    var model_name = $('#modelName');
    var model_results = $('#modelResults');
    model_results.select2({
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
                    model: $("#modelName").val()
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
    model_name.on('change', function () {
        model_results.val(null).trigger('change');
        setModelName($(this).val());
    });

    $('#menuType').on('change', function () {
        model_results.val(null).trigger('change');
        model_name.val(window.custom_var.models[parseInt($(this).val())])
        setModelName(model_name.val());
    });
    setModelName(model_name.val());
});