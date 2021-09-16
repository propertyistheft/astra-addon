<?php
/**
 * Handles logic for the theme layout data.
 *
 * @package Astra Addon
 */

/**
 * Astra Page Header Addon
 *
 * @since 1.0.0
 */
final class Astra_Ext_Advanced_Headers_Data {


	/**
	 * Cached layout data for the current page indexed by type.
	 *
	 * @since 1.0.0
	 * @access Private
	 * @var    array $current_page_layouts
	 */
	private static $current_page_layouts = null;

	/**
	 * Current page header ID
	 *
	 * @since  1.0.0
	 * @access  Private
	 * @var int
	 */
	private static $current_page_header = null;

	/**
	 * Returns the post IDs for the current page's header layouts.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public static function get_current_page_header_ids() {

		if ( is_customize_preview() && ! did_action( 'wp' ) ) {
			return false;
		}

		// If header is aleady searched for once, use that value.
		if ( null !== self::$current_page_header ) {
			return self::$current_page_header;
		}

		$option = array(
			'location'  => 'ast-advanced-headers-location',
			'exclusion' => 'ast-advanced-headers-exclusion',
			'users'     => 'ast-advanced-headers-users',
			'page_meta' => 'adv-header-id-meta',
		);
		$posts  = Astra_Target_Rules_Fields::get_instance()->get_posts_by_conditions( 'astra_adv_header', $option );

		if ( is_array( $posts ) && ! empty( $posts ) ) {

			foreach ( $posts as $post_id => $data ) {
				return $post_id;
			}
		}

		// default to false if there is not advanced header on the current page/post.
		return false;
	}
}
