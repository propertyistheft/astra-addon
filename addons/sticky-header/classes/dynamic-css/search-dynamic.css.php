<?php
/**
 * Sticky Header Social Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_sticky_header_search_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_sticky_header_search_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$selector = '.ast-header-sticked .ast-header-search';

	if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'search', 'header' ) ) {
		return $dynamic_css;
	}

	/**
	 * Search CSS.
	 */
	$css_output_desktop = array(

		$selector . ' .astra-search-icon, ' . $selector . ' .search-field::placeholder,' . $selector . ' .ast-icon' => array(
			'color' => esc_attr( astra_get_option( 'sticky-header-search-icon-color' ) ),
		),
		$selector . ' .astra-search-icon:hover,' . $selector . ' .ast-icon:hover' => array(
			'color' => esc_attr( astra_get_option( 'sticky-header-search-icon-h-color' ) ),
		),
		$selector . ' .search-field, ' . $selector . ' .ast-search-menu-icon .search-field::placeholder' => array(
			'color' => esc_attr( astra_get_option( 'sticky-header-search-text-placeholder-color' ) ),
		),
		$selector . ' .ast-search-menu-icon .search-field, ' . $selector . ' .ast-search-menu-icon .search-form, ' . $selector . ' .ast-search-menu-icon .search-submit ' => array(
			'background-color' => esc_attr( astra_get_option( 'sticky-header-search-box-background-color' ) ),
		),
		$selector . ' .ast-search-menu-icon:hover .search-field, ' . $selector . ' .ast-search-menu-icon:hover .search-form, ' . $selector . ' .ast-search-menu-icon:hover .search-submit,' . $selector . ' .ast-search-menu-icon:focus .search-field, ' . $selector . ' .ast-search-menu-icon:focus .search-form, ' . $selector . ' .ast-search-menu-icon:focus .search-submit' => array(
			'background-color' => esc_attr( astra_get_option( 'sticky-header-search-box-background-h-color' ) ),
		),
	);
	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output_desktop );

	$dynamic_css .= $css_output;

	return $dynamic_css;

}
