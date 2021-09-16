<?php
/**
 * Advanced Headers - Loader.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Astra_Ext_Advanced_Headers_Loader' ) ) {

	/**
	 * Astra Advanced Headers Initialization
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Advanced_Headers_Loader {


		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var $_action
		 */
		public static $_action = 'advanced-headers'; // phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			add_action( 'init', array( $this, 'advanced_headers_post_type' ) );
			add_action( 'admin_menu', array( $this, 'register_admin_menu' ), 100 );
			add_filter( 'postbox_classes_astra_adv_header_astra_advanced_headers_settings', array( $this, 'add_class_to_metabox' ) );

			add_filter( 'post_updated_messages', array( $this, 'custom_post_type_post_update_messages' ) );

			if ( is_admin() ) {
				add_action( 'manage_astra_adv_header_posts_custom_column', array( $this, 'column_content' ), 10, 2 );
				// Filters.
				add_filter( 'manage_astra_adv_header_posts_columns', array( $this, 'column_headings' ) );
			}

			// Actions.
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			self::load_files();
		}


		/**
		 * Add Custom Class to setting meta box
		 *
		 * @param array $classes Array of meta box classes.
		 * @return array $classes updated body classes.
		 */
		public function add_class_to_metabox( $classes ) {
			$classes[] = 'astra-advanced-headers-meta-box-wrap';
				return $classes;
		}

		/**
		 * Loads classes and includes.
		 *
		 * @since 1.0.0
		 * @access private
		 * @return void
		 */
		private static function load_files() {
			// Classes.
			include_once ASTRA_EXT_ADVANCED_HEADERS_DIR . 'classes/class-astra-ext-advanced-headers-data.php';
			// Load Astra Breadcrumbs.
			include_once ASTRA_EXT_ADVANCED_HEADERS_DIR . 'classes/astra-breadcrumbs.php';
		}


		/**
		 * Return Advanced Headers layout options.
		 *
		 * @param  string $option     Option key.
		 * @param  string $default    Option default value.
		 * @param  string $deprecated Option default value.
		 * @return string                  Return option value.
		 */
		public static function astra_advanced_headers_layout_option( $option, $default = '', $deprecated = '' ) {

			if ( '' != $deprecated ) {
				$default = $deprecated;
			}

			$advanced_headers_options = self::get_advanced_headers_layout();
			if ( ! $advanced_headers_options ) {
				return false;
			}
			$value = ( isset( $advanced_headers_options[ $option ] ) && '' !== $advanced_headers_options[ $option ] ) ? $advanced_headers_options[ $option ] : $default;

			return $value;
		}

		/**
		 * Return Advanced Headers design options.
		 *
		 * @param  string $option     Option key.
		 * @param  string $default    Option default value.
		 * @param  string $deprecated Option default value.
		 * @return string                  Return option value.
		 */
		public static function astra_advanced_headers_design_option( $option, $default = '', $deprecated = '' ) {

			if ( '' != $deprecated ) {
				$default = $deprecated;
			}

			$advanced_headers_options = self::get_advanced_headers_design();

			$value = ( isset( $advanced_headers_options[ $option ] ) && '' !== $advanced_headers_options[ $option ] ) ? $advanced_headers_options[ $option ] : $default;

			return $value;
		}

		/**
		 * Render Advanced Headers Setting page
		 */
		public static function get_advanced_headers_layout() {

			$ids = Astra_Ext_Advanced_Headers_Data::get_current_page_header_ids();

			if ( false == $ids ) {
				return false;
			}

			$settings = get_post_meta( $ids, 'ast-advanced-headers-layout', true );

			return $settings;
		}

		/**
		 * Render Advanced Headers Setting page
		 */
		public static function get_advanced_headers_design() {

			$ids = Astra_Ext_Advanced_Headers_Data::get_current_page_header_ids();

			if ( false == $ids ) {
				return false;
			}

			$settings = get_post_meta( $ids, 'ast-advanced-headers-design', true );

			return $settings;
		}

		/**
		 * Create Astra Advanced Headers custom post type
		 */
		public function advanced_headers_post_type() {

			$labels = array(
				'name'          => esc_html_x( 'Page Headers', 'advanced-header general name', 'astra-addon' ),
				'singular_name' => esc_html_x( 'Page Header', 'advanced-header singular name', 'astra-addon' ),
				'search_items'  => esc_html__( 'Search Page Header', 'astra-addon' ),
				'all_items'     => esc_html__( 'All Page Headers', 'astra-addon' ),
				'edit_item'     => esc_html__( 'Edit Page Header', 'astra-addon' ),
				'add_new'       => esc_html__( 'Add New', 'astra-addon' ),
				'update_item'   => esc_html__( 'Update Page Header', 'astra-addon' ),
				'add_new_item'  => esc_html__( 'Add New', 'astra-addon' ),
				'new_item_name' => esc_html__( 'New Page Header Name', 'astra-addon' ),
			);

			$args = array(
				'labels'              => $labels,
				'show_in_menu'        => false,
				'public'              => false,
				'show_ui'             => true,
				'query_var'           => true,
				'can_export'          => true,
				'show_in_menu'        => false,
				'show_in_admin_bar'   => true,
				'exclude_from_search' => true,
				'supports'            => apply_filters( 'astra_advanced_headers_supports', array( 'title' ) ),
			);

			register_post_type( 'astra_adv_header', apply_filters( 'astra_advanced_headers_post_type_args', $args ) );
		}

		/**
		 * Register the admin menu for Page Headers
		 *
		 * @since  1.2.1
		 *         Moved the menu under Appearance -> Page Headers
		 */
		public function register_admin_menu() {

			$page_header_capability = apply_filters( 'astra_page_header_capability', 'edit_theme_options' );

			add_submenu_page(
				'themes.php',
				__( 'Page Headers', 'astra-addon' ),
				__( 'Page Headers', 'astra-addon' ),
				$page_header_capability,
				'edit.php?post_type=astra_adv_header'
			);
		}

		/**
		 * Enqueues scripts and styles for the theme layout
		 * post type on the WordPress admin edit post screen.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function admin_enqueue_scripts() {

			global $pagenow;
			global $post;

			$screen = get_current_screen();

			if ( ( 'post-new.php' == $pagenow || 'post.php' == $pagenow ) && 'astra_adv_header' == $screen->post_type ) {
				$rtl = '';
				if ( is_rtl() ) {
					$rtl = '-rtl';
				}
				// Styles.
				wp_enqueue_media();

				/**
				 * Localize wp-color-picker & wpColorPickerL10n.
				 *
				 * This is only needed in WordPress version >= 5.5 because wpColorPickerL10n has been removed.
				 *
				 * @see https://github.com/WordPress/WordPress/commit/7e7b70cd1ae5772229abb769d0823411112c748b
				 *
				 * This is should be removed once the issue is fixed from wp-color-picker-alpha repo.
				 * @see https://github.com/kallookoo/wp-color-picker-alpha/issues/35
				 *
				 * @since 2.6.3
				 */
				global $wp_version;

				if ( version_compare( $wp_version, '5.4.99', '>=' ) ) {
					wp_localize_script(
						'wp-color-picker',
						'wpColorPickerL10n',
						array(
							'clear'            => __( 'Clear', 'astra-addon' ),
							'clearAriaLabel'   => __( 'Clear color', 'astra-addon' ),
							'defaultString'    => __( 'Default', 'astra-addon' ),
							'defaultAriaLabel' => __( 'Select default color', 'astra-addon' ),
							'pick'             => __( 'Select Color', 'astra-addon' ),
							'defaultLabel'     => __( 'Color value', 'astra-addon' ),
						)
					);
				}

				// Scripts.
				if ( SCRIPT_DEBUG ) {

					wp_enqueue_style( 'astra-advanced-headers-admin-edit', ASTRA_EXT_ADVANCED_HEADERS_URL . 'assets/css/unminified/astra-advanced-headers-admin-edit' . $rtl . '.css', array( 'wp-color-picker' ), ASTRA_EXT_VER );

					wp_enqueue_script( 'astra-advanced-headers-admin', ASTRA_EXT_ADVANCED_HEADERS_URL . 'assets/js/unminified/astra-advanced-headers-admin.js', array( 'jquery', 'wp-color-picker', 'astra-color-alpha', 'jquery-ui-tooltip' ), ASTRA_EXT_VER, false );

				} else {
					wp_enqueue_style( 'astra-advanced-headers-admin-edit', ASTRA_EXT_ADVANCED_HEADERS_URL . 'assets/css/minified/astra-advanced-headers-admin-edit' . $rtl . '.min.css', array( 'wp-color-picker' ), ASTRA_EXT_VER );

					wp_enqueue_script( 'astra-advanced-headers-admin', ASTRA_EXT_ADVANCED_HEADERS_URL . 'assets/js/minified/astra-advanced-headers-admin.min.js', array( 'jquery', 'wp-color-picker', 'astra-color-alpha', 'jquery-ui-tooltip' ), ASTRA_EXT_VER, false );
				}
			}
		}

		/**
		 * Add Update messages for any custom post type
		 *
		 * @param array $messages Array of default messages.
		 */
		public function custom_post_type_post_update_messages( $messages ) {

			$custom_post_type = get_post_type( get_the_ID() );

			if ( 'astra_adv_header' == $custom_post_type ) {

				$obj                           = get_post_type_object( $custom_post_type );
				$singular_name                 = $obj->labels->singular_name;
				$messages[ $custom_post_type ] = array(
					0  => '', // Unused. Messages start at index 1.
					/* translators: %s: singular custom post type name */
					1  => sprintf( __( '%s updated.', 'astra-addon' ), $singular_name ),
					/* translators: %s: singular custom post type name */
					2  => sprintf( __( 'Custom %s updated.', 'astra-addon' ), $singular_name ),
					/* translators: %s: singular custom post type name */
					3  => sprintf( __( 'Custom %s deleted.', 'astra-addon' ), $singular_name ),
					/* translators: %s: singular custom post type name */
					4  => sprintf( __( '%s updated.', 'astra-addon' ), $singular_name ),
					/* translators: %1$s: singular custom post type name ,%2$s: date and time of the revision */
					5  => isset( $_GET['revision'] ) ? sprintf( __( '%1$s restored to revision from %2$s', 'astra-addon' ), $singular_name, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
					/* translators: %s: singular custom post type name */
					6  => sprintf( __( '%s published.', 'astra-addon' ), $singular_name ),
					/* translators: %s: singular custom post type name */
					7  => sprintf( __( '%s saved.', 'astra-addon' ), $singular_name ),
					/* translators: %s: singular custom post type name */
					8  => sprintf( __( '%s submitted.', 'astra-addon' ), $singular_name ),
					/* translators: %s: singular custom post type name */
					9  => sprintf( __( '%s scheduled for.', 'astra-addon' ), $singular_name ),
					/* translators: %s: singular custom post type name */
					10 => sprintf( __( '%s draft updated.', 'astra-addon' ), $singular_name ),
				);
			}

			return $messages;
		}

		/**
		 * Adds or removes list table column headings.
		 *
		 * @param array $columns Array of columns.
		 * @return array
		 */
		public static function column_headings( $columns ) {

			unset( $columns['date'] );

			$columns['advanced_headers_display_rules'] = __( 'Display Rules', 'astra-addon' );
			$columns['date']                           = __( 'Date', 'astra-addon' );

			return $columns;
		}

		/**
		 * Adds the custom list table column content.
		 *
		 * @since 1.0
		 * @param array $column Name of column.
		 * @param int   $post_id Post id.
		 * @return void
		 */
		public function column_content( $column, $post_id ) {

			if ( 'advanced_headers_display_rules' == $column ) {

				$locations = get_post_meta( $post_id, 'ast-advanced-headers-location', true );
				if ( ! empty( $locations ) ) {
					echo '<div class="ast-advanced-headers-location-wrap" style="margin-bottom: 5px;">';
					echo '<strong>Display: </strong>';
					$this->column_display_location_rules( $locations );
					echo '</div>';
				}

				$locations = get_post_meta( $post_id, 'ast-advanced-headers-exclusion', true );
				if ( ! empty( $locations ) ) {
					echo '<div class="ast-advanced-headers-exclusion-wrap" style="margin-bottom: 5px;">';
					echo '<strong>Exclusion: </strong>';
					$this->column_display_location_rules( $locations );
					echo '</div>';
				}

				$users = get_post_meta( $post_id, 'ast-advanced-headers-users', true );
				if ( isset( $users ) && is_array( $users ) ) {
					if ( isset( $users[0] ) && ! empty( $users[0] ) ) {
						$user_label = array();
						foreach ( $users as $user ) {
							$user_label[] = Astra_Target_Rules_Fields::get_user_by_key( $user );
						}
						echo '<div class="ast-advanced-headers-users-wrap">';
						echo '<strong>Users: </strong>';
						echo esc_html( join( ', ', $user_label ) );
						echo '</div>';
					}
				}
			}
		}

		/**
		 * Get Markup of Location rules for Display rule column.
		 *
		 * @param array $locations Array of locations.
		 * @return void
		 */
		public function column_display_location_rules( $locations ) {

			$location_label = array();
			$index          = array_search( 'specifics', $locations['rule'] );
			if ( false !== $index && ! empty( $index ) ) {
				unset( $locations['rule'][ $index ] );
			}

			if ( isset( $locations['rule'] ) && is_array( $locations['rule'] ) ) {
				foreach ( $locations['rule'] as $location ) {
					$location_label[] = Astra_Target_Rules_Fields::get_location_by_key( $location );
				}
			}
			if ( isset( $locations['specific'] ) && is_array( $locations['specific'] ) ) {
				foreach ( $locations['specific'] as $location ) {
					$location_label[] = Astra_Target_Rules_Fields::get_location_by_key( $location );
				}
			}

			echo esc_html( join( ', ', $location_label ) );
		}

	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Advanced_Headers_Loader::get_instance();
