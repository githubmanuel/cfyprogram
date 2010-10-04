<?php
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
include('db.php');

class ajaxLoginModule  {
	
	private $timeout         = null;
	private $target_element  = null;
	private $wait_text       = null;
	private $form_element    = null;
	private $wait_element    = null;
	private $notify_element  = null;

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
		 return "<script type='text/javascript' src='core/scripts/jquery-1.3.2.min.js'></script>";
	}
/**
 * Gets the included php-jscript file and load to page.
 * @return void
 * @access public
 */ 		
  	function getScript() { 
	 	include ('core/bin/login_script.php');
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
		 	$strSQL = "SELECT * FROM " . USERS_TABLE_NAME . "
					   WHERE username ='$username' AND password = '$password'"; 
			$result  = mysql_query ($strSQL); 
			$row     = mysql_fetch_row($result);
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
    	echo "<script>$('." . AJAX_NOTIFY_ELEMENT . "').fadeIn();</script>";
  	}
/**
 * Used for redirecting page that defined in SUCCESS_LOGIN_GOTO 
 * @return void
 * @access private
 */    
  	function jscript_location() {
    	$this->set_session();
    	echo "<script> $('#logincontainer').fadeOut();window.location.href='" . SUCCESS_LOGIN_GOTO . "'</script>";
  	}
/**
 * Sets the session if successful login
 * @return void
 * @access private
 */    
  	function set_session() {
      	session_start();
	  	$_SESSION['is_successful_login'] = true;
  	}  	 
	  
}  
?>  