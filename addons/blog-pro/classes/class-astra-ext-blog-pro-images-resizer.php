<?php
/**
 * Blog Pro - Customizer.
 *
 * @package Astra Addon
 * @since 1.5.0
 */

if ( ! class_exists( 'Astra_Ext_Blog_Pro_Images_Resizer' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.5.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Blog_Pro_Images_Resizer {
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
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

			if ( self::is_image_resizer() ) {
				self::includes();
			}

			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );

			add_filter( 'astra_featured_image_markup', array( $this, 'blog_archive_featured_image' ) );
			add_filter( 'astra_featured_image_markup', array( $this, 'blog_single_post_featured_image' ) );
			add_filter( 'astra_article_featured_image_markup', array( $this, 'article_post_featured_image' ) );
		}

		/**
		 * Filter to disable Image Processing Queue by DeliciousBrains.
		 *
		 * @return boolean true if Library is included/loaded.
		 */
		public function is_image_resizer() {
			return apply_filters( 'astra_image_resizer', true );
		}


		/**
		 * Register panel, section and controls
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			require_once ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'classes/sections/class-astra-customizer-blog-pro-image-resizer-configs.php';

		}

		/**
		 * Include necessary files.
		 *
		 * @since 1.5.0
		 */
		public static function includes() {

			require_once ASTRA_EXT_DIR . 'classes/library/image-processing-queue/image-processing-queue.php';

		}

		/**
		 * Filter to add updated featured image markup with updated images sizes on Blog Archive Page.
		 *
		 * @since 1.5.0
		 * @param string $output the featured image markup for archive post.
		 * @return string $output Updated featured image markup for archive post.
		 */
		public function blog_archive_featured_image( $output ) {

			if ( 'post' === get_post_type() && ( is_archive() || is_search() || is_home() ) ) {
				$blog_archive_image_width  = astra_get_option( 'blog-archive-image-width' );
				$blog_archive_image_height = astra_get_option( 'blog-archive-image-height' );

				$blog_post_title = astra_get_option( 'blog-post-structure' );

				$attributes = array(
					'width'  => empty( $blog_archive_image_width ) ? false : $blog_archive_image_width,
					'height' => empty( $blog_archive_image_height ) ? false : $blog_archive_image_height,
					'crop'   => ( empty( $blog_archive_image_width ) || empty( $blog_archive_image_height ) ) ? false : true,
				);

				if ( ! $attributes['width'] && ! $attributes['height'] ) {
					$attributes = array();
				}

				$image_id = get_post_thumbnail_id( get_the_ID(), 'full' );

				if ( in_array( 'image', $blog_post_title ) ) {
					if ( $attributes && function_exists( 'ipq_get_theme_image' ) ) {
						$output = ipq_get_theme_image(
							$image_id,
							array(
								array( $attributes['width'], $attributes['height'], $attributes['crop'] ),
							),
							sprintf(
								astra_attr(
									'article-image-blog-archive',
									array(
										'class' => '',
									)
								)
							)
						);
					}
				}
			}
			return $output;
		}

		/**
		 * Filter to add updated featured image markup with updated images sizes on Blog Post single Page.
		 *
		 * @since 1.5.0
		 * @param string $output the featured image markup for single post.
		 * @return string $output Updated featured image markup for single post.
		 */
		public function blog_single_post_featured_image( $output ) {

			$post_types = apply_filters( 'astra_single_featured_image_post_types', array( 'post' ) );

			$check_is_singular_post = is_singular( $post_types );

			if ( $check_is_singular_post ) {
				$current_post_type        = strval( get_post_type() );
				$blog_single_image_width  = astra_get_option( 'blog-single-post-image-width' );
				$blog_single_image_height = astra_get_option( 'blog-single-post-image-height' );

				$blog_single_post_structure = is_callable( 'astra_banner_elements_order' ) ? astra_get_option( 'ast-dynamic-single-' . $current_post_type . '-structure', array( 'ast-dynamic-single-' . $current_post_type . '-title', 'ast-dynamic-single-' . $current_post_type . '-breadcrumb' ) ) : astra_get_option( 'blog-single-' . $current_post_type . '-structure' );

				$attributes = array(
					'width'  => empty( $blog_single_image_width ) ? false : $blog_single_image_width,
					'height' => empty( $blog_single_image_height ) ? false : $blog_single_image_height,
					'crop'   => ( empty( $blog_single_image_width ) || empty( $blog_single_image_height ) ) ? false : true,
				);

				if ( ! $attributes['width'] && ! $attributes['height'] ) {
					$attributes = array();
				}

				$attributes = apply_filters( 'astra_single_featured_image_attributes', $attributes );

				$image_id = get_post_thumbnail_id( get_the_ID(), 'full' );

				if ( in_array( 'single-image', $blog_single_post_structure ) || in_array( 'ast-dynamic-single-' . $current_post_type . '-image', $blog_single_post_structure ) ) {

					if ( $attributes && function_exists( 'ipq_get_theme_image' ) ) {
						$output = ipq_get_theme_image(
							$image_id,
							array(
								array( $attributes['width'], $attributes['height'], $attributes['crop'] ),
							),
							sprintf(
								str_replace(
									'"',
									'',
									astra_attr(
										'article-image-blog-single-post',
										array( 'class' => '' )
									)
								)
							)
						);
					}
				}
			}
			return $output;
		}

		/**
		 * Filter to add updated featured image markup with updated images sizes on Article featured image.
		 *
		 * @since 4.4.0
		 * @param string $output the featured image markup for post article.
		 * @return string $output Updated featured image markup for post article.
		 */
		public function article_post_featured_image( $output ) {

			$post_types = apply_filters( 'astra_single_featured_image_post_types', array( 'post' ) );

			$check_is_singular_post = is_singular( $post_types );

			if ( $check_is_singular_post ) {
				$current_post_type        = strval( get_post_type() );
				$blog_single_image_width  = astra_get_option( 'blog-single-post-image-width' );
				$blog_single_image_height = astra_get_option( 'blog-single-post-image-height' );

				$attributes = array(
					'width'  => empty( $blog_single_image_width ) ? false : $blog_single_image_width,
					'height' => empty( $blog_single_image_height ) ? false : $blog_single_image_height,
					'crop'   => ( empty( $blog_single_image_width ) || empty( $blog_single_image_height ) ) ? false : true,
				);

				if ( ! $attributes['width'] && ! $attributes['height'] ) {
					$attributes = array();
				}

				$attributes = apply_filters( 'astra_single_featured_image_attributes', $attributes );

				$image_id = get_post_thumbnail_id( get_the_ID(), 'full' );

				if ( $attributes && function_exists( 'ipq_get_theme_image' ) ) {
					$output = ipq_get_theme_image(
						$image_id,
						array(
							array( $attributes['width'], $attributes['height'], $attributes['crop'] ),
						),
						sprintf(
							str_replace(
								'"',
								'',
								astra_attr(
									'article-image-blog-single-post',
									array( 'class' => '' )
								)
							)
						)
					);
				}
			}
			return $output;
		}
	}

}

if ( ! defined( 'ASTRA_BLOG_IMG_RESIZER' ) ) {
	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Blog_Pro_Images_Resizer::get_instance();
}
