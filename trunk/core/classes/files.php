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
class Files {
		
	function set_style($file, $url, $content_page, $style_name) { // apply style to a style page
		$contents = '';		
        // get contents of a file into a string
        $filename = '../../styles/'.$style_name.'/style.html';
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);

        // fix the url for the style css
        $contents = str_replace('link href="', 'link href="'.$url.'/styles/'.$style_name.'/', $contents);
        // replace the tag line
        $contents = str_replace('--head--', $this->set_head(), $contents);
        $contents = str_replace('--module--<ul><li><a href="#">do not</a></li><li><a href="#">change</a></li><li><a href="#">this</a></li><li><a href="#">content</a></li></ul>--end module--', $this->set_module_menu(), $contents);
        $contents = str_replace('--menu--', '<?php require($CORE["page"]["menu"]); ?>' , $contents);
        $contents = str_replace('--content--<h1>Sample Content</h1><section><h2>This is only for testing</h2><p>Do not change the content of this section.</p></section>--end content--', '<?php require($CORE["page"]["content"]); ?>' , $contents);
        $contents = str_replace('--footer--', $this->set_footer() , $contents);

        // put the new content into the files
        $fr = fopen('../conf/'.$file, 'w');
        fwrite($fr, $contents);
        fclose($fr);
    }
	function set_head() {
        $head_menu =  '<script src="core/scripts/menu_bar.js" type="text/javascript"></script>';
        $head_menu .= '<link href="core/css/menu_bar.css" rel="stylesheet" type="text/css" />';
		$head_menu .= '<link href="core/css/login.css" rel="stylesheet" type="text/css" />' ;
		$head_menu .= '<script type="text/javascript" src="core/scripts/jquery-1.3.2.min.js"></script>' ;
        return $head_menu;
    }

    function set_footer() {
        $footer_menu =  '<script type="text/javascript">';
        $footer_menu .= 'var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"core/image/MenuBarDownHover.gif", imgRight:"core/image/MenuBarRightHover.gif"});';
        $footer_menu .= '</script>';
        return $footer_menu;
    }
    function set_module_menu(){
        $module = '<ul>';
        $module .= '<li>';
        $module .= '<a href="?pid=1">Home</a>';
        $module .= '</li>';
        $module .= '<li>';
        $module .= '<a href="?pid=2">Administración</a>';
        $module .= '</li>';
        $module .= '<li>';
        $module .= '<a href="?pid=3">Presupuesto</a>';
        $module .= '</li>';
        $module .= '</ul>';
        return $module;
    }
}

?>