<?php
/**
 * Menu Styling Loader for Astra Addon.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Initialization
 *
 * @since 3.3.0
 */
class Astra_Addon_Header_Menu_Component_Loader {

	/**
	 * Constructor
	 *
	 * @since 3.3.0
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
	 * @since 3.3.0
	 */
	public function theme_defaults( $defaults ) {

		// Menu - Box Shadow defaults.
		$component_limit = astra_addon_builder_helper()->component_limit;

		for ( $index = 1; $index <= $component_limit; $index++ ) {

			$_prefix = 'menu' . $index;

			$defaults[ 'header-' . $_prefix . '-box-shadow-control' ]  = array(
				'x'      => '0',
				'y'      => '4',
				'blur'   => '10',
				'spread' => '-2',
			);
			$defaults[ 'header-' . $_prefix . '-box-shadow-color' ]    = 'rgba(0,0,0,0.1)';
			$defaults[ 'header-' . $_prefix . '-box-shadow-position' ] = 'outline';
		}

		return $defaults;
	}

	/**
	 * Customizer Preview
	 *
	 * @since 3.3.0
	 */
	public function preview_scripts() {
		/**
		 * Load unminified if SCRIPT_DEBUG is true.
		 */
		$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_script( 'astra-ext-header-menu-customizer-preview-js', ASTRA_ADDON_HEADER_MENU_URI . '/assets/js/' . $dir_name . '/customizer-preview' . $file_prefix . '.js', array( 'customize-preview', 'astra-addon-customizer-preview-js' ), ASTRA_EXT_VER, true );

		// Localize variables for menu JS.
		wp_localize_script(
			'astra-ext-header-menu-customizer-preview-js',
			'AstraAddonMenuData',
			array(
				'component_limit' => astra_addon_builder_helper()->component_limit,
			)
		);
	}
}

/**
*  Kicking this off by creating the object of the class.
*/
new Astra_Addon_Header_Menu_Component_Loader();
