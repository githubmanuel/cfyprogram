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
$employee = "";
if (isset($_GET['employee'])) {
    $employee = mysql_escape_string(substr(trim($_GET['employee']), 0, 255));
}
$assignment = "";
if (isset($_GET['assignment'])) {
    $assignment = mysql_escape_string(substr(trim($_GET['assignment']), 0, 255));
}

$jsondata = "";
if (isset($_GET['jsondata'])) {
    $jsondata = mysql_escape_string(substr(trim($_GET['jsondata']), 0, 255));
}


$table = "pa_payroll";
$view = "view_pa_payroll";


switch ($action) {
    case "open" :
        $result = "1";
        break;
    case "getdata" :
        switch ($jsondata) {
            case "employee":
                $select = " id_employee as id, name ";
                $table = "pa_employee";
                $sort = "id_employee ASC";
                break;

            case "assignment":
                $select = " id_assignment as id, name ";
                $table = "pa_assignment";
                $sort = "id_assignment ASC";
                break;

            default:
                break;
        }
        $json2 = $myData->select($select, $table, "all", $sort, "", "");
        $result = "1";
        break;
    case "update" :
        $myInput = array(id_employee => $employee, id_assignment => $assignment);
        $result = $myData->update($myInput, "id_payroll=" . $id, $table);
        break;
    case "insert" :
        $myInput = array(id_employee => $employee, id_assignment => $assignment);
        $result = $myData->insert($myInput, $table);
        break;
    case "delete" :
        $result = $myData->delete("id_payroll=" . $id, $table);
        break;
    default :
        $xml = "no action";
}

if ($result == "1") { // check for the result, and read the xml.
    if (isset($json2)){
        $json = $json2;
    }else{
        $json = $myData->select("", $view, "all", "employee ASC", "", "");
    }
} else {
    $json = '{"result":"error"}';
}

echo $json;
?>