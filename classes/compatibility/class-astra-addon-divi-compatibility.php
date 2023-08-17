<?php
/**
 * Astra Addon Customizer
 *
 * @package Astra Addon
 * @since 1.6.0
 */

if ( ! class_exists( 'Astra_Addon_Divi_Compatibility' ) ) :

	/**
	 * Astra Addon Page Builder Compatibility base class
	 *
	 * @since 1.6.0
	 */
	class Astra_Addon_Divi_Compatibility extends Astra_Addon_Page_Builder_Compatibility {

		/**
		 * Instance
		 *
		 * @since 1.6.0
		 *
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

			$current_post = get_post( $post_id, OBJECT );

			wp( 'p=' . $post_id );

			$current_post->post_content = self::add_divi_wrap( $current_post->post_content );

			$current_post->post_content = apply_filters( 'the_content', $current_post->post_content );// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

			if ( strpos( $current_post->post_content, '<div id="et-boc" class="et-boc">' ) === false ) {
				$current_post->post_content = self::add_main_divi_wrapper( $current_post->post_content );
			}

			echo do_shortcode( $current_post->post_content );

			wp_reset_postdata();
		}

		/**
		 * Adds Divi wrapper container to post content.
		 *
		 * @since 1.3.3
		 *
		 * @param string $content Post content.
		 * @return string         Post content.
		 */
		public static function add_divi_wrap( $content ) {

			$outer_class   = apply_filters( 'et_builder_outer_content_class', array( 'et_builder_outer_content' ) );// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
			$outer_classes = implode( ' ', $outer_class );

			$outer_id = apply_filters( 'et_builder_outer_content_id', 'et_builder_outer_content' );// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

			$inner_class   = apply_filters( 'et_builder_inner_content_class', array( 'et_builder_inner_content' ) );// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
			$inner_classes = implode( ' ', $inner_class );

			$content = sprintf(
				'<div class="%2$s" id="%4$s">
					<div class="%3$s">
						%1$s
					</div>
				</div>',
				$content,
				esc_attr( $outer_classes ),
				esc_attr( $inner_classes ),
				esc_attr( $outer_id )
			);

			return $content;
		}

		/**
		 * Adds Divi main wrapper container to post content.
		 *
		 * @since v1.6.14
		 *
		 * @param string $content Post content.
		 * @return string         Post content.
		 */
		public static function add_main_divi_wrapper( $content ) {

			$content = sprintf(
				'<div id="%2$s" class="%2$s">
					%1$s
				</div>',
				$content,
				esc_attr( 'et-boc' ),
				esc_attr( 'et-boc' )
			);
			return $content;
		}
	}

endif;
