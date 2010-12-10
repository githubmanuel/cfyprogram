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

  File: global
  Commnents: Configuration file.

 */

require_once(PATH_site . "core/conf/config.php"); // Configuration varibles
// Modules Variables

$CORE["module"]["names"] = array(0=>"");
$xml = simplexml_load_file(PATH_site . "core/conf/modules.xml");
foreach ($xml->names as $item) {
    array_push($CORE["module"]["names"], $item->name);
}
$CORE["module"]["print_name"] = array(1 => 'Inicio');

/* Ajax Login Module v1.1 */
/* If login successful then it will redirect to */
$CORE["login"]["success_login_goto"] = "?pid=1";

/* if the defined table in USERS_TABLE_NAME doesn't exist in the Database,
 * this module  will attempt to create.
 */
$CORE["login"]["user_table_name"] = "core_user";

/* Page varible */

$CORE["page"]["module_menu_id"] = 1;

// get var on database
// require_once(PATH_site . "core/classes/conf_var.php");
// $setVar = new conf_var("core_conf_var");
?>
