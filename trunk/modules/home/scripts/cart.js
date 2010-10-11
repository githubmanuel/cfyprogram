
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
	//handler for submitting the search form
	document.getElementsByName("searchform")[0].onsubmit = function ()	
	{
		return productSearch(document.getElementsByName("searchinp")[0].value);
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
}

/*
* Called when the user types something into the input box and selects search
*/
function productSearch(input)
{	
	//clear the message pane
	showMsg("");

	document.getElementById("searchmsgspan").innerHTML="Searching...";	
	Effect.Pulsate("searchmsgspan"); //scriptaculous feature requires effects.js
	makeHttpRequest("modules/home/bin/searchResults.php?sinput=" + input, "handleSearchResults", "true");
	
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
		var name = currentResult.getElementsByTagName("name").item(0).firstChild.nodeValue;
		var code = currentResult.getElementsByTagName("code").item(0).firstChild.nodeValue;
		var price = currentResult.getElementsByTagName("price").item(0).firstChild.nodeValue;
		
		//for each result append to the table		
		appendSearchResult(code,name,price, resultstable);	
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
function appendSearchResult(code, name, price, resultstable)
{	
	//clear the message pane
	showMsg("");


	//Create row to hold the data	
	var row = document.createElement("tr");
	styleChooser = !styleChooser;
	if(styleChooser) a = "1"; else a="2";
	row.setAttribute(classLiteral,"searchresultstable" + a);	
	
	//product code
	var codecell = document.createElement("td"); //displays product code
	codecell.setAttribute(classLiteral,"searchresultstable");	
	codecell.setAttribute("align","center");	
		
	//Name/Description
	var namecell = document.createElement("td"); //displays name of the product
	namecell.setAttribute("id", "namecell-" + code); //we'll need this cell later in showProductDetails()
	codecell.setAttribute(classLiteral,"searchresultstable");
	
	//price of product
	var pricecell = document.createElement("td");
	pricecell.setAttribute(classLiteral,"pricecell");
	
	//add to cart links
	var addToCartLink = document.createElement("a");
	addToCartLink.setAttribute(classLiteral, "control");
	addToCartLink.setAttribute("title", "Click to add this item to your cart");
	addToCartLink.appendChild(document.createTextNode("Add"));
	addToCartLink.onclick = function()
	{
		return addToCart(code);
	}
	
	//product link
	var link = document.createElement("a");
	link.setAttribute("href","");
	link.appendChild(document.createTextNode(name));
	
	//add event handlers
	link.onclick = function()
	{
		return showProductDetails(code);
	}
		
	//add product name	
	namecell.appendChild(link);
	row.appendChild(namecell);
	
	//add price
	pricecell.appendChild(document.createTextNode("$" + formatCurrency( price)));
	row.appendChild(pricecell);	
	
	//add addlink
	codecell.appendChild(addToCartLink);
	row.appendChild(codecell);
	
	
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
function showProductDetails(productCode)
{		
	//clear the message pane
	showMsg("");

	makeHttpRequest("modules/home/bin/productDescriptions.php?productCode=" + productCode, "handleProductDetails", "true");
	return false;
}

/*
* Callback function to display the extended details about a selected product
*/
function handleProductDetails(results)
{
	//clear the message pane
	showMsg("");

	var productCode = results.getElementsByTagName("code").item(0).firstChild.nodeValue;
	var desDiv = "descriptiondiv-" + productCode;

	if(document.getElementById(desDiv)==null) //we don't want to load more than once
	{
		var description = results.getElementsByTagName("description").item(0).firstChild.nodeValue;
		
		//get a handle to the table cell that contains the description
		var namecell = document.getElementById("namecell-" + productCode);
		
		//add a div below the description
		var div = document.createElement("div");
		div.setAttribute("id", desDiv);
		namecell.appendChild(div);
		
		div.appendChild(document.createTextNode(description));
		div.appendChild(document.createElement("p"));
		var boldTag = document.createElement("strong");
		
		boldTag.appendChild(document.createTextNode("Reviews"));
		div.appendChild(boldTag);
		div.appendChild(document.createElement("p"));
		
		//get the reviews
		var reviews = results.getElementsByTagName("review");
		for(i=0; i < reviews.length; i++)
		{
			var review = reviews.item(i);
			var name = review.getElementsByTagName("name").item(0).firstChild.nodeValue;
			var rating = review.getElementsByTagName("rating").item(0).firstChild.nodeValue;
			var comment = review.getElementsByTagName("comment").item(0).firstChild.nodeValue;	
			
			//build some text	
			var reviewdiv = document.createElement("div");
			reviewdiv.setAttribute(classLiteral, "reviewdiv");
			reviewdiv.appendChild(document.createTextNode(name + " [" + rating + " out of 5]"));	
			reviewdiv.appendChild(document.createElement("p"));
			reviewdiv.appendChild(document.createTextNode(comment));	
			div.appendChild(reviewdiv);
			
		}
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
function addToCart(productCode)
{	
		//clear the message pane
	showMsg("");
	var res = "";
	
	//if the user tries to add the same item twice we ignore the request...
	if(!document.getElementById("amountcell-" + productCode))
	{
		//if an item is selected we add it to our node
		res = extractXmlForProductCode(productCode,productListXml); //it's not really xml we're extracting
		//send to server
		makeHttpRequest("modules/home/bin/addToCart.php?prod=" + res, "handleCartUpdate", "true");
	}
	else //...and show a message
	{
		showMsg("The item you selected is already in your cart. " +
			"<br>You can add more than one by clicking on the AMOUNT and changing the number.");
	}
	
	//prevents the browser from activating the hyperlink
	return false;
}

/*
* Private function to find a matching product XML node and return a delimited string.
* @param code the product code to add to the cart
* @param results the search results from which the selection was made
* @param amount the amount of the product
*/
function extractXmlForProductCode(code, results, amount)
{	
	if(!amount) amount=1; //because sometimes we might call the function without the amount argument

    var res = "";
	var total = results.getElementsByTagName("result").length; // the number of results
	for(i=0; i < total; i++)
	{
		var currentResult = results.getElementsByTagName("result").item(i);
		var currcode = currentResult.getElementsByTagName("code").item(0).firstChild.nodeValue;	
		var name = currentResult.getElementsByTagName("name").item(0).firstChild.nodeValue;		
		var price = currentResult.getElementsByTagName("price").item(0).firstChild.nodeValue;	
		if(code==currcode)
		{
			res = code + "/" + name + "/" + price + "/" + amount;
			break;
		}
	}	
	
	return res;
	
}


/*
* Updates the diplay of the cart contents. This function is called after adding or deleting items from the cart.
*/
function handleCartUpdate(results)
{		
	//clear the message pane
	showMsg("");
	
	//reset style chooser
	styleChooser = true;
	
	if(results)
	{
		document.getElementById("cartdiv").style.display = "inline";
		
		//clear the existing results if any
		var cartcontentstable = document.getElementById("cartcontentstable");
		clearANode(cartcontentstable);
		
		//get the results that were returned
		var itemsInCart = results.getElementsByTagName("item").length; // the number of items in the cart
		
		var total = 0;
		
		for(i=0; i < itemsInCart; i++)
		{   //it's more efficient to assign to variables (like below), so that javascript has a handle to the xml, instead of iterating through it over and over
			var currentResult = results.getElementsByTagName("item").item(i);
			var name = currentResult.getElementsByTagName("name").item(0).firstChild.nodeValue;
			var code = currentResult.getElementsByTagName("code").item(0).firstChild.nodeValue;
			var price = currentResult.getElementsByTagName("price").item(0).firstChild.nodeValue;
			var amount = currentResult.getElementsByTagName("amount").item(0).firstChild.nodeValue;
			
			total = total + (amount*price);
			
			//add a row to the CART HTML table
			appendCartEntry(code,amount,name,price, cartcontentstable);				
		}	
		
		//if any exception message we show it
		if(results.getElementsByTagName("exception").item(0))
		{
			showMsg(results.getElementsByTagName("exception").item(0).firstChild.nodeValue);
		}
		
		//add the total and 'checkout' link
		if(itemsInCart > 0)
		{	
			//add row with 2 empty cells
			var trow = document.createElement("tr");		
			trow.setAttribute(classLiteral, "total");
			trow.appendChild(document.createElement("td"));
			trow.appendChild(document.createElement("td"));
			
			//add 3rd column for TOTAL
			var tcol = document.createElement("td");
			tcol.setAttribute("align","right");
			tcol.appendChild(document.createTextNode("TOTAL: $" + formatCurrency( total)));
			trow.appendChild(tcol);		
		
			//checkout (4th) column
			var col = document.createElement("td");
			col.setAttribute("align","center");
			col.setAttribute("valign","center");
			trow.appendChild(col);			
			
			//checkout button		
			var checkout = document.createElement("button");	
			checkout.setAttribute("type","button");
			checkout.setAttribute("name","checkoutfromcart");
			checkout.setAttribute("title","Click here to checkout");
			checkout.setAttribute(classLiteral,"cartbutton");
			checkout.appendChild(document.createTextNode("Checkout"));			
			col.appendChild(checkout);			
						
			//add the total + delete-link row to the table
			cartcontentstable.appendChild(trow);		
			
			//event handler for the checkout button
			checkout.onclick = function()
			{
				return checkoutCart();
			}		
		}
		else
		{
			document.getElementById("cartdiv").style.display = "none";
		}		
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
