function showMessage(sHtml, sType) {
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    $("#mask").css({'width':maskWidth,'height':maskHeight});
    $("#mask").fadeTo("slow",0.9);
    $("#mask").fadeIn(250);    
            
    if (sType == "err")
        sHtml = '<img src="img/err.png" alt="ошибка...">' + sHtml;
    $("#modal-content").html(sHtml);

    var winH = $(window).height();
    var winW = $(window).width();  
    $("#modal").css('top',  winH/2-$("#modal").height()/2);
    $("#modal").css('left', winW/2-$("#modal").width()/2);
     
    $("#modal").fadeIn(250);
}

function toForm(sFormName) {
    $.post("forms/f" + sFormName + ".php", null,
        function (data) {
            $("#form").html(data);
            $("#content").html("");
        });
}

function menuClick(oClicked) {
    $(".selected").removeClass();
    oClicked.className = "selected";
    toForm(oClicked.id);
}
