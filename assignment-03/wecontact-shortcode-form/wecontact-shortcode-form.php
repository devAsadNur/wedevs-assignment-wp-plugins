<?php
/**
 * Plugin Name: weContact Shortcode Form
 * Description: A shortcode form plugin. Assignment 03, Plugin 01.
 * Plugin URI: https://cyberasad.com
 * Author: Asad
 * Author URI: https://cyberasad.com
 * Version: 1.0.0
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
final class WeContact_Shortcode_Form {

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
     * @return \WeContact_Shortcode_Form
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
        define( 'WC_SC_FORM_VERSION', self::VERSION );
        define( 'WC_SC_FORM_FILE', __FILE__ );
        define( 'WC_SC_FORM_PATH', __DIR__ );
        define( 'WC_SC_FORM_URL', plugins_url( '', WC_SC_FORM_FILE ) );
        define( 'WC_SC_FORM_ASSETS', WC_SC_FORM_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function init_plugin() {
        if ( is_admin() ) {
            new WeContactForm\Admin();
        } else {
            new WeContactForm\Frontend();
        }
    }

    /**
     * Do staff upon plugin activation
     * 
     * @return void
     */
    public function activate() {
        $installed = get_option( 'wc_sc_form_installed' );

        if( ! $installed ) {
            update_option( 'wc_sc_form_installed', time() );
        }

        update_option( 'wc_sc_form_installed', WC_SC_FORM_VERSION );
    }

}

/**
 * Initialize the main plugin
 * 
 * @return \WeContact_Shortcode_Form
 */
function wecontact_shortcode_form() {
    return WeContact_Shortcode_Form::init();
}

/**
 * Kick-off the plugin
 */
wecontact_shortcode_form();