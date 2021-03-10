<?php
/**
 * Plugin Name: Post Excerpt
 * Plugin URI: https://wedevs.com/
 * Description: Assignment 4, plugin 1
 * Version: 1.0.0
 * Author: Asad
 * Author URI: https://wedevs.com/
 * Text Domain: post-excerpt
 * WP requires at least: 4.0
 * WP tested up to: 5.0.0
 * Domain Path: /languages/
 * License: GPL2
 */

/*
 * Copyright (c) 2021 weDevs (email: info@wedevs.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Post_Excerpt class
 *
 * @class Post_Excerpt
 *
 * The class that holds
 * the entire plugin
 */
final class Asd_Post_Excerpt {

    /**
     * Plugin version
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Class constructor
     */
    public function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );

        $this->init_plugin();
    }

    /**
     * Initialize a singleton instance
     *
     * @since  1.0.0
	 *
     * @return \Asd_Post_Excerpt
     */
    public static function init() {
        static $instance = false;

        if( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the plugin constants
     *
     * @since  1.0.0
	 *
     * @return void
     */
    public function define_constants() {
        define( 'ASD_POST_EXCERPT_VERSION', self::VERSION );
        define( 'ASD_POST_EXCERPT_FILE', __FILE__ );
        define( 'ASD_POST_EXCERPT_PATH', __DIR__ );
        define( 'ASD_POST_EXCERPT_URL', plugins_url( '', ASD_POST_EXCERPT_FILE ) );
        define( 'ASD_POST_EXCERPT_ASSETS', ASD_POST_EXCERPT_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @since  1.0.0
	 *
     * @return void
     */
    public function init_plugin() {
        require_once( ASD_POST_EXCERPT_PATH . '/includes/Metabox.php' );
        new Metabox();
        
        if ( is_admin() ) {
            require_once( ASD_POST_EXCERPT_PATH . '/includes/Menu.php' );
            new Menu();
        } else {
            require_once( ASD_POST_EXCERPT_PATH . '/includes/Shortcode.php' );
            new Shortcode();
        }
    }

    /**
     * Do staff upon plugin activation
     *
     * @since  1.0.0
	 *
     * @return void
     */
    public function activate() {
        $installed = get_option( 'asd_meta_excerpt_installed' );

        if( ! $installed ) {
            update_option( 'asd_meta_excerpt_installed', time() );
        }

        update_option( 'asd_meta_excerpt_installed', ASD_POST_EXCERPT_VERSION );
    }

}

/**
 * Initialize the main plugin.
 *
 * @return \Asd_Post_Excerpt
 */
function asd_post_excerpt() {
    return Asd_Post_Excerpt::init();
}

/**
 * Kick-off the plugin
 */
asd_post_excerpt();
