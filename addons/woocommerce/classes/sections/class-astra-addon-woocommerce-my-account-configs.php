<?php
/**
 * My Account Options for our theme.
 *
 * @package     Astra
 * @link        https://wpastra.com/
 * @since       Astra 3.9.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Register Woocommerce My-Account Configurations.
 */
class Astra_Addon_Woocommerce_My_Account_Configs extends Astra_Customizer_Config_Base {
	/**
	 * Register Woocommerce My-Account Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 * @since 3.9.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public function register_configuration( $configurations, $wp_customize ) {

		$_configs = array(

			/**
			 * Adding My-Account new section.
			 */
			array(
				'name'     => 'section-ast-woo-my-account',
				'title'    => __( 'My Account', 'astra-addon' ),
				'priority' => 24,
				'panel'    => 'woocommerce',
				'type'     => 'section',
			),

			/**
			 * Option: Divider.
			 */

			array(
				'name'     => ASTRA_THEME_SETTINGS . '[woo-myaccount-general-divider]',
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'General', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'ast-heading',
				'priority' => 5,
				'settings' => array(),
			),

			/**
			 * Enable modern my-account view.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
				'default'  => astra_get_option( 'modern-woo-account-view' ),
				'type'     => 'control',
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Enable Modern Layout', 'astra-addon' ),
				'priority' => 5,
				'control'  => Astra_Theme_Extension::$switch_control,
				'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
			),

			/**
			 * Option: Divider.
			 */

			array(
				'name'     => ASTRA_THEME_SETTINGS . '[woo-myaccount-dashboard-divider]',
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Dashboard', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'ast-heading',
				'priority' => 10,
				'settings' => array(),
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
				'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
			),

			/**
			 * Enable modern user-gravatar option.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[my-account-user-gravatar]',
				'default'  => astra_get_option( 'my-account-user-gravatar' ),
				'type'     => 'control',
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Enable User Gravatar', 'astra-addon' ),
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 10,
				'control'  => Astra_Theme_Extension::$switch_control,
				'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
			),

			/**
			 * Option: Divider.
			 */

			array(
				'name'     => ASTRA_THEME_SETTINGS . '[woo-myaccount-orders-divider]',
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Orders', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'ast-heading',
				'priority' => 15,
				'settings' => array(),
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
				'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
			),

			/**
			 * Option: Enable grid orders view.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[show-woo-grid-orders]',
				'default'  => astra_get_option( 'show-woo-grid-orders' ),
				'type'     => 'control',
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Enable Grid View', 'astra-addon' ),
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 15,
				'control'  => Astra_Theme_Extension::$switch_control,
				'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
			),

			/**
			 * Option: Divider.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[my-account-input-divider]',
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'My Account Text', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'ast-heading',
				'priority' => 15,
				'settings' => array(),
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[show-woo-grid-orders]',
						'operator' => '==',
						'value'    => true,
					),
				),
				'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
			),

			/**
			 * Option: Download text.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[my-account-download-text]',
				'default'  => astra_get_option( 'my-account-download-text' ),
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Download Text', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'text',
				'priority' => 15,
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[show-woo-grid-orders]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			/**
			 * Option: Download remaining text.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[my-account-download-remaining-text]',
				'default'  => astra_get_option( 'my-account-download-remaining-text' ),
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Download Remaining Text', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'text',
				'priority' => 15,
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[show-woo-grid-orders]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			/**
			 * Option: Download expire text.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[my-account-download-expire-text]',
				'default'  => astra_get_option( 'my-account-download-expire-text' ),
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Download Expire Text', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'text',
				'priority' => 15,
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[show-woo-grid-orders]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			/**
			 * Option: Download expire alt text.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[my-account-download-expire-alt-text]',
				'default'  => astra_get_option( 'my-account-download-expire-alt-text' ),
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Download Expire Alt Text', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'text',
				'priority' => 15,
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[show-woo-grid-orders]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			/**
			 * Option: Divider.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[login-register-divider]',
				'section'  => 'section-ast-woo-my-account',
				'title'    => __( 'Login and Register', 'astra-addon' ),
				'type'     => 'control',
				'control'  => 'ast-heading',
				'priority' => 15,
				'settings' => array(),
				'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				'context'  => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			/**
			 * Option: Register text.
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[my-account-register-text]',
				'default'   => astra_get_option( 'my-account-register-text' ),
				'section'   => 'section-ast-woo-my-account',
				'title'     => __( 'Register Text', 'astra-addon' ),
				'type'      => 'control',
				'control'   => 'text',
				'transport' => 'postMessage',
				'priority'  => 15,
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			/**
			 * Option: Register description text.
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[my-account-register-description-text]',
				'default'   => astra_get_option( 'my-account-register-description-text' ),
				'section'   => 'section-ast-woo-my-account',
				'title'     => __( 'Register Description', 'astra-addon' ),
				'type'      => 'control',
				'control'   => 'text',
				'transport' => 'postMessage',
				'priority'  => 15,
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			/**
			 * Option: Login text.
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[my-account-login-text]',
				'default'   => astra_get_option( 'my-account-login-text' ),
				'section'   => 'section-ast-woo-my-account',
				'title'     => __( 'Login Text', 'astra-addon' ),
				'type'      => 'control',
				'control'   => 'text',
				'transport' => 'postMessage',
				'priority'  => 15,
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			/**
			 * Option: Login description text.
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[my-account-login-description-text]',
				'default'   => astra_get_option( 'my-account-login-description-text' ),
				'section'   => 'section-ast-woo-my-account',
				'title'     => __( 'Login Description Text', 'astra-addon' ),
				'type'      => 'control',
				'control'   => 'text',
				'transport' => 'postMessage',
				'priority'  => 15,
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[modern-woo-account-view]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

		);

		return array_merge( $configurations, $_configs );
	}
}

new Astra_Addon_Woocommerce_My_Account_Configs();
