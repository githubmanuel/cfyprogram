<?PHP
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
//
// some modification on the original files
//
// -- Original --
// // *******************************************************************************************************************
// Get each product based on the token and add it to the session cart variable
// Expected input to this page is a structure like [code + "/" + name + "/" + price + "/" + amount]
// representing a line-item in the cart. Each line item is seperated by a |. Thus the structure:
// fruit1/apple/2.00/1|fruit2/pear/3.00/2 represents an order for:
// - 1 apple (product code 'fruit1') at a price of $2.00
// - 2 pears at a price of $3.00
//
// The contents of the cart are held in a PHP array with a key=PRODUCT_CODE and a value=fruit1/apple/2.00/1.
// The cart string will be designated with query string variable 'prod'
// ********************************************************************************************************************
//tell client we are sending xml
header('Content-Type: text/xml');

//make sure we have a running session to hold our cart
session_start();

if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = ""; //this fixes a bug on a new session when clicking Add for the first time
    //this is an array holding our product strings (use it to prevent inserting duplicates)
 $res = $_SESSION['cart'];

//ADDED THIS LATER
if (isset($_GET['prod']))
    $prod = mysql_escape_string(substr(trim($_GET['prod']), 0, 255));
else
    $prod = "";

//if query string variable $prod then try and add to cart
if ($prod) {
    //get the list of products to add as an array
    $prodArray = explode("|", $prod); //probably should have been called $lineItemArray, instead of $prodArray
    //for each product...
    foreach ($prodArray as $currprod) {
        //get the fields (code,description,price,amount) as an array
        $cols = explode("/", $currprod); //$currprod probably should have been called $currLineItem

        if ($cols != "") {
            //use the product code (array item 0) as the key to the array and add to the array
            $res[$cols[0]] = $currprod;
        }
    }
}

//need to re-assign the modified $res to the session
$_SESSION['cart'] = $res;

//** Next we need to send back an XML representation of the cart
$errorxml = "";
$cartxml = "";
//loop though the array of products in the cart
foreach ($res as $currprod) {
    $cartxml = $cartxml . "\r<item>";

    //get the product attributes and add entries to the XML
    $prodAttributes = explode("/", $currprod); //this gives me the attributes as an array
    $amount = $prodAttributes[3];

    //only let them buy up to 10 items
    if ($prodAttributes[3] > 10) {
        $amount = 10;
        $res[$prodAttributes[0]] = $prodAttributes[0] . "/" . $prodAttributes[1] . "/" . $prodAttributes[2] . "/" . $amount; //without this line, the amount of items will still be in the cart, even though the gui only shows 10
        $errorxml = "<exception>You can only add up to 10 of each item to your cart.</exception>";
    }


    $cartxml = $cartxml . "<code>" . $prodAttributes[0] . "</code>" . "<name>" . $prodAttributes[1] . "</name>" .
            "<price>" . $prodAttributes[2] . "</price>" .
            "<amount>" . $amount . "</amount>";

    $cartxml = $cartxml . "</item>";
}

$cartxml = $errorxml . $cartxml;

//need to re-assign the modified $res to the session
$_SESSION['cart'] = $res;
?>


<cart>
    <?PHP
    print_r($cartxml);
    ?>
</cart>
