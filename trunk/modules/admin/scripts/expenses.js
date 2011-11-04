//
//
// CFY program = CFY Business Management Suite
//
// Integrated enterprise applications to execute and optimize business and IT strategies.
// Enable you to perform essential, industry-specific, and business-support processes with modular solutions.
//
// Version: 0.0.0.1a
// Author: Ernesto La Fontaine
// Mail: mail@pajarraco.com
// License: New BSD License (see docs/license.txt)
// Redistributions of files must retain the copyright notice.
//
// File:
// Commnents:

var speed = 200; // effect speed 0,2 min
var styleChooser = false; // variable for change color on table row
var urlJson = "modules/admin/bin/expenses.json.php"; // url for the json php file
var edit_id = 0;
 
$(document).ready(function(){
    showmsg("Espere un momento por favor..."); // msg bos for client
    openTable(); // function to get data
});

// ajax call, return json
function getDatajson (jsonFile, callBack){
    try {
        $.getJSON(jsonFile, eval(callBack));
    } catch (e) { 
        alert(e);
    } 
}

function setBottonEvent(){
    // event for new data
    $("#newbotton").unbind();
    $("#newbotton").bind("click", function(){
        edit_id = 0;
        $("#newbotton").slideUp(speed, function(){// hide new botton
            $("feditor").slideDown(speed);// show editor panel
        });
    });

    // function for cancel edit
    $("#cancelbotton").unbind();
    $("#cancelbotton").bind("click", function(){
        $("feditor").slideUp(speed, function(){ // hide editor panel
            $("#botton-edit-"+edit_id).slideDown(speed); // show editor bottons
            $("#newbotton").slideDown(speed);// show new botton
        });
    });

    // function for save edit
    $("#savebotton").unbind();
    $("#savebotton").bind("click", function(){
        showmsg("Su data se esta actualizando.<br /><br />Espere un momento por favor....");
        var newcode = $("#code").val();
        var newname = $("#name").val();
        var newdescription = $("#description").val();
        var newtype = $("#type").val();
        var newamount = $("#amount").val();

        // edit function
        editCall(edit_id, newcode, newname, newdescription, newtype, newamount);

        // clean off the form
        $("#code").attr("value", "");
        $("#name").attr("value", "");
        $("#description").attr("value", "");
        $("#type").attr("value", "");
        $("#amount").attr("value", "");
        
        $("feditor").slideUp(speed); // close editor panel
        $("#newbotton").slideDown(speed); // show new botton
    
    });
}

// function to get data
function openTable(){
    getDatajson(urlJson+"?action=open", handlerOpenTable);
    setBottonEvent();
}

// get data from xml and put it in on local var
function handlerOpenTable(data){
    // empty table row for new data
    $("#trow").empty();

    // initilize the var for color rows
    styleChooser = false;

    // get xml data to local variables
    if (data.result != "error"){
        var totalRow = data.totalRows;
        if (totalRow > 0){            
            $.each(data.result, function(i, field){
                var id = field.id_expenses;
                var code = field.code;
                var name = field.name;
                var description = field.description;
                var type = field.type;
                var amount = field.amount;
                var creation_date = field.creation_date;

                // function to append data to page
                appendOpenTable(id, code, name, description, type, amount, creation_date);
            });
        }

        // show total and add new botton
        $("ftotal span").empty();
        $("ftotal span").html("Se encontraron " + totalRow + " registros");
    
        // hide msg box when data load is finish
        hidemsg();
    }
}

// put data on table
function appendOpenTable(id, code, name, description, type, amount, creation_date ){

    // select color for row
    styleChooser = !styleChooser;
    var a = "";
    if(styleChooser) a = "1"; else a = "2";

    // create a row on fill with data
    $("<tr>").attr("id", "item-"+id).addClass("row"+a).appendTo("#trow");
    $("<td>").attr("id", "code-"+id).html(code).appendTo("#item-"+id);
    $("<td>").attr("id", "name-"+id).html(name).appendTo("#item-"+id);
    $("<td>").attr("id", "description-"+id).html(description).appendTo("#item-"+id);
    $("<td>").attr("id", "type-"+id).html(type).appendTo("#item-"+id);
    $("<td>").attr("id", "amount-"+id).html(amount).appendTo("#item-"+id);
    $("<td>").attr("id", "creation_date-"+id).html(creation_date).appendTo("#item-"+id);

    // create editor bottons on table
    $("<td>").attr("id", "editor-"+id).addClass("editor").appendTo("#item-"+id);
    $("<fbotton>").attr("id", "botton-edit-"+id).appendTo("#editor-"+id);
    $("<a>").attr("id", "deletebotton-"+ id).attr("title","Borrar").addClass("deletebotton").appendTo("#botton-edit-"+id);
    $("<a>").attr("id", "editbotton-"+ id).attr("title","Editar").addClass("editbotton").appendTo("#botton-edit-"+id);

    // event for edit
    $("#editbotton-"+id).unbind();
    $("#editbotton-"+id).bind("click", function(){
        edit_id = id;

        var editcode = $("#code-"+id).html();
        var editname = $("#name-"+id).html();
        var editdescription = $("#description-"+id).html();
        var edittype = $("#type-"+id).html();
        var editamount = $("#amount-"+id).html();
        
        $("#code").attr("value", editcode);
        $("#name").attr("value", editname);
        $("#description").attr("value", editdescription);
        $("#type").attr("value", edittype);
        $("#amount").attr("value", editamount);
        
        $("#botton-edit-"+id).slideUp(speed, function(){ // hide edit botton
            $("feditor").slideDown(speed); // show editor panel
        });
    });

    // event for delete
    $("#deletebotton-"+id).click(function(){
        if(confirm("Esta seguro que desea borra el registro " + id)){
            showmsg("Su data se esta borrando.<br /><br />Espere un momento por favor....");
            deleteCall(id); // function to delete items
        }
    });
}

// delete function
function deleteCall(id){
    // ajax call to delete item
    getDatajson(urlJson+"?action=delete&id="+id, "handlerEditCall")
}

// edit function
function editCall(id, code, name, description, type, amount){
    // ajax call to edit and insert base on action
    var action = "update";
    if (id == 0){
        action = "insert"
    }
    getDatajson(urlJson+"?action="+action+"&id="+id+"&code="+code+"&name="+name+"&description="+description+"&type="+type+"&amount="+amount, "handlerEditCall");
}

// handler result for edit and insert
function handlerEditCall(data){
    if (data.result != "error"){
        handlerOpenTable(data);
    }else{
        alert("error en edicion");
    }
}







