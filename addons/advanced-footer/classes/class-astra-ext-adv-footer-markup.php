<?php
/**
 * Footer Widgets Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Adv_Footer_Markup' ) ) {

	/**
	 * Footer Widgets Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Adv_Footer_Markup {
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

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

			/* Register Footer Widgets */
			add_action( 'init', array( $this, 'register_advanced_footer_widget' ) );

			remove_action( 'astra_footer_content', 'astra_advanced_footer_markup', 1 );
			/* Add HTML Markup */
			add_action( 'astra_footer_content', array( $this, 'html_markup_loader' ), 1 );

			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );

			/**
			 * Metabox setup
			 */
			add_filter( 'astra_meta_box_options', array( $this, 'add_options' ) );
			add_action( 'astra_meta_box_markup_disable_sections_after', array( $this, 'add_options_markup' ) );
		}

		/**
		 * Add Meta Options
		 *
		 * @param array $meta_option Page Meta.
		 * @return array
		 */
		public function add_options( $meta_option ) {

			if ( ! isset( $meta_option['footer-adv-display'] ) ) {
				$meta_option['footer-adv-display'] = array(
					'sanitize' => 'FILTER_SANITIZE_STRING',
				);
			}
			return $meta_option;
		}

		/**
		 * Register Footer Widgets
		 */
		public function register_advanced_footer_widget() {

			/**
			 * Register Footer Widgets area
			 */
			register_sidebar(
				apply_filters(
					'astra_advanced_footer_widget_1_args',
					array(
						'name'          => esc_html__( 'Footer Widget Area 1', 'astra-addon' ),
						'id'            => 'advanced-footer-widget-1',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				)
			);

			register_sidebar(
				apply_filters(
					'astra_advanced_footer_widget_2_args',
					array(
						'name'          => esc_html__( 'Footer Widget Area 2', 'astra-addon' ),
						'id'            => 'advanced-footer-widget-2',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				)
			);

			register_sidebar(
				apply_filters(
					'astra_advanced_footer_widget_3_args',
					array(
						'name'          => esc_html__( 'Footer Widget Area 3', 'astra-addon' ),
						'id'            => 'advanced-footer-widget-3',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				)
			);

			register_sidebar(
				apply_filters(
					'astra_advanced_footer_widget_4_args',
					array(
						'name'          => esc_html__( 'Footer Widget Area 4', 'astra-addon' ),
						'id'            => 'advanced-footer-widget-4',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				)
			);

			register_sidebar(
				apply_filters(
					'astra_advanced_footer_widget_5_args',
					array(
						'name'          => esc_html__( 'Footer Widget Area 5', 'astra-addon' ),
						'id'            => 'advanced-footer-widget-5',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				)
			);
		}

		/**
		 * Footer Widgets markup loader
		 *
		 * Loads appropriate template file based on the style option selected in options panel.
		 *
		 * @since 1.0.0
		 */
		public function html_markup_loader() {

			$advanced_footer_layout = astra_get_option( 'footer-adv' );
			$advanced_footer_meta   = astra_get_option_meta( 'footer-adv-display' );

			if ( apply_filters( 'astra_advanced_footer_disable', false ) || 'disabled' == $advanced_footer_layout || 'disabled' == $advanced_footer_meta ) {
				return;
			}

			// Add markup.
			astra_addon_get_template( 'advanced-footer/template/' . esc_attr( $advanced_footer_layout ) . '.php' );
		}

		/**
		 * Footer Widgets Meta Field markup
		 *
		 * Loads appropriate template file based on the style option selected in options panel.
		 *
		 * @param array $meta Page Meta.
		 * @since 1.0.0
		 */
		public function add_options_markup( $meta ) {

			if ( ! isset( $meta['footer-adv-display'] ) ) {

				/**
				 * Get options
				 */
				$footer_adv = astra_get_option( 'footer-adv' );
				if ( 'disabled' != $footer_adv ) {
					$advanced_footer = isset( $meta['footer-adv-display']['default'] ) ? $meta['footer-adv-display']['default'] : 'default';
					?>
				<span>
					<input type="checkbox" id="footer-adv-display" name="footer-adv-display" value="disabled" <?php checked( $advanced_footer, 'disabled' ); ?> />
					<label for="footer-adv-display"><?php esc_html_e( 'Disable Footer Widgets', 'astra-addon' ); ?></label> <br />
				</span>
					<?php

				}
			}
		}

		/**
		 * Add Styles Callback
		 */
		public function add_styles() {

			$advanced_footer_layout = astra_get_option( 'footer-adv' );
			if ( 'disabled' == $advanced_footer_layout ) {
				return;
			}

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_ADVANCED_FOOTER_URL . 'assets/css/';
			$path = ASTRA_ADDON_EXT_ADVANCED_FOOTER_DIR . 'assets/css/';
			$rtl  = '';

			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			/* Directory and Extension */
			$file_prefix = $rtl . '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = $rtl;
				$dir_name    = 'unminified';
			}

			$css_uri = $uri . $dir_name . '/';
			$css_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $css_uri;
			} else {
				$gen_path = $css_dir;
			}

			/* End Path Logic */

			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );

			if ( 'layout-2' == $advanced_footer_layout ) {
				return;
			}

			Astra_Minify::add_css( $gen_path . $advanced_footer_layout . $file_prefix . '.css' );
		}

		/**
		 * Add Font Family Callback
		 */
		public function add_fonts() {

			$advanced_footer_layout = astra_get_option( 'footer-adv' );
			if ( 'disabled' == $advanced_footer_layout ) {
				return;
			}

			$font_family_advanced_footer_title   = astra_get_option( 'footer-adv-wgt-title-font-family' );
			$font_weight_advanced_footer_title   = astra_get_option( 'footer-adv-wgt-title-font-weight' );
			$font_family_advanced_footer_content = astra_get_option( 'footer-adv-wgt-content-font-family' );
			$font_weight_advanced_footer_content = astra_get_option( 'footer-adv-wgt-content-font-weight' );

			Astra_Fonts::add_font( $font_family_advanced_footer_title, $font_weight_advanced_footer_title );
			Astra_Fonts::add_font( $font_family_advanced_footer_content, $font_weight_advanced_footer_content );
		}

		/**
		 * Get Footer Default Sidebar
		 *
		 * @param  string $sidebar_id   Sidebar Id..
		 * @return void
		 */
		public static function get_sidebar( $sidebar_id ) {

			if ( is_active_sidebar( $sidebar_id ) ) {
				dynamic_sidebar( $sidebar_id );
			} elseif ( current_user_can( 'edit_theme_options' ) ) {

				global $wp_registered_sidebars;
				$sidebar_name = '';
				if ( isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
					$sidebar_name = $wp_registered_sidebars[ $sidebar_id ]['name'];
				}
				?>
				<div class="widget ast-no-widget-row">
					<h2 class='widget-title'><?php echo esc_html( $sidebar_name ); ?></h2>

					<p class='no-widget-text'>
						<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
							<?php esc_html_e( 'Click here to assign a widget for this area.', 'astra-addon' ); ?>
						</a>
					</p>
				</div>
				<?php
			}
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Adv_Footer_Markup::get_instance();
