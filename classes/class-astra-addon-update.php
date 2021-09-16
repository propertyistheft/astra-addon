<?php
/**
 * Astra Addon Update
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Addon_Update' ) ) {

	/**
	 * Astra_Addon_Update initial setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Addon_Update {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
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
		 *  Constructor
		 */
		public function __construct() {

			// Theme Updates.
			add_action( 'astra_update_before', __CLASS__ . '::init' );
		}

		/**
		 * Implement addon update logic.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public static function init() {

			do_action( 'astra_addon_update_before' );

			// Get auto saved version number.
			$saved_version = self::astra_addon_stored_version();

			// If there is no saved version in the database then return.
			if ( false === $saved_version ) {
				return;
			}

			// If equals then return.
			if ( version_compare( $saved_version, ASTRA_EXT_VER, '=' ) ) {
				return;
			}

			// Update to older version than 1.0.0-beta.6 version.
			if ( version_compare( $saved_version, '1.0.0-beta.6', '<' ) ) {
				self::v_1_0_0_beta_6();
			}

			// Update to older version than 1.0.0-beta.7 version.
			if ( version_compare( $saved_version, '1.0.0-beta.7', '<' ) ) {
				self::v_1_0_0_beta_7();
			}

			// Update to older version than 1.0.0-rc.3 version.
			if ( version_compare( $saved_version, '1.0.0-rc.3', '<' ) ) {
				self::v_1_0_0_rc_3();
			}

			// Update to older version than 1.0.0-rc.6 version.
			if ( version_compare( $saved_version, '1.0.0-rc.6', '<' ) ) {
				self::v_1_0_0_rc_6();
			}

			// Update to older version than 1.0.0-rc.7 version.
			if ( version_compare( $saved_version, '1.0.0-rc.7', '<' ) && version_compare( ASTRA_THEME_VERSION, '1.0.22', '>=' ) ) {
				self::v_1_0_0_rc_7();
			}

			// Update to older version than 1.0.0-rc.9 version.
			if ( version_compare( $saved_version, '1.0.0-rc.9', '<' ) ) {
				self::v_1_0_0_rc_9();
			}

			// Footer Widget Spacing Top/Right/Bottom/Left updated for responsive devices.
			if ( version_compare( $saved_version, '1.2.0-beta.1', '<' ) ) {
				self::v_1_2_0_beta_1();
			}
			// Site Lauout Padded layout Top/Right/Bottom/Left updated for responsive devices.
			if ( version_compare( $saved_version, '1.2.0-beta.2', '<' ) ) {
				self::v_1_2_0_beta_2();
			}
			// Update to older version than 1.2.0-beta.4 version.
			if ( version_compare( $saved_version, '1.2.0-beta.4', '<' ) ) {
				self::v_1_2_0_beta_4();
			}
			// Update to older version than 1.3.0-beta.4 version.
			if ( version_compare( $saved_version, '1.3.0-beta.4', '<' ) ) {
				self::v_1_3_0_beta_4();
			}
			// Update to older version than 1.3.0 version.
			if ( version_compare( $saved_version, '1.3.0', '<' ) ) {
				self::v_1_3_0();
			}
			// Update to older version than 1.4.0-beta.3 version.
			if ( version_compare( $saved_version, '1.4.0-beta.3', '<' ) ) {
				self::v_1_4_0_beta_3();
			}
			// Update to older version than 1.4.0-beta.4 version.
			if ( version_compare( $saved_version, '1.4.0-beta.4', '<' ) ) {
				self::v_1_4_0_beta_4();
			}

			if ( version_compare( $saved_version, '1.4.0-beta.5', '<' ) ) {
				self::v_1_4_0_beta_5();
			}

			if ( version_compare( $saved_version, '1.4.1', '<' ) ) {
				self::v_1_4_1();
			}

			if ( version_compare( $saved_version, '1.4.8', '<' ) ) {
				self::v_1_4_8();
			}

			if ( version_compare( $saved_version, '1.6.0-beta.4', '<' ) ) {
				self::v_1_6_0_beta_4();
			}

			if ( version_compare( $saved_version, '1.6.0', '<' ) ) {
				self::v_1_6_0();
			}

			if ( version_compare( $saved_version, '1.6.1', '<' ) ) {
				self::v_1_6_1();
			}

			if ( version_compare( $saved_version, '1.6.10', '<' ) ) {
				self::v_1_6_10();
			}

			if ( version_compare( $saved_version, '1.8.0-beta.1', '<' ) ) {
				self::v1_8_0();
			}

			if ( version_compare( $saved_version, '1.8.8', '<' ) ) {
				self::v1_8_8();
			}
		}

		/**
		 * Return Astra Addon saved version.
		 */
		public static function astra_addon_stored_version() {

			$theme_options = get_option( 'astra-settings' );

			$value = ( isset( $theme_options['astra-addon-auto-version'] ) && '' !== $theme_options['astra-addon-auto-version'] ) ? $theme_options['astra-addon-auto-version'] : false;

			return $value;
		}

		/**
		 * Update options of older version than 1.0.0-beta.6.
		 *
		 * @since 1.0.0-beta.6
		 * @return void
		 */
		public static function v_1_0_0_beta_6() {

			$options = array(
				'footer-adv'              => 'layout-3',
				'footer-adv-area-padding' => array(
					'top'    => 50,
					'right'  => '',
					'bottom' => 50,
					'left'   => '',
				),
			);

			// Get all supported post Types. [excluding 'page', 'post'].
			$post_types = astra_get_supported_posts();
			foreach ( $post_types as $slug => $label ) {
				$options[ 'single-' . esc_attr( $slug ) . '-content-layout' ] = 'content-boxed-container';
			}

			// Get all supported post Types which HAVE TAXONOMIES. [excluding 'page', 'post'].
			$post_types_tax = astra_get_supported_posts( true );
			foreach ( $post_types_tax as $index => $slug ) {
				$options[ 'archive-' . esc_attr( $slug ) . '-content-layout' ] = 'content-boxed-container';
			}

			$astra_options = get_option( 'astra-settings', array() );

			foreach ( $options as $key => $value ) {
				if ( ! isset( $astra_options[ $key ] ) ) {
					$astra_options[ $key ] = $value;
				}
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Update options of older version than 1.0.0-beta.7.
		 *
		 * @since 1.0.0-beta.7
		 * @return void
		 */
		public static function v_1_0_0_beta_7() {

			$options = array(
				'footer-adv' => 'disabled',
			);

			// Get all supported post Types. [excluding 'page', 'post'].
			$post_types = astra_get_supported_posts();
			foreach ( $post_types as $slug => $label ) {
				$options[ 'single-' . esc_attr( $slug ) . '-sidebar-layout' ] = 'right-sidebar';
			}

			// Get all supported post Types which HAVE TAXONOMIES. [excluding 'page', 'post'].
			$post_types_tax = astra_get_supported_posts( true );
			foreach ( $post_types_tax as $index => $slug ) {
				$options[ 'archive-' . esc_attr( $slug ) . '-sidebar-layout' ] = 'right-sidebar';
			}

			$astra_options = get_option( 'astra-settings', array() );

			foreach ( $options as $key => $value ) {
				if ( ! isset( $astra_options[ $key ] ) ) {
					$astra_options[ $key ] = $value;
				}
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Update options of older version than 1.0.0-rc.3.
		 *
		 * @since 1.0.0-rc.3
		 * @return void
		 */
		public static function v_1_0_0_rc_3() {

			$astra_options = get_option( 'astra-settings', array() );

			if ( isset( $astra_options['sticky-header-mobile'] ) && 'enabled' == $astra_options['sticky-header-mobile'] ) {
				unset( $astra_options['sticky-header-mobile'] );
				$astra_options['sticky-header-on-devices'] = 'both';
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Update options of older version than 1.0.0-rc.6.
		 *
		 * @since 1.0.0-rc.3
		 * @return void
		 */
		public static function v_1_0_0_rc_6() {

			// Get the site-wide option if we're in the network admin.
			if ( is_multisite() ) {
				$white_label = get_site_option( '_astra_ext_white_label' );
			} else {
				$white_label = get_option( '_astra_ext_white_label' );
			}

			// updated white label options.
			$updated_branding = array();
			if ( isset( $white_label['theme_name'] ) ) {
				$updated_branding['astra']['name'] = $white_label['theme_name'];
			}
			if ( isset( $white_label['theme_desc'] ) ) {
				$updated_branding['astra']['description'] = $white_label['theme_desc'];
			}
			if ( isset( $white_label['theme_author'] ) ) {
				$updated_branding['astra-agency']['author'] = $white_label['theme_author'];
			}
			if ( isset( $white_label['theme_author_url'] ) ) {
				$updated_branding['astra-agency']['author_url'] = $white_label['theme_author_url'];
			}
			if ( isset( $white_label['theme_screenshot'] ) ) {
				$updated_branding['astra']['screenshot'] = $white_label['theme_screenshot'];
			}
			if ( isset( $white_label['plugin_name'] ) ) {
				$updated_branding['astra-pro']['name'] = $white_label['plugin_name'];
			}
			if ( isset( $white_label['plugin_desc'] ) ) {
				$updated_branding['astra-pro']['description'] = $white_label['plugin_desc'];
			}

			if ( isset( $white_label['plugin_licence'] ) ) {
				$updated_branding['astra-agency']['licence'] = $white_label['plugin_licence'];
			}
			if ( isset( $white_label['hide_branding'] ) ) {
				$updated_branding['astra-agency']['hide_branding'] = $white_label['hide_branding'];
			}

			// Update the site-wide option since we're in the network admin.
			if ( is_multisite() ) {
				update_site_option( '_astra_ext_white_label', $updated_branding );
			} else {
				update_option( '_astra_ext_white_label', $updated_branding );
			}
		}

		/**
		 * Update options of older version than 1.0.0-rc.7.
		 *
		 * @since 1.0.0-rc.7
		 * @return void
		 */
		public static function v_1_0_0_rc_7() {

			$astra_options = get_option( 'astra-settings', array() );

			if ( ! empty( $astra_options['footer-bg-color'] ) && ! empty( $astra_options['footer-bg-img'] ) ) {

				$astra_options['footer-bg-color-opc'] = ! empty( $astra_options['footer-bg-color-opc'] ) ? $astra_options['footer-bg-color-opc'] : '0.8';

				$astra_options['footer-bg-color'] = astra_hex_to_rgba( $astra_options['footer-bg-color'], $astra_options['footer-bg-color-opc'] );
			}

			if ( ! empty( $astra_options['footer-adv-bg-color'] ) && ! empty( $astra_options['footer-adv-bg-img'] ) ) {

				$astra_options['footer-adv-bg-color-opac'] = ! empty( $astra_options['footer-adv-bg-color-opac'] ) ? $astra_options['footer-adv-bg-color-opac'] : '0.8';
				$astra_options['footer-adv-bg-color']      = astra_hex_to_rgba( $astra_options['footer-adv-bg-color'], $astra_options['footer-adv-bg-color-opac'] );
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Update options of older version than 1.0.0-rc.9.
		 *
		 * @since 1.0.0-rc.9
		 * @return void
		 */
		public static function v_1_0_0_rc_9() {
			$query_args = array(
				'post_type'      => 'astra-advanced-hook',
				'posts_per_page' => -1,
				'fields'         => 'ids',
			);

			$adv_hooks = new WP_Query( $query_args );
			$layouts   = $adv_hooks->posts;

			if ( is_array( $layouts ) && ! empty( $layouts ) ) {
				foreach ( $layouts as $key => $layout_id ) {

					$hook_layout = get_post_meta( $layout_id, 'ast-advanced-hook-layout', true );
					$hook_action = get_post_meta( $layout_id, 'ast-advanced-hook-action', true );

					if ( '' != $hook_action && '' == $hook_layout ) {

						update_post_meta( $layout_id, 'ast-advanced-hook-layout', 'hooks' );
					}
				}
			}

			wp_reset_postdata();
		}

		/**
		 * Update options of older version than 1.2.0-beta.1.
		 *
		 * Footer Widget Spacing Top/Right/Bottom/Left updated for responsive devices.
		 * Merge menu backward compatibility.
		 *
		 * @since 1.2.0-beta.1
		 */
		public static function v_1_2_0_beta_1() {

			$options = array(
				'footer-adv-area-padding' => array(
					'top'    => 70,
					'right'  => '',
					'bottom' => 70,
					'left'   => '',
				),
			);

			$astra_options = get_option( 'astra-settings', array() );

			if ( 0 < count( $astra_options ) ) {
				foreach ( $options as $key => $value ) {

					if ( array_key_exists( $key, $astra_options ) ) {

						$astra_options[ $key ] = array(
							'desktop'      => array(
								'top'    => $astra_options[ $key ]['top'],
								'right'  => $astra_options[ $key ]['right'],
								'bottom' => $astra_options[ $key ]['bottom'],
								'left'   => $astra_options[ $key ]['left'],
							),
							'tablet'       => array(
								'top'    => '',
								'right'  => '',
								'bottom' => '',
								'left'   => '',
							),
							'mobile'       => array(
								'top'    => '',
								'right'  => '',
								'bottom' => '',
								'left'   => '',
							),
							'desktop-unit' => 'px',
							'tablet-unit'  => 'px',
							'mobile-unit'  => 'px',
						);
					}
				}
			}

			// Above Header Merge menu backward compatibility.
			if ( ! isset( $astra_options['above-header-merge-menu'] ) ) {

				$astra_options['above-header-merge-menu'] = true;
			}
			// Above Header Merge menu backward compatibility.
			if ( ! isset( $astra_options['below-header-merge-menu'] ) ) {

				$astra_options['below-header-merge-menu'] = true;
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Update options of older version than 1.2.0-beta.2.
		 *
		 * Padded Layout Spacing Top/Right/Bottom/Left updated for responsive devices.
		 *
		 * @since 1.2.0-beta.2
		 */
		public static function v_1_2_0_beta_2() {

			$options = array(
				'site-layout-padded-pad' => array(
					'top'    => 25,
					'right'  => 50,
					'bottom' => 25,
					'left'   => 50,
				),
			);

			$astra_options = get_option( 'astra-settings', array() );

			if ( 0 < count( $astra_options ) ) {
				foreach ( $options as $key => $value ) {

					if ( array_key_exists( $key, $astra_options ) ) {

						$astra_options[ $key ] = array(
							'desktop'      => array(
								'top'    => $astra_options[ $key ]['top'],
								'right'  => $astra_options[ $key ]['right'],
								'bottom' => $astra_options[ $key ]['bottom'],
								'left'   => $astra_options[ $key ]['left'],
							),
							'tablet'       => array(
								'top'    => '',
								'right'  => '',
								'bottom' => '',
								'left'   => '',
							),
							'mobile'       => array(
								'top'    => '',
								'right'  => '',
								'bottom' => '',
								'left'   => '',
							),
							'desktop-unit' => 'px',
							'tablet-unit'  => 'px',
							'mobile-unit'  => 'px',
						);
					}
				}
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Update Sticky Header & Transparent Header Logo width options of older version than 1.2.0-beta.4.
		 *
		 * Responsive Sticky & Transparent Header Logo Width
		 *
		 * @since 1.2.0-beta.4
		 */
		public static function v_1_2_0_beta_4() {

			$astra_options = get_option( 'astra-settings', array() );
			// Trasnparent Header value to reponsive width option.
			if ( isset( $astra_options['transparent-header-logo-width'] ) && ! is_array( $astra_options['transparent-header-logo-width'] ) ) {
				$astra_options['transparent-header-logo-width'] = array(
					'desktop' => $astra_options['transparent-header-logo-width'],
					'tablet'  => '',
					'mobile'  => '',
				);
			}
			// Trasnparent Header value to reponsive width option.
			if ( isset( $astra_options['sticky-header-logo-width'] ) && ! is_array( $astra_options['sticky-header-logo-width'] ) ) {
				$astra_options['sticky-header-logo-width'] = array(
					'desktop' => $astra_options['sticky-header-logo-width'],
					'tablet'  => '',
					'mobile'  => '',
				);
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * LifterLMS custom header menu.
		 *
		 * @since 1.3.0-beta.4
		 */
		public static function v_1_3_0_beta_4() {

			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );

			if ( isset( $astra_options['header-main-rt-section'] ) && 'lifterlms' == $astra_options['header-main-rt-section'] ) {
				$astra_options['header-main-rt-section']         = 'none';
				$astra_options['lifterlms-profile-link-enabled'] = true;
			}

			update_option( ASTRA_THEME_SETTINGS, $astra_options );
		}

		/**
		 * Update options of older version than 1.3.0.
		 *
		 * Background options
		 *
		 * @since 1.3.0
		 */
		public static function v_1_3_0() {
			$astra_options = get_option( 'astra-settings', array() );

			$astra_options['header-bg-obj'] = array(
				'background-color' => isset( $astra_options['header-bg-color'] ) ? $astra_options['header-bg-color'] : '',
			);

			$astra_options['content-bg-obj'] = array(
				'background-color' => isset( $astra_options['content-bg-color'] ) ? $astra_options['content-bg-color'] : '#ffffff',
			);

			$astra_options['above-header-bg-obj'] = array(
				'background-color' => isset( $astra_options['above-header-bg-color'] ) ? $astra_options['above-header-bg-color'] : '',
			);

			$astra_options['below-header-bg-obj'] = array(
				'background-color' => isset( $astra_options['below-header-bg-color'] ) ? $astra_options['below-header-bg-color'] : '',
			);

			$astra_options['footer-adv-bg-obj'] = array(
				'background-color'      => isset( $astra_options['footer-adv-bg-color'] ) ? $astra_options['footer-adv-bg-color'] : '',
				'background-image'      => isset( $astra_options['footer-adv-bg-img'] ) ? $astra_options['footer-adv-bg-img'] : '',
				'background-repeat'     => isset( $astra_options['footer-adv-bg-repeat'] ) ? $astra_options['footer-adv-bg-repeat'] : 'no-repeat',
				'background-position'   => isset( $astra_options['footer-adv-bg-pos'] ) ? $astra_options['footer-adv-bg-pos'] : 'center center',
				'background-size'       => isset( $astra_options['footer-adv-bg-size'] ) ? $astra_options['footer-adv-bg-size'] : 'cover',
				'background-attachment' => isset( $astra_options['footer-adv-bg-attac'] ) ? $astra_options['footer-adv-bg-attac'] : 'scroll',
			);

			$astra_options['footer-bg-obj'] = array(
				'background-color'      => isset( $astra_options['footer-bg-color'] ) ? $astra_options['footer-bg-color'] : '',
				'background-image'      => isset( $astra_options['footer-bg-img'] ) ? $astra_options['footer-bg-img'] : '',
				'background-repeat'     => isset( $astra_options['footer-bg-rep'] ) ? $astra_options['footer-bg-rep'] : 'repeat',
				'background-position'   => isset( $astra_options['footer-bg-pos'] ) ? $astra_options['footer-bg-pos'] : 'center center',
				'background-size'       => isset( $astra_options['footer-bg-size'] ) ? $astra_options['footer-bg-size'] : 'auto',
				'background-attachment' => isset( $astra_options['footer-bg-atch'] ) ? $astra_options['footer-bg-atch'] : 'scroll',
			);

			// Site layout background image and color.
			$site_layout = isset( $astra_options['site-layout'] ) ? $astra_options['site-layout'] : '';
			switch ( $site_layout ) {
				case 'ast-box-layout':
						$astra_options['site-layout-outside-bg-obj'] = array(
							'background-color'      => isset( $astra_options['site-layout-outside-bg-color'] ) ? $astra_options['site-layout-outside-bg-color'] : '',
							'background-image'      => isset( $astra_options['site-layout-box-bg-img'] ) ? $astra_options['site-layout-box-bg-img'] : '',
							'background-repeat'     => isset( $astra_options['site-layout-box-bg-rep'] ) ? $astra_options['site-layout-box-bg-rep'] : 'no-repeat',
							'background-position'   => isset( $astra_options['site-layout-box-bg-pos'] ) ? $astra_options['site-layout-box-bg-pos'] : 'center center',
							'background-size'       => isset( $astra_options['site-layout-box-bg-size'] ) ? $astra_options['site-layout-box-bg-size'] : 'cover',
							'background-attachment' => isset( $astra_options['site-layout-box-bg-atch'] ) ? $astra_options['site-layout-box-bg-atch'] : 'scroll',
						);
					break;

				case 'ast-padded-layout':
						$bg_color = isset( $astra_options['site-layout-outside-bg-color'] ) ? $astra_options['site-layout-outside-bg-color'] : '';
						$bg_image = isset( $astra_options['site-layout-padded-bg-img'] ) ? $astra_options['site-layout-padded-bg-img'] : '';

						$astra_options['site-layout-outside-bg-obj'] = array(
							'background-color'      => empty( $bg_image ) ? $bg_color : '',
							'background-image'      => $bg_image,
							'background-repeat'     => isset( $astra_options['site-layout-padded-bg-rep'] ) ? $astra_options['site-layout-padded-bg-rep'] : 'no-repeat',
							'background-position'   => isset( $astra_options['site-layout-padded-bg-pos'] ) ? $astra_options['site-layout-padded-bg-pos'] : 'center center',
							'background-size'       => isset( $astra_options['site-layout-padded-bg-size'] ) ? $astra_options['site-layout-padded-bg-size'] : 'cover',
							'background-attachment' => '',
						);
					break;

				case 'ast-full-width-layout':
				case 'ast-fluid-width-layout':
				default:
						$astra_options['site-layout-outside-bg-obj'] = array(
							'background-color' => isset( $astra_options['site-layout-outside-bg-color'] ) ? $astra_options['site-layout-outside-bg-color'] : '',
						);
					break;
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Update options of older version than 1.4.0-beta.3.
		 *
		 * @since 1.4.0-beta.3
		 */
		public static function v_1_4_0_beta_3() {

			// Mobile Header - Border new param introduced for Top, Right, Bottom and left border.
			$astra_options = get_option( 'astra-settings', array() );

			if ( isset( $astra_options['mobile-header-menu-border'] ) ) {
				if ( $astra_options['mobile-header-menu-border'] ) {
					$astra_options['mobile-header-menu-all-border'] = array(
						'top'    => 1,
						'right'  => '',
						'bottom' => 1,
						'left'   => '',
					);
				} else {
						$astra_options['mobile-header-menu-all-border'] = array(
							'top'    => 0,
							'right'  => 0,
							'bottom' => 0,
							'left'   => 0,
						);
				}
			}
			if ( isset( $astra_options['mobile-above-header-menu-border'] ) ) {
				if ( $astra_options['mobile-above-header-menu-border'] ) {
					$astra_options['mobile-above-header-menu-all-border'] = array(
						'top'    => 1,
						'right'  => '',
						'bottom' => 1,
						'left'   => '',
					);
				} else {
					$astra_options['mobile-above-header-menu-all-border'] = array(
						'top'    => 0,
						'right'  => 0,
						'bottom' => 0,
						'left'   => 0,
					);
				}
			}
			if ( isset( $astra_options['mobile-below-header-menu-border'] ) ) {
				if ( $astra_options['mobile-below-header-menu-border'] ) {
					$astra_options['mobile-below-header-menu-all-border'] = array(
						'top'    => 1,
						'right'  => '',
						'bottom' => 1,
						'left'   => '',
					);
				} else {
					$astra_options['mobile-below-header-menu-all-border'] = array(
						'top'    => 0,
						'right'  => 0,
						'bottom' => 0,
						'left'   => 0,
					);
				}
			}

			update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Set different page header logo option when page header logo is set
		 *
		 * @since 1.4.0
		 */
		public static function update_header_layout_opts() {

			$query_args = array(
				'post_type'      => 'astra_adv_header',
				'posts_per_page' => -1,
				'fields'         => 'ids',
			);

			$adv_headers = new WP_Query( $query_args );

			if ( isset( $adv_headers->posts ) && ! empty( $adv_headers->posts ) ) {

				foreach ( $adv_headers->posts as $header ) {

					$adv_header_design = get_post_meta( $header, 'ast-advanced-headers-design', true );

					if ( ( isset( $adv_header_design['logo-id'] ) && '' !== $adv_header_design['logo-id'] ) || ( isset( $adv_header_design['retina-logo-id'] ) && '' !== $adv_header_design['retina-logo-id'] ) ) {

						$adv_header_opts = get_post_meta( $header, 'ast-advanced-headers-layout', true );

						$adv_header_opts['diff-header-logo'] = 'enabled';

						update_post_meta( $header, 'ast-advanced-headers-layout', $adv_header_opts );
					}
				}
			}

		}

		/**
		 * All Headers (Above Header, Primary menu and Below Header) options made responsive.
		 * All the existing value are moved inside the array
		 * All the Mobile Header Colors options are moved into the responsive option for tablet.
		 *
		 * @since 1.4.0-beta.4
		 */
		public static function v_1_4_0_beta_4() {

			$astra_options = get_option( 'astra-settings', array() );
			/**
			* All Header , Above Header, Below Header Primary Header colors updated options values
			*/
				$headers_colors_options = array(

					'header-bg-obj-responsive'             => array(
						'desktop' => array(
							'background-color'      => isset( $astra_options['header-bg-obj']['background-color'] ) ? $astra_options['header-bg-obj']['background-color'] : '',
							'background-image'      => isset( $astra_options['header-bg-obj']['background-image'] ) ? $astra_options['header-bg-obj']['background-image'] : '',
							'background-repeat'     => isset( $astra_options['header-bg-obj']['background-repeat'] ) ? $astra_options['header-bg-obj']['background-repeat'] : 'no-repeat',
							'background-position'   => isset( $astra_options['header-bg-obj']['background-position'] ) ? $astra_options['header-bg-obj']['background-position'] : 'center center',
							'background-size'       => isset( $astra_options['header-bg-obj']['background-size'] ) ? $astra_options['header-bg-obj']['background-size'] : 'cover',
							'background-attachment' => isset( $astra_options['header-bg-obj']['background-attachment'] ) ? $astra_options['header-bg-obj']['background-attachment'] : 'scroll',
						),
						'tablet'  => array(
							'background-color'      => isset( $astra_options['mobile-header-bg-obj']['background-color'] ) ? $astra_options['mobile-header-bg-obj']['background-color'] : '',
							'background-image'      => isset( $astra_options['mobile-header-bg-obj']['background-image'] ) ? $astra_options['mobile-header-bg-obj']['background-image'] : '',
							'background-repeat'     => isset( $astra_options['mobile-header-bg-obj']['background-repeat'] ) ? $astra_options['mobile-header-bg-obj']['background-repeat'] : 'no-repeat',
							'background-position'   => isset( $astra_options['mobile-header-bg-obj']['background-position'] ) ? $astra_options['mobile-header-bg-obj']['background-position'] : 'center center',
							'background-size'       => isset( $astra_options['mobile-header-bg-obj']['background-size'] ) ? $astra_options['mobile-header-bg-obj']['background-size'] : 'cover',
							'background-attachment' => isset( $astra_options['mobile-header-bg-obj']['background-attachment'] ) ? $astra_options['mobile-header-bg-obj']['background-attachment'] : 'scroll',
						),
						'mobile'  => array(
							'background-color'      => '',
							'background-image'      => '',
							'background-repeat'     => 'no-repeat',
							'background-position'   => 'center center',
							'background-size'       => 'cover',
							'background-attachment' => 'scroll',
						),
					),

					'above-header-bg-obj-responsive'       => array(
						'desktop' => array(
							'background-color'      => isset( $astra_options['above-header-bg-obj']['background-color'] ) ? $astra_options['above-header-bg-obj']['background-color'] : '',
							'background-image'      => isset( $astra_options['above-header-bg-obj']['background-image'] ) ? $astra_options['above-header-bg-obj']['background-image'] : '',
							'background-repeat'     => isset( $astra_options['above-header-bg-obj']['background-repeat'] ) ? $astra_options['above-header-bg-obj']['background-repeat'] : 'no-repeat',
							'background-position'   => isset( $astra_options['above-header-bg-obj']['background-position'] ) ? $astra_options['above-header-bg-obj']['background-position'] : 'center center',
							'background-size'       => isset( $astra_options['above-header-bg-obj']['background-size'] ) ? $astra_options['above-header-bg-obj']['background-size'] : 'cover',
							'background-attachment' => isset( $astra_options['above-header-bg-obj']['background-attachment'] ) ? $astra_options['above-header-bg-obj']['background-attachment'] : 'scroll',
						),
						'tablet'  => array(
							'background-color'      => isset( $astra_options['mobile-above-header-bg-obj']['background-color'] ) ? $astra_options['mobile-above-header-bg-obj']['background-color'] : '',
							'background-image'      => isset( $astra_options['mobile-above-header-bg-obj']['background-image'] ) ? $astra_options['mobile-above-header-bg-obj']['background-image'] : '',
							'background-repeat'     => isset( $astra_options['mobile-above-header-bg-obj']['background-repeat'] ) ? $astra_options['mobile-above-header-bg-obj']['background-repeat'] : 'no-repeat',
							'background-position'   => isset( $astra_options['mobile-above-header-bg-obj']['background-position'] ) ? $astra_options['mobile-above-header-bg-obj']['background-position'] : 'center center',
							'background-size'       => isset( $astra_options['mobile-above-header-bg-obj']['background-size'] ) ? $astra_options['mobile-above-header-bg-obj']['background-size'] : 'cover',
							'background-attachment' => isset( $astra_options['mobile-above-header-bg-obj']['background-attachment'] ) ? $astra_options['mobile-above-header-bg-obj']['background-attachment'] : 'scroll',
						),
						'mobile'  => array(
							'background-color'      => '',
							'background-image'      => '',
							'background-repeat'     => 'no-repeat',
							'background-position'   => 'center center',
							'background-size'       => 'cover',
							'background-attachment' => 'scroll',
						),
					),

					'below-header-bg-obj-responsive'       => array(
						'desktop' => array(
							'background-color'      => isset( $astra_options['below-header-bg-obj']['background-color'] ) ? $astra_options['below-header-bg-obj']['background-color'] : '#414042',
							'background-image'      => isset( $astra_options['below-header-bg-obj']['background-image'] ) ? $astra_options['below-header-bg-obj']['background-image'] : '',
							'background-repeat'     => isset( $astra_options['below-header-bg-obj']['background-repeat'] ) ? $astra_options['below-header-bg-obj']['background-repeat'] : 'no-repeat',
							'background-position'   => isset( $astra_options['below-header-bg-obj']['background-position'] ) ? $astra_options['below-header-bg-obj']['background-position'] : 'center center',
							'background-size'       => isset( $astra_options['below-header-bg-obj']['background-size'] ) ? $astra_options['below-header-bg-obj']['background-size'] : 'cover',
							'background-attachment' => isset( $astra_options['below-header-bg-obj']['background-attachment'] ) ? $astra_options['below-header-bg-obj']['background-attachment'] : 'scroll',
						),
						'tablet'  => array(
							'background-color'      => isset( $astra_options['mobile-below-header-bg-obj']['background-color'] ) ? $astra_options['mobile-below-header-bg-obj']['background-color'] : '',
							'background-image'      => isset( $astra_options['mobile-below-header-bg-obj']['background-image'] ) ? $astra_options['mobile-below-header-bg-obj']['background-image'] : '',
							'background-repeat'     => isset( $astra_options['mobile-below-header-bg-obj']['background-repeat'] ) ? $astra_options['mobile-below-header-bg-obj']['background-repeat'] : 'no-repeat',
							'background-position'   => isset( $astra_options['mobile-below-header-bg-obj']['background-position'] ) ? $astra_options['mobile-below-header-bg-obj']['background-position'] : 'center center',
							'background-size'       => isset( $astra_options['mobile-below-header-bg-obj']['background-size'] ) ? $astra_options['mobile-below-header-bg-obj']['background-size'] : 'cover',
							'background-attachment' => isset( $astra_options['mobile-below-header-bg-obj']['background-attachment'] ) ? $astra_options['mobile-below-header-bg-obj']['background-attachment'] : 'scroll',
						),
						'mobile'  => array(
							'background-color'      => '',
							'background-image'      => '',
							'background-repeat'     => 'no-repeat',
							'background-position'   => 'center center',
							'background-size'       => 'cover',
							'background-attachment' => 'scroll',
						),
					),

					'primary-menu-bg-color-responsive'     => array(
						'desktop' => isset( $astra_options['primary-menu-bg-color'] ) ? $astra_options['primary-menu-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-menu-bg-color'] ) ? $astra_options['mobile-header-menu-bg-color'] : '',
						'mobile'  => '',
					),

					'primary-menu-color-responsive'        => array(
						'desktop' => isset( $astra_options['primary-menu-color'] ) ? $astra_options['primary-menu-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-menu-color'] ) ? $astra_options['mobile-header-menu-color'] : '',
						'mobile'  => '',
					),

					'primary-menu-h-bg-color-responsive'   => array(
						'desktop' => isset( $astra_options['primary-menu-h-bg-color'] ) ? $astra_options['primary-menu-h-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-menu-h-bg-color'] ) ? $astra_options['mobile-header-menu-h-bg-color'] : '',
						'mobile'  => '',
					),

					'primary-menu-h-color-responsive'      => array(
						'desktop' => isset( $astra_options['primary-menu-h-color'] ) ? $astra_options['primary-menu-h-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-menu-h-color'] ) ? $astra_options['mobile-header-menu-h-color'] : '',
						'mobile'  => '',
					),

					'primary-menu-a-bg-color-responsive'   => array(
						'desktop' => isset( $astra_options['primary-menu-a-bg-color'] ) ? $astra_options['primary-menu-a-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-menu-a-bg-color'] ) ? $astra_options['mobile-header-menu-a-bg-color'] : '',
						'mobile'  => '',
					),

					'primary-menu-a-color-responsive'      => array(
						'desktop' => isset( $astra_options['primary-menu-a-color'] ) ? $astra_options['primary-menu-a-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-menu-a-color'] ) ? $astra_options['mobile-header-menu-a-color'] : '',
						'mobile'  => '',
					),

					'primary-submenu-bg-color-responsive'  => array(
						'desktop' => isset( $astra_options['primary-submenu-bg-color'] ) ? $astra_options['primary-submenu-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-submenu-bg-color'] ) ? $astra_options['mobile-header-submenu-bg-color'] : '',
						'mobile'  => '',
					),

					'primary-submenu-color-responsive'     => array(
						'desktop' => isset( $astra_options['primary-submenu-color'] ) ? $astra_options['primary-submenu-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-submenu-color'] ) ? $astra_options['mobile-header-submenu-color'] : '',
						'mobile'  => '',
					),

					'primary-submenu-h-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['primary-submenu-h-bg-color'] ) ? $astra_options['primary-submenu-h-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-submenu-h-bg-color'] ) ? $astra_options['mobile-header-submenu-h-bg-color'] : '',
						'mobile'  => '',
					),

					'primary-submenu-h-color-responsive'   => array(
						'desktop' => isset( $astra_options['primary-submenu-h-color'] ) ? $astra_options['primary-submenu-h-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-submenu-h-color'] ) ? $astra_options['mobile-header-submenu-h-color'] : '',
						'mobile'  => '',
					),

					'primary-submenu-a-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['primary-submenu-a-bg-color'] ) ? $astra_options['primary-submenu-a-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-submenu-a-bg-color'] ) ? $astra_options['mobile-header-submenu-a-bg-color'] : '',
						'mobile'  => '',
					),

					'primary-submenu-a-color-responsive'   => array(
						'desktop' => isset( $astra_options['primary-submenu-a-color'] ) ? $astra_options['primary-submenu-a-color'] : '',
						'tablet'  => isset( $astra_options['mobile-header-submenu-a-color'] ) ? $astra_options['mobile-header-submenu-a-color'] : '',
						'mobile'  => '',
					),

					'above-header-text-color-responsive'   => array(
						'desktop' => isset( $astra_options['above-header-text-color'] ) ? $astra_options['above-header-text-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-t-l-color'] ) ? $astra_options['mobile-above-header-t-l-color'] : '',
						'mobile'  => '',
					),

					'above-header-link-color-responsive'   => array(
						'desktop' => isset( $astra_options['above-header-link-color'] ) ? $astra_options['above-header-link-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-t-l-color'] ) ? $astra_options['mobile-above-header-t-l-color'] : '',
						'mobile'  => '',
					),

					'above-header-link-h-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-link-h-color'] ) ? $astra_options['above-header-link-h-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-t-l-hover-color'] ) ? $astra_options['mobile-above-header-t-l-hover-color'] : '',
						'mobile'  => '',
					),

					'above-header-menu-bg-color'           => array(
						'desktop' => '',
						'tablet'  => isset( $astra_options['mobile-above-header-menu-bg-color'] ) ? $astra_options['mobile-above-header-menu-bg-color'] : '',
						'mobile'  => '',
					),

					'above-header-menu-color-responsive'   => array(
						'desktop' => isset( $astra_options['above-header-menu-color'] ) ? $astra_options['above-header-menu-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-menu-color'] ) ? $astra_options['mobile-above-header-menu-color'] : '',
						'mobile'  => '',
					),

					'above-header-menu-h-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-menu-h-color'] ) ? $astra_options['above-header-menu-h-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-menu-h-color'] ) ? $astra_options['mobile-above-header-menu-h-color'] : '',
						'mobile'  => '',
					),

					'above-header-menu-h-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-menu-h-bg-color'] ) ? $astra_options['above-header-menu-h-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-menu-h-bg-color'] ) ? $astra_options['mobile-above-header-menu-h-bg-color'] : '',
						'mobile'  => '',
					),

					'above-header-menu-active-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-menu-active-color'] ) ? $astra_options['above-header-menu-active-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-menu-a-color'] ) ? $astra_options['mobile-above-header-menu-a-color'] : '',
						'mobile'  => '',
					),

					'above-header-menu-active-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-menu-active-bg-color'] ) ? $astra_options['above-header-menu-active-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-menu-a-bg-color'] ) ? $astra_options['mobile-above-header-menu-a-bg-color'] : '',
						'mobile'  => '',
					),

					'above-header-submenu-text-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-submenu-text-color'] ) ? $astra_options['above-header-submenu-text-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-submenu-color'] ) ? $astra_options['mobile-above-header-submenu-color'] : '',
						'mobile'  => '',
					),

					'above-header-submenu-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-submenu-bg-color'] ) ? $astra_options['above-header-submenu-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-submenu-bg-color'] ) ? $astra_options['mobile-above-header-submenu-bg-color'] : '',
						'mobile'  => '',
					),

					'above-header-submenu-hover-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-submenu-hover-color'] ) ? $astra_options['above-header-submenu-hover-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-submenu-h-color'] ) ? $astra_options['mobile-above-header-submenu-h-color'] : '',
						'mobile'  => '',
					),

					'above-header-submenu-bg-hover-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-submenu-bg-hover-color'] ) ? $astra_options['above-header-submenu-bg-hover-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-submenu-h-bg-color'] ) ? $astra_options['mobile-above-header-submenu-h-bg-color'] : '',
						'mobile'  => '',
					),

					'above-header-submenu-active-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-submenu-active-color'] ) ? $astra_options['above-header-submenu-active-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-submenu-a-color'] ) ? $astra_options['mobile-above-header-submenu-a-color'] : '',
						'mobile'  => '',
					),

					'above-header-submenu-active-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['above-header-submenu-active-bg-color'] ) ? $astra_options['above-header-submenu-active-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-above-header-submenu-a-bg-color'] ) ? $astra_options['mobile-above-header-submenu-a-bg-color'] : '',
						'mobile'  => '',
					),

					'below-header-text-color-responsive'   => array(
						'desktop' => isset( $astra_options['below-header-text-color'] ) ? $astra_options['below-header-text-color'] : '#ffffff',
						'tablet'  => isset( $astra_options['mobile-below-header-t-l-color'] ) ? $astra_options['mobile-below-header-t-l-color'] : '',
						'mobile'  => '',
					),

					'below-header-link-hover-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-link-hover-color'] ) ? $astra_options['below-header-link-hover-color'] : '#ffffff',
						'tablet'  => isset( $astra_options['mobile-below-header-t-l-hover-color'] ) ? $astra_options['mobile-below-header-t-l-hover-color'] : '',
						'mobile'  => '',
					),

					'below-header-link-color-responsive'   => array(
						'desktop' => isset( $astra_options['below-header-link-color'] ) ? $astra_options['below-header-link-color'] : '#ffffff',
						'tablet'  => isset( $astra_options['mobile-below-header-t-l-color'] ) ? $astra_options['mobile-below-header-t-l-color'] : '',
						'mobile'  => '',
					),

					'below-header-menu-text-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-menu-text-color'] ) ? $astra_options['below-header-menu-text-color'] : '#ffffff',
						'tablet'  => isset( $astra_options['mobile-below-header-menu-color'] ) ? $astra_options['mobile-below-header-menu-color'] : '',
						'mobile'  => '',
					),

					'below-header-menu-text-hover-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-menu-text-hover-color'] ) ? $astra_options['below-header-menu-text-hover-color'] : '#ffffff',
						'tablet'  => isset( $astra_options['mobile-below-header-menu-h-color'] ) ? $astra_options['mobile-below-header-menu-h-color'] : '',
						'mobile'  => '',
					),

					'below-header-menu-bg-hover-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-menu-bg-hover-color'] ) ? $astra_options['below-header-menu-bg-hover-color'] : '#575757',
						'tablet'  => isset( $astra_options['mobile-below-header-menu-h-bg-color'] ) ? $astra_options['mobile-below-header-menu-h-bg-color'] : '',
						'mobile'  => '',
					),

					'below-header-current-menu-text-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-current-menu-text-color'] ) ? $astra_options['below-header-current-menu-text-color'] : '#ffffff',
						'tablet'  => isset( $astra_options['mobile-below-header-menu-a-color'] ) ? $astra_options['mobile-below-header-menu-a-color'] : '',
						'mobile'  => '',
					),

					'below-header-current-menu-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-current-menu-bg-color'] ) ? $astra_options['below-header-current-menu-bg-color'] : '#575757',
						'tablet'  => isset( $astra_options['mobile-below-header-menu-a-bg-color'] ) ? $astra_options['mobile-below-header-menu-a-bg-color'] : '',
						'mobile'  => '',
					),

					'below-header-submenu-text-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-submenu-text-color'] ) ? $astra_options['below-header-submenu-text-color'] : '',
						'tablet'  => isset( $astra_options['mobile-below-header-submenu-color'] ) ? $astra_options['mobile-below-header-submenu-color'] : '',
						'mobile'  => '',
					),

					'below-header-submenu-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-submenu-bg-color'] ) ? $astra_options['below-header-submenu-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-below-header-submenu-bg-color'] ) ? $astra_options['mobile-below-header-submenu-bg-color'] : '',
						'mobile'  => '',
					),

					'below-header-submenu-hover-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-submenu-hover-color'] ) ? $astra_options['below-header-submenu-hover-color'] : '',
						'tablet'  => isset( $astra_options['mobile-below-header-submenu-h-color'] ) ? $astra_options['mobile-below-header-submenu-h-color'] : '',
						'mobile'  => '',
					),

					'below-header-submenu-bg-hover-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-submenu-bg-hover-color'] ) ? $astra_options['below-header-submenu-bg-hover-color'] : '',
						'tablet'  => isset( $astra_options['mobile-below-header-submenu-h-bg-color'] ) ? $astra_options['mobile-below-header-submenu-h-bg-color'] : '',
						'mobile'  => '',
					),

					'below-header-submenu-active-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-submenu-active-color'] ) ? $astra_options['below-header-submenu-active-color'] : '',
						'tablet'  => isset( $astra_options['mobile-below-header-submenu-a-color'] ) ? $astra_options['mobile-below-header-submenu-a-color'] : '',
						'mobile'  => '',
					),

					'below-header-submenu-active-bg-color-responsive' => array(
						'desktop' => isset( $astra_options['below-header-submenu-active-bg-color'] ) ? $astra_options['below-header-submenu-active-bg-color'] : '',
						'tablet'  => isset( $astra_options['mobile-below-header-submenu-a-bg-color'] ) ? $astra_options['mobile-below-header-submenu-a-bg-color'] : '',
						'mobile'  => '',
					),
				);

				// Merge customizer options with old options.
				$astra_options = wp_parse_args( $headers_colors_options, $astra_options );

				// Unset all color options which is no longer used.
				$mobile_color_options = array(
					'mobile-header-bg-obj',
					'mobile-above-header-bg-obj',
					'mobile-below-header-bg-obj',

					'mobile-header-menu-bg-color',
					'mobile-header-menu-color',
					'mobile-header-menu-h-bg-color',
					'mobile-header-menu-h-color',
					'mobile-header-menu-a-bg-color',
					'mobile-header-menu-a-color',
					'mobile-header-submenu-bg-color',
					'mobile-header-submenu-color',
					'mobile-header-submenu-h-bg-color',
					'mobile-header-submenu-h-color',
					'mobile-header-submenu-a-bg-color',
					'mobile-header-submenu-a-color',

					'mobile-above-header-t-l-color',
					'mobile-above-header-t-l-color',
					'mobile-above-header-t-l-hover-color',
					'mobile-above-header-menu-bg-color',
					'mobile-above-header-menu-color',
					'mobile-above-header-menu-h-color',
					'mobile-above-header-menu-h-bg-color',
					'mobile-above-header-menu-a-color',
					'mobile-above-header-menu-a-bg-color',
					'mobile-above-header-submenu-color',
					'mobile-above-header-submenu-bg-color',
					'mobile-above-header-submenu-h-color',
					'mobile-above-header-submenu-h-bg-color',
					'mobile-above-header-submenu-a-color',
					'mobile-above-header-submenu-a-bg-color',

					'mobile-below-header-t-l-color',
					'mobile-below-header-t-l-hover-color',
					'mobile-below-header-t-l-color',
					'mobile-below-header-menu-bg-color',
					'mobile-below-header-menu-color',
					'mobile-below-header-menu-h-color',
					'mobile-below-header-menu-h-bg-color',
					'mobile-below-header-menu-a-color',
					'mobile-below-header-menu-a-bg-color',
					'mobile-below-header-submenu-color',
					'mobile-below-header-submenu-bg-color',
					'mobile-below-header-submenu-h-color',
					'mobile-below-header-submenu-h-bg-color',
					'mobile-below-header-submenu-a-color',
					'mobile-below-header-submenu-a-bg-color',
				);
				foreach ( $mobile_color_options as $key => $value ) {
					if ( array_key_exists( $value, $astra_options ) ) {
						unset( $astra_options[ $value ] );
					}
				}

				$sticky_logo = ( isset( $astra_options['sticky-header-logo'] ) && '' !== $astra_options['sticky-header-logo'] ) ? $astra_options['sticky-header-logo'] : false;

				$sticky_rt_logo = ( isset( $astra_options['sticky-header-retina-logo'] ) && '' !== $astra_options['sticky-header-retina-logo'] ) ? $astra_options['sticky-header-retina-logo'] : false;

				$transparent_logo = ( isset( $astra_options['transparent-header-logo'] ) && '' !== $astra_options['transparent-header-logo'] ) ? $astra_options['transparent-header-logo'] : false;

				$transparent_rt_logo = ( isset( $astra_options['transparent-header-retina-logo'] ) && '' !== $astra_options['transparent-header-retina-logo'] ) ? $astra_options['transparent-header-retina-logo'] : false;

				if ( '' != $sticky_logo || '' != $sticky_rt_logo ) {
					$astra_options['different-sticky-logo'] = '1';
				}

				if ( '' != $transparent_rt_logo || '' != $transparent_logo ) {
					$astra_options['different-transparent-logo'] = '1';
				}

				update_option( 'astra-settings', $astra_options );
		}

		/**
		 * Update options of older version than 1.4.0-beta.5
		 *
		 * Mobile header alignment options
		 * Primary Menu, Above Header Menu and Below Header menu background color moved into
		 * responsive background image option
		 *
		 * @since 1.4.0-beta.5
		 */
		public static function v_1_4_0_beta_5() {

			$astra_options = get_option( 'astra-settings', array() );

			if ( ! isset( $astra_options['above-header-menu-align'] ) ) {
				$astra_options['above-header-menu-align'] = 'inline';
			}

			if ( ! isset( $astra_options['below-header-menu-align'] ) ) {
				$astra_options['below-header-menu-align'] = 'inline';
			}

			// Primary menu background color.
			if ( isset( $astra_options['primary-menu-bg-color-responsive']['desktop'] ) ) {
				$astra_options['primary-menu-bg-obj-responsive']['desktop'] = array(
					'background-color'      => $astra_options['primary-menu-bg-color-responsive']['desktop'],
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				);
			}
			if ( isset( $astra_options['primary-menu-bg-color-responsive']['tablet'] ) ) {
				$astra_options['primary-menu-bg-obj-responsive']['tablet'] = array(
					'background-color'      => $astra_options['primary-menu-bg-color-responsive']['tablet'],
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				);
			}
			if ( isset( $astra_options['primary-menu-bg-color-responsive']['mobile'] ) ) {
				$astra_options['primary-menu-bg-obj-responsive']['mobile'] = array(
					'background-color'      => $astra_options['primary-menu-bg-color-responsive']['mobile'],
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				);
			}

			// Above header menu background color.
			if ( isset( $astra_options['above-header-menu-bg-color']['desktop'] ) ) {
				$astra_options['above-header-menu-bg-obj-responsive']['desktop'] = array(
					'background-color'      => $astra_options['above-header-menu-bg-color']['desktop'],
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				);

			}
			if ( isset( $astra_options['above-header-menu-bg-color']['tablet'] ) ) {
				$astra_options['above-header-menu-bg-obj-responsive']['tablet'] = array(
					'background-color'      => $astra_options['above-header-menu-bg-color']['tablet'],
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				);
			}
			if ( isset( $astra_options['above-header-menu-bg-color']['mobile'] ) ) {
				$astra_options['above-header-menu-bg-obj-responsive']['mobile'] = array(
					'background-color'      => $astra_options['above-header-menu-bg-color']['mobile'],
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				);
			}

			// Below header menu background color.
			if ( isset( $astra_options['below-header-menu-bg-color']['desktop'] ) ) {
					$astra_options['below-header-menu-bg-obj-responsive']['desktop'] = array(
						'background-color'      => $astra_options['below-header-menu-bg-color']['desktop'],
						'background-image'      => '',
						'background-repeat'     => 'no-repeat',
						'background-position'   => 'center center',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
					);
			}
			if ( isset( $astra_options['below-header-menu-bg-color']['tablet'] ) ) {
				$astra_options['below-header-menu-bg-obj-responsive']['tablet'] = array(
					'background-color'      => $astra_options['below-header-menu-bg-color']['tablet'],
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				);
			}
			if ( isset( $astra_options['below-header-menu-bg-color']['mobile'] ) ) {
				$astra_options['below-header-menu-bg-obj-responsive']['mobile'] = array(
					'background-color'      => $astra_options['below-header-menu-bg-color']['mobile'],
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				);
			}

			// Set Above Header menu style fill for older version users.
			if ( ! isset( $astra_options['mobile-above-header-toggle-btn-style'] ) ) {
				$astra_options['mobile-above-header-toggle-btn-style'] = 'fill';
			}

			// Set Below Header menu style fill for older version users.
			if ( ! isset( $astra_options['mobile-below-header-toggle-btn-style'] ) ) {
				$astra_options['mobile-below-header-toggle-btn-style'] = 'fill';
			}

			update_option( 'astra-settings', $astra_options );

			self::update_header_layout_opts();
		}

		/**
		 * Update options of older version than 1.4.1
		 *
		 * Sticky Header options
		 * Primary Menu, Above Header Menu and Below Header menu colors moved into
		 * Sticky Header colors
		 *
		 * Transparent Header colors options migrate to respective responsive keys
		 *
		 * 1) Set the new option `different-sticky-retina-logo` to true for users who are already using a sticky header retina logo.
		 * 2) Set the new option `different-transparent-retina-logo` to true for users who are already using a transparent header retina logo.
		 * 3) Set the new option `different-retina-logo` to true for users who are already using a advanced header retina logo.
		 *
		 * @since 1.4.1
		 */
		public static function v_1_4_1() {
			$astra_options         = get_option( 'astra-settings', array() );
			$sticky_header_opacity = isset( $astra_options['sticky-header-bg-opc'] ) ? $astra_options['sticky-header-bg-opc'] : 1;
			$updated_options       = array(
				'sticky-header-color-site-title-responsive' => array(
					'desktop' => ( isset( $astra_options['header-color-site-title'] ) ) ? $astra_options['header-color-site-title'] : '',
					'tablet'  => '',
					'mobile'  => '',
				),
				'sticky-header-color-site-tagline-responsive' => array(
					'desktop' => ( isset( $astra_options['header-color-h-site-title'] ) ) ? $astra_options['header-color-h-site-title'] : '',
					'tablet'  => '',
					'mobile'  => '',
				),
				'sticky-header-color-h-site-title-responsive' => array(
					'desktop' => ( isset( $astra_options['header-color-site-tagline'] ) ) ? $astra_options['header-color-site-tagline'] : '',
					'tablet'  => '',
					'mobile'  => '',
				),
				'sticky-header-bg-color-responsive'        => array(
					'desktop' => ( ! empty( $astra_options['header-bg-obj-responsive']['desktop']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['header-bg-obj-responsive']['desktop']['background'] ), $sticky_header_opacity ) : astra_hex_to_rgba( '#ffffff', $sticky_header_opacity ),
					'tablet'  => ( ! empty( $astra_options['header-bg-obj-responsive']['tablet']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['header-bg-obj-responsive']['tablet']['background'] ), $sticky_header_opacity ) : '',
					'mobile'  => ( ! empty( $astra_options['header-bg-obj-responsive']['mobile']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['header-bg-obj-responsive']['mobile']['background'] ), $sticky_header_opacity ) : '',
				),
				'sticky-header-menu-bg-color-responsive'   => array(
					'desktop' => ( ! empty( $astra_options['primary-menu-bg-obj-responsive']['desktop']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['primary-menu-bg-obj-responsive']['desktop']['background-color'] ), $sticky_header_opacity ) : '',
					'tablet'  => ( ! empty( $astra_options['primary-menu-bg-obj-responsive']['tablet']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['primary-menu-bg-obj-responsive']['tablet']['background-color'] ), $sticky_header_opacity ) : '',
					'mobile'  => ( ! empty( $astra_options['primary-menu-bg-obj-responsive']['mobile']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['primary-menu-bg-obj-responsive']['mobile']['background-color'] ), $sticky_header_opacity ) : '',
				),
				'sticky-header-menu-color-responsive'      => array(
					'desktop' => ( isset( $astra_options['primary-menu-color-responsive']['desktop'] ) ) ? $astra_options['primary-menu-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['primary-menu-color-responsive']['tablet'] ) ) ? $astra_options['primary-menu-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['primary-menu-color-responsive']['mobile'] ) ) ? $astra_options['primary-menu-color-responsive']['mobile'] : '',
				),
				'sticky-header-menu-h-color-responsive'    => array(
					'desktop' => ( isset( $astra_options['primary-menu-h-color-responsive']['desktop'] ) ) ? $astra_options['primary-menu-h-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['primary-menu-h-color-responsive']['tablet'] ) ) ? $astra_options['primary-menu-h-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['primary-menu-h-color-responsive']['mobile'] ) ) ? $astra_options['primary-menu-h-color-responsive']['mobile'] : '',
				),
				'sticky-header-menu-h-a-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['primary-menu-h-bg-color-responsive']['desktop'] ) ) ? $astra_options['primary-menu-h-bg-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['primary-menu-h-bg-color-responsive']['tablet'] ) ) ? $astra_options['primary-menu-h-bg-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['primary-menu-h-bg-color-responsive']['mobile'] ) ) ? $astra_options['primary-menu-h-bg-color-responsive']['mobile'] : '',
				),
				'sticky-header-submenu-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['primary-submenu-bg-color-responsive']['desktop'] ) ) ? $astra_options['primary-submenu-bg-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['primary-submenu-bg-color-responsive']['tablet'] ) ) ? $astra_options['primary-submenu-bg-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['primary-submenu-bg-color-responsive']['mobile'] ) ) ? $astra_options['primary-submenu-bg-color-responsive']['mobile'] : '',
				),
				'sticky-header-submenu-color-responsive'   => array(
					'desktop' => ( isset( $astra_options['primary-submenu-color-responsive']['desktop'] ) ) ? $astra_options['primary-submenu-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['primary-submenu-color-responsive']['tablet'] ) ) ? $astra_options['primary-submenu-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['primary-submenu-color-responsive']['mobile'] ) ) ? $astra_options['primary-submenu-color-responsive']['mobile'] : '',
				),
				'sticky-header-submenu-h-color-responsive' => array(
					'desktop' => ( isset( $astra_options['primary-submenu-h-color-responsive']['desktop'] ) ) ? $astra_options['primary-submenu-h-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['primary-submenu-h-color-responsive']['tablet'] ) ) ? $astra_options['primary-submenu-h-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['primary-submenu-h-color-responsive']['mobile'] ) ) ? $astra_options['primary-submenu-h-color-responsive']['mobile'] : '',
				),
				'sticky-header-submenu-h-a-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['primary-submenu-h-bg-color-responsive']['desktop'] ) ) ? $astra_options['primary-submenu-h-bg-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['primary-submenu-h-bg-color-responsive']['tablet'] ) ) ? $astra_options['primary-submenu-h-bg-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['primary-submenu-h-bg-color-responsive']['mobile'] ) ) ? $astra_options['primary-submenu-h-bg-color-responsive']['mobile'] : '',
				),

				// Below header.
				'sticky-below-header-bg-color-responsive'  => array(
					'desktop' => ( ! empty( $astra_options['below-header-bg-obj-responsive']['desktop']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['below-header-bg-obj-responsive']['desktop']['background'] ), $sticky_header_opacity ) : astra_hex_to_rgba( '#414042', $sticky_header_opacity ),
					'tablet'  => ( ! empty( $astra_options['below-header-bg-obj-responsive']['tablet']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['below-header-bg-obj-responsive']['tablet']['background'] ), $sticky_header_opacity ) : '',
					'mobile'  => ( ! empty( $astra_options['below-header-bg-obj-responsive']['mobile']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['below-header-bg-obj-responsive']['mobile']['background'] ), $sticky_header_opacity ) : '',
				),
				'sticky-below-header-menu-bg-color-responsive' => array(
					'desktop' => ( ! empty( $astra_options['below-header-menu-bg-obj-responsive']['desktop']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['below-header-menu-bg-obj-responsive']['desktop']['background-color'] ), $sticky_header_opacity ) : '',
					'tablet'  => ( ! empty( $astra_options['below-header-menu-bg-obj-responsive']['tablet']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['below-header-menu-bg-obj-responsive']['tablet']['background-color'] ), $sticky_header_opacity ) : '',
					'mobile'  => ( ! empty( $astra_options['below-header-menu-bg-obj-responsive']['mobile']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['below-header-menu-bg-obj-responsive']['mobile']['background-color'] ), $sticky_header_opacity ) : '',
				),
				'sticky-below-header-menu-color-responsive' => array(
					'desktop' => ( isset( $astra_options['below-header-menu-text-color-responsive']['desktop'] ) ) ? $astra_options['below-header-menu-text-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['below-header-menu-text-color-responsive']['tablet'] ) ) ? $astra_options['below-header-menu-text-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['below-header-menu-text-color-responsive']['mobile'] ) ) ? $astra_options['below-header-menu-text-color-responsive']['mobile'] : '',
				),
				'sticky-below-header-menu-h-color-responsive' => array(
					'desktop' => ( isset( $astra_options['below-header-menu-text-hover-color-responsive']['desktop'] ) ) ? $astra_options['below-header-menu-text-hover-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['below-header-menu-text-hover-color-responsive']['tablet'] ) ) ? $astra_options['below-header-menu-text-hover-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['below-header-menu-text-hover-color-responsive']['mobile'] ) ) ? $astra_options['below-header-menu-text-hover-color-responsive']['mobile'] : '',
				),
				'sticky-below-header-menu-h-a-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['below-header-menu-bg-hover-color-responsive']['desktop'] ) ) ? $astra_options['below-header-menu-bg-hover-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['below-header-menu-bg-hover-color-responsive']['tablet'] ) ) ? $astra_options['below-header-menu-bg-hover-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['below-header-menu-bg-hover-color-responsive']['mobile'] ) ) ? $astra_options['below-header-menu-bg-hover-color-responsive']['mobile'] : '',
				),
				'sticky-below-header-submenu-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['below-header-submenu-bg-color-responsive']['desktop'] ) ) ? $astra_options['below-header-submenu-bg-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['below-header-submenu-bg-color-responsive']['tablet'] ) ) ? $astra_options['below-header-submenu-bg-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['below-header-submenu-bg-color-responsive']['mobile'] ) ) ? $astra_options['below-header-submenu-bg-color-responsive']['mobile'] : '',
				),
				'sticky-below-header-submenu-color-responsive' => array(
					'desktop' => ( isset( $astra_options['below-header-submenu-text-color-responsive']['desktop'] ) ) ? $astra_options['below-header-submenu-text-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['below-header-submenu-text-color-responsive']['tablet'] ) ) ? $astra_options['below-header-submenu-text-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['below-header-submenu-text-color-responsive']['mobile'] ) ) ? $astra_options['below-header-submenu-text-color-responsive']['mobile'] : '',
				),
				'sticky-below-header-submenu-h-color-responsive' => array(
					'desktop' => ( isset( $astra_options['below-header-submenu-hover-color-responsive']['desktop'] ) ) ? $astra_options['below-header-submenu-hover-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['below-header-submenu-hover-color-responsive']['tablet'] ) ) ? $astra_options['below-header-submenu-hover-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['below-header-submenu-hover-color-responsive']['mobile'] ) ) ? $astra_options['below-header-submenu-hover-color-responsive']['mobile'] : '',
				),
				'sticky-below-header-submenu-h-a-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['below-header-submenu-bg-hover-color-responsive']['desktop'] ) ) ? $astra_options['below-header-submenu-bg-hover-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['below-header-submenu-bg-hover-color-responsive']['tablet'] ) ) ? $astra_options['below-header-submenu-bg-hover-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['below-header-submenu-bg-hover-color-responsive']['mobile'] ) ) ? $astra_options['below-header-submenu-bg-hover-color-responsive']['mobile'] : '',
				),

				// Above header.
				'sticky-above-header-bg-color-responsive'  => array(
					'desktop' => ( ! empty( $astra_options['above-header-bg-obj-responsive']['desktop']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['above-header-bg-obj-responsive']['desktop']['background'] ), $sticky_header_opacity ) : astra_hex_to_rgba( '#ffffff', $sticky_header_opacity ),
					'tablet'  => ( ! empty( $astra_options['above-header-bg-obj-responsive']['tablet']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['above-header-bg-obj-responsive']['tablet']['background'] ), $sticky_header_opacity ) : '',
					'mobile'  => ( ! empty( $astra_options['above-header-bg-obj-responsive']['mobile']['background'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['above-header-bg-obj-responsive']['mobile']['background'] ), $sticky_header_opacity ) : '',
				),
				'sticky-above-header-menu-bg-color-responsive' => array(
					'desktop' => ( ! empty( $astra_options['above-header-menu-bg-obj-responsive']['desktop']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['above-header-menu-bg-obj-responsive']['desktop']['background-color'] ), $sticky_header_opacity ) : '',
					'tablet'  => ( ! empty( $astra_options['above-header-menu-bg-obj-responsive']['tablet']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['above-header-menu-bg-obj-responsive']['tablet']['background-color'] ), $sticky_header_opacity ) : '',
					'mobile'  => ( ! empty( $astra_options['above-header-menu-bg-obj-responsive']['mobile']['background-color'] ) ) ? astra_hex_to_rgba( astra_rgba2hex( $astra_options['above-header-menu-bg-obj-responsive']['mobile']['background-color'] ), $sticky_header_opacity ) : '',
				),
				'sticky-above-header-menu-color-responsive' => array(
					'desktop' => ( isset( $astra_options['above-header-menu-color-responsive']['desktop'] ) ) ? $astra_options['above-header-menu-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['above-header-menu-color-responsive']['tablet'] ) ) ? $astra_options['above-header-menu-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['above-header-menu-color-responsive']['mobile'] ) ) ? $astra_options['above-header-menu-color-responsive']['mobile'] : '',
				),
				'sticky-above-header-menu-h-color-responsive' => array(
					'desktop' => ( isset( $astra_options['above-header-menu-h-color-responsive']['desktop'] ) ) ? $astra_options['above-header-menu-h-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['above-header-menu-h-color-responsive']['tablet'] ) ) ? $astra_options['above-header-menu-h-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['above-header-menu-h-color-responsive']['mobile'] ) ) ? $astra_options['above-header-menu-h-color-responsive']['mobile'] : '',
				),
				'sticky-above-header-menu-h-a-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['above-header-menu-h-bg-color-responsive']['desktop'] ) ) ? $astra_options['above-header-menu-h-bg-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['above-header-menu-h-bg-color-responsive']['tablet'] ) ) ? $astra_options['above-header-menu-h-bg-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['above-header-menu-h-bg-color-responsive']['mobile'] ) ) ? $astra_options['above-header-menu-h-bg-color-responsive']['mobile'] : '',
				),
				'sticky-above-header-submenu-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['above-header-submenu-bg-color-responsive']['desktop'] ) ) ? $astra_options['above-header-submenu-bg-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['above-header-submenu-bg-color-responsive']['tablet'] ) ) ? $astra_options['above-header-submenu-bg-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['above-header-submenu-bg-color-responsive']['mobile'] ) ) ? $astra_options['above-header-submenu-bg-color-responsive']['mobile'] : '',
				),
				'sticky-above-header-submenu-color-responsive' => array(
					'desktop' => ( isset( $astra_options['above-header-submenu-text-color-responsive']['desktop'] ) ) ? $astra_options['above-header-submenu-text-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['above-header-submenu-text-color-responsive']['tablet'] ) ) ? $astra_options['above-header-submenu-text-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['above-header-submenu-text-color-responsive']['mobile'] ) ) ? $astra_options['above-header-submenu-text-color-responsive']['mobile'] : '',
				),
				'sticky-above-header-submenu-h-color-responsive' => array(
					'desktop' => ( isset( $astra_options['above-header-submenu-hover-color-responsive']['desktop'] ) ) ? $astra_options['above-header-submenu-hover-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['above-header-submenu-hover-color-responsive']['tablet'] ) ) ? $astra_options['above-header-submenu-hover-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['above-header-submenu-hover-color-responsive']['mobile'] ) ) ? $astra_options['above-header-submenu-hover-color-responsive']['mobile'] : '',
				),
				'sticky-above-header-submenu-h-a-bg-color-responsive' => array(
					'desktop' => ( isset( $astra_options['above-header-submenu-bg-hover-color-responsive']['desktop'] ) ) ? $astra_options['above-header-submenu-bg-hover-color-responsive']['desktop'] : '',
					'tablet'  => ( isset( $astra_options['above-header-submenu-bg-hover-color-responsive']['tablet'] ) ) ? $astra_options['above-header-submenu-bg-hover-color-responsive']['tablet'] : '',
					'mobile'  => ( isset( $astra_options['above-header-submenu-bg-hover-color-responsive']['mobile'] ) ) ? $astra_options['above-header-submenu-bg-hover-color-responsive']['mobile'] : '',
				),
				// Transparent Header Colors.
				'transparent-header-bg-color-responsive'   => array(
					'desktop' => ( isset( $astra_options['transparent-header-bg-color'] ) ? $astra_options['transparent-header-bg-color'] : '' ),
					'tablet'  => '',
					'mobile'  => '',
				),
				'transparent-header-color-site-title-responsive' => array(
					'desktop' => isset( $astra_options['transparent-header-color-site-title'] ) ? $astra_options['transparent-header-color-site-title'] : '',
					'tablet'  => '',
					'mobile'  => '',
				),
				'transparent-header-color-h-site-title-responsive' => array(
					'desktop' => isset( $astra_options['transparent-header-color-h-site-title'] ) ? $astra_options['transparent-header-color-h-site-title'] : '',
					'tablet'  => '',
					'mobile'  => '',
				),
				'transparent-menu-bg-color-responsive'     => array(
					'desktop' => isset( $astra_options['transparent-menu-bg-color'] ) ? $astra_options['transparent-menu-bg-color'] : '',
					'tablet'  => '',
					'mobile'  => '',
				),
				'transparent-menu-color-responsive'        => array(
					'desktop' => isset( $astra_options['transparent-menu-color'] ) ? $astra_options['transparent-menu-color'] : '',
					'tablet'  => '',
					'mobile'  => '',
				),
				'transparent-menu-h-color-responsive'      => array(
					'desktop' => isset( $astra_options['transparent-menu-h-color'] ) ? $astra_options['transparent-menu-h-color'] : '',
					'tablet'  => '',
					'mobile'  => '',
				),
				'different-sticky-retina-logo'             => ( isset( $astra_options['sticky-header-retina-logo'] ) && '' != $astra_options['sticky-header-retina-logo'] ) ? '1' : false,
				'different-transparent-retina-logo'        => ( isset( $astra_options['transparent-header-retina-logo'] ) && '' != $astra_options['transparent-header-retina-logo'] ) ? '1' : false,

			);

			// Merge customizer options with old options.
			$astra_options = wp_parse_args( $updated_options, $astra_options );
			update_option( 'astra-settings', $astra_options );

			// Page Header different retina logo.
			$args = array(
				'post_type'      => 'astra_adv_header',

				// Query performance optimization.
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'post_status'    => 'any',
				'posts_per_page' => 200, // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page

			);

			$query = new WP_Query( $args );

			$post_ids = (array) $query->posts;
			foreach ( $post_ids as $key => $post_id ) {

				$ast_advanced_headers_design = get_post_meta( $post_id, 'ast-advanced-headers-design', true );

				if ( '' !== $ast_advanced_headers_design['retina-logo-url'] ) {

					$ast_advanced_headers_layout                            = get_post_meta( $post_id, 'ast-advanced-headers-layout', true );
					$ast_advanced_headers_layout['diff-header-retina-logo'] = 'enabled';

					update_post_meta( $post_id, 'ast-advanced-headers-layout', $ast_advanced_headers_layout );
				}
			}

		}

		/**
		 * Update options when updating to v1.4.8
		 *
		 * Typography addon don't include typography CSS for annchors inside headings.
		 *
		 * @return void
		 */
		public static function v_1_4_8() {
			$theme_options = get_option( 'astra-settings' );

			// Set flag to use anchors CSS selectors in the CSS for headings.
			if ( ! isset( $theme_options['include-headings-in-typography'] ) ) {
				$theme_options['include-headings-in-typography'] = true;
				update_option( 'astra-settings', $theme_options );
			}
		}

		/**
		 * Update options when updating to v1.6.0-beta.4
		 * Header Sections Submenu Border width
		 * Header Sections Pointer animation default value
		 *
		 * @return void
		 */
		public static function v_1_6_0_beta_4() {

			$border_disabled_values        = array(
				'top'    => '0',
				'bottom' => '0',
				'left'   => '0',
				'right'  => '0',
			);
			$inside_border_disabled_values = array(
				'bottom' => '0',
			);
			$border_enabled_values         = array(
				'top'    => '1',
				'bottom' => '1',
				'left'   => '1',
				'right'  => '1',
			);
			$inside_border_enabled_values  = array(
				'bottom' => '1',
			);

			$theme_options = get_option( 'astra-settings' );

			$above_submenu_border = isset( $theme_options['above-header-submenu-border'] ) ? $theme_options['above-header-submenu-border'] : true;
			$below_submenu_border = isset( $theme_options['below-header-submenu-border'] ) ? $theme_options['below-header-submenu-border'] : true;

			// Above Header.
			if ( $above_submenu_border ) {
				$theme_options['above-header-submenu-border']      = $border_enabled_values;
				$theme_options['above-header-submenu-item-border'] = $inside_border_enabled_values;
			} else {
				$theme_options['above-header-submenu-border']      = $border_disabled_values;
				$theme_options['above-header-submenu-item-border'] = $inside_border_disabled_values;
			}
			// Below Header.
			if ( $below_submenu_border ) {
				$theme_options['below-header-submenu-border']      = $border_enabled_values;
				$theme_options['below-header-submenu-item-border'] = $inside_border_enabled_values;
			} else {
				$theme_options['below-header-submenu-border']      = $border_disabled_values;
				$theme_options['below-header-submenu-item-border'] = $inside_border_disabled_values;
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Set Above Header submenu border color 'above-header-submenu-border-color' to '#eaeaea' for old users who doesn't set any color and set the theme color who install the fresh v_1_6_0 plugin.
		 *
		 * @return void
		 */
		public static function v_1_6_0() {

			$theme_options = get_option( 'astra-settings' );

			// Set the default #eaeaea sub menu border color who doesn't set any color.
			if ( ! isset( $theme_options['above-header-submenu-border-color'] ) || empty( $theme_options['above-header-submenu-border-color'] ) ) {
				$theme_options['above-header-submenu-border-color'] = '#eaeaea';
			}

			// Set above and below header sub menu animation option to default for existing users.
			if ( ! isset( $theme_options['below-header-submenu-container-animation'] ) || empty( $theme_options['below-header-submenu-container-animation'] ) ) {
				$theme_options['below-header-submenu-container-animation'] = '';
			}

			if ( ! isset( $theme_options['above-header-submenu-container-animation'] ) ) {
				$theme_options['above-header-submenu-container-animation'] = '';
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Change the Above Header and Below Header submenu option to be checkbpx rather than border selection.
		 * Apply the submenu border color to the submenu item border color for Above and Below Header.
		 *
		 * @return void
		 */
		public static function v_1_6_1() {
			$theme_options                    = get_option( 'astra-settings', array() );
			$above_header_submenu_otem_border = isset( $theme_options['above-header-submenu-item-border'] ) ? $theme_options['above-header-submenu-item-border'] : array();
			$below_header_submenu_otem_border = isset( $theme_options['below-header-submenu-item-border'] ) ? $theme_options['below-header-submenu-item-border'] : array();

			if ( ( is_array( $above_header_submenu_otem_border ) && '0' != $above_header_submenu_otem_border['bottom'] ) ) {
				$theme_options['above-header-submenu-item-border'] = 1;
			} else {
				$theme_options['above-header-submenu-item-border'] = 0;
			}

			if ( ( is_array( $below_header_submenu_otem_border ) && '0' != $below_header_submenu_otem_border['bottom'] ) ) {
				$theme_options['below-header-submenu-item-border'] = 1;
			} else {
				$theme_options['below-header-submenu-item-border'] = 0;
			}

			if ( isset( $theme_options['above-header-submenu-border-color'] ) && ! empty( $theme_options['above-header-submenu-border-color'] ) ) {
				$theme_options['above-header-submenu-item-b-color'] = $theme_options['above-header-submenu-border-color'];
			}

			if ( isset( $theme_options['below-header-submenu-border-color'] ) && ! empty( $theme_options['below-header-submenu-border-color'] ) ) {
				$theme_options['below-header-submenu-item-b-color'] = $theme_options['below-header-submenu-border-color'];
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * Quick View Improvements.
		 *
		 * @since 1.6.10
		 *
		 * @return void
		 */
		public static function v_1_6_10() {
			$theme_options = get_option( 'astra-settings' );

			// Setting the value `true` for `Stick Add to Cart` option.
			// For `Quick View` option for old users. For new users its `false`.
			if ( ! isset( $theme_options['shop-quick-view-stick-cart'] ) ) {
				$theme_options['shop-quick-view-stick-cart'] = true;
			}

			update_option( 'astra-settings', $theme_options );
		}

		/**
		 * If any advanced header is using existing breadcrumb layout then set a flag to keep using older version of breadcrumb.
		 *
		 * @return void
		 */
		public static function v1_8_0() {
			$query_args = array(
				'post_type'      => 'astra_adv_header',
				'posts_per_page' => 200, // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page
				// Limiting number of posts so that query does not timeout if there are too many posts.
				'fields'         => 'ids',
			);

			$page_headers = new WP_Query( $query_args );
			$layouts      = $page_headers->posts;

			if ( is_array( $layouts ) && ! empty( $layouts ) ) {
				foreach ( $layouts as $key => $layout_id ) {

					$post_meta  = get_post_meta( $layout_id, 'ast-advanced-headers-layout', true );
					$breadcrumb = isset( $post_meta['breadcrumb'] ) ? $post_meta['breadcrumb'] : '';

					if ( 'enabled' === $breadcrumb ) {
						update_post_meta( $layout_id, 'astra-breadcrumb-old', 'true' );
					}
				}
			}

			wp_reset_postdata();
		}

		/**
		 * Flush bundled products After udpating to version 1.8.8
		 *
		 * @return void
		 */
		public static function v1_8_8() {
			update_site_option( 'bsf_force_check_extensions', true );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Addon_Update::get_instance();
