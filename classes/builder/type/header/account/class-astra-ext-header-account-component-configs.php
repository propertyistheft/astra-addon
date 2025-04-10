<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       3.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Register Builder Customizer Configurations.
 *
 * @since 3.0.0
 */
// @codingStandardsIgnoreStart
class Astra_Ext_Header_Account_Component_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	// @codingStandardsIgnoreEnd

	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 * @since 3.0.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public function register_configuration( $configurations, $wp_customize ) {

		$_section = 'section-header-account';

		$account_choices = array(
			'default' => __( 'Default', 'astra-addon' ),
		);

		if ( class_exists( 'LifterLMS' ) && get_permalink( llms_get_page_id( 'myaccount' ) ) ) {
			$account_choices['lifterlms'] = __( 'LifterLMS', 'astra-addon' );
		}

		if ( class_exists( 'WooCommerce' ) && get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) {
			$account_choices['woocommerce'] = __( 'WooCommerce', 'astra-addon' );
		}

		$register_option = '';

		if ( get_option( 'users_can_register' ) ) {
			$register_option = array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-account-login-register]',
				'default'   => astra_get_option( 'header-account-login-register' ),
				'type'      => 'control',
				'control'   => Astra_Theme_Extension::$switch_control,
				'section'   => $_section,
				'priority'  => 205,
				'title'     => __( 'Register', 'astra-addon' ),
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-action]',
						'operator' => '==',
						'value'    => 'login',
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-style]',
						'operator' => '!=',
						'value'    => 'none',
					),
				),
				'partial'   => array(
					'selector'        => '.ast-header-account',
					'render_callback' => array( 'Astra_Builder_UI_Controller', 'render_account' ),
				),
				'transport' => 'postMessage',
			);
		}

		$_configs = array(

			/**
			 * Option: Profile Link type
			 */
			array(
				'name'       => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
				'default'    => astra_get_option( 'header-account-action-type' ),
				'type'       => 'control',
				'control'    => Astra_Theme_Extension::$selector_control,
				'section'    => $_section,
				'title'      => __( 'Profile Action', 'astra-addon' ),
				'priority'   => 4,
				'choices'    => array(
					'link' => __( 'Link', 'astra-addon' ),
					'menu' => __( 'Menu', 'astra-addon' ),
				),
				'transport'  => 'postMessage',
				'partial'    => array(
					'selector'        => '.ast-header-account',
					'render_callback' => array( 'Astra_Builder_UI_Controller', 'render_account' ),
				),
				'responsive' => false,
				'renderAs'   => 'text',
			),

			/**
			 * Option: Show Menu On.
			 */
			array(
				'name'       => ASTRA_THEME_SETTINGS . '[header-account-action-menu-display-on]',
				'default'    => astra_get_option( 'header-account-action-menu-display-on' ),
				'type'       => 'control',
				'control'    => Astra_Theme_Extension::$selector_control,
				'section'    => $_section,
				'title'      => __( 'Show Menu On', 'astra-addon' ),
				'priority'   => 4,
				'choices'    => array(
					'hover' => __( 'Hover', 'astra-addon' ),
					'click' => __( 'Click', 'astra-addon' ),
				),
				'context'    => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
						'operator' => '==',
						'value'    => 'menu',
					),
				),
				'responsive' => false,
				'renderAs'   => 'text',
				'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
			),

			/**
			 * Option: Profile Link type
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-account-link-type]',
				'default'   => astra_get_option( 'header-account-link-type' ),
				'type'      => 'control',
				'control'   => 'ast-select',
				'section'   => $_section,
				'priority'  => 5,
				'title'     => __( 'Link Type', 'astra-addon' ),
				'choices'   => array(
					'default' => __( 'Default', 'astra-addon' ),
					'custom'  => __( 'Custom', 'astra-addon' ),
				),
				'transport' => 'postMessage',
				'partial'   => array(
					'selector'        => '.ast-header-account',
					'render_callback' => array( 'Astra_Builder_UI_Controller', 'render_account' ),
				),
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-type]',
						'operator' => '!=',
						'value'    => 'default',
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
						'operator' => '!=',
						'value'    => 'menu',
					),
				),

			),

			array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-account-woo-menu]',
				'default'   => astra_get_option( 'header-account-woo-menu' ),
				'type'      => 'control',
				'control'   => Astra_Theme_Extension::$switch_control,
				'section'   => $_section,
				'priority'  => 7,
				'title'     => __( 'Use WooCommerce Account Menu', 'astra-addon' ),
				'context'   => array(
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-type]',
						'operator' => '==',
						'value'    => 'woocommerce',
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
						'operator' => '==',
						'value'    => 'menu',
					),
					astra_addon_builder_helper()->general_tab_config,
				),
				'partial'   => array(
					'selector'        => '.ast-header-account',
					'render_callback' => array( 'Astra_Builder_UI_Controller', 'render_account' ),
				),
				'transport' => 'postMessage',
			),

			/**
			 * Option: Theme Menu create link
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-account-create-menu-link]',
				'default'   => astra_get_option( 'header-account-create-menu-link' ),
				'type'      => 'control',
				'control'   => 'ast-customizer-link',
				'section'   => $_section,
				'link_type' => 'section',
				'linked'    => 'menu_locations',
				'link_text' => __( 'Configure Menu from Here.', 'astra-addon' ),
				'priority'  => 7,
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
						'operator' => '==',
						'value'    => 'menu',
					),
				),
			),

			array(
				'name'     => ASTRA_THEME_SETTINGS . '[header-account-menu-link-notice]',
				'type'     => 'control',
				'control'  => 'ast-description',
				'section'  => $_section,
				'priority' => 7,
				'label'    => '',
				'help'     => $this->get_help_text_notice(),
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
						'operator' => '==',
						'value'    => 'menu',
					),
				),
			),

			/**
			 * Option: Click action type
			 */
			array(
				'name'       => ASTRA_THEME_SETTINGS . '[header-account-logout-action]',
				'default'    => astra_get_option( 'header-account-logout-action' ),
				'type'       => 'control',
				'control'    => Astra_Theme_Extension::$selector_control,
				'section'    => $_section,
				'title'      => __( 'Click Action', 'astra-addon' ),
				'choices'    => array(
					'link'  => __( 'Link', 'astra-addon' ),
					'login' => __( 'Login Popup', 'astra-addon' ),
				),
				'transport'  => 'postMessage',
				'priority'   => 204,
				'context'    => array(
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-style]',
						'operator' => '!=',
						'value'    => 'none',
					),
					astra_addon_builder_helper()->general_tab_config,
				),
				'partial'    => array(
					'selector'        => '.ast-header-account',
					'render_callback' => array( 'Astra_Builder_UI_Controller', 'render_account' ),
				),
				'responsive' => false,
				'renderAs'   => 'text',
				'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
			),

			$register_option,

			array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-account-login-lostpass]',
				'default'   => astra_get_option( 'header-account-login-lostpass' ),
				'type'      => 'control',
				'control'   => Astra_Theme_Extension::$switch_control,
				'section'   => $_section,
				'priority'  => 205,
				'title'     => __( 'Lost your password?', 'astra-addon' ),
				'divider'   => array( 'ast_class' => 'ast-top-dotted-divider' ),
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-action]',
						'operator' => '==',
						'value'    => 'login',
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-style]',
						'operator' => '!=',
						'value'    => 'none',
					),
				),
				'partial'   => array(
					'selector'        => '.ast-header-account',
					'render_callback' => array( 'Astra_Builder_UI_Controller', 'render_account' ),
				),
				'transport' => 'postMessage',
			),

			array(
				'name'       => ASTRA_THEME_SETTINGS . '[header-account-icon-type]',
				'default'    => astra_get_option( 'header-account-icon-type' ),
				'type'       => 'control',
				'control'    => Astra_Theme_Extension::$selector_control,
				'section'    => $_section,
				'priority'   => 3,
				'title'      => __( 'Select Icon', 'astra-addon' ),
				'choices'    => array(
					'account-1' => 'account-1',
					'account-2' => 'account-2',
					'account-3' => 'account-3',
					'account-4' => 'account-4',
				),
				'transport'  => 'postMessage',
				'partial'    => array(
					'selector'        => '.ast-header-account',
					'render_callback' => array( 'Astra_Builder_UI_Controller', 'render_account' ),
				),
				'context'    => array(
					astra_addon_builder_helper()->design_tab_config,
					array(
						'relation' => 'OR',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-login-style]',
							'operator' => '==',
							'value'    => 'icon',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-style]',
							'operator' => '==',
							'value'    => 'icon',
						),
					),
				),
				'responsive' => false,
				'divider'    => array( 'ast_class' => 'ast-bottom-dotted-divider' ),
			),
		);

		if ( count( $account_choices ) > 1 ) {
			$_configs[] = array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-account-type]',
				'default'   => astra_get_option( 'header-account-type' ),
				'type'      => 'control',
				'control'   => 'ast-select',
				'divider'   => array( 'ast_class' => 'ast-bottom-dotted-divider ast-section-spacing' ),
				'section'   => $_section,
				'priority'  => 1,
				'title'     => __( 'Select Account', 'astra-addon' ),
				'choices'   => $account_choices,
				'transport' => 'postMessage',
				'partial'   => array(
					'selector'        => '.ast-header-account',
					'render_callback' => array( 'Astra_Builder_UI_Controller', 'render_account' ),
				),
			);
		}

		return array_merge( $configurations, $_configs );
	}

	/**
	 * Help notice message to be displayed when the Link type set as Menu.
	 *
	 * @since  3.5.9
	 * @return String HTML Markup for the help notice.
	 */
	private function get_help_text_notice() {

		if ( class_exists( 'WooCommerce' ) ) {
			$notice = __( '<b>Note:</b> For responsive devices, the menu will be replaced with the WooCommerce "My Account" link.', 'astra-addon' );
		} elseif ( class_exists( 'LifterLMS' ) ) {
			$notice = __( '<b>Note:</b> For responsive devices, the menu will be replaced with the LifterLMS "My Account" link.', 'astra-addon' );
		} else {
			$notice = __( '<b>Note:</b> For responsive devices, the menu will be replaced with the Link provided in the Link Tab.', 'astra-addon' );
		}

		return $notice;
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Ext_Header_Account_Component_Configs();
