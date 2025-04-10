<?php
/**
 * Account Styling Loader for Astra theme.
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
class Astra_Ext_Header_Account_Component_Loader {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	// @codingStandardsIgnoreEnd

	/**
	 * Constructor
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
	}

	/**
	 * Default customizer configs.
	 *
	 * @param  array $defaults  Astra options default value array.
	 *
	 * @since 3.0.0
	 */
	public function theme_defaults( $defaults ) {
		// Account header defaults.
		$defaults['header-account-icon-type']              = 'account-1';
		$defaults['header-account-action-menu-display-on'] = 'hover';

		return $defaults;
	}

}

/**
 *  Kicking this off by creating the object of the class.
 */
new Astra_Ext_Header_Account_Component_Loader();
