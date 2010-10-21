<?php

header('Content-Type: text/xml');
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

if ($productCode == "admin") {
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
            "<product><code>admin</code>
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
} else if ($productCode == "general") {
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
            "<product><code>general</code>
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
