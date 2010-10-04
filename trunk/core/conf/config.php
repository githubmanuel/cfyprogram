<?php
/*

CFY program - CFY Business Management Suite

Integrated enterprise applications to execute and optimize business and IT strategies. Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

Version: 0.0.0.1a
Author: Ernesto La Fontaine
License: New BSD License (see docs/license.txt)

File: config
Commnents: Configuration file.

*/

// System variable
$CORE["system"]["site_url"] 	= "http://pajarraco.homeip.net/cfyprogram";

// DB variables
$CORE["system"]["db_host"] 		= "localhost";
$CORE["system"]["db_name"]		= "cfy_base";
$CORE["system"]["db_username"] 	= "cfyadmin";
$CORE["system"]["db_password"] 	= "yGZUWc2rJ9PmJxhv";



// Style variable
$CORE["style"]["name"] = "base";




/* Ajax Login Module v1.1*/

/* If login successful then it will redirect to */
  define('SUCCESS_LOGIN_GOTO'   ,'');
  
  /* if the defined table in USERS_TABLE_NAME doesn't exist in the Database,
   * this module  will attempt to create.
   */
  define('USERS_TABLE_NAME','app_members');
  
   
    /* Advance Configuration - no need to edit this section */
  define('AJAX_TIMEOUT',        '10000000');
  define('AJAX_TARGET_ELEMENT', 'ajax_target');
  define('AJAX_WAIT_TEXT',      'Please wait...');
  define('AJAX_FORM_ELEMENT',   'ajax_form');
  define('AJAX_WAIT_ELEMENT',   'ajax_wait');
  define('AJAX_NOTIFY_ELEMENT', 'ajax_notify');
  
?>
