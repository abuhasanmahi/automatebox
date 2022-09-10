<?php
 
namespace Automatebox\Admin;

use Automatebox\Traits\Form_Error;
 
/**
 * Key Handler class
 */
class Key {
 
    use Form_Error;
    
    /**
     * Plugin page handler
     *
     * @return void
     */
    public function key_page() {
        $key = !empty(AUTOMATEBOX_KEY) ? unserialize(AUTOMATEBOX_KEY) :'';
        $amazon_key = !empty(AUTOMATEBOX_AMAZON_KEY) ? unserialize(AUTOMATEBOX_AMAZON_KEY) :'';
        $template = __DIR__ . '/views/key.php';
 
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
        if ( isset ($_POST['submit_key'] ) ){
            if ( ! isset( $_POST['submit_key'] ) ) {
                return;
            }
    
            if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'key-edit' ) ) {
                wp_die( 'Are you cheating?' );
            }
    
            if ( ! current_user_can( 'manage_options' ) ) {
                wp_die( 'Are you cheating?' );
            }

            $customer_id = isset( $_POST['customer_id'] ) ? sanitize_text_field( $_POST['customer_id'] ) : '';
            $key1 = isset( $_POST['key1'] ) ? sanitize_text_field( $_POST['key1'] ) : '';
            $key2    = isset( $_POST['key2'] ) ? sanitize_text_field( $_POST['key2'] ) : '';
            
            $key = !empty(AUTOMATEBOX_KEY) ? unserialize(AUTOMATEBOX_KEY) :'';
            $validation_ip = !empty($key['validation_ip'])? $key['validation_ip']:'';
            $destination_ip = !empty($key['destination_ip'])? $key['destination_ip']:'';
            $forge_initiate_ip = !empty($key['forge_initiate_ip'])? $key['forge_initiate_ip']:'';
            $forge_publish_ip = !empty($key['forge_publish_ip'])? $key['forge_publish_ip']:'';
            $quota = !empty($key['quota'])? $key['quota']:0;
            $ai_quota = !empty($key['ai_quota'])? $key['ai_quota']:0;
            $word_limit = !empty($key['word_limit'])? $key['word_limit']:0;

    
            if ( empty( $customer_id ) ) {
                $this->errors['customer_id'] = __( 'Please enter Customer ID', 'automatebox' );
            }

            if ( empty( $key1 ) ) {
                $this->errors['key1'] = __( 'Please enter Key1', 'automatebox' );
            }

            if ( empty( $key2 ) ) {
                $this->errors['key2'] = __( 'Please enter Key2', 'automatebox' );
            }
    
            if ( ! empty( $this->errors ) ) {
                return;
            }
            
            if($customer_id == ''){
                $redirected_to = admin_url( 'admin.php?page=automatebox-key&key-invalidcustomer=true' );
            }elseif($key1 == '' || $key2 == ''){
                $redirected_to = admin_url( 'admin.php?page=automatebox-key&key-invalidkey=true' );
            }elseif($validation_ip == ''){
                $redirected_to = admin_url( 'admin.php?page=automatebox-key&key-invalidip=true' );
            }else{
                $domain = home_url();
                $domain = explode("/", preg_replace('/^(https?)\:\/\/(www\.)?(.*)\/?$/isU',"$3", $domain));
                $domain = trim($domain[0]," \r\n\t/");

                $postdata=http_build_query(
                    array(
                        'customer_id' => $customer_id,
                        'key1' => $key1,
                        'key2' => $key2,
                        'validation_ip' => $validation_ip,
                        'client_domain' => $domain,
                        'destination_ip' => $destination_ip,
                        'forge_initiate_ip' => $forge_initiate_ip,
                        'forge_publish_ip' => $forge_publish_ip,
                        'quota' => $quota,
                        'ai_quota' => $ai_quota,
                        'word_limit' => $word_limit,
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
                $response = file_get_contents($validation_ip,false,$context);
                $data = json_decode($response,true);
                
                if($data['msgcode'] == '200'){
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
            
                    $redirected_to = admin_url( 'admin.php?page=automatebox-key&key-updated=true' );
                }elseif($data['msgcode'] == '103'){
                    $redirected_to = admin_url( 'admin.php?page=automatebox-key&key-invalidkey=true' );
                }elseif($data['msgcode'] == '105'){
                    $redirected_to = admin_url( 'admin.php?page=automatebox-key&key-invaliddomain=true' );
                }elseif($data['msgcode'] == '107'){
                    $redirected_to = admin_url( 'admin.php?page=automatebox-key&key-duplicatedomain=true' );
                }else{
                    $redirected_to = admin_url( 'admin.php?page=automatebox-key&key-invalidrequest=true' );
                }
            }
            wp_redirect( $redirected_to );
            exit;
        }

        if ( isset ($_POST['submit_amazon_key'] ) ){
            if ( ! isset( $_POST['submit_amazon_key'] ) ) {
                return;
            }
    
            if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'amazon-key' ) ) {
                wp_die( 'Are you cheating?' );
            }
    
            if ( ! current_user_can( 'manage_options' ) ) {
                wp_die( 'Are you cheating?' );
            }     

            $tracking_id    = isset( $_POST['tracking_id'] ) ? sanitize_text_field( $_POST['tracking_id'] ) : '';
            $access_key    = isset( $_POST['access_key'] ) ? sanitize_text_field( $_POST['access_key'] ) : '';
            $secret_key    = isset( $_POST['secret_key'] ) ? sanitize_text_field( $_POST['secret_key'] ) : '';
            $partner_tag    = isset( $_POST['partner_tag'] ) ? sanitize_text_field( $_POST['partner_tag'] ) : '';
            
            $amazon_key = !empty(AUTOMATEBOX_AMAZON_KEY) ? unserialize(AUTOMATEBOX_AMAZON_KEY) :'';
            $amazon_validation_ip = !empty($amazon_key['amazon_validation_ip'])? $amazon_key['amazon_validation_ip']:'';
            
            if($tracking_id == '' || $access_key == '' || $secret_key == '' || $partner_tag == ''){
                $redirected_to = admin_url( 'admin.php?page=automatebox-key&amazon-key-invalid=true' );
            }else{
                $domain = home_url();
                $domain = explode("/", preg_replace('/^(https?)\:\/\/(www\.)?(.*)\/?$/isU',"$3", $domain));
                $domain = trim($domain[0]," \r\n\t/");

                $postdata=http_build_query(
                    array(
                        'tracking_id' => $tracking_id, 
                        'access_key' => $access_key,
                        'secret_key' => $secret_key, 
                        'partner_tag' => $partner_tag,
                        'client_domain' => $domain,
                        'amazon_validation_ip' => $amazon_validation_ip,
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
                $response = file_get_contents($amazon_validation_ip,false,$context);
                $data = json_decode($response,true);
                
                if($data['msgcode'] == '200'){
                    $value = array(
                        'tracking_id' => $tracking_id, 
                        'access_key' => $access_key,
                        'secret_key' => $secret_key, 
                        'partner_tag' => $partner_tag,
                        'status' => 1,
                        'amazon_validation_ip' => $data['amazon_validation_ip'],
                    );
                
                    update_option( 'automatebox_amazon_key', $value );   
                    $redirected_to = admin_url( 'admin.php?page=automatebox-key&amazon-key-updated=true' );
                }else{
                    $value = array(
                        'tracking_id' => $tracking_id, 
                        'access_key' => $access_key,
                        'secret_key' => $secret_key, 
                        'partner_tag' => $partner_tag,
                        'status' => 0,
                        'amazon_validation_ip' => $data['amazon_validation_ip'],
                    );
                
                    update_option( 'automatebox_amazon_key', $value );

                    $redirected_to = admin_url( 'admin.php?page=automatebox-key&amazon-key-invalid=true' );
                }

                wp_redirect( $redirected_to );
                exit;
            }
        }
    }
}