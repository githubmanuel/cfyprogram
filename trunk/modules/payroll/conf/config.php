<?php

/*

  CFY program = CFY Business Management Suite

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
    $head_script .= '<link href="' . $CORE["system"]["site_url"] . 'modules/payroll/css/payroll.css" rel="stylesheet" type="text/css" />';

    echo $head_script;
}
echo "";
?>
