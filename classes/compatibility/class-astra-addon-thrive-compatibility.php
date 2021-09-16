<?php
/**
 * Astra Addon Customizer
 *
 * @package Astra Addon
 * @since 1.6.0
 */

if ( ! class_exists( 'Astra_Addon_Thrive_Compatibility' ) ) :

	/**
	 * Astra Addon Page Builder Compatibility base class
	 *
	 * @since 1.6.0
	 */
	class Astra_Addon_Thrive_Compatibility extends Astra_Addon_Page_Builder_Compatibility {

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

			if ( true === $this->is_thrive_builder_page( $post_id ) ) {
				return;
			}

			$current_post = get_post( $post_id, OBJECT );

			global $post;
			$post = $current_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

			$tve_content = apply_filters( 'the_content', $current_post->post_content );

			if ( isset( $_REQUEST[ TVE_EDITOR_FLAG ] ) ) {  // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$tve_content = str_replace( 'id="tve_editor"', '', $tve_content );
			}

			echo $tve_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			wp_reset_postdata();
		}

		/**
		 * Load styles and scripts.
		 *
		 * @param int $post_id Post id.
		 *
		 * @since 1.6.0
		 */
		public function enqueue_scripts( $post_id ) {

			if ( true === $this->is_thrive_builder_page( $post_id ) ) {
				return;
			}

			if ( tve_get_post_meta( $post_id, 'thrive_icon_pack' ) && ! wp_style_is( 'thrive_icon_pack', 'enqueued' ) ) {
				TCB_Icon_Manager::enqueue_icon_pack();
			}

			tve_enqueue_extra_resources( $post_id );
			tve_enqueue_style_family( $post_id );
			tve_enqueue_custom_fonts( $post_id, true );
			tve_load_custom_css( $post_id );

			add_filter( 'tcb_enqueue_resources', '__return_true' );
			tve_frontend_enqueue_scripts();
			remove_filter( 'tcb_enqueue_resources', '__return_true' );

		}

		/**
		 * Check if the page being rendered is the main ID on the editor page.
		 *
		 * @since 1.6.2
		 * @param String $post_id  Post ID which is to be rendered.
		 * @return boolean True if current if is being rendered is not being edited.
		 */
		private function is_thrive_builder_page( $post_id ) {
			$tve  = ( isset( $_GET['tve'] ) && 'true' == $_GET['tve'] ) ? true : false;  // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$post = isset( $_GET['post'] ) ? sanitize_text_field( $_GET['post'] ) : false;  // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			return ( true == $tve && $post_id !== $post );
		}

	}

endif;
