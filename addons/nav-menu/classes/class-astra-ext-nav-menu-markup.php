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
	// @codingStandardsIgnoreStart
	final class Astra_Ext_Nav_Menu_Markup {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
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
				add_action( 'admin_footer', array( $this, 'add_mega_menu_wrap' ) );
				add_action( 'admin_footer', array( $this, 'dynamic_mega_menu_css' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'register_mega_menu_script' ) );
			}

			add_action( 'rest_api_init', array( $this, 'create_rest_routes' ) );
		}

		/**
		 * Add global palette to admin section.
		 *
		 * @since 4.0.0
		 */
		public function dynamic_mega_menu_css() {
			$css        = '';
			$inline_css = array(
				':root' => Astra_Global_Palette::generate_global_palette_style(),
			);

			$css .= astra_parse_css( $inline_css );

			?>
				<style>
					<?php echo esc_html( $css ); ?>
				</style>
			<?php
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
		 * @param int    $id menu item id.
		 * @param object $item A single menu item.
		 * @param int    $depth menu item depth.
		 * @param array  $args menu item arguments.
		 * @return void.
		 */
		public function add_custom_fields( $id, $item, $depth, $args ) {
			$item_title = isset( $item->title ) ? $item->title : '';
			?>

			<input type="hidden" class="ast-nonce-field" value="<?php echo esc_attr( wp_create_nonce( 'ast-render-opts-' . $id ) ); ?>">

			<p class="description description-wide">
				<a class="button button-secondary button-large astra-megamenu-opts-btn" data-depth="<?php echo esc_attr( $depth ); ?>" data-menu-id="<?php echo esc_attr( $id ); ?>" data-menu-title="<?php echo esc_attr( $item_title ); ?>">
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
		 * @param object $menu_item A single menu item.
		 * @return object The menu item.
		 */
		public function add_custom_fields_meta( $menu_item ) {

			// Bail early if the ID property is not set to prevent warnings or errors.
			if ( ! isset( $menu_item->ID ) ) {
				return $menu_item;
			}

			$menu_item->megamenu                  = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
			$menu_item->megamenu_width            = get_post_meta( $menu_item->ID, '_menu_item_megamenu_width', true );
			$menu_item->megamenu_col              = get_post_meta( $menu_item->ID, '_menu_item_megamenu_col', true );
			$menu_item->megamenu_text_color       = get_post_meta( $menu_item->ID, '_menu_item_megamenu_text_color', true );
			$menu_item->megamenu_text_h_color     = get_post_meta( $menu_item->ID, '_menu_item_megamenu_text_h_color', true );
			$menu_item->megamenu_background_image = get_post_meta( $menu_item->ID, '_menu_item_megamenu_background_image', true );
			$menu_item->megamenu_bg_size          = get_post_meta( $menu_item->ID, '_menu_item_megamenu_bg_size', true );
			$menu_item->megamenu_bg_repeat        = get_post_meta( $menu_item->ID, '_menu_item_megamenu_bg_repeat', true );
			$menu_item->megamenu_bg_position      = get_post_meta( $menu_item->ID, '_menu_item_megamenu_bg_position', true );
			$menu_item->megamenu_bg_color         = get_post_meta( $menu_item->ID, '_menu_item_megamenu_bg_color', true );
			$menu_item->megamenu_highlight_label  = get_post_meta( $menu_item->ID, '_menu_item_megamenu_highlight_label', true );

			$menu_item->megamenu_icon_source          = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item->ID );
			$menu_item->megamenu_icon_position        = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_position', $menu_item->ID );
			$menu_item->megamenu_icon_spacing         = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_spacing', $menu_item->ID );
			$menu_item->megamenu_icon_view            = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_view', $menu_item->ID );
			$menu_item->megamenu_icon_primary_color   = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_primary_color', $menu_item->ID );
			$menu_item->megamenu_icon_secondary_color = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_secondary_color', $menu_item->ID );
			$menu_item->megamenu_icon_padding         = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_padding', $menu_item->ID );
			$menu_item->megamenu_icon_corner_radius   = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_corner_radius', $menu_item->ID );
			$menu_item->megamenu_icon_border_width    = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_border_width', $menu_item->ID );
			$menu_item->megamenu_icon_size            = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_size', $menu_item->ID );

			$menu_item->megamenu_label_color              = get_post_meta( $menu_item->ID, '_menu_item_megamenu_label_color', true );
			$menu_item->megamenu_label_bg_color           = get_post_meta( $menu_item->ID, '_menu_item_megamenu_label_bg_color', true );
			$menu_item->megamenu_column_divider_color     = get_post_meta( $menu_item->ID, '_menu_item_megamenu_column_divider_color', true );
			$menu_item->megamenu_heading_seeparator_color = get_post_meta( $menu_item->ID, '_menu_item_megamenu_heading_seeparator_color', true );
			$menu_item->megamenu_content_src              = get_post_meta( $menu_item->ID, '_menu_item_megamenu_content_src', true );
			$menu_item->megamenu_custom_text              = get_post_meta( $menu_item->ID, '_menu_item_megamenu_custom_text', true );
			$menu_item->megamenu_disable_title            = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'disable_title', $menu_item->ID );
			$menu_item->megamenu_enable_heading           = get_post_meta( $menu_item->ID, '_menu_item_megamenu_enable_heading', true );
			$menu_item->megamenu_disable_link             = get_post_meta( $menu_item->ID, '_menu_item_megamenu_disable_link', true );
			$menu_item->megamenu_widgets_list             = get_post_meta( $menu_item->ID, '_menu_item_megamenu_widgets_list', true );
			$menu_item->megamenu_template                 = get_post_meta( $menu_item->ID, '_menu_item_megamenu_template', true );
			$menu_item->custom_width                      = get_post_meta( $menu_item->ID, '_menu_item_megamenu_custom_width', true );

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

			require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/class-astra-walker-nav-menu-edit-custom.php';
			return 'Astra_Walker_Nav_Menu_Edit_Custom';
		}

		/**
		 * Function to load custom navigation walker.
		 *
		 * @return void.
		 */
		public static function load_walker() {
			require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/class-astra-custom-nav-walker.php';
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
						$title .= 0 != $query->post->post_parent ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
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
			// If primary menu is set then enable mega menu.
			if ( has_nav_menu( 'primary' ) ) {
				add_filter( 'astra_primary_menu_classes', array( $this, 'add_primary_menu_classes' ) );
			}
			// If secondary menu is set then enable mega menu.
			if ( has_nav_menu( 'secondary_menu' ) ) {
				add_filter( 'astra_secondary_menu_menu_classes', array( $this, 'add_primary_menu_classes' ) );
			}

			// If there are other menus having mega menu support.
			$mega_menu_custom_navmenus = apply_filters( 'astra_nav_mega_menu_support', array() );
			if ( ! empty( $mega_menu_custom_navmenus ) && is_array( $mega_menu_custom_navmenus ) ) {
				foreach ( $mega_menu_custom_navmenus as $menu_id ) {
					if ( has_nav_menu( $menu_id ) ) {
						add_filter( 'astra_' . $menu_id . '_menu_classes', array( $this, 'add_primary_menu_classes' ) );
					}
				}
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
		public function add_mega_menu_wrap() {
			astra_addon_get_template( 'nav-menu/template/canvas.php' );
		}

		/**
		 * Creating rest routes for mega menu
		 *
		 * @since 4.0.0
		 * @return void
		 */
		public function create_rest_routes() {

			register_rest_route(
				'astra_addon/v1',
				'/mega_menu/(?P<id>\d+)',
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_mega_menu_option' ),
					'permission_callback' => array( $this, 'get_mega_menu_option_permission' ),
				)
			);

			register_rest_route(
				'astra_addon/v1',
				'/mega_menu',
				array(
					'methods'             => WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'set_mega_menu_option' ),
					'permission_callback' => array( $this, 'set_mega_menu_option_permission' ),
				)
			);
		}

		/**
		 * Checking permissions
		 *
		 * @since 4.0.0
		 * @return bool
		 */
		public function get_mega_menu_option_permission() {
			return true;
		}

		/**
		 * Checking permissions
		 *
		 * @since 4.0.0
		 */
		public function set_mega_menu_option_permission() {
			return current_user_can( 'edit_theme_options' );
		}

		/**
		 * Mega set configs
		 *
		 * @param array $req Megamenu request payload.
		 * @return string
		 * @since 4.0.0
		 */
		public function set_mega_menu_option( $req ) {

			$fields  = isset( $req['options'] ) ? $req['options'] : array();
			$menu_id = isset( $req['menu_id'] ) ? sanitize_text_field( $req['menu_id'] ) : '';
			$widgets = isset( $req['widgets'] ) ? $req['widgets'] : array();

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_die();
			}

			if ( ! empty( $widgets ) ) {
				$fields['megamenu_widgets_list'] = implode( ',', $widgets );
			}

			if ( ! empty( $fields ) ) {
				// Update meta values.
				foreach ( $fields as $key => $value ) {

					$key = sanitize_text_field( str_replace( 'menu-item-', '', $key ) );

					if ( 'megamenu_custom_text' === $key ) {
						$value = wp_kses_post( wp_unslash( $value ) );
					} else {
						$value = wp_unslash( $value );
					}

					update_post_meta( $menu_id, '_menu_item_' . $key, $value );
				}
			}

			return rest_ensure_response( 'success' );
		}

		/**
		 * Mega menu configs
		 *
		 * @param array $data Megamenu id.
		 * @return array
		 * @since 4.0.0
		 */
		public function get_mega_menu_option( $data ) {

			$menu_item_id = $data['id'];

			$_config = array(

				// Option: As Heading.
				array(
					'name'            => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_enable_heading',
					'defaults'        => get_post_meta( $menu_item_id, '_menu_item_megamenu_enable_heading', true ),
					'control'         => 'ast-toggle',
					'title'           => __( 'As Heading', 'astra-addon' ),
					'custom_value'    => 'enable-heading',
					'divider'         => 'top-spacing',
					'tab_type'        => 'general',
					'depth'           => 1,
					'trigger_context' => array(
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_heading_separator_color',
							'value'   => array( 'enable-heading' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_mega_menu_label_title',
							'value'   => array( 'enable-heading' ),
						),
					),
				),

				// Option: Heading Mega Menu for sub menu.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_mega_menu_label_title',
					'control'  => 'ast-title',
					'title'    => __( 'Mega Menu', 'astra-addon' ),
					'divider'  => 'top-spacing',
					'tab_type' => 'design',
					'depth'    => 1,
					'context'  => array(
						array(
							'value'        => array( 'enable-heading' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_enable_heading', true ),
						),
					),
				),

				// Option: Separator Color.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_heading_separator_color',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_heading_separator_color', true ),
					'control'  => 'ast-color',
					'title'    => __( 'Separator Color', 'astra-addon' ),
					'tab_type' => 'design',
					'depth'    => 1,
					'context'  => array(
						array(
							'value'        => array( 'enable-heading' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_enable_heading', true ),
						),
					),
				),

				// Option: Hide Label.
				array(
					'name'            => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_disable_title',
					'defaults'        => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'disable_title', $menu_item_id ),
					'control'         => 'ast-toggle',
					'title'           => __( 'Hide Menu Label', 'astra-addon' ),
					'custom_value'    => 'disable-title',
					'divider'         => '',
					'tab_type'        => 'general',
					'depth'           => 1,
					'trigger_context' => array(
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_disable_link',
							'value'   => array( '' ),
						),
					),
				),

				// Option: Disable Link.
				array(
					'name'         => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_disable_link',
					'defaults'     => get_post_meta( $menu_item_id, '_menu_item_megamenu_disable_link', true ),
					'control'      => 'ast-toggle',
					'title'        => __( 'Disable Link', 'astra-addon' ),
					'custom_value' => 'disable-link',
					'divider'      => '',
					'tab_type'     => 'general',
					'depth'        => 1,
					'context'      => array(
						array(
							'value'        => array( '' ),
							'target_value' => strval( Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'disable_title', $menu_item_id ) ),
						),
					),
				),

				// Option: Enable Mega Menu toggle.
				array(
					'name'            => ASTRA_THEME_SETTINGS . '_menu_item_megamenu',
					'defaults'        => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
					'control'         => 'ast-toggle',
					'divider'         => 'top-spacing',
					'custom_value'    => 'megamenu',
					'title'           => __( 'Mega Menu', 'astra-addon' ),
					'tab_type'        => 'general',
					'as_heading'      => true,
					'depth'           => 0,
					'trigger_context' => array(
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_width',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_background_type_title',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_image',
							'value'            => array( 'megamenu' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_color',
							'value'            => array( 'megamenu' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_repeat',
							'value'            => array( 'megamenu' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_size',
							'value'            => array( 'megamenu' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_position',
							'value'            => array( 'megamenu' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_gradient',
							'value'            => array( 'megamenu' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'gradient' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_margin',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_padding',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_spacing_title',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_top_border_width',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_column_divider_width',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_row_divider_width',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_top_border_color',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_column_divider_color',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_divider_style',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_divider_title',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_color_label_title',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_text_color_group',
							'value'   => array( 'megamenu' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_heading_color_group',
							'value'   => array( 'megamenu' ),
						),
					),
				),

				// Option: Mega Menu Width.
				array(
					'name'            => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_width',
					'defaults'        => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'width', $menu_item_id ),
					'control'         => 'ast-select',
					'title'           => __( 'Mega Menu Width', 'astra-addon' ),
					'divider'         => '',
					'choices'         => array(
						'content'        => __( 'Content', 'astra-addon' ),
						'menu-container' => __( 'Menu Container Width', 'astra-addon' ),
						'full'           => __( 'Full Width', 'astra-addon' ),
						'full-stretched' => __( 'Full Width Stretched', 'astra-addon' ),
						'custom'         => __( 'Custom Width', 'astra-addon' ),
					),
					'trigger_context' => array(
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_custom_width',
							'value'   => array( 'custom' ),
						),
					),
					'context'         => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
					'tab_type'        => 'general',
					'depth'           => 0,
				),

				// Option: Icon spacing.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_custom_width',
					'defaults'    => get_post_meta( $menu_item_id, '_menu_item_megamenu_custom_width', true ),
					'control'     => 'ast-slider',
					'title'       => __( 'Custom Width', 'astra-addon' ),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 1920,
					),
					'tab_type'    => 'general',
					'depth'       => '0',
					'context'     => array(
						array(
							'value'        => array( 'custom' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_width', true ),
						),
					),
				),

				// Option: Icon Heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_icon_label_title',
					'control'  => 'ast-title',
					'title'    => __( 'Icon', 'astra-addon' ),
					'divider'  => 'ast-top-section-divider',
					'tab_type' => 'general',
					'depth'    => 'all',
				),

				// Option: Icon source.
				array(
					'name'            => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_source',
					'defaults'        => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
					'title'           => __( 'Icon', 'astra-addon' ),
					'control'         => 'ast-icon',
					'tab_type'        => 'general',
					'depth'           => 'all',
					'trigger_context' => array(
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_position',
							'value'   => array( 'image', 'icon' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_size',
							'value'   => array( 'image', 'icon' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_spacing',
							'value'   => array( 'image', 'icon' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_icon_label_title_design',
							'value'   => array( 'image', 'icon' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'value'   => array( 'image', 'icon' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_primary_color',
							'value'   => array( 'image', 'icon' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_secondary_color',
							'value'            => array( 'image', 'icon' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'dependency_value' => array( 'stacked', 'framed' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_padding',
							'value'            => array( 'image', 'icon' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'dependency_value' => array( 'stacked', 'framed' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_border_width',
							'value'            => array( 'image', 'icon' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'dependency_value' => array( 'framed' ),
						),
						array(
							'setting'          => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_corner_radius',
							'value'            => array( 'image', 'icon' ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'dependency_value' => array( 'stacked', 'framed' ),
						),
					),
				),

				// Option: Icon position.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_position',
					'defaults' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_position', $menu_item_id ),
					'control'  => 'ast-select',
					'title'    => __( 'Icon Position', 'astra-addon' ),
					'choices'  => array(
						'before-label' => __( 'Before Menu Label', 'astra-addon' ),
						'after-label'  => __( 'After Menu Label', 'astra-addon' ),
					),
					'tab_type' => 'general',
					'depth'    => 'all',
					'context'  => array(
						array(
							'value'        => array( 'image', 'icon' ),
							'target_value' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
						),
					),
				),

				// Option: Icon size.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_size',
					'control'     => 'ast-slider',
					'defaults'    => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_size', $menu_item_id ),
					'title'       => __( 'Size', 'astra-addon' ),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
					'tab_type'    => 'general',
					'depth'       => 'all',
					'context'     => array(
						array(
							'value'        => array( 'image', 'icon' ),
							'target_value' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
						),
					),
				),

				// Option: Icon spacing.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_spacing',
					'defaults'    => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_spacing', $menu_item_id ),
					'control'     => 'ast-slider',
					'title'       => __( 'Icon Spacing', 'astra-addon' ),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
					'tab_type'    => 'general',
					'depth'       => 'all',
					'context'     => array(
						array(
							'value'        => array( 'image', 'icon' ),
							'target_value' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
						),
					),
				),

				// Option: Content source heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_content_source_title',
					'control'  => 'ast-title',
					'title'    => __( 'Content Source', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'general',
					'divider'  => 'ast-top-section-divider',
					'depth'    => 1,
				),

				// Option: Content source.
				array(
					'name'            => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_content_src',
					'defaults'        => get_post_meta( $menu_item_id, '_menu_item_megamenu_content_src', true ),
					'control'         => 'ast-select',
					'title'           => __( 'Content Source', 'astra-addon' ),
					'divider'         => '',
					'choices'         => array(
						'default'     => __( 'Default', 'astra-addon' ),
						'custom_text' => __( 'Custom Text', 'astra-addon' ),
						'template'    => __( 'Template', 'astra-addon' ),
						'widget'      => __( 'Widget', 'astra-addon' ),
					),
					'tab_type'        => 'general',
					'depth'           => 1,
					'trigger_context' => array(
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_widget_list',
							'value'   => array( 'widget' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_template',
							'value'   => array( 'template' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_custom_text',
							'value'   => array( 'custom_text' ),
						),
					),
				),

				// Option: Widget list.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_widget_list',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_widget_list', true ),
					'control'  => 'ast-widget',
					'title'    => __( 'Widget List', 'astra-addon' ),
					'tab_type' => 'general',
					'depth'    => 1,
					'context'  => array(
						array(
							'value'        => array( 'widget' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_content_src', true ),
						),
					),
				),

				// Option: Select template.
				array(
					'name'           => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_template',
					'defaults'       => get_post_meta( $menu_item_id, '_menu_item_megamenu_template', true ),
					'control'        => 'ast-template',
					'defaults_title' => get_the_title( (int) get_post_meta( $menu_item_id, '_menu_item_megamenu_template', true ) ),
					'title'          => __( 'Template', 'astra-addon' ),
					'tab_type'       => 'general',
					'depth'          => 1,
					'context'        => array(
						array(
							'value'        => array( 'template' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_content_src', true ),
						),
					),
				),

				// Option: Custom text field.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_custom_text',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_custom_text', true ),
					'control'  => 'ast-textarea',
					'title'    => __( 'Custom Text', 'astra-addon' ),
					'tab_type' => 'general',
					'depth'    => 1,
					'context'  => array(
						array(
							'value'        => array( 'custom_text' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_content_src', true ),
						),
					),
				),

				// Option: Highlight heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_highlight_label_title',
					'control'  => 'ast-title',
					'title'    => __( 'Highlight Labels', 'astra-addon' ),
					'divider'  => 'ast-top-section-divider',
					'tab_type' => 'general',
					'depth'    => 'all',
				),

				// Option: Menu highlight label input.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_highlight_label',
					'defaults'    => get_post_meta( $menu_item_id, '_menu_item_megamenu_highlight_label', true ),
					'control'     => 'ast-text',
					'title'       => __( 'Menu Highlight Label', 'astra-addon' ),
					'description' => __( 'Change menu highlight label text', 'astra-addon' ),
					'divider'     => '',
					'tab_type'    => 'general',
					'depth'       => 'all',
				),

				// Option: Background type heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_background_type_title',
					'control'  => 'ast-title',
					'title'    => __( 'Background Type', 'astra-addon' ),
					'divider'  => 'top-spacing',
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Background type.
				array(
					'name'            => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
					'defaults'        => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'bg_type', $menu_item_id ),
					'control'         => 'ast-background-type',
					'title'           => __( 'Background Type', 'astra-addon' ),
					'divider'         => '',
					'tab_type'        => 'design',
					'depth'           => 0,
					'context'         => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
					'trigger_context' => array(
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_gradient',
							'value'   => array( 'gradient' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_image',
							'value'   => array( 'image' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_color',
							'value'   => array( 'image' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_repeat',
							'value'   => array( 'image' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_size',
							'value'   => array( 'image' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_position',
							'value'   => array( 'image' ),
						),
					),
				),

				// Option: Background color.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_color',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_bg_color', true ),
					'control'  => 'ast-color',
					'title'    => __( 'Color', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'image' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_background_type', true ),
						),
						array(
							'value'            => array( 'megamenu' ),
							'target_value'     => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
					),
				),

				// Option: Background gradient.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_gradient',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_gradient', true ),
					'control'  => 'ast-gradient',
					'title'    => __( 'Image', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'gradient' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_background_type', true ),
						),
						array(
							'value'            => array( 'megamenu' ),
							'target_value'     => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'gradient' ),
						),
					),
				),

				// Option: Background image.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_image',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_background_image', true ),
					'control'  => 'ast-image',
					'title'    => __( 'Image', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'image' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_background_type', true ),
						),
						array(
							'value'            => array( 'megamenu' ),
							'target_value'     => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
					),
				),

				// Option: Background repeat.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_repeat',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_bg_repeat', true ),
					'control'  => 'ast-select',
					'choices'  => array(
						'no-repeat' => __( 'No Repeat', 'astra-addon' ),
						'repeat'    => __( 'Repeat All', 'astra-addon' ),
						'repeat-x'  => __( 'Repeat Horizontally	', 'astra-addon' ),
						'repeat-y'  => __( 'Repeat Vertically', 'astra-addon' ),
					),
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'image' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_background_type', true ),
						),
						array(
							'value'            => array( 'megamenu' ),
							'target_value'     => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
					),
				),

				// Option: Background size.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_size',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_bg_size', true ),
					'control'  => 'ast-select',
					'choices'  => array(
						'auto'    => __( 'Auto', 'astra-addon' ),
						'cover'   => __( 'Cover', 'astra-addon' ),
						'contain' => __( 'Contain', 'astra-addon' ),
					),
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'image' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_background_type', true ),
						),
						array(
							'value'            => array( 'megamenu' ),
							'target_value'     => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
					),
				),

				// Option: Background position.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_bg_position',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_bg_position', true ),
					'control'  => 'ast-select',
					'choices'  => array(
						'left top'      => __( 'Left Top', 'astra-addon' ),
						'left center'   => __( 'Left Center', 'astra-addon' ),
						'left bottom'   => __( 'Left Bottom	', 'astra-addon' ),
						'right top'     => __( 'Right Top', 'astra-addon' ),
						'right center'  => __( 'Right Center', 'astra-addon' ),
						'right bottom'  => __( 'Right Bottom', 'astra-addon' ),
						'center top'    => __( 'Center Top', 'astra-addon' ),
						'center center' => __( 'Center Center', 'astra-addon' ),
						'center bottom' => __( 'Center Bottom', 'astra-addon' ),
					),
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'image' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_background_type', true ),
						),
						array(
							'value'            => array( 'megamenu' ),
							'target_value'     => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_background_type',
							'dependency_value' => array( 'image' ),
						),
					),
				),

				// Option: Color heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_color_label_title',
					'control'  => 'ast-title',
					'title'    => __( 'Colors', 'astra-addon' ),
					'tab_type' => 'design',
					'divider'  => 'ast-top-section-divider',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Heading color.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_heading_color_group',
					'defaults'  => get_post_meta( $menu_item_id, '_menu_item_megamenu_heading_color_group', true ),
					'control'   => 'ast-color',
					'title'     => __( 'Heading', 'astra-addon' ),
					'link_to'   => 'panel-header-builder-group',
					'divider'   => '',
					'depth'     => 0,
					'tab_type'  => 'design',
					'has_hover' => true,
					'context'   => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Text/Link text color.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_text_color_group',
					'defaults'  => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'text_color', $menu_item_id ),
					'control'   => 'ast-color',
					'title'     => __( 'Text/Link', 'astra-addon' ),
					'tab_type'  => 'design',
					'depth'     => 0,
					'has_hover' => true,
					'context'   => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Icon heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_icon_label_title_design',
					'control'  => 'ast-title',
					'title'    => __( 'Icon', 'astra-addon' ),
					'tab_type' => 'design',
					'divider'  => 'ast-top-section-divider',
					'depth'    => 'all',
					'context'  => array(
						array(
							'value'        => array( 'image', 'icon' ),
							'target_value' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
						),
					),
				),

				// Option: Icon view type.
				array(
					'name'            => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
					'defaults'        => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_view', $menu_item_id ),
					'control'         => 'ast-select',
					'title'           => __( 'View', 'astra-addon' ),
					'choices'         => array(
						'default' => __( 'Default', 'astra-addon' ),
						'stacked' => __( 'Stacked', 'astra-addon' ),
						'framed'  => __( 'Framed', 'astra-addon' ),
					),
					'tab_type'        => 'design',
					'depth'           => 'all',
					'trigger_context' => array(
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_secondary_color',
							'value'   => array( 'stacked', 'framed' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_padding',
							'value'   => array( 'stacked', 'framed' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_corner_radius',
							'value'   => array( 'stacked', 'framed' ),
						),
						array(
							'setting' => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_border_width',
							'value'   => array( 'framed' ),
						),
					),
					'context'         => array(
						array(
							'value'        => array( 'image', 'icon' ),
							'target_value' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
						),
					),

				),

				// Option: Icon primary color.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_primary_color',
					'defaults' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_primary_color', $menu_item_id ),
					'control'  => 'ast-color',
					'title'    => __( 'Primary Color', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 'all',
					'context'  => array(
						array(
							'value'        => array( 'image', 'icon' ),
							'target_value' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
						),
					),
				),

				// Option: Icon secondary color.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_secondary_color',
					'defaults' => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_secondary_color', $menu_item_id ),
					'control'  => 'ast-color',
					'title'    => __( 'Secondary Color', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 'all',
					'context'  => array(
						array(
							'value'        => array( 'stacked' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_icon_view', true ),
						),
						array(
							'value'        => array( 'framed' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_icon_view', true ),
						),
						array(
							'value'            => array( 'image', 'icon' ),
							'target_value'     => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'dependency_value' => array( 'stacked', 'framed' ),
						),
					),
				),

				// Option: Icon padding.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_padding',
					'control'     => 'ast-slider',
					'defaults'    => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_padding', $menu_item_id ),
					'title'       => __( 'Padding', 'astra-addon' ),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
					'tab_type'    => 'design',
					'depth'       => 'all',
					'context'     => array(
						array(
							'value'        => array( 'stacked' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_icon_view', true ),
						),
						array(
							'value'        => array( 'framed' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_icon_view', true ),
						),
						array(
							'value'            => array( 'image', 'icon' ),
							'target_value'     => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'dependency_value' => array( 'stacked', 'framed' ),
						),
					),
				),

				// Option: Icon border width.
				array(
					'name'           => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_border_width',
					'defaults'       => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_border_width', $menu_item_id ),
					'type'           => 'control',
					'control'        => 'ast-spacing',
					'title'          => __( 'Border Width', 'astra-addon' ),
					'linked_choices' => true,
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'suffix'         => 'px',
					'connected'      => false,
					'tab_type'       => 'design',
					'responsive'     => false,
					'depth'          => 'all',
					'context'        => array(
						array(
							'value'        => array( 'framed' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_icon_view', true ),
						),
						array(
							'value'            => array( 'image', 'icon' ),
							'target_value'     => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'dependency_value' => array( 'framed' ),
						),
					),
				),

				// Option: Icon border radius.
				array(
					'name'           => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_corner_radius',
					'defaults'       => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_corner_radius', $menu_item_id ),
					'type'           => 'control',
					'control'        => 'ast-spacing',
					'suffix'         => 'px',
					'title'          => __( 'Corner Radius', 'astra-addon' ),
					'linked_choices' => true,
					'choices'        => array(
						'top-left'     => __( 'Top left', 'astra-addon' ),
						'top-right'    => __( 'Top Right', 'astra-addon' ),
						'bottom-left'  => __( 'Bottom Left', 'astra-addon' ),
						'bottom-right' => __( 'Bottom Right', 'astra-addon' ),
					),
					'connected'      => false,
					'tab_type'       => 'design',
					'responsive'     => false,
					'depth'          => 'all',
					'context'        => array(
						array(
							'value'        => array( 'stacked' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_icon_view', true ),
						),
						array(
							'value'        => array( 'framed' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu_icon_view', true ),
						),
						array(
							'value'            => array( 'image', 'icon' ),
							'target_value'     => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'icon_source', $menu_item_id ),
							'dependency'       => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_icon_view',
							'dependency_value' => array( 'stacked', 'framed' ),
						),
					),
				),

				// Option: Divider Heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_divider_title',
					'control'  => 'ast-title',
					'title'    => __( 'Divider', 'astra-addon' ),
					'divider'  => 'ast-top-section-divider',
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Divider style.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_divider_style',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_divider_style', true ),
					'control'  => 'ast-select',
					'title'    => __( 'Style', 'astra-addon' ),
					'choices'  => array(
						'solid'  => __( 'Solid', 'astra-addon' ),
						'dotted' => __( 'Dotted', 'astra-addon' ),
						'dashed' => __( 'Dashed', 'astra-addon' ),
						'double' => __( 'Double', 'astra-addon' ),
						'none'   => __( 'None', 'astra-addon' ),
					),
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option:  Top Border width.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_top_border_width',
					'control'     => 'ast-slider',
					'defaults'    => get_post_meta( $menu_item_id, '_menu_item_megamenu_top_border_width', true ),
					'title'       => __( 'Top Border Width', 'astra-addon' ),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
					'tab_type'    => 'design',
					'depth'       => 0,
					'context'     => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Column Divider width.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_column_divider_width',
					'defaults'    => get_post_meta( $menu_item_id, '_menu_item_megamenu_column_divider_width', true ),
					'control'     => 'ast-slider',
					'title'       => __( 'Column Width', 'astra-addon' ),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
					'tab_type'    => 'design',
					'depth'       => 0,
					'context'     => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Row Divider width.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_row_divider_width',
					'control'     => 'ast-slider',
					'defaults'    => get_post_meta( $menu_item_id, '_menu_item_megamenu_row_divider_width', true ),
					'title'       => __( 'Row Width', 'astra-addon' ),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
					'tab_type'    => 'design',
					'depth'       => 0,
					'context'     => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Top Border.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_top_border_color',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_top_border_color', true ),
					'control'  => 'ast-color',
					'title'    => __( 'Top Border', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Divider column color.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_column_divider_color',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_column_divider_color', true ),
					'control'  => 'ast-color',
					'title'    => __( 'Column Divider', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Highlight Labels heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_highlight_labels_title',
					'control'  => 'ast-title',
					'title'    => __( 'Highlight Labels', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'divider'  => 'ast-top-section-divider',
					'depth'    => 'all',
				),

				// Option: Highlight Label color.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_label_color',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_label_color', true ),
					'control'  => 'ast-color',
					'title'    => __( 'Highlight Label Color', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 'all',
				),

				// Option: Highlight Label background color.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_label_bg_color',
					'defaults' => get_post_meta( $menu_item_id, '_menu_item_megamenu_label_bg_color', true ),
					'control'  => 'ast-color',
					'title'    => __( 'Background Color', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'depth'    => 'all',
				),

				// Option: Highlight Label spacing heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '_menu_item_spacing_title',
					'control'  => 'ast-title',
					'title'    => __( 'Spacing', 'astra-addon' ),
					'divider'  => '',
					'tab_type' => 'design',
					'divider'  => 'ast-top-section-divider',
					'depth'    => 0,
					'context'  => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Margin.
				array(
					'name'           => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_margin',
					'defaults'       => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'margin', $menu_item_id ),
					'type'           => 'control',
					'control'        => 'ast-spacing',
					'title'          => __( 'Margin', 'astra-addon' ),
					'suffix'         => 'px',
					'linked_choices' => true,
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'connected'      => false,
					'tab_type'       => 'design',
					'responsive'     => false,
					'depth'          => 0,
					'context'        => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

				// Option: Padding.
				array(
					'name'           => ASTRA_THEME_SETTINGS . '_menu_item_megamenu_padding',
					'defaults'       => Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'padding', $menu_item_id ),
					'type'           => 'control',
					'control'        => 'ast-spacing',
					'title'          => __( 'Padding', 'astra-addon' ),
					'suffix'         => 'px',
					'linked_choices' => true,
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'connected'      => false,
					'tab_type'       => 'design',
					'responsive'     => false,
					'depth'          => 0,
					'context'        => array(
						array(
							'value'        => array( 'megamenu' ),
							'target_value' => get_post_meta( $menu_item_id, '_menu_item_megamenu', true ),
						),
					),
				),

			);

			return rest_ensure_response( $_config );
		}

		/**
		 * Register Script for Mega menu.
		 *
		 * @since 4.0.0
		 */
		public function register_mega_menu_script() {
			$path = ASTRA_ADDON_EXT_NAV_MENU_URL . 'react/build/index.js';

			if ( is_rtl() ) {
				$font_icon_picker_css_file = 'font-icon-picker-rtl';
			} else {
				$font_icon_picker_css_file = 'font-icon-picker';
			}

			wp_enqueue_style( 'ahfb-customizer-color-picker-style', ASTRA_THEME_URI . 'inc/assets/css/' . $font_icon_picker_css_file . '.css', array(), ASTRA_EXT_VER );
			wp_enqueue_style( 'astra-customizer-control-css', get_site_url() . '/wp-includes/css/dist/components/style.css', array(), ASTRA_EXT_VER );

			wp_register_script(
				'astra-mega-menu',
				$path,
				array( 'wp-edit-post', 'wp-i18n', 'wp-element' ),
				ASTRA_EXT_VER,
				true
			);

			$widget_obj = Astra_Ext_Nav_Widget_Support::get_instance();

			wp_localize_script(
				'astra-mega-menu',
				'AstraBuilderMegaMenu',
				array(
					'isWP_5_9'                    => astra_wp_version_compare( '5.8.99', '>=' ),
					'nonce'                       => wp_create_nonce( 'wp_rest' ),
					'nonceWidget'                 => wp_create_nonce( 'wp_widget_nonce' ),
					'globalColorPalette'          => astra_get_option( 'global-color-palette' ),
					'globalPaletteStylePrefix'    => Astra_Global_Palette::get_css_variable_prefix(),
					'globalPaletteLabels'         => Astra_Global_Palette::get_palette_labels(),
					'widgets'                     => $widget_obj->get_widget_list(),
					'savingButtonText'            => array(
						'initial' => __( 'Save Changes', 'astra-addon' ),
						'saving'  => __( 'Saving...', 'astra-addon' ),
						'saved'   => __( 'Saved', 'astra-addon' ),
						'error'   => __( 'Error Saving', 'astra-addon' ),
					),
					'oldMegaMenuUrl'              => admin_url( 'customize.php?autofocus[control]=' . ASTRA_THEME_SETTINGS . '[primary-header-megamenu-heading-color]' ),
					'isHeaderFooterBuilderActive' => astra_addon_builder_helper()->is_header_footer_builder_active,
					'newMegaMenuUrl'              => admin_url( 'customize.php?autofocus[panel]=panel-header-builder-group' ),
					'theme_name'                  => astra_get_theme_name(),
				)
			);

			wp_enqueue_script( 'astra-mega-menu' );
			wp_set_script_translations( 'astra-mega-menu', 'astra-addon' );
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
