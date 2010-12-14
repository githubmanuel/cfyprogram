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

define('PATH_site', str_replace("/modules/home/bin", "/", dirname(PATH_thisScript)));

sleep(2);

$xmlheader = "";
$xmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$xmlheader .= "<update-result>";
echo $xmlheader;

require_once (PATH_site . 'modules/home/classes/dbquery.php');
$myData = new dbconnect();
$xml = "";

$id = "";
if (isset($_GET['id'])) {
    $id = mysql_escape_string(substr(trim($_GET['id']), 0, 255));
}
$print = "";
if (isset($_GET['print'])) {
    $print = mysql_escape_string(substr(trim($_GET['print']), 0, 255));
}
$status = "";
if (isset($_GET['status'])) {
    $status = mysql_escape_string(substr(trim($_GET['status']), 0, 255));
}

$myInput = array(print_name => $print, status => $status);

$result = $myData->update($myInput, "id=" . $id, "core_module_var");

if ($result == "1"){
    $xml = $myData->select("id", $sinput, "core_module_var", "", "", "id ASC");
}else{
    $xml = "error";
}

$xml .= "</update-result>";
echo $xml;
?>