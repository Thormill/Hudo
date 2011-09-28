function MaterialClick(material) {
	$.post('ajax/MaterialCheck.php', { id : $(material).val(), amount : $('#amount').val() },
    function (data) {
       alert(data);
    });
}
