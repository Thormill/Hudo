function Import(){
  $.post("ajax/Import.php", null,
    function (data) {
      alert(data);
    });
}

function Export(){
  $.post("ajax/Export.php", $("#fExport").serialize(),
    function (data) {
    });
  var url='/files/export.xlsx'; 
  window.open(url,'Download');
}

