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
 
 ?>
<script type="text/javascript">
       $(document).ready(function() { 
           formLogin();
           function	formLogin() {
                $("#logincontainer").fadeIn();
				var options = { 
                    target       :  '.<?php echo AJAX_TARGET_ELEMENT; ?>',
                    timeout      :    <?php echo AJAX_TIMEOUT;?>,    
                    beforeSubmit :   request,  
                    success      :   response  
                }; 
               $('.<?php echo AJAX_FORM_ELEMENT;?>').submit(function() {  $(this).ajaxSubmit(options); return false;});   
                function request(formData, jqForm, options) { 
                    valid = true;
                    $('.<?php echo AJAX_WAIT_ELEMENT; ?>').hide();
                    var label = "<span class='ajax_spinner'><img src='core/image/ispinner.gif'/><?php echo AJAX_WAIT_TEXT;?></span>";
                    $(".<?php echo AJAX_WAIT_ELEMENT; ?>").after(label);
                    $('.<?php echo AJAX_NOTIFY_ELEMENT; ?>').hide();						
                    if(valid) {
                      return true;
                    } else { 
                     $('.<?php echo AJAX_WAIT_ELEMENT; ?>').show();
					 $('.ajax_spinner').fadeOut();
					 $(".ajax_spinner").remove();
					 $('.<?php echo AJAX_NOTIFY_ELEMENT; ?>').fadeIn(); 
                      return false;
                    } 
                } 
                function response(responseText, statusText) {
				   $('.<?php echo AJAX_WAIT_ELEMENT; ?>').show();
                   $('.ajax_spinner').fadeOut();
				   $(".ajax_spinner").remove();	
				 }
            }		
        }); 		
 </script>