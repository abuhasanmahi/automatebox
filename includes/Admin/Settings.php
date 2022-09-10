<?php
 
namespace Automatebox\Admin;

use Automatebox\Traits\Form_Error;
 
/**
 * Settings Handler class
 */
class Settings {
 
    use Form_Error;
    
    /**
     * Plugin page handler
     *
     * @return void
     */
    public function plugin_page() {
        //$action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
        $template = __DIR__ . '/views/settings-edit.php';
 
        if ( file_exists( $template ) ) {
            include $template;
        }
    }
 
    /**
     * Handle the form
     *
     * @return void
     */
    public function form_handler() {
        if ( ! isset( $_POST['submit_profile'] ) ) {
            return;
        }
 
        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-profile' ) ) {
            wp_die( 'Are you cheating?' );
        }
 
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }
 
        $flag_title_prefix    = isset( $_POST['flag_title_prefix'] ) ? sanitize_text_field( $_POST['flag_title_prefix'] ) : '';
        $title_prefix    = isset( $_POST['title_prefix'] ) ? sanitize_text_field( $_POST['title_prefix'] ) : '';
        $flag_title_suffix    = isset( $_POST['flag_title_suffix'] ) ? sanitize_text_field( $_POST['flag_title_suffix'] ) : '';
        $title_suffix    = isset( $_POST['title_suffix'] ) ? sanitize_text_field( $_POST['title_suffix'] ) : '';
        $post_status    = isset( $_POST['post_status'] ) ? sanitize_text_field( $_POST['post_status'] ) : '';
        $frequency    = isset( $_POST['frequency'] ) ? sanitize_text_field( $_POST['frequency'] ) : '';
        $frequency_number    = isset( $_POST['frequency_number'] ) ? sanitize_text_field( $_POST['frequency_number'] ) : '';
        $permalink    = isset( $_POST['permalink'] ) ? sanitize_text_field( $_POST['permalink'] ) : '';
        $button_text    = isset( $_POST['button_text'] ) ? sanitize_text_field( $_POST['button_text'] ) : '';
        $button_style    = isset( $_POST['button_style'] ) ? sanitize_text_field( $_POST['button_style'] ) : 0;
        $product_number    = isset( $_POST['product_number'] ) ? sanitize_text_field( $_POST['product_number'] ) : '';
        $interlink    = isset( $_POST['interlink'] ) ? sanitize_text_field( $_POST['interlink'] ) : '';
        $feature_style    = isset( $_POST['feature_style'] ) ? sanitize_text_field( $_POST['feature_style'] ) : '';
        $feature_shuffle    = isset( $_POST['feature_shuffle'] ) ? sanitize_text_field( $_POST['feature_shuffle'] ) : '';
        $custom_category    = isset( $_POST['custom_category'] ) ? sanitize_text_field( $_POST['custom_category'] ) : '';
        $custom_category_text    = isset( $_POST['cat'] ) ? sanitize_text_field( $_POST['cat'] ) : '';
        $tags    = isset( $_POST['tags'] ) ? sanitize_text_field( $_POST['tags'] ) : '';
        $content    = isset( $_POST['content'] ) ? sanitize_text_field( $_POST['content'] ) : '';
        $select_ai_introduction    = isset( $_POST['select_ai_introduction'] ) ? sanitize_text_field( $_POST['select_ai_introduction'] ) : '';
        $select_ai_product_description    = isset( $_POST['select_ai_product_description'] ) ? sanitize_text_field( $_POST['select_ai_product_description'] ) : '';
        $select_ai_buying_guide    = isset( $_POST['select_ai_buying_guide'] ) ? sanitize_text_field( $_POST['select_ai_buying_guide'] ) : '';
        $select_ai_faq    = isset( $_POST['select_ai_faq'] ) ? sanitize_text_field( $_POST['select_ai_faq'] ) : '';
        $select_ai_conclusion    = isset( $_POST['select_ai_conclusion'] ) ? sanitize_text_field( $_POST['select_ai_conclusion'] ) : '';
        $show_table    = isset( $_POST['show_table'] ) ? sanitize_text_field( $_POST['show_table'] ) : '';
        $show_table_serial    = isset( $_POST['show_table_serial'] ) ? sanitize_text_field( $_POST['show_table_serial'] ) : '';
        $show_table_img    = isset( $_POST['show_table_img'] ) ? sanitize_text_field( $_POST['show_table_img'] ) : '';
        $show_table_score    = isset( $_POST['show_table_score'] ) ? sanitize_text_field( $_POST['show_table_score'] ) : '';
        $show_table_price    = isset( $_POST['show_table_price'] ) ? sanitize_text_field( $_POST['show_table_price'] ) : '';
        $featured_img    = isset( $_POST['featured_img'] ) ? sanitize_text_field( $_POST['featured_img'] ) : '';
        $show_affiliate_disclaimer    = isset( $_POST['show_affiliate_disclaimer'] ) ? sanitize_text_field( $_POST['show_affiliate_disclaimer'] ) : '';

        $introduction = isset( $_POST['introduction'] ) ? $_POST['introduction'] : '';
        $introduction_id = isset( $_POST['introduction_id'] ) ? htmlentities(wpautop($_POST['introduction_id'])) : '';
        $introduction_id2 = isset( $_POST['introduction_id2'] ) ? htmlentities(wpautop($_POST['introduction_id2'])) : '';
        $introduction_id3 = isset( $_POST['introduction_id3'] ) ? htmlentities(wpautop($_POST['introduction_id3'])) : '';
        $introduction_id4 = isset( $_POST['introduction_id4'] ) ? htmlentities(wpautop($_POST['introduction_id4'])) : '';
        $introduction_id5 = isset( $_POST['introduction_id5'] ) ? htmlentities(wpautop($_POST['introduction_id5'])) : '';
        $buying_guide_title    = isset( $_POST['buying_guide_title'] ) ? sanitize_text_field( $_POST['buying_guide_title'] ) : '';
        $buying_guide_id = isset( $_POST['buying_guide_id'] ) ? htmlentities(wpautop($_POST['buying_guide_id'])) : '';
        $buying_guide_id2 = isset( $_POST['buying_guide_id2'] ) ? htmlentities(wpautop($_POST['buying_guide_id2'])) : '';
        $buying_guide_id3 = isset( $_POST['buying_guide_id3'] ) ? htmlentities(wpautop($_POST['buying_guide_id3'])) : '';
        $buying_guide_id4 = isset( $_POST['buying_guide_id4'] ) ? htmlentities(wpautop($_POST['buying_guide_id4'])) : '';
        $buying_guide_id5 = isset( $_POST['buying_guide_id5'] ) ? htmlentities(wpautop($_POST['buying_guide_id5'])) : '';
        $buying_guide = isset( $_POST['buying_guide'] ) ? $_POST['buying_guide'] : '';
        $conclusion_title    = isset( $_POST['conclusion_title'] ) ? sanitize_text_field( $_POST['conclusion_title'] ) : '';
        $conclusion_id = isset( $_POST['conclusion_id'] ) ? htmlentities(wpautop($_POST['conclusion_id'])) : '';
        $conclusion_id2 = isset( $_POST['conclusion_id2'] ) ? htmlentities(wpautop($_POST['conclusion_id2'])) : '';
        $conclusion_id3 = isset( $_POST['conclusion_id3'] ) ? htmlentities(wpautop($_POST['conclusion_id3'])) : '';
        $conclusion_id4 = isset( $_POST['conclusion_id4'] ) ? htmlentities(wpautop($_POST['conclusion_id4'])) : '';
        $conclusion_id5 = isset( $_POST['conclusion_id5'] ) ? htmlentities(wpautop($_POST['conclusion_id5'])) : '';
        $conclusion = isset( $_POST['conclusion'] ) ? $_POST['conclusion'] : '';
        $affiliate_disclaimer = isset( $_POST['affiliate_disclaimer'] ) ? $_POST['affiliate_disclaimer'] : '';
        $show_product_description    = isset( $_POST['show_product_description'] ) ? sanitize_text_field( $_POST['show_product_description'] ) : '';

        $value = array(
            'flag_title_prefix' => $flag_title_prefix,
            'title_prefix' => $title_prefix,
            'flag_title_suffix' => $flag_title_suffix,
            'title_suffix' => $title_suffix,
            'table_of_content' => 1,
            'permalink' => $permalink,
            'button_text' => $button_text,
            'button_style' => $button_style,
            'interlink' => $interlink,
            'feature_style' => $feature_style,
            'feature_shuffle' => $feature_shuffle,
            'custom_category' => $custom_category,
            'custom_category_text' => $custom_category_text,
            'tags' => $tags,
            'content' => $content,
            'select_ai_introduction' => $select_ai_introduction,
            'select_ai_product_description' => $select_ai_product_description,
            'select_ai_buying_guide' => $select_ai_buying_guide,
            'select_ai_faq' => $select_ai_faq,
            'select_ai_conclusion' => $select_ai_conclusion,
            'product_number' => $product_number,
            'introduction' => $introduction,
            'introduction_id' => $introduction_id,
            'introduction_id2' => $introduction_id2,
            'introduction_id3' => $introduction_id3,
            'introduction_id4' => $introduction_id4,
            'introduction_id5' => $introduction_id5,
            'buying_guide_title' => $buying_guide_title,
            'buying_guide_id' => $buying_guide_id,
            'buying_guide_id2' => $buying_guide_id2,
            'buying_guide_id3' => $buying_guide_id3,
            'buying_guide_id4' => $buying_guide_id4,
            'buying_guide_id5' => $buying_guide_id5,
            'buying_guide' => $buying_guide,
            'conclusion_title' => $conclusion_title,
            'conclusion_id' => $conclusion_id,
            'conclusion_id2' => $conclusion_id2,
            'conclusion_id3' => $conclusion_id3,
            'conclusion_id4' => $conclusion_id4,
            'conclusion_id5' => $conclusion_id5,
            'conclusion' => $conclusion,
            'post_status' => $post_status,
            'frequency' => $frequency,
            'frequency_number' => $frequency_number,
            'show_table' => $show_table,
            'show_table_serial' => $show_table_serial,
            'show_table_img' => $show_table_img,
            'show_table_score' => $show_table_score,
            'show_table_price' => $show_table_price,
            'featured_img' => $featured_img,
            'show_affiliate_disclaimer' => $show_affiliate_disclaimer,
            'affiliate_disclaimer' => $affiliate_disclaimer,
            'show_product_description' => $show_product_description,
            'active_continue_reading' => '',
            'carousel' => '',
            'show_img_excerpt' => 0,
            'display_product_details' => 1,
            'country_block_list' => '',
            'ip_block_list' => '',
            'footer_script' => '',
            'time' => time()
        );
        
        update_option( 'automatebox_settings', $value );        
        $redirected_to = admin_url( 'admin.php?page=automatebox&inserted=true' );
        wp_redirect( $redirected_to );
        exit;
    }
}