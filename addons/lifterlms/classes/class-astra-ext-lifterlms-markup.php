<?php
/**
 * LifterLMS Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'ASTRA_Ext_LifterLMS_Markup' ) ) {

	/**
	 * Advanced Search Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class ASTRA_Ext_LifterLMS_Markup {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

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
		 * Add backward support for LifterLMS "Enable Progress Bar" toggle option.
		 *
		 * @return bool
		 * @since 4.6.2
		 */
		public static function astra_addon_4_6_2_enable_lifterlms_progress_bar_compatibility() {
			$enable = class_exists( 'WP_Block_Type_Registry' ) ? ! isset( WP_Block_Type_Registry::get_instance()->get_all_registered()['llms/course-progress'] ) : true;

			return apply_filters( 'astra_addon_4_6_2_enable_lifterlms_progress_bar_compatibility', $enable );
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'wp', array( $this, 'llms_checkout' ) );
			add_action( 'wp', array( $this, 'llms_learning' ) );
			add_action( 'body_class', array( $this, 'body_class' ) );
			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );

			// Add LifterLMS icon in Menu.
			add_action( 'astra_masthead_content', array( $this, 'lifterlms_profile_link_enabled' ) );
			add_action( 'astra_masthead_content', array( $this, 'menu_lifter_lms_profile_link_wrapper_start' ), 9 );
			add_action( 'astra_masthead_content', array( $this, 'menu_lifter_lms_profile_link_wrapper_end' ), 11 );

			// Shortcode.
			add_shortcode( 'astra_lifterlms_profile_link', array( $this, 'astra_lifterlms_profile_link_callback' ) );
		}

		/**
		 * LifterLMS Profile Link Shortcode.
		 *
		 * @param  array $attrs Shortcode Attrs.
		 * @return mixed
		 */
		public function astra_lifterlms_profile_link_callback( $attrs ) {

			ob_start();
			self::astra_header_lifterlms();
			return ob_get_clean();
		}

		/**
		 * Lifter LMS Profile and Navigation Wrapper end for center header layout
		 *
		 * @return void
		 */
		public function menu_lifter_lms_profile_link_wrapper_start() {
			$header_layout       = astra_get_option( 'header-layouts' );
			$header_profile_link = astra_get_option( 'lifterlms-profile-link-enabled' );
			if ( 'header-main-layout-2' === $header_layout && $header_profile_link ) {
				echo '<div class="ast-header-nav-lifter-profile-wrap">';
			}
		}

		/**
		 * Lifter LMS Profile Enabled.
		 *
		 * @return void
		 */
		public function menu_lifter_lms_profile_link_wrapper_end() {
			$header_layout       = astra_get_option( 'header-layouts' );
			$header_profile_link = astra_get_option( 'lifterlms-profile-link-enabled' );
			if ( 'header-main-layout-2' === $header_layout && $header_profile_link ) {
				echo '</div>';
			}
		}

		/**
		 * LifterLMS Profile Enabled.
		 *
		 * @return void
		 */
		public function lifterlms_profile_link_enabled() {

			if ( astra_get_option( 'lifterlms-profile-link-enabled' ) ) {
				self::astra_header_lifterlms();
			}
		}

		/**
		 * Add LifterLMS icon markup
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public static function astra_header_lifterlms() {

			if ( is_user_logged_in() ) {
				$my_account_permalink = get_permalink( get_option( 'lifterlms_myaccount_page_id' ) );
				?>
				<div class="main-header-log-out">
					<a class="llms-profile-link" role="link" aria-label="<?php esc_attr_e( 'LifterLMS profile link', 'astra-addon' ); ?>" href="<?php echo esc_url_raw( apply_filters( 'astra_llms_profile_link', $my_account_permalink ) ); ?>"><?php echo get_avatar( get_current_user_id(), 45 ); ?></a>
				</div>
				<?php
			}
		}

		/**
		 * Distraction Free for LLMS Course/Lession Page.
		 *
		 * @return void
		 */
		public function llms_learning() {

			$is_course = is_course();
			$is_lesson = is_lesson();

			if ( ! ( $is_lesson || $is_course ) ) {
				/**
				 * Bail early if we are not in single lesson or single course.
				 */
				return;
			}

			$featured_img       = true;
			$course_description = true;
			$course_meta        = true;
			$instructor         = true;
			$syllabus           = true;
			$progress_bar       = true;
			$page_restricted    = llms_page_restricted( get_the_id() );

			remove_action( 'lifterlms_single_course_before_summary', 'lifterlms_template_single_featured_image', 10 );
			remove_action( 'lifterlms_single_course_before_summary', 'lifterlms_template_single_video', 20 );
			remove_action( 'lifterlms_single_course_before_summary', 'lifterlms_template_single_audio', 30 );

			if ( ( 'role-access' === $page_restricted['reason'] ) && ! $page_restricted['is_restricted'] ) {
				/**
				 * If we are here, then user is probably viewing current lesson or course as self. ( View as Myself ).
				 * So in such case, running below codes has no use.
				 */
				return;
			}

			if ( $page_restricted['is_restricted'] ) {

				$featured_img       = astra_get_option( 'lifterlms-enable-visitor-featured-image' );
				$course_description = $is_course ? astra_get_option( 'lifterlms-enable-visitor-course-description' ) : true;
				$course_meta        = $is_course ? astra_get_option( 'lifterlms-enable-visitor-course-meta' ) : true;
				$instructor         = astra_get_option( 'lifterlms-enable-visitor-instructor-detail' );
				$syllabus           = astra_get_option( 'lifterlms-enable-visitor-syllabus' );
			} else {

				if ( astra_get_option( 'lifterlms-distraction-free-learning' ) ) {

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

				$featured_img       = astra_get_option( 'lifterlms-enable-featured-image' );
				$course_description = $is_course ? astra_get_option( 'lifterlms-enable-course-description' ) : true;
				$course_meta        = $is_course ? astra_get_option( 'lifterlms-enable-course-meta' ) : true;
				$instructor         = astra_get_option( 'lifterlms-enable-instructor-detail' );
				$progress_bar       = astra_get_option( 'lifterlms-enable-progress-bar', self::astra_addon_4_6_2_enable_lifterlms_progress_bar_compatibility() );
			}

			if ( ! $featured_img ) {
				add_filter( 'astra_get_option_blog-single-post-structure', array( $this, 'disable_featured_img' ) );
			}

			if ( ! $course_meta || ! $instructor ) {
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_meta_wrapper_start', 5 );
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_meta_wrapper_end', 50 );
			}

			if ( ! $instructor ) {
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_course_author', 40 );
			}

			if ( ! $progress_bar ) {
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_course_progress', 60 );
			}

			if ( ! $syllabus ) {
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_syllabus', 90 );
			}

			if ( ! $course_meta ) {
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_length', 10 );
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_difficulty', 20 );
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_course_tracks', 25 );
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_course_categories', 30 );
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_course_tags', 35 );

				// Remove Astra's meta info if disabled from the customizer.
				add_filter( 'astra_single_post_meta', '__return_empty_string' );
			}

			if ( ! $course_description ) {
				add_filter( 'the_excerpt', '__return_empty_string', 9 );
				add_filter( 'the_content', '__return_empty_string', 9 );
			}
		}

		/**
		 * Disable Featured Image.
		 *
		 * @param  array $option Option value.
		 * @return array
		 */
		public function disable_featured_img( $option ) {
			$index = array_search( 'single-image', $option );
			if ( false !== $index ) {
				unset( $option[ $index ] );
			}

			return $option;
		}

		/**
		 * Distraction Free for LLMS Checkout Page.
		 *
		 * @return void
		 */
		public function llms_checkout() {

			if ( is_llms_checkout() && astra_get_option( 'lifterlms-distraction-free-checkout' ) ) {

				// HFB Support for distration free checkout.
				if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
					remove_action( 'astra_header', array( Astra_Builder_Header::get_instance(), 'prepare_header_builder_markup' ) );
					remove_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ), 10 );
				}

				remove_action( 'astra_header', 'astra_header_markup' );
				remove_action( 'astra_footer', 'astra_footer_markup' );

				add_action( 'astra_header', array( $this, 'header_markup' ) );
				add_action( 'astra_footer', array( $this, 'footer_markup' ) );

				// Store Sidebar Layout.
				add_filter( 'astra_page_layout', array( $this, 'checkout_sidebar_layout' ), 99 );
			}
		}

		/**
		 * Header markup.
		 */
		public function header_markup() {

			astra_addon_get_template( 'lifterlms/templates/header.php' );
		}

		/**
		 * Footer markup.
		 */
		public function footer_markup() {

			astra_addon_get_template( 'lifterlms/templates/footer.php' );
		}

		/**
		 * Checkout sidebar layout.
		 *
		 * @param string $sidebar_layout Layout.
		 *
		 * @return string;
		 */
		public function checkout_sidebar_layout( $sidebar_layout ) {

			return 'no-sidebar';
		}

		/**
		 * Body Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @return array;
		 */
		public function body_class( $classes ) {

			$distraction_free_learning = astra_get_option( 'lifterlms-distraction-free-learning' );
			$distraction_free_checkout = astra_get_option( 'lifterlms-distraction-free-checkout' );
			$vertical_tab              = astra_get_option( 'lifterlms-my-account-vertical' );
			$page_restricted           = llms_page_restricted( get_the_id() );

			$header_profile_link = astra_get_option( 'lifterlms-profile-link-enabled' );

			if ( ( ( is_course() || is_lesson() ) && $distraction_free_learning && ! $page_restricted['is_restricted'] ) || ( is_llms_checkout() && $distraction_free_checkout ) ) {
				$classes[] = 'llms-distraction-free';
			}
			if ( $vertical_tab ) {
				$classes[] = 'llms-student-dashboard-vertical';
			}
			if ( $header_profile_link ) {
				$classes[] = 'llms-profile-link-enabled';
			}

			return $classes;
		}

		/**
		 * Add Styles
		 */
		public function add_styles() {

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_LIFTERLMS_URI . 'assets/css/';
			$path = ASTRA_ADDON_EXT_LIFTERLMS_DIR . 'assets/css/';
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

			/* Add style.css */
			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
ASTRA_Ext_LifterLMS_Markup::get_instance();
