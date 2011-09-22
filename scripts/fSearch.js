function startSearch() {
//    $("#content").html('<img src="img/search.gif" alt="идет поиск...">')
    $.post("ajax/searchPayment.php", $("#fSearch").serialize(),
        function (data) {
            showMessage('<p>Результаты поиска:</p>' + data + '<br />');
        });
//    $("#content").html("");
}

function pickDate() {
    if ($("#s_date").val() == 5) {
        $("#p_datepicker").html('<input type="text" id="datepicker" name="datepicker" />')
// инициализация datepicker'a
        $("#datepicker").datepicker();
// вставка подсказки
        $("#datepicker").val('нажмите');
    } else
        $("#p_datepicker").html('');
};
