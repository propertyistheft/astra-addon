<?php
/**
 * Menu Element.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ASTRA_ADDON_HEADER_MENU_DIR', ASTRA_EXT_DIR . 'classes/builder/type/header/menu/' );
define( 'ASTRA_ADDON_HEADER_MENU_URI', ASTRA_EXT_URI . 'classes/builder/type/header/menu/' );

/**
 * Menu Initial Setup
 *
 * @since 3.3.0
 */
class Astra_Addon_Header_Menu_Component {

	/**
	 * Constructor function that initializes required actions and hooks
	 */
	public function __construct() {

		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once ASTRA_ADDON_HEADER_MENU_DIR . 'classes/class-astra-addon-header-menu-component-loader.php';

		// Include front end files.
		if ( ! is_admin() ) {
			require_once ASTRA_ADDON_HEADER_MENU_DIR . 'dynamic-css/dynamic.css.php';
		}
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}

/**
 *  Kicking this off by creating an object.
 */
new Astra_Addon_Header_Menu_Component();

