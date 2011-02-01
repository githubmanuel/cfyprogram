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

  File: index.php
  Commnents: Startup file.

 */

require_once(PATH_site . "core/classes/db.php");

class dbconnect {

    private $data = NULL;

    function createConnection() {
        $msql = new Db;
        $msql->connect();
    }

    function select($select, $inputfield, $input, $table, $where, $andor, $order, $limit) {
        $this->createConnection();
        $query_result = NULL;

        $query = "SELECT ";
        if ($select) {
            $query .= $select;
        } else {
            $query .= " * ";
        }
        $query .= " FROM " . $table;
        if ($input != "all") {
            $query .= " WHERE " . $inputfield . " like '%" . $input . "%' ";
            if ($where) {
                $query.= $andor . $where;
            }
        } else {
            if ($where) {
                $query .= " WHERE " . $where;
            }
        }
        if ($order) {
            $query .= " ORDER BY " . $order;
        }
        if ($limit) {
            $query .= " LIMIT " . $limit;
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
        //return $query ;
    }

    function query_result($totalRows) {
        $result = NULL;
        $result .= "<total>$totalRows</total>";
        if ($totalRows > 0) {
            foreach ($this->data as $item) {
                $result .= "<result>\r\n";
                foreach ($item as $key => $value) {
                    $result .= "<" . $key . ">" . $value . "</" . $key . ">\r\n";
                }
                $result .= "</result>\r\n";
            }
        }
        return $result;
    }

    function update($myInput, $key, $table) {
        $this->createConnection();
        $query_result = NULL;

        $query = sprintf("UPDATE %s SET %s WHERE %s",
                        $table,
                        $this->getUpdateData($myInput),
                        $key);

        $query_result = mysql_query($query) or die(mysql_error());
        //$query_result = $query;
        return $query_result;
    }

    function insert($myInput, $table) {
        $this->createConnection();
        $query_result = NULL;

        $query = sprintf("INSERT INTO %s (%s) VALUES (%s) ",
                        $table,
                        $this->getInsertKey($myInput),
                        $this->getInsertValue($myInput));

        $query_result = mysql_query($query) or die(mysql_error());
        //$query_result = $query;
        return $query_result;
    }

    function delete($key, $table) {
        $this->createConnection();
        $query_result = NULL;

        $query = sprintf("DELETE FROM %s WHERE %s ",
                        $table,
                        $key);

        $query_result = mysql_query($query) or die(mysql_error());
        //$query_result = $query;
        return $query_result;
    }

    function getUpdateData($myInput) {

        $returnData = NULL;
        foreach ($myInput as $key => $value) {
            if ($value == "CURRENT_TIMESTAMP") {
                $returnData .= $key . "=" . $value . ", ";
            } else {
                $returnData .= $key . "='" . $value . "', ";
            }
        }
        $returnData = substr($returnData, 0, -2);
        return $returnData;
    }

    function getInsertKey($myInput) {
        $returnData = NULL;

        foreach ($myInput as $key => $value) {
            $returnData .= $key . ", ";
        }
        $returnData = substr($returnData, 0, -2);
        return $returnData;
    }

    function getInsertValue($myInput) {
        $returnData = NULL;
        foreach ($myInput as $key => $value) {

            $returnData .= "'" . $value . "', ";
        }
        $returnData = substr($returnData, 0, -2);
        return $returnData;
    }

}

?>
