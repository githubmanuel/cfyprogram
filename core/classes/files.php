<?php
/*

CFY program - CFY Business Management Suite

Integrated enterprise applications to execute and optimize business and IT strategies. Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

Version: 0.0.0.1a
Author: Ernesto La Fontaine
License: New BSD License (see docs/license.txt)

File: files.php
Commnents: class for handle the files

*/
include 'menu.php';

class Files
{
 	function check_file_exists($url){ // check if file exist
		$f=@fopen($url,'r');
		if($f){
			fclose($f);
			return true;
		}
	return false;
	}
	
	function set_style($file, $url, $style_name){ // apply style to a style page
		$myMenu = new Menu();
		$lines = file($url.'/styles/'.$style_name.'/style.html');
		$fr = fopen('../conf/'.$file, 'w');
		foreach ($lines as $line_num => $line) {
			$css_line = str_replace('link href="', 'link href="'.$url.'/styles/'.$style_name.'/', $line);
			$head_line = str_replace('--head--', $myMenu->set_head_menu(), $css_line);
			$menu_line = str_replace('--menu--', $myMenu->set_menu() , $head_line);
			$footer_line = str_replace('--footer--', $myMenu->set_footer_menu() , $menu_line);
			fwrite($fr, $footer_line);
		}
		fclose($fr);	
	}
}

?>