<?php
/**
 * Plugin Name:           Book Review Plus
 * Plugin URI:            https://wedevs.com/
 * Description:           Assignment 6, plugin 1
 * Version:               1.0.0
 * Author:                Asad
 * Author URI:            https://wedevs.com/
 * Text Domain:           asd-book-review-plus
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
    return;
}
require_once __DIR__ . "/vendor/autoload.php";

/**
 * Main plugin class
 *
 * @class Asd_Book_Review_Plus
 *
 * The class that holds
 * the entire plugin
 */
final class AsdBookReviewPlus {

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
     * @return \AsdBookReviewPlus
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
        define( 'ASD_BOOK_REVIEW_PLUS_VERSION', self::VERSION );
        define( 'ASD_BOOK_REVIEW_PLUS_FILE', __FILE__ );
        define( 'ASD_BOOK_REVIEW_PLUS_PATH', __DIR__ );
        define( 'ASD_BOOK_REVIEW_PLUS_URL', plugins_url( '', ASD_BOOK_REVIEW_PLUS_FILE ) );
        define( 'ASD_BOOK_REVIEW_PLUS_ASSETS', ASD_BOOK_REVIEW_PLUS_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function init_plugin() {
        new Asd\BookReviewPlus\Menu();
        new Asd\BookReviewPlus\CustomPostBook();
        new Asd\BookReviewPlus\CustomTaxonomyGenre();
        new Asd\BookReviewPlus\Metabox();
        new Asd\BookReviewPlus\Shortcode();
    }

    /**
     * Do staff upon plugin activation
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function activate() {
        $installed = get_option( 'asd_book_review_plus_installed' );

        if( ! $installed ) {
            update_option( 'asd_book_review_plus_installed', time() );
        }

        update_option( 'asd_book_review_plus_version', ASD_BOOK_REVIEW_PLUS_VERSION );
    }

}

/**
 * Initialize the main plugin.
 *
 * @return \AsdBookReviewPlus
 */
function asd_book_review_plus() {
    return AsdBookReviewPlus::init();
}

/**
 * Kick-off the plugin
 */
asd_book_review_plus();
