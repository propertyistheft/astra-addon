<?php
/**
 * Astra Addon Customizer
 *
 * @package Astra Addon
 * @since 1.6.0
 */

if ( ! class_exists( 'Astra_Addon_Beaver_Builder_Compatibility' ) ) :

	/**
	 * Astra Addon Page Builder Compatibility base class
	 *
	 * @since 1.6.0
	 */
	class Astra_Addon_Beaver_Builder_Compatibility extends Astra_Addon_Page_Builder_Compatibility {

		/**
		 * Instance
		 *
		 * @since 1.6.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.6.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Render content for post.
		 *
		 * @param int $post_id Post id.
		 *
		 * @since 1.6.0
		 */
		public function render_content( $post_id ) {

			if ( ! apply_filters( 'astra_bb_render_content_by_id', false ) ) {
				if ( is_callable( 'FLBuilderShortcodes::insert_layout' ) ) {
					echo FLBuilderShortcodes::insert_layout( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						array( // WPCS: XSS OK.
							'id' => $post_id,
						)
					);
				}
			} else {
				FLBuilder::render_content_by_id(
					$post_id,
					'div',
					array()
				);
			}

		}

		/**
		 * Load styles and scripts for the BB layout.
		 *
		 * @param int $post_id Post id.
		 *
		 * @since 1.6.0
		 */
		public function enqueue_scripts( $post_id ) {

			if ( is_callable( 'FLBuilder::enqueue_layout_styles_scripts_by_id' ) ) {
				// Enqueue styles and scripts for this post.
				FLBuilder::enqueue_layout_styles_scripts_by_id( $post_id );
			}
		}

	}

endif;
