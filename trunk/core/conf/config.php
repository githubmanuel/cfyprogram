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
$CORE["system"]["site_url"] = 				"http://192.168.137.50/cfyprogram";

// DB variables
$CORE["system"]["db_host"] = 				"localhost";
$CORE["system"]["db_name"] = 				"cfy_base";
$CORE["system"]["db_username"] = 			"cfyadmin";
$CORE["system"]["db_password"] = 			"12345";

// Style variable
$CORE["style"]["name"] = 					"base";

// Modules Variables

$CORE["module"]["names"] = array(1=>'home', 'admin', 'payroll', 'budget');
$CORE["module"]["print_name"] = array(1=>'Inicio', 'Adminitración', 'Nomina', 'Presupuesto');

/* Ajax Login Module v1.1*/
/* If login successful then it will redirect to */
$CORE["login"]["success_login_goto"] = 		"?pid=1";
  
/* if the defined table in USERS_TABLE_NAME doesn't exist in the Database,
 * this module  will attempt to create.
*/
$CORE["login"]["user_table_name"] = 		"core_user";
 
  /* Advance Configuration - no need to edit this section */
$CORE["login"]["ajax_timeout"] = 			"10000000";
$CORE["login"]["ajax_target_element"] = 	"ajax_target";
$CORE["login"]["ajax_wait_text"] = 			"Espere por favor...";
$CORE["login"]["ajax_form_element"] = 		"ajax_form";
$CORE["login"]["ajax_wait_element"] = 		"ajax_wait";
$CORE["login"]["ajax_notify_element"] = 	"ajax_notify";

/* module varible */

$CORE["page"]["module_menu_id"] = 1;
  
?>
