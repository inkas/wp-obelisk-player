<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Api;

use Includes\Base\Config;

class SettingsLinks implements API
{
    public function register()
    {
        add_filter('plugin_action_links_' . Config::plugin(), array($this, 'settingsLink'));
    }

    /**
     * Add custom settings link
     *
     * @param $links
     * @return array
     */
    public function settingsLink($links)
    {
        $links[] = '<a href="admin.php?page=obelisk_player_plugin">Settings</a>';

        return $links;
    }
}
