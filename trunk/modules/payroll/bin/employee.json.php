<?php

header('Content-Type: text/plain');
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
 * 
 */

if (defined('E_DEPRECATED')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
} else {
    error_reporting(E_ALL ^ E_NOTICE);
}

define('PATH_thisScript', str_replace('//', '/', str_replace('\\', '/', (PHP_SAPI == 'cgi' || PHP_SAPI == 'isapi' || PHP_SAPI == 'cgi-fcgi') && ($_SERVER['ORIG_PATH_TRANSLATED'] ? $_SERVER['ORIG_PATH_TRANSLATED'] : $_SERVER['PATH_TRANSLATED']) ? ($_SERVER['ORIG_PATH_TRANSLATED'] ? $_SERVER['ORIG_PATH_TRANSLATED'] : $_SERVER['PATH_TRANSLATED']) : ($_SERVER['ORIG_SCRIPT_FILENAME'] ? $_SERVER['ORIG_SCRIPT_FILENAME'] : $_SERVER['SCRIPT_FILENAME']))));

define('PATH_site', str_replace("/modules/payroll/bin", "/", dirname(PATH_thisScript)));


//sleep(2);

require_once (PATH_site . 'core/classes/dbquery.json.php');
$myData = new dbconnect();
$json = "";

$action = "";
if (isset($_GET['action'])) {
    $action = mysql_escape_string(substr(trim($_GET['action']), 0, 255));
}

$id = "";
if (isset($_GET['id'])) {
    $id = mysql_escape_string(substr(trim($_GET['id']), 0, 255));
}
$code = "";
if (isset($_GET['code'])) {
    $code = mysql_escape_string(substr(trim($_GET['code']), 0, 255));
}
$name = "";
if (isset($_GET['name'])) {
    $name = mysql_escape_string(substr(trim($_GET['name']), 0, 255));
}
$description = "";
if (isset($_GET['description'])) {
    $description = mysql_escape_string(substr(trim($_GET['description']), 0, 255));
}
$type = "";
if (isset($_GET['type'])) {
    $type = mysql_escape_string(substr(trim($_GET['type']), 0, 255));
}
$amount = "";
if (isset($_GET['amount'])) {
    $amount = mysql_escape_string(substr(trim($_GET['amount']), 0, 255));
}
$table = "pa_employee";

switch ($action) {
    case "open" :
        $result = "1";
        break;
    case "update" :
        $myInput = array(code => $code, name => $name, description => $description, type => $type, amount => $amount);
        $result = $myData->update($myInput, "id_employee=" . $id, $table);
        break;
    case "insert" :
        $myInput = array(code => $code, name => $name, description => $description, type => $type, amount => $amount);
        $result = $myData->insert($myInput, $table);
        break;
    case "delete" :
        $result = $myData->delete("id_employee=" . $id, $table);
        break;
    default :
        $xml = "no action";
}

if ($result == "1") { // check for the result, and read the xml.
    $json = $myData->select("", $table, "all", "id_employee ASC", "", "");
} else {
    $json = '{"result":"error"}';
}

echo $json;
?>