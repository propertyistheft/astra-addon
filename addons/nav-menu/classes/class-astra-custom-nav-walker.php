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
	class Astra_Custom_Nav_Walker extends Walker_Nav_Menu {

		/**
		 * Use full width mega menu?
		 *
		 * @access  private
		 * @var string
		 */
		private $menu_megamenu_width = '';

		/**
		 * How many columns should the mega menu have?
		 *
		 * @access  private
		 * @var int
		 */
		private $num_of_columns = 0;

		/**
		 * Menu item ID.
		 *
		 * @access  private
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

			$style = '';

			if ( 0 === $depth && '' != $this->megamenu && 'ast-hf-mobile-menu' !== $args->menu_id ) {

				$style = array(
					'.ast-desktop .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item > .menu-link, .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item .sub-menu > .menu-link, .ast-desktop .ast-container .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item:hover' => array(
						'color' => $this->megamenu_text_color,
					),
					'.ast-container .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item .sub-menu .menu-item:hover, .ast-desktop .ast-container .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item .menu-link:hover, .ast-container .menu-item-' . $this->menu_megamenu_item_id . ' .menu-item .sub-menu .menu-link:hover' => array(
						'color' => $this->megamenu_text_h_color,
					),
				);

				$megamenu_divider_class = '';

				if ( isset( $this->megamenu_divider_color ) && '' != $this->megamenu_divider_color ) {
					$megamenu_divider_class = ' astra-megamenu-has-divider';
					$style[ '.ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ':hover .astra-megamenu > .menu-item' ] = array(
						'border-right' => '1px solid ' . $this->megamenu_divider_color,
					);
				}

				if ( isset( $this->megamenu_separator_color ) && '' != $this->megamenu_separator_color ) {
					$style['.ast-desktop .astra-megamenu-li .sub-menu .menu-item-heading > .menu-link'] = array(
						'border-bottom' => '1px solid ' . $this->megamenu_separator_color,
					);
				}

				if ( isset( $this->megamenu_bg_image ) ) {

					$bg_object = array(
						'background-color'    => $this->megamenu_bg_color,
						'background-image'    => $this->megamenu_bg_image,
						'background-repeat'   => $this->megamenu_bg_repeat,
						'background-size'     => $this->megamenu_bg_size,
						'background-position' => $this->megamenu_bg_position,
					);

					$style[ '.ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-full-megamenu-wrapper, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-menu-container, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-content, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-custom' ] = astra_get_megamenu_background_obj( $bg_object );
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

				$style[ '.ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' div.astra-full-megamenu-wrapper, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' ul.astra-mega-menu-width-menu-container, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' ul.astra-mega-menu-width-content, .ast-desktop .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' ul.astra-mega-menu-width-custom' ] = astra_get_megamenu_spacing_css( $margin_object );

				$padding_object = array(
					'padding-top'    => $this->megamenu_padding_top,
					'padding-right'  => $this->megamenu_padding_right,
					'padding-bottom' => $this->megamenu_padding_bottom,
					'padding-left'   => $this->megamenu_padding_left,
				);

				$style[ '.ast-desktop .ast-mega-menu-enabled .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-full-megamenu-wrapper, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-menu-container, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-content, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li.menu-item-' . $this->menu_megamenu_item_id . ' .astra-mega-menu-width-custom' ] = astra_get_megamenu_spacing_css( $padding_object );

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
		 * Modified the menu output.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu().
		 * @param int    $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			if ( 0 === $depth ) {
				$this->megamenu = get_post_meta( $item->ID, '_menu_item_megamenu', true );

				$this->megamenu_width        = get_post_meta( $item->ID, '_menu_item_megamenu_width', true );
				$this->megamenu_custom_width = get_post_meta( $item->ID, '_menu_item_megamenu_custom_width', true );

				$this->megamenu_bg_image = get_post_meta( $item->ID, '_menu_item_megamenu_background_image', true );

				$this->megamenu_text_color   = get_post_meta( $item->ID, '_menu_item_megamenu_text_color', true );
				$this->megamenu_text_h_color = get_post_meta( $item->ID, '_menu_item_megamenu_text_h_color', true );

				$this->megamenu_bg_size     = get_post_meta( $item->ID, '_menu_item_megamenu_bg_size', true );
				$this->megamenu_bg_repeat   = get_post_meta( $item->ID, '_menu_item_megamenu_bg_repeat', true );
				$this->megamenu_bg_position = get_post_meta( $item->ID, '_menu_item_megamenu_bg_position', true );

				$this->megamenu_bg_color = get_post_meta( $item->ID, '_menu_item_megamenu_bg_color', true );

				$this->megamenu_divider_color = get_post_meta( $item->ID, '_menu_item_megamenu_column_divider_color', true );

				$this->num_of_columns = 0;

				$this->menu_megamenu_item_id = $item->ID;

				$this->megamenu_margin_top    = get_post_meta( $item->ID, '_menu_item_megamenu_margin_top', true );
				$this->megamenu_margin_right  = get_post_meta( $item->ID, '_menu_item_megamenu_margin_right', true );
				$this->megamenu_margin_bottom = get_post_meta( $item->ID, '_menu_item_megamenu_margin_bottom', true );
				$this->megamenu_margin_left   = get_post_meta( $item->ID, '_menu_item_megamenu_margin_left', true );

				$this->megamenu_padding_top    = get_post_meta( $item->ID, '_menu_item_megamenu_padding_top', true );
				$this->megamenu_padding_right  = get_post_meta( $item->ID, '_menu_item_megamenu_padding_right', true );
				$this->megamenu_padding_bottom = get_post_meta( $item->ID, '_menu_item_megamenu_padding_bottom', true );
				$this->megamenu_padding_left   = get_post_meta( $item->ID, '_menu_item_megamenu_padding_left', true );
			}

			$this->menu_megamenu_individual_item_id = $item->ID;
			$this->megamenu_disable_link            = get_post_meta( $item->ID, '_menu_item_megamenu_disable_link', true );
			$this->megamenu_disable_title           = get_post_meta( $item->ID, '_menu_item_megamenu_disable_title', true );
			$this->megamenu_enable_heading          = get_post_meta( $item->ID, '_menu_item_megamenu_enable_heading', true );
			$this->megamenu_separator_color         = get_post_meta( $item->ID, '_menu_item_megamenu_heading_separator_color', true );

			// Set up empty variable.
			$class_names = '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			if ( 'megamenu' === $this->megamenu && 'enable-heading' === $item->megamenu_enable_heading /*&& 0 != $depth*/ ) {
				$classes[] = 'menu-item-heading';
			}

			if ( isset( $this->megamenu_separator_color ) && '' != $this->megamenu_separator_color ) {
				$style = array(
					'.ast-desktop .astra-megamenu-li .menu-item-' . $this->menu_megamenu_individual_item_id . '.menu-item-heading > .menu-link, .ast-desktop .ast-mega-menu-enabled.submenu-with-border .astra-megamenu-li .menu-item-' . $this->menu_megamenu_individual_item_id . '.menu-item-heading > .menu-link, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li .menu-item-' . $this->menu_megamenu_individual_item_id . '.menu-item-heading > .menu-link' => array(
						'border-bottom' => '1px solid ' . $this->megamenu_separator_color,
					),
				);
				Astra_Ext_Nav_Menu_Loader::add_css( astra_parse_css( $style ) );
			}

			// Mega menu and Hide headings.
			if ( 0 === $depth && $this->has_children && '' != $this->megamenu && 'ast-hf-mobile-menu' !== $args->menu_id ) {
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
					'.ast-desktop .menu-item-' . $item->ID . ' .astra-mm-highlight-label' => array(
						'color'            => $item->megamenu_label_color,
						'background-color' => $item->megamenu_label_bg_color,
					),
				);

				Astra_Ext_Nav_Menu_Loader::add_css( astra_parse_css( $style ) );

				$title .= '<span class="astra-mm-highlight-label">' . esc_html( $item->megamenu_highlight_label ) . '</span>';
			}

			$item_output .= Astra_Icons::get_icons( 'arrow' );

			$item_output .= $args->link_before . $title . $args->link_after;

			if ( $args->walker->has_children ) {
				$item_output .= Astra_Icons::get_icons( 'arrow' );
			}

			if ( 0 == $depth && 'ast-hf-mobile-menu' !== $args->menu_id ) {
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
