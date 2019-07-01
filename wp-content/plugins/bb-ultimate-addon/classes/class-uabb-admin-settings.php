<?php
/**
 * Handles logic for the admin settings page.
 *
 * @since 1.3.0
 * @package UABB Admin Settings.
 */

/**
 * This class initializes UABB Builder Admin Settings
 *
 * @class UABBBuilderAdminSettings
 */
final class UABBBuilderAdminSettings {

	/**
	 * Holds any errors that may arise from
	 * saving admin settings.
	 *
	 * @since 1.3.0
	 * @var array $errors
	 */
	static public $errors = array();

	/**
	 * Initializes the admin settings.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function init() {
		add_action( 'after_setup_theme', __CLASS__ . '::init_hooks' );
	}

	/**
	 * Adds the admin menu and enqueues CSS/JS if we are on
	 * the builder admin settings page.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function init_hooks() {
		if ( ! is_admin() ) {
			return;
		}

		add_action( 'network_admin_menu', __CLASS__ . '::menu' );
		add_action( 'admin_menu', __CLASS__ . '::menu' );

		if ( isset( $_REQUEST['page'] ) && 'uabb-builder-settings' == $_REQUEST['page'] ) {
			add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles_scripts' );
			self::save();
		}
	}
	/**
	 * Show Branding tab.
	 *
	 * @since 1.16.1
	 * @return bool true | false
	 */
	public static function show_branding() {
		$show_branding = true;

		if ( true == get_option( 'uabb_hide_branding' ) ) {
			$show_branding = false;
		}

		if ( defined( 'WP_UABB_WHITE_LABEL' ) && WP_UABB_WHITE_LABEL ) {
			$show_branding = false;
		}
		return apply_filters( 'uabb_show_branding', $show_branding );
	}
	/**
	 * Renders the admin settings menu.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function menu() {
		if ( current_user_can( 'manage_options' ) ) {

			$title = UABB_PREFIX;
			$cap   = 'manage_options';
			$slug  = 'uabb-builder-settings';
			$func  = __CLASS__ . '::render';
			add_submenu_page( 'options-general.php', $title, $title, $cap, $slug, $func );
		}
	}

	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since 1.3.0
	 * @param hook $hook get the hooks for the styles.
	 * @return void
	 */
	static public function styles_scripts( $hook ) {
		wp_register_style( 'uabb-admin-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-admin.css', array() );
		wp_register_script( 'uabb-admin-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-admin.js', array( 'jquery' ), '', true );
		wp_localize_script( 'uabb-admin-js', 'uabb', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		// Load AJAX script only on Builder UI Panel.
		wp_register_script( 'uabb-lazyload', BB_ULTIMATE_ADDON_URL . 'assets/js/jquery.lazyload.min.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-tabs' ), null, true );
		wp_register_script( 'uabb-cloud-templates-shuffle', BB_ULTIMATE_ADDON_URL . 'assets/js/jquery.shuffle.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'uabb-cloud-templates', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-cloud-templates.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-tabs', 'uabb-lazyload', 'uabb-cloud-templates-shuffle' ), null, true );
		wp_enqueue_script( 'uabb-admin-menu-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-admin-menu.js' );
		wp_register_style( 'uabb-admin-menu-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-admin-menu.css' );

		$uabbcloudtemplates = array(
			'ajaxurl'                => admin_url( 'admin-ajax.php' ),
			'errorMessage'           => __( 'Something went wrong!', 'uabb' ),
			'successMessage'         => __( 'Complete', 'uabb' ),
			'successMessageFetch'    => __( 'Refreshed!', 'uabb' ),
			'errorMessageTryAgain'   => __( 'Try Again!', 'uabb' ),
			'successMessageDownload' => __( 'Installed!', 'uabb' ),
			'btnTextRemove'          => __( 'Remove', 'uabb' ),
			'btnTextDownload'        => __( 'Install', 'uabb' ),
			'btnTextInstall'         => __( 'Installed', 'uabb' ),
			'successMessageRemove'   => __( 'Removed!', 'uabb' ),
		);
		wp_localize_script( 'uabb-cloud-templates', 'UABBCloudTemplates', $uabbcloudtemplates );

		if ( 'settings_page_uabb-builder-settings' == $hook || 'settings_page_uabb-builder-multisite-settings' == $hook ) {

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'uabb-admin-css' );
			wp_enqueue_script( 'uabb-admin-js' );
			wp_enqueue_script( 'uabb-cloud-templates' );
			wp_enqueue_script( 'uabb-lazyload' );

			wp_enqueue_script( 'uabb-cloud-templates' );
			wp_enqueue_script( 'uabb-lazyload' );
			wp_enqueue_style( 'uabb-admin-menu-css' );

			wp_enqueue_media();

			// Added ThickBox support.
			add_thickbox();

			/** BB Admin CSS */
			wp_enqueue_style( 'fl-builder-admin-settings' );
		}
	}

	/**
	 * Renders the admin settings.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function render() {
		include BB_ULTIMATE_ADDON_DIR . 'includes/admin-settings.php';
	}

	/**
	 * Renders the page class for network installs and single site installs.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function render_page_class() {
		if ( self::multisite_support() ) {
			echo 'fl-settings-network-admin';
		} else {
			echo 'fl-settings-single-install';
		}
	}

	/**
	 * Renders the admin settings page heading.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function render_page_heading() {
		if ( ! empty( $icon ) ) {
			echo '<img src="' . $icon . '" />';
		}

		echo '<span>' . sprintf( /* translators: %s: search term */ _x( '%s Settings', '%s stands for custom branded "UABB" name.', 'uabb' ), UABB_PREFIX ) . '</span>';
	}

	/**
	 * Renders the update message.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function render_update_message() {
		if ( ! empty( self::$errors ) ) {
			foreach ( self::$errors as $message ) {
				echo '<div class="error"><p>' . $message . '</p></div>';
			}
		} elseif ( ! empty( $_POST ) && ! isset( $_POST['email'] ) ) {
			echo '<div class="updated"><p>' . __( 'Settings updated!', 'uabb' ) . '</p></div>';
		}
	}

	/**
	 * Renders the nav items for the admin settings menu.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function render_nav_items() {
		$items['uabb-license'] = array(
			'title'    => __( 'License', 'uabb' ),
			'show'     => is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
			'priority' => 505,
		);

		$items['uabb'] = array(
			'title'    => __( 'General Settings', 'uabb' ),
			'show'     => ! is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
			'priority' => 506,
		);

		$items['uabb-modules'] = array(
			'title'    => __( 'Modules', 'uabb' ),
			'show'     => is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
			'priority' => 507,
		);

		if ( BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-enable-template-cloud' ) ) {

			$items['uabb-cloud-templates'] = array(
				'title'    => __( 'Template Cloud', 'uabb' ),
				'show'     => is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
				'priority' => 508,
			);
		}

		$items['uabb-icons'] = array(
			'title'    => __( 'Font Icon Manager', 'uabb' ),
			'show'     => ! is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
			'priority' => 509,
		);
		if ( self::show_branding() ) {
			$items['uabb-branding'] = array(
				'title'    => __( 'Branding', 'uabb' ),
				'show'     => is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
				'priority' => 510,
			);
		}

		$item_data = apply_filters( 'uabb_builder_admin_settings_nav_items', $items );

		$sorted_data = array();

		foreach ( $item_data as $key => $data ) {
			$data['key']                      = $key;
			$sorted_data[ $data['priority'] ] = $data;
		}

		ksort( $sorted_data );

		foreach ( $sorted_data as $data ) {
			if ( $data['show'] ) {
				echo '<li><a href="#' . $data['key'] . '">' . $data['title'] . '</a></li>';
			}
		}

	}

	/**
	 * Renders the admin settings forms.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function render_forms() {
		// License.
		if ( is_network_admin() || ! self::multisite_support() ) {
			self::render_form( 'license' );
		}

		self::render_form( 'general' );
		self::render_form( 'modules' );
		self::render_form( 'icons' );
		self::render_form( 'branding' );

		self::render_form( 'template-cloud' );

		// Let extensions hook into form rendering.
		do_action( 'uabb_builder_admin_settings_render_forms' );
	}

	/**
	 * Renders an admin settings form based on the type specified.
	 *
	 * @since 1.3.0
	 * @param string $type The type of form to render.
	 * @return void
	 */
	static public function render_form( $type ) {
		if ( self::has_support( $type ) ) {
			include BB_ULTIMATE_ADDON_DIR . 'includes/admin-settings-' . $type . '.php';
		}
	}

	/**
	 * Renders the action for a form.
	 *
	 * @since 1.3.0
	 * @param string $type The type of form being rendered.
	 * @return void
	 */
	static public function render_form_action( $type = '' ) {
		if ( is_network_admin() ) {
			echo network_admin_url( '/settings.php?page=uabb-builder-multisite-settings#' . $type );
		} else {
			echo admin_url( '/options-general.php?page=uabb-builder-settings#' . $type );
		}
	}

	/**
	 * Returns the action for a form.
	 *
	 * @since 1.3.0
	 * @param string $type The type of form being rendered.
	 * @return string The URL for the form action.
	 */
	static public function get_form_action( $type = '' ) {
		if ( is_network_admin() ) {
			return network_admin_url( '/settings.php?page=uabb-builder-multisite-settings#' . $type );
		} else {
			return admin_url( '/options-general.php?page=uabb-builder-settings#' . $type );
		}
	}

	/**
	 * Checks to see if a settings form is supported.
	 *
	 * @since 1.3.0
	 * @param string $type The type of form to check.
	 * @return bool
	 */
	static public function has_support( $type ) {
		return file_exists( BB_ULTIMATE_ADDON_DIR . 'includes/admin-settings-' . $type . '.php' );
	}

	/**
	 * Checks to see if multisite is supported.
	 *
	 * @since 1.3.0
	 * @return bool
	 */
	static public function multisite_support() {
		return is_multisite() && class_exists( 'FLBuilderMultisiteSettings' );
	}

	/**
	 * Adds an error message to be rendered.
	 *
	 * @since 1.3.0
	 * @param string $message The error message to add.
	 * @return void
	 */
	static public function add_error( $message ) {
		self::$errors[] = $message;
	}

	/**
	 * Saves the admin settings.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	static public function save() {
		// Only admins can save settings.
		if ( ! current_user_can( 'delete_users' ) ) {
			return;
		}

		if ( isset( $_POST['fl-uabb-nonce'] ) && wp_verify_nonce( $_POST['fl-uabb-nonce'], 'uabb' ) ) {

			$uabb = UABB_Init::$uabb_options['fl_builder_uabb'];

			isset( $_POST['uabb-enabled-panels'] ) ? $uabb['load_panels']     = true : $uabb['load_panels'] = false;
			isset( $_POST['uabb-live-preview'] ) ? $uabb['uabb-live-preview'] = true : $uabb['uabb-live-preview'] = false;
			isset( $_POST['uabb-load-templates'] ) ? $uabb['load_templates']  = true : $uabb['load_templates'] = false;
			if ( isset( $_POST['uabb-google-map-api'] ) ) {
				$uabb['uabb-google-map-api'] = $_POST['uabb-google-map-api'];
			}
			isset( $_POST['uabb-enable-beta-updates'] ) ? $uabb['uabb-enable-beta-updates'] = true : $uabb['uabb-enable-beta-updates'] = false;

			FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb', $uabb, false );
		}

		if ( isset( $_POST['fl-uabb-branding-nonce'] ) && wp_verify_nonce( $_POST['fl-uabb-branding-nonce'], 'uabb-branding' ) ) {

			if ( isset( $_POST['uabb-plugin-name'] ) ) {
				$uabb['uabb-plugin-name'] = wp_kses_post( $_POST['uabb-plugin-name'] ); }
			if ( isset( $_POST['uabb-plugin-short-name'] ) ) {
				$uabb['uabb-plugin-short-name'] = wp_kses_post( $_POST['uabb-plugin-short-name'] );   }
			if ( isset( $_POST['uabb-plugin-desc'] ) ) {
				$uabb['uabb-plugin-desc'] = wp_kses_post( $_POST['uabb-plugin-desc'] ); }
			if ( isset( $_POST['uabb-author-name'] ) ) {
				$uabb['uabb-author-name'] = wp_kses_post( $_POST['uabb-author-name'] ); }
			if ( isset( $_POST['uabb-author-url'] ) ) {
				$uabb['uabb-author-url'] = sanitize_text_field( $_POST['uabb-author-url'] );   }
			if ( isset( $_POST['uabb-knowledge-base-url'] ) ) {
				$uabb['uabb-knowledge-base-url'] = sanitize_text_field( $_POST['uabb-knowledge-base-url'] );   }
			if ( isset( $_POST['uabb-contact-support-url'] ) ) {
				$uabb['uabb-contact-support-url'] = sanitize_text_field( $_POST['uabb-contact-support-url'] );  }
			if ( isset( $_POST['uabb-plugin-icon-url'] ) ) {
				$uabb['uabb-plugin-icon-url'] = sanitize_text_field( $_POST['uabb-plugin-icon-url'] );   }

			/* Enable / Disable Template Cloud */
			$uabb['uabb-enable-template-cloud'] = false;
			if ( isset( $_POST['uabb-enable-template-cloud'] ) ) {
				$uabb['uabb-enable-template-cloud'] = true;
			}

			/* Enable / Disable Template Cloud */
			$uabb['uabb-global-module-listing'] = false;
			if ( isset( $_POST['uabb-global-module-listing'] ) ) {
				$uabb['uabb-global-module-listing'] = true;
			}

			/* Enable / Disable KB */
			$uabb['uabb-enable-knowledge-base'] = true;
			if ( ! isset( $_POST['uabb-enable-knowledge-base'] ) ) {
				$uabb['uabb-enable-knowledge-base'] = false;
			}

			/* Enable / Disable Template Cloud */
			$uabb['uabb-enable-contact-support'] = true;
			if ( ! isset( $_POST['uabb-enable-contact-support'] ) ) {
				$uabb['uabb-enable-contact-support'] = false;
			}

			if ( isset( $_POST['uabb-hide-branding'] ) ) {
				update_option( 'uabb_hide_branding', true );
			} else {
				update_option( 'uabb_hide_branding', false );
			}

			FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb_branding', $uabb, false );
		}

		if ( isset( $_POST['fl-uabb-modules-nonce'] ) && wp_verify_nonce( $_POST['fl-uabb-modules-nonce'], 'uabb-modules' ) ) {
			$modules = array();

			$modules_array = BB_Ultimate_Addon_Helper::get_all_modules();

			if ( isset( $_POST['uabb-modules'] ) && is_array( $_POST['uabb-modules'] ) ) {

				$modules = array_map( 'sanitize_text_field', $_POST['uabb-modules'] );

				foreach ( $modules_array as $key => $value ) {
					if ( ! array_key_exists( $key, $modules ) ) {
						$modules[ $key ] = 'false';
					}
				}

				$modules['image-icon']         = 'image-icon';
				$modules['advanced-separator'] = 'advanced-separator';
				$modules['uabb-separator']     = 'uabb-separator';
				$modules['uabb-button']        = 'uabb-button';

			} else {
				$modules = array( 'unset_all' => 'unset_all' );
			}

			// update extension options.
			$extenstions_array = BB_Ultimate_Addon_Helper::get_all_extenstions();
			$uabb              = UABB_Init::$uabb_options['fl_builder_uabb'];

			foreach ( $extenstions_array as $slug => $name ) {
				$uabb[ $slug ]                            = true;
				isset( $_POST[ $slug ] ) ? $uabb[ $slug ] = true : $uabb[ $slug ] = false;
			}
			FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb', $uabb, false );
			FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb_modules', $modules, false );
		}

		/**
		 *  For Performance
		 *  Update UABB static object from database.
		 */
		UABB_Init::set_uabb_options();

		// Clear all asset cache.
		FLBuilderModel::delete_asset_cache_for_all_posts();
	}
}

UABBBuilderAdminSettings::init();
