<?php
/**
 * Blog Pro - Customizer.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Astra_Ext_Blog_Pro_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Blog_Pro_Loader {

		/**
		 * Member Variable
		 *
		 * @var instance
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

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
			}

			add_action( 'customize_register', array( $this, 'new_customize_register' ), 2 );

		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			// Blog / Archive.
			$defaults['blog-masonry']               = false;
			$defaults['blog-date-box']              = false;
			$defaults['blog-date-box-style']        = 'square';
			$defaults['first-post-full-width']      = false;
			$defaults['blog-space-bet-posts']       = false;
			$defaults['blog-grid']                  = 1;
			$defaults['blog-grid-layout']           = 1;
			$defaults['blog-layout']                = 'blog-layout-1';
			$defaults['blog-pagination']            = 'number';
			$defaults['blog-pagination-style']      = 'default';
			$defaults['blog-infinite-scroll-event'] = 'scroll';

			$defaults['blog-excerpt-count']          = 55;
			$defaults['blog-read-more-text']         = __( 'Read More »', 'astra-addon' );
			$defaults['blog-read-more-as-button']    = false;
			$defaults['blog-load-more-text']         = __( 'Load More', 'astra-addon' );
			$defaults['blog-featured-image-padding'] = false;

			// Single.
			$defaults['ast-author-info']               = false;
			$defaults['ast-single-post-navigation']    = false;
			$defaults['ast-auto-prev-post']            = false;
			$defaults['single-featured-image-padding'] = false;

			// Blog Archive Images size.
			$defaults['blog-archive-image-width']  = false;
			$defaults['blog-archive-image-height'] = false;

			// Blog Single Images size.
			$defaults['blog-single-post-image-width']  = false;
			$defaults['blog-single-post-image-height'] = false;

			return $defaults;
		}

		/**
		 * Register panel, section and controls
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function new_customize_register( $wp_customize ) {

			/**
			 * Sections
			 */
			require_once ASTRA_EXT_BLOG_PRO_DIR . 'classes/sections/class-astra-customizer-blog-pro-configs.php';
			require_once ASTRA_EXT_BLOG_PRO_DIR . 'classes/sections/class-astra-customizer-blog-pro-single-configs.php';
		}
		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {
			wp_enqueue_script( 'astra-blog-customizer-preview-js', ASTRA_EXT_BLOG_PRO_URI . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
		}
	}

}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Blog_Pro_Loader::get_instance();
