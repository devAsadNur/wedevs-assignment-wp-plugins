<?php
/**
 * Plugin Name: Posts View Plus
 * Description: Assignment Plugin 2
 * Plugin URI: https://cyberasad.com
 * Author: Asad
 * Author URI: https://cyberasad.com
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include the autoloader
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Posts_View_Plus {

    /**
     * Plugin version
     * 
     * @var string
     */
    const VERSION = '1.0';

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
     * @return \Posts_View_Plus
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
     * @return void
     */
    public function define_constants() {
        define( 'POSTS_VIEW_PLUS_VERSION', self::VERSION );
        define( 'POSTS_VIEW_PLUS_FILE', __FILE__ );
        define( 'POSTS_VIEW_PLUS_PATH', __DIR__ );
        define( 'POSTS_VIEW_PLUS_URL', plugins_url( '', POSTS_VIEW_PLUS_FILE ) );
        define( 'POSTS_VIEW_PLUS_ASSETS', POSTS_VIEW_PLUS_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function init_plugin() {
        new PostsViewPlus\Admin();
        new PostsViewPlus\Frontend();
    }

    /**
     * Do staff upon plugin activation
     * 
     * @return void
     */
    public function activate() {
        $installed = get_option( 'posts_view_plus_installed' );

        if( ! $installed ) {
            update_option( 'posts_view_plus_installed', time() );
        }

        update_option( 'posts_view_plus_version', POSTS_VIEW_PLUS_VERSION );
    }

}

/**
 * Initialize the main plugin
 * 
 * @return \Posts_View_Plus
 */
function posts_view_plus() {
    return Posts_View_Plus::init();
}

/**
 * Kick-off the plugin
 */
posts_view_plus();