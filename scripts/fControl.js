function ItemAdd() {
	$.post('ajax/addItem.php', { Type : $('#atype').val(), Category : $('#acategory').val(),
	 Item : $('#aitem').val(), Price : $('#aprice').val() },
    function (data) {
       alert(data);
    });
}

function ShowPhone() {  //����� �� fAddPayment.js. ��������� ��� ������� DRY
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
    regexp_fio = /^\s*[a-z�-��]+\s[a-z�-��]+\s*[a-z�-��]*\s*$/i;
    if (regexp_fio.test($('#fio').val())) {
        regexp_phone = /^[1-9][0-9]{2}-[0-9]{4,7}$/;
        if (regexp_phone.test($('#phone').val())) {
            $.post('ajax/MasterControl.php', $('#MasterControl').serialize(),
                function (data) {
                    showMessage(data);
                });
        }
        else
            showMessage("������� ������� � ������� ���-���� (���������) <br /> ��� XXX-XXXXXXX (���������)", 'err');
    }
    else
        showMessage("������� ���������� ��� �������", 'err');
}