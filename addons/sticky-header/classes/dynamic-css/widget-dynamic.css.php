<?php
/**
 * Sticky Header Buttons Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_sticky_header_widget_dynamic_css', 30 );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_sticky_header_widget_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$num_of_header_widgets = astra_addon_builder_helper()->num_of_header_widgets;
	for ( $index = 1; $index <= $num_of_header_widgets; $index++ ) {

		if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'widget-' . $index, 'header' ) ) {
			continue;
		}

		$_section = 'sidebar-widgets-header-widget-' . $index;
		$selector = '.ast-header-sticked .header-widget-area[data-section="sidebar-widgets-header-widget-' . $index . '"]';

		/**
		 * Copyright CSS.
		 */
		if ( Astra_Addon_Builder_Helper::apply_flex_based_css() ) {
			$header_widget_selector = $selector . '.header-widget-area-inner';
		} else {
			$header_widget_selector = $selector . ' .header-widget-area-inner';
		}
		$css_output_desktop = array(

			$header_widget_selector              => array(
				'color' => astra_get_option( 'sticky-header-widget-' . $index . '-color' ),
			),
			$header_widget_selector . ' a'       => array(
				'color' => astra_get_option( 'sticky-header-widget-' . $index . '-link-color' ),
			),
			$header_widget_selector . ' a:hover' => array(
				'color' => astra_get_option( 'sticky-header-widget-' . $index . '-link-h-color' ),
			),
			$selector . ' .widget-title, ' . $selector . ' h1, ' . $selector . ' .widget-area h1, ' . $selector . ' h2, ' . $selector . ' .widget-area h2, ' . $selector . ' h3, ' . $selector . ' .widget-area h3, ' . $selector . ' h4, ' . $selector . ' .widget-area h4, ' . $selector . ' h5, ' . $selector . ' .widget-area h5, ' . $selector . ' h6, ' . $selector . ' .widget-area h6' => array(
				'color' => astra_get_option( 'sticky-header-widget-' . $index . '-title-color' ),
			),
		);

		/* Parse CSS from array() */
		$css_output   = astra_parse_css( $css_output_desktop );
		$dynamic_css .= $css_output;
	}

	return $dynamic_css;

}
