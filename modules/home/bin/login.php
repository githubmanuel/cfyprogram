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

File: index.php
Commnents: Startup file.

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


?>

<div id="login_body">
  <div id="logincontainer" style="display:none;">
    <div class="logintitle">Ingreso al sistema</div>
    <form method="post" class="ajax_form">
      <ul class="login">
        <li class="loginlabel">Usuario</li>
        <li class="loginfield">
          <input name="username" type="text" class="text" />
        </li>
        <li class="loginlabel">Clave</li>
        <li class="loginfield">
          <input name="password" type="password" class="text"/>
        </li>
        <li class="loginlabel"> </li>
     	<li class="loginfield"> <img src="core/image/isubmit.jpg" class="submit" onclick="$('.<?php echo $CORE["login"]["ajax_form_element"]; ?>').submit();"/>
        <input name="submit" type="submit" style="display:none" />
        </li>
<li class="invalid_message">
        <div class="ajax_notify" style="display:none; clear:both"> 
          Error : Invalid username or password. Please try again.
          <!--don't delete this div class="ajax_notify"-->
        </div>
      </li>
      <li class="label status"> 
        <span class="ajax_wait">
        <!--don't delete this span class="ajax_wait"-->
        </span> </li>
    </ul>
      <div class="ajax_target" style="display:none" > 
        <!--don't delete this div class="ajax_target" --> 
      </div>
    </form>
    <?php 
   echo $LoginModule->getScript();
 ?>
  </div>
  <div class="default">Default username: admin / password: juan316</div>
</div>
