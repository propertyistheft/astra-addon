<?php
/**
 * Off Canvas component.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ASTRA_ADDON_OFFCANVAS_DIR', ASTRA_EXT_DIR . 'classes/builder/type/header/off-canvas/' );
define( 'ASTRA_ADDON_OFFCANVAS_URI', ASTRA_EXT_URI . 'classes/builder/type/header/off-canvas/' );

/**
 * Heading Initial Setup
 *
 * @since 3.3.0
 */
class Astra_Addon_Offcanvas_Component {

	/**
	 * Constructor function that initializes required actions and hooks
	 */
	public function __construct() {

		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once ASTRA_ADDON_OFFCANVAS_DIR . 'classes/class-astra-addon-offcanvas-component-loader.php';

		// Include front end files.
		if ( ! is_admin() ) {
			require_once ASTRA_ADDON_OFFCANVAS_DIR . 'dynamic-css/dynamic.css.php';
		}
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}

/**
 *  Kicking this off by creating an object.
 */
new Astra_Addon_Offcanvas_Component();
