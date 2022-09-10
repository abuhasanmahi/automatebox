<div class="wrap">
    <h1><?php _e( 'New Article', 'automatebox' ); ?></h1>
 
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row<?php echo $this->has_error( 'article' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="article"><?php _e( 'Article', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <textarea class="regular-text replace-special-character-kw" name="article" id="article" rows="8" placeholder="Enter articles with line break. For example:&#10;&#10;how to fly a drone&#10;what ingredients help hair growth&#10;why does washing machine drain into sewer line&#10;&#10;You can input upto 5 articles/lines at a time"></textarea>

                        <?php if ( $this->has_error( 'article' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'article' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <script>
                    var textarea_kw = document.querySelector('textarea.replace-special-character-kw');
                    textarea_kw.addEventListener('keyup', function(e) {
                        this.value = this.value.replace(/'/, '’');
                    });
                    var textarea = document.getElementById("article");
                    textarea.onkeyup = function() {
                        var lines = textarea.value.split("\n");
                        textarea.value = lines.slice(0, 5).join("\n");
                    }
                </script>
                <tr class="row">
                    <th scope="row">
                        <label for="length"><?php _e( 'Length', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <select name="length" id="length" class="regular-text">
                            <option value="very_long">Very Long (~1500 words)</option>
                            <option value="long">Long (~750 words)</option>
                            <option value="medium">Medium (~500 words)</option>
                            <option value="short">Short (~250 words)</option>
                            <option value="very_short">Very Short (~50 words)</option>
                        </select>
                    </td>
                </tr>
                <tr class="row">
                    <th scope="row">
                        <label for="section_heading"><?php _e( 'Section Heading', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="section_heading" id="section_heading" class="regular-text" value="1" checked>
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