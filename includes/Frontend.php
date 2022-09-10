<?php
 
namespace Automatebox;
 
/**
 * Frontend handler class
 */
class Frontend {
 
    /**
     * Initialize the class
     */
    function __construct() {
        new Frontend\Shortcode();
        add_filter( 'the_title', 'do_shortcode' );
        add_filter( 'breadcrumb_trail', 'do_shortcode' );

		add_filter( 'single_post_title', 'do_shortcode' );
		add_filter( 'wp_title', 'do_shortcode' );
		add_filter( 'the_excerpt', 'do_shortcode');

		// Rank Math Support
		add_filter( 'rank_math/frontend/title', function( $title ) {
			return do_shortcode( $title );
		});
		add_filter( 'rank_math/frontend/description', function( $description ) {
			return do_shortcode( $description );
		});
		// add_filter( 'rank_math/paper/auto_generated_description/apply_shortcode', '__return_true' );
		add_filter( 'rank_math/product_description/apply_shortcode', '__return_true' );
		add_filter( 'rank_math/frontend/breadcrumb/html', 'do_shortcode' );
		/* In Beta — Open Graph Testing for Rank Math */
		add_filter( 'rank_math/opengraph/facebook/og_title', function( $fbog ) {
			return do_shortcode( $fbog );
		});
		add_filter( 'rank_math/opengraph/facebook/og_description', function( $fbogdesc ) {
			return do_shortcode( $fbogdesc );
		});
		add_filter( 'rank_math/opengraph/twitter/title', function( $twtitle ) {
			return do_shortcode( $twtitle );
		});
		add_filter( 'rank_math/opengraph/twitter/description', function( $twdesc ) {
			return do_shortcode( $twdesc );
		});
		// Yoast SEO Support
		add_filter( 'wpseo_title', 'do_shortcode' );
		add_filter( 'wpseo_metadesc', 'do_shortcode' );
		add_filter( 'wpseo_opengraph_title', 'do_shortcode' );
		add_filter( 'wpseo_opengraph_desc', 'do_shortcode' );
		// add_filter( 'wpseo_json_ld_output', 'do_shortcode' );

		// SEOPress Support

		add_filter( 'seopress_titles_title', 'do_shortcode'); // SEOPress Support
		add_filter( 'seopress_titles_desc', 'do_shortcode'); // SEOPress Support

		// Miscellaneous
		add_filter( 'crp_title', 'do_shortcode'); // CRP Support
		// add_filter( 'rank_math/snippet/breadcrumb', 'do_shortcode' ); @TODO
    }
}