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

var speed = 200;

$(document).ready(function(){
    showmsg("Espere un momento por favor...");
    getXML("modules/booking/bin/destination_xml.php?action=search", "appendResult");
});

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
    
function appendResult(xml){
    $("fcontainer").empty();
    var totalRow = $(xml).find("total").text();
    if (totalRow > 0){
        $(xml).find("result").each(function(){
            var id = $(this).find("id").text();
            var name = $(this).find("name").text();

            $("<fitem>").attr("id", "item-"+id).appendTo("fcontainer");
            $("<flabel>").attr("id", "label-"+id).html(name).appendTo("#item-"+id);
            $("<a>").attr("id", "deletebotton-"+ id).attr("title","Borrar").addClass("deletebotton").appendTo("#label-"+id);
            $("<a>").attr("id", "editbotton-"+ id).attr("title","Editar").addClass("editbotton").appendTo("#label-"+id);
            $("<ffield>").attr("id", "field-"+id).css("display", "none").appendTo("#item-"+id);
            $("<input>").attr("type", "text").attr("id", "name-"+id).attr("value", name).appendTo("#field-"+id);
            $("<a>").attr("id", "cancelbotton-"+id).attr("title","Cancelar").addClass("cancelbotton").appendTo("#field-"+id);
            $("<a>").attr("id", "savebotton-"+id).attr("title","Guardar").addClass("savebotton").appendTo("#field-"+id);
            $("#editbotton-"+id).click(function(){
                $("#label-"+id).slideUp(speed, function(){
                    $("#field-"+id).slideDown(speed);
                });
            });
            $("#deletebotton-"+id).click(function(){
                if(confirm("Esta seguro que desea borra el registro " + id)){
                    showmsg("Su data se esta borrando.<br /><br />Espere un momento por favor....");
                    deleteCall(id);
                    $("#item-"+id).slideUp(speed, function(){
                        $("#item-"+id).remove();
                    });
                }
            });
            $("#savebotton-"+id).click(function(){
                showmsg("Su data se esta actualizando.<br /><br />Espere un momento por favor....");
                var newname = $("#name-"+id).val();
                editCall(id, newname);
            });
            $("#cancelbotton-"+id).click(function(){
                $("#field-"+id).slideUp(speed, function(){
                    $("#label-"+id).slideDown(speed);
                });
            });
        });
    }
    $("<ftotal>").attr("id", "new").html("Se encontraron " + totalRow + " registros").appendTo("fcontainer");
    $("<a>").attr("id", "newbotton").attr("title","Nuevo").addClass("newbotton").appendTo("#new");
    $("#newbotton").click(function(){
        $("#newbotton").slideUp(speed);
        $("<fitem>").attr("id", "item-new").css("display", "none").insertBefore("#new");
        $("<ffield>").attr("id", "field-new").appendTo("#item-new");
        $("<input>").attr("type", "text").attr("id", "id-new").attr("value", "id").attr("size", "2").appendTo("#field-new");
        $("<input>").attr("type", "text").attr("id", "name-new").attr("value", "name").appendTo("#field-new");
        $("<a>").attr("id", "cancelbotton-new").attr("title","Cancelar").addClass("cancelbotton").appendTo("#field-new");
        $("<a>").attr("id", "savebotton-new").attr("title","Guardar").addClass("savebotton").appendTo("#field-new");
        $("#savebotton-new").click(function(){
            showmsg("Su data se esta actualizando.<br /><br />Espere un momento por favor....");
            var newid = $("#id-new").val();
            var newname = $("#name-new").val();
            addNewCall(newid, newname);
        });
        $("#cancelbotton-new").click(function(){
            $("#item-new").slideUp(speed, function(){
                $(this).remove();
                $("#newbotton").slideDown(speed);
            });
        });
        $("#item-new").slideDown(speed);
    });
    hidemsg();
}

function editCall(id, name){
    getXML("modules/booking/bin/destination_xml.php?action=update&id="+id+"&name="+name, "handlerEdit");
}

function addNewCall(id, name){
    getXML("modules/booking/bin/destination_xml.php?action=insert&id="+id+"&name="+name, "handlerEdit")
}

function handlerEdit(xml){
    if ($(xml).find("update-result").text()!=" error"){
        appendResult(xml);
    }else{
        alert("error");
    }
    hidemsg();
}

function deleteCall(id){
    getXML("modules/booking/bin/destination_xml.php?action=delete&id="+id, "handlerDelete")
}

function handlerDelete(xml){
    if ($(xml).find("update-result").text()==" error"){
        alert("error");
    }
    hidemsg();
}