<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Controllers;

class CategoriesController
{
    public function addCategory()
    {
        // Validate token
        check_ajax_referer('obelisk_plugin_nonce', 'nonce', true);

        global $wpdb;

        $table_name = $wpdb->prefix . "obelisk_player_categories";
        $name = $_POST['category_name'];

        if ($name === '') {
            wp_send_json_error(array(
                'message' => 'Category name cannot be empty.'
            ));
        }

        $rows_affected = $wpdb->insert($table_name, array(
            'name' => $name
        ));

        if (is_int($rows_affected)) {
            wp_send_json_success(array(
                'message' => 'The category "' . $name . '" was saved successfully.'));
        } else {
            wp_send_json_error(array(
                'message' => 'Something went wrong.'
            ));
        }

        wp_die();
    }

    public function editCategory()
    {
        // Validate token
        check_ajax_referer('obelisk_plugin_nonce', 'nonce', true);

        global $wpdb;

        $table_name = $wpdb->prefix . "obelisk_player_categories";
        $id = $_POST['id'];
        $name = $_POST['category_name'];

        if ($name === '') {
            wp_send_json_error(array(
                    'message' => 'Category name cannot be empty.')
            );
        }

        $rows_affected = $wpdb->update($table_name, array(
            'name' => $name
        ), array('id' => $id));

        if (is_int($rows_affected)) {
            wp_send_json_success(array(
                'message' => 'The category "' . $name . '" was updated successfully.'));
        } else {
            wp_send_json_error(array(
                'message' => 'Something went wrong.'));
        }

        wp_die();
    }

    public function deleteCategory()
    {
        // Validate token
        check_ajax_referer('obelisk_plugin_nonce', 'nonce', true);

        global $wpdb;

        $table_name = $wpdb->prefix . "obelisk_player_categories";
        $id = $_POST['id'];
        $name = $_POST['category_name'];

        $rows_affected = $wpdb->delete($table_name, array('id' => $id));

        if (is_int($rows_affected)) {
            wp_send_json_success(array(
                'message' => 'The category "' . $name . '" was removed successfully.',
                'action' => 'delete_row'
            ));
        } else {
            wp_send_json_error(array(
                'message' => 'Something went wrong.'
            ));
        }

        wp_die();
    }
}
