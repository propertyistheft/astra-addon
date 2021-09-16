<?php
/**
 * Deprecated Actions of Astra Addon.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2021, Astra
 * @link        https://wpastra.com/
 * @since       Astra 3.5.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'astra_do_action_deprecated' ) ) {

	/**
	 * Depreciating Astra AJAX pgination actions.
	 *
	 * @since 3.5.7
	 */
	astra_do_action_deprecated( 'astra_shop_pagination_infinite', array(), '3.5.7' );
	astra_do_action_deprecated( 'astra_pagination_infinite', array(), '3.5.7' );
}
