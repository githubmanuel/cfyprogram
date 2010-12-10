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

$(document).ready(function(){
    showmsg("Espere un momento por favor...");
    getXML("modules/home/bin/setting_xml.php", "appendResult"); 
});

function getXML(xmlfile, callback){
    $.ajax({
        type: "GET",
        url: xmlfile,
        dataType: "xml",
        success: eval(callback)
    });
}
    
function appendResult(xml){
    $("fcontainer").empty();
    $(xml).find("result").each(function(){
        var id = $(this).find("id").text();
        var print = $(this).find("print_name").text();
        var status = $(this).find("status").text();
        var check = "";
        var textstatus = "off";
        if (status == 0){
            check = "checked";
            textstatus = "on";
        }
        $("<fitem>").attr("id", "item-"+id).appendTo("fcontainer");
        $("<flabel>").attr("id", "label-"+id).html(print + " - " + textstatus).appendTo("#item-"+id);
        $("<a>").attr("id", "editbotton-"+ id).addClass("editbotton").appendTo("#label-"+id);
        $("<ffield>").attr("id", "field-"+id).css("display", "none").appendTo("#item-"+id);
        $("<input>").attr("type", "text").attr("id", "print-"+id).attr("value", print).appendTo("#field-"+id);
        $("<input>").attr("type", "checkbox").attr("id", "status-"+id).attr("value", status).attr("checked", check).appendTo("#field-"+id);
        $("<a>").attr("id", "cancelbotton-"+id).addClass("cancelbotton").appendTo("#field-"+id);
        $("<a>").attr("id", "savebotton-"+id).addClass("savebotton").appendTo("#field-"+id);
        $("#editbotton-"+id).click(function(){
            $("#label-"+id).hide();
            $("#field-"+id).show();
        });
        $("#savebotton-"+id).click(function(){
            showmsg("Su data se esta actualizando.<br /><br />Espere un momento por favor....");
            var newstatus = 1;
            if ($("#status-"+id).attr("checked")){
                newstatus = 0;
            }
            var newprint = $("#print-"+id).val();
            editSetting(id, newprint, newstatus);
            $("#editbotton-"+id).show();
            $("#field-"+id).hide();
        });
        $("#cancelbotton-"+id).click(function(){
            $("#label-"+id).show();
            $("#field-"+id).hide();
        });
    });
    hidemsg();
}
function editSetting(id, print, status){
    getXML("modules/home/bin/setting_update.php?id="+id+"&print="+print+"&status="+status,"handlerEditSetting");
}

function handlerEditSetting(xml){
    if ($(xml).find("update-result").text()!=" error"){
        appendResult(xml);
    }else{
        alert("error");
    }
    hidemsg();
}