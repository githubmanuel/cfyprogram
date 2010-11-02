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

require_once(PATH_site . "core/classes/db.php");
require_once(PATH_site . "core/conf/global.php");

class conf_var {

    function __construct($table) {

        $msql = new Db;
        $msql->connect();

        $query = "SELECT * FROM " . $table . " ORDER BY id ";

        $rsUsuarios = mysql_query($query);
        $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);

        $contents = NULL;
        $filename = PATH_site . "core/conf/modules.xml";

        $contents = '<?xml version="1.0" encoding="UTF-8"?>
                    <!--

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

                    -->
                    <modules>';

        do {
           $contents .= '<names>
                            <id>'.$row_rsUsuarios["id"].'</id>
                            <name>'.$row_rsUsuarios["name"].'</name>
                            <print>'.$row_rsUsuarios["print"].'</print>
                        </names>';

            } while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));

            mysql_free_result($rsUsuarios);

            $contents .= '</modules>';

            // put the new content into the files
            $fr = fopen($filename, 'w');
            fwrite($fr, $contents);
            fclose($fr);
        }
    }

?>
