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
    format: "yyyy-mm-dd",
    clearBtn: true,
    language: "pt-BR",
    multidate: false,
    autoclose: true,
    todayHighlight: true
});

$('.select2').select2({
    placeholder: 'Selecione uma Opção'
});
