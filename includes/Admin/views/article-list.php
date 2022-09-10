<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'Article', 'automatebox' ); ?></h1>
    <a href="<?php echo admin_url( 'admin.php?page=automatebox-article&action=new' ); ?>" class="page-title-action"><?php _e( 'Add New', 'automatebox' ); ?></a>
    <a href="<?php echo admin_url( 'admin.php?page=automatebox-article&action=processing' ); ?>" class="page-title-action"><?php _e( 'Processing', 'automatebox' ); ?></a>
    <hr class="wp-header-end">
    
    <?php if ( isset( $_GET['processed'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Article has been added on queue for processing!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['inserted'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Article has been added successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['duplicate'] ) ) { ?>
        <div class="notice notice-warning">
            <p><?php _e( 'Article has been added as a duplicate!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['undetectedfailure'] ) ) { ?>
        <div class="notice notice-warning">
            <p><?php _e( 'Failed!', 'automatebox' ); ?></p>
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

    <?php if ( isset( $_GET['nowordlimit'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Word Limit Exceeds', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['articlegenerationerror'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Article Generation Error', 'automatebox' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['articlenotfinished'] ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'Article not finished yet', 'automatebox' ); ?></p>
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

    <?php if ( isset( $_GET['article-deleted'] ) && $_GET['article-deleted'] == 'true' ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Article has been deleted successfully!', 'automatebox' ); ?></p>
        </div>
    <?php } ?>
    
    <form action="" method="post">
        <?php
        $table = new Automatebox\Admin\Article_List();
        $table->prepare_items();
        $table->search_box( 'Search Article', 'search_id' );
        $table->display();
        ?>
    </form>
</div>