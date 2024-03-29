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
    }

    function query_result($totalRows) {
        $result = NULL;
        $result .= '{"totalRows": "'.$totalRows.'"';
        if ($totalRows > 0) {
            $result .= ', "result":[';
            foreach ($this->data as $item) {
                $result .= '{';
                foreach ($item as $key => $value) {
                    $result .= '"'. $key . '":"' . $value . '", ';
                }
                $result = substr($result, 0, -2);
                $result .= '}, ';
            }
            $result = substr($result, 0, -2);
            $result .= ']';
        }
        $result .= '}';
        return $result;
    }

    function select($select, $table, $where, $order, $group, $limit) {
        $this->createConnection();
        $query_result = NULL;

        $query = "SELECT ";
        if ($select) {
            $query .= $select;
        } else {
            $query .= " * ";
        }
        $query .= " FROM " . $table;
        if ($where != "all") {
            $query .= " WHERE " . $where;
        } 
        if ($order) {
            $query .= " ORDER BY " . $order;
        }
        if ($group){
            $query .= " GROUP BY " . $group;
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
        //$query_result = $query;

        return $query_result;
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
                        $this->getInsertKeyValue($myInput, TRUE),
                        $this->getInsertKeyValue($myInput, FALSE));

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

    function getInsertKeyValue($myInput, $isKey) {
        $returnData = NULL;
        foreach ($myInput as $key => $value) {
            if ($isKey){
                $returnData .= $key . ", ";
            } else {
                $returnData .= "'" . $value . "', ";
            }
        }
        $returnData = substr($returnData, 0, -2);
        return $returnData;
    }
}

?>
