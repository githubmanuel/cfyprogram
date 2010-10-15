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

require(PATH_site . "core/conf/global.php");

class Db {

    /**
     * Connects to mysql and check if the table is existing
     * @return void
     * @access public
     */
    function connect() {

        $connect = mysql_connect($GLOBALS["CORE"]["system"]["db_host"], $GLOBALS["CORE"]["system"]["db_username"], $GLOBALS["CORE"]["system"]["db_password"]);
        $select_db = mysql_select_db($GLOBALS["CORE"]["system"]["db_name"], $connect);
        if (!$connect) {
            $errno = mysql_errno();
            switch ($errno) {
                case 1045 : {
                        $this->error();
                        break;
                    }
            }
        } elseif (!$select_db) {
            $this->error();
            break;
        }
    }

    /**
     * Displays the html in the page with mysql error
     * @return void
     * @access private
     */
    function error() {
        echo "<div style='width:350;margin:auto;text-align:center;font-family:Arial'>
			     <span style='font-size:15px;color:red'>MYSQL SERVER ERROR : " . mysql_error() . "</span>
			  </div>";
        echo "<div style='width:350;margin:auto;text-align:center;margin-top:10px;font-family:Arial'>
				 You must edit first the <b>config.php</b> file and input your correct MySQL account, this file 
				 is located under this <b>login</b> folder.
				 <p>Note: if  the database TABLE doesn't exist this module will automatically create one.</p>
				 <p>After done editing the config.php try to refresh this page</p>.
			  </div>";
        die();
    }

}

?>  