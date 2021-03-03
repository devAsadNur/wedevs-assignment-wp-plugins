<?php
/**
 * Plugin Name: SEO Meta Inserter
 * Description: Assignment 02, Plugin 02
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
final class SEO_Meta_Inserter {

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
     * @return \SEO_Meta_Inserter
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
        define( 'SEO_META_INSERTER_VERSION', self::VERSION );
        define( 'SEO_META_INSERTER_FILE', __FILE__ );
        define( 'SEO_META_INSERTER_PATH', __DIR__ );
        define( 'SEO_META_INSERTER_URL', plugins_url( '', SEO_META_INSERTER_FILE ) );
        define( 'SEO_META_INSERTER_ASSETS', SEO_META_INSERTER_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function init_plugin() { 
        new SeoMetaInserter\Traits();

        if( is_admin() ) {
            new SeoMetaInserter\Admin();
        }
    }

    /**
     * Do staff upon plugin activation
     * 
     * @return void
     */
    public function activate() {
        $installed = get_option( 'seo_meta_inserter_installed' );

        if( ! $installed ) {
            update_option( 'seo_meta_inserter_installed', time() );
        }

        update_option( 'seo_meta_inserter_version', SEO_META_INSERTER_VERSION );
    }

}

/**
 * Initialize the main plugin
 * 
 * @return \SEO_Meta_Inserter
 */
function seo_meta_inserter() {
    return SEO_Meta_Inserter::init();
}

/**
 * Kick-off the plugin
 */
seo_meta_inserter();