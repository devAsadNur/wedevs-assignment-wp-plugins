<?php
/**
 * Plugin Name:           Book Review Plus Plus
 * Plugin URI:            https://wedevs.com/
 * Description:           Assignment 07, plugin 01
 * Version:               1.0.0
 * Author:                Asad
 * Author URI:            https://wedevs.com/
 * Text Domain:           asd-book-review-pp
 * Requires WP at least:  4.0
 * Requires PHP at least: 5.4
 * Domain Path:           /languages/
 * License:               GPL2
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

/**
 * Don't call the file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include the autoloader
 */
if ( ! file_exists( __DIR__ . "/vendor/autoload.php" ) ) {
    wp_die( 'Composer auto-loader missing. Run "composer update" command.' );
}
require_once __DIR__ . "/vendor/autoload.php";

/**
 * Main plugin class
 *
 * @class AsdBookReviewPP
 *
 * The class that holds
 * the entire plugin
 */
final class AsdBookReviewPP {

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

        $this->init_plugin();
    }

    /**
     * Initialize a singleton instance
     *
     * @since  1.0.0
     *
     * @return \AsdBookReviewPP
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
        define( 'ASD_BOOK_REVIEW_PP_VERSION', self::VERSION );
        define( 'ASD_BOOK_REVIEW_PP_FILE', __FILE__ );
        define( 'ASD_BOOK_REVIEW_PP_PATH', __DIR__ );
        define( 'ASD_BOOK_REVIEW_PP_URL', plugins_url( '', ASD_BOOK_REVIEW_PP_FILE ) );
        define( 'ASD_BOOK_REVIEW_PP_ASSETS', ASD_BOOK_REVIEW_PP_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function init_plugin() {
        if ( is_admin() ) {
            new Asd\BookReviewPP\Admin\Menu();
            new Asd\BookReviewPP\Admin\Metabox();
        } else {
            new Asd\BookReviewPP\Shortcode();
        }

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new Asd\BookReviewPP\Ajax();
        }

        new Asd\BookReviewPP\CustomPost();
        new Asd\BookReviewPP\CustomTaxonomy();
        new Asd\BookReviewPP\Assets();
    }

    /**
     * Do staff upon plugin activation
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function activate() {
        $installer = new Asd\BookReviewPP\Install\Installer();
        $installer->run();
    }
}

/**
 * Initialize the main plugin.
 *
 * @return \AsdBookReviewPP
 */
function asd_book_review_pp() {
    return AsdBookReviewPP::init();
}

/**
 * Kick-off the plugin
 */
asd_book_review_pp();
