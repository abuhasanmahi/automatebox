<?php
/**
 * Plugin Name:       Automatebox
 * Plugin URI:        https://github.com/abuhasanmahi/automatebox
 * Description:       Amazon Automation
 * Version:           4.0.0
 * Author:            Abu Hasan Mahi
 * Author URI:        https://automatebox.com
 * License:           GPL v2 or later
 * Text Domain:       automatebox
 * Domain Path:       /languages
 */
 
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/abuhasanmahi/automatebox',
	__FILE__,
	'Automatebox'
);
$myUpdateChecker->setBranch('main');

if( ! defined( 'ABSPATH') ) {
    exit;
}
ini_set("memory_limit","128M");
ini_set('max_execution_time', 3900);
//Flush All Cache
wp_cache_flush();

require_once __DIR__ . '/vendor/autoload.php';

final class automatebox {
    
    const version = '4.0.0';

    //class constructor
    private function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /*
    * initializes a singleton instance
    * @return \automatebox
    */
    public static function init() {
        static $instance = false;
 
        if( ! $instance ) {
            $instance = new self();
        }
 
        return $instance;
    }

    public function define_constants() {
        define( 'AUTOMATEBOX_VERSION', self::version );
        define( 'AUTOMATEBOX_FILE', __FILE__ );
        define( 'AUTOMATEBOX_PATH', __DIR__ );
        define( 'AUTOMATEBOX_URL', plugins_url( '', AUTOMATEBOX_FILE ) );
        define( 'AUTOMATEBOX_ASSETS', AUTOMATEBOX_URL . '/assets' );
        define( 'AUTOMATEBOX_KEY', serialize( get_option('automatebox_key')) );
        define( 'AUTOMATEBOX_AMAZON_KEY', serialize( get_option('automatebox_amazon_key')) );
        define( 'AUTOMATEBOX_OPTIONS', serialize( get_option('automatebox_settings')) );
    }

    public function init_plugin() {
        new Automatebox\Assets();

        if ( is_admin() ) {
            new Automatebox\Admin();
        } else {
            new Automatebox\Frontend();
        }
    }

    public function activate() {
        $installer = new Automatebox\Installer();
        $installer->run();
    }

}

/*
* initializes the main plugin
* @return \automatebox
*/
function automatebox() {
    return AUTOMATEBOX::init();
}

//kick-off the plugin
automatebox();