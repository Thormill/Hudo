var count = 0;

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
	count++;

	var jsonPlan = '{"plan_number":' + count + ',';
    jsonPlan +=  '"item_id":' + $('#itemlist option:selected').val() + ',';
    jsonPlan +=  '"amount_to_make":' + $('#amount').val() + ',';
    jsonPlan +=  '"price":' + $('#price').val() + ',';
    jsonPlan +=  '"comment":"' + $('#comment').val() + '"}';
	alert(jsonPlan);
	
	var text = $('#currentplan').html();
	text += $('#typelist option:selected').text() + ' / ';
	text += $('#categorylist option:selected').text() + ' / ';
	text += $('#itemlist option:selected').text() + ' / ';
	text += $('#amount').val() + 'шт. / ';
	text += $('#price').val() + 'руб. /';
	text += $('#comment').val() + '<br />';
	text += '<input type="hidden" name="planpoint' + count + '" value="' + jsonPlan + '" />';
	$('#currentplan').html(text);
}

function Add() {
	$('#planpreview').append('<input type="hidden" name="Count" value="' + count + '" />');
    $.post('ajax/addPlan.php', $('#planpreview').serialize(),
        function (data) {
			alert(data);
            PlanClear();
            count = 0;
        });
}

function PlanClear() {
}
