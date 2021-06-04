<?php
/**
 * Plugin Name:           Posts Email Notification Pro
 * Plugin URI:            https://wedevs.com/
 * Description:           Assignment 17, plugin 01
 * Version:               1.0.0
 * Author:                Asad
 * Author URI:            https://wedevs.com/
 * Text Domain:           asd-posts-email-pro
 * Requires WP at least:  4.0
 * Requires PHP at least: 5.4
 * Domain Path:           /languages/
 * License:               GPL2
 */

/**
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

/**
 * Don't call the file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main plugin class
 *
 * @class AsdPostsEmailPro
 *
 * The class that holds
 * the entire plugin
 */
final class AsdPostsEmailPro {

    /**
     * Plugin version
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Class constructor
     *
     * @since  1.0.0
     */
    public function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Initialize a singleton instance
     *
     * @since  1.0.0
     *
     * @return \AsdPostsEmailPro
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
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
        define( 'ASD_POSTS_EMAIL_PRO_VERSION', self::VERSION );
        define( 'ASD_POSTS_EMAIL_PRO_FILE', __FILE__ );
        define( 'ASD_POSTS_EMAIL_PRO_PATH', __DIR__ );
        define( 'ASD_POSTS_EMAIL_PRO_URL', plugins_url( '', ASD_POSTS_EMAIL_PRO_FILE ) );
        define( 'ASD_POSTS_EMAIL_PRO_ASSETS', ASD_POSTS_EMAIL_PRO_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function init_plugin() {
        require_once( ASD_POSTS_EMAIL_PRO_PATH . '/includes/EmailNotification.php' );
        new Asd\PostsEmailPro\EmailNotification();
    }

    /**
     * Do staff upon plugin activation
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function activate() {
        $installed = get_option( 'asd_posts_email_pro_installed' );

        if ( ! $installed ) {
            update_option( 'asd_posts_email_pro_installed', time() );
        }

        update_option( 'asd_posts_email_pro_version', ASD_POSTS_EMAIL_PRO_VERSION );
    }

    /**
     * Do stuff upon plugin deactivation
     *
     * @version 1.0.0
     *
     * @return boolean|WP_Error
     */
    public function deactivate() {
        $timestamp = wp_next_scheduled( 'asd_email_notification_cron_hook' );

        wp_unschedule_event( $timestamp, 'asd_email_notification_cron_hook' );
    }
}

/**
 * Initialize the main plugin
 *
 * @return \AsdPostsEmailPro
 */
function asd_posts_email_pro() {
    return AsdPostsEmailPro::init();
}

/**
 * Kick-off the plugin
 */
asd_posts_email_pro();
