<?php
/**
 * WooCommerce Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'ASTRA_Ext_WooCommerce_Markup' ) ) {

	/**
	 * Advanced Search Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	class ASTRA_Ext_WooCommerce_Markup {

		/**
		 * Member Varible
		 *
		 * @var object instance
		 */
		private static $instance;

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
		 * Constructor
		 */
		public function __construct() {

			add_action( 'astra_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'astra_get_js_files', array( $this, 'add_scripts' ) );

			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'get_the_post_type_description', 'astra_woo_remove_shop_page_description', 10, 2 );

			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_filter( 'post_class', array( $this, 'post_class' ) );

			// Single product.
			add_filter( 'woocommerce_loop_add_to_cart_args', array( $this, 'add_to_cart_args' ), 10, 2 );
			add_filter( 'woocommerce_sale_flash', array( $this, 'sale_flash' ), 10, 3 );

			add_action( 'wp', array( $this, 'single_product_customization' ) );
			add_action( 'wp', array( $this, 'customization_checkout_page' ) );
			add_action( 'wp', array( $this, 'customization_cart_page' ) );

			// Load WooCommerce shop page styles.
			add_action( 'wp', array( $this, 'shop_page_styles' ) );
			$astra_woocommerce_instance = Astra_Woocommerce::get_instance();

			add_action( 'woocommerce_shop_loop', array( $this, 'init_quick_view' ), 999 );

			// Pagination.
			add_action( 'wp', array( $this, 'common_actions' ), 999 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ) );
			add_filter( 'astra_theme_js_localize', array( $this, 'shop_js_localize' ) );    // if user not logged in.

			// quick view ajax.
			add_action( 'wp_ajax_ast_load_product_quick_view', array( $this, 'ast_load_product_quick_view_ajax' ) );
			add_action( 'wp_ajax_nopriv_ast_load_product_quick_view', array( $this, 'ast_load_product_quick_view_ajax' ) );
			// Custom Template Quick View.
			$this->quick_view_content_actions();

			add_action( 'wp_ajax_astra_add_cart_single_product', array( $this, 'astra_add_cart_single_product_ajax' ) );
			add_action( 'wp_ajax_nopriv_astra_add_cart_single_product', array( $this, 'astra_add_cart_single_product_ajax' ) );

			// Register Off Canvas Sidebars.
			add_action( 'widgets_init', array( $this, 'shop_filters_sidebar' ), 15 );
			add_action( 'astra_body_bottom', array( $this, 'get_off_canvas_sidebar' ) );

			// Addon meta option.
			add_action( 'wp', array( $this, 'addons_meta_options' ) );
			add_filter( 'astra_addon_js_localize', array( $this, 'localize_variables_shop_page' ) );

			// Advanced header bg image.
			add_filter( 'astra_advanced_headers_title_bar_bg', array( $this, 'category_featured_image' ), 10, 2 );

			add_shortcode( 'astra_woo_mini_cart', array( $this, 'astra_woo_mini_cart_markup' ) );

			// Load Google fonts.
			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );
		}

		/**
		 * Add Font Family Callback
		 *
		 * @since  1.2.0
		 * @return void
		 */
		public function add_fonts() {

			$font_family_product_title = astra_get_option( 'font-family-product-title' );
			$font_weight_product_title = astra_get_option( 'font-weight-product-title' );
			Astra_Fonts::add_font( $font_family_product_title, $font_weight_product_title );

			$font_family_shop_product_title = astra_get_option( 'font-family-shop-product-title' );
			$font_weight_shop_product_title = astra_get_option( 'font-weight-shop-product-title' );
			Astra_Fonts::add_font( $font_family_shop_product_title, $font_weight_shop_product_title );

			$font_family_shop_product_price = astra_get_option( 'font-family-shop-product-price' );
			$font_weight_shop_product_price = astra_get_option( 'font-weight-shop-product-price' );
			Astra_Fonts::add_font( $font_family_shop_product_price, $font_weight_shop_product_price );

			$font_family_shop_product_content = astra_get_option( 'font-family-shop-product-content' );
			$font_weight_shop_product_content = astra_get_option( 'font-weight-shop-product-content' );
			Astra_Fonts::add_font( $font_family_shop_product_content, $font_weight_shop_product_content );

			$font_family_product_price = astra_get_option( 'font-family-product-price' );
			$font_weight_product_price = astra_get_option( 'font-weight-product-price' );
			Astra_Fonts::add_font( $font_family_product_price, $font_weight_product_price );

			$font_family_product_content = astra_get_option( 'font-family-product-content' );
			$font_weight_product_content = astra_get_option( 'font-weight-product-content' );
			Astra_Fonts::add_font( $font_family_product_content, $font_weight_product_content );

			$font_family_product_breadcrumb = astra_get_option( 'font-family-product-breadcrumb' );
			$font_weight_product_breadcrumb = astra_get_option( 'font-weight-product-breadcrumb' );
			Astra_Fonts::add_font( $font_family_product_breadcrumb, $font_weight_product_breadcrumb );
		}

		/**
		 * Mini Cart shortcode `astra_woo_mini_cart` mrakup.
		 *
		 * @since  1.2.0
		 * @param  array $atts Shortcode atts.
		 * @return html
		 */
		public function astra_woo_mini_cart_markup( $atts ) {

			$atts = shortcode_atts(
				array(
					'direction' => 'bottom left',
				),
				$atts
			);

			$output                     = '';
			$astra_woocommerce_instance = Astra_Woocommerce::get_instance();

			if ( method_exists( $astra_woocommerce_instance, 'woo_mini_cart_markup' ) ) {

				$output  = '<div class="ast-woo-mini-cart-wrapper ast-woo-mini-cart-dir ' . esc_attr( $atts['direction'] ) . '">';
				$output .= $astra_woocommerce_instance->woo_mini_cart_markup();
				$output .= '</div>';
			}

			return $output;
		}

		/**
		 * Get Off Canvas Sidebar
		 *
		 * @return void
		 */
		public function get_off_canvas_sidebar() {
			if ( 'disable' != astra_get_option( 'shop-off-canvas-trigger-type' ) && ( is_shop() || is_product_taxonomy() ) ) {
				echo '<div class="astra-off-canvas-sidebar-wrapper from-left"><div class="astra-off-canvas-sidebar"><a href="javascript:void(0)" id="cart-accessibility" class="ast-shop-filter-close close">' . Astra_Icons::get_icons( 'close' ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				astra_get_footer_widget( 'astra-woo-product-off-canvas-sidebar' );
				echo '</div></div>';
			}
		}

		/**
		 * Store widgets init.
		 *
		 * @since  1.1.0
		 * @return void
		 */
		public function shop_filters_sidebar() {

			register_sidebar(
				array(
					'name'          => esc_html__( 'Off-Canvas Filters', 'astra-addon' ),
					'id'            => 'astra-woo-product-off-canvas-sidebar',
					'description'   => __( 'This sidebar will show product filters on Shop page. Uncheck "Disable Off Canvas" option from `Customizer > Layout > Woocommerce > Shop` to enable this on Shop page.', 'astra-addon' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		}

		/**
		 * Infinite Products Show on scroll
		 *
		 * @since 1.1.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		public function shop_js_localize( $localize ) {
			global $wp_query;

			$single_ajax_add_to_cart = astra_get_option( 'single-product-ajax-add-to-cart' );

			if ( is_singular( 'product' ) ) {
				$product = wc_get_product( get_the_id() );
				if ( false !== $product && $product->is_type( 'external' ) ) {
					// Disable Ajax Add to Cart feature for External/Affiliate product.
					$single_ajax_add_to_cart = false;
				}
			}

			$shop_pagination            = astra_get_option( 'shop-pagination' );
			$shop_infinite_scroll_event = astra_get_option( 'shop-infinite-scroll-event' );

			$localize['edit_post_url']              = admin_url( 'post.php?post={{id}}&action=edit' );
			$localize['ajax_url']                   = admin_url( 'admin-ajax.php' );
			$localize['shop_infinite_count']        = 2;
			$localize['shop_infinite_total']        = $wp_query->max_num_pages;
			$localize['shop_pagination']            = $shop_pagination;
			$localize['shop_infinite_scroll_event'] = $shop_infinite_scroll_event;
			$localize['shop_no_more_post_message']  = apply_filters( 'astra_shop_no_more_product_text', __( 'No more products to show.', 'astra-addon' ) );

			$localize['checkout_prev_text'] = __( 'Back to my details', 'astra-addon' );
			$localize['checkout_next_text'] = __( 'Proceed to payment', 'astra-addon' );

			$localize['show_comments'] = __( 'Show Comments', 'astra-addon' );

			$localize['shop_quick_view_enable']          = astra_get_option( 'shop-quick-view-enable' );
			$localize['shop_quick_view_stick_cart']      = astra_get_option( 'shop-quick-view-stick-cart' );
			$localize['shop_quick_view_auto_height']     = true;
			$localize['single_product_ajax_add_to_cart'] = $single_ajax_add_to_cart;
			$localize['is_cart']                         = is_cart();
			$localize['is_single_product']               = is_product();
			$localize['view_cart']                       = esc_attr__( 'View cart', 'astra-addon' );
			$localize['cart_url']                        = apply_filters( 'astra_woocommerce_add_to_cart_redirect', wc_get_cart_url() );

			return $localize;
		}

		/**
		 * Common Actions.
		 *
		 * @since 1.1.0
		 * @return void
		 */
		public function common_actions() {
			// Shop Pagination.
			$this->shop_pagination();

			// Quick View.
			$this->init_quick_view();
		}

		/**
		 * Shop Pagination.
		 *
		 * @since 1.1.0
		 * @return void
		 */
		public function shop_pagination() {

			$pagination = astra_get_option( 'shop-pagination' );

			if ( 'infinite' == $pagination ) {
				add_action( 'woocommerce_after_shop_loop', array( $this, 'astra_shop_pagination' ), 10 );
			}
		}

		/**
		 * Astra Shop Pagination
		 *
		 * @since 1.1.0
		 * @param html $output Pagination markup.
		 * @return void
		 */
		public function astra_shop_pagination( $output ) {

			global $wp_query;

			$infinite_event = astra_get_option( 'shop-infinite-scroll-event' );
			$load_more_text = astra_get_option( 'shop-load-more-text' );

			if ( '' === $load_more_text ) {
				$load_more_text = __( 'Load More', 'astra-addon' );
			}

			if ( $wp_query->max_num_pages > 1 ) {
				?>
				<nav class="ast-shop-pagination-infinite">
					<div class="ast-loader">
							<div class="ast-loader-1"></div>
							<div class="ast-loader-2"></div>
							<div class="ast-loader-3"></div>
					</div>
					<?php if ( 'click' == $infinite_event ) { ?>
						<span class="ast-shop-load-more active">
							<?php echo apply_filters( 'astra_load_more_text', esc_html( $load_more_text ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</span>
					<?php } ?>
				</nav>
				<?php
			}
		}

		/**
		 * Frontend scripts.
		 *
		 * @since 1.0
		 *
		 * @return void.
		 */
		public function enqueue_frontend_scripts() {

			/* Directory and Extension */
			$shop_pagination = astra_get_option( 'shop-pagination' );
			$file_prefix     = '.min';
			$dir_name        = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = '';
				$dir_name    = 'unminified';
			}

			$js_gen_path  = ASTRA_EXT_WOOCOMMERCE_URI . 'assets/js/' . $dir_name . '/';
			$css_gen_path = ASTRA_EXT_WOOCOMMERCE_URI . 'assets/css/' . $dir_name . '/';

			// Load shop infinite JS pagination  only when used.
			if ( ( is_shop() || is_product_taxonomy() ) && 'infinite' === $shop_pagination ) {

				if ( is_shop() ) {
					$shop_page_display = get_option( 'woocommerce_shop_page_display', false );

					if ( 'subcategories' !== $shop_page_display || is_search() ) {
						wp_enqueue_script( 'astra-shop-pagination-infinite', $js_gen_path . 'pagination-infinite' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
					}
				} elseif ( is_product_taxonomy() ) {
					wp_enqueue_script( 'astra-shop-pagination-infinite', $js_gen_path . 'pagination-infinite' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
				}
			}

			if ( is_checkout() ) {
				$two_step_checkout = astra_get_option( 'two-step-checkout' );
				if ( $two_step_checkout ) {
					wp_enqueue_script( 'astra-two-step-checkout', $js_gen_path . 'two-step-checkout' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js', 'flexslider' ), ASTRA_EXT_VER, true );
				}

				$checkout_placeholder_forms = astra_get_option( 'checkout-labels-as-placeholders' );
				if ( $checkout_placeholder_forms ) {
					wp_enqueue_script( 'astra-checkout-labels-as-placeholders', $js_gen_path . 'checkout-labels-as-placeholders' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
				}

				$checkout_persistence_form_data = astra_get_option( 'checkout-persistence-form-data' );
				if ( $checkout_persistence_form_data ) {
					wp_enqueue_script( 'astra-checkout-persistence-form-data', $js_gen_path . 'checkout-persistence-form-data' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
				}
			}

			$single_product_ajax_add_to_cart = astra_get_option( 'single-product-ajax-add-to-cart' );
			$shop_quick_view_enable          = astra_get_option( 'shop-quick-view-enable' );
			if ( $single_product_ajax_add_to_cart || $shop_quick_view_enable ) {
				wp_enqueue_script( 'astra-single-product-ajax-cart', $js_gen_path . 'single-product-ajax-cart' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
			}

		}

		/**
		 * Single Product add to cart ajax request
		 *
		 * @since 1.1.0
		 *
		 * @return void.
		 */
		public function astra_add_cart_single_product_ajax() {
			add_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

			if ( is_callable( array( 'WC_AJAX', 'get_refreshed_fragments' ) ) ) {
				WC_AJAX::get_refreshed_fragments();
			}

			die();
		}

		/**
		 * Breadcrumb wrapper Start
		 */
		public function product_navigation_wrapper_start() {
			$nav_style = astra_get_option( 'single-product-nav-style' );
			?>
			<div class="ast-product-navigation-wrapper <?php echo esc_attr( $nav_style ); ?>">
			<?php
		}

		/**
		 * Breadcrumb wrapper End
		 */
		public function product_navigation_wrapper_end() {
			?>
			</div><!-- .ast-product-navigation-wrapper -->
			<?php
		}

		/**
		 * Single product next and previous links.
		 *
		 * @since 1.0.0
		 * @return void if not a single product.
		 */
		public function next_previous_links() {

			if ( ! is_product() ) {
				return;
			}
			$previous_icon = '<i class="ast-icon-previous"></i>';
			$next_icon     = '<i class="ast-icon-next"></i>';
			if ( true === Astra_Icons::is_svg_icons() ) {
				$previous_icon = '<i class="ast-product-icon-previous">' . Astra_Icons::get_icons( 'arrow' ) . '</i>';
				$next_icon     = '<i class="ast-product-icon-next">' . Astra_Icons::get_icons( 'arrow' ) . '</i>';
			}
			?>
			<div class="product-links">
				<?php
				previous_post_link( '%link', $previous_icon );
				next_post_link( '%link', $next_icon );
				?>
			</div>
			<?php
		}

		/**
		 * Shop page template.
		 *
		 * @since 1.0.0
		 * @return void if not a shop page.
		 */
		public function shop_page_styles() {

			$wp_doing_ajax = wp_doing_ajax();
			if ( ! ( is_shop() || is_product_taxonomy() ) && ! $wp_doing_ajax ) {
				return;
			}

			// Page Title.
			if ( ! astra_get_option( 'shop-page-title-display' ) ) {
				add_filter( 'woocommerce_show_page_title', '__return_false' );
			}

			// Breadcrumb.
			if ( ! astra_get_option( 'shop-breadcrumb-display' ) ) {
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			}

			// Toolbar.
			if ( ! astra_get_option( 'shop-toolbar-display' ) ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			}

			// Off Canvas.
			if ( 'disable' != astra_get_option( 'shop-off-canvas-trigger-type' ) ) {
				add_action( 'woocommerce_before_shop_loop', array( $this, 'off_canvas_button' ), 11 );
				if ( astra_get_option( 'shop-active-filters-display' ) ) {
					add_action( 'woocommerce_before_shop_loop', array( $this, 'off_canvas_applied_filters' ), 40 );
				}
			}

		}

		/**
		 * Off Canvas Filters button.
		 *
		 * @return void
		 */
		public function off_canvas_button() {

			$icon_class   = apply_filters( 'astra_woo_off_canvas_trigger_icon', 'astra-woo-filter-icon' );
			$filter_text  = '';
			$trigger_link = astra_get_option( 'shop-filter-trigger-link' );
			if ( ! empty( $trigger_link ) ) {
				$filter_text = '<span class="astra-woo-filter-text">' . $trigger_link . '</span>';
			}

			switch ( astra_get_option( 'shop-off-canvas-trigger-type' ) ) {
				case 'link':
					echo '<a href="#" class="astra-shop-filter-button" data-selector="astra-off-canvas-sidebar-wrapper"><span class="' . $icon_class . '">' . Astra_Icons::get_icons( 'menu-bars' ) . '</span>' . $filter_text . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;

				case 'button':
					echo '<button class="button astra-shop-filter-button" data-selector="astra-off-canvas-sidebar-wrapper"><span class="' . $icon_class . '">' . Astra_Icons::get_icons( 'menu-bars' ) . '</span>' . $filter_text . '</button>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;
			}
		}

		/**
		 * Off Canvas applied filters.
		 *
		 * @return void
		 */
		public function off_canvas_applied_filters() {
			the_widget( 'WC_Widget_Layered_Nav_Filters' );
		}

		/**
		 * Single product customization.
		 *
		 * @return void
		 */
		public function single_product_customization() {

			if ( ! is_product() ) {
				return;
			}

			if ( ! astra_get_option( 'single-product-image-zoom-effect' ) ) {
				remove_theme_support( 'wc-product-gallery-zoom' );
			}

			if ( 'disable' != astra_get_option( 'single-product-nav-style' ) ) {
				add_action( 'woocommerce_single_product_summary', array( $this, 'product_navigation_wrapper_start' ), 1, 0 );
				add_action( 'woocommerce_single_product_summary', array( $this, 'next_previous_links' ), 1, 0 );
				add_action( 'woocommerce_single_product_summary', array( $this, 'product_navigation_wrapper_end' ), 1, 0 );
			}

			// Breadcrumb.
			if ( astra_get_option( 'single-product-breadcrumb-disable' ) ) {
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 2 );
			}

			// Remove Default actions.
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

			/* Add single product content */
			add_action( 'woocommerce_single_product_summary', array( $this, 'single_product_content_structure' ), 10 );

			if ( ! astra_get_option( 'single-product-tabs-display' ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			}

			/* Display Related Products */
			if ( ! astra_get_option( 'single-product-related-display' ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}

			/* Display Up sell Products */
			if ( ! astra_get_option( 'single-product-up-sells-display' ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			}

		}

		/**
		 * Show the product title in the product loop.
		 *
		 * @param string $product_type product type.
		 */
		public function astra_woo_woocommerce_template_product_title( $product_type ) {

			if ( 'quick-view' === $product_type ) {
				echo '<a href="' . esc_url( get_the_permalink() ) . '" class="ast-loop-product__link">';
			}

			woocommerce_template_single_title();

			if ( 'quick-view' === $product_type ) {
				echo '</a>';
			}

		}

		/**
		 * Show the product title in the product loop. By default this is an H2.
		 *
		 * @param string $product_type product type.
		 */
		public function single_product_content_structure( $product_type = '' ) {

			$single_structure = apply_filters( 'astra_woo_single_product_structure', astra_get_option( 'single-product-structure' ), $product_type );

			if ( is_array( $single_structure ) && ! empty( $single_structure ) ) {

				foreach ( $single_structure as $value ) {

					switch ( $value ) {
						case 'title':
							/**
							 * Add Product Title on single product page for all products.
							 */
							do_action( 'astra_woo_single_title_before' );
							$this->astra_woo_woocommerce_template_product_title( $product_type );
							do_action( 'astra_woo_single_title_after' );
							break;
						case 'price':
							/**
							 * Add Product Price on single product page for all products.
							 */
							do_action( 'astra_woo_single_price_before' );
							woocommerce_template_single_price();
							do_action( 'astra_woo_single_price_after' );
							break;
						case 'ratings':
							/**
							 * Add rating on single product page for all products.
							 */
							do_action( 'astra_woo_single_rating_before' );
							woocommerce_template_single_rating();
							do_action( 'astra_woo_single_rating_after' );
							break;
						case 'short_desc':
							do_action( 'astra_woo_single_short_description_before' );
							woocommerce_template_single_excerpt();
							do_action( 'astra_woo_single_short_description_after' );
							break;
						case 'add_cart':
							do_action( 'astra_woo_single_add_to_cart_before' );
							woocommerce_template_single_add_to_cart();
							do_action( 'astra_woo_single_add_to_cart_after' );
							break;
						case 'meta':
							do_action( 'astra_woo_single_category_before' );
							woocommerce_template_single_meta();
							do_action( 'astra_woo_single_category_after' );
							break;
						default:
							break;
					}
				}
			}
		}

		/**
		 * Sale bubble flash
		 *
		 * @param  mixed  $markup  HTML markup of the the sale bubble / flash.
		 * @param  string $post Post.
		 * @param  string $product Product.
		 * @return string bubble markup.
		 */
		public function sale_flash( $markup, $post, $product ) {

			$sale_notification  = astra_get_option( 'product-sale-notification', '', 'default' );
			$sale_percent_value = '';

			// If none then return!
			if ( 'none' === $sale_notification ) {
				return;
			}

			// Default text.
			$text                 = __( 'Sale!', 'astra-addon' );
			$sale_percentage_data = array();

			switch ( $sale_notification ) {

				// Display % instead of "Sale!".
				case 'sale-percentage':
					$sale_percent_value = astra_get_option( 'product-sale-percent-value' );
					// if not variable product.
					if ( ! $product->is_type( 'variable' ) ) {
						$sale_price = $product->get_sale_price();

						if ( $sale_price ) {
							$regular_price      = $product->get_regular_price();
							$percent_sale       = round( ( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 ), 0 );
							$sale_percent_value = $sale_percent_value ? $sale_percent_value : '-[value]%';
							$text               = str_replace( '[value]', $percent_sale, $sale_percent_value );
						}
					} else {

						// if variable product.
						foreach ( $product->get_children() as $child_id ) {
							$variation = wc_get_product( $child_id );
							if ( $variation instanceof WC_Product ) {
								// Checking in case if the wc_get_product exists or is not false.
								$sale_price = $variation->get_sale_price();
								if ( $sale_price ) {
									$regular_price                     = $variation->get_regular_price();
									$percent_sale                      = round( ( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 ), 0 );
									$sale_percent_value                = $sale_percent_value ? $sale_percent_value : '-[value]%';
									$text                              = str_replace( '[value]', $percent_sale, $sale_percent_value );
									$sale_percentage_data[ $child_id ] = $percent_sale;

								}
							}
						}
					}
					break;
			}

			// CSS classes.
			$classes   = array();
			$classes[] = 'onsale';
			$classes[] = astra_get_option( 'product-sale-style' );
			$classes   = implode( ' ', $classes );

			// Generate markup.
			return '<span  ' . astra_attr(
				'woo-sale-badge-container',
				array(
					'class'              => $classes,
					'data-sale'          => wp_json_encode( $sale_percentage_data ),
					'data-notification'  => $sale_notification,
					'data-sale-per-text' => $sale_percent_value,
				)
			) . '>' . esc_html( $text ) . '</span>';

		}

		/**
		 * Add to cart button arguments
		 *
		 * @param array $defaults Default argument array.
		 * @param array $product  Add button style class.
		 *
		 * @return array;
		 */
		public function add_to_cart_args( $defaults, $product ) {

			$defaults['class'] = $defaults['class'] . ' ' . astra_get_option( 'shop-button-style' );

			return $defaults;
		}

		/**
		 * Related products arguments
		 *
		 * @param array $args Default argument array.
		 *
		 * @return array;
		 */
		public function related_products_args( $args ) {

			$columns = astra_get_option( 'single-product-related-upsell-grid' );

			$args['posts_per_page'] = astra_get_option( 'single-product-related-upsell-per-page' ); // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page
			$args['columns']        = $columns['desktop'];

			return $args;
		}

		/**
		 * Body Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @return array;
		 */
		public function body_class( $classes ) {
			if ( is_shop() || is_product_taxonomy() ) {

				$shop_style = astra_get_option( 'shop-style' );
				if ( 'shop-page-list-style' == $shop_style ) {
					$classes[] = 'ast-woocommerce-' . $shop_style;
				}
				$pagination_type = astra_get_option( 'shop-pagination' );

				if ( 'infinite' === $pagination_type ) {
					$classes[] = 'ast-woocommerce-pagination-type-infinite';
				}

				if ( 'number' === $pagination_type ) {

					$classes[] = 'ast-woocommerce-pagination-' . astra_get_option( 'shop-pagination-style' );
				}
			} elseif ( is_product() ) {

				$related_upsell_style = astra_get_option( 'shop-style' );
				if ( 'shop-page-list-style' == $related_upsell_style ) {
					$classes[] = 'ast-woocommerce-related-upsell-list-style';
				}

				$rel_up_columns = astra_get_option( 'single-product-related-upsell-grid' );

				$classes[] = 'rel-up-columns-' . $rel_up_columns['desktop'];
				$classes[] = 'tablet-rel-up-columns-' . $rel_up_columns['tablet'];
				$classes[] = 'mobile-rel-up-columns-' . $rel_up_columns['mobile'];

			} elseif ( is_checkout() ) {
				if ( astra_get_option( 'two-step-checkout' ) ) {
					$classes[] = 'ast-woo-two-step-checkout';
				}
				if ( astra_get_option( 'checkout-labels-as-placeholders' ) ) {
					$classes[] = 'ast-checkout-labels-as-placeholders';
				}
				if ( astra_get_option( 'checkout-distraction-free' ) ) {
					$classes[] = 'distraction-free';
				}
			}

			return $classes;
		}

		/**
		 * Post Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @return array;
		 */
		public function post_class( $classes ) {

			$wp_doing_ajax = wp_doing_ajax();

			if ( is_shop() || is_product_taxonomy() || ( post_type_exists( 'product' ) && 'product' === get_post_type() ) || $wp_doing_ajax ) {

				// Single product normal & hover box shadow.
				$classes[] = astra_get_option( 'shop-product-align' );
				$classes[] = 'box-shadow-' . astra_get_option( 'shop-product-shadow' );
				$classes[] = 'box-shadow-' . astra_get_option( 'shop-product-shadow-hover' ) . '-hover';

				// Single product gallery layout ( vertical / horizontal ).
				$classes[] = 'ast-product-gallery-layout-' . astra_get_option( 'single-product-gallery-layout' );

				$image_gallery = get_post_meta( get_the_ID(), '_product_image_gallery', true );
				if ( empty( $image_gallery ) ) {
					$classes[] = 'ast-product-gallery-with-no-image';
				}

				// Single product tabs layout ( vertical / horizontal ).
				if ( astra_get_option( 'single-product-tabs-display' ) ) {
					$classes[] = 'ast-product-tabs-layout-' . astra_get_option( 'single-product-tabs-layout' );
				}

				$qv_enable = astra_get_option( 'shop-quick-view-enable' );

				if ( 'disabled' !== $qv_enable ) {
					$classes[] = 'ast-qv-' . $qv_enable;

				}
				// Add Product Hover class only for infinite scroll products.
				if ( $wp_doing_ajax ) {
					$hover_style = astra_get_option( 'shop-hover-style' );

					if ( '' !== $hover_style ) {
						$classes[] = 'astra-woo-hover-' . $hover_style;
					}
				}
			}

			return $classes;
		}

		/**
		 * Checkout page markup update using actions & filters only
		 */
		public function customization_checkout_page() {

			if ( ! is_checkout() ) {
				return;
			}
			// Display order notes.
			if ( ! astra_get_option( 'checkout-order-notes-display' ) ) {
				add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
			}
			// Display coupon.
			if ( ! astra_get_option( 'checkout-coupon-display' ) ) {
				remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
			}

			/*
			 * Two Step Checkout Page
			 */
			if ( astra_get_option( 'two-step-checkout' ) ) {
				add_action( 'woocommerce_checkout_before_customer_details', 'astra_two_step_checkout_form_wrapper_div', 1 );
				add_action( 'woocommerce_checkout_before_customer_details', 'astra_two_step_checkout_form_ul_wrapper', 2 );
				add_action( 'woocommerce_checkout_order_review', 'astra_woocommerce_div_wrapper_close', 30 );
				add_action( 'woocommerce_checkout_order_review', 'astra_woocommerce_ul_close', 30 );
				add_action( 'woocommerce_checkout_before_customer_details', 'astra_two_step_checkout_address_li_wrapper', 5 );
				add_action( 'woocommerce_checkout_after_customer_details', 'astra_woocommerce_li_close' );
				add_action( 'woocommerce_checkout_before_order_review', 'astra_two_step_checkout_order_review_wrap', 1 );
				add_action( 'woocommerce_checkout_after_order_review', 'astra_woocommerce_li_close', 40 );
			}

			if ( astra_get_option( 'checkout-distraction-free' ) ) {

				// HFB Support for distration free checkout.
				if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
					remove_action( 'astra_header', array( Astra_Builder_Header::get_instance(), 'prepare_header_builder_markup' ) );
					remove_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ), 10 );
				}

				remove_action( 'astra_header', 'astra_header_markup' );
				remove_action( 'astra_footer', 'astra_footer_markup' );

				add_action( 'astra_header', array( $this, 'checkout_header_markup' ) );
				add_action( 'astra_footer', array( $this, 'checkout_footer_markup' ) );

				// Store Sidebar Layout.
				add_filter( 'astra_page_layout', array( $this, 'checkout_sidebar_layout' ), 99 );
			}
		}

		/**
		 * Cart page markup update using actions & filters only
		 */
		public function customization_cart_page() {

			if ( ! is_cart() ) {
				return;
			}
			// Disable cart page cross sell.
			if ( astra_get_option( 'cart-cross-sell-disable' ) ) {
				remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			}

			// Disable single checkout cross sell.
			if ( astra_get_option( 'cart-cross-sell-disable' ) ) {
				remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			}
		}

		/**
		 * Header markup.
		 */
		public function checkout_header_markup() {

			astra_get_template( 'woocommerce/templates/checkout-header.php' );
		}

		/**
		 * Footer markup.
		 */
		public function checkout_footer_markup() {

			astra_get_template( 'woocommerce/templates/checkout-footer.php' );
		}

		/**
		 * Checkout sidebar layout.
		 *
		 * @param string $sidebar_layout Layout.
		 *
		 * @return string;
		 */
		public function checkout_sidebar_layout( $sidebar_layout ) {

			return 'no-sidebar';
		}

		/**
		 * Add Styles
		 */
		public function add_styles() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_EXT_WOOCOMMERCE_URI . 'assets/css/';
			$path = ASTRA_EXT_WOOCOMMERCE_DIR . 'assets/css/';
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

			/* Add style.css */
			$style = ( true === Astra_Addon_Builder_Helper::apply_flex_based_css() ) ? 'style-grid' : 'style';
			Astra_Minify::add_css( $gen_path . $style . $file_prefix . '.css' );

			// Shop page style.
			$shop_page_style = astra_get_option( 'shop-style' );

			if ( 'shop-page-list-style' == $shop_page_style ) {
				$shop_page_style = Astra_Addon_Builder_Helper::apply_flex_based_css() ? $shop_page_style . '-grid' : $shop_page_style;
				Astra_Minify::add_css( $gen_path . $shop_page_style . $file_prefix . '.css' );
				// Single Product related & upsell product style.
				$related_upsell_list_style = ( true === Astra_Addon_Builder_Helper::apply_flex_based_css() ) ? 'related-upsell-list-style-grid' : 'related-upsell-list-style';
				Astra_Minify::add_css( $gen_path . $related_upsell_list_style . $file_prefix . '.css' );
			}

			if ( astra_get_option( 'two-step-checkout' ) ) {
				Astra_Minify::add_css( $gen_path . 'two-steps-checkout' . $file_prefix . '.css' );
			}
			if ( astra_get_option( 'checkout-labels-as-placeholders' ) ) {
				Astra_Minify::add_css( $gen_path . 'checkout-labels-as-placeholders' . $file_prefix . '.css' );
			}
			if ( self::add_to_cart_quantity_btn_enabled() ) {
				Astra_Minify::add_css( $gen_path . 'add-to-cart-quantity-btn' . $file_prefix . '.css' );
			}

			$quick_view = astra_get_option( 'shop-quick-view-enable' );

			if ( $quick_view ) {
				Astra_Minify::add_css( $gen_path . 'quick-view' . $file_prefix . '.css' );
			}

		}

		/**
		 * Add Scripts
		 */
		public function add_scripts() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_EXT_WOOCOMMERCE_URI . 'assets/js/';
			$path = ASTRA_EXT_WOOCOMMERCE_DIR . 'assets/js/';

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

			$quick_view = astra_get_option( 'shop-quick-view-enable' );

			if ( $quick_view ) {
				Astra_Minify::add_js( $gen_path . 'quick-view' . $file_prefix . '.js' );
				Astra_Minify::add_dependent_js( 'imagesloaded' );
			}

			$product_gallery = astra_get_option( 'single-product-gallery-layout' );

			if ( 'vertical' === $product_gallery ) {
				Astra_Minify::add_js( $gen_path . 'single-product-vertical-gallery' . $file_prefix . '.js' );
			}

			Astra_Minify::add_js( $gen_path . 'single-product-vertical-gallery' . $file_prefix . '.js' );

			if ( self::add_to_cart_quantity_btn_enabled() ) {
				Astra_Minify::add_js( $gen_path . 'add-to-cart-quantity-btn' . $file_prefix . '.js' );
			}
		}

		/**
		 * Init Quick View
		 */
		public function init_quick_view() {

			$qv_enable = astra_get_option( 'shop-quick-view-enable' );

			if ( 'disabled' !== $qv_enable ) {

				add_filter( 'astra_theme_js_localize', array( $this, 'qv_js_localize' ) );

				// add button.
				if ( 'after-summary' === $qv_enable ) {
					add_action( 'astra_woo_shop_summary_wrap_bottom', array( $this, 'add_quick_view_button' ) );
				} elseif ( 'on-image' === $qv_enable ) {

					add_action( 'woocommerce_after_shop_loop_item', array( $this, 'add_quick_view_on_img' ), 7 );

				} elseif ( 'on-image-click' === $qv_enable ) {
					add_action( 'woocommerce_after_shop_loop_item', array( $this, 'add_quick_view_on_img_click' ), 7 );
				}

				// load modal template.
				add_action( 'wp_footer', array( $this, 'quick_view_html' ) );

			}
		}

		/**
		 * Quick view localize.
		 *
		 * @since 1.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		public function qv_js_localize( $localize ) {

			global $wp_query;

			if ( ! isset( $localize['ajax_url'] ) ) {
				$localize['ajax_url'] = admin_url( 'admin-ajax.php', 'relative' );
			}

			return $localize;
		}

		/**
		 * Quick view ajax
		 */
		public function ast_load_product_quick_view_ajax() {

			if ( ! isset( $_REQUEST['product_id'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				die();
			}

			$product_id = intval( $_REQUEST['product_id'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			// set the main wp query for the product.
			wp( 'p=' . $product_id . '&post_type=product' );

			// remove product thumbnails gallery.
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

			ob_start();

			// load content template.
			astra_get_template( 'woocommerce/templates/quick-view-product.php' );

			echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			die();
		}

		/**
		 * Quick view actions
		 */
		public function quick_view_content_actions() {

			// Image.
			add_action( 'astra_woo_qv_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'astra_woo_qv_product_image', array( $this, 'qv_product_images_markup' ), 20 );

			// Summary.
			add_action( 'astra_woo_quick_view_product_summary', array( $this, 'single_product_content_structure' ), 10, 1 );

		}



		/**
		 * Footer markup.
		 */
		public function qv_product_images_markup() {

			astra_get_template( 'woocommerce/templates/quick-view-product-image.php' );
		}

		/**
		 * Quick view button
		 */
		public function add_quick_view_button() {

			global $product;

			$product_id = $product->get_id();

			// Get label.
			$label = __( 'Quick View', 'astra-addon' );

			$button  = '<div class="ast-qv-button-wrap">';
			$button .= '<a href="#" class="button ast-quick-view-button" data-product_id="' . $product_id . '">' . $label . '</a>';
			$button .= '</div>';
			$button  = apply_filters( 'astra_woo_add_quick_view_button_html', $button, $label, $product );

			echo $button; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Quick view on image
		 */
		public function add_quick_view_on_img() {

			global $product;

			$product_id = $product->get_id();

			// Get label.
			$label = __( 'Quick View', 'astra-addon' );

			$button = '<a href="#" class="ast-quick-view-text" data-product_id="' . $product_id . '">' . $label . '</a>';
			$button = apply_filters( 'astra_woo_add_quick_view_text_html', $button, $label, $product );

			echo $button; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Quick view on image
		 */
		public function add_quick_view_on_img_click() {

			global $product;

			$product_id = $product->get_id();

			$button = '<div class="ast-quick-view-data" data-product_id="' . $product_id . '"></div>';
			$button = apply_filters( 'astra_woo_add_quick_view_data_html', $button, $product );

			echo $button; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Quick view html
		 */
		public function quick_view_html() {

			$this->quick_view_dependent_data();

			astra_get_template( 'woocommerce/templates/quick-view-modal.php' );
		}

		/**
		 * Quick view dependent data
		 */
		public function quick_view_dependent_data() {

			wp_enqueue_script( 'wc-add-to-cart-variation' );
			wp_enqueue_script( 'flexslider' );
		}

		/**
		 * Category featured image.
		 *
		 * @param string  $bg_img   Image background url.
		 * @param boolean $is_override   Override featured image.
		 * @return string
		 */
		public function category_featured_image( $bg_img, $is_override ) {

			if ( $is_override ) {

				if ( is_product_category() ) {
					global $wp_query;

					$cat = $wp_query->get_queried_object();

					$thumbnail_id = function_exists( 'get_term_meta' ) ? get_term_meta( $cat->term_id, 'thumbnail_id', true ) : get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );

					$image = wp_get_attachment_url( $thumbnail_id );

					if ( $image ) {
						$bg_img = $image;
					}
				}
			}

			return $bg_img;
		}

		/**
		 * Shop Page Meta Options
		 *
		 * @return void
		 */
		public function addons_meta_options() {

			if ( is_shop() ) {

				$shop_page_id = get_option( 'woocommerce_shop_page_id' );

				/*
				 * Transparent Header for shop page meta.
				 */
				$enable_trans_header          = astra_get_option( 'transparent-header-enable' );
				$shop_transparent_header_meta = get_post_meta( $shop_page_id, 'theme-transparent-header-meta', true );
				$show_trans_header            = '__return_false';

				if ( 'enabled' === $shop_transparent_header_meta ) {
					$enable_trans_header = true;
				} elseif ( 'disabled' === $shop_transparent_header_meta ) {
					$enable_trans_header = false;
				}

				if ( $enable_trans_header ) {
					$show_trans_header = '__return_true';
				}
				add_filter( 'astra_is_transparent_header', $show_trans_header );

				/*
				 * Above Header for shop page meta.
				 */
				$above_header_meta = get_post_meta( $shop_page_id, 'ast-above-header-display', true );
				$show_above_header = '__return_false';
				if ( 'disabled' == $above_header_meta ) {
					$show_above_header = '__return_true';
				}
				add_filter( 'astra_above_header_disable', $show_above_header );

				/*
				 * Below Header for shop page meta.
				 */
				$below_header_meta = get_post_meta( $shop_page_id, 'ast-below-header-display', true );
				$show_below_header = '__return_false';
				if ( 'disabled' == $below_header_meta ) {
					$show_below_header = '__return_true';
				}
				add_filter( 'astra_below_header_disable', $show_below_header );

			}
		}

		/**
		 * Add Localize variables
		 *
		 * @param  array $localize_vars Localize variables array.
		 * @return array
		 */
		public function localize_variables_shop_page( $localize_vars ) {

			/**
			 * Stick Header meta option for shop page
			 */
			if ( is_shop() ) {
				$shop_page_id                             = get_option( 'woocommerce_shop_page_id' );
				$localize_vars['stick_header_meta']       = get_post_meta( $shop_page_id, 'stick-header-meta', true );
				$localize_vars['header_main_stick_meta']  = get_post_meta( $shop_page_id, 'header-main-stick-meta', true );
				$localize_vars['header_above_stick_meta'] = get_post_meta( $shop_page_id, 'header-above-stick-meta', true );
				$localize_vars['header_below_stick_meta'] = get_post_meta( $shop_page_id, 'header-below-stick-meta', true );
			}
			// Accessibility Text.
			$localize_vars['product_plus_minus_text'] = array(
				'plus_qty'  => __( 'Plus Quantity', 'astra-addon' ),
				'minus_qty' => __( 'Minus Quantity', 'astra-addon' ),
			);
			return $localize_vars;
		}

		/**
		 * Function to disable the Add to Cart quantity buttons
		 *
		 * @return boolean
		 * @since 2.1.3
		 */
		public static function add_to_cart_quantity_btn_enabled() {
			return apply_filters( 'astra_add_to_cart_quantity_btn_enabled', true );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
ASTRA_Ext_WooCommerce_Markup::get_instance();
