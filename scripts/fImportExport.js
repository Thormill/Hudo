function Import(){
  $.post("forms/ajax/Import.php", null,
    function (data) {
      alert(data);
    });
}

function Export(){
  $.post("forms/ajax/Export.php", null,
    function (data) {
      alert(data);
    });
}

