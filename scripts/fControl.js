var table = ''; 
var myid = 0;    //переменные для удаления

function TypeClick() {
    $('#atype').val( $('#mType option:selected').text() );
    $('#mItem option').attr('selected', false);
    $('#mItem').html('<option>--Сначала выберите категорию--</option>');
    $('#aitem').val('');
    $('#aprice').val('');
    $('#mCategory option').attr('selected', false);
    $('#acategory').val('');
    $.post('ajax/loadCategories.php', { t_id : $('#mType option:selected').val()},
    function (data) {
       $('#mCategory').html(data);
    });
    $('#ibutton').val('изменить');
    table = 'types';
    myid = $('#mType option:selected').val();
}

function CategoryClick() {
    $('#acategory').val( $('#mCategory option:selected').text() );
    $('#mItem option:first').attr('selected','1');
    $('#aitem').val('');
    $('#aprice').val('');
    $.post('ajax/loadItems.php', { c_id : $('#mCategory option:selected').val()},
    function (data) {
       $('#mItem').html(data);
    });
    
    table = 'categories';
    myid = $('#mCategory option:selected').val();  
}

function ItemClick() {
    $('#aitem').val( $('#mItem option:selected').text() );
    $.post('ajax/loadPrice.php', { item_id : $('#mItem option:selected').val()},
    function (data) {
       $('#aprice').val(data);
    });
    
    table = 'items';
    myid = $('#mItem option:selected').val();
}

function ItemsClear() {
    $('#mType option:first').attr('selected','1');
    $('#mCategory option:first').attr('selected','1');
    $('#mCategory').html('<option>----Сначала выберите тип----</option>');
    $('#mItem option:first').attr('selected','1');
    $('#mItem').html('<option>--Сначала выберите категорию--</option>');
    $('#ibutton').val('добавить');
    $('#atype').val('');
    $('#acategory').val('');
    $('#aitem').val('');
    $('#aprice').val('');
    table = '';
    myid = 0;
}

function ShowPhone() {  //взял из fAddPayment.js. придумать как переделать по принципу DRY
    var m_id = $('#MasterList option:selected').val();
    $.post('ajax/getPhone.php', { m_id : m_id },
        function (data) {
            $('#phone').val(data);
        });
}

function MasterSelect(fio) {
    $('#fio').val(fio);
    $('#mbutton').val('изменить');
	ShowPhone();
	table = 'masters';
    myid = $('#MasterList option:selected').val();
}

function MasterClear() {
    $('#masterlist option:first').attr('selected','1');
    $('#mbutton').val('добавить');
    $('#fio').val('');
    $('#phone').val('');
    table = '';
    myid = 0;    
}

function addMaster() {
    regexp_fio = /^\s*[A-zА-я]+\s[A-zА-я]+\s*[A-zА-я]*\s*$/i;
    if (regexp_fio.test($('#fio').val())) {
        regexp_phone = /^[1-9][0-9]{2}-[0-9]{4,7}$/;
        if (regexp_phone.test($('#phone').val())) {
            $.post('ajax/MasterControl.php', $('#MasterControl').serialize(),
                function (data) {
                    showMessage(data);
                    
                }).done(function() {LoadMasters();});
			MasterClear();
        }
        else
            showMessage("Введите телефонв формате XXX-XXXX (городской) <br /> или XXX-XXXXXXX (мобильный)", 'err');
    }
    else
        showMessage("Введите адекватное имя мастера", 'err');
}

function ItemAdd() {
	$.post('ajax/ItemControl.php', $('#ItemControl').serialize(),
    function (data) {
       showMessage(data);
	ItemsClear();
    }).done(function() {
	       LoadTypes();
	   });
}

function MaterialClick() {
    $('#matbutton').val('изменить');
    $('#aMaterial').val( $('#MaterialList option:selected').text() );
    table = 'materials';
    myid = $('#MaterialList option:selected').val();
}

function MaterialAdd() {
    $.post('ajax/MaterialControl.php', $('#MaterialControl').serialize(),
    function (data) {
       showMessage(data);
    }).done(function() {LoadMaterials();});
	MaterialClear();
}

function MaterialClear() {
    $('#MaterialList option:first').attr('selected','1');
    $('#matbutton').val('добавить');
    $('#aMaterial').val('');
    table = '';
    myid = 0;    
}

function Delete() {
    $.post('ajax/DataDelete.php', {table : table, myid : myid},
    function (data) {
       showMessage(data);
    }).done(function() {
	    switch (table) {
            case 'masters': LoadMasters(); MasterClear(); break;
            case 'types': LoadTypes(); ItemsClear(); break;
	        case 'materials':  LoadMaterials(); MaterialClear(); break;
		    default: ItemsClear(); break;
	   }});
}

function LoadMasters() {
$.post('ajax/loadMasters.php', null,
    function (data) {
        $('#MasterList').html(data);
	});
}

function LoadTypes() {
$.post('ajax/loadTypes.php', null,
    function (data) {
        $('#mType').html(data);
	});
}

function LoadMaterials() {
$.post('ajax/loadMaterials.php', null,
    function (data) {
		$('#MaterialList').html(data);
	});
}

$(document).ready(function() {
	LoadTypes();
    LoadMasters();
    LoadMaterials();
});
