<?php

/**
 * @package   Obelisk Player
 */

namespace Includes\Api;

use Includes\Base\Config;

class EnqueueAssets implements API
{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueAdmin'));
        add_action('init', array($this, 'enqueueFrontEnd'));
    }

    public function enqueueAdmin()
    {
        wp_enqueue_style('pluginBootstrapStyle', Config::assets() . '/css/bootstrap.min.css');
        wp_enqueue_script('pluginBootstrapScript', Config::assets() . '/js/bootstrap.min.js');
        wp_enqueue_script('pluginAdminScript', Config::assets() . '/js/admin.js');

        wp_localize_script( 'pluginAdminScript', 'ajax_object',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('obelisk_plugin_nonce')
            )
        );
    }

    public function enqueueFrontEnd()
    {
        wp_register_style('jQueryScrollbarStyle', Config::assets() . '/css/jquery.scrollbar.css');
        wp_register_style('pluginFrontEndStyle', Config::assets() . '/css/frontend.css');
        wp_register_script('jQueryScrollbarScript', Config::assets() . '/js/jquery.scrollbar.min.js');
        wp_register_script('jQuerySortablePlugin', Config::assets() . '/js/jquery-sortable.js');
        wp_register_script('pluginFrontEndScript', Config::assets() . '/js/frontend.js');
    }
}
