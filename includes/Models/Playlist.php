<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Models;

use Includes\Database\Model;

class Playlist extends Model
{
    public static $table = 'wp_obelisk_player_user_playlists';

    public static function getCategoriesWithSongs()
    {
        global $wpdb;

        $categoriesWithSongs = $wpdb->get_results("
            select s.id, s.name as song_name, s.url, s.description, s.volume, s.info_url, c.name as category_name 
            from " . (Category::$table) . " as c 
            left join " . (Song::$table) . " as s on c.id = s.category_id 
            order by c.name, s.name 
        ", OBJECT);

        $categoriesWithSongsArr = array();

        foreach ($categoriesWithSongs as $category) {
            $categoriesWithSongsArr[$category->category_name][] = $category;
        }

        return $categoriesWithSongsArr;
    }

    public static function getUserPlaylist($userId)
    {
        global $wpdb;

        $userPlaylist = $wpdb->get_results($wpdb->prepare("
            select * 
            from " . (Playlist::$table) . " as up
            inner join " . (Song::$table) . " as s on s.id = up.song_id
            where user_id = %d
            order by sequence
        ", array($userId)));

        return $userPlaylist;
    }

    public static function getMostlyAddedSongsToPlaylist($limit = null)
    {
        global $wpdb;

        $songs = $wpdb->get_results("
            select * 
            from
            (
                select up.song_id, count(*) as count
                from " . (Playlist::$table) . " as up
                group by up.song_id
            ) as up
            left join " . (Song::$table) . " as s
            on s.id = up.song_id
            order by count desc
            " . ($limit ? "limit {$limit}" : '') . "
        ");

        return $songs;
    }
}
