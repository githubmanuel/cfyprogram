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

  File: index.php
  Commnents: Startup file.

 */
?>
<?php

require_once(PATH_site . "core/conf/global.php"); // Global varibles
require_once(PATH_site . "core/classes/menu.php"); // Class for read xml menus and call pages
$myMenu = new Menu();

$pid = 0; // page ID, used to call pages
$module_name = NULL; // name of the module used
$user_auth = TRUE; // asing security to the page


if (isset($_GET['pid'])) { // asing page ID form url varible
    $pid = $_GET['pid'];
}

if ($pid == 0) { // on ID 0, call the login page
    $module_name = 'login';
    $page_name = 'login.php';
    $user_auth = FALSE;
    require_once(PATH_site . "core/classes/login_module.php"); // class that create the login screen
    $LoginModule = new LoginModule();
} else {  // for any other ID call the class menu to asing the page
    $module_name = $myMenu->getModuleName($pid); // get the name of the module called
    $page_name = $myMenu->getPageName($pid, 'modules/' . $module_name . '/conf/menu.xml'); // get the page called
}
if ($user_auth) { // check for user session open
    require_once(PATH_site . "core/bin/user_auth.php");
}


$CORE["page"]["content"] = 'modules/' . $module_name . '/bin/' . $page_name; // path to the content page
$CORE["page"]["menu"] = 'modules/' . $module_name . '/conf/menu.xml'; // path tho the xml menu
$CORE["module"]["head_content"] = 'modules/' . $module_name . '/conf/config.php';
$CORE["page"]["head_content"] = $CORE["module"]["head_content"];
if (file_exists('modules/' . $module_name . '/conf/config_' . $page_name)) {
    $CORE["page"]["head_content"] = 'modules/' . $module_name . '/conf/config_' . $page_name;
}

require_once(PATH_site . 'core/conf/style_apply.php'); // call the style file create
?>