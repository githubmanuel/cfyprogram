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
include "core/classes/files.php";

$pid = 0;
$style_filename = '';
$myContent = new Files();

if (isset($_GET['pid'])){
    $pid = $_GET['pid'];
}

switch ($pid) {
    case 1:
        echo "i equals 0";
        break;
    case 2:
        echo "i equals 1";
        break;
    case 3:
        echo "i equals 2";
        break;
    default:
        $style_filename = 'core/conf/style_apply.php';
        $CORE["page"]["content"] = $myContent->set_content('setting');
        require($style_filename);
}




?>