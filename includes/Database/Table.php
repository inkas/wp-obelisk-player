<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Database;

class Table
{
    public static function create($table, $fields)
    {
        global $wpdb;

        $tableName = $wpdb->prefix . $table;
        $charsetCollate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $tableName (
            $fields
        ) $charsetCollate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($sql);
    }

    public static function dropIfExists($table)
    {
        global $wpdb;

        $wpdb->query(sprintf("DROP TABLE IF EXISTS %s", $wpdb->prefix . $table));
    }
}
