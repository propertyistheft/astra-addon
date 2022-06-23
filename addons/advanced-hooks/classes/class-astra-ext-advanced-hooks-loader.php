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
	// @codingStandardsIgnoreStart
	class Astra_Ext_Advanced_Hooks_Loader { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

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

			// Custom layout tabs based on type.
			add_filter( 'views_edit-' . ASTRA_ADVANCED_HOOKS_POST_TYPE, array( $this, 'admin_print_tabs' ) );

			// Show only active tab posts in custom layout.
			add_action( 'parse_query', array( $this, 'admin_query_filter_types' ) );

			// Actions.
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			add_filter( 'fl_builder_post_types', array( $this, 'bb_builder_compatibility' ), 10, 1 );

			// Divi support.
			add_filter( 'et_builder_post_types', array( $this, 'divi_builder_compatibility' ) );

			add_filter(
				'block_parser_class',
				function( $content ) {
					// Check if we're inside the main post content.
					if ( is_singular() && in_the_loop() && is_main_query() ) {
						return 'Astra_WP_Block_Parser';
					}
					return $content;
				},
				1
			);

			add_action( 'init', array( $this, 'register_meta_settings' ) );
			add_action( 'init', array( $this, 'register_react_script' ) );
			if ( ! is_customize_preview() ) {
				add_action( 'enqueue_block_editor_assets', array( $this, 'load_react_script' ) );
			}

			add_action( 'wp_ajax_ast_advanced_hook_display_toggle', array( $this, 'ast_advanced_hook_display_toggle' ) );
		}

		/**
		 * Print admin tabs.
		 *
		 * Used to output the custom layouts on basis of their types.
		 *
		 * Fired by `views_edit-astra-advanced-hook` filter.
		 *
		 * @since 3.6.4
		 * @access public
		 *
		 * @param array $views An array of available list table views.
		 *
		 * @return array An updated array of available list table views.
		 */
		public function admin_print_tabs( $views ) {

			$current_type = '';
			$active_class = ' nav-tab-active';
			$current_tab  = $this->get_active_tab();

			if ( ! empty( $_REQUEST['layout_type'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$current_type = $_REQUEST['layout_type']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$active_class = '';
			}

			$url_args = array(
				'post_type'   => ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'layout_type' => $current_tab,
			);

			$custom_layout_types = array(
				'header'   => __( 'Header', 'astra-addon' ),
				'footer'   => __( 'Footer', 'astra-addon' ),
				'hooks'    => __( 'Hooks', 'astra-addon' ),
				'404-page' => __( '404 Page', 'astra-addon' ),
				'content'  => __( 'Page Content', 'astra-addon' ),
			);

			$baseurl = add_query_arg( $url_args, admin_url( 'edit.php' ) );

			?>
				<div class="nav-tab-wrapper ast-custom-layout-tabs-wrapper">
					<a class="nav-tab<?php echo esc_attr( $active_class ); ?>" href="<?php echo esc_url( admin_url( 'edit.php?post_type=' . ASTRA_ADVANCED_HOOKS_POST_TYPE ) ); ?>">
						<?php
							echo esc_html__( 'All', 'astra-addon' );
						?>
					</a>
					<?php
					foreach ( $custom_layout_types as $type => $title ) {
						$type_url     = esc_url( add_query_arg( 'layout_type', $type, $baseurl ) );
						$active_class = ( $current_type === $type ) ? ' nav-tab-active' : '';

						?>
								<a class="nav-tab<?php echo esc_attr( $active_class ); ?>" href="<?php echo esc_url( $type_url ); ?>">
								<?php
									echo esc_attr( $title );
								?>
								</a>
							<?php
					}
					?>
				</div>
			<?php

			return $views;
		}

		/**
		 * Get default/active tab for custom layout admin tables.
		 *
		 * @since 3.6.4
		 * @param string $default default tab attr.
		 * @return string $current_tab
		 */
		public function get_active_tab( $default = '' ) {
			$current_tab = $default;

			if ( ! empty( $_REQUEST['layout_type'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$current_tab = $_REQUEST['layout_type']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			}

			return $current_tab;
		}

		/**
		 * Filter custom layouts in admin query.
		 *
		 * Update the custom layouts in the main admin query.
		 *
		 * Fired by `parse_query` action.
		 *
		 * @since 3.6.4
		 * @access public
		 *
		 * @param WP_Query $query The `WP_Query` instance.
		 */
		public function admin_query_filter_types( WP_Query $query ) {
			global $pagenow, $typenow;

			if ( ! ( 'edit.php' === $pagenow && ASTRA_ADVANCED_HOOKS_POST_TYPE === $typenow ) || ! empty( $query->query_vars['meta_key'] ) ) {
				return;
			}

			$current_tab = $this->get_active_tab();

			if ( isset( $query->query_vars['layout_type'] ) && '-1' === $query->query_vars['layout_type'] ) {
				unset( $query->query_vars['layout_type'] );
			}

			if ( empty( $current_tab ) ) {
				return;
			}

			$query->query_vars['meta_key']   = 'ast-advanced-hook-layout';
			$query->query_vars['meta_value'] = $current_tab;
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
			$columns['enable_disable']              = __( 'Enable/Disable', 'astra-addon' );
			$columns['advanced_hook_shortcode']     = __( 'Shortcode', 'astra-addon' );

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

					if ( empty( $locations['rule'] ) || ( ! empty( $locations['rule'] ) && ( 1 === count( $locations['rule'] ) && isset( $locations['rule'][0] ) && 'clflag' === $locations['rule'][0] ) ) ) {
						echo esc_attr( __( '[UNSET]', 'astra-addon' ) );
					} else {
						$this->column_display_location_rules( $locations );
					}
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
			} elseif ( 'advanced_hook_shortcode' === $column ) {
				echo '<div class = "ast-shrotcut"> <input type="text" onfocus="this.select();" readonly="readonly" value="[astra_custom_layout id=' . esc_attr( $post_id ) . ']" />
				<i class="ast-advanced-hook-heading-help dashicons dashicons-editor-help" style="vertical-align: text-bottom;" title="' . esc_attr__( 'Make sure to set display rule to post/page where you will be adding the Shortcode.', 'astra-addon' ) . '"></i></div>';
			} elseif ( 'enable_disable' == $column ) {
				$switch_class = 'ast-custom-layout-switch ast-option-switch';
				$enabled      = get_post_meta( $post_id, 'ast-advanced-hook-enabled', 'yes' );
				if ( 'no' !== $enabled ) {
					$switch_class .= ' ast-active';
				}

				echo '<div class="' . esc_attr( $switch_class ) . '" data-post_id = "' . esc_attr( $post_id ) . '"><span></div>';
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

			$location_label = array_diff( $location_label, array( 'clflag' ) );

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
				'supports'            => apply_filters( 'astra_advanced_hooks_supports', array( 'title', 'editor', 'elementor', 'custom-fields' ) ),
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
					ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/js/minified/jquery-ui-timepicker-addon.min.js',
					array( 'jquery-ui-datepicker', 'jquery-ui-slider' ),
					ASTRA_EXT_VER,
					true
				);
				wp_enqueue_style(
					'advanced-hook-datetimepicker-style',
					ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/css/minified/jquery-ui-timepicker-addon.min.css',
					null,
					ASTRA_EXT_VER
				);

				// Scripts.
				if ( SCRIPT_DEBUG ) {
					wp_enqueue_style( 'advanced-hook-admin-edit', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/css/unminified/astra-advanced-hooks-admin-edit.css', null, ASTRA_EXT_VER );
					wp_enqueue_script( 'advanced-hook-admin-edit', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/js/unminified/advanced-hooks.js', array( 'jquery', 'jquery-ui-tooltip' ), ASTRA_EXT_VER, false );
				} else {
					wp_enqueue_style( 'advanced-hook-admin-edit', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/css/minified/astra-advanced-hooks-admin-edit.min.css', null, ASTRA_EXT_VER );
					wp_enqueue_script( 'advanced-hook-admin-edit', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/js/minified/advanced-hooks.min.js', array( 'jquery', 'jquery-ui-tooltip' ), ASTRA_EXT_VER, false );
				}
			}

			if ( isset( $_GET['post_type'] ) && 'astra-advanced-hook' === $_GET['post_type'] ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended

				if ( SCRIPT_DEBUG ) {
					wp_enqueue_script( 'advanced-hook-admin-list', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/js/unminified/advanced-hooks-enable-disable.js', array(), ASTRA_EXT_VER, false );
					wp_enqueue_style( 'advanced-hook-admin-list', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/css/unminified/astra-advanced-hooks-admin-list.css', null, ASTRA_EXT_VER );
				} else {
					wp_enqueue_script( 'advanced-hook-admin-list', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/js/minified/advanced-hooks-enable-disable.min.js', array(), ASTRA_EXT_VER, false );
					wp_enqueue_style( 'advanced-hook-admin-list', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/css/minified/astra-advanced-hooks-admin-list.min.css', null, ASTRA_EXT_VER );
				}
				wp_localize_script(
					'advanced-hook-admin-list',
					'astHooksData',
					array(
						'url'   => admin_url( 'admin-ajax.php' ),
						'nonce' => wp_create_nonce( 'astra-addon-enable-tgl-nonce' ),
					)
				);
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

		/**
		 * Register Script for Custom Layout.
		 *
		 * @since 3.6.4
		 */
		public function register_react_script() {
			$path = ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'react/build/index.js';
			wp_register_script(
				'astra-custom-layout',
				$path,
				array( 'wp-plugins', 'wp-edit-post', 'wp-i18n', 'wp-element', 'updates' ),
				ASTRA_EXT_VER,
				true
			);
		}

		/**
		 * Enqueue custom Layout script.
		 *
		 * @since 3.6.4
		 */
		public function load_react_script() {
			global $post;
			$post_type = get_post_type();

			if ( ASTRA_ADVANCED_HOOKS_POST_TYPE !== $post_type ) {
				return;
			}

			$responsive_visibility_status = ( 'array' == gettype( get_post_meta( get_the_ID(), 'ast-advanced-display-device', true ) ) ) ? true : false;

			// UAG plugin slug.
			$plugin_slug = 'ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php';

			wp_enqueue_script( 'astra-custom-layout' );
			wp_localize_script(
				'astra-custom-layout',
				'astCustomLayout',
				array(
					'checkPolylangActive'        => class_exists( 'Polylang' ),
					'postType'                   => $post_type,
					'title'                      => __( 'Custom Layout', 'astra-addon' ),
					'layouts'                    => $this->get_layout_type(),
					'DeviceOptions'              => $this->get_device_type(),
					'ContentBlockType'           => $this->get_content_type(),
					'actionHooks'                => Astra_Ext_Advanced_Hooks_Meta::$hooks,
					'displayRules'               => Astra_Target_Rules_Fields::get_location_selections(),
					'specificRule'               => $this->get_specific_rule(),
					'specificExclusionRule'      => $this->get_specific_rule( 'exclusion' ),
					'ajax_nonce'                 => wp_create_nonce( 'astra-addon-get-posts-by-query' ),
					'installPluginNoticeNonce'   => wp_create_nonce( 'bsf_activate_extension_nonce' ),
					'isPluginInstalled'          => file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug ),
					'isPluginActivated'          => is_plugin_active( $plugin_slug ),
					'userRoles'                  => Astra_Target_Rules_Fields::get_user_selections(),
					'ResponsiveVisibilityStatus' => $responsive_visibility_status,
					'siteurl'                    => get_option( 'siteurl' ),
				)
			);

			// Register Meta for 404-page.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-404-page',
				array(
					'single'        => true,
					'type'          => 'object',
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'disable_header' => array(
									'type' => 'string',
								),
								'disable_footer' => array(
									'type' => 'string',
								),
							),
						),
					),
				)
			);

			// Register Meta for content position.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-content',
				array(
					'single'        => true,
					'type'          => 'object',
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'location'              => array(
									'type' => 'string',
								),
								'after_block_number'    => array(
									'type' => 'string',
								),
								'before_heading_number' => array(
									'type' => 'string',
								),
							),
						),
					),
				)
			);

		}

		/**
		 * Get device types.
		 *
		 * @since 3.6.4
		 */
		public function get_device_type() {
			return array(
				'desktop' => __( 'Desktop', 'astra-addon' ),
				'mobile'  => __( 'Mobile', 'astra-addon' ),
				'both'    => __( 'Desktop + Mobile', 'astra-addon' ),
			);
		}

		/**
		 * Get Post/Page Content types.
		 *
		 * @since 3.6.4
		 */
		public function get_content_type() {
			return array(
				'after_blocks'    => __( 'After certain number of blocks', 'astra-addon' ),
				'before_headings' => __( 'Before certain number of Heading blocks', 'astra-addon' ),
			);
		}

		/**
		 * Get saved specific post/page rules values.
		 *
		 * @param string $type is type Add rule or exclusion rule.
		 * @since 3.6.4
		 * @return array
		 */
		public function get_specific_rule( $type = '' ) {
			global $post;

			$post_id        = $post->ID;
			$location_label = array();

			if ( 'exclusion' === $type ) {
				$locations = get_post_meta( $post_id, 'ast-advanced-hook-exclusion', true );
			} else {
				$locations = get_post_meta( $post_id, 'ast-advanced-hook-location', true );
			}

			if ( ! isset( $locations['specific'] ) ) {
				return $location_label;
			}

			foreach ( $locations['specific'] as $location ) {
				$label            = Astra_Target_Rules_Fields::get_location_by_key( $location );
				$location_label[] = array(
					'label' => $label,
					'value' => $location,
				);
			}

			return $location_label;
		}

		/**
		 * Register Post Meta options for react based fields.
		 *
		 * @since 3.6.4
		 */
		public function register_meta_settings() {
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-layout',
				array(
					'single'        => true,
					'type'          => 'string',
					'auth_callback' => '__return_true',
					'show_in_rest'  => true,
				)
			);

			// Register Meta for Header Hook.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-header',
				array(
					'single'        => true,
					'type'          => 'object',
					'auth_callback' => '__return_true',
					'default'       => array( 'sticky-header-on-devices' => 'desktop' ),
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'sticky'                   => array(
									'type' => 'string',
								),
								'shrink'                   => array(
									'type' => 'string',
								),
								'sticky-header-on-devices' => array(
									'type' => 'string',
								),
							),
						),
					),
				)
			);

			// Register Meta for Footer Hook.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-footer',
				array(
					'single'        => true,
					'type'          => 'object',
					'auth_callback' => '__return_true',
					'default'       => array( 'sticky-footer-on-devices' => 'desktop' ),
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'sticky'                   => array(
									'type' => 'string',
								),
								'sticky-footer-on-devices' => array(
									'type' => 'string',
								),
							),
						),
					),
				)
			);

			// Register Meta for 404-page.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-404-page',
				array(
					'single'        => true,
					'type'          => 'object',
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'disable_header' => array(
									'type' => 'string',
								),
								'disable_footer' => array(
									'type' => 'string',
								),
							),
						),
					),
				)
			);

			// Register Meta for Time Duration.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-time-duration',
				array(
					'single'        => true,
					'type'          => 'object',
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'enabled'  => array(
									'type' => 'string',
								),
								'start-dt' => array(
									'type' => 'string',
								),
								'end-dt'   => array(
									'type' => 'string',
								),
							),
						),
					),
				)
			);

			// Register Meta for content position.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-content',
				array(
					'single'        => true,
					'type'          => 'object',
					'default'       => array( 'location' => 'after_blocks' ),
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'location'              => array(
									'type' => 'string',
								),
								'after_block_number'    => array(
									'type' => 'string',
								),
								'before_heading_number' => array(
									'type' => 'string',
								),
							),
						),
					),
				)
			);

			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-action',
				array(
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => 'string',
					'auth_callback' => '__return_true',
				)
			);

			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-priority',
				array(
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => 'string',
					'auth_callback' => '__return_true',
				)
			);

			// Register Meta for Action Hook padding.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-padding',
				array(
					'single'        => true,
					'type'          => 'object',
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'top'    => array(
									'type' => 'string',
								),
								'bottom' => array(
									'type' => 'string',
								),
							),
						),
					),
				)
			);

			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-location',
				array(
					'single'        => true,
					'type'          => 'object',
					'default'       => array(
						'rule'         => array(),
						'specific'     => array(),
						'specificText' => array(),
					),
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'rule'         => array(
									'type' => 'array',
								),
								'specific'     => array(
									'type' => 'array',
								),
								'specificText' => array(
									'type' => 'array',
								),
							),
						),
					),
				)
			);

			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-exclusion',
				array(
					'single'        => true,
					'type'          => 'object',
					'default'       => array(
						'rule'         => array(),
						'specific'     => array(),
						'specificText' => array(),
					),
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'       => 'object',
							'properties' => array(
								'rule'         => array(
									'type' => 'array',
								),
								'specific'     => array(
									'type' => 'array',
								),
								'specificText' => array(
									'type' => 'array',
								),
							),
						),
					),
				)
			);

			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-hook-users',
				array(
					'single'        => true,
					'type'          => 'array',
					'auth_callback' => '__return_true',
					'show_in_rest'  => array(
						'schema' => array(
							'type'  => 'array',
							'items' => array(
								'type' => 'string',
							),
						),
					),
				)
			);

			// Register Meta for responsive visibility.
			register_post_meta(
				ASTRA_ADVANCED_HOOKS_POST_TYPE,
				'ast-advanced-display-device',
				array(
					'single'        => true,
					'type'          => 'array',
					'auth_callback' => '__return_true',
					'default'       => array( 'desktop', 'mobile', 'tablet' ),
					'show_in_rest'  => array(
						'schema' => array(
							'type'  => 'array',
							'items' => array(
								'type' => 'string',
							),
						),
					),
				)
			);

		}

		/**
		 * Get all layout types.
		 *
		 * @since 3.6.4
		 */
		public function get_layout_type() {
			return array(
				'0'        => __( '— Select —', 'astra-addon' ),
				'header'   => __( 'Header', 'astra-addon' ),
				'footer'   => __( 'Footer', 'astra-addon' ),
				'404-page' => __( '404 Page', 'astra-addon' ),
				'hooks'    => __( 'Hooks', 'astra-addon' ),
				'content'  => __( 'Inside Post/Page Content', 'astra-addon' ),
			);
		}

		/**
		 * Ajax request to toggle the display advanced hook.
		 *
		 * @since 3.6.4
		 */
		public function ast_advanced_hook_display_toggle() {
			check_ajax_referer( 'astra-addon-enable-tgl-nonce', 'nonce' );

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error();
			}

			if ( ! isset( $_REQUEST['post_id'] ) ) {
				wp_send_json_error();
			}

			if ( ! isset( $_REQUEST['enable'] ) ) {
				wp_send_json_error();
			}

			$post_id = sanitize_text_field( intval( $_REQUEST['post_id'] ) );
			$enabled = sanitize_text_field( $_REQUEST['enable'] );

			if ( 'yes' !== $enabled && 'no' !== $enabled ) {
				wp_send_json_error();
			}

			if ( ! $post_id ) {
				wp_send_json_error();
			}

			update_post_meta( $post_id, 'ast-advanced-hook-enabled', $enabled );
			wp_send_json_success( array() );
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Advanced_Hooks_Loader::get_instance();
