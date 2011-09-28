var iCurrPrice;
var iPaymentCount = 0;
var iMaterialCount = 0;

function ShowPhone(m_id) {
    $('#phone_info').html(m_id);
    $.post('ajax/getPhone.php', { m_id : m_id },
        function (data) {
            $('#phone_info').html('Телефон:<div style="float:right;">' + data + '</div>');
        });
}

function getCategories() {
    $.post('ajax/getCategories.php', { iType : $('#type option:selected').val() },
        function (data) {
            $('#category').html(data);
        });
    $('#item').html('');
    $('#amount').html('');
    $('#price').html('');
    $('#comment').html('');
}

function getItems() {
    $.post('ajax/getItems.php', { iCategory : $('#category option:selected').val() },
        function (data) {
            $('#item').html(data);
        });
    $('#amount').html('');
    $('#price').html('');
    $('#comment').html('');
}

function getAmount() {
    $('#amount').html('Количество: <input type="text" name="amount" id="multiplier" onkeyup="count()" value="1"/>');
    $.post('ajax/getPrice.php', { iItem : $('#item option:selected').val() },
        function (data) {
            $('#price').html(data);
            iCurrPrice = $('#given').val();
        });
    $('#comment').html('Ваш комментарий: <input type="text" name="comment" />');
    $('#roll_button').html('<input type="button" onclick="validPayment();" value="Добавить платеж" />');
}

function count(){
    $('#given').val($('#multiplier').val() * iCurrPrice);
    if ($('#multiplier').val() == 0 || $('#multiplier').val() == '')
        $('#given').val(iCurrPrice);
}

function changePrice() {
    iCurrPrice = $('#given').val();
}

function validPayment()
{
    if ($('#fio').val() != 0) {
        if ($('#type').val() != 0 && $('#category option:selected').val() != 0 && $('#item option:selected').val() != 0) {
            regexp_amount = /^[1-9][0-9]*$/;
            if (regexp_amount.test($('[name=amount]').val())) {
                if (regexp_amount.test($('[name=price]').val())) {
                    rollPayment();
                }
                else
                    showMessage('Введите цену', 'err');    
            }
            else
                showMessage('Введите количество', 'err');
        }
        else
            showMessage('Выберите Вид-Категорию-Изделие', 'err');
    }
    else
        showMessage('Выберите мастера', 'err');
}

function rollPayment()
{
// генерация json кода
    jsonPayment =   '{"fio":' + $('#fio').val() + ',';
    jsonPayment +=  '"type":' + $('#type option:selected').val() + ',';
    jsonPayment +=  '"category":' + $('#category option:selected').val() + ',';
    jsonPayment +=  '"item":' + $('#item option:selected').val() + ',';
    jsonPayment +=  '"price":' + $('[name=price]').val() + ',';
    jsonPayment +=  '"amount":' + $('[name=amount]').val() + ',';
    jsonPayment +=  '"comment":"' + $('[name=comment]').val() + '"}';
// генерация текстового хэндла
    sPayment =  'Мастер: ' + $('#fio option:selected').html() + '<br />';
    sPayment +=  'К-В-И: ' + $('#type option:selected').html() + ' - ';
    sPayment += $('#category option:selected').html() + ' - ';
    sPayment += $('#item option:selected').html() + '<br />';
    sPayment += 'Цена: ' + $('[name=price]').val() + '<br />';
    sPayment += 'Количество: ' + $('[name=amount]').val() + '<br />';
    sPayment += 'Комментарий: ' + $('[name=comment]').val();
// добавление платежа в колонку платежей    
    iPaymentCount++;
    if ($('#added_payments').html() == '')
        $('#added_payments').html('<b>Добавленные платежи:</b><br />');
    $('#added_payments').html($('#added_payments').html() + '<div id="payment' + iPaymentCount +
        '" class="payment"><div class="delete" onclick="delPayment(' + iPaymentCount + ');return false;">X</div>' + sPayment +
        '<input type="hidden" name="payment' + iPaymentCount + '" value=\'' + jsonPayment +'\' /></div>');    
    $('#type option:first').attr('selected','1');
    $('#category').html(''); $('#item').html(''); $('#amount').html(''); $('#price').html(''); 
    $('#add_button').html(''); $('#comment').html('');
    $('#add_button').html('<input type="button" onclick="addPayment();" value="Оплатить" />');
}

function delPayment(paymentNum) {
    $('div#payment' + paymentNum).remove();
    showMessage('Платеж удален', 'info');
    if ($('#added_payments').html() == '<b>Добавленные платежи:</b><br>') {
        $('#added_payments').html('');
        $('#add_button').html('');
    }
}

function addPayment() {
    $('#added_payments').append('<input type="hidden" name="iPaymentCount" value="' + iPaymentCount + '" />');
    $.post('ajax/addPayment.php', $('#fAddPayment').serialize(),
        function (data) {
            showMessage(data, 'info');
            $('#added_payments').html('');
            $('#add_button').html('');
            iPaymentCount = 0;
        });
}

function rollMaterial()
{
// генерация json кода
    jsonMaterial =   '{"fio":' + $('#fio').val() + ',';
    jsonMaterial +=  '"material_id":' + $('#material option:selected').val() + ',';
    jsonMaterial +=  '"amount":' + $('#material_amount').val() + '}';
// генерация текстового хэндла
    sMaterial =  'Мастер: ' + $('#fio option:selected').text() + '<br />';
    sMaterial += 'Наименование: ' + $('#material option:selected').text();
    sMaterial += 'Количество: ' + $('#material_amount').val() + '<br />';
// добавление платежа в колонку платежей    
    iMaterialCount++;
    if ($('#added_payments').html() == '')
        $('#added_payments').html('<b>Выданные заготовки:</b><br />');
    $('#added_payments').html($('#added_payments').html() + '<div id="payment' + iMaterialCount +
        '" class="payment"><div class="delete" onclick="delPayment(' + iMaterialCount + ');return false;">X</div>' + sMaterial +
        '<input type="hidden" name="payment' + iMaterialCount + '" value=\'' + jsonMaterial +'\' /></div>');    
    $('#type option:first').attr('selected','1');
    $('#category').html(''); $('#item').html(''); $('#amount').html(''); $('#price').html(''); 
    $('#add_button').html(''); $('#comment').html('');
    $('#add_button').html('<input type="button" onclick="addPayment();" value="Оплатить" />');
}

function MaterialAdd() {
    $('#added_materials').append('<input type="hidden" name="iMaterialCount" value="' + iMaterialCount + '" />');
    $.post('ajax/addMaterial.php', $('#fAddMaterial').serialize(),
        function (data) {
            showMessage(data, 'info');
            $('#added_materials').html('');
            $('#add_mbutton').html('');
            iMaterialCount = 0;
        });
}