<?php

namespace Automatebox\Admin;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List Table Class
 */
class Keyword_List extends \WP_List_Table {

    function __construct() {
        parent::__construct( [
            'singular' => 'keyword',
            'plural'   => 'keywords',
            'ajax'     => false
        ] );
    }

    /**
     * Message to show if no designation found
     *
     * @return void
     */
    function no_items() {
        _e( 'No Keyword found', 'automatebox' );
    }

    /**
     * Get the column names
     *
     * @return array
     */
    public function get_columns() {
        return [
            'cb'            => '<input type="checkbox" />',
            'keyword'       => __( 'Keyword', 'automatebox' ),
            'status'       => __( 'Status', 'automatebox' ),
            'created_at'    => __( 'Date', 'automatebox' ),
        ];
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = [
            'keyword'           => [ 'keyword', true ],
            'status'           => [ 'status', true ],
            'created_at'        => [ 'created_at', true ],
        ];

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'bulk-delete'  => __( 'Delete', 'automatebox' ),
        );

        return $actions;
    }

    /**
     * Default column values
     *
     * @param  object $item
     * @param  string $column_name
     *
     * @return string
     */
    protected function column_default( $item, $column_name ) {

        switch ( $column_name ) {

            case 'created_at':
                return wp_date( get_option( 'date_format' ), strtotime( $item->created_at ) );

            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
        }
    }

    /**
     * Render the "name" column
     *
     * @param  object $item
     *
     * @return string
     */
    public function column_keyword( $item ) {
        $actions = [];

        $actions['delete'] = sprintf( '<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=wd-delete-keyword&id=' . $item->id ), 'wd-delete-keyword' ), $item->id, __( 'Delete', 'automatebox' ), __( 'Delete', 'automatebox' ) );

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=automatebox-keyword&action=view&id' . $item->id ), $item->keyword, $this->row_actions( $actions )
        );
    }

    /**
     * Render the "cb" column
     *
     * @param  object $item
     *
     * @return string
     */
    protected function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="keyword_id[]" value="%d" />', $item->id
        );
    }

    /**
     * Prepare the keyword items
     *
     * @return void
     */
    public function prepare_items() {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [ $column, $hidden, $sortable ];

        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        $search_term = isset($_POST['s']) ? trim($_POST['s']) : "";
        
        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'] ;
        }

        if (!empty($search_term)){
            $this->items = wd_keyword_gets2( $args, $search_term );
            $this->set_pagination_args( [
                'total_items' => wd_keyword_count2($search_term),
                'per_page'    => $per_page
            ] );
        }else{
            $this->items = wd_keyword_gets( $args );
            $this->set_pagination_args( [
                'total_items' => wd_keyword_count(),
                'per_page'    => $per_page
            ] );
        }

        $actions = $this->current_action();
        if( 'bulk-delete'===$actions ) {
            $delete_ids = esc_sql( $_POST['keyword_id'] );
            $this->items = wd_delete_keywords( $delete_ids );

            $this->set_pagination_args( [
                'total_items' => wd_keyword_count(),
                'per_page'    => $per_page
            ] );
        }
    }
}