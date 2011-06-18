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

var urlJson = "modules/condo/bin/bill.json.php";

 
$(document).ready(function(){
    openTable();
});

function getDatajson (jsonFile, callBack){
    try {
        $.getJSON(jsonFile, eval(callBack));
    } catch (e) { 
        alert(e);
    } 
}

function openTable(){
    getDatajson(urlJson+"?action=open", handlerOpenTable);
}

function handlerOpenTable(data){
    if (data.result != "error"){
        $.each(data.result, function(i, field){
            alert (field.id_expenses);
        });
    }else{
        alert("Error lejendo la base de datos");
    }
}

