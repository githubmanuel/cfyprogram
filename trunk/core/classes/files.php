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
require('menu.php');

class Files {

    function check_file_exists($url) { // check if file exist
        $f=@fopen($url,'r');
        if($f) {
            fclose($f);
            return true;
        }
        return false;
    }

    function set_style($file, $url, $content_page, $style_name) { // apply style to a style page
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
        $module_line = str_replace('--module--<ul><li><a href="#">do not</a></li><li><a href="#">change</a></li><li><a href="#">this</a></li><li><a href="#">content</a></li></ul>--end module--', $myMenu->set_module_menu(), $head_line);
        $menu_line = str_replace('--menu--', '<?php require($CORE["page"]["menu"]); ?>' , $module_line);
        $content_line = str_replace('--content--<h1>Sample Content</h1><section><h2>This is only for testing</h2><p>Do not change the content of this section.</p></section>--end content--', '<?php require($CORE["page"]["content"]); ?>' , $menu_line);
        $footer_line = str_replace('--footer--', $myMenu->set_footer_menu() , $content_line);

        // put the new content into the files
        $fr = fopen('../conf/'.$file, 'c');
        fwrite($fr, $footer_line);
        fclose($fr);
    }
}

?>