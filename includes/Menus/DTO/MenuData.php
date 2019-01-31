<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Menus\DTO;

class MenuData
{
    protected $pageTitle;
    protected $menuTitle;
    protected $capability;
    protected $menuSlug;
    protected $callback;
    protected $iconUrl;
    protected $position;

    /**
     * MenuData constructor.
     *
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param null|callable $callback
     * @param null|string $iconUrl
     * @param null|int $position
     */
    public function __construct($pageTitle, $menuTitle, $capability, $menuSlug, $callback = null, $iconUrl = null, $position = null)
    {
        $this->pageTitle = $pageTitle;
        $this->menuTitle = $menuTitle;
        $this->capability = $capability;
        $this->menuSlug = $menuSlug;
        $this->callback = $callback;
        $this->iconUrl = $iconUrl;
        $this->position = $position;
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

    public function getIconUrl()
    {
        return $this->iconUrl;
    }

    public function getPosition()
    {
        return $this->position;
    }
}
