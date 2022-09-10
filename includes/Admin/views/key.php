<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'Key Validation', 'automatebox' ); ?></h1>
    <?php $quota = !empty($key['quota'])? $key['quota']:0; ?>
    <a class="page-title-action"><?php _e( 'Quota Left: '.$quota, 'automatebox' ); ?></a>
    <?php $ai_quota = !empty($key['ai_quota'])? $key['ai_quota']:0; ?>
    <a class="page-title-action"><?php _e( 'AI Quota Left: '.$ai_quota, 'automatebox' ); ?></a>
    <?php $word_limit = !empty($key['word_limit'])? $key['word_limit']:0; ?>
    <a class="page-title-action"><?php _e( 'Word Limit: '.$word_limit, 'automatebox' ); ?></a>
    <hr class="wp-header-end">
    
    <?php if ( isset( $_GET['key-updated'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Key has been updated successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['key-invalidcustomer'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Customer ID', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['key-invalidkey'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Key/Key2!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['key-invaliddomain'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Domain!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['key-duplicatedomain'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Duplicate Domain / Domain is in Use!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['key-invalidrequest'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Request!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['key-invalidip'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Validation IP!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>
    
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row<?php echo $this->has_error( 'customer_id' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="customer_id"><?php _e( 'Customer ID', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="customer_id" id="customer_id" class="regular-text" value="<?php echo $customer_id = !empty($key['customer_id'])? $key['customer_id']:''; ?>">
 
                        <?php if ( $this->has_error( 'customer_id' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'customer_id' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr class="row<?php echo $this->has_error( 'key1' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="key1"><?php _e( 'Key1', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="key1" id="key1" class="regular-text" value="<?php echo $key1 = !empty($key['key1'])? $key['key1']:''; ?>">
 
                        <?php if ( $this->has_error( 'key1' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'key' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr class="row<?php echo $this->has_error( 'key2' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="key2"><?php _e( 'Key2', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="key2" id="key2" class="regular-text" value="<?php echo $key2 = !empty($key['key2'])? $key['key2']:''; ?>">
 
                        <?php if ( $this->has_error( 'key2' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'key2' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
 
        <?php wp_nonce_field( 'key-edit' ); ?>
        <?php submit_button( __( 'Validate Key', 'automatebox' ), 'primary', 'submit_key' ); ?>
    </form>

    <h1 class="wp-heading-inline"><?php _e( 'Amazon Key Validation', 'automatebox' ); ?></h1>
    <?php $status = !empty($amazon_key['status'])? $amazon_key['status']:0; ?>
    <?php 
        if($status == 1){ 
            $status = 'Verified'; 
            ?><a class="page-title-action" style="color:green"><?php _e( 'Status: '.$status, 'automatebox' ); ?></a><?php
        }else{ 
            $status = 'Not Verified'; 
            ?><a class="page-title-action" style="color:red"><?php _e( 'Status: '.$status, 'automatebox' ); ?></a><?php
        } 
    ?>

    <?php if ( isset( $_GET['amazon-key-updated'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Amazon Key has been updated successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['amazon-key-invalid'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Amazon Credentials', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row<?php echo $this->has_error( 'tracking_id' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="tracking_id"><?php _e( 'Tracking ID (Retain)', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="tracking_id" id="tracking_id" class="regular-text" value="<?php echo $tracking_id = !empty($amazon_key['tracking_id'])? $amazon_key['tracking_id']:''; ?>">
 
                        <?php if ( $this->has_error( 'tracking_id' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'tracking_id' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr class="row<?php echo $this->has_error( 'access_key' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="access_key"><?php _e( 'Access Key', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="password" name="access_key" id="access_key" class="regular-text" value="<?php echo $access_key = !empty($amazon_key['access_key'])? $amazon_key['access_key']:''; ?>">
 
                        <?php if ( $this->has_error( 'access_key' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'access_key' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr class="row<?php echo $this->has_error( 'secret_key' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="secret_key"><?php _e( 'Secret Key', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="password" name="secret_key" id="secret_key" class="regular-text" value="<?php echo $secret_key = !empty($amazon_key['secret_key'])? $amazon_key['secret_key']:''; ?>">
 
                        <?php if ( $this->has_error( 'secret_key' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'secret_key' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr class="row<?php echo $this->has_error( 'partner_tag' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="partner_tag"><?php _e( 'Partner Tag / Store ID', 'automatebox' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="partner_tag" id="partner_tag" class="regular-text" value="<?php echo $partner_tag = !empty($amazon_key['partner_tag'])? $amazon_key['partner_tag']:''; ?>">
 
                        <?php if ( $this->has_error( 'partner_tag' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'partner_tag' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
 
        <?php wp_nonce_field( 'amazon-key' ); ?>
        <?php submit_button( __( 'Validate Amazon Key', 'automatebox' ), 'primary', 'submit_amazon_key' ); ?>
    </form>
</div>