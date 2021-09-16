<?php
/**
 * AMP Compatibility.
 *
 * @package Astra Addon
 * @since 1.7.0
 */

/**
 * Customizer Initialization
 *
 * @since 1.7.0
 */
class Astra_Addon_AMP_Compatibility {

	/**
	 *  Constructor
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'disable_addon_features' ) );
	}

	/**
	 * Disable features from Astra Pro when AMP endpoint is enabled.
	 *
	 * @return void
	 */
	public function disable_addon_features() {

		// If AMP endpoint is not active, bail as we don't need to change anything here.
		if ( true !== astra_pro_is_emp_endpoint() ) {
			return;
		}

		// Bail if AMP support is disabled by the user.
		if ( false === apply_filters( 'astra_amp_support', true ) ) {
			return;
		}

		add_filter( 'astra_cache_asset_type', array( $this, 'cache_add_amp_prefix' ) );

		if ( is_callable( 'Astra_Minify::get_instance' ) ) {
			// Prioritize Astra Addon's CSS in AMP layouts.
			remove_action( 'wp_enqueue_scripts', array( Astra_Minify::get_instance(), 'enqueue_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( Astra_Minify::get_instance(), 'enqueue_scripts' ), 7 );
		}

		// Scroll to top Addon.
		if ( true === Astra_Ext_Extension::is_active( 'scroll-to-top' ) && is_callable( 'Astra_Ext_Scroll_To_Top_Markup::get_instance' ) ) {
			remove_action( 'wp_footer', array( Astra_Ext_Scroll_To_Top_Markup::get_instance(), 'html_markup_loader' ) );
			remove_action( 'astra_get_css_files', array( Astra_Ext_Scroll_To_Top_Markup::get_instance(), 'add_styles' ) );
			remove_action( 'astra_get_js_files', array( Astra_Ext_Scroll_To_Top_Markup::get_instance(), 'add_scripts' ) );
			remove_filter( 'astra_dynamic_css', 'astra_ext_scroll_to_top_dynamic_css' );
		}

		// Sticky Header.
		if ( true === Astra_Ext_Extension::is_active( 'sticky-header' ) && is_callable( 'Astra_Ext_Sticky_Header_Markup::get_instance' ) ) {
			remove_action( 'astra_get_css_files', array( Astra_Ext_Sticky_Header_Markup::get_instance(), 'add_styles' ) );
			remove_action( 'astra_get_js_files', array( Astra_Ext_Sticky_Header_Markup::get_instance(), 'add_scripts' ) );
			remove_filter( 'astra_addon_js_localize', array( Astra_Ext_Sticky_Header_Markup::get_instance(), 'localize_variables' ) );
			remove_action( 'body_class', array( Astra_Ext_Sticky_Header_Markup::get_instance(), 'add_body_class' ) );
			remove_action( 'astra_header', array( Astra_Ext_Sticky_Header_Markup::get_instance(), 'none_header_markup' ), 5 );
			remove_action( 'astra_header', array( Astra_Ext_Sticky_Header_Markup::get_instance(), 'fixed_header_markup' ), 11 );
			remove_filter( 'astra_dynamic_css', 'astra_ext_sticky_header_dynamic_css', 30 );
			remove_filter( 'astra_dynamic_css', 'astra_ext_above_header_sections_dynamic_css', 30 );
			remove_filter( 'astra_dynamic_css', 'astra_ext_below_header_sections_dynamic_css', 30 );
			remove_filter( 'astra_dynamic_css', 'astra_ext_sticky_header_with_site_layouts_dynamic_css' );
		}

		// Nav Menu Addon.
		if ( true === Astra_Ext_Extension::is_active( 'nav-menu' ) && is_callable( 'Astra_Ext_Nav_Menu_Loader::get_instance' ) ) {
			remove_action( 'astra_get_css_files', array( Astra_Ext_Nav_Menu_Loader::get_instance(), 'add_styles' ) );
			remove_filter( 'wp_nav_menu_args', array( Astra_Ext_Nav_Menu_Loader::get_instance(), 'modify_nav_menu_args' ) );
			remove_filter( 'astra_dynamic_css', 'astra_ext_mega_menu_dynamic_css' );
		}

		// Page Header Addon.
		if ( true === Astra_Ext_Extension::is_active( 'advanced-headers' ) && is_callable( 'Astra_Ext_Advanced_Headers_Markup::get_instance' ) ) {
			remove_action( 'wp_enqueue_scripts', array( Astra_Ext_Advanced_Headers_Markup::get_instance(), 'add_scripts' ), 9 );
			add_action( 'wp_enqueue_scripts', array( Astra_Ext_Advanced_Headers_Markup::get_instance(), 'add_scripts' ), 6 );
		}

		// Blog Pro Addon.
		if ( true === Astra_Ext_Extension::is_active( 'blog-pro' ) && is_callable( 'Astra_Ext_Blog_Pro_Markup::get_instance' ) ) {
			// Remove Auto Load Previous Posts option.
			remove_action( 'init', array( Astra_Ext_Blog_Pro_Markup::get_instance(), 'init_action' ) );
			add_filter( 'astra_get_option_ast-auto-prev-post', '__return_false' );

			// Remove Infinite Scroll option.
			remove_filter( 'astra_theme_js_localize', array( Astra_Ext_Blog_Pro_Markup::get_instance(), 'blog_js_localize' ) );
			remove_filter( 'astra_pagination_markup', array( Astra_Ext_Blog_Pro_Markup::get_instance(), 'astra_blog_pagination' ) );
			add_filter( 'astra_get_option_blog-pagination', array( $this, 'return_number_pagination' ) );

		}

		if ( true === Astra_Ext_Extension::is_active( 'advanced-search' ) ) {
			add_filter( 'astra_get_option_header-main-rt-section-search-box-type', array( $this, 'return_slide_search' ) );
		}

		if ( true === Astra_Ext_Extension::is_active( 'header-sections' ) ) {
			add_filter( 'astra_get_option_above-header-layout', array( $this, 'return_disabled' ) );
			add_filter( 'astra_get_option_below-header-layout', array( $this, 'return_disabled' ) );
		}

		if ( true === Astra_Ext_Extension::is_active( 'mobile-header' ) ) {
			add_filter( 'astra_get_option_mobile-menu-style', array( $this, 'return_default' ) );
		}

		if ( true === Astra_Ext_Extension::is_active( 'colors-and-background' ) ) {
			add_filter( 'astra_addon_colors_dynamic_css_desktop', array( $this, 'css_replace_breakpoint_to_amp' ) );
			add_filter( 'astra_addon_colors_dynamic_css_tablet', array( $this, 'css_replace_breakpoint_to_amp' ) );
			add_filter( 'astra_addon_colors_dynamic_css_mobile', array( $this, 'css_replace_breakpoint_to_amp' ) );
		}

		add_filter( 'astra_addon_render_custom_layout_content', array( $this, 'custom_layout_disable_on_amp' ), 10, 2 );
	}

	/**
	 * Add prefix to Assets cache key if on AMP endpoint.
	 *
	 * @param String $asset_type Asset type.
	 * @return String Asset type with AMP Prefix.
	 */
	public function cache_add_amp_prefix( $asset_type ) {
		return 'amp-' . $asset_type;
	}

	/**
	 * Disable Custom Layout on frontend if it is disabled on AMP.
	 *
	 * @since 1.7.0
	 * @param boolean $status Status true if layout is tobe displayed on the frontend. False is it should not be rendered.
	 * @param int     $post_id Post ID which is to be rendered from the Custom Layout.
	 * @return boolean.
	 */
	public function custom_layout_disable_on_amp( $status, $post_id ) {
		$amp_status = get_post_meta( $post_id, 'amp_status', true );
		if ( 'enabled' === $amp_status || '' === $amp_status ) {
			$status = true;
		} else {
			$status = false;
		}

		return $status;
	}

	/**
	 * Change the breakpoint CSS class to ast-amp for AMP specific CSS.
	 *
	 * @since 1.7.0
	 *
	 * @param String $css compiled css.
	 * @return String
	 */
	public function css_replace_breakpoint_to_amp( $css ) {
		return str_replace( 'ast-header-break-point', 'ast-amp', $css );
	}

	/**
	 * FReturn `slide-search` string.
	 *
	 * @since 1.7.0
	 *
	 * @return String
	 */
	public function return_slide_search() {
		return 'slide-search';
	}

	/**
	 * Return `disabled` string.
	 *
	 * @since 1.7.0
	 *
	 * @return String
	 */
	public function return_disabled() {
		return 'disabled';
	}

	/**
	 * Return `default` string.
	 *
	 * @since 1.7.0
	 *
	 * @return String
	 */
	public function return_default() {
		return 'default';
	}

	/**
	 * Return number string.
	 *
	 * @since 1.7.0
	 *
	 * @return String
	 */
	public function return_number_pagination() {
		return 'number';
	}

}

/**
*  Kicking this off by calling 'get_instance()' method
*/
new Astra_Addon_AMP_Compatibility();
