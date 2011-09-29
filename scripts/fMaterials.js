function MaterialClick(material) {
	$.post('ajax/MaterialCheck.php', { id : $(material).val(), amount : $('#amount' + $(material).val()).val() },
    function (data) {
       showMessage(data, 'info');
    });
    
    $.post('ajax/currentMaterialAmount.php', { id : $(material).val() },
    function (val) {
        $('#amount' + $(material).val()).val(val);
	    if (val == 0)
	        $(material).parent().html('');
		if($(material).parent().parent().html() == '')
		{
		    $(material).parent().parent().parent().html('');
		}
    });
}
