function ItemAdd() {
	$.post('ajax/addItem.php', { Type : $('#atype').val(), Category : $('#acategory').val(),
	 Item : $('#aitem').val(), Price : $('#aprice').val() },
    function (data) {
       alert(data);
    });
}

function ShowPhone() {  //взято из fAddPayment.js. придумать как сделать DRY
    var m_id = $('#MasterList option:selected').val();
    $.post('ajax/getPhone.php', { m_id : m_id },
        function (data) {
            $('#phone').val(data);
        });
}

function MasterSelect(fio) {
    document.getElementById('fio').value = fio;
	ShowPhone();
}


function addMaster() {
    regexp_fio = /^\s*[a-zа-яё]+\s[a-zа-яё]+\s*[a-zа-яё]*\s*$/i;
    if (regexp_fio.test($('#fio').val())) {
        regexp_phone = /^[1-9][0-9]{2}-[0-9]{4,7}$/;
        if (regexp_phone.test($('#phone').val())) {
            $.post('ajax/MasterControl.php', $('#MasterControl').serialize(),
                function (data) {
                    showMessage(data);
                });
        }
        else
            showMessage("Введите телефон в формате ХХХ-ХХХХ (городской) <br /> или XXX-XXXXXXX (мобильный)", 'err');
    }
    else
        showMessage("Введите адекватное ФИО мастера", 'err');
}