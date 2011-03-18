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

  File:
  Commnents:

 */

require_once (PATH_site . "core/conf/global.php");

class Apply_Style {

    function set_style($file, $style_file) { // apply style to a style page
        $contents = '';
        // get contents of a file into a string
        $filename = $style_file;
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);

        // fix the url for the style css
        $contents = str_replace('link href="', 'link href="' . $GLOBALS["CORE"]["system"]["site_url"] . 'styles/' . $GLOBALS["CORE"]["style"]["name"] . '/', $contents);
        // replace the tag line
        $contents = str_replace('--head--', $this->set_head(), $contents);
        $contents = str_replace('--header--', '<company_name>'.$GLOBALS["CORE"]["system"]["company_name"].'</company_name>', $contents);
        $contents = str_replace('--module--<ul><li><a href="#">do not</a></li><li><a href="#">change</a></li><li><a href="#">this</a></li><li><a href="#">content</a></li></ul>--end module--', $this->set_module_menu(), $contents);
        $contents = str_replace('--menu--', '<?php if ($CORE["page"]["menu"]){echo $myMenu->printMenu($CORE["page"]["menu"]);} ?>', $contents);
        $contents = str_replace('--content--<h1>Sample Content</h1><section><h2>This is only for testing</h2><p>Do not change the content of this section.</p></section>--end content--', '<user>Usuario:&nbsp;<b><?php echo $_SESSION["MM_Username"]; ?></b></user><?php require_once(PATH_site.$CORE["page"]["content"]); ?>', $contents);
        $contents = str_replace('--footer--', $this->set_footer(), $contents);

        // put the new content into the files
        $fr = fopen($file, 'w');
        fwrite($fr, $contents);
        fclose($fr);
    }

    function set_head() {
        $head_menu  = '<script src="' . $GLOBALS["CORE"]["system"]["site_url"] . 'core/scripts/menu_bar.js" ></script>';
        $head_menu .= '<script src="' . $GLOBALS["CORE"]["system"]["site_url"] . 'core/scripts/jquery-1.4.4.js" ></script>';
        $head_menu .= '<script src="' . $GLOBALS["CORE"]["system"]["site_url"] . 'core/scripts/jquery.form.js" ></script>';
        $head_menu .= '<script src="' . $GLOBALS["CORE"]["system"]["site_url"] . 'core/scripts/general_function.js" ></script>';
        $head_menu .= '<link href="'  . $GLOBALS["CORE"]["system"]["site_url"] . 'core/css/menu_bar.css" rel="stylesheet" type="text/css" />';
        $head_menu .= '<?php require_once(PATH_site.$CORE["module"]["head_content"]); ?>';
        $head_menu .= '<?php require_once(PATH_site.$CORE["page"]["head_content"]); ?>';
        return $head_menu;
    }

    function set_footer() {
        $footer_menu = '<script type="text/javascript">';
        $footer_menu .= 'var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"' . $GLOBALS["CORE"]["system"]["site_url"] . 'core/image/MenuBarDownHover.gif", imgRight:"' . $GLOBALS["CORE"]["system"]["site_url"] . 'core/image/MenuBarRightHover.gif"});';
        $footer_menu .= '</script>';
        return $footer_menu;
    }

    function set_module_menu() {
        $module = '<ul>';
        $xml = simplexml_load_file(PATH_site . "core/conf/modules.xml");
        foreach ($xml->names as $item) {
            $GLOBALS["CORE"]["module"]["names"]["$item->id"] = $item->name;
            $module .= '<li>';
            $module .= '<a href="?pid=' . $item->id . '">' . $item->print . '</a>';
            $module .= '</li>';
        }
        $module .= '</ul>';
        return $module;
    }

}

?>