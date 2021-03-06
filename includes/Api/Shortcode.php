<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Api;

use Includes\Base\Config;

class Shortcode implements API
{
    public function register()
    {
        add_shortcode('obelisk_player', array($this, 'playlistShortcode'));
    }

    public function playlistShortcode($atts, $content = null)
    {
        wp_enqueue_style('jQueryScrollbarStyle');
        wp_enqueue_style('pluginFrontEndStyle');
        wp_enqueue_script('jQueryScrollbarScript');
        wp_enqueue_script('jQuerySortablePlugin');
        wp_enqueue_script('pluginFrontEndScript');

        ob_start();

        require_once Config::templates() . '/playlist.php';

        return ob_get_clean();
    }
}
