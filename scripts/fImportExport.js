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
  var url='files/export.xlsx'; 
  window.open(url,'Download');
}

$(function() {
	var dates = $( "#from, #to" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			var option = this.id == "from" ? "minDate" : "maxDate",
			instance = $( this ).data( "datepicker" ),
			date = $.datepicker.parseDate(
			instance.settings.dateFormat ||
			$.datepicker._defaults.dateFormat,
			selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});
$("#from").text() = "trololo";
});
