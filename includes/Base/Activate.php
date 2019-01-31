<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Base;

use Includes\Database\Table;

class Activate
{
    public static function activate()
    {
        Table::create('obelisk_player_categories', '
            id INT(9) NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            PRIMARY KEY (id)
        ');

        Table::create('obelisk_player_songs', '
            id INT(9) NOT NULL AUTO_INCREMENT,
            name TEXT NOT NULL,
            url TEXT NOT NULL,
            description TEXT NULL DEFAULT NULL,
            category_id INT(9) NOT NULL,
            PRIMARY KEY (id)
        ');

        Table::create('obelisk_player_user_playlists', '
            id INT(9) NOT NULL AUTO_INCREMENT,
            user_id INT(9) NOT NULL,
            song_id INT(9) NOT NULL,
            sequence INT(9) NOT NULL,
            PRIMARY KEY (id)
        ');

        flush_rewrite_rules();
    }
}
