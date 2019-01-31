<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Database;

class Migration
{
    private $pluginVersion;

    public function __construct()
    {
        $this->pluginVersion = get_option('obelisk_player_version', 0);
    }

    protected function getPluginVersion()
    {
        return $this->pluginVersion;
    }
}
