<?php
/**
 * Navigation Menu Markup.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Ext_Nav_Menu_Markup' ) ) {

	/**
	 * Astra Nav Menu loader.
	 *
	 * @since 1.6.0
	 */
	final class Astra_Ext_Nav_Menu_Markup {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var string
		 */
		private static $mega_menu_style = '';

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
			global $pagenow;

			// Add custom fields to menu.
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_fields_meta' ) );

			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'add_custom_fields' ), 10, 4 );

			// Edit menu walker.
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_walker' ), 12 );

			add_action( 'init', array( 'Astra_Ext_Nav_Menu_Markup', 'load_walker' ), 1 );

			add_action( 'wp_ajax_ast_get_posts_list', array( $this, 'get_post_list_by_query' ) );

			/* Add Body Classes */
			add_filter( 'body_class', array( $this, 'body_classes' ), 10, 1 );

			add_action( 'init', array( $this, 'add_mega_menu_classes' ) );

			add_filter( 'astra_above_header_menu_classes', array( $this, 'add_above_menu_classes' ) );
			add_filter( 'astra_below_header_menu_classes', array( $this, 'add_below_menu_classes' ) );

			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );

			if ( 'nav-menus.php' === $pagenow ) {
				add_action( 'admin_footer', array( $this, 'add_popup_wrap' ) );
			}

			add_action( 'wp_ajax_ast_render_popup', array( $this, 'render_mm_popup_html' ) );

			add_action( 'wp_ajax_ast_save_menu_options', array( $this, 'save_menu_options' ) );

		}

		/**
		 * Enqueue Font Family
		 */
		public function add_fonts() {
			$font_family_primary = astra_get_option( 'primary-header-megamenu-heading-font-family' );
			$font_weight_primary = astra_get_option( 'primary-header-megamenu-heading-font-weight' );
			Astra_Fonts::add_font( $font_family_primary, $font_weight_primary );

			$font_family_above = astra_get_option( 'above-header-megamenu-heading-font-family' );
			$font_weight_above = astra_get_option( 'above-header-megamenu-heading-font-weight' );
			Astra_Fonts::add_font( $font_family_above, $font_weight_above );

			$font_family_below = astra_get_option( 'below-header-megamenu-heading-font-family' );
			$font_weight_below = astra_get_option( 'below-header-megamenu-heading-font-weight' );
			Astra_Fonts::add_font( $font_family_below, $font_weight_below );

			$font_family_mobile_submenu = astra_get_option( 'header-font-family-mobile-menu-sub-menu' );
			$font_weight_mobile_submenu = astra_get_option( 'header-font-weight-mobile-menu-sub-menu' );
			Astra_Fonts::add_font( $font_family_mobile_submenu, $font_weight_mobile_submenu );
		}

		/**
		 * Add custom megamenu fields data to the menu.
		 *
		 * @access public
		 * @param int    $id menu item id.
		 * @param object $item A single menu item.
		 * @param int    $depth menu item depth.
		 * @param array  $args menu item arguments.
		 * @return void.
		 */
		public function add_custom_fields( $id, $item, $depth, $args ) {

			?>

			<input type="hidden" class="ast-nonce-field" value="<?php echo esc_attr( wp_create_nonce( 'ast-render-opts-' . $id ) ); ?>">

			<p class="description description-wide">
				<a class="button button-secondary button-large astra-megamenu-opts-btn" data-depth="<?php echo esc_attr( $depth ); ?>">
					<?php

						echo sprintf(
							/* translators: Astra Pro whitelabbeled string */
							esc_html__(
								'%1$s Menu Settings',
								'astra-addon'
							),
							esc_html( astra_get_theme_name() )
						);
					?>
				</a>
			</p>
			<?php
		}

		/**
		 * Add custom menu style fields data to the menu.
		 *
		 * @access public
		 * @param object $menu_item A single menu item.
		 * @return object The menu item.
		 */
		public function add_custom_fields_meta( $menu_item ) {

			$menu_item->megamenu                          = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
			$menu_item->megamenu_width                    = get_post_meta( $menu_item->ID, '_menu_item_megamenu_width', true );
			$menu_item->megamenu_col                      = get_post_meta( $menu_item->ID, '_menu_item_megamenu_col', true );
			$menu_item->megamenu_text_color               = get_post_meta( $menu_item->ID, '_menu_item_megamenu_text_color', true );
			$menu_item->megamenu_text_h_color             = get_post_meta( $menu_item->ID, '_menu_item_megamenu_text_h_color', true );
			$menu_item->megamenu_background_image         = get_post_meta( $menu_item->ID, '_menu_item_megamenu_background_image', true );
			$menu_item->megamenu_bg_size                  = get_post_meta( $menu_item->ID, '_menu_item_megamenu_bg_size', true );
			$menu_item->megamenu_bg_repeat                = get_post_meta( $menu_item->ID, '_menu_item_megamenu_bg_repeat', true );
			$menu_item->megamenu_bg_position              = get_post_meta( $menu_item->ID, '_menu_item_megamenu_bg_position', true );
			$menu_item->megamenu_bg_color                 = get_post_meta( $menu_item->ID, '_menu_item_megamenu_bg_color', true );
			$menu_item->megamenu_highlight_label          = get_post_meta( $menu_item->ID, '_menu_item_megamenu_highlight_label', true );
			$menu_item->megamenu_label_color              = get_post_meta( $menu_item->ID, '_menu_item_megamenu_label_color', true );
			$menu_item->megamenu_label_bg_color           = get_post_meta( $menu_item->ID, '_menu_item_megamenu_label_bg_color', true );
			$menu_item->megamenu_column_divider_color     = get_post_meta( $menu_item->ID, '_menu_item_megamenu_column_divider_color', true );
			$menu_item->megamenu_heading_seeparator_color = get_post_meta( $menu_item->ID, '_menu_item_megamenu_heading_seeparator_color', true );
			$menu_item->megamenu_content_src              = get_post_meta( $menu_item->ID, '_menu_item_megamenu_content_src', true );
			$menu_item->megamenu_custom_text              = get_post_meta( $menu_item->ID, '_menu_item_megamenu_custom_text', true );

			$menu_item->megamenu_disable_title  = get_post_meta( $menu_item->ID, '_menu_item_megamenu_disable_title', true );
			$menu_item->megamenu_enable_heading = get_post_meta( $menu_item->ID, '_menu_item_megamenu_enable_heading', true );
			$menu_item->megamenu_disable_link   = get_post_meta( $menu_item->ID, '_menu_item_megamenu_disable_link', true );

			$menu_item->megamenu_widgets_list = get_post_meta( $menu_item->ID, '_menu_item_megamenu_widgets_list', true );

			$menu_item->megamenu_template = get_post_meta( $menu_item->ID, '_menu_item_megamenu_template', true );
			$menu_item->custom_width      = get_post_meta( $menu_item->ID, '_menu_item_megamenu_custom_width', true );

			$menu_item->megamenu_margin_top    = get_post_meta( $menu_item->ID, '_menu_item_megamenu_margin_top', true );
			$menu_item->megamenu_margin_right  = get_post_meta( $menu_item->ID, '_menu_item_megamenu_margin_right', true );
			$menu_item->megamenu_margin_bottom = get_post_meta( $menu_item->ID, '_menu_item_megamenu_margin_bottom', true );
			$menu_item->megamenu_margin_left   = get_post_meta( $menu_item->ID, '_menu_item_megamenu_margin_left', true );

			$menu_item->megamenu_padding_top    = get_post_meta( $menu_item->ID, '_menu_item_megamenu_padding_top', true );
			$menu_item->megamenu_padding_right  = get_post_meta( $menu_item->ID, '_menu_item_megamenu_padding_right', true );
			$menu_item->megamenu_padding_bottom = get_post_meta( $menu_item->ID, '_menu_item_megamenu_padding_bottom', true );
			$menu_item->megamenu_padding_left   = get_post_meta( $menu_item->ID, '_menu_item_megamenu_padding_left', true );

			return $menu_item;
		}

		/**
		 * Function to replace normal edit nav walker
		 *
		 * @return string Class name of new navwalker
		 */
		public function edit_walker() {

			require_once ASTRA_EXT_NAV_MENU_DIR . 'classes/class-astra-walker-nav-menu-edit-custom.php';
			return 'Astra_Walker_Nav_Menu_Edit_Custom';
		}

		/**
		 * Function to load custom navigation walker.
		 *
		 * @return void.
		 */
		public static function load_walker() {
			require_once ASTRA_EXT_NAV_MENU_DIR . 'classes/class-astra-custom-nav-walker.php';
		}

		/**
		 * Function to get posts lists to display.
		 *
		 * @return void.
		 */
		public function get_post_list_by_query() {

			check_ajax_referer( 'astra-addon-get-posts-by-query', 'nonce' );

			$search_string = isset( $_POST['q'] ) ? sanitize_text_field( $_POST['q'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$data          = array();
			$result        = array();

			$args = array(
				'public'   => true,
				'_builtin' => false,
			);

			$output     = 'names'; // names or objects, note names is the default.
			$operator   = 'and'; // also supports 'or'.
			$post_types = get_post_types( $args, $output, $operator );

			$post_types['Posts'] = 'post';
			$post_types['Pages'] = 'page';

			$has_wp_block_suport = post_type_exists( 'wp_block' );

			if ( $has_wp_block_suport ) {
				$post_types['Reusable Blocks'] = 'wp_block';
			}

			foreach ( $post_types as $key => $post_type ) {

				$data = array();

				$obj_instance = Astra_Target_Rules_Fields::get_instance();

				add_filter( 'posts_search', array( $obj_instance, 'search_only_titles' ), 10, 2 );

				$query = new WP_Query(
					array(
						's'              => $search_string,
						'post_type'      => $post_type,
						'posts_per_page' => - 1,
					)
				);

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$title  = get_the_title();
						$title .= ( 0 != $query->post->post_parent ) ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
						$id     = get_the_id();
						$data[] = array(
							'id'   => $id,
							'text' => $title,
						);
					}
				}

				if ( is_array( $data ) && ! empty( $data ) ) {
					$result[] = array(
						'text'     => $key,
						'children' => $data,
					);
				}
			}

			$data = array();

			wp_reset_postdata();

			// return the result in json.
			wp_send_json( $result );
		}

		/**
		 * Mega Menu Header Classes
		 *
		 * Add classes of mega menu only if Primary Menu is set.
		 *
		 * @since 1.7.2
		 * @return void;
		 */
		public function add_mega_menu_classes() {

			if ( has_nav_menu( 'primary' ) ) {
				add_filter( 'astra_primary_menu_classes', array( $this, 'add_primary_menu_classes' ) );
				add_filter( 'astra_secondary_menu_menu_classes', array( $this, 'add_primary_menu_classes' ) );
			}
		}

		/**
		 * Primary Header Classes
		 *
		 * @param array $classes CSS Classes.
		 *
		 * @since 1.6.0
		 * @return array;
		 */
		public function add_primary_menu_classes( $classes ) {

			$classes[] = 'ast-mega-menu-enabled';
			return $classes;
		}

		/**
		 * Above Header Classes
		 *
		 * @param array $classes CSS Classes.
		 *
		 * @since 1.6.0
		 * @return array;
		 */
		public function add_above_menu_classes( $classes ) {

			$classes[] = 'ast-mega-menu-enabled';
			return $classes;
		}

		/**
		 * Below Header Classes
		 *
		 * @param array $classes CSS Classes.
		 *
		 * @since 1.6.0
		 * @return array;
		 */
		public function add_below_menu_classes( $classes ) {

			$classes[] = 'ast-mega-menu-enabled';
			return $classes;
		}

		/**
		 * Add menu options settings popup wrap at footer.
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function add_popup_wrap() {

			ob_start();
			?>

			<div class='ast-popup-wrap'>
				<div class='astra-mm-modal-overlay'></div>
				<div class='ast-popup-content'>
					<div class="ast-megamenu-spinner spinner"></div>
					<div class='astra-mm-options-wrap'>
					</div>
				</div>
			</div>

			<?php

			echo ob_get_clean();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Render HTML for nav menu settings popup.
		 *
		 * @return void
		 * @since 1.6.0
		 */
		public function render_mm_popup_html() {

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_die();
			}

			$menu_item_id   = sanitize_text_field( $_POST['menu_item_id'] );
			$menu_parent_id = sanitize_text_field( $_POST['parent_id'] );

			check_ajax_referer( 'ast-render-opts-' . $menu_item_id, 'security_nonce' );

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_die();
			}

			ob_start();

			$megamenu                         = get_post_meta( $menu_item_id, '_menu_item_megamenu', true );
			$megamenu_width                   = get_post_meta( $menu_item_id, '_menu_item_megamenu_width', true );
			$megamenu_col                     = get_post_meta( $menu_item_id, '_menu_item_megamenu_col', true );
			$megamenu_text_color              = get_post_meta( $menu_item_id, '_menu_item_megamenu_text_color', true );
			$megamenu_text_h_color            = get_post_meta( $menu_item_id, '_menu_item_megamenu_text_h_color', true );
			$megamenu_background_image        = get_post_meta( $menu_item_id, '_menu_item_megamenu_background_image', true );
			$megamenu_bg_size                 = get_post_meta( $menu_item_id, '_menu_item_megamenu_bg_size', true );
			$megamenu_bg_repeat               = get_post_meta( $menu_item_id, '_menu_item_megamenu_bg_repeat', true );
			$megamenu_bg_position             = get_post_meta( $menu_item_id, '_menu_item_megamenu_bg_position', true );
			$megamenu_bg_color                = get_post_meta( $menu_item_id, '_menu_item_megamenu_bg_color', true );
			$megamenu_highlight_label         = get_post_meta( $menu_item_id, '_menu_item_megamenu_highlight_label', true );
			$megamenu_label_color             = get_post_meta( $menu_item_id, '_menu_item_megamenu_label_color', true );
			$megamenu_label_bg_color          = get_post_meta( $menu_item_id, '_menu_item_megamenu_label_bg_color', true );
			$megamenu_column_divider_color    = get_post_meta( $menu_item_id, '_menu_item_megamenu_column_divider_color', true );
			$megamenu_heading_separator_color = get_post_meta( $menu_item_id, '_menu_item_megamenu_heading_separator_color', true );
			$megamenu_content_src             = get_post_meta( $menu_item_id, '_menu_item_megamenu_content_src', true );
			$megamenu_custom_text             = get_post_meta( $menu_item_id, '_menu_item_megamenu_custom_text', true );
			$megamenu_disable_title           = get_post_meta( $menu_item_id, '_menu_item_megamenu_disable_title', true );
			$megamenu_enable_heading          = get_post_meta( $menu_item_id, '_menu_item_megamenu_enable_heading', true );
			$megamenu_disable_link            = get_post_meta( $menu_item_id, '_menu_item_megamenu_disable_link', true );
			$custom_width                     = get_post_meta( $menu_item_id, '_menu_item_megamenu_custom_width', true );

			$megamenu_margin_top    = get_post_meta( $menu_item_id, '_menu_item_megamenu_margin_top', true );
			$megamenu_margin_right  = get_post_meta( $menu_item_id, '_menu_item_megamenu_margin_right', true );
			$megamenu_margin_bottom = get_post_meta( $menu_item_id, '_menu_item_megamenu_margin_bottom', true );
			$megamenu_margin_left   = get_post_meta( $menu_item_id, '_menu_item_megamenu_margin_left', true );

			$megamenu_padding_top    = get_post_meta( $menu_item_id, '_menu_item_megamenu_padding_top', true );
			$megamenu_padding_right  = get_post_meta( $menu_item_id, '_menu_item_megamenu_padding_right', true );
			$megamenu_padding_bottom = get_post_meta( $menu_item_id, '_menu_item_megamenu_padding_bottom', true );
			$megamenu_padding_left   = get_post_meta( $menu_item_id, '_menu_item_megamenu_padding_left', true );

			$parent_megamenu = get_post_meta( $menu_parent_id, '_menu_item_megamenu', true );

			$megamenu_template = get_post_meta( $menu_item_id, '_menu_item_megamenu_template', true );

			$menulabel_style = '';

			if ( 'disable-title' == $megamenu_disable_title ) {
				$menulabel_style = "style='display:none;'";
			}

			$mm_container_style = '';

			if ( 'megamenu' != $megamenu ) {
				$mm_container_style = "style='display:none;'";
			}

			if ( 'megamenu' == $parent_megamenu || '' == $menu_parent_id ) {
				$parent_container_class = 'ast-show';
			} else {
				$parent_container_class = 'ast-hide';
			}

			if ( 'enable-heading' === $megamenu_enable_heading ) {
				$color_class = 'ast-show';
			} else {
				$color_class = 'ast-hide';
			}

			?>
			<div class="astra-mm-title-wrap">
				<h2>
					<?php
						echo sprintf(
							/* translators: Astra Pro whitelabbeled string */
							esc_html__(
								'%1$s Menu Options',
								'astra-addon'
							),
							esc_html( astra_get_theme_name() )
						);
					?>
				</h2>
				<span class="ast-editing-label" data-label="<?php esc_attr_e( 'Editing', 'astra-addon' ); ?>"></span>
				<div class="astra-mm-close dashicons dashicons-no-alt"></div>
			</div>
			<div class="ast-mm-settings">
				<div class="astra-mm-option-container field-mm-megamenu-opts <?php echo esc_attr( $parent_container_class ); ?> " >
					<h2 class="astra-mm-option-heading"><?php esc_html_e( 'Mega Menu', 'astra-addon' ); ?></h2>

					<input type="hidden" class="ast-nonce-field" name="ast-mm-opts-nonce-<?php echo esc_attr( $menu_item_id ); ?>" value="<?php echo esc_attr( wp_create_nonce( 'ast-save-opts-' . $menu_item_id ) ); ?>">
					<input type="hidden" class="ast-nonce-field ast-drop-widget-nonce" name="ast-drop-widget-nonce-<?php echo esc_attr( $menu_item_id ); ?>" value="<?php echo esc_attr( wp_create_nonce( 'ast-drop-widget-' . $menu_item_id ) ); ?>">
					<input type="hidden" class="ast-nonce-field ast-render-widgets-nonce" name="ast-render-widgets-nonce-<?php echo esc_attr( $menu_item_id ); ?>" value="<?php echo esc_attr( wp_create_nonce( 'ast-render-widgets-' . $menu_item_id ) ); ?>">

					<div class="astra-mm-settings-wrap field-mm-enabled">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu-<?php echo esc_attr( $menu_item_id ); ?>"><?php esc_html_e( 'Enable Mega Menu', 'astra-addon' ); ?></label>
						</div>
						<div class="astra-option-input-container">
							<input type="checkbox" id="edit-menu-item-megamenu-<?php echo esc_attr( $menu_item_id ); ?>" class="code edit-menu-item-megamenu" value="megamenu" name="megamenu" <?php checked( $megamenu, 'megamenu' ); ?> />
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-width" <?php echo $mm_container_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_width-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Mega Menu Width', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<select id="edit-menu-item-megamenu_width-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_width">
								<option value="content" <?php selected( $megamenu_width, 'content' ); ?> >
								<?php esc_attr_e( 'Content', 'astra-addon' ); ?>
								</option>
								<option value="menu-container" <?php selected( $megamenu_width, 'menu-container' ); ?> >
									<?php esc_attr_e( 'Menu Container Width', 'astra-addon' ); ?>
								</option>
								<option value="full" <?php selected( $megamenu_width, 'full' ); ?> >
									<?php esc_attr_e( 'Full Width', 'astra-addon' ); ?>
								</option>
								<option value="full-stretched" <?php selected( $megamenu_width, 'full-stretched' ); ?> >
									<?php esc_attr_e( 'Full Width Stretched', 'astra-addon' ); ?>
								</option>
								<option value="custom" <?php selected( $megamenu_width, 'custom' ); ?> >
									<?php esc_attr_e( 'Custom Width', 'astra-addon' ); ?>
								</option>
							</select>
						</div>
					</div>
					<div class="astra-mm-settings-wrap mm-custom-width-wrap">
						<div class="ast-mm-label-container">
							<label for="mega-menu-item-megamenu_custom_width-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Custom Width (in px)', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="number" class="ast-mm-input" id="mega-menu-item-megamenu_custom_width-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_custom_width" / value="<?php echo esc_attr( $custom_width ); ?>" >
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-width" <?php echo $mm_container_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_heading_color">
								<?php esc_html_e( 'Change Heading Color', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
						<?php
							$url = admin_url( 'customize.php?autofocus[control]=' . ASTRA_THEME_SETTINGS . '[primary-header-megamenu-heading-color]' );
						if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
							$url = admin_url( 'customize.php?autofocus[control]=' . ASTRA_THEME_SETTINGS . '[header-menu1-mega-menu-col-color-group]&context=design' );
						}

						?>
							<a href="<?php echo esc_url( $url ); ?>" for="edit-menu-item-megamenu_heading_color_link">
								<?php esc_html_e( 'Click Here!', 'astra-addon' ); ?>
							</a>
						</div>
					</div>
					<!-- Column Heading field-->
					<div class="astra-mm-settings-wrap field-mm-enabled-heading <?php echo esc_attr( $parent_container_class ); ?> " >
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_enable_heading-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Make this menu as column heading?', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="checkbox" id="edit-menu-item-megamenu_enable_heading-<?php echo esc_attr( $menu_item_id ); ?>" class="code edit-menu-item-megamenu_enable_heading" value="enable-heading" name="megamenu_enable_heading"<?php checked( $megamenu_enable_heading, 'enable-heading' ); ?> />
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-header-sep-color <?php echo esc_attr( $color_class ); ?>">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Column Heading Separator Color', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="text" data-alpha="true" class="astra-wp-color-input" id="edit-menu-item-megamenu_heading_separator_color-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_heading_separator_color" value="<?php echo esc_attr( $megamenu_heading_separator_color ); ?>"/>
						</div>
					</div>
				</div>

				<div class="astra-mm-option-container field-mm-megamenu-label" >
					<h2 class="astra-mm-option-heading"><?php esc_html_e( 'Menu Label', 'astra-addon' ); ?></h2>

					<!-- Submenu Disable Label/Description field-->
					<div class="astra-mm-settings-wrap field-mm-disable-label">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_disable_title-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Hide Menu Label/Description?', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="checkbox" id="edit-menu-item-megamenu_disable_title-<?php echo esc_attr( $menu_item_id ); ?>" class="code edit-menu-item-megamenu_disable_title" value="disable-title" name="megamenu_disable_title" <?php checked( $megamenu_disable_title, 'disable-title' ); ?> />
						</div>
					</div>

					<!-- Submenu Disable link field-->
					<div class="astra-mm-settings-wrap field-mm-disable-link" <?php echo esc_attr( $menulabel_style ); ?>>
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_disable_link-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Disable Link', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="checkbox" id="edit-menu-item-megamenu_disable_link-<?php echo esc_attr( $menu_item_id ); ?>" class="code edit-menu-item-megamenu_disable_link" value="disable-link" name="megamenu_disable_link" <?php checked( $megamenu_disable_link, 'disable-link' ); ?> />
						</div>
					</div>
				</div>

				<div class="astra-mm-option-container field-mm-bg-img bg-image-container" <?php echo $mm_container_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
					<h2 class="astra-mm-option-heading"><?php esc_html_e( 'Background Color / Image', 'astra-addon' ); ?></h2>
					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Background Color', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="text" data-alpha="true" class="astra-wp-color-input" id="edit-menu-item-megamenu_bg_color-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_bg_color" value="<?php echo esc_attr( $megamenu_bg_color ); ?>"/>
						</div>
					</div>
					<div class="astra-mm-settings-wrap">

						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Background Image', 'astra-addon' ); ?>
							</label>
						</div>
						<?php
						$image_set_cls = '';
						if ( '' != $megamenu_background_image ) {
							$image_set_cls = 'ast-image-set';
						}
						?>
						<div class="astra-option-input-container ast-media-img-container <?php echo esc_attr( $image_set_cls ); ?>">
							<input type="hidden" id="edit-menu-item-megamenu-background-image-<?php echo esc_attr( $menu_item_id ); ?>" class="regular-text astra-builder-upload-field" name="menu-item-megamenu_background_image" value="<?php echo esc_attr( $megamenu_background_image ); ?>" />
							<div class="astra-builder-upload-preview">
								<img src="<?php echo esc_attr( $megamenu_background_image ); ?>" id="astra-media-img-background-image-<?php echo esc_attr( $menu_item_id ); ?>" class="astra-megamenu-background-image" style="<?php echo ( trim( $megamenu_background_image ) ) ? 'display:inline;' : ''; ?>" />
							</div>
							<input type='button' data-id="background-image-<?php echo esc_attr( $menu_item_id ); ?>" class='button-upload astra-builder-upload-button astra-edit-button button button-secondary' data-type="image" value="<?php esc_attr_e( 'Edit', 'astra-addon' ); ?>" />
							<input type="button" data-id="background-image-<?php echo esc_attr( $menu_item_id ); ?>" class="button button-secondary upload-image-remove ast-remove-button" value="<?php esc_attr_e( 'Remove', 'astra-addon' ); ?>"  />
							<input type='button' data-id="background-image-<?php echo esc_attr( $menu_item_id ); ?>" class='button-upload astra-builder-upload-button ast-upload-button button-secondary' data-type="image" value="<?php esc_attr_e( 'Upload Image', 'astra-addon' ); ?>" />

						</div>
					</div>

					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Background Repeat', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<?php
							$bg_sizes = array(
								'no-repeat' => __( 'No Repeat', 'astra-addon' ),
								'repeat'    => __( 'Repeat All', 'astra-addon' ),
								'repeat-x'  => __( 'Repeat Horizontally', 'astra-addon' ),
								'repeat-y'  => __( 'Repeat Vertically', 'astra-addon' ),
							);
							?>
							<select id="edit-menu-item-megamenu_bg_repeat-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_bg_repeat">
								<?php foreach ( $bg_sizes as $key => $value ) { ?>
									<option <?php selected( $megamenu_bg_repeat, $key ); ?> value="<?php echo esc_attr( $key ); ?>">
										<?php echo esc_html( $value ); ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Background Size', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<?php
							$bg_sizes = array(
								'auto'    => __( 'Auto', 'astra-addon' ),
								'cover'   => __( 'Cover', 'astra-addon' ),
								'contain' => __( 'Contain', 'astra-addon' ),
							);

							$megamenu_bg_size = ! $megamenu_bg_size ? 'cover' : $megamenu_bg_size;

							?>
							<select id="edit-menu-item-megamenu_bg_size-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_bg_size">
								<?php foreach ( $bg_sizes as $key => $value ) { ?>
									<option <?php selected( $megamenu_bg_size, $key ); ?> value="<?php echo esc_attr( $key ); ?>">
										<?php echo esc_html( $value ); ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="astra-mm-settings-wrap field-mm-bg-position">

						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Background Position', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<?php
							$bg_positions = array(
								'left top'      => __( 'Left Top', 'astra-addon' ),
								'left center'   => __( 'Left Center', 'astra-addon' ),
								'left bottom'   => __( 'Left Bottom', 'astra-addon' ),
								'right top'     => __( 'Right Top', 'astra-addon' ),
								'right center'  => __( 'Right Center', 'astra-addon' ),
								'right bottom'  => __( 'Right Bottom', 'astra-addon' ),
								'center top'    => __( 'Center Top', 'astra-addon' ),
								'center center' => __( 'Center Center', 'astra-addon' ),
								'center bottom' => __( 'Center Bottom', 'astra-addon' ),
							);
							?>
							<select id="edit-menu-item-megamenu_bg_position-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_bg_position">
								<?php foreach ( $bg_positions as $key => $value ) { ?>
									<option <?php selected( $megamenu_bg_position, $key ); ?> value="<?php echo esc_attr( $key ); ?>">
										<?php echo esc_attr( $value ); ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="astra-mm-option-container field-mm-color" <?php echo $mm_container_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
					<h2 class="astra-mm-option-heading"><?php esc_html_e( 'Override Colors for this Mega Menu?', 'astra-addon' ); ?></h2>
					<div class="astra-mm-settings-wrap field-mm-text-color">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Text/Link Color', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="text" data-alpha="true" class="astra-wp-color-input" id="edit-menu-item-megamenu_text_color-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_text_color" value="<?php echo esc_attr( $megamenu_text_color ); ?>"/>
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-text-hover-color">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Text/Link Hover Color', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="text" data-alpha="true" class="astra-wp-color-input" id="edit-menu-item-megamenu_text_h_color-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_text_h_color" value="<?php echo esc_attr( $megamenu_text_h_color ); ?>"/>
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-column-div-color">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Column Divider Color', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="text" data-alpha="true" class="astra-wp-color-input" id="edit-menu-item-megamenu_column_divider_color-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_column_divider_color" value="<?php echo esc_attr( $megamenu_column_divider_color ); ?>"/>
						</div>
					</div>
				</div>
				<div class="astra-mm-option-container field-mm-content-src <?php echo esc_attr( $parent_container_class ); ?>" >
					<h2 class="astra-mm-option-heading"><?php esc_html_e( 'Content Source', 'astra-addon' ); ?></h2>
					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_content_src-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Content Source', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<?php

							$src = array(
								'default'     => __( 'Default', 'astra-addon' ),
								'custom_text' => __( 'Custom Text', 'astra-addon' ),
								'template'    => __( 'Template', 'astra-addon' ),
								'widget'      => __( 'Widget', 'astra-addon' ),
							);

							?>
							<select id="edit-menu-item-megamenu_content_src-<?php echo esc_attr( $menu_item_id ); ?>" class="ast-content-src form-control ast-input" name="menu-item-megamenu_content_src" / >

								<?php
								$content_src = $megamenu_content_src;

								foreach ( $src as $key => $value ) {

									echo '<option ' . selected( $content_src, $key ) . " value='" . esc_attr( $key ) . "'>" . esc_attr( $value ) . '</option>';
								}

								?>
							</select>
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-custom-text">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_custom_text-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Enter Custom Text', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<textarea cols="65" rows="15" class="ast-custom-text-editor" id="menu-item-megamenu_custom_text" name="menu-item-megamenu_custom_text"><?php echo esc_textarea( $megamenu_custom_text ); ?></textarea>
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-template">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_template-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Template', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<select id="edit-menu-item-megamenu_template-<?php echo esc_attr( $menu_item_id ); ?>" class="form-control ast-input ast-select2-container" name="menu-item-megamenu_template" / >

								<?php

								if ( ! empty( $megamenu_template ) ) {

									$template_title = get_the_title( (int) $megamenu_template );

									echo "<option selected='selected' value='" . esc_attr( $megamenu_template ) . "'>" . esc_attr( $template_title ) . '</option>';
								}

								?>
							</select>
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-widget-option">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_widget-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Insert Widget', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<?php

							$widget_obj = Astra_Ext_Nav_Widget_Support::get_instance();
							$widgets    = $widget_obj->get_widget_list();

							?>
							<select id="edit-menu-item-megamenu_widget-<?php echo esc_attr( $menu_item_id ); ?>" class="form-control ast-input ast-select-widget" name="menu-item-megamenu_widget" / >

								<option value=""><?php esc_html_e( 'Select widget', 'astra-addon' ); ?></option>

								<?php

								foreach ( $widgets as $widget ) {

									echo '<option value="' . esc_attr( $widget['id'] ) . '">' . esc_attr( $widget['text'] ) . '</option>';
								}

								?>
							</select>
							<button class="button button-primary ast-insert-widget"><?php esc_html_e( 'Add Widget', 'astra-addon' ); ?></button>
						</div>
					</div>
					<div class="astra-mm-settings-wrap field-mm-widget-area">
						<div class="ast-widget-list" id="ast-widget-sortable">

						</div>
					</div>
				</div>
				<div class="astra-mm-option-container field-mm-highlight-label" >
					<h2 class="astra-mm-option-heading"><?php esc_html_e( 'Highlight Labels', 'astra-addon' ); ?></h2>
					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_highlight_label-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Menu Highlight Label', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="text" class="ast-mm-input" id="edit-menu-item-megamenu_highlight_label-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_highlight_label" / value="<?php echo esc_attr( $megamenu_highlight_label ); ?>" >
						</div>
					</div>
					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Highlight Label Color', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="text" data-alpha="true" class="ast-mm-input astra-wp-color-input" id="edit-menu-item-megamenu_label_color-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_label_color" value="<?php echo esc_attr( $megamenu_label_color ); ?>"/>
						</div>
					</div>
					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label>
								<?php esc_html_e( 'Highlight Label Background Color', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container">
							<input type="text" data-alpha="true" class="ast-mm-input astra-wp-color-input" id="edit-menu-item-megamenu_label_bg_color-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_label_bg_color" value="<?php echo esc_attr( $megamenu_label_bg_color ); ?>"/>
						</div>
					</div>
				</div>
				<div class="astra-mm-option-container field-mm-highlight-label field-mm-advanced-options" >
					<h2 class="astra-mm-option-heading"><?php esc_html_e( 'Advanced', 'astra-addon' ); ?></h2>
					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_margin_top-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Margin (in px)', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container spacing-wrapper">
							<ul class="ast-mm-spacing-wrap">
								<li clas="spacing-input-item">
									<input type="number" class="ast-mm-input" id="edit-menu-item-megamenu_margin_top-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_margin_top" / value="<?php echo esc_attr( $megamenu_margin_top ); ?>" >
									<span class="ast-spacing-title"> <?php esc_html_e( 'Top', 'astra-addon' ); ?> </span>
								</li>
								<li clas="spacing-input-item">
									<input type="number" class="ast-mm-input" id="edit-menu-item-megamenu_margin_right-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_margin_right" / value="<?php echo esc_attr( $megamenu_margin_right ); ?>" >
									<span class="ast-spacing-title"> <?php esc_html_e( 'Right', 'astra-addon' ); ?> </span>
								</li>
								<li clas="spacing-input-item">
									<input type="number" class="ast-mm-input" id="edit-menu-item-megamenu_margin_bottom-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_margin_bottom" / value="<?php echo esc_attr( $megamenu_margin_bottom ); ?>" >
									<span class="ast-spacing-title"> <?php esc_html_e( 'Bottom', 'astra-addon' ); ?> </span>
								</li>
								<li clas="spacing-input-item">
									<input type="number" class="ast-mm-input" id="edit-menu-item-megamenu_margin_left-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_margin_left" / value="<?php echo esc_attr( $megamenu_margin_left ); ?>" >
									<span class="ast-spacing-title"> <?php esc_html_e( 'Left', 'astra-addon' ); ?> </span>
								</li>
							</ul>
						</div>
					</div>

					<div class="astra-mm-settings-wrap">
						<div class="ast-mm-label-container">
							<label for="edit-menu-item-megamenu_padding_top-<?php echo esc_attr( $menu_item_id ); ?>">
								<?php esc_html_e( 'Padding (in px)', 'astra-addon' ); ?>
							</label>
						</div>
						<div class="astra-option-input-container spacing-wrapper">
							<ul class="ast-mm-spacing-wrap">
								<li clas="spacing-input-item">
									<input type="number" class="ast-mm-input" id="edit-menu-item-megamenu_padding_top-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_padding_top" / value="<?php echo esc_attr( $megamenu_padding_top ); ?>" >
									<span class="ast-spacing-title"> <?php esc_html_e( 'Top', 'astra-addon' ); ?> </span>
								</li>
								<li clas="spacing-input-item">
									<input type="number" class="ast-mm-input" id="edit-menu-item-megamenu_padding_right-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_padding_right" / value="<?php echo esc_attr( $megamenu_padding_right ); ?>" >
									<span class="ast-spacing-title"> <?php esc_html_e( 'Right', 'astra-addon' ); ?> </span>
								</li>
								<li clas="spacing-input-item">
									<input type="number" class="ast-mm-input" id="edit-menu-item-megamenu_padding_bottom-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_padding_bottom" / value="<?php echo esc_attr( $megamenu_padding_bottom ); ?>" >
									<span class="ast-spacing-title"> <?php esc_html_e( 'Bottom', 'astra-addon' ); ?> </span>
								</li>
								<li clas="spacing-input-item">
									<input type="number" class="ast-mm-input" id="edit-menu-item-megamenu_padding_left-<?php echo esc_attr( $menu_item_id ); ?>" name="menu-item-megamenu_padding_left" / value="<?php echo esc_attr( $megamenu_padding_left ); ?>" >
									<span class="ast-spacing-title"> <?php esc_html_e( 'Left', 'astra-addon' ); ?> </span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="astra-mm-cta-wrap">
				<div class="alignright">
					<span class="spinner"></span>
					<a data-label="<?php esc_html_e( 'Save', 'astra-addon' ); ?>" class="button button-primary button-large astra-megamenu-save-opts"><?php esc_html_e( 'Save', 'astra-addon' ); ?></a>
					<a class="button button-primary button-large astra-megamenu-cancel-btn">		<?php esc_html_e( 'Cancel', 'astra-addon' ); ?>
					</a>
				</div>
			</div>
			<?php

			$html = ob_get_clean();

			wp_send_json_success( $html );
		}

		/**
		 * Save menu item meta options.
		 *
		 * @return void
		 * @since 1.6.0
		 */
		public function save_menu_options() {

			$menu_id = sanitize_text_field( $_POST['menu_item_id'] );

			check_ajax_referer( 'ast-save-opts-' . $menu_id, 'security_nonce' );

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_die();
			}

			$nav_id  = sanitize_text_field( $_POST['nav_id'] );
			$fields  = isset( $_POST['options'] ) ? $_POST['options'] : array();
			$widgets = isset( $_POST['widgets'] ) ? $_POST['widgets'] : array();

			if ( ! empty( $widgets ) ) {
				$fields['megamenu_widgets_list'] = implode( ',', $widgets );
			}

			if ( ! empty( $fields ) ) {
				// Update meta values.
				foreach ( $fields as $key => $value ) {

					$key = sanitize_text_field( str_replace( 'menu-item-', '', $key ) );

					if ( 'megamenu_custom_text' == $key ) {
						$value = wp_kses_post( wp_unslash( $value ) );
					} else {

						$value = sanitize_text_field( wp_unslash( $value ) );
					}

					update_post_meta( $menu_id, '_menu_item_' . $key, $value );
				}
			}

			wp_send_json_success();
		}

		/**
		 * Add Body Classes
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function body_classes( $classes ) {

			if ( ! wp_is_mobile() ) {
				$classes[] = 'ast-desktop';
			}

			return $classes;
		}
	}
}

new Astra_Ext_Nav_Menu_Markup();
