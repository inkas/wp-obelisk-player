<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Menus\API;

use Includes\Menus\DTO\MenuData;
use Includes\Menus\DTO\SubMenuData;

class Menu
{
    /**
     * @var MenuData $menu
     */
    protected $menu;
    protected $subMenus = array();

    /**
     * Create menu and sub-menu
     */
    public function create()
    {
        if (!empty($this->menu)) {
            add_action('admin_menu', array($this, 'addMenuPages'));
        }
    }

    /**
     * Add menus and associated pages
     */
    public function addMenuPages()
    {
        add_menu_page(
            $this->menu->getPageTitle(), $this->menu->getMenuTitle(), $this->menu->getCapability(),
            $this->menu->getMenuSlug(), $this->menu->getCallback(), $this->menu->getIconUrl(),
            $this->menu->getPosition()
        );

        /**
         * @var SubMenuData $subMenu
         */
        foreach ($this->subMenus as $subMenu) {
            add_submenu_page(
                $subMenu->getParentSlug(), $subMenu->getPageTitle(), $subMenu->getMenuTitle(),
                $subMenu->getCapability(), $subMenu->getMenuSlug(), $subMenu->getCallback()
            );
        }
    }

    /**
     * Add menu
     *
     * @param MenuData $menuData
     * @return $this
     */
    public function addMenu(MenuData $menuData)
    {
        $this->menu = $menuData;

        return $this;
    }

    /**
     * Add initial(first) sub-menu
     *
     * @param null|string $title
     * @return $this
     */
    public function initialSubMenu($title = null)
    {
        if (empty($this->menu)) {
            return $this;
        }

        $initialSubMenu = array(
            new SubMenuData(
                $this->menu->getMenuSlug(),
                $this->menu->getPageTitle(),
                ($title) ? $title : $this->menu->getMenuTitle(),
                $this->menu->getCapability(),
                $this->menu->getMenuSlug(),
                $this->menu->getCallback()
            )
        );

        $this->subMenus = $initialSubMenu;

        return $this;
    }

    /**
     * Add sub-menus
     *
     * @param array $subMenus
     * @return $this
     */
    public function addSubMenus(array $subMenus)
    {
        $this->subMenus = array_merge($this->subMenus, $subMenus);

        /**
         * @var SubMenuData $subMenu
         */
        foreach ($this->subMenus as &$subMenu) {
            $subMenu = new SubMenuData(
                $this->menu->getMenuSlug(),
                $subMenu->getPageTitle(),
                $subMenu->getMenuTitle(),
                $subMenu->getCapability(),
                $subMenu->getMenuSlug(),
                $subMenu->getCallback()
            );
        }

        return $this;
    }
}
