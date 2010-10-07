<?php
/*

CFY program - CFY Business Management Suite

Integrated enterprise applications to execute and optimize business and IT strategies. Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

Version: 0.0.0.1a
Author: Ernesto La Fontaine
License: New BSD License (see docs/license.txt)

File: menu.php
Commnents: class for handle the menues

*/

//require_once ("../conf/config.php");

class Menu{
	
	private $menu = NULL;
	private $inTag = NULL;
	private $depth = NULL;
	private $closeTag = NULL;
	private $menupid = NULL;
	private $moduleid = NULL;
	
	function printMenu($file, $mid){
		
		$this->moduleid = $mid;
		
		$xml_parser = xml_parser_create();
		xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($xml_parser, XML_OPTION_SKIP_WHITE, 1);
		xml_set_processing_instruction_handler($xml_parser, array($this, "pi_handler"));
		xml_set_default_handler($xml_parser, array ($this, "parseDEFAULT"));
		xml_set_element_handler($xml_parser, array ($this, "startElement"), array ($this, "endElement"));
		xml_set_character_data_handler($xml_parser, array ($this, "contents"));
		
		if (!($fp = fopen($file, "r"))) {
			if (!xml_parse($xml_parser, $data, feof($fp))) {
			   die( sprintf("XML error: %s at line %d",
									xml_error_string(xml_get_error_code($xml_parser)),
									xml_get_current_line_number($xml_parser)));
			}
		}
		while ($data = fread($fp, 4096)) {
			if (!xml_parse($xml_parser, $data, feof($fp))) {
			   die( sprintf("XML error: %s at line %d",
									xml_error_string(xml_get_error_code($xml_parser)),
									xml_get_current_line_number($xml_parser)));
			}
		}
		xml_parser_free($xml_parser);
			
		return $this->menu;
			
	}
	
	function startElement($parser, $name, $attrs) {

		if ($attrs["id"]){
			$this->menupid = $attrs["id"];
		}
		
		$padTag = str_repeat(str_pad(" ", 3), $this->depth);
		
		switch ($name){
			case "menu" :
				$this->menu .= "\n$padTag<ul id='MenuBar1' class='MenuBarHorizontal'>";
				break;
			case "item":
				$this->menu .= "\n$padTag<li class='border'>";
				break;
			case "subitem" :
				$this->menu .= "\n$padTag<ul>\n<li>";
			}
		$this->inTag = $name;
		$this->depth++;
	}
	
	function endElement($parser, $name) {
	 
		$this->depth--;
	
		if ($this->closeTag == TRUE) {
			switch ($name){
				case "menu" :
					$this->menu .= "</ul>";
					break;
				case "item":
					$this->menu .= "</li>";
					break;
				case "subitem" :
					$this->menu .= "</li>\n</ul>";
			}	
			$this->inTag = "";
		} elseif ($this->inTag == $name) {
			$this->menu .= " />";
			$this->inTag = "";
		} else {
			$padTag = str_repeat(str_pad(" ", 3), $this->depth);
			switch ($name){
				case "menu" :
					$this->menu .= "\n$padTag</ul>";
					break;
				case "item":
					$this->menu .= "\n$padTag</li>";
					break;
				case "subitem" :
					$this->menu .= "\n$padTag</li>\n</ul>";
			}	
		} 
	}
	 
	function contents($parser, $data) {
		if ($data=="pid"){
			$data = "?$data=$this->moduleid";
			if ($this->menupid != 0){
				$data .= "-$this->menupid";
			}
		}
		$data = preg_replace("/^\s+/", "", $data);
		$data = preg_replace("/\s+$/", "", $data);
	
		if (!($data == ""))  {
			switch ($this->inTag){
				case "url" :
					$this->menu .= "<a href='$data' ";
					if ($data=="#"){
						$this->menu .= "class='MenuBarItemSubmenu' ";
					}
					break;
				case "name":
					$this->menu .= ">$data</a>";
					break;
			}	
			$this->closeTag = TRUE;
		} else {
			$this->closeTag = FALSE;
		}
	}
	
	function parseDEFAULT($parser, $data) {
		$data = preg_replace("/</", "<", $data);
		$data = preg_replace("/>/", ">", $data);
		$this->menu .= $data;
	}
	
	function pi_handler($parser, $target, $data) {
		global $menu;
		$this->menu .= "<?$target $data?>\n";
	}
		
}

?>