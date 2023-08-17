<?php
/**
 * Spacing - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_ext_spacing_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_spacing_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	// Spacing.
	$is_site_rtl                  = is_rtl();
	$site_identity_spacing        = astra_get_option( 'site-identity-spacing' );
	$continder_outside_spacing    = astra_get_option( 'container-outside-spacing' );
	$container_inside_spacing     = astra_get_option( 'container-inside-spacing' );
	$single_post_inside_spacing   = astra_get_option( 'single-post-inside-spacing' );
	$header_spacing               = astra_get_option( 'header-spacing' );
	$primary_menu_spacing         = astra_get_option( 'primary-menu-spacing' );
	$primary_submenu_spacing      = astra_get_option( 'primary-submenu-spacing' );
	$above_header_spacing         = astra_get_option( 'above-header-spacing' );
	$above_header_menu_spacing    = astra_get_option( 'above-header-menu-spacing' );
	$above_header_submenu_spacing = astra_get_option( 'above-header-submenu-spacing' );

	$below_header_spacing         = astra_get_option( 'below-header-spacing' );
	$below_header_menu_spacing    = astra_get_option( 'below-header-menu-spacing' );
	$below_header_submenu_spacing = astra_get_option( 'below-header-submenu-spacing' );
	$sidebar_outside_spacing      = astra_get_option( 'sidebar-outside-spacing' );
	$sidebar_inside_spacing       = astra_get_option( 'sidebar-inside-spacing' );
	$astra_footer_width           = astra_get_option( 'footer-layout-width' );
	$footer_spacing               = astra_get_option( 'footer-sml-spacing' );
	$footer_menu_spacing          = astra_get_option( 'footer-menu-spacing' );
	$site_content_layout          = astra_get_option( 'site-content-layout' );
	$header_content_layout        = astra_get_option( 'header-main-layout-width' );
	$header_layouts               = astra_get_option( 'header-layouts' );

	// Sticky header.
	$stick_header_main       = astra_get_option( 'header-main-stick' );
	$stick_header_main_meta  = astra_get_option_meta( 'header-main-stick-meta' );
	$stick_header_above      = astra_get_option( 'header-above-stick' );
	$stick_header_above_meta = astra_get_option_meta( 'header-above-stick-meta' );
	$stick_header_below      = astra_get_option( 'header-below-stick' );
	$stick_header_below_meta = astra_get_option_meta( 'header-below-stick-meta' );
	$header_main_shrink      = astra_get_option( 'header-main-shrink' );

	// Blog Grid spacing.
	$blog_grid   = astra_get_option( 'blog-grid' );
	$blog_layout = astra_get_option( 'blog-layout' );

	$blog_post_outside_spacing    = astra_get_option( 'blog-post-outside-spacing' );
	$blog_post_inside_spacing     = astra_get_option( 'blog-post-inside-spacing' );
	$blog_post_pagination_spacing = astra_get_option( 'blog-post-pagination-spacing' );

	$blog_featured_image_padding    = astra_get_option( 'blog-featured-image-padding' );
	$remove_single_featured_padding = astra_get_option( 'single-featured-image-padding' );
	$alignfull_editor_selector      = ( true === astra_get_option( 'improve-gb-editor-ui' ) ) ? '.ast-no-sidebar.ast-separate-container .entry-content > .alignfull, .ast-no-sidebar.ast-narrow-container .entry-content > .alignfull' : '.ast-no-sidebar.ast-separate-container .entry-content .alignfull, .ast-no-sidebar.ast-narrow-container .entry-content .alignfull'; // Updated selector here because there is no requirement of extra spacing for nested alignfull blocks.

	// Desktop Spacing.
	$is_new_strctural_defaults = astra_get_option( 'customizer-default-layout-update', true );

	$spacing = array(

		/**
		 * Content Spacing
		 */
		'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-single, .ast-separate-container .ast-comment-list li.depth-1, .ast-separate-container .comment-respond, .single.ast-separate-container .ast-author-details, .ast-separate-container .ast-related-posts-wrap, .ast-separate-container .ast-woocommerce-container' => array(
			'padding-top'    => astra_responsive_spacing( $container_inside_spacing, 'top', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $container_inside_spacing, 'bottom', 'desktop' ),
		),

		// Narrow Container global inside spacing support.
		'.ast-narrow-container .ast-article-post, .ast-narrow-container .ast-article-single, .ast-narrow-container .ast-comment-list li.depth-1, .ast-narrow-container .comment-respond, .single.ast-narrow-container .ast-author-details, .ast-narrow-container .ast-related-posts-wrap, .ast-narrow-container .ast-woocommerce-container, .ast-narrow-container .ast-single-related-posts-container' => array(
			'padding-top'    => astra_responsive_spacing( $container_inside_spacing, 'top', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $container_inside_spacing, 'bottom', 'desktop' ),
		),
		'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-single,.ast-separate-container .comments-count-wrapper, .ast-separate-container .ast-comment-list li.depth-1, .ast-separate-container .comment-respond,.ast-separate-container .related-posts-title-wrapper,.ast-separate-container .related-posts-title-wrapper, .single.ast-separate-container .ast-author-details, .single.ast-separate-container .about-author-title-wrapper, .ast-separate-container .ast-related-posts-wrap, .ast-separate-container .ast-woocommerce-container' => array(
			'padding-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'desktop' ),
			'padding-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'desktop' ),
		),
		// Narrow Container global inside spacing support.
		'.ast-narrow-container .ast-article-post, .ast-narrow-container .ast-article-single,.ast-narrow-container .comments-count-wrapper, .ast-narrow-container .ast-comment-list li.depth-1, .ast-narrow-container .comment-respond,.ast-narrow-container .related-posts-title-wrapper,.ast-narrow-container .related-posts-title-wrapper, .single.ast-narrow-container .ast-author-details, .single.ast-narrow-container .about-author-title-wrapper, .ast-narrow-container .ast-related-posts-wrap, .ast-narrow-container .ast-woocommerce-container, .ast-narrow-container .ast-single-related-posts-container' => array(
			'padding-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'desktop' ),
			'padding-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'desktop' ),
		),
		'.ast-separate-container.ast-right-sidebar #primary, .ast-separate-container.ast-left-sidebar #primary, .ast-separate-container #primary, .ast-plain-container #primary, .ast-narrow-container #primary' => array(
			'margin-top'    => astra_responsive_spacing( $continder_outside_spacing, 'top', 'desktop' ),
			'margin-bottom' => astra_responsive_spacing( $continder_outside_spacing, 'bottom', 'desktop' ),
		),
		'.ast-left-sidebar #primary, .ast-right-sidebar #primary, .ast-separate-container.ast-right-sidebar #primary, .ast-separate-container.ast-left-sidebar #primary, .ast-separate-container #primary, .ast-narrow-container #primary' => array(
			'padding-left'  => astra_responsive_spacing( $continder_outside_spacing, 'left', 'desktop' ),
			'padding-right' => astra_responsive_spacing( $continder_outside_spacing, 'right', 'desktop' ),
		),

		// Negative margin for the alignfull gutenberg class based on the padding.
		$alignfull_editor_selector => array(
			'margin-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'desktop', '', '-' ),
			'margin-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'desktop', '', '-' ),
		),

		/**
		 * Single Post Content Spacing
		 */
		'.ast-separate-container.ast-single-post .ast-article-post, .ast-separate-container.ast-single-post .ast-article-single, .ast-separate-container.ast-single-post .ast-comment-list li.depth-1, .ast-separate-container.ast-single-post .comment-respond, .ast-separate-container.ast-single-post .ast-related-posts-wrap, .ast-separate-container.ast-single-post .ast-woocommerce-container, .single.ast-separate-container.ast-single-post .ast-author-meta' => array(
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $single_post_inside_spacing, 'bottom', 'desktop' ),
		),

		// Narrow Container single post inside spacing support.
		'.ast-narrow-container.ast-single-post .ast-article-post, .ast-narrow-container.ast-single-post .ast-article-single, .ast-narrow-container.ast-single-post .ast-comment-list li.depth-1, .ast-narrow-container.ast-single-post .comment-respond, .ast-narrow-container.ast-single-post .ast-related-posts-wrap, .ast-narrow-container.ast-single-post .ast-woocommerce-container, .single.ast-narrow-container.ast-single-post .ast-author-meta, .ast-narrow-container.ast-single-post .ast-single-related-posts-container' => array(
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $single_post_inside_spacing, 'bottom', 'desktop' ),
		),

		'.ast-separate-container.ast-single-post .ast-article-post, .ast-separate-container.ast-single-post .ast-article-single, .ast-separate-container.ast-single-post .comments-count-wrapper, .ast-separate-container.ast-single-post .ast-comment-list li.depth-1, .ast-separate-container.ast-single-post .comment-respond,.ast-separate-container.ast-single-post .related-posts-title-wrapper,.ast-separate-container.ast-single-post .related-posts-title-wrapper,  .single.ast-separate-container.ast-single-post .ast-author-meta, .ast-separate-container.ast-single-post .ast-related-posts-wrap, .ast-separate-container.ast-single-post .ast-woocommerce-container' => array(
			'padding-right' => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'desktop' ),
			'padding-left'  => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'desktop' ),
		),

		// Narrow Container single post inside spacing support.
		'.ast-narrow-container.ast-single-post .ast-article-post, .ast-narrow-container.ast-single-post .ast-article-single, .ast-narrow-container.ast-single-post .comments-count-wrapper, .ast-narrow-container.ast-single-post .ast-comment-list li.depth-1, .ast-narrow-container.ast-single-post .comment-respond,.ast-narrow-container.ast-single-post .related-posts-title-wrapper,.ast-narrow-container.ast-single-post .related-posts-title-wrapper,  .single.ast-narrow-container.ast-single-post .ast-author-meta, .ast-narrow-container.ast-single-post .ast-related-posts-wrap, .ast-narrow-container.ast-single-post .ast-woocommerce-container, .ast-narrow-container.ast-single-post .ast-single-related-posts-container' => array(
			'padding-right' => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'desktop' ),
			'padding-left'  => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'desktop' ),
		),

		/**
		 * Sidebar Spacing
		 */
		'.ast-plain-container #secondary, .ast-separate-container #secondary, .ast-page-builder-template #secondary' => array(
			'margin-top'    => astra_responsive_spacing( $sidebar_outside_spacing, 'top', 'desktop' ),
			'margin-bottom' => astra_responsive_spacing( $sidebar_outside_spacing, 'bottom', 'desktop' ),
		),
		'.ast-right-sidebar #secondary, .ast-left-sidebar #secondary, .ast-separate-container.ast-two-container.ast-left-sidebar #secondary, .ast-separate-container.ast-two-container.ast-right-sidebar #secondary, .ast-separate-container.ast-right-sidebar #secondary, .ast-separate-container.ast-left-sidebar #secondary' => array(
			'padding-left'  => astra_responsive_spacing( $sidebar_outside_spacing, 'left', 'desktop' ),
			'padding-right' => astra_responsive_spacing( $sidebar_outside_spacing, 'right', 'desktop' ),
		),
		// Sidebar Inside Spacing Top / Bottom / Left / Right Padding.
		'.ast-separate-container.ast-two-container #secondary .widget, .ast-separate-container #secondary .widget, .ast-plain-container #secondary .widget' => array(
			'padding-top'    => astra_responsive_spacing( $sidebar_inside_spacing, 'top', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $sidebar_inside_spacing, 'bottom', 'desktop' ),
		),
		'.ast-two-container.ast-right-sidebar #secondary .widget, .ast-two-container.ast-left-sidebar #secondary .widget, .ast-separate-container #secondary .widget, .ast-plain-container #secondary .widget' => array(
			'padding-left'  => astra_responsive_spacing( $sidebar_inside_spacing, 'left', 'desktop' ),
			'padding-right' => astra_responsive_spacing( $sidebar_inside_spacing, 'right', 'desktop' ),
		),

		/**
		 * Blog Grid Spacing
		 */
		// Blog Grid Outside Spacing.
		'.ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+1)' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'desktop' ),
		),
		// Narrow Container blog grid support for outside spacing.
		'.ast-narrow-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-narrow-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-narrow-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+1)' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'desktop' ),
		),
		// Blog Grid Inside Spacing.
		'.ast-separate-container .ast-grid-2 .blog-layout-1, .ast-separate-container .ast-grid-2 .blog-layout-2, .ast-separate-container .ast-grid-2 .blog-layout-3, .ast-separate-container .ast-grid-3 .blog-layout-1, .ast-separate-container .ast-grid-3 .blog-layout-2, .ast-separate-container .ast-grid-3 .blog-layout-3, .ast-separate-container .ast-grid-4 .blog-layout-1, .ast-separate-container .ast-grid-4 .blog-layout-2, .ast-separate-container .ast-grid-4 .blog-layout-3' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'desktop' ),
		),
		// Narrow Container blog grid support for inside spacing.
		'.ast-narrow-container .ast-grid-2 .blog-layout-1, .ast-narrow-container .ast-grid-2 .blog-layout-2, .ast-narrow-container .ast-grid-2 .blog-layout-3, .ast-narrow-container .ast-grid-3 .blog-layout-1, .ast-narrow-container .ast-grid-3 .blog-layout-2, .ast-narrow-container .ast-grid-3 .blog-layout-3, .ast-narrow-container .ast-grid-4 .blog-layout-1, .ast-narrow-container .ast-grid-4 .blog-layout-2, .ast-narrow-container .ast-grid-4 .blog-layout-3' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'desktop' ),
		),
		// Blog Pagination Spacing.
		'.ast-pagination'          => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_pagination_spacing, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_pagination_spacing, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_pagination_spacing, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_pagination_spacing, 'left', 'desktop' ),
		),
	);

	if ( $is_new_strctural_defaults ) {
		$spacing['.ast-separate-container .comments-title, .ast-narrow-container .comments-title'] = array(
			'padding-right'  => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'desktop' ),
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'desktop' ),
			'padding-bottom' => '0',
		);
	}

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

		/**
		 * Site Identity Spacing
		 */
		$spacing['.site-header .ast-site-identity'] = array(
			'padding-top'    => astra_responsive_spacing( $site_identity_spacing, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $site_identity_spacing, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $site_identity_spacing, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $site_identity_spacing, 'left', 'desktop' ),
		);
	}

	$spacing_css_output = astra_parse_css( $spacing );

	$tablet_spacing = array(

		/**
		 * Content Spacing
		 */
		'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-single, .ast-separate-container .ast-comment-list li.depth-1, .ast-separate-container .comment-respond, .single.ast-separate-container .ast-author-details, .ast-separate-container .ast-related-posts-wrap, .ast-separate-container .ast-woocommerce-container' => array(
			'padding-top'    => astra_responsive_spacing( $container_inside_spacing, 'top', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $container_inside_spacing, 'bottom', 'tablet' ),
		),
		'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-single,.ast-separate-container .comments-count-wrapper, .ast-separate-container .ast-comment-list li.depth-1, .ast-separate-container .comment-respond,.ast-separate-container .related-posts-title-wrapper,.ast-separate-container .related-posts-title-wrapper, .single.ast-separate-container .ast-author-details, .single.ast-separate-container .about-author-title-wrapper, .ast-separate-container .ast-related-posts-wrap, .ast-separate-container .ast-woocommerce-container, .ast-separate-container .ast-single-related-posts-container' => array(
			'padding-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'tablet' ),
			'padding-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'tablet' ),
		),
		// Narrow Container global tablet support for inside spacing.
		'.ast-narrow-container .ast-article-post, .ast-narrow-container .ast-article-single, .ast-narrow-container .ast-comment-list li.depth-1, .ast-narrow-container .comment-respond, .single.ast-narrow-container .ast-author-details, .ast-narrow-container .ast-related-posts-wrap, .ast-narrow-container .ast-woocommerce-container, .ast-narrow-container .ast-single-related-posts-container' => array(
			'padding-top'    => astra_responsive_spacing( $container_inside_spacing, 'top', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $container_inside_spacing, 'bottom', 'tablet' ),
		),
		// Narrow Container global tablet support for inside spacing.
		'.ast-narrow-container .ast-article-post, .ast-narrow-container .ast-article-single,.ast-narrow-container .comments-count-wrapper, .ast-narrow-container .ast-comment-list li.depth-1, .ast-narrow-container .comment-respond,.ast-narrow-container .related-posts-title-wrapper,.ast-narrow-container .related-posts-title-wrapper, .single.ast-narrow-container .ast-author-details, .single.ast-narrow-container .about-author-title-wrapper, .ast-narrow-container .ast-related-posts-wrap, .ast-narrow-container .ast-woocommerce-container, .ast-narrow-container .ast-single-related-posts-container' => array(
			'padding-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'tablet' ),
			'padding-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'tablet' ),
		),
		'.ast-separate-container.ast-right-sidebar #primary, .ast-separate-container.ast-left-sidebar #primary, .ast-separate-container #primary, .ast-plain-container #primary, .ast-narrow-container #primary' => array(
			'margin-top'    => astra_responsive_spacing( $continder_outside_spacing, 'top', 'tablet' ),
			'margin-bottom' => astra_responsive_spacing( $continder_outside_spacing, 'bottom', 'tablet' ),
		),
		'.ast-left-sidebar #primary, .ast-right-sidebar #primary, .ast-separate-container.ast-right-sidebar #primary, .ast-separate-container.ast-left-sidebar #primary, .ast-separate-container #primary, .ast-narrow-container #primary' => array(
			'padding-left'  => astra_responsive_spacing( $continder_outside_spacing, 'left', 'tablet' ),
			'padding-right' => astra_responsive_spacing( $continder_outside_spacing, 'right', 'tablet' ),
		),

		/**
		 * Single Post Content Spacing
		 */
		'.ast-separate-container.ast-single-post .ast-article-post, .ast-separate-container.ast-single-post .ast-article-single, .ast-separate-container.ast-single-post .ast-comment-list li.depth-1, .ast-separate-container.ast-single-post .comment-respond, .ast-separate-container.ast-single-post .ast-related-posts-wrap, .ast-separate-container.ast-single-post .ast-woocommerce-container, .single.ast-separate-container.ast-single-post .ast-author-meta' => array(
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $single_post_inside_spacing, 'bottom', 'tablet' ),
		),
		// Narrow Container single post tablet support for inside spacing.
		'.ast-narrow-container.ast-single-post .ast-article-post, .ast-narrow-container.ast-single-post .ast-article-single, .ast-narrow-container.ast-single-post .ast-comment-list li.depth-1, .ast-narrow-container.ast-single-post .comment-respond, .ast-narrow-container.ast-single-post .ast-related-posts-wrap, .ast-narrow-container.ast-single-post .ast-woocommerce-container, .single.ast-narrow-container.ast-single-post .ast-author-meta, .ast-narrow-container.ast-single-post .ast-single-related-posts-container' => array(
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $single_post_inside_spacing, 'bottom', 'tablet' ),
		),
		'.ast-separate-container.ast-single-post .ast-article-post, .ast-separate-container.ast-single-post .ast-article-single,.ast-separate-container.ast-single-post .comments-count-wrapper, .ast-separate-container.ast-single-post .ast-comment-list li.depth-1, .ast-separate-container.ast-single-post .comment-respond,.ast-separate-container.ast-single-post .related-posts-title-wrapper,.ast-separate-container.ast-single-post .related-posts-title-wrapper, .single.ast-separate-container.ast-single-post .ast-author-meta, .ast-separate-container.ast-single-post .ast-related-posts-wrap, .ast-separate-container.ast-single-post .ast-woocommerce-container' => array(
			'padding-right' => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'tablet' ),
			'padding-left'  => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'tablet' ),
		),
		'.ast-separate-container.ast-single-post .ast-article-post, .ast-separate-container.ast-single-post .ast-article-single,.ast-separate-container.ast-single-post .comments-count-wrapper, .ast-separate-container.ast-single-post .ast-comment-list li.depth-1, .ast-separate-container.ast-single-post .comment-respond,.ast-separate-container.ast-single-post .related-posts-title-wrapper,.ast-separate-container.ast-single-post .related-posts-title-wrapper, .single.ast-separate-container.ast-single-post .ast-author-meta, .ast-separate-container.ast-single-post .ast-related-posts-wrap, .ast-separate-container.ast-single-post .ast-woocommerce-container' => array(
			'padding-right' => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'tablet' ),
			'padding-left'  => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'tablet' ),
		),
		// Narrow Container single post tablet support for inside spacing.
		'.ast-narrow-container.ast-single-post .ast-article-post, .ast-narrow-container.ast-single-post .ast-article-single,.ast-narrow-container.ast-single-post .comments-count-wrapper, .ast-narrow-container.ast-single-post .ast-comment-list li.depth-1, .ast-narrow-container.ast-single-post .comment-respond,.ast-narrow-container.ast-single-post .related-posts-title-wrapper,.ast-narrow-container.ast-single-post .related-posts-title-wrapper, .single.ast-narrow-container.ast-single-post .ast-author-meta, .ast-narrow-container.ast-single-post .ast-related-posts-wrap, .ast-narrow-container.ast-single-post .ast-woocommerce-container, .ast-narrow-container.ast-single-post .ast-single-related-posts-container' => array(
			'padding-right' => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'tablet' ),
			'padding-left'  => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'tablet' ),
		),

		/**
		 * Blog Grid Spacing
		 */
		// Blog Grid Outside Spacing.
		'.ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+1)' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'tablet' ),
		),
		// Narrow Container blog grid tablet support for outside spacing.
		'.ast-narrow-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-narrow-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-narrow-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+1)' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'tablet' ),
		),
		// Blog Grid Inside Spacing.
		'.ast-separate-container .ast-grid-2 .blog-layout-1, .ast-separate-container .ast-grid-2 .blog-layout-2, .ast-separate-container .ast-grid-2 .blog-layout-3, .ast-separate-container .ast-grid-3 .blog-layout-1, .ast-separate-container .ast-grid-3 .blog-layout-2, .ast-separate-container .ast-grid-3 .blog-layout-3, .ast-separate-container .ast-grid-4 .blog-layout-1, .ast-separate-container .ast-grid-4 .blog-layout-2, .ast-separate-container .ast-grid-4 .blog-layout-3' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'tablet' ),
		),
		// Narrow Container blog grid tablet support for inside spacing.
		'.ast-narrow-container .ast-grid-2 .blog-layout-1, .ast-narrow-container .ast-grid-2 .blog-layout-2, .ast-narrow-container .ast-grid-2 .blog-layout-3, .ast-narrow-container .ast-grid-3 .blog-layout-1, .ast-narrow-container .ast-grid-3 .blog-layout-2, .ast-narrow-container .ast-grid-3 .blog-layout-3, .ast-narrow-container .ast-grid-4 .blog-layout-1, .ast-narrow-container .ast-grid-4 .blog-layout-2, .ast-narrow-container .ast-grid-4 .blog-layout-3' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'tablet' ),
		),
		// Blog Pagination Spacing.
		'.ast-pagination'          => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_pagination_spacing, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_pagination_spacing, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_pagination_spacing, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_pagination_spacing, 'left', 'tablet' ),
		),
		$alignfull_editor_selector => array(
			'margin-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'tablet', '', '-' ),
			'margin-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'tablet', '', '-' ),
		),
	);

	if ( $is_new_strctural_defaults ) {
		$tablet_spacing['.ast-separate-container .comments-title, .ast-narrow-container .comments-title'] = array(
			'padding-right'  => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'tablet' ),
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'tablet' ),
			'padding-bottom' => '0',
		);
	}

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

		/**
		 * Site Identity Spacing
		 */
		$tablet_spacing['.site-header .ast-site-identity'] = array(
			'padding-top'    => astra_responsive_spacing( $site_identity_spacing, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $site_identity_spacing, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $site_identity_spacing, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $site_identity_spacing, 'left', 'tablet' ),
		);
	}

	$spacing_css_output .= astra_parse_css( $tablet_spacing, '', astra_addon_get_tablet_breakpoint() );

	$mobile_spacing = array(

		/**
		 * Content Spacing
		 */
		'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-single, .ast-separate-container .ast-comment-list li.depth-1, .ast-separate-container .comment-respond, .single.ast-separate-container .ast-author-details, .ast-separate-container .ast-related-posts-wrap, .ast-separate-container .ast-woocommerce-container' => array(
			'padding-top'    => astra_responsive_spacing( $container_inside_spacing, 'top', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $container_inside_spacing, 'bottom', 'mobile' ),
		),
		// Narrow Container global mobile support for inside spacing.
		'.ast-narrow-container .ast-article-post, .ast-narrow-container .ast-article-single, .ast-narrow-container .ast-comment-list li.depth-1, .ast-narrow-container .comment-respond, .single.ast-narrow-container .ast-author-details, .ast-narrow-container .ast-related-posts-wrap, .ast-narrow-container .ast-woocommerce-container, .ast-narrow-container .ast-single-related-posts-container' => array(
			'padding-top'    => astra_responsive_spacing( $container_inside_spacing, 'top', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $container_inside_spacing, 'bottom', 'mobile' ),
		),
		'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-single,.ast-separate-container .comments-count-wrapper, .ast-separate-container .ast-comment-list li.depth-1, .ast-separate-container .comment-respond,.ast-separate-container .related-posts-title-wrapper,.ast-separate-container .related-posts-title-wrapper, .single.ast-separate-container .ast-author-details, .single.ast-separate-container .about-author-title-wrapper, .ast-separate-container .ast-related-posts-wrap, .ast-separate-container .ast-woocommerce-container' => array(
			'padding-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'mobile' ),
			'padding-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'mobile' ),
		),
		// Narrow Container global mobile support for inside spacing.
		'.ast-narrow-container .ast-article-post, .ast-narrow-container .ast-article-single,.ast-narrow-container .comments-count-wrapper, .ast-narrow-container .ast-comment-list li.depth-1, .ast-narrow-container .comment-respond,.ast-narrow-container .related-posts-title-wrapper,.ast-narrow-container .related-posts-title-wrapper, .single.ast-narrow-container .ast-author-details, .single.ast-narrow-container .about-author-title-wrapper, .ast-narrow-container .ast-related-posts-wrap, .ast-narrow-container .ast-woocommerce-container, .ast-narrow-container .ast-single-related-posts-container' => array(
			'padding-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'mobile' ),
			'padding-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'mobile' ),
		),
		'.ast-separate-container.ast-right-sidebar #primary, .ast-separate-container.ast-left-sidebar #primary, .ast-separate-container #primary, .ast-plain-container #primary, .ast-narrow-container #primary' => array(
			'margin-top'    => astra_responsive_spacing( $continder_outside_spacing, 'top', 'mobile' ),
			'margin-bottom' => astra_responsive_spacing( $continder_outside_spacing, 'bottom', 'mobile' ),
		),
		'.ast-left-sidebar #primary, .ast-right-sidebar #primary, .ast-separate-container.ast-right-sidebar #primary, .ast-separate-container.ast-left-sidebar #primary, .ast-separate-container #primary, .ast-narrow-container #primary' => array(
			'padding-left'  => astra_responsive_spacing( $continder_outside_spacing, 'left', 'mobile' ),
			'padding-right' => astra_responsive_spacing( $continder_outside_spacing, 'right', 'mobile' ),
		),

		/**
		 * Single Post Content Spacing
		 */
		'.main-navigation ul .menu-item .menu-link, .ast-header-break-point .main-navigation ul .menu-item .menu-link, .ast-header-break-point li.ast-masthead-custom-menu-items, li.ast-masthead-custom-menu-items' => array(
			'padding-top'    => astra_responsive_spacing( $primary_menu_spacing, 'top', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $primary_menu_spacing, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $primary_menu_spacing, 'left', 'mobile' ),
		),
		'.ast-header-break-point .main-navigation ul .menu-item.menu-item-has-children button' => array(
			'padding-right'  => astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $primary_menu_spacing, 'bottom', 'mobile' ),
		),
		'.ast-separate-container.ast-single-post .ast-article-post, .ast-separate-container.ast-single-post .ast-article-single,.ast-separate-container.ast-single-post .comments-count-wrapper, .ast-separate-container.ast-single-post .ast-comment-list li.depth-1, .ast-separate-container.ast-single-post .comment-respond, .ast-separate-container.ast-single-post .related-posts-title-wrapper, .single.ast-separate-container.ast-single-post .ast-author-meta, .ast-separate-container.ast-single-post .ast-related-posts-wrap, .ast-separate-container.ast-single-post .ast-woocommerce-container' => array(
			'padding-right'  => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'mobile' ),
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $single_post_inside_spacing, 'bottom', 'mobile' ),
		),
		// Narrow Container single post mobile support for inside spacing.
		'.ast-narrow-container.ast-single-post .ast-article-post, .ast-narrow-container.ast-single-post .ast-article-single,.ast-narrow-container.ast-single-post .comments-count-wrapper, .ast-narrow-container.ast-single-post .ast-comment-list li.depth-1, .ast-narrow-container.ast-single-post .comment-respond, .ast-narrow-container.ast-single-post .related-posts-title-wrapper, .single.ast-narrow-container.ast-single-post .ast-author-meta, .ast-narrow-container.ast-single-post .ast-related-posts-wrap, .ast-narrow-container.ast-single-post .ast-woocommerce-container' => array(
			'padding-right'  => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'mobile' ),
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $single_post_inside_spacing, 'bottom', 'mobile' ),
		),

		/**
		 * Sidebar Spacing
		 */
		// Sidebar Spacing Top / Bottom Padding.
		'.ast-plain-container #secondary,.ast-separate-container #secondary, .ast-page-builder-template #secondary' => array(
			'margin-top'    => astra_responsive_spacing( $sidebar_outside_spacing, 'top', 'mobile' ),
			'margin-bottom' => astra_responsive_spacing( $sidebar_outside_spacing, 'bottom', 'mobile' ),
		),
		'.ast-right-sidebar #secondary, .ast-left-sidebar #secondary, .ast-separate-container.ast-two-container.ast-left-sidebar #secondary, .ast-separate-container.ast-two-container.ast-right-sidebar #secondary, .ast-separate-container.ast-right-sidebar #secondary, .ast-separate-container.ast-left-sidebar #secondary' => array(
			'padding-left'  => astra_responsive_spacing( $sidebar_outside_spacing, 'left', 'mobile' ),
			'padding-right' => astra_responsive_spacing( $sidebar_outside_spacing, 'right', 'mobile' ),
		),
		// Sidebar Inside Spacing Top / Bottom / Left / Right Padding.
		'.ast-separate-container.ast-two-container #secondary .widget, .ast-separate-container #secondary .widget, .ast-plain-container #secondary .widget' => array(
			'padding-top'    => astra_responsive_spacing( $sidebar_inside_spacing, 'top', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $sidebar_inside_spacing, 'bottom', 'mobile' ),
		),
		'.ast-two-container.ast-right-sidebar #secondary .widget, .ast-two-container.ast-left-sidebar #secondary .widget, .ast-separate-container #secondary .widget, .ast-plain-container #secondary .widget' => array(
			'padding-left'  => astra_responsive_spacing( $sidebar_inside_spacing, 'left', 'mobile' ),
			'padding-right' => astra_responsive_spacing( $sidebar_inside_spacing, 'right', 'mobile' ),
		),

		/**
		 * Blog Grid Spacing
		 */
		// Blog Grid Outside Spacing.
		'.ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+1)' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'mobile' ),
		),
		// Narrow Container blog grid mobile support for outside spacing.
		'.ast-narrow-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-narrow-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-narrow-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-narrow-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+1)' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'mobile' ),
		),
		// Blog Grid Inside Spacing.
		'.ast-separate-container .ast-grid-2 .blog-layout-1, .ast-separate-container .ast-grid-2 .blog-layout-2, .ast-separate-container .ast-grid-2 .blog-layout-3, .ast-separate-container .ast-grid-3 .ast-article-post .blog-layout-1, .ast-separate-container .ast-grid-3 .blog-layout-2, .ast-separate-container .ast-grid-3 .blog-layout-3, .ast-separate-container .ast-grid-4 .ast-article-post .blog-layout-1, .ast-separate-container .ast-grid-4 .blog-layout-2, .ast-separate-container .ast-grid-4 .blog-layout-3' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'mobile' ),
		),
		// Narrow Container blog grid mobile support for inside spacing.
		'.ast-narrow-container .ast-grid-2 .blog-layout-1, .ast-narrow-container .ast-grid-2 .blog-layout-2, .ast-narrow-container .ast-grid-2 .blog-layout-3, .ast-narrow-container .ast-grid-3 .ast-article-post .blog-layout-1, .ast-narrow-container .ast-grid-3 .blog-layout-2, .ast-narrow-container .ast-grid-3 .blog-layout-3, .ast-narrow-container .ast-grid-4 .ast-article-post .blog-layout-1, .ast-narrow-container .ast-grid-4 .blog-layout-2, .ast-narrow-container .ast-grid-4 .blog-layout-3' => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'mobile' ),
		),
		// Blog Pagination Spacing.
		'.ast-pagination'          => array(
			'padding-top'    => astra_responsive_spacing( $blog_post_pagination_spacing, 'top', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $blog_post_pagination_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $blog_post_pagination_spacing, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $blog_post_pagination_spacing, 'left', 'mobile' ),
		),
		$alignfull_editor_selector => array(
			'margin-right' => astra_responsive_spacing( $container_inside_spacing, 'right', 'mobile', '', '-' ),
			'margin-left'  => astra_responsive_spacing( $container_inside_spacing, 'left', 'mobile', '', '-' ),
		),
	);

	if ( $is_new_strctural_defaults ) {
		$mobile_spacing['.ast-separate-container .comments-title, .ast-narrow-container .comments-title'] = array(
			'padding-right'  => astra_responsive_spacing( $single_post_inside_spacing, 'right', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $single_post_inside_spacing, 'left', 'mobile' ),
			'padding-top'    => astra_responsive_spacing( $single_post_inside_spacing, 'top', 'mobile' ),
			'padding-bottom' => '0',
		);
	}

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

		/**
		 * Site Identity Spacing
		 */
		$mobile_spacing['.site-header .ast-site-identity'] = array(
			'padding-top'    => astra_responsive_spacing( $site_identity_spacing, 'top', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $site_identity_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $site_identity_spacing, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $site_identity_spacing, 'left', 'mobile' ),
		);
	}

	$spacing_css_output .= astra_parse_css( $mobile_spacing, '', astra_addon_get_mobile_breakpoint() );

	// Fixed submenu icon issue for RTL in responsive devices.
	if ( $is_site_rtl ) {

		$rtl_desktop_submenu_arrow_css = array(
			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top'  => astra_responsive_spacing( $primary_menu_spacing, 'top', 'desktop' ),
				'left' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'left', 'desktop' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'left' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'left', 'desktop' ), '-', '0.907', 'em' ),
			),
		);

		$rtl_tablet_submenu_arrow_css = array(
			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top'  => astra_responsive_spacing( $primary_menu_spacing, 'top', 'tablet' ),
				'left' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'left', 'tablet' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'left' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'left', 'tablet' ), '-', '0.907', 'em' ),
			),
		);

		$rtl_mobile_submenu_arrow_css = array(
			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top'  => astra_responsive_spacing( $primary_menu_spacing, 'top', 'mobile' ),
				'left' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'left', 'mobile' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'left' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'left', 'mobile' ), '-', '0.907', 'em' ),
			),

		);
		$spacing_css_output .= astra_parse_css( $rtl_desktop_submenu_arrow_css );
		$spacing_css_output .= astra_parse_css( $rtl_tablet_submenu_arrow_css, '', astra_addon_get_tablet_breakpoint() );
		$spacing_css_output .= astra_parse_css( $rtl_mobile_submenu_arrow_css, '', astra_addon_get_mobile_breakpoint() );

	} else {

		$desktop_submenu_arrow_css = array(
			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $primary_menu_spacing, 'top', 'desktop' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ),
			),
		);

		$tablet_submenu_arrow_css = array(
			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $primary_menu_spacing, 'top', 'tablet' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ),
			),
		);

		$mobile_submenu_arrow_css = array(
			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $primary_menu_spacing, 'top', 'mobile' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ),
			),

		);
		$spacing_css_output .= astra_parse_css( $desktop_submenu_arrow_css );
		$spacing_css_output .= astra_parse_css( $tablet_submenu_arrow_css, '', astra_addon_get_tablet_breakpoint() );
		$spacing_css_output .= astra_parse_css( $mobile_submenu_arrow_css, '', astra_addon_get_mobile_breakpoint() );

	}

	$remove_bottom_sire_brancing = array(
		'.ast-header-break-point .header-main-layout-2 .site-branding, .ast-header-break-point .ast-mobile-header-stack .ast-mobile-menu-buttons'                    => array(
			'padding-bottom' => astra_get_css_value( 0, 'px' ),
		),
	);

	if ( isset( $header_spacing['mobile']['bottom'] ) && ( '' != $header_spacing['mobile']['bottom'] ) ) {
		$spacing_css_output .= astra_parse_css( $remove_bottom_sire_brancing, '', astra_addon_get_mobile_breakpoint() );
	}

	/**
	 *
	 * Sidebar Desktop/Tablet/Mobile Spacing
	 */
	$remove_sidebar_widget_outside_margin_desktop = array(
		'.ast-separate-container.ast-two-container #secondary .widget, .ast-separate-container #secondary .widget'                    => array(
			'margin-bottom' => astra_responsive_spacing( $sidebar_outside_spacing, 'bottom', 'desktop' ),
		),
	);
	$spacing_css_output                          .= astra_parse_css( $remove_sidebar_widget_outside_margin_desktop );

	// Tablet.
	$remove_sidebar_widget_outside_margin_tablet = array(
		'.ast-separate-container.ast-two-container #secondary .widget, .ast-separate-container #secondary .widget'                    => array(
			'margin-bottom' => astra_responsive_spacing( $sidebar_outside_spacing, 'bottom', 'tablet' ),
		),
	);
	$spacing_css_output                         .= astra_parse_css( $remove_sidebar_widget_outside_margin_tablet, '', astra_addon_get_tablet_breakpoint() );

	// Mobile.
	$remove_sidebar_widget_outside_margin_mobile = array(
		'.ast-separate-container.ast-two-container #secondary .widget, .ast-separate-container #secondary .widget'                    => array(
			'margin-bottom' => astra_responsive_spacing( $sidebar_outside_spacing, 'bottom', 'mobile' ),
		),
	);
	$spacing_css_output                         .= astra_parse_css( $remove_sidebar_widget_outside_margin_mobile, '', astra_addon_get_mobile_breakpoint() );

	/**
	 * Container Outer spacing
	 */
	// To apply Container Outside Spacing we need to remove default top padding given from the theme.
	$remove_top_padding_container = array(
		'.ast-separate-container #primary, .ast-narrow-container #primary' => array(
			'padding-top' => astra_get_css_value( 0, 'px' ),
		),
	);
	if ( '' != $continder_outside_spacing['desktop']['top'] ) {
		$spacing_css_output .= astra_parse_css( $remove_top_padding_container );
	}
	if ( '' != $continder_outside_spacing['tablet']['top'] ) {
		$spacing_css_output .= astra_parse_css( $remove_top_padding_container, '', astra_addon_get_tablet_breakpoint() );
	}
	if ( '' != $continder_outside_spacing['mobile']['top'] ) {
		$spacing_css_output .= astra_parse_css( $remove_top_padding_container, '', astra_addon_get_mobile_breakpoint() );
	}

	// To apply Container Outside Spacing we need to remove default bottom padding given from the theme.
	$remove_bottom_padding_container = array(
		'.ast-separate-container #primary, .ast-narrow-container #primary' => array(
			'padding-bottom' => astra_get_css_value( 0, 'px' ),
		),
	);
	if ( '' != $continder_outside_spacing['desktop']['top'] ) {
		$spacing_css_output .= astra_parse_css( $remove_bottom_padding_container );
	}
	if ( '' != $continder_outside_spacing['tablet']['top'] ) {
		$spacing_css_output .= astra_parse_css( $remove_bottom_padding_container, '', astra_addon_get_tablet_breakpoint() );
	}
	if ( '' != $continder_outside_spacing['mobile']['top'] ) {
		$spacing_css_output .= astra_parse_css( $remove_bottom_padding_container, '', astra_addon_get_mobile_breakpoint() );
	}

	/**
	 * Blog Grid Outer spacing
	 */
	if ( ( 1 == $blog_grid || 'blog-layout-2' === $blog_layout || 'blog-layout-3' === $blog_layout || ! Astra_Ext_Extension::is_active( 'blog-pro' ) ) ) {
		// Apply margin only if grid is selected 1 column.
		$single_column_margin_blog_pro = array(
			'.ast-separate-container .ast-article-post, .ast-separate-container .ast-separate-posts.ast-article-post, .ast-narrow-container .ast-article-post, .ast-narrow-container .ast-separate-posts.ast-article-post' => array(
				'margin-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'desktop' ),
				'margin-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'desktop' ),
				'margin-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'desktop' ),
				'margin-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'desktop' ),
			),
			'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-post,  .ast-narrow-container .ast-article-post, .ast-narrow-container .ast-separate-posts.ast-article-post' => array(
				'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'desktop' ),
			),
		);
		$spacing_css_output           .= astra_parse_css( $single_column_margin_blog_pro );

		$single_column_margin_blog_pro_tablet = array(
			'.ast-separate-container .ast-article-post, .ast-separate-container .ast-separate-posts.ast-article-post, .ast-narrow-container .ast-article-post, .ast-narrow-container .ast-separate-posts.ast-article-post' => array(
				'margin-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'tablet' ),
				'margin-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'tablet' ),
				'margin-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'tablet' ),
				'margin-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'tablet' ),
			),
			'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-post, .ast-narrow-container .ast-article-post, .ast-narrow-container .ast-article-post' => array(
				'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'tablet' ),
			),
		);
		$spacing_css_output                  .= astra_parse_css( $single_column_margin_blog_pro_tablet, '', astra_addon_get_tablet_breakpoint() );

		$single_column_margin_blog_pro_mobile = array(
			'.ast-separate-container .ast-article-post, .ast-separate-container .ast-separate-posts.ast-article-post, .ast-narrow-container .ast-article-post, .ast-narrow-container .ast-separate-posts.ast-article-post' => array(
				'margin-top'    => astra_responsive_spacing( $blog_post_outside_spacing, 'top', 'mobile' ),
				'margin-right'  => astra_responsive_spacing( $blog_post_outside_spacing, 'right', 'mobile' ),
				'margin-bottom' => astra_responsive_spacing( $blog_post_outside_spacing, 'bottom', 'mobile' ),
				'margin-left'   => astra_responsive_spacing( $blog_post_outside_spacing, 'left', 'mobile' ),
			),
			'.ast-separate-container .ast-article-post, .ast-separate-container .ast-article-post, .ast-narrow-container .ast-article-post, .ast-narrow-container .ast-article-post' => array(
				'padding-top'    => astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $blog_post_inside_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'mobile' ),
			),
		);
		$spacing_css_output                  .= astra_parse_css( $single_column_margin_blog_pro_mobile, '', astra_addon_get_mobile_breakpoint() );
	} else {
		// To apply Blog Grid Outside Spacing we need to remove default bottom margin given from the blog pro.
		$remove_bottom_margin_blog_pro = array(
			'.ast-separate-container .ast-separate-posts.ast-article-post, .ast-narrow-container .ast-separate-posts.ast-article-post' => array(
				'margin-bottom' => astra_get_css_value( 0, 'px' ),
			),
		);
		if ( '' != $blog_post_outside_spacing['desktop']['bottom'] ) {
			$spacing_css_output .= astra_parse_css( $remove_bottom_margin_blog_pro );
		}
		if ( '' != $blog_post_outside_spacing['tablet']['bottom'] ) {
			$spacing_css_output .= astra_parse_css( $remove_bottom_margin_blog_pro, '', astra_addon_get_tablet_breakpoint() );
		}
		if ( '' != $blog_post_outside_spacing['mobile']['bottom'] ) {
			$spacing_css_output .= astra_parse_css( $remove_bottom_margin_blog_pro, '', astra_addon_get_mobile_breakpoint() );
		}
	}

	/**
	 * Blog Pro Featured Image padding
	 */

	if ( $blog_featured_image_padding ) {
		$remove_featured_image_margin_top = array(
			'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content,.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .square .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .square .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .square .posted-on,.ast-desktop.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .square .posted-on' => array(
				'margin-top' => ( isset( $blog_post_inside_spacing['desktop']['top'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'desktop' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-left'  => ( isset( $blog_post_inside_spacing['desktop']['left'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'desktop' ) ) : '' ),
				'margin-right' => ( isset( $blog_post_inside_spacing['desktop']['right'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'desktop' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-left' => ( isset( $blog_post_inside_spacing['desktop']['left'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'desktop' ) ) : '' ),
			),
		);
		$spacing_css_output              .= astra_parse_css( $remove_featured_image_margin_top );

		$remove_featured_image_margin_top_tablet = array(
			'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content,.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content' => array(
				'margin-top' => ( isset( $blog_post_inside_spacing['tablet']['top'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'tablet' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content,.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-left'  => ( isset( $blog_post_inside_spacing['tablet']['left'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'tablet' ) ) : '' ),
				'margin-right' => ( isset( $blog_post_inside_spacing['tablet']['right'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'tablet' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-left' => ( isset( $blog_post_inside_spacing['tablet']['left'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'tablet' ) ) : '' ),
			),
		);
		$spacing_css_output                     .= astra_parse_css( $remove_featured_image_margin_top_tablet, '', astra_addon_get_tablet_breakpoint() );

		$remove_featured_image_margin_top_mobile = array(
			'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content,.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content' => array(
				'margin-top' => ( isset( $blog_post_inside_spacing['mobile']['top'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'top', 'mobile' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content,.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-left'  => ( isset( $blog_post_inside_spacing['mobile']['left'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'mobile' ) ) : '' ),
				'margin-right' => ( isset( $blog_post_inside_spacing['mobile']['right'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'right', 'mobile' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-left' => ( isset( $blog_post_inside_spacing['mobile']['left'] ) ? ( '-' . astra_responsive_spacing( $blog_post_inside_spacing, 'left', 'mobile' ) ) : '' ),
			),
		);
		$spacing_css_output                     .= astra_parse_css( $remove_featured_image_margin_top_mobile, '', astra_addon_get_mobile_breakpoint() );
	}

	/**
	 * Single Blog Featured Image padding
	 */
	if ( $remove_single_featured_padding ) {

		// Container inside spacing for single post if single_post_inside_spacing is not given then fallback to  container_inside_spacing.
		$remove_single_featured_image_margin_top = array(
			'.ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child' => array(
				'margin-top' => ( isset( $container_inside_spacing['desktop']['top'] ) && ( '' != $container_inside_spacing['desktop']['top'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'top', 'desktop' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child, .ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .post-thumb-img-content' => array(
				'margin-left'  => ( isset( $container_inside_spacing['desktop']['left'] ) && ( '' != $container_inside_spacing['desktop']['left'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'left', 'desktop' ) ) : '' ),
				'margin-right' => ( isset( $container_inside_spacing['desktop']['right'] ) && ( '' != $container_inside_spacing['desktop']['right'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'right', 'desktop' ) ) : '' ),
			),
		);
		$spacing_css_output                     .= astra_parse_css( $remove_single_featured_image_margin_top );

		$remove_single_featured_image_margin_top_tablet = array(
			'.ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child' => array(
				'margin-top' => ( isset( $container_inside_spacing['tablet']['top'] ) && ( '' != $container_inside_spacing['tablet']['top'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'top', 'tablet' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child, .ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .post-thumb-img-content' => array(
				'margin-left'  => ( isset( $container_inside_spacing['tablet']['left'] ) && ( '' != $container_inside_spacing['tablet']['left'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'left', 'tablet' ) ) : '' ),
				'margin-right' => ( isset( $container_inside_spacing['tablet']['right'] ) && ( '' != $container_inside_spacing['tablet']['right'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'right', 'tablet' ) ) : '' ),
			),
		);
		$spacing_css_output                            .= astra_parse_css( $remove_single_featured_image_margin_top_tablet, '', astra_addon_get_tablet_breakpoint() );

		$remove_single_featured_image_margin_top_mobile = array(
			'.ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child' => array(
				'margin-top' => ( isset( $container_inside_spacing['mobile']['top'] ) && ( '' != $container_inside_spacing['mobile']['top'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'top', 'mobile' ) ) : '' ),
			),
			'.ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child, .ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .post-thumb-img-content' => array(
				'margin-left'  => ( isset( $container_inside_spacing['mobile']['left'] ) && ( '' != $container_inside_spacing['mobile']['left'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'left', 'mobile' ) ) : '' ),
				'margin-right' => ( isset( $container_inside_spacing['mobile']['right'] ) && ( '' != $container_inside_spacing['mobile']['right'] ) ? ( '-' . astra_responsive_spacing( $container_inside_spacing, 'right', 'mobile' ) ) : '' ),
			),
		);
		$spacing_css_output                            .= astra_parse_css( $remove_single_featured_image_margin_top_mobile, '', astra_addon_get_mobile_breakpoint() );

		// Single Post inside spacing for single post.
		// Works only for single post if single_post_inside_spacing is given.
		$remove_single_post_featured_image_margin_top = array(
			'.ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child' => array(
				'margin-top' => ( isset( $single_post_inside_spacing['desktop']['top'] ) && ( '' != $single_post_inside_spacing['desktop']['top'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'top', 'desktop' ) ) : '' ),
			),
			'.ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child, .ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .post-thumb-img-content' => array(
				'margin-left'  => ( isset( $single_post_inside_spacing['desktop']['left'] ) && ( '' != $single_post_inside_spacing['desktop']['left'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'left', 'desktop' ) ) : '' ),
				'margin-right' => ( isset( $single_post_inside_spacing['desktop']['right'] ) && ( '' != $single_post_inside_spacing['desktop']['right'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'right', 'desktop' ) ) : '' ),
			),
		);
		$spacing_css_output                          .= astra_parse_css( $remove_single_post_featured_image_margin_top );

		$remove_single_post_featured_image_margin_top_tablet = array(
			'.ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child' => array(
				'margin-top' => ( isset( $single_post_inside_spacing['tablet']['top'] ) && ( '' != $single_post_inside_spacing['tablet']['top'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'top', 'tablet' ) ) : '' ),
			),
			'.ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child, .ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .post-thumb-img-content' => array(
				'margin-left'  => ( isset( $single_post_inside_spacing['tablet']['left'] ) && ( '' != $single_post_inside_spacing['tablet']['left'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'left', 'tablet' ) ) : '' ),
				'margin-right' => ( isset( $single_post_inside_spacing['tablet']['right'] ) && ( '' != $single_post_inside_spacing['tablet']['right'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'right', 'tablet' ) ) : '' ),
			),
		);
		$spacing_css_output                                 .= astra_parse_css( $remove_single_post_featured_image_margin_top_tablet, '', astra_addon_get_tablet_breakpoint() );

		$remove_single_post_featured_image_margin_top_mobile = array(
			'.ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child' => array(
				'margin-top' => ( isset( $single_post_inside_spacing['mobile']['top'] ) && ( '' != $single_post_inside_spacing['mobile']['top'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'top', 'mobile' ) ) : '' ),
			),
			'.ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child, .ast-separate-container.ast-single-post .ast-article-single.remove-featured-img-padding .single-layout-1 .post-thumb-img-content' => array(
				'margin-left'  => ( isset( $single_post_inside_spacing['mobile']['left'] ) && ( '' != $single_post_inside_spacing['mobile']['left'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'left', 'mobile' ) ) : '' ),
				'margin-right' => ( isset( $single_post_inside_spacing['mobile']['right'] ) && ( '' != $single_post_inside_spacing['mobile']['right'] ) ? ( '-' . astra_responsive_spacing( $single_post_inside_spacing, 'right', 'mobile' ) ) : '' ),
			),
		);
		$spacing_css_output                                 .= astra_parse_css( $remove_single_post_featured_image_margin_top_mobile, '', astra_addon_get_mobile_breakpoint() );
	}

	/**
	 * Sticky Header - Shrink realted spacing
	 * Remove Top, Bottom spacing from Site Identity, Header Spacing, Primary Menu and Add default Sub menu top
	 */

	if ( Astra_Ext_Extension::is_active( 'sticky-header' ) && ( $stick_header_main || $stick_header_main_meta ) && $header_main_shrink ) {

		/**
		 * Site Identity Spacing
		 */
		$remove_header_shrink_padding = array(
			'.site-header .ast-sticky-shrunk .ast-site-identity, .ast-sticky-shrunk .main-header-menu > .menu-item > .menu-link, .ast-sticky-shrunk li.ast-masthead-custom-menu-items' => array(
				'padding-top'    => astra_get_css_value( 0, 'px' ),
				'padding-bottom' => astra_get_css_value( 0, 'px' ),
			),
			// Remove Priamry submenu top-bottom padding for responsive devices.
			' .ast-header-break-point .ast-sticky-shrunk  .main-navigation .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_get_css_value( 0, 'px' ),
				'padding-bottom' => astra_get_css_value( 0, 'px' ),
			),
			'.ast-sticky-shrunk .main-header-menu .sub-menu .menu-link' => array(
				'padding-top'    => astra_get_css_value( 0.9, 'em' ),
				'padding-bottom' => astra_get_css_value( 0.9, 'em' ),
			),
			'.site-header .ast-sticky-shrunk .ast-site-identity, .ast-sticky-shrunk li.ast-masthead-custom-menu-items' => array(
				'padding-top'    => astra_get_css_value( 0.5, 'em' ),
				'padding-bottom' => astra_get_css_value( 0.5, 'em' ),
			),
			// Remove Priamry submenu top-bottom padding for responsive devices.
			' .ast-header-break-point .ast-sticky-shrunk  .main-navigation .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_get_css_value( 0, 'px' ),
				'padding-bottom' => astra_get_css_value( 0, 'px' ),
			),
			'.ast-sticky-shrunk .main-header-menu .sub-menu .menu-link' => array(
				'padding-top'    => astra_get_css_value( 0.9, 'em' ),
				'padding-bottom' => astra_get_css_value( 0.9, 'em' ),
			),
		);

		$spacing_css_output .= astra_parse_css( $remove_header_shrink_padding );
	}

	if ( true === astra_addon_builder_helper()->is_header_footer_builder_active && Astra_Ext_Extension::is_active( 'sticky-header' ) && ( $stick_header_main || $stick_header_main_meta || $stick_header_above || $stick_header_above_meta || $stick_header_below || $stick_header_below_meta ) && $header_main_shrink ) {

		$hb_header_height  = astra_get_option( 'hb-header-height' );
		$hba_header_height = astra_get_option( 'hba-header-height' );
		$hbb_header_height = astra_get_option( 'hbb-header-height' );

		$hb_header_height_desktop = ( isset( $hb_header_height['desktop'] ) && is_numeric( $hb_header_height['desktop'] ) ) ? $hb_header_height['desktop'] - 10 : '';
		$hb_header_height_tablet  = ( isset( $hb_header_height['tablet'] ) && is_numeric( $hb_header_height['tablet'] ) ) ? $hb_header_height['tablet'] - 10 : '';
		$hb_header_height_mobile  = ( isset( $hb_header_height['mobile'] ) && is_numeric( $hb_header_height['mobile'] ) ) ? $hb_header_height['mobile'] - 10 : '';

		$hba_header_height_desktop = ( isset( $hba_header_height['desktop'] ) && is_numeric( $hba_header_height['desktop'] ) ) ? $hba_header_height['desktop'] - 10 : '';
		$hba_header_height_tablet  = ( isset( $hba_header_height['tablet'] ) && is_numeric( $hba_header_height['tablet'] ) ) ? $hba_header_height['tablet'] - 10 : '';
		$hba_header_height_mobile  = ( isset( $hba_header_height['mobile'] ) && is_numeric( $hba_header_height['mobile'] ) ) ? $hba_header_height['mobile'] - 10 : '';

		$hbb_header_height_desktop = ( isset( $hbb_header_height['desktop'] ) && is_numeric( $hbb_header_height['desktop'] ) ) ? $hbb_header_height['desktop'] - 10 : '';
		$hbb_header_height_tablet  = ( isset( $hbb_header_height['tablet'] ) && is_numeric( $hbb_header_height['tablet'] ) ) ? $hbb_header_height['tablet'] - 10 : '';
		$hbb_header_height_mobile  = ( isset( $hbb_header_height['mobile'] ) && is_numeric( $hbb_header_height['mobile'] ) ) ? $hbb_header_height['mobile'] - 10 : '';

		$css_output_shrink_desktop = array(
			// Primary Header Shrink for Desktop & mobile.
			'.ast-sticky-header-shrink .ast-primary-header-bar.ast-header-sticked, .ast-sticky-header-shrink .ast-primary-header-bar.ast-header-sticked .site-primary-header-wrap, .ast-header-sticked .ast-primary-header-bar .site-primary-header-wrap, .ast-sticky-header-shrink .ast-mobile-header-wrap .ast-primary-header-bar.ast-header-sticked, .ast-sticky-header-shrink .ast-mobile-header-wrap .ast-stick-primary-below-wrapper.ast-header-sticked .ast-below-header , .ast-sticky-header-shrink .ast-stick-primary-below-wrapper.ast-header-sticked .ast-primary-header-bar .site-primary-header-wrap' => array(
				'min-height' => astra_get_css_value( $hb_header_height_desktop, 'px' ),
			),
			'.ast-desktop.ast-sticky-header-shrink .ast-primary-header-bar.ast-header-sticked .main-header-menu > .menu-item' => array(
				'line-height' => astra_get_css_value( $hb_header_height_desktop, 'px' ),
			),
			// Above Header Shrink for Desktop & mobile.
			'.ast-sticky-header-shrink .ast-above-header-bar.ast-header-sticked .site-above-header-wrap, .ast-sticky-header-shrink .ast-above-header-bar.ast-header-sticked .site-above-header-wrap, .ast-header-sticked .ast-above-header-bar .site-above-header-wrap, .ast-header-sticked .ast-above-header-bar, .ast-sticky-header-shrink .ast-mobile-header-wrap .ast-above-header-bar.ast-header-sticked' => array(
				'min-height' => astra_get_css_value( $hba_header_height_desktop, 'px' ),
			),
			'.ast-desktop.ast-sticky-header-shrink .ast-above-header-bar.ast-header-sticked .main-header-menu > .menu-item' => array(
				'line-height' => astra_get_css_value( $hba_header_height_desktop, 'px' ),
			),
			// Below Header Shrink for Desktop & mobile.
			'.ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked, .ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked .site-below-header-wrap, .ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked.site-below-header-wrap, .ast-header-sticked .ast-below-header-bar .site-below-header-wrap, .ast-sticky-header-shrink .ast-mobile-header-wrap .ast-below-header-bar.ast-header-sticked .site-below-header-wrap'                         => array(
				'min-height' => astra_get_css_value( $hbb_header_height_desktop, 'px' ),
			),
			'.ast-desktop.ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked .main-header-menu > .menu-item' => array(
				'line-height' => astra_get_css_value( $hbb_header_height_desktop, 'px' ),
			),
		);

		$css_output_shrink_tablet = array(
			// Primary Header Shrink for tablet & mobile.
			'.ast-sticky-header-shrink .ast-primary-header-bar.ast-header-sticked, .ast-sticky-header-shrink .ast-primary-header-bar.ast-header-sticked, .ast-header-sticked .ast-primary-header-bar, .ast-sticky-header-shrink .ast-stick-primary-below-wrapper.ast-header-sticked' => array(
				'min-height' => astra_get_css_value( $hb_header_height_tablet, 'px' ),
			),
			// Above Header Shrink for tablet & mobile.
			'.ast-sticky-header-shrink .ast-above-header-bar.ast-header-sticked .site-above-header-wrap, .ast-sticky-header-shrink .ast-above-header-bar.ast-header-sticked .site-above-header-wrap, .ast-header-sticked .ast-above-header-bar .site-above-header-wrap, .ast-header-sticked .ast-above-header-bar'                         => array(
				'min-height' => astra_get_css_value( $hba_header_height_tablet, 'px' ),
			),
			// Below Header Shrink for tablet & mobile.
			'.ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked, .ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked .site-below-header-wrap, .ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked.site-below-header-wrap, .ast-header-sticked .ast-below-header-bar .site-below-header-wrap'                         => array(
				'min-height' => astra_get_css_value( $hbb_header_height_tablet, 'px' ),
			),
		);

		$css_output_shrink_mobile = array(
			// Primary Header Shrink for mobile & mobile.
			'.ast-sticky-header-shrink .ast-primary-header-bar.ast-header-sticked, .ast-sticky-header-shrink .ast-primary-header-bar.ast-header-sticked, .ast-header-sticked .ast-primary-header-bar, .ast-sticky-header-shrink .ast-stick-primary-below-wrapper.ast-header-sticked' => array(
				'min-height' => astra_get_css_value( $hb_header_height_mobile, 'px' ),
			),
			// Above Header Shrink for mobile & mobile.
			'.ast-sticky-header-shrink .ast-above-header-bar.ast-header-sticked .site-above-header-wrap, .ast-sticky-header-shrink .ast-above-header-bar.ast-header-sticked .site-above-header-wrap, .ast-header-sticked .ast-above-header-bar .site-above-header-wrap, .ast-header-sticked .ast-above-header-bar'                         => array(
				'min-height' => astra_get_css_value( $hba_header_height_mobile, 'px' ),
			),
			// Below Header Shrink for mobile & mobile.
			'.ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked, .ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked .site-below-header-wrap, .ast-sticky-header-shrink .ast-below-header-bar.ast-header-sticked.site-below-header-wrap, .ast-header-sticked .ast-below-header-bar .site-below-header-wrap'                         => array(
				'min-height' => astra_get_css_value( $hbb_header_height_mobile, 'px' ),
			),
		);

		$spacing_css_output .= astra_parse_css( $css_output_shrink_desktop );
		$spacing_css_output .= astra_parse_css( $css_output_shrink_tablet, '', astra_addon_get_tablet_breakpoint() );
		$spacing_css_output .= astra_parse_css( $css_output_shrink_mobile, '', astra_addon_get_mobile_breakpoint() );
	}
	/**
	 * Header Builder Menu - Spacing.
	 */
	if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

		$num_of_header_menu = astra_addon_builder_helper()->num_of_header_menu;
		for ( $index = 1; $index <= $num_of_header_menu; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'menu-' . $index, 'header' ) ) {
				continue;
			}

			$_prefix  = 'menu' . $index;
			$_section = 'section-hb-menu-' . $index;

			$selector = '.ast-builder-menu-' . $index . ' .main-header-menu';

			$sub_menu_spacing          = astra_get_option( 'header-' . $_prefix . '-submenu-spacing' );
			$mega_menu_heading_spacing = astra_get_option( 'header-' . $_prefix . '-megamenu-heading-space' );
			$sub_menu_border           = astra_get_option( 'header-' . $_prefix . '-submenu-border' );

			$sub_menu_border_top = ( isset( $sub_menu_border ) && ! empty( $sub_menu_border['top'] ) ) ? $sub_menu_border['top'] : 0;

			$sub_menu_border_bottom = ( isset( $sub_menu_border ) && ! empty( $sub_menu_border['bottom'] ) ) ? $sub_menu_border['bottom'] : 0;

			$sub_menu_border_right = ( isset( $sub_menu_border ) && ! empty( $sub_menu_border['right'] ) ) ? $sub_menu_border['right'] : 0;

			$sub_menu_border_left = ( isset( $sub_menu_border ) && ! empty( $sub_menu_border['left'] ) ) ? $sub_menu_border['left'] : 0;

			// SubMenu Spacing.

			// - Desktop
			$sub_menu_desktop_spacing_top = ( isset( $sub_menu_spacing['desktop']['top'] ) ) ? $sub_menu_spacing['desktop']['top'] : '';

			$sub_menu_desktop_spacing_bottom = ( isset( $sub_menu_spacing['desktop']['bottom'] ) ) ? $sub_menu_spacing['desktop']['bottom'] : '';

			$sub_menu_desktop_spacing_right = ( isset( $sub_menu_spacing['desktop']['right'] ) ) ? $sub_menu_spacing['desktop']['right'] : '';

			$sub_menu_desktop_spacing_left = ( isset( $sub_menu_spacing['desktop']['left'] ) ) ? $sub_menu_spacing['desktop']['left'] : '';

			$sub_menu_desktop_spacing_unit = ( isset( $sub_menu_spacing['desktop-unit'] ) && ! empty( $sub_menu_spacing['desktop-unit'] ) ) ? $sub_menu_spacing['desktop-unit'] : 'px';

			// - Tablet.
			$sub_menu_tablet_spacing_top = ( isset( $sub_menu_spacing['tablet']['top'] ) ) ? $sub_menu_spacing['tablet']['top'] : '';

			$sub_menu_tablet_spacing_bottom = ( isset( $sub_menu_spacing['tablet']['bottom'] ) ) ? $sub_menu_spacing['tablet']['bottom'] : '';

			$sub_menu_tablet_spacing_right = ( isset( $sub_menu_spacing['tablet']['right'] ) ) ? $sub_menu_spacing['tablet']['right'] : '';

			$sub_menu_tablet_spacing_left = ( isset( $sub_menu_spacing['tablet']['left'] ) ) ? $sub_menu_spacing['tablet']['left'] : '';

			$sub_menu_tablet_spacing_unit = ( isset( $sub_menu_spacing['tablet-unit'] ) && ! empty( $sub_menu_spacing['tablet-unit'] ) ) ? $sub_menu_spacing['tablet-unit'] : 'px';

			// - Mobile.
			$sub_menu_mobile_spacing_top = ( isset( $sub_menu_spacing['mobile']['top'] ) ) ? $sub_menu_spacing['mobile']['top'] : '';

			$sub_menu_mobile_spacing_bottom = ( isset( $sub_menu_spacing['mobile']['bottom'] ) ) ? $sub_menu_spacing['mobile']['bottom'] : '';

			$sub_menu_mobile_spacing_right = ( isset( $sub_menu_spacing['mobile']['right'] ) ) ? $sub_menu_spacing['mobile']['right'] : '';

			$sub_menu_mobile_spacing_left = ( isset( $sub_menu_spacing['mobile']['left'] ) ) ? $sub_menu_spacing['mobile']['left'] : '';

			$sub_menu_mobile_spacing_unit = ( isset( $sub_menu_spacing['mobile-unit'] ) && ! empty( $sub_menu_spacing['mobile-unit'] ) ) ? $sub_menu_spacing['mobile-unit'] : 'px';

			$css_output_desktop = array(
				// Sub Menu.
				$selector . ' .sub-menu .menu-link' => array(
					'padding-top'    => astra_get_css_value( $sub_menu_desktop_spacing_top, $sub_menu_desktop_spacing_unit ),
					'padding-bottom' => astra_get_css_value( $sub_menu_desktop_spacing_bottom, $sub_menu_desktop_spacing_unit ),
					'padding-left'   => astra_get_css_value( $sub_menu_desktop_spacing_left, $sub_menu_desktop_spacing_unit ),
					'padding-right'  => astra_get_css_value( $sub_menu_desktop_spacing_right, $sub_menu_desktop_spacing_unit ),
				),
				$selector . '.submenu-with-border .astra-megamenu, ' . $selector . '.submenu-with-border .astra-full-megamenu-wrapper' => array(
					'border-top-width'    => astra_get_css_value( $sub_menu_border_top, 'px' ),
					'border-bottom-width' => astra_get_css_value( $sub_menu_border_bottom, 'px' ),
					'border-right-width'  => astra_get_css_value( $sub_menu_border_right, 'px' ),
					'border-left-width'   => astra_get_css_value( $sub_menu_border_left, 'px' ),
					'border-color'        => esc_attr( astra_get_option( 'header-' . $_prefix . '-submenu-b-color' ) ),
					'border-style'        => 'solid',
				),
			);

			$mobile_selector = '.ast-header-break-point .ast-builder-menu-' . $index;

			$sub_menu_spacing_tablet_top = astra_responsive_spacing( $sub_menu_spacing, 'top', 'tablet' );

			if ( isset( $sub_menu_spacing_tablet_top ) && '' === $sub_menu_spacing_tablet_top && isset( $sub_menu_spacing_desktop_top ) && '' !== $sub_menu_spacing_desktop_top && 0 !== $sub_menu_spacing_desktop_top ) {

				$sub_menu_spacing_tablet_top = $sub_menu_spacing_desktop_top;
			}

			$sub_menu_spacing_tablet_top = ( isset( $sub_menu_spacing_tablet_top ) && ! empty( $sub_menu_spacing_tablet_top ) ) ? $sub_menu_spacing_tablet_top : 0;

			$sub_menu_spacing_mobile_top = astra_responsive_spacing( $sub_menu_spacing, 'top', 'mobile' );

			if ( isset( $sub_menu_spacing_mobile_top ) && '' === $sub_menu_spacing_mobile_top && isset( $sub_menu_spacing_tablet_top ) && '' !== $sub_menu_spacing_tablet_top && 0 !== $sub_menu_spacing_tablet_top ) {

				$sub_menu_spacing_mobile_top = $sub_menu_spacing_tablet_top;
			}

			$sub_menu_spacing_mobile_top = ( isset( $sub_menu_spacing_mobile_top ) && ! empty( $sub_menu_spacing_mobile_top ) ) ? $sub_menu_spacing_mobile_top : 0;

			$css_output_tablet = array(
				// Sub Menu.
				'.ast-header-break-point ' . $selector . ' .sub-menu > .menu-item > .menu-link' => array(
					'padding-top'    => astra_get_css_value( $sub_menu_tablet_spacing_top, $sub_menu_tablet_spacing_unit ),
					'padding-bottom' => astra_get_css_value( $sub_menu_tablet_spacing_bottom, $sub_menu_tablet_spacing_unit ),
					'padding-left'   => astra_get_css_value( $sub_menu_tablet_spacing_left, $sub_menu_tablet_spacing_unit ),
					'padding-right'  => astra_get_css_value( $sub_menu_tablet_spacing_right, $sub_menu_tablet_spacing_unit ),
				),
				$mobile_selector . ' .sub-menu .menu-item.menu-item-has-children > .ast-menu-toggle' => array(
					'top'   => $sub_menu_spacing_tablet_top,
					'right' => class_exists( 'Astra_Addon_Builder_Helper' ) ? astra_calc_spacing( astra_responsive_spacing( $sub_menu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ) : '',
				),
			);

			$css_output_mobile = array(
				// Sub Menu.
				'.ast-header-break-point ' . $selector . ' .sub-menu > .menu-item > .menu-link' => array(
					'padding-top'    => astra_get_css_value( $sub_menu_mobile_spacing_top, $sub_menu_mobile_spacing_unit ),
					'padding-bottom' => astra_get_css_value( $sub_menu_mobile_spacing_bottom, $sub_menu_mobile_spacing_unit ),
					'padding-left'   => astra_get_css_value( $sub_menu_mobile_spacing_left, $sub_menu_mobile_spacing_unit ),
					'padding-right'  => astra_get_css_value( $sub_menu_mobile_spacing_right, $sub_menu_mobile_spacing_unit ),
				),
				$mobile_selector . ' .sub-menu .menu-item.menu-item-has-children > .ast-menu-toggle' => array(
					'top'   => $sub_menu_spacing_mobile_top,
					'right' => class_exists( 'Astra_Addon_Builder_Helper' ) ? astra_calc_spacing( astra_responsive_spacing( $sub_menu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ) : '',
				),
			);

			if ( 3 > $index ) {

				// Mega Menu heading Spacing.

				// - Desktop
				$mega_menu_desktop_spacing_top = ( isset( $mega_menu_heading_spacing['desktop']['top'] ) ) ? $mega_menu_heading_spacing['desktop']['top'] : '';

				$mega_menu_desktop_spacing_bottom = ( isset( $mega_menu_heading_spacing['desktop']['bottom'] ) ) ? $mega_menu_heading_spacing['desktop']['bottom'] : '';

				$mega_menu_desktop_spacing_right = ( isset( $mega_menu_heading_spacing['desktop']['right'] ) ) ? $mega_menu_heading_spacing['desktop']['right'] : '';

				$mega_menu_desktop_spacing_left = ( isset( $mega_menu_heading_spacing['desktop']['left'] ) ) ? $mega_menu_heading_spacing['desktop']['left'] : '';

				$mega_menu_desktop_spacing_unit = ( isset( $mega_menu_heading_spacing['desktop-unit'] ) && ! empty( $mega_menu_heading_spacing['desktop-unit'] ) ) ? $mega_menu_heading_spacing['desktop-unit'] : 'px';

				// - Tablet.
				$mega_menu_tablet_spacing_top = ( isset( $mega_menu_heading_spacing['tablet']['top'] ) ) ? $mega_menu_heading_spacing['tablet']['top'] : '';

				$mega_menu_tablet_spacing_bottom = ( isset( $mega_menu_heading_spacing['tablet']['bottom'] ) ) ? $mega_menu_heading_spacing['tablet']['bottom'] : '';

				$mega_menu_tablet_spacing_right = ( isset( $mega_menu_heading_spacing['tablet']['right'] ) ) ? $mega_menu_heading_spacing['tablet']['right'] : '';

				$mega_menu_tablet_spacing_left = ( isset( $mega_menu_heading_spacing['tablet']['left'] ) ) ? $mega_menu_heading_spacing['tablet']['left'] : '';

				$mega_menu_tablet_spacing_unit = ( isset( $mega_menu_heading_spacing['tablet-unit'] ) && ! empty( $mega_menu_heading_spacing['tablet-unit'] ) ) ? $mega_menu_heading_spacing['tablet-unit'] : 'px';

				// - Mobile.
				$mega_menu_mobile_spacing_top = ( isset( $mega_menu_heading_spacing['mobile']['top'] ) ) ? $mega_menu_heading_spacing['mobile']['top'] : '';

				$mega_menu_mobile_spacing_bottom = ( isset( $mega_menu_heading_spacing['mobile']['bottom'] ) ) ? $mega_menu_heading_spacing['mobile']['bottom'] : '';

				$mega_menu_mobile_spacing_right = ( isset( $mega_menu_heading_spacing['mobile']['right'] ) ) ? $mega_menu_heading_spacing['mobile']['right'] : '';

				$mega_menu_mobile_spacing_left = ( isset( $mega_menu_heading_spacing['mobile']['left'] ) ) ? $mega_menu_heading_spacing['mobile']['left'] : '';

				$mega_menu_mobile_spacing_unit = ( isset( $mega_menu_heading_spacing['mobile-unit'] ) && ! empty( $mega_menu_heading_spacing['mobile-unit'] ) ) ? $mega_menu_heading_spacing['mobile-unit'] : 'px';

				$css_megamenu_output_desktop = array(
					// Mega Menu.
					$selector . ' .menu-item.menu-item-heading > .menu-link' => array(
						'padding-top'    => astra_get_css_value( $mega_menu_desktop_spacing_top, $mega_menu_desktop_spacing_unit ),
						'padding-bottom' => astra_get_css_value( $mega_menu_desktop_spacing_bottom, $mega_menu_desktop_spacing_unit ),
						'padding-left'   => astra_get_css_value( $mega_menu_desktop_spacing_left, $mega_menu_desktop_spacing_unit ),
						'padding-right'  => astra_get_css_value( $mega_menu_desktop_spacing_right, $mega_menu_desktop_spacing_unit ),
					),
				);

				$css_megamenu_output_tablet = array(
					// Mega Menu.
					'.ast-header-break-point ' . $selector . ' .menu-item.menu-item-heading > .menu-link' => array(
						'padding-top'    => astra_get_css_value( $mega_menu_tablet_spacing_top, $mega_menu_tablet_spacing_unit ),
						'padding-bottom' => astra_get_css_value( $mega_menu_tablet_spacing_bottom, $mega_menu_tablet_spacing_unit ),
						'padding-left'   => astra_get_css_value( $mega_menu_tablet_spacing_left, $mega_menu_tablet_spacing_unit ),
						'padding-right'  => astra_get_css_value( $mega_menu_tablet_spacing_right, $mega_menu_tablet_spacing_unit ),
					),
				);

				$css_megamenu_output_mobile = array(
					// Mega Menu.
					'.ast-header-break-point ' . $selector . ' .menu-item.menu-item-heading > .menu-link' => array(
						'padding-top'    => astra_get_css_value( $mega_menu_mobile_spacing_top, $mega_menu_mobile_spacing_unit ),
						'padding-bottom' => astra_get_css_value( $mega_menu_mobile_spacing_bottom, $mega_menu_mobile_spacing_unit ),
						'padding-left'   => astra_get_css_value( $mega_menu_mobile_spacing_left, $mega_menu_mobile_spacing_unit ),
						'padding-right'  => astra_get_css_value( $mega_menu_mobile_spacing_right, $mega_menu_mobile_spacing_unit ),
					),
				);

				$spacing_css_output .= astra_parse_css( $css_megamenu_output_desktop );
				$spacing_css_output .= astra_parse_css( $css_megamenu_output_tablet, '', astra_addon_get_tablet_breakpoint() );
				$spacing_css_output .= astra_parse_css( $css_megamenu_output_mobile, '', astra_addon_get_mobile_breakpoint() );
			}

			$spacing_css_output .= astra_parse_css( $css_output_desktop );
			$spacing_css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$spacing_css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
		}

		if ( is_callable( 'Astra_Addon_Builder_Helper::is_component_loaded' ) && Astra_Addon_Builder_Helper::is_component_loaded( 'mobile-menu', 'header', 'mobile' ) ) {

			$selector = '.ast-hfb-header .ast-builder-menu-mobile';

			$sub_menu_spacing = astra_get_option( 'header-mobile-menu-submenu-spacing' );

			// SubMenu Spacing.

			// - Desktop.
			$sub_menu_desktop_spacing_top = ( isset( $sub_menu_spacing['desktop']['top'] ) && ! empty( $sub_menu_spacing['desktop']['top'] ) ) ? $sub_menu_spacing['desktop']['top'] : '';

			$sub_menu_desktop_spacing_bottom = ( isset( $sub_menu_spacing['desktop']['bottom'] ) && ! empty( $sub_menu_spacing['desktop']['bottom'] ) ) ? $sub_menu_spacing['desktop']['bottom'] : '';

			$sub_menu_desktop_spacing_right = ( isset( $sub_menu_spacing['desktop']['right'] ) && ! empty( $sub_menu_spacing['desktop']['right'] ) ) ? $sub_menu_spacing['desktop']['right'] : '';

			$sub_menu_desktop_spacing_left = ( isset( $sub_menu_spacing['desktop']['left'] ) && ! empty( $sub_menu_spacing['desktop']['left'] ) ) ? $sub_menu_spacing['desktop']['left'] : '';

			$sub_menu_desktop_spacing_unit = ( isset( $sub_menu_spacing['desktop-unit'] ) && ! empty( $sub_menu_spacing['desktop-unit'] ) ) ? $sub_menu_spacing['desktop-unit'] : '';

			// - Tablet.
			$sub_menu_tablet_spacing_top = ( isset( $sub_menu_spacing['tablet']['top'] ) && ! empty( $sub_menu_spacing['tablet']['top'] ) ) ? $sub_menu_spacing['tablet']['top'] : '';

			$sub_menu_tablet_spacing_bottom = ( isset( $sub_menu_spacing['tablet']['bottom'] ) && ! empty( $sub_menu_spacing['tablet']['bottom'] ) ) ? $sub_menu_spacing['tablet']['bottom'] : '';

			$sub_menu_tablet_spacing_right = ( isset( $sub_menu_spacing['tablet']['right'] ) && ! empty( $sub_menu_spacing['tablet']['right'] ) ) ? $sub_menu_spacing['tablet']['right'] : '';

			$sub_menu_tablet_spacing_left = ( isset( $sub_menu_spacing['tablet']['left'] ) && ! empty( $sub_menu_spacing['tablet']['left'] ) ) ? $sub_menu_spacing['tablet']['left'] : '';

			$sub_menu_tablet_spacing_unit = ( isset( $sub_menu_spacing['tablet-unit'] ) && ! empty( $sub_menu_spacing['tablet-unit'] ) ) ? $sub_menu_spacing['tablet-unit'] : '';

			// - Mobile.
			$sub_menu_mobile_spacing_top = ( isset( $sub_menu_spacing['mobile']['top'] ) && ! empty( $sub_menu_spacing['mobile']['top'] ) ) ? $sub_menu_spacing['mobile']['top'] : '';

			$sub_menu_mobile_spacing_bottom = ( isset( $sub_menu_spacing['mobile']['bottom'] ) && ! empty( $sub_menu_spacing['mobile']['bottom'] ) ) ? $sub_menu_spacing['mobile']['bottom'] : '';

			$sub_menu_mobile_spacing_right = ( isset( $sub_menu_spacing['mobile']['right'] ) && ! empty( $sub_menu_spacing['mobile']['right'] ) ) ? $sub_menu_spacing['mobile']['right'] : '';

			$sub_menu_mobile_spacing_left = ( isset( $sub_menu_spacing['mobile']['left'] ) && ! empty( $sub_menu_spacing['mobile']['left'] ) ) ? $sub_menu_spacing['mobile']['left'] : '';

			$sub_menu_mobile_spacing_unit = ( isset( $sub_menu_spacing['mobile-unit'] ) && ! empty( $sub_menu_spacing['mobile-unit'] ) ) ? $sub_menu_spacing['mobile-unit'] : '';

			$css_output_desktop = array(
				// Sub Menu.
				$selector . ' .ast-nav-menu .sub-menu .menu-item > .menu-link' => array(
					'padding-top'    => astra_get_css_value( $sub_menu_desktop_spacing_top, $sub_menu_desktop_spacing_unit ),
					'padding-bottom' => astra_get_css_value( $sub_menu_desktop_spacing_bottom, $sub_menu_desktop_spacing_unit ),
					'padding-left'   => astra_get_css_value( $sub_menu_desktop_spacing_left, $sub_menu_desktop_spacing_unit ),
					'padding-right'  => astra_get_css_value( $sub_menu_desktop_spacing_right, $sub_menu_desktop_spacing_unit ),
				),
				$selector . ' .ast-nav-menu .sub-menu .menu-item.menu-item-has-children > .ast-menu-toggle' => array(
					'top'   => astra_responsive_spacing( $sub_menu_spacing, 'top', 'desktop' ),
					'right' => class_exists( 'Astra_Addon_Builder_Helper' ) ? astra_calc_spacing( astra_responsive_spacing( $sub_menu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ) : '',
				),
			);

			$css_output_tablet = array(
				// Sub Menu.
				$selector . ' .ast-nav-menu .sub-menu .menu-item > .menu-link' => array(
					'padding-top'    => astra_get_css_value( $sub_menu_tablet_spacing_top, $sub_menu_tablet_spacing_unit ),
					'padding-bottom' => astra_get_css_value( $sub_menu_tablet_spacing_bottom, $sub_menu_tablet_spacing_unit ),
					'padding-left'   => astra_get_css_value( $sub_menu_tablet_spacing_left, $sub_menu_tablet_spacing_unit ),
					'padding-right'  => astra_get_css_value( $sub_menu_tablet_spacing_right, $sub_menu_tablet_spacing_unit ),
				),
				$selector . ' .ast-nav-menu .sub-menu .menu-item.menu-item-has-children > .ast-menu-toggle' => array(
					'top'   => astra_responsive_spacing( $sub_menu_spacing, 'top', 'tablet' ),
					'right' => class_exists( 'Astra_Addon_Builder_Helper' ) ? astra_calc_spacing( astra_responsive_spacing( $sub_menu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ) : '',
				),
			);

			$css_output_mobile = array(
				// Sub Menu.
				$selector . ' .ast-nav-menu .sub-menu .menu-item > .menu-link' => array(
					'padding-top'    => astra_get_css_value( $sub_menu_mobile_spacing_top, $sub_menu_mobile_spacing_unit ),
					'padding-bottom' => astra_get_css_value( $sub_menu_mobile_spacing_bottom, $sub_menu_mobile_spacing_unit ),
					'padding-left'   => astra_get_css_value( $sub_menu_mobile_spacing_left, $sub_menu_mobile_spacing_unit ),
					'padding-right'  => astra_get_css_value( $sub_menu_mobile_spacing_right, $sub_menu_mobile_spacing_unit ),
				),
				$selector . ' .ast-nav-menu .sub-menu .menu-item.menu-item-has-children > .ast-menu-toggle' => array(
					'top'   => astra_responsive_spacing( $sub_menu_spacing, 'top', 'mobile' ),
					'right' => class_exists( 'Astra_Addon_Builder_Helper' ) ? astra_calc_spacing( astra_responsive_spacing( $sub_menu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ) : '',
				),
			);

			$spacing_css_output .= astra_parse_css( $css_output_desktop );
			$spacing_css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$spacing_css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		}

		/**
		 * Account CSS.
		 */
		if ( is_callable( 'Astra_Addon_Builder_Helper::is_component_loaded' ) && Astra_Addon_Builder_Helper::is_component_loaded( 'account', 'header' ) ) {

			$selector     = '.ast-header-account-wrap';
			$adv_selector = '.ast-advanced-headers .ast-header-account-wrap';

			// Spacing.
			$menu_spacing = astra_get_option( 'header-account-menu-spacing' );

			$css_output_desktop = array(
				$selector . ' .main-header-menu.ast-account-nav-menu .menu-item .menu-link, ' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .menu-item .menu-link' => array(
					'padding-top'    => astra_responsive_spacing( $menu_spacing, 'top', 'desktop' ),
					'padding-bottom' => astra_responsive_spacing( $menu_spacing, 'bottom', 'desktop' ),
					'padding-left'   => astra_responsive_spacing( $menu_spacing, 'left', 'desktop' ),
					'padding-right'  => astra_responsive_spacing( $menu_spacing, 'right', 'desktop' ),
				),
			);

			$css_output_tablet = array(
				$selector . ' .main-header-menu.ast-account-nav-menu .menu-item .menu-link, ' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .menu-item .menu-link' => array(
					'padding-top'    => astra_responsive_spacing( $menu_spacing, 'top', 'tablet' ),
					'padding-bottom' => astra_responsive_spacing( $menu_spacing, 'bottom', 'tablet' ),
					'padding-left'   => astra_responsive_spacing( $menu_spacing, 'left', 'tablet' ),
					'padding-right'  => astra_responsive_spacing( $menu_spacing, 'right', 'tablet' ),
				),
			);

			$css_output_mobile = array(
				$selector . ' .main-header-menu.ast-account-nav-menu .menu-item .menu-link, ' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .menu-item .menu-link' => array(
					'padding-top'    => astra_responsive_spacing( $menu_spacing, 'top', 'mobile' ),
					'padding-bottom' => astra_responsive_spacing( $menu_spacing, 'bottom', 'mobile' ),
					'padding-left'   => astra_responsive_spacing( $menu_spacing, 'left', 'mobile' ),
					'padding-right'  => astra_responsive_spacing( $menu_spacing, 'right', 'mobile' ),
				),
			);

			/* Parse CSS from array() */
			$spacing_css_output .= astra_parse_css( $css_output_desktop );
			$spacing_css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$spacing_css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		}

		/**
		 * Language switcher CSS.
		 */
		if ( is_callable( 'Astra_Addon_Builder_Helper::is_component_loaded' ) && Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'header' ) ) {
			$_section = 'section-hb-language-switcher';

			$selector = '.ast-header-language-switcher';

			$margin       = astra_get_option( $_section . '-margin' );
			$item_spacing = astra_get_option( $_section . '-item-spacing' );

			/**
			 * Desktop CSS.
			 */
			$lswitcher_css_output_desktop = array(
				$selector => array(
					// Margin.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'desktop' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'desktop' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'desktop' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'desktop' ),
				),
				'.ast-builder-language-switcher-menu-item-header' => array(
					// Margin.
					'padding-top'    => astra_responsive_spacing( $item_spacing, 'top', 'desktop' ),
					'padding-bottom' => astra_responsive_spacing( $item_spacing, 'bottom', 'desktop' ),
					'padding-left'   => astra_responsive_spacing( $item_spacing, 'left', 'desktop' ),
					'padding-right'  => astra_responsive_spacing( $item_spacing, 'right', 'desktop' ),
				),
			);

			/**
			 * Tablet CSS.
			 */
			$lswitcher_css_output_tablet = array(
				$selector => array(
					// Margin CSS.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'tablet' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'tablet' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'tablet' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'tablet' ),
				),
				'.ast-builder-language-switcher-menu-item-header' => array(
					// Padding.
					'padding-top'    => astra_responsive_spacing( $item_spacing, 'top', 'tablet' ),
					'padding-bottom' => astra_responsive_spacing( $item_spacing, 'bottom', 'tablet' ),
					'padding-left'   => astra_responsive_spacing( $item_spacing, 'left', 'tablet' ),
					'padding-right'  => astra_responsive_spacing( $item_spacing, 'right', 'tablet' ),
				),
			);

			/**
			 * Mobile CSS.
			 */
			$lswitcher_css_output_mobile = array(
				$selector => array(
					// Margin CSS.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'mobile' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'mobile' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'mobile' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'mobile' ),
				),
				'.ast-builder-language-switcher-menu-item-header' => array(
					// Padding.
					'padding-top'    => astra_responsive_spacing( $item_spacing, 'top', 'mobile' ),
					'padding-bottom' => astra_responsive_spacing( $item_spacing, 'bottom', 'mobile' ),
					'padding-left'   => astra_responsive_spacing( $item_spacing, 'left', 'mobile' ),
					'padding-right'  => astra_responsive_spacing( $item_spacing, 'right', 'mobile' ),
				),
			);

			/* Parse CSS from array() */
			$spacing_css_output .= astra_parse_css( $lswitcher_css_output_desktop );
			$spacing_css_output .= astra_parse_css( $lswitcher_css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$spacing_css_output .= astra_parse_css( $lswitcher_css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		}

		/**
		 * Language switcher CSS.
		 */
		if ( is_callable( 'Astra_Addon_Builder_Helper::is_component_loaded' ) && Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'footer' ) ) {
			$_section = 'section-fb-language-switcher';

			$selector = '.ast-footer-language-switcher';

			$margin       = astra_get_option( $_section . '-margin' );
			$item_spacing = astra_get_option( $_section . '-item-spacing' );

			/**
			 * Desktop CSS.
			 */
			$lswitcher_css_output_desktop = array(
				$selector => array(
					// Margin.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'desktop' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'desktop' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'desktop' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'desktop' ),
				),
				'.ast-builder-language-switcher-menu-item-footer' => array(
					// Margin.
					'padding-top'    => astra_responsive_spacing( $item_spacing, 'top', 'desktop' ),
					'padding-bottom' => astra_responsive_spacing( $item_spacing, 'bottom', 'desktop' ),
					'padding-left'   => astra_responsive_spacing( $item_spacing, 'left', 'desktop' ),
					'padding-right'  => astra_responsive_spacing( $item_spacing, 'right', 'desktop' ),
				),
			);

			/**
			 * Tablet CSS.
			 */
			$lswitcher_css_output_tablet = array(
				$selector => array(
					// Margin CSS.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'tablet' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'tablet' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'tablet' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'tablet' ),
				),
				'.ast-builder-language-switcher-menu-item-footer' => array(
					// Padding.
					'padding-top'    => astra_responsive_spacing( $item_spacing, 'top', 'tablet' ),
					'padding-bottom' => astra_responsive_spacing( $item_spacing, 'bottom', 'tablet' ),
					'padding-left'   => astra_responsive_spacing( $item_spacing, 'left', 'tablet' ),
					'padding-right'  => astra_responsive_spacing( $item_spacing, 'right', 'tablet' ),
				),
			);

			/**
			 * Mobile CSS.
			 */
			$lswitcher_css_output_mobile = array(
				$selector => array(
					// Margin CSS.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'mobile' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'mobile' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'mobile' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'mobile' ),
				),
				'.ast-builder-language-switcher-menu-item-footer' => array(
					// Padding.
					'padding-top'    => astra_responsive_spacing( $item_spacing, 'top', 'mobile' ),
					'padding-bottom' => astra_responsive_spacing( $item_spacing, 'bottom', 'mobile' ),
					'padding-left'   => astra_responsive_spacing( $item_spacing, 'left', 'mobile' ),
					'padding-right'  => astra_responsive_spacing( $item_spacing, 'right', 'mobile' ),
				),
			);

			/* Parse CSS from array() */
			$spacing_css_output .= astra_parse_css( $lswitcher_css_output_desktop );
			$spacing_css_output .= astra_parse_css( $lswitcher_css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$spacing_css_output .= astra_parse_css( $lswitcher_css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		}
	} else {

		// Desktop Spacing.
		$spacing = array(
			// Header Spacing Top / Bottom Padding.
			'.main-header-bar, .ast-header-break-point .main-header-bar, .ast-header-break-point .header-main-layout-2 .main-header-bar' => array(
				'padding-top'    => astra_responsive_spacing( $header_spacing, 'top', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $header_spacing, 'bottom', 'desktop' ),
			),
			// Header Spacing Left / Right Padding apply to inside container.
			'.main-header-bar .ast-container, #masthead .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $header_spacing, 'left', 'desktop' ),
				'padding-right' => astra_responsive_spacing( $header_spacing, 'right', 'desktop' ),
			),
			/**
			 * Header Spacing
			 */
			'.ast-default-menu-enable.ast-main-header-nav-open.ast-header-break-point .main-header-bar, .ast-main-header-nav-open .main-header-bar' => array(
				'padding-bottom' => 0,
			),

			/**
			 * Main Menu Spacing
			 */
			'.main-navigation ul .menu-item .menu-link, .ast-header-break-point .main-navigation ul .menu-item .menu-link, .ast-header-break-point li.ast-masthead-custom-menu-items, li.ast-masthead-custom-menu-items' => array(
				'padding-top'    => astra_responsive_spacing( $primary_menu_spacing, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $primary_menu_spacing, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $primary_menu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $primary_menu_spacing, 'left', 'desktop' ),
			),
			'.ast-header-break-point .main-navigation ul .menu-item.menu-item-has-children button' => array(
				'padding-right'  => astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $primary_menu_spacing, 'bottom', 'mobile' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $primary_menu_spacing, 'top', 'desktop' ),
			),

			/**
			 * Main Submenu Spacing
			 */
			'.ast-desktop .main-navigation .ast-mm-template-content, .ast-desktop .main-navigation .ast-mm-custom-content, .ast-desktop .main-navigation .ast-mm-custom-text-content,.main-navigation .sub-menu .menu-item .menu-link, .ast-header-break-point .main-navigation .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $primary_submenu_spacing, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'desktop' ),
			),
			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'desktop' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'desktop' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'desktop' ),

			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right'  => 0,
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'desktop' ),

			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right'  => 0,
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'desktop' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'desktop' ),
			),

			/**
			 * Below Header Spacing
			 */
			// Below Header Spacing Top / Bottom Padding.
			'.ast-below-header, .ast-header-break-point .ast-below-header' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_spacing, 'top', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_spacing, 'bottom', 'desktop' ),
			),
			// Below Header Spacing Left / Right Padding apply to inside container.
			'.ast-below-header .ast-container, #masthead .ast-below-header .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $below_header_spacing, 'left', 'desktop' ),
				'padding-right' => astra_responsive_spacing( $below_header_spacing, 'right', 'desktop' ),
			),
			/**
			 * Below Header Menu Spacing
			 */
			'.ast-below-header-menu .menu-link, .below-header-nav-padding-support .below-header-section-1 .below-header-menu > .menu-item > .menu-link, .below-header-nav-padding-support .below-header-section-2 .below-header-menu > .menu-item > .menu-link, .ast-header-break-point .ast-below-header-actual-nav > .ast-below-header-menu > .menu-item > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_menu_spacing, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $below_header_menu_spacing, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_menu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $below_header_menu_spacing, 'left', 'desktop' ),
			),
			/**
			 * Below Header Submenu Spacing
			 */
			'.ast-desktop .ast-below-header-menu .ast-mm-template-content, .ast-desktop .ast-below-header-menu .ast-mm-custom-text-content, .ast-below-header-menu .sub-menu .menu-link, .ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_submenu_spacing, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $below_header_submenu_spacing, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_submenu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'desktop' ),
			),

			/* Padding right set to zero to all the menu elements that have submenu*/
			'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-below-menu-enable.ast-header-break-point .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right' => 0,
			),

			/* Align submenu toggle button with menu text for menu */
			'.ast-default-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-default-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle, .ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $below_header_menu_spacing, 'top', 'desktop' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $below_header_menu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for sub menu */
			'.ast-default-below-menu-enable .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle, .ast-flyout-below-menu-enable .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $below_header_submenu_spacing, 'top', 'desktop' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for full screen menu */
			'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/* Align submenu toggle button with menu text for full screen sub menu */
			'.ast-fullscreen-below-menu-enable .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/**
			 * Above Header Spacing
			 */
			// Above Header Spacing Top / Bottom Padding.
			'.ast-above-header'                => array(
				'padding-top'    => astra_responsive_spacing( $above_header_spacing, 'top', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_spacing, 'bottom', 'desktop' ),
			),
			// Above Header Spacing Left / Right Padding apply to inside container.
			'.ast-above-header-wrap .ast-above-header .ast-container, #masthead .ast-above-header-wrap .ast-above-header .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $above_header_spacing, 'left', 'desktop' ),
				'padding-right' => astra_responsive_spacing( $above_header_spacing, 'right', 'desktop' ),
			),
			/**
			 * Above Header Menu Spacing
			 */
			'.ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu > .menu-item > .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu > .menu-item:first-child > .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu > .menu-item:last-child > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $above_header_menu_spacing, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_menu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $above_header_menu_spacing, 'left', 'desktop' ),
			),
			/**
			 * Above Header Toggle Button Top
			 */
			'.ast-header-break-point .ast-above-header-navigation > ul > .menu-item-has-children > .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'desktop' ),
			),

			/**
			 * Above Header Submenu Spacing
			 */
			'.ast-desktop .ast-above-header-navigation .ast-mm-custom-text-content, .ast-desktop .ast-above-header-navigation .ast-mm-template-content, .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item .sub-menu .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-link, .ast-above-header-enabled .ast-above-header-menu > .menu-item:first-child .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $above_header_submenu_spacing, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $above_header_submenu_spacing, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_submenu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'desktop' ),
			),

			/* Padding right set to zero to all the menu elements that have submenu*/
			'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-above-menu-enable.ast-header-break-point .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right' => 0,
			),

			/* Align submenu toggle button with menu text for menu */
			'.ast-default-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-default-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle, .ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'desktop' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $above_header_menu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for sub menu */
			'.ast-default-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle, .ast-flyout-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $above_header_submenu_spacing, 'top', 'desktop' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'right', 'desktop' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for full screen menu */
			'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/* Align submenu toggle button with menu text for full screen sub menu */
			'.ast-fullscreen-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'margin-right' => astra_responsive_spacing( $above_header_submenu_spacing, 'right', 'desktop' ),
				'right'        => esc_attr( 0 ),
			),
			/**
			 * Footer Spacing
			 */
			// Footer Spacing Top / Bottom Padding.
			'.ast-footer-overlay'              => array(
				'padding-top'    => astra_responsive_spacing( $footer_spacing, 'top', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $footer_spacing, 'bottom', 'desktop' ),
			),
			// Footer Spacing Left / Right Padding to inside container.
			'.ast-small-footer .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $footer_spacing, 'left', 'desktop' ),
				'padding-right' => astra_responsive_spacing( $footer_spacing, 'right', 'desktop' ),
			),
			// Default margin for .ast-row is -20px, Managing Margin to fix repsonsive design.
			'.ast-small-footer .ast-row'       => array(
				'margin-left'  => astra_responsive_spacing( $footer_spacing, 'left', 'desktop' ),
				'margin-right' => astra_responsive_spacing( $footer_spacing, 'right', 'desktop' ),
			),

			/**
			 * Footer Menu Spacing
			 */
			'.ast-small-footer .nav-menu a, .footer-sml-layout-2 .ast-small-footer-section-1 .menu-item a, .footer-sml-layout-2 .ast-small-footer-section-2 .menu-item a' => array(
				'padding-top'    => astra_responsive_spacing( $footer_menu_spacing, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $footer_menu_spacing, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $footer_menu_spacing, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $footer_menu_spacing, 'left', 'desktop' ),
			),
		);

		$spacing_css_output .= astra_parse_css( $spacing );

		// Tablet Spacing.
		$tablet_spacing = array(
			// Header Spacing Top / Bottom Padding.
			'.main-header-bar, .ast-header-break-point .main-header-bar, .ast-header-break-point .header-main-layout-2 .main-header-bar' => array(
				'padding-top'    => astra_responsive_spacing( $header_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $header_spacing, 'bottom', 'tablet' ),
			),
			// Header Spacing Left / Right Padding apply to inside container.
			'.main-header-bar .ast-container, #masthead .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $header_spacing, 'left', 'tablet' ),
				'padding-right' => astra_responsive_spacing( $header_spacing, 'right', 'tablet' ),
			),
			/**
			 * Header Tablet Spacing
			 */
			'.ast-default-menu-enable.ast-main-header-nav-open.ast-header-break-point .main-header-bar, .ast-main-header-nav-open .main-header-bar' => array(
				'padding-bottom' => 0,
			),

			/**
			 * Main Menu Spacing
			 */
			'.main-navigation ul .menu-item .menu-link, .ast-header-break-point .main-navigation ul .menu-item .menu-link, .ast-header-break-point li.ast-masthead-custom-menu-items, li.ast-masthead-custom-menu-items' => array(
				'padding-top'    => astra_responsive_spacing( $primary_menu_spacing, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $primary_menu_spacing, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $primary_menu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $primary_menu_spacing, 'left', 'tablet' ),
			),
			'.ast-header-break-point .main-navigation ul .menu-item.menu-item-has-children button' => array(
				'padding-right'  => astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $primary_menu_spacing, 'bottom', 'mobile' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $primary_menu_spacing, 'top', 'tablet' ),
			),

			/**
			 * Main Submenu Spacing
			 */

			'.ast-desktop .main-navigation .ast-mm-template-content, .ast-desktop .main-navigation .ast-mm-custom-content, .ast-desktop .main-navigation .ast-mm-custom-text-content,.main-navigation .sub-menu .menu-item .menu-link, .ast-header-break-point .main-navigation .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'tablet' ),
				'padding-right'  => 0,
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ),
			),
			// Primary Header Submenu level 2.
			'.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ), '+', '10', 'px' ),
			),
			// Primary Header Submenu level 3.
			'.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ), '+', '20', 'px' ),
			),
			// Primary Header Submenu level 4.
			'.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ), '+', '30', 'px' ),
			),
			// Primary Header Submenu level 5.
			'.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ), '+', '40', 'px' ),
			),

			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'tablet' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'margin-right' => astra_responsive_spacing( $primary_submenu_spacing, 'right', 'tablet' ),
				'right'        => esc_attr( 0 ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'tablet' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ),

			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right'  => 0,
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ),

			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right'  => 0,
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'tablet' ),
			),

			/**
			 * Below Header Spacing
			 */
			// Below Header Spacing Top / Bottom Padding.
			'.ast-below-header, .ast-header-break-point .ast-below-header' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_spacing, 'bottom', 'tablet' ),
			),
			// Below Header Spacing Left / Right Padding apply to inside container.
			'.ast-below-header .ast-container, #masthead .ast-below-header .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $below_header_spacing, 'left', 'tablet' ),
				'padding-right' => astra_responsive_spacing( $below_header_spacing, 'right', 'tablet' ),
			),
			/**
			 * Below Header Menu Spacing
			 */
			'.ast-below-header-menu .menu-link, .below-header-nav-padding-support .below-header-section-1 .below-header-menu > .menu-item > .menu-link, .below-header-nav-padding-support .below-header-section-2 .below-header-menu > .menu-item > .menu-link, .ast-header-break-point .ast-below-header-actual-nav > .ast-below-header-menu > .menu-item > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_menu_spacing, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $below_header_menu_spacing, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_menu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $below_header_menu_spacing, 'left', 'tablet' ),
			),
			/**
			 * Below Header Submenu Spacing
			 */
			'.ast-desktop .ast-below-header-menu .ast-mm-template-content, .ast-desktop .ast-below-header-menu .ast-mm-custom-text-content, .ast-below-header-menu .sub-menu .menu-link, .ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_submenu_spacing, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $below_header_submenu_spacing, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_submenu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'tablet' ),
			),

			// Below Header Submenu level 2.
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-item .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'tablet' ), '+', '10', 'px' ),
			),
			// Below Header Submenu level 3.
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-item .menu-item .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'tablet' ), '+', '20', 'px' ),
			),
			// Below Header Submenu level 4.
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'tablet' ), '+', '30', 'px' ),
			),
			// Below Header Submenu level 5.
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-item .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'tablet' ), '+', '40', 'px' ),
			),

			/* Align submenu toggle button with menu text for menu */
			'.ast-default-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-default-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle, .ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $below_header_menu_spacing, 'top', 'tablet' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $below_header_menu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for sub menu */
			'.ast-default-below-menu-enable .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle, .ast-flyout-below-menu-enable .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $below_header_submenu_spacing, 'top', 'tablet' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for full screen menu */
			'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/* Align submenu toggle button with menu text for full screen sub menu */
			'.ast-fullscreen-below-menu-enable .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/**
			 * Above Header Spacing
			 */
			// Above Header Spacing Top / Bottom Padding.
			'.ast-above-header'                => array(
				'padding-top'    => astra_responsive_spacing( $above_header_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_spacing, 'bottom', 'tablet' ),
			),
			// Above Header Spacing Left / Right Padding apply to inside container.
			'.ast-above-header-wrap .ast-above-header .ast-container, #masthead .ast-above-header-wrap .ast-above-header .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $above_header_spacing, 'left', 'tablet' ),
				'padding-right' => astra_responsive_spacing( $above_header_spacing, 'right', 'tablet' ),
			),
			/**
			 * Above Header Menu Spacing
			 */
			'.ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu > .menu-item > .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu > .menu-item:first-child > .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu > .menu-item:last-child > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $above_header_menu_spacing, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_menu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $above_header_menu_spacing, 'left', 'tablet' ),
			),
			/**
			 * Above Header Toggle Button Top
			 */
			'.ast-header-break-point .ast-above-header-navigation > ul > .menu-item-has-children > .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'tablet' ),
			),

			/**
			 * Above Header Submenu Spacing
			 */
			'.ast-desktop .ast-above-header-navigation .ast-mm-custom-text-content, .ast-desktop .ast-above-header-navigation .ast-mm-template-content, .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item .sub-menu .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-link, .ast-above-header-enabled .ast-above-header-menu > .menu-item:first-child .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $above_header_submenu_spacing, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $above_header_submenu_spacing, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_submenu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'tablet' ),
			),
			// Above Header Submenu level 2.
			'.ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'tablet' ), '+', '10', 'px' ),
			),
			// Above Header Submenu level 3.
			'.ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'tablet' ), '+', '20', 'px' ),
			),
			// Above Header Submenu level 4.
			'.ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'tablet' ), '+', '30', 'px' ),
			),
			// Above Header Submenu level 5.
			'.ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'tablet' ), '+', '40', 'px' ),
			),

			/* Align submenu toggle button with menu text for menu */
			'.ast-default-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-default-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle, .ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'tablet' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $above_header_menu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for sub menu */
			'.ast-default-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle, .ast-flyout-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $above_header_submenu_spacing, 'top', 'tablet' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'right', 'tablet' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for full screen menu */
			'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/* Align submenu toggle button with menu text for full screen sub menu */
			'.ast-fullscreen-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'margin-right' => astra_responsive_spacing( $above_header_submenu_spacing, 'right', 'tablet' ),
				'right'        => esc_attr( 0 ),
			),
			/**
			 * Footer Spacing
			 */
			// Footer Spacing Top / Bottom Padding.
			'.ast-footer-overlay'              => array(
				'padding-top'    => astra_responsive_spacing( $footer_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $footer_spacing, 'bottom', 'tablet' ),
			),
			// Footer Spacing Left / Right Padding to inside container.
			'.ast-small-footer .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $footer_spacing, 'left', 'tablet' ),
				'padding-right' => astra_responsive_spacing( $footer_spacing, 'right', 'tablet' ),
			),
			// Default margin for .ast-row is -20px, Managing Margin to fix repsonsive design.
			'.ast-small-footer .ast-row'       => array(
				'margin-left'  => astra_responsive_spacing( $footer_spacing, 'left', 'tablet' ),
				'margin-right' => astra_responsive_spacing( $footer_spacing, 'right', 'tablet' ),
			),

			/**
			 * Footer Menu Spacing
			 */
			'.ast-small-footer .nav-menu a, .footer-sml-layout-2 .ast-small-footer-section-1 .menu-item a, .footer-sml-layout-2 .ast-small-footer-section-2 .menu-item a' => array(
				'padding-top'    => astra_responsive_spacing( $footer_menu_spacing, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $footer_menu_spacing, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $footer_menu_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $footer_menu_spacing, 'left', 'tablet' ),
			),
		);

		$spacing_css_output .= astra_parse_css( $tablet_spacing, '', astra_addon_get_tablet_breakpoint() );

		// Mobile Spacing.
		$mobile_spacing = array(
			// Header Spacing Top / Bottom Padding.
			'.main-header-bar, .ast-header-break-point .main-header-bar, .ast-header-break-point .header-main-layout-2 .main-header-bar, .ast-header-break-point .ast-mobile-header-stack .main-header-bar' => array(
				'padding-top'    => astra_responsive_spacing( $header_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $header_spacing, 'bottom', 'mobile' ),
			),
			// Header Spacing Left / Right Padding apply to inside container.
			'.main-header-bar .ast-container, #masthead .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $header_spacing, 'left', 'mobile' ),
				'padding-right' => astra_responsive_spacing( $header_spacing, 'right', 'mobile' ),
			),
			/**
			 * Header Mobile Spacing
			 */
			'.ast-default-menu-enable.ast-main-header-nav-open.ast-header-break-point .main-header-bar, .ast-main-header-nav-open .main-header-bar' => array(
				'padding-bottom' => 0,
			),

			/**
			 * Main Menu Spacing
			 */
			'.main-navigation ul .menu-item .menu-link, .ast-header-break-point .main-navigation ul .menu-item .menu-link, .ast-header-break-point li.ast-masthead-custom-menu-items, li.ast-masthead-custom-menu-items' => array(
				'padding-top'    => astra_responsive_spacing( $primary_menu_spacing, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $primary_menu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $primary_menu_spacing, 'left', 'mobile' ),
			),
			'.ast-header-break-point .main-navigation ul .menu-item.menu-item-has-children button' => array(
				'padding-right'  => astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $primary_menu_spacing, 'bottom', 'mobile' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $primary_menu_spacing, 'top', 'mobile' ),
			),

			/**
			 * Main Submenu Spacing
			 */

			'.ast-desktop .main-navigation .ast-mm-template-content, .ast-desktop .main-navigation .ast-mm-custom-content, .ast-desktop .main-navigation .ast-mm-custom-text-content,.main-navigation .sub-menu .menu-item .menu-link, .ast-header-break-point .main-navigation .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'mobile' ),
				'padding-right'  => 0,
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ),
			),
			// Primary Header Submenu level 2.
			'.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ), '+', '10', 'px' ),
			),
			// Primary Header Submenu level 3.
			'.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ), '+', '20', 'px' ),
			),
			// Primary Header Submenu level 4.
			'.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ), '+', '30', 'px' ),
			),
			// Primary Header Submenu level 5.
			'.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ), '+', '40', 'px' ),
			),
			'.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'mobile' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'margin-right' => astra_responsive_spacing( $primary_submenu_spacing, 'right', 'mobile' ),
				'right'        => esc_attr( 0 ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .sub-menu .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => astra_calc_spacing( astra_responsive_spacing( $primary_submenu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ),
			),
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'mobile' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ),

			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right'  => 0,
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ),

			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right'  => 0,
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ),
			),
			'.ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-link, .ast-fullscreen-menu-enable.ast-header-break-point .main-navigation .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $primary_submenu_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $primary_submenu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $primary_submenu_spacing, 'left', 'mobile' ),
			),

			/**
			 * Below Header Spacing
			 */
			// Below Header Spacing Top / Bottom Padding.
			'.ast-below-header, .ast-header-break-point .ast-below-header' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_spacing, 'bottom', 'mobile' ),
			),
			// Below Header Spacing Left / Right Padding apply to inside container.
			'.ast-below-header .ast-container, #masthead .ast-below-header .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $below_header_spacing, 'left', 'mobile' ),
				'padding-right' => astra_responsive_spacing( $below_header_spacing, 'right', 'mobile' ),
			),
			/**
			 * Below Header Menu Spacing
			 */
			'.ast-below-header-menu .menu-link, .below-header-nav-padding-support .below-header-section-1 .below-header-menu > .menu-item > .menu-link, .below-header-nav-padding-support .below-header-section-2 .below-header-menu > .menu-item > .menu-link, .ast-header-break-point .ast-below-header-actual-nav > .ast-below-header-menu > .menu-item > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_menu_spacing, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $below_header_menu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_menu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $below_header_menu_spacing, 'left', 'mobile' ),
			),
			/**
			 * Below Header Submenu Spacing
			 */
			'.ast-desktop .ast-below-header-menu .ast-mm-template-content, .ast-desktop .ast-below-header-menu .ast-mm-custom-text-content, .ast-below-header-menu .sub-menu .menu-link, .ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $below_header_submenu_spacing, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $below_header_submenu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $below_header_submenu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'mobile' ),
			),
			// Below Header Submenu level 2.
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-item .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'mobile' ), '+', '10', 'px' ),
			),
			// Below Header Submenu level 3.
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-item .menu-item .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'mobile' ), '+', '20', 'px' ),
			),
			// Below Header Submenu level 4.
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'mobile' ), '+', '30', 'px' ),
			),
			// Below Header Submenu level 5.
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-item .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'left', 'mobile' ), '+', '40', 'px' ),
			),

			/* Align submenu toggle button with menu text for menu */
			'.ast-default-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-default-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle, .ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $below_header_menu_spacing, 'top', 'mobile' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $below_header_menu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for sub menu */
			'.ast-default-below-menu-enable.ast-header-break-point .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle, .ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $below_header_submenu_spacing, 'top', 'mobile' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $below_header_submenu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for full screen menu */
			'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item-has-children > .ast-menu-toggle, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/* Align submenu toggle button with menu text for full screen sub menu */
			'.ast-fullscreen-below-menu-enable .ast-below-header-enabled .ast-below-header-navigation .ast-below-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/**
			 * Above Header Spacing
			 */
			// Above Header Spacing Top / Bottom Padding.
			'.ast-above-header'                => array(
				'padding-top'    => astra_responsive_spacing( $above_header_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_spacing, 'bottom', 'mobile' ),
			),
			// Above Header Spacing Left / Right Padding apply to inside container.
			'.ast-above-header-wrap .ast-above-header .ast-container, #masthead .ast-above-header-wrap .ast-above-header .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $above_header_spacing, 'left', 'mobile' ),
				'padding-right' => astra_responsive_spacing( $above_header_spacing, 'right', 'mobile' ),
			),
			/**
			 * Above Header Menu Spacing
			 */
			'.ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu > .menu-item > .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu > .menu-item:first-child > .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu > .menu-item:last-child > .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $above_header_menu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_menu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $above_header_menu_spacing, 'left', 'mobile' ),
			),
			/**
			 * Above Header Toggle Button Top
			 */
			'.ast-header-break-point .ast-above-header-navigation > ul > .menu-item-has-children > .ast-menu-toggle' => array(
				'top' => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'mobile' ),
			),

			/**
			 * Above Header Submenu Spacing
			 */
			'.ast-desktop .ast-above-header-navigation .ast-mm-custom-text-content, .ast-desktop .ast-above-header-navigation .ast-mm-template-content, .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item .sub-menu .menu-link, .ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-link, .ast-above-header-enabled .ast-above-header-menu > .menu-item:first-child .sub-menu .menu-item .menu-link' => array(
				'padding-top'    => astra_responsive_spacing( $above_header_submenu_spacing, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $above_header_submenu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $above_header_submenu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'mobile' ),
			),
			// Above Header Submenu level 2.
			'.ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'mobile' ), '+', '10', 'px' ),
			),
			// Above Header Submenu level 3.
			'.ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'mobile' ), '+', '20', 'px' ),
			),
			// Above Header Submenu level 4.
			'.ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'mobile' ), '+', '30', 'px' ),
			),
			// Above Header Submenu level 5.
			'.ast-header-break-point .ast-above-header-enabled .ast-above-header-menu .menu-item .sub-menu .menu-item .menu-item .menu-item .menu-item .menu-link' => array(
				'padding-left' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'left', 'mobile' ), '+', '40', 'px' ),
			),

			/* Padding right set to zero to all the menu elements that have submenu*/
			'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children > .menu-link, .ast-default-above-menu-enable.ast-header-break-point .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children > .menu-link, .ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children > .menu-link' => array(
				'padding-right' => 0,
			),

			/* Align submenu toggle button with menu text for menu */
			'.ast-default-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-default-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle, .ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle,  .ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $above_header_menu_spacing, 'top', 'mobile' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $above_header_menu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for sub menu */
			'.ast-default-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle, .ast-flyout-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'top'   => astra_responsive_spacing( $above_header_submenu_spacing, 'top', 'mobile' ),
				'right' => astra_calc_spacing( astra_responsive_spacing( $above_header_submenu_spacing, 'right', 'mobile' ), '-', '0.907', 'em' ),
			),

			/* Align submenu toggle button with menu text for full screen menu */
			'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu-items .menu-item-has-children > .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),

			/* Align submenu toggle button with menu text for full screen sub menu */
			'.ast-fullscreen-above-menu-enable .ast-above-header-enabled .ast-above-header-navigation .ast-above-header-menu .menu-item.menu-item-has-children .sub-menu .ast-menu-toggle' => array(
				'right' => esc_attr( 0 ),
			),
			/**
			 * Footer Spacing
			 */
			// Footer Spacing Top / Bottom Padding.
			'.ast-footer-overlay'              => array(
				'padding-top'    => astra_responsive_spacing( $footer_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $footer_spacing, 'bottom', 'mobile' ),
			),
			// Footer Spacing Left / Right Padding to inside container.
			'.ast-small-footer .ast-container' => array(
				'padding-left'  => astra_responsive_spacing( $footer_spacing, 'left', 'mobile' ),
				'padding-right' => astra_responsive_spacing( $footer_spacing, 'right', 'mobile' ),
			),
			// Default margin for .ast-row is -20px, Managing Margin to fix repsonsive design.
			'.ast-small-footer .ast-row'       => array(
				'margin-left'  => astra_responsive_spacing( $footer_spacing, 'left', 'mobile' ),
				'margin-right' => astra_responsive_spacing( $footer_spacing, 'right', 'mobile' ),
			),

			/**
			 * Footer Menu Spacing
			 */
			'.ast-small-footer .nav-menu a, .footer-sml-layout-2 .ast-small-footer-section-1 .menu-item a, .footer-sml-layout-2 .ast-small-footer-section-2 .menu-item a' => array(
				'padding-top'    => astra_responsive_spacing( $footer_menu_spacing, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $footer_menu_spacing, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $footer_menu_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $footer_menu_spacing, 'left', 'mobile' ),
			),
		);

		$spacing_css_output .= astra_parse_css( $mobile_spacing, '', astra_addon_get_mobile_breakpoint() );

		$remove_bottom_sire_brancing = array(
			'.ast-header-break-point .header-main-layout-2 .site-branding, .ast-header-break-point .ast-mobile-header-stack .ast-mobile-menu-buttons'                    => array(
				'padding-bottom' => astra_get_css_value( 0, 'px' ),
			),
		);

		if ( isset( $header_spacing['mobile']['bottom'] ) && ( '' != $header_spacing['mobile']['bottom'] ) ) {
			$spacing_css_output .= astra_parse_css( $remove_bottom_sire_brancing, '', astra_addon_get_mobile_breakpoint() );
		}
	}

	return $dynamic_css . $spacing_css_output;
}
