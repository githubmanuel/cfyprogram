<?php
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
require("modules/home/classes/class.phpmailer.php");

//ADDED THIS LATER
if(isset($_GET['name'])) $name = mysql_escape_string(substr(trim($_GET['name']),0,255));
else $name = "";
if(isset($_GET['email'])) $email = mysql_escape_string(substr(trim($_GET['email']),0,255));
else $email = "";

//make sure we have a running session to hold our cart
session_start();

header('Content-Type: text/xml');
//get cart from session and build an XML and an HTML representation of it to email the site admin and the purchaser
$res = $_SESSION['cart']; 

//** Next we need to send back an HTML representation of the cart
	$carthtml = "Thank you for your order. Below you will find the details. <p>Name: ".$name. "<br>Email: ".$email."<p><table border=1><tr><th>Product Code</th><th>Product Name</th><th>Price</th><th>Amount</th></tr>";
	$cartxml = "<cart>\r\t<name>".$name. "</name>\r\t<email>".$email."</email>";
	$total = 0;
	//loop though the array of products in the cart
	foreach($res as $currprod)
	{
		//get the product attributes and add entries to the XML
		$prodAttributes = explode("/", $currprod); //this gives me the attributes as an array
		
		//build the html
		$carthtml = $carthtml ."<tr><td>" . $prodAttributes[0] . "</td>" . "<td>" . $prodAttributes[1] . "</td>" . 
			"<td align='right'>$" . $prodAttributes[2] . "</td>" . 
			"<td align='right'>" . $prodAttributes[3] . "</td></tr>" ;
		
		//build the xml
		$cartxml = $cartxml . "\r\t<item>";				
		$cartxml = $cartxml . "\r\t\t<code>" . $prodAttributes[0] . "</code>" . "<name>" . $prodAttributes[1] . "</name>" . 
		"<price>" . $prodAttributes[2] . "</price>" . 
		"<amount>" . $prodAttributes[3] . "</amount>" ;
		
		$cartxml = $cartxml . "\r\t</item>";
		
		//increment the total
		$total = $total + ($prodAttributes[3] * $prodAttributes[2]);
	}

	$carthtml = $carthtml."<tr><td>&nbsp;</td><td align='right'>Total:</td><td align='right'>$".$total."</td><td>&nbsp;</td></tr></table>";
	$cartxml = $cartxml . "\r</cart>"; 


//build the email
$mail = new PHPMailer();

$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "";  // specify main and backup server like smtp.mail.yahoo.com (Note that if you're sending from a home computer, you might need to use your Internet provider's smtp settings, or else they might block the email from going out.)
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "";  // SMTP username. Might be your email.
$mail->Password = ""; // SMTP password

$mail->From = ""; //admin's email address
$mail->FromName = "Killersites.com";
$mail->AddAddress("x@y.com", "Rich Mischook");  //x@y.com", "Rich Mischook" replace with your email and name. This admin will get a copy of the email
$mail->AddAddress($email,  $name); //customer

$mail->WordWrap = 80;                                 // set word wrap to 80 characters
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "New Order from ". $name." ". $email;
$mail->Body    = $carthtml; //this is the default of what the customer will see when they get the email
$mail->AltBody = $cartxml; //plain text of the email

if(!$mail->Send())
{
   echo "<response><status>NOK</status>"; //NOK means Not Okay
   echo "<msg>".$mail->ErrorInfo."</msg></response>";
   exit;
}
else
{
	echo "<response><status>OK</status>".$cartxml."</response>";
	
	//clear the cart
	$_SESSION['cart'] = "";
}
?>