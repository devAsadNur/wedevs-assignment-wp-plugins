<?php
/**
 * Plugin Name: Post Title Capitalize
 * Description: Assignment Plugin 5
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
final class Posts_Title_Capitalize {

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
     * @return \Posts_Title_Capitalize
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
        define( 'POST_TITLE_CAPITALIZE_VERSION', self::VERSION );
        define( 'POST_TITLE_CAPITALIZE_FILE', __FILE__ );
        define( 'POST_TITLE_CAPITALIZE_PATH', __DIR__ );
        define( 'POST_TITLE_CAPITALIZE_URL', plugins_url( '', POST_TITLE_CAPITALIZE_FILE ) );
        define( 'POST_TITLE_CAPITALIZE_ASSETS', POST_TITLE_CAPITALIZE_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function init_plugin() {
        new PostTitleCapitalize\Admin();
    }

    /**
     * Do staff upon plugin activation
     * 
     * @return void
     */
    public function activate() {
        $installed = get_option( 'post_title_capitalize_installed' );

        if( ! $installed ) {
            update_option( 'post_title_capitalize_installed', time() );
        }

        update_option( 'post_title_capitalize_version', POST_TITLE_CAPITALIZE_VERSION );
    }

}

/**
 * Initialize the main plugin
 * 
 * @return \Posts_Title_Capitalize
 */
function posts_title_capitalize() {
    return Posts_Title_Capitalize::init();
}

/**
 * Kick-off the plugin
 */
posts_title_capitalize();