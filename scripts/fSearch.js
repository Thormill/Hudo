function startSearch() {
//    $('#content').html('<img src="img/search.gif" alt="идет поиск...">')
    $.post('ajax/searchPayment.php', $('#fSearch').serialize(),
        function (data) {
            showMessage('<p><b>Результаты поиска:</b></p>' + data + '<br />');
        });
//    $('#content').html('');
}

function pickDate() {
    if ($('#s_date').val() == 5) {
        $('#p_datepicker').html('<input type="text" id="datepicker" name="datepicker" />')
// инициализация datepicker'a
        $('#datepicker').datepicker();
// вставка подсказки
        $('#datepicker').val('нажмите');
    } else
        $('#p_datepicker').html('');
};

$(document).ready(function(){
    var masters = '';
    $.post('ajax/loadMastersArray.php', null,
        function (data) {masters = data.split(';')}).done(function(){
		$("#fio").autocomplete(masters);
	  });    
});
