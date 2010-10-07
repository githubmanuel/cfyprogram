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
require_once("core/conf/config.php");
require_once ("core/classes/menu.php");
$myMenu = new Menu();




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
        $module_name = 'payroll';
        break;
    case '4':
        $module_name = 'budget';
        break;
    default:
        $module_name = 'home';
		$page_name = 'login';
		$user_auth = false;
		require_once("core/classes/login_module.php");
   		$LoginModule = new LoginModule();
}

if($user_auth){
	require_once("core/bin/user_auth.php");
}


$CORE["page"]["content"] = 'modules/'.$module_name.'/bin/'.$page_name.'.php';
$CORE["page"]["menu"] = 'modules/'.$module_name.'/bin/menu.xml';
$CORE["page"]["menuid"] = 1; 
$style_filename = 'core/conf/style_apply.php';
require_once($style_filename);

?>