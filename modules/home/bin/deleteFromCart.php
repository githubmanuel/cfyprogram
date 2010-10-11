<?PHP 

	header('Content-Type: text/xml');
	session_start();	
	//** Get each product based on the token and add it to the session cart variable
	
	//this is an array holding our product strings (use it to prevent inserting duplicates)
	$res = $_SESSION['cart']; 
	
	//ADDED THIS LATER
	if(isset($_GET['prod'])) $prod = mysql_escape_string(substr(trim($_GET['prod']),0,255));
	else $prod = "";
	
	//get the list of products to add as an array
	$prodArray = explode("|", $prod);
	//for each product...
	foreach($prodArray as $key)
	{
			unset($res[$key]);
	}
	
	
	//need to re-assign the modified $res to the session
	$_SESSION['cart'] = $res;
	
	//** Next we need to send back an XML representation of the cart
	$cartxml = "";
	//loop thought the array of products in the cart
	foreach($res as $currprod)
	{
		$cartxml = $cartxml . "\r<item>";		
		
		//get the product attributes and add entries to the XML
		$prodAttributes = explode("/", $currprod); //this gives me the attributes as an array
		$cartxml = $cartxml . "<code>" . $prodAttributes[0] . "</code>" . "<name>" . $prodAttributes[1] . "</name>" . 
		"<price>" . $prodAttributes[2] . "</price>"  . 
		"<amount>" . $prodAttributes[3] . "</amount>" ;
		
		$cartxml = $cartxml . "</item>";
	}
	
?>


<cart>
<?PHP
print_r($cartxml);
?>
</cart>
