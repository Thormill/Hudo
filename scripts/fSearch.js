function startSearch() {
    $("#content").html('<img src="img/search.gif" alt="идет поиск...">')
    $.post("ajax/searchPayment.php", $("#fSearch").serialize(),
        function (data) {
            $("#content").html(data);
    });
    $("#content").html("");
}
