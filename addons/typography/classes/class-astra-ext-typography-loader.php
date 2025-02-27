<?php
/**
 * Typography - Customizer.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Astra_Ext_Typography_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Typography_Loader {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Initiator
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
			add_action( 'init', array( $this, 'disale_qm_cap_checking' ) );

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 9 );
			add_action( 'customize_register', array( $this, 'customize_register_new' ), 2 );
			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );

			add_filter( 'uabb_theme_button_font_family', array( $this, 'button_font_family' ), 11 );
			add_filter( 'uabb_theme_button_font_size', array( $this, 'button_font_size' ), 11 );
			add_filter( 'uabb_theme_button_text_transform', array( $this, 'button_text_transform' ), 11 );
		}

		/**
		 * Add Font Family Callback
		 *
		 * @return void
		 */
		public function add_fonts() {

			$font_family_header_content = astra_get_option( 'font-family-header-content' );
			$font_weight_header_content = astra_get_option( 'font-weight-header-content' );
			Astra_Fonts::add_font( $font_family_header_content, $font_weight_header_content );

			$font_family_site_title = astra_get_option( 'font-family-site-title' );
			$font_weight_site_title = astra_get_option( 'font-weight-site-title' );

			Astra_Fonts::add_font( $font_family_site_title, $font_weight_site_title );

			$font_family_site_tagline = astra_get_option( 'font-family-site-tagline' );
			$font_weight_site_tagline = astra_get_option( 'font-weight-site-tagline' );
			Astra_Fonts::add_font( $font_family_site_tagline, $font_weight_site_tagline );

			$font_family_primary_menu = astra_get_option( 'font-family-primary-menu' );
			$font_weight_primary_menu = astra_get_option( 'font-weight-primary-menu' );
			Astra_Fonts::add_font( $font_family_primary_menu, $font_weight_primary_menu );

			$font_family_primary_dropdown_menu = astra_get_option( 'font-family-primary-dropdown-menu' );
			$font_weight_primary_dropdown_menu = astra_get_option( 'font-weight-primary-dropdown-menu' );
			Astra_Fonts::add_font( $font_family_primary_dropdown_menu, $font_weight_primary_dropdown_menu );

			$font_family_archive_page_title = astra_get_option( 'font-family-page-title' );
			$font_weight_archive_page_title = astra_get_option( 'font-weight-page-title' );
			Astra_Fonts::add_font( $font_family_archive_page_title, $font_weight_archive_page_title );

			$font_family_post_meta = astra_get_option( 'font-family-post-meta' );
			$font_weight_post_meta = astra_get_option( 'font-weight-post-meta' );
			Astra_Fonts::add_font( $font_family_post_meta, $font_weight_post_meta );

			$font_family_post_tax = astra_get_option( 'font-family-post-tax' );
			$font_weight_post_tax = astra_get_option( 'font-weight-post-tax' );
			Astra_Fonts::add_font( $font_family_post_tax, $font_weight_post_tax );

			$font_family_post_read_more = astra_get_option( 'font-family-post-read-more' );
			$font_weight_post_read_more = astra_get_option( 'font-family-post-read-more' );
			Astra_Fonts::add_font( $font_family_post_read_more, $font_weight_post_read_more );

			$font_family_post_excerpt = astra_get_option( 'font-family-post-excerpt' );
			$font_weight_post_excerpt = astra_get_option( 'font-weight-post-excerpt' );
			Astra_Fonts::add_font( $font_family_post_excerpt, $font_weight_post_excerpt );

			$font_family_post_filter_taxonomy = astra_get_option( 'font-family-blog-filter-taxonomy' );
			$font_weight_post_filter_taxonomy = astra_get_option( 'font-weight-blog-filter-taxonomy' );
			Astra_Fonts::add_font( $font_family_post_filter_taxonomy, $font_weight_post_filter_taxonomy );

			$font_family_widget_title = astra_get_option( 'font-family-widget-title' );
			$font_weight_widget_title = astra_get_option( 'font-weight-widget-title' );
			Astra_Fonts::add_font( $font_family_widget_title, $font_weight_widget_title );

			$font_family_widget_content = astra_get_option( 'font-family-widget-content' );
			$font_weight_widget_content = astra_get_option( 'font-weight-widget-content' );
			Astra_Fonts::add_font( $font_family_widget_content, $font_weight_widget_content );

			$font_family_footer_content = astra_get_option( 'font-family-footer-content' );
			$font_weight_footer_content = astra_get_option( 'font-weight-footer-content' );
			Astra_Fonts::add_font( $font_family_footer_content, $font_weight_footer_content );

			$font_family_button = astra_get_option( 'font-family-button' );
			$font_weight_button = astra_get_option( 'font-weight-button' );
			Astra_Fonts::add_font( $font_family_button, $font_weight_button );

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				/**
				 * Footer - Copyright
				 */
				if ( Astra_Addon_Builder_Helper::is_component_loaded( 'copyright', 'footer' ) ) {
					$copyright_font_family = astra_get_option( 'font-family-section-footer-copyright' );
					$copyright_font_weight = astra_get_option( 'font-weight-section-footer-copyright' );
					Astra_Fonts::add_font( $copyright_font_family, $copyright_font_weight );
				}

				/**
				 * Header - Account
				 */
				if ( Astra_Addon_Builder_Helper::is_component_loaded( 'account', 'header' ) ) {
					$account_font_family = astra_get_option( 'font-family-section-header-account' );
					$account_font_weight = astra_get_option( 'font-weight-section-header-account' );
					Astra_Fonts::add_font( $account_font_family, $account_font_weight );

					$account_menu_font_family = astra_get_option( 'section-header-account-menu-font-family' );
					$account_menu_font_weight = astra_get_option( 'section-header-account-menu-font-weight' );
					Astra_Fonts::add_font( $account_menu_font_family, $account_menu_font_weight );
				}

				/**
				 * Footer - HTML
				 */
				$num_of_footer_html = astra_addon_builder_helper()->num_of_footer_html;
				for ( $index = 1; $index <= $num_of_footer_html; $index++ ) {

					if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'html-' . $index, 'footer' ) ) {
						continue;
					}

					$_prefix = 'section-fb-html-' . $index;

					$html_font_family = astra_get_option( 'font-family-' . $_prefix );
					$html_font_weight = astra_get_option( 'font-weight-' . $_prefix );
					Astra_Fonts::add_font( $html_font_family, $html_font_weight );
				}

				/**
				 * Header - HTML
				 */
				$num_of_header_html = astra_addon_builder_helper()->num_of_header_html;
				for ( $index = 1; $index <= $num_of_header_html; $index++ ) {

					if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'html-' . $index, 'header' ) ) {
						continue;
					}

					$_prefix = 'section-hb-html-' . $index;

					$html_font_family = astra_get_option( 'font-family-' . $_prefix );
					$html_font_weight = astra_get_option( 'font-weight-' . $_prefix );
					Astra_Fonts::add_font( $html_font_family, $html_font_weight );
				}

				/**
				 * Footer - Social
				 */

				$num_of_footer_social_icons = astra_addon_builder_helper()->num_of_footer_social_icons;
				for ( $index = 1; $index <= $num_of_footer_social_icons; $index++ ) {

					if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'social-icons-' . $index, 'footer' ) ) {
						continue;
					}

					$_prefix = 'section-fb-social-icons-' . $index;

					$social_footer_font_family = astra_get_option( 'font-family-' . $_prefix );
					$social_footer_font_weight = astra_get_option( 'font-weight-' . $_prefix );
					Astra_Fonts::add_font( $social_footer_font_family, $social_footer_font_weight );
				}

				/**
				 * Header - Social
				 */
				$num_of_header_social_icons = astra_addon_builder_helper()->num_of_header_social_icons;
				for ( $index = 1; $index <= $num_of_header_social_icons; $index++ ) {

					if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'social-icons-' . $index, 'header' ) ) {
						continue;
					}

					$_prefix = 'section-hb-social-icons-' . $index;

					$social_header_font_family = astra_get_option( 'font-family-' . $_prefix );
					$social_header_font_weight = astra_get_option( 'font-weight-' . $_prefix );
					Astra_Fonts::add_font( $social_header_font_family, $social_header_font_weight );
				}

				/**
				 * Header - Widgets
				 */
				$num_of_header_widgets = astra_addon_builder_helper()->num_of_header_widgets;
				for ( $index = 1; $index <= $num_of_header_widgets; $index++ ) {

					if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'widget-' . $index, 'header' ) ) {
						continue;
					}

					$_prefix = 'widget-' . $index;

					$widget_font_family = astra_get_option( 'header-' . $_prefix . '-font-family' );
					$widget_font_weight = astra_get_option( 'header-' . $_prefix . '-font-weight' );
					Astra_Fonts::add_font( $widget_font_family, $widget_font_weight );

					$widget_content_font_family = astra_get_option( 'header-' . $_prefix . '-content-font-family' );
					$widget_content_font_weight = astra_get_option( 'header-' . $_prefix . '-content-font-weight' );
					Astra_Fonts::add_font( $widget_content_font_family, $widget_content_font_weight );
				}

				/**
				 * Footer - Widgets
				 */
				$num_of_footer_widgets = astra_addon_builder_helper()->num_of_footer_widgets;
				for ( $index = 1; $index <= $num_of_footer_widgets; $index++ ) {

					if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'widget-' . $index, 'footer' ) ) {
						continue;
					}

					$_prefix = 'widget-' . $index;

					$widget_font_family = astra_get_option( 'footer-' . $_prefix . '-font-family' );
					$widget_font_weight = astra_get_option( 'footer-' . $_prefix . '-font-weight' );
					Astra_Fonts::add_font( $widget_font_family, $widget_font_weight );

					$widget_content_font_family = astra_get_option( 'footer-' . $_prefix . '-content-font-family' );
					$widget_content_font_weight = astra_get_option( 'footer-' . $_prefix . '-content-font-weight' );
					Astra_Fonts::add_font( $widget_content_font_family, $widget_content_font_weight );
				}

				/**
				 * Mobile Trigger
				 */

				$header_menu_trigger_font_family = astra_get_option( 'mobile-header-label-font-family' );
				$header_menu_trigger_font_weight = astra_get_option( 'mobile-header-label-font-weight' );
				Astra_Fonts::add_font( $header_menu_trigger_font_family, $header_menu_trigger_font_weight );

				/**
				 * Header - Menu
				 */

				$component_limit = astra_addon_builder_helper()->component_limit;
				for ( $index = 1; $index <= $component_limit; $index++ ) {

					$_prefix = 'menu' . $index;

					$submenu_font_family = astra_get_option( 'header-font-family-' . $_prefix . '-sub-menu' );
					$submenu_font_weight = astra_get_option( 'header-font-weight-' . $_prefix . '-sub-menu' );
					Astra_Fonts::add_font( $submenu_font_family, $submenu_font_weight );

					if ( 3 > $index ) {
						$megamenu_font_family = astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-family' );
						$megamenu_font_weight = astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-weight' );
						Astra_Fonts::add_font( $megamenu_font_family, $megamenu_font_weight );
					}
				}

				/**
				 * Footer Menu
				 */
				$footer_menu_font_family = astra_get_option( 'footer-menu-font-family' );
				$footer_menu_font_weight = astra_get_option( 'footer-menu-font-weight' );
				Astra_Fonts::add_font( $footer_menu_font_family, $footer_menu_font_weight );

				/**
				 * Mobile menu
				 */

				$submenu_font_family = astra_get_option( 'header-mobile-menu-sub-menu-font-family' );
				$submenu_font_weight = astra_get_option( 'header-mobile-menu-sub-menu-font-weight' );
				Astra_Fonts::add_font( $submenu_font_family, $submenu_font_weight );

				/**
				 * Header - Language Switcher
				 */
				$header_lang_switcher_font_family = astra_get_option( 'font-family-section-hb-language-switcher' );
				$header_lang_switcher_font_weight = astra_get_option( 'font-weight-section-hb-language-switcher' );
				Astra_Fonts::add_font( $header_lang_switcher_font_family, $header_lang_switcher_font_weight );

				/**
				 * Footer - Language Switcher
				 */
				$footer_lang_switcher_font_family = astra_get_option( 'font-family-section-fb-language-switcher' );
				$footer_lang_switcher_font_weight = astra_get_option( 'font-weight-section-fb-language-switcher' );
				Astra_Fonts::add_font( $footer_lang_switcher_font_family, $footer_lang_switcher_font_weight );

			}
		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			$astra_options                       = astra_get_options();
			$apply_new_default_color_typo_values = is_callable( 'Astra_Dynamic_CSS::astra_check_default_color_typo' ) ? Astra_Dynamic_CSS::astra_check_default_color_typo() : false;
			$blog_improvements                   = astra_addon_4_6_0_compatibility();

			// Header.
			$defaults['font-family-site-title'] = 'inherit';
			$defaults['font-weight-site-title'] = 'inherit';
			$defaults['font-extras-site-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-site-title'] ) && isset( $astra_options['line-height-site-title'] ) ? $astra_options['line-height-site-title'] : '1.23',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-site-title'] ) && isset( $astra_options['text-transform-site-title'] ) ? $astra_options['text-transform-site-title'] : '',
				'text-decoration'     => '',
			);

			$defaults['font-family-site-tagline'] = 'inherit';
			$defaults['font-weight-site-tagline'] = 'inherit';
			$defaults['font-extras-site-tagline'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-site-tagline'] ) && isset( $astra_options['line-height-site-tagline'] ) ? $astra_options['line-height-site-tagline'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-site-tagline'] ) && isset( $astra_options['text-transform-site-tagline'] ) ? $astra_options['text-transform-site-tagline'] : '',
				'text-decoration'     => '',
			);

			// Primary Menu.
			$defaults['font-size-primary-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-weight-primary-menu']    = 'inherit';
			$defaults['font-family-primary-menu']    = 'inherit';
			$defaults['text-transform-primary-menu'] = '';
			$defaults['line-height-primary-menu']    = '';

			// Primary Dropdown Menu.
			$defaults['font-size-primary-dropdown-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-family-primary-dropdown-menu']    = 'inherit';
			$defaults['font-weight-primary-dropdown-menu']    = 'inherit';
			$defaults['text-transform-primary-dropdown-menu'] = '';
			$defaults['line-height-primary-dropdown-menu']    = '';

			// Archive Summary Box.
			$defaults['font-family-archive-summary-title'] = 'inherit';
			$defaults['font-weight-archive-summary-title'] = 'inherit';
			$defaults['font-extras-archive-summary-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-archive-summary-title'] ) && isset( $astra_options['line-height-archive-summary-title'] ) ? $astra_options['line-height-archive-summary-title'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-archive-summary-title'] ) && isset( $astra_options['text-transform-archive-summary-title'] ) ? $astra_options['text-transform-archive-summary-title'] : '',
				'text-decoration'     => '',
			);

			// Archive.
			$defaults['font-family-page-title'] = 'inherit';
			$defaults['font-weight-page-title'] = $apply_new_default_color_typo_values ? '500' : 'inherit';
			$defaults['font-extras-page-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-page-title'] ) && isset( $astra_options['line-height-page-title'] ) ? $astra_options['line-height-page-title'] : '1.23',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-page-title'] ) && isset( $astra_options['text-transform-page-title'] ) ? $astra_options['text-transform-page-title'] : '',
				'text-decoration'     => '',
			);

			$defaults['font-family-post-meta'] = 'inherit';
			$defaults['font-weight-post-meta'] = $blog_improvements ? '600' : 'inherit';
			$defaults['font-extras-post-meta'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-post-meta'] ) && isset( $astra_options['line-height-post-meta'] ) ? $astra_options['line-height-post-meta'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-post-meta'] ) && isset( $astra_options['text-transform-post-meta'] ) ? $astra_options['text-transform-post-meta'] : '',
				'text-decoration'     => '',
			);

			// Blog Font Tax fonts.
			$defaults['font-family-post-tax'] = 'inherit';
			$defaults['font-weight-post-tax'] = 'inherit';
			$defaults['font-extras-post-tax'] = array(
				'line-height'         => '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => '',
				'text-decoration'     => '',
			);

			// Blog Font Read More.
			$defaults['font-size-post-read-more']   = array(
				'desktop'      => $apply_new_default_color_typo_values ? 16 : '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-family-post-read-more'] = 'inherit';
			$defaults['font-weight-post-read-more'] = 'inherit';
			$defaults['font-extras-post-read-more'] = array(
				'line-height'         => '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => '',
				'text-decoration'     => '',
			);

			// Blog Font Excerpt.
			$defaults['font-size-post-excerpt']   = array(
				'desktop'      => $apply_new_default_color_typo_values ? 16 : '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-family-post-excerpt'] = 'inherit';
			$defaults['font-weight-post-excerpt'] = 'inherit';
			$defaults['font-extras-post-excerpt'] = array(
				'line-height'         => '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => '',
				'text-decoration'     => '',
			);

			$defaults['font-size-post-pagination'] = array(
				'desktop'      => $apply_new_default_color_typo_values ? 16 : '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['text-transform-post-pagination'] = '';

			// Single.
			$defaults['font-family-entry-title'] = 'inherit';
			$defaults['font-weight-entry-title'] = 'inherit';
			$defaults['font-extras-entry-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-entry-title'] ) && isset( $astra_options['line-height-entry-title'] ) ? $astra_options['line-height-entry-title'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-entry-title'] ) && isset( $astra_options['text-transform-entry-title'] ) ? $astra_options['text-transform-entry-title'] : '',
				'text-decoration'     => '',
			);

			// Button.
			$defaults['font-size-button']   = array(
				'desktop'      => $apply_new_default_color_typo_values ? 16 : '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-weight-button'] = $apply_new_default_color_typo_values ? '500' : 'inherit';
			$defaults['font-family-button'] = 'inherit';

			// Sidebar.
			$defaults['font-size-widget-title']   = array(
				'desktop'      => $apply_new_default_color_typo_values ? 26 : '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-size-sidebar-title']  = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-family-widget-title'] = 'inherit';
			$defaults['font-weight-widget-title'] = 'inherit';
			$defaults['font-extras-widget-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-widget-title'] ) && isset( $astra_options['line-height-widget-title'] ) ? $astra_options['line-height-widget-title'] : '1.23',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-widget-title'] ) && isset( $astra_options['text-transform-widget-title'] ) ? $astra_options['text-transform-widget-title'] : '',
				'text-decoration'     => '',
			);

			$defaults['font-size-widget-content']   = array(
				'desktop'      => $apply_new_default_color_typo_values ? 16 : '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-size-sidebar-content']  = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'em',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'em',
			);
			$defaults['font-family-widget-content'] = 'inherit';
			$defaults['font-weight-widget-content'] = 'inherit';
			$defaults['line-height-widget-content'] = '';
			$defaults['font-extras-widget-content'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-widget-content'] ) && isset( $astra_options['line-height-widget-content'] ) ? $astra_options['line-height-widget-content'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-widget-content'] ) && isset( $astra_options['text-transform-widget-content'] ) ? $astra_options['text-transform-widget-content'] : '',
				'text-decoration'     => '',
			);

			// Footer.
			$defaults['font-size-footer-content']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-family-footer-content']    = 'inherit';
			$defaults['font-weight-footer-content']    = 'inherit';
			$defaults['text-transform-footer-content'] = '';
			$defaults['line-height-footer-content']    = '';

			// Header <H1>.
			$defaults['font-family-h1']    = 'inherit';
			$defaults['font-weight-h1']    = 'inherit';
			$defaults['text-transform-h1'] = '';
			$defaults['line-height-h1']    = '';

			// Header <H2>.
			$defaults['font-family-h2']    = 'inherit';
			$defaults['font-weight-h2']    = 'inherit';
			$defaults['text-transform-h2'] = '';
			$defaults['line-height-h2']    = '';

			// Header <H3>.
			$defaults['font-family-h3']    = 'inherit';
			$defaults['font-weight-h3']    = 'inherit';
			$defaults['text-transform-h3'] = '';
			$defaults['line-height-h3']    = '';

			// Outside Menu Item.
			$defaults['outside-menu-font-size']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['outside-menu-line-height'] = '';

			$defaults['section-header-account-menu-font-size']         = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['section-header-account-popup-font-size']        = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['section-header-account-popup-button-font-size'] = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-size-section-hb-language-switcher']        = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-size-section-fb-language-switcher']        = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['font-family-section-hb-language-switcher']      = 'inherit';
			$defaults['font-family-section-fb-language-switcher']      = 'inherit';

			$defaults['font-extras-section-hb-language-switcher'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-section-hb-language-switcher'] ) && isset( $astra_options['line-height-section-hb-language-switcher'] ) ? $astra_options['line-height-section-hb-language-switcher'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-section-hb-language-switcher'] ) && isset( $astra_options['text-transform-section-hb-language-switcher'] ) ? $astra_options['text-transform-section-hb-language-switcher'] : '',
				'text-decoration'     => '',
			);

			$defaults['font-extras-section-fb-language-switcher'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-section-fb-language-switcher'] ) && isset( $astra_options['line-height-section-fb-language-switcher'] ) ? $astra_options['line-height-section-fb-language-switcher'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-section-fb-language-switcher'] ) && isset( $astra_options['text-transform-section-fb-language-switcher'] ) ? $astra_options['text-transform-section-fb-language-switcher'] : '',
				'text-decoration'     => '',
			);

			$defaults['font-extras-section-footer-copyright'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-section-footer-copyright'] ) && isset( $astra_options['line-height-section-footer-copyright'] ) ? $astra_options['line-height-section-footer-copyright'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-section-footer-copyright'] ) && isset( $astra_options['text-transform-section-footer-copyright'] ) ? $astra_options['text-transform-section-footer-copyright'] : '',
				'text-decoration'     => '',
			);

			/**
			 * Footer > Social Icon Defaults.
			 */
			$num_of_footer_social_icons = astra_addon_builder_helper()->num_of_footer_social_icons;
			for ( $index = 1; $index <= $num_of_footer_social_icons; $index++ ) {
				$defaults[ 'font-family-section-fb-social-icons-' . $index ]    = 'inherit';
				$defaults[ 'font-weight-section-fb-social-icons-' . $index ]    = 'inherit';
				$defaults[ 'text-transform-section-fb-social-icons-' . $index ] = '';
				$defaults[ 'line-height-section-fb-social-icons-' . $index ]    = '';
			}

			/**
			 * Header > Social Icon Defaults.
			 */
			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {
				$defaults = $this->prepare_social_icons_defaults( $defaults, $index );
			}

			return $defaults;
		}

		/**
		 * Prepare Social Icons Defaults.
		 *
		 * @param array $defaults defaults.
		 * @param int   $index index.
		 * @return array
		 * @since 3.1.0
		 */
		public function prepare_social_icons_defaults( $defaults, $index ) {

			$defaults[ 'font-family-section-hb-social-icons-' . $index ]    = 'inherit';
			$defaults[ 'font-weight-section-hb-social-icons-' . $index ]    = 'inherit';
			$defaults[ 'text-transform-section-hb-social-icons-' . $index ] = '';
			$defaults[ 'line-height-section-hb-social-icons-' . $index ]    = '';

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register_new( $wp_customize ) {

			/**
			 * Register Sections & Panels
			 */
			require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/class-astra-typo-panel-section-configs.php';
			require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/sections/class-astra-archive-advanced-typo-configs.php';
			require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/sections/class-astra-site-header-typo-configs.php';
			if ( astra_addon_existing_header_footer_configs() ) {
				require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/sections/class-astra-primary-menu-typo-configs.php';
				require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/sections/class-astra-footer-typo-configs.php';
			}
			require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/sections/class-astra-sidebar-typo-configs.php';
			require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/sections/class-astra-builder-menu-configs.php';
			require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/sections/class-astra-header-builder-typo-configs.php';
		}

		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'astra-ext-typography-customize-preview-js', ASTRA_ADDON_EXT_TYPOGRAPHY_URI . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			} else {
				wp_enqueue_script( 'astra-ext-typography-customize-preview-js', ASTRA_ADDON_EXT_TYPOGRAPHY_URI . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			}

			$localize_array = array(
				'includeAnchorsInHeadindsCss'         => astra_addon_typography_anchors_in_css_selectors_heading(),
				'addon_page_builder_button_style_css' => Astra_Addon_Update_Filter_Function::page_builder_addon_button_style_css(),
				'component_limit'                     => astra_addon_builder_helper()->component_limit,
				'is_flex_based_css'                   => Astra_Addon_Builder_Helper::apply_flex_based_css(),
				'astra_not_updated'                   => version_compare( ASTRA_THEME_VERSION, '3.2.0', '<' ),
				'font_weight_support_widget_title'    => Astra_Addon_Update_Filter_Function::support_addon_font_css_to_widget_and_in_editor(),
			);

			wp_localize_script( 'astra-ext-typography-customize-preview-js', 'astTypography', $localize_array );
		}

		/**
		 * Button Font Family
		 */
		public function button_font_family() {
			$font_family = str_replace( "'", '', astra_get_option( 'font-family-button' ) );
			$font_family = explode( ',', $font_family );
			return array(
				'family' => $font_family[0],
				'weight' => astra_get_option( 'font-weight-button' ),
			);
		}

		/**
		 * Button Font Size
		 */
		public function button_font_size() {
			$font_size        = astra_get_option( 'font-size-button' );
			$font_size_number = $font_size['desktop'];
			$font_size_unit   = $font_size['desktop-unit'];

			return $font_size_number . $font_size_unit;
		}

		/**
		 * Button Text Transform
		 */
		public function button_text_transform() {
			return astra_addon_get_font_extras( astra_get_option( 'font-extras-button' ), 'text-transform' );
		}

		/**
		 * Typography Param loads all the available Google fonts from the Json.
		 * The Google Fonts list is generated usig a Grunt Command so this list will keep on increasing in future.
		 *
		 * When Typography param and Query Monitor is active, Both of these cause a lot of memory consumption. Particularly `QM_Collector_Caps->filter_user_has_cap`
		 * Hence we are disaling this method only when inside the Customizer Preview. This is not affected anywhere else on the site, Front End or Admin.
		 *
		 * @since 1.1.0
		 */
		public function disale_qm_cap_checking() {

			if ( class_exists( 'QM_Collector_Caps' ) && is_customize_preview() ) {
				$qm_caps = QM_Collectors::get( 'caps' );
				remove_filter( 'user_has_cap', array( $qm_caps, 'filter_user_has_cap' ), 9999, 3 );
			}
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Typography_Loader::get_instance();
