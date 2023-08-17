<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Woocommerce_Shop_Configs' ) ) {

	/**
	 * Register Woocommerce Shop Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Woocommerce_Shop_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Woocommerce Shop Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$easy_list_view_attr = array();

			/**
			 * Easy view control.
			 */
			$easy_list_view_attr['easy_view'] = array(
				'clone'       => false,
				'is_parent'   => true,
				'main_index'  => 'easy_view',
				'clone_limit' => 2,
				'title'       => __( 'Easy List View', 'astra-addon' ),
			);

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-shop-toolbar-divider]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Toolbar Structure', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 15,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Toolbar Structure.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
					'type'              => 'control',
					'control'           => 'ast-sortable',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_multi_choices' ),
					'section'           => 'woocommerce_product_catalog',
					'default'           => astra_get_option( 'shop-toolbar-structure' ),
					'priority'          => 15,
					'consider_hidden'   => true,
					'hidden_dataset'    => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure-with-hiddenset]',
					'choices'           => array_merge(
						array(
							'filters' => __( 'Filter', 'astra-addon' ),
							'results' => __( 'Result Count', 'astra-addon' ),
							'sorting' => __( 'Sorting', 'astra-addon' ),
						),
						$easy_list_view_attr
					),
					'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Easy list disable description.
				 */

				array(
					'name'     => 'easy-list-content-enable-description',
					'parent'   => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
					'default'  => astra_get_option( 'easy-list-content-enable-description' ),
					'linked'   => 'easy_view',
					'type'     => 'sub-control',
					'control'  => 'ast-toggle',
					'section'  => 'woocommerce_product_catalog',
					'priority' => 15,
					'title'    => __( 'Enable Description', 'astra-addon' ),
				),

				/**
				 * Option: Easy list columns.
				 */
				array(
					'name'              => 'easy-list-grids',
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
					'type'              => 'sub-control',
					'linked'            => 'easy_view',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'woocommerce_product_catalog',
					'transport'         => 'postMessage',
					'default'           => astra_get_option(
						'easy-list-grids',
						array(
							'desktop' => 2,
							'tablet'  => 1,
							'mobile'  => 1,
						)
					),
					'priority'          => 15,
					'title'             => __( 'List Columns', 'astra-addon' ),
					'input_attrs'       => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 2,
					),
				),

				/**
				 * Option: Easy list alignment.
				*/
				array(
					'name'       => 'easy-list-content-alignment',
					'parent'     => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
					'default'    => astra_get_option( 'easy-list-content-alignment' ),
					'section'    => 'woocommerce_product_catalog',
					'linked'     => 'easy_view',
					'type'       => 'sub-control',
					'control'    => 'ast-selector',
					'title'      => __( 'Content Alignment', 'astra-addon' ),
					'priority'   => 15,
					'choices'    => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'center' => __( 'Center', 'astra-addon' ),
					),
					'renderAs'   => 'text',
					'responsive' => true,
				),

				/**
				 * Dataset with hidden dataset.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure-with-hiddenset]',
					'section'  => 'woocommerce_product_catalog',
					'type'     => 'control',
					'control'  => 'ast-hidden',
					'priority' => 15,
					'partial'  => false,
					'default'  => astra_get_option( 'shop-toolbar-structure-with-hiddenset' ),
				),

				/**
				 * Shop single product background color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-product-background-color]',
					'default'           => astra_get_option( 'shop-product-background-color' ),
					'type'              => 'control',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Background', 'astra-addon' ),
					'priority'          => 228.5,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-spacing' ),
				),

				/**
				 * Option: Product content padding
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-product-content-padding]',
					'default'           => astra_get_option( 'shop-product-content-padding' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'woocommerce_product_catalog',
					'title'             => __( 'Content Padding', 'astra-addon' ),
					'linked_choices'    => true,
					'transport'         => 'postMessage',
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'priority'          => 230,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-section-divider' ),
				),

				// Option Group: Box shadow Group.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[shop-items-box-shadow-group]',
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Box Shadow', 'astra-addon' ),
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'priority'  => 230,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'   => array( 'ast_class' => 'ast-bottom-dotted-divider' ),
				),

				/**
				 * Option: box shadow
				 */
				array(
					'name'              => 'shop-item-box-shadow-control',
					'default'           => astra_get_option( 'shop-item-box-shadow-control' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-items-box-shadow-group]',
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'control'           => 'ast-box-shadow',
					'section'           => 'woocommerce_product_catalog',
					'sanitize_callback' => array( 'Astra_Addon_Customizer', 'sanitize_box_shadow' ),
					'priority'          => 1,
					'title'             => __( 'Value', 'astra-addon' ),
					'choices'           => array(
						'x'      => __( 'X', 'astra-addon' ),
						'y'      => __( 'Y', 'astra-addon' ),
						'blur'   => __( 'Blur', 'astra-addon' ),
						'spread' => __( 'Spread', 'astra-addon' ),
					),
				),

				array(
					'name'      => 'shop-item-box-shadow-position',
					'default'   => astra_get_option( 'shop-item-box-shadow-position' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-items-box-shadow-group]',
					'type'      => 'sub-control',
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'control'   => 'ast-select',
					'title'     => __( 'Position', 'astra-addon' ),
					'choices'   => array(
						'outline' => __( 'Outline', 'astra-addon' ),
						'inset'   => __( 'Inset', 'astra-addon' ),
					),
					'priority'  => 2,
				),

				array(
					'name'      => 'shop-item-box-shadow-color',
					'default'   => astra_get_option( 'shop-item-box-shadow-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-items-box-shadow-group]',
					'type'      => 'sub-control',
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'title'     => __( 'Color', 'astra-addon' ),
					'rgba'      => true,
					'priority'  => 3,
				),

				// Option Group: Box shadow Hover Group.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[shop-items-hover-box-shadow-group]',
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Box Hover Shadow', 'astra-addon' ),
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'priority'  => 230,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				/**
				 * Option: box shadow
				 */
				array(
					'name'              => 'shop-item-hover-box-shadow-control',
					'default'           => astra_get_option( 'shop-item-hover-box-shadow-control' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-items-hover-box-shadow-group]',
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'control'           => 'ast-box-shadow',
					'section'           => 'woocommerce_product_catalog',
					'sanitize_callback' => array( 'Astra_Addon_Customizer', 'sanitize_box_shadow' ),
					'priority'          => 1,
					'title'             => __( 'Value', 'astra-addon' ),
					'choices'           => array(
						'x'      => __( 'X', 'astra-addon' ),
						'y'      => __( 'Y', 'astra-addon' ),
						'blur'   => __( 'Blur', 'astra-addon' ),
						'spread' => __( 'Spread', 'astra-addon' ),
					),
				),

				array(
					'name'      => 'shop-item-hover-box-shadow-position',
					'default'   => astra_get_option( 'shop-item-hover-box-shadow-position' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-items-hover-box-shadow-group]',
					'type'      => 'sub-control',
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'control'   => 'ast-select',
					'title'     => __( 'Position', 'astra-addon' ),
					'choices'   => array(
						'outline' => __( 'Outline', 'astra-addon' ),
						'inset'   => __( 'Inset', 'astra-addon' ),
					),
					'priority'  => 2,
				),

				array(
					'name'      => 'shop-item-hover-box-shadow-color',
					'default'   => astra_get_option( 'shop-item-hover-box-shadow-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-items-hover-box-shadow-group]',
					'type'      => 'sub-control',
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'title'     => __( 'Color', 'astra-addon' ),
					'rgba'      => true,
					'priority'  => 3,
				),

				/**
				 * Option: Content alignment for style 2
				*/
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[shop-page-list-style-alignment]',
					'default'    => astra_get_option( 'shop-page-list-style-alignment' ),
					'section'    => 'woocommerce_product_catalog',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Vertical Content alignment', 'astra-addon' ),
					'priority'   => 229,
					'choices'    => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'center' => __( 'Center', 'astra-addon' ),
					),
					'renderAs'   => 'text',
					'responsive' => true,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-style]',
							'operator' => '==',
							'value'    => 'shop-page-list-style',
						),
					),
					'divider'    => array( 'ast_class' => 'ast-bottom-section-divider' ),
				),

				/**
				 * Option: Product Hover Style
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-hover-style]',
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'woocommerce_product_catalog',
					'default'  => astra_get_option( 'shop-hover-style' ),
					'priority' => 229,
					'title'    => __( 'Product Image Hover Style', 'astra-addon' ),
					'choices'  => apply_filters(
						'astra_woo_shop_hover_style',
						array(
							''     => __( 'None', 'astra-addon' ),
							'swap' => __( 'Swap Images', 'astra-addon' ),
						)
					),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'  => array( 'ast_class' => 'ast-bottom-section-divider' ),
				),

				/**
				 * Option: Button Padding
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-button-padding]',
					'default'           => astra_get_option( 'shop-button-padding' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'woocommerce_product_catalog',
					'title'             => __( 'Button Padding', 'astra-addon' ),
					'linked_choices'    => true,
					'transport'         => 'postMessage',
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'priority'          => 229,
					'connected'         => false,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-section-divider' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-pagination-divider]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Shop Pagination', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 140,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Shop Pagination
				 */

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[shop-pagination]',
					'default'    => astra_get_option( 'shop-pagination' ),
					'section'    => 'woocommerce_product_catalog',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Shop Pagination', 'astra-addon' ),
					'priority'   => 145,
					'choices'    => array(
						'number'   => __( 'Number', 'astra-addon' ),
						'infinite' => __( 'Infinite Scroll', 'astra-addon' ),
					),
					'transport'  => 'refresh',
					'renderAs'   => 'text',
					'responsive' => false,
					'divider'    => array( 'ast_class' => 'ast-bottom-dotted-divider ast-section-spacing' ),
				),

				/**
				 * Option: Shop Pagination Style
				 */

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[shop-pagination-style]',
					'default'    => astra_get_option( 'shop-pagination-style' ),
					'section'    => 'woocommerce_product_catalog',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Shop Pagination Style', 'astra-addon' ),
					'priority'   => 150,
					'choices'    => array(
						'default' => __( 'Default', 'astra-addon' ),
						'square'  => __( 'Square', 'astra-addon' ),
						'circle'  => __( 'Circle', 'astra-addon' ),
					),
					'transport'  => 'postMessage',
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-pagination]',
							'operator' => '==',
							'value'    => 'number',
						),
					),
				),

				/**
				 * Option: Event to Trigger Infinite Loading
				 */

				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-infinite-scroll-event]',
					'default'     => astra_get_option( 'shop-infinite-scroll-event' ),
					'section'     => 'woocommerce_product_catalog',
					'type'        => 'control',
					'control'     => 'ast-selector',
					'title'       => __( 'Event to Trigger Infinite Loading', 'astra-addon' ),
					'description' => __( 'Infinite Scroll cannot be previewed in the Customizer.', 'astra-addon' ),
					'priority'    => 155,
					'choices'     => array(
						'scroll' => __( 'Scroll', 'astra-addon' ),
						'click'  => __( 'Click', 'astra-addon' ),
					),
					'transport'   => 'refresh',
					'renderAs'    => 'text',
					'responsive'  => false,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-pagination]',
							'operator' => '==',
							'value'    => 'infinite',
						),
					),
				),

				/**
				 * Option: Read more text
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[shop-load-more-text]',
					'default'   => astra_get_option( 'shop-load-more-text' ),
					'type'      => 'control',
					'transport' => 'postMessage',
					'section'   => 'woocommerce_product_catalog',
					'priority'  => 160,
					'title'     => __( 'Load More Text', 'astra-addon' ),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-pagination]',
							'operator' => '==',
							'value'    => 'infinite',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-infinite-scroll-event]',
							'operator' => '==',
							'value'    => 'click',
						),
					),
					'control'   => 'text',
					'partial'   => array(
						'selector'            => '.ast-shop-pagination-infinite .ast-shop-load-more',
						'container_inclusive' => false,
						'render_callback'     => 'Astra_Customizer_Ext_WooCommerce_Partials::_render_shop_load_more',
					),
				),

				/**
				 * Option: Divider
				 */

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-shop-structure-options-divider]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Shop Structure Options', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 29,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Display Page Title
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-page-title-display]',
					'default'  => astra_get_option( 'shop-page-title-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Display Page Title', 'astra-addon' ),
					'priority' => 29,
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Display Breadcrumb
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-breadcrumb-display]',
					'default'  => astra_get_option( 'shop-breadcrumb-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Display Breadcrumb', 'astra-addon' ),
					'priority' => 29,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Enable Sticky Sidebar.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-active-filters-sticky-sidebar]',
					'default'  => astra_get_option( 'shop-active-filters-sticky-sidebar' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Enable Sticky Sidebar', 'astra-addon' ),
					'priority' => 29,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Shop filter list to buttons.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-filter-list-to-buttons]',
					'default'  => astra_get_option( 'shop-filter-list-to-buttons' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Change Filter List To Buttons', 'astra-addon' ),
					'priority' => 29,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Enable / Disable Filter Accordion.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-filter-accordion]',
					'default'  => astra_get_option( 'shop-filter-accordion' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Enable Filter Accordion', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 29,
				),

				/**
				 * Option: Display Active Filters
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-active-filters-display]',
					'default'  => astra_get_option( 'shop-active-filters-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
					'title'    => __( 'Display Active Filters', 'astra-addon' ),
					'priority' => 29,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-filters-heading]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Shop Filters', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 200,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
				),

				/**
				 * Option: Display Off Canvas On Click Of
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
					'default'    => astra_get_option( 'shop-off-canvas-trigger-type' ),
					'type'       => 'control',
					'control'    => 'ast-selector',
					'renderAs'   => 'text',
					'responsive' => false,
					'section'    => 'woocommerce_product_catalog',
					'priority'   => 200,
					'title'      => __( 'Shop Filter Button', 'astra-addon' ),
					'choices'    => array(
						'link'         => __( 'Link', 'astra-addon' ),
						'button'       => __( 'Button', 'astra-addon' ),
						'custom-class' => __( 'Custom Class', 'astra-addon' ),
					),
					'divider'    => array( 'ast_class' => 'ast-section-spacing ast-bottom-dotted-divider' ),
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
				),

				/**
				 * Option: Custom Class
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-filter-trigger-custom-class]',
					'default'  => astra_get_option( 'shop-filter-trigger-custom-class' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => '==',
							'value'    => 'custom-class',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
					'priority' => 200,
					'title'    => __( 'Custom Class', 'astra-addon' ),
					'control'  => 'text',
				),

				/**
				* Option: Filter Button Text
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-filter-trigger-link]',
					'default'  => astra_get_option( 'shop-filter-trigger-link' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'priority' => 200,
					'title'    => __( 'Shop Filter Button Text', 'astra-addon' ),
					'control'  => 'text',
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => 'in',
							'value'    => array( 'button', 'link' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
				),

				/**
				 * Option: Choose Filter position
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[shop-filter-position]',
					'default'    => astra_get_option( 'shop-filter-position' ),
					'type'       => 'control',
					'section'    => 'woocommerce_product_catalog',
					'title'      => __( 'Filter Panel Layout', 'astra-addon' ),
					'control'    => 'ast-selector',
					'renderAs'   => 'text',
					'responsive' => false,
					'priority'   => 200,
					'choices'    => array(
						'shop-filter-collapsible' => __( 'Top Collapsible', 'astra-addon' ),
						'shop-filter-flyout'      => __( 'Flyout', 'astra-addon' ),
					),
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => 'in',
							'value'    => array( 'button', 'link', 'custom-class' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
					'divider'    => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Filter collapsable number of columns.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-filter-collapsable-columns]',
					'section'     => 'woocommerce_product_catalog',
					'priority'    => 200,
					'default'     => astra_get_option( 'shop-filter-collapsable-columns' ),
					'title'       => __( 'Filter columns', 'astra-addon' ),
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 6,
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-filter-position]',
							'operator' => 'in',
							'value'    => array( 'shop-filter-collapsible' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => 'in',
							'value'    => array( 'button', 'link', 'custom-class' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
				),

				/**
				 * Option: Enable / Disable Scrollbar Max Height.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-filter-max-height]',
					'default'  => astra_get_option( 'shop-filter-max-height' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Enable Scrollbar Max Height', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 200,
					'divider'  => array( 'ast_class' => 'ast-top-section-divider' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-filter-position]',
							'operator' => 'in',
							'value'    => array( 'shop-filter-collapsible' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => 'in',
							'value'    => array( 'button', 'link', 'custom-class' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
				),

				/**
				 * Option: Scrollbar Max Height.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-filter-scrollbar-max-height]',
					'default'           => astra_get_option( 'shop-filter-scrollbar-max-height' ),
					'type'              => 'control',
					'section'           => 'woocommerce_product_catalog',
					'title'             => __( 'Scrollbar Max Height', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'px',
					'transport'         => 'postMessage',
					'priority'          => 200,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 300,
					),
					'divider'           => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => 'in',
							'value'    => array( 'button', 'link', 'custom-class' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-filter-max-height]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-toolbar-structure]',
							'operator' => 'contains',
							'value'    => 'filters',
						),
					),
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-shop-layout-divider]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Quick View', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 91,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable Quick View
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-quick-view-enable]',
					'default'  => astra_get_option( 'shop-quick-view-enable' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Quick View', 'astra-addon' ),
					'control'  => 'ast-select',
					'priority' => 91,
					'choices'  => array(
						'disabled'       => __( 'Disabled', 'astra-addon' ),
						'on-image'       => __( 'On Image', 'astra-addon' ),
						'on-image-click' => __( 'On Image Click', 'astra-addon' ),
						'after-summary'  => __( 'After Summary', 'astra-addon' ),
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Stick Quick View
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-quick-view-stick-cart]',
					'default'     => astra_get_option( 'shop-quick-view-stick-cart' ),
					'type'        => 'control',
					'section'     => 'woocommerce_product_catalog',
					'title'       => __( 'Stick Add to Cart Button', 'astra-addon' ),
					'description' => __( 'If contents of the popup is larger then the button will stick at the end of the popup.', 'astra-addon' ),
					'control'     => Astra_Theme_Extension::$switch_control,
					'priority'    => 91,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-quick-view-enable]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Woocommerce_Shop_Configs();
