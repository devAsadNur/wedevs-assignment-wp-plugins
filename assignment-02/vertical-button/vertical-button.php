<?php
/**
 * Plugin Name: Vertical Button
 * Description: Assignment 02, Plugin 01 
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
final class Vertical_Button {

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
     * @return \Vertical_Button
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
        define( 'VERTICAL_BUTTON_VERSION', self::VERSION );
        define( 'VERTICAL_BUTTON_FILE', __FILE__ );
        define( 'VERTICAL_BUTTON_PATH', __DIR__ );
        define( 'VERTICAL_BUTTON_URL', plugins_url( '', VERTICAL_BUTTON_FILE ) );
        define( 'VERTICAL_BUTTON_ASSETS', VERTICAL_BUTTON_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function init_plugin() {
        new VerticalButton\Traits();

        if ( is_admin() ) {
            new VerticalButton\Admin();
        } else {
            new VerticalButton\Frontend();
        }
    }

    /**
     * Do staff upon plugin activation
     * 
     * @return void
     */
    public function activate() {
        $installed = get_option( 'vertical_button_installed' );

        if( ! $installed ) {
            update_option( 'vertical_button_installed', time() );
        }

        update_option( 'vertical_button_version', VERTICAL_BUTTON_VERSION );
    }

}

/**
 * Initialize the main plugin
 * 
 * @return \Vertical_Button
 */
function vertical_button() {
    return Vertical_Button::init();
}

/**
 * Kick-off the plugin
 */
vertical_button();