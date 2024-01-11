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
 * Page Header's color options compatibility with new Header builder layout.
 *
 * @since 3.5.0
 * @return void
 */
function astra_addon_page_headers_support_to_builder_layout() {

	$theme_options = get_option( 'astra-settings' );

	if ( ! isset( $theme_options['can-update-page-header-compatibility-to-header-builder'] ) ) {
		// Set a flag to avoid direct changes on frontend.
		$theme_options['can-update-page-header-compatibility-to-header-builder'] = true;
	}

	update_option( 'astra-settings', $theme_options );
}

/**
 * Do not apply new font-weight heading support CSS in editor/frontend directly.
 *
 * 1. Adding Font-weight support to widget titles.
 * 2. Customizer font CSS not supporting in editor.
 *
 * @since 3.5.1
 *
 * @return void
 */
function astra_addon_headings_font_support() {
	$theme_options = get_option( 'astra-settings', array() );

	if ( ! isset( $theme_options['can-support-widget-and-editor-fonts'] ) ) {
		$theme_options['can-support-widget-and-editor-fonts'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Cart color not working in old header > cart widget. As this change can reflect on frontend directly, adding this backward compatibility.
 *
 * @since 3.5.1
 * @return void
 */
function astra_addon_cart_color_not_working_in_old_header() {

	$theme_options = get_option( 'astra-settings' );

	if ( ! isset( $theme_options['can-reflect-cart-color-in-old-header'] ) ) {
		// Set a flag to avoid direct changes on frontend.
		$theme_options['can-reflect-cart-color-in-old-header'] = false;
	}

	update_option( 'astra-settings', $theme_options );
}

/**
 * Till now "Header Sections" addon has dependency conflict with new header builder, unless & until this addon activate dynamic CSS does load for new header layouts.
 * As we deprecate "Header Sections" for new header builder layout, conflict appears here.
 *
 * Adding backward compatibility as changes can directly reflect on frontend.
 *
 * @since 3.5.7
 * @return void
 */
function astra_addon_remove_header_sections_deps_new_builder() {

	$theme_options = get_option( 'astra-settings' );

	if ( ! isset( $theme_options['remove-header-sections-deps-in-new-header'] ) ) {
		// Set a flag to avoid direct changes on frontend.
		$theme_options['remove-header-sections-deps-in-new-header'] = false;
	}

	update_option( 'astra-settings', $theme_options );
}

/**
 * In old header for Cart widget we have background: #ffffff; for outline cart, whereas this CSS missed in new HFB > Cart element. Adding it now as per support requests. This case is only for new header builder > WooCommerce cart.
 *
 * @since 3.5.7
 * @return void
 */
function astra_addon_outline_cart_bg_color_support() {
	$theme_options = get_option( 'astra-settings', array() );

	if ( ! isset( $theme_options['add-outline-cart-bg-new-header'] ) ) {
		$theme_options['add-outline-cart-bg-new-header'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Swap section on Mobile Device not working in old header. As this change can reflect on frontend directly, adding this backward compatibility.
 *
 * @since 3.5.7
 * @return void
 */
function astra_addon_swap_section_not_working_in_old_header() {

	$theme_options = get_option( 'astra-settings', array() );

	if ( ! isset( $theme_options['support-swap-mobile-header-sections'] ) ) {
		$theme_options['support-swap-mobile-header-sections'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Do not apply default header site title and tag line color to sticky header for existing users.
 *
 * @since 3.5.8
 *
 * @return void
 */
function astra_sticky_header_site_title_tagline_css() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	$theme_options = get_option( 'astra-settings', array() );

	if ( ! isset( $theme_options['sticky-header-default-site-title-tagline-css'] ) ) {
		$theme_options['sticky-header-default-site-title-tagline-css'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Migrating Builder > Account > resonsive menu color options to single color options.
 * Because we do not show menu on resonsive devices, whereas we trigger login link on responsive devices instead of showing menu.
 *
 * @since 3.5.9
 *
 * @return void
 */
function astra_addon_remove_responsive_account_menu_colors_support() {

	$theme_options = get_option( 'astra-settings', array() );

	$account_menu_colors = array(
		'header-account-menu-color',                // Menu color.
		'header-account-menu-h-color',              // Menu hover color.
		'header-account-menu-a-color',              // Menu active color.
		'header-account-menu-bg-obj',               // Menu background color.
		'header-account-menu-h-bg-color',           // Menu background hover color.
		'header-account-menu-a-bg-color',           // Menu background active color.
		'sticky-header-account-menu-color',         // Sticky menu color.
		'sticky-header-account-menu-h-color',       // Sticky menu hover color.
		'sticky-header-account-menu-a-color',       // Sticky menu active color.
		'sticky-header-account-menu-bg-obj',        // Sticky menu background color.
		'sticky-header-account-menu-h-bg-color',    // Sticky menu background hover color.
		'sticky-header-account-menu-a-bg-color',    // Sticky menu background active color.
	);

	foreach ( $account_menu_colors as $color_option ) {
		if ( ! isset( $theme_options[ $color_option ] ) && isset( $theme_options[ $color_option . '-responsive' ]['desktop'] ) ) {
			$theme_options[ $color_option ] = $theme_options[ $color_option . '-responsive' ]['desktop'];
		}
	}

	update_option( 'astra-settings', $theme_options );
}


/**
 * Check if old user and keep the existing product gallery layouts.
 *
 * @since 3.9.0
 * @return void
 */
function astra_addon_update_product_gallery_layout() {

	$theme_options = get_option( 'astra-settings' );

	if ( ! isset( $theme_options['astra-product-gallery-layout-flag'] ) ) {
		$theme_options['astra-product-gallery-layout-flag'] = false;
	}

	update_option( 'astra-settings', $theme_options );
}

/**
 * Migrate old user data to new responsive format for shop's cart button padding.
 *
 * @since 3.9.0
 * @return void
 */
function astra_addon_responsive_shop_button_padding() {
	$theme_options             = get_option( 'astra-settings', array() );
	$vertical_button_padding   = isset( $theme_options['shop-button-v-padding'] ) ? $theme_options['shop-button-v-padding'] : '';
	$horizontal_button_padding = isset( $theme_options['shop-button-h-padding'] ) ? $theme_options['shop-button-h-padding'] : '';
	if ( ! isset( $theme_options['shop-button-padding'] ) ) {
		$theme_options['shop-button-padding'] = array(
			'desktop'      => array(
				'top'    => $vertical_button_padding,
				'right'  => $horizontal_button_padding,
				'bottom' => $vertical_button_padding,
				'left'   => $horizontal_button_padding,
			),
			'tablet'       => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'mobile'       => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'desktop-unit' => 'px',
			'tablet-unit'  => 'px',
			'mobile-unit'  => 'px',
		);
		update_option( 'astra-settings', $theme_options );
	}
}


/**
 * Migrate old box shadow user data to new simplyfy box-shadow controls shop items shadow.
 *
 * @since 3.9.0
 * @return void
 */
function astra_addon_shop_box_shadow_migration() {
	// For shop products box-shadow.
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['shop-item-box-shadow-control'] ) && isset( $theme_options['shop-product-shadow'] ) ) {

		$normal_shadow_x      = '';
		$normal_shadow_y      = '';
		$normal_shadow_blur   = '';
		$normal_shadow_spread = '';
		$normal_shadow_color  = 'rgba(0,0,0,.1)';

		switch ( $theme_options['shop-product-shadow'] ) {
			case 1:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '1';
				$normal_shadow_blur   = '3';
				$normal_shadow_spread = '-2';
				break;

			case 2:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '3';
				$normal_shadow_blur   = '6';
				$normal_shadow_spread = '-5';
				break;

			case 3:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '10';
				$normal_shadow_blur   = '20';
				$normal_shadow_spread = '';
				break;

			case 4:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '14';
				$normal_shadow_blur   = '28';
				$normal_shadow_spread = '';
				break;

			case 5:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '20';
				$normal_shadow_blur   = '30';
				$normal_shadow_spread = '0';
				break;

			default:
				break;
		}

		$theme_options['shop-item-box-shadow-control']  = array(
			'x'      => $normal_shadow_x,
			'y'      => $normal_shadow_y,
			'blur'   => $normal_shadow_blur,
			'spread' => $normal_shadow_spread,
		);
		$theme_options['shop-item-box-shadow-position'] = 'outline';
		$theme_options['shop-item-box-shadow-color']    = $normal_shadow_color;

		update_option( 'astra-settings', $theme_options );
	}

	// For shop products hover box-shadow.
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['shop-item-hover-box-shadow-control'] ) && isset( $theme_options['shop-product-shadow-hover'] ) ) {

		$normal_shadow_x      = '';
		$normal_shadow_y      = '';
		$normal_shadow_blur   = '';
		$normal_shadow_spread = '';
		$normal_shadow_color  = 'rgba(0,0,0,.1)';

		switch ( $theme_options['shop-product-shadow-hover'] ) {
			case 1:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '1';
				$normal_shadow_blur   = '3';
				$normal_shadow_spread = '-2';
				break;

			case 2:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '3';
				$normal_shadow_blur   = '6';
				$normal_shadow_spread = '-5';
				break;

			case 3:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '10';
				$normal_shadow_blur   = '20';
				$normal_shadow_spread = '';
				break;

			case 4:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '14';
				$normal_shadow_blur   = '28';
				$normal_shadow_spread = '';
				break;

			case 5:
				$normal_shadow_x      = '0';
				$normal_shadow_y      = '20';
				$normal_shadow_blur   = '30';
				$normal_shadow_spread = '0';
				break;

			default:
				break;
		}

		$theme_options['shop-item-hover-box-shadow-control']  = array(
			'x'      => $normal_shadow_x,
			'y'      => $normal_shadow_y,
			'blur'   => $normal_shadow_blur,
			'spread' => $normal_shadow_spread,
		);
		$theme_options['shop-item-hover-box-shadow-position'] = 'outline';
		$theme_options['shop-item-hover-box-shadow-color']    = $normal_shadow_color;

		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * If old user then it keeps then default cart icon.
 *
 * @since 3.9.0
 * @return void
 */
function astra_addon_update_woocommerce_cart_icons() {

	$theme_options = get_option( 'astra-settings' );

	if ( ! isset( $theme_options['astra-woocommerce-cart-icons-flag'] ) ) {
		$theme_options['astra-woocommerce-cart-icons-flag'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * If old user then it keeps then default cart icon.
 *
 * @since 3.9.0
 * @return void
 */
function astra_addon_update_toolbar_seperations() {
	$theme_options = get_option( 'astra-settings' );

	$shop_toolbar_display = isset( $theme_options['shop-toolbar-display'] ) ? $theme_options['shop-toolbar-display'] : true;

	if ( ! isset( $theme_options['shop-toolbar-structure'] ) ) {
		if ( true === $shop_toolbar_display ) {
			if (
				isset( $theme_options['shop-off-canvas-trigger-type'] ) &&
				'disable' !== $theme_options['shop-off-canvas-trigger-type'] &&
				'custom-class' !== $theme_options['shop-off-canvas-trigger-type']
			) {
				$theme_options['shop-toolbar-structure']                = array(
					'filters',
					'results',
					'sorting',
				);
				$theme_options['shop-toolbar-structure-with-hiddenset'] = array(
					'filters'   => true,
					'results'   => true,
					'sorting'   => true,
					'easy_view' => false,
				);
			} else {
				$theme_options['shop-toolbar-structure']                = array(
					'results',
					'sorting',
				);
				$theme_options['shop-toolbar-structure-with-hiddenset'] = array(
					'results'   => true,
					'filters'   => false,
					'sorting'   => true,
					'easy_view' => false,
				);
			}
		} else {
			if (
				isset( $theme_options['shop-off-canvas-trigger-type'] ) &&
				'disable' !== $theme_options['shop-off-canvas-trigger-type'] &&
				'custom-class' !== $theme_options['shop-off-canvas-trigger-type']
			) {
				$theme_options['shop-toolbar-structure']                = array(
					'filters',
				);
				$theme_options['shop-toolbar-structure-with-hiddenset'] = array(
					'filters'   => true,
					'results'   => false,
					'sorting'   => false,
					'easy_view' => false,
				);
			} else {
				$theme_options['shop-toolbar-structure']                = array();
				$theme_options['shop-toolbar-structure-with-hiddenset'] = array(
					'results'   => false,
					'filters'   => false,
					'sorting'   => false,
					'easy_view' => false,
				);
			}
		}

		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Restrict direct changes on users end so make it filterable.
 *
 * @since 3.9.0
 * @return void
 */
function astra_addon_apply_modern_ecommerce_setup() {
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['modern-ecommerce-setup'] ) ) {
		$theme_options['modern-ecommerce-setup'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

/**
 * Improve active/selected variant for WooCommerce single product.
 *
 * @since 3.9.3
 * @return void
 */
function astra_addon_update_variant_active_state() {
	$theme_options = get_option( 'astra-settings', array() );
	if ( ! isset( $theme_options['can-update-variant-active-style'] ) ) {
		$theme_options['can-update-variant-active-style'] = false;
		update_option( 'astra-settings', $theme_options );
	}
}

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
