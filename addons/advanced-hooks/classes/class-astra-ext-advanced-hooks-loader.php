<?php
/**
 * Advanced Hooks - Loader.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Astra_Ext_Advanced_Hooks_Loader' ) ) {

	/**
	 * Astra Advanced Hooks Initialization
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Advanced_Hooks_Loader {


		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var $_actions
		 */
		public static $_action = 'advanced-hooks'; // phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

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

			add_action( 'init', array( $this, 'advanced_hooks_post_type' ) );
			add_action( 'admin_menu', array( $this, 'register_admin_menu' ), 100 );
			add_action( 'astra_addon_activated', array( $this, 'astra_addon_activated_callback' ) );
			add_filter( 'postbox_classes_ ' . ASTRA_ADVANCED_HOOKS_POST_TYPE . ' -advanced-hook-settings', array( $this, 'add_class_to_metabox' ) );

			// Remove Meta box of astra settings.
			add_action( 'do_meta_boxes', array( $this, 'remove_astra_meta_box' ) );
			add_filter( 'post_updated_messages', array( $this, 'custom_post_type_post_update_messages' ) );

			if ( is_admin() ) {
				add_action( 'manage_' . ASTRA_ADVANCED_HOOKS_POST_TYPE . '_posts_custom_column', array( $this, 'column_content' ), 10, 2 );
				// Filters.
				add_filter( 'manage_' . ASTRA_ADVANCED_HOOKS_POST_TYPE . '_posts_columns', array( $this, 'column_headings' ) );
			}

			// Actions.
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			add_filter( 'fl_builder_post_types', array( $this, 'bb_builder_compatibility' ), 10, 1 );

			// Divi support.
			add_filter( 'et_builder_post_types', array( $this, 'divi_builder_compatibility' ) );

			add_filter(
				'block_parser_class',
				function () {
					return 'Astra_WP_Block_Parser';
				}
			);
		}


		/**
		 * Adds or removes list table column headings.
		 *
		 * @param array $columns Array of columns.
		 * @return array
		 */
		public static function column_headings( $columns ) {

			unset( $columns['date'] );

			$columns['advanced_hook_action']        = __( 'Action', 'astra-addon' );
			$columns['advanced_hook_display_rules'] = __( 'Display Rules', 'astra-addon' );
			$columns['date']                        = __( 'Date', 'astra-addon' );

			return apply_filters( 'astra_advanced_hooks_list_action_column_headings', $columns );
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

			$icon_style = 'font-size:17px;';

			if ( 'advanced_hook_action' == $column ) {
				$layout = get_post_meta( $post_id, 'ast-advanced-hook-layout', true );

				if ( 'hooks' === $layout ) {
					$action = get_post_meta( $post_id, 'ast-advanced-hook-action', true );
				} else {
					$action = $layout;
				}

				echo apply_filters( 'astra_advanced_hooks_list_action_column', $action ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} elseif ( 'advanced_hook_display_rules' == $column ) {

				$locations = get_post_meta( $post_id, 'ast-advanced-hook-location', true );
				if ( ! empty( $locations ) ) {
					echo '<div class="ast-advanced-hook-location-wrap ast-advanced-hook-wrap">';
					echo '<strong>' . esc_attr( __( 'Display', 'astra-addon' ) ) . ': </strong>';
					$this->column_display_location_rules( $locations );
					echo '</div>';
				}

				$locations = get_post_meta( $post_id, 'ast-advanced-hook-exclusion', true );
				if ( ! empty( $locations ) ) {
					echo '<div class="ast-advanced-hook-exclusion-wrap ast-advanced-hook-wrap">';
					echo '<strong>' . esc_attr( __( 'Exclusion', 'astra-addon' ) ) . ': </strong>';
					$this->column_display_location_rules( $locations );
					echo '</div>';
				}

				$users = get_post_meta( $post_id, 'ast-advanced-hook-users', true );
				if ( isset( $users ) && is_array( $users ) ) {
					$user_label = array();
					foreach ( $users as $user ) {
						$user_label[] = Astra_Target_Rules_Fields::get_user_by_key( $user );
					}
					echo '<div class="ast-advanced-hook-users-wrap ast-advanced-hook-wrap">';
					echo '<strong>' . esc_attr( __( 'Users', 'astra-addon' ) ) . ': </strong>';
					echo esc_html( join( ', ', $user_label ) );
					echo '</div>';
				}

				$display_devices = get_post_meta( $post_id, 'ast-advanced-display-device', true );
				if ( is_array( $display_devices ) ) {
					echo '<div class="ast-advanced-hook-display-devices-wrap ast-advanced-hook-wrap">';
					echo '<strong>' . esc_attr( __( 'Devices', 'astra-addon' ) ) . ': </strong>';
					foreach ( $display_devices as $display_device ) {
						switch ( $display_device ) {
							case 'desktop':
								echo '<span style=' . esc_attr( $icon_style ) . ' class="dashicons dashicons-desktop"></span>';
								break;
							case 'tablet':
								echo '<span style=' . esc_attr( $icon_style ) . ' class="dashicons dashicons-tablet"></span>';
								break;
							case 'mobile':
								echo '<span style=' . esc_attr( $icon_style ) . ' class="dashicons dashicons-smartphone"></span>';
								break;
						}
					}
					echo '</div>';
				}

				$time_duration = get_post_meta( $post_id, 'ast-advanced-time-duration', true );
				if ( isset( $time_duration ) && is_array( $time_duration ) && isset( $time_duration['enabled'] ) ) {
					echo '<div class="ast-advanced-hook-time-duration-wrap ast-advanced-hook-wrap">';
					echo '<strong>' . esc_attr( __( 'Time Duration Eligible', 'astra-addon' ) ) . ': </strong>';

					if ( ! Astra_Ext_Advanced_Hooks_Markup::get_time_duration_eligibility( $post_id ) ) {
						echo '<span style=' . esc_attr( $icon_style ) . ' class="dashicons dashicons-no"></span>';
					} else {
						echo '<span style=' . esc_attr( $icon_style ) . ' class="dashicons dashicons-yes-alt"></span>';
					}

					echo '</div>';
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

		/**
		 * Custom post type rewrite rules.
		 */
		public function astra_addon_activated_callback() {
			$this->advanced_hooks_post_type();
			flush_rewrite_rules();
		}

		/**
		 * Add Custom Class to setting meta box
		 *
		 * @param array $classes Array of meta box classes.
		 * @return array $classes updated body classes.
		 */
		public function add_class_to_metabox( $classes ) {
			$classes[] = 'advanced-hook-meta-box-wrap';
				return $classes;
		}

		/**
		 * Remove astra setting meta box
		 */
		public function remove_astra_meta_box() {
			remove_meta_box( 'astra_settings_meta_box', ASTRA_ADVANCED_HOOKS_POST_TYPE, 'side' );
		}

		/**
		 * Create Astra Advanced Hooks custom post type
		 */
		public function advanced_hooks_post_type() {

			$labels = array(
				'name'          => esc_html_x( 'Custom Layouts', 'advanced-hooks general name', 'astra-addon' ),
				'singular_name' => esc_html_x( 'Custom Layout', 'advanced-hooks singular name', 'astra-addon' ),
				'search_items'  => esc_html__( 'Search Custom Layouts', 'astra-addon' ),
				'all_items'     => esc_html__( 'All Custom Layouts', 'astra-addon' ),
				'edit_item'     => esc_html__( 'Edit Custom Layout', 'astra-addon' ),
				'view_item'     => esc_html__( 'View Custom Layout', 'astra-addon' ),
				'add_new'       => esc_html__( 'Add New', 'astra-addon' ),
				'update_item'   => esc_html__( 'Update Custom Layout', 'astra-addon' ),
				'add_new_item'  => esc_html__( 'Add New', 'astra-addon' ),
				'new_item_name' => esc_html__( 'New Custom Layout Name', 'astra-addon' ),
			);

			$rest_support = true;

			// Rest support false if it is a old post with post meta code_editor set.
			if ( isset( $_GET['code_editor'] ) || ( isset( $_GET['post'] ) && 'code_editor' === get_post_meta( $_GET['post'], 'editor_type', true ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$rest_support = false;
			}

			// Rest support true if it is a WordPress editor.
			if ( isset( $_GET['wordpress_editor'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$rest_support = true;
			}

			$args = array(
				'labels'              => $labels,
				'show_in_menu'        => false,
				'public'              => true,
				'show_ui'             => true,
				'query_var'           => true,
				'can_export'          => true,
				'show_in_admin_bar'   => true,
				'exclude_from_search' => true,
				'show_in_rest'        => $rest_support,
				'supports'            => apply_filters( 'astra_advanced_hooks_supports', array( 'title', 'editor', 'elementor' ) ),
				'rewrite'             => array( 'slug' => apply_filters( 'astra_advanced_hooks_rewrite_slug', 'astra-advanced-hook' ) ),
			);

			register_post_type( ASTRA_ADVANCED_HOOKS_POST_TYPE, apply_filters( 'astra_advanced_hooks_post_type_args', $args ) );
		}

		/**
		 * Register the admin menu for Custom Layouts
		 *
		 * @since  1.2.1
		 *         Moved the menu under Appearance -> Custom Layouts
		 */
		public function register_admin_menu() {

			$custom_layouts_capability = apply_filters( 'astra_custom_layouts_capability', 'edit_theme_options' );

			add_submenu_page(
				'themes.php',
				__( 'Custom Layouts', 'astra-addon' ),
				__( 'Custom Layouts', 'astra-addon' ),
				$custom_layouts_capability,
				'edit.php?post_type=' . ASTRA_ADVANCED_HOOKS_POST_TYPE
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

			if ( ( 'post-new.php' == $pagenow || 'post.php' == $pagenow ) && ASTRA_ADVANCED_HOOKS_POST_TYPE == $screen->post_type ) {
				// Styles.
				wp_enqueue_media();

				wp_enqueue_script(
					'advanced-hook-datetimepicker-script',
					ASTRA_EXT_ADVANCED_HOOKS_URL . 'assets/js/minified/jquery-ui-timepicker-addon.min.js',
					array( 'jquery-ui-datepicker', 'jquery-ui-slider' ),
					ASTRA_EXT_VER,
					true
				);
				wp_enqueue_style(
					'advanced-hook-datetimepicker-style',
					ASTRA_EXT_ADVANCED_HOOKS_URL . 'assets/css/minified/jquery-ui-timepicker-addon.min.css',
					null,
					ASTRA_EXT_VER
				);

				// Scripts.
				if ( SCRIPT_DEBUG ) {
					wp_enqueue_style( 'advanced-hook-admin-edit', ASTRA_EXT_ADVANCED_HOOKS_URL . 'assets/css/unminified/astra-advanced-hooks-admin-edit.css', null, ASTRA_EXT_VER );
					wp_enqueue_script( 'advanced-hook-admin-edit', ASTRA_EXT_ADVANCED_HOOKS_URL . 'assets/js/unminified/advanced-hooks.js', array( 'jquery', 'jquery-ui-tooltip' ), ASTRA_EXT_VER, false );
				} else {
					wp_enqueue_style( 'advanced-hook-admin-edit', ASTRA_EXT_ADVANCED_HOOKS_URL . 'assets/css/minified/astra-advanced-hooks-admin-edit.min.css', null, ASTRA_EXT_VER );
					wp_enqueue_script( 'advanced-hook-admin-edit', ASTRA_EXT_ADVANCED_HOOKS_URL . 'assets/js/minified/advanced-hooks.min.js', array( 'jquery', 'jquery-ui-tooltip' ), ASTRA_EXT_VER, false );
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

			if ( ASTRA_ADVANCED_HOOKS_POST_TYPE == $custom_post_type ) {

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
		 * Add page builder support to Advanced hook.
		 *
		 * @param array $value Array of post types.
		 */
		public function bb_builder_compatibility( $value ) {

			$value[] = ASTRA_ADVANCED_HOOKS_POST_TYPE;

			return $value;
		}

		/**
		 * Add Divi page builder support to Advanced hook post type.
		 *
		 * @param array $post_types Array of post types.
		 * @return array $post_types Modified array of post types.
		 */
		public function divi_builder_compatibility( $post_types ) {
			$post_types[] = ASTRA_ADVANCED_HOOKS_POST_TYPE;

			return $post_types;
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Advanced_Hooks_Loader::get_instance();
