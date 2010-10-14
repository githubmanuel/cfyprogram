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

  File: logout.php
  Commnents: page use for close the user session.

 */

//initialize the session
if (!isset($_SESSION)) {
    session_start();
}

//to fully log out a visitor we need to clear the session varialbles
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
$_SESSION['PrevUrl'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
unset($_SESSION['PrevUrl']);

// go to page after logout
$logoutGoTo = "../../index.php"; // :TODO: use a global varible for this. 
if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
}
?>