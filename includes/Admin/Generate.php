<?php
 
namespace Automatebox\Admin;

use Automatebox\Traits\Form_Error;
 
/**
 * Settings Handler class
 */
class Generate {
 
    use Form_Error;
    
    /**
     * Plugin page handler
     *
     * @return void
     */
    public function generate_page() {
            
        if (the_slug_exists('dmca') || the_slug_exists('privacy-policy') || the_slug_exists('disclaimer') || the_slug_exists('contact')) {
            $template = __DIR__ . '/views/generate2.php';
        }else{
            $template = __DIR__ . '/views/generate.php';
        }
        
 
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
        if ( ! isset( $_POST['generate_pages'] ) ) {
            return;
        }
 
        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'generate-pages' ) ) {
            wp_die( 'Are you cheating?' );
        }
 
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }

        $dmca_content = file_get_contents(dirname(__FILE__).'/pages/dmca.php');
        $policy_content = file_get_contents(dirname(__FILE__).'/pages/policy.php');
        $disclaimer_content = file_get_contents(dirname(__FILE__).'/pages/disclaimer.php');

        $cf7_args = array(
            'posts_per_page'   => 1,
            'numberposts'      =>1,
            'orderby'          => 'ID',
            'order'            => 'ASC',
            'post_type'        => 'wpcf7_contact_form',
            'post_status'      => 'publish'
        );
        $cf7Form = (get_posts( $cf7_args ))? get_posts( $cf7_args )[0] : '';
        $cf7ID = !empty($cf7Form)? $cf7Form->ID : 1234;
        
        $cf7shortcode = '<h3>Contact Us</h3>[contact-form-7 id="'.$cf7ID.'" title="Contact form"]';

        $pages = array(
            'contact'=>'Contact Us',
            'dmca'=>'DMCA',
            'privacy-policy'=>'Privacy Policy',
            'disclaimer'=>'Disclaimer'
        );

        $contents = array(
            'contact'=> $cf7shortcode,
            'dmca'=> $dmca_content,
            'privacy-policy'=> $policy_content,
            'disclaimer'=> $disclaimer_content
        );

        
        foreach($pages as $page=>$title){

            $contactPageID = get_page_by_path('contact', OBJECT, 'page');
            $contactLink = ($page!='contact')? get_permalink($contactPageID) : '';
            $content = ($page!='contact')? str_replace('{contact_link}', $contactLink, $contents[$page]) : $contents[$page];
            $content = str_replace('{HOST_NAME}', $_SERVER['HTTP_HOST'], $content);
            $my_post = array(
                'post_name'     => $page,
                'post_title'    => $title,
                'post_content'  => $content,
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_date'     => date('Y-m-d H:i:s'),
                'post_date_gmt' => date('Y-m-d H:i:s'),
                'post_author'   => get_current_user_id()
            );
            
            // Insert the post into the database
            $insert_post = wp_insert_post( $my_post );
        }

        $redirected_to = admin_url( 'admin.php?page=automatebox-generate&generate-updated=true');
        
        wp_redirect( $redirected_to );
        exit;
    }
}