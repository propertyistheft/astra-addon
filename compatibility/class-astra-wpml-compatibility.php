<?php
/**
 * WPML Compatibility
 *
 * @package     Astra Addon
 * @link        https://wpastra.com/
 * @since       Astra 1.0
 */

if ( ! class_exists( 'Astra_Wpml_Compatibility' ) ) :

	/**
	 * WPML Compatibility
	 */
	// @codingStandardsIgnoreStart
	final class Astra_Wpml_Compatibility {
		// @codingStandardsIgnoreEnd

		/**
		 * Instance of Astra_Wpml_Compatibility.
		 *
		 * @since  1.1.0
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Get instance of Astra_Wpml_Compatibility
		 *
		 * @since  1.1.0
		 * @return Astra_Wpml_Compatibility
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Setup actions and filters.
		 *
		 * @since  1.1.0
		 */
		private function __construct() {
			add_filter( 'astra_addon_get_display_posts_by_conditions', array( $this, 'get_advanced_hook_wpml_object' ), 10, 2 );
		}

		/**
		 * Pass the current page advanced hook display posts to WPML's object filter to allow strings to be translated.
		 *
		 * @since  1.1.0
		 * @param  object $current_posts Posts.
		 * @param  string $post_type Post Type.
		 *
		 * @return object  Posts.
		 */
		public function get_advanced_hook_wpml_object( $current_posts, $post_type ) {

			if ( 'astra-advanced-hook' === $post_type ) {

				$wpml_filter_posts = $current_posts;

				foreach ( $current_posts as $post_id => $post_data ) {

					// Get tralated post id here.
					$wpml_filter_id = apply_filters( 'wpml_object_id', $post_id, 'astra-advanced-hook', true ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

					if ( null !== $wpml_filter_id ) {

						if ( $post_id !== $wpml_filter_id && isset( $wpml_filter_posts[ $post_id ] ) ) {

							$wpml_filter_posts[ $wpml_filter_id ]       = $wpml_filter_posts[ $post_id ];
							$wpml_filter_posts[ $wpml_filter_id ]['id'] = $wpml_filter_id;

							unset( $wpml_filter_posts[ $post_id ] );
						}
					}
				}

				$current_posts = $wpml_filter_posts;
			}

			return $current_posts;
		}
	}
endif;

/**
 * Initiate the class.
 */
Astra_Wpml_Compatibility::instance();
