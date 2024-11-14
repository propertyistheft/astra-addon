<?php
/**
 * HTML component.
 *
 * @package     Astra Builder
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ASTRA_ADDON_EXT_HEADER_ACCOUNT_DIR', ASTRA_EXT_DIR . 'classes/builder/type/header/account/' );

/**
 * Heading Initial Setup
 *
 * @since 3.0.0
 */
// @codingStandardsIgnoreStart
class Astra_Ext_Header_Account_Component {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	// @codingStandardsIgnoreEnd

	/**
	 * Constructor function that initializes required actions and hooks
	 */
	public function __construct() {

		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once ASTRA_ADDON_EXT_HEADER_ACCOUNT_DIR . 'classes/class-astra-ext-header-account-component-loader.php';
		require_once ASTRA_ADDON_EXT_HEADER_ACCOUNT_DIR . 'classes/class-astra-addon-header-account-markup.php';
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		
		// Include front end files.
		if ( ! is_admin() ) {
			require_once ASTRA_ADDON_EXT_HEADER_ACCOUNT_DIR . '/dynamic-css/dynamic.css.php';
		}
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}

/**
 *  Kicking this off by creating an object.
 */
new Astra_Ext_Header_Account_Component();

