<?php
/**
 * Blog Pro - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_ext_blog_pro_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_blog_pro_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$parse_css = '';

	$body_font_family = astra_body_font_family();
	$link_color       = astra_get_option( 'link-color' );
	$text_color       = astra_get_option( 'text-color' );

	$blog_layout           = astra_get_option( 'blog-layout' );
	$blog_pagination       = astra_get_option( 'blog-pagination' );
	$blog_pagination_style = astra_get_option( 'blog-pagination-style' );

	$css_output = array(
		// Blog Layout 1 Dynamic Style.
		'.ast-article-post .ast-date-meta .posted-on, .ast-article-post .ast-date-meta .posted-on *' => array(
			'background' => esc_attr( $link_color ),
			'color'      => astra_get_foreground_color( $link_color ),
		),
		'.ast-article-post .ast-date-meta .posted-on .date-month, .ast-article-post .ast-date-meta .posted-on .date-year' => array(
			'color' => astra_get_foreground_color( $link_color ),
		),
		'.ast-load-more:hover' => array(
			'color'            => astra_get_foreground_color( $link_color ),
			'border-color'     => esc_attr( $link_color ),
			'background-color' => esc_attr( $link_color ),
		),
		'.ast-loader > div'    => array(
			'background-color' => esc_attr( $link_color ),
		),
	);

	if ( 'number' === $blog_pagination ) {

		if ( 'circle' === $blog_pagination_style || 'square' === $blog_pagination_style ) {

			$css_output['.ast-pagination .page-numbers'] = array(
				'color'        => $text_color,
				'border-color' => $link_color,
			);

			$css_output['.ast-pagination .page-numbers.current, .ast-pagination .page-numbers:focus, .ast-pagination .page-numbers:hover'] = array(
				'color'            => astra_get_foreground_color( $link_color ),
				'background-color' => $link_color,
				'border-color'     => $link_color,
			);
		}
	}

	/* Parse CSS from array() */
	$parse_css = astra_parse_css( $css_output );

	return $dynamic_css . $parse_css;
}
