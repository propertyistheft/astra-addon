<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       4.10.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config color_switcher base class is already present.
if ( class_exists( 'Astra_Color_Switcher_Component_Configs' ) ) {
	return;
}

/**
 * Register Builder Customizer Configurations.
 *
 * @since 4.10.0
 */
class Astra_Color_Switcher_Component_Configs {

	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @param Array  $configurations Configurations.
	 * @param string $builder_type Builder Type.
	 * @param string $_section Section.
	 *
	 * @since 4.10.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public static function register_configuration( $configurations, $builder_type = 'header', $_section = 'section-hb-color-switcher' ) {

		$partial_markup = array(
			'selector'            => '.ast-color-switcher-wrapper',
			'container_inclusive' => false,
			'render_callback'     => array( 'Astra_Addon_Builder_UI_Controller', 'render_color_switcher_markup' ),
		);

		// Dark palette context.
		$dark_palette_context = array(
			'relation' => 'AND',
			astra_addon_builder_helper()->general_tab_config,
			array(
				'setting'  => ASTRA_THEME_SETTINGS . '[color-switcher-palette]',
				'operator' => '==',
				'value'    => 'palette_4',
			),
		);

		/* Color Switcher Tabs */
		$configurations[] = array(
			'name'        => $_section . '-ast-context-tabs',
			'section'     => $_section,
			'type'        => 'control',
			'control'     => 'ast-builder-header-control',
			'priority'    => 0,
			'description' => '',
		);

		$configurations[] = array(
			'name'     => $_section,
			'type'     => 'section',
			'priority' => 1,
			'title'    => __( 'Color Switcher', 'astra-addon' ),
			'panel'    => 'panel-' . $builder_type . '-builder-group',
		);

		// Check if the current Astra theme version is less than 4.10.0.
		if ( version_compare( ASTRA_THEME_VERSION, '4.10.0', '<' ) ) {
			/* Notice: If Color Switcher is not fully compatible */
			$configurations[] = array(
				'name'     => ASTRA_THEME_SETTINGS . '[color-switcher-notice]',
				'type'     => 'control',
				'control'  => 'ast-description',
				'section'  => $_section,
				'priority' => 1,
				'context'  => astra_addon_builder_helper()->general_tab,
				'help'     => sprintf(
					'<div class="ast-customizer-notice wp-ui-highlight"><p>' . __( 'The Color Switcher feature is not fully compatible with your current Astra theme version %s. Please update your theme to the latest version for full compatibility.', 'astra-addon' ) . '</p></div>',
					ASTRA_THEME_VERSION
				),
			);
		}

		/**
		 * General Tab Options.
		 */

		/* Quick Link: Palettes Section. */
		$configurations[] = array(
			'name'      => ASTRA_THEME_SETTINGS . '[color-switcher-palettes-quick-link]',
			'type'      => 'control',
			'control'   => 'ast-customizer-link',
			'section'   => $_section,
			'priority'  => 1,
			'link_type' => 'control',
			'linked'    => 'astra-color-palettes',
			'link_text' => __( 'Configure Palettes', 'astra-addon' ),
			'context'   => astra_addon_builder_helper()->general_tab,
		);

		/* Option: Switcher/Alternate Palette */
		$configurations[] = array(
			'name'     => ASTRA_THEME_SETTINGS . '[color-switcher-palette]',
			'default'  => astra_get_option( 'color-switcher-palette' ),
			'type'     => 'control',
			'priority' => 1,
			'control'  => 'ast-select',
			'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
			'section'  => $_section,
			'title'    => __( 'Alternate Palette', 'astra-addon' ),
			'choices'  => astra_get_palette_names(),
			'context'  => astra_addon_builder_helper()->general_tab,
			'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
		);

		/* Option: Default Mode */
		$configurations[] = array(
			'name'        => ASTRA_THEME_SETTINGS . '[color-switcher-default-mode]',
			'default'     => astra_get_option( 'color-switcher-default-mode' ),
			'type'        => 'control',
			'priority'    => 1,
			'control'     => 'ast-select',
			'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
			'section'     => $_section,
			'title'       => __( 'Default Color Mode', 'astra-addon' ),
			'description' => __( 'Preview is disabled in the Customizer to prevent conflicts with color settings.', 'astra-addon' ),
			'choices'     => array(
				'system' => __( 'System Default', 'astra-addon' ),
				'light'  => __( 'Light', 'astra-addon' ),
				'dark'   => __( 'Dark', 'astra-addon' ),
			),
			'transport'   => 'refresh',
			'context'     => $dark_palette_context,
			'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
		);

		$configurations[] = array(
			'name'     => ASTRA_THEME_SETTINGS . '[color-switcher-mode-help]',
			'type'     => 'control',
			'control'  => 'ast-description',
			'section'  => $_section,
			'priority' => 1,
			'label'    => '',
			'help'     => __( '`System Default` adapts to your device\'s and browser\'s light or dark mode setting automatically.', 'astra-addon' ),
			'context'  => $dark_palette_context,
		);

		/* Option: Force Reload */
		$configurations[] = array(
			'name'        => ASTRA_THEME_SETTINGS . '[color-switcher-force-reload]',
			'default'     => astra_get_option( 'color-switcher-force-reload' ),
			'section'     => $_section,
			'type'        => 'control',
			'control'     => 'ast-toggle-control',
			'priority'    => 1,
			'title'       => __( 'Force Reload', 'astra-addon' ),
			'description' => __( 'Enable this option to trigger a full page reload when switching the color palette. This can improve performance in cases where dark mode compatibility CSS is applied dynamically.', 'astra-addon' ),
			'transport'   => 'refresh',
			'context'     => $dark_palette_context,
			'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
		);

		/* Option: Default Mode Icon */
		$configurations[] = array(
			'name'        => ASTRA_THEME_SETTINGS . '[color-switcher-icon]',
			'default'     => astra_get_option( 'color-switcher-icon' ),
			'section'     => $_section,
			'priority'    => 1,
			'title'       => __( 'Default Mode Icon', 'astra-addon' ),
			'type'        => 'control',
			'control'     => 'ast-svg-icon-selector',
			'keyword'     => 'switcher', // to pull the icons first related to color keyword.
			'choices'     => array(
				'none'   => 'ban',
				'adjust' => 'adjust',
				'moon'   => 'moon',
				'sun'    => 'sun',
				'custom' => 'code',
			),
			'partial'     => $partial_markup,
			'transport'   => 'postMessage',
			/* translators: %s: filter to enable svg icons */
			'description' => Astra_Icons::is_svg_icons() ? '' : sprintf( __( 'SVG icons are currently disabled. To enable them, use the filter `%s`.', 'astra-addon' ), 'apply_filters( \'astra_is_svg_icons\', \'__return_true\' )' ),
			'context'     => astra_addon_builder_helper()->general_tab,
			'responsive'  => false,
			'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
		);

		/* Option: Alternate/Switched Icon */
		$configurations[] = array(
			'name'        => ASTRA_THEME_SETTINGS . '[color-switcher-icon-switched]',
			'default'     => astra_get_option( 'color-switcher-icon-switched' ),
			'section'     => $_section,
			'priority'    => 1,
			'title'       => __( 'Alternate Mode Icon', 'astra-addon' ),
			'type'        => 'control',
			'control'     => 'ast-svg-icon-selector',
			'keyword'     => 'switcher', // to pull the icons first related to color keyword.
			'choices'     => array(
				'none'   => 'ban',
				'adjust' => 'adjust',
				'sun'    => 'sun',
				'moon'   => 'moon',
				'custom' => 'code',
			),
			'partial'     => $partial_markup,
			'transport'   => 'postMessage',
			/* translators: %s: filter to enable svg icons */
			'description' => Astra_Icons::is_svg_icons() ? '' : sprintf( __( 'SVG icons are currently disabled. To enable them, use the filter `%s`.', 'astra-addon' ), 'apply_filters( \'astra_is_svg_icons\', \'__return_true\' )' ),
			'context'     => astra_addon_builder_helper()->general_tab,
			'responsive'  => false,
		);

		/* Option: Icon Size */
		$configurations[] = array(
			'name'              => ASTRA_THEME_SETTINGS . '[color-switcher-icon-size]',
			'section'           => $_section,
			'priority'          => 1,
			'transport'         => 'postMessage',
			'default'           => astra_get_option( 'color-switcher-icon-size' ),
			'title'             => __( 'Icon Size', 'astra-addon' ),
			'type'              => 'control',
			'suffix'            => 'px',
			'control'           => 'ast-responsive-slider',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
			'input_attrs'       => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 50,
			),
			'context'           => astra_addon_builder_helper()->general_tab,
			'divider'           => array( 'ast_class' => 'ast-top-dotted-divider ast-bottom-dotted-divider' ),
		);

		/* Option: Default Mode Text */
		$configurations[] = array(
			'name'      => ASTRA_THEME_SETTINGS . '[color-switcher-text]',
			'default'   => astra_get_option( 'color-switcher-text' ),
			'type'      => 'control',
			'control'   => 'text',
			'section'   => $_section,
			'title'     => __( 'Default Mode Label', 'astra-addon' ),
			'priority'  => 1,
			'partial'   => $partial_markup,
			'transport' => 'postMessage',
			'context'   => astra_addon_builder_helper()->general_tab,
		);

		/* Option: Alternate/Switched Mode Text */
		$configurations[] = array(
			'name'      => ASTRA_THEME_SETTINGS . '[color-switcher-text-switched]',
			'default'   => astra_get_option( 'color-switcher-text-switched' ),
			'type'      => 'control',
			'control'   => 'text',
			'section'   => $_section,
			'title'     => __( 'Alternate Mode Label', 'astra-addon' ),
			'priority'  => 1,
			'partial'   => $partial_markup,
			'transport' => 'postMessage',
			'context'   => astra_addon_builder_helper()->general_tab,
		);

		/* Option: Visibility */
		$configurations[] = array(
			'name'      => ASTRA_THEME_SETTINGS . '[color-switcher-visibility]',
			'default'   => astra_get_option( 'color-switcher-visibility' ),
			'type'      => 'control',
			'control'   => 'ast-multi-selector',
			'section'   => $_section,
			'priority'  => 1,
			'title'     => __( 'Visibility', 'astra-addon' ),
			'context'   => astra_addon_builder_helper()->general_tab,
			'transport' => 'postMessage',
			'choices'   => array(
				'desktop' => 'customizer-desktop',
				'tablet'  => 'customizer-tablet',
				'mobile'  => 'customizer-mobile',
			),
			'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
		);

		/**
		 * Design tab Options.
		 */

		/* Option: Icon Color */
		$configurations[] = array(
			'name'       => ASTRA_THEME_SETTINGS . '[color-switcher-icon-color]',
			'default'    => astra_get_option( 'color-switcher-icon-color' ),
			'type'       => 'control',
			'section'    => $_section,
			'priority'   => 1,
			'transport'  => 'postMessage',
			'control'    => 'ast-responsive-color',
			'responsive' => true,
			'rgba'       => true,
			'title'      => __( 'Icon / Text Color', 'astra-addon' ),
			'context'    => astra_addon_builder_helper()->design_tab,
			'divider'    => array( 'ast_class' => 'ast-section-spacing' ),
		);

		/* Heading: Background Group */
		$configurations[] = array(
			'name'       => ASTRA_THEME_SETTINGS . '[color-switcher-background-group]',
			'default'    => astra_get_option( 'color-switcher-background-group' ),
			'section'    => $_section,
			'type'       => 'control',
			'control'    => 'ast-color-group',
			'title'      => __( 'Background', 'astra-addon' ),
			'transport'  => 'postMessage',
			'priority'   => 1,
			'context'    => astra_addon_builder_helper()->design_tab,
			'responsive' => true,
			'divider'    => array( 'ast_class' => 'ast-bottom-dotted-divider' ),
		);

		/* Option: Button Background */
		$configurations[] = array(
			'name'       => 'color-switcher-background',
			'default'    => astra_get_option( 'color-switcher-background' ),
			'section'    => $_section,
			'parent'     => ASTRA_THEME_SETTINGS . '[color-switcher-background-group]',
			'type'       => 'sub-control',
			'control'    => 'ast-responsive-color',
			'title'      => __( 'Normal', 'astra-addon' ),
			'transport'  => 'postMessage',
			'responsive' => true,
			'rgba'       => true,
		);

		/* Option: Button Background Hover */
		$configurations[] = array(
			'name'       => 'color-switcher-background-hover',
			'default'    => astra_get_option( 'color-switcher-background-hover' ),
			'section'    => $_section,
			'parent'     => ASTRA_THEME_SETTINGS . '[color-switcher-background-group]',
			'type'       => 'sub-control',
			'control'    => 'ast-responsive-color',
			'title'      => __( 'Hover', 'astra-addon' ),
			'transport'  => 'postMessage',
			'responsive' => true,
			'rgba'       => true,
		);

		/* Option: Border Radius */
		$configurations[] = array(
			'name'              => ASTRA_THEME_SETTINGS . '[color-switcher-radius]',
			'default'           => astra_get_option( 'color-switcher-radius' ),
			'type'              => 'control',
			'transport'         => 'postMessage',
			'control'           => 'ast-responsive-spacing',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
			'section'           => $_section,
			'priority'          => 1,
			'title'             => __( 'Border Radius', 'astra-addon' ),
			'linked_choices'    => true,
			'unit_choices'      => array( 'px', 'em', '%' ),
			'choices'           => array(
				'top'    => __( 'Top', 'astra-addon' ),
				'right'  => __( 'Right', 'astra-addon' ),
				'bottom' => __( 'Bottom', 'astra-addon' ),
				'left'   => __( 'Left', 'astra-addon' ),
			),
			'context'           => astra_addon_builder_helper()->design_tab,
			'divider'           => array( 'ast_class' => 'ast-bottom-spacing' ),
		);

		/* Heading: Spacing */
		$configurations[] = array(
			'name'     => ASTRA_THEME_SETTINGS . '[color-switcher-spacing-divider-heading]',
			'section'  => $_section,
			'title'    => __( 'Spacing', 'astra-addon' ),
			'type'     => 'control',
			'control'  => 'ast-heading',
			'priority' => 1,
			'context'  => astra_addon_builder_helper()->design_tab,
		);

		/* Option: Margin */
		$configurations[] = array(
			'name'              => ASTRA_THEME_SETTINGS . '[color-switcher-margin]',
			'default'           => astra_get_option( 'color-switcher-margin' ),
			'type'              => 'control',
			'transport'         => 'postMessage',
			'control'           => 'ast-responsive-spacing',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
			'section'           => $_section,
			'priority'          => 1,
			'title'             => __( 'Margin', 'astra-addon' ),
			'linked_choices'    => true,
			'unit_choices'      => array( 'px', 'em', '%', 'vw' ),
			'choices'           => array(
				'top'    => __( 'Top', 'astra-addon' ),
				'right'  => __( 'Right', 'astra-addon' ),
				'bottom' => __( 'Bottom', 'astra-addon' ),
				'left'   => __( 'Left', 'astra-addon' ),
			),
			'context'           => astra_addon_builder_helper()->design_tab,
			'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
		);

		/* Option: Padding */
		$configurations[] = array(
			'name'              => ASTRA_THEME_SETTINGS . '[color-switcher-padding]',
			'default'           => astra_get_option( 'color-switcher-padding' ),
			'type'              => 'control',
			'transport'         => 'postMessage',
			'control'           => 'ast-responsive-spacing',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
			'section'           => $_section,
			'priority'          => 1,
			'title'             => __( 'Padding', 'astra-addon' ),
			'linked_choices'    => true,
			'unit_choices'      => array( 'px', 'em', '%', 'vw' ),
			'choices'           => array(
				'top'    => __( 'Top', 'astra-addon' ),
				'right'  => __( 'Right', 'astra-addon' ),
				'bottom' => __( 'Bottom', 'astra-addon' ),
				'left'   => __( 'Left', 'astra-addon' ),
			),
			'context'           => astra_addon_builder_helper()->design_tab,
			'divider'           => array( 'ast_class' => 'ast-top-dotted-divider' ),
		);

		if ( $builder_type === 'header' ) {
			/**
			 * Transparent Header Options.
			 */
			$transparent_header_section = 'section-transparent-header';

			/* Option: Icon Color */
			$configurations[] = array(
				'name'       => ASTRA_THEME_SETTINGS . '[transparent-color-switcher-icon-color]',
				'default'    => astra_get_option( 'transparent-color-switcher-icon-color' ),
				'type'       => 'control',
				'section'    => $transparent_header_section,
				'priority'   => 75,
				'transport'  => 'postMessage',
				'control'    => 'ast-responsive-color',
				'responsive' => true,
				'rgba'       => true,
				'title'      => __( 'Icon Color', 'astra-addon' ),
				'context'    => astra_addon_builder_helper()->design_tab,
				'divider'    => array(
					'ast_title' => __( 'Color Switcher', 'astra-addon' ),
					'ast_class' => 'ast-top-divider ast-top-dotted-divider',
				),
			);

			/* Heading: Background Group */
			$configurations[] = array(
				'name'       => ASTRA_THEME_SETTINGS . '[transparent-color-switcher-background-group]',
				'default'    => astra_get_option( 'transparent-color-switcher-background-group' ),
				'section'    => $transparent_header_section,
				'type'       => 'control',
				'control'    => 'ast-color-group',
				'title'      => __( 'Background', 'astra-addon' ),
				'transport'  => 'postMessage',
				'priority'   => 75,
				'context'    => astra_addon_builder_helper()->design_tab,
				'responsive' => true,
			);

			/* Option: Button Background */
			$configurations[] = array(
				'name'       => 'transparent-color-switcher-background',
				'default'    => astra_get_option( 'transparent-color-switcher-background' ),
				'section'    => $transparent_header_section,
				'parent'     => ASTRA_THEME_SETTINGS . '[transparent-color-switcher-background-group]',
				'type'       => 'sub-control',
				'control'    => 'ast-responsive-color',
				'title'      => __( 'Normal', 'astra-addon' ),
				'transport'  => 'postMessage',
				'responsive' => true,
				'rgba'       => true,
			);

			/* Option: Button Background Hover */
			$configurations[] = array(
				'name'       => 'transparent-color-switcher-background-hover',
				'default'    => astra_get_option( 'transparent-color-switcher-background-hover' ),
				'section'    => $transparent_header_section,
				'parent'     => ASTRA_THEME_SETTINGS . '[transparent-color-switcher-background-group]',
				'type'       => 'sub-control',
				'control'    => 'ast-responsive-color',
				'title'      => __( 'Hover', 'astra-addon' ),
				'transport'  => 'postMessage',
				'responsive' => true,
				'rgba'       => true,
			);
		}

		return $configurations;
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Color_Switcher_Component_Configs();
