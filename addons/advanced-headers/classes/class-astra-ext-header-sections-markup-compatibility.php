<?php
/**
 * Advanced Header Markup.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       3.3.0
 */

/**
 * Advanced Header Markup Initial Setup
 *
 * @since 3.3.0
 */
// @codingStandardsIgnoreStart
class Astra_Ext_Header_Sections_Markup_Compatibility {
	// @codingStandardsIgnoreEnd

	/**
	 *  Constructor
	 */
	public function __construct() {

		if ( astra_addon_builder_helper()->is_header_footer_builder_active ) {

			// Above Header markup control.
			add_filter( 'astra_above_header_display', array( $this, 'astra_above_header_enabled' ) );
			// Below Header markup control.
			add_filter( 'astra_below_header_display', array( $this, 'astra_below_header_enabled' ) );
		}
	}

	/**
	 * Above Header status
	 *
	 * @since  3.3.0
	 * @return string|boolean
	 */
	public function astra_above_header_enabled() {

		$above_header_meta = astra_get_option_meta( 'ast-hfb-above-header-display' );

		if ( 'disabled' !== $above_header_meta ) {
			if ( Astra_Ext_Extension::is_active( 'advanced-headers' ) ) {
				// Above Header meta from the Advanced Headers.
				$above_header = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'above-header-enabled' );

				if ( Astra_Ext_Advanced_Headers_Markup::advanced_header_enabled() && ( is_front_page() && 'posts' === get_option( 'show_on_front' ) ) ) {
					return false;
				} elseif ( 'enabled' !== $above_header && Astra_Ext_Advanced_Headers_Markup::advanced_header_enabled() ) {
					return 'disabled';
				}
			}
			return false;
		}
		return 'disabled';
	}

	/**
	 * Below Header status
	 *
	 * @since  3.3.0
	 * @return string|boolean
	 */
	public function astra_below_header_enabled() {

		$below_header_meta = astra_get_option_meta( 'ast-hfb-below-header-display' );

		if ( 'disabled' !== $below_header_meta ) {
			if ( Astra_Ext_Extension::is_active( 'advanced-headers' ) ) {
				// Below Header meta from the Advanced Headers.
				$below_header = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'below-header-enabled' );

				if ( Astra_Ext_Advanced_Headers_Markup::advanced_header_enabled() && ( is_front_page() && 'posts' === get_option( 'show_on_front' ) ) ) {
					return false;
				} elseif ( 'enabled' !== $below_header && Astra_Ext_Advanced_Headers_Markup::advanced_header_enabled() ) {
					return 'disabled';
				}
			}
			return false;
		}
		return 'disabled';
	}

}

new Astra_Ext_Header_Sections_Markup_Compatibility();
