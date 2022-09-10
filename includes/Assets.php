<?php

namespace Automatebox;

/**
 * Assets handlers class
 */
class Assets {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        //add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts() {
        return [
            'automatebox-script' => [
                'src'     => AUTOMATEBOX_ASSETS . '/js/frontend.js',
                'version' => filemtime( AUTOMATEBOX_PATH . '/assets/js/frontend.js' ),
                'deps'    => [ 'jquery' ]
            ],
            'automatebox-bootstrap-script' => [
                'src'     => AUTOMATEBOX_ASSETS . '/js/bootstrap.min.js',
                'version' => filemtime( AUTOMATEBOX_PATH . '/assets/js/bootstrap.min.js' ),
                'deps'    => [ 'jquery' ]
            ]
        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles() {
        return [
            'automatebox-style' => [
                'src'     => AUTOMATEBOX_ASSETS . '/css/frontend.css',
                'version' => filemtime( AUTOMATEBOX_PATH . '/assets/css/frontend.css' )
            ],
            'automatebox-admin-style' => [
                'src'     => AUTOMATEBOX_ASSETS . '/css/admin.css',
                'version' => filemtime( AUTOMATEBOX_PATH . '/assets/css/admin.css' )
            ],
            'automatebox-bootstrap-style' => [
                'src'     => AUTOMATEBOX_ASSETS . '/css/bootstrap.min.css',
                'version' => filemtime( AUTOMATEBOX_PATH . '/assets/css/bootstrap.min.css' )
            ]
        ];
    }

    /**
     * enqueue scripts and styles
     *
     * @return void
     */
    public function enqueue_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_enqueue_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_enqueue_style( $handle, $style['src'], $deps, $style['version'] );
        }
    }
}