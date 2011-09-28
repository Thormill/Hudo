function TypeClick() {
	$('#itemlist option').attr('selected', false);
    $('#itemlist').html('<option>--Сначала выберите категорию--</option>');
    $('#price').val('');
    $('#categorylist option').attr('selected', false);
    $.post('ajax/loadCategories.php', { t_id : $('#typelist option:selected').val()},
    function (data) {
       $('#categorylist').html(data);
    });
}

function CategoryClick() {
    $('#itemlist option').attr('selected', false);
    $('#price').val('');
    $.post('ajax/loadItems.php', { c_id : $('#categorylist option:selected').val()},
    function (data) {
       $('#itemlist').html(data);
    });
}

function ItemClick() {
    $.post('ajax/loadPrice.php', { item_id : $('#itemlist option:selected').val()},
    function (data) {
       $('#price').val(data);
    });
}

function AddToList() {
	var text = $('#currentplan').html();
	text += '<option>';
	text += $('#typelist option:selected').text() + ' / ';
	text += $('#categorylist option:selected').text() + ' / ';
	text += $('#itemlist option:selected').text() + ' / ';
	text += $('#amount').val() + 'шт. / ';
	text += $('#price').val() + 'руб.';
	text += '</option>';
	$('#currentplan').html(text);
}

function Add() {
}

function PlanClear() {
}
