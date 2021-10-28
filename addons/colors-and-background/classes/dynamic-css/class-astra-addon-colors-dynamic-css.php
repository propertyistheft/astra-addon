<?php
/**
 * Colors & Background - Dynamic CSS
 *
 * @package Astra Addon
 */

/**
 * Customizer Initialization
 *
 * @since 1.7.0
 */
class Astra_Addon_Colors_Dynamic_CSS {

	/**
	 *  Constructor
	 */
	public function __construct() {
		add_filter( 'astra_addon_dynamic_css', array( $this, 'astra_ext_colors_dynamic_css' ) );
	}


	/**
	 * Dynamic CSS
	 *
	 * @param  string $dynamic_css          Astra Dynamic CSS.
	 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
	 * @return string
	 */
	public function astra_ext_colors_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

		$blog_layout           = astra_get_option( 'blog-layout' );
		$blog_grid             = astra_get_option( 'blog-grid' );
		$site_container_layout = astra_get_option( 'site-content-layout' );
		$link_color            = astra_get_option( 'link-color' );
		$h1_color              = astra_get_option( 'h1-color' );
		$h2_color              = astra_get_option( 'h2-color' );
		$h3_color              = astra_get_option( 'h3-color' );
		$h4_color              = astra_get_option( 'h4-color' );
		$h5_color              = astra_get_option( 'h5-color' );
		$h6_color              = astra_get_option( 'h6-color' );

		$header_bg_obj           = astra_get_option( 'header-bg-obj-responsive' );
		$desktop_header_bg_color = isset( $header_bg_obj['desktop']['background-color'] ) ? $header_bg_obj['desktop']['background-color'] : '';
		$tablet_header_bg_color  = isset( $header_bg_obj['tablet']['background-color'] ) ? $header_bg_obj['tablet']['background-color'] : '';
		$mobile_header_bg_color  = isset( $header_bg_obj['mobile']['background-color'] ) ? $header_bg_obj['mobile']['background-color'] : '';

		$disable_primary_nav = astra_get_option( 'disable-primary-nav' );

		$primary_menu_bg_image   = astra_get_option( 'primary-menu-bg-obj-responsive' );
		$primary_menu_color      = astra_get_option( 'primary-menu-color-responsive' );
		$primary_menu_h_bg_color = astra_get_option( 'primary-menu-h-bg-color-responsive' );
		$primary_menu_h_color    = astra_get_option( 'primary-menu-h-color-responsive' );
		$primary_menu_a_bg_color = astra_get_option( 'primary-menu-a-bg-color-responsive' );
		$primary_menu_a_color    = astra_get_option( 'primary-menu-a-color-responsive' );

		$primary_submenu_bg_color   = astra_get_option( 'primary-submenu-bg-color-responsive' );
		$primary_submenu_color      = astra_get_option( 'primary-submenu-color-responsive' );
		$primary_submenu_h_bg_color = astra_get_option( 'primary-submenu-h-bg-color-responsive' );
		$primary_submenu_h_color    = astra_get_option( 'primary-submenu-h-color-responsive' );
		$primary_submenu_a_bg_color = astra_get_option( 'primary-submenu-a-bg-color-responsive' );
		$primary_submenu_a_color    = astra_get_option( 'primary-submenu-a-color-responsive' );

		$entry_title_color = astra_get_option( 'entry-title-color' );
		$page_title_color  = astra_get_option( 'page-title-color' );

		$archive_summary_bg_color    = astra_get_option( 'archive-summary-box-bg-color' );
		$archive_summary_title_color = astra_get_option( 'archive-summary-box-title-color' );
		$archive_summary_text_color  = astra_get_option( 'archive-summary-box-text-color' );

		$post_meta_color        = astra_get_option( 'post-meta-color' );
		$post_meta_link_color   = astra_get_option( 'post-meta-link-color' );
		$post_meta_link_h_color = astra_get_option( 'post-meta-link-h-color' );

		$sidebar_wgt_title_color = astra_get_option( 'sidebar-widget-title-color' );
		$sidebar_text_color      = astra_get_option( 'sidebar-text-color' );
		$sidebar_link_color      = astra_get_option( 'sidebar-link-color' );
		$sidebar_link_h_color    = astra_get_option( 'sidebar-link-h-color' );
		$sidebar_bg_obj          = astra_get_option( 'sidebar-bg-obj' );

		$footer_color        = astra_get_option( 'footer-color' );
		$footer_link_color   = astra_get_option( 'footer-link-color' );
		$footer_link_h_color = astra_get_option( 'footer-link-h-color' );
		$header_break_point  = astra_header_break_point(); // Header Break Point.

		/**
		 * Normal Colors without reponsive option.
		 * [1]. Header Colors
		 * [2]. Content Colors
		 *      - Single Post / Page Title Colors
		 *      - Blog / Archive Title Colors
		 *      - Blog / Archive Meta Colors
		 * [3]. Sidebar Colors
		 * [4]. Footer Colors
		 *
		 * Responsive Colors options
		 * [1]. Header Responsive Background with Image.
		 * [2]. Primary Menu Responsive Colors
		 */

		/**
		 * Normal Colors without reponsive option.
		 * [1]. Header Colors
		 * [2]. Content Colors
		 *      - Single Post / Page Title Color
		 *      - Blog / Archive Title
		 *      - Blog / Archive Meta
		 * [3]. Sidebar Colors
		 * [4]. Footer
		 */
		$css_output = array(

			/**
			 * Content <h1> to <h6> headings
			 */
			'h1, .entry-content h1'                      => array(
				'color' => esc_attr( $h1_color ),
			),
			'h2, .entry-content h2'                      => array(
				'color' => esc_attr( $h2_color ),
			),
			'h3, .entry-content h3'                      => array(
				'color' => esc_attr( $h3_color ),
			),
			'h4, .entry-content h4'                      => array(
				'color' => esc_attr( $h4_color ),
			),
			'h5, .entry-content h5'                      => array(
				'color' => esc_attr( $h5_color ),
			),
			'h6, .entry-content h6'                      => array(
				'color' => esc_attr( $h6_color ),
			),

			/**
			 * Single Post / Page Title Color
			 */
			'.ast-single-post .entry-title, .page-title' => array(
				'color' => esc_attr( $entry_title_color ),
			),

			/**
			 * Sidebar
			 */
			'.sidebar-main'                              => astra_get_background_obj( $sidebar_bg_obj ),
			'.secondary .widget-title, .secondary .widget-title *' => array(
				'color' => esc_attr( $sidebar_wgt_title_color ),
			),
			'.secondary'                                 => array(
				'color' => esc_attr( $sidebar_text_color ),
			),
			'.secondary a'                               => array(
				'color' => esc_attr( $sidebar_link_color ),
			),
			'.secondary a:hover'                         => array(
				'color' => esc_attr( $sidebar_link_h_color ),
			),
			'.secondary .tagcloud a:hover, .secondary .tagcloud a.current-item' => array(
				'border-color'     => esc_attr( $sidebar_link_color ),
				'background-color' => esc_attr( $sidebar_link_color ),
			),
			'.secondary .calendar_wrap #today, .secondary a:hover + .post-count' => array(
				'background-color' => esc_attr( $sidebar_link_color ),
			),

			/**
			 * Blog / Archive Title
			 */
			'.entry-title a'                             => array(
				'color' => esc_attr( $page_title_color ),
			),

			/**
			 * Blog / Archive Meta
			 */
			'.read-more a:not(.ast-button):hover, .entry-meta a:hover, .entry-meta a:hover *' => array(
				'color' => esc_attr( $post_meta_link_h_color ),
			),
			'.entry-meta a, .entry-meta a *, .read-more a:not(.ast-button)' => array(
				'color' => esc_attr( $post_meta_link_color ),
			),

			'.entry-meta, .entry-meta *'                 => array(
				'color' => esc_attr( $post_meta_color ),
			),

			/**
			 * Footer
			 */
			'.ast-small-footer'                          => array(
				'color' => esc_attr( $footer_color ),
			),
			'.ast-small-footer a'                        => array(
				'color' => esc_attr( $footer_link_color ),
			),
			'.ast-small-footer a:hover'                  => array(
				'color' => esc_attr( $footer_link_h_color ),
			),

		);

		/**
		 * Restricting this CSS to load because we introduced color controls in theme directly for Site Title & Tagline.
		 *
		 * @since 3.5.0
		 */
		if ( astra_addon_check_theme_3_5_0_version() ) {
			$header_color_site_title   = astra_get_option( 'header-color-site-title' );
			$header_color_h_site_title = astra_get_option( 'header-color-h-site-title' );
			$header_color_site_tagline = astra_get_option( 'header-color-site-tagline' );
			/**
			 * Header
			 */
			$css_output['.site-title a, .site-title a:focus, .site-title a:hover, .site-title a:visited'] = array(
				'color' => esc_attr( $header_color_site_title ),
			);
			$css_output['.site-header .site-title a:hover'] = array(
				'color' => esc_attr( $header_color_h_site_title ),
			);
			$css_output['.site-header .site-description']   = array(
				'color' => esc_attr( $header_color_site_tagline ),
			);
		}

		/* Parse CSS from array() */
		$css_output = astra_parse_css( $css_output );

		// Container Layout Colors.
		$separate_container_css = array(

			/**
			 * Archive Summary Background Color
			 */
			'.ast-separate-container .ast-archive-description' => array(
				'background-color' => esc_attr( $archive_summary_bg_color ),
			),

			'.ast-archive-description'             => array(
				'color' => esc_attr( $archive_summary_text_color ),
			),

			'.ast-archive-description .page-title' => array(
				'color' => esc_attr( $archive_summary_title_color ),
			),
		);

		if ( astra_addon_has_gcp_typo_preset_compatibility() ) {

			$content_bg_obj = astra_get_option( 'content-bg-obj-responsive' );

			$separate_container_css['.ast-separate-container .ast-article-single:not(.ast-related-post), .ast-separate-container .comment-respond,.ast-separate-container .ast-comment-list li, .ast-separate-container .ast-woocommerce-container, .ast-separate-container .error-404, .ast-separate-container .no-results, .single.ast-separate-container .ast-author-meta, .ast-separate-container .related-posts-title-wrapper, .ast-separate-container.ast-two-container #secondary .widget,.ast-separate-container .comments-count-wrapper, .ast-box-layout.ast-plain-container .site-content,.ast-padded-layout.ast-plain-container .site-content'] = astra_get_responsive_background_obj( $content_bg_obj, 'desktop' );

			// Container Layout Colors.
			$separate_container_css_tablet = array(
				'.ast-separate-container .ast-article-single:not(.ast-related-post), .ast-separate-container .comment-respond,.ast-separate-container .ast-comment-list li, .ast-separate-container .ast-woocommerce-container, .ast-separate-container .error-404, .ast-separate-container .no-results, .single.ast-separate-container .ast-author-meta, .ast-separate-container .related-posts-title-wrapper, .ast-separate-container.ast-two-container #secondary .widget,.ast-separate-container .comments-count-wrapper, .ast-box-layout.ast-plain-container .site-content,.ast-padded-layout.ast-plain-container .site-content' => astra_get_responsive_background_obj( $content_bg_obj, 'tablet' ),
			);
			// Container Layout Colors.
			$separate_container_css_mobile = array(
				'.ast-separate-container .ast-article-single:not(.ast-related-post), .ast-separate-container .comment-respond,.ast-separate-container .ast-comment-list li, .ast-separate-container .ast-woocommerce-container, .ast-separate-container .error-404, .ast-separate-container .no-results, .single.ast-separate-container .ast-author-meta, .ast-separate-container .related-posts-title-wrapper, .ast-separate-container.ast-two-container #secondary .widget,.ast-separate-container .comments-count-wrapper, .ast-box-layout.ast-plain-container .site-content,.ast-padded-layout.ast-plain-container .site-content' => astra_get_responsive_background_obj( $content_bg_obj, 'mobile' ),
			);

			// Blog Pro Layout Colors.
			if ( 'blog-layout-1' == $blog_layout && 1 != $blog_grid ) {
				$blog_layouts        = array(
					'.ast-separate-container .blog-layout-1, .ast-separate-container .blog-layout-2, .ast-separate-container .blog-layout-3' => astra_get_responsive_background_obj( $content_bg_obj, 'desktop' ),
				);
				$blog_layouts_tablet = array(
					'.ast-separate-container .blog-layout-1, .ast-separate-container .blog-layout-2, .ast-separate-container .blog-layout-3' => astra_get_responsive_background_obj( $content_bg_obj, 'tablet' ),
				);
				$blog_layouts_mobile = array(
					'.ast-separate-container .blog-layout-1, .ast-separate-container .blog-layout-2, .ast-separate-container .blog-layout-3' => astra_get_responsive_background_obj( $content_bg_obj, 'mobile' ),
				);
			} else {
				$blog_layouts        = array(
					'.ast-separate-container .ast-article-post' => astra_get_responsive_background_obj( $content_bg_obj, 'desktop' ),
				);
				$blog_layouts_tablet = array(
					'.ast-separate-container .ast-article-post' => astra_get_responsive_background_obj( $content_bg_obj, 'tablet' ),
				);
				$blog_layouts_mobile = array(
					'.ast-separate-container .ast-article-post' => astra_get_responsive_background_obj( $content_bg_obj, 'mobile' ),
				);
				$inner_layout        = array(
					'.ast-separate-container .blog-layout-1, .ast-separate-container .blog-layout-2, .ast-separate-container .blog-layout-3' => array(
						'background-color' => 'transparent',
						'background-image' => 'none',
					),
				);
				$css_output         .= astra_parse_css( $inner_layout );
			}

			$css_output .= astra_parse_css( $blog_layouts );
			$css_output .= astra_parse_css( $blog_layouts_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $blog_layouts_mobile, '', astra_addon_get_mobile_breakpoint() );
		}

		$css_output .= astra_parse_css( $separate_container_css );

		if ( astra_addon_has_gcp_typo_preset_compatibility() ) {
			$css_output .= astra_parse_css( $separate_container_css_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $separate_container_css_mobile, '', astra_addon_get_mobile_breakpoint() );
		}

		// Sidebar Foreground color.
		if ( ! empty( $sidebar_link_color ) ) {
			$sidebar_foreground = array(
				'.secondary .tagcloud a:hover, .secondary .tagcloud a.current-item' => array(
					'color' => astra_get_foreground_color( $sidebar_link_color ),
				),
				'.secondary .calendar_wrap #today' => array(
					'color' => astra_get_foreground_color( $sidebar_link_color ),
				),
			);
			$css_output        .= astra_parse_css( $sidebar_foreground );
		}

		if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

			/**
			 * Responsive Colors options
			 * [1]. Header Responsive Background with Image
			 * [2]. Primary Menu Responsive Colors
			 */
			$desktop_colors = array(

				/**
				 * Header
				 */
				'.main-header-bar' => astra_get_responsive_background_obj( $header_bg_obj, 'desktop' ),
				/**
				 * Primary Menu
				 */
				'.main-header-menu, .ast-header-break-point .main-header-menu, .ast-header-break-point .ast-header-custom-item' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' ),
				'.main-header-menu .current-menu-item > .menu-link, .main-header-menu .current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $primary_menu_a_color['desktop'] ),
					'background-color' => esc_attr( $primary_menu_a_bg_color['desktop'] ),
				),
				'.main-header-menu .menu-link:hover, .ast-header-custom-item a:hover, .main-header-menu .menu-item:hover > .menu-link, .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
					'color'            => esc_attr( $primary_menu_h_color['desktop'] ),
				),
				'.main-header-menu .ast-masthead-custom-menu-items a:hover, .main-header-menu .menu-item:hover > .ast-menu-toggle, .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
					'color' => esc_attr( $primary_menu_h_color['desktop'] ),
				),

				'.main-header-menu, .main-header-menu .menu-link, .ast-header-custom-item, .ast-header-custom-item a,  .ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items a' => array(
					'color' => esc_attr( $primary_menu_color['desktop'] ),
				),

				/**
				 * Primary Submenu
				 */
				'.main-header-menu .sub-menu, .main-header-menu .sub-menu .menu-link' => array(
					'color' => esc_attr( $primary_submenu_color['desktop'] ),
				),
				'.main-header-menu .sub-menu .menu-link:hover, .main-header-menu .sub-menu .menu-item:hover > .menu-link, .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
					'color'            => esc_attr( $primary_submenu_h_color['desktop'] ),
					'background-color' => esc_attr( $primary_submenu_h_bg_color['desktop'] ),
				),
				'.main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
					'color' => esc_attr( $primary_submenu_h_color['desktop'] ),
				),
				'.main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
					'color'            => esc_attr( $primary_submenu_a_color['desktop'] ),
					'background-color' => esc_attr( $primary_submenu_a_bg_color['desktop'] ),
				),
				'.main-navigation .sub-menu, .ast-header-break-point .main-header-menu .sub-menu' => array(
					'background-color' => esc_attr( $primary_submenu_bg_color['desktop'] ),
				),
			);

			$tablet_colors = array(
				/**
				 * Header
				 */
				'.main-header-bar' => astra_get_responsive_background_obj( $header_bg_obj, 'tablet' ),

				/**
				 * Primary Menu
				 */
				'.main-header-menu, .ast-header-break-point .main-header-menu, .ast-header-break-point .ast-header-custom-item' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' ),
				'.main-header-menu .current-menu-item > .menu-link, .main-header-menu .current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $primary_menu_a_color['tablet'] ),
					'background-color' => esc_attr( $primary_menu_a_bg_color['tablet'] ),
				),
				'.main-header-menu .menu-link:hover, .ast-header-custom-item a:hover, .main-header-menu .menu-item:hover > .menu-link, .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['tablet'] ),
					'color'            => esc_attr( $primary_menu_h_color['tablet'] ),
				),
				'.main-header-menu .ast-masthead-custom-menu-items a:hover, .main-header-menu .menu-item:hover > .ast-menu-toggle, .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
					'color' => esc_attr( $primary_menu_h_color['tablet'] ),
				),

				'.main-header-menu, .main-header-menu .menu-link, .ast-header-custom-item, .ast-header-custom-item a,  .ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items a' => array(
					'color' => esc_attr( $primary_menu_color['tablet'] ),
				),

				/**
				 * Primary Submenu
				 */
				'.main-header-menu .sub-menu, .main-header-menu .sub-menu .menu-link' => array(
					'color' => esc_attr( $primary_submenu_color['tablet'] ),
				),
				'.main-header-menu .sub-menu .menu-link:hover, .main-header-menu .sub-menu .menu-item:hover > .menu-link, .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
					'color'            => esc_attr( $primary_submenu_h_color['tablet'] ),
					'background-color' => esc_attr( $primary_submenu_h_bg_color['tablet'] ),
				),
				'.main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
					'color' => esc_attr( $primary_submenu_h_color['tablet'] ),
				),
				'.main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $primary_submenu_a_color['tablet'] ),
					'background-color' => esc_attr( $primary_submenu_a_bg_color['tablet'] ),
				),
				'.main-navigation .sub-menu, .ast-header-break-point .main-header-menu .sub-menu' => array(
					'background-color' => esc_attr( $primary_submenu_bg_color['tablet'] ),
				),
			);
			$mobile_colors = array(
				/**
				 * Header
				 */
				'.main-header-bar' => astra_get_responsive_background_obj( $header_bg_obj, 'mobile' ),

				/**
				 * Primary Menu
				 */
				'.main-header-menu, .ast-header-break-point .main-header-menu, .ast-header-break-point .ast-header-custom-item' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' ),
				'.main-header-menu .current-menu-item > .menu-link, .main-header-menu .current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $primary_menu_a_color['mobile'] ),
					'background-color' => esc_attr( $primary_menu_a_bg_color['mobile'] ),
				),
				'.main-header-menu .menu-link:hover, .ast-header-custom-item a:hover, .main-header-menu .menu-item:hover > .menu-link, .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['mobile'] ),
					'color'            => esc_attr( $primary_menu_h_color['mobile'] ),
				),
				'.main-header-menu .ast-masthead-custom-menu-items a:hover, .main-header-menu .menu-item:hover > .ast-menu-toggle, .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
					'color' => esc_attr( $primary_menu_h_color['mobile'] ),
				),

				'.main-header-menu, .main-header-menu .menu-link, .ast-header-custom-item, .ast-header-custom-item .menu-link, .ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items a' => array(
					'color' => esc_attr( $primary_menu_color['mobile'] ),
				),

				/**
				 * Primary Submenu
				 */
				'.main-header-menu .sub-menu, .main-header-menu .sub-menu .menu-link' => array(
					'color' => esc_attr( $primary_submenu_color['mobile'] ),
				),
				'.main-header-menu .sub-menu .menu-link:hover, .main-header-menu .sub-menu .menu-item:hover > .menu-link, .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
					'color'            => esc_attr( $primary_submenu_h_color['mobile'] ),
					'background-color' => esc_attr( $primary_submenu_h_bg_color['mobile'] ),
				),
				'.main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
					'color' => esc_attr( $primary_submenu_h_color['mobile'] ),
				),
				'.main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $primary_submenu_a_color['mobile'] ),
					'background-color' => esc_attr( $primary_submenu_a_bg_color['mobile'] ),
				),
				'.main-navigation .sub-menu, .ast-header-break-point .main-header-menu .sub-menu' => array(
					'background-color' => esc_attr( $primary_submenu_bg_color['mobile'] ),
				),
			);

			// Primary Menu Desabled.
			if ( $disable_primary_nav ) {
				// Set Primary Menu background color to the Custom Menu Item.
				$desktop_colors['.ast-header-break-point .ast-header-custom-item'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' );
				$tablet_colors['.ast-header-break-point .ast-header-custom-item']  = astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' );
				$mobile_colors['.ast-header-break-point .ast-header-custom-item']  = astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' );
			}

			/* Parse CSS from array() */
			$css_output .= apply_filters( 'astra_addon_colors_dynamic_css_desktop', astra_parse_css( $desktop_colors ) );
			$css_output .= apply_filters( 'astra_addon_colors_dynamic_css_tablet', astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() ) );
			$css_output .= apply_filters( 'astra_addon_colors_dynamic_css_mobile', astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() ) );

			// All the primary menu bg color is not set then set the default header bg color to the primary menu for responsive devices.
			if ( '' == $primary_menu_bg_image['desktop']['background-color'] ) {
				$menu_bg_color = array(
					'.ast-header-break-point .main-header-menu' => array(
						'background-color' => esc_attr( $desktop_header_bg_color ),
					),
				);
				$css_output   .= astra_parse_css( $menu_bg_color );
			}
			if ( '' == $primary_menu_bg_image['tablet']['background-color'] ) {
				$menu_bg_color = array(
					'.ast-header-break-point .main-header-menu' => array(
						'background-color' => esc_attr( $tablet_header_bg_color ),
					),
				);
				$css_output   .= astra_parse_css( $menu_bg_color, '', astra_addon_get_tablet_breakpoint() );
			}
			if ( '' == $primary_menu_bg_image['mobile']['background-color'] ) {
				$menu_bg_color = array(
					'.ast-header-break-point .main-header-menu' => array(
						'background-color' => esc_attr( $mobile_header_bg_color ),
					),
				);
				$css_output   .= astra_parse_css( $menu_bg_color, '', astra_addon_get_mobile_breakpoint() );
			}
		}

		/**
		 * Search Colors Dynamic CSS.
		 */

		$search_selector      = '.ast-header-search .ast-search-menu-icon';
		$search_border_size   = astra_get_option( 'header-search-border-size' );
		$search_border_radius = astra_get_option( 'header-search-border-radius' );

		$icon_h_color_desktop = astra_get_prop( astra_get_option( 'header-search-icon-h-color' ), 'desktop' );
		$icon_h_color_tablet  = astra_get_prop( astra_get_option( 'header-search-icon-h-color' ), 'tablet' );
		$icon_h_color_mobile  = astra_get_prop( astra_get_option( 'header-search-icon-h-color' ), 'mobile' );

		$text_color_desktop = astra_get_prop( astra_get_option( 'header-search-text-placeholder-color' ), 'desktop' );
		$text_color_tablet  = astra_get_prop( astra_get_option( 'header-search-text-placeholder-color' ), 'tablet' );
		$text_color_mobile  = astra_get_prop( astra_get_option( 'header-search-text-placeholder-color' ), 'mobile' );

		$search_height_desktop = astra_get_prop( astra_get_option( 'header-search-height' ), 'desktop' );
		$search_height_tablet  = astra_get_prop( astra_get_option( 'header-search-height' ), 'tablet' );
		$search_height_mobile  = astra_get_prop( astra_get_option( 'header-search-height' ), 'mobile' );

		$search_css_output = array(
			// Search Box Background.
			$search_selector . ' .search-field'           => array(
				'background-color' => esc_attr( astra_get_option( 'header-search-box-background-color' ) ),

				// Search Box Border.
				'border-radius'    => astra_get_css_value( $search_border_radius, 'px' ),
			),
			$search_selector . ' .search-submit'          => array(
				'background-color' => esc_attr( astra_get_option( 'header-search-box-background-color' ) ),

				// Search Box Border.
				'border-radius'    => astra_get_css_value( $search_border_radius, 'px' ),
			),
			$search_selector . ' .search-form'            => array(
				'background-color'    => esc_attr( astra_get_option( 'header-search-box-background-color' ) ),

				// Search Box Border.
				'border-top-width'    => astra_get_css_value( $search_border_size['top'], 'px' ),
				'border-bottom-width' => astra_get_css_value( $search_border_size['bottom'], 'px' ),
				'border-left-width'   => astra_get_css_value( $search_border_size['left'], 'px' ),
				'border-right-width'  => astra_get_css_value( $search_border_size['right'], 'px' ),
				'border-color'        => esc_attr( astra_get_option( 'header-search-border-color' ) ),
				'border-radius'       => astra_get_css_value( $search_border_radius, 'px' ),
			),

			$search_selector . ' .search-form:hover, .ast-search-icon:hover + .search-form' => array(
				'border-color' => esc_attr( astra_get_option( 'header-search-border-h-color' ) ),
			),

			// Seach Full Screen Overlay Color.
			'.ast-search-box.full-screen, .ast-search-box.header-cover' => array(
				'background' => esc_attr( astra_get_option( 'header-search-overlay-color' ) ),
			),

			// Search Overlay Text Color.
			'.ast-search-box.header-cover #close, .ast-search-box.full-screen #close, .ast-search-box.full-screen .ast-search-wrapper .large-search-text, .ast-search-box.header-cover .search-submit, .ast-search-box.full-screen .search-submit, .ast-search-box.header-cover .search-field, .ast-search-box.full-screen .search-field, .ast-search-box.header-cover .search-field::-webkit-input-placeholder, .ast-search-box.full-screen .search-field::-webkit-input-placeholder' => array(
				'color' => esc_attr( astra_get_option( 'header-search-overlay-text-color' ) ),
			),

			'.ast-search-box.full-screen .ast-search-wrapper fieldset' => array(
				'border-color' => esc_attr( astra_get_option( 'header-search-overlay-text-color' ) ),
			),

			'.ast-header-break-point ' . $search_selector . '.slide-search:hover .search-field, .ast-header-break-point ' . $search_selector . '.slide-search:focus .search-field, .ast-header-break-point ' . $search_selector . '.slide-search:hover .search-submit, .ast-header-break-point ' . $search_selector . '.slide-search:focus .search-submit, .ast-header-break-point ' . $search_selector . '.slide-search:hover .search-form, .ast-header-break-point ' . $search_selector . '.slide-search:focus .search-form' => array(
				'background-color' => esc_attr( astra_get_option( 'header-search-box-background-color' ) ),
			),

			$search_selector . ':hover .search-field, ' . $search_selector . ':focus .search-field' => array(
				'background-color' => esc_attr( astra_get_option( 'header-search-box-background-h-color' ) ),
			),
			$search_selector . ':hover .search-submit, ' . $search_selector . ':focus .search-submit' => array(
				'background-color' => esc_attr( astra_get_option( 'header-search-box-background-h-color' ) ),
			),
			$search_selector . ':hover .search-form, ' . $search_selector . ':focus .search-form' => array(
				'background-color' => esc_attr( astra_get_option( 'header-search-box-background-h-color' ) ),
			),
			'.ast-header-search .astra-search-icon:hover' => array(
				'color' => esc_attr( $icon_h_color_desktop ),
			),
			$search_selector . ' .search-field, ' . $search_selector . ' .search-field::placeholder' => array(
				'color' => esc_attr( $text_color_desktop ),
			),
		);

		// Checking valid height value to remove CSS parse error -> .selector { height: px; }.
		if ( '' !== $search_height_desktop && null !== $search_height_desktop ) {
			$search_css_output[ $search_selector . ' form.search-form .search-field' ] = array(
				'height' => astra_get_css_value( $search_height_desktop, 'px' ),
			);
		}

		$search_css_output_tablet = array(
			'.ast-header-search .astra-search-icon:hover' => array(
				'color' => esc_attr( $icon_h_color_tablet ),
			),
			$search_selector . ' .search-field, ' . $search_selector . ' .search-field::placeholder' => array(
				'color' => esc_attr( $text_color_tablet ),
			),
		);

		if ( '' !== $search_height_tablet && null !== $search_height_tablet ) {
			$search_css_output_tablet[ '.ast-header-break-point ' . $search_selector . ' .search-form .search-field' ] = array(
				'height' => astra_get_css_value( $search_height_tablet, 'px' ),
			);
		}

		$search_css_output_mobile = array(
			'.ast-header-search .astra-search-icon:hover' => array(
				'color' => esc_attr( $icon_h_color_mobile ),
			),
			$search_selector . ' .search-field, ' . $search_selector . ' .search-field::placeholder' => array(
				'color' => esc_attr( $text_color_mobile ),
			),
		);

		if ( '' !== $search_height_mobile && null !== $search_height_mobile ) {
			$search_css_output_mobile[ '.ast-header-break-point ' . $search_selector . ' .search-form .search-field' ] = array(
				'height' => astra_get_css_value( $search_height_mobile, 'px' ),
			);
		}

		$css_output .= astra_parse_css( $search_css_output );
		$css_output .= astra_parse_css( $search_css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $search_css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		return $dynamic_css . $css_output;
	}

}

/**
*  Kicking this off by calling 'get_instance()' method
*/
new Astra_Addon_Colors_Dynamic_CSS();
