<div class="wrap">
    <h1><?php _e( 'Generate Pages', 'automatebox' ); ?></h1>
    
    <?php if ( isset( $_GET['generate-updated'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Pages have been generated successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <b>
    <ol>
        <li>Contact Us <?php if (the_slug_exists('contact')){ ?> &#10004; <?php } ?></li>
        <li>DMCA <?php if (the_slug_exists('dmca')){ ?> &#10004; <?php } ?></li>
        <li>Privacy Policy <?php if (the_slug_exists('privacy-policy')){ ?> &#10004; <?php } ?></li>
        <li>Disclaimer <?php if (the_slug_exists('disclaimer')){ ?> &#10004; <?php } ?></li>
    </ol>
    </b>
</div>