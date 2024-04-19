<?php
/**
 * Deprecated Functions of Astra Addon.
 *
 * @package     Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.6.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'astra_pagination_infinite' ) ) :

	/**
	 * Deprecating astra_pagination_infinite function.
	 *
	 * @since 3.5.7
	 * @deprecated 3.5.7
	 */
	function astra_pagination_infinite() {
		_deprecated_function( __FUNCTION__, '3.5.7' );
	}

endif;

if ( ! function_exists( 'astra_shop_pagination_infinite' ) ) :

	/**
	 * Deprecating astra_shop_pagination_infinite function.
	 *
	 * @since 3.5.7
	 * @deprecated 3.5.7
	 */
	function astra_shop_pagination_infinite() {
		_deprecated_function( __FUNCTION__, '3.5.7' );
	}

endif;

if ( ! function_exists( 'astra_addon_clear_assets_cache' ) ) :

	/**
	 * Deprecating astra_addon_clear_assets_cache function.
	 *
	 * @since 3.5.9
	 * @deprecated 3.5.9
	 */
	function astra_addon_clear_assets_cache() {
		_deprecated_function( __FUNCTION__, '3.5.9' );
	}

endif;

/**
 * Deprecating astra_get_supported_posts function.
 *
 * Getting Astra theme name.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_get_supported_posts()
 * @param  boolean $with_tax Post has taxonomy.
 *
 * @see astra_addon_get_supported_posts()
 *
 * @return string
 */
function astra_get_supported_posts( $with_tax ) {
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_get_supported_posts()' );
	return astra_addon_get_supported_posts( $with_tax );
}

/**
 * Deprecating astra_rgba2hex function.
 *
 * Getting Astra theme name.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_rgba2hex()
 * @param  string $string Color code in RGBA / RGB format.
 * @param  string $include_alpha Color code in RGBA / RGB format.
 *
 * @see astra_addon_rgba2hex()
 *
 * @return string Return HEX color code.
 */
function astra_rgba2hex( $string, $include_alpha = false ) {
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_rgba2hex()' );
	return astra_addon_rgba2hex( $string, $include_alpha = false );
}

/**
 * Deprecating astra_check_is_hex function.
 *
 * Getting Astra theme name.
 *
 * @since 3.6.2
 * @param  string $string   Color code any format.
 *
 * @see astra_addon_check_is_hex()
 *
 * @return boolean          Return true | false.
 */
function astra_check_is_hex( $string ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_check_is_hex()' );
	return astra_addon_check_is_hex( $string );
}

/**
 * Deprecating is_support_swap_mobile_below_header_sections function.
 *
 * Checking backward flag to support swapping of sections in mobile-below header.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_swap_mobile_below_header_sections()
 * @see astra_addon_swap_mobile_below_header_sections()
 *
 * @return bool true|false
 */
function is_support_swap_mobile_below_header_sections() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_swap_mobile_below_header_sections()' );
	return astra_addon_swap_mobile_below_header_sections();
}

/**
 * Deprecating sticky_header_default_site_title_tagline_css_comp function.
 *
 * Sticky header's title-tagline CSS compatibility backward check.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_sticky_site_title_tagline_css_comp()
 * @see astra_addon_sticky_site_title_tagline_css_comp()
 *
 * @return bool true|false
 */
function sticky_header_default_site_title_tagline_css_comp() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_sticky_site_title_tagline_css_comp()' );
	return astra_addon_sticky_site_title_tagline_css_comp();
}

/**
 * Deprecating is_support_swap_mobile_above_header_sections function.
 *
 * Checking backward flag to support swapping of sections in mobile-above header.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_support_swap_mobile_above_header_sections()
 * @see astra_addon_support_swap_mobile_above_header_sections()
 *
 * @return bool true|false
 */
function is_support_swap_mobile_above_header_sections() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_support_swap_mobile_above_header_sections()' );
	return astra_addon_support_swap_mobile_above_header_sections();
}

/**
 * Deprecating astra_return_content_layout_page_builder function.
 *
 * Getting 'page-builder' layout.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_return_content_layout_page_builder()
 * @see astra_addon_return_content_layout_page_builder()
 *
 * @return string page-builder string used for filter `astra_get_content_layout`
 */
function astra_return_content_layout_page_builder() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_return_content_layout_page_builder()' );
	return astra_addon_return_content_layout_page_builder();
}

/**
 * Deprecating astra_return_page_layout_no_sidebar function.
 *
 * Getting 'no-sidebar' layout option.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_return_page_layout_no_sidebar()
 * @see astra_addon_return_page_layout_no_sidebar()
 *
 * @return string page-builder string used for filter `astra_get_content_layout`
 */
function astra_return_page_layout_no_sidebar() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_return_page_layout_no_sidebar()' );
	return astra_addon_return_page_layout_no_sidebar();
}

/**
 * Deprecating astra_pro_is_emp_endpoint function.
 *
 * Checking if AMP is setup or not.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_is_amp_endpoint()
 * @see astra_addon_is_amp_endpoint()
 *
 * @return string page-builder string used for filter `astra_get_content_layout`
 */
function astra_pro_is_emp_endpoint() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_is_amp_endpoint()' );
	return astra_addon_is_amp_endpoint();
}

/**
 * Deprecating is_astra_breadcrumb_trail function.
 *
 * Checking if breadcrumb with trail.
 *
 * @since 3.6.2
 * @param string $echo Whether to echo or return.
 *
 * @see astra_addon_is_breadcrumb_trail()
 *
 * @return string breadcrumb markup
 */
function is_astra_breadcrumb_trail( $echo ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_is_breadcrumb_trail()' );
	return astra_addon_is_breadcrumb_trail( $echo );
}

/**
 * Deprecating astra_breadcrumb_shortcode function.
 *
 * Breadcrumb markup shortcode based.
 *
 * @since 3.6.2
 * @deprecated 3.6.2 Use astra_addon_breadcrumb_shortcode()
 * @see astra_addon_breadcrumb_shortcode()
 *
 * @return string
 */
function astra_breadcrumb_shortcode() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_breadcrumb_shortcode()' );
	return astra_addon_breadcrumb_shortcode();
}

/**
 * Deprecating astra_get_template function.
 *
 * Getting Astra Pro's template.
 *
 * @since 3.6.2
 * @param string $template_name template path. E.g. (directory / template.php).
 * @param array  $args (default: array()).
 * @param string $template_path (default: '').
 * @param string $default_path (default: '').
 *
 * @see astra_addon_get_template()
 *
 * @return callback
 */
function astra_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_get_template()' );
	return astra_addon_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' );
}

/**
 * Deprecating astra_locate_template function.
 *
 * Locate Astra Pro's template.
 *
 * @since 3.6.2
 * @param string $template_name template path. E.g. (directory / template.php).
 * @param string $template_path (default: '').
 * @param string $default_path (default: '').
 *
 * @see astra_addon_locate_template()
 *
 * @return string return the template path which is maybe filtered.
 */
function astra_locate_template( $template_name, $template_path = '', $default_path = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_locate_template()' );
	return astra_addon_locate_template( $template_name, $template_path = '', $default_path = '' );
}

/**
 * Deprecating astra_ext_adv_search_dynamic_css function.
 *
 * Advanced search's dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_adv_search_dynamic_css()
 *
 * @return string
 */
function astra_ext_adv_search_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_adv_search_dynamic_css()' );
	return astra_addon_adv_search_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_advanced_search_dynamic_css function.
 *
 * Advanced search's dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_advanced_search_dynamic_css()
 *
 * @return string
 */
function astra_ext_advanced_search_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_advanced_search_dynamic_css()' );
	return astra_addon_advanced_search_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_header_builder_sections_colors_dynamic_css function.
 *
 * Astra builder sections advanced color & background specific dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_header_builder_sections_colors_dynamic_css()
 *
 * @return string
 */
function astra_ext_header_builder_sections_colors_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_header_builder_sections_colors_dynamic_css()' );
	return astra_addon_header_builder_sections_colors_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_header_sections_colors_dynamic_css function.
 *
 * Astra's old header sections dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_header_sections_colors_dynamic_css()
 *
 * @return string
 */
function astra_ext_header_sections_colors_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_header_sections_colors_dynamic_css()' );
	return astra_addon_header_sections_colors_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}


/**
 * Deprecating astra_ldrv3_dynamic_css function.
 *
 * Learndash extension specific dynamic CSS.
 *
 * @since 3.6.2
 *
 * @see astra_addon_ldrv3_dynamic_css()
 *
 * @return string
 */
function astra_ldrv3_dynamic_css() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_ldrv3_dynamic_css()' );
	return astra_addon_ldrv3_dynamic_css();
}

/**
 * Deprecating astra_learndash_dynamic_css function.
 *
 * Learndash extension specific dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_learndash_dynamic_css()
 *
 * @return string
 */
function astra_learndash_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_learndash_dynamic_css()' );
	return astra_addon_learndash_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_mobile_above_header_dynamic_css function.
 *
 * Astra's old header mobile layout specific dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_mobile_above_header_dynamic_css()
 *
 * @return string
 */
function astra_ext_mobile_above_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_mobile_above_header_dynamic_css()' );
	return astra_addon_mobile_above_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_mobile_below_header_dynamic_css function.
 *
 * Astra's old header mobile layout specific dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_mobile_below_header_dynamic_css()
 *
 * @return string
 */
function astra_ext_mobile_below_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_mobile_below_header_dynamic_css()' );
	return astra_addon_mobile_below_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_mobile_header_colors_background_dynamic_css function.
 *
 * Astra's old header mobile layout colors-background specific dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_mobile_header_colors_background_dynamic_css()
 *
 * @return string
 */
function astra_ext_mobile_header_colors_background_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_mobile_header_colors_background_dynamic_css()' );
	return astra_addon_mobile_header_colors_background_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_mobile_header_spacing_dynamic_css function.
 *
 * Astra's old header mobile layout spacing specific dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_mobile_header_spacing_dynamic_css()
 *
 * @return string
 */
function astra_ext_mobile_header_spacing_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_mobile_header_spacing_dynamic_css()' );
	return astra_addon_mobile_header_spacing_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_mobile_header_dynamic_css function.
 *
 * Astra's old header mobile layout specific dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_mobile_header_dynamic_css()
 *
 * @return string
 */
function astra_ext_mobile_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_mobile_header_dynamic_css()' );
	return astra_addon_mobile_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_mega_menu_dynamic_css function.
 *
 * Megamenu dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_mega_menu_dynamic_css()
 *
 * @return string
 */
function astra_ext_mega_menu_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_mega_menu_dynamic_css()' );
	return astra_addon_mega_menu_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_scroll_to_top_dynamic_css function.
 *
 * Scroll to top ext dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_scroll_to_top_dynamic_css()
 *
 * @return string
 */
function astra_ext_scroll_to_top_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_scroll_to_top_dynamic_css()' );
	return astra_addon_scroll_to_top_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_fb_button_dynamic_css function.
 *
 * Footer builder - Button dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_footer_button_dynamic_css()
 *
 * @return string
 */
function astra_ext_fb_button_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_footer_button_dynamic_css()' );
	return astra_addon_footer_button_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_fb_divider_dynamic_css function.
 *
 * Footer builder - Divider dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_footer_divider_dynamic_css()
 *
 * @return string
 */
function astra_fb_divider_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_footer_divider_dynamic_css()' );
	return astra_addon_footer_divider_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_fb_lang_switcher_dynamic_css function.
 *
 * Footer builder - Language switcher dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_footer_lang_switcher_dynamic_css()
 *
 * @return string
 */
function astra_fb_lang_switcher_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_footer_lang_switcher_dynamic_css()' );
	return astra_addon_footer_lang_switcher_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_footer_social_dynamic_css function.
 *
 * Footer builder - Social dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_footer_social_dynamic_css()
 *
 * @return string
 */
function astra_footer_social_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_footer_social_dynamic_css()' );
	return astra_addon_footer_social_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_hb_divider_dynamic_css function.
 *
 * Header builder - Divider dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_header_divider_dynamic_css()
 *
 * @return string
 */
function astra_hb_divider_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_header_divider_dynamic_css()' );
	return astra_addon_header_divider_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_hb_button_dynamic_css function.
 *
 * Footer builder - Social dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_header_button_dynamic_css()
 *
 * @return string
 */
function astra_ext_hb_button_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_header_button_dynamic_css()' );
	return astra_addon_header_button_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_hb_lang_switcher_dynamic_css function.
 *
 * Header builder - Language switcher dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_header_lang_switcher_dynamic_css()
 *
 * @return string
 */
function astra_hb_lang_switcher_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_header_lang_switcher_dynamic_css()' );
	return astra_addon_header_lang_switcher_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_ext_hb_menu_dynamic_css function.
 *
 * Header builder - Menu dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_header_menu_dynamic_css()
 *
 * @return string
 */
function astra_ext_hb_menu_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_header_menu_dynamic_css()' );
	return astra_addon_header_menu_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}

/**
 * Deprecating astra_header_social_dynamic_css function.
 *
 * Header builder - Social dynamic CSS.
 *
 * @since 3.6.2
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 *
 * @see astra_addon_header_social_dynamic_css()
 *
 * @return string
 */
function astra_header_social_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	_deprecated_function( __FUNCTION__, '3.6.2', 'astra_addon_header_social_dynamic_css()' );
	return astra_addon_header_social_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' );
}
