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

define('PATH_site', str_replace("/core/bin", "/", dirname(PATH_thisScript)));


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

$username = "";
if (isset($_GET['username'])) {
    $username = mysql_escape_string(substr(trim($_GET['username']), 0, 255));
}

$password = "";
if (isset($_GET['password'])) {
    $password = mysql_escape_string(substr(trim($_GET['password']), 0, 255));
}

$recive = "";
if (isset($_GET['recive'])) {
    $recive = mysql_escape_string(substr(trim($_GET['recive']), 0, 255));
}

$msg = "";
if (isset($_GET['msg'])) {
    $msg = mysql_escape_string(substr(trim($_GET['msg']), 0, 255));
}
$lastId = "";
if (isset($_GET['lastId'])) {
    $lastId = mysql_escape_string(substr(trim($_GET['lastId']), 0, 255));
}

switch ($action) {
    case "login" :
        $where = "username = '" .$username. "' and password = '" . $password . "' ";
        $xml = $myData->select("username", "core_user", $where, "", "", "");
        break;

    case "online" :
        $myInput = array(online => "CURRENT_TIMESTAMP");
        $xml = $myData->update($myInput, "username='" . $username . "'", "core_user");
        break;

    case "getuser" :
        $xml = $myData->select("username", "core_user", "all", "username ASC", "", "");
        break;

    case "getsection" :
        
        $where = " ( `from` = '" . $username . "' and `to` = '" . $recive . "') or ( `from` = '" . $recive . "' and `to` = '" . $username . "') ";
        if (isset($lastId)){
            $where .= " AND id > '" . $lastId . "' ";
        }
        $xml = $myData->select("", "core_chat", $where, "id ASC", "", "");
        $myInput = array(recd => "1");
        $myData->update($myInput, " `from` ='" . $recive . "' and `to`='" . $username . "'", "core_chat");
        break;

    case "sendmessage" :
        $mymInput = array('`from`' => $username, '`to`' => $recive, '`message`' => $msg);
        $xml = $myData->insert($mymInput, "core_chat");
        break;

    case "updateusers" :
        $where = " `to` = '" . $username . "' ";
        $xml = $myData->select(" min(recd) as recd, `from` ", "core_chat", $where, "", "`from`", "");
        break;

    default :
        $xml = "1";
}
$xml .= "</search-results>";
echo $xml;
?>