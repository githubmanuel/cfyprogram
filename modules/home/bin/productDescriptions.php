<?php

header('Content-Type: text/xml');
/*
 * Created on 31-Dec-2005
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

$xml = "";

//ADDED THIS LATER
if (isset($_GET['productCode']))
    $productCode = mysql_escape_string(substr(trim($_GET['productCode']), 0, 255));
else
    $productCode = "";

//Normally, you'd search a database, but for ease, we'll do it this way
//some databases allow you to return the results in xml format

if ($productCode == "1") {
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
            "<product><code>1</code>
			<description>The Focus is a vehicle that delivers good value of money, particularly the diesel version.</description>
			<reviews>
				<review>
					<name>John Smith</name>
					<rating>5</rating>
					<comment>I really like this car.</comment>
				</review>
				<review>
					<name>Jane Jones</name>
					<rating>3</rating>
					<comment>I wish I could afford a BMW.</comment>
				</review>		
			</reviews>
			</product>";
} else if ($productCode == "2") {
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
            "<product><code>2</code>
			<description>The Audi A4 is a great car particularly in winter conditions.</description>
			<reviews>
				<review>
					<name>Peter Pan</name>
					<rating>5</rating>
					<comment>I have always loved these cars.</comment>
				</review>
				<review>
					<name>Frodo Baggins</name>
					<rating>3</rating>
					<comment>Nice but a little too conspicuous when trying to escape from black rider types.</comment>
				</review>		
			</reviews>
			</product>";
} else if ($productCode == "3") {
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
            "<product><code>3</code>
			<description>The Inspiron is a great laptop.</description>
			<reviews>
				<review>
					<name>Mr. Kong</name>
					<rating>2</rating>
					<comment>Keyboard too small for me.</comment>
				</review>		
			</reviews>
			</product>";
} else if ($productCode == "4") {
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
            "<product><code>4</code>
			<description>IBM has a long history of producing computers</description>
			<reviews />
			</product>";
}

echo $xml;
?>
