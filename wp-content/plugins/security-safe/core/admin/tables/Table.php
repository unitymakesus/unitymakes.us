<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( ! defined( 'ABSPATH' ) ) { die; }

Use \WP_List_Table;

if ( ! class_exists( 'WP_List_Table' ) ) {

    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

}

/**
 * Class Table
 * @package SecuritySafe
 * @since 2.0.0
 */
class Table extends WP_List_Table {

    /**
     * The desired type of data to display
     * @since  2.0.0
     */ 
    protected $type = false;


    function __construct() {

        parent::__construct();

        // Set the type to retrieve
        $this->set_type();

        // Set the columns
        $this->_column_headers = [
            $this->get_columns(), 
            [], //hidden columns if applicable 
            $this->get_sortable_columns()
        ];

    } // __construct()


    /**
     * Set the type of data to display.
     * @since  2.0.0
     */
    protected function set_type() {

        // This must be overwritten by the child class.

    } // set_type()


    /**
     * Get a list of sortable columns. The format is:
     * 'internal-name' => 'orderby'
     * or
     * 'internal-name' => array( 'orderby', true )
     *
     * The second format will make the initial sorting order be descending
     * 
     * @package WordPress
     * @since 3.1.0
     *
     * @return array
     */
    function get_sortable_columns() {

        return [
            'date' => [ 'date', true ], 
            'uri' => [ 'uri', true ], 
            'ip' => [ 'ip', true ],
            'status' => [ 'status', true ],
            'username' => [ 'username', true ],
            'user_agent' => [ 'user_agent', true ],
            'referer' => [ 'referer', true ]
        ];

    } // get_sortable_columns()


    /**
     * @package WordPress
     * @param object $item
     * @param string $column_name
     */
    protected function column_default( $item, $column_name ) {
        
        return esc_html( $item->$column_name );

    } // column_default()


    protected function column_cb( $item ) {

        return '<input type="checkbox" name="bulk_action[]" value="' . esc_html( $item->ID ) . '" />';

    } // column_cb()


    protected function column_uri( $item ) {

        $uri = esc_html( $item->uri );

        return '<a href="' . $uri . '" target="_blank">' . $uri . '</a>';
    
    } // column_uri()


    protected function column_ip( $item ) {

        return esc_html( $item->ip );
    
    } // column_ip()


    protected function column_threats( $item ) {

        return ( $item->threats ) ? __( 'yes', SECSAFE_SLUG ) : __( 'no', SECSAFE_SLUG );
        
    } // column_details()


    protected function column_date_expire( $item ) {

        $date_expire = esc_html( $item->date_expire );
        $date_expire = ( $date_expire == '0000-00-00 00:00:00' ) ? __( 'never', SECSAFE_SLUG ) : $date_expire;

        return $date_expire;
    
    } // column_ip()


    /** 
     * This deletes entries in bulk
     * @return int Number of rows affected
     */
    private function bulk_delete() {

        global $wpdb;

        if ( empty( $_REQUEST[ 'bulk_action' ] ) ) { return; }

        $table = Yoda::get_table_main();
        $ids = array_map( 'intval', (array) $_REQUEST['bulk_action'] );
        $ids = implode( ',', $ids );

        return $wpdb->query( "DELETE FROM $table WHERE ID IN ( $ids )" );
    
    } // bulk_delete()


    /**
     * Get the array of searchable columns in the database
     * @since  2.0.0
     * @return  array An unassociated array.
     */ 
    protected function get_searchable_columns() {
        
        // Must be overwritten by child class
        return false;

    } // get_searchable_columns()


    /**
     * Gets the search query
     * @since  2.0.0
     * @return string
     */  
    private function get_search_query() {

        global $wpdb;

        $query = '';
        $search = isset( $_REQUEST['s'] ) ? $wpdb->esc_like( $_REQUEST['s'] ) : '' ; // Sanitized
        $searchable_columns = $this->get_searchable_columns();

        // Add and Sanitize Search Query
        if ( ! empty( $search ) && isset( $searchable_columns[ 0 ] ) ) {

            $num = 0;

            $query = " AND ( ";

            foreach ( $searchable_columns as $column ) {

                $num++;
                $query .= ( $num > 1 ) ? " OR " : "";
                $query .= "($column LIKE '%$search%')";

            } // foreach()

            $query .= " ) ";
            
        }

        return $query;

    } // get_search_query()


    /**
     * Prepares the list of items for displaying.
     * 
     * @package  WordPress
     * @uses WP_List_Table::set_pagination_args()
     *
     * @since 3.1.0
     * @abstract
     */
    function prepare_items() {

        global $wpdb;

        // Bail if the type is not valid
        if ( ! $this->type || ! in_array( $this->type, Yoda::get_types() ) ) { return; }
        
        // Process Bulk Deletes
        if ( 'delete' === $this->current_action() ) {

            $deleted = $this->bulk_delete();
            echo '<div id="message" class="updated"><p>' . $deleted . ' rows deleted</p></div>';

        }
        
        // Clean Values
        $table = Yoda::get_table_main(); // Sanitized
        $page = $this->get_pagenum(); // Sanitized
        $per_page = ( isset( $_REQUEST['per_page'] ) ) ? filter_var( $_REQUEST['per_page'], FILTER_SANITIZE_NUMBER_INT ) : 25; // Sanitized
        $search = $this->get_search_query(); // Sanitized
        $order = isset( $_REQUEST['order'] ) && strtolower( $_REQUEST['order'] ) == 'asc' ? 'ASC' : 'DESC'; // Sanitized
        $limit = $wpdb->esc_like( ( ( $page - 1 ) * $per_page ) . ',' . $per_page ); // Sanitized
        $status = ( isset( $_REQUEST['status'] ) ) ? " AND status like '" . $wpdb->esc_like( $_REQUEST['status'] ) . "' " : ''; // Sanitized
        $sortable_columns = $this->get_sortable_columns();
        $orderby = ( isset( $_REQUEST['orderby'] ) && isset( $sortable_columns[ $_REQUEST['orderby'] ] ) ) ? $sortable_columns[ $_REQUEST['orderby'] ][0] : 'date'; // NOT Sanitized
        
        $blocked = ( $this->type == 'blocked' ) ? true : false;
        $threats = ( $this->type == 'threats' ) ? true : false;

        if ( $blocked || $threats ) {

            $type = ( $blocked ) ? "status like 'blocked'" : "";
            $type = ( $threats ) ? "threats = '1'" : $type;

        } else { 

            $type = "type like '" . $this->type . "'";
        
        }

        $type .= ( $this->type == 'activity' ) ? " OR ( type like 'logins' AND status like 'success' )" : "" ;

        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM $table WHERE $type $status $search ORDER BY $orderby $order LIMIT $limit";
        //echo $query;

        $this->items = $wpdb->get_results( $query );
        $total_items = $wpdb->get_var( "SELECT FOUND_ROWS()" );

        $limit_total = ( $blocked || $threats ) ? -1 : Yoda::get_display_limits( $this->type );
        $total_items = ( $total_items > $limit_total && $limit_total != -1 ) ? $limit_total : $total_items;

        

        $this->set_pagination_args( [
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil( $total_items/$per_page )
        ] );

    } // prepare_items()


    public function hide_charts() {

        if ( 
            isset( $_REQUEST['s'] ) ||
            isset( $_REQUEST['order'] ) ||
            isset( $_REQUEST['orderby'] ) ||
            isset( $_REQUEST['per_page'] )

        ) {

            return true;

        }

        return false;
    
    } // hide_charts()


    protected function get_status() {

        return false;

    } // get_status()


    /**
    * Display the filters and per_page options. This should be wrapped by the bulk_actions() method in a child class.
    *
    * @since 2.0.0
    *
    * @param string $which The location of the bulk actions: 'top' or 'bottom'.
    *                      This is designated as optional for backward compatibility.
   */
   function bulk_actions_load( $which = '' ) {
    
        if ( $which != 'top' ) { return; }

        $html = '';
        $page = ( isset( $_REQUEST['page'] ) ) ? filter_var( $_REQUEST['page'], FILTER_SANITIZE_STRING ) : SECSAFE_SLUG;
        $tab = ( isset( $_REQUEST['tab'] ) ) ? filter_var( $_REQUEST['tab'], FILTER_SANITIZE_STRING ) : false;

        $status = $this->get_status();

        if ( $status ) {

            $html .= '<select name="status">
                        <option value="">-- ' . __( 'Select Status', SECSAFE_SLUG ) . ' --</option>';

            foreach ( $status as $value => $label ) {

                $selected = ( isset( $_REQUEST['status'] ) && selected( $value, $_REQUEST['status'], false ) ) ? ' SELECTED' : '';

                $html .= '<option value="' . esc_html( $value ) . '"' . $selected . '>' . esc_html( $label ) . '</option>';

            } 

            $html .= '</select>';

        }

        $html .= '<select name="per_page">';

        $per_page = array( '25', '50', '100', '250' );

        foreach ( $per_page as $value ) {

            $selected = ( isset( $_REQUEST['per_page'] ) ) ? selected( $value, $_REQUEST['per_page'], false ) : '';

            $html .= '<option value="' . $value . '" ' . $selected . '>' . $value . ' ' . __( 'Per Page', SECSAFE_SLUG ) . '</option>';

        } 

        $search = ( isset( $_REQUEST['s'] ) ) ? filter_var( $_REQUEST['s'], FILTER_SANITIZE_STRING ) : '';

        $html .=
                '</select>

                <input type="hidden" name="s" value="' . esc_html( $search ) . '"> 
                <input type="submit" class="button" value="' . __( 'Apply Filters', SECSAFE_SLUG ) . '">';

        // Display Reset Filters

        if ( 
            isset( $_REQUEST['per_page'] ) || 
            isset( $_REQUEST['status'] )
        ) {

            $page = '?page=' . $page;
            $tab = ( $tab ) ? '&tab=' . $tab : '';

            $html .= '<a href="' . admin_url( 'admin.php' . $page . $tab ) . '" class="reset-filters" style="padding:5px 13px;display:inline-block;">' . __( 'reset filters', SECSAFE_SLUG ) . '</a>';
        
        } 

        echo $html;

    } // bulk_actions_load()


} // Table()
