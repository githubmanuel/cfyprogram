<?php

/*

  CFY program - CFY Business Management Suite

  Integrated enterprise applications to execute and optimize business and IT strategies.
  Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

  Version: 0.0.0.1a
  Author: Ernesto La Fontaine
  Mail: mail@pajarraco.com
  License: New BSD License (see docs/license.txt)
  Redistributions of files must retain the copyright notice.

  File:
  Commnents:

  File: menu.php
  Commnents: class for handle the menues

 */

require ("core/conf/config.php");
require ("core/conf/global.php");

class Menu {

    private $menu = NULL;
    private $inTag = NULL;
    private $depth = NULL;
    private $closeTag = NULL;
    private $menuPid = NULL;
    private $moduleId = NULL;
    private $urlData = NULL;
    private $realUrl = NULL;
    private $firstItem = TRUE;
    private $modulePageId = NULL;
    private $pageId = NULL;

    function printMenu($file) {

        $this->moduleid = $GLOBALS["CORE"]["page"]["module_menu_id"];

        $xml_parser = xml_parser_create();
        xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($xml_parser, XML_OPTION_SKIP_WHITE, 1);
        xml_set_processing_instruction_handler($xml_parser, array($this, "pi_handler"));
        xml_set_default_handler($xml_parser, array($this, "parseDEFAULT"));
        xml_set_element_handler($xml_parser, array($this, "startElement"), array($this, "endElement"));
        xml_set_character_data_handler($xml_parser, array($this, "contents"));

        if (!($fp = fopen($file, "r"))) {
            if (!xml_parse($xml_parser, $data, feof($fp))) {
                die(sprintf("XML error: %s at line %d",
                                xml_error_string(xml_get_error_code($xml_parser)),
                                xml_get_current_line_number($xml_parser)));
            }
        }
        while ($data = fread($fp, 4096)) {
            if (!xml_parse($xml_parser, $data, feof($fp))) {
                die(sprintf("XML error: %s at line %d",
                                xml_error_string(xml_get_error_code($xml_parser)),
                                xml_get_current_line_number($xml_parser)));
            }
        }
        xml_parser_free($xml_parser);

        return $this->menu;
    }

    function getModuleName($pid) {
        $this->getId($pid);
        $GLOBALS["CORE"]["page"]["module_menu_id"] = $this->modulePageId;
        $moduleName = $GLOBALS["CORE"]["module"]["names"][$this->modulePageId];
        return $moduleName;
    }

    function getPageName($pid, $xmlstr) {

        if (!$this->pageId) {
            $pageName = "index.php";
        } else {
            $xml = simplexml_load_file($xmlstr);
            foreach ($xml->item as $item) {
                if ($item["id"] == $this->pageId) {
                    $pageName = $item->url;
                } else {
                    $l = 0;
                    foreach ($item as $value) {
                        $l = $l + 1;
                    }
                    if ($l > 3) {
                        foreach ($item->submenu->subitem as $subitem) {
                            if ($subitem["id"] == $this->pageId) {
                                $pageName = $subitem->url;
                                break;
                            } else {
                                $l = 0;
                                foreach ($subitem as $value) {
                                    $l = $l + 1;
                                }
                                if ($l > 3) {
                                    foreach ($subitem->submenu->subitem as $subitem) {
                                        if ($subitem["id"] == $this->pageId) {
                                            $pageName = $subitem->url;
                                            break;
                                        } else {
                                            $l = 0;
                                            foreach ($subitem as $value) {
                                                $l = $l + 1;
                                            }
                                            if ($l > 3) {
                                                foreach ($subitem->submenu->subitem as $subitem) {
                                                    if ($subitem["id"] == $this->pageId) {
                                                        $pageName = $subitem->url;
                                                        break;
                                                    } else {
                                                        $l = 0;
                                                        foreach ($subitem as $value) {
                                                            $l = $l + 1;
                                                        }
                                                        if ($l > 3) {
                                                            foreach ($subitem->submenu->subitem as $subitem) {
                                                                if ($subitem["id"] == $this->pageId) {
                                                                    $pageName = $subitem->url;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $pageName;
    }

    function getId($pid) {
        list($this->modulePageId, $this->pageId) = explode("-", $pid);
    }

    function startElement($parser, $name, $attrs) {

        if ($attrs["id"]) {
            $this->menupid = $attrs["id"];
        }

        $padTag = str_repeat(str_pad(" ", 3), $this->depth);

        switch ($name) {
            case "menu" :
                $this->menu .= "\n$padTag<ul id='MenuBar1' class='MenuBarHorizontal'>";
                break;
            case "item":
                if ($this->firstItem) {
                    $this->menu .= "\n$padTag<li class='border_first'>";
                    $this->firstItem = FALSE;
                } else {
                    $this->menu .= "\n$padTag<li class='border'>";
                }
                break;
            case "submenu":
                $this->menu .= "\n$padTag<ul>";
                break;
            case "subitem" :
                $this->menu .= "\n$padTag<li>";
        }
        $this->inTag = $name;
        $this->depth++;
    }

    function endElement($parser, $name) {

        $this->depth--;

        if ($this->closeTag == TRUE) {
            switch ($name) {
                case "menu":
                    $this->menu .= "</ul>";
                    break;
                case "item":
                    $this->menu .= "</li>";
                    break;
                case "submenu":
                    $this->menu .= "</ul>";
                    break;
                case "subitem" :
                    $this->menu .= "</li>";
            }
            $this->inTag = "";
        } elseif ($this->inTag == $name) {
            $this->menu .= " />";
            $this->inTag = "";
        } else {
            $padTag = str_repeat(str_pad(" ", 3), $this->depth);
            switch ($name) {
                case "menu":
                    $this->menu .= "\n$padTag</ul>";
                    break;
                case "item":
                    $this->menu .= "\n$padTag</li>";
                    break;
                case "submenu":
                    $this->menu .= "\n$padTag</ul>";
                    break;
                case "subitem":
                    $this->menu .= "\n$padTag</li>";
            }
        }
    }

    function contents($parser, $data) {

        $data = preg_replace("/^\s+/", "", $data);
        $data = preg_replace("/\s+$/", "", $data);

        if (!($data == "")) {
            switch ($this->inTag) {
                case "type":
                    switch ($data) {
                        case "pid":
                            $this->urldata = "?pid=$this->moduleid";
                            if ($this->menupid != 0) {
                                $this->urldata .= "-$this->menupid";
                            }
                            break;
                        case "url":
                            $this->realurl = TRUE;
                            break;
                        case "submenu":
                            $this->urldata = "#' class='MenuBarItemSubmenu'";
                    }
                    break;
                case "url" :
                    if ($this->realurl) {
                        $this->menu .= "<a href='$data' >";
                        $this->realurl = FALSE;
                    } else {
                        $this->menu .= "<a href='$this->urldata' >";
                    }
                    break;
                case "name":
                    $this->menu .= "$data</a>";
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