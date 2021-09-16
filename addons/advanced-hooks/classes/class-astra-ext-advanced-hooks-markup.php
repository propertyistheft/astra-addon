<?php
/**
 * Advanced Hooks Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Advanced_Hooks_Markup' ) ) {

	/**
	 * Advanced Hooks Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Advanced_Hooks_Markup {


		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var bool is_layout_content_in_process
		 */
		private $is_layout_content_in_process = false;

		/**
		 *  Initiator
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
			add_action( 'wp', array( $this, 'load_advanced_hooks_template' ), 1 );
			add_action( 'wp', array( $this, 'load_markup' ), 1 );
			add_action( 'wp', array( $this, 'remove_navigation_markup' ), 1 );

			if ( defined( 'UAGB_VER' ) && version_compare( preg_replace( '/[^0-9\.]/', '', UAGB_VER ), '1.23.0', '>=' ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'load_ultimate_gutenberg_blocks_assets' ) );
			} else {
				add_action( 'wp', array( $this, 'load_ultimate_gutenberg_blocks_assets' ) );
			}
			add_action( 'template_redirect', array( $this, 'advanced_hook_template_frontend' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_styles' ) );
			add_action( 'astra_advanced_hook_template', array( $this, 'template_empty_content' ) );

			add_filter( 'wp_enqueue_scripts', array( $this, 'advanced_hook_scripts' ) );
			add_filter( 'the_content', array( $this, 'advanced_hook_content_markup' ) );
			add_filter( 'single_template', array( $this, 'get_custom_post_type_template' ) );

			/* Add Body Classes */
			add_filter( 'body_class', array( $this, 'body_classes' ), 10, 1 );

			add_action( 'astra_get_css_files', array( $this, 'add_front_styles' ) );
			add_action( 'astra_get_js_files', array( $this, 'add_scripts' ) );
			add_filter( 'astra_addon_js_localize', array( $this, 'localize_variables' ) );
			add_filter( 'astra_dynamic_css', array( $this, 'astra_ext_advanced_hooks_dynamic_css' ) );
		}


		/**
		 * Get the classes for custom layout.
		 *
		 * @param int  $post_id post id.
		 * @param bool $layout is header | footer | 404-page.
		 */
		private function prepare_astra_header_filter( $post_id, $layout ) {

			$hide_classes = explode( ' ', $this->get_display_device( $post_id, false ) );

			if ( 'footer' === $layout && true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				add_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ), 1 );
			}

			if ( ! static::get_time_duration_eligibility( $post_id ) ) {
				return;
			}

			if ( 3 === count( $hide_classes ) ) { // If displayed on desktop, tablet & mobile.

				switch ( $layout ) {
					case 'header':
						remove_action( 'astra_header', 'astra_header_markup' );
						break;
					case 'footer':
						remove_action( 'astra_footer', 'astra_footer_markup' );
						if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
							remove_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ), 1 );
						}
						break;
					case '404-page':
						remove_action( 'astra_entry_content_404_page', 'astra_entry_content_404_page_template' );
						break;
				}

				return;

			}

			switch ( $layout ) {
				case 'header':
				case 'footer':
					$filter = 'astra_get_' . $layout . '_classes';
					break;
				case '404-page':
					$filter = 'astra_attr_404_page';
					break;
				default:
					$filter = '';
					break;
			}

			if ( $filter ) {
				add_filter(
					$filter,
					function ( $classes ) use ( $hide_classes, $layout ) {
						if ( '404-page' === $layout ) {
							$hide_classes     = implode( ' ', $hide_classes );
							$classes['class'] = isset( $classes['class'] ) ? $classes['class'] . ' ' . $hide_classes : $hide_classes;
							return $classes;
						}
						return array_merge( $classes, $hide_classes );
					}
				);
			}

		}

		/**
		 * Empty Content area for Advanced hooks.
		 *
		 * @return void
		 */
		public function template_empty_content() {
			$post_id = get_the_id();
			$layout  = get_post_meta( $post_id, 'ast-advanced-hook-layout', true );
			if ( empty( $layout ) ) {
				the_content();
			}
		}

		/**
		 * Custom template for Advanced Hook post type.
		 *
		 * @param  string $template Single Post template path.
		 * @return string
		 */
		public function get_custom_post_type_template( $template ) {
			global $post;

			$post_id = get_the_id();
			$action  = get_post_meta( $post_id, 'ast-advanced-hook-action', true );
			$layout  = get_post_meta( $post_id, 'ast-advanced-hook-layout', true );

			// Dispaly single post content as normal post content only for woocommerce actions.
			$woocommerce_hooks     = array( 'woo-global', 'woo-shop', 'woo-product', 'woo-cart', 'woo-checkout', 'woo-distraction-checkout', 'woo-account' );
			$woocommerce_activated = false;

			if ( ASTRA_ADVANCED_HOOKS_POST_TYPE == $post->post_type ) {
				if ( 'hooks' === $layout ) {
					foreach ( Astra_Ext_Advanced_Hooks_Meta::$hooks as $key => $value ) {
						if ( in_array( $key, $woocommerce_hooks ) && isset( Astra_Ext_Advanced_Hooks_Meta::$hooks[ $key ]['hooks'][ $action ] ) ) {
							$woocommerce_activated = true;
						}
					}
				}

				// Exclude rendeting the content in correct action for WooCommerce and 404 Layout.
				if ( ( 'hooks' === $layout && false == $woocommerce_activated ) || 'header' === $layout || 'footer' === $layout ) {
					$template = ASTRA_EXT_ADVANCED_HOOKS_DIR . '/template/template.php';
				}
			}

			return $template;
		}


		/**
		 * Load Advanced hook markup.
		 *
		 * @return void
		 */
		public function load_advanced_hooks_template() {

			if ( is_singular( ASTRA_ADVANCED_HOOKS_POST_TYPE ) ) {
				$post_id  = get_the_id();
				$action   = get_post_meta( $post_id, 'ast-advanced-hook-action', true );
				$layout   = get_post_meta( $post_id, 'ast-advanced-hook-layout', true );
				$priority = get_post_meta( $post_id, 'ast-advanced-hook-priority', true );

				// Exclude default p tag wrapper from the content if selected hook is from below list.
				$exclude_wrapper_hooks = array( 'astra_html_before', 'astra_body_top', 'astra_head_top', 'astra_head_bottom', 'wp_head', 'astra_body_bottom', 'wp_footer' );
				$with_wrapper          = in_array( $action, $exclude_wrapper_hooks );
				if ( $with_wrapper ) {
					remove_filter( 'the_content', 'wpautop' );
				}

				$astra_hooks = Astra_Ext_Advanced_Hooks_Meta::$hooks;
				if ( isset( $astra_hooks['content']['hooks'][ $action ] ) || isset( $astra_hooks['comment']['hooks'][ $action ] ) || isset( $astra_hooks['sidebar']['hooks'][ $action ] ) ) {

					$action = 'astra_advanced_hook_template';
				}

				$vc_activated = Astra_Addon_Page_Builder_Compatibility::is_vc_activated( $post_id );
				if ( 'astra_advanced_hook_template' == $action || $vc_activated ) {
					remove_action( 'astra_advanced_hook_template', array( $this, 'template_empty_content' ) );
					add_action( 'astra_advanced_hook_template', 'the_content' );
				} elseif ( 'header' == $layout ) {

					$this->prepare_astra_header_filter( $post_id, 'header' );

					// remove default site's fixed header if sticky header is activated.
					add_filter( 'astra_fixed_header_markup_enabled', '__return_false' );

					$action = 'astra_custom_header';
					// if astra_custom_header not exist then call astra_header.
					if ( ! has_action( 'astra_custom_header' ) ) {
						$action = 'astra_header';
					}

					add_action(
						$action,
						function() use ( $post_id ) {
							echo '<header class="ast-custom-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">';

								Astra_Ext_Advanced_Hooks_Markup::get_instance()->get_the_hook_content();

							echo '</header>';
						},
						$priority
					);
				} elseif ( 'footer' == $layout ) {

					$this->prepare_astra_header_filter( $post_id, 'footer' );

					$action = 'astra_custom_footer';
					// if astra_custom_footer not exist then call astra_footer.
					if ( ! has_action( 'astra_custom_footer' ) ) {
						$action = 'astra_footer';
					}

					// Add Action for custom header advanced-hooks.
					add_action(
						$action,
						function() use ( $post_id ) {
							echo '<footer class="ast-custom-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">';

								Astra_Ext_Advanced_Hooks_Markup::get_instance()->get_the_hook_content();

							echo '</footer>';
						},
						$priority
					);
				} else {
					add_action(
						$action,
						function() use ( $post_id ) {

							Astra_Ext_Advanced_Hooks_Markup::get_instance()->get_the_hook_content();

						},
						$priority
					);
				}
			}
		}

		/**
		 * Get the content of the hook
		 */
		public function get_the_hook_content() {
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
		}

		/**
		 * Filter content markup for Advanced Hook post type.
		 *
		 * @param  html $content the_content markup.
		 * @return html
		 */
		public function advanced_hook_content_markup( $content ) {
			if ( is_singular( ASTRA_ADVANCED_HOOKS_POST_TYPE ) ) {
				$post_id = get_the_id();

				if ( ! static::get_time_duration_eligibility( $post_id ) ) {
					return;
				}

				$php_snippet = $this->get_php_snippet( $post_id );
				if ( $php_snippet ) {
					$content = $php_snippet;
				}

				$display_device_classes = $this->get_display_device( $post_id );

				$action = get_post_meta( $post_id, 'ast-advanced-hook-action', true );
				// Exclude div wrapper if selected hook is from below list.
				$exclude_wrapper_hooks = array( 'astra_html_before', 'astra_body_top', 'astra_head_top', 'astra_head_bottom', 'wp_head', 'astra_body_bottom', 'wp_footer' );
				$with_wrapper          = ! in_array( $action, $exclude_wrapper_hooks );
				if ( $with_wrapper ) {
					$content = '<div class="astra-advanced-hook-' . esc_attr( $post_id ) . ' ' . esc_attr( $display_device_classes ) . '">' . $content . '</div>';
				}
			}
			return $content;
		}

		/**
		 * Get PHP snippet if enabled.
		 *
		 * @param  int $post_id Post Id.
		 * @return boolean|html
		 */
		public function get_php_snippet( $post_id ) {
			$php_enabled = get_post_meta( $post_id, 'editor_type', true );
			if ( 'code_editor' === $php_enabled ) {
				$code = get_post_meta( $post_id, 'ast-advanced-hook-php-code', true );
				if ( defined( 'ASTRA_ADVANCED_HOOKS_DISABLE_PHP' ) ) {
					return $code;
				}
				ob_start();
				// @codingStandardsIgnoreStart
				eval( '?>' . $code . '<?php ' );
				// @codingStandardsIgnoreEnd
				return ob_get_clean();
			}
			return false;
		}

		/**
		 * Add style for Advanced Hook post type.
		 *
		 * @return void
		 */
		public function advanced_hook_scripts() {
			if ( is_singular( ASTRA_ADVANCED_HOOKS_POST_TYPE ) ) {
				$post_id = get_the_id();
				$styles  = '';

				$padding        = get_post_meta( $post_id, 'ast-advanced-hook-padding', true );
				$padding_top    = isset( $padding['top'] ) ? $padding['top'] : '';
				$padding_top    = is_numeric( $padding_top ) ? $padding_top . 'px' : $padding_top;
				$padding_bottom = isset( $padding['bottom'] ) ? $padding['bottom'] : '';
				$padding_bottom = is_numeric( $padding_bottom ) ? $padding_bottom . 'px' : $padding_bottom;

				if ( ! ( empty( $padding_top ) && empty( $padding_bottom ) ) ) {
					$styles .= ' .astra-advanced-hook-' . $post_id . ' { ';
					if ( ! empty( $padding_top ) ) {
						$styles .= 'padding-top: ' . $padding_top . ';';
					}
					if ( ! empty( $padding_bottom ) ) {
						$styles .= 'padding-bottom: ' . $padding_bottom . ';';
					}
					$styles .= '}';
					wp_add_inline_style( 'astra-addon-css', $styles );
				}
			}
		}

		/**
		 * Remove Navigation Links.
		 */
		public function remove_navigation_markup() {
			$post_type = get_post_type();
			if ( ASTRA_ADVANCED_HOOKS_POST_TYPE == $post_type ) {
				remove_action( 'astra_entry_after', 'astra_single_post_navigation_markup' );
			}
		}

		/**
		 * Add Styles
		 */
		public function add_styles() {

			$option = array(
				'location'  => 'ast-advanced-hook-location',
				'exclusion' => 'ast-advanced-hook-exclusion',
				'users'     => 'ast-advanced-hook-users',
			);

			$result = Astra_Target_Rules_Fields::get_instance()->get_posts_by_conditions( ASTRA_ADVANCED_HOOKS_POST_TYPE, $option );

			foreach ( $result as $post_id => $post_data ) {

				if ( class_exists( 'Astra_Addon_Page_Builder_Compatibility' ) ) {
					$page_builder_base_instance = Astra_Addon_Page_Builder_Compatibility::get_instance();

					$page_builder_instance = $page_builder_base_instance->get_active_page_builder( $post_id );

					if ( is_callable( array( $page_builder_instance, 'enqueue_scripts' ) ) ) {
						$page_builder_instance->enqueue_scripts( $post_id );
					}
				}
			}
		}

		/**
		 * Load all Guttenberg compatibility styles & scripts.
		 *
		 * @since 2.5.1
		 */
		public function load_ultimate_gutenberg_blocks_assets() {

			$option = array(
				'location'  => 'ast-advanced-hook-location',
				'exclusion' => 'ast-advanced-hook-exclusion',
				'users'     => 'ast-advanced-hook-users',
			);

			$result = Astra_Target_Rules_Fields::get_instance()->get_posts_by_conditions( ASTRA_ADVANCED_HOOKS_POST_TYPE, $option );

			foreach ( $result as $post_id => $post_data ) {

				if ( class_exists( 'Astra_Addon_Gutenberg_Compatibility' ) ) {

					$astra_gutenberg_instance = new Astra_Addon_Gutenberg_Compatibility();

					if ( is_callable( array( $astra_gutenberg_instance, 'enqueue_blocks_assets' ) ) ) {
						$astra_gutenberg_instance->enqueue_blocks_assets( $post_id );
					}
				}
			}
		}

		/**
		 * Don't display the elementor header footer templates on the frontend for non edit_posts capable users.
		 *
		 * @since  1.0.0
		 */
		public function advanced_hook_template_frontend() {
			if ( is_singular( ASTRA_ADVANCED_HOOKS_POST_TYPE ) && ! current_user_can( 'edit_posts' ) ) {
				wp_safe_redirect( site_url(), 301 );
				die;
			}
		}

		/**
		 * Advanced Hooks markup loader
		 *
		 * Loads appropriate template file based on the style option selected in options panel.
		 *
		 * @since 1.0.0
		 */
		public function load_markup() {

			$option = array(
				'location'  => 'ast-advanced-hook-location',
				'exclusion' => 'ast-advanced-hook-exclusion',
				'users'     => 'ast-advanced-hook-users',
			);

			$result             = Astra_Target_Rules_Fields::get_instance()->get_posts_by_conditions( ASTRA_ADVANCED_HOOKS_POST_TYPE, $option );
			$header_counter     = 0;
			$footer_counter     = 0;
			$layout_404_counter = 0;

			foreach ( $result as $post_id => $post_data ) {
				$post_type = get_post_type();

				if ( ASTRA_ADVANCED_HOOKS_POST_TYPE != $post_type ) {
					$action   = get_post_meta( $post_id, 'ast-advanced-hook-action', true );
					$layout   = get_post_meta( $post_id, 'ast-advanced-hook-layout', false );
					$priority = get_post_meta( $post_id, 'ast-advanced-hook-priority', true );
					add_action(
						'wp_enqueue_scripts',
						function() use ( $post_id ) {

							$styles = '';

							// Add VC style if it is activated.
							$wpb_custom_css = get_post_meta( $post_id, '_wpb_shortcodes_custom_css', true );
							$styles        .= $wpb_custom_css;

							$padding        = get_post_meta( $post_id, 'ast-advanced-hook-padding', true );
							$padding_top    = isset( $padding['top'] ) ? $padding['top'] : '';
							$padding_top    = is_numeric( $padding_top ) ? $padding_top . 'px' : $padding_top;
							$padding_bottom = isset( $padding['bottom'] ) ? $padding['bottom'] : '';
							$padding_bottom = is_numeric( $padding_bottom ) ? $padding_bottom . 'px' : $padding_bottom;

							if ( ! ( empty( $padding_top ) && empty( $padding_bottom ) ) ) {
								$styles .= ' .astra-advanced-hook-' . $post_id . ' { ';
								if ( ! empty( $padding_top ) ) {
									$styles .= 'padding-top: ' . $padding_top . ';';
								}
								if ( ! empty( $padding_bottom ) ) {
									$styles .= 'padding-bottom: ' . $padding_bottom . ';';
								}
								$styles .= '}';
								wp_add_inline_style( 'astra-addon-css', $styles );
							}
						}
					);

					if ( isset( $layout[0] ) && '404-page' == $layout[0] && 0 == $layout_404_counter ) {

						$this->prepare_astra_header_filter( $post_id, '404-page' );

						add_action( 'astra_get_content_layout', 'astra_return_content_layout_page_builder' );
						add_action( 'astra_page_layout', 'astra_return_page_layout_no_sidebar' );

						$layout_404_settings = get_post_meta( $post_id, 'ast-404-page', true );
						if ( isset( $layout_404_settings['disable_header'] ) && 'enabled' == $layout_404_settings['disable_header'] ) {
							remove_action( 'astra_header', 'astra_header_markup' );
							if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
								remove_action( 'astra_header', array( Astra_Builder_Header::get_instance(), 'prepare_header_builder_markup' ) );
							}
						}

						if ( isset( $layout_404_settings['disable_footer'] ) && 'enabled' == $layout_404_settings['disable_footer'] ) {
							remove_action( 'astra_footer', 'astra_footer_markup' );
							if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
								remove_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ) );
							}
						}

						add_action(
							'astra_entry_content_404_page',
							function() use ( $post_id ) {
									Astra_Ext_Advanced_Hooks_Markup::get_instance()->get_action_content( $post_id );
							},
							$priority
						);

						$layout_404_counter ++;
					} elseif ( isset( $layout[0] ) && 'header' == $layout[0] && 0 == $header_counter ) {

						$this->prepare_astra_header_filter( $post_id, 'header' );

						if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
							remove_action( 'astra_header', array( Astra_Builder_Header::get_instance(), 'prepare_header_builder_markup' ) );
						}
						// remove default site's fixed header if sticky header is activated.
						add_filter( 'astra_fixed_header_markup_enabled', '__return_false' );

						$action = 'astra_custom_header';
						// if astra_custom_header not exist then call astra_header.
						if ( ! has_action( 'astra_custom_header' ) ) {
							$action = 'astra_header';
						}
						add_action(
							$action,
							function() use ( $post_id ) {
								echo '<header class="ast-custom-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">';
									Astra_Ext_Advanced_Hooks_Markup::get_instance()->get_action_content( $post_id );
								echo '</header>';
							},
							$priority
						);
						$header_counter++;
					} elseif ( isset( $layout[0] ) && 'footer' == $layout[0] && 0 == $footer_counter ) {

						$this->prepare_astra_header_filter( $post_id, 'footer' );

						if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
							remove_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ) );
						}

						$action = 'astra_custom_footer';
						// if astra_custom_footer not exist then call astra_footer.
						if ( ! has_action( 'astra_custom_footer' ) ) {
							$action = 'astra_footer';
						}

						// Add Action for custom header advanced-hooks.
						add_action(
							$action,
							function() use ( $post_id ) {
								echo '<footer class="ast-custom-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">';

								Astra_Ext_Advanced_Hooks_Markup::get_instance()->get_action_content( $post_id );

								echo '</footer>';
							},
							$priority
						);
						$footer_counter++;
					} elseif ( isset( $layout[0] ) && 'content' == $layout[0] ) {

						add_filter(
							'render_block',
							function ( $content, $parsed_block ) use ( $post_id ) {
								return Astra_Ext_Advanced_Hooks_Markup::get_instance()->render_inside_content( $post_id, $content, $parsed_block );
							},
							10,
							2
						);

					}
					if ( isset( $layout[0] ) && '0' != $layout[0] && 'header' != $layout[0] && 'footer' != $layout[0] ) {
						// Add Action for advanced-hooks.
						add_action(
							$action,
							function() use ( $post_id ) {

								Astra_Ext_Advanced_Hooks_Markup::get_instance()->get_action_content( $post_id );

							},
							$priority
						);
					}
				}
			}
		}

		/**
		 * Generates block array with layout content.
		 *
		 * @param int $post_id Post ID.
		 * @since 3.2.0
		 */
		public function generate_blocks( $post_id ) {

			$blocks = array();
			ob_start();
			self::get_instance()->get_action_content( $post_id );
			$content = ob_get_clean();

			$blocks = array(
				array(
					'blockName'    => 'core/html',
					'attrs'        => array(),
					'innerBlocks'  => array(),
					'innerHTML'    => $content,
					'innerContent' => array( $content ),
				),
			);

			return $blocks;
		}

		/**
		 * Insert array at specific position.
		 *
		 * @param array $array Array.
		 * @param int   $position position of new array element.
		 * @param array $insert_array Array needs to be inserted.
		 * @since 3.2.0
		 */
		public function array_insert( &$array, $position, $insert_array ) {
			$first_array = array_splice( $array, 0, $position );
			$array       = array_merge( $first_array, $insert_array, $array );
		}


		/**
		 * Prepare a class to hide custom layout as per selected device.
		 *
		 * @param int  $post_id post id.
		 * @param bool $hide_classes get the hide/show classes.
		 * @return string
		 */
		public function get_display_device( $post_id, $hide_classes = true ) {
			$classes        = '';
			$display_device = get_post_meta( $post_id, 'ast-advanced-display-device', true );
			$devices        = array( 'desktop', 'tablet', 'mobile' );

			if ( '' === $display_device ) {
				$display_device = $devices; // Managing backward compatibility.
			}

			if ( ! is_array( $display_device ) ) {
				return $classes;
			}

			if ( $hide_classes ) {
				$devices        = array( 'desktop', 'tablet', 'mobile' );
				$display_device = array_diff( $devices, $display_device );
			}

			if ( ! empty( $display_device ) ) {
				$classes = implode( ' ', preg_filter( '/^/', 'ast-hide-display-device-', $display_device ) );
			}
			return $classes;
		}


		/**
		 * Check if post eligible to show on time duration
		 *
		 *  @param int $post_id post id.
		 */
		public static function get_time_duration_eligibility( $post_id ) {

			$time_duration = get_post_meta( $post_id, 'ast-advanced-time-duration', 'true' );

			if ( isset( $time_duration['enabled'] ) && 'enabled' !== $time_duration['enabled'] ) {
				return true; // Eligible to display as not enabled time duration.
			}

			$start_dt   = isset( $time_duration['start-dt'] ) ? strtotime( $time_duration['start-dt'] ) : false;
			$end_dt     = isset( $time_duration['end-dt'] ) ? strtotime( $time_duration['end-dt'] ) : false;
			$current_dt = strtotime( current_time( 'mysql' ) );

			if ( $start_dt && $start_dt > $current_dt ) {
				return false; // Not eligible if not started yet.
			}

			if ( $end_dt && $end_dt < $current_dt ) {
				return false; // Not eligible if already time passed.
			}

			return true; // Fallback true.
		}

		/**
		 * Advanced Hooks get content
		 *
		 * Loads content
		 *
		 * @since 1.0.0
		 * @param int $post_id post id.
		 */
		public function get_action_content( $post_id ) {

			if ( false === apply_filters( 'astra_addon_render_custom_layout_content', true, $post_id ) ) {
				return;
			}

			if ( ! static::get_time_duration_eligibility( $post_id ) ) {
				return;
			}

			$action                 = get_post_meta( $post_id, 'ast-advanced-hook-action', true );
			$display_device_classes = $this->get_display_device( $post_id );

			// Exclude div wrapper if selected hook is from below list.
			$exclude_wrapper_hooks = array( 'astra_html_before', 'astra_body_top', 'astra_head_top', 'astra_head_bottom', 'wp_head', 'astra_body_bottom', 'wp_footer' );
			$with_wrapper          = ! in_array( $action, $exclude_wrapper_hooks );
			if ( $with_wrapper ) {
				echo '<div class="astra-advanced-hook-' . esc_attr( $post_id ) . ' ' . esc_attr( $display_device_classes ) . '">';
			}

			$php_snippet = $this->get_php_snippet( $post_id );
			if ( $php_snippet ) {
				echo $php_snippet; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			} else {

				if ( class_exists( 'Astra_Addon_Page_Builder_Compatibility' ) ) {

					$page_builder_base_instance = Astra_Addon_Page_Builder_Compatibility::get_instance();

					$page_builder_instance = $page_builder_base_instance->get_active_page_builder( $post_id );

					$page_builder_instance->render_content( $post_id );

				}
			}

			if ( $with_wrapper ) {
				echo '</div>';
			}
		}

		/**
		 * Add Styles Callback
		 */
		public function add_front_styles() {
			/**
			* Start Path Logic */
			/* Define Variables */
			$uri  = ASTRA_EXT_ADVANCED_HOOKS_URL . 'assets/css/';
			$path = ASTRA_EXT_ADVANCED_HOOKS_DIR . 'assets/css/';
			$rtl  = '';

			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			/* Directory and Extension */
			$file_prefix = $rtl . '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = $rtl;
				$dir_name    = 'unminified';
			}

			$css_uri = $uri . $dir_name . '/';
			$css_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $css_uri;
			} else {
				$gen_path = $css_dir;
			}

			/*** End Path Logic */
			Astra_Minify::add_css( $gen_path . 'astra-hooks-sticky-header-footer' . $file_prefix . '.css' );
			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );
		}

		/**
		 * Add Scripts Callback
		 */
		public function add_scripts() {
			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_EXT_ADVANCED_HOOKS_URL . 'assets/js/';
			$path = ASTRA_EXT_ADVANCED_HOOKS_DIR . 'assets/js/';

			/* Directory and Extension */
			$file_prefix = '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = '';
				$dir_name    = 'unminified';
			}

			$js_uri = $uri . $dir_name . '/';
			$js_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $js_uri;
			} else {
				$gen_path = $js_dir;
			}

			/*** End Path Logic */
			Astra_Minify::add_dependent_js( 'jquery' );

			Astra_Minify::add_js( $gen_path . 'advanced-hooks-sticky-header-footer' . $file_prefix . '.js' );
		}

		/**
		 * Add Localize variables
		 *
		 * @param  array $localize_vars Localize variables array.
		 * @return array
		 */
		public function localize_variables( $localize_vars ) {

			$option = array(
				'location'  => 'ast-advanced-hook-location',
				'exclusion' => 'ast-advanced-hook-exclusion',
				'users'     => 'ast-advanced-hook-users',
			);

			$result         = Astra_Target_Rules_Fields::get_instance()->get_posts_by_conditions( ASTRA_ADVANCED_HOOKS_POST_TYPE, $option );
			$counter_header = 0;
			$counter_footer = 0;

			foreach ( $result as $post_id => $post_data ) {
				$post_type = get_post_type();

				if ( ASTRA_ADVANCED_HOOKS_POST_TYPE != $post_type ) {
					$header = get_post_meta( $post_id, 'ast-advanced-hook-header', true );
					$footer = get_post_meta( $post_id, 'ast-advanced-hook-footer', true );
					$layout = get_post_meta( $post_id, 'ast-advanced-hook-layout', false );

					if ( 0 == $counter_header && isset( $layout[0] ) && 'header' == $layout[0] ) {
						$localize_vars['hook_sticky_header']            = isset( $header['sticky'] ) ? $header['sticky'] : '';
						$localize_vars['hook_shrink_header']            = isset( $header['shrink'] ) ? $header['shrink'] : '';
						$localize_vars['hook_sticky_header_on_devices'] = isset( $header['sticky-header-on-devices'] ) ? $header['sticky-header-on-devices'] : '';

						$localize_vars['hook_custom_header_break_point'] = apply_filters( 'astra_custom_header_break_point', 921 );

						$counter_header++;
					}

					if ( 0 == $counter_footer && isset( $layout[0] ) && 'footer' == $layout[0] ) {
						$localize_vars['hook_sticky_footer']             = isset( $footer['sticky'] ) ? $footer['sticky'] : '';
						$localize_vars['hook_sticky_footer_on_devices']  = isset( $footer['sticky-footer-on-devices'] ) ? $footer['sticky-footer-on-devices'] : '';
						$localize_vars['hook_custom_footer_break_point'] = apply_filters( 'astra_custom_footer_break_point', 921 );

						$counter_footer++;
					}
				}
			}

			return $localize_vars;
		}

		/**
		 * Add Body Classes
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Apply Above Below header layout class to the body.
				$option = array(
					'location'  => 'ast-advanced-hook-location',
					'exclusion' => 'ast-advanced-hook-exclusion',
					'users'     => 'ast-advanced-hook-users',
				);

				$result  = Astra_Target_Rules_Fields::get_instance()->get_posts_by_conditions( ASTRA_ADVANCED_HOOKS_POST_TYPE, $option );
				$counter = 0;
				foreach ( $result as $post_id => $post_data ) {
					$post_type = get_post_type();

					if ( ASTRA_ADVANCED_HOOKS_POST_TYPE != $post_type ) {
						$footer = get_post_meta( $post_id, 'ast-advanced-hook-footer', true );
						$layout = get_post_meta( $post_id, 'ast-advanced-hook-layout', false );

						if ( 0 == $counter && isset( $layout[0] ) && 'footer' == $layout[0] ) {

							if ( isset( $footer['sticky'] ) && 'enabled' == $footer['sticky'] && isset( $footer['sticky-footer-on-devices'] ) && ( 'desktop' == $footer['sticky-footer-on-devices'] || 'both' == $footer['sticky-footer-on-devices'] ) && ! wp_is_mobile() ) {
								$classes[] = 'ast-footer-sticky-active';
							}
							if ( isset( $footer['sticky'] ) && 'enabled' == $footer['sticky'] && isset( $footer['sticky-footer-on-devices'] ) && 'mobile' == $footer['sticky-footer-on-devices'] && wp_is_mobile() ) {
								$classes[] = 'ast-footer-sticky-active';
							}
							$counter++;
						}

						if ( self::is_elementor_activated( $post_id ) && is_404() ) {
							$classes[] = 'elementor-page elementor-page-' . $post_id;
						}
					}
				}

				return $classes;
		}

		/**
		 * Dynamic CSS
		 *
		 * @param  string $dynamic_css          Astra Dynamic CSS.
		 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
		 * @return string
		 */
		public function astra_ext_advanced_hooks_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {
			/**
			 * - Variable Declaration
			 */
			$page_width = '100%';
			$parse_css  = '';
			$layout     = astra_get_option( 'site-layout', 'ast-full-width-layout' );

			// set page width depending on site layout.
			if ( 'ast-box-layout' == $layout ) {
				$page_width = astra_get_option( 'site-layout-box-width' ) . 'px';
			}

			/* Box Layout CSS */
			if ( 'ast-box-layout' == $layout ) :
				$box_css    = array(
					'.ast-custom-header, .ast-custom-footer' => array(
						'max-width'    => $page_width,
						'margin-left'  => 'auto',
						'margin-right' => 'auto',
					),
				);
				$parse_css .= astra_parse_css( $box_css );
			endif;
			return $dynamic_css . $parse_css;
		}

		/**
		 * Check is elementor activated.
		 *
		 * @param int $id Post/Page Id.
		 * @return boolean
		 */
		public static function is_elementor_activated( $id ) {
			if ( ! class_exists( '\Elementor\Plugin' ) ) {
				return false;
			}
			if ( version_compare( ELEMENTOR_VERSION, '1.5.0', '<' ) ) {
				return ( 'builder' === Elementor\Plugin::$instance->db->get_edit_mode( $id ) );
			} else {
				return Elementor\Plugin::$instance->db->is_built_with_elementor( $id );
			}

			return false;
		}

		/**
		 * Create layout blocks data to insert in content.
		 *
		 * @param int    $post_id post ID.
		 * @param string $content block content.
		 * @param array  $parsed_block Block array.
		 * @since 3.2.0
		 */
		public function render_inside_content( $post_id, $content, $parsed_block ) {

			// We don't want to run this filter when we are processing layout content as it will result in infinite loop.
			if ( true === $this->is_layout_content_in_process ) {
				return $content;
			}

			$layout_meta = get_post_meta( $post_id, 'ast-advanced-hook-content', true );
			$location    = isset( $layout_meta['location'] ) ? $layout_meta['location'] : 0;

			$this->is_layout_content_in_process = true;

			if ( 'after_blocks' === $location ) {

				$after_blocks = isset( $layout_meta['after_block_number'] ) ? $layout_meta['after_block_number'] : 0;

				// Match block index with After Blocks number and display the content.
				if (
					isset( $parsed_block['firstLevelBlock'] )
					&&
					$parsed_block['firstLevelBlock']
					&&
					isset( $parsed_block['firstLevelBlockIndex'] )
					&&
					intval(
						$parsed_block['firstLevelBlockIndex']
					) + 1 === intval( $after_blocks )
				) {
					ob_start();
					self::get_instance()->get_action_content( $post_id );
					$layout_content = ob_get_clean();
					$content       .= $layout_content;
				}
			} elseif ( 'before_headings' === $location ) {

				$headings_number = isset( $layout_meta['before_heading_number'] ) ? $layout_meta['before_heading_number'] : 0;

				// Match block index with before headings number and display the content.
				if (
					isset( $parsed_block['firstLevelBlock'] )
					&&
					$parsed_block['firstLevelBlock']
					&&
					isset( $parsed_block['firstLevelHeadingIndex'] )
					&&
					intval(
						$parsed_block['firstLevelHeadingIndex']
					) + 1 === intval( $headings_number )
				) {
					ob_start();
					self::get_instance()->get_action_content( $post_id );
					$layout_content = ob_get_clean();
					$content        = $layout_content . $content;
				}
			}

			$this->is_layout_content_in_process = false;

			return $content;
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Advanced_Hooks_Markup::get_instance();
