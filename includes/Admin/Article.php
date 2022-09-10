<?php
 
namespace Automatebox\Admin;

use Automatebox\Traits\Form_Error;
 
/**
 * Article Handler class
 */
class Article {
 
    use Form_Error;
    
    /**
     * Plugin page handler
     *
     * @return void
     */
    public function article_page() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        
        switch ( $action ) {
            case 'new':
                $template = __DIR__ . '/views/article-new.php';
                break;
 
            case 'processing':
                $fetch_profiles_processing = wd_article_gets_processing();
                $template = __DIR__ . '/views/article-processing.php';
                break;
     
            case 'view':
                $template = __DIR__ . '/views/article-list.php';
                break;
 
            default:
                $template = __DIR__ . '/views/article-list.php';
                break;
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
        if ( ! isset( $_POST['submit_article'] ) ) {
            return;
        }
 
        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-article' ) ) {
            wp_die( 'Are you cheating?' );
        }
 
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }
 
        $articles2   = isset( $_POST['article'] ) ? sanitize_textarea_field( $_POST['article'] ) : '';
        $articles   = preg_split('/\r\n|\r|\n/', $articles2);
 
        if ( empty( $articles2 ) ) {
            $this->errors['article'] = __( 'Please enter Article', 'automatebox' );
        }
 
        if ( ! empty( $this->errors ) ) {
            return;
        }

        $length    = isset( $_POST['length'] ) ? sanitize_text_field( $_POST['length'] ) : '';
        $section_heading    = isset( $_POST['section_heading'] ) ? sanitize_text_field( $_POST['section_heading'] ) : 0;
        $faq_flag    = isset( $_POST['faq'] ) ? sanitize_text_field( $_POST['faq'] ) : 0;
        $conclusion_flag    = isset( $_POST['conclusion'] ) ? sanitize_text_field( $_POST['conclusion'] ) : 0;
        
        $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
        $automatebox_key = !empty(AUTOMATEBOX_KEY) ? unserialize(AUTOMATEBOX_KEY) :'';
        $amazon_key = !empty(AUTOMATEBOX_AMAZON_KEY) ? unserialize(AUTOMATEBOX_AMAZON_KEY) :'';

        $customer_id = !empty($automatebox_key['customer_id'])? $automatebox_key['customer_id']:'';
        $key1 = !empty($automatebox_key['key1'])? $automatebox_key['key1']:'';
        $key2 = !empty($automatebox_key['key2'])? $automatebox_key['key2']:'';
        $validation_ip = !empty($automatebox_key['validation_ip'])? $automatebox_key['validation_ip']:'';
        $destination_ip = !empty($automatebox_key['destination_ip'])? $automatebox_key['destination_ip']:'';
        $article_ip = !empty($automatebox_key['article_ip'])? $automatebox_key['article_ip']:'';
        $forge_initiate_ip = !empty($automatebox_key['forge_initiate_ip'])? $automatebox_key['forge_initiate_ip']:'';
        $forge_publish_ip = !empty($automatebox_key['forge_publish_ip'])? $automatebox_key['forge_publish_ip']:'';
        $quota = !empty($automatebox_key['quota'])? $automatebox_key['quota']:0;
        $ai_quota = !empty($automatebox_key['ai_quota'])? $automatebox_key['ai_quota']:0;
        $word_limit = !empty($automatebox_key['word_limit'])? $automatebox_key['word_limit']:0;
        $amazon_key_status = !empty($amazon_key['status'])? $amazon_key['status']:0;

        if($amazon_key_status == 0){
            $redirected_to = admin_url( 'admin.php?page=automatebox-article&invalidamazon=true' );
        }elseif($customer_id == ''){
            $redirected_to = admin_url( 'admin.php?page=automatebox-article&invalidcustomer=true' );
        }elseif($key1 == '' || $key2 == ''){
            $redirected_to = admin_url( 'admin.php?page=automatebox-article&invalidkey=true' );
        }elseif($destination_ip == ''){
            $redirected_to = admin_url( 'admin.php?page=automatebox-article&invalidip=true' );
        }elseif($word_limit < 1){
            $redirected_to = admin_url( 'admin.php?page=automatebox-article&nowordlimit=true' );
        }else{

            $tracking_id = !empty($amazon_key['tracking_id'])? $amazon_key['tracking_id']:'';
            $access_key = !empty($amazon_key['access_key'])? $amazon_key['access_key']:'';
            $secret_key = !empty($amazon_key['secret_key'])? $amazon_key['secret_key']:'';
            $partner_tag = !empty($amazon_key['partner_tag'])? $amazon_key['partner_tag']:'';
            $flag_title_prefix = !empty($settings['flag_title_prefix'])? $settings['flag_title_prefix']:0;
            $title_prefix = !empty($settings['title_prefix'])? $settings['title_prefix']:'';
            $flag_title_suffix = !empty($settings['flag_title_suffix'])? $settings['flag_title_suffix']:0;
            $title_suffix = !empty($settings['title_suffix'])? $settings['title_suffix']:'';
            $permalink = !empty($settings['permalink'])? $settings['permalink']:'';
            $button_text = !empty($settings['button_text'])? $settings['button_text']:'Check Price';
            $button_style = !empty($settings['button_style'])? $settings['button_style']:0;
            $interlink = !empty($settings['interlink'])? $settings['interlink']:0;
            $feature_style = !empty($settings['feature_style'])? $settings['feature_style']:0;
            $feature_shuffle = !empty($settings['feature_shuffle'])? $settings['feature_shuffle']:0;
            $content = !empty($settings['content'])? $settings['content']:0;
            $custom_category    = !empty($settings['custom_category'])? $settings['custom_category']:0;
            $custom_category_text    = !empty($settings['custom_category_text'])? $settings['custom_category_text']:'';
            $product_number = !empty($settings['product_number'])? $settings['product_number']:'10';
            $introduction = !empty($settings['introduction'])? $settings['introduction']:'';
            $buying_guide = !empty($settings['buying_guide'])? $settings['buying_guide']:'';
            $conclusion = !empty($settings['conclusion'])? $settings['conclusion']:'';
            $post_status = !empty($settings['post_status'])? $settings['post_status']:0;
            $frequency = !empty($settings['frequency'])? $settings['frequency']:0;
            $show_table = !empty($settings['show_table'])? $settings['show_table']:1;
            $show_table_img = !empty($settings['show_table_img'])? $settings['show_table_img']:1;
            $featured_img = !empty($settings['featured_img'])? $settings['featured_img']:1;  
            $show_affiliate_disclaimer = !empty($settings['show_affiliate_disclaimer'])? $settings['show_affiliate_disclaimer']:1;
            if($show_affiliate_disclaimer == 1){
                $affiliate_disclaimer = !empty($settings['affiliate_disclaimer'])? $settings['affiliate_disclaimer']:'';
            }else{
                $affiliate_disclaimer = '';
            }

            $domain = home_url();
            $domain = explode("/", preg_replace('/^(https?)\:\/\/(www\.)?(.*)\/?$/isU',"$3", $domain));
            $domain = trim($domain[0]," \r\n\t/");

            foreach($articles as $article){

                $fetch_profiles = wd_article_gets_all();
                $duplicate_article = 0;
                foreach( $fetch_profiles as $value ) {
                    if (trim($value->article) == trim($article)){
                        $duplicate_article = 1;
                    }
                }

                if($word_limit < 1){
                    $redirected_to = admin_url( 'admin.php?page=automatebox-article&nowordlimit=true' );
                }elseif($duplicate_article == 0){
                    
                    $postdata=http_build_query(
                        array(
                            'customer_id' => $customer_id,
                            'key1' => $key1,
                            'key2' => $key2,
                            'validation_ip' => $validation_ip,
                            'destination_ip' => $destination_ip,
                            'article_ip' => $article_ip,
                            'forge_initiate_ip' => $forge_initiate_ip,
                            'forge_publish_ip' => $forge_publish_ip,
                            'quota' => $quota,
                            'ai_quota' => $ai_quota,
                            'word_limit' => $word_limit,
                            'tracking_id' => $tracking_id, 
                            'access_key' => $access_key,
                            'secret_key' => $secret_key, 
                            'partner_tag' => $partner_tag,
                            'flag_title_prefix' => $flag_title_prefix,
                            'title_prefix' => $title_prefix,
                            'flag_title_suffix' => $flag_title_suffix,
                            'title_suffix' => $title_suffix,
                            'permalink' => $permalink,
                            'button_text' => $button_text,
                            'button_style' => $button_style,
                            'interlink' => $interlink,
                            'feature_style' => $feature_style,
                            'feature_shuffle' => $feature_shuffle,
                            'content' => $content,
                            'product_number' => $product_number,
                            'introduction' => $introduction,
                            'buying_guide' => $buying_guide,
                            'conclusion' => $conclusion,
                            'post_status' => $post_status,
                            'frequency' => $frequency,
                            'show_table' => $show_table,
                            'show_table_img' => $show_table_img,
                            'featured_img' => $featured_img,
                            'show_affiliate_disclaimer' => $show_affiliate_disclaimer,
                            'affiliate_disclaimer' => $affiliate_disclaimer,
                            'active_continue_reading' => '',
                            'carousel' => '',
                            'show_img_excerpt' => 0,
                            'display_product_details' => 1,
                            'country_block_list' => '',
                            'ip_block_list' => '',
                            'footer_script' => '',
                            'time' => time(),
                            'article' => $article,
                            'domain' => $domain,
                            'length' => $length,
                            'section_heading' => $section_heading,
                            'faq_flag' => $faq_flag,
                            'conclusion_flag' => $conclusion_flag
                        )
                    );
                    $opts = array('http' =>
                        array(
                            'method' => 'POST',
                            'header' => 'Content-type: application/x-www-form-urlencoded',
                            'content' => $postdata,
                        )
                    );
                    $context = stream_context_create($opts);
                    $response = file_get_contents($forge_initiate_ip,false,$context);
                    $data = json_decode($response,true);

                    if($data['msgcode'] == '200'){
                        $status = 'processing';

                        $args = [
                            'article'    => $article,
                            'profile'    => 0,
                            'ref_key'    => $data['ref_key'],
                            'status'     => $status
                        ];

                        $insert_id = wd_article_insert( $args );
                
                        if ( is_wp_error( $insert_id ) ) {
                            wp_die( $insert_id->get_error_message() );
                        }

                        $value = array(
                            'customer_id' => $data['customer_id'],
                            'key1' => $data['key1'],
                            'key2' => $data['key2'],
                            'validation_ip' => $data['validation_ip'],
                            'destination_ip' => $data['destination_ip'],
                            'article_ip' => $data['article_ip'],
                            'forge_initiate_ip' => $data['forge_initiate_ip'],
                            'forge_publish_ip' => $data['forge_publish_ip'],
                            'quota' => $data['quota'],
                            'ai_quota' => $data['ai_quota'],
                            'word_limit' => $data['word_limit'],
                        );
                        update_option( 'automatebox_key', $value );

                        $redirected_to = admin_url( 'admin.php?page=automatebox-article&processed=true' );
                    }else{
                        if($data['msgcode'] == '103'){
                            $args = [
                                'article'    => $article,
                                'profile'    => 0,
                                'status'    => 'invaild key'
                            ];
        
                            $insert_id = wd_article_insert( $args );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-article&invalidkey=true' );
                        }elseif($data['msgcode'] == '105'){
                            $args = [
                                'article'    => $article,
                                'profile'    => 0,
                                'status'    => 'Word Limit Exceeds'
                            ];
        
                            $insert_id = wd_article_insert( $args );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-article&nowordlimit=true' );
                        }elseif($data['msgcode'] == '110'){
                            $args = [
                                'article'    => $article,
                                'profile'    => 0,
                                'status'    => 'Article Generation Error'
                            ];
        
                            $insert_id = wd_article_insert( $args );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-article&articlegenerationerror=true' );
                        }else{
                            $args = [
                                'article'    => $article,
                                'profile'    => 0,
                                'status'    => 'failed'
                            ];
        
                            $insert_id = wd_article_insert( $args );
                            
                            $redirected_to = admin_url( 'admin.php?page=automatebox-article&undetectedfailure=true' );
                        }
                    }

                }else{
                    $fetch_profiles_processing = wd_article_gets_processing();
                    $processing_article = 0;
                    foreach( $fetch_profiles_processing as $value ) {
                        if (trim($value->article) == trim($article)){
                            $article_id = $value->id;
                            $processing_article = 1;
                            $ref_key = $value->ref_key;
                        }
                    }

                    if($processing_article == 1){

                        $postdata=http_build_query(
                            array(
                                'customer_id' => $customer_id,
                                'key1' => $key1,
                                'key2' => $key2,
                                'validation_ip' => $validation_ip,
                                'destination_ip' => $destination_ip,
                                'article_ip' => $article_ip,
                                'forge_initiate_ip' => $forge_initiate_ip,
                                'forge_publish_ip' => $forge_publish_ip,
                                'quota' => $quota,
                                'ai_quota' => $ai_quota,
                                'word_limit' => $word_limit,
                                'tracking_id' => $tracking_id, 
                                'access_key' => $access_key,
                                'secret_key' => $secret_key, 
                                'partner_tag' => $partner_tag,
                                'flag_title_prefix' => $flag_title_prefix,
                                'title_prefix' => $title_prefix,
                                'flag_title_suffix' => $flag_title_suffix,
                                'title_suffix' => $title_suffix,
                                'permalink' => $permalink,
                                'button_text' => $button_text,
                                'button_style' => $button_style,
                                'interlink' => $interlink,
                                'feature_style' => $feature_style,
                                'feature_shuffle' => $feature_shuffle,
                                'content' => $content,
                                'product_number' => $product_number,
                                'introduction' => $introduction,
                                'buying_guide' => $buying_guide,
                                'conclusion' => $conclusion,
                                'post_status' => $post_status,
                                'frequency' => $frequency,
                                'show_table' => $show_table,
                                'show_table_img' => $show_table_img,
                                'featured_img' => $featured_img,
                                'show_affiliate_disclaimer' => $show_affiliate_disclaimer,
                                'affiliate_disclaimer' => $affiliate_disclaimer,
                                'active_continue_reading' => '',
                                'carousel' => '',
                                'show_img_excerpt' => 0,
                                'display_product_details' => 1,
                                'country_block_list' => '',
                                'ip_block_list' => '',
                                'footer_script' => '',
                                'time' => time(),
                                'article' => $article,
                                'domain' => $domain,
                                'ref_key' => $ref_key,
                                'length' => $length,
                                'section_heading' => $section_heading,
                                'faq_flag' => $faq_flag,
                                'conclusion_flag' => $conclusion_flag
                            )
                        );

                        $opts = array('http' =>
                            array(
                                'method' => 'POST',
                                'header' => 'Content-type: application/x-www-form-urlencoded',
                                'content' => $postdata,
                            )
                        );
                        $context = stream_context_create($opts);
                        $response = file_get_contents($forge_publish_ip,false,$context);
                        $data = json_decode($response,true);

                        if($data['msgcode'] == '200'){
                            if($custom_category == 0){
                                $my_category = array(
                                    'cat_ID'    => 0,
                                    'taxonomy'  => 'category',
                                    'cat_name'   => 'Tips & Tricks',
                                    'post_author'   => get_current_user_id()
                                );
                    
                                $categoryId = wp_insert_category( $my_category, $wp_error = false );

                                $term_id = category_exists( 'Tips & Tricks', $parent = null );
                                if($term_id == 0 || $term_id == NULL){
                                    $categoryId = wp_insert_category( $my_category, $wp_error = false );
                                }else{
                                    $categoryId = $term_id;
                                }
                            }else{
                                $categoryId = 'Tips & Tricks';
                            }
                
                            //Create Post
                            $my_post = array(
                                'post_title'    => wp_strip_all_tags( $data['title'] ),
                                'post_name'     => $data['permalink'],
                                'post_content'  => $data['content'],
                                'post_status'   => $data['post_status'],
                                //'tags_input'    => $data['tag_name'],
                                'post_author'   => get_current_user_id(),
                                'post_category' => array( $categoryId )
                            );
                            
                            // Insert the post into the database
                            $insert_post = wp_insert_post( $my_post );
                            if ( is_wp_error( $insert_post ) ) {
                                $status = 'failed';
                                wp_die( $insert_post->get_error_message() );
                            }else{
                                $status = 'success';
                            }

                            update_post_meta($insert_post,'rank_math_focus_keyword',strtolower($article));
                            update_post_meta($insert_post,'_yoast_wpseo_focuskw',strtolower($article));

                            $args = [
                                'id'         => $article_id,
                                'article'    => $article,
                                'profile'    => 0,
                                'status'     => $status
                            ];
                            
                            $insert_id = wd_article_insert( $args );
                
                            if ( is_wp_error( $insert_id ) ) {
                                wp_die( $insert_id->get_error_message() );
                            }

                            $value = array(
                                'customer_id' => $data['customer_id'],
                                'key1' => $data['key1'],
                                'key2' => $data['key2'],
                                'validation_ip' => $data['validation_ip'],
                                'destination_ip' => $data['destination_ip'],
                                'article_ip' => $data['article_ip'],
                                'forge_initiate_ip' => $data['forge_initiate_ip'],
                                'forge_publish_ip' => $data['forge_publish_ip'],
                                'quota' => $data['quota'],
                                'ai_quota' => $data['ai_quota'],
                                'word_limit' => $data['word_limit'],
                            );
                            update_option( 'automatebox_key', $value );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-article&inserted=true' );
                        }else{
                            if($data['msgcode'] == '103'){
                                $args = [
                                    'article'    => $article,
                                    'profile'    => 0,
                                    'status'    => 'invaild key'
                                ];
            
                                $insert_id = wd_article_insert( $args );
    
                                $redirected_to = admin_url( 'admin.php?page=automatebox-article&invalidkey=true' );
                            }elseif($data['msgcode'] == '105'){
                                $args = [
                                    'article'    => $article,
                                    'profile'    => 0,
                                    'status'    => 'Word Limit Exceeds'
                                ];
            
                                $insert_id = wd_article_insert( $args );
    
                                $redirected_to = admin_url( 'admin.php?page=automatebox-article&nowordlimit=true' );
                            }elseif($data['msgcode'] == '115'){
                                $args = [
                                    'article'    => $article,
                                    'profile'    => 0,
                                    'status'    => 'Article not finished yet.'
                                ];
            
                                $insert_id = wd_article_insert( $args );
    
                                $redirected_to = admin_url( 'admin.php?page=automatebox-article&articlenotfinished=true' );
                            }else{
                                $args = [
                                    'article'    => $article,
                                    'profile'    => 0,
                                    'status'    => 'failed'
                                ];
            
                                $insert_id = wd_article_insert( $args );
                                
                                $redirected_to = admin_url( 'admin.php?page=automatebox-article&noapi=true' );
                            }
                        }
                        
                    }else{

                        $args = [
                            'article'    => $article,
                            'profile'    => 0,
                            'status'    => 'duplicate'
                        ];

                        $insert_id = wd_article_insert( $args );

                        $redirected_to = admin_url( 'admin.php?page=automatebox-article&duplicate=true' );
                    
                    }
                }
            }
        }
 
        wp_redirect( $redirected_to );
        exit;
    }

    public function delete_article() {
        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'wd-delete-article' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        if ( wd_delete_article( $id ) ) {
            $redirected_to = admin_url( 'admin.php?page=automatebox-article&article-deleted=true' );
        } else {
            $redirected_to = admin_url( 'admin.php?page=automatebox-article&article-deleted=false' );
        }

        wp_redirect( $redirected_to );
        exit;
    }
}