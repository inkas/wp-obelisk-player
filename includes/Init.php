<?php

/**
 * @package   Obelisk Player
 */

namespace Includes;

use Includes\Api\Route;
use Includes\Api\Shortcode;
use Includes\Api\EnqueueAssets;
use Includes\Api\SettingsLinks;
use Includes\Database\Migrations\AddInfoUrlToSongsTable;
use Includes\Database\Migrations\AddVolumeToSongsTable;
use Includes\Menus\Menus;

final class Init
{
    protected static $services = array(
        EnqueueAssets::class,
        SettingsLinks::class,
        Route::class,
        Shortcode::class,
    );

    public static function registerServices()
    {
        foreach (self::$services as $class) {
            $service = new $class;

            $service->register();
        }
    }

    public static function menus()
    {
        $menus = new Menus();
        $menus->register();
    }

    public static function migrations()
    {
        $migrations = array(
            AddVolumeToSongsTable::class,
            AddInfoUrlToSongsTable::class,
        );

        foreach ($migrations as $migration) {
            $instance = new $migration;
            $instance();
        }
    }
}
