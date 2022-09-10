<?php
 
namespace Automatebox\Admin;

use Automatebox\Admin\Keyword;
 
/**
 * The Menu handler class
 */
class Menu {
 
    public $settings;
 
    /**
     * Initialize the class
     */
    function __construct( ) {
        //$this->settings = $settings;
 
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }
 
    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu() {
        $parent_slug = 'automatebox-key';
        $capability = 'manage_options';
 
        $hook = add_menu_page( __( 'Automatebox', 'automatebox' ), __( 'Automatebox', 'automatebox' ), $capability, $parent_slug, [ $this, 'key_page' ], 'dashicons-amazon' );
        add_submenu_page( $parent_slug, __( 'Key Validation', 'automatebox' ), __( 'Key Validation', 'automatebox' ), $capability, 'automatebox-key', [ $this, 'key_page' ] );
        add_submenu_page( $parent_slug, __( 'Settings', 'automatebox' ), __( 'Settings', 'automatebox' ), $capability, 'automatebox', [ $this, 'plugin_page' ] );
        add_submenu_page( $parent_slug, __( 'Keyword', 'automatebox' ), __( 'Keyword', 'automatebox' ), $capability, 'automatebox-keyword', [ $this, 'keyword_page' ] );
        
        $key = !empty(AUTOMATEBOX_KEY) ? unserialize(AUTOMATEBOX_KEY) :'';
        $word_limit = !empty($key['word_limit'])? $key['word_limit']:0;
        if($word_limit > 0){
            add_submenu_page( $parent_slug, __( 'Article', 'automatebox' ), __( 'Article', 'automatebox' ), $capability, 'automatebox-article', [ $this, 'article_page' ] );
        }
        add_submenu_page( $parent_slug, __( 'Generate Pages', 'automatebox' ), __( 'Generate Pages', 'automatebox' ), $capability, 'automatebox-generate', [ $this, 'generate_page' ] );
        
        add_action( 'admin_head-' . $hook, [ $this, 'enqueue_assets' ] );
    }
 
    public function plugin_page() {
        $settings = new Settings();
        $settings->plugin_page();
    }
    
    public function keyword_page() {
        $keyword = new Keyword();
        $keyword->keyword_page();
    }

    public function article_page() {
        $article = new Article();
        $article->article_page();
    }

    public function generate_page() {
        $keyword = new Generate();
        $keyword->generate_page();
    }

    public function key_page() {
        $keyword = new Key();
        $keyword->key_page();
    }

    public function enqueue_assets() {
        wp_enqueue_style( 'automatebox-admin-style' );
    }
}