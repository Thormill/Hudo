function MaterialClick(material) {
	$.post('ajax/MaterialCheck.php', { id : $(material).val(), amount : $('#amount' + $(material).val()).val() },
    function (data) {
       showMessage(data);
    });
}
