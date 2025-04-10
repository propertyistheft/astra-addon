<?php
/**
 * Supportive class for checking batch based option functions & filters.
 *
 * @package Astra Addon
 * @since 3.5.7
 */

/**
 * Astra_Addon_Update_Filter_Function initial setup.
 *
 * @since 3.5.7
 */
class Astra_Addon_Update_Filter_Function {
	/**
	 * Check backwards compatibility to not load default CSS for the button styling of Page Builders.
	 *
	 * @since 2.2.0
	 * @return bool true if button style CSS should be loaded, False if not.
	 */
	public static function page_builder_addon_button_style_css() {
		return apply_filters( 'astra_addon_page_builder_button_style_css', astra_get_option( 'pb-button-color-compatibility-addon', true ) );
	}

	/**
	 * Font CSS support for widget-title heading fonts & fonts which are not working in editor.
	 *
	 * 1. Adding Font-weight support to widget titles.
	 * 2. Customizer font CSS not supporting in editor.
	 *
	 * @since 3.5.1
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function support_addon_font_css_to_widget_and_in_editor() {
		$astra_settings                                        = astra_get_options();
		$astra_settings['can-support-widget-and-editor-fonts'] = isset( $astra_settings['can-support-widget-and-editor-fonts'] ) ? false : true;
		return apply_filters( 'astra_heading_fonts_typo_support', $astra_settings['can-support-widget-and-editor-fonts'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

	/**
	 * Support cart color setting to default cart icon, till now with other cart icons have this color comaptibility but default one don't have this.
	 * This case is only for old header layout.
	 *
	 * @since 3.5.1
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_cart_color_default_icon_old_header() {
		$astra_settings = astra_get_options();
		$astra_settings['can-reflect-cart-color-in-old-header'] = isset( $astra_settings['can-reflect-cart-color-in-old-header'] ) ? false : true;
		return apply_filters( 'astra_support_default_cart_color_in_old_header', $astra_settings['can-reflect-cart-color-in-old-header'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

	/**
	 * In old header for Cart widget we have background: #ffffff; for outline cart, whereas this CSS missed in new HFB > Cart element. Adding it now as per support requests.
	 * This case is only for new header builder > WooCommerce cart.
	 *
	 * @since 3.5.7
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_add_bg_color_outline_cart_header_builder() {
		$astra_settings                                   = astra_get_options();
		$astra_settings['add-outline-cart-bg-new-header'] = isset( $astra_settings['add-outline-cart-bg-new-header'] ) ? false : true;
		return apply_filters( 'astra_apply_background_to_outline_cart_builder_element', $astra_settings['add-outline-cart-bg-new-header'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

	/**
	 * Astra update default font size and font weight.
	 *
	 * @since 4.6.0
	 * @return bool
	 */
	public static function astra_update_default_font_styling_addon() {
		return is_callable( 'Astra_Woocommerce::astra_update_default_font_styling' ) ? Astra_Woocommerce::astra_update_default_font_styling() : false;
	}
	/**
	 * Remove 'Header Sections' addon dependency
	 *
	 * @since 3.5.7
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_remove_header_sections_deps_header_builder() {
		$astra_settings = astra_get_options();
		$astra_settings['remove-header-sections-deps-in-new-header'] = isset( $astra_settings['remove-header-sections-deps-in-new-header'] ) ? false : true;
		return apply_filters( 'astra_remove_header_sections_dependency', $astra_settings['remove-header-sections-deps-in-new-header'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

	/**
	 * Check whether to update variant selected style or not.
	 *
	 * @since 3.9.3
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_addon_update_variant_active_style() {
		$astra_settings                                    = astra_get_options();
		$astra_settings['can-update-variant-active-style'] = isset( $astra_settings['can-update-variant-active-style'] ) ? false : true;
		return apply_filters( 'astra_addon_update_wc_variant_style', $astra_settings['can-update-variant-active-style'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

	/**
	 * Support sale badge background color for design 2.
	 *
	 * @since 4.1.6
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_addon_sale_badge_background_color() {
		$astra_settings = astra_get_options();
		$astra_settings['apply-modern-layout-sale-badge-styles'] = isset( $astra_settings['apply-modern-layout-sale-badge-styles'] ) ? false : true;
		return apply_filters( 'astra_addon_apply_sale_badge_styles_modern_layout', $astra_settings['apply-modern-layout-sale-badge-styles'] );
	}

	/**
	 * Improve full screen search Submit button style.
	 *
	 * @since 4.4.0
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_addon_upgrade_fullscreen_search_submit_style() {
		$astra_settings                           = astra_get_options();
		$astra_settings['v4-4-0-backward-option'] = isset( $astra_settings['v4-4-0-backward-option'] ) ? false : true;
		return apply_filters( 'astra_addon_upgrade_fullscreen_search_submit_style', $astra_settings['v4-4-0-backward-option'] );
	}

	/**
	 * Sub menu broken arrow icon for tablet and mobile.
	 *
	 * @since 4.6.0
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_addon_update_default_menu_styling() {
		$astra_settings                                      = astra_get_options();
		$astra_settings['update-default-spacing-for-header'] = isset( $astra_settings['update-default-spacing-for-header'] ) ? false : true;
		return apply_filters( 'astra_addon_update_legacy_menu_spacing', $astra_settings['update-default-spacing-for-header'] );
	}

	/**
	 * Restrict banner area with page header.
	 *
	 * @since 4.6.1
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_addon_restrict_banner_area_with_page_header() {
		$astra_settings = astra_get_options();
		$astra_settings['restrict-banner-layout-with-page-header'] = isset( $astra_settings['restrict-banner-layout-with-page-header'] ) ? false : true;
		return apply_filters( 'astra_addon_page_header_with_banner', $astra_settings['restrict-banner-layout-with-page-header'] );
	}

	/**
	 * Restrict site builder templates heading spacing.
	 *
	 * @since 4.6.8
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_addon_update_site_templates_headings_space() {
		$astra_settings = astra_get_options();
		$astra_settings['site-builder-templates-headings-space'] = isset( $astra_settings['site-builder-templates-headings-space'] ) ? false : true;
		return apply_filters( 'astra_get_option_site-builder-templates-headings-space', $astra_settings['site-builder-templates-headings-space'] );
	}

	/**
	 * Hiding Social share post icon left and right side option.
	 *
	 * @since 4.7.0
	 * @return bool false if it is an existing user, true if not.
	 */
	public static function astra_addon_hide_social_share_icon_position() {
		$astra_settings                                      = astra_get_options();
		$astra_settings['hiding_social_share_icon_position'] = isset( $astra_settings['hiding_social_share_icon_position'] ) ? false : true;
		return apply_filters( 'astra_addon_hide_left_right_social_icon_responsive_positions', $astra_settings['hiding_social_share_icon_position'] );
	}
}
