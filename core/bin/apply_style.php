<?php
/*

  CFY program - CFY Business Management Suite

  Integrated enterprise applications to execute and optimize business and IT strategies.
  Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

  Version: 0.0.0.1a
  Author: Ernesto La Fontaine
  Mail: mail@pajarraco.com
  License: New BSD License (see docs/license.txt)
  Redistributions of files must retain the copyright notice.

  File: apply_style.php
  Commnents: file used for call the apply_style class.

 */

require_once('../classes/apply_style.php'); // class to apply the styles. see core/classes/apply_style.php for detail

$setStyle = new Apply_Style();
$setStyle->set_style('style_apply.php', $CORE["system"]["site_url"], $CORE["style"]["name"]);
?>

Su estilo ha sido aplicado
<a href="javascript:back()">Atras</a>