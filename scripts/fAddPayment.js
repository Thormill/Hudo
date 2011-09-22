var iCurrPrice

function getCategories() {
    $.post("ajax/getCategories.php", { iType : $("#type option:selected").val() },
        function (data) {
            $("#category").html(data);
        });
    $("#item").html("");
    $("#amount").html("");
    $("#price").html("");
    $("#addbutton").html("");
    $("#addcomment").html("");
}

function getItems() {
    $.post("ajax/getItems.php", { iCategory : $("#category option:selected").val() },
        function (data) {
            $("#item").html(data);
        });
    $("#amount").html("");
    $("#price").html("");
    $("#addbutton").html("");
    $("#addcomment").html("");
}

function getAmount() {
    $("#amount").html('Количество: <input type="text" name="amount" id="multiplier" onkeyup="count()"/>');
    $.post("ajax/getPrice.php", { iItem : $("#item option:selected").val() },
        function (data) {
            $("#price").html(data);
            iCurrPrice = $("#given").val();
        });
    $("#addcomment").html('Ваш комментарий: <input type="text" name="comment_text" />');
    $("#addbutton").html('<input type="button" onclick="addPayment();" value="Работа оплачена" />');
}

function count(){
    $("#given").val($("#multiplier").val() * iCurrPrice);
    if ($("#multiplier").val() == 0 || $("#multiplier").val() == "")
        $("#given").val(iCurrPrice);
}

function changePrice() {
    iCurrPrice = $("#given").val();
}

function addPayment() {
//    regexp_fio = /^\s*[a-zа-яё]+\s[a-zа-яё]+\s*[a-zа-яё]*\s*$/i;
    if ($("#fio").val() != 0) {
        if ($("#type").val() != 0 && $("#category option:selected").val() != 0 && $("#item option:selected").val() != 0) {
            regexp_amount = /^[1-9][0-9]*$/;
            if (regexp_amount.test($("[name=amount]").val())) {
                if (regexp_amount.test($("[name=price]").val())) {
                    $.post("ajax/addPayment.php", $("#fAddPayment").serialize(),
                        function (data) {
                            alert(data);
                        });
                }
                else
                    alert("Ошибка! \r\n>> Введите цену");    
            }
            else
                alert("Ошибка! \r\n>> Введите количество");
        }
        else
            alert("Ошибка! \r\n>> Выберите Вид-Категорию-Изделие");
    }
    else
        alert("Ошибка! \r\n>> Выберите мастера");
}
