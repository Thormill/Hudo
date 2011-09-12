function addMaster() {
    regexp_fio = /^\s*[a-zа-яё]+\s[a-zа-яё]+\s*[a-zа-яё]*\s*$/i;
    if (regexp_fio.test($("#fio").val())) {
        regexp_phone = /^[1-9][0-9]{2}-[0-9]{4,7}$/;
        if (regexp_phone.test($("#phone").val())) {
            $.post("ajax/addMaster.php", $("#fAddMaster").serialize(),
                function (data) {
                    alert(data);
                });
            }
        else
            alert("Ошибка! \r\n>> Введите телефон в формате ХХХ-ХХХХ (городской) \r\n>> или XXX-XXXXXXX (мобильный)");    
    }
    else
        alert("Ошибка! \r\n>> Введите адекватное ФИО мастера");
}
