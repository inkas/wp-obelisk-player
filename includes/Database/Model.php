<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Database;

class Model
{
    public static $table;

    /**
     * Get all records
     *
     * @return array|null|object
     */
    public static function all()
    {
        global $wpdb;

        return $wpdb->get_results("SELECT * FROM " . static::$table);
    }

    /**
     * SQL Where clause
     *
     * @param $params
     * @param null $param
     * @return array|bool|null|object
     */
    public static function where($params, $param = null)
    {
        global $wpdb;

        $where = 1;

        if (is_array($params)) {
            $whereArr = array();

            foreach ($params as $key => $value) {
                if (!is_int($value) || !is_string($value)) {
                    return false;
                }

                $whereArr[] = "{$key} = " . (is_int($value) ? $value : "'{$value}'");
            }

            $where = implode(' AND ', $whereArr);

        }

        if (is_string($params)) {
            $where = "{$params} = {$param}";
        }

        return $wpdb->get_results("SELECT * FROM " . static::$table . " WHERE " . $where . ";");
    }

    /**
     * Mass insertion method
     *
     * @param $params
     * @return false|int
     */
    public static function insert($params)
    {
        global $wpdb;

        $columnsArr = array_keys($params[0]);
        $columns = implode(", ", $columnsArr);
        $query = "INSERT INTO " . static::$table . " ({$columns}) VALUES ";
        $values = array();
        $placeholderTypes = array();
        $placeholders = array();

        foreach ($params[0] as $value) {
            switch (gettype($value)) {
                case 'integer':
                    $placeholderTypes[] = '%d';
                    break;
                case 'float':
                    $placeholderTypes[] = '%f';
                    break;
                case 'string':
                    $placeholderTypes[] = '%s';
                    break;
            }
        }

        foreach ($params as $param) {
            foreach ($param as $value) {
                $values[] = $value;
            }

            $placeholders[] = '(' . implode(", ", $placeholderTypes) . ')';
        }

        $query .= implode(", ", $placeholders);

        return $wpdb->query($wpdb->prepare($query, $values));
    }
}
