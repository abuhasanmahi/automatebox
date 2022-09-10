<?php
 
namespace Automatebox;
 
/**
 * The admin class
 */
class Admin {
 
    /**
     * Initialize the class
     */
    function __construct() {
        $this->dispatch_actions();
        new Admin\Menu();
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions() {
        $settings = new Admin\Settings();

        add_action( 'admin_init', [ $settings, 'form_handler' ] );

        $keyword = new Admin\Keyword();

        add_action( 'admin_init', [ $keyword, 'form_handler' ] );
        add_action( 'admin_post_wd-delete-keyword', [ $keyword, 'delete_keyword' ] );

        $article = new Admin\Article();

        add_action( 'admin_init', [ $article, 'form_handler' ] );
        add_action( 'admin_post_wd-delete-article', [ $article, 'delete_article' ] );

        $generate = new Admin\Generate();

        add_action( 'admin_init', [ $generate, 'form_handler' ] );

        $key = new Admin\Key();

        add_action( 'admin_init', [ $key, 'form_handler' ] );
    }
}