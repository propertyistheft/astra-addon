<?php
/**
 * Navigation Widget Support
 *
 * @package Astra Addon
 * @since 1.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Ext_Nav_Widget_Support' ) ) {

	/**
	 * Astra Nav widget support.
	 *
	 * @since 1.6.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Nav_Widget_Support {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'wp_ajax_ast_add_widget', array( $this, 'add_widget' ) );
			add_action( 'wp_ajax_ast_edit_widget', array( $this, 'edit_widget' ) );
			add_action( 'wp_ajax_ast_delete_widget', array( $this, 'delete_widget' ) );
			add_action( 'wp_ajax_ast_render_widgets', array( $this, 'render_widgets' ) );
			add_action( 'wp_ajax_ast_save_widget', array( $this, 'save_widget' ) );

			add_action( 'init', array( $this, 'register_widget_area' ) );

			add_action( 'admin_print_footer_scripts-nav-menus.php', array( $this, 'admin_print_footer_scripts' ) );

			// @codingStandardsIgnoreStart
			add_action( 'admin_print_scripts-nav-menus.php', array( $this, 'admin_print_scripts' ) );
			add_action( 'admin_print_styles-nav-menus.php', array( $this, 'admin_print_styles' ) );
			// @codingStandardsIgnoreEnd

			add_filter( 'black_studio_tinymce_enable_pages', array( $this, 'megamenu_blackstudio_tinymce' ) );
			add_filter( 'conditional_menus_theme_location', array( $this, 'conditional_menus_restore_theme_location' ), 10, 3 );
		}

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
		 * Function to get widget list
		 *
		 * @since 1.6.0
		 * @return array;
		 */
		public function get_widget_list() {

			global $wp_widget_factory;

			$widgets = array();

			foreach ( $wp_widget_factory->widgets as $widget ) {

				$widgets[] = array(
					'text' => $widget->name,
					'id'   => $widget->id_base,
				);
			}

			return $widgets;

		}

		/**
		 * Function to add widget to list.
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function add_widget() {
			$menu_item_id = isset( $_POST['menu_item_id'] ) ? sanitize_text_field( $_POST['menu_item_id'] ) : '';
			check_ajax_referer( 'wp_widget_nonce', 'security_nonce' );

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_send_json_error( __( 'Insufficient permissions', 'astra-addon' ) );
			}
			$widget_id = isset( $_POST['widget_id'] ) ? sanitize_text_field( $_POST['widget_id'] ) : '';
			$title     = isset( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : '';

			require_once ABSPATH . 'wp-admin/includes/widgets.php';

			// Adding instance of menu item.
			$next_id         = next_widget_id_number( $widget_id );
			$current_widgets = get_option( 'widget_' . $widget_id );

			$current_widgets[ $next_id ] = array(
				'ast_mm_parent_menu_id' => $menu_item_id,
			);

			update_option( 'widget_' . $widget_id, $current_widgets );

			$widget_id = $this->add_widget_to_sidebar( $widget_id, $next_id );

			$html = $this->render_widget( $widget_id, $title );

			wp_send_json_success( $html );

		}

		/**
		 * Registers astra menu widgets area
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function register_widget_area() {

			register_sidebar(
				array(
					'id'          => 'ast-widgets',
					'name'        => __( 'Astra Menu Widgets', 'astra-addon' ),
					'description' => __( 'Astra Nav Menu widgets.', 'astra-addon' ),
				)
			);
		}

		/**
		 * Adds a widget to Astra sidebar.
		 *
		 * @param int $widget_id widget id.
		 * @param int $next_id next widget id.
		 * @since 1.6.0
		 * @return int
		 */
		private function add_widget_to_sidebar( $widget_id, $next_id ) {

			$widget_id = $widget_id . '-' . $next_id;

			$sidebar_widgets = $this->get_ast_sidebar_widgets();

			$sidebar_widgets[] = $widget_id;

			$this->set_sidebar_widgets( $sidebar_widgets );

			do_action( 'ast_after_widget_add' );

			return $widget_id;

		}

		/**
		 * Returns an unfiltered array of all widgets in our sidebar
		 *
		 * @since 1.6.0
		 * @return array
		 */
		public function get_ast_sidebar_widgets() {

			$sidebar_widgets = wp_get_sidebars_widgets();

			if ( ! isset( $sidebar_widgets['ast-widgets'] ) ) {
				return false;
			}

			return $sidebar_widgets['ast-widgets'];

		}

		/**
		 * Sets the sidebar widgets
		 *
		 * @param int $widgets widgets list.
		 * @since 1.6.0
		 */
		private function set_sidebar_widgets( $widgets ) {

			$sidebar_widgets = wp_get_sidebars_widgets();

			$sidebar_widgets['ast-widgets'] = $widgets;

			wp_set_sidebars_widgets( $sidebar_widgets );

		}

		/**
		 * Render widget HTML
		 *
		 * @param int    $widget_id widget id.
		 * @param string $title widget title.
		 * @since 1.6.0
		 * @return string
		 */
		private function render_widget( $widget_id, $title ) {

			$nonce = wp_create_nonce( 'ast-edit-widget-' . $widget_id );

			$html  = '<div class="widget" title="' . esc_attr( $title ) . '" id="' . $widget_id . '" data-type="widget" data-id="' . $widget_id . '">';
			$html .= '    <div class="widget-top">';
			$html .= '        <div class="widget-title-action">';

			$html .= '            <a class="widget-option widget-action item-edit" title="' . esc_attr__( 'Edit', 'astra-addon' ) . '"><span class="screen-reader-text">Edit</span></a>';
			$html .= '            <input type="hidden" class="ast-nonce-field ast-edit-widget-nonce" name="ast-edit-widget-nonce-' . esc_attr( $widget_id ) . '" value="' . esc_attr( $nonce ) . '">';
			$html .= '        </div>';
			$html .= '        <div class="widget-title">';
			$html .= '            <h4>' . esc_html( $title ) . '</h4>';

			$html .= '        </div>';
			$html .= '    </div>';
			$html .= '    <div class="widget-inner widget-inside"></div>';
			$html .= '</div>';

			return $html;

		}

		/**
		 * Function to return widget form to edit.
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function edit_widget() {

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_send_json_error( __( 'Insufficient permissions', 'astra-addon' ) );
			}

			$widget_id = isset( $_POST['widget_id'] ) ? sanitize_text_field( $_POST['widget_id'] ) : '';

			check_ajax_referer( 'wp_widget_nonce', 'security_nonce' );

			global $wp_registered_widget_controls;

			$control = $wp_registered_widget_controls[ $widget_id ];
			$id_base = $this->get_id_base_for_widget_id( $widget_id );

			$nonce = wp_create_nonce( 'ast_save_widget_' . $widget_id );
			ob_start();
			?>

			<form method="post">
				<input type="hidden" name="widget-id" class="widget-id" value="<?php echo esc_attr( $widget_id ); ?>" />
				<input type='hidden' name='action'    value='ast_save_widget' />
				<input type='hidden' name='id_base'   class="id_base" value='<?php echo esc_attr( $id_base ); ?>' />
				<input type='hidden' name='widget_id' value='<?php echo esc_attr( $widget_id ); ?>' />
				<input type='hidden' name='_wpnonce'  value='<?php echo esc_attr( $nonce ); ?>' />
				<input type="hidden" class="ast-nonce-field ast-delete-widget-nonce" name="ast-delete-widget-nonce-<?php echo esc_attr( $widget_id ); ?>" value="<?php echo esc_attr( wp_create_nonce( 'ast-delete-widget-' . $widget_id ) ); ?>">

				<div class='widget-content'>
					<?php
					if ( is_callable( $control['callback'] ) ) {

						call_user_func_array( $control['callback'], $control['params'] );
					}
					?>

					<div class='widget-controls'>
						<a class='delete' href='#delete'><?php esc_html_e( 'Delete', 'astra-addon' ); ?></a> |
						<a class='close' href='#close'><?php esc_html_e( 'Close', 'astra-addon' ); ?></a>
					</div>
					<div class="alignright">
						<?php
							submit_button( __( 'Save', 'astra-addon' ), 'button-primary ast-save-widget alignright', 'savewidget', false );
						?>
						<span class="spinner"></span>
					</div>
				</div>
			</form>

			<?php

			$output = ob_get_clean();

			wp_send_json_success( $output );

		}

		/**
		 * Returns the id_base value for a Widget ID
		 *
		 * @param int $widget_id widget id.
		 * @return int
		 * @since 1.6.0
		 */
		public function get_id_base_for_widget_id( $widget_id ) {

			global $wp_registered_widget_controls;

			if ( ! isset( $wp_registered_widget_controls[ $widget_id ] ) ) {
				return false;
			}

			$control = $wp_registered_widget_controls[ $widget_id ];

			$id_base = isset( $control['id_base'] ) ? $control['id_base'] : $control['id'];

			return $id_base;

		}

		/**
		 * Delete widget attached to sidebar.
		 *
		 * @return void
		 * @since 1.6.0
		 */
		public function delete_widget() {

			$widget_id = isset( $_POST['widget_id'] ) ? sanitize_text_field( $_POST['widget_id'] ) : '';

			check_ajax_referer( 'wp_widget_nonce', 'security_nonce' );

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_send_json_error( __( 'Insufficient permissions', 'astra-addon' ) );
			}

			$this->remove_widget_from_sidebar( $widget_id );
			$this->remove_widget_instance( $widget_id );
		}

		/**
		 * Remove widget from sidebar.
		 *
		 * @param int $widget_id widget id.
		 * @return void
		 * @since 1.6.0
		 */
		private function remove_widget_from_sidebar( $widget_id ) {

			$widgets = $this->get_ast_sidebar_widgets();

			$new_ast_widgets = array();

			foreach ( $widgets as $widget ) {

				if ( $widget != $widget_id ) {
					$new_ast_widgets[] = $widget;
				}
			}

			$this->set_sidebar_widgets( $new_ast_widgets );
		}

		/**
		 * Remove widget instance.
		 *
		 * @param int $widget_id widget id.
		 * @return bool
		 * @since 1.6.0
		 */
		private function remove_widget_instance( $widget_id ) {

			$id_base       = $this->get_id_base_for_widget_id( $widget_id );
			$parts         = explode( '-', $widget_id );
			$widget_number = absint( end( $parts ) );

			$current_widgets = get_option( 'widget_' . $id_base );

			if ( isset( $current_widgets[ $widget_number ] ) ) {

				unset( $current_widgets[ $widget_number ] );

				update_option( 'widget_' . $id_base, $current_widgets );

				return true;
			}

			return false;

		}

		/**
		 * Render widget.
		 *
		 * @return void
		 * @since 1.6.0
		 */
		public function render_widgets() {

			$menu_item_id = isset( $_POST['menu_item_id'] ) ? sanitize_text_field( $_POST['menu_item_id'] ) : '';

			check_ajax_referer( 'wp_widget_nonce', 'security_nonce' );

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_die();
			}

			$html        = '';
			$has_widgets = false;

			$widgets = get_post_meta( $menu_item_id, '_menu_item_megamenu_widgets_list', true );
			$widgets = explode( ',', $widgets );

			if ( ! empty( $widgets ) ) {
				$has_widgets = true;
				foreach ( $widgets as $widget ) {

					if ( '' !== $widget ) {
						$title = $this->get_name_for_widget_id( $widget );
						$html .= $this->render_widget( $widget, $title );
					}
				}
			}

			$data = array(
				'html'        => $html,
				'has_widgets' => $has_widgets,
			);

			wp_send_json_success( $data );

		}

		/**
		 * Get widgets for menu item.
		 *
		 * @param int $menu_item_id menu item ID.
		 * @return array
		 * @since 1.6.0
		 */
		public function get_widgets_by_id( $menu_item_id ) {

			$widgets     = array();
			$all_widgets = $this->get_ast_sidebar_widgets();

			if ( ! empty( $all_widgets ) ) {
				foreach ( $all_widgets as $widget_id ) {

					$settings = $this->get_settings_for_widget_id( $widget_id );

					if ( isset( $settings['ast_mm_parent_menu_id'] ) && $settings['ast_mm_parent_menu_id'] == $menu_item_id ) {

						$name = $this->get_name_for_widget_id( $widget_id );

						$widgets[ $widget_id ] = array(
							'id'    => $widget_id,
							'type'  => 'widget',
							'title' => $name,
						);
					}
				}
			}

			return $widgets;
		}

		/**
		 * Get settings for widget.
		 *
		 * @param int $widget_id widget ID.
		 * @return array
		 * @since 1.6.0
		 */
		public function get_settings_for_widget_id( $widget_id ) {

			$id = $this->get_id_base_for_widget_id( $widget_id );

			if ( ! $id ) {
				return false;
			}

			$parts           = explode( '-', $widget_id );
			$widget_number   = absint( end( $parts ) );
			$current_widgets = get_option( 'widget_' . $id );

			return $current_widgets[ $widget_number ];
		}

		/**
		 * Get name for the widget.
		 *
		 * @param int $widget_id widget ID.
		 * @return string
		 * @since 1.6.0
		 */
		public function get_name_for_widget_id( $widget_id ) {
			global $wp_registered_widgets;

			if ( ! isset( $wp_registered_widgets[ $widget_id ] ) ) {
				return false;
			}

			$registered_widget = $wp_registered_widgets[ $widget_id ];

			return $registered_widget['name'];

		}

		/**
		 * Save widget settings.
		 *
		 * @return void
		 * @since 1.6.0
		 */
		public function save_widget() {

			$widget_id = isset( $_POST['widget-id'] ) ? sanitize_text_field( $_POST['widget-id'] ) : '';

			check_ajax_referer( 'ast_save_widget_' . $widget_id );

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_die();
			}

			$id_base = isset( $_POST['id_base'] ) ? sanitize_text_field( $_POST['id_base'] ) : '';

			global $wp_registered_widget_updates;

			$control = $wp_registered_widget_updates[ $id_base ];

			if ( is_callable( $control['callback'] ) ) {

				call_user_func_array( $control['callback'], $control['params'] );

				do_action( 'ast_after_widget_save' );

				wp_send_json_success();
			}

			wp_send_json_error();

		}

		/**
		 * Display widget on front end.
		 *
		 * @param int $id widget id.
		 * @return string
		 * @since 1.6.0
		 */
		public function display_widget( $id ) {

			global $wp_registered_widgets;

			if ( ! isset( $wp_registered_widgets[ $id ] ) ) {
				return '';
			}

			$params = array_merge(
				array(
					array_merge(
						array(
							'widget_id'   => $id,
							'widget_name' => $wp_registered_widgets[ $id ]['name'],
						)
					),
				),
				(array) $wp_registered_widgets[ $id ]['params']
			);

			$params[0]['id']            = 'ast-widgets';
			$params[0]['before_title']  = apply_filters( 'ast_before_widget_title', '<h4 class="mega-block-title">', $wp_registered_widgets[ $id ] );
			$params[0]['after_title']   = apply_filters( 'ast_after_widget_title', '</h4>', $wp_registered_widgets[ $id ] );
			$params[0]['before_widget'] = apply_filters( 'ast_before_widget', '<div class="ast-mm-widget-item">', $wp_registered_widgets[ $id ] );
			$params[0]['after_widget']  = apply_filters( 'ast_after_widget', '</div>', $wp_registered_widgets[ $id ] );

			$callback = $wp_registered_widgets[ $id ]['callback'];

			if ( is_callable( $callback ) ) {
				ob_start();
				call_user_func_array( $callback, $params );
				return ob_get_clean();
			}
		}

		/**
		 * Print the widgets.php scripts on the nav-menus.php page. Required for 4.8 Core Media Widgets.
		 *
		 * @param string $hook action hook.
		 * @since 1.6.0
		 */
		public function admin_print_scripts( $hook ) {
			// @codingStandardsIgnoreStart
			do_action( 'admin_print_scripts-widgets.php' );
			// @codingStandardsIgnoreEnd
		}

		/**
		 * Print the widgets.php scripts on the nav-menus.php page. Required for 4.8 Core Media Widgets.
		 *
		 * @param string $hook action hook.
		 * @since 1.6.0
		 */
		public function admin_print_styles( $hook ) {
			// @codingStandardsIgnoreStart
			do_action( 'admin_print_styles-widgets.php' );
			// @codingStandardsIgnoreEnd
		}

		/**
		 * Add compatibility for conditional menus plugin
		 *
		 * @param string $location theme action.
		 * @param array  $new_args new arguments.
		 * @param array  $old_args old arguments.
		 * @since 1.6.0
		 */
		public function conditional_menus_restore_theme_location( $location, $new_args, $old_args ) {
			return $old_args['theme_location'];
		}

		/**
		 * Black Studio TinyMCE Compatibility.
		 * Load TinyMCE assets on nav-menus.php page.
		 *
		 * @since 1.6.0
		 * @param array $pages pages list array.
		 * @return array $pages
		 */
		public function megamenu_blackstudio_tinymce( $pages ) {
			$pages[] = 'nav-menus.php';
			return $pages;
		}

		/**
		 * Print the widgets.php scripts on the nav-menus.php page. Required for 4.8 Core Media Widgets.
		 *
		 * @param string $hook action hook.
		 * @since 1.6.0
		 */
		public function admin_print_footer_scripts( $hook ) {
			// @codingStandardsIgnoreStart
			do_action( 'admin_footer-widgets.php' );
			// @codingStandardsIgnoreEnd
		}
	}

	Astra_Ext_Nav_Widget_Support::get_instance();
}

