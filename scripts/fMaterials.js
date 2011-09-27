function MaterialClick(material_out_id) {
    $.post('ajax/MaterialCheck.php', { id : material_out_id},
    function (data) {
       alert(data);
    });
}
