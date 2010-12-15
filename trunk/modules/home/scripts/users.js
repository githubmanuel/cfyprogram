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
// Commnents: TODO: change to jquery and eliminate prototype
//
// some modification on the original files
//
// -- Original --
/* 
 * Code below initializes any variables that are specific to IE or other browsers
 */
if (window.ActiveXObject) { //Internet Explorer
    //use for DOM setAttribute for assigning a CSS class to an element
    var classLiteral = "className";
} else { //other (e.g. Firefox)
    var classLiteral = "class";
}

/*
 * We're going to store the XML representation of the product list globally
 * for use in the add to cart functionality
 */
var productListXml = "";

/*
 * Use this to paint alternate rows in tables
 */
var styleChooser = true;

/*
 * This section initializes event handlers for various element of the HTML page
 * and anything else that needs done when the page is loaded.
 */
window.onload = function () 
{

    userSearch("all");

    //handler for submitting the search form
    document.getElementsByName("searchform")[0].onsubmit = function ()
    {
        return userSearch(document.getElementsByName("searchinp")[0].value);
    }

    document.getElementById("msgdiv").onclick = function(evt)
    {
        showMsg("");
    }

}

function showMsg(msg)
{
    document.getElementById("msgdiv").innerHTML = msg;
	 	
    if(msg.length==0)
    {
        document.getElementById("msgdiv").style.display = "none";
    }
    else
    {
		
        document.getElementById("msgdiv").style.display = "inline";
    }
	
    Effect.Pulsate("msgdiv");

}

function userSearch(input)
{
    //clear the message pane
    showMsg("");
    if (input=="all"){
        document.getElementById("searchmsgspan").innerHTML="Opening...";
    }else{
        document.getElementById("searchmsgspan").innerHTML="Searching...";
    }
    Effect.Pulsate("searchmsgspan"); //scriptaculous feature requires effects.js

    makeHttpRequest("modules/home/bin/users_xml.php?sinput=" + input, "handleSearchResults", "true");
    //prevents the browser from trying to submit the form
    return false;
}

function handleSearchResults(results)
{	
    //UNCOMMENT BELOW FOR FADE APPEAR EFFECT TO WORK (also need to uncomment the Effect.Appear line later in this function
    document.getElementById("tablediv").style.display = "none"; //scriptaculous feature
	
    //clear the message pane
    showMsg("");

    //reset variable for style
    styleChooser = true;
	
    //assign the results to our global variable
    productListXml = results;

    //clear the existing results if any
    var resultstable = document.getElementById("resultstable");
    //clear the existing node
    clearANode(resultstable);
			
    //get the results that were returned
    var total = results.getElementsByTagName("result").length; // the number of results
	
    for(i=0; i < total; i++)
    {
        var currentResult = results.getElementsByTagName("result").item(i);
        var username = currentResult.getElementsByTagName("username").item(0).firstChild.nodeValue;
        var password = currentResult.getElementsByTagName("password").item(0).firstChild.nodeValue;
        var level = currentResult.getElementsByTagName("level").item(0).firstChild.nodeValue;
        var creation_date = currentResult.getElementsByTagName("creation_date").item(0).firstChild.nodeValue;
        var status = currentResult.getElementsByTagName("status").item(0).firstChild.nodeValue;
		
        //for each result append to the table
        appendSearchResult(username, password, level, creation_date, status, resultstable);
    }

    //expose the search results section
	
    //if(total > 0) document.getElementById("tablediv").style.display = "inline";
    //else document.getElementById("tablediv").style.display = "none";
    //IF YOU UNCOMMENTED THE line at the top of this function to do the "FADE APPEAR EFFECT," then comment out the line above and uncomment the line below
    if(total>0)	Effect.Appear(document.getElementById("tablediv")); //scriptaculous feature requires effects.js
    else document.getElementById("tablediv").style.display = "none";
	
    //todo: use this same "FADE APPEAR" effect for the shopping cart
	
    //hide the 'searching message'
    document.getElementById("searchmsgspan").innerHTML = total + " results found.";


    // add New botton

    if(document.getElementById("newboton")==null)
    {
        var tablediv = document.getElementById("tablediv");
    
        var newBoton = document.createElement("div");
        newBoton.setAttribute("id", "newboton")
        var newBotonLink = document.createElement("a");
        newBotonLink.setAttribute("title", "Crear un usuario");
        newBotonLink.appendChild(document.createTextNode("Nuevo"));
        newBotonLink.onclick = function()
        {
            return addUser();
        }
        newBoton.appendChild(newBotonLink);
        tablediv.appendChild(newBoton);      
    }
}

function appendSearchResult(username, password, level, creation_date, status, resultstable)
{	
    //clear the message pane
    showMsg("");

    //Create row to hold the data
    var row = document.createElement("tr");
    styleChooser = !styleChooser;
    if(styleChooser) a = "1"; else a = "2";
    row.setAttribute(classLiteral, "searchresultstable" + a);
	
    //username
    var usernamecell = document.createElement("td"); //displays name of the product
    usernamecell.setAttribute("id", "usernamecell-" + username); //we'll need this cell later in showProductDetails()
    usernamecell.setAttribute(classLiteral,"cell"); //we'll need this cell later in showProductDetails()

    //password
    var passwordcell = document.createElement("td");
    passwordcell.setAttribute("id", "passwordcell-" + username); //we'll need this cell later in showProductDetails()
    passwordcell.setAttribute(classLiteral,"cell");

    //level
    var levelcell = document.createElement("td");
    levelcell.setAttribute("id", "levelcell-" + username); //we'll need this cell later in showProductDetails()
    levelcell.setAttribute(classLiteral,"cell");

    //date
    var datecell = document.createElement("td");
    datecell.setAttribute("id", "datecell-" + username); //we'll need this cell later in showProductDetails()
    datecell.setAttribute(classLiteral,"cell");

    //status
    var statuscell = document.createElement("td");
    statuscell.setAttribute("id", "statuscell-" + username); //we'll need this cell later in showProductDetails()
    statuscell.setAttribute(classLiteral,"cell");
    
    //edit cell
    var editcell = document.createElement("td"); //displays product code
    editcell.setAttribute("id", "editcell-" + username); //we'll need this cell later in showProductDetails()
    editcell.setAttribute(classLiteral,"cell");

    //add to cart links
    var editUsersLink = document.createElement("a");
    editUsersLink.setAttribute(classLiteral, "control");
    editUsersLink.setAttribute("id", "control-edit-"+username);
    editUsersLink.setAttribute("title", "Editar usuario");
    editUsersLink.appendChild(document.createTextNode("Editar"));
    editUsersLink.onclick = function()
    {
        return editUser(username);
    }

    //delete to cart links
    var deleteUsersLink = document.createElement("a");
    deleteUsersLink.setAttribute(classLiteral, "control");
    deleteUsersLink.setAttribute("id", "control-delete-"+username);
    deleteUsersLink.setAttribute("title", "Borra un usuario");
    deleteUsersLink.appendChild(document.createTextNode("Borrar"));
    deleteUsersLink.onclick = function()
    {
        return deleteUser(username);
    }

    //add username
    usernamecell.appendChild(document.createTextNode(username));
    row.appendChild(usernamecell);
	
    //add password
    passwordcell.appendChild(document.createTextNode(password));
    row.appendChild(passwordcell);

    //add level
    levelcell.appendChild(document.createTextNode(level));
    row.appendChild(levelcell);

    //add date
    datecell.appendChild(document.createTextNode(creation_date));
    row.appendChild(datecell);

    //add status
    statuscell.appendChild(document.createTextNode(status));
    row.appendChild(statuscell);
	
    //add addlink
    editcell.appendChild(editUsersLink);
    editcell.appendChild(document.createTextNode(" | "));
    editcell.appendChild(deleteUsersLink);
    row.appendChild(editcell);

    resultstable.appendChild(row);
}

function editUser(username)
{		
    //clear the message pane
    showMsg("");

    //makeHttpRequest("modules/home/bin/productDescriptions.php?productCode=" + productCode, "handleProductDetails", "true");
    
    makeHttpRequest("modules/home/bin/users_xml.php?sinput=" + username, "handleEditUser", "true");

    return false;
}

function handleEditUser(results)
{
    //clear the message pane
    showMsg("");

    var username = results.getElementsByTagName("username").item(0).firstChild.nodeValue;
    var password = results.getElementsByTagName("password").item(0).firstChild.nodeValue;
    var level = results.getElementsByTagName("level").item(0).firstChild.nodeValue;
    var creation_date = results.getElementsByTagName("creation_date").item(0).firstChild.nodeValue;
    var status = results.getElementsByTagName("status").item(0).firstChild.nodeValue;

    //get a handle to the table cell that contains the values
    var usernamecell = document.getElementById("usernamecell-" + username);
    var passwordcell = document.getElementById("passwordcell-" + username);
    var levelcell = document.getElementById("levelcell-" + username);
    var datecell = document.getElementById("datecell-" + username);
    var statuscell = document.getElementById("statuscell-" + username);
		        
    //clear the existing text
    var usernamechild =  usernamecell.childNodes[0];
    var passwordchild =  passwordcell.childNodes[0];
    var levelchild =  levelcell.childNodes[0];
    var datechild =  datecell.childNodes[0];
    var statuschild =  statuscell.childNodes[0];

    usernamecell.removeChild(usernamechild);
    passwordcell.removeChild(passwordchild);
    levelcell.removeChild(levelchild);
    datecell.removeChild(datechild);
    statuscell.removeChild(statuschild);

    // create the input element
    var usernameinput = document.createElement("input");
    var passwordinput = document.createElement("input");
    var levelinput = document.createElement("input");
    var dateinput = document.createElement("input");
    var statusinput = document.createElement("input");

    // set id to the input
    usernameinput.setAttribute("id", "username-" + username);
    passwordinput.setAttribute("id", "password-" + username);
    levelinput.setAttribute("id", "level-" + username);
    dateinput.setAttribute("id", "date-" + username);
    statusinput.setAttribute("id", "status-" + username);

    // set value to the input
    usernameinput.setAttribute("value", username);
    usernameinput.setAttribute("disabled", true);
    passwordinput.setAttribute("value", password);
    levelinput.setAttribute("value", level);
    dateinput.setAttribute("value", creation_date);
    statusinput.setAttribute("value", status);

    // appent input to the table
    usernamecell.appendChild(usernameinput);
    passwordcell.appendChild(passwordinput);
    levelcell.appendChild(levelinput);
    datecell.appendChild(dateinput);
    statuscell.appendChild(statusinput);

    // change add boton to edit
    var control = document.getElementById("control-edit-"+username);
    var controlchild =  control.childNodes[0];
    control.removeChild(controlchild);
    control.setAttribute("title", "Editar usuario");
    control.appendChild(document.createTextNode("Guardar"));
    control.onclick = function()
    {
        var usernameinput = document.getElementById("username-" + username).value;
        var passwordinput = document.getElementById("password-" + username).value;
        var levelinput = document.getElementById("level-" + username).value;
        var dateinput = document.getElementById("date-" + username).value;
        var statusinput = document.getElementById("status-" + username).value;

        return updateTable(usernameinput, passwordinput, levelinput, dateinput, statusinput);
    }

    // change delete boton to cancel
    var cancel = document.getElementById("control-delete-"+username);
    var cancelchild = cancel.childNodes[0];
    cancel.removeChild(cancelchild);
    cancel.setAttribute("title", "Cancelar la operacion");
    cancel.appendChild(document.createTextNode("Cancelar"));
    cancel.onclick = function()
    {
        return userSearch(document.getElementsByName("searchinp")[0].value);
    }
}

function updateTable(username, password, level, creation_date, status)
{	
    //clear the message pane
    showMsg("");
    showMsg("The Usuario esta siendo actualizado...");
    //send to server
    makeHttpRequest("modules/home/bin/users_update.php?username="+username+"&password="+password+"&level="+level+"&creation_date="+creation_date+"&status="+status, "handleUsersUpdate", "true");
    //prevents the browser from activating the hyperlink
    return false;
}

function insertTable(username, password, level, creation_date, status)
{
    //clear the message pane
    showMsg("");
    showMsg("The Usuario esta siendo actualizado...");
    //send to server
    makeHttpRequest("modules/home/bin/users_insert.php?username="+username+"&password="+password+"&level="+level+"&creation_date="+creation_date+"&status="+status, "handleUsersUpdate", "true");
    //prevents the browser from activating the hyperlink
    return false;
}

function handleUsersUpdate(results)
{		
    //clear the message pane
    showMsg("");
	
    //reset style chooser
    styleChooser = true;
	
    if(results)
    {
        var updateresult = results.getElementsByTagName("result").item(0).firstChild.nodeValue

        if (updateresult=="  1")
        {
            showMsg("Actualizacion Lista");
            userSearch(document.getElementsByName("searchinp")[0].value);

        }else{
            
            showMsg("Error en actualizacion");
        }
    }
    return false;
}

function addUser()
{
    //clear the message pane
    showMsg("");

    var resultstable = document.getElementById("resultstable");

    //Create row to hold the data
    var row = document.createElement("tr");
    styleChooser = !styleChooser;
    if(styleChooser) a = "1"; else a = "2";
    row.setAttribute(classLiteral, "searchresultstable" + a);

    var username = "new";
    var desDiv = "username-" + username;

    if(document.getElementById(desDiv)==null) //we don't want to load more than once
    {

        //username
        var usernamecell = document.createElement("td"); //displays name of the product
        usernamecell.setAttribute("id", "usernamecell-" + username); //we'll need this cell later in showProductDetails()
        usernamecell.setAttribute(classLiteral,"cell"); //we'll need this cell later in showProductDetails()

        //password
        var passwordcell = document.createElement("td");
        passwordcell.setAttribute("id", "passwordcell-" + username); //we'll need this cell later in showProductDetails()
        passwordcell.setAttribute(classLiteral,"cell");

        //level
        var levelcell = document.createElement("td");
        levelcell.setAttribute("id", "levelcell-" + username); //we'll need this cell later in showProductDetails()
        levelcell.setAttribute(classLiteral,"cell");

        //date
        var datecell = document.createElement("td");
        datecell.setAttribute("id", "datecell-" + username); //we'll need this cell later in showProductDetails()
        datecell.setAttribute(classLiteral,"cell");

        //status
        var statuscell = document.createElement("td");
        statuscell.setAttribute("id", "statuscell-" + username); //we'll need this cell later in showProductDetails()
        statuscell.setAttribute(classLiteral,"cell");

        //edit cell
        var editcell = document.createElement("td"); //displays product code
        editcell.setAttribute("id", "editcell-" + username); //we'll need this cell later in showProductDetails()
        editcell.setAttribute(classLiteral,"cell");

        // create the input element
        var usernameinput = document.createElement("input");
        var passwordinput = document.createElement("input");
        var levelinput = document.createElement("input");
        var dateinput = document.createElement("input");
        var statusinput = document.createElement("input");

        // set id to the input
        usernameinput.setAttribute("id", desDiv);
        passwordinput.setAttribute("id", "password-" + username);
        levelinput.setAttribute("id", "level-" + username);
        dateinput.setAttribute("id", "date-" + username);
        statusinput.setAttribute("id", "status-" + username);

        // appent input to the table
        usernamecell.appendChild(usernameinput);
        passwordcell.appendChild(passwordinput);
        levelcell.appendChild(levelinput);
        datecell.appendChild(dateinput);
        statuscell.appendChild(statusinput);

        // change add boton to edit

        var control = document.createElement("a");
        control.setAttribute(classLiteral, "control");
        control.setAttribute("id", "control-edit-"+username);
        control.setAttribute("title", "Guardar nuevo usuario");
        control.appendChild(document.createTextNode("Guardar"));
        control.onclick = function()
        {
            var usernameinput = document.getElementById("username-" + username).value;
            var passwordinput = document.getElementById("password-" + username).value;
            var levelinput = document.getElementById("level-" + username).value;
            var dateinput = document.getElementById("date-" + username).value;
            var statusinput = document.getElementById("status-" + username).value;

            return insertTable(usernameinput, passwordinput, levelinput, dateinput, statusinput);
        }

        // create cancel boton
        var cancel = document.createElement("a");
        cancel.setAttribute(classLiteral, "control");
        cancel.setAttribute("id", "control-delete-"+username);
        cancel.setAttribute("title", "Cancelar la operacion");
        cancel.appendChild(document.createTextNode("Cancelar"));
        cancel.onclick = function()
        {
            return userSearch(document.getElementsByName("searchinp")[0].value);
        }
        editcell.appendChild(control);
        editcell.appendChild(document.createTextNode(" | "));
        editcell.appendChild(cancel);

        //add username
        row.appendChild(usernamecell);
        //add password
        row.appendChild(passwordcell);
        //add level
        row.appendChild(levelcell);
        //add date
        row.appendChild(datecell);
        //add status
        row.appendChild(statuscell);
        //add addlink
        row.appendChild(editcell);

        resultstable.appendChild(row);
    }else{
        showMsg("Solo puedo ingresar un registro a la ves");
    }
}

function deleteUser(username)
{	
    //clear the message pane
    showMsg("");

    if(username.length==0)
    {
        showMsg("Please select at least one product to delete.");
    }
    else
    {
        //send to server
        if (confirm('Se va a eliminar el Usuario "' + username + '".\nEsta Seguro que desea Eliminarlo?' )){
            makeHttpRequest("modules/home/bin/users_delete.php?username=" + username, "handleUsersUpdate", "true");
        }
    }

    //prevents the browser from activating the hyperlink
    return false;
}

function clearANode(node)
{
    //clear the existing results if any
    var child = node.childNodes[0];
    while(child != null)
    {
        node.removeChild(child);
        child = node.childNodes[0];
    }
}
