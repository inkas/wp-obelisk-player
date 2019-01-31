<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Menus\Admin;

use Includes\Base\Config;

class Views
{
    public function adminDashboard()
    {
        return require_once Config::templates() . '/dashboard.php';
    }

    public function adminCategories()
    {
        return require_once Config::templates() . '/categories.php';
    }

    public function adminSongs()
    {
        return require_once Config::templates() . '/songs.php';
    }
}
