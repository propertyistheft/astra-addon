<?php
/**
 * Social Styling Loader for Astra theme.
 *
 * @package     Astra Builder
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Initialization
 *
 * @since 3.0.0
 */
class Astra_Header_Social_Component_Loader {

	/**
	 * Constructor
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
		add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 110 );
	}

	/**
	 * Default customizer configs.
	 *
	 * @param  array $defaults  Astra options default value array.
	 *
	 * @since 3.0.0
	 */
	public function theme_defaults( $defaults ) {

		$num_of_header_social_icons = astra_addon_builder_helper()->num_of_header_social_icons;

		// Divider header defaults.
		for ( $index = 1; $index <= $num_of_header_social_icons; $index++ ) {

			$defaults[ 'header-social-' . $index . '-stack' ] = 'none';
		}

		return $defaults;
	}

	/**
	 * Customizer Preview
	 *
	 * @since 3.0.0
	 */
	public function preview_scripts() {
		/**
		 * Load unminified if SCRIPT_DEBUG is true.
		 */
		/* Directory and Extension */
		$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_script( 'astra-social-icon-addon-header-customizer-preview-js', ASTRA_HEADER_SOCIAL_URI . '/assets/js/customizer-preview.js', array( 'customize-preview', 'ahfb-addon-base-customizer-preview' ), ASTRA_EXT_VER, true );

		// Localize variables for divider JS.
		wp_localize_script(
			'astra-social-icon-addon-header-customizer-preview-js',
			'AstraBuilderSocialData',
			array(
				'header_social_count' => astra_addon_builder_helper()->num_of_header_social_icons,
			)
		);
	}
}

/**
*  Kicking this off by creating the object of the class.
*/
new Astra_Header_Social_Component_Loader();
