<?php
 
namespace Automatebox\Admin;

use Automatebox\Traits\Form_Error;
 
/**
 * Keyword Handler class
 */
class Keyword {
 
    use Form_Error;
    
    /**
     * Plugin page handler
     *
     * @return void
     */
    public function keyword_page() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
 
        switch ( $action ) {
            case 'new':
                $template = __DIR__ . '/views/keyword-new.php';
                break;
 
            case 'view':
                $template = __DIR__ . '/views/keyword-list.php';
                break;
 
            default:
                $template = __DIR__ . '/views/keyword-list.php';
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
        if ( ! isset( $_POST['submit_keyword'] ) ) {
            return;
        }
 
        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-keyword' ) ) {
            wp_die( 'Are you cheating?' );
        }
 
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }
 
        $keyword2   = isset( $_POST['keyword'] ) ? sanitize_textarea_field( $_POST['keyword'] ) : '';
        $keywords   = preg_split('/\r\n|\r|\n/', $keyword2);
        $token_id = isset( $_POST['token_id'] ) ? sanitize_text_field( $_POST['token_id'] ) : '';
 
        if ( empty( $keyword2 ) ) {
            $this->errors['keyword'] = __( 'Please enter Keyword', 'automatebox' );
        }
 
        if ( ! empty( $this->errors ) ) {
            return;
        }

        
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
            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&invalidamazon=true' );
        }elseif($customer_id == ''){
            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&invalidcustomer=true' );
        }elseif($key1 == '' || $key2 == ''){
            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&invalidkey=true' );
        }elseif($destination_ip == ''){
            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&invalidip=true' );
        }elseif($quota < 1){
            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&noquota=true' );
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
            $select_ai_introduction = !empty($settings['select_ai_introduction'])? $settings['select_ai_introduction']:0;
            $select_ai_product_description = !empty($settings['select_ai_product_description'])? $settings['select_ai_product_description']:0;
            $select_ai_buying_guide = !empty($settings['select_ai_buying_guide'])? $settings['select_ai_buying_guide']:0;
            $select_ai_faq = !empty($settings['select_ai_faq'])? $settings['select_ai_faq']:0;
            $select_ai_conclusion = !empty($settings['select_ai_conclusion'])? $settings['select_ai_conclusion']:0;
            $custom_category    = !empty($settings['custom_category'])? $settings['custom_category']:0;
            $custom_category_text    = !empty($settings['custom_category_text'])? $settings['custom_category_text']:'';
            $tags    = !empty($settings['tags'])? $settings['tags']:0;
            $product_number = !empty($settings['product_number'])? $settings['product_number']:'10';
            $introduction = !empty($settings['introduction'])? $settings['introduction']:'';
            $introduction_id = !empty($settings['introduction_id'])? $settings['introduction_id']:'';
            $introduction_id2 = !empty($settings['introduction_id2'])? $settings['introduction_id2']:'';
            $introduction_id3 = !empty($settings['introduction_id3'])? $settings['introduction_id3']:'';
            $introduction_id4 = !empty($settings['introduction_id4'])? $settings['introduction_id4']:'';
            $introduction_id5 = !empty($settings['introduction_id5'])? $settings['introduction_id5']:'';
            $buying_guide_title = !empty($settings['buying_guide_title'])? $settings['buying_guide_title']:0;
            $buying_guide = !empty($settings['buying_guide'])? $settings['buying_guide']:'';
            $buying_guide_id = !empty($settings['buying_guide_id'])? $settings['buying_guide_id']:'';
            $buying_guide_id2 = !empty($settings['buying_guide_id2'])? $settings['buying_guide_id2']:'';
            $buying_guide_id3 = !empty($settings['buying_guide_id3'])? $settings['buying_guide_id3']:'';
            $buying_guide_id4 = !empty($settings['buying_guide_id4'])? $settings['buying_guide_id4']:'';
            $buying_guide_id5 = !empty($settings['buying_guide_id5'])? $settings['buying_guide_id5']:'';
            $conclusion_title = !empty($settings['conclusion_title'])? $settings['conclusion_title']:0;
            $conclusion = !empty($settings['conclusion'])? $settings['conclusion']:'';
            $conclusion_id = !empty($settings['conclusion_id'])? $settings['conclusion_id']:'';
            $conclusion_id2 = !empty($settings['conclusion_id2'])? $settings['conclusion_id2']:'';
            $conclusion_id3 = !empty($settings['conclusion_id3'])? $settings['conclusion_id3']:'';
            $conclusion_id4 = !empty($settings['conclusion_id4'])? $settings['conclusion_id4']:'';
            $conclusion_id5 = !empty($settings['conclusion_id5'])? $settings['conclusion_id5']:'';
            $post_status = !empty($settings['post_status'])? $settings['post_status']:0;
            $frequency = !empty($settings['frequency'])? $settings['frequency']:0;
            $show_table = !empty($settings['show_table'])? $settings['show_table']:0;
            $show_table_serial = !empty($settings['show_table_serial'])? $settings['show_table_serial']:0;
            $show_table_img = !empty($settings['show_table_img'])? $settings['show_table_img']:0;
            $show_table_score = !empty($settings['show_table_score'])? $settings['show_table_score']:0;
            $show_table_price = !empty($settings['show_table_price'])? $settings['show_table_price']:0;
            $featured_img = !empty($settings['featured_img'])? $settings['featured_img']:1;  
            $show_affiliate_disclaimer = !empty($settings['show_affiliate_disclaimer'])? $settings['show_affiliate_disclaimer']:1;
            if($show_affiliate_disclaimer == 1){
                $affiliate_disclaimer = !empty($settings['affiliate_disclaimer'])? $settings['affiliate_disclaimer']:'';
            }else{
                $affiliate_disclaimer = '';
            }
            $show_product_description = !empty($settings['show_product_description'])? $settings['show_product_description']:0;

            $domain = home_url();
            $domain = explode("/", preg_replace('/^(https?)\:\/\/(www\.)?(.*)\/?$/isU',"$3", $domain));
            $domain = trim($domain[0]," \r\n\t/");

            foreach($keywords as $keyword){
                $fetch_profiles = wd_keyword_gets_all();
                $duplicate_keyword = 0;
                foreach( $fetch_profiles as $value ) {
                    if (trim($value->keyword) == trim($keyword)){
                        $duplicate_keyword = 1;
                    }
                }

                if($quota < 1){
                    $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&noquota=true' );
                }elseif($duplicate_keyword == 0){
                    $postdata=http_build_query(
                        array(
                            'customer_id' => $customer_id,
                            'key1' => $key1,
                            'key2' => $key2,
                            'validation_ip' => $validation_ip,
                            'destination_ip' => $destination_ip,
                            'quota' => $quota,
                            'ai_quota' => $ai_quota,
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
                            'buying_guide' => $buying_guide,
                            'buying_guide_id' => $buying_guide_id,
                            'buying_guide_id2' => $buying_guide_id2,
                            'buying_guide_id3' => $buying_guide_id3,
                            'buying_guide_id4' => $buying_guide_id4,
                            'buying_guide_id5' => $buying_guide_id5,
                            'conclusion_title' => $conclusion_title,
                            'conclusion' => $conclusion,
                            'conclusion_id' => $conclusion_id,
                            'conclusion_id2' => $conclusion_id2,
                            'conclusion_id3' => $conclusion_id3,
                            'conclusion_id4' => $conclusion_id4,
                            'conclusion_id5' => $conclusion_id5,
                            'post_status' => $post_status,
                            'frequency' => $frequency,
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
                            'time' => time(),
                            'keyword' => $keyword,
                            'domain' => $domain,
                            'token' => $token_id.'_'.$domain.'_'.$keyword
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
                    $response = file_get_contents($destination_ip,false,$context);
                    $data = json_decode($response,true);

                    if($data['msgcode'] == '200'){
                        if($custom_category == 0){
                            $my_category = array(
                                'cat_ID'    => 0,
                                'taxonomy'  => 'category',
                                'cat_name'   => $data['category'],
                                'post_author'   => get_current_user_id()
                            );
                
                            $categoryId = wp_insert_category( $my_category, $wp_error = false );

                            $term_id = category_exists( $data['category'], $parent = null );
                            if($term_id == 0 || $term_id == NULL){
                                $categoryId = wp_insert_category( $my_category, $wp_error = false );
                            }else{
                                $categoryId = $term_id;
                            }
                        }else{
                            $categoryId = $custom_category_text;
                        }
                        
                        if($tags == 1){
                            $flag_tags = $data['tag_name'];
                        }else{
                            $flag_tags = '';
                        }

                        //Create Post
                        $my_post = array(
                            'post_title'    => wp_strip_all_tags( $data['title'] ),
                            'post_name'     => $data['permalink'],
                            'post_content'  => $data['content'],
                            'post_status'   => $data['post_status'],
                            'tags_input'    => $flag_tags,
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

                        update_post_meta($insert_post,'rank_math_focus_keyword',strtolower($keyword));
                        update_post_meta($insert_post,'_yoast_wpseo_focuskw',strtolower($keyword));

                        // Add Featured Image to Post
                        if($featured_img == 1 && $data['image_url'] != ''){
                            wd_insert_image($data['image_url'],$insert_post);
                        }

                        $args = [
                            'keyword'    => $keyword,
                            'profile'    => 0,
                            'status'     => $status
                        ];

                        $insert_id = wd_keyword_insert( $args );
                
                        if ( is_wp_error( $insert_id ) ) {
                            wp_die( $insert_id->get_error_message() );
                        }

                        $value = array(
                            'customer_id' => $data['customer_id'],
                            'key1' => $data['key1'],
                            'key2' => $data['key2'],
                            'validation_ip' => $data['validation_ip'],
                            'destination_ip' => $data['destination_ip'],
                            'forge_initiate_ip' => $data['forge_initiate_ip'],
                            'forge_publish_ip' => $data['forge_publish_ip'],
                            'quota' => $data['quota'],
                            'ai_quota' => $data['ai_quota'],
                            'word_limit' => $data['word_limit'],
                        );
                        update_option( 'automatebox_key', $value );

                        $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&inserted=true' );
                    }else{
                        if($data['msgcode'] == '103'){
                            $args = [
                                'keyword'    => $keyword,
                                'profile'    => 0,
                                'status'    => 'invaild key'
                            ];
        
                            $insert_id = wd_keyword_insert( $args );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&invalidkey=true' );
                        }elseif($data['msgcode'] == '105'){
                            $args = [
                                'keyword'    => $keyword,
                                'profile'    => 0,
                                'status'    => 'no quota'
                            ];
        
                            $insert_id = wd_keyword_insert( $args );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&noquota=true' );
                        }elseif($data['msgcode'] == '106'){
                            $args = [
                                'keyword'    => $keyword,
                                'profile'    => 0,
                                'status'    => 'no ai quota'
                            ];
        
                            $insert_id = wd_keyword_insert( $args );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&noaiquota=true' );
                        }elseif($data['msgcode'] == '107'){
                            //duplicate (server issue)

                            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword' );
                        }elseif($data['msgcode'] == '108'){
                            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&exceedlimit=true' );
                        }elseif($data['msgcode'] == '111'){
                            $args = [
                                'keyword'    => $keyword,
                                'profile'    => 0,
                                'status'    => 'Failed to get content from Amazon'
                            ];
        
                            $insert_id = wd_keyword_insert( $args );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&invalidamazon=true' );
                        }elseif($data['msgcode'] == '112'){
                            $args = [
                                'keyword'    => $keyword,
                                'profile'    => 0,
                                'status'    => 'Failed to get content from Amazon'
                            ];
        
                            $insert_id = wd_keyword_insert( $args );

                            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&failedamazon=true' );
                        }else{
                            $args = [
                                'keyword'    => $keyword,
                                'profile'    => 0,
                                'status'    => 'failed'
                            ];
        
                            $insert_id = wd_keyword_insert( $args );
                            
                            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&noapi=true' );
                        }
                    }

                }else{
                    $args = [
                        'keyword'    => $keyword,
                        'profile'    => 0,
                        'status'    => 'duplicate'
                    ];

                    $insert_id = wd_keyword_insert( $args );

                    $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&duplicate=true' );
                }
            }
        }
 
        wp_redirect( $redirected_to );
        exit;
    }

    public function delete_keyword() {
        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'wd-delete-keyword' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        if ( wd_delete_keyword( $id ) ) {
            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&keyword-deleted=true' );
        } else {
            $redirected_to = admin_url( 'admin.php?page=automatebox-keyword&keyword-deleted=false' );
        }

        wp_redirect( $redirected_to );
        exit;
    }
}