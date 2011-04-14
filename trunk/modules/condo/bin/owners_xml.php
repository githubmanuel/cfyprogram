<?php

header('Content-Type: text/xml');
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

define('PATH_site', str_replace("/modules/condo/bin", "/", dirname(PATH_thisScript)));


//sleep(2);

$xmlheader = "";
$xmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$xmlheader .= "<search-results>";
echo $xmlheader;

require_once (PATH_site . 'core/classes/dbquery.php');
$myData = new dbconnect();
$xml = "";

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

$table = "co_owners";

switch ($action) {
    case "open" :
        $result = "1";
        break;
    case "update" :
        $myInput = array(name => $name);
        $result = $myData->update($myInput, "id=" . $id, $table);
        break;
    case "insert" :
        $myInput = array(id => $id, name => $name);
        $result = $myData->insert($myInput, $table);
        break;
    case "delete" :
        $result = $myData->delete("id=" . $id, $table);
        break;
    default :
        $xml = "no action";
}

if ($result == "1") { // check for the result, and read the xml.
    $xml = $myData->select("", $table, "all", "id_owners ASC", "", "");
} else {
    $xml = "error";
}

$xml .= "</search-results>";
echo $xml;
?>