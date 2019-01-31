<?php

namespace Includes\Database\Migrations;

use Includes\Database\Table;
use Includes\Database\Migration;

class AddVolumeToSongsTable extends Migration
{
    public function __invoke()
    {
        if (version_compare($this->getPluginVersion(), '1.1') < 0) {
            Table::create('obelisk_player_songs', '
                id INT(9) NOT NULL AUTO_INCREMENT,
                name TEXT NOT NULL,
                url TEXT NOT NULL,
                description TEXT NULL DEFAULT NULL,
                category_id INT(9) NOT NULL,
                volume TINYINT NOT NULL DEFAULT 100,
                PRIMARY KEY (id)
            ');

            update_option('obelisk_player_version', '1.1');
        }
    }
}
