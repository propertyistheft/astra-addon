<?php
/**
 * Astra Addon Customizer
 *
 * @package Astra Addon
 * @since 1.6.0
 */

if ( ! class_exists( 'Astra_Addon_Brizy_Compatibility' ) ) :

	/**
	 * Astra Addon Page Builder Compatibility base class
	 *
	 * @since 1.6.0
	 */
	class Astra_Addon_Brizy_Compatibility extends Astra_Addon_Page_Builder_Compatibility {

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
		 *  Constructor
		 */
		public function __construct() {
			add_filter( 'brizy_supported_post_types', array( $this, 'support_astra_advanced_hook' ) );
		}

		/**
		 * Support astra advanced hook.
		 *
		 * @param array $posts posts.
		 *
		 * @since 1.6.12
		 */
		public function support_astra_advanced_hook( $posts ) {
			$posts[] = 'astra-advanced-hook';
			return $posts;
		}

		/**
		 * Render content for post.
		 *
		 * @param int $post_id Post id.
		 *
		 * @since 1.6.0
		 */
		public function render_content( $post_id ) {

			$post = Brizy_Editor_Post::get( $post_id );

			if ( $post && $post->uses_editor() ) {

				$content = apply_filters( 'brizy_content', $post->get_compiled_html(), Brizy_Editor_Project::get(), $post->get_wp_post() );

				echo do_shortcode( $content );
			}
		}

		/**
		 * Load styles and scripts.
		 *
		 * @param int $post_id Post id.
		 *
		 * @since 1.6.0
		 */
		public function enqueue_scripts( $post_id ) {

			$prefix = method_exists( 'Brizy_Editor', 'prefix' ) ? Brizy_Editor::prefix() : 'brizy';

			if ( isset( $_GET[ "{$prefix}-edit-iframe" ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				return;
			}

			try {
				$post = Brizy_Editor_Post::get( $post_id );
				$main = method_exists( 'Brizy_Public_Main', 'get' ) ? Brizy_Public_Main::get( $post ) : new Brizy_Public_Main( $post );
			} catch ( Exception $e ) {
				return;
			}

			$needs_compile = ! $post->isCompiledWithCurrentVersion() || $post->get_needs_compile();

			if ( $needs_compile ) {
				try {
					$post->compile_page();
					$post->saveStorage();
					$post->savePost();
				} catch ( Exception $e ) {
					return;
				}
			}

			// Add page CSS.
			add_filter( 'body_class', array( $main, 'body_class_frontend' ) );
			add_action(
				'wp_enqueue_scripts',
				function() use ( $main ) {
					if ( ! wp_script_is( 'brizy-preview' ) ) {
						add_action( 'wp_enqueue_scripts', array( $main, '_action_enqueue_preview_assets' ), 10001 );
					}
				},
				10000
			);

			add_action(
				'wp_head',
				function() use ( $post ) {
					$html = new Brizy_Editor_CompiledHtml( $post->get_compiled_html() );
					echo $html->get_head(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			);

			if ( $post && $post->uses_editor() ) {

				// Add page admin edit menu.
				add_action(
					'admin_bar_menu',
					function( $wp_admin_bar ) use ( $post ) {
						$wp_post_id = $post->get_wp_post()->ID;
						$args       = array(
							'id'    => 'brizy_Edit_page_' . $wp_post_id . '_link',
							/* translators: %s is the page title */
							'title' => sprintf( __( 'Edit %1$s with %2$s', 'astra-addon' ), get_the_title( $wp_post_id ), is_callable( 'Brizy_Editor::get' ) ? Brizy_Editor::get()->get_name() : 'Brizy' ),
							'href'  => $post->edit_url(),
							'meta'  => array(),
						);

					if ( true === $wp_admin_bar->get_node( 'brizy_Edit_page_link' ) ) { // PHPCS:ignore Generic.WhiteSpace.ScopeIndent.IncorrectExact
							$args['parent'] = 'brizy_Edit_page_link';
					} // PHPCS:ignore Generic.WhiteSpace.ScopeIndent.IncorrectExact

						$wp_admin_bar->add_node( $args );

					},
					1000
				);
			}
		}
	}

endif;

// Add support for Advannced Hooks.
Astra_Addon_Brizy_Compatibility::get_instance();
