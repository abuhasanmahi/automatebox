<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'Keyword', 'automatebox' ); ?></h1>
    <a href="<?php echo admin_url( 'admin.php?page=automatebox-keyword&action=new' ); ?>" class="page-title-action"><?php _e( 'Add New', 'automatebox' ); ?></a>
    <hr class="wp-header-end">
    
    <?php if ( isset( $_GET['inserted'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Keyword has been added successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['duplicate'] ) ) { ?>
        <div class="notice notice-warning">
            <p><?php _e( 'Keyword has been added as a duplicate!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['exceedlimit'] ) ) { ?>
        <div class="notice notice-warning">
            <p><?php _e( 'Exceeded Limit!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['noapi'] ) ) { ?>
        <div class="notice notice-warning">
            <p><?php _e( 'Unable to connect with API!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['invalidcustomer'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Customer ID', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['invalidkey'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Key', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['invalidip'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid IP', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['noquota'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'No Quota Available', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['noaiquota'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'No AI Quota Available', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['invalidamazon'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Invalid Amazon Credentials', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['failedamazon'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Failed to get content from Amazon', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['keyword-deleted'] ) && $_GET['keyword-deleted'] == 'true' ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Keyword has been deleted successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>
    
    <form action="" method="post">
        <?php
        $table = new Automatebox\Admin\Keyword_List();
        $table->prepare_items();
        $table->search_box( 'Search Keywords', 'search_id' );
        $table->display();
        ?>
    </form>
</div>