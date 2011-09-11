function toForm(sFormName)
{
    $.post("forms/f" + sFormName + ".php", null,
        function (data) {
            $("#form").html(data);
        });
}

function menuClick(oClicked)
{
    $(".selected").removeClass();
    oClicked.className = "selected";
    toForm(oClicked.id);
}