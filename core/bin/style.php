<?php
/*

CFY program - CFY Business Management Suite

Integrated enterprise applications to execute and optimize business and IT strategies. Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

Version: 0.0.0.1a
Author: Ernesto La Fontaine
License: New BSD License (see docs/license.txt)

File: style.php
Commnents: Apply the style to the system.

*/

//require("styles/".$CORE["style"]["name"]."/style.html");

$lines = file("styles/".$CORE["style"]["name"]."/style.html");

foreach ($lines as $line_num => $line) {
		$head_line = str_replace("--head--", ' ', $line);
		$css_line = str_replace('href="', 'href="'.$CORE["system"]["site_url"].'/styles/base/', $head_line);
		echo $css_line;
}

?>
