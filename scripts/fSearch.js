function startSearch() {
    $("#content").html('<img src="img/search.gif" alt="идет поиск...">')
    $.post("forms/ajax/searchPayment.php", $("#fSearch").serialize(),
        function (data) {
            alert($("#fSearch").serialize());
    });
    $("#content").html("");
}