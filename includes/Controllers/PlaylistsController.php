<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Controllers;

use Includes\Helper;
use Includes\Models\Playlist;

class PlaylistsController
{
    public function register()
    {
        add_action('wp_ajax_' . Helper::PascalToSnake('savePlaylist'), array($this, 'savePlaylist'));
        add_action('wp_ajax_' . Helper::PascalToSnake('deletePlaylistSong'), array($this, 'deletePlaylistSong'));
    }

    public function savePlaylist()
    {
        // Validate token
        check_ajax_referer('obelisk_plugin_nonce', 'nonce', true);

        global $wpdb;

        $currentUserID = get_current_user_id();

        if (!$currentUserID) {
            wp_send_json_error(array('message' => 'Wrong user ID.'));
        }

        // Delete rows of current user first
        $wpdb->delete(Playlist::$table, array('user_id' => $currentUserID));

        // Insert playlist data
        $playlist = $_POST['playlist'];
        $playlistData = array();

        foreach ($playlist as $sequence => $song) {
            $playlistData[] = array(
                'user_id' => $currentUserID,
                'song_id' => (int)$song['id'],
                'sequence' => $sequence
            );
        }

        $rows_affected = Playlist::insert($playlistData);

        if (is_int($rows_affected)) {
            wp_send_json_success(array(
                'message' => 'The song was added to playlist successfully.'));
        } else {
            wp_send_json_error(array(
                'message' => 'Something went wrong.'));
        }

        wp_die();
    }

    public function deletePlaylistSong()
    {
        global $wpdb;

        $currentUserID = get_current_user_id();

        if (!$currentUserID) {
            wp_send_json_error(array('message' => 'Wrong user ID.'));
        }

        $songID = $_POST['songID'];

        // Delete song from playlist
        $rows_affected = $wpdb->delete(Playlist::$table, array(
            'user_id' => $currentUserID,
            'song_id' => (int)$songID
        ));


        if (is_int($rows_affected)) {
            wp_send_json_success(array(
                'song_id' => (int)$songID,
                'message' => 'The song was removed from playlist successfully.'));
        } else {
            wp_send_json_error(array(
                'message' => 'Something went wrong.'));
        }

        wp_die();
    }
}
