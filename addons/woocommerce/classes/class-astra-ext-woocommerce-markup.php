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
	// @codingStandardsIgnoreStart
	class ASTRA_Ext_WooCommerce_Markup {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

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

			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'astra_addon_get_js_files', array( $this, 'add_scripts' ) );

			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'get_the_post_type_description', 'astra_woo_remove_shop_page_description', 10, 2 );

			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_filter( 'post_class', array( $this, 'post_class' ) );

			// Single product.
			add_filter( 'woocommerce_loop_add_to_cart_args', array( $this, 'add_to_cart_args' ), 10, 2 );
			add_filter( 'woocommerce_sale_flash', array( $this, 'sale_flash' ), 10, 3 );

			add_action( 'wp', array( $this, 'single_product_quantity_ajax_cart' ) );
			add_action( 'wp', array( $this, 'single_product_customization' ) );
			add_action( 'wp', array( $this, 'customization_checkout_page' ) );
			add_action( 'wp', array( $this, 'customization_cart_page' ) );
			add_action( 'wp', array( $this, 'woo_product_tabs_layout' ) );
			add_action( 'wp', array( $this, 'modern_my_account_template' ) );

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

			// Cart quantity update AJAX.
			add_action( 'wp_ajax_astra_add_cart_single_product_quantity', array( $this, 'astra_add_cart_single_product_quantity' ) );
			add_action( 'wp_ajax_nopriv_astra_add_cart_single_product_quantity', array( $this, 'astra_add_cart_single_product_quantity' ) );

			// Register Off Canvas Sidebars / Shop Filters.
			if ( is_customize_preview() ) {
				add_action( 'widgets_init', array( $this, 'shop_filters_sidebar' ), 99 );
				add_action( 'wp', array( $this, 'shop_filters_sidebar' ), 99 );
			} else {
				add_action( 'widgets_init', array( $this, 'shop_filters_sidebar' ), 99 );
			}

			add_action( 'astra_body_bottom', array( $this, 'get_off_canvas_sidebar' ) );

			// Addon meta option.
			add_action( 'wp', array( $this, 'addons_meta_options' ) );
			add_filter( 'astra_addon_js_localize', array( $this, 'localize_variables_shop_page' ) );

			// Advanced header bg image.
			add_filter( 'astra_advanced_headers_title_bar_bg', array( $this, 'category_featured_image' ), 10, 2 );

			add_shortcode( 'astra_woo_mini_cart', array( $this, 'astra_woo_mini_cart_markup' ) );

			// Woocommerce single product sticky.
			add_action( 'wp', array( $this, 'woo_single_product_sticky' ), 99 );

			// Woocommerce single product layouts.
			add_action( 'wp', array( $this, 'woo_single_product_layouts' ), 99 );

			// Load Google fonts.
			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );

			// Sticky add to cart.
			add_action( 'wp_footer', array( $this, 'single_product_sticky_add_to_cart' ) );

			add_filter( 'astra_woo_shop_product_structure', array( $this, 'enable_short_desc_modern_view' ) );

			// Single Product Custom Product Variations.
			add_action( 'wp', array( $this, 'single_product_product_variations_custom_output' ), 99 );

			add_action( 'wp', array( $this, 'modern_cart' ), 99 );

			// Multi step Checkout.
			add_action( 'wp', array( $this, 'multistep_checkout' ), 99 );

			// Modern Checkout.
			add_action( 'wp', array( $this, 'modern_checkout' ) );

			// Check if email exist.
			add_action( 'wp_ajax_nopriv_astra_woo_check_email_exist', array( $this, 'astra_check_email_exist' ) );

			// Login user.
			add_action( 'wp_ajax_astra_woocommerce_login_user', array( $this, 'astra_woocommerce_login_user' ) );
			add_action( 'wp_ajax_nopriv_astra_woocommerce_login_user', array( $this, 'astra_woocommerce_login_user' ) );

			// Localize cart variables.
			add_filter( 'astra_addon_js_localize', array( $this, 'cart_js_localize' ) );

			// Localize checkout variables.
			add_filter( 'astra_addon_js_localize', array( $this, 'checkout_js_localize' ) );

			// Converts filter list to buttons.
			add_action( 'wp', array( $this, 'filter_list_to_buttons' ), 99 );
		}

		/**
		 * Action to initiate my-account modernizing template.
		 *
		 * @since  3.9.0
		 * @return void
		 */
		public function modern_my_account_template() {
			if ( true === astra_get_option( 'modern-woo-account-view', false ) && is_account_page() ) {
				remove_action( 'woocommerce_account_navigation', 'woocommerce_account_navigation' );
				add_action( 'woocommerce_account_navigation', array( $this, 'woocommerce_account_navigation' ) );

				// Add custom CTA to switch between Login & registration form on WooCommerce my account page.
				if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) {
					add_action( 'woocommerce_login_form_end', array( $this, 'add_registration_link_text' ) );
					add_action( 'woocommerce_register_form_end', array( $this, 'add_member_login_link_text' ) );
				}

				if ( true === astra_get_option( 'show-woo-grid-orders', false ) ) {
					// Orders content.
					remove_action( 'woocommerce_account_orders_endpoint', 'woocommerce_account_orders' );
					add_action( 'woocommerce_account_orders_endpoint', array( $this, 'astra_addon_woo_account_orders' ) );

					// Downloads content.
					remove_action( 'woocommerce_available_downloads', 'woocommerce_order_downloads_table', 10 );
					add_action( 'woocommerce_available_downloads', array( $this, 'woo_account_downloads' ), 10 );
				}
			}
		}

		/**
		 * Not a member? Register
		 * CTA adding at the end of registration form.
		 *
		 * @since 3.9.0
		 */
		public function add_registration_link_text() {
			printf(
				'<p class="ast-woo-form-actions">
					%1$s
					<a href="#ast-woo-register" data-type="do-register" class="ast-woo-account-form-link">
						%2$s
					</a>
				</p>',
				apply_filters( 'astra_addon_woo_account_register_heading', __( 'Not a member?', 'astra-addon' ) ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				apply_filters( 'astra_addon_woo_account_register_string', __( 'Register', 'astra-addon' ) ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}

		/**
		 * Already a member? Login
		 * CTA adding at the end of registration form.
		 *
		 * @since 3.9.0
		 */
		public function add_member_login_link_text() {
			printf(
				'<p class="ast-woo-form-actions">
					%1$s
					<a href="#ast-woo-login" data-type="do-login" class="ast-woo-account-form-link">
						%2$s
					</a>
				</p>',
				apply_filters( 'astra_addon_woo_account_login_heading', __( 'Already a member?', 'astra-addon' ) ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				apply_filters( 'astra_addon_woo_account_login_trigger', __( 'Login', 'astra-addon' ) ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}

		/**
		 * My Account > Downloads WooCommerce template.
		 *
		 * @param array $downloads Downloads.
		 * @since 3.9.0
		 */
		public function woo_account_downloads( $downloads ) {
			if ( ! $downloads ) {
				return;
			}
			astra_addon_get_template(
				'woocommerce/templates/order-downloads.php',
				array(
					'downloads' => $downloads,
				)
			);
		}

		/**
		 * My Account > Orders WooCommerce template.
		 *
		 * @param int $current_page Current page number.
		 * @since 3.9.0
		 */
		public function astra_addon_woo_account_orders( $current_page ) {
			$current_page    = empty( $current_page ) ? 1 : absint( $current_page );
			$customer_orders = wc_get_orders(
				apply_filters(
					'woocommerce_my_account_my_orders_query',
					array(
						'customer' => get_current_user_id(),
						'page'     => $current_page,
						'paginate' => true,
					)
				)
			);

			astra_addon_get_template(
				'woocommerce/templates/orders.php',
				array(
					'current_page'    => absint( $current_page ),
					'customer_orders' => $customer_orders,
					'has_orders'      => 0 < $customer_orders->total,
				)
			);
		}

		/**
		 * Override my-account WooCommerce's defauilt my-account template.
		 *
		 * @since  3.9.0
		 * @return void
		 */
		public function woocommerce_account_navigation() {
			astra_addon_get_template( 'woocommerce/templates/navigation.php' );
		}

		/**
		 * Add product short description in Shop Page structure for List View layout.
		 *
		 * @param  array $shop_product_stucture Customizer Shop Product Strcture.
		 * @return array $shop_product_stucture Strcture of shop page after adding short-desc into it.
		 * @since 3.9.0
		 */
		public function enable_short_desc_modern_view( $shop_product_stucture ) {
			if ( ( is_shop() || is_product_taxonomy() ) && self::is_easy_view_switcher_enable() && ! in_array( 'short_desc', $shop_product_stucture ) && 'shop-page-list-style' !== astra_get_option( 'shop-style' ) && true === astra_get_option( 'easy-list-content-enable-description' ) ) {
				$shop_product_stucture[] = 'short_desc';
			}
			return $shop_product_stucture;
		}

		/**
		 * Single Product Payments.
		 *
		 * @since  3.9.0
		 * @return void
		 */
		public function woocommerce_product_single_payments() {
			$section_title    = astra_get_option( 'single-product-payment-text' );
			$if_color_version = astra_get_option( 'single-product-payment-icon-color' );
			$visa_icon        = Astra_Builder_UI_Controller::fetch_svg_icon( 'visa', false );
			$visa_gray        = Astra_Builder_UI_Controller::fetch_svg_icon( 'visa_gray', false );
			$mastercard_icon  = Astra_Builder_UI_Controller::fetch_svg_icon( 'mastercard', false );
			$mastercard_gray  = Astra_Builder_UI_Controller::fetch_svg_icon( 'mastercard_gray', false );
			$amex_icon        = Astra_Builder_UI_Controller::fetch_svg_icon( 'amex', false );
			$amex_gray        = Astra_Builder_UI_Controller::fetch_svg_icon( 'amex_gray', false );
			$discover_icon    = Astra_Builder_UI_Controller::fetch_svg_icon( 'discover', false );
			$discover_gray    = Astra_Builder_UI_Controller::fetch_svg_icon( 'discover_gray', false );
			$paypal_icon      = Astra_Builder_UI_Controller::fetch_svg_icon( 'paypal', false );
			$paypal_gray      = Astra_Builder_UI_Controller::fetch_svg_icon( 'paypal_gray', false );
			$applepay_icon    = Astra_Builder_UI_Controller::fetch_svg_icon( 'applepay', false );
			$applepay_gray    = Astra_Builder_UI_Controller::fetch_svg_icon( 'applepay_gray', false );

			if ( 'inherit_text_color' === $if_color_version ) {
				$visa_icon       = $visa_gray;
				$mastercard_icon = $mastercard_gray;
				$amex_icon       = $amex_gray;
				$discover_icon   = $discover_gray;
				$paypal_icon     = $paypal_gray;
				$applepay_icon   = $applepay_gray;
			}

			ob_start();
			?>
			<?php $if_color_version = 'inherit_text_color' === $if_color_version ? 'ast-text-color-version' : 'ast-inherit-color-version'; ?>
			<fieldset class="ast-single-product-payments <?php echo esc_attr( $if_color_version ); ?>">
				<legend><?php echo esc_html( $section_title ); ?></legend>
				<ul>
					<?php if ( astra_get_option( 'single-product-payment-visa' ) ) { ?>
						<li class="ast-payment-visa">
							<?php echo $visa_icon;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</li>
					<?php } ?>
					<?php if ( astra_get_option( 'single-product-payment-mastercard' ) ) { ?>
						<li class="ast-payment-mastercard">
							<?php echo $mastercard_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</li>
					<?php } ?>
					<?php if ( astra_get_option( 'single-product-payment-amex' ) ) { ?>
						<li class="ast-payment-amex">
							<?php echo $amex_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</li>
					<?php } ?>
					<?php if ( astra_get_option( 'single-product-payment-discover' ) ) { ?>
						<li class="ast-payment-discover">
							<?php echo $discover_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</li>
					<?php } ?>
					<?php if ( astra_get_option( 'single-product-payment-paypal' ) ) { ?>
						<li class="ast-payment-paypal">
							<?php echo $paypal_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</li>
					<?php } ?>
					<?php if ( astra_get_option( 'single-product-payment-apple-pay' ) ) { ?>
						<li class="ast-payment-apple-pay">
							<?php echo $applepay_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</li>
					<?php } ?>
				</ul>
			</fieldset>

			<?php
			echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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

			// Single Product Category font section.
			$font_family_product_category = astra_get_option( 'font-family-product-category' );
			$font_weight_product_category = astra_get_option( 'font-weight-product-category' );
			Astra_Fonts::add_font( $font_family_product_category, $font_weight_product_category );

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

			if ( in_array( 'filters', astra_get_option( 'shop-toolbar-structure', array() ) ) && ( is_shop() || is_product_taxonomy() ) && 'shop-filter-flyout' === astra_get_option( 'shop-filter-position' ) ) {
				echo '<div class="astra-off-canvas-sidebar-wrapper from-left"><div class="astra-off-canvas-sidebar"><a href="javascript:void(0)" id="cart-accessibility" class="ast-shop-filter-close close" aria-label="' . esc_attr__( 'Close Off-Canvas Sidebar', 'astra-addon' ) . '">' . Astra_Icons::get_icons( 'close' ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
			$shop_filter_array = array(
				'name'          => esc_html__( 'Shop Filters', 'astra-addon' ),
				'id'            => 'astra-woo-product-off-canvas-sidebar',
				'description'   => __( 'This sidebar will show product filters on Shop page. Uncheck "Disable Off Canvas" option from `Customizer > Layout > Woocommerce > Shop` to enable this on Shop page.', 'astra-addon' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			);

			if ( astra_get_option( 'shop-filter-accordion' ) ) {
				$shop_filter_array['before_title']   = '<h2 class="widget-title">';
				$shop_filter_array['after_title']    = Astra_Builder_UI_Controller::fetch_svg_icon( 'angle-down', false ) . '</h2>';
				$shop_filter_array['before_sidebar'] = '<div class="ast-accordion-layout ast-filter-wrap">';
				$shop_filter_array['after_sidebar']  = '</div>';
			} else {
				$shop_filter_array['before_title']   = '<h2 class="widget-title">';
				$shop_filter_array['after_title']    = '</h2>';
				$shop_filter_array['before_sidebar'] = '<div class="ast-filter-wrap">';
				$shop_filter_array['after_sidebar']  = '</div>';
			}

			register_sidebar(
				$shop_filter_array
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
			$localize['single_product_qty_ajax_nonce']   = wp_create_nonce( 'single_product_qty_ajax_nonce' );
			$localize['single_product_ajax_add_to_cart'] = $single_ajax_add_to_cart;
			$localize['is_cart']                         = is_cart();
			$localize['is_single_product']               = is_product();
			$localize['view_cart']                       = esc_attr__( 'View cart', 'astra-addon' );
			$localize['cart_url']                        = apply_filters( 'astra_woocommerce_add_to_cart_redirect', wc_get_cart_url() );

			return $localize;
		}

		/**
		 * Localize variables for checkout.
		 *
		 * @since 3.9.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		public function checkout_js_localize( $localize ) {

			$wc_checkout = new WC_Checkout();

			$localize['order_review_toggle_texts']    = array(
				'toggle_show_text' => order_review_toggle_texts(),
				'toggle_hide_text' => order_review_toggle_texts( 'hide_text' ),
			);
			$localize['check_email_exist_nonce']      = wp_create_nonce( 'check-email-exist' );
			$localize['woocommerce_login_nonce']      = wp_create_nonce( 'woocommerce-login' );
			$localize['is_logged_in']                 = is_user_logged_in();
			$localize['email_validation_msgs']        = array(
				'error_msg'   => __( 'Entered email address is not a valid email.', 'astra-addon' ),
				'success_msg' => __( 'This email is already registered. Please enter the password to continue.', 'astra-addon' ),
			);
			$localize['checkout_order_review_sticky'] = astra_get_option( 'checkout-order-review-sticky' );
			$localize['cartflows_version']            = defined( 'CARTFLOWS_VER' );
			$localize['is_registration_required']     = $wc_checkout->is_registration_required();

			return $localize;
		}

		/**
		 * Cart localize
		 *
		 * @since 3.9.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		public function cart_js_localize( $localize ) {

			$localize['cart_sticky_cart_totals'] = astra_get_option( 'cart-sticky-cart-totals' );

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

			if ( self::is_shop_page_modern_style() ) {
				// Modern Shop Look.
				$this->render_modern_shop_view();
			}
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

			$js_gen_path  = ASTRA_ADDON_EXT_WOOCOMMERCE_URI . 'assets/js/' . $dir_name . '/';
			$css_gen_path = ASTRA_ADDON_EXT_WOOCOMMERCE_URI . 'assets/css/' . $dir_name . '/';

			$is_product_archive = ( is_shop() || is_product_taxonomy() ) ? true : false;

			// Load shop infinite JS pagination  only when used.
			if ( $is_product_archive && 'infinite' === $shop_pagination ) {

				if ( is_shop() ) {
					$shop_page_display = get_option( 'woocommerce_shop_page_display', false );

					if ( 'subcategories' !== $shop_page_display || is_search() ) {
						wp_enqueue_script( 'astra-shop-pagination-infinite', $js_gen_path . 'pagination-infinite' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
					}
				} elseif ( is_product_taxonomy() ) {
					wp_enqueue_script( 'astra-shop-pagination-infinite', $js_gen_path . 'pagination-infinite' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
				}
			}

			if ( $is_product_archive && ( true === self::is_shop_page_modern_style() || true === self::is_easy_view_switcher_enable() ) ) {
				wp_enqueue_script( 'astra-modern-shop-view', $js_gen_path . 'modern-shop-view' . $file_prefix . '.js', array(), ASTRA_EXT_VER, true );

				$localize_array = array(
					'mobile_breakpoint' => astra_addon_get_mobile_breakpoint(),
				);

				wp_localize_script( 'astra-modern-shop-view', 'ast_modern_shop', $localize_array );
			}

			if ( is_checkout() && ! is_wc_endpoint_url( 'order-received' ) ) {
				$two_step_checkout = astra_get_option( 'two-step-checkout' );
				if ( $two_step_checkout && 'default' === astra_get_option( 'checkout-layout-type' ) ) {
					wp_enqueue_script( 'astra-two-step-checkout', $js_gen_path . 'two-step-checkout' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js', 'flexslider' ), ASTRA_EXT_VER, true );
				}

				$checkout_placeholder_forms = astra_get_option( 'checkout-labels-as-placeholders' );
				if ( $checkout_placeholder_forms && 'default' === astra_get_option( 'woo-input-style-type' ) ) {
					wp_enqueue_script( 'astra-checkout-labels-as-placeholders', $js_gen_path . 'checkout-labels-as-placeholders' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
				}

				$checkout_persistence_form_data = astra_get_option( 'checkout-persistence-form-data' );
				if ( $checkout_persistence_form_data ) {
					wp_enqueue_script( 'astra-checkout-persistence-form-data', $js_gen_path . 'checkout-persistence-form-data' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );
				}
			}

			if (
				is_account_page() &&
				! is_user_logged_in() &&
				true === astra_get_option( 'modern-woo-account-view', false ) &&
				'yes' === get_option( 'woocommerce_enable_myaccount_registration' )
			) {
				wp_enqueue_script( 'astra-my-account-form-switcher', $js_gen_path . 'my-account-form-switcher' . $file_prefix . '.js', array(), ASTRA_EXT_VER, true );
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
		 * Insert Post thumbnail into anchor.
		 * Type - Previous.
		 *
		 * @param string $output   The adjacent post link.
		 * @param string $format   Link anchor format.
		 * @param string $link     Link permalink format.
		 * @param object $post     WP_Post - The adjacent post.
		 * @param string $adjacent Whether the post is previous or next.
		 *
		 * @return string HTML markup.
		 * @since 3.9.0
		 */
		public function previous_product_preview_image_insertion( $output, $format, $link, $post, $adjacent ) {
			if ( $post && $post->ID ) {
				$product       = wc_get_product( $post->ID );
				$image_size    = apply_filters( 'astra_product_navigation_image_size', array( 100, 100 ) );
				$image_markup  = '<div class="ast-navigation-product-preview" data-direction="previous"><div class="ast-navigation-wrapper">' . get_the_post_thumbnail( $post->ID, $image_size );
				$image_markup .= '<div class="ast-navigation-content"><div class="ast-navigation-product-title">' . get_the_title( $post->ID ) . '</div><div class="ast-navigation-price">' . wp_kses_post( $product->get_price_html() ) . '</div></div></div></div></a>';
				$output        = str_replace( '</a>', $image_markup, $output );
			}
			return $output;
		}

		/**
		 * Insert Post thumbnail into anchor.
		 * Type - Next.
		 *
		 * @param string $output   The adjacent post link.
		 * @param string $format   Link anchor format.
		 * @param string $link     Link permalink format.
		 * @param object $post     WP_Post - The adjacent post.
		 * @param string $adjacent Whether the post is previous or next.
		 *
		 * @return string HTML markup.
		 * @since 3.9.0
		 */
		public function next_product_preview_image_insertion( $output, $format, $link, $post, $adjacent ) {
			if ( $post && $post->ID ) {
				$product       = wc_get_product( $post->ID );
				$image_size    = apply_filters( 'astra_product_navigation_image_size', array( 100, 100 ) );
				$image_markup  = '<div class="ast-navigation-product-preview" data-direction="next"><div class="ast-navigation-wrapper">' . get_the_post_thumbnail( $post->ID, $image_size );
				$image_markup .= '<div class="ast-navigation-content"><div class="ast-navigation-product-title">' . get_the_title( $post->ID ) . '</div><div class="ast-navigation-price">' . wp_kses_post( $product->get_price_html() ) . '</div></div></div></div></a>';
				$output        = str_replace( '</a>', $image_markup, $output );
			}
			return $output;
		}

		/**
		 * Single product next and previous links.
		 *
		 * @since 1.0.0
		 * @return void if not a single product.
		 */
		public function next_previous_links() {
			$args = array();
			if ( ! is_product() ) {
				return;
			}
			$show_product_thumbnails_on_hover = astra_get_option( 'single-product-navigation-preview', false );
			$previous_icon                    = '<i class="ast-icon-previous"></i>';
			$next_icon                        = '<i class="ast-icon-next"></i>';
			if ( true === Astra_Icons::is_svg_icons() ) {
				$previous_icon = '<i class="ast-product-icon-previous">' . Astra_Icons::get_icons( 'arrow' ) . '</i>';
				$next_icon     = '<i class="ast-product-icon-next">' . Astra_Icons::get_icons( 'arrow' ) . '</i>';
			}
			if ( true === $show_product_thumbnails_on_hover ) {
				add_filter( 'previous_post_link', array( $this, 'previous_product_preview_image_insertion' ), 10, 5 );
				add_filter( 'next_post_link', array( $this, 'next_product_preview_image_insertion' ), 10, 5 );
			}

			?>
			<div class="product-links">
				<?php
				$previous_args = apply_filters( 'astra_woo_product_previous_post_nav_args', $args );
				$next_args     = apply_filters( 'astra_woo_product_next_post_nav_args', $args );

				if ( ! empty( $previous_args ) || ! empty( $next_args ) ) {
					$previous_args_icon = ! empty( $previous_args['link'] ) ? $previous_args['link'] : $previous_icon;
					$next_args_icon     = ! empty( $next_args['link'] ) ? $next_args['link'] : $next_icon;
					$previous_post_link = get_previous_post_link( $previous_args['format'], $previous_args_icon, $previous_args['in_same_term'], $previous_args['excluded_terms'], $previous_args['taxonomy'] );
					$next_post_link     = get_next_post_link( $next_args['format'], $next_args_icon, $next_args['in_same_term'], $next_args['excluded_terms'], $next_args['taxonomy'] );
				} else {
					$previous_post_link = get_previous_post_link( '%link', $previous_icon );
					$next_post_link     = get_next_post_link( '%link', $next_icon );
				}

				echo get_previous_post_link() ? $previous_post_link : '<a href="#" class="ast-disable" rel="prev">' . $previous_icon . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo get_next_post_link() ? $next_post_link : '<a href="#" class="ast-disable" rel="next">' . $next_icon . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

				?>
			</div>
			<?php

			if ( true === $show_product_thumbnails_on_hover ) {
				remove_filter( 'previous_post_link', array( $this, 'previous_product_preview_image_insertion' ), 10, 4 );
				remove_filter( 'next_post_link', array( $this, 'next_product_preview_image_insertion' ), 10, 4 );
			}
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

			$toolbar_structure = astra_get_option( 'shop-toolbar-structure' );

			if ( ! empty( $toolbar_structure ) ) {

				add_action( 'woocommerce_before_shop_loop', array( $this, 'before_shop_loop_starts_wrapper' ), 11 );

				add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_toolbar_aside_starts_wrapper' ), 12 );
				add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_toolbar_elements_ends_wrapper' ), 15 );

				add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_toolbar_aside_starts_wrapper' ), 16 );
				add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_toolbar_elements_ends_wrapper' ), 19 );

				add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_toolbar_elements_ends_wrapper' ), 20 );

				$toolbar_elements = astra_get_option( 'shop-toolbar-structure-with-hiddenset' );
				$loop_counter     = 1;

				foreach ( $toolbar_elements as $element => $is_visible ) {

					switch ( $loop_counter ) {
						case '1':
							$priority = 13;
							break;

						case '2':
							$priority = 14;
							break;

						case '3':
							$priority = 17;
							break;

						case '4':
							$priority = 18;
							break;

						default:
							$priority = false;
							break;
					}

					if ( false === $priority ) {
						return;
					}

					switch ( $element ) {
						case 'results':
							if ( $is_visible ) {
								remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
								add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', $priority );
							} else {
								remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
							}
							$loop_counter = $loop_counter + 1; // phpcs:ignore Squiz.Operators.IncrementDecrementUsage.Found
							break;

						case 'easy_view':
							if ( $is_visible ) {
								add_action( 'woocommerce_before_shop_loop', array( $this, 'add_views_layout_support' ), $priority );
							}
							$loop_counter = $loop_counter + 1; // phpcs:ignore Squiz.Operators.IncrementDecrementUsage.Found
							break;

						case 'filters':
							if ( $is_visible ) {
								add_action( 'woocommerce_before_shop_loop', array( $this, 'off_canvas_button' ), $priority );
								if ( astra_get_option( 'shop-active-filters-d1isplay' ) ) {
									add_action( 'woocommerce_before_shop_loop', array( $this, 'off_canvas_applied_filters' ), $priority + 10 );
								}
								// Collapsible filter.
								if ( 'shop-filter-collapsible' === astra_get_option( 'shop-filter-position' ) ) {
									add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_filter_markup' ), $priority + 20 );
								}
							}
							$loop_counter = $loop_counter + 1;  // phpcs:ignore Squiz.Operators.IncrementDecrementUsage.Found
							break;

						case 'sorting':
							if ( $is_visible ) {
								remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
								add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', $priority );
							} else {
								remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
							}
							$loop_counter = $loop_counter + 1; // phpcs:ignore Squiz.Operators.IncrementDecrementUsage.Found
							break;

						default:
							break;
					}
				}
			} else {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			}
		}

		/**
		 * Add wrapper for before shop loop.
		 *
		 * @return void
		 */
		public function before_shop_loop_starts_wrapper() {
			?>
				<div class="ast-shop-toolbar-container">
			<?php
		}

		/**
		 * Add wrapper for before shop loop.
		 *
		 * @return void
		 */
		public function shop_toolbar_aside_starts_wrapper() {
			?>
				<div class="ast-shop-toolbar-aside-wrap">
			<?php
		}

		/**
		 * Add wrapper for after shop loop.
		 */
		public function shop_toolbar_elements_ends_wrapper() {
			?>
				</div>
			<?php
		}

		/**
		 * Adding list-grid view support for shop page products.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function add_views_layout_support() {
			$shop_page_style = astra_get_option( 'shop-style' );
			$html_markup     = '<div class="ast-products-view">';
			$html_markup    .= '<span class="ast-view-trigger ' . esc_attr( 'shop-page-list-style' === $shop_page_style ? '' : 'active' ) . '" data-view="grid">' . Astra_Builder_UI_Controller::fetch_svg_icon( 'th-large', false ) . '</span>';
			$html_markup    .= '<span class="ast-view-trigger ' . esc_attr( 'shop-page-list-style' === $shop_page_style ? 'active' : '' ) . '" data-view="list">' . Astra_Builder_UI_Controller::fetch_svg_icon( 'th-list', false ) . '</span>';
			$html_markup    .= '</div>';

			echo $html_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Off Canvas Filters button.
		 *
		 * @return void
		 */
		public function off_canvas_button() {

			$icon_class         = apply_filters( 'astra_woo_off_canvas_trigger_icon', 'astra-woo-filter-icon' );
			$filter_text        = '';
			$trigger_link       = astra_get_option( 'shop-filter-trigger-link' );
			$filter_position    = astra_get_option( 'shop-filter-position' );
			$current_attributes = '';
			$data_attribute     = '';
			$class_attribute    = '';

			if ( 'shop-filter-collapsible' === $filter_position ) {
				$class_attribute = 'astra-shop-filter-button ast-collapsible-filter';
			}

			if ( 'shop-filter-flyout' === $filter_position ) {
				$class_attribute = 'astra-shop-filter-button ast-flyout-filter';
			}

			if ( ! empty( $trigger_link ) ) {
				$filter_text = '<span class="astra-woo-filter-text">' . $trigger_link . '</span>';
			}

			$icon       = ( self::is_shop_page_modern_style() && true === Astra_Icons::is_svg_icons() ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'sliders-h', false ) : Astra_Icons::get_icons( 'menu-bars' );
			$icon_close = ! self::is_shop_page_modern_style() ? Astra_Icons::get_icons( 'close' ) : '';
			switch ( astra_get_option( 'shop-off-canvas-trigger-type' ) ) {
				case 'link':
					echo '<a href="#" class="' . esc_attr( $class_attribute ) . '" data-selector="astra-off-canvas-sidebar-wrapper"><span class="' . $icon_class . '">' . $icon . ' ' . $icon_close . '</span>' . $filter_text . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;

				case 'button':
					echo '<button class="' . esc_attr( $class_attribute ) . '" data-selector="astra-off-canvas-sidebar-wrapper"><span class="' . $icon_class . '">' . $icon . ' ' . $icon_close . '</span>' . $filter_text . '</button>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;
			}

			// Collapsible Filter.
			add_action( 'wp', array( $this, 'shop_filter' ), 99 );
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
			if ( ! astra_get_option( 'single-product-breadcrumb-disable' ) ) {
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
						case 'summary-extras':
							do_action( 'astra_woo_single_extras_before' );
							$this->single_product_extras();
							do_action( 'astra_woo_single_extras_after' );
							break;
						case 'single-product-payments':
							do_action( 'astra_woo_single_product_payments_before' );
							$this->woocommerce_product_single_payments();
							do_action( 'astra_woo_single_product_payments_after' );
							break;
						case 'meta':
							do_action( 'astra_woo_single_category_before' );
							woocommerce_template_single_meta();
							do_action( 'astra_woo_single_category_after' );
							break;
						case 'category':
							do_action( 'astra_woo_single_product_category_before' );
							$this->single_product_category();
							do_action( 'astra_woo_single_product_category_after' );
							break;
						default:
							break;
					}
				}

				// Product single tabs accordion.
				if ( astra_get_option( 'accordion-inside-woo-summary' ) && 'accordion' === astra_get_option( 'single-product-tabs-layout' ) && astra_get_option( 'single-product-tabs-display' ) ) {
					$this->woo_product_tabs_layout_output();
				}
			}
		}

		/**
		 * Show the product catgories in the product loop.
		 */
		public function single_product_category() {
			global $product;
			echo '<span class="single-product-category">' . wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ' ) ) . '</span>';
		}

		/**
		 * Show single product extras.
		 *
		 * @return html product extra markup.
		 * @since 3.9.0
		 */
		public function single_product_extras() {
			ob_start();
			?>
				<div class="ast-single-product-extras">
					<?php
					$extras_text = astra_get_option( 'single-product-extras-text' );

					if ( $extras_text ) {
						?>
						<p class="ast-heading"><?php echo esc_html( $extras_text ); ?></p>
					<?php } ?>

					<?php

					$extras_list = astra_get_option( 'single-product-extras-list' );

					if ( isset( $extras_list['items'] ) ) {
						?>
						<ul>
							<?php foreach ( $extras_list['items'] as $single ) { ?>
								<?php if ( isset( $single['enabled'] ) && true === $single['enabled'] ) { ?>
									<?php $icon_data_attr = isset( $single['icon'] ) && ! $single['icon'] ? 'data-icon="false"' : 'data-icon="true"'; ?>
									<li <?php echo $icon_data_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php
										if ( isset( $single['icon'] ) && $single['icon'] ) {
											echo Astra_Builder_UI_Controller::fetch_svg_icon( $single['icon'], false ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										}
										if ( isset( $single['label'] ) ) {
											echo esc_html( $single['label'] );
										}
										?>
									</li>
								<?php } ?>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>
			<?php
			$output = ob_get_contents();
			return $output;

		}

		/**
		 * Astra Sale flash markup.
		 *
		 * @param string $sale_notification sale bubble type.
		 * @param string $product Product.
		 * @return mixed HTML markup.
		 */
		public function get_sale_flash_markup( $sale_notification, $product ) {
			$sale_percent_value   = '';
			$text                 = __( 'Sale!', 'astra-addon' ); // Default text.
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
			$classes[] = ( self::is_shop_page_modern_style() ) ? 'ast-on-card-button ast-onsale-card' : 'onsale';
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
		 * Sale bubble flash
		 *
		 * @param  mixed  $markup  HTML markup of the the sale bubble / flash.
		 * @param  string $post Post.
		 * @param  string $product Product.
		 * @return string bubble markup.
		 */
		public function sale_flash( $markup, $post, $product ) {

			$sale_notification = astra_get_option( 'product-sale-notification', '', 'default' );

			// If none then return!
			if ( 'none' === $sale_notification || ( ! is_singular( 'product' ) && self::is_shop_page_modern_style() ) ) {
				return;
			}

			return $this->get_sale_flash_markup( $sale_notification, $product );
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
		 * Checking whether shop page style is selected as modern layout.
		 *
		 * @return bool true|false.
		 */
		public static function is_shop_page_modern_style() {
			return ( 'shop-page-modern-style' === astra_get_option( 'shop-style' ) ) ? true : false;
		}

		/**
		 * Checking whether easy list view setting is enable or not.
		 *
		 * @return bool true|false.
		 */
		public static function is_easy_view_switcher_enable() {
			return in_array( 'easy_view', self::get_shop_toolbar_option() );
		}

		/**
		 * Get priority for shop toolbar elements.
		 * Cause: 2 elements will keep at left & 2 are right.
		 *
		 * @return int $priority
		 */
		public static function get_toolbar_elements_processed_array() {
			$processed_array       = array();
			$shop_toolbar_strcture = self::get_shop_toolbar_option();

			foreach ( $shop_toolbar_strcture as $key => $value ) {
				$priority                  = $key + 15;
				$processed_array[ $value ] = $priority;
			}

			$defaults = array(
				'filters'   => false,
				'results'   => false,
				'sorting'   => false,
				'easy_view' => false,
			);

			return wp_parse_args( $processed_array, $defaults );
		}

		/**
		 * Instead of every time of astra_get_option used static at once.
		 *
		 * @return array
		 */
		public static function get_shop_toolbar_option() {
			return astra_get_option( 'shop-toolbar-structure', array() );
		}

		/**
		 * Body Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @return array;
		 */
		public function body_class( $classes ) {
			$shop_style = astra_get_option( 'shop-style' );
			if ( is_shop() || is_product_taxonomy() ) {

				$classes[] = 'ast-default-' . $shop_style;

				if (
					self::is_easy_view_switcher_enable() &&
					! in_array( 'short_desc', astra_get_option( 'shop-product-structure' ) ) &&
					( 'shop-page-modern-style' === $shop_style || 'shop-page-grid-style' === $shop_style )
				) {
					$classes[] = 'ast-force-short-desc-listview-display';
				}

				if ( 'shop-page-list-style' == $shop_style || self::is_shop_page_modern_style() ) {
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

				if ( 'shop-page-list-style' === $shop_style || self::is_shop_page_modern_style() ) {
					$classes[] = 'ast-woocommerce-related-upsell-list-style';
				}

				$rel_up_columns = astra_get_option( 'single-product-related-upsell-grid' );

				$classes[] = 'rel-up-columns-' . $rel_up_columns['desktop'];
				$classes[] = 'tablet-rel-up-columns-' . $rel_up_columns['tablet'];
				$classes[] = 'mobile-rel-up-columns-' . $rel_up_columns['mobile'];

			} elseif ( is_checkout() ) {

				$checkout_layout = astra_get_option( 'checkout-layout-type', 'default' );

				if ( ! defined( 'CARTFLOWS_VER' ) && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === $checkout_layout ) {
					$classes[] = 'ast-modern-checkout';
				}

				if ( astra_get_option( 'two-step-checkout' ) && 'default' === astra_get_option( 'checkout-layout-type' ) ) {
					$classes[] = 'ast-woo-two-step-checkout';
				}

				if ( astra_get_option( 'two-step-checkout' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
					$classes[] = 'ast-woo-two-step-modern-checkout';
				}

				if ( astra_get_option( 'checkout-labels-as-placeholders' ) ) {
					$classes[] = 'ast-checkout-labels-as-placeholders';
				}
				if ( astra_get_option( 'checkout-distraction-free' ) ) {
					$classes[] = 'distraction-free';
				}
			} elseif ( is_account_page() && true === astra_get_option( 'modern-woo-account-view' ) ) {
				$classes[] = 'ast-modern-woo-account-page';
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
			global $product;
			$wp_doing_ajax = wp_doing_ajax();

			if ( is_shop() || is_product_taxonomy() || ( post_type_exists( 'product' ) && 'product' === get_post_type() ) || $wp_doing_ajax ) {

				// Shop page summary box alignment.
				$shop_product_alignment = astra_get_option( 'shop-product-align-responsive' );
				$desktop_alignment      = ( isset( $shop_product_alignment['desktop'] ) ) ? $shop_product_alignment['desktop'] : '';
				$tablet_alignment       = ( isset( $shop_product_alignment['tablet'] ) ) ? $shop_product_alignment['tablet'] : '';
				$mobile_alignment       = ( isset( $shop_product_alignment['mobile'] ) ) ? $shop_product_alignment['mobile'] : '';

				$classes[] = 'desktop-' . esc_attr( $desktop_alignment );
				$classes[] = 'tablet-' . esc_attr( $tablet_alignment );
				$classes[] = 'mobile-' . esc_attr( $mobile_alignment );

				// Single product gallery layout ( vertical / horizontal / first image large ).
				$classes[] = 'ast-product-gallery-layout-' . astra_get_option( 'single-product-gallery-layout' );

				$image_gallery = get_post_meta( get_the_ID(), '_product_image_gallery', true );
				if ( empty( $image_gallery ) ) {
					$classes[] = 'ast-product-gallery-with-no-image';
				}

				if ( ! astra_get_option( 'single-product-image-zoom-effect' ) ) {
					$classes[] = 'ast-magnify-disabled';
				}

				if ( $product && $product->is_type( 'variable' ) ) {
					$classes[] = 'ast-product-single-variable';

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

			// Checkout Layout.
			$checkout_layout = astra_get_option( 'checkout-modern-layout-type' );
			if ( is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) && $checkout_layout ) {
				$classes[] = 'ast-' . $checkout_layout;
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
			if ( astra_get_option( 'two-step-checkout' ) && 'default' === astra_get_option( 'checkout-layout-type' ) ) {
				add_action( 'woocommerce_checkout_before_customer_details', 'astra_two_step_checkout_form_wrapper_div', 1 );
				add_action( 'woocommerce_checkout_before_customer_details', 'astra_two_step_checkout_form_ul_wrapper', 2 );
				add_action( 'woocommerce_checkout_order_review', 'astra_woocommerce_div_wrapper_close', 30 );
				add_action( 'woocommerce_checkout_order_review', 'astra_woocommerce_ul_close', 30 );
				add_action( 'woocommerce_checkout_before_customer_details', 'astra_two_step_checkout_address_li_wrapper', 5 );
				add_action( 'woocommerce_checkout_after_customer_details', 'astra_woocommerce_li_close' );
				add_action( 'woocommerce_checkout_before_order_review', 'astra_two_step_checkout_order_review_wrap', 1 );
				add_action( 'woocommerce_checkout_after_order_review', 'astra_woocommerce_li_close', 40 );
			}

			/*
			 * Two Step Modern Checkout Page
			 */
			if ( ! defined( 'CARTFLOWS_VER' ) && astra_get_option( 'two-step-checkout' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) && ! is_wc_endpoint_url( 'order-received' ) ) {

				add_action( 'astra_entry_content_before', array( $this, 'get_checkout_form_note' ), 10, 1 );

				add_action( 'woocommerce_checkout_before_customer_details', array( $this, 'add_two_step_first_step_wrapper' ), 13 );

				add_action( 'astra_entry_content_before', array( $this, 'add_two_step_second_step_wrapper' ), 11 );

				add_action( 'astra_entry_content_before', array( $this, 'add_two_step_nav_menu' ), 12, 1 );

				add_action( 'woocommerce_checkout_after_customer_details', array( $this, 'add_two_step_next_btn' ), 12 );

				add_action( 'woocommerce_checkout_after_customer_details', array( $this, 'add_two_step_closing_div' ), 13 );

				add_action( 'astra_entry_content_after', array( $this, 'add_two_step_closing_div' ), 14 );

				add_action( 'woocommerce_checkout_before_order_review_heading', array( $this, 'add_two_step_second_step_order_wrapper' ), 14 );

				add_action( 'woocommerce_checkout_after_order_review', array( $this, 'add_two_step_closing_div' ), 14 );

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

			astra_addon_get_template( 'woocommerce/templates/checkout-header.php' );
		}

		/**
		 * Footer markup.
		 */
		public function checkout_footer_markup() {

			astra_addon_get_template( 'woocommerce/templates/checkout-footer.php' );
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
			$uri  = ASTRA_ADDON_EXT_WOOCOMMERCE_URI . 'assets/css/';
			$path = ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'assets/css/';
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
			$list_style_css    = Astra_Addon_Builder_Helper::apply_flex_based_css() ? 'shop-page-list-style-grid' : 'shop-page-list-style';
			$list_style_loaded = false;

			if ( 'shop-page-list-style' === astra_get_option( 'shop-style' ) ) {
				Astra_Minify::add_css( $gen_path . $list_style_css . $file_prefix . '.css' );
				// Single Product related & upsell product style.
				$related_upsell_list_style = ( true === Astra_Addon_Builder_Helper::apply_flex_based_css() ) ? 'related-upsell-list-style-grid' : 'related-upsell-list-style';
				Astra_Minify::add_css( $gen_path . $related_upsell_list_style . $file_prefix . '.css' );
				$list_style_loaded = true;
			}

			if ( true === self::is_easy_view_switcher_enable() && false === $list_style_loaded ) {
				Astra_Minify::add_css( $gen_path . $list_style_css . $file_prefix . '.css' );
			}

			if ( self::is_shop_page_modern_style() ) {
				Astra_Minify::add_css( $gen_path . 'shop-page-modern-style' . $file_prefix . '.css' );
			}

			if ( astra_get_option( 'two-step-checkout' ) && 'default' === astra_get_option( 'checkout-layout-type' ) ) {
				Astra_Minify::add_css( $gen_path . 'two-steps-checkout' . $file_prefix . '.css' );
			}

			if ( astra_get_option( 'checkout-labels-as-placeholders' ) && 'default' === astra_get_option( 'woo-input-style-type' ) ) {
				Astra_Minify::add_css( $gen_path . 'checkout-labels-as-placeholders' . $file_prefix . '.css' );
			}
			if ( self::add_to_cart_quantity_btn_enabled() ) {
				Astra_Minify::add_css( $gen_path . 'add-to-cart-quantity-btn' . $file_prefix . '.css' );
			}

			$quick_view = astra_get_option( 'shop-quick-view-enable' );

			if ( $quick_view ) {
				Astra_Minify::add_css( $gen_path . 'quick-view' . $file_prefix . '.css' );
			}

			if ( 'first-image-large' === astra_get_option( 'single-product-gallery-layout' ) ) {
				Astra_Minify::add_css( $gen_path . 'tinyslider' . $file_prefix . '.css' );
			}

			if ( astra_get_option( 'single-product-sticky-add-to-cart' ) ) {
				Astra_Minify::add_css( $gen_path . 'sticky-add-to-cart' . $file_prefix . '.css' );
			}

			/* product payment */
			$single_product_payment_array = astra_get_option( 'single-product-structure' );
			if ( is_array( $single_product_payment_array ) && ! empty( $single_product_payment_array ) && in_array( 'single-product-payments', $single_product_payment_array ) ) {
				Astra_Minify::add_css( $gen_path . 'product-payment' . $file_prefix . '.css' );
			}

			if ( astra_get_option( 'cart-modern-layout' ) ) {
				Astra_Minify::add_css( $gen_path . 'modern-cart' . $file_prefix . '.css' );
				Astra_Minify::add_css( $gen_path . 'cart-cross-sells-list-view' . $file_prefix . '.css' );
			}

			if ( astra_get_option( 'cart-multistep-checkout' ) ) {
				Astra_Minify::add_css( $gen_path . 'cart-mutistep-checkout' . $file_prefix . '.css' );
			}

			// Modern Input Styles.
			if ( 'modern' === astra_get_option( 'woo-input-style-type' ) ) {
				Astra_Minify::add_css( $gen_path . 'woo-modern-input' . $file_prefix . '.css' );
			}

			if ( ! defined( 'CARTFLOWS_VER' ) ) {

				if ( 'modern' === astra_get_option( 'checkout-layout-type' ) ) {
					Astra_Minify::add_css( $gen_path . 'modern-checkout' . $file_prefix . '.css' );
				}

				if ( astra_get_option( 'two-step-checkout' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) ) {
					Astra_Minify::add_css( $gen_path . 'two-step-modern-checkout' . $file_prefix . '.css' );
				}

				if ( astra_get_option( 'checkout-modern-order-received' ) ) {
					Astra_Minify::add_css( $gen_path . 'order-received' . $file_prefix . '.css' );

				}
			}

		}


		/**
		 * Add Scripts
		 */
		public function add_scripts() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_WOOCOMMERCE_URI . 'assets/js/';
			$path = ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'assets/js/';

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

			if ( self::add_to_cart_quantity_btn_enabled() ) {
				Astra_Minify::add_js( $gen_path . 'add-to-cart-quantity-btn' . $file_prefix . '.js' );
			}

			if ( astra_get_option( 'single-product-tabs-display' ) && 'accordion' === astra_get_option( 'single-product-tabs-layout' ) ) {
				Astra_Minify::add_js( $gen_path . 'single-product-tab-layout' . $file_prefix . '.js' );
			}

			if ( 'horizontal-slider' === astra_get_option( 'single-product-gallery-layout' ) ) {
				Astra_Minify::add_js( $gen_path . 'horizontal-product-gallery-slider' . $file_prefix . '.js' );
			}

			if ( 'vertical-slider' === astra_get_option( 'single-product-gallery-layout' ) ) {
				Astra_Minify::add_js( $gen_path . 'vertical-product-gallery-slider' . $file_prefix . '.js' );
			}

			if ( 'first-image-large' === astra_get_option( 'single-product-gallery-layout' ) ) {
				Astra_Minify::add_js( $gen_path . 'tinyslider' . $file_prefix . '.js' );
				Astra_Minify::add_js( $gen_path . 'first-image-large-gallery' . $file_prefix . '.js' );
			}

			if ( 'vertical-slider' === astra_get_option( 'single-product-gallery-layout' ) || 'horizontal-slider' === astra_get_option( 'single-product-gallery-layout' ) ) {
				Astra_Minify::add_dependent_js( 'flexslider' );
				Astra_Minify::add_js( $gen_path . 'single-product-gallery' . $file_prefix . '.js' );
			}

			if ( astra_get_option( 'single-product-sticky-add-to-cart' ) ) {
				Astra_Minify::add_js( $gen_path . 'sticky-add-to-cart' . $file_prefix . '.js' );
			}

			if ( astra_get_option( 'shop-filter-accordion' ) ) {
				Astra_Minify::add_js( $gen_path . 'shop-filters' . $file_prefix . '.js' );
			}

			if ( astra_get_option( 'single-product-select-variations' ) ) {
				Astra_Minify::add_js( $gen_path . 'single-product-variations' . $file_prefix . '.js' );
			}

			if ( astra_get_option( 'shop-active-filters-sticky-sidebar' ) || astra_get_option( 'single-product-sticky-summary' ) || ( astra_get_option( 'cart-modern-layout' ) && astra_get_option( 'cart-sticky-cart-totals' ) ) || ( 'modern' === astra_get_option( 'checkout-layout-type' ) && astra_get_option( 'checkout-order-review-sticky' ) ) ) {
				Astra_Minify::add_js( $gen_path . 'sticky-section' . $file_prefix . '.js' );
			}

			if ( astra_get_option( 'cart-modern-layout' ) ) {
				Astra_Minify::add_js( $gen_path . 'cart-cross-sells-list-view' . $file_prefix . '.js' );
			}

			if ( astra_get_option( 'cart-modern-layout' ) || 'modern' === astra_get_option( 'checkout-layout-type' ) ) {
				Astra_Minify::add_js( $gen_path . 'modern-coupon' . $file_prefix . '.js' );
			}

			if ( astra_get_option( 'cart-ajax-cart-quantity' ) ) {
				Astra_Minify::add_js( $gen_path . 'ajax-cart-quantity-updater' . $file_prefix . '.js' );
			}

			// Modern Layout Input.
			if ( 'modern' === astra_get_option( 'woo-input-style-type' ) ) {
				Astra_Minify::add_js( $gen_path . 'woo-common-input' . $file_prefix . '.js' );
			}

			if ( ! defined( 'CARTFLOWS_VER' ) ) {
				// Collapsed Order Review.
				if ( 'modern' === astra_get_option( 'checkout-layout-type' ) ) {
					Astra_Minify::add_js( $gen_path . 'modern-checkout' . $file_prefix . '.js' );
				}

				if ( astra_get_option( 'two-step-checkout' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) ) {
					Astra_Minify::add_js( $gen_path . 'two-step-modern-checkout' . $file_prefix . '.js' );
				}
			}

		}

		/**
		 * Init Modern Shop view's items.
		 *
		 * @since 3.9.0
		 */
		public function render_modern_shop_view() {
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'add_modern_triggers_on_image' ), 5 );
		}

		/**
		 * Modern shop page's triggers on product image.
		 *
		 * @since 3.9.0
		 */
		public function add_modern_triggers_on_image() {

			global $product;
			$markup     = '';
			$product_id = $product->get_id();

			// Sale bubble markup.
			$sale_notification = astra_get_option( 'product-sale-notification', '', 'default' );
			if ( $product->is_on_sale() && 'none' !== $sale_notification ) {
				$markup .= $this->get_sale_flash_markup( $sale_notification, $product );
			}

			// Product link markup.
			$header_woo_cart = astra_get_option( 'woo-header-cart-icon', 'default' );
			$cart_icon       = ( true === Astra_Icons::is_svg_icons() ) ? Astra_Icons::get_icons( 'default' === $header_woo_cart ? 'bag' : $header_woo_cart ) : Astra_Builder_UI_Controller::fetch_svg_icon( 'shopping-' . $header_woo_cart, false );
			$classes         = implode(
				' ',
				array_filter(
					array(
						'ast-on-card-button',
						'ast-select-options-trigger',
						'product_type_' . $product->get_type(),
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
					)
				)
			);
			$attributes      = array(
				'data-product_id'  => $product->get_id(),
				'data-product_sku' => $product->get_sku(),
				'aria-label'       => $product->add_to_cart_description(),
				'rel'              => 'nofollow',
			);
			$markup         .= sprintf(
				'<a href="%s" data-quantity="%s" class="%s" %s> <span class="ast-card-action-tooltip"> %s </span> <span class="ahfb-svg-iconset"> %s </span> </a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( 1 ),
				esc_attr( $classes ),
				wc_implode_html_attributes( $attributes ),
				esc_html( $product->add_to_cart_text() ),
				$cart_icon
			);

			// Quick view markup.
			$qv_enable = astra_get_option( 'shop-quick-view-enable' );
			if ( 'disabled' !== $qv_enable && 'on-image' === $qv_enable ) {
				$quick_view_button_text = apply_filters( 'astra_addon_product_card_quick_view_text', __( 'Quick View', 'astra-addon' ) );
				add_filter( 'astra_theme_js_localize', array( $this, 'qv_js_localize' ) );

				$markup .= '<span class="ast-on-card-button ast-quick-view-trigger" data-product_id="' . esc_attr( $product_id ) . '"> <span class="ast-card-action-tooltip">' . esc_attr( $quick_view_button_text ) . '</span>' . Astra_Builder_UI_Controller::fetch_svg_icon( 'eye', false ) . '</span>';

				// load modal template.
				add_action( 'wp_footer', array( $this, 'quick_view_html' ) );
			}

			$html = apply_filters( 'astra_addon_shop_cards_buttons_html', $markup, $product );

			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
				} elseif ( 'on-image' === $qv_enable && false === self::is_shop_page_modern_style() ) {

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
			astra_addon_get_template( 'woocommerce/templates/quick-view-product.php' );

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

			astra_addon_get_template( 'woocommerce/templates/quick-view-product-image.php' );
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

			astra_addon_get_template( 'woocommerce/templates/quick-view-modal.php' );
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
		 * Woocommece single product layouts.
		 *
		 * @since 3.9.0
		 * @return mixed
		 */
		public function woo_single_product_layouts() {

			if ( class_exists( 'woocommerce' ) && is_product() ) {

				// Vertical product gallery slider.
				if ( 'vertical-slider' === astra_get_option( 'single-product-gallery-layout' ) || 'horizontal-slider' === astra_get_option( 'single-product-gallery-layout' ) ) {
					remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
					add_action( 'woocommerce_before_single_product_summary', array( $this, 'woo_single_product_gallery_output' ), 20 );

					add_filter(
						'woocommerce_gallery_thumbnail_size',
						function( $size ) {
							return 'thumbnail';
						}
					);

					add_filter( 'woocommerce_single_product_carousel_options', array( $this, 'filter_single_product_carousel_options' ) );
				}

				// First image large gallery.
				if ( 'first-image-large' === astra_get_option( 'single-product-gallery-layout' ) ) {

					remove_theme_support( 'wc-product-gallery-slider' );

					add_filter(
						'woocommerce_gallery_thumbnail_size',
						function( $size ) {
							return 'medium';
						}
					);
				}
			}
		}

		/**
		 * Single product sticky add to cart.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function single_product_sticky_add_to_cart() {

			if ( is_product() && astra_get_option( 'single-product-sticky-add-to-cart' ) ) {
				global $post;
				$product          = wc_get_product( $post->ID );
				$sticky_position  = astra_get_option( 'single-product-sticky-add-to-cart-position' );
				$add_to_cart_ajax = astra_get_option( 'single-product-ajax-add-to-cart' );

				if ( ( $product->is_purchasable() && ( $product->is_in_stock() || $product->backorders_allowed() ) ) || $product->is_type( 'external' ) ) {
					echo '<div class="ast-sticky-add-to-cart ' . esc_attr( $sticky_position ) . '">';
					echo '<div class="ast-container">';
						echo '<div class="ast-sticky-add-to-cart-content">';
							echo '<div class="ast-sticky-add-to-cart-title-wrap">';
								echo wp_kses_post( woocommerce_get_product_thumbnail() );
								echo '<span class="ast-sticky-add-to-cart-title">' . wp_kses_post( get_the_title() ) . '</span>';
							echo '</div>';
							echo '<div class="ast-sticky-add-to-cart-action-wrap">';
					if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) || $product->is_type( 'subscription' ) ) {
						echo '<span class="ast-sticky-add-to-cart-action-price price">' . wp_kses_post( $product->get_price_html() ) . '</span>';
						if ( $add_to_cart_ajax ) {
							echo '<div id="sticky-add-to-cart">';
						}
							woocommerce_template_single_add_to_cart();
						if ( $add_to_cart_ajax ) {
							echo '</div>';
						}
					} else {
						echo '<span class="ast-sticky-add-to-cart-action-price price">' . wp_kses_post( $product->get_price_html() ) . '</span>';
						echo '<a href="#product-' . esc_attr( $product->get_ID() ) . '" class="single_link_to_cart_button button alt">' . esc_html( $product->add_to_cart_text() ) . '</a>';
					}
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '</div>';
				}
			}
		}

		/**
		 * Woocommerce single product gallery output.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function woo_single_product_gallery_output() {
			include_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . '/templates/single-product-gallery.php';
		}

		/**
		 * Woocommerce single product flexslider options.
		 *
		 * @return array
		 * @param array $options Flexslider options.
		 * @since 3.9.0
		 */
		public function filter_single_product_carousel_options( $options ) {
			$options['controlNav'] = false;
			return $options;
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

			// Cart Plus Minus Button Type.
			$cart_plus_minus_button_type = astra_get_option( 'cart-plus-minus-button-type' );

			// Accessibility Text.
			$localize_vars['product_plus_minus_text'] = array(
				'plus_qty'   => __( 'Plus Quantity', 'astra-addon' ),
				'minus_qty'  => __( 'Minus Quantity', 'astra-addon' ),
				'style_type' => $cart_plus_minus_button_type,
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
			return apply_filters( 'astra_add_to_cart_quantity_btn_enabled', astra_get_option( 'single-product-plus-minus-button' ) );
		}

		/**
		 * Woocommerce single product tab styles.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function woo_product_tabs_layout() {
			if ( astra_get_option( 'single-product-tabs-display' ) ) {

				$product_tabs_type = astra_get_option( 'single-product-tabs-layout' );

				if ( 'accordion' === $product_tabs_type || 'distributed' === $product_tabs_type ) {
					remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

					if ( ! astra_get_option( 'accordion-inside-woo-summary' ) || 'distributed' === $product_tabs_type ) {
						add_action( 'woocommerce_after_single_product_summary', array( $this, 'woo_product_tabs_layout_output' ), 10 );
					}
				}
			}
		}

		/**
		 * Woocommerce single product tab output.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function woo_product_tabs_layout_output() {
			include_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . '/templates/single-product-tab-layout.php';
		}

		/**
		 * Woocommerce single product sticky.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function woo_single_product_sticky() {

			if ( ! astra_get_option( 'single-product-sticky-summary' ) ) {
				return;
			}

			add_action( 'woocommerce_before_single_product_summary', array( $this, 'sticky_content_wrapper_start' ), 10 );
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'sticky_content_wrapper_end' ), 9 );
		}

		/**
		 *  Adds opening div before product single gallery section.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function sticky_content_wrapper_start() {
			echo '<div id="ast-sticky-row-summary" class="ast-sticky-row">';
		}

		/**
		 * Adds closing div after product single summary section.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function sticky_content_wrapper_end() {
			echo '</div>';
		}



		/**
		 * Single product Quantity Ajax Offcanvas markup.
		 *
		 * @return void
		 */
		public function single_product_quantity_ajax_cart() {

			$woo_header_cart_click_action = astra_get_option( 'woo-header-cart-click-action' );

			add_filter(
				'woocommerce_widget_cart_item_quantity',
				array( $this, 'astra_addon_add_offcanvas_quantity_fields' ),
				10,
				3
			);
		}

		/**
		 * Single Product quantity update to cart ajax request
		 *
		 * @since 3.9.0
		 *
		 * @return void.
		 */
		public function astra_add_cart_single_product_quantity() {

			check_ajax_referer( 'single_product_qty_ajax_nonce', 'qtyNonce' );

			$cart_item_key = sanitize_text_field( $_POST['hash'] );

			$threeball_product_values = WC()->cart->get_cart_item( $cart_item_key );

			$threeball_product_quantity = apply_filters(
				'woocommerce_stock_amount_cart_item',
				apply_filters(
					'woocommerce_stock_amount',
					preg_replace(
						'/[^0-9\.]/',
						'',
						filter_var( $_POST['quantity'], FILTER_SANITIZE_NUMBER_INT )
					)
				),
				$cart_item_key
			);

			$passed_validation = apply_filters(
				'woocommerce_update_cart_validation',
				true,
				$cart_item_key,
				$threeball_product_values,
				$threeball_product_quantity
			);

			if ( $passed_validation ) {
				WC()->cart->set_quantity(
					$cart_item_key,
					$threeball_product_quantity,
					true
				);
			}

			die();
		}

		/**
		 * Offcanvas Cart Quantity fields.
		 *
		 * @param string $html html markup.
		 * @param array  $cart_item Cart item details.
		 * @param string $cart_item_key Cart item key.
		 * @return string
		 */
		public function astra_addon_add_offcanvas_quantity_fields( $html, $cart_item, $cart_item_key ) {

			$_product      = apply_filters(
				'woocommerce_cart_item_product',
				$cart_item['data'],
				$cart_item,
				$cart_item_key
			);
			$product_price = apply_filters(
				'woocommerce_cart_item_price',
				WC()->cart->get_product_price( $cart_item['data'] ),
				$cart_item,
				$cart_item_key
			);

			$product_subtotal = apply_filters(
				'woocommerce_cart_item_subtotal',
				WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ),
				$cart_item,
				$cart_item_key
			);

			if ( $_product->is_sold_individually() ) {
				$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
			} else {
				$product_quantity = trim(
					woocommerce_quantity_input(
						array(
							'input_name'   => "cart[{$cart_item_key}][qty]",
							'input_value'  => $cart_item['quantity'],
							'max_value'    => $_product->get_max_purchase_quantity(),
							'min_value'    => '0',
							'product_name' => $_product->get_name(),
						),
						$_product,
						false
					)
				);
			}

			return $product_quantity . '<div class="ast-mini-cart-price-wrap">' . $product_subtotal . '</div>';
		}

		/**
		 * Collapsible filter markup.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function shop_filter_markup() {

			ob_start();
			?>
				<div class="ast-collapse-filter">
						<?php
						if ( is_active_sidebar( 'astra-woo-product-off-canvas-sidebar' ) ) {
							dynamic_sidebar( 'astra-woo-product-off-canvas-sidebar' );
						}
						?>
				</div>
			<?php
			echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Single Product Variation Output.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function single_product_product_variations_custom_output() {
			if ( ! defined( 'CFVSW_VER' ) && class_exists( 'woocommerce' ) && is_product() && astra_get_option( 'single-product-select-variations' ) ) {
				add_filter( 'woocommerce_dropdown_variation_attribute_options_html', array( $this, 'single_product_variations_custom_html' ), 999, 2 );
			}
		}


		/**
		 * Filter list to buttons.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function filter_list_to_buttons() {

			if ( ( is_shop() || is_product_taxonomy() ) && astra_get_option( 'shop-filter-list-to-buttons' ) ) {

				// Remove woocommerce filter navigation count.
				add_filter( 'woocommerce_layered_nav_count', '__return_false' );

				add_filter( 'woocommerce_layered_nav_term_html', array( $this, 'custom_woocommerce_layered_nav_term_html' ), 10, 4 );
			}
		}

		/**
		 * Woocommerce layered nav term html.
		 *
		 * @param string  $term_html html markup.
		 * @param object  $term Terms.
		 * @param string  $link Link.
		 * @param integer $count Count.
		 * @return string HTML markup.
		 * @since 3.9.0
		 */
		public function custom_woocommerce_layered_nav_term_html( $term_html, $term, $link, $count ) {

			$term_html = str_replace( '<a rel="nofollow" href="' . esc_url( $link ) . '">' . esc_html( $term->name ) . '</a>', '<a rel="nofollow" href="' . esc_url( $link ) . '"><span class="title">' . esc_html( $term->name ) . '</span> <span class="count">(' . absint( $count ) . ')</span></a>', $term_html );

			return $term_html;
		}


		/**
		 * Multistep checkout.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function multistep_checkout() {
			if ( astra_get_option( 'cart-multistep-checkout' ) && ( is_cart() || is_checkout() || is_wc_endpoint_url( 'order-received' ) ) ) {
				add_action( 'astra_entry_content_before', array( $this, 'multistep_checkout_html_output' ), 9, 1 );
			}
		}

		/**
		 * Multistep checkout html output.
		 *
		 * @return void
		 * @param array $content content.
		 * @since 3.9.0
		 */
		public function multistep_checkout_html_output( $content ) {

			$active_class          = 'ast-current';
			$cart_active           = is_cart() ? $active_class : null;
			$checkout_active       = is_checkout() && ! is_wc_endpoint_url( 'order-received' ) ? $active_class : null;
			$order_received_active = is_wc_endpoint_url( 'order-received' ) ? $active_class : null;
			$enable_steps_numbers  = astra_get_option( 'cart-multistep-steps-numbers' );
			$steps_size            = astra_get_option( 'cart-multistep-checkout-size' );
			$step_number           = astra_get_option( 'cart-multistep-checkout-font-case' );
			ob_start();
			?>

			<div id="ast-checkout-wrap" class="ast-checkout-<?php echo esc_attr( $steps_size ); ?> ast-checkout-<?php echo esc_attr( $step_number ); ?>">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"
									<?php
									if ( $cart_active ) {
										?>
					class="<?php echo esc_attr( $cart_active ); ?>" <?php } ?>>
					<?php
					if ( $enable_steps_numbers ) {
						?>
						<span class="ast-step-number"><?php esc_html_e( '1', 'astra-addon' ); ?></span><?php } ?><p><?php esc_html_e( 'Shopping Cart', 'astra-addon' ); ?></p>
				</a>
				<?php echo Astra_Builder_UI_Controller::fetch_svg_icon( 'angle-right' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
									<?php
									if ( $checkout_active ) {
										?>
					class="<?php echo esc_attr( $checkout_active ); ?>" <?php } ?>>
					<?php
					if ( $enable_steps_numbers ) {
						?>
						<span class="ast-step-number"><?php esc_html_e( '2', 'astra-addon' ); ?></span><?php } ?><p><?php esc_html_e( 'Checkout details', 'astra-addon' ); ?></p>
				</a>
				<?php echo Astra_Builder_UI_Controller::fetch_svg_icon( 'angle-right' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<a href="#" class="ast-disable-click
				<?php
				if ( $order_received_active ) {
					echo esc_attr( $order_received_active ); }
				?>
				">
					<?php
					if ( $enable_steps_numbers ) {
						?>
						<span class="ast-step-number"><?php esc_html_e( '3', 'astra-addon' ); ?></span><?php } ?><p><?php esc_html_e( 'Order Complete', 'astra-addon' ); ?></p>
				</a>
			</div>

			<?php
			$custom_content  = ob_get_clean();
			$custom_content .= $content;
			echo $custom_content;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Modern Checkout.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function modern_checkout() {

			if ( ! defined( 'CARTFLOWS_VER' ) && is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) ) {

				// Modern input layout.
				add_filter( 'woocommerce_checkout_fields', array( $this, 'checkout_column_layout_fields' ) );

				// Adds placeholder for modern input.
				add_filter( 'woocommerce_checkout_fields', array( $this, 'label_fields_customization' ), 1000 );

				// Adds payment title before payment section.
				add_action( 'woocommerce_review_order_before_payment', array( $this, 'display_custom_payment_heading' ), 12 );

				if ( ! astra_get_option( 'two-step-checkout' ) ) {

					// Adds collapsible order review for modern layout mobile.
					add_action( 'woocommerce_before_checkout_form', array( $this, 'checkout_collapsible_order_review' ), 8 );

					if ( 'two-column-checkout' === astra_get_option( 'checkout-modern-layout-type' ) ) {
						remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

						add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );

						add_action( 'woocommerce_checkout_before_order_review_heading', array( $this, 'woocommerce_order_review_start' ) );

						add_action( 'woocommerce_checkout_after_order_review', array( $this, 'woocommerce_order_review_end' ) );
					}

					if ( 'one-column-checkout' === astra_get_option( 'checkout-modern-layout-type' ) ) {
						remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

						add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 10, 0 );
					}
				}

				// Adds custom email fields.
				add_action( 'woocommerce_checkout_billing', array( $this, 'checkout_billing_email_field' ), 9, 1 );

				// Unset non required fields.
				add_filter( 'woocommerce_checkout_fields', array( $this, 'unset_fields_for_modern_checkout' ), 10, 1 );

				// Remove default register form.
				remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

				if ( astra_get_option( 'checkout-coupon-display' ) ) {
					add_action( 'woocommerce_after_order_notes', array( $this, 'woocommerce_modern_coupon_cart' ) );
				}
			}

			// Update the cart total price to display on button and on the mobile order view section.
			add_filter( 'woocommerce_update_order_review_fragments', array( $this, 'add_updated_cart_price' ), 11, 1 );

			// Adds image for checkout product summary.
			add_filter( 'woocommerce_cart_item_name', array( $this, 'add_cart_product_image' ), 10, 3 );

			// Place order button text with price.
			add_action( 'woocommerce_order_button_text', array( $this, 'checkout_place_order_button_text' ) );

			// Adds class to cart item.
			add_filter( 'woocommerce_cart_item_class', array( $this, 'additional_class_to_cart_item_classes' ), 10, 3 );

		}

		/**
		 * Update cart total on button and order review mobile sction.
		 *
		 * @param string $fragments shipping message.
		 *
		 * @return array $fragments updated Woo fragments.
		 */
		public function add_updated_cart_price( $fragments ) {

			if ( ! defined( 'CARTFLOWS_VER' ) && is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) ) {

				$fragments['.ast-order-review-total'] = "<div class='ast-order-review-total'>" . WC()->cart->get_total() . '</div>';

			}
			return $fragments;
		}

		/**
		 * Customized order review section used to display in modern checkout responsive devices.
		 *
		 * @return void
		 * @since 3.9.0
		 */
		public function checkout_collapsible_order_review() {
			astra_addon_get_template( 'woocommerce/templates/collapsed-order-review.php' );
		}

		/**
		 * Prefill the checkout fields if available in url.
		 *
		 * @param array $checkout_fields checkout fields array.
		 * @since 3.9.0
		 */
		public function unset_fields_for_modern_checkout( $checkout_fields ) {

			// Unset defalut billing email from Billing Details.
			unset( $checkout_fields['billing']['billing_email'] );
			unset( $checkout_fields['account']['account_username'] );
			unset( $checkout_fields['account']['account_password'] );

			return $checkout_fields;
		}

		/**
		 * Check email exist.
		 *
		 * @since 3.9.0
		 */
		public function astra_check_email_exist() {

			check_ajax_referer( 'check-email-exist', 'security' );

			$email_address = isset( $_POST['email_address'] ) ? sanitize_email( wp_unslash( $_POST['email_address'] ) ) : false;

			$is_exist = email_exists( $email_address );

			$response = array(
				'success'          => filter_var( $is_exist, FILTER_VALIDATE_BOOLEAN ),
				'is_login_allowed' => 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ),
				'msg'              => $is_exist ? __( 'Email Exist.', 'astra-addon' ) : __( 'Email not exist', 'astra-addon' ),
			);

			wp_send_json_success( $response );
		}

		/**
		 * Check email exist.
		 *
		 * @since 3.9.0
		 */
		public function astra_woocommerce_login_user() {

			check_ajax_referer( 'woocommerce-login', 'security' );

			$response = array(
				'success' => false,
			);

			$email_address = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : false;
			$password      = isset( $_POST['password'] ) ? wp_unslash( $_POST['password'] ) : false; // phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

			$creds = array(
				'user_login'    => $email_address,
				'user_password' => $password,
				'remember'      => false,
			);

			$user = wp_signon( $creds, false );

			if ( ! is_wp_error( $user ) ) {

				$response = array(
					'success' => true,
				);
			} else {
				$response['error'] = wp_kses_post( $user->get_error_message() );
			}

			wp_send_json_success( $response );
		}

		/**
		 * Add Custom Email Field.
		 *
		 * @return void
		 */
		public function checkout_billing_email_field() {
			$lost_password_url  = get_site_url() . '/my-account/lost-password/';
			$current_user_name  = wp_get_current_user()->display_name;
			$current_user_email = wp_get_current_user()->user_email;
			$is_allow_login     = 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' );

			?>
				<div class="ast-customer-info" id="customer_info">
					<div class="ast-customer-info__notice woocommerce-error"></div>
					<div class="woocommerce-billing-fields-custom">
						<h3><?php esc_html_e( apply_filters( 'astra_addon_modern_checkout_customer_info_title', __( 'Customer information', 'astra-addon' ) ) ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText ?>
							<?php if ( ! is_user_logged_in() && $is_allow_login ) { ?>
								<div class="woocommerce-billing-fields__customer-login-label"><?php /* translators: %1$s: Link HTML start, %2$s Link HTML End */ echo sprintf( __( 'Already have an account? %1$1s Log in%2$2s', 'astra-addon' ), '<a href="javascript:" id="ast-customer-login-url">', '</a>' ); ?></div> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php } ?>
						</h3>
						<div class="woocommerce-billing-fields__customer-info-wrapper">
						<?php
						if ( ! is_user_logged_in() ) {

								woocommerce_form_field(
									'billing_email',
									array(
										'type'         => 'email',
										'class'        => array( 'form-row-fill' ),
										'required'     => true,
										'label'        => __( 'Email Address', 'astra-addon' ),
										'placeholder'  => __( 'Email Address', 'astra-addon' ),
										'autocomplete' => 'email username',
										'default'      => isset( $_COOKIE['ast_modern_checkout_useremail'] ) ? esc_attr( $_COOKIE['ast_modern_checkout_useremail'] ) : '',
									)
								);

							if ( 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
								?>
									<div id="ast-customer-login-section">
										<div class="ast-customer-login-inner-wrap">
										<?php
											woocommerce_form_field(
												'billing_password',
												array(
													'type' => 'password',
													'class' => array( 'form-row-fill', 'ast-password-field' ),
													'required' => true,
													'label' => __( 'Password', 'astra-addon' ),
													'placeholder' => __( 'Password', 'astra-addon' ),
												)
											);
										?>
										<div class="ast-customer-login-actions">
									<?php
											echo "<input type='button' name='ast-customer-login-btn' class='button ast-customer-login-section__login-button' id='ast-customer-login-section__login-button' value='" . esc_html( __( 'Login', 'astra-addon' ) ) . "'>";
											echo "<a href='$lost_password_url' class='ast-customer-login-lost-password-url'>" . esc_html( __( 'Lost your password?', 'astra-addon' ) ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									?>
										</div>
									<?php
									if ( 'yes' === get_option( 'woocommerce_enable_guest_checkout', false ) ) {
										echo "<p class='ast-login-section-message'>" . esc_html( __( 'Login is optional, you can continue with your order below.', 'astra-addon' ) ) . '</p>';
									}
									?>
										</div>
									</div>
							<?php } ?>
							<?php
							if ( 'yes' === get_option( 'woocommerce_enable_signup_and_login_from_checkout' ) ) {
								?>
									<div class="ast-create-account-section" hidden>
									<?php if ( 'yes' === get_option( 'woocommerce_enable_guest_checkout' ) ) { ?>
											<p class="form-row form-row-wide create-account">
												<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
													<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'astra-addon' ); ?></span>
												</label>
											</p>
										<?php } ?>
										<div class="create-account">
										<?php

										if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) {
											woocommerce_form_field(
												'account_username',
												array(
													'type' => 'text',
													'class' => array( 'form-row-fill' ),
													'id'   => 'account_username',
													'required' => true,
													'label' => __( 'Account username', 'astra-addon' ),
													'placeholder' => __( 'Account username', 'astra-addon' ),
												)
											);
										}
										if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) {
											woocommerce_form_field(
												'account_password',
												array(
													'type' => 'password',
													'id'   => 'account_password',
													'class' => array( 'form-row-fill' ),
													'required' => true,
													'label' => __( 'Create account password', 'astra-addon' ),
													'placeholder' => __( 'Create account password', 'astra-addon' ),
												)
											);
										}
										?>
										</div>
									</div>
							<?php } ?>
						<?php } else { ?>
									<div class="ast-logged-in-customer-info"> <?php /* translators: %1$s: username, %2$s emailid */ echo apply_filters( 'astra_addon_logged_in_customer_info_text', sprintf( __( ' Welcome Back %1$s (%2$s)', 'astra-addon' ), esc_attr( $current_user_name ), esc_attr( $current_user_email ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										<div><input type="hidden" class="ast-email-address" id="billing_email" name="billing_email" value="<?php echo esc_attr( $current_user_email ); ?>"/></div>
									</div>
						<?php } ?>
						</div>
					</div>
				</div>
			<?php
		}

		/**
		 * Checkout Place Order Button.
		 *
		 * @param string $button_text Place order text.
		 * @since 3.9.0
		 * @return string
		 */
		public function checkout_place_order_button_text( $button_text ) {

			if ( ! defined( 'CARTFLOWS_VER' ) && is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) ) {
				global $woocommerce;
				$cart_total_with_symbol = '';

				if ( isset( $woocommerce->cart->total ) && astra_get_option( 'checkout-modern-checkout-button-price' ) ) {
					$cart_total             = $woocommerce->cart->total;
					$cart_total_with_symbol = ' ' . get_woocommerce_currency_symbol() . $cart_total;
				}

				$is_custom_text = astra_get_option( 'checkout-place-order-text' );

				if ( $is_custom_text && ! empty( $is_custom_text ) ) {
					$button_text = $is_custom_text;
				}

				$button_text = $button_text . $cart_total_with_symbol;
			}

			return $button_text;
		}


		/**
		 * Display Payment heading field after coupon code fields.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function display_custom_payment_heading() {

			ob_start();
			?>
			<div class="ast-payment-option-heading">
				<h3 id="ast-payment_options_heading"><?php esc_html_e( 'Payment', 'astra-addon' ); ?></h3>
			</div>
			<?php
			echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Add or remove cart product image.
		 *
		 * @param string $product_name product name.
		 * @param object $cart_item cart item.
		 * @param string $cart_item_key cart item key.
		 * @return string HTML markup.
		 */
		public function add_cart_product_image( $product_name, $cart_item, $cart_item_key ) {
			$image              = '';
			$is_thumbnail_class = 'ast-disable-image';
			if ( ! defined( 'CARTFLOWS_VER' ) && is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) && astra_get_option( 'checkout-order-review-product-images', false ) ) {

					// Get product object.
					$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

					// Get product thumbnail.
					$thumbnail = $_product->get_image();

					$is_thumbnail_class = isset( $thumbnail ) ? 'ast-enable-image' : 'ast-disable-image';

					// Add wrapper to image and add some css.
					$image = '<div class="ast-product-thumbnail">' . $thumbnail . ' </div>';
			}
			$product_name = '<div class="ast-product-image ' . $is_thumbnail_class . '"> ' . $image . ' <div class="ast-product-name">' . $product_name . '</div></div>';

			return $product_name;
		}

		/**
		 * Single Product Select to Button Markup.
		 *
		 * @param string $html old select html populated by WooCommerce.
		 * @param array  $args variation arguments.
		 * @return void
		 * @since 3.9.0
		 */
		public function single_product_variations_custom_html( $html, $args ) {
			echo $html;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
				<div class="ast-variation-button-group">
				<?php
				if ( isset( $args['options'] ) ) {
					foreach ( $args['options'] as $slug ) {
						$term = get_term_by( 'slug', $slug, $args['attribute'] );
						$name = ! empty( $term->name ) ? $term->name : $slug;
						?>
						<div class="ast-single-variation" data-slug="<?php echo esc_attr( $slug ); ?>" >
						<?php echo esc_attr( $name ); ?>
						</div>
						<?php
					}
				}
				?>
				</div>
			<?php
		}


		/**
		 * Add custom class to the fields to change the UI to three column.
		 *
		 * @param array $fields fields.
		 * @since 3.9.0
		 * @return array
		 */
		public function checkout_column_layout_fields( $fields ) {

			if ( empty( $fields['billing']['billing_address_2'] ) ) {

				if ( isset( $fields['billing']['billing_address_1'] ) && is_array( $fields['billing']['billing_address_1'] ) ) {
					$fields['billing']['billing_address_1']['class'][] = 'form-row-full';
				}
			}

			if ( ! empty( $fields['billing']['billing_company'] ) ) {

				if ( isset( $fields['billing']['billing_company'] ) && is_array( $fields['billing']['billing_company'] ) ) {
					$fields['billing']['billing_company']['class'][] = 'form-row-full';
				}
			}

			if ( ! empty( $fields['shipping']['shipping_company'] ) ) {

				if ( isset( $fields['shipping']['shipping_company'] ) && is_array( $fields['shipping']['shipping_company'] ) ) {
					$fields['shipping']['shipping_company']['class'][] = 'form-row-full';
				}
			}

			if ( ! empty( $fields['billing']['billing_country'] ) ) {

				if ( isset( $fields['billing']['billing_country'] ) && is_array( $fields['billing']['billing_country'] ) ) {
					$fields['billing']['billing_country']['class'][] = 'form-row-full';
				}
			}

			if ( ! empty( $fields['shipping']['shipping_country'] ) ) {

				if ( isset( $fields['shipping']['shipping_country'] ) && is_array( $fields['shipping']['shipping_country'] ) ) {
					$fields['shipping']['shipping_country']['class'][] = 'form-row-full';
				}
			}

			if ( ! empty( $fields['billing']['billing_phone'] ) ) {

				if ( isset( $fields['billing']['billing_phone'] ) && is_array( $fields['billing']['billing_phone'] ) ) {
					$fields['billing']['billing_phone']['class'][] = 'form-row-full';
				}
			}

			if ( ! empty( $fields['billing']['billing_email'] ) ) {

				if ( isset( $fields['billing']['billing_email'] ) && is_array( $fields['billing']['billing_email'] ) ) {
					$fields['billing']['billing_email']['class'][] = 'form-row-full';
				}
			}

			if ( empty( $fields['shipping']['shipping_address_2'] ) ) {

				if ( isset( $fields['shipping']['shipping_address_1'] ) && is_array( $fields['shipping']['shipping_address_1'] ) ) {
					$fields['shipping']['shipping_address_1']['class'][] = 'form-row-full';
				}
			}

			/* Billing address classes for 50% width */
			if (
				isset( $fields['billing']['billing_address_1'] ) &&
				isset( $fields['billing']['billing_address_2'] )
			) {
				$fields['billing']['billing_address_1']['class'][] = 'ast-column-50';
				$fields['billing']['billing_address_2']['class'][] = 'ast-column-50';

				if ( isset( $fields['billing']['billing_address_2']['label_class'] ) ) {
					if ( ! astra_get_option( 'checkout-labels-as-placeholders' ) ) {
						$fields['billing']['billing_address_2']['label_class'] = array_diff( $fields['billing']['billing_address_2']['label_class'], array( 'screen-reader-text' ) );
					}
				}
			}

			/* Shipping address classes for 50% width */
			if (
				isset( $fields['shipping']['shipping_address_1'] ) &&
				isset( $fields['shipping']['shipping_address_2'] )
			) {
				$fields['shipping']['shipping_address_1']['class'][] = 'ast-column-50';
				$fields['shipping']['shipping_address_2']['class'][] = 'ast-column-50';

				if ( isset( $fields['shipping']['shipping_address_2']['label_class'] ) ) {
					if ( ! astra_get_option( 'checkout-labels-as-placeholders' ) ) {
						$fields['shipping']['shipping_address_2']['label_class'] = array_diff( $fields['shipping']['shipping_address_2']['label_class'], array( 'screen-reader-text' ) );
					}
				}
			}

			/* Billing address classes for 33% width */
			if (
				isset( $fields['billing']['billing_city'] ) &&
				isset( $fields['billing']['billing_state'] ) && isset( $fields['billing']['billing_postcode'] )
			) {

				$fields['billing']['billing_city']['class'][]     = 'ast-column-33';
				$fields['billing']['billing_state']['class'][]    = 'ast-column-33';
				$fields['billing']['billing_postcode']['class'][] = 'ast-column-33';
			}

			/* Billing address classes for 33% width */
			if (
				isset( $fields['shipping']['shipping_city'] ) &&
				isset( $fields['shipping']['shipping_state'] ) && isset( $fields['shipping']['shipping_postcode'] )
			) {

				$fields['shipping']['shipping_city']['class'][]     = 'ast-column-33';
				$fields['shipping']['shipping_state']['class'][]    = 'ast-column-33';
				$fields['shipping']['shipping_postcode']['class'][] = 'ast-column-33';
			}

			return $fields;
		}


		/**
		 * Change order comments placeholder and label, and set billing phone number to not required.
		 *
		 * @param array $fields checkout fields.
		 * @since 3.9.0
		 * @return array
		 */
		public function label_fields_customization( $fields ) {

			if ( is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === astra_get_option( 'woo-input-style-type' ) ) {

				$field_types = array(
					'billing',
					'shipping',
					'account',
					'order',
				);

				foreach ( $field_types as $type ) {

					if ( isset( $fields[ $type ] ) && is_array( $fields[ $type ] ) ) {

						foreach ( $fields[ $type ] as $key => $field ) {
							// Add label as placeholder if the placeholder value is empty.
							if ( empty( $fields[ $type ][ $key ]['placeholder'] ) ) {
								$fields[ $type ][ $key ]['placeholder'] = $fields[ $type ][ $key ]['label'];
							}

							// Remove screen-reader-text class from labels.
							if ( isset( $fields[ $type ][ $key ]['label_class'] ) ) {
								$fields[ $type ][ $key ]['label_class'] = array_diff( $fields[ $type ][ $key ]['label_class'], array( 'screen-reader-text' ) );
							}
						}
					}
				}
			}

			return $fields;
		}

		/**
		 * Woocommerce cart item add class checkout.
		 *
		 * @param string $class classes.
		 * @param array  $cart_item cart item.
		 * @param string $cart_item_key cart item key.
		 * @since 3.9.0
		 * @return string
		 */
		public function additional_class_to_cart_item_classes( $class, $cart_item, $cart_item_key ) {

			if ( ! defined( 'CARTFLOWS_VER' ) && is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === astra_get_option( 'checkout-layout-type' ) && ! empty( $cart_item['variation_id'] ) ) {
				$class .= ' ast-variable-product';
			}

			return $class;
		}

		/**
		 * Woocommerce order review start.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function woocommerce_order_review_start() {
			echo '<div id="ast-order-review-wrapper">';
		}

		/**
		 * Woocommerce order review end.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function woocommerce_order_review_end() {
			echo '</div>';
		}

		/**
		 * Modern cart Layout.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function modern_cart() {
			if ( ! astra_get_option( 'cart-modern-layout' ) ) {
				return;
			}
			add_action( 'woocommerce_before_cart', array( $this, 'woocommerce_cart_wrapper_start' ) );

			if ( astra_get_option( 'enable-cart-upsells' ) ) {
				remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
				add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cross_sell_display' );
			}

			add_action( 'woocommerce_before_cart_collaterals', array( $this, 'woocommerce_cart_non_sticky_end' ) );
			add_action( 'woocommerce_after_cart', array( $this, 'woocommerce_cart_wrapper_end' ) );
			add_action( 'woocommerce_proceed_to_checkout', array( $this, 'woocommerce_modern_coupon_cart' ) );
		}

		/**
		 * Cart wrapper non sticky end.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function woocommerce_cart_non_sticky_end() {
			echo '</div>';
		}

		/**
		 * Cart wrapper start.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function woocommerce_cart_wrapper_start() {
			echo '<div id="ast-cart-wrapper"><div class="ast-cart-non-sticky">';

		}

		/**
		 * Cart wrapper end.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function woocommerce_cart_wrapper_end() {
			echo '</div>';
		}

		/**
		 * Modern cart coupon markup.
		 *
		 * @since 3.9.0
		 */
		public function woocommerce_modern_coupon_cart() {

			if ( wc_coupons_enabled() ) {
				?>
			<div id="ast-checkout-coupon">
				<p id="ast-coupon-trigger"><?php esc_attr_e( 'Have a coupon?', 'astra-addon' ); ?></p>
				<div class="coupon">
					<input type="text" name="ast-coupon-code" id="ast-coupon-code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'astra-addon' ); ?>" />
					<a class="button" id="ast-apply-coupon" name="ast-apply-coupon" value="<?php esc_attr_e( 'Apply', 'astra-addon' ); ?>">
							<?php esc_attr_e( 'Apply', 'astra-addon' ); ?>
					</a>
				</div>
			</div>
				<?php
			}
		}

		/**
		 * Add second step opening dev
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function add_two_step_second_step_wrapper() {
			echo "<div class='ast-two-step-wrap'> ";
		}

		/**
		 * Add second step opening dev
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function add_two_step_second_step_order_wrapper() {
			echo "<div class='ast-order-wrap'> ";
		}

		/**
		 * Add first step opening dev
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function add_two_step_first_step_wrapper() {
			echo '<div class="ast-checkout-fields-wrapper">';
		}

		/**
		 * Add Startng & closing dev
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function add_two_step_closing_div() {
			echo '</div> ';
		}

		/**
		 * Display Two Step Nav Menu.
		 *
		 * @param string $layout_style layout style.
		 * @since 3.9.0
		 * @return void
		 */
		public function add_two_step_nav_menu( $layout_style ) {

				// Get the values form the applied settings.
				// Get step titles.
				$step_one_title     = astra_get_option( 'two-step-checkout-modern-step-1-text' );
				$step_one_sub_title = astra_get_option( 'two-step-checkout-modern-step-1-sub-text' );
				$step_two_title     = astra_get_option( 'two-step-checkout-modern-step-2-text' );
				$step_two_sub_title = astra_get_option( 'two-step-checkout-modern-step-2-sub-text' );

				$two_step_section_border = 'none';

				$two_step_html = '';

					$two_step_html .= "<div class='ast-embed-checkout-form-nav ast-border-" . esc_attr( $two_step_section_border ) . " '>";

					$two_step_html             .= "<ul class='ast-embed-checkout-form-steps'>";
						$two_step_html         .= "<div class='steps step-one ast-current'>";
							$two_step_html     .= "<a href='#customer_details'>";
								$two_step_html .= "<div class='step-number'>1</div>";

								$two_step_html .= "<div class='step-heading'>";

									$two_step_html .= "<div class='step-name'>" . esc_html( $step_one_title ) . '</div>';
									$two_step_html .= "<div class='step-sub-name'>" . esc_html( $step_one_sub_title ) . '</div>';

								$two_step_html .= '</div>';

							$two_step_html .= '</a>';
						$two_step_html     .= '</div>';

						$two_step_html         .= "<div class='steps step-two'>";
							$two_step_html     .= "<a href='#ast-order-wrap'>";
								$two_step_html .= "<div class='step-number'>2</div>";

									$two_step_html .= "<div class='step-heading'>";

										$two_step_html .= "<div class='step-name'>" . esc_html( $step_two_title ) . '</div>';
										$two_step_html .= "<div class='step-sub-name'>" . esc_html( $step_two_sub_title ) . '</div>';

									$two_step_html .= '</div>';

							$two_step_html .= '</a>';
						$two_step_html     .= '</div>';

					$two_step_html .= '</ul>';
				$two_step_html     .= '</div>';

				echo $two_step_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Display Two Step note box.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function get_checkout_form_note() {

			if ( astra_get_option( 'two-step-checkout-modern-note' ) ) {

				$checkout_note = astra_get_option( 'two-step-checkout-modern-note-text' );

				$two_step_note = '';

				$two_step_note .= "<div class='ast-embed-checkout-form-note'>";

				$two_step_note .= '<p>' . wp_kses_post( $checkout_note ) . '</p>';

				$two_step_note .= '</div>';

				echo $two_step_note; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		/**
		 * Display Two Step Nav Next Button.
		 *
		 * @since 3.9.0
		 * @return void
		 */
		public function add_two_step_next_btn() {

			$button_title     = astra_get_option( 'two-step-checkout-modern-button-text' );
			$button_sub_title = astra_get_option( 'two-step-checkout-modern-button-sub-text' );

			$two_step_next_btn_html = '';

			$two_step_next_btn_html .= '<div class="ast-embed-checkout-form-nav-btns">';

				$two_step_next_btn_html     .= '<a href="#ast-order-wrap" class="button ast-next-button" >';
					$two_step_next_btn_html .= '<span class="ast-next-button-content">';

			if ( '' != $button_title ) {
						$two_step_next_btn_html     .= '<span class="ast-next-button-icon-wrap">';
							$two_step_next_btn_html .= '<span class="dashicons dashicons-arrow-right-alt"></span>';
							$two_step_next_btn_html .= '<span class="ast-button-text">' . esc_html( $button_title ) . '</span>';
						$two_step_next_btn_html     .= '</span>';
			}

			if ( '' != $button_sub_title ) {
						$two_step_next_btn_html .= '<span class="ast-button-sub-text">' . esc_html( $button_sub_title ) . '</span>';
			}
					$two_step_next_btn_html .= '</span>';
				$two_step_next_btn_html     .= '</a>';

			$two_step_next_btn_html .= '</div>';

			echo $two_step_next_btn_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}


		/**
		 * Render the checkout step one title for the selective refresh partial.
		 *
		 * @since 3.9.0
		 * @return string
		 */
		public function render_checkout_step_one_title() {
			return astra_get_option( 'two-step-checkout-modern-step-1-text' );
		}

		/**
		 * Render the checkout step one sub title for the selective refresh partial.
		 *
		 * @since 3.9.0
		 * @return string
		 */
		public function render_checkout_step_one_sub_title() {
			return astra_get_option( 'two-step-checkout-modern-step-1-sub-text' );
		}

		/**
		 * Render the checkout step two title for the selective refresh partial.
		 *
		 * @since 3.9.0
		 * @return string
		 */
		public function render_checkout_step_two_title() {
			return astra_get_option( 'two-step-checkout-modern-step-2-text' );
		}

		/**
		 * Render the checkout step two sub title for the selective refresh partial.
		 *
		 * @since 3.9.0
		 * @return string
		 */
		public function render_checkout_step_two_sub_title() {
			return astra_get_option( 'two-step-checkout-modern-step-2-sub-text' );
		}

		/**
		 * Render the checkout step two button text for the selective refresh partial.
		 *
		 * @since 3.9.0
		 * @return string
		 */
		public function render_checkout_step_two_button_text() {
			return astra_get_option( 'two-step-checkout-modern-button-text' );
		}

		/**
		 * Render the checkout step two button sub text for the selective refresh partial.
		 *
		 * @since 3.9.0
		 * @return string
		 */
		public function render_checkout_step_two_button_sub_text() {
			return astra_get_option( 'two-step-checkout-modern-button-sub-text' );
		}

		/**
		 * Render the checkout place order text for the selective refresh partial.
		 *
		 * @since 3.9.0
		 * @return string
		 */
		public function render_checkout_place_order_text() {

			global $woocommerce;
			$cart_total_with_symbol = '';

			if ( isset( $woocommerce->cart->total ) && astra_get_option( 'checkout-modern-checkout-button-price' ) ) {
				$cart_total             = $woocommerce->cart->total;
				$cart_total_with_symbol = ' ' . get_woocommerce_currency_symbol() . $cart_total;
			}

			return astra_get_option( 'checkout-place-order-text' ) . $cart_total_with_symbol;
		}

		/**
		 * Render the checkout two step form note for the selective refresh partial.
		 *
		 * @since 3.9.0
		 * @return string
		 */
		public function render_checkout_two_step_form_note() {
			return astra_get_option( 'two-step-checkout-modern-note-text' );
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
ASTRA_Ext_WooCommerce_Markup::get_instance();
