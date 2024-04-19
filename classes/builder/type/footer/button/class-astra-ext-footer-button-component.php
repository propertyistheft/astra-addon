<?php
/**
 * Footer Button component.
 *
 * @package     Astra Builder
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ASTRA_ADDON_EXT_FOOTER_BUTTON_DIR', ASTRA_EXT_DIR . 'classes/builder/type/footer/button/' );
define( 'ASTRA_ADDON_EXT_FOOTER_BUTTON_URI', ASTRA_EXT_URI . 'classes/builder/type/footer/button/' );

/**
 * Button Initial Setup
 *
 * @since 3.1.0
 */
// @codingStandardsIgnoreStart
class Astra_Ext_Footer_Button_Component {
	// @codingStandardsIgnoreEnd

	/**
	 * Constructor function that initializes required actions and hooks
	 */
	public function __construct() {

		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once ASTRA_ADDON_EXT_FOOTER_BUTTON_DIR . 'classes/class-astra-ext-footer-button-component-loader.php';
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

		// Include front end files.
		if ( ! is_admin() ) {
			require_once ASTRA_ADDON_EXT_FOOTER_BUTTON_DIR . 'dynamic-css/dynamic.css.php';
		}
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}

/**
 *  Kicking this off by creating an object.
 */
new Astra_Ext_Footer_Button_Component();

