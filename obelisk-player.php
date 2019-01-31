<?php

/**
 * @package   Obelisk Player
 * @author    Ilkin Ismailov - <inkas91@gmail.com>
 * @license   GPL-2.0+
 * @version   1.0.0
 */

/*
   Plugin Name: Obelisk Player
   Description: Obelisk Player gives users the ability to make their own playlists by predefined playlist.
   Author: Ilkin Ismailov
   Version: 1.0.0
   Author URI: https://ilkin.eu
   License: GPL-2.0+
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    exit;
}

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use \Includes\Base\Activate;
use \Includes\Base\Deactivate;
use \Includes\Init;

register_activation_hook(__FILE__, function() {
    Activate::activate();
});

register_deactivation_hook(__FILE__, function() {
    Deactivate::deactivate();
});

if (class_exists(Init::class)) {
    Init::migrations();
    Init::registerServices();
    Init::menus();
}
