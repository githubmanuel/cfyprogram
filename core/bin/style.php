<?php
/*

CFY program - CFY Business Management Suite

Integrated enterprise applications to execute and optimize business and IT strategies. Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

Version: 0.0.0.1a
Author: Ernesto La Fontaine
License: New BSD License (see docs/license.txt)

File: style.php
Commnents: apply the style to the style file.

*/

require('../conf/config.php');
include '../classes/files.php';
$setStyle = new Files();

$setStyle->set_style('style_apply.php', $CORE["system"]["site_url"], $CORE["style"]["name"]);

?>
Su estilo ha sido aplicado

<a href="javascript:back()">Atras</a>