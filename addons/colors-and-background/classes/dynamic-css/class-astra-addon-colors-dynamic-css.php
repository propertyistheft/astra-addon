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

		$h1_color = astra_get_option( 'h1-color' );
		$h2_color = astra_get_option( 'h2-color' );
		$h3_color = astra_get_option( 'h3-color' );
		$h4_color = astra_get_option( 'h4-color' );
		$h5_color = astra_get_option( 'h5-color' );
		$h6_color = astra_get_option( 'h6-color' );

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

		$page_title_color = astra_get_option( 'page-title-color' );

		$post_meta_color        = astra_get_option( 'post-meta-color' );
		$post_meta_link_color   = astra_get_option( 'post-meta-link-color' );
		$post_meta_link_h_color = astra_get_option( 'post-meta-link-h-color' );

		$post_excerpt_color = astra_get_option( 'blog-excerpt-color' );

		$post_read_more_color   = astra_get_option( 'blog-read-more-color' );
		$post_read_more_h_cover = astra_get_option( 'blog-read-more-h-color' );

		$post_tax_color   = astra_get_option( 'blog-tax-color' );
		$post_tax_h_color = astra_get_option( 'blog-tax-h-color' );

		$post_tax_bg_color   = astra_get_option( 'blog-tax-bg-color' );
		$post_tax_bg_h_color = astra_get_option( 'blog-tax-bg-h-color' );

		$post_tax_border_color   = astra_get_option( 'blog-tax-border-color' );
		$post_tax_border_h_color = astra_get_option( 'blog-tax-border-h-color' );

		$post_blog_content_color    = astra_get_option( 'blog-content-color' );
		$post_blog_bg_content_color = astra_get_option( 'blog-content-bg-color' );

		$blog_tax_normal = '.ast-blog-single-element.ast-taxonomy-container a';
		$blog_tax_hover  = '.ast-blog-single-element.ast-taxonomy-container a:hover';

		$blog_tax_normal_bg = '.ast-blog-single-element.ast-taxonomy-container.badge a';
		$blog_tax_hover_bg  = '.ast-blog-single-element.ast-taxonomy-container.badge a:hover';

		$post_excerpt_normal = '.ast-excerpt-container';

		$post_read_more_normal = '.ast-read-more-container a:not(.ast-button)';
		$post_read_more_hover  = '.ast-read-more-container a:not(.ast-button):hover';

		$post_blog_content_color_normal    = 'div.ast-blog-layout-6-grid .blog-layout-6 .ast-blog-single-element *';
		$post_blog_bg_content_color_normal = 'div.ast-blog-layout-6-grid .blog-layout-6 .ast-blog-featured-section:before';

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
		 * Normal Colors without responsive option.
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
		 * Normal Colors without responsive option.
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
			'h1, .entry-content h1'            => array(
				'color' => esc_attr( $h1_color ),
			),
			'h2, .entry-content h2'            => array(
				'color' => esc_attr( $h2_color ),
			),
			'h3, .entry-content h3'            => array(
				'color' => esc_attr( $h3_color ),
			),
			'h4, .entry-content h4'            => array(
				'color' => esc_attr( $h4_color ),
			),
			'h5, .entry-content h5'            => array(
				'color' => esc_attr( $h5_color ),
			),
			'h6, .entry-content h6'            => array(
				'color' => esc_attr( $h6_color ),
			),

			/**
			 * Sidebar
			 */
			'.sidebar-main'                    => astra_get_background_obj( $sidebar_bg_obj ),
			'.secondary .widget-title, .secondary .widget-title *' => array(
				'color' => esc_attr( $sidebar_wgt_title_color ),
			),
			'.secondary'                       => array(
				'color' => esc_attr( $sidebar_text_color ),
			),
			'.secondary a'                     => array(
				'color' => esc_attr( $sidebar_link_color ),
			),
			'.secondary a:hover'               => array(
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
			'.entry-title a'                   => array(
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

			'.entry-meta, .entry-meta *'       => array(
				'color' => esc_attr( $post_meta_color ),
			),

			/**
			 * Blog / Archive Taxonomy Color
			 */
			$blog_tax_normal                   => array(
				'color'        => esc_attr( $post_tax_color ),
				'border-color' => esc_attr( $post_tax_border_color ),
			),

			/**
			 * Blog / Archive Taxonomy Background Color
			 */
			$blog_tax_normal_bg                => array(
				'background-color' => esc_attr( $post_tax_bg_color ),
			),

			/**
			 * Blog / Archive Taxonomy Color
			 */
			$blog_tax_hover                    => array(
				'color'        => esc_attr( $post_tax_h_color ),
				'border-color' => esc_attr( $post_tax_border_h_color ),
			),

			/**
			 * Blog / Archive Background Taxonomy Color Hover
			 */
			$blog_tax_hover_bg                 => array(
				'background-color' => esc_attr( $post_tax_bg_h_color ),
			),

			/**
			 *Blog / Archive  Blog Excerpt Color
			 */
			$post_excerpt_normal               => array(
				'color' => esc_attr( $post_excerpt_color ),
			),

			/**
			 *Blog / Archive  Blog Read More Color
			 */
			$post_read_more_normal             => array(
				'color' => esc_attr( $post_read_more_color ),
			),

			/**
			 *Blog / Archive  Blog Read More Hover Color
			 */
			$post_read_more_hover              => array(
				'color' => esc_attr( $post_read_more_h_cover ),
			),

			/**
			 *Blog / Archive Content Color
			 */
			$post_blog_content_color_normal    => array(
				'color' => esc_attr( $post_blog_content_color ),
			),

			/**
			 *Blog / Archive Content Color.
			 */
			$post_blog_bg_content_color_normal => array(
				'background-color' => esc_attr( $post_blog_bg_content_color ),
			),

			/**
			 * Footer
			 */
			'.ast-small-footer'                => array(
				'color' => esc_attr( $footer_color ),
			),
			'.ast-small-footer a'              => array(
				'color' => esc_attr( $footer_link_color ),
			),
			'.ast-small-footer a:hover'        => array(
				'color' => esc_attr( $footer_link_h_color ),
			),

		);

		/* Parse CSS from array() */
		$css_output = astra_parse_css( $css_output );

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

			// Search Full Screen Overlay Color.
			'.ast-search-box.full-screen, .ast-search-box.header-cover' => array(
				'background' => esc_attr( astra_get_option( 'header-search-overlay-color' ) ),
			),

			// Search Overlay Text Color.
			'.ast-search-box.header-cover #close, .ast-search-box.full-screen #close, .ast-search-box.full-screen .ast-search-wrapper .large-search-text, .ast-search-box.header-cover .search-submit, .ast-search-box.header-cover .search-field, .ast-search-box.full-screen .search-field, .ast-search-box.header-cover .search-field::-webkit-input-placeholder, .ast-search-box.full-screen .search-field::-webkit-input-placeholder, .full-screen .ast-live-search-results *, .ast-search-box.full-screen .ast-search--posttype-heading' => array(
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
