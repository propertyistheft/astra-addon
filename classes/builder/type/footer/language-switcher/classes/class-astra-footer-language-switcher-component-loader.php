<?php
/**
 * Language Switcher Styling Loader for Astra theme.
 *
 * @package     Astra Builder
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Initialization
 *
 * @since 3.1.0
 */
// @codingStandardsIgnoreStart
class Astra_Footer_Language_Switcher_Component_Loader {
	// @codingStandardsIgnoreEnd

	/**
	 * Constructor
	 *
	 * @since 3.1.0
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
	 * @since 3.1.0
	 */
	public function theme_defaults( $defaults ) {
		// Language Switcher footer defaults.
		$defaults['footer-language-switcher-type']             = 'custom';
		$defaults['footer-language-switcher-layout']           = 'vertical';
		$defaults['footer-language-switcher-show-flag']        = true;
		$defaults['footer-language-switcher-show-name']        = true;
		$defaults['footer-language-switcher-show-tname']       = false;
		$defaults['footer-language-switcher-show-code']        = false;
		$defaults['section-fb-language-switcher-flag-spacing'] = array(
			'desktop' => '5',
			'tablet'  => '',
			'mobile'  => '',
		);
		$defaults['section-fb-language-switcher-flag-size']    = array(
			'desktop' => '20',
			'tablet'  => '',
			'mobile'  => '',
		);
		$defaults['footer-language-switcher-options']          = array(
			'items' => array(
				array(
					'id'      => 'gb',
					'enabled' => true,
					'url'     => '',
					'label'   => __( 'English', 'astra-addon' ),
				),
			),
		);
		$defaults['footer-language-switcher-alignment']        = array(
			'desktop' => 'flex-start',
			'tablet'  => 'flex-start',
			'mobile'  => 'flex-start',
		);
		$defaults['section-fb-language-switcher-margin']       = astra_addon_builder_helper()->default_responsive_spacing;

		return $defaults;
	}

	/**
	 * Customizer Preview
	 *
	 * @since 3.1.0
	 */
	public function preview_scripts() {
		/**
		 * Load unminified if SCRIPT_DEBUG is true.
		 */
		wp_enqueue_script( 'astra-footer-language-switcher-customizer-preview-js', ASTRA_ADDON_FOOTER_LANGUAGE_SWITCHER_URI . '/assets/js/customizer-preview.js', array( 'customize-preview', 'ahfb-addon-base-customizer-preview' ), ASTRA_EXT_VER, true );
	}
}

/**
 *  Kicking this off by creating the object of the class.
 */
new Astra_Footer_Language_Switcher_Component_Loader();
