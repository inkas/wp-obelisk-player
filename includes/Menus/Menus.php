<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Menus;

use Includes\Menus\Admin\Admin;
use Includes\Menus\Admin\Views;
use Includes\Menus\API\Menu;

class Menus
{
    /**
     * Register Menus
     */
    public function register()
    {
        $admin = new Admin(new Menu(), new Views());
        $admin->register();
    }
}
