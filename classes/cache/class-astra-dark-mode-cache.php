<?php
/**
 * Astra Dark Mode Cache
 *
 * @package Astra Addon
 * @since 4.11.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Astra_Dark_Mode_Cache
 *
 * @since 4.11.2
 */
class Astra_Dark_Mode_Cache {

	/**
	 * Constructor
	 *
	 * @since 4.11.2
	 */
	public function __construct() {
		add_filter( 'astra_dynamic_theme_css', array( $this, 'force_dark_palette_css_on_cache' ), 99 );
	}

	/**
	 * Force generation of dark-palette CSS when assets are written to files.
	 *
	 * Astra's dark mode styles are normally added only when the dark palette is
	 * active. When dynamic CSS is cached to static files, these rules might be
	 * missing if the palette wasn't enabled at build time. This filter ensures the
	 * rules are created regardless, so they are available whenever dark mode is
	 * toggled later.
	 *
	 * @param string $css Dynamic CSS accumulated from previous filters.
	 * @return string Modified CSS including dark-palette rules when needed.
	 * @since 4.11.2
	 */
	public function force_dark_palette_css_on_cache( $css ) {
		// Check if dynamic CSS is being generated as a file instead of inline.
		if ( class_exists( 'Astra_Cache_Base' ) && ! Astra_Cache_Base::inline_assets() ) {
			$css = astra_dark_palette_css( $css, true );
		}
		return $css;
	}
}

new Astra_Dark_Mode_Cache();
