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


class Db{
/**
 * Connects to mysql and check if the table is existing
 * @return void
 * @access public
 */ 	
	function connect() {
		include ("core/conf/config.php");
    	$connect      = mysql_connect($CORE["system"]["db_host"], $CORE["system"]["db_username"], $CORE["system"]["db_password"]);
	   	$select_db    = mysql_select_db($CORE["system"]["db_name"], $connect); 
		if (!$connect) {
			$errno  = mysql_errno();
		   	switch($errno) {
		    	case 1045 : { 
					$this->error(); 
					break; 
				}
		    }
		}
		elseif(!$select_db) { 
			$this->error(); 
			break;
		}
		
		$strSQL = "SELECT * from ".$CORE["login"]["user_table_name"]." limit 1";
        $result = mysql_query ($strSQL); 
		if($result == null) {
		   $this->create_table($CORE["login"]["user_table_name"]);
		   die();
		}
    }
/**
 * Displays the html in the page with mysql error
 * @return void
 * @access private
 */    
   	function error() {
    	echo "<div style='width:350;margin:auto;text-align:center;font-family:Arial'>
			     <span style='font-size:15px;color:red'>MYSQL SERVER ERROR : ".mysql_error()."</span> 	
			  </div>";
		echo "<div style='width:350;margin:auto;text-align:center;margin-top:10px;font-family:Arial'>
				 You must edit first the <b>config.php</b> file and input your correct MySQL account, this file 
				 is located under this <b>login</b> folder.
				 <p>Note: if  the database TABLE doesn't exist this module will automatically create one.</p>
				 <p>After done editing the config.php try to refresh this page</p>.
			  </div>";	  
	    die();
   	}
/**
 * Creates table in the database that defined in USERS_TABLE_NAME  
 * @return void
 * @access private
 */     
	function create_table($table_name) {
    	$strSQL =	"CREATE TABLE IF NOT EXISTS `" . $table_name . "` (
  					`username` varchar(15) NOT NULL,
  					`password` varchar(15) NOT NULL,
  					`level` int(11) NOT NULL,
  					`creation_date` datetime NOT NULL,
  					`status` int(11) NOT NULL,
  					PRIMARY KEY (`username`)
					) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

      $result = mysql_query ($strSQL); 
	  $strSQL = "INSERT INTO `" . $table_name."` (`username`,`password`,`level`,`creation_date`,`status `) VALUES ('admin','juan316', 0, NOW(), 0);";
	  $result = mysql_query ($strSQL); 
	  if(!$result) {
		   die("Couldn't connect to mysql hostname, Please check your configuration");
		}
	  echo ('<meta http-equiv="refresh" content="0;">');
   } 
 }  
?>  