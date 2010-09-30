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

require("core/conf/config.php");

$pid = 0;
$style_filename = '';
$module_name = '';

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}

switch ($pid) {
    case 1:
        $module_name = 'home';
        break;
    case 2:
        $module_name = 'admin';
        ;
        break;
    case 3:
        $module_name = 'budget';
        break;
    default:
        $module_name = 'setting';
        ;
}

$CORE["page"]["content"] = 'modules/'.$module_name.'/bin/index.php';
$CORE["page"]["menu"] = 'modules/'.$module_name.'/bin/menu.php';
$style_filename = 'core/conf/style_apply.php';
require($style_filename);

?>