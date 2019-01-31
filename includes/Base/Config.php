<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Base;

class Config
{
    public static function path()
    {
        return plugin_dir_path(dirname(dirname(__FILE__)));
    }

    public static function url()
    {
        return plugin_dir_url(dirname(dirname(__FILE__)));
    }

    public static function plugin()
    {
        return plugin_basename(dirname(dirname(dirname(__FILE__)))) . '/obelisk-player.php';
    }

    public static function templates()
    {
        return self::path() . 'templates';
    }

    public static function assets()
    {
        return self::url() . 'assets';
    }

    public static function routes()
    {
        return self::path() . 'includes/Routes';
    }
}
