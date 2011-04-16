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
var xml_url = "modules/condo/bin/owners_xml.php"; // url for the xml php file
var edit_id = 0;
 
$(document).ready(function(){
    showmsg("Espere un momento por favor..."); // msg bos for client
    openTable(); // function to get data
});

// ajax call, return xml
function getXML(xmlfile, callback){
    $.ajax({
        type: "GET",
        url: xmlfile,
        dataType: "xml",
        timeout: 5000,
        success: eval(callback),
        error: function(err, e){
            hidemsg();
            alert("error : " + err + " - " + e);
        }
    });
}

function setBottonEvent(){
    // event for new data
    $("#newbotton").click(function(){
        edit_id = 0;
        $("#newbotton").slideUp(speed, function(){// hide new botton
            $("feditor").slideDown(speed);// show editor panel
        });
    });

    // function for cancel edit
    $("#cancelbotton").click(function(){
        $("feditor").slideUp(speed, function(){ // hide editor panel
            $("#botton-edit-"+edit_id).slideDown(speed); // show editor bottons
            $("#newbotton").slideDown(speed);// show new botton
        });
    });

    // function for save edit
    $("#savebotton").click(function(){
        showmsg("Su data se esta actualizando.<br /><br />Espere un momento por favor....");
        var newid_doc = $("#id_doc").val();
        var newname = $("#name").val();
        var newlastname = $("#lastname").val();
        var newaddress = $("#address").val();
        var action = "update";

        if (edit_id == 0){
            action = "insert"
        }
        // edit function
        editCall(action, edit_id, newid_doc, newname, newlastname, newaddress);

        // clean off the form
        $("#id_doc").attr("value", "");
        $("#name").attr("value", "");
        $("#lastname").attr("value", "");
        $("#address").attr("value", "");
        $("feditor").slideUp(speed); // close editor panel
        $("#newbotton").slideDown(speed); // show new botton
    
    });
}

// function to get data
function openTable(){
    // ajax call, search for all data
    getXML(xml_url+"?action=open", "handlerOpenTable");
    setBottonEvent();
}

// get data from xml and put it in on local var
function handlerOpenTable(xml){
    // empty table row for new data
    $("#trow").empty();

    // initilize the var for color rows
    styleChooser = false;

    // get xml data to local variables
    var totalRow = $(xml).find("total").text();
    if (totalRow > 0){
        $(xml).find("result").each(function(){
            var id = $(this).find("id_owners").text();
            var id_doc = $(this).find("id_doc").text();
            var name = $(this).find("name").text();
            var lastname = $(this).find("lastname").text();
            var address = $(this).find("address").text();
            var creation_date = $(this).find("creation_date").text();

            // function to append data to page
            appendOpenTable(id, id_doc, name, lastname, address, creation_date);
        });
    }

    // show total and add new botton
    $("ftotal span").empty();
    $("ftotal span").html("Se encontraron " + totalRow + " registros");
    
    // hide msg box when data load is finish
    hidemsg();
}

// put data on table
function appendOpenTable(id, id_doc, name, lastname, address, creation_date ){

    // select color for row
    styleChooser = !styleChooser;
    var a = "";
    if(styleChooser) a = "1"; else a = "2";

    // create a row on fill with data
    $("<tr>").attr("id", "item-"+id).addClass("row"+a).appendTo("#trow");
    $("<td>").attr("id", "id_doc-"+id).html(id_doc).appendTo("#item-"+id);
    $("<td>").attr("id", "name-"+id).html(name).appendTo("#item-"+id);
    $("<td>").attr("id", "lastname-"+id).html(lastname).appendTo("#item-"+id);
    $("<td>").attr("id", "address-"+id).html(address).appendTo("#item-"+id);
    $("<td>").attr("id", "creation_date-"+id).html(creation_date).appendTo("#item-"+id);

    // create editor bottons on table
    $("<td>").attr("id", "editor-"+id).addClass("editor").appendTo("#item-"+id);
    $("<fbotton>").attr("id", "botton-edit-"+id).appendTo("#editor-"+id);
    $("<a>").attr("id", "deletebotton-"+ id).attr("title","Borrar").addClass("deletebotton").appendTo("#botton-edit-"+id);
    $("<a>").attr("id", "editbotton-"+ id).attr("title","Editar").addClass("editbotton").appendTo("#botton-edit-"+id);

    // event for edit
    $("#editbotton-"+id).click(function(){
        edit_id = id;
        $("#botton-edit-"+id).slideUp(speed, function(){ // hide edit botton
            $("feditor").slideDown(speed); // show editor panel
        });
        // TODO: Edit function -  pass variable
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
    getXML(xml_url+"?action=delete&id="+id, "handlerEditCall")
}

// edit function
function editCall(action, id, id_doc, name, lastname, address ){
    // ajax call to edit and insert base on action
    getXML(xml_url+"?action="+action+"&id="+id+"&id_doc="+id_doc+"&name="+name+"&lastname="+lastname+"&address="+address, "handlerEditCall");
}

// handler result for edit and insert
function handlerEditCall(xml){
    if ($(xml).find("search-results").text()!=" error"){
        handlerOpenTable(xml);
    }else{
        alert("error");
    }
}







