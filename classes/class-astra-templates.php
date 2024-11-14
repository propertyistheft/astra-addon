<?php
/**
 * Astra Templates
 *
 * @package Astra pro
 * @since 1.0.0
 */

/**
 * Astra get template.
 */
if ( ! function_exists( 'astra_addon_get_template' ) ) {

	/**
	 * Get other templates (e.g. blog layout 2/3, advanced footer layout 1/2/3/etc) passing attributes and including the file.
	 *
	 * @param string $template_name template path. E.g. (directory / template.php).
	 * @param array  $args (default: array()).
	 * @param string $template_path (default: '').
	 * @param string $default_path (default: '').
	 * @since 1.0.0
	 * @return void
	 */
	function astra_addon_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

		$located = astra_addon_locate_template( $template_name, $template_path, $default_path );

		if ( ! file_exists( $located ) ) {
			/* translators: 1: file location */
			_doing_it_wrong( __FUNCTION__, esc_html( sprintf( __( '%s does not exist.', 'astra-addon' ), '<code>' . $located . '</code>' ) ), '1.0.0' );
			return;
		}

		// Allow 3rd party plugin filter template file from their plugin.
		$located = apply_filters( 'astra_addon_get_template', $located, $template_name, $args, $template_path, $default_path );

		do_action( 'astra_addon_before_template_part', $template_name, $template_path, $located, $args );

		if ( file_exists( $located ) ) {
			// @codingStandardsIgnoreStart
			// nosemgrep audit.php.lang.security.file.inclusion-arg
			include $located; // phpcs:ignore
			// @codingStandardsIgnoreEnd
		}

		do_action( 'astra_addon_after_template_part', $template_name, $template_path, $located, $args );
	}
}

/**
 * Astra locate template.
 */
if ( ! function_exists( 'astra_addon_locate_template' ) ) {
	/**
	 * Locate a template and return the path for inclusion.
	 *
	 * This is the load order:
	 *
	 *      yourtheme       /   $template_path  /   $template_name
	 *      yourtheme       /   $template_name
	 *      $default_path   /   $template_name
	 *
	 * @param string $template_name template path. E.g. (directory / template.php).
	 * @param string $template_path (default: '').
	 * @param string $default_path (default: '').
	 * @since 1.0.0
	 * @return string return the template path which is maybe filtered.
	 */
	function astra_addon_locate_template( $template_name, $template_path = '', $default_path = '' ) {

		if ( ! $template_path ) {
			$template_path = 'astra-addon/';
		}

		if ( ! $default_path ) {
			$default_path = ASTRA_EXT_DIR . 'addons/';
		}

		/**
		 * Look within passed path within the theme - this is priority.
		 *
		 * Note: Avoided directories '/addons/' and '/template/'.
		 *
		 * E.g.
		 *
		 * 1) Override Footer Widgets - Template 1.
		 * Addon: {astra-addon}/addons/advanced-footer/template/layout-1.php
		 * Theme: {child-theme}/astra-addon/advanced-footer/layout-1.php
		 *
		 * 2) Override Blog Pro - Template 2.
		 * Addon: {astra-addon}/addons/blog-pro/template/blog-layout-2.php
		 * Theme: {child-theme}/astra-addon/blog-pro/blog-layout-2.php.
		 */
		$theme_template_name = str_replace( 'template/', '', $template_name );
		$template            = locate_template(
			array(
				trailingslashit( $template_path ) . $theme_template_name,
				$theme_template_name,
			)
		);

		// Get default template.
		if ( ! $template || ASTRA_EXT_TEMPLATE_DEBUG_MODE ) {
			$template = $default_path . $template_name;
		}

		// Return what we found.
		return apply_filters( 'astra_addon_locate_template', $template, $template_name, $template_path );
	}
}
