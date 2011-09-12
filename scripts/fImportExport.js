function Import(){
  $.post("ajax/Import.php", null,
    function (data) {
      alert(data);
    });
}

function Export(){
  $.post("ajax/Export.php", null,
    function (data) {
      alert(data);
    });
}

