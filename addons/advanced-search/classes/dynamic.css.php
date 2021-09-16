<?php
/**
 * Mega Menu - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_ext_adv_search_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_adv_search_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {
	$css = '';
	if ( false === Astra_Icons::is_svg_icons() ) {
		$search_close_btn = array(
			'.ast-search-box.header-cover #close::before, .ast-search-box.full-screen #close::before' => array(
				'font-family' => 'Astra',
				'content'     => '"\e5cd"',
				'display'     => 'inline-block',
				'transition'  => 'transform .3s ease-in-out',
			),
		);

		/* Parse CSS from array() */
		$css .= astra_parse_css( $search_close_btn );
	}

	return $dynamic_css . $css;
}
