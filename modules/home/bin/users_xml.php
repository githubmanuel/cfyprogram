<?php

header('Content-Type: text/xml');
/*

  CFY program - CFY Business Management Suite

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

sleep(2);
$xmlheader = "";
$xmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$xmlheader .= "<search-results>";
echo $xmlheader;

require_once ('../classes/dbconnect.php');
$myData = new dbconnect();
$xml = "";

$sinput = "";
if (isset($_GET['sinput'])) {
    $sinput = mysql_escape_string(substr(trim($_GET['sinput']), 0, 255));
}

$xml = $myData->select("username", $sinput, "core_user");
$xml .= "</search-results>";
echo $xml;
?>