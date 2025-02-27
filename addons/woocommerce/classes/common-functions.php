<?php
/**
 * Functions for Astra Woocommerce Addon.
 *
 * @package Astra
 * @since   Astra 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Woocommerce shop/product div close tag.
 */
if ( ! function_exists( 'astra_woocommerce_div_wrapper_close' ) ) {

	/**
	 * Woocommerce shop/product div close tag.
	 *
	 * @since 1.1.0
	 */
	function astra_woocommerce_div_wrapper_close() {

		echo '</div>';
	}
}

/**
 * Woocommerce shop/product/checkout ul close tag.
 */
if ( ! function_exists( 'astra_woocommerce_ul_close' ) ) {

	/**
	 * Woocommerce shop/product/checkout ul close tag.
	 *
	 * @return void
	 */
	function astra_woocommerce_ul_close() {
		echo '</ul>';
	}
}

/**
 * Woocommerce shop/product/checkout li close tag.
 */
if ( ! function_exists( 'astra_woocommerce_li_close' ) ) {

	/**
	 * Woocommerce shop/product/checkout li close tag.
	 *
	 * @return void
	 */
	function astra_woocommerce_li_close() {
		echo '</li>';
	}
}

/**
 * Two step checkout wrapper
 */
if ( ! function_exists( 'astra_two_step_checkout_form_wrapper_div' ) ) {

	/**
	 * Used to wrap the checkout form in a div and include navigation links
	 *
	 * @return void
	 */
	function astra_two_step_checkout_form_wrapper_div() {
		echo '<div class="ast-checkout-slides">';
		?>
			<ul class="ast-checkout-control-nav">
				<li><a href="#"><?php esc_html_e( 'Billing details', 'astra-addon' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Payments', 'astra-addon' ); ?></a></li>
			</ul>
			<?php
	}
}

/**
 * Two step checkout ul wrapper
 */
if ( ! function_exists( 'astra_two_step_checkout_form_ul_wrapper' ) ) {

	/**
	 * Used to wrap the checkout form in a ul
	 *
	 * @return void
	 */
	function astra_two_step_checkout_form_ul_wrapper() {
		echo '<ul class="ast-two-step-checkout">';
	}
}

/**
 * Two step checkout li wrapper
 */
if ( ! function_exists( 'astra_two_step_checkout_address_li_wrapper' ) ) {

	/**
	 * Used to wrap the address fields on the ckecout in an li
	 *
	 * @return void
	 */
	function astra_two_step_checkout_address_li_wrapper() {
		echo '<li class="ast-checkout-addresses">';
	}
}

/**
 * Two step checkout li wrapper
 */
if ( ! function_exists( 'astra_two_step_checkout_order_review_wrap' ) ) {

	/**
	 * Used to wrap the order review in an li
	 *
	 * @return void
	 */
	function astra_two_step_checkout_order_review_wrap() {
		echo '<li class="order-review">';
		echo '<h3 id="order_review_heading">' . esc_html__( 'Your order', 'astra-addon' ) . '</h3>';
	}
}

/**
 * Remove shop page description
 */
if ( ! function_exists( 'astra_woo_remove_shop_page_description' ) ) {

	/**
	 * Remove desription
	 *
	 * @param string $description  Description.
	 * @param obj    $post_type_obj   Post object.
	 *
	 * @return string
	 */
	function astra_woo_remove_shop_page_description( $description, $post_type_obj ) {

		if ( is_shop() ) {

			$description = '';
		}

		return $description;
	}
}

/**
 * Array of order review toggler text.
 *
 * @param string $text array key to get specific value.
 *
 * @return string
 */
function order_review_toggle_texts( $text = 'show_text' ) {
	$order_summary_show_text = astra_get_i18n_option( 'checkout-show-summary-text', _x( '%astra%', 'WooCommerce Checkout: Show Summary Text', 'astra-addon' ) );
	$order_summary_hide_text = astra_get_i18n_option( 'checkout-hide-summary-text', _x( '%astra%', 'WooCommerce Checkout: Hide Summary Text', 'astra-addon' ) );

	$toggle_texts = apply_filters(
		'astra_addon_order_review_toggle_texts',
		array(
			'show_text' => esc_html( $order_summary_show_text ),
			'hide_text' => esc_html( $order_summary_hide_text ),
		)
	);

	return $toggle_texts[ $text ];
}
