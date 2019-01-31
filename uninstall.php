<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

// Delete tables
use \Includes\Database\Table;

Table::dropIfExists('obelisk_player_categories');
Table::dropIfExists('obelisk_player_songs');
Table::dropIfExists('obelisk_player_user_playlists');
