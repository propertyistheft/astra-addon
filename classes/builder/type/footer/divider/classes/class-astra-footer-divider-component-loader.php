<?php
/**
 * Divider Styling Loader for Astra theme.
 *
 * @package     Astra Builder
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
// @codingStandardsIgnoreStart
class Astra_Footer_Divider_Component_Loader {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	// @codingStandardsIgnoreEnd

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
		// Divider Footer defaults.
		$num_of_footer_divider = astra_addon_builder_helper()->num_of_footer_divider;
		for ( $index = 1; $index <= $num_of_footer_divider; $index++ ) {

			$defaults[ 'footer-divider-' . $index . '-layout' ] = 'horizontal';
			$defaults[ 'footer-divider-' . $index . '-style' ]  = 'solid';
			$defaults[ 'footer-divider-' . $index . '-color' ]  = '';

			$defaults[ 'footer-divider-' . $index . '-size' ] = array(
				'desktop' => '50',
				'tablet'  => '50',
				'mobile'  => '50',
			);

			$defaults[ 'footer-vertical-divider-' . $index . '-size' ] = array(
				'desktop' => '50',
				'tablet'  => '50',
				'mobile'  => '50',
			);

			$defaults[ 'footer-divider-' . $index . '-thickness' ] = array(
				'desktop' => '1',
				'tablet'  => '1',
				'mobile'  => '1',
			);

			$defaults[ 'footer-divider-' . $index . '-alignment' ] = array(
				'desktop' => 'center',
				'tablet'  => 'center',
				'mobile'  => 'center',
			);
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
		$dir_name    = SCRIPT_DEBUG ? 'unminified' : 'minified';
		$file_prefix = SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script( 'astra-footer-divider-customizer-preview-js', ASTRA_ADDON_FOOTER_DIVIDER_URI . 'assets/js/' . $dir_name . '/customizer-preview' . $file_prefix . '.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );

		// Localize variables for divider JS.
		wp_localize_script(
			'astra-footer-divider-customizer-preview-js',
			'AstraBuilderDividerData',
			array(
				'component_limit'    => astra_addon_builder_helper()->component_limit,
				'tablet_break_point' => astra_addon_get_tablet_breakpoint(),
				'mobile_break_point' => astra_addon_get_mobile_breakpoint(),
			)
		);
	}
}

/**
 *  Kicking this off by creating the object of the class.
 */
new Astra_Footer_Divider_Component_Loader();
