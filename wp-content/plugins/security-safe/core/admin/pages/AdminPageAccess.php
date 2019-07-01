<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( ! defined( 'ABSPATH' ) ) { die; }

/**
 * Class AdminPageAccess
 * @package SecuritySafe
 * @since  0.2.0
 */
class AdminPageAccess extends AdminPage {


    /**
     * This sets the variables for the page.
     * @since  0.1.0
     */  
    protected function set_page() {

        $this->slug = 'security-safe-user-access';
        $this->title = 'User Access Control';
        $this->description = __( 'Control how your users access your admin area.', SECSAFE_SLUG );

        $this->tabs[] = [
            'id' => 'settings',
            'label' => 'Settings',
            'title' => __( 'User Access Settings', SECSAFE_SLUG ),
            'heading' => false,
            'intro' => false,
            'content_callback' => 'tab_settings',
        ];

        $this->tabs[] = [
            'id' => 'logins',
            'label' => __( 'Logins', SECSAFE_SLUG ),
            'title' => __( 'Login Log', SECSAFE_SLUG ),
            'heading' => false,
            'intro' => false,
            'classes' => [ 'full' ],
            'content_callback' => 'tab_logins',
        ];

        if ( SECSAFE_DEBUG ) {

            $this->tabs[] = [
                'id' => 'activity',
                'label' => __( 'Activity Log', SECSAFE_SLUG ),
                'title' => __( 'Admin Activity Log', SECSAFE_SLUG ),
                'heading' => false,
                'intro' => false,
                'classes' => [ 'full' ],
                'content_callback' => 'tab_activity',
            ];

        }

    } // set_page()


    /**
     * This populates all the metaboxes for this specific page.
     * @since  0.2.0
     */ 
    function tab_settings() {

        $html = '';

        // Shutoff Switch - All Access Policies
        $classes = ( $this->settings['on'] ) ? '' : 'notice-warning';
        $rows = $this->form_select( $this->settings, __( 'User Access Policies', SECSAFE_SLUG ), 'on', [ '0' => 'Disabled', '1' => 'Enabled' ], 'If you experience a problem, you may want to temporarily turn off all user access policies at once to troubleshoot the issue.', $classes );
        $html .= $this->form_table( $rows );
        $classes = '';

        // Login Security
        $html .= $this->form_section( __( 'Login Form', SECSAFE_SLUG ), __( "Your website's first line of defense is the login form.", SECSAFE_SLUG ) );
        $rows = $this->form_checkbox( $this->settings, __( 'Login Errors', SECSAFE_SLUG ), 'login_errors', __( 'Make login errors generic.', SECSAFE_SLUG ), __( 'When someone attempts to log in, by default, the error messages will tell the user that the password is incorrect or that the username is not valid. This exposes too much information to the potential intruder.', SECSAFE_SLUG ) );
        $rows .= $this->form_checkbox( $this->settings, __( 'Password Reset', SECSAFE_SLUG ), 'login_password_reset', 'Disable Password Reset', __( 'If you are the only user of the site, you may want to disable this feature as you have access to the database and hosting control panel.', SECSAFE_SLUG ) );
        $rows .= $this->form_checkbox( $this->settings, __( 'Remember Me', SECSAFE_SLUG ), 'login_remember_me', 'Disable Remember Me Checkbox', __( 'If the device that uses the remember me feature gets stolen, then the person in possession can now log in.', SECSAFE_SLUG ) );
        $html .= $this->form_table( $rows );

        // Remote Access
        $html .= $this->form_section( __( 'Remote Control', SECSAFE_SLUG ), __( 'How do you want your users to access your site?', SECSAFE_SLUG ) );
        $rows = $this->form_checkbox( $this->settings, __( 'XML-RPC', SECSAFE_SLUG ), 'xml_rpc', __( 'Disable Remote Control', SECSAFE_SLUG ), __( 'The xmlrpc.php file allows remote execution of scripts. This can be useful in some cases, but most of the time it is not needed.', SECSAFE_SLUG ) );
        $html .= $this->form_table( $rows );

        // Brute Force
        $html .= $this->form_section( __( 'Brute Force Logins', SECSAFE_SLUG ), __( 'Brute Force login attempts are repetitive attempts to gain access to your site using the login form.', SECSAFE_SLUG ) );
        $rows = $this->form_checkbox( $this->settings, __( 'Local Logins', SECSAFE_SLUG ), 'login_local', __( 'Only Allow Local Logins', SECSAFE_SLUG ), __( 'Software can remotely log in without actually visiting your website or using the login form. Unless you know that you need to be able to remotely login, it is recommended to only allow local logins. This is compatible with ManageWP.', SECSAFE_SLUG ) );
        $html .= $this->form_table( $rows );

        // Save Button
        $html .= $this->button( __( 'Save Settings', SECSAFE_SLUG ) );

        return $html;

    } // tab_settings()


    /**
     * This tab displays the login log.
     * @since  2.0.0
     */ 
    function tab_logins() {

        require_once( SECSAFE_DIR_ADMIN_TABLES . '/TableLogins.php' );

        ob_start();

        $table = new TableLogins();
        $table->display_charts();
        $table->prepare_items();
        $table->search_box( __( 'Search logins', SECSAFE_SLUG ), 'log' );
        $table->display();

        return ob_get_clean();
       
    } // tab_logins()


    /**
     * This tab displays the admin activity log.
     * @since  2.0.0
     */ 
    function tab_activity() {

        if ( ! SECSAFE_DEBUG ) { return; }

        require_once( SECSAFE_DIR_ADMIN_TABLES . '/TableActivity.php' );

        ob_start();

        $table = new TableActivity();
        $table->prepare_items();
        $table->search_box( __( 'Search activity', SECSAFE_SLUG ), 'log' );
        $table->display();

        return ob_get_clean();
       
    } // tab_activity()


} // AdminPageAccess()
