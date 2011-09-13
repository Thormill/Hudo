function startSearch() {
    $("#content").html('<img src="img/search.gif" alt="идет поиск...">')
    $.post("ajax/searchPayment.php", $("#fSearch").serialize(),
        function (data) {
            $("#content").html('<p>Результаты поиска:</p>' + data + '<br />');
    });
    $("#content").html("");
}

function pickDate() {
    if ($("#s_date").val() == 3) {
        $("#p_datepicker").html('<input type="text" id="datepicker" name="datepicker" />')

        $(function() {
            var dates = $( "#datepicker" ).datepicker({
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
        });
    } else
        $("#p_datepicker").html('');
};
