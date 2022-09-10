<?php
 
namespace Automatebox;
 
/**
 * Installer class
 */
class Installer {
 
    /**
     * Run the installer
     *
     * @return void
     */
    public function run() {
        $this->add_version();
        $this->add_option();
        $this->create_tables();
    }
 
    /**
     * Add time and version on DB
     */
    public function add_version() {
        $installed = get_option( 'automatebox_installed' );
 
        if( ! $installed ) {
            update_option( 'automatebox_installed', time() );
        }
 
        update_option('automatebox_version', AUTOMATEBOX_VERSION );
    }

    /**
     * Add settings option
     */
    public function add_option() {
        $installed = get_option( 'automatebox_key' );
        
        if( ! $installed ) {
            $value = array(
                'customer_id' => '',
                'key1' => '',
                'key2' => '',
                'validation_ip' => 'https://automatebox.com/api/validation.php',
                'destination_ip' => 'https://automatebox.com/api/content.php',
                'article_ip' => 'https://automatebox.com/api/article.php',
                'forge_initiate_ip' => 'https://automatebox.com/api/forge_initiate.php',
                'forge_publish_ip' => 'https://automatebox.com/api/forge_publish.php',
                'quota' => '0',
                'ai_quota' => '0',
                'word_limit' => '0',
            );
            update_option( 'automatebox_key', $value );
        }else{
            $key = !empty(AUTOMATEBOX_KEY) ? unserialize(AUTOMATEBOX_KEY) :'';
            
            $customer_id = !empty($key['customer_id'])? $key['customer_id']:'';
            $key1 = !empty($key['key1'])? $key['key1']:'';
            $key2 = !empty($key['key2'])? $key['key2']:'';
            $quota = !empty($key['quota'])? $key['quota']:0;
            $ai_quota = !empty($key['ai_quota'])? $key['ai_quota']:0;
            $word_limit = !empty($key['word_limit'])? $key['word_limit']:0;
            
            $value = array(
                'customer_id' => $customer_id,
                'key1' => $key1,
                'key2' => $key2,
                'validation_ip' => 'https://automatebox.com/api/validation.php',
                'destination_ip' => 'https://automatebox.com/api/content.php',
                'article_ip' => 'https://automatebox.com/api/article.php',
                'forge_initiate_ip' => 'https://automatebox.com/api/forge_initiate.php',
                'forge_publish_ip' => 'https://automatebox.com/api/forge_publish.php',
                'quota' => $quota,
                'ai_quota' => $ai_quota,
                'word_limit' => $word_limit,
            );
            update_option( 'automatebox_key', $value );   
        }

        $installed2 = get_option( 'automatebox_settings' );
 
        if( ! $installed2 ) {
            $value = array(
                'flag_title_prefix' => 1,
                'title_prefix' => '',
                'flag_title_suffix' => 1,
                'title_suffix' => '',
                'table_of_content' => 1,
                'permalink' => 1,
                'button_text' => 'Check Price',
                'button_style' => 0,
                'interlink' => 1,
                'feature_style' => 0,
                'feature_shuffle' => 0,
                'custom_category' => 0,
                'custom_category_text' => '',
                'content' => 2,
                'select_ai_introduction' => 1,
                'select_ai_product_description' => 1,
                'select_ai_buying_guide' => 1,
                'select_ai_faq' => 1,
                'select_ai_conclusion' => 1,
                'product_number' => 10,
                'introduction_id' => 'Are you looking for ---KEYWORD4---? The service we provide will save you time from reading thousands of reviews. This suggestions is created for those looking for their ---KEYWORD3---. On selected products for the ---KEYWORD--- you will see ratings. The rating matrix we have generated is based on user ratings found online. Take a look -',
                'introduction_id2' => '',
                'introduction_id3' => '',
                'introduction_id4' => '',
                'introduction_id5' => '',
                'introduction' => 'Are you looking for ---KEYWORD4---? The service we provide will save you time from reading thousands of reviews. This suggestions is created for those looking for their ---KEYWORD3---. On selected products for the ---KEYWORD--- you will see ratings. The rating matrix we have generated is based on user ratings found online. Take a look -',
                'buying_guide_title' => 1,
                'buying_guide_id' => 'The products aren’t chosen randomly. We consider several criteria before assembling a list. Some of the criteria are discussed below-<ol> <li><strong><u> Brand Value:</u></strong> What happens when you go for a not-so-reputable brand just because the price seems cheap? Well, the chance of getting a short-lasting product goes higher. That’s because the renowned brands have a reputation to maintain, others don’t. ---KEYWORD3--- brands try to offer some unique features that make them stand out in the crowd. Thus hopefully, you’ll find one ideal product or another in our list.</li><li><strong><u> Features:</u></strong> You don’t need heaps of features, but useful ones. We look at the features that matter and choose the top ---KEYWORD2--- based on that.</li> <li><strong><u> Specifications:</u></strong> Numbers always help you measure the quality of a product in a quantitative way. We try to find products of higher specifications, but with the right balance.</li> <li><strong><u> Customer Ratings:</u></strong> The hundreds of customers using the ---KEYWORD2--- before you won’t say wrong, would they? Better ratings mean better service experienced by a good number of people.</li> <li><strong><u> Customer Reviews:</u></strong> Like ratings, customer reviews give you actual and trustworthy information, coming from real-world consumers about the ---KEYWORD2--- they used.</li> <li><strong><u> Seller Rank:</u></strong> Now, this is interesting! You don’t just need a good ---KEYWORD2---, you need a product that is trendy and growing in sales. It serves two objectives. Firstly, the growing number of users indicates the product is good. Secondly, the manufacturers will hopefully provide better quality and after-sales service because of that growing number.</li> <li><strong><u> Value For The Money:</u></strong> They say you get what you pay for. Cheap isn’t always good. But that doesn’t mean splashing tons of money on a flashy but underserving product is good either. We try to measure how much value for the money you can get from your ---KEYWORD2--- before putting them on the list.</li> <li><strong><u> Durability:</u></strong> Durability and reliability go hand to hand. A robust and durable ---KEYWORD2--- Roofing will serve you for months and years to come.</li> <li><strong><u> Availability:</u></strong> Products come and go, new products take the place of the old ones. Probably some new features were added, some necessary modifications were done. What’s the point of using a supposedly good ---KEYWORD2--- if that’s no longer continued by the manufacturer? We try to feature products that are up-to-date and sold by at least one reliable seller, if not several.</li> <li><strong><u> Negative Ratings: </u></strong>Yes, we take that into consideration too! When we pick the top rated ---KEYWORD2--- on the market, the products that got mostly negative ratings get filtered and discarded.</li></ol></br>These are the criteria we have chosen our ---KEYWORD2--- on. Does our process stop there? Heck, no! The most important thing that you should know about us is, we’re always updating our website to provide timely and relevant information.',
                'buying_guide_id2' => '',
                'buying_guide_id3' => '',
                'buying_guide_id4' => '',
                'buying_guide_id5' => '',
                'buying_guide' => 'The products aren’t chosen randomly. We consider several criteria before assembling a list. Some of the criteria are discussed below-<ol> <li><strong><u> Brand Value:</u></strong> What happens when you go for a not-so-reputable brand just because the price seems cheap? Well, the chance of getting a short-lasting product goes higher. That’s because the renowned brands have a reputation to maintain, others don’t. ---KEYWORD3--- brands try to offer some unique features that make them stand out in the crowd. Thus hopefully, you’ll find one ideal product or another in our list.</li><li><strong><u> Features:</u></strong> You don’t need heaps of features, but useful ones. We look at the features that matter and choose the top ---KEYWORD2--- based on that.</li> <li><strong><u> Specifications:</u></strong> Numbers always help you measure the quality of a product in a quantitative way. We try to find products of higher specifications, but with the right balance.</li> <li><strong><u> Customer Ratings:</u></strong> The hundreds of customers using the ---KEYWORD2--- before you won’t say wrong, would they? Better ratings mean better service experienced by a good number of people.</li> <li><strong><u> Customer Reviews:</u></strong> Like ratings, customer reviews give you actual and trustworthy information, coming from real-world consumers about the ---KEYWORD2--- they used.</li> <li><strong><u> Seller Rank:</u></strong> Now, this is interesting! You don’t just need a good ---KEYWORD2---, you need a product that is trendy and growing in sales. It serves two objectives. Firstly, the growing number of users indicates the product is good. Secondly, the manufacturers will hopefully provide better quality and after-sales service because of that growing number.</li> <li><strong><u> Value For The Money:</u></strong> They say you get what you pay for. Cheap isn’t always good. But that doesn’t mean splashing tons of money on a flashy but underserving product is good either. We try to measure how much value for the money you can get from your ---KEYWORD2--- before putting them on the list.</li> <li><strong><u> Durability:</u></strong> Durability and reliability go hand to hand. A robust and durable ---KEYWORD2--- Roofing will serve you for months and years to come.</li> <li><strong><u> Availability:</u></strong> Products come and go, new products take the place of the old ones. Probably some new features were added, some necessary modifications were done. What’s the point of using a supposedly good ---KEYWORD2--- if that’s no longer continued by the manufacturer? We try to feature products that are up-to-date and sold by at least one reliable seller, if not several.</li> <li><strong><u> Negative Ratings: </u></strong>Yes, we take that into consideration too! When we pick the top rated ---KEYWORD2--- on the market, the products that got mostly negative ratings get filtered and discarded.</li></ol></br>These are the criteria we have chosen our ---KEYWORD2--- on. Does our process stop there? Heck, no! The most important thing that you should know about us is, we’re always updating our website to provide timely and relevant information.',
                'conclusion_title' => 1,
                'conclusion_id' => 'Since reader satisfaction is our utmost priority, we have a final layer of filtration. And that is you, the reader! If you find any ---KEYWORD2--- featured here incorrect, irrelevant, not up to the mark, or simply outdated, please let us know. Your feedback is always welcome and we’ll try to promptly correct our list as per your reasonable suggestion.',
                'conclusion_id2' => '',
                'conclusion_id3' => '',
                'conclusion_id4' => '',
                'conclusion_id5' => '',
                'conclusion' => 'Since reader satisfaction is our utmost priority, we have a final layer of filtration. And that is you, the reader! If you find any ---KEYWORD2--- featured here incorrect, irrelevant, not up to the mark, or simply outdated, please let us know. Your feedback is always welcome and we’ll try to promptly correct our list as per your reasonable suggestion.',
                'post_status' => 0,
                'frequency' => 0,
                'frequency_number' => 1,
                'show_table' => 1,
                'show_table_serial' => 1,
                'show_table_img' => 1,
                'show_table_score' => 1,
                'show_table_price' => 0,
                'featured_img' => 1,
                'show_affiliate_disclaimer' => 1,
                'affiliate_disclaimer' => '<noindex><b>Disclaimer:</b> The Amazon Affiliate Product Advertising API is used to fetch products from Amazon. This API includes product content, image and logo as well as brand, design, and feature information. These are trademarks of Amazon.com. We may earn an affiliate commission if you purchase through our links.</noindex>',
                'show_product_description' => 1,
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
        }

        $installed3 = get_option( 'automatebox_amazon_key' );
        
        if( ! $installed3 ) {
            $value = array(
                'tracking_id' => '', 
                'access_key' => '',
                'secret_key' => '', 
                'partner_tag' => '',
                'status' => 0,
                'amazon_validation_ip' => 'https://automatebox.com/api/amazon_validation.php',
            );
            update_option( 'automatebox_amazon_key', $value );
        }
    }
 
    /**
     * Create necessary database tables
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;
 
        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}automatebox_keyword` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `keyword` varchar(255) NOT NULL,
            `profile` bigint(20) unsigned NOT NULL,
            `status` varchar(255) NULL,
            `faq` LONGTEXT NULL,
            `created_by` bigint(20) unsigned NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate";

        $schema2 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}automatebox_article` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `article` varchar(255) NOT NULL,
            `profile` bigint(20) unsigned NOT NULL,
            `status` varchar(255) NULL,
            `ref_key` varchar(255) NULL,
            `faq` LONGTEXT NULL,
            `created_by` bigint(20) unsigned NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate";
 
        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }
 
        dbDelta( $schema );
        dbDelta( $schema2 );
    }
}