<?php
/**
 * Plugin Name: Posts Email Notification Plus
 * Description: Assignment Plugin 4
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
final class Email_Notification_Plus {

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
     * @return \Email_Notification_Plus
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
        define( 'EMAIL_NOTIFICATION_PLUS_VERSION', self::VERSION );
        define( 'EMAIL_NOTIFICATION_PLUS_FILE', __FILE__ );
        define( 'EMAIL_NOTIFICATION_PLUS_PATH', __DIR__ );
        define( 'EMAIL_NOTIFICATION_PLUS_URL', plugins_url( '', EMAIL_NOTIFICATION_PLUS_FILE ) );
        define( 'EMAIL_NOTIFICATION_PLUS_ASSETS', EMAIL_NOTIFICATION_PLUS_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function init_plugin() {
        new EmailNotificationPlus\Admin();
    }

    /**
     * Do staff upon plugin activation
     * 
     * @return void
     */
    public function activate() {
        $installed = get_option( 'Email_Notification_Plus_installed' );

        if( ! $installed ) {
            update_option( 'Email_Notification_Plus_installed', time() );
        }

        update_option( 'Email_Notification_Plus_version', EMAIL_NOTIFICATION_PLUS_VERSION );
    }

}

/**
 * Initialize the main plugin
 * 
 * @return \Email_Notification_Plus
 */
function email_notification_plus() {
    return Email_Notification_Plus::init();
}

/**
 * Kick-off the plugin
 */
email_notification_plus();