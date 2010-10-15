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

  File:
  Commnents:

 */



if ($pid != 0) {
    $head_script = '<link rel="stylesheet" type="text/css" href="'.$CORE["system"]["site_url"].'modules/home/css/styles.css">';
    $head_script .= '<SCRIPT language="javascript" type="text/javascript" src="'.$CORE["system"]["site_url"].'modules/home/scripts/prototype.js"></SCRIPT>';
    $head_script .= '<SCRIPT language="javascript" type="text/javascript" src="'.$CORE["system"]["site_url"].'modules/home/scripts/scriptaculous.js"></SCRIPT> <!-- calls effects.js -->';
    $head_script .= '<SCRIPT language="javascript" type="text/javascript" src="'.$CORE["system"]["site_url"].'modules/home/scripts/ajax.js"></SCRIPT>';
    $head_script .= '<SCRIPT language="javascript" type="text/javascript" src="'.$CORE["system"]["site_url"].'modules/home/scripts/users.js"></SCRIPT>';

    echo $head_script;
}
echo "";
?>

