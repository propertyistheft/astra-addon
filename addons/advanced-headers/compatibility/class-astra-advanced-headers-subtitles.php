<?php
/**
 * Breadcrumnbs
 *
 * @package Astra Addon
 */

if ( class_exists( 'Subtitles' ) && ! class_exists( 'Astra_Advanced_Headers_Subtitles' ) ) {

	/**
	 * Astra_Advanced_Headers_Subtitles
	 *
	 * @since 1.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Advanced_Headers_Subtitles {
		// @codingStandardsIgnoreEnd

		/**
		 * Astra_Advanced_Headers_Subtitles constructor
		 */
		public function __construct() {
			add_filter( 'astra_advanced_header_title', array( $this, 'subtitle_compatibility' ) );
		}

		/**
		 * Subtitle Plugin's Compatibility
		 *
		 * @param string $title  Normal Post/Page Title.
		 * @return string
		 */
		public function subtitle_compatibility( $title ) {

			$post_id = astra_get_post_id();
			if ( function_exists( 'get_the_subtitle' ) && '' != get_the_subtitle( $post_id ) ) {
				$output  = '<span class="entry-title-primary">' . esc_html( $title ) . '</span>';
				$output .= '<span class="entry-subtitle">' . esc_html( get_the_subtitle( $post_id ) ) . '</span>';
				return $output;
			}
			return $title;

		}
	}

	new Astra_Advanced_Headers_Subtitles();

}
