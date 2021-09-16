<?php
/**
 * Advanced Search - Shortcodes.
 *
 * @package Astra Addon
 * @since 1.4.8
 */

if ( ! class_exists( 'Astra_Ext_Adv_Search_Shortcodes' ) ) {

	/**
	 * Shortcodes Initialization
	 *
	 * @since 1.4.8
	 */
	class Astra_Ext_Adv_Search_Shortcodes {

		/**
		 * Member Variable
		 *
		 * @var instance
		 * @since 1.4.8
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.4.8
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.4.8
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_shortcode( 'astra_search', array( $this, 'search_markup' ) );
		}

		/**
		 * Enqueue scripts
		 *
		 * @since 1.4.8
		 * @return void
		 */
		public function enqueue_scripts() {

			/* Define Variables */
			$uri = ASTRA_EXT_ADVANCED_SEARCH_URL . 'assets/css/';
			$rtl = '';

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

			/*** End Path Logic */

			wp_register_style( 'advanced-search-shortcode', $css_uri . 'advanced-search-shortcode' . $file_prefix . '.css', array(), ASTRA_EXT_VER );
		}

		/**
		 * Search Markup
		 *
		 * @since 1.4.8
		 * @param  array $atts Shortcode parameters.
		 * @return mixed
		 */
		public function search_markup( $atts ) {

			wp_enqueue_style( 'advanced-search-shortcode' );

			$atts = shortcode_atts(
				array(
					'style'     => 'slide',
					'direction' => 'left',
				),
				$atts
			);

			if ( 'inline' === $atts['style'] ) {
				$markup = Astra_Ext_Adv_Search_Markup::get_instance()->get_search_form( 'search-box' );
			} elseif ( 'full-screen' === $atts['style'] ) {
				$markup = '<div class="ast-search-icon"><a class="full-screen astra-search-icon" aria-label="Search icon link" href="#" ></a></div>';
				add_action(
					'wp_footer',
					function() {
						echo Astra_Ext_Adv_Search_Markup::get_instance()->get_search_form( 'full-screen' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				);
			} elseif ( 'cover' === $atts['style'] ) {
				$markup  = '<div class="ast-search-icon"><a class="header-cover astra-search-icon" aria-label="Search icon link" href="#"></a></div>';
				$markup .= Astra_Ext_Adv_Search_Markup::get_instance()->get_search_form( 'header-cover' );
			} else {
				$markup = astra_get_search();
			}

			$classes = array( 'astra-search-shortcode', 'search-custom-menu-item' );

			if ( ! empty( $atts['style'] ) ) {
				$classes[] = $atts['style'];
			}

			if ( ! empty( $atts['direction'] ) ) {
				$classes[] = $atts['direction'];
			}

			$classes = implode( ' ', $classes );
			ob_start();
			?>
			<div class="<?php echo esc_attr( $classes ); ?>">
				<?php echo $markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php
			return ob_get_clean();
		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Adv_Search_Shortcodes::get_instance();
}

