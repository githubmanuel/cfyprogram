<?php
/*

CFY program - CFY Business Management Suite

Integrated enterprise applications to execute and optimize business and IT strategies. Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

Version: 0.0.0.1a
Author: Ernesto La Fontaine
License: New BSD License (see docs/license.txt)

File: index.php
Commnents: Startup file.

*/
?>
<?php
include("core/conf/config.php");


$pid = '';
$style_filename = '';
$module_name = '';
$page_name = 'index';
$user_auth = true;

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}

switch ($pid) {
    case '1':
        $module_name = 'home';
        break;
	case '1-1':
        $module_name = 'home';
		$page_name = 'setting';
        break;
    case '2':
        $module_name = 'admin';
        break;
    case '3':
        $module_name = 'budget';
        break;
    default:
        $module_name = 'home';
		$page_name = 'login';
		$user_auth = false;
		include("core/classes/ajaxLoginModule.class.php");
   		$ajaxLoginModule = new ajaxLoginModule();
}

if($user_auth){
	include("core/bin/user_auth.php");
}
$CORE["page"]["content"] = 'modules/'.$module_name.'/bin/'.$page_name.'.php';
$CORE["page"]["menu"] = 'modules/'.$module_name.'/bin/menu.php';
$style_filename = 'core/conf/style_apply.php';
require($style_filename);

?>