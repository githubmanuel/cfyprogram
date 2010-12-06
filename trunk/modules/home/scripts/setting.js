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
    showmsg("espere un momento por favor...");
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
    $(xml).find("result").each(function(){
        var id = $(this).find("id").text();
        var name = $(this).find("name").text();
        var print = $(this).find("print").text();
        var status = $(this).find("status").text();
        $("<flabel>").html(id + ":" + print ).appendTo("fcontainer");
        var htmlInput = "<input type='text' id='" + name + "' value='"+ status +"' />";
        $("<ffield>").html(htmlInput).appendTo("fcontainer");
    });
    hidemsg();
}

