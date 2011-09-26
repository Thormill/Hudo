function TypeClick() {
    $('#atype').val( $('#mType option:selected').text() );
    $.post('ajax/loadCategories.php', { t_id : $('#mType option:selected').val()},
    function (data) {
       $('#mCategory').html(data);
    });
    $('#ibutton').val('изменить');
}

function CategoryClick() {
    $('#acategory').val( $('#mCategory option:selected').text() );
    $.post('ajax/loadItems.php', { c_id : $('#mCategory option:selected').val()},
    function (data) {
       $('#mItem').html(data);
    });
}

function ItemClick() {
    $('#aitem').val( $('#mItem option:selected').text() );
    $.post('ajax/loadPrice.php', { item_id : $('#mItem option:selected').val()},
    function (data) {
       $('#aprice').val(data);
    });
}

function ItemsClear() {
    $('#mType option').attr('selected', false);
    $('#mCategory option').attr('selected', false);
    $('#mItem option').attr('selected', false);
    $('#ibutton').val('добавить');    
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
    $('#mbutton').val('изменить');
	ShowPhone();
}

function MasterClear() {
    $('#masterlist option').attr('selected', false);
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

function ItemAdd() {
	$.post('ajax/ItemControl.php', $('#ItemControl').serialize(),
    function (data) {
       alert(data);
    });
}
