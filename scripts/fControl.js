function ItemAdd() {
	$.post('ajax/addItem.php', { Type : $('#atype').val(), Category : $('#acategory').val(),
	 Item : $('#aitem').val(), Price : $('#aprice').val() },
    function (data) {
       alert(data);
    });
}

function ShowPhone() {  //взял из fAddPayment.js. придумать как переделать по принципу DRY
    var m_id = $('#MasterList option:selected').val();
    $.post('ajax/getPhone.php', { m_id : m_id },
        function (data) {
            $('#phone').val(data);
        });
}

function MasterSelect(fio) {
    $('#fio').val(fio);
    $('#masterstatus').html('Изменить мастера ' + fio);
    $('#mbutton').val('изменить');
	ShowPhone();
}

function MasterClear() {
    $('#masterlist option').attr('selected', false);
    $('#masterstatus').html('Добавить мастера');
    $('#mbutton').val('добавить');    
}

function addMaster() {
    regexp_fio = /^\s*[A-zА-я]+\s[A-zА-я]+\s*[A-zА-я]*\s*$/i;
    if (regexp_fio.test($('#fio').val())) {
        regexp_phone = /^[1-9][0-9]{2}-[0-9]{4,7}$/;
        if (regexp_phone.test($('#phone').val())) {
            $.post('ajax/MasterControl.php', $('#MasterControl').serialize(),
                function (data) {
                    showMessage(data);
                });
        }
        else
            showMessage("Введите телефонв формате XXX-XXXX (городской) <br /> или XXX-XXXXXXX (мобильный)", 'err');
    }
    else
        showMessage("Введите адекватное имя мастера", 'err');
}
