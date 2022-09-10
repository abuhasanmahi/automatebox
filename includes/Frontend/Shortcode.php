<?php
 
namespace Automatebox\Frontend;
 
/**
 * Shortcode handler class
 */
class Shortcode {
 
    /**
     * Initializes the class
     */
    function __construct() {
        add_shortcode( 'automatebox-current-year', [ $this, 'render_shortcode' ] );
        
        add_shortcode( 'automatebox-tracking-id1', [ $this, 'tracking_id' ] );
        add_shortcode( 'automatebox-button-text1', [ $this, 'button_text' ] );
        add_shortcode( 'automatebox-button-style1', [ $this, 'button_style' ] );
        add_shortcode( 'automatebox-interlink1', [ $this, 'interlink' ] );
        add_shortcode( 'automatebox-feature-style1', [ $this, 'feature_style' ] );
        add_shortcode( 'automatebox-disclaimer1', [ $this, 'disclaimer' ] );

        add_shortcode( 'automatebox-tracking-id2', [ $this, 'tracking_id' ] );
        add_shortcode( 'automatebox-button-text2', [ $this, 'button_text' ] );
        add_shortcode( 'automatebox-button-style2', [ $this, 'button_style2' ] );
        add_shortcode( 'automatebox-interlink2', [ $this, 'interlink' ] );
        add_shortcode( 'automatebox-feature-style2', [ $this, 'feature_style' ] );
        add_shortcode( 'automatebox-disclaimer2', [ $this, 'disclaimer' ] );
    }
 
    /**
     * Shortcode handler class
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_shortcode( $atts, $content = '' ) {
        $year = date("Y");
        return $year;
    }

    public function tracking_id( $atts, $content = '' ) {
        $settings = !empty(AUTOMATEBOX_AMAZON_KEY) ? unserialize(AUTOMATEBOX_AMAZON_KEY) :'';
        return $settings['tracking_id'];
    }

    public function button_text( $atts, $content = '' ) {
        $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
        return $settings['button_text'];
    }

    public function button_style( $atts, $content = '' ) {
        $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
        if($settings['button_style'] == 0){
            return 'automatebox-button-text';
        }else{
            return 'automatebox-button-text3'; //dashicons dashicons-cart
        }
    }

    public function button_style2( $atts, $content = '' ) {
        $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
        if($settings['button_style'] == 0){
            return 'automatebox-button-text2';
        }else{
            return 'automatebox-button-text4'; //dashicons dashicons-cart
        }
    }

    public function interlink( $atts, $content = '' ) {
        $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
        if($settings['interlink'] == 1){
            //$postId = get_the_ID();
            $show_related_post = show_related_post(3);
            if($show_related_post != NULL){
                $related_post = '<p></p>';
                $related_post .= '<table class="table table-bordered table-sm">';
                $related_post .= '<tr><th class="table-active">Related Posts</th></tr><tr><td>';
                $related_post .= show_related_post(3);
                $related_post .= '</td></tr></table>';
                $related_post .= '<p></p>';
                return $related_post;
            }
        }
    }

    public function feature_style( $atts, $content = '' ) {
        $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
        return $settings['feature_style'];
    }

    public function disclaimer( $atts, $content = '' ) {
        $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
        if($settings['show_affiliate_disclaimer'] == 1){
            return $settings['affiliate_disclaimer'];
        }
    }
}