<?php
/**
 * Functions for Astra - Easy Digital Downloads Addon.
 *
 * @package Astra
 * @since   Astra 1.6.10
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Current Page is EDD page
 */
if ( ! function_exists( 'astra_is_edd_page' ) ) {

	/**
	 * Check current page is an EDD page
	 *
	 * @since 1.6.10
	 * @return bool true | false
	 */
	function astra_is_edd_page() {
		if (
			is_singular( 'download' ) ||
			is_post_type_archive( 'download' ) ||
			is_tax( 'download_category' ) ||
			is_tax( 'download_tag' ) ||
			edd_is_checkout() ||
			edd_is_success_page() ||
			edd_is_failed_transaction_page() ||
			edd_is_purchase_history_page()
		) {
			return true;
		}
		return false;
	}
}

/**
 * Current Page is EDD single page
 */
if ( ! function_exists( 'astra_is_edd_single_page' ) ) {

	/**
	 * Check current page is an EDD single page
	 *
	 * @since 1.6.10
	 * @return bool true | false
	 */
	function astra_is_edd_single_page() {
		if (
			is_singular( 'download' ) ||
			edd_is_checkout() ||
			edd_is_success_page() ||
			edd_is_failed_transaction_page() ||
			edd_is_purchase_history_page()
		) {
			return true;
		}
		return false;
	}
}

/**
 * Current Page is EDD archive page
 */
if ( ! function_exists( 'astra_is_edd_archive_page' ) ) {

	/**
	 * Check current page is an EDD archive page
	 *
	 * @since 1.6.10
	 * @return bool true | false
	 */
	function astra_is_edd_archive_page() {
		if (
			is_post_type_archive( 'download' ) ||
			is_tax( 'download_category' ) ||
			is_tax( 'download_tag' )
		) {
			return true;
		}
		return false;
	}
}

/**
 * Current Page is EDD single Product page
 */
if ( ! function_exists( 'astra_is_edd_single_product_page' ) ) {

	/**
	 * Check current page is an EDD single product page
	 *
	 * @since 1.6.10
	 * @return bool true | false
	 */
	function astra_is_edd_single_product_page() {
		if ( is_singular( 'download' ) ) {
			return true;
		}
		return false;
	}
}
