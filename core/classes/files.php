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
	
	function set_style($file, $url, $content_page, $style_name){ // apply style to a style page
		$myMenu = new Menu();


                // get contents of a file into a string
                $filename = '../../styles/'.$style_name.'/style.html';
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                fclose($handle);

                // fix the url for the style css
                $css_line = str_replace('link href="', 'link href="'.$url.'/styles/'.$style_name.'/', $contents);
		// replace the tag line
                $head_line = str_replace('--head--', $myMenu->set_head_menu(), $css_line);
                $menu_line = str_replace('--menu--', $myMenu->set_menu($content_page) , $head_line);
                $content_line = str_replace('--content--<h1>Sample Content</h1><section><h2>This is only for testing</h2><p>Do not change the content of this file.</p><p><a  href="core/bin/style.php">Aplicar Estilo</a></p></section>--end content--', '<?php echo $CORE["page"]["content"]; ?> ' , $menu_line);
		$footer_line = str_replace('--footer--', $myMenu->set_footer_menu() , $content_line);

                // put the new content into the files
                $fr = fopen('../conf/'.$file, 'c');
                fwrite($fr, $footer_line);
		fclose($fr);	
	}

        function set_content($content_page){

                $filename = $content_page.'/bin/'.$content_page.'.php';
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                fclose($handle);

                return $contents;
        }
}

?>