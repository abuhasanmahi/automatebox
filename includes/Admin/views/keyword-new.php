<div class="wrap">
    <h1><?php _e( 'New Keyword', 'automatebox' ); ?></h1>
 
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row<?php echo $this->has_error( 'keyword' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="keyword"><?php _e( 'Keyword', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <textarea class="regular-text replace-special-character-kw" name="keyword" id="keyword" rows="8" placeholder="Enter keywords with line break. For example:&#10;&#10;best toys for kids&#10;best lawn mower machine&#10;best electric kettle&#10;&#10;You can input upto 2000 keywords/lines at a time"></textarea>

                        <?php if ( $this->has_error( 'keyword' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'keyword' ); ?></p>
                        <?php } ?>
                    </td>
                    <td>
                        <input type="hidden" name="token_id" id="token_id" value="<?php echo bin2hex(openssl_random_pseudo_bytes(8)); ?>">
                    </td>
                </tr>
                <script>
                    var textarea_kw = document.querySelector('textarea.replace-special-character-kw');
                    textarea_kw.addEventListener('keyup', function(e) {
                        this.value = this.value.replace(/'/, '’');
                    });
                    var textarea = document.getElementById("keyword");
                    textarea.onkeyup = function() {
                        var lines = textarea.value.split("\n");
                        textarea.value = lines.slice(0, 2000).join("\n");
                    }
                </script>
            </tbody>
        </table>

        <?php wp_nonce_field( 'new-keyword' ); ?>
        <?php submit_button( __( 'Add Keyword(s)', 'automatebox' ), 'primary', 'submit_keyword' ); ?>
    </form>
</div>