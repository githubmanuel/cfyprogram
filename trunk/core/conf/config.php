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

  File: config
  Commnents: Configuration file.

 */

//error_reporting(0);

// System variable
$CORE["system"]["site_url"] = "http://192.168.137.50/cfyprogram";

// DB variables
$CORE["system"]["db_host"] = "localhost";
$CORE["system"]["db_name"] = "cfy_base";
$CORE["system"]["db_username"] = "cfyadmin";
$CORE["system"]["db_password"] = "12345";

// Style variable
$CORE["style"]["name"] = "base";

// Modules Variables

$CORE["module"]["names"] = array(1 => 'home', 'admin', 'payroll', 'budget');
$CORE["module"]["print_name"] = array(1 => 'Inicio', 'Adminitración', 'Nomina', 'Presupuesto');

?>
