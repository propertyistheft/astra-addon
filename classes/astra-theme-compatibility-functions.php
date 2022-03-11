<?php
/**
 * Astra Theme Extension
 *
 * @package Astra Addon
 */

if ( ! function_exists( 'astra_get_theme_name' ) ) :

	/**
	 * Get theme name.
	 *
	 * @return string Theme Name.
	 */
	function astra_get_theme_name() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound

		$theme_name = __( 'Astra', 'astra-addon' );

		return apply_filters( 'astra_theme_name', $theme_name ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}
endif;
