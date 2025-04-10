<?php
/**
 * Deprecated Filters of Astra Addon.
 *
 * @package     Astra
 * @link        https://wpastra.com/
 * @since       Astra 3.5.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'astra_apply_filters_deprecated' ) ) {

	/**
	 * Astra search results post type filter added for AJAX action
	 *
	 * @since 3.5.7
	 */
	$astra_addon_post_type_condition = 'any';
	astra_apply_filters_deprecated( 'astra_infinite_pagination_post_type', array( $astra_addon_post_type_condition ), '3.5.7' );
}

// Deprecating astra_bb_render_content_by_id filter.
add_filter( 'astra_addon_bb_render_content_by_id', 'astra_deprecated_astra_bb_render_content_by_id_filter', 10, 1 );

/**
 * Render Beaver Builder content by ID.
 *
 * @since 3.6.2
 * @param bool $render_content true | false.
 * @return bool true for enabled | false for disable.
 *
 * @see astra_addon_bb_render_content_by_id
 */
function astra_deprecated_astra_bb_render_content_by_id_filter( $render_content ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_bb_render_content_by_id', array( $render_content ), '3.6.2', 'astra_addon_bb_render_content_by_id', '' );
}

// Deprecating astra_get_assets_uploads_dir filter.
add_filter( 'astra_addon_get_assets_uploads_dir', 'astra_deprecated_astra_get_assets_uploads_dir_filter', 10, 1 );

/**
 * Uplods astra assets dir data
 *
 * @since 3.6.2
 * @param string $assets_dir directory name to be created in the WordPress uploads directory.
 * @return array Includes path & url.
 *
 * @see astra_addon_get_assets_uploads_dir
 */
function astra_deprecated_astra_get_assets_uploads_dir_filter( $assets_dir ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_get_assets_uploads_dir', array( $assets_dir ), '3.6.2', 'astra_addon_get_assets_uploads_dir', '' );
}

// Deprecating astra_pro_show_branding filter.
add_filter( 'astra_addon_show_branding', 'astra_deprecated_astra_pro_show_branding_filter', 10, 1 );

/**
 * Whitelabel branding markup.
 *
 * @since 3.6.2
 * @param bool $show_branding true | false.
 * @return bool true for showing | false for hiding branding markup.
 *
 * @see astra_addon_show_branding
 */
function astra_deprecated_astra_pro_show_branding_filter( $show_branding ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_pro_show_branding', array( $show_branding ), '3.6.2', 'astra_addon_show_branding', '' );
}

// Deprecating astra_dynamic_css filter.
add_filter( 'astra_addon_dynamic_css', 'astra_deprecated_astra_dynamic_css_filter', 10, 1 );

/**
 * Dynamic CSS to be enqueue.
 *
 * @since 3.6.2
 * @param string $dynamic_css Parsed CSS.
 * @return string
 *
 * @see astra_addon_dynamic_css
 */
function astra_deprecated_astra_dynamic_css_filter( $dynamic_css ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_dynamic_css', array( $dynamic_css ), '3.6.2', 'astra_addon_dynamic_css', '' );
}

// Deprecating astra_add_css_file filter.
add_filter( 'astra_addon_add_css_file', 'astra_deprecated_astra_add_css_file_filter', 10, 1 );

/**
 * Ading custom CSS file privilege.
 *
 * @since 3.6.2
 * @param array $css_files All stylesheets.
 *
 * @see astra_addon_add_css_file
 */
function astra_deprecated_astra_add_css_file_filter( $css_files ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_add_css_file', array( $css_files ), '3.6.2', 'astra_addon_add_css_file', '' );
}

// Deprecating astra_add_js_file filter.
add_filter( 'astra_addon_add_js_file', 'astra_deprecated_astra_add_js_file_filter', 10, 1 );

/**
 * Ading custom JS file privilege.
 *
 * @since 3.6.2
 * @param array $js_files All scripts.
 *
 * @see astra_addon_add_js_file
 */
function astra_deprecated_astra_add_js_file_filter( $js_files ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_add_js_file', array( $js_files ), '3.6.2', 'astra_addon_add_js_file', '' );
}

// Deprecating astra_add_dependent_js_file filter.
add_filter( 'astra_addon_add_dependent_js_file', 'astra_deprecated_astra_add_dependent_js_file_filter', 10, 1 );

/**
 * Get dependent JS files to generate.
 *
 * @since 3.6.2
 * @param array $dependent_js_files Dependent script array.
 *
 * @see astra_addon_add_dependent_js_file
 */
function astra_deprecated_astra_add_dependent_js_file_filter( $dependent_js_files ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_add_dependent_js_file', array( $dependent_js_files ), '3.6.2', 'astra_addon_add_dependent_js_file', '' );
}

// Deprecating astra_render_css filter.
add_filter( 'astra_addon_render_css', 'astra_deprecated_astra_render_css_filter', 10, 1 );

/**
 * To be render dynamic CSS.
 *
 * @since 3.6.2
 * @param array $css Dynamic CSS.
 *
 * @see astra_addon_render_css
 */
function astra_deprecated_astra_render_css_filter( $css ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_render_css', array( $css ), '3.6.2', 'astra_addon_render_css', '' );
}

// Deprecating astra_render_js filter.
add_filter( 'astra_addon_render_js', 'astra_deprecated_astra_render_js_filter', 10, 1 );

/**
 * To be render dynamic JS.
 *
 * @since 3.6.2
 * @param array $js Dynamic JS.
 *
 * @see astra_addon_render_js
 */
function astra_deprecated_astra_render_js_filter( $js ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_render_js', array( $js ), '3.6.2', 'astra_addon_render_js', '' );
}

// Deprecating astra_languages_directory filter.
add_filter( 'astra_addon_languages_directory', 'astra_deprecated_astra_languages_directory_filter', 10, 1 );

/**
 * Plugin language directory.
 *
 * @since 3.6.2
 * @param string $lang_dir The languages directory path.
 * @return string $lang_dir The languages directory path.
 *
 * @see astra_addon_languages_directory
 */
function astra_deprecated_astra_languages_directory_filter( $lang_dir ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_languages_directory', array( $lang_dir ), '3.6.2', 'astra_addon_languages_directory', '' );
}

// Deprecating astra_ext_default_addons filter.
add_filter( 'astra_addon_ext_default_addons', 'astra_deprecated_astra_ext_default_addons_filter', 10, 1 );

/**
 * Default addon list in Astra Addon.
 *
 * @since 3.6.2
 * @param array $default_addons Default extensions from Astra Pro.
 *
 * @see astra_addon_ext_default_addons
 */
function astra_deprecated_astra_ext_default_addons_filter( $default_addons ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_ext_default_addons', array( $default_addons ), '3.6.2', 'astra_addon_ext_default_addons', '' );
}

// Deprecating astra_get_addons filter.
add_filter( 'astra_addon_get_addons', 'astra_deprecated_astra_get_addons_filter', 10, 1 );

/**
 * Astra addon's all modules list.
 *
 * @since 3.6.2
 * @param array $extensions All Astra Pro's extensions.
 *
 * @see astra_addon_get_addons
 */
function astra_deprecated_astra_get_addons_filter( $extensions ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_get_addons', array( $extensions ), '3.6.2', 'astra_addon_get_addons', '' );
}

// Deprecating astra_ext_enabled_extensions filter.
add_filter( 'astra_addon_enabled_extensions', 'astra_deprecated_astra_ext_enabled_extensions_filter', 10, 1 );

/**
 * Astra addon's all active extensions.
 *
 * @since 3.6.2
 * @param array $active_addons Astra Pro's active extensions.
 *
 * @see astra_addon_enabled_extensions
 */
function astra_deprecated_astra_ext_enabled_extensions_filter( $active_addons ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_ext_enabled_extensions', array( $active_addons ), '3.6.2', 'astra_addon_enabled_extensions', '' );
}

// Deprecating astra_custom_404_options filter.
add_filter( 'astra_addon_custom_404_options', 'astra_deprecated_astra_custom_404_options_filter', 10, 1 );

/**
 * Provide Custom 404 data array().
 *
 * @since 3.6.2
 * @param array $options 404 layout options.
 *
 * @see astra_addon_custom_404_options
 */
function astra_deprecated_astra_custom_404_options_filter( $options ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_custom_404_options', array( $options ), '3.6.2', 'astra_addon_custom_404_options', '' );
}

// Deprecating astra_cache_asset_query_var filter.
add_filter( 'astra_addon_cache_asset_query_var', 'astra_deprecated_astra_cache_asset_query_var_filter', 10, 1 );

/**
 * Get Current query type.
 *
 * @since 3.6.2
 * @param string $slug single|archive.
 *
 * @see astra_addon_cache_asset_query_var
 */
function astra_deprecated_astra_cache_asset_query_var_filter( $slug ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_cache_asset_query_var', array( $slug ), '3.6.2', 'astra_addon_cache_asset_query_var', '' );
}

// Deprecating astra_cache_asset_type filter.
add_filter( 'astra_addon_cache_asset_type', 'astra_deprecated_astra_cache_asset_type_filter', 10, 1 );

/**
 * Get the archive title.
 *
 * @since 3.6.2
 * @param string $title archive title.
 * @return string $title Returns the archive title.
 *
 * @see astra_addon_cache_asset_type
 */
function astra_deprecated_astra_cache_asset_type_filter( $title ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_cache_asset_type', array( $title ), '3.6.2', 'astra_addon_cache_asset_type', '' );
}

// Deprecating astra_load_dynamic_css_inline filter.
add_filter( 'astra_addon_load_dynamic_css_inline', 'astra_deprecated_astra_load_dynamic_css_inline_filter', 10, 1 );

/**
 * Enqueue the assets inline.
 *
 * @since 3.6.2
 * @param bool $load_inline True|False.
 *
 * @see astra_addon_load_dynamic_css_inline
 */
function astra_deprecated_astra_load_dynamic_css_inline_filter( $load_inline ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_load_dynamic_css_inline', array( $load_inline ), '3.6.2', 'astra_addon_load_dynamic_css_inline', '' );
}

// Deprecating astra_flags_svg filter.
add_filter( 'astra_addon_flags_svg', 'astra_deprecated_astra_flags_svg_filter', 10, 1 );

/**
 * Builder components SVG icons.
 *
 * @since 3.6.2
 * @param bool $svg_icons Component's SVG icons.
 *
 * @see astra_addon_flags_svg
 */
function astra_deprecated_astra_flags_svg_filter( $svg_icons ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_flags_svg', array( $svg_icons ), '3.6.2', 'astra_addon_flags_svg', '' );
}

// Deprecating astra_display_on_list filter.
add_filter( 'astra_addon_display_on_list', 'astra_deprecated_astra_display_on_list_filter', 10, 1 );

/**
 * Filter options displayed in the display conditions select field of Display conditions.
 *
 * @since 3.6.2
 * @param array $selection_options Display conditions.
 *
 * @see astra_addon_display_on_list
 */
function astra_deprecated_astra_display_on_list_filter( $selection_options ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_display_on_list', array( $selection_options ), '3.6.2', 'astra_addon_display_on_list', '' );
}

// Deprecating astra_location_rule_post_types filter.
add_filter( 'astra_addon_location_rule_post_types', 'astra_deprecated_astra_location_rule_post_types_filter', 10, 1 );

/**
 * Get location selection post types.
 *
 * @since 3.6.2
 * @param array $post_types Post tyoes based on to be targeted locations.
 *
 * @see astra_addon_location_rule_post_types
 */
function astra_deprecated_astra_location_rule_post_types_filter( $post_types ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_location_rule_post_types', array( $post_types ), '3.6.2', 'astra_addon_location_rule_post_types', '' );
}

// Deprecating astra_user_roles_list filter.
add_filter( 'astra_addon_user_roles_list', 'astra_deprecated_astra_user_roles_list_filter', 10, 1 );

/**
 * Filter options displayed in the user select field of Display conditions.
 *
 * @since 3.6.2
 * @param array $selection_options User list options.
 *
 * @see astra_addon_user_roles_list
 */
function astra_deprecated_astra_user_roles_list_filter( $selection_options ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_user_roles_list', array( $selection_options ), '3.6.2', 'astra_addon_user_roles_list', '' );
}

// Deprecating astra_target_page_settings filter.
add_filter( 'astra_addon_target_page_settings', 'astra_deprecated_astra_target_page_settings_filter', 10, 2 );

/**
 * Targeted page|rule setting.
 *
 * @since 3.6.2
 * @param array $current_layout Active custom layout.
 * @param array $layout_id Current layout ID.
 *
 * @return int|bool If the current layout is to be displayed it will be returned back else a boolean will be passed.
 *
 * @see astra_addon_target_page_settings
 */
function astra_deprecated_astra_target_page_settings_filter( $current_layout, $layout_id ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_target_page_settings', array( $current_layout, $layout_id ), '3.6.2', 'astra_addon_target_page_settings', '' );
}

// Deprecating astra_get_display_posts_by_conditions filter.
add_filter( 'astra_addon_get_display_posts_by_conditions', 'astra_deprecated_astra_get_display_posts_by_conditions_filter', 10, 2 );

/**
 * Get posts by conditions
 *
 * @since 3.6.2
 * @param array  $current_page_data Passed query data.
 * @param string $post_type Post Type.
 *
 * @return object Posts.
 *
 * @see astra_addon_get_display_posts_by_conditions
 */
function astra_deprecated_astra_get_display_posts_by_conditions_filter( $current_page_data, $post_type ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_get_display_posts_by_conditions', array( $current_page_data, $post_type ), '3.6.2', 'astra_addon_get_display_posts_by_conditions', '' );
}

// Deprecating astra_meta_args_post_by_condition filter.
add_filter( 'astra_addon_meta_args_post_by_condition', 'astra_deprecated_astra_meta_args_post_by_condition_filter', 10, 3 );

/**
 * Get posts by conditions
 *
 * @since 3.6.2
 * @param array  $meta_args Metadata of custom layout.
 * @param array  $q_obj Passed query object.
 * @param string $current_post_id Current Post Type.
 *
 * @return object Posts.
 *
 * @see astra_addon_meta_args_post_by_condition
 */
function astra_deprecated_astra_meta_args_post_by_condition_filter( $meta_args, $q_obj, $current_post_id ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_meta_args_post_by_condition', array( $meta_args, $q_obj, $current_post_id ), '3.6.2', 'astra_addon_meta_args_post_by_condition', '' );
}

// Deprecating astra_pro_white_label_add_form filter.
add_filter( 'astra_addon_white_label_add_form', 'astra_deprecated_astra_pro_white_label_add_form_filter', 10, 1 );

/**
 * Provide White Label structure markup.
 *
 * @since 3.6.2
 * @param array $markup form markup.
 *
 * @return array Brading array
 *
 * @see astra_addon_white_label_add_form
 */
function astra_deprecated_astra_pro_white_label_add_form_filter( $markup ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	return astra_apply_filters_deprecated( 'astra_pro_white_label_add_form', array( $markup ), '3.6.2', 'astra_addon_white_label_add_form', '' );
}
