//
//
// CFY program - CFY Business Management Suite
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

    //add event-handlers for user details
    document.getElementById("finalcheckout").onclick = function()
    {
        return submitCheckout();
    }
	
    document.getElementById("msgdiv").onclick = function(evt)
    {
        showMsg("");
    }

}

/**
 * Display a message to the user.
 */
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
/*
 * Called when the page is loaded and when the user types something into the input box and selects search
 */
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

/*
* Callback function used by productSearch() function above.
* @param results an XML document that contains Product search results.
*/
function handleSearchResults(results)
{	
    //UNCOMMENT BELOW FOR FADE APPEAR EFFECT TO WORK (also need to uncomment the Effect.Appear line later in this function
    document.getElementById("productdiv").style.display = "none"; //scriptaculous feature
	
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
	
    //if(total > 0) document.getElementById("productdiv").style.display = "inline";
    //else document.getElementById("productdiv").style.display = "none";
    //IF YOU UNCOMMENTED THE line at the top of this function to do the "FADE APPEAR EFFECT," then comment out the line above and uncomment the line below
    if(total>0)	Effect.Appear(document.getElementById("productdiv")); //scriptaculous feature requires effects.js
    else document.getElementById("productdiv").style.display = "none";
	
    //todo: use this same "FADE APPEAR" effect for the shopping cart
	
    //hide the 'searching message'
    document.getElementById("searchmsgspan").innerHTML = total + " results found.";
}

/*
* Adds a row to the Product Search results table.
*/
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
    var addUsersLink = document.createElement("a");
    addUsersLink.setAttribute(classLiteral, "control");
    addUsersLink.setAttribute("id", "control-"+username);
    addUsersLink.setAttribute("title", "Crea un nuevo usuario");
    addUsersLink.appendChild(document.createTextNode("Nuevo"));
    addUsersLink.onclick = function()
    {
        return addToCart(username);
    }
	
    //product link
    var updateLink = document.createElement("a");
    updateLink.setAttribute("href","");
    updateLink.appendChild(document.createTextNode(username));
	
    //add event handlers
    updateLink.onclick = function()
    {
        return showProductDetails(username);
    }
		
    //add username
    usernamecell.appendChild(updateLink);
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
    editcell.appendChild(addUsersLink);
    row.appendChild(editcell);
	
	
    resultstable.appendChild(row);
}

/*
* Adds a row to the Cart contents table.
*/
function appendCartEntry(code, amount, name, price, resultstable)
{	
    //clear the message pane
    showMsg("");
    //new row
    var row = document.createElement("tr");
    styleChooser = !styleChooser;
    if(styleChooser) a = "1"; else a="2";
    row.setAttribute(classLiteral,"searchresultstable" + a);
	
    //product code checkbox for deleting from cart
    var codecell = document.createElement("td"); //displays product code
    codecell.setAttribute(classLiteral,"searchresultstable");
    codecell.setAttribute("align","center");
		
    //amount of product
    var amountcell = document.createElement("td");
    amountcell.setAttribute(classLiteral,"searchresultstable amountcell");
    amountcell.setAttribute("id", "amountcell-" + code);
    amountcell.setAttribute("mode", "show");
    amountcell.setAttribute("value", amount);
	
    //add the text node
    var amountTxtNode = document.createTextNode(amount);
    amountcell.appendChild(amountTxtNode);
	
    //Name/Description
    var namecell = document.createElement("td"); //displays name of the product
    namecell.setAttribute("id", "namecell-" + code); //we'll need this cell later in showProductDetails()
    codecell.setAttribute(classLiteral,"searchresultstable");
	
    //price of product
    var pricecell = document.createElement("td");
    pricecell.setAttribute(classLiteral,"pricecell");
				
    //remove from cart links
    var removeFromCartLink = document.createElement("a");
    removeFromCartLink.setAttribute(classLiteral, "control");
    removeFromCartLink.setAttribute("title", "Click to remove this item from your cart");
    removeFromCartLink.appendChild(document.createTextNode("Remove"));
    removeFromCartLink.onclick = function()
    {
        return deleteFromCart(code);
    }
	
    //add event handlers for amount cell
    var val = amountcell.style.backgroundColor;

    //highlight the amountcell by changing background color
    amountcell.onmouseover = function()
    {
        amountcell.style.backgroundColor = "#d5d5d5";
    }

    //reset the background color
    amountcell.onmouseout = function()
    {
        amountcell.style.backgroundColor = val;
    }

    //show the textbox so user can edit the amount
    amountcell.onclick = function()
    {
        if(amountcell.getAttribute("mode")=="show")
        {
            //reset any existing cell
            resetAmountCell(this, amount);
			
            var inputElement = document.createElement("input");
            inputElement.setAttribute("type","text");
            inputElement.setAttribute("value",amount);
            inputElement.setAttribute("size","2");
            inputElement.setAttribute("id","prodAmountTxt");
			
            //clear the existing node
            clearANode(amountcell);
            amountcell.appendChild(inputElement);
			
            amountcell.setAttribute("mode", "edit");
            document.getElementById("prodAmountTxt").focus();
			
            inputElement.onkeypress = function(evt)
            {
                //IE handles events differently from other browsers
                var keycode;
                if(window.event) keycode = window.event.keyCode;
                else keycode = evt.keyCode;
			
                //return key
                if(keycode==13)
                {
                    amount = document.getElementById("prodAmountTxt").value;
					
                    if(amount && amount > 0)
                    {
                        showMsg("");
                        //send the new entry to the server
                        var data = code + "/" + name + "/" + price + "/" + amount;
                        makeHttpRequest("modules/home/bin/addToCart.php?prod=" + data, "handleCartUpdate", "true");
						
                    }
                    else
                    {
                        amount = amountcell.getAttribute("value");
                        //alert user they must type a number
                        showMsg("Please provide a number greater than 0 or press ESCAPE to keep the current value.");
                    }
                }
				
                //escape key
                if(keycode==27)
                {
                    showMsg("");
                    resetAmountCell(amountcell, amount, pricecell, price);
                }
            }
        }
        return false;
    }
	
	
	
    //add amount
    row.appendChild(amountcell);
	
    //add product name
    namecell.appendChild(document.createTextNode(name));
    row.appendChild(namecell);
	
    //add subtotal
    var subtotal = amount*price;
    pricecell.appendChild(document.createTextNode("$" + formatCurrency(subtotal)));
    row.appendChild(pricecell);
	
    //add addlink
    codecell.appendChild(removeFromCartLink);
    row.appendChild(codecell);
		
    resultstable.appendChild(row);
}


function resetAmountCell(amountcell, amount, pricecell, price)
{
    //reset
    amountcell.setAttribute("value", amount);
    amountcell.innerHTML = "<p'>"+ amount + "</p>";
    amountcell.setAttribute("mode", "show");
	
    if(pricecell)
    {
        var st = "$" + (price*amount);
        pricecell.innerHTML = "<p>" + st + "<p>";
    }
}



/*
* Called to make an ajax request to load the details of a product
*/
function showProductDetails(username)
{		
    //clear the message pane
    showMsg("");

    //makeHttpRequest("modules/home/bin/productDescriptions.php?productCode=" + productCode, "handleProductDetails", "true");
    
    makeHttpRequest("modules/home/bin/users_xml.php?sinput=" + username, "handleProductDetails", "true");

    return false;
}

/*
* Callback function to display the extended details about a selected product
*/
function handleProductDetails(results)
{
    //clear the message pane
    showMsg("");

    var username = results.getElementsByTagName("username").item(0).firstChild.nodeValue;
    var password = results.getElementsByTagName("password").item(0).firstChild.nodeValue;
    var level = results.getElementsByTagName("level").item(0).firstChild.nodeValue;
    var creation_date = results.getElementsByTagName("creation_date").item(0).firstChild.nodeValue;
    var status = results.getElementsByTagName("status").item(0).firstChild.nodeValue;


    var desDiv = "username-" + username;

    if(document.getElementById(desDiv)==null) //we don't want to load more than once
    {

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
        usernameinput.setAttribute("id", desDiv);
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

        var control = document.getElementById("control-"+username);
        var controlchild =  control.childNodes[0];
        control.removeChild(controlchild);
        control.setAttribute("title", "Editar usuario");
        control.appendChild(document.createTextNode("Editar"));
        control.onclick = function()
        {
            var usernameinput = document.getElementById("username-" + username).value;
            var passwordinput = document.getElementById("password-" + username).value;
            var levelinput = document.getElementById("level-" + username).value;
            var dateinput = document.getElementById("date-" + username).value;
            var statusinput = document.getElementById("status-" + username).value;

            return editTable(usernameinput, passwordinput, levelinput, dateinput, statusinput);
        }
        // create cancel boton
        var cancel = document.createElement("a");
        cancel.setAttribute(classLiteral, "control");
        cancel.setAttribute("title", "Click to remove this item from your cart");
        cancel.appendChild(document.createTextNode("Cancelar"));
        cancel.onclick = function()
        {
            return userSearch(document.getElementsByName("searchinp")[0].value);
        }
        var editcell = document.getElementById("editcell-" + username);
        editcell.appendChild(document.createTextNode(" | "));
        editcell.appendChild(cancel);
    
    }
    else //remove the extended description node
    {
        var parent = document.getElementById(desDiv).parentNode;
        parent.removeChild(document.getElementById(desDiv));
    }
}

/*
* Called to add checked items to the cart.
*/
function editTable(username, password, level, creation_date, status)
{	
    //clear the message pane
    showMsg("");
    showMsg("The Usuario esta siendo actualizado...");
    //send to server
    makeHttpRequest("modules/home/bin/users_update.php?username="+username+"&password="+password+"&level="+level+"&creation_date="+creation_date+"&status="+status, "handleUsersUpdate", "true");
    //prevents the browser from activating the hyperlink
    return false;
}

/*
* Updates the diplay of the cart contents. This function is called after adding or deleting items from the cart.
*/
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

    //        document.getElementById("cartdiv").style.display = "inline";
    //
    //        //clear the existing results if any
    //        var cartcontentstable = document.getElementById("cartcontentstable");
    //        clearANode(cartcontentstable);
    //
    //        //get the results that were returned
    //        var itemsInCart = results.getElementsByTagName("item").length; // the number of items in the cart
    //
    //        var total = 0;
    //
    //        for(i=0; i < itemsInCart; i++)
    //        {   //it's more efficient to assign to variables (like below), so that javascript has a handle to the xml, instead of iterating through it over and over
    //            var currentResult = results.getElementsByTagName("item").item(i);
    //            var name = currentResult.getElementsByTagName("name").item(0).firstChild.nodeValue;
    //            var code = currentResult.getElementsByTagName("code").item(0).firstChild.nodeValue;
    //            var price = currentResult.getElementsByTagName("price").item(0).firstChild.nodeValue;
    //            var amount = currentResult.getElementsByTagName("amount").item(0).firstChild.nodeValue;
    //
    //            total = total + (amount*price);
    //
    //            //add a row to the CART HTML table
    //            appendCartEntry(code,amount,name,price, cartcontentstable);
    //        }
    //
    //        //if any exception message we show it
    //        if(results.getElementsByTagName("exception").item(0))
    //        {
    //            showMsg(results.getElementsByTagName("exception").item(0).firstChild.nodeValue);
    //        }
    //
    //        //add the total and 'checkout' link
    //        if(itemsInCart > 0)
    //        {
    //            //add row with 2 empty cells
    //            var trow = document.createElement("tr");
    //            trow.setAttribute(classLiteral, "total");
    //            trow.appendChild(document.createElement("td"));
    //            trow.appendChild(document.createElement("td"));
    //
    //            //add 3rd column for TOTAL
    //            var tcol = document.createElement("td");
    //            tcol.setAttribute("align","right");
    //            tcol.appendChild(document.createTextNode("TOTAL: $" + formatCurrency( total)));
    //            trow.appendChild(tcol);
    //
    //            //checkout (4th) column
    //            var col = document.createElement("td");
    //            col.setAttribute("align","center");
    //            col.setAttribute("valign","center");
    //            trow.appendChild(col);
    //
    //            //checkout button
    //            var checkout = document.createElement("button");
    //            checkout.setAttribute("type","button");
    //            checkout.setAttribute("name","checkoutfromcart");
    //            checkout.setAttribute("title","Click here to checkout");
    //            checkout.setAttribute(classLiteral,"cartbutton");
    //            checkout.appendChild(document.createTextNode("Checkout"));
    //            col.appendChild(checkout);
    //
    //            //add the total + delete-link row to the table
    //            cartcontentstable.appendChild(trow);
    //
    //            //event handler for the checkout button
    //            checkout.onclick = function()
    //            {
    //                return checkoutCart();
    //            }
    //        }
    //        else
    //        {
    //            document.getElementById("cartdiv").style.display = "none";
    //        }
    }
    return false;
}
/**
* Called to checkout the cart.
*/
function checkoutCart()
{
    document.getElementById("userDetailsDiv").style.display = "inline";
//todo: check if already filled in
}

function submitCheckout()
{
    //clear the message pane
    showMsg("");

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
	
    if(name.length==0 || email.length==0)
    {
        showMsg("You must provide your name and email address in order to check out.");
    }
    else
    {
        //clear the message pane
        showMsg("Sending your checkout request to the server. Please wait...");
		
        //disable the finalcheckout button so they can't click it twice
        document.getElementById("finalcheckout").disabled = true;
        makeHttpRequest("modules/home/bin/checkoutCart.php?name=" + name + "&email=" + email, "handleCartCheckout", "true");
    }
}

function handleCartCheckout()
{
    //todo: code for failure: probably look for checkout errors and display them to the user
    //todo: hide the "2 results found." text field
    //show success message
    showMsg("Your checkout has been confirmed. Thank you for shopping with us.");
	
    //re-enable the finalcheckout button
    document.getElementById("finalcheckout").disabled = false;
	
    //clear the cart display and hide stuff
    document.getElementById("cartdiv").style.display = "none";
    document.getElementById("userDetailsDiv").style.display = "none";
    document.getElementById("productdiv").style.display = "none";
		
    //clear the existing results if any
    var cartcontentstable = document.getElementById("cartcontentstable");
    var child = cartcontentstable.childNodes[0];
    while(child != null)
    {
        cartcontentstable.removeChild(child);
        child = cartcontentstable.childNodes[0];
    }
}

/*
* Called to delete checked items from the cart. Similar to addToCart except we only need to send 
* the product code and not the description and price.
*/
function deleteFromCart(productCode)
{	
    //clear the message pane
    showMsg("");

    if(productCode.length==0)
    {
        showMsg("Please select at least one product to delete.");
    }
    else
    {
        //send to server
        makeHttpRequest("modules/home/bin/deleteFromCart.php?prod=" + productCode, "handleCartUpdate", "true");
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

/**
* Inserts commas for display purposes
*/
function formatCurrency(amount)
{
    amount += '';
    x = amount.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
} 
