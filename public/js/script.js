$('.btn-filter').on('click', function () {
    $('.overlay').removeClass('overlay-hidden');
});

$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    clearBtn: true,
    language: "pt-BR",
    multidate: false,
    autoclose: true,
    todayHighlight: true
});