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

  File: index.php
  Commnents: Startup file.

 */

require_once("../../../core/classes/db_module.php");

class dbconnect {

    private $data = NULL;

    function select_all($table) {
        $msql = new Db;
        $msql->connect();

        $query_result = NULL;

        $query = "SELECT * FROM " . $table;
        $rsUsuarios = mysql_query($query);
        $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
        $totalRows = mysql_num_rows($rsUsuarios);

        $i = 0;
        do {
            $this->data[$i] = $row_rsUsuarios;
            $i++;
        } while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));

        if ($totalRows >= 1) {
            $query_result = $this->query_result($totalRows);
        } else {
            $query_result = $this->notify_show();
        }
        return $query_result;
    }

    function notify_show() {
        return 'error';
    }

    function query_result($totalRows) {
        $result = NULL;
        $result .= "<total>$totalRows</total>";
        for ($i = 0; $i <= $totalRows - 1; $i++) {
            $result .= "<result>\r\n<code>" . $this->data[$i]["username"] .
                    "</code>\r\n<name>" . $this->data[$i]["password"] .
                    "</name>\r\n<price>" . $this->data[$i]["level"] .
                    "</price>\r\n</result>\r\n";
        }
        return $result;
    }

}

?>
