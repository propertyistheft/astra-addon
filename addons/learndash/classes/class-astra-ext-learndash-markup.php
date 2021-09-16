<?php
/**
 * LearnDash Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'ASTRA_Ext_LearnDash_Markup' ) ) {

	/**
	 * Advanced Search Markup Initial Setup
	 *
	 * @since 1.3.0
	 */
	class ASTRA_Ext_LearnDash_Markup {

		/**
		 * Member Varible
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
		 * Constructor
		 */
		public function __construct() {

			add_action( 'wp', array( $this, 'llms_learning' ) );
			add_action( 'body_class', array( $this, 'body_class' ) );
			add_action( 'astra_get_css_files', array( $this, 'add_styles' ) );

			// Add LearnDash icon in Menu.
			add_action( 'astra_masthead_content', array( $this, 'learndash_profile_link_enabled' ) );

			// Shortcode.
			add_shortcode( 'astra_learndash_profile_link', array( $this, 'astra_learndash_profile_link_callback' ) );
		}

		/**
		 * LearnDash Profile Link Shortcode.
		 *
		 * @param  array $attrs Shortcode Attrs.
		 * @return mixed
		 */
		public function astra_learndash_profile_link_callback( $attrs ) {

			ob_start();

			$attrs = shortcode_atts(
				array(
					'link' => astra_get_option( 'learndash-profile-link' ),
				),
				$attrs
			);

			$profile_link = esc_attr( $attrs['link'] );

			self::astra_header_learndash( $profile_link );
			return ob_get_clean();
		}

		/**
		 * LearnDash Profile Enabled.
		 *
		 * @return void
		 */
		public function learndash_profile_link_enabled() {

			if ( apply_filters( 'astra_learndash_profile_icon_enable', true ) && astra_get_option( 'learndash-profile-link-enabled' ) ) {
				$profile_link = astra_get_option( 'learndash-profile-link' );
				self::astra_header_learndash( $profile_link );
			}
		}

		/**
		 * Add LearnDash icon markup
		 *
		 * @since 1.3.0
		 * @param  string $profile_link Profile Link.
		 * @return void
		 */
		public static function astra_header_learndash( $profile_link = '' ) {

			if ( is_user_logged_in() ) :
				?>
				<div class="ast-masthead-custom-menu-items learndash-custom-menu-item">
					<div class="main-header-log-out">
						<?php if ( ! empty( $profile_link ) ) : ?>
							<a class="learndash-profile-link" href="<?php echo empty( $profile_link ) ? '#' : esc_url( $profile_link ); ?>">
						<?php else : ?>
							<span class="learndash-profile-link">
						<?php endif; ?>
						<?php echo get_avatar( get_current_user_id(), 45 ); ?>
						<?php if ( ! empty( $profile_link ) ) : ?>
							</a>
						<?php else : ?>
							</span>
						<?php endif; ?>
					</div>
				</div>
				<?php
			endif;
		}

		/**
		 * Distraction Free for LLMS Course/Lession Page.
		 *
		 * @return void
		 */
		public function llms_learning() {

			if ( is_singular( 'sfwd-courses' ) || is_singular( 'sfwd-lessons' ) || is_singular( 'sfwd-topic' ) || is_singular( 'sfwd-quiz' ) ) {

				$course_id = learndash_get_course_id();
				$user_id   = get_current_user_id();

				if ( astra_get_option( 'learndash-distraction-free-learning' ) && sfwd_lms_has_access( $course_id, $user_id ) ) {

					// HFB Support for distration free checkout.
					if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
						remove_action( 'astra_header', array( Astra_Builder_Header::get_instance(), 'prepare_header_builder_markup' ) );
						remove_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ), 10 );
					}

					remove_action( 'astra_header', 'astra_header_markup' );
					remove_action( 'astra_footer', 'astra_footer_markup' );

					add_action( 'astra_header', array( $this, 'header_markup' ) );
					add_action( 'astra_footer', array( $this, 'footer_markup' ) );
				}
			}
		}

		/**
		 * Header markup.
		 */
		public function header_markup() {

			astra_get_template( 'learndash/templates/header.php' );
		}

		/**
		 * Footer markup.
		 */
		public function footer_markup() {

			astra_get_template( 'learndash/templates/footer.php' );
		}

		/**
		 * Body Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @return array;
		 */
		public function body_class( $classes ) {

			$distraction_free_learning = astra_get_option( 'learndash-distraction-free-learning' );

			if ( ( is_singular( 'sfwd-courses' ) || is_singular( 'sfwd-lessons' ) || is_singular( 'sfwd-topic' ) || is_singular( 'sfwd-quiz' ) ) && $distraction_free_learning ) {
				$classes[] = 'learndash-distraction-free';
			}

			return $classes;
		}

		/**
		 * Add Styles
		 */
		public function add_styles() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_EXT_LEARNDASH_URI . 'assets/css/';
			$path = ASTRA_EXT_LEARNDASH_DIR . 'assets/css/';
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

			/*** End Path Logic */

			/* Add style.css */
			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
ASTRA_Ext_LearnDash_Markup::get_instance();
