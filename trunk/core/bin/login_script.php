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

  File: login_script.php
  Commnents: script use for login module.

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
require(PATH_site . "core/conf/config.php");
?>
<script type="text/javascript">
    $(document).ready(function() {
        formLogin();
        function formLogin() {
            $("#logincontainer").fadeIn();
            var options = {
                target       :  ".<?php echo $CORE["login"]["ajax_target_element"]; ?>",
                timeout      :    <?php echo $CORE["login"]["ajax_timeout"]; ?>,
                beforeSubmit :   request,
                success      :   response
            };
            $(".<?php echo $CORE["login"]["ajax_form_element"]; ?>").submit(function() {  $(this).ajaxSubmit(options); return false;});
            function request(formData, jqForm, options) {
                valid = true;
                $(".<?php echo $CORE["login"]["ajax_wait_element"]; ?>").hide();
                var label = "<span class='ajax_spinner'><img src='<?php echo $CORE["system"]["site_url"]; ?>core/image/ispinner.gif'/><?php echo $CORE["login"]["ajax_wait_text"]; ?></span>";
                $(".<?php echo $CORE["login"]["ajax_wait_element"]; ?>").after(label);
                $(".<?php echo $CORE["login"]["ajax_notify_element"]; ?>").hide();
                if(valid) {
                    return true;
                } else {
                    $(".<?php echo $CORE["login"]["ajax_wait_element"]; ?>").show();
                    $(".ajax_spinner").fadeOut();
                    $(".ajax_spinner").remove();
                    $(".<?php echo $CORE["login"]["ajax_notify_element"]; ?>").fadeIn();
                    return false;
                }
            }
            function response(responseText, statusText) {
                $(".<?php echo $CORE["login"]["ajax_wait_element"]; ?>").show();
                $(".ajax_spinner").fadeOut();
                $(".ajax_spinner").remove();
            }
        }
    });
</script>