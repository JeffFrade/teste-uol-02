$('.btn-clear').on('click', function (e) {
    e.preventDefault();

    $(document).find('input').val('');
    $(document).find('textarea').val('');
    $(".multi-select").val(null).trigger("change");
    $(".single-select").val(null).trigger("change");
});

$('.btn-overlay').on('click', function (e) {
    $('.overlay').removeClass('overlay-hidden');
});

$('.btn-save').on('click', function (e) {
    $('.overlay').removeClass('overlay-hidden');
});

$.notifyDefaults({
    z_index: 100000
});

$('.form-error').each(function (index) {
    $.notify({message: $(this).text()}, {type: 'danger'});
});

$('.form-success').each(function (index) {
    $.notify({message: $(this).text()}, {type: 'success'});
});

$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    clearBtn: true,
    language: "pt-BR",
    multidate: false,
    autoclose: true,
    todayHighlight: true
});


