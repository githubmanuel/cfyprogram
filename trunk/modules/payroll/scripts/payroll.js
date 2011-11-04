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
var urlJson = "modules/payroll/bin/payroll.json.php"; // url for the json php file
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
        $("#employee_name").jCombo(urlJson+"?action=getdata&jsondata=employee");
        $("#assignment_name").jCombo(urlJson+"?action=getdata&jsondata=assignment");
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
        //showmsg("Su data se esta actualizando.<br /><br />Espere un momento por favor....");
        
        var newemployee = $("#employee_name").val();
        var newassignment = $("#assignment_name").val();
        
        //alert (newemployee + " - " + newassignment);
        // 
        // edit function
        editCall(edit_id, newemployee, newassignment);

        // clean off the form
        $("#employee_name").jCombo(urlJson+"?action=getdata&jsondata=employee");
        $("#assignment_name").jCombo(urlJson+"?action=getdata&jsondata=assignment");
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
                var id = field.id_payroll;
                var employee = field.employee;
                var position = field.position;
                var income = parseFloat(field.income);
                var period = field.period;
                var assignment = field.assignment;
                var assignment_amount = parseFloat(field.assignment_amount);
                var assignment_type = field.assignment_type;
                var assignment_period = field.assignment_period;
                
                var amount = 0;
                var valor_period = 0;
                var valor_assignment_period = 0;

                switch (period) {
                    case "Semanal":
                        valor_period = 7;
                        break;
                    case "Quincenal":
                        valor_period = 15;
                        break;
                    case "Mensual":
                        valor_period = 30;
                        break; 
                    case "Anual":
                        valor_period = 365;
                        break;
                    default:
                        alert("Error en Periodo");
                        break;
                }
                switch (assignment_period) {
                    case "Semanal":
                        valor_assignment_period  = 7;
                        break;
                    case "Quincenal":
                        valor_assignment_period  = 15;
                        break;
                    case "Mensual":
                        valor_assignment_period  = 30;
                        break; 
                    case "Anual":
                        valor_assignment_period  = 365;
                        break;
                    default:
                        alert("Error en Periodo de Asignacion");
                        break;
                }
                
                switch(assignment_type)
                {
                    case "Dias":
                        amount = Math.round((((income/valor_period)*assignment_amount)/valor_assignment_period)*100)/100;
                         
                        break;
                    case "Monto":
                        amount = income + assignment_amount;
                        
                        break;
                    case "Porcentaje":
                        amount = ((income * assignment_amount)/100)+income;
                        
                        break;
                    default:
                        alert("Error en Assignacion");
                }

                // function to append data to page
                appendOpenTable(id, employee, position, income, assignment, amount);

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
function appendOpenTable(id, employee, position, income, assignment, amount){

    // select color for row
    styleChooser = !styleChooser;
    var a = "";
    if(styleChooser) a = "1"; else a = "2";

    // create a row on fill with data
    $("<tr>").attr("id", "item-"+id).addClass("row"+a).appendTo("#trow");
    $("<td>").attr("id", "employee-"+id).html(employee).appendTo("#item-"+id);
    $("<td>").attr("id", "position-"+id).html(position).appendTo("#item-"+id);
    $("<td>").attr("id", "income-"+id).html(income).appendTo("#item-"+id);
    $("<td>").attr("id", "assignment-"+id).html(assignment).appendTo("#item-"+id);
    $("<td>").attr("id", "amount-"+id).css("text-align", "right").html(amount).appendTo("#item-"+id);

    // create editor bottons on table
    $("<td>").attr("id", "editor-"+id).addClass("editor").appendTo("#item-"+id);
    $("<fbotton>").attr("id", "botton-edit-"+id).appendTo("#editor-"+id);
    $("<a>").attr("id", "deletebotton-"+ id).attr("title","Borrar").addClass("deletebotton").appendTo("#botton-edit-"+id);
    $("<a>").attr("id", "editbotton-"+ id).attr("title","Editar").addClass("editbotton").appendTo("#botton-edit-"+id);

    // event for edit
    $("#editbotton-"+id).unbind();
    $("#editbotton-"+id).bind("click", function(){
        showmsg("Espere un momento por favor...");
        edit_id = id;

        var editid = id;
        var editemployee = $("#employee-"+id).html();
        var editassignment = $("#assignment-"+id).html();
        $("#id").attr("value", editid);
        $("#employee_name").jCombo(urlJson+"?action=getdata&jsondata=employee", {
            selected_name: editemployee
        });
        $("#assignment_name").jCombo(urlJson+"?action=getdata&jsondata=assignment", {
            selected_name: editassignment
        });        
        $("#botton-edit-"+id).slideUp(speed, function(){ // hide edit botton
            $("feditor").slideDown(speed); // show editor panel
        });
        hidemsg();
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
function editCall(id, employee, assignment){
    // ajax call to edit and insert base on action
    var action = "update";
    if (id == 0){
        action = "insert"
    }
    //alert (urlJson+"?action="+action+"&id="+id+"&employee="+employee+"&assignment="+assignment);
    getDatajson(urlJson+"?action="+action+"&id="+id+"&employee="+employee+"&assignment="+assignment, "handlerEditCall");
}

// handler result for edit and insert
function handlerEditCall(data){
    if (data.result != "error"){
        handlerOpenTable(data);
    }else{
        alert("error en edicion");
    }
}