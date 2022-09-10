<?php

/**
 * Insert a new keyword
 *
 * @param  array  $args
 *
 * @return int|WP_Error
 */
function wd_keyword_insert( $args = [] ) {
    global $wpdb;
 
    if ( empty( $args['keyword'] ) ) {
        return new \WP_Error( 'no-keyword', __( 'You must provide a keyword.', 'automatebox' ) );
    }
 
    $defaults = [
        'keyword'   => '',
        'profile'   => '',
        'status'   => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time( 'mysql' ),
    ];
 
    $data = wp_parse_args( $args, $defaults );

    $inserted = $wpdb->insert(
        $wpdb->prefix . 'automatebox_keyword',
        $data,
        [
            '%s',
            '%s',
            '%s',
            '%d',
            '%s'
        ]
    );

    if ( ! $inserted ) {
        return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'automatebox' ) );
    }

    return $wpdb->insert_id;
}

/**
 * Fetch Addresses
 *
 * @param  array  $args
 *
 * @return array
 */
function wd_keyword_gets( $args = [] ) {
    global $wpdb;
 
    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];
 
    $args = wp_parse_args( $args, $defaults );
 
    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}automatebox_keyword
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );
 
    $items = $wpdb->get_results( $sql );
 
    return $items;
}

function wd_keyword_gets2( $args = [], $search_term ) {
    global $wpdb;
 
    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];
 
    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}automatebox_keyword 
            WHERE keyword LIKE '%$search_term%'
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );
 
    $items = $wpdb->get_results( $sql );
 
    return $items;
}

function wd_keyword_gets_all() {
    global $wpdb;
    
    $items = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}automatebox_keyword" );
 
    return $items;
}
 
/**
 * Get the count of all keyword
 *
 * @return int
 */
function wd_keyword_count() {
    global $wpdb;
 
    return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}automatebox_keyword" );
}

/**
 * Get the count of all keyword (search items)
 *
 * @return int
 */
function wd_keyword_count2($search_term) {
    global $wpdb;
 
    return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}automatebox_keyword WHERE keyword LIKE '%$search_term%' " );
}

/**
 * Fetch a single keyword from the DB
 *
 * @param  int $id
 *
 * @return object
 */
function wd_keyword_get( $id ) {
    global $wpdb;

    return $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}automatebox_keyword WHERE id = %d", $id )
    );
}

/**
 * Delete a keyword
 *
 * @param  int $id
 *
 * @return int|boolean
 */
function wd_delete_keyword( $id ) {
    global $wpdb;

    return $wpdb->delete(
        $wpdb->prefix . 'automatebox_keyword',
        [ 'id' => $id ],
        [ '%d' ]
    );
}

function wd_delete_keywords( $id ) {
    global $wpdb;

    $count = count($id);
    for($i=0; $i<$count; $i++){
        $wpdb->delete(
            $wpdb->prefix . 'automatebox_keyword',
            [ 'id' => $id[$i] ],
            [ '%d' ]
        );
    }

    $items = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}automatebox_keyword" );
 
    return $items;
}

function wd_article_insert( $args = [] ) {
    global $wpdb;
 
    if ( empty( $args['article'] ) ) {
        return new \WP_Error( 'no-article', __( 'You must provide a article.', 'automatebox' ) );
    }
 
    $defaults = [
        'article'   => '',
        'profile'   => '',
        'status'   => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time( 'mysql' ),
    ];
 
    $data = wp_parse_args( $args, $defaults );

    if ( isset( $data['id'] ) ) {

        $id = $data['id'];
        unset( $data['id'] );

        $updated = $wpdb->update(
            $wpdb->prefix . 'automatebox_article',
            $data,
            [ 'id' => $id ],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ],
            [ '%d' ]
        );

        return $updated;

    } else {

        $inserted = $wpdb->insert(
            $wpdb->prefix . 'automatebox_article',
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ]
        );

        if ( ! $inserted ) {
            return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'automatebox' ) );
        }

        return $wpdb->insert_id;
    }
}

function wd_article_gets( $args = [] ) {
    global $wpdb;
 
    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];
 
    $args = wp_parse_args( $args, $defaults );
 
    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}automatebox_article
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );
 
    $items = $wpdb->get_results( $sql );
 
    return $items;
}

function wd_article_gets2( $args = [], $search_term ) {
    global $wpdb;
 
    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];
 
    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}automatebox_article 
            WHERE article LIKE '%$search_term%'
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );
 
    $items = $wpdb->get_results( $sql );
 
    return $items;
}

function wd_article_gets_all() {
    global $wpdb;
    
    $items = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}automatebox_article" );
 
    return $items;
}

function wd_article_gets_processing() {
    global $wpdb;
    
    $items = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}automatebox_article WHERE status = 'processing'" );
 
    return $items;
}
 
/**
 * Get the count of all article
 *
 * @return int
 */
function wd_article_count() {
    global $wpdb;
 
    return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}automatebox_article" );
}

/**
 * Get the count of all article (search items)
 *
 * @return int
 */
function wd_article_count2($search_term) {
    global $wpdb;
 
    return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}automatebox_article WHERE article LIKE '%$search_term%' " );
}

/**
 * Fetch a single article from the DB
 *
 * @param  int $id
 *
 * @return object
 */
function wd_article_get( $id ) {
    global $wpdb;

    return $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}automatebox_article WHERE id = %d", $id )
    );
}

/**
 * Delete a article
 *
 * @param  int $id
 *
 * @return int|boolean
 */
function wd_delete_article( $id ) {
    global $wpdb;

    return $wpdb->delete(
        $wpdb->prefix . 'automatebox_article',
        [ 'id' => $id ],
        [ '%d' ]
    );
}

function wd_delete_articles( $id ) {
    global $wpdb;

    $count = count($id);
    for($i=0; $i<$count; $i++){
        $wpdb->delete(
            $wpdb->prefix . 'automatebox_article',
            [ 'id' => $id[$i] ],
            [ '%d' ]
        );
    }

    $items = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}automatebox_article" );
 
    return $items;
}


function the_slug_exists($post_name) {
    global $wpdb;
    if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
        return true;
    } else {
        return false;
    }
}

function wd_insert_image($image_url,$post_id){
    $image_name2        = explode('https://m.media-amazon.com/images/I/',$image_url);
    $image_name         = $image_name2[1];
    $upload_dir         = wp_upload_dir(); // Set upload folder
    $image_data         = file_get_contents($image_url); // Get image data
    $unique_file_name   = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
    $filename           = basename( $unique_file_name ); // Create image file name

    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
    } else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }

    // Create the image  file on the server
    file_put_contents( $file, $image_data );

    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );

    // Set attachment data
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name( $filename ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );

    // And finally assign featured image to post
    set_post_thumbnail( $post_id, $attach_id );
}

function show_related_post($numberposts=5, $Array=false){

	$postId = get_the_ID();
	$relatedPosts = array();
	$relatedPosts2 = '';
	if($postId){
		$related = get_posts( array( 'category__in' => wp_get_post_categories($postId), 'numberposts' => $numberposts, 'post__not_in' => array($postId) ) );
		
		if( !empty($related) ){
			foreach( $related as $post ) {
				$relatedPosts[] = '<li class="automatebox-related-post-item"><a href="'.get_the_permalink($post->ID).'" title="'.$post->post_title.'">'.do_shortcode($post->post_title).'</a></li>';
				$relatedPosts2 .= '<li class="automatebox-related-post-item"><a href="'.get_the_permalink($post->ID).'" title="'.$post->post_title.'">'.do_shortcode($post->post_title).'</a></li>';
			}
		}
	}
	$relatedPosts2 = !empty($relatedPosts2)? '<ul class="automatebox-related-posts">'.trim($relatedPosts2,' ').'</ul>' : '';
	return $Array? $relatedPosts : $relatedPosts2;  
}

function activate_auto_publish_drafts() {
    $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
    $publish_frequency = isset($settings['frequency'])? $settings['frequency']:0;
    if($publish_frequency==0){  // Disabling the schedule.
        wp_clear_scheduled_hook('auto_publish_drafts');
    }else{
        if(!wp_get_schedule('auto_publish_drafts')){
            wp_schedule_event(time() + $publish_frequency, 'publish_draft_every_5_minutes', 'auto_publish_drafts');
        }
    }
}
add_action( 'plugins_loaded', 'activate_auto_publish_drafts' );

// Custom cron schedule to auto publish drafts
function custom_publish_draft_cron_schedule($schedules) {
    $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
    $publish_frequency = isset($settings['frequency'])? $settings['frequency']:0;
    $schedules['publish_draft_every_5_minutes'] = array(
        'interval' => $publish_frequency,
        'display'  => __('Auto Publish Draft Every 5 Minutes'),
    );

    return $schedules;
}
add_filter('cron_schedules', 'custom_publish_draft_cron_schedule');

// Auto publish drafts
function auto_publish_draft() {
    $settings = !empty(AUTOMATEBOX_OPTIONS) ? unserialize(AUTOMATEBOX_OPTIONS) :'';
    $frequency_number = isset($settings['frequency_number'])? $settings['frequency_number']:0;
    $args = array(
        'fields' => 'ids',
        'post_type' => 'post',
        'post_status' => 'draft',
        'posts_per_page' => $frequency_number,
        'orderby' => 'date',
        'order' => 'ASC'
    );
    $draft_posts = new \WP_Query($args);

    if($draft_posts->have_posts()) {
        foreach($draft_posts->posts as $draft_post_id)
            wp_update_post(array('ID' => $draft_post_id, 'post_status' => 'publish'));

        wp_reset_postdata();
    }
}
add_action('auto_publish_drafts', 'auto_publish_draft');