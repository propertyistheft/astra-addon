<?php
/**
 * Typography - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_lifterlms_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_lifterlms_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$header_spacing = astra_get_option( 'header-spacing' );

	/**
	 * Set font sizes
	 */
	$css_output = '';

	if ( Astra_Ext_Extension::is_active( 'spacing' ) ) {
		/**
		 * Header Desktop/Tablet/Mobile Spacing
		 */
		// Remove padding bottom to header's Menu Profile Link Toggle button which is static.
		// Only if any of the bottom ( desktop, tablet, mobile ) spacing is given.
		$remove_bottom_profile_link = array(
			'.llms-profile-link-enabled.ast-header-break-point .main-header-log-out,.llms-profile-link-enabled.ast-header-break-point .header-main-layout-2 .main-header-log-out'                    => array(
				'padding-bottom' => astra_get_css_value( 0, 'px' ),
			),
		);

		if ( isset( $header_spacing['desktop']['bottom'] ) && ( '' != $header_spacing['desktop']['bottom'] ) ) {
			$css_output .= astra_parse_css( $remove_bottom_profile_link );
		}
		if ( isset( $header_spacing['tablet']['bottom'] ) && ( '' != $header_spacing['tablet']['bottom'] ) ) {
			$css_output .= astra_parse_css( $remove_bottom_profile_link, '', astra_addon_get_tablet_breakpoint() );
		}
		if ( isset( $header_spacing['mobile']['bottom'] ) && ( '' != $header_spacing['mobile']['bottom'] ) ) {
			$css_output .= astra_parse_css( $remove_bottom_profile_link, '', astra_addon_get_mobile_breakpoint() );
		}
	}

	return $dynamic_css . $css_output;
}

