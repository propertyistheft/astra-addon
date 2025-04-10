<?php
/**
 * Astra Addon Gutenberg Compatibility class
 *
 * @package Astra Addon
 * @since 2.5.1
 */

/**
 * Astra Addon Gutenberg Builder Compatibility class
 *
 * @since 2.5.1
 */
class Astra_Addon_Gutenberg_Compatibility extends Astra_Addon_Page_Builder_Compatibility {
	/**
	 * Render Blocks content for post.
	 *
	 * @param int $post_id Post id.
	 *
	 * @since 2.5.1
	 */
	public function render_content( $post_id ) {
		$output       = '';
		$current_post = get_post( $post_id, OBJECT );

		if ( has_blocks( $current_post ) ) {
			$blocks = parse_blocks( $current_post->post_content );
			foreach ( $blocks as $block ) {
				$output .= render_block( $block );
			}

			// Automatically embed URLs (like Vimeo) using WP_Embed.
			if ( class_exists( 'WP_Embed' ) ) {
				$wp_embed = new WP_Embed();
				$output   = $wp_embed->autoembed( $output );
			}
		} else {
			$output = $current_post->post_content;
		}

		// Process nested shortcodes as it's for site builder and remove automatic <p> tags around them.
		echo do_shortcode( do_shortcode( shortcode_unautop( $output ) ) );
	}

	/**
	 * Load Gutenberg Blocks styles & scripts.
	 *
	 * @param int $post_id Post id.
	 *
	 * @since 2.5.1
	 */
	public function enqueue_blocks_assets( $post_id ) {

		wp_enqueue_style( 'wp-block-library' );

		if ( defined( 'UAGB_VER' ) ) {
			if ( version_compare( UAGB_VER, '1.23.0', '>=' ) && class_exists( 'UAGB_Post_Assets' ) ) {
				if ( 'no' !== get_post_meta( $post_id, 'ast-advanced-hook-enabled', true ) ) {
					$post_assets = new UAGB_Post_Assets( $post_id );
					$post_assets->enqueue_scripts();
				}
			} else {
				/**
				 * We can keep this compatibility for some releases and after few releases we need to remove it.
				 *
				 * @since 3.5.0
				 */
				if ( class_exists( 'UAGB_Helper' ) && class_exists( 'UAGB_Config' ) ) {

					/**
					 * Load UAG styles and scripts assets.
					 *
					 * @since 2.5.1
					 */
					if ( version_compare( UAGB_VER, '1.14.11', '>=' ) ) {
						$uag_post_meta = get_post_meta( $post_id, 'uag_style_timestamp-css', true );
					} else {
						$uag_post_meta = get_post_meta( $post_id, 'uagb_style_timestamp-css', true );
					}

					/**
					 * Set flag to load UAG assets.
					 *
					 * Resolving this to manage "UAG styles not load in some cases for Custom Layouts".
					 *
					 * @since 2.6.0
					 */
					$uag_is_active        = false;
					$current_post         = get_post( $post_id, OBJECT );
					$uagb_helper_instance = UAGB_Helper::get_instance();

					if ( $uag_post_meta ) {
						$uag_is_active = true;
					} else {
						$uag_helper_parse_func      = array( $uagb_helper_instance, 'parse' );
						$uag_helper_get_assets_func = array( $uagb_helper_instance, 'get_assets' );

						if ( is_callable( $uag_helper_parse_func ) && is_callable( $uag_helper_get_assets_func ) ) {

							$post_blocks     = $uagb_helper_instance->parse( $current_post->post_content );
							$post_uag_assets = $uagb_helper_instance->get_assets( $post_blocks );

							if ( ! empty( $post_uag_assets['css'] ) ) {

								$uag_is_active = true;

								$active_gutenberg_blocks = parse_blocks( $current_post->post_content );
								$used_uag_elements       = $this->get_active_uag_blocks( $active_gutenberg_blocks );

								if ( ! empty( $used_uag_elements ) ) {
									add_action(
										'wp_enqueue_scripts',
										static function() use ( $current_post, $used_uag_elements ) {

											if ( has_blocks( $current_post ) ) {

												$uag_blocks       = UAGB_Config::get_block_attributes();
												$uag_block_assets = UAGB_Config::get_block_assets();

												foreach ( $used_uag_elements as $curr_block_name ) {

													$js_assets  = isset( $uag_blocks[ $curr_block_name ]['js_assets'] ) ? $uag_blocks[ $curr_block_name ]['js_assets'] : array();
													$css_assets = isset( $uag_blocks[ $curr_block_name ]['css_assets'] ) ? $uag_blocks[ $curr_block_name ]['css_assets'] : array();

													// Script Assets.
													foreach ( $js_assets as $val ) {
														wp_register_script(
															$val, // Handle.
															$uag_block_assets[ $val ]['src'],
															$uag_block_assets[ $val ]['dep'],
															UAGB_VER,
															true
														);

														wp_enqueue_script( $val );
													}

													// Style Assets.
													foreach ( $css_assets as $val ) {
														wp_register_style(
															$val, // Handle.
															$uag_block_assets[ $val ]['src'],
															$uag_block_assets[ $val ]['dep'],
															UAGB_VER
														);

														wp_enqueue_style( $val );
													}
												}
											}
										},
										11
									);
								}
							}
						}
					}

					if ( $uag_is_active ) {

						$uag_generated_stylesheet_func = array( $uagb_helper_instance, 'get_generated_stylesheet' );

						/**
						 * As per UAG Team discussion they are going to keep this stylesheet for upcoming few updates, after their stable release UAGB_VER = v1.23.0. Later they are going to deprecate it.
						 *
						 * @since 3.5.0
						 */
						wp_enqueue_style(
							'uagb-block-css', // UAG-Handle.
							UAGB_URL . 'dist/blocks.style.css', // Block style CSS.
							array(),
							UAGB_VER
						);

						if ( is_callable( $uag_generated_stylesheet_func ) ) {
							$uagb_helper_instance->get_generated_stylesheet( $current_post );
						}
					}
				}
			}
		}
	}

	/**
	 * Get all UAG specific blocks from current Custom Layout.
	 *
	 * @param array $active_gutenberg_blocks has all gutenberg blocks used in this Custom Layout.
	 * @return array $uag_block_names having all UAG block names
	 * @since 2.6.0
	 */
	public function get_active_uag_blocks( array $active_gutenberg_blocks ) {

		$uag_block_names = array();

		foreach ( $active_gutenberg_blocks as $key => $curr_block_name ) {

			if ( 'blockName' === $key && strpos( $curr_block_name, 'uagb/' ) !== false ) {
				$uag_block_names[] = $curr_block_name;
			}

			if ( is_array( $curr_block_name ) ) {
				$uag_block_names = array_merge( $uag_block_names, $this->get_active_uag_blocks( $curr_block_name ) );
			}
		}

		return $uag_block_names;
	}
}
