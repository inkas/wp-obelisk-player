<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Menus\Admin;

use Includes\Menus\API\Menu;
use Includes\Menus\DTO\MenuData;
use Includes\Menus\DTO\SubMenuData;

class Admin
{
    public $menu;
    public $views;

    public function __construct(Menu $menu, Views $views)
    {
        $this->menu = $menu;
        $this->views = $views;
    }

    /**
     * Register menu
     */
    public function register()
    {
        $this->menu->addMenu($this->buildMenuData())->initialSubmenu('Dashboard')
            ->addSubMenus($this->buildSubMenuData())->create();
    }

    /**
     * Build menu data
     *
     * @return MenuData
     */
    public function buildMenuData()
    {
        return new MenuData(
            'Obelisk Player Plugin',
            'Obelisk Player',
            'manage_options',
            'obelisk_player_plugin',
            array($this->views, 'adminDashboard'),
            'dashicons-playlist-audio'
        );
    }

    /**
     * Build sub-menu data
     *
     * @return array Array of SubMenuData objects
     */
    public function buildSubMenuData()
    {
        return array(
            new SubMenuData(
                null,
                'Categories',
                'Categories',
                'manage_options',
                'obelisk_player_categories',
                array($this->views, 'adminCategories')
            ),
            new SubMenuData(
                null,
                'Songs',
                'Songs',
                'manage_options',
                'obelisk_player_songs',
                array($this->views, 'adminSongs')
            ),
        );
    }
}
