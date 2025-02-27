<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-addon
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
class Astra_Customizer_Adv_Search_Configs extends Astra_Customizer_Config_Base {
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

		$_section       = 'section-header-search';
		$markup_partial = array(
			'selector'            => '.ast-header-search',
			'container_inclusive' => false,
			'render_callback'     => array( Astra_Ext_Adv_Search_Markup::get_instance(), 'get_search_markup' ),
		);

		/**
		 * Option: Pro Search Bar Configs.
		 */
		$_configs = array(
			// Option: Header Search Style.
			array(
				'name'        => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
				'default'     => astra_get_option( 'header-search-box-type' ),
				'section'     => $_section,
				'priority'    => 1,
				'title'       => __( 'Search Style', 'astra-addon' ),
				'type'        => 'control',
				'control'     => 'ast-select',
				'choices'     => array(
					'slide-search' => __( 'Slide Search', 'astra-addon' ),
					'full-screen'  => __( 'Full Screen Search', 'astra-addon' ),
					'header-cover' => __( 'Header Cover Search', 'astra-addon' ),
					'search-box'   => __( 'Search Box', 'astra-addon' ),
				),
				'description' => __( 'Only the Search Box style will work within the Off Canvas section.', 'astra-addon' ),
				'context'     => astra_addon_builder_helper()->general_tab,
				'transport'   => 'refresh',
				'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
			),

			// Option: Search Icon.
			array(
				'name'        => ASTRA_THEME_SETTINGS . '[header-search-icon]',
				'default'     => astra_get_option( 'header-search-icon' ),
				'section'     => $_section,
				'priority'    => 1,
				'title'       => __( 'Search Icon', 'astra-addon' ),
				'type'        => 'control',
				'control'     => 'ast-svg-icon-selector',
				'keyword'     => 'search', // to pull the icons in first related to search keyword.
				'choices'     => array(
					'search'        => 'search',
					'search-thin'   => 'search-thin',
					'search-filled' => 'search-filled',
					'icon-library'  => 'upload',
					'custom'        => 'code',
				),
				'partial'     => $markup_partial,
				'transport'   => 'postMessage',
				/* translators: %s: filter to enable svg icons */
				'description' => Astra_Icons::is_svg_icons() ? '' : sprintf( __( 'SVG icons are currently disabled. To enable them, use the filter `%s`.', 'astra-addon' ), 'apply_filters( \'astra_is_svg_icons\', \'__return_true\' )' ),
				'context'     => astra_addon_builder_helper()->general_tab,
				'responsive'  => false,
				'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
			),

			/**
			 * Option: search placeholder text.
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-search-box-placeholder]',
				'default'   => astra_get_option( 'header-search-box-placeholder' ),
				'section'   => $_section,
				'priority'  => 3,
				'title'     => __( 'Placeholder Text', 'astra-addon' ),
				'type'      => 'control',
				'control'   => 'ast-text-input',
				'transport' => 'postMessage',
				'partial'   => $markup_partial,
				'context'   => astra_addon_builder_helper()->general_tab,
				'divider'   => array( 'ast_class' => 'ast-top-section-divider ast-bottom-section-divider' ),
			),

			array(
				'name'       => ASTRA_THEME_SETTINGS . '[fullsearch-modal-color-mode]',
				'default'    => astra_get_option( 'fullsearch-modal-color-mode' ),
				'type'       => 'control',
				'priority'   => 3,
				'control'    => 'ast-selector',
				'section'    => $_section,
				'title'      => __( 'Modal Box Style', 'astra-addon' ),
				'choices'    => array(
					'light' => __( 'Light', 'astra-addon' ),
					'dark'  => __( 'Dark', 'astra-addon' ),
				),
				'renderAs'   => 'text',
				'responsive' => false,
				'transport'  => 'refresh',
				'context'    => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
						'operator' => '==',
						'value'    => 'full-screen',
					),
				),
				'divider'    => array( 'ast_class' => 'ast-top-section-divider' ),
			),
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[full-screen-modal-heading]',
				'default'   => astra_get_option( 'full-screen-modal-heading' ),
				'type'      => 'control',
				'control'   => Astra_Theme_Extension::$switch_control,
				'section'   => $_section,
				'title'     => __( 'Modal Box Heading', 'astra-addon' ),
				'transport' => 'refresh',
				'priority'  => 3,
				'divider'   => array( 'ast_class' => 'ast-top-dotted-divider' ),
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
						'operator' => '==',
						'value'    => 'full-screen',
					),
				),
			),
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[fullscreen-modal-heading-text]',
				'default'   => astra_get_option( 'fullscreen-modal-heading-text' ),
				'section'   => $_section,
				'priority'  => 3,
				'title'     => __( 'Heading Text', 'astra-addon' ),
				'type'      => 'control',
				'control'   => 'ast-text-input',
				'transport' => 'refresh',
				'divider'   => array( 'ast_class' => 'ast-top-dotted-divider' ),
				'partial'   => $markup_partial,
				'context'   => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
						'operator' => '==',
						'value'    => 'full-screen',
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[full-screen-modal-heading]',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		return array_merge( $configurations, $_configs );
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Customizer_Adv_Search_Configs();
