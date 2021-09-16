<?php
/**
 * HTML component.
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

define( 'ASTRA_EXT_HEADER_ACCOUNT_DIR', ASTRA_EXT_DIR . 'classes/builder/type/header/account/' );
define( 'ASTRA_EXT_HEADER_ACCOUNT_URI', ASTRA_EXT_URI . 'classes/builder/type/header/account/' );

/**
 * Heading Initial Setup
 *
 * @since 3.0.0
 */
class Astra_Ext_Header_Account_Component {

	/**
	 * Constructor function that initializes required actions and hooks
	 */
	public function __construct() {

		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once ASTRA_EXT_HEADER_ACCOUNT_DIR . 'classes/class-astra-ext-header-account-component-loader.php';
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}

/**
 *  Kicking this off by creating an object.
 */
new Astra_Ext_Header_Account_Component();

