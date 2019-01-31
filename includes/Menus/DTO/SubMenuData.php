<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Menus\DTO;

class SubMenuData
{
    protected $parentSlug;
    protected $pageTitle;
    protected $menuTitle;
    protected $capability;
    protected $menuSlug;
    protected $callback;

    /**
     * SubMenuData constructor.
     *
     * @param string $parentSlug
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param null|callable $callback
     */
    public function __construct($parentSlug, $pageTitle, $menuTitle, $capability, $menuSlug, $callback = null)
    {
        $this->parentSlug = $parentSlug;
        $this->pageTitle = $pageTitle;
        $this->menuTitle = $menuTitle;
        $this->capability = $capability;
        $this->menuSlug = $menuSlug;
        $this->callback = $callback;
    }

    public function getParentSlug()
    {
        return $this->parentSlug;
    }

    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function getMenuTitle()
    {
        return $this->menuTitle;
    }

    public function getCapability()
    {
        return $this->capability;
    }

    public function getMenuSlug()
    {
        return $this->menuSlug;
    }

    public function getCallback()
    {
        return $this->callback;
    }
}
