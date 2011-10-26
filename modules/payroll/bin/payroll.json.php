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
$name = "";
if (isset($_GET['name'])) {
    $name = mysql_escape_string(substr(trim($_GET['name']), 0, 255));
}
$position = "";
if (isset($_GET['position'])) {
    $position = mysql_escape_string(substr(trim($_GET['position']), 0, 255));
}
$started_date = "";
if (isset($_GET['started_date'])) {
    $started_date = mysql_escape_string(substr(trim($_GET['started_date']), 0, 255));
}
$income = "";
if (isset($_GET['income'])) {
    $income = mysql_escape_string(substr(trim($_GET['income']), 0, 255));
}
$period = "";
if (isset($_GET['period'])) {
    $period = mysql_escape_string(substr(trim($_GET['period']), 0, 255));
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
        $myInput = array(name => $name, position => $position, started_date => $started_date, income => $income, period => $period);
        $result = $myData->update($myInput, "id_payroll=" . $id, $table);
        break;
    case "insert" :
        $myInput = array(name => $name, position => $position, started_date => $started_date, income => $income, period => $period);
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
        $json = $myData->select("", $view, "all", "id_payroll ASC", "", "");
    }
} else {
    $json = '{"result":"error"}';
}

echo $json;
?>