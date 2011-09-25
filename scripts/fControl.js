function ItemAdd() {
	$.post('ajax/addItem.php', { Type : $('#atype').val(), Category : $('#acategory').val(),
	 Item : $('#aitem').val(), Price : $('#aprice').val() },
    function (data) {
       alert(data);
    });
}
