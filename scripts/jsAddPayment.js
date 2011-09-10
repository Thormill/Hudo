function getCategories() {
    $.post("forms/ajax/getCategories.php", { iType : $("#type option:selected").val() },
        function (data) {
            $("#category").html(data);
        });
    $("#item").html("");
    $("#amount").html("");
    $("#price").html("");
    $("#addbutton").html("");
}

function getItems() {
    $.post("forms/ajax/getItems.php", { iCategory : $("#category option:selected").val() },
        function (data) {
            $("#item").html(data);
        });
}

function getAmount() {
    $("#amount").html('Количество: <input type="text" name="amount" />');
    $.post("forms/ajax/getPrice.php", { iItem : $("#item option:selected").val() },
        function (data) {
            $("#price").html(data);
        });
    $("#addbutton").html('<input type="button" name="" onclick="addPayment();" value="Работа оплачена" />');
}

function addPayment() {
//    regexp_fio = /^\s*[a-zа-яё]+\s[a-zа-яё]+\s*[a-zа-яё]*\s*$/i;
    if ($("#fio").val() != 0) {
        if ($("#type").val() != 0 && $("#category option:selected").val() != 0 && $("#item option:selected").val() != 0) {
            regexp_amount = /^[1-9][0-9]*$/;
            if (regexp_amount.test($("[name=amount]").val())) {
                if (regexp_amount.test($("[name=price]").val())) {
                    $.post("forms/ajax/addPayment.php", $("#fAdd").serialize(),
                        function (data) {
                            alert(data);
                        });
                }
                else
                    alert("Ошибка! \r\n>> Введите верную цену!");    
            }
            else
                alert("Ошибка! \r\n>> Введите верное количество!");
        }
        else
            alert("Ошибка! \r\n>> Выберите Вид-Категорию-Изделие!");
    }
    else
        alert("Ошибка! \r\n>> Выберите мастера!");
}