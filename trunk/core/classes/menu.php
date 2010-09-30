<?php
/*

CFY program - CFY Business Management Suite

Integrated enterprise applications to execute and optimize business and IT strategies. Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

Version: 0.0.0.1a
Author: Ernesto La Fontaine
License: New BSD License (see docs/license.txt)

File: menu.php
Commnents: class for handle the menu

*/

class Menu {

    function set_head_menu() {
        $head_menu =  '<script src="core/scripts/menu_bar.js" type="text/javascript"></script>';
        $head_menu .= '<link href="core/css/menu_bar.css" rel="stylesheet" type="text/css" />';
        return $head_menu;
    }

    function set_footer_menu() {
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
        $module .= '<li>';
        $module .= '<a href="?pid=0">Configuración</a>';
        $module .= '</li>';
        $module .= '</ul>';
        return $module;
    }
}

?>