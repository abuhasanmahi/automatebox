<div class="wrap">
    <h1><?php _e( 'Edit Profile', 'automatebox' ); ?></h1><br>
    <hr class="wp-header-end">

    <?php if ( isset( $_GET['profile-updated'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Profile has been updated successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>
    
    <style>
        .automatebox-settings-th{
            font-size: 18px !important;
            text-align: center !important;
            color: blue !important;
        }
    </style>
    
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <!--Title-->
                <tr>
                    <th scope="row" class="automatebox-settings-th">
                        <label for="title"><?php _e( 'Title', 'automatebox' ); ?></label>
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="title_prefix"><?php _e( 'Auto Title Prefix', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="flag_title_prefix" id="flag_title_prefix" class="regular-text" value="1" onclick="yesnoCheck()" <?php if ($settings['flag_title_prefix'] == 1) echo ' checked'; ?>>Yes
                        <input type="radio" name="flag_title_prefix" id="flag_title_prefix2" class="regular-text" value="0" onclick="yesnoCheck()" <?php if ($settings['flag_title_prefix'] == 0) echo ' checked'; ?>>No
                    </td>
                </tr>
                <tr id="ifYes" <?php if($settings['flag_title_prefix'] == 1){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row"></th>
                    <td>
                        <input type="text" name="title_prefix" id="title_prefix" placeholder="Write your custom title prefix" class="regular-text replace-special-character-prefix" value="<?php echo $title_prefix = !empty($settings['title_prefix'])? $settings['title_prefix']:''; ?>">
                    </td>
                </tr>
                <script type="text/javascript">
                    function yesnoCheck() {
                        if (document.getElementById('flag_title_prefix2').checked) {
                            document.getElementById('ifYes').style.display = 'table-row';
                        }
                        else {
                            document.getElementById('ifYes').style.display = 'none';
                        }
                    }
                </script>
                <script>
                    var input_prefix = document.querySelector('input.replace-special-character-prefix');
                    input_prefix.addEventListener('keyup', function(e) {
                        this.value = this.value.replace(/'/, '’');
                    });
                </script>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="title_suffix"><?php _e( 'Auto Title Suffix', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="flag_title_suffix" id="flag_title_suffix" class="regular-text" value="1" onclick="yesnoCheck2()" <?php if ($settings['flag_title_suffix'] == 1) echo ' checked'; ?>>Yes
                        <input type="radio" name="flag_title_suffix" id="flag_title_suffix2" class="regular-text" value="0" onclick="yesnoCheck2()" <?php if ($settings['flag_title_suffix'] == 0) echo ' checked'; ?>>No
                    </td>
                </tr>
                <tr id="ifYes2" <?php if($settings['flag_title_suffix'] == 1){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row"></th>
                    <td>
                        <input type="text" name="title_suffix" id="title_suffix" placeholder="Write your custom title suffix" class="regular-text replace-special-character-suffix" value="<?php echo $title_suffix = !empty($settings['title_suffix'])? $settings['title_suffix']:''; ?>">
                    </td>
                </tr>
                <script type="text/javascript">
                    function yesnoCheck2() {
                        if (document.getElementById('flag_title_suffix2').checked) {
                            document.getElementById('ifYes2').style.display = 'table-row';
                        }
                        else {
                            document.getElementById('ifYes2').style.display = 'none';
                        }
                    }
                </script>
                <script>
                    var input_suffix = document.querySelector('input.replace-special-character-suffix');
                    input_suffix.addEventListener('keyup', function(e) {
                        this.value = this.value.replace(/'/, '’');
                    });
                </script>

                <!--Content-->
                <tr>
                    <th scope="row" class="automatebox-settings-th">
                        <label for="content"><?php _e( 'Content', 'automatebox' ); ?></label>
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="content_type"><?php _e( 'Content Type', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="content" id="content" class="regular-text" value="2" onclick="yesnoCheckmanual()" <?php if ($settings['content'] == 2) echo ' checked'; ?>>Auto
                        <input type="radio" name="content" id="content2" class="regular-text" value="0" onclick="yesnoCheckmanual()" <?php if ($settings['content'] == 0) echo ' checked'; ?>>Manual
                        <input type="radio" name="content" id="content3" class="regular-text" value="1" onclick="yesnoCheckmanual()" <?php if ($settings['content'] == 1) echo ' checked'; ?>>AI
                    </td>
                </tr>
                <tr id="ifYesmanual0" <?php if($settings['content'] == 0 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="ai_section"><?php _e( 'Select AI Section', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="select_ai_introduction" id="select_ai_introduction" class="regular-text" value="1" <?php if (@$settings['select_ai_introduction'] == 1) echo ' checked'; ?>>Introduction
                        <input type="checkbox" name="select_ai_product_description" id="select_ai_product_description" class="regular-text" value="1" <?php if (@$settings['select_ai_product_description'] == 1) echo ' checked'; ?>>Product Description
                        <input type="checkbox" name="select_ai_buying_guide" id="select_ai_buying_guide" class="regular-text" value="1" <?php if (@$settings['select_ai_buying_guide'] == 1) echo ' checked'; ?>>Buying Guide
                        <input type="checkbox" name="select_ai_faq" id="select_ai_faq" class="regular-text" value="1" <?php if (@$settings['select_ai_faq'] == 1) echo ' checked'; ?>>FAQ
                        <input type="checkbox" name="select_ai_conclusion" id="select_ai_conclusion" class="regular-text" value="1" <?php if (@$settings['select_ai_conclusion'] == 1) echo ' checked'; ?>>Conclusion
                    </td>
                </tr>
                <tr id="ifYesmanual18" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="keyword_sample"><?php _e( 'Keyword Sample', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <ul>
                            <li><b>---KEYWORD---</b> : your keyword (Best Electric Bike)</li>
                            <li><b>---KEYWORD2---</b> : your keyword except first word (Electric Bike)</li>
                            <li><b>---KEYWORD3---</b> : Top + your keyword except first word (Top Electric Bike)</li>
                            <li><b>---KEYWORD4---</b> : your keyword except first word + Reviews (Electric Bike Reviews)</li>
                        </ul>
                    </td>
                </tr>
                <tr id="ifYesmanual" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="introduction"><?php _e( 'Introduction 1', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $introduction_id = !empty($settings['introduction_id'])? $settings['introduction_id']:'';
                            wp_editor(stripslashes(html_entity_decode($introduction_id)), 'introduction_id'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual2" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="introduction2"><?php _e( 'Introduction 2', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $introduction_id2 = !empty($settings['introduction_id2'])? $settings['introduction_id2']:'';
                            wp_editor(stripslashes(html_entity_decode($introduction_id2)), 'introduction_id2'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual3" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="introduction3"><?php _e( 'Introduction 3', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $introduction_id3 = !empty($settings['introduction_id3'])? $settings['introduction_id3']:'';
                            wp_editor(stripslashes(html_entity_decode($introduction_id3)), 'introduction_id3'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual4" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="introduction4"><?php _e( 'Introduction 4', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $introduction_id4 = !empty($settings['introduction_id4'])? $settings['introduction_id4']:'';
                            wp_editor(stripslashes(html_entity_decode($introduction_id4)), 'introduction_id4'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual5" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="introduction5"><?php _e( 'Introduction 5', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $introduction_id5 = !empty($settings['introduction_id5'])? $settings['introduction_id5']:'';
                            wp_editor(stripslashes(html_entity_decode($introduction_id5)), 'introduction_id5'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual6" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="buying_guide_title"><?php _e( 'Buying Guide Title', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="buying_guide_title" id="buying_guide_title" class="regular-text" value="1" <?php if (@$settings['buying_guide_title'] == 1) echo ' checked'; ?>>On
                        <input type="radio" name="buying_guide_title" id="buying_guide_title2" class="regular-text" value="0" <?php if (@$settings['buying_guide_title'] == 0) echo ' checked'; ?>>Off
                    </td>
                </tr>
                <tr id="ifYesmanual7" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="buying_guide"><?php _e( 'Buying Guide 1', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $buying_guide_id = !empty($settings['buying_guide_id'])? $settings['buying_guide_id']:'';
                            wp_editor(stripslashes(html_entity_decode($buying_guide_id)), 'buying_guide_id'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual8" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="buying_guide2"><?php _e( 'Buying Guide 2', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $buying_guide_id2 = !empty($settings['buying_guide_id2'])? $settings['buying_guide_id2']:'';
                            wp_editor(stripslashes(html_entity_decode($buying_guide_id2)), 'buying_guide_id2'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual9" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="buying_guide3"><?php _e( 'Buying Guide 3', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $buying_guide_id3 = !empty($settings['buying_guide_id3'])? $settings['buying_guide_id3']:'';
                            wp_editor(stripslashes(html_entity_decode($buying_guide_id3)), 'buying_guide_id3'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual10" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="buying_guide4"><?php _e( 'Buying Guide 4', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $buying_guide_id4 = !empty($settings['buying_guide_id4'])? $settings['buying_guide_id4']:'';
                            wp_editor(stripslashes(html_entity_decode($buying_guide_id4)), 'buying_guide_id4'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual11" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="buying_guide5"><?php _e( 'Buying Guide 5', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $buying_guide_id5 = !empty($settings['buying_guide_id5'])? $settings['buying_guide_id5']:'';
                            wp_editor(stripslashes(html_entity_decode($buying_guide_id5)), 'buying_guide_id5'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual12" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="conclusion_title"><?php _e( 'Conclusion Title', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="conclusion_title" id="conclusion_title" class="regular-text" value="1" <?php if (@$settings['conclusion_title'] == 1) echo ' checked'; ?>>On
                        <input type="radio" name="conclusion_title" id="conclusion_title2" class="regular-text" value="0" <?php if (@$settings['conclusion_title'] == 0) echo ' checked'; ?>>Off
                    </td>
                </tr>
                <tr id="ifYesmanual13" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="conclusion"><?php _e( 'Conclusion 1', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $conclusion_id = !empty($settings['conclusion_id'])? $settings['conclusion_id']:'';
                            wp_editor(stripslashes(html_entity_decode($conclusion_id)), 'conclusion_id'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual14" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="conclusion2"><?php _e( 'Conclusion 2', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $conclusion_id2 = !empty($settings['conclusion_id2'])? $settings['conclusion_id2']:'';
                            wp_editor(stripslashes(html_entity_decode($conclusion_id2)), 'conclusion_id2'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual15" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="conclusion3"><?php _e( 'Conclusion 3', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $conclusion_id3 = !empty($settings['conclusion_id3'])? $settings['conclusion_id3']:'';
                            wp_editor(stripslashes(html_entity_decode($conclusion_id3)), 'conclusion_id3'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual16" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="conclusion4"><?php _e( 'Conclusion 4', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $conclusion_id4 = !empty($settings['conclusion_id4'])? $settings['conclusion_id4']:'';
                            wp_editor(stripslashes(html_entity_decode($conclusion_id4)), 'conclusion_id4'); 
                        ?>
                    </td>
                </tr>
                <tr id="ifYesmanual17" <?php if($settings['content'] == 1 || $settings['content'] == 2){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="conclusion5"><?php _e( 'Conclusion 5', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <?php 
                            $conclusion_id5 = !empty($settings['conclusion_id5'])? $settings['conclusion_id5']:'';
                            wp_editor(stripslashes(html_entity_decode($conclusion_id5)), 'conclusion_id5'); 
                        ?>
                    </td>
                </tr>
                <script type="text/javascript">
                    function yesnoCheckmanual() {
                        if (document.getElementById('content2').checked) {
                            document.getElementById('ifYesmanual').style.display = 'table-row';
                            document.getElementById('ifYesmanual2').style.display = 'table-row';
                            document.getElementById('ifYesmanual3').style.display = 'table-row';
                            document.getElementById('ifYesmanual4').style.display = 'table-row';
                            document.getElementById('ifYesmanual5').style.display = 'table-row';
                            document.getElementById('ifYesmanual6').style.display = 'table-row';
                            document.getElementById('ifYesmanual7').style.display = 'table-row';
                            document.getElementById('ifYesmanual8').style.display = 'table-row';
                            document.getElementById('ifYesmanual9').style.display = 'table-row';
                            document.getElementById('ifYesmanual10').style.display = 'table-row';
                            document.getElementById('ifYesmanual11').style.display = 'table-row';
                            document.getElementById('ifYesmanual12').style.display = 'table-row';
                            document.getElementById('ifYesmanual13').style.display = 'table-row';
                            document.getElementById('ifYesmanual14').style.display = 'table-row';
                            document.getElementById('ifYesmanual15').style.display = 'table-row';
                            document.getElementById('ifYesmanual16').style.display = 'table-row';
                            document.getElementById('ifYesmanual17').style.display = 'table-row';
                            document.getElementById('ifYesmanual18').style.display = 'table-row';
                        }
                        else {
                            document.getElementById('ifYesmanual').style.display = 'none';
                            document.getElementById('ifYesmanual2').style.display = 'none';
                            document.getElementById('ifYesmanual3').style.display = 'none';
                            document.getElementById('ifYesmanual4').style.display = 'none';
                            document.getElementById('ifYesmanual5').style.display = 'none';
                            document.getElementById('ifYesmanual6').style.display = 'none';
                            document.getElementById('ifYesmanual7').style.display = 'none';
                            document.getElementById('ifYesmanual8').style.display = 'none';
                            document.getElementById('ifYesmanual9').style.display = 'none';
                            document.getElementById('ifYesmanual10').style.display = 'none';
                            document.getElementById('ifYesmanual11').style.display = 'none';
                            document.getElementById('ifYesmanual12').style.display = 'none';
                            document.getElementById('ifYesmanual13').style.display = 'none';
                            document.getElementById('ifYesmanual14').style.display = 'none';
                            document.getElementById('ifYesmanual15').style.display = 'none';
                            document.getElementById('ifYesmanual16').style.display = 'none';
                            document.getElementById('ifYesmanual17').style.display = 'none';
                            document.getElementById('ifYesmanual18').style.display = 'none';
                        }

                        if (document.getElementById('content3').checked) {
                            document.getElementById('ifYesmanual0').style.display = 'table-row';
                        }
                        else {
                            document.getElementById('ifYesmanual0').style.display = 'none';
                        }
                    }
                </script>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="custom_category"><?php _e( 'Category', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="custom_category" id="custom_category" class="regular-text" value="0" onclick="yesnoCheckcc()" <?php if ($settings['custom_category'] == 0) echo ' checked'; ?>>Auto
                        <input type="radio" name="custom_category" id="custom_category2" class="regular-text" value="1" onclick="yesnoCheckcc()" <?php if ($settings['custom_category'] == 1) echo ' checked'; ?>>Manual
                    </td>
                </tr>
                <tr id="ifYescc" <?php if($settings['custom_category'] == 0){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row"></th>
                    <td>
                        <?php wp_dropdown_categories(array('selected' => $settings['custom_category_text'], 'orderby' => 'name', 'hide_empty' => false)); ?>
                    </td>
                </tr>
                <script type="text/javascript">
                    function yesnoCheckcc() {
                        if (document.getElementById('custom_category2').checked) {
                            document.getElementById('ifYescc').style.display = 'table-row';
                        }
                        else {
                            document.getElementById('ifYescc').style.display = 'none';
                        }
                    }
                </script>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="tags"><?php _e( 'Tags', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="tags" id="tags" class="regular-text" value="1" <?php if (@$settings['tags'] == 1) echo ' checked'; ?>>Yes
                        <input type="radio" name="tags" id="tags2" class="regular-text" value="0" <?php if (@$settings['tags'] == 0) echo ' checked'; ?>>No
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="permalink"><?php _e( 'Permalink', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="permalink" id="permalink" class="regular-text" value="1" <?php if ($settings['permalink'] == 1) echo ' checked'; ?>>Keyword
                        <input type="radio" name="permalink" id="permalink3" class="regular-text" value="2" <?php if ($settings['permalink'] == 2) echo ' checked'; ?>>Keyword without Best
                        <input type="radio" name="permalink" id="permalink2" class="regular-text" value="0" <?php if ($settings['permalink'] == 0) echo ' checked'; ?>>Title
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="featured_img"><?php _e( 'Use Featured Image', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="featured_img" id="featured_img" class="regular-text" value="1" <?php if ($settings['featured_img'] == 1) echo ' checked'; ?>>Yes
                        <input type="radio" name="featured_img" id="featured_img2" class="regular-text" value="0" <?php if ($settings['featured_img'] == 0) echo ' checked'; ?>>No
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="interlink"><?php _e( 'Show Interlink (Retain)', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="interlink" id="interlink" class="regular-text" value="1" <?php if ($settings['interlink'] == 1) echo ' checked'; ?>>Yes
                        <input type="radio" name="interlink" id="interlink2" class="regular-text" value="0" <?php if ($settings['interlink'] == 0) echo ' checked'; ?>>No
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="show_affiliate_disclaimer"><?php _e( 'Show Affiliate Disclaimer (Retain)', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="show_affiliate_disclaimer" id="show_affiliate_disclaimer" class="regular-text" value="1" onclick="affiliateCheck()" <?php if ($settings['show_affiliate_disclaimer'] == 1) echo ' checked'; ?>>Yes
                        <input type="radio" name="show_affiliate_disclaimer" id="show_affiliate_disclaimer2" class="regular-text" value="0" onclick="affiliateCheck()" <?php if ($settings['show_affiliate_disclaimer'] == 0) echo ' checked'; ?>>No
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row"></th>
                    <td id="ifYes6" <?php if($settings['show_affiliate_disclaimer'] == 0){ ?>style="display:none" <?php } ?>>
                        <textarea class="regular-text replace-special-character-disclaimer" name="affiliate_disclaimer" id="affiliate_disclaimer" placeholder="Write Affiliate Disclaimer" rows="7"><?php echo $affiliate_disclaimer = !empty($settings['affiliate_disclaimer'])? $settings['affiliate_disclaimer']:''; ?></textarea>
                    </td>
                </tr>
                <script type="text/javascript">
                    function affiliateCheck() {
                        if (document.getElementById('show_affiliate_disclaimer').checked) {
                            document.getElementById('ifYes6').style.display = 'table-row';
                        }
                        else {
                            document.getElementById('ifYes6').style.display = 'none';
                        }
                    }
                </script>
                <script>
                    var textarea_disclaimer = document.querySelector('textarea.replace-special-character-disclaimer');
                    textarea_disclaimer.addEventListener('keyup', function(e) {
                        this.value = this.value.replace(/'/, '’');
                    });
                </script>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="show_product_description"><?php _e( 'Show Product Description', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="show_product_description" id="show_product_description" class="regular-text" value="1" <?php if (@$settings['show_product_description'] == 1) echo ' checked'; ?>>Yes
                        <input type="radio" name="show_product_description" id="show_product_description2" class="regular-text" value="0" <?php if (@$settings['show_product_description'] == 0) echo ' checked'; ?>>No
                    </td>
                </tr>

                <!--Table-->
                <tr>
                    <th scope="row" class="automatebox-settings-th">
                        <label for="table"><?php _e( 'Table', 'automatebox' ); ?></label>
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="show_table"><?php _e( 'Show Table', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="show_table" id="show_table" class="regular-text" value="1" onclick="tableCheck()" <?php if ($settings['show_table'] == 1) echo ' checked'; ?>>Yes
                        <input type="radio" name="show_table" id="show_table2" class="regular-text" value="0" onclick="tableCheck()" <?php if ($settings['show_table'] == 0) echo ' checked'; ?>>No
                    </td>
                </tr>
                <tr id="ifYes4" <?php if($settings['show_table'] == 0){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">
                        <label for="show_table_column"><?php _e( 'Select Column on Table', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="show_table_serial" id="show_table_serial" class="regular-text" value="1" <?php if (@$settings['show_table_serial'] == 1) echo ' checked'; ?>>Serial
                        <input type="checkbox" name="show_table_img" id="show_table_img" class="regular-text" value="1" <?php if ($settings['show_table_img'] == 1) echo ' checked'; ?>>Preview Image
                        <input type="checkbox" name="show_table_product" id="show_table_product" class="regular-text" value="1" checked disabled>Product Title
                        <input type="checkbox" name="show_table_score" id="show_table_score" class="regular-text" value="1" <?php if (@$settings['show_table_score'] == 1) echo ' checked'; ?>>Score
                        <input type="checkbox" name="show_table_price" id="show_table_price" class="regular-text" value="1" <?php if (@$settings['show_table_price'] == 1) echo ' checked'; ?>>Price
                        <input type="checkbox" name="show_table_action" id="show_table_action" class="regular-text" value="1" checked disabled>Action
                    </td>
                </tr>
                <script type="text/javascript">
                    function tableCheck() {
                        if (document.getElementById('show_table').checked) {
                            document.getElementById('ifYes4').style.display = 'table-row';
                            document.getElementById('ifYes5').style.display = 'table-row';
                        }
                        else {
                            document.getElementById('ifYes4').style.display = 'none';
                            document.getElementById('ifYes5').style.display = 'none';
                        }
                    }
                </script>

                <!--Button-->
                <tr>
                    <th scope="row" class="automatebox-settings-th">
                        <label for="button"><?php _e( 'Button', 'automatebox' ); ?></label>
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="button_text"><?php _e( 'Button Text (Retain)', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="button_text" id="button_text" class="regular-text replace-special-character-button" value="<?php echo $showtable = !empty($settings['button_text'])? $settings['button_text']:''; ?>">
                    </td>
                </tr>
                <script>
                    var input_button = document.querySelector('input.replace-special-character-button');
                    input_button.addEventListener('keyup', function(e) {
                        this.value = this.value.replace(/'/, '’');
                    });
                </script>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="button_style"><?php _e( 'Button Style (Retain)', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="button_style" id="button_style" class="regular-text" value="0" <?php if ($settings['button_style'] == 0) echo ' checked'; ?>>Default
                        <input type="radio" name="button_style" id="button_style2" class="regular-text" value="1" <?php if ($settings['button_style'] == 1) echo ' checked'; ?>>Amazon Cart
                    </td>
                </tr>

                <!--Product-->
                <tr>
                    <th scope="row" class="automatebox-settings-th">
                        <label for="product"><?php _e( 'Product', 'automatebox' ); ?></label>
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="product_number"><?php _e( 'Product Number', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <select name="product_number" id="product_number" class="regular-text">
                            <option value="10"<?php if ($settings['product_number'] == '10') echo ' selected="selected"'; ?>>10</option>
                            <option value="9"<?php if ($settings['product_number'] == '9') echo ' selected="selected"'; ?>>9</option>
                            <option value="8"<?php if ($settings['product_number'] == '8') echo ' selected="selected"'; ?>>8</option>
                            <option value="7"<?php if ($settings['product_number'] == '7') echo ' selected="selected"'; ?>>7</option>
                            <option value="6"<?php if ($settings['product_number'] == '6') echo ' selected="selected"'; ?>>6</option>
                            <option value="5"<?php if ($settings['product_number'] == '5') echo ' selected="selected"'; ?>>5</option>
                            <option value="4"<?php if ($settings['product_number'] == '4') echo ' selected="selected"'; ?>>4</option>
                            <option value="3"<?php if ($settings['product_number'] == '3') echo ' selected="selected"'; ?>>3</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="feature_style"><?php _e( 'Product Feature Style', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="feature_style" id="feature_style" class="regular-text" value="0" <?php if ($settings['feature_style'] == 0) echo ' checked'; ?>>Default
                        <input type="radio" name="feature_style" id="feature_style2" class="regular-text" value="1" <?php if ($settings['feature_style'] == 1) echo ' checked'; ?>>Border
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="feature_shuffle"><?php _e( 'Product Feature Shuffle', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="feature_shuffle" id="feature_shuffle" class="regular-text" value="0" <?php if ($settings['feature_shuffle'] == 0) echo ' checked'; ?>>Default
                        <input type="radio" name="feature_shuffle" id="feature_shuffle2" class="regular-text" value="1" <?php if ($settings['feature_shuffle'] == 1) echo ' checked'; ?>>Shuffle
                    </td>
                </tr>

                <!--Scheduler-->
                <tr>
                    <th scope="row" class="automatebox-settings-th">
                        <label for="scheduler"><?php _e( 'Scheduler', 'automatebox' ); ?></label>
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <th scope="row">
                        <label for="post_status"><?php _e( 'Post Status', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="radio" name="post_status" id="post_status" class="regular-text" value="1" onclick="postCheck()" <?php if ($settings['post_status'] == 1) echo ' checked'; ?>>Publish
                        <input type="radio" name="post_status" id="post_status2" class="regular-text" value="0" onclick="postCheck()" <?php if ($settings['post_status'] == 0) echo ' checked'; ?>>Draft
                    </td>
                </tr>
                <tr id="ifYes3" <?php if($settings['post_status'] == 1){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">Frequency</th>
                    <td>
                        <select name="frequency" id="frequency" class="regular-text">
                            <option value="0"<?php if ($settings['frequency'] == 0) echo ' selected="selected"'; ?>>Disable Draft Auto Publish</option>
                            <option value="60"<?php if ($settings['frequency'] == 60) echo ' selected="selected"'; ?>>After Every 1 Minute</option>
                            <option value="300"<?php if ($settings['frequency'] == 300) echo ' selected="selected"'; ?>>After Every 5 Minutes</option>
                            <option value="1800"<?php if ($settings['frequency'] == 1800) echo ' selected="selected"'; ?>>After Every 30 Minutes</option>
                            <option value="3600"<?php if ($settings['frequency'] == 3600) echo ' selected="selected"'; ?>>After Every 1 Hour</option>
                            <option value="7200"<?php if ($settings['frequency'] == 7200) echo ' selected="selected"'; ?>>After Every 2 Hours</option>
                            <option value="10800"<?php if ($settings['frequency'] == 10800) echo ' selected="selected"'; ?>>After Every 3 Hours</option>
                            <option value="14400"<?php if ($settings['frequency'] == 14400) echo ' selected="selected"'; ?>>After Every 4 Hours</option>
                            <option value="18000"<?php if ($settings['frequency'] == 18000) echo ' selected="selected"'; ?>>After Every 5 Hours</option>
                            <option value="21600"<?php if ($settings['frequency'] == 21600) echo ' selected="selected"'; ?>>After Every 6 Hours</option>
                            <option value="43200"<?php if ($settings['frequency'] == 43200) echo ' selected="selected"'; ?>>After Every 12 Hours</option>
                            <option value="86400"<?php if ($settings['frequency'] == 86400) echo ' selected="selected"'; ?>>After Every 24 Hours</option> 
                        </select>
                    </td>
                </tr>
                <tr id="ifYes30" <?php if($settings['post_status'] == 1){ ?>style="display:none" <?php } ?>>
                    <td></td>
                    <th scope="row">Number of Post(s)</th>
                    <td>
                        <select name="frequency_number" id="frequency_number" class="regular-text">
                            <option value="1"<?php if ($settings['frequency_number'] == 1) echo ' selected="selected"'; ?>>1</option>
                            <option value="2"<?php if ($settings['frequency_number'] == 2) echo ' selected="selected"'; ?>>2</option>
                            <option value="3"<?php if ($settings['frequency_number'] == 3) echo ' selected="selected"'; ?>>3</option>
                            <option value="4"<?php if ($settings['frequency_number'] == 4) echo ' selected="selected"'; ?>>4</option>
                            <option value="5"<?php if ($settings['frequency_number'] == 5) echo ' selected="selected"'; ?>>5</option>
                            <option value="8"<?php if ($settings['frequency_number'] == 8) echo ' selected="selected"'; ?>>8</option>
                            <option value="9"<?php if ($settings['frequency_number'] == 9) echo ' selected="selected"'; ?>>9</option>
                            <option value="10"<?php if ($settings['frequency_number'] == 10) echo ' selected="selected"'; ?>>10</option>
                            <option value="20"<?php if ($settings['frequency_number'] == 20) echo ' selected="selected"'; ?>>20</option>
                            <option value="30"<?php if ($settings['frequency_number'] == 30) echo ' selected="selected"'; ?>>30</option>
                            <option value="50"<?php if ($settings['frequency_number'] == 50) echo ' selected="selected"'; ?>>50</option>
                            <option value="100"<?php if ($settings['frequency_number'] == 100) echo ' selected="selected"'; ?>>100</option> 
                        </select>
                    </td>
                </tr>
                <script type="text/javascript">
                    function postCheck() {
                        if (document.getElementById('post_status2').checked) {
                            document.getElementById('ifYes3').style.display = 'table-row';
                            document.getElementById('ifYes30').style.display = 'table-row';
                        }
                        else {
                            document.getElementById('ifYes3').style.display = 'none';
                            document.getElementById('ifYes30').style.display = 'none';
                        }
                    }
                </script>                
            </tbody>
        </table>
 
        <input type="hidden" name="id" value="<?php echo $id = !empty($settings['id'])? $settings['id']:''; ?>">
        <?php wp_nonce_field( 'new-profile' ); ?>
        <?php submit_button( __( 'Update Profile', 'automatebox' ), 'primary', 'submit_profile' ); ?>
    </form>
</div>