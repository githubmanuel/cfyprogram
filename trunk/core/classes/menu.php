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

class Menu
{
 	function set_menu($page){ // check if file exist
		$menu =  '<ul id="MenuBar1" class="MenuBarHorizontal">';
 		$menu .= ' <li class="border"><a href="../index.php">Pricipal</a></li>';
 		$menu .= '<li class="border"><a class="MenuBarItemSubmenu" href="#">Ventas</a>';
 		$menu .= '  <ul>';
 		$menu .= '    <li><a href="../clientes.php">Clientes</a></li>';
  		$menu .= '    <li><a href="../presupuesto.php">Presupuesto</a></li>';
  		$menu .= '  </ul>';
 		$menu .= ' </li>';
 		$menu .= ' <li class="border"><a class="MenuBarItemSubmenu" href="#">Archivos</a>';
 		$menu .= '   <ul>';
 		$menu .= '     <li><a href="../cargar_archivo.php">Cargar Archivo</a></li>';
 		$menu .= '     <li><a href="../muebles.php">Muebles</a></li>';
 		$menu .= '     <li><a href="../materiales.php">Materiales</a></li>';
  		$menu .= '    <li><a href="../accesorios.php">Accesorios</a></li>';
  		$menu .= '  </ul>';
 		$menu .= ' </li>';
 		$menu .= ' <li class="border"><a class="MenuBarItemSubmenu" href="#">Configuración</a>';
 		$menu .= '   <ul>';
		$menu .= '     <li><a href="../gastos.php" >Gastos</a></li>';
 		$menu .= '     <li><a href="../proyecciones.php" >Proyecciones</a></li>';
 		$menu .= '     <li><a href="../utilidad.php">Utilidad</a></li>';
 		$menu .= '     <li><a href="../usuarios.php">Usuarios</a></li>';
 		$menu .= '   </ul>';
 		$menu .= ' </li>';
 		$menu .= ' <li class="border"><a href="../ayuda.php">Ayuda</a></li>';
		$menu .= '  <li class="border_last"><a href="#">Salir</a></li>';
		$menu .= '</ul>';
		return $menu;
	}
	
	function set_head_menu(){
		$head_menu =  '<script src="core/scripts/menu_bar.js" type="text/javascript"></script>';
		$head_menu .= '<link href="core/css/menu_bar.css" rel="stylesheet" type="text/css" />';
		return $head_menu;
	}

	function set_footer_menu(){
		$footer_menu =  '<script type="text/javascript">';
		$footer_menu .= 'var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"core/image/MenuBarDownHover.gif", imgRight:"core/image/MenuBarRightHover.gif"});';
		$footer_menu .= '</script>';
		
		return $footer_menu;
	}
}

?>