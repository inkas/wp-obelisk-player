<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Controllers;

use Includes\Models\Song;

class SongsController
{
    public function addSong()
    {
        // Validate token
        check_ajax_referer('obelisk_plugin_nonce', 'nonce', true);

        global $wpdb;

        $name = $_POST['song_name'];
        $url = $_POST['song_url'];
        $categoryId = $_POST['song_category_id'];
        $description = $_POST['song_description'];
        $volume = $_POST['song_volume'];
        $infoUrl = $_POST['song_info_url'];

        if ($name === '') {
            wp_send_json_error(array(
                'message' => 'Song name cannot be empty.'
            ));
        }

        if ($url === '') {
            wp_send_json_error(array(
                'message' => 'URL name cannot be empty.'
            ));
        }

        $rows_affected = $wpdb->insert(Song::$table, array(
            'name' => $name,
            'url' => $url,
            'category_id' => $categoryId,
            'description' => htmlspecialchars(stripslashes($description)),
            'volume' => $volume,
            'info_url' => $infoUrl,
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

    public function editSong()
    {
        // Validate token
        check_ajax_referer('obelisk_plugin_nonce', 'nonce', true);

        global $wpdb;

        $id = $_POST['song_id'];
        $name = $_POST['song_name'];
        $url = $_POST['song_url'];
        $description = $_POST['song_description'];
        $categoryId = $_POST['song_category_id'];
        $volume = $_POST['song_volume'];
        $infoUrl = $_POST['song_info_url'];

        if ($name === '') {
            wp_send_json_error(array(
                'message' => 'Song name cannot be empty.'
            ));
        }

        if ($url === '') {
            wp_send_json_error(array(
                'message' => 'URL name cannot be empty.'
            ));
        }

        $rows_affected = $wpdb->update(Song::$table, array(
            'name' => $name,
            'url' => $url,
            'category_id' => $categoryId,
            'description' => $description,
            'volume' => $volume,
            'info_url' => $infoUrl,
        ), array('id' => $id));

        if (is_int($rows_affected)) {
            wp_send_json_success(array(
                'message' => 'The song "' . $name . '" was updated successfully.'));
        } else {
            wp_send_json_error(array(
                'message' => 'Something went wrong.'
            ));
        }

        wp_die();
    }

    public function deleteSong()
    {
        // Validate token
        check_ajax_referer('obelisk_plugin_nonce', 'nonce', true);

        global $wpdb;

        $id = $_POST['song_id'];
        $name = $_POST['song_name'];

        $rows_affected = $wpdb->delete(Song::$table, array('id' => $id));

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
