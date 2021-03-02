<?php
/**
 * Plugin Name: Posts Email Notification
 * Description: Assignment Plugin 3 
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
final class Email_Notification {

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
     * @return \Email_Notification
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
        define( 'EMAIL_NOTIFICATION_VERSION', self::VERSION );
        define( 'EMAIL_NOTIFICATION_FILE', __FILE__ );
        define( 'EMAIL_NOTIFICATION_PATH', __DIR__ );
        define( 'EMAIL_NOTIFICATION_URL', plugins_url( '', EMAIL_NOTIFICATION_FILE ) );
        define( 'EMAIL_NOTIFICATION_ASSETS', EMAIL_NOTIFICATION_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function init_plugin() {
        if ( is_admin() ) {
            new EmailNotification\Admin();
        } else {
            new EmailNotification\Frontend();
        }

    }

    /**
     * Do staff upon plugin activation
     * 
     * @return void
     */
    public function activate() {
        $installed = get_option( 'email_notification_installed' );

        if( ! $installed ) {
            update_option( 'email_notification_installed', time() );
        }

        update_option( 'email_notification_version', EMAIL_NOTIFICATION_VERSION );
    }

}

/**
 * Initialize the main plugin
 * 
 * @return \Email_Notification
 */
function email_notification() {
    return Email_Notification::init();
}

/**
 * Kick-off the plugin
 */
email_notification();