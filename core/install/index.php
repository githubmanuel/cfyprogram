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

  File: apply_style.php
  Commnents: file used for call the apply_style class.

 */
// *******************************
// Set error reporting
// *******************************

if (defined('E_DEPRECATED')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
} else {
    error_reporting(E_ALL ^ E_NOTICE);
}

define('PATH_thisScript', str_replace('//', '/', str_replace('\\', '/', (PHP_SAPI == 'cgi' || PHP_SAPI == 'isapi' || PHP_SAPI == 'cgi-fcgi') && ($_SERVER['ORIG_PATH_TRANSLATED'] ? $_SERVER['ORIG_PATH_TRANSLATED'] : $_SERVER['PATH_TRANSLATED']) ? ($_SERVER['ORIG_PATH_TRANSLATED'] ? $_SERVER['ORIG_PATH_TRANSLATED'] : $_SERVER['PATH_TRANSLATED']) : ($_SERVER['ORIG_SCRIPT_FILENAME'] ? $_SERVER['ORIG_SCRIPT_FILENAME'] : $_SERVER['SCRIPT_FILENAME']))));

define('PATH_site', str_replace("/core/install", "/", dirname(PATH_thisScript)));



require_once(PATH_site . 'core/classes/apply_style.php'); // class to apply the styles. see core/classes/apply_style.php for detail
require_once(PATH_site . 'core/conf/global.php');
require_once(PATH_site . 'core/classes/conf_var.php'); // Class for read xml menus and call pages

$myVar = new conf_var("core_module_var");

$setStyle = new Apply_Style();
$setStyle->set_style(PATH_site . 'core/conf/style_apply.php', PATH_site . 'styles/' . $CORE["style"]["name"] . '/style.html');

?>

El sistema se ha instalado con exito.<br />
<a href="<?php echo $CORE["system"]["site_url"]; ?>">Home</a>