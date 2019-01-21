// セレクトボックスの表示
$('select').each(function () {
    var select = $(this);
    var selected = $(this).data('selected');
    select.children('option[value="' + selected + '"]').prop('selected', true);
});