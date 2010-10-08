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

File: 
Commnents: 

some modification on the original files

-- Original --

/**
 * Ajax Login Module v1.1
 *
 * Ajax Login Module is a nice Php-AJAX Login used to authenticate users without reloading a login page.
 * Easy to integrate with your existing php applications with no further configuration and coding.
 *
 *
 * @copyright     Copyright 2009, Christopher M. Natan
 * @link          http://phpstring.co.cc/phpclasses/modules/ajax-login-module/
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @email         chris.natan@gmail.com
 *
 * Dual licensed under the MIT and GPL licenses.
 * Redistributions of files must retain the above copyright notice.
 */

/**
 * include the db class
 */ 
 
//sleep(2); //for testing ajax effects

require_once("db.php");
require_once("core/conf/config.php");

class LoginModule  {
	
	private $userGroup = NULL;
	
/**
 * Loads the configuration and initialize the DB class
 * $this->is_login(); checks if the hml form is submitted
 */    
  	function __construct() { 
		$msql  = new Db;
		$msql->connect();
		$this->is_login();
  	}
/**
 * Returns with the jquery location
 * @return string
 * @access public
 */ 	 
	function initJquery() { 
		 return '<script type="text/javascript" src="core/scripts/jquery-1.3.2.min.js"></script>';
	}
/**
 * Gets the included php-jscript file and load to page.
 * @return void
 * @access public
 */ 		
  	function getScript() { 
	 	require_once ("core/bin/login_script.php");
  	}
/**
 * Checks if form is submitted and then submit query to database
 * @return void
 * @access private
 */ 	
	function is_login() {
		if(isset($_POST['username']))  {
			$username   = $_POST['username'];
		 	$password   = $_POST['password'];
			if (isset($_GET['accesscheck'])){
				$GLOBALS["CORE"]["login"]["success_login_goto"] = $_GET['accesscheck'];
			}
		 	$strSQL = "SELECT * FROM ".$GLOBALS["CORE"]["login"]["user_table_name"]."
					   WHERE username ='$username' AND password = '$password'"; 
			$result  = mysql_query ($strSQL); 
			$row     = mysql_fetch_row($result);
			$this->userGroup = $row[2];
			$exist   = count($row);
			if($exist >= 2) {
				
				$this->jscript_location();  
			} 
			else { 
				$this->notify_show();
			}
			exit;		
	  	}   
	}
/**
 * Echos this jquery code to page.This is used for displaying html tag defined in AJAX_NOTIFY_ELEMENT  
 * @return void
 * @access private
 */   
  	function notify_show() {
    	echo '<script>$(".'.$GLOBALS["CORE"]["login"]["ajax_notify_element"].'").fadeIn();</script>';
  	}
/**
 * Used for redirecting page that defined in SUCCESS_LOGIN_GOTO 
 * @return void
 * @access private
 */    
  	function jscript_location() {
    	$this->set_session();
    	echo '<script> $("#logincontainer").fadeOut();window.location.href="'.$GLOBALS["CORE"]["login"]["success_login_goto"].'"</script>';
  	}
/**
 * Sets the session if successful login
 * @return void
 * @access private
 */    
  	function set_session() {
      	session_start();
		$_SESSION['MM_Username'] = $_POST['username'];
		$_SESSION['MM_UserGroup'] = $this->userGroup;
  	}  	 
	  
}  
?>
