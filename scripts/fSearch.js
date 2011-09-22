function startSearch() {
//    $("#content").html('<img src="img/search.gif" alt="идет поиск...">')
    $.post("ajax/searchPayment.php", $("#fSearch").serialize(),
        function (data) {
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();
            $("#mask").css({'width':maskWidth,'height':maskHeight});
            $("#mask").fadeTo("slow",0.9);
            $("#mask").fadeIn(500);    
            
            $("#modal-content").html('<p>Результаты поиска:</p>' + data + '<br />');

            var winH = $(window).height();
            var winW = $(window).width();  
            $("#modal").css('top',  winH/2-$("#modal").height()/2);
            $("#modal").css('left', winW/2-$("#modal").width()/2);
     
            $("#modal").fadeIn(1000);
        });
//    $("#content").html("");
}

$("#close").click(function (e) {
        e.preventDefault();
        $('#mask, #modal').hide();
    });

$("#mask").click(function () {
        $(this).hide();
        $("#modal").hide();
    });  

function pickDate() {
    if ($("#s_date").val() == 5) {
        $("#p_datepicker").html('<input type="text" id="datepicker" name="datepicker" />')
// инициализация datepicker'a
        $("#datepicker").datepicker();
// вставка подсказки
        $("#datepicker").val('нажмите');
    } else
        $("#p_datepicker").html('');
};
