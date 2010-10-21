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

define('PATH_thisScript', str_replace('//', '/', str_replace('\\', '/', (PHP_SAPI == 'cgi' || PHP_SAPI == 'isapi' || PHP_SAPI == 'cgi-fcgi') && ($_SERVER['ORIG_PATH_TRANSLATED'] ? $_SERVER['ORIG_PATH_TRANSLATED'] : $_SERVER['PATH_TRANSLATED']) ? ($_SERVER['ORIG_PATH_TRANSLATED'] ? $_SERVER['ORIG_PATH_TRANSLATED'] : $_SERVER['PATH_TRANSLATED']) : ($_SERVER['ORIG_SCRIPT_FILENAME'] ? $_SERVER['ORIG_SCRIPT_FILENAME'] : $_SERVER['SCRIPT_FILENAME']))));

define('PATH_site', str_replace("/modules/home/bin", "/", dirname(PATH_thisScript)));

sleep(5);

$xmlheader = "";
$xmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$xmlheader .= "<result>";
echo $xmlheader;

require_once (PATH_site . 'modules/home/classes/dbconnect.php');
$myData = new dbconnect();
$xml = "";

$username = "";
if (isset($_GET['username'])) {
    $username = mysql_escape_string(substr(trim($_GET['username']), 0, 255));
}
$password = "";
if (isset($_GET['password'])) {
    $password = mysql_escape_string(substr(trim($_GET['password']), 0, 255));
}
$level = "";
if (isset($_GET['level'])) {
    $level = mysql_escape_string(substr(trim($_GET['level']), 0, 255));
}
$creation_date = "";
if (isset($_GET['creation_date'])) {
    $creation_date = mysql_escape_string(substr(trim($_GET['creation_date']), 0, 255));
}
$status = "";
if (isset($_GET['status'])) {
    $status = mysql_escape_string(substr(trim($_GET['status']), 0, 255));
}

$myInput = array(password=>$password, level=>$level, creation_date=>$creation_date, status=>$status);

$xml = $myData->update($myInput, "username='".$username."' " , "core_user");

$xml .= "</result>";
echo $xml;
?>
