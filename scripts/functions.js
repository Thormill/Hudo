function getCategories()
{
    $.post("forms/ajax/getCategories.php", { iType : $("#type option:selected").val() },
        function (data){
            $("#category").html(data);
        });
    $("#item").html("");
}

function getItems()
{
    $.post("forms/ajax/getItems.php", { iCategory : $("#category option:selected").val() },
        function (data){
            $("#item").html(data);
        });
}

/*переход по формам*/
function toForm(sFormName)
{
    $.post("forms/f"+sFormName+".php", null,
        function (data){
            $("#form").html(data);
        });
}

/*клик в меню*/
function menuClick(objClicked)
{
    $(".selected").removeClass();
    objClicked.className = "selected";
    toForm(objClicked.id);
}

function formImport()
{
    $.post("import/import.php", null,
        function (data){
            $("#imp_result").html(data);
        });
}
