function Import(){
  $.post("forms/ajax/Import.php", $("#fImport").serialize(),
    function (data) {
      alert(data);
    });
}

function Export(){
  $.post("forms/ajax/Export.php", $("#fExport").serialize(),
    function (data) {
      alert(data);
    });
}

