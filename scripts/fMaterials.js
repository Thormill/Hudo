function MaterialClick(material) {
    $.post('ajax/MaterialCheck.php', { id : $(material).val()},
    function (data) {
       alert(data);
    });
}
