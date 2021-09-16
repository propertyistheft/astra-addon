<?php
/**
 * Advanced Header - Customizer Partials.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Customizer_Header_Sections_Partials' ) ) {

	/**
	 * Astra_Customizer_Header_Sections_Partials initial setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Customizer_Header_Sections_Partials {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() { }

		/**
		 * Render the Below Header Section 1 for the selective refresh partial.
		 *
		 * @since 1.0.0
		 */
		public static function _render_below_header_section_1() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
			return do_shortcode( astra_get_option( 'below-header-section-1-html' ) );
		}

		/**
		 * Render the Below Header Section 2 for the selective refresh partial.
		 *
		 * @since 1.0.0
		 */
		public static function _render_below_header_section_2() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
			return do_shortcode( astra_get_option( 'below-header-section-2-html' ) );
		}


		/**
		 * Render the Above Header Section 1 for the selective refresh partial.
		 *
		 * @since 1.0.0
		 */
		public static function _render_above_header_section_1_html() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
			return do_shortcode( astra_get_option( 'above-header-section-1-html' ) );
		}

		/**
		 * Render the Above Header Section 2 for the selective refresh partial.
		 *
		 * @since 1.0.0
		 */
		public static function _render_above_header_section_2_html() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
			return do_shortcode( astra_get_option( 'above-header-section-2-html' ) );
		}
	}
}
