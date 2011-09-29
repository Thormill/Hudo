function MaterialClick(material) {
	$.post('ajax/MaterialCheck.php', { id : $(material).val(), amount : $('#amount' + $(material).val()).val() },
    function (data) {
       showMessage(data, 'info');
    });
    
    $.post('ajax/currentMaterialAmount.php', { id : $(material).val() },
    function (data) {
       $('#amount' + $(material).val()).val(data);
    });
}
