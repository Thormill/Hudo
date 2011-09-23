var iCurrPrice

function ShowPhone(mId) {
    $("#phone").html(mId);
    $.post("ajax/getPhone.php",{ mId : mId },
        function (data) {
            $("#phone").html(data);
        });
}

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
    $("#amount").html('Количество: <input type="text" name="amount" id="multiplier" onkeyup="count()" value="1" />');
    $.post("ajax/getPrice.php", { iItem : $("#item option:selected").val() },
        function (data) {
            $("#price").html(data);
            iCurrPrice = $("#given").val();
        });
    $("#addcomment").html('Ваш комментарий: <input type="text" name="comment_text" />');
    $("#addbutton").html('<input type="button" onclick="addPayment();" value="Работа оплачена" />');
    $("#addmore").html('<input type="button" onClick="addMore();" value="Добавить изделие" />');
}

function count(){
    $("#given").val($("#multiplier").val() * iCurrPrice);
    if ($("#multiplier").val() == 0 || $("#multiplier").val() == "")
        $("#given").val(iCurrPrice);
}

function changePrice() {
    iCurrPrice = $("#given").val();
}

function createForm() {
	var dynId = 1;
	var form = $('<div>', {
		id: "dynform" + dynId,
		class: 'fAdd'
	});

	$('#left').append(form);
	$('#dynform' + dynId).html('trololo');
	dynId++;
}

function ToggleMain() {
      $("#main_headline").slideToggle("slow", function(){});
      $("#main_form").slideToggle("slow", function(){});
}

function addMore() {
    $("#main_form").slideToggle("slow", function () {
      $("#main_headline").slideToggle("slow", function(){});
      var div_text = $("#multiplier").val() + ": " + $("#type option:selected").text() + 
          " / " + $("#category option:selected").text() + " / " + $("#item option:selected").text();
      $("#main_headline").html(div_text + '<input type="button" onclick="ToggleMain();" value="edit"></input>');
      createForm();
    });
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
                            showMessage(data, "info");
                        });
                }
                else
                    showMessage("<br />Введите цену", "err");    
            }
            else
                showMessage("<br />Введите количество", "err");
        }
        else
            showMessage("<br />Выберите Вид-Категорию-Изделие", "err");
    }
    else
        showMessage("<br />Выберите мастера", "err");
}
