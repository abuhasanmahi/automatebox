<div class="wrap">
    <h1><?php _e( 'Processing Article', 'automatebox' ); ?></h1>
 
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row">
                    <th scope="row">
                        <label for="article"><?php _e( 'Article', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <select name="article" id="article" class="regular-text">
                        <?php foreach( $fetch_profiles_processing as $value ) { ?>
                            <option><?php echo $value->article; ?></option>
                        <?php } ?>
                    </td>
                </tr>
                <tr class="row">
                    <th scope="row">
                        <label for="faq"><?php _e( 'FAQ', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="faq" id="faq" class="regular-text" value="1" checked>
                    </td>
                </tr>
                <tr class="row">
                    <th scope="row">
                        <label for="conclusion"><?php _e( 'Conclusion', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="conclusion" id="conclusion" class="regular-text" value="1" checked>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php wp_nonce_field( 'new-article' ); ?>
        <?php submit_button( __( 'Add Article(s)', 'automatebox' ), 'primary', 'submit_article' ); ?>
    </form>
</div>