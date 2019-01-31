<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Api;

use Includes\Base\Config;

class Route implements API
{
    protected static $routes = array();

    /**
     * Register route actions and handlers
     */
    public function register()
    {
        self::getRouteFiles();

        foreach (self::$routes as $route) {
            add_action('wp_ajax_' . $route['action'], $route['handler']);
        }
    }

    /**
     * Add routes
     *
     * @param string $action
     * @param array $handler Array of Controller and method
     */
    public static function add($action, $handler)
    {
        self::$routes[] = array(
            'action' => $action,
            'handler' => $handler,
        );
    }

    /**
     * Include route files
     */
    protected static function getRouteFiles()
    {
        foreach(glob(Config::routes() . "/*.php") as $file){
            include_once $file;
        }
    }
}
