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
	// @codingStandardsIgnoreStart
	class Astra_Ext_Blog_Pro_Loader {
		// @codingStandardsIgnoreEnd

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

			$defaults['single-post-social-sharing-icon-enable']      = false;
			$defaults['single-post-social-sharing-heading-enable']   = false;
			$defaults['single-post-social-sharing-heading-position'] = 'above';
			$defaults['single-post-social-sharing-heading-text']     = __( 'Share your love', 'astra-addon' );
			$defaults['single-post-social-sharing-heading-position'] = 'above';

			$defaults['single-post-social-sharing-icon-list'] = array(
				'items' =>
					array(
						array(
							'id'         => 'facebook',
							'enabled'    => true,
							'source'     => 'icon',
							'url'        => '',
							'color'      => '#557dbc',
							'background' => 'transparent',
							'icon'       => 'facebook',
							'label'      => __( 'Facebook', 'astra-addon' ),
						),
						array(
							'id'         => 'twitter',
							'enabled'    => true,
							'source'     => 'icon',
							'url'        => '',
							'color'      => '#7acdee',
							'background' => 'transparent',
							'icon'       => 'twitter',
							'label'      => __( 'Twitter', 'astra-addon' ),
						),
						array(
							'id'         => 'pinterest',
							'enabled'    => true,
							'source'     => 'icon',
							'url'        => '',
							'color'      => '#E60023',
							'background' => 'transparent',
							'icon'       => 'pinterest',
							'label'      => __( 'Pinterest', 'astra-addon' ),
						),
						array(
							'id'         => 'linkedin',
							'enabled'    => true,
							'source'     => 'icon',
							'url'        => '',
							'color'      => '#1c86c6',
							'background' => 'transparent',
							'icon'       => 'linkedin',
							'label'      => __( 'Linkedin', 'astra-addon' ),
						),
					),
			);

			$defaults['single-post-social-sharing-icon-label']          = false;
			$defaults['single-post-social-sharing-icon-label-position'] = 'below';
			$defaults['single-post-social-sharing-icon-position']       = 'below-post-title';
			$defaults['single-post-social-sharing-alignment']           = 'left';
			$defaults['single-post-social-sharing-icon-color-type']     = 'official';

			$defaults['single-post-social-sharing-icon-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['single-post-social-sharing-icon-h-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['single-post-social-sharing-icon-label-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['single-post-social-sharing-icon-label-h-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['single-post-social-sharing-icon-background-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['single-post-social-sharing-icon-background-h-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['above-header-link-h-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['single-post-social-sharing-icon-spacing'] = array(
				'desktop' => '20',
				'tablet'  => '20',
				'mobile'  => '20',
			);

			$defaults['single-post-social-sharing-icon-background-spacing'] = array(
				'desktop' => '0',
				'tablet'  => '0',
				'mobile'  => '0',
			);

			$defaults['single-post-social-sharing-icon-size'] = array(
				'desktop' => '30',
				'tablet'  => '30',
				'mobile'  => '30',
			);

			$defaults['single-post-social-sharing-icon-radius'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['single-post-social-sharing-margin'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'em',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'em',
			);

			$defaults['single-post-social-sharing-background-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['single-post-social-sharing-padding'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'em',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'em',
			);

			$defaults['single-post-social-sharing-border-radius'] = array(
				'desktop'      => array(
					'top_left'     => '',
					'top_right'    => '',
					'bottom_right' => '',
					'bottom_left'  => '',
				),
				'tablet'       => array(
					'top_left'     => '',
					'top_right'    => '',
					'bottom_right' => '',
					'bottom_left'  => '',
				),
				'mobile'       => array(
					'top_left'     => '',
					'top_right'    => '',
					'bottom_right' => '',
					'bottom_left'  => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['single-post-social-sharing-heading-font-family'] = 'inherit';
			$defaults['single-post-social-sharing-heading-font-weight'] = 'inherit';
			$defaults['single-post-social-sharing-heading-font-size']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['single-post-social-sharing-heading-font-extras'] = array(
				'line-height'         => '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => '',
				'text-decoration'     => '',
			);

			// Social Heading.
			$defaults['single-post-social-sharing-icon-label-font-family'] = 'inherit';
			$defaults['single-post-social-sharing-icon-label-font-weight'] = 'inherit';
			$defaults['single-post-social-sharing-icon-label-font-size']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['single-post-social-sharing-icon-label-font-extras'] = array(
				'line-height'         => '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => '',
				'text-decoration'     => '',
			);

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
			require_once ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'classes/sections/class-astra-customizer-blog-pro-configs.php';
			require_once ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'classes/sections/class-astra-customizer-blog-pro-single-configs.php';
		}
		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {
			wp_enqueue_script( 'astra-blog-customizer-preview-js', ASTRA_ADDON_EXT_BLOG_PRO_URI . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );

			$localize_array = array(
				'tablet_break_point' => astra_addon_get_tablet_breakpoint(),
				'mobile_break_point' => astra_addon_get_mobile_breakpoint(),
				'rtl'                => is_rtl(),
				'soc_position'       => astra_get_option( 'single-post-social-sharing-icon-position' ),
			);

			wp_localize_script( 'astra-blog-customizer-preview-js', 'AstraAddon', $localize_array );
		}
	}

}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Blog_Pro_Loader::get_instance();
