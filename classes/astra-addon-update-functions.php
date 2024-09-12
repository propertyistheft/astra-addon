<?php
/**
 * Astra Addon Updates
 *
 * Functions for updating data, used by the background updater.
 *
 * @package Astra Addon
 * @version 2.1.3
 */

defined( 'ABSPATH' ) || exit;

/**
 * Version 4.0.0 backward handle.
 *
 * 1. Migrating Post Structure & Meta options in title area meta parts.
 * 2. Migrate existing setting & do required onboarding for new admin dashboard v4.0.0 app.
 *
 * @since 4.0.0
 * @return void
 */
function astra_addon_background_updater_4_0_0() {
	// Dynamic customizer migration setup starts here.
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['addon-dynamic-customizer-support'] ) ) {
		$theme_options['addon-dynamic-customizer-support'] = true;
		update_option( 'astra-settings', $theme_options );
	}

	// Admin dashboard migration starts here.
	$admin_dashboard_settings = get_option( 'astra_admin_settings', array() );
	if ( ! isset( $admin_dashboard_settings['addon-setup-admin-migrated'] ) ) {

		// Insert fallback whitelabel icon for agency users to maintain their branding.
		if ( is_multisite() ) {
			$branding = get_site_option( '_astra_ext_white_label' );
		} else {
			$branding = get_option( '_astra_ext_white_label' );
		}
		if ( ( isset( $branding['astra-agency']['hide_branding'] ) && true === (bool) $branding['astra-agency']['hide_branding'] ) && ! isset( $branding['astra']['icon'] ) ) {

			$branding['astra']['icon'] = ASTRA_EXT_URI . 'admin/core/assets/images/whitelabel-branding.svg';

			if ( is_multisite() ) {
				update_site_option( '_astra_ext_white_label', $branding );
			} else {
				update_option( '_astra_ext_white_label', $branding );
			}
		}

		// Consider admin part from addon side migrated.
		$admin_dashboard_settings['addon-setup-admin-migrated'] = true;
		update_option( 'astra_admin_settings', $admin_dashboard_settings );
	}
}

/**
 * Backward handle for 4.1.0
 *
 * @since 4.1.0
 * @return void
 */
function astra_addon_background_updater_4_1_0() {
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['single-product-add-to-cart-action'] ) && isset( $theme_options['single-product-ajax-add-to-cart'] ) ) {
		$theme_options['single-product-add-to-cart-action'] = 'rt_add_to_cart';
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Improve sale badge background color option for WooCommerce catalog design 2.
 *
 * @since 4.1.6
 * @return void
 */
function astra_addon_background_updater_4_1_6() {
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['apply-modern-layout-sale-badge-styles'] ) ) {
		$theme_options['apply-modern-layout-sale-badge-styles'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Improve full screen search Submit button style.
 *
 * @since 4.6.0
 * @return void
 */
function astra_addon_background_updater_4_4_0() {
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['v4-4-0-backward-option'] ) ) {
		$theme_options['v4-4-0-backward-option'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Update default spacing for primary menu in old hf builder.
 *
 * @since 4.6.0
 * @return void
 */
function astra_addon_background_updater_4_6_0() {
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['update-default-spacing-for-header'] ) ) {
		$theme_options['update-default-spacing-for-header'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Restrict banner layout-2 if page header is active.
 *
 * @since 4.6.1
 * @return void
 */
function astra_addon_background_updater_4_6_1() {
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['restrict-banner-layout-with-page-header'] ) ) {
		$theme_options['restrict-banner-layout-with-page-header'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Backward compatibility for version 4.6.8
 *
 * @since 4.6.8
 * @return void
 */
function astra_addon_background_updater_4_6_8() {
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['site-builder-templates-headings-space'] ) ) {
		$theme_options['site-builder-templates-headings-space'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Backward compatibility for version 4.7.0
 *
 * @since 4.7.0
 * @return void
 */
function astra_addon_background_updater_4_7_0() {

	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['hiding_social_share_icon_position'] ) ) {
		$theme_options['hiding_social_share_icon_position'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}
