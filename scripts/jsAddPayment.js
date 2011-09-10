function getCategories()
{
    $.post("forms/ajax/getCategories.php", { iType : $("#type option:selected").val() },
        function (data) {
            $("#category").html(data);
        });
    $("#item").html("");
    $("#amount").html("");
    $("#price").html("");
    $("#addbutton").html("");
}

function getItems()
{
    $.post("forms/ajax/getItems.php", { iCategory : $("#category option:selected").val() },
        function (data) {
            $("#item").html(data);
        });
}

function getAmount()
{
    $("#amount").html('Количество: <input type="text" name="amount" />');
    $.post("forms/ajax/getPrice.php", { iItem : $("#item option:selected").val() },
        function (data) {
            $("#price").html(data);
        });
    $("#addbutton").html('<input type="button" onclick="addPayment();" value="Работа оплачена" />');
}