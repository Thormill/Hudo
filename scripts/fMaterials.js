var backup = '';

function MaterialClick(material) {
	$.post('ajax/MaterialCheck.php', { id : $(material).attr('id'), amount : $('#amount' + $(material).attr('id')).val() },
    function (data) {
       showMessage(data, 'info');
    }).done(function(){
          ShowMaterials();
    });
}

function ShowMaterials() {
    $.post('ajax/MaterialShow.php', { status : $('#status').prop('checked') },
    function (data) {
       $('#Mcontainer').html(data);
    });
}

function DeleteMaterial(id) {
    $.post('ajax/MaterialDel.php', { id : id },
    function (data) {
       showMessage(data);
    });
}

function EditMaterial(id) {
	backup = $('#material_block' + id).html();
	var edit_block = '<SELECT id="select' + id + '"></SELECT>';
	edit_block += '<input type = "text" id="amount' + id + '" style="width: 25px;" value="' + $('#amount' + id).val() + '"></input>штук ';
	edit_block += '<br />';
	edit_block += 'Комментарий: <input type="text" id="comment' + id + '" value="' + $('#comment' + id).html() + '" / >';
	edit_block += '<input type="button" value="Сохранить" onClick="SaveMaterial(' + id + ')">';
	edit_block += '<input type="button" value="Отменить" onClick="RestoreMaterial(' + id + ')">';
	$('#material_block' + id).html(edit_block);
	$('#comment' + id).html('');
	$.post('ajax/loadMaterials.php', null,
        function (data) {
            $('#select' + id).html(data);
        }).done(function(){
			$('#select' + id).val($('#material_id' + id).val());
	});
}

function RestoreMaterial(id) {
    $('#material_block' + id).html(backup);
}

function SaveMaterial(id) {
    $.post('ajax/MaterialEdit.php', { id : id, amount : $('#amount' + id).val(), 
                                      comment : $('#comment' + id).val(), 
                                      material_id : $('#select' + id + ' option:selected').val()},
    function (data) {
       showMessage(data);
    }).done(function(){
		ShowMaterials();
	});
}

$(document).ready(function() {
    ShowMaterials();
});
