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

$(document).ready(function() {
    ShowMaterials();
});
