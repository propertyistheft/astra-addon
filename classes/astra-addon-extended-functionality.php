<?php
/**
 * Astra Addon BSF & WP-Com package extended functionality.
 *
 * In this file as per WooCommerce.com standards we manipulated following things -
 * 1. Deprecation of Code editor due to usage of
 *      i) eval()
 *      ii) echo $php_snippet;
 * 2. Removed modern checkout layout's easy login due to $_POST['password'] sanitization case.
 *
 * @package Astra Addon
 * @since 4.1.1
 */

/**
 * Check if code editor custom layout enabled.
 *
 * @param  int $post_id Post Id.
 * @return boolean
 * @since 4.1.5
 */
function astra_addon_is_code_editor_layout( $post_id ) {
	$php_enabled = get_post_meta( $post_id, 'editor_type', true );
	if ( 'code_editor' === $php_enabled ) {
		return true;
	}
	return false;
}

/**
 * Get PHP snippet if enabled.
 *
 * @param  int $post_id Post Id.
 * @return boolean|html
 * @since 4.1.1
 */
function astra_addon_get_php_snippet( $post_id ) {
	if ( ! astra_addon_is_code_editor_layout( $post_id ) ) {
		return false;
	}
	$code = get_post_meta( $post_id, 'ast-advanced-hook-php-code', true );
	if ( defined( 'ASTRA_ADVANCED_HOOKS_DISABLE_PHP' ) ) {
		return $code;
	}
	ob_start();
	// @codingStandardsIgnoreStart
	eval( '?>' . $code . '<?php ' ); // phpcs:ignore Squiz.PHP.Eval.Discouraged -- Ignored PHP standards to execute PHP code snipett.
	// @codingStandardsIgnoreEnd
	return ob_get_clean();
}

/**
 * Echo PHP snippet if enabled.
 *
 * @param  int $post_id Post Id.
 * @since 4.1.1
 */
function astra_addon_echo_php_snippet( $post_id ) {
	if ( astra_addon_is_code_editor_layout( $post_id ) ) {
		$php_snippet = astra_addon_get_php_snippet( $post_id );
		echo $php_snippet; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Check email exist.
 *
 * @since 3.9.0
 */
function astra_addon_woocommerce_login_user() {

	check_ajax_referer( 'woocommerce-login', 'security' );

	$response = array(
		'success' => false,
	);

	$user_name_email          = isset( $_POST['user_name_email'] ) ? sanitize_text_field( wp_unslash( $_POST['user_name_email'] ) ) : false;
	$password                 = isset( $_POST['password'] ) ? wp_unslash( $_POST['password'] ) : false; // phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$selected_user_name_email = '';

	if ( filter_var( $user_name_email, FILTER_VALIDATE_EMAIL ) ) {
		$selected_user_name_email = sanitize_email( $user_name_email );
	} else {
		$selected_user_name_email = $user_name_email;
	}

	$creds = array(
		'user_login'    => $selected_user_name_email,
		'user_password' => $password,
		'remember'      => false,
	);

	$user = wp_signon( $creds, false );

	if ( ! is_wp_error( $user ) ) {

		$response = array(
			'success' => true,
		);
	} else {
		$response['error'] = wp_kses_post( $user->get_error_message() );
	}

	wp_send_json_success( $response );
}

// Login user on modern checkout layout.
add_action( 'wp_ajax_astra_woocommerce_login_user', 'astra_addon_woocommerce_login_user' );
add_action( 'wp_ajax_nopriv_astra_woocommerce_login_user', 'astra_addon_woocommerce_login_user' );
