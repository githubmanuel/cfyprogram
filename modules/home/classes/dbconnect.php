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

require_once(PATH_site . "core/classes/db_module.php");

class dbconnect {

    private $data = NULL;

    function createConnection() {
        $msql = new Db;
        $msql->connect();
    }

    function select($field, $input, $table) {
        $this->createConnection();
        $query_result = NULL;
        if ($input == "all") {
            $query = "SELECT * FROM " . $table;
        } else {
            $query = "SELECT * FROM " . $table . " WHERE " . $field . " like '%" . $input . "%' ";
        }
        $rsUsuarios = mysql_query($query);
        $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
        $totalRows = mysql_num_rows($rsUsuarios);

        $i = 0;
        do {
            $this->data[$i] = $row_rsUsuarios;
            $i++;
        } while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));

        $query_result = $this->query_result($totalRows);
        return $query_result;
    }

    function query_result($totalRows) {
        $result = NULL;
        $result .= "<total>$totalRows</total>";
        for ($i = 0; $i <= $totalRows - 1; $i++) {
            $result .= "<result>\r\n" .
                    "<username>" . $this->data[$i]["username"] . "</username>\r\n" .
                    "<password>" . $this->data[$i]["password"] . "</password>\r\n" .
                    "<level>" . $this->data[$i]["level"] . "</level>\r\n" .
                    "<creation_date>" . $this->data[$i]["creation_date"] . "</creation_date>\r\n" .
                    "<status>" . $this->data[$i]["status"] . "</status>\r\n" .
                    "</result>\r\n";
        }
        return $result;
    }

    function update($myInput, $key, $table) {
        $this->createConnection();
        $query_result = NULL;


        $query = sprintf("UPDATE %s SET %s WHERE %s",
                        $table,
                        $this->getInputData($myInput),
                        $key);


        $query_result = mysql_query($query) or die(mysql_error());
        //$query_result = $query;
        return $query_result;
    }

    function getInputData($myInput){

        $returnData = NULL;
        foreach ($myInput as $key => $value) {
            $returnData .= $key. "='" .$value. "', ";
        }
        $returnData .= substr($returnData, 0, -2);
        return $returnData;

    }
}

?>
