<?php
/**
 * Created by PhpStorm.
 * User: stanislaw
 * Date: 1/15/19
 * Time: 15:04
 */

class SQL
{
    static public function findTable ($params = []) {

    }

    static public function INSERT($params = [], $table_name = null, $additional = '') {
//        $properties = UtovA::run(["params" => [], "table_name" => null, "additional"], $properties, 1);

        if ($table_name !== null)
            $sql = "INSERT INTO $table_name (";
        else
            $sql = "INSERT INTO ".self::findTable($params)."  (";

        $count = 1;

        foreach ($params as $key => $item) {
            $sql .= "`".$key."`";
            if ($count < count($params)) {
                $sql .=', ';
            }
            $count++;
        }

        $sql .= ') VALUES (';

        $count = 1;

        foreach ($params as $key => $item) {
            $sql .= "'".htmlentities($item)."'";
            if ($count < count($params)) {
                $sql .=', ';
            }
            $count++;
        }

        $sql .= ") $additional";

        return $sql;

    }

    static public function UPDATE($params = [], $condition = [], $table_name = null, $additional = '') {
        if ($table_name !== null)
            $sql = "UPDATE $table_name SET ";
        else
            $sql = "UPDATE ".self::findTable($params)." SET ";

        $count = 1;

        foreach ($params as $key => $item) {
            $sql .= "`".$key."` = '".$item."'";
            if ($count < count($params)) {
                $sql .=', ';
            }
            $count++;
        }

        if (count($params) < 1) return $sql;

        $sql .= ' WHERE ';

        $count = 1;

        foreach ($condition as $key => $item) {
            $sql .= "`".$key."` = '".$item."'";
            if ($count < count($condition)) {
                $sql .=' AND ';
            }
            $count++;
        }

        $sql .= " $additional";

        return $sql;

    }

    static public function DELETE($params = [], $table_name = null, $additional = '') {
        if ($table_name !== null)
            $sql = "DELETE FROM $table_name WHERE ";
        else
            $sql = "DELETE FROM ".self::findTable($params)." WHERE ";

        $count = 1;

        foreach ($params as $key => $item) {
            $sql .= "`".$key."` = '".$item."'";
            if ($count < count($params)) {
                $sql .=', ';
            }
            $count++;
        }

        if (count($params) < 1) return $sql;

        $sql .= " $additional";

        return $sql;
    }

    static public function SELECT($select = [], $params = [], $table_name = null, $additional = '')
    {

        if ($table_name !== null)
            $sql = "SELECT * FROM $table_name WHERE ";
        else
            $sql = "SELECT * FROM ".self::findTable($params)." WHERE ";

        $count = 1;

        foreach ($select as $key => $item) {
            $sql .= $item.", ";
            if ($count < count($select)) {
                $sql .= $item;
            }
            $count++;
        }

        if (count($params) < 1) return $sql;

        $count = 1;

        $sql .= " WHERE ";

        foreach ($params as $key => $item) {
            $sql .= "`".$key."` = '".$item."'";
            if ($count < count($params)) {
                $sql .=' AND ';
            }
            $count++;
        }

        return $sql;
    }

}