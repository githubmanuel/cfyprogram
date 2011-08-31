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
var edit_id = 0;
var urlJson = "modules/payroll/bin/employee.json.php";


$(document).ready(function(){
    showmsg("Espere un momento por favor..."); // msg bos for client
    openTable();
});

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
        
        var newname = $("#name").val();
        var newposition = $("#position").val();
        var newstarted_date = $("#started_date").val();
        var newincome = $("#income").val();
        var newperiod = $("#period").val();

        // edit function
        editCall(edit_id, newname, newposition, newstarted_date, newincome, newperiod);

        // clean off the form
        $("#name").attr("value", "");
        $("#position").attr("value", "");
        $("#started_date").attr("value", "");
        $("#income").attr("value", "");
        $("#period").attr("value", "");
        $("feditor").slideUp(speed); // close editor panel
        $("#newbotton").slideDown(speed); // show new botton
    
    });
}

function openTable(){
    getDatajson(urlJson+"?action=open", handlerOpenTable);
    setBottonEvent();
}

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
                var id = field.id_employee;
                var name = field.name;
                var position = field.position;
                var started_date = field.started_date;
                var income = field.income;
                var period = field.period;
                var creation_date = field.creation_date;

                // function to append data to page
                appendOpenTable(id, name, position, started_date, income, period, creation_date);

            });
        }
    }else{
        alert("Error lejendo la base de datos");
    }

    // show total and add new botton
    $("ftotal span").empty();
    $("ftotal span").html("Se encontraron " + totalRow + " registros");
    
    // hide msg box when data load is finish
    hidemsg();
    
    
}

// put data on table
function appendOpenTable(id, name, position, started_date, income, period, creation_date){

    // select color for row
    styleChooser = !styleChooser;
    var a = "";
    if(styleChooser) a = "1"; else a = "2";

    // create a row on fill with data
    $("<tr>").attr("id", "item-"+id).addClass("row"+a).appendTo("#trow");
    $("<td>").attr("id", "name-"+id).html(name).appendTo("#item-"+id);
    $("<td>").attr("id", "position-"+id).html(position).appendTo("#item-"+id);
    $("<td>").attr("id", "started_date-"+id).html(started_date).appendTo("#item-"+id);
    $("<td>").attr("id", "income-"+id).html(income).appendTo("#item-"+id);
    $("<td>").attr("id", "period-"+id).html(period).appendTo("#item-"+id);
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

        var editname = $("#name-"+id).html();
        var editposition = $("#position-"+id).html();
        var editstarted_date = $("#started_date-"+id).html();
        var editincome = $("#income-"+id).html();
        var editperiod = $("#period-"+id).html();
        
        $("#name").attr("value", editname);
        $("#position").attr("value", editposition);
        $("#started_date").attr("value", editstarted_date);
        $("#income").attr("value", editincome);
        $("#period").attr("value", editperiod);
        
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
function editCall(id, name, position, started_date, income, period){
    // ajax call to edit and insert base on action
    var action = "update";
    if (id == 0){
        action = "insert"
    }
    getDatajson(urlJson+"?action="+action+"&id="+id+"&name="+name+"&position="+position+"&started_date="+started_date+"&income="+income+"&period="+period, "handlerEditCall");
}

// handler result for edit and insert
function handlerEditCall(data){
    if (data.result != "error"){
        handlerOpenTable(data);
    }else{
        alert("error en edicion");
    }
}