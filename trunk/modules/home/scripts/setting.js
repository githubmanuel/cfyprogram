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
        var name = $(this).find("name").text();
        var print = $(this).find("print_name").text();
        var status = $(this).find("status").text();
        var check = "";
        var textstatus = "off";
        if (status == 0){
            check = "checked='checked'";
            textstatus = "on";
        }
        $("<flabel>").attr("id", "label-"+id).html(print + " - " + textstatus).appendTo("fcontainer");
        $("<a>").attr("id", "editbotton-"+ id).addClass("editbotton").appendTo("#label-"+id);
        var htmlInput = "<input type='text' id='print-" + id + "' value='" + print + "' />" +
        "<input type='checkbox' id='status-" + id + "' value='" + status + "' "+ check +" />";
        $("<ffield>").attr("id", "field-"+id).html(htmlInput).css("display", "none").appendTo("fcontainer");
        $("<a>").attr("id", "cancelbotton-"+id).addClass("cancelbotton").appendTo("#field-"+id);
        $("<a>").attr("id", "savebotton-"+id).addClass("savebotton").appendTo("#field-"+id);
        $("#editbotton-"+id).click(function(){
            $("#editbotton-"+id).hide();
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
            $("#editbotton-"+id).show();
            $("#field-"+id).hide();
        });
    });
    hidemsg();
}
function editSetting(id, print, status){
    getXML("modules/home/bin/setting_update.php?id="+id+"&print="+print+"&status="+status,"handlereditSetting")
}

function handlereditSetting(xml){
    if ($(xml).find("result").text()==" 1"){
        getXML("modules/home/bin/setting_xml.php", "appendResult");
    }else{
        alert("error");
    }
    hidemsg();
}