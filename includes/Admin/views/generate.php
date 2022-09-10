<div class="wrap">
    <h1><?php _e( 'Generate Pages', 'automatebox' ); ?></h1>
    
    <?php if ( isset( $_GET['generate-updated'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Pages have been generated successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>
    
    <br>
    <b>Please install and activate <a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a> plugin before generating the pages.
    <form action="" method="post">
        <b>
        <ol>
            <li>Contact Us</li>
            <li>DMCA</li>
            <li>Privacy Policy</li>
            <li>Disclaimer</li>
        </ol>
        </b>
 
        <?php wp_nonce_field( 'generate-pages' ); ?>
        <?php submit_button( __( 'Generate Pages', 'automatebox' ), 'primary', 'generate_pages' ); ?>
    </form>
</div>