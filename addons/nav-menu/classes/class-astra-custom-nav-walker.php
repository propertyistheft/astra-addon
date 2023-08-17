<?php
/**
 * Custom wp_nav_menu walker.
 *
 * @package Astra WordPress theme
 */

if ( ! class_exists( 'Astra_Custom_Nav_Walker' ) ) {

	/**
	 * Astra custom navigation walker.
	 *
	 * @since 1.6.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Custom_Nav_Walker extends Walker_Nav_Menu {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Use full width mega menu?
		 *
		 * @var string
		 */
		private $menu_megamenu_width = '';

		/**
		 * How many columns should the mega menu have?
		 *
		 * @var int
		 */
		private $num_of_columns = 0;

		/**
		 * Menu item ID.
		 *
		 * @var int
		 */
		private $menu_megamenu_item_id = 0;

		/**
		 * Starts the list before the elements are added.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu().
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {

			$indent = str_repeat( "\t", $depth );

			$style = array();

			if ( 0 === $depth && '' != $this->megamenu && 'ast-hf-mobile-menu' !== $args->menu_id && 'ast-desktop-toggle-menu' !== $args->menu_id ) {

				if ( isset( $this->megamenu_text_color_group ) && '' != $this->megamenu_text_color_group ) {

					if ( isset( $this->megamenu_text_color_group['normal'] ) && $this->megamenu_text_color_group['normal'] ) {

						$style[ '.ast-desktop .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item > .menu-link, .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item .sub-menu > .menu-link, .ast-desktop .ast-container .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item:hover' ] = array(
							'color' => $this->megamenu_text_color_group['normal'],
						);
					}

					if ( isset( $this->megamenu_text_color_group['hover'] ) && $this->megamenu_text_color_group['hover'] ) {
						$style[ '.ast-container .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item .sub-menu .menu-item:hover, .ast-desktop .ast-container .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item .menu-link:hover, .ast-container .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item .sub-menu .menu-link:hover' ] = array(
							'color' => $this->megamenu_text_color_group['hover'],
						);
					}
				}

				$megamenu_divider_class = '';

				if ( isset( $this->megamenu_top_border_width ) && '' != $this->megamenu_top_border_width ) {
					$style[ '.ast-desktop li.astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-megamenu' ] = array(
						'border-top-width' => $this->megamenu_top_border_width . 'px',
					);
				}

				if ( isset( $this->megamenu_column_divider_width ) && '' != $this->megamenu_column_divider_width ) {
					$style[ '.ast-desktop li.astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-megamenu > .menu-item' ] = array(
						'border-right-width' => $this->megamenu_column_divider_width . 'px',
					);
				}

				if ( isset( $this->megamenu_top_border_color ) && '' != $this->megamenu_top_border_color ) {
					$style[ '.ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-megamenu' ] = array(
						'border-color' => $this->megamenu_top_border_color,
					);
				}

				if ( isset( $this->megamenu_column_divider_color ) && '' != $this->megamenu_column_divider_color ) {
					$megamenu_divider_class = ' astra-megamenu-has-divider';
					$style[ '.ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-megamenu > .menu-item' ] = array(
						'border-right' => '1px solid ' . $this->megamenu_column_divider_color,
					);
				}

				if ( isset( $this->megamenu_divider_style ) && '' != $this->megamenu_divider_style ) {
					$style[ '.ast-desktop li.astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-megamenu, .ast-desktop li.astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-megamenu > .menu-item' ] = array(
						'border-style' => $this->megamenu_divider_style,
					);
				}

				if ( isset( $this->megamenu_margin_top ) && '' != $this->megamenu_margin_top ) {
					$style[ '.ast-hfb-header.ast-desktop .main-header-menu > .menu-item-' . $this->menu_megamenu_item_id . ' > .sub-menu:before' ] = array(
						'height' => astra_calculate_spacing( $this->megamenu_margin_top . 'px', '+', '5', 'px' ),
					);
				}

				if ( isset( $this->megamenu_heading_color_group ) && '' != $this->megamenu_heading_color_group ) {

					if ( isset( $this->megamenu_heading_color_group['normal'] ) && $this->megamenu_heading_color_group['normal'] ) {

						$style[ '.ast-desktop li.astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .menu-item-heading > .menu-link' ] = array(
							'color' => $this->megamenu_heading_color_group['normal'],
						);
					}

					if ( isset( $this->megamenu_heading_color_group['hover'] ) && $this->megamenu_heading_color_group['hover'] ) {
						$style[ '.ast-desktop li.astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .menu-item-heading > .menu-link:hover' ] = array(
							'color' => $this->megamenu_heading_color_group['hover'],
						);
					}
				}

				if ( isset( $this->megamenu_bg_type ) && ( isset( $this->megamenu_bg_image ) || isset( $this->megamenu_bg_gradient ) ) ) {

					if ( 'image' === $this->megamenu_bg_type ) {

						$bg_object = array(
							'background-color'    => $this->megamenu_bg_color,
							'background-image'    => $this->megamenu_bg_image,
							'background-repeat'   => $this->megamenu_bg_repeat,
							'background-size'     => $this->megamenu_bg_size,
							'background-position' => $this->megamenu_bg_position,
						);
					} else {
						$bg_object = array(
							'background' => $this->megamenu_bg_gradient,
						);
					}

					$style[ '.ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-full-megamenu-wrapper, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-menu-container, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-content, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-custom' ] = 'image' === $this->megamenu_bg_type ? astra_addon_get_megamenu_background_obj( $bg_object ) : $bg_object;
				}

				if ( 'custom' === $this->megamenu_width ) {

					$megamenu_custom_width = $this->megamenu_custom_width;

					$megamenu_custom_width = ( isset( $megamenu_custom_width ) && ! empty( $megamenu_custom_width ) ) ? $megamenu_custom_width : 1200;

					$style[ '.ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-custom:before' ] = array(
						'content' => '"' . $megamenu_custom_width . '"',
						'opacity' => 0,
					);
				}

				// Advanced spacing options.
				$margin_object = array(
					'margin-top'    => $this->megamenu_margin_top,
					'margin-right'  => $this->megamenu_margin_right,
					'margin-bottom' => $this->megamenu_margin_bottom,
					'margin-left'   => $this->megamenu_margin_left,
				);

				$style[ '.ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' div.astra-full-megamenu-wrapper, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' ul.astra-mega-menu-width-menu-container, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' ul.astra-mega-menu-width-content, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' ul.astra-mega-menu-width-custom' ] = astra_addon_get_megamenu_spacing_css( $margin_object );

				$padding_object = array(
					'padding-top'    => $this->megamenu_padding_top,
					'padding-right'  => $this->megamenu_padding_right,
					'padding-bottom' => $this->megamenu_padding_bottom,
					'padding-left'   => $this->megamenu_padding_left,
				);

				$style[ '.ast-desktop .ast-mega-menu-enabled .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-full-megamenu-wrapper, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-menu-container, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-content, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-custom' ] = astra_addon_get_megamenu_spacing_css( $padding_object );

				Astra_Ext_Nav_Menu_Loader::add_css( astra_parse_css( $style ) );

				if ( 'full' === $this->megamenu_width || 'full-stretched' === $this->megamenu_width ) {
					// Adding "hidden" class to fix the visibility issue during page load.
					$output .= "\n$indent<div " . astra_attr(
						'ast-megamenu-full-attr',
						array(
							'class' => 'astra-full-megamenu-wrapper ast-hidden' . esc_attr( $megamenu_divider_class ),
						)
					) . ">\n";
				}
				// Adding "hidden" class to fix the visibility issue during page load.
				$output .= "\n$indent<ul " . astra_attr(
					'ast-megamenu-attr',
					array(
						'class' => "astra-megamenu sub-menu astra-mega-menu-width-{$this->megamenu_width}" . esc_attr( $megamenu_divider_class ) . ' ast-hidden',
					)
				) . ">\n";

			} elseif ( 2 <= $depth && '' != $this->megamenu ) {
				$output .= "\n$indent<ul class='astra-nested-sub-menu sub-menu'\">\n";
			} else {
				$output .= "\n$indent<ul class=\"sub-menu\">\n";
			}
		}

		/**
		 * Parse post meta of particular passed key & return its value.
		 *
		 * @param array  $post_meta Post meta of megamenu.
		 * @param string $key Meta item key.
		 *
		 * @return mixed value of meta key.
		 * @since 4.1.5
		 */
		public function get_post_meta( $post_meta, $key ) {
			return isset( $post_meta[ $key ][0] ) ? $post_meta[ $key ][0] : '';
		}

		/**
		 * Modified the menu output.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu().
		 * @param int    $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$indent    = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$post_meta = get_post_meta( $item->ID );

			if ( 0 === $depth ) {
				$this->megamenu = $this->get_post_meta( $post_meta, '_menu_item_megamenu' );

				$this->megamenu_width = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'width', $item->ID );

				$this->megamenu_custom_width = $this->get_post_meta( $post_meta, '_menu_item_megamenu_custom_width' );

				$this->megamenu_bg_image = $this->get_post_meta( $post_meta, '_menu_item_megamenu_background_image' );

				$this->megamenu_text_color_group = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'text_color', $item->ID );

				$this->megamenu_bg_type = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'bg_type', $item->ID );

				$this->megamenu_bg_size     = $this->get_post_meta( $post_meta, '_menu_item_megamenu_bg_size' );
				$this->megamenu_bg_repeat   = $this->get_post_meta( $post_meta, '_menu_item_megamenu_bg_repeat' );
				$this->megamenu_bg_position = $this->get_post_meta( $post_meta, '_menu_item_megamenu_bg_position' );

				$this->megamenu_bg_color = $this->get_post_meta( $post_meta, '_menu_item_megamenu_bg_color' );

				$this->megamenu_bg_gradient = $this->get_post_meta( $post_meta, '_menu_item_megamenu_gradient' );

				$this->megamenu_divider_width = $this->get_post_meta( $post_meta, '_menu_item_megamenu_divider_width' );

				// Common divider.
				$this->megamenu_divider_style = $this->get_post_meta( $post_meta, '_menu_item_megamenu_divider_style' );

				// Top border.
				$this->megamenu_top_border_color = $this->get_post_meta( $post_meta, '_menu_item_megamenu_top_border_color' );
				$this->megamenu_top_border_width = $this->get_post_meta( $post_meta, '_menu_item_megamenu_top_border_width' );

				// Column divider.
				$this->megamenu_column_divider_color = $this->get_post_meta( $post_meta, '_menu_item_megamenu_column_divider_color' );
				$this->megamenu_column_divider_width = $this->get_post_meta( $post_meta, '_menu_item_megamenu_column_divider_width' );

				// Row divider.
				$this->megamenu_row_divider_width = $this->get_post_meta( $post_meta, '_menu_item_megamenu_row_divider_width' );

				$this->megamenu_heading_color_group = $this->get_post_meta( $post_meta, '_menu_item_megamenu_heading_color_group' );

				$this->num_of_columns = 0;

				$this->menu_megamenu_item_id = $item->ID;

				$margin_defaults = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'margin', $item->ID );

				$this->megamenu_margin_top    = isset( $margin_defaults['desktop']['top'] ) ? $margin_defaults['desktop']['top'] : '';
				$this->megamenu_margin_right  = isset( $margin_defaults['desktop']['right'] ) ? $margin_defaults['desktop']['right'] : '';
				$this->megamenu_margin_bottom = isset( $margin_defaults['desktop']['bottom'] ) ? $margin_defaults['desktop']['bottom'] : '';
				$this->megamenu_margin_left   = isset( $margin_defaults['desktop']['left'] ) ? $margin_defaults['desktop']['left'] : '';

				$padding_defaults = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'padding', $item->ID );

				$this->megamenu_padding_top    = isset( $padding_defaults['desktop']['top'] ) ? $padding_defaults['desktop']['top'] : '';
				$this->megamenu_padding_right  = isset( $padding_defaults['desktop']['right'] ) ? $padding_defaults['desktop']['right'] : '';
				$this->megamenu_padding_bottom = isset( $padding_defaults['desktop']['bottom'] ) ? $padding_defaults['desktop']['bottom'] : '';
				$this->megamenu_padding_left   = isset( $padding_defaults['desktop']['left'] ) ? $padding_defaults['desktop']['left'] : '';
			}

			$this->menu_megamenu_individual_item_id = $item->ID;
			$this->megamenu_disable_link            = $this->get_post_meta( $post_meta, '_menu_item_megamenu_disable_link' );
			$this->megamenu_disable_title           = Astra_Ext_Nav_Menu_Loader::get_megamenu_default( 'disable_title', $item->ID );
			$this->megamenu_enable_heading          = $this->get_post_meta( $post_meta, '_menu_item_megamenu_enable_heading' );
			$this->megamenu_separator_color         = $this->get_post_meta( $post_meta, '_menu_item_megamenu_heading_separator_color' );

			// Set up empty variable.
			$class_names = '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			if ( 'megamenu' === $this->megamenu && 'enable-heading' === $item->megamenu_enable_heading /*&& 0 != $depth*/ ) {
				$classes[] = 'menu-item-heading';
			}

			$row_border_width = $this->megamenu_row_divider_width ? $this->megamenu_row_divider_width . esc_attr( 'px' ) : esc_attr( '1px' );
			$row_border_style = $this->megamenu_divider_style ? $this->megamenu_divider_style : esc_attr( 'solid' );

			if ( ( isset( $this->megamenu_separator_color ) && '' != $this->megamenu_separator_color ) ) {

				$style = array(
					'.ast-desktop .astra-megamenu-li .menu-item-' . $this->menu_megamenu_individual_item_id . '.menu-item-heading > .menu-link, .ast-desktop .ast-mega-menu-enabled.submenu-with-border .astra-megamenu-li .menu-item-' . $this->menu_megamenu_individual_item_id . '.menu-item-heading > .menu-link, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li .menu-item-' . $this->menu_megamenu_individual_item_id . '.menu-item-heading > .menu-link' => array(
						'border-bottom' => $row_border_width . ' ' . $row_border_style . ' ' . $this->megamenu_separator_color,
					),
				);

				Astra_Ext_Nav_Menu_Loader::add_css( astra_parse_css( $style ) );
			}

			// Mega menu and Hide headings.
			if ( 0 === $depth && $this->has_children && '' != $this->megamenu && 'ast-hf-mobile-menu' !== $args->menu_id && 'ast-desktop-toggle-menu' !== $args->menu_id ) {
				$classes[] = 'astra-megamenu-li ' . $this->megamenu_width . '-width-mega';
			}

			if ( $item->description ) {
				$classes[] = 'ast-mm-has-desc';
			}

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param WP_Post  $item  Menu item data object.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			/**
			 * Filters the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );

			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';

			/**
			 * Passing Attr Classes to the filter in order to not override the existing CSS classes using the filter 'nav_menu_link_attributes' added from theme.
			 *
			 * This resolves the cloning Menu CSS for menu added after Primary Menu issue + 'MegaMenu Hide Menu Label / Description?' option not working issue.
			 *
			 * @since 3.1.0
			 */
			$item_output  = $args->before;
			$link_classes = array();

			if ( 'disable-link' === $item->megamenu_disable_link ) {
				$link_classes[] = 'ast-disable-link';
			}

			if ( 'disable-title' === $item->megamenu_disable_title ) {
				$link_classes[] = 'ast-hide-menu-item';
			}

			$link_classes_str = join( ' ', $link_classes );

			$atts['class'] = ! empty( $link_classes_str ) ? $link_classes_str : '';

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$atts       = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

					if ( 'href' === $attr && 'disable-link' === $item->megamenu_disable_link ) {
						$value = 'javascript:void(0)';
					}
					if ( 'class' !== $attr ) {
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
			}

			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string   $title The menu item's title.
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			// Wrap menu text in a span tag.
			$title = '<span class="menu-text">' . $title . '</span>';

			$item_output .= '<a' . $attributes . ' class="' . $atts['class'] . '">';

			if ( isset( $item->megamenu_highlight_label ) && '' != $item->megamenu_highlight_label ) {

				$style = array(
					'.ast-desktop .menu-item-' . $item->ID . ' .astra-mm-highlight-label, .ast-header-break-point .menu-item-' . $item->ID . ' .astra-mm-highlight-label' => array(
						'color'            => $item->megamenu_label_color,
						'background-color' => $item->megamenu_label_bg_color,
					),
				);

				Astra_Ext_Nav_Menu_Loader::add_css( astra_parse_css( $style ) );

				$title .= '<span class="astra-mm-highlight-label">' . esc_html( $item->megamenu_highlight_label ) . '</span>';
			}

			if ( isset( $item->megamenu_icon_source ) && '' != $item->megamenu_icon_source && 'none' !== $item->megamenu_icon_source ) {

				$mm_megamenu_icon_main            = $item->megamenu_icon_source;
				$mm_megamenu_icon_source          = isset( $mm_megamenu_icon_main['source'] ) ? $mm_megamenu_icon_main['source'] : '';
				$mm_megamenu_icon                 = isset( $mm_megamenu_icon_main['icon'] ) ? $mm_megamenu_icon_main['icon'] : '';
				$mm_megamenu_image                = isset( $mm_megamenu_icon_main['image'] ) ? $mm_megamenu_icon_main['image'] : '';
				$mm_megamenu_icon_spacing         = isset( $item->megamenu_icon_spacing ) ? $item->megamenu_icon_spacing : '';
				$mm_megamenu_icon_position        = isset( $item->megamenu_icon_position ) ? $item->megamenu_icon_position : '';
				$mm_megamenu_icon_view            = isset( $item->megamenu_icon_view ) ? $item->megamenu_icon_view : '';
				$mm_megamenu_icon_primary_color   = isset( $item->megamenu_icon_primary_color ) ? $item->megamenu_icon_primary_color : '';
				$mm_megamenu_icon_secondary_color = isset( $item->megamenu_icon_secondary_color ) ? $item->megamenu_icon_secondary_color : '';
				$mm_megamenu_icon_size            = isset( $item->megamenu_icon_size ) ? $item->megamenu_icon_size : '';
				$mm_megamenu_icon_padding         = isset( $item->megamenu_icon_padding ) ? $item->megamenu_icon_padding : '';
				$mm_megamenu_icon_corner_radius   = isset( $item->megamenu_icon_corner_radius ) ? $item->megamenu_icon_corner_radius : '';
				$mm_megamenu_icon_border_width    = isset( $item->megamenu_icon_border_width ) ? $item->megamenu_icon_border_width : '';
				$mm_image                         = '';

				if ( 'icon' === $mm_megamenu_icon_source ) {
					$mm_image = ( class_exists( 'Astra_Builder_UI_Controller' ) && $mm_megamenu_icon ) ? Astra_Builder_UI_Controller::fetch_svg_icon( $mm_megamenu_icon, false ) : '';
				}

				if ( 'image' === $mm_megamenu_icon_source ) {
					$mm_image = $mm_megamenu_image ? '<img src="' . $mm_megamenu_image . '" alt="mm-ast-icon">' : '';
				}

				$icon_array_slug        = '.ast-desktop .menu-item-' . $item->ID . ' .astra-mm-icon-label.icon-item-' . $item->ID;
				$icon_array_slug       .= ',  .ast-header-break-point .menu-item-' . $item->ID . ' .astra-mm-icon-label.icon-item-' . $item->ID;
				$icon_array_slug_image  = '.ast-desktop .menu-item-' . $item->ID . ' .astra-mm-icon-label.icon-item-' . $item->ID . ' > img';
				$icon_array_slug_image .= ',  .ast-header-break-point .menu-item-' . $item->ID . ' .astra-mm-icon-label.icon-item-' . $item->ID . ' > img';
				$icon_array_slug_svg    = '.ast-desktop .menu-item-' . $item->ID . ' .astra-mm-icon-label.icon-item-' . $item->ID . ' svg';
				$icon_array_slug_svg   .= ',  .ast-header-break-point .menu-item-' . $item->ID . ' .astra-mm-icon-label.icon-item-' . $item->ID . ' svg';
				$icon_style             = array();
				$icon_tablet_style      = array();
				$icon_mobile_style      = array();

				$icon_style[ $icon_array_slug ]['display']        = esc_attr( 'inline-block' );
				$icon_style[ $icon_array_slug ]['vertical-align'] = esc_attr( 'middle' );
				$icon_style[ $icon_array_slug ]['line-height']    = esc_attr( 0 );

				// Defaults for icon.
				if ( 'default' === $mm_megamenu_icon_view ) {
					if ( ! $mm_megamenu_icon_primary_color ) {
						$icon_style[ $icon_array_slug_svg ]['color'] = 'var(--ast-global-color-0)';
						$icon_style[ $icon_array_slug_svg ]['fill']  = 'var(--ast-global-color-0)';
					}
				}

				if ( 'stacked' === $mm_megamenu_icon_view ) {
					if ( ! $mm_megamenu_icon_primary_color ) {
						$icon_style[ $icon_array_slug_svg ]['color'] = '#fff';
						$icon_style[ $icon_array_slug_svg ]['fill']  = '#fff';
					}

					if ( ! $mm_megamenu_icon_secondary_color ) {
						$icon_style[ $icon_array_slug ]['background-color'] = 'var(--ast-global-color-0)';
					}
				}

				if ( 'framed' === $mm_megamenu_icon_view ) {
					if ( ! $mm_megamenu_icon_primary_color ) {
						$icon_style[ $icon_array_slug_svg ]['color']    = 'var(--ast-global-color-0)';
						$icon_style[ $icon_array_slug_svg ]['fill']     = 'var(--ast-global-color-0)';
						$icon_style[ $icon_array_slug ]['border-color'] = 'var(--ast-global-color-0)';
					}

					if ( ! $mm_megamenu_icon_secondary_color ) {
						$global_palette = astra_get_option( 'global-color-palette' );
						if ( $global_palette && isset( $global_palette['palette'][0] ) && function_exists( 'astra_hex_to_rgba' ) ) {
							$icon_style[ $icon_array_slug ]['background-color'] = astra_hex_to_rgba( $global_palette['palette'][0], .15 );
						}
					}
				}

				if ( $mm_megamenu_icon_spacing ) {
					$icon_style[ $icon_array_slug ]['margin'] = $mm_megamenu_icon_spacing . 'px';
				}

				if ( $mm_megamenu_icon_size ) {

					if ( 'image' === $mm_megamenu_icon_source ) {
						$icon_style[ $icon_array_slug_image ]['width']  = $mm_megamenu_icon_size . 'px';
						$icon_style[ $icon_array_slug_image ]['height'] = $mm_megamenu_icon_size . 'px';

					} else {
						$icon_style[ $icon_array_slug_svg ]['width']  = $mm_megamenu_icon_size . 'px';
						$icon_style[ $icon_array_slug_svg ]['height'] = $mm_megamenu_icon_size . 'px';
					}
				}

				if ( $mm_megamenu_icon_primary_color ) {
					$icon_style[ $icon_array_slug_svg ]['color'] = $mm_megamenu_icon_primary_color;
					$icon_style[ $icon_array_slug_svg ]['fill']  = $mm_megamenu_icon_primary_color;
				}

				if ( 'stacked' === $mm_megamenu_icon_view || 'framed' === $mm_megamenu_icon_view ) {

					if ( $mm_megamenu_icon_padding ) {
						$icon_style[ $icon_array_slug ]['padding'] = $mm_megamenu_icon_padding . 'px';
					}

					if ( $mm_megamenu_icon_secondary_color ) {
						$icon_style[ $icon_array_slug ]['background-color'] = $mm_megamenu_icon_secondary_color;
					}

					if ( $mm_megamenu_icon_corner_radius && isset( $mm_megamenu_icon_corner_radius['desktop'] ) && isset( $mm_megamenu_icon_corner_radius['desktop-unit'] ) ) {

						if ( isset( $mm_megamenu_icon_corner_radius['desktop']['top-left'] ) && $mm_megamenu_icon_corner_radius['desktop']['top-left'] ) {
							$icon_style[ $icon_array_slug ]['border-top-left-radius'] = $mm_megamenu_icon_corner_radius['desktop']['top-left'] . $mm_megamenu_icon_corner_radius['desktop-unit'];
						}

						if ( isset( $mm_megamenu_icon_corner_radius['desktop']['top-right'] ) && $mm_megamenu_icon_corner_radius['desktop']['top-right'] ) {
							$icon_style[ $icon_array_slug ]['border-top-right-radius'] = $mm_megamenu_icon_corner_radius['desktop']['top-right'] . $mm_megamenu_icon_corner_radius['desktop-unit'];
						}

						if ( isset( $mm_megamenu_icon_corner_radius['desktop']['bottom-left'] ) && $mm_megamenu_icon_corner_radius['desktop']['bottom-left'] ) {
							$icon_style[ $icon_array_slug ]['border-bottom-left-radius'] = $mm_megamenu_icon_corner_radius['desktop']['bottom-left'] . $mm_megamenu_icon_corner_radius['desktop-unit'];
						}

						if ( isset( $mm_megamenu_icon_corner_radius['desktop']['bottom-right'] ) && $mm_megamenu_icon_corner_radius['desktop']['bottom-right'] ) {
							$icon_style[ $icon_array_slug ]['border-bottom-right-radius'] = $mm_megamenu_icon_corner_radius['desktop']['bottom-right'] . $mm_megamenu_icon_corner_radius['desktop-unit'];
						}
					}
				}

				if ( 'framed' === $mm_megamenu_icon_view ) {

					if ( $mm_megamenu_icon_corner_radius || $mm_megamenu_icon_border_width ) {
						$icon_style[ $icon_array_slug ]['border-style'] = esc_attr( 'solid' );
						$icon_style[ $icon_array_slug ]['border-width'] = esc_attr( 'inherit' );
					}

					if ( $mm_megamenu_icon_border_width && isset( $mm_megamenu_icon_border_width['desktop'] ) && isset( $mm_megamenu_icon_border_width['desktop-unit'] ) ) {
						if ( isset( $mm_megamenu_icon_border_width['desktop']['top'] ) && $mm_megamenu_icon_border_width['desktop']['top'] ) {
							$icon_style[ $icon_array_slug ]['border-top-width'] = $mm_megamenu_icon_border_width['desktop']['top'] . $mm_megamenu_icon_border_width['desktop-unit'];
						}
						if ( isset( $mm_megamenu_icon_border_width['desktop']['bottom'] ) && $mm_megamenu_icon_border_width['desktop']['bottom'] ) {
							$icon_style[ $icon_array_slug ]['border-bottom-width'] = $mm_megamenu_icon_border_width['desktop']['bottom'] . $mm_megamenu_icon_border_width['desktop-unit'];
						}
						if ( isset( $mm_megamenu_icon_border_width['desktop']['left'] ) && $mm_megamenu_icon_border_width['desktop']['left'] ) {
							$icon_style[ $icon_array_slug ]['border-left-width'] = $mm_megamenu_icon_border_width['desktop']['left'] . $mm_megamenu_icon_border_width['desktop-unit'];
						}
						if ( isset( $mm_megamenu_icon_border_width['desktop']['right'] ) && $mm_megamenu_icon_border_width['desktop']['right'] ) {
							$icon_style[ $icon_array_slug ]['border-right-width'] = $mm_megamenu_icon_border_width['desktop']['right'] . $mm_megamenu_icon_border_width['desktop-unit'];
						}
					}

					if ( $mm_megamenu_icon_primary_color ) {
						$icon_style[ $icon_array_slug ]['border-color'] = $mm_megamenu_icon_primary_color;
					}
				}

				if ( ! empty( $icon_style ) || ! empty( $icon_tablet_style ) || ! empty( $icon_mobile_style ) ) {
					Astra_Ext_Nav_Menu_Loader::add_css( astra_parse_css( $icon_style ) );
				}

				if ( $mm_image ) {
					$icon_source   = 'icon' === $mm_megamenu_icon_source ? $mm_image : wp_kses_post( $mm_image );
					$icon_position = $icon_source ? '<span class="astra-mm-icon-label icon-item-' . $item->ID . '">' . $icon_source . '</span>' : '';
					$title         = 'after-label' === $mm_megamenu_icon_position ? $title . $icon_position : $icon_position . $title;
				}
			}

			$item_output .= Astra_Icons::get_icons( 'arrow' );

			$item_output     .= $args->link_before . $title . $args->link_after;
			$astra_arrow_icon = Astra_Icons::get_icons( 'arrow' );

			$role = 'application';

			$custom_tabindex = true === astra_addon_builder_helper()->is_header_footer_builder_active ? 'tabindex="0"' : '';

			if ( $args->walker->has_children && ( true === astra_addon_builder_helper()->is_header_footer_builder_active || Astra_Icons::is_svg_icons() ) ) {
				$item_output .= $astra_arrow_icon ? '<span role="' . esc_attr( $role ) . '" class="dropdown-menu-toggle ast-header-navigation-arrow" ' . $custom_tabindex . ' aria-expanded="false" aria-label="' . esc_attr__( 'Menu Toggle', 'astra-addon' ) . '"  >' . $astra_arrow_icon . '</span>' : '';
			}

			if ( 0 == $depth && 'ast-hf-mobile-menu' !== $args->menu_id && 'ast-desktop-toggle-menu' !== $args->menu_id && false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$item_output .= '<span class="sub-arrow"></span>';
			}

			$item_output .= '</a>';

			if ( '' != $this->megamenu && isset( $item->megamenu_content_src ) && 'default' != $item->megamenu_content_src ) {

				ob_start();

				$content = '';

				switch ( $item->megamenu_content_src ) {

					case 'template':
						// Get ID.
						$template_id = $item->megamenu_template;

						// Get template content.
						if ( ! empty( $template_id ) ) {

							$content .= '<div class="ast-mm-custom-content ast-mm-template-content">';

							$page_builder_base_instance = Astra_Addon_Page_Builder_Compatibility::get_instance();
							$page_builder_instance      = $page_builder_base_instance->get_active_page_builder( $template_id );

							$page_builder_instance->render_content( $template_id );

							$content .= ob_get_contents();

							$content .= '</div>';
						}

						break;

					case 'custom_text':
						$content  = '<div class="ast-mm-custom-content ast-mm-custom-text-content">';
						$content .= do_shortcode( $item->megamenu_custom_text );
						$content .= '</div>';

						break;

					case 'widget':
						$astra_nav_support_object = Astra_Ext_Nav_Widget_Support::get_instance();
						$widgets                  = explode( ',', $item->megamenu_widgets_list );

						if ( ! empty( $widgets ) ) {
							$content = '<div class="ast-mm-custom-content ast-mm-widget-content">';

							foreach ( $widgets as $widget_id ) {

								$content .= $astra_nav_support_object->display_widget( $widget_id );
							}
							$content .= '</div>';
						}

						break;

					default:
						// code...
						break;
				}

				ob_end_clean();

				$item_output .= $content;

			}

			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $item        Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}

		/**
		 * Modified the menu end.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu().
		 */
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {

			// </li> output.
			$output .= '</li>';
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu().
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {

			$indent  = str_repeat( "\t", $depth );
			$output .= "$indent</ul>\n";
		}
	}
}
