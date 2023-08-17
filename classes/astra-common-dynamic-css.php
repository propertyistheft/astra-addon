<?php
/**
 * Astra Addon Common dynamic CSS.
 *
 * @package Astra Addon
 */

if ( Astra_Ext_Extension::is_active( 'blog-pro' ) ) {
	add_filter( 'astra_addon_dynamic_css', 'astra_addon_blog_pro_dynamic_css', 9 );
}

/**
 * Dynamic CSS for Single Post Author Info-box
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_addon_blog_pro_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * - Variable Declaration.
	 */
	$is_site_rtl = is_rtl();
	$css_output  = '';
	$theme_color = astra_get_option( 'theme-color' );
	$link_color  = astra_get_option( 'link-color', $theme_color );

	$desktop_max_css = array(
		// Updated before content value to fix the masonry layout issue.
		'#content:before'                           => array(
			'content'    => '"' . astra_addon_get_tablet_breakpoint() . '"',
			'position'   => 'absolute',
			'overflow'   => 'hidden',
			'opacity'    => '0',
			'visibility' => 'hidden',
		),
		'.single .ast-author-details .author-title' => array(
			'color' => esc_attr( $link_color ),
		),
	);

	if ( true === astra_get_option( 'customizer-default-layout-update', true ) ) {
		$desktop_max_css['.single.ast-page-builder-template .ast-single-author-box'] = array(
			'padding' => '2em 20px',
		);
		$desktop_max_css['.single.ast-separate-container .ast-author-meta']          = array(
			'padding' => '3em',
		);
	}

	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $desktop_max_css );

	$tablet_max_css = array(
		// Single Post author info.
		'.single.ast-separate-container .ast-author-meta' => array(
			'padding' => '1.5em 2.14em',
		),
		'.single .ast-author-meta .post-author-avatar'    => array(
			'margin-bottom' => '1em',
		),
		'.ast-separate-container .ast-grid-2 .ast-article-post, .ast-separate-container .ast-grid-3 .ast-article-post, .ast-separate-container .ast-grid-4 .ast-article-post' => array(
			'width' => '100%',
		),
		'.blog-layout-1 .post-content, .blog-layout-1 .ast-blog-featured-section' => array(
			'float' => 'none',
		),
		'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .square .posted-on' => array(
			'margin-top' => 0,
		),
		'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .circle .posted-on' => array(
			'margin-top' => '1em',
		),
		'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content' => array(
			'margin-top' => '-1.5em',
		),
		'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content' => array(
			'margin-left'  => '-2.14em',
			'margin-right' => '-2.14em',
		),
		'.ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .entry-header .post-thumb-img-content:first-child' => array(
			'margin-top' => '-1.5em',
		),
		'.ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .post-thumb-img-content' => array(
			'margin-left'  => '-2.14em',
			'margin-right' => '-2.14em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
			'margin-left'  => '-1.5em',
			'margin-right' => '-1.5em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on' => array(
			'margin-left'  => '-0.5em',
			'margin-right' => '-0.5em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .square .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .square .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .square .posted-on' => array(
			'margin-top' => 0,
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .circle .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .circle .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .circle .posted-on' => array(
			'margin-top' => '1em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content' => array(
			'margin-top' => '-1.5em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content' => array(
			'margin-left'  => '-1.5em',
			'margin-right' => '-1.5em',
		),
		'.blog-layout-2'                                  => array(
			'display'        => 'flex',
			'flex-direction' => 'column-reverse',
		),
		'.ast-separate-container .blog-layout-3, .ast-separate-container .blog-layout-1' => array(
			'display' => 'block',
		),
		'.ast-plain-container .ast-grid-2 .ast-article-post, .ast-plain-container .ast-grid-3 .ast-article-post, .ast-plain-container .ast-grid-4 .ast-article-post, .ast-page-builder-template .ast-grid-2 .ast-article-post, .ast-page-builder-template .ast-grid-3 .ast-article-post, .ast-page-builder-template .ast-grid-4 .ast-article-post' => array(
			'width' => '100%',
		),
	);

	/* Parse CSS from array() -> max-width: (tablet-breakpoint)px */
	$css_output .= astra_parse_css( $tablet_max_css, '', astra_addon_get_tablet_breakpoint() );

	if ( $is_site_rtl ) {
		$tablet_max_lang_direction_css = array(
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-top'   => 0,
				'margin-right' => '-2.14em',
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on' => array(
				'margin-top'   => 0,
				'margin-right' => '-1.14em',
			),
		);
	} else {
		$tablet_max_lang_direction_css = array(
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-top'  => 0,
				'margin-left' => '-2.14em',
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on' => array(
				'margin-top'  => 0,
				'margin-left' => '-1.14em',
			),
		);
	}

	/* Parse CSS from array() -> max-width: (tablet-breakpoint)px */
	$css_output .= astra_parse_css( $tablet_max_lang_direction_css, '', astra_addon_get_tablet_breakpoint() );

	/**
	 * Normal blog multiple column layout creates extra spacing around category title, whereas this '-1em' needed when "Add Space Between Posts" optionn is enabled.
	 *
	 * @since 3.5.7
	 */
	$margin_space = astra_get_option( 'blog-space-bet-posts' ) ? '-1em' : '0';

	$tablet_min_css = array(
		'.ast-separate-container.ast-blog-grid-2 .ast-archive-description, .ast-separate-container.ast-blog-grid-3 .ast-archive-description, .ast-separate-container.ast-blog-grid-4 .ast-archive-description' => array(
			'margin-bottom' => '1.33333em',
		),
		'.blog-layout-2.ast-no-thumb .post-content, .blog-layout-3.ast-no-thumb .post-content' => array(
			'width' => 'calc(100% - 5.714285714em)',
		),
		'.blog-layout-2.ast-no-thumb.ast-no-date-box .post-content, .blog-layout-3.ast-no-thumb.ast-no-date-box .post-content' => array(
			'width' => '100%',
		),
		'.ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts, .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts, .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts' => array(
			'border-bottom' => 0,
		),
		'.ast-separate-container .ast-grid-2 > .site-main > .ast-row, .ast-separate-container .ast-grid-3 > .site-main > .ast-row, .ast-separate-container .ast-grid-4 > .site-main > .ast-row' => array(
			'margin-left'  => esc_attr( $margin_space ),
			'margin-right' => esc_attr( $margin_space ),
			'display'      => 'flex',
			'flex-flow'    => 'row wrap',
			'align-items'  => 'stretch',
		),
		'.ast-separate-container .ast-grid-2 > .site-main > .ast-row:before, .ast-separate-container .ast-grid-2 > .site-main > .ast-row:after, .ast-separate-container .ast-grid-3 > .site-main > .ast-row:before, .ast-separate-container .ast-grid-3 > .site-main > .ast-row:after, .ast-separate-container .ast-grid-4 > .site-main > .ast-row:before, .ast-separate-container .ast-grid-4 > .site-main > .ast-row:after' => array(
			'flex-basis' => 0,
			'width'      => 0,
		),
		'.ast-separate-container .ast-grid-2 .ast-article-post, .ast-separate-container .ast-grid-3 .ast-article-post, .ast-separate-container .ast-grid-4 .ast-article-post' => array(
			'display' => 'flex',
			'padding' => 0,
		),
		'.ast-plain-container .ast-grid-2 > .site-main > .ast-row, .ast-plain-container .ast-grid-3 > .site-main > .ast-row, .ast-plain-container .ast-grid-4 > .site-main > .ast-row, .ast-page-builder-template .ast-grid-2 > .site-main > .ast-row, .ast-page-builder-template .ast-grid-3 > .site-main > .ast-row, .ast-page-builder-template .ast-grid-4 > .site-main > .ast-row' => array(
			'margin-left'  => '-1em',
			'margin-right' => '-1em',
			'display'      => 'flex',
			'flex-flow'    => 'row wrap',
			'align-items'  => 'stretch',
		),
		'.ast-plain-container .ast-grid-2 > .site-main > .ast-row:before, .ast-plain-container .ast-grid-2 > .site-main > .ast-row:after, .ast-plain-container .ast-grid-3 > .site-main > .ast-row:before, .ast-plain-container .ast-grid-3 > .site-main > .ast-row:after, .ast-plain-container .ast-grid-4 > .site-main > .ast-row:before, .ast-plain-container .ast-grid-4 > .site-main > .ast-row:after, .ast-page-builder-template .ast-grid-2 > .site-main > .ast-row:before, .ast-page-builder-template .ast-grid-2 > .site-main > .ast-row:after, .ast-page-builder-template .ast-grid-3 > .site-main > .ast-row:before, .ast-page-builder-template .ast-grid-3 > .site-main > .ast-row:after, .ast-page-builder-template .ast-grid-4 > .site-main > .ast-row:before, .ast-page-builder-template .ast-grid-4 > .site-main > .ast-row:after' => array(
			'flex-basis' => 0,
			'width'      => 0,
		),
		'.ast-plain-container .ast-grid-2 .ast-article-post, .ast-plain-container .ast-grid-3 .ast-article-post, .ast-plain-container .ast-grid-4 .ast-article-post, .ast-page-builder-template .ast-grid-2 .ast-article-post, .ast-page-builder-template .ast-grid-3 .ast-article-post, .ast-page-builder-template .ast-grid-4 .ast-article-post' => array(
			'display' => 'flex',
		),
		'.ast-plain-container .ast-grid-2 .ast-article-post:last-child, .ast-plain-container .ast-grid-3 .ast-article-post:last-child, .ast-plain-container .ast-grid-4 .ast-article-post:last-child, .ast-page-builder-template .ast-grid-2 .ast-article-post:last-child, .ast-page-builder-template .ast-grid-3 .ast-article-post:last-child, .ast-page-builder-template .ast-grid-4 .ast-article-post:last-child' => array(
			'margin-bottom' => '2.5em',
		),
	);

	if ( true === astra_get_option( 'customizer-default-layout-update', true ) ) {
		$tablet_min_css['.single .ast-author-meta .ast-author-details'] = array(
			'display'     => 'flex',
			'align-items' => 'center',
		);
		$tablet_min_css['.post-author-bio .author-title']               = array(
			'margin-bottom' => '10px',
		);
	} else {
		$tablet_min_css['.single .ast-author-meta .ast-author-details'] = array(
			'display' => 'flex',
		);
	}

	/* Parse CSS from array() -> min-width: (tablet-breakpoint + 1)px */
	$css_output .= astra_parse_css( $tablet_min_css, astra_addon_get_tablet_breakpoint( '', 1 ) );

	if ( $is_site_rtl ) {
		$tablet_min_lang_direction_css = array(
			'.single .post-author-avatar, .single .post-author-bio' => array(
				'float' => 'right',
				'clear' => 'left',
			),
			'.single .ast-author-meta .post-author-avatar' => array(
				'margin-left' => '1.33333em',
			),
			'.single .ast-author-meta .about-author-title-wrapper, .single .ast-author-meta .post-author-bio' => array(
				'text-align' => 'right',
			),
			'.blog-layout-2 .post-content'                 => array(
				'padding-left' => '2em',
			),
			'.blog-layout-2.ast-no-date-box.ast-no-thumb .post-content' => array(
				'padding-left' => 0,
			),
			'.blog-layout-3 .post-content'                 => array(
				'padding-right' => '2em',
			),
			'.blog-layout-3.ast-no-date-box.ast-no-thumb .post-content' => array(
				'padding-right' => 0,
			),
			'.ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+1)' => array(
				'padding' => '0 0 0 1em',
			),
		);
	} else {
		$tablet_min_lang_direction_css = array(
			'.single .post-author-avatar, .single .post-author-bio' => array(
				'float' => 'left',
				'clear' => 'right',
			),
			'.single .ast-author-meta .post-author-avatar' => array(
				'margin-right' => '1.33333em',
			),
			'.single .ast-author-meta .about-author-title-wrapper, .single .ast-author-meta .post-author-bio' => array(
				'text-align' => 'left',
			),
			'.blog-layout-2 .post-content'                 => array(
				'padding-right' => '2em',
			),
			'.blog-layout-2.ast-no-date-box.ast-no-thumb .post-content' => array(
				'padding-right' => 0,
			),
			'.blog-layout-3 .post-content'                 => array(
				'padding-left' => '2em',
			),
			'.blog-layout-3.ast-no-date-box.ast-no-thumb .post-content' => array(
				'padding-left' => 0,
			),
			'.ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-2 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-3 .ast-article-post.ast-separate-posts:nth-child(2n+1), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+0), .ast-separate-container .ast-grid-4 .ast-article-post.ast-separate-posts:nth-child(2n+1)' => array(
				'padding' => '0 1em 0',
			),
		);
	}

	/* Parse CSS from array() -> min-width: (tablet-breakpoint + 1)px */
	$css_output .= astra_parse_css( $tablet_min_lang_direction_css, astra_addon_get_tablet_breakpoint( '', 1 ) );

	$mobile_css = array(
		'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .circle .posted-on' => array(
			'margin-top' => '0.5em',
		),
		'.ast-separate-container .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container .ast-article-single.remove-featured-img-padding .single-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
			'margin-left'  => '-1em',
			'margin-right' => '-1em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on' => array(
			'margin-left'  => '-0.5em',
			'margin-right' => '-0.5em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .circle .posted-on, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .circle .posted-on, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section:first-child .circle .posted-on' => array(
			'margin-top' => '0.5em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-content .ast-blog-featured-section:first-child .post-thumb-img-content' => array(
			'margin-top' => '-1.33333em',
		),
		'.ast-separate-container.ast-blog-grid-2 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-3 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content, .ast-separate-container.ast-blog-grid-4 .ast-article-post.remove-featured-img-padding .blog-layout-1 .post-thumb-img-content' => array(
			'margin-left'  => '-1em',
			'margin-right' => '-1em',
		),
		'.ast-separate-container .ast-grid-2 .ast-article-post .blog-layout-1, .ast-separate-container .ast-grid-2 .ast-article-post .blog-layout-2, .ast-separate-container .ast-grid-2 .ast-article-post .blog-layout-3' => array(
			'padding' => '1.33333em 1em',
		),
		'.ast-separate-container .ast-grid-3 .ast-article-post .blog-layout-1, .ast-separate-container .ast-grid-4 .ast-article-post .blog-layout-1' => array(
			'padding' => '1.33333em 1em',
		),
		'.single.ast-separate-container .ast-author-meta' => array(
			'padding' => '1.5em 1em',
		),
	);

	/* Parse CSS from array() -> max-width: (mobile-breakpoint)px */
	$css_output .= astra_parse_css( $mobile_css, '', astra_addon_get_mobile_breakpoint() );

	if ( $is_site_rtl ) {
		$mobile_max_direction_css = array(
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-right' => '-1em',
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on' => array(
				'margin-right' => '-0.5em',
			),
		);
	} else {
		$mobile_max_direction_css = array(
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .square .posted-on' => array(
				'margin-left' => '-1em',
			),
			'.ast-separate-container .ast-article-post.remove-featured-img-padding.has-post-thumbnail .blog-layout-1 .post-content .ast-blog-featured-section .circle .posted-on' => array(
				'margin-left' => '-0.5em',
			),
		);
	}

	/* Parse CSS from array() -> max-width: (mobile-breakpoint)px */
	$css_output .= astra_parse_css( $mobile_max_direction_css, '', astra_addon_get_mobile_breakpoint() );

	return $dynamic_css . $css_output;
}
