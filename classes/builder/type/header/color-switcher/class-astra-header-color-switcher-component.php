<?php
/**
 * Color Switcher component.
 *
 * @package     Astra Builder
 * @link        https://www.brainstormforce.com
 * @since       Astra 4.10.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ASTRA_ADDON_HEADER_COLOR_SWITCHER_DIR', ASTRA_EXT_DIR . 'classes/builder/type/header/color-switcher/' );
define( 'ASTRA_ADDON_HEADER_COLOR_SWITCHER_URI', ASTRA_EXT_URI . 'classes/builder/type/header/color-switcher/' );

/**
 * Color Switcher class.
 *
 * @since 4.10.0
 */
class Astra_Header_Color_Switcher_Component {

	/**
	 * Constructor function that initializes required actions and hooks
	 */
	public function __construct() {
		require_once ASTRA_ADDON_HEADER_COLOR_SWITCHER_DIR . 'classes/class-astra-header-color-switcher-component-loader.php';

		// Include front end files.
		if ( ! is_admin() ) {
			require_once ASTRA_ADDON_HEADER_COLOR_SWITCHER_DIR . 'dynamic-css/dynamic.css.php';
		}
	}
}

/**
 *  Kicking this off by creating an object.
 */
new Astra_Header_Color_Switcher_Component();
