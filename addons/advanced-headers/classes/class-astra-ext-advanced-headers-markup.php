<?php
/**
 * Advanced Headers Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Advanced_Headers_Markup' ) ) {

	/**
	 * Advanced Headers Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Advanced_Headers_Markup {
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
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
		 *  Constructor
		 */
		public function __construct() {
			add_filter( 'body_class', array( $this, 'body_classes' ), 10, 1 );
			add_filter( 'get_the_archive_title', array( $this, 'archive_title' ) );

			/* Fixed site logo markup */
			add_action( 'astra_header', array( $this, 'page_header_logo' ), 1 );

			// Remove single Page/Post featured image.
			add_filter( 'astra_featured_image_enabled', array( $this, 'remove_post_thumbnail' ), 10 );

			// Advanced Header with Merge header action.
			add_action( 'astra_header_before', array( $this, 'advanced_header_merged' ) );
			// Advanced Headers action.
			add_action( 'astra_header_after', array( $this, 'load_markup' ), 0 );
			add_filter( 'wp_nav_menu_args', array( $this, 'custom_primary_menu' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ), 9 );

			/**
			 * Metabox setup
			 */
			add_filter( 'astra_meta_box_options', array( $this, 'add_options' ) );
			add_action( 'astra_meta_box_markup_after', array( $this, 'add_options_markup' ) );

			add_filter( 'astra_get_option_header-main-rt-section', array( $this, 'header_custom_menu_item' ) );
			add_filter( 'astra_get_option_header-display-outside-menu', array( $this, 'header_display_outside_menu' ) );
			add_filter( 'astra_get_option_header-main-rt-section-html', array( $this, 'header_custom_menu_text' ) );
			add_filter( 'astra_search_style_header_main_rt_section', array( $this, 'default_search_type' ) );
			add_filter( 'astra_breadcrumb_enabled', array( $this, 'disable_breadcrumb_page_header' ) );
		}

		/**
		 * Disable breadcrumb if Page Header already has Breadcrumb enabled.
		 *
		 * @param boolean $status checks ruleset value.
		 * @return boolean
		 */
		public function disable_breadcrumb_page_header( $status ) {
			$show_breadcrumb = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'breadcrumb' );
			if ( $show_breadcrumb ) {
				$status = false;
			}
			return $status;
		}

		/**
		 * Advanced Header Search Style
		 *
		 * @param  string $default Search style.
		 * @return string
		 */
		public function default_search_type( $default ) {

			$search_style = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'search-style' );

			if ( ! empty( $search_style ) && 'default' !== $search_style ) {
				return $search_style;
			}

			return $default;
		}

		/**
		 * Advanced Header Custom Menu Text/HTML
		 *
		 * @param  html $value Custom menu text/html.
		 * @return html
		 */
		public function header_custom_menu_text( $value ) {

			$custom_menu_item = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'custom-menu-item' );
			if ( ! ( self::advanced_header_enabled() ) || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) || 'default' == $custom_menu_item || '' == $custom_menu_item ) {
				return $value;
			}

			$custom_html         = '';
			$custom_html_content = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'custom-menu-item-text-html' );

			if ( ! empty( $custom_html_content ) ) {
				$custom_html = do_shortcode( $custom_html_content );
			} elseif ( current_user_can( 'edit_theme_options' ) ) {
				$id              = Astra_Ext_Advanced_Headers_Data::get_current_page_header_ids();
				$page_header_url = get_edit_post_link( $id );
				$custom_html     = '<a href="' . esc_url( $page_header_url ) . '">' . __( 'Add Custom HTML', 'astra-addon' ) . '</a>';
			}
			return html_entity_decode( $custom_html, ENT_COMPAT, 'UTF-8' );
		}

		/**
		 * Advanced Header Custom Menu Outside/Inside
		 *
		 * @param  string|boolean $value display menu outside or not.
		 * @return string|boolean
		 */
		public function header_display_outside_menu( $value ) {

			$custom_menu_item = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'custom-menu-item' );
			if ( ! ( self::advanced_header_enabled() ) || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) || 'default' == $custom_menu_item || '' == $custom_menu_item ) {
				return $value;
			}

			$display_outside = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'custom-menu-item-outside' );
			return $display_outside;
		}

		/**
		 * Advanced Header Custom Menu Item
		 *
		 * @param  string $value Custom Menu Item.
		 * @return string
		 */
		public function header_custom_menu_item( $value ) {

			$custom_menu_item = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'custom-menu-item' );
			if ( ! ( self::advanced_header_enabled() ) || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) || 'default' == $custom_menu_item || '' == $custom_menu_item ) {
				return $value;
			}

			return $custom_menu_item;
		}

		/**
		 * Remove Post Featured Image If advanced headers is enable with featured image as background image
		 *
		 * @param  boolean $is_featured Markup of featured image.
		 * @return boolean $is_featured
		 */
		public function remove_post_thumbnail( $is_featured ) {

			if ( self::advanced_header_enabled() ) {

				if ( ! ( is_archive() || is_home() || is_search() || is_404() || wp_doing_ajax() ) ) {

					$page_post_featured      = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'page-post-featured' );
					$advanced_headers_layout = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'layout' );

					// If selected Post / Page Featured image.
					if ( 'disable' != $advanced_headers_layout && 'enabled' == $page_post_featured ) {
						$is_featured = false;
					}
				}
			}

			return $is_featured;

		}

		/**
		 * Add cutom Logo for Advanced Headers
		 *
		 * @param string $html    Markup of custom logo.
		 * @param string $blog_id blog id.
		 * @return strung $html   updated Markup of Custom Logo.
		 */
		public function add_custom_logo( $html, $blog_id ) {

			$advanced_headers_merged       = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'merged' );
			$advanced_headers_inherit_logo = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'diff-header-logo' );

			if ( ! $advanced_headers_merged || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) || 'enabled' != $advanced_headers_inherit_logo ) {
				return $html;
			}

			$custom_logo_id = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'logo-id' );

			// Site logo.
			if ( $custom_logo_id ) {

				add_filter( 'astra_main_header_retina', '__return_false' );

				add_filter( 'wp_get_attachment_image_attributes', array( $this, 'adv_replace_header_logo_attr' ), 10, 3 );

				// Custom Site logo.
				$html = sprintf(
					'<a href="%1$s" class="custom-logo-link advanced-header-logo" rel="home" %3$s >%2$s</a>',
					esc_url( home_url( '/' ) ),
					wp_get_attachment_image(
						$custom_logo_id,
						'ast-adv-header-logo-size',
						false,
						array(
							'class' => 'custom-logo',
						)
					),
					astra_attr(
						'site-title-custom-link',
						array(
							'class' => '',
						)
					)
				);

				remove_filter( 'wp_get_attachment_image_attributes', array( $this, 'adv_replace_header_logo_attr' ) );
			}

			return $html;
		}

		/**
		 * Replace header logo.
		 *
		 * @param array  $attr Image.
		 * @param object $attachment Image obj.
		 * @param sting  $size Size name.
		 *
		 * @return array Image attr.
		 */
		public function adv_replace_header_logo_attr( $attr, $attachment, $size ) {

			$custom_logo_id = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'logo-id' );

			if ( $custom_logo_id == $attachment->ID ) {

				$attach_data = array();
				$attach_data = wp_get_attachment_image_src( $attachment->ID, 'ast-adv-header-logo-size' );
				if ( isset( $attach_data[0] ) ) {
					$attr['src'] = $attach_data[0];
				}

				$file_type      = wp_check_filetype( $attr['src'] );
				$file_extension = $file_type['ext'];

				if ( 'svg' == $file_extension ) {
					$attr['width']  = '100%';
					$attr['height'] = '100%';
					$attr['class']  = 'astra-logo-svg';
				}

				$diff_retina_logo = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'diff-header-retina-logo' );

				if ( 'enabled' === $diff_retina_logo ) {

					$custom_logo = $attr['src'];
					$retina_logo = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'retina-logo-url' );

					$attr['srcset'] = '';

					if ( '' !== $retina_logo ) {

						if ( astra_check_is_ie() ) {
							// Replace header logo url to retina logo url.
							$attr['src'] = $retina_logo;
						}

						$attr['srcset'] = $custom_logo . ' 1x, ' . $retina_logo . ' 2x';
					}
				}
			}

			return $attr;
		}
		/**
		 * Remove Prefix : from Archive title
		 *
		 * @param  string $title Default title.
		 * @return string $title updated title.
		 */
		public function archive_title( $title ) {

			if ( is_category() ) {
				$title = single_cat_title( '', false );
			} elseif ( is_tag() ) {
				$title = single_tag_title( '', false );
			} elseif ( is_author() ) {
				$title = '<span class="vcard">' . get_the_author() . '</span>';
			} elseif ( is_tax() ) {
				$title = single_term_title( '', false );
			}

			return $title;
		}

		/**
		 * Add Body Classes
		 *
		 * @param  array $classes Body Class Array.
		 * @return array
		 */
		public function body_classes( $classes ) {

			$advanced_headers_layout = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'layout' );
			$transparent_header      = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'merged' );

			$custom_logo_id = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'logo-id' );

			// Site logo.
			if ( $custom_logo_id && $transparent_header ) {
				$classes[] = 'ast-advanced-headers-different-logo';
			}

			if ( $advanced_headers_layout ) {
				$classes[] = 'ast-advanced-headers';
			}

			if ( 'enabled' == $transparent_header && 'disable' == $advanced_headers_layout ) {
				// Add class.
				$classes[] = 'ast-transparent-header';

			}

			return $classes;
		}


		/**
		 * Advanced Headers Bar markup loader if we are using merged with header
		 *
		 * @since 1.0.0
		 */
		public function advanced_header_merged() {

			// Get our options.
			$advanced_headers_merged         = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'merged' );
			$advanced_header_bg_size         = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'bg-size' );
			$advanced_header_parallax_device = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'parallax-device' );

			if ( ! self::advanced_header_enabled() || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) ) {
				return;
			}
			if ( ! $advanced_headers_merged ) {
				return;
			}

			$combined = 'ast-merged-advanced-header ast-title-bar-wrap';

			// Parallax variable.
			$parallax = ( 'none' !== $advanced_header_parallax_device ) ? ' ast-advanced-headers-parallax' : '';
			// Parallax Device.
			$parallax_device = ( 'none' !== $advanced_header_parallax_device ) ? $advanced_header_parallax_device : '';
			// Parallax speed variable.
			$parallax_speed = apply_filters( 'astra_advanced_header_parallax_speed', 2 );
			// Full Screen vertical align center.
			$vertical_center = ' ast-advanced-headers-vertical-center';
			// Full Screen.
			$full_screen = ( 'full-screen' == $advanced_header_bg_size ) ? ' ast-full-advanced-header' : '';
			// Add advanced header wrapper classes.
			printf(
				'<div class="%1$s" %2$s role="img" %3$s>',
				$combined . $parallax . $full_screen . $vertical_center,
				( ! empty( $parallax ) ) ? 'data-parallax-speed="' . esc_attr( $parallax_speed ) . '" data-parallax-device="' . esc_attr( $parallax_device ) . '"' : '',
				'aria-label="' . esc_attr( $this->get_header_background_image_alt_text() ) . '"'
			);
		}


		/**
		 * Advanced Headers markup loader
		 *
		 * Loads appropriate template file based on the style option selected in options panel.
		 *
		 * @since 1.0.0
		 */
		public function load_markup() {

			// Get our options.
			$advanced_headers_layout         = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'layout' );
			$advanced_headers_merged         = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'merged' );
			$advanced_header_bg_size         = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'bg-size' );
			$advanced_header_parallax_device = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'parallax-device' );

			if ( ! self::advanced_header_enabled() || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) ) {
				return;
			}

			if ( ! $advanced_headers_merged ) {
				$combined = 'ast-title-bar-wrap';

				// Parallax variable.
				$parallax = ( 'none' !== $advanced_header_parallax_device ) ? '  ast-advanced-headers-parallax' : '';
				// Parallax Device.
				$parallax_device = ( 'none' !== $advanced_header_parallax_device ) ? $advanced_header_parallax_device : '';
				// Parallax speed variable.
				$parallax_speed = apply_filters( 'astra_advanced_header_parallax_speed', 2 );
				// Full Screen vertical align center.
				$vertical_center = ' ast-advanced-headers-vertical-center';
				// Full Screen.
				$full_screen = ( 'full-screen' == $advanced_header_bg_size ) ? ' ast-full-advanced-header' : '';

				// Add advanced header wrapper classes.
				printf(
					'<div class="%1$s" %2$s role="img" %3$s>',
					$combined . $parallax . $full_screen . $vertical_center,
					( ! empty( $parallax ) ) ? 'data-parallax-speed="' . esc_attr( $parallax_speed ) . '" data-parallax-device="' . esc_attr( $parallax_device ) . '"' : '',
					'aria-label="' . esc_attr( $this->get_header_background_image_alt_text() ) . '"'
				);
			}

			if ( $advanced_headers_layout && 'disable' !== $advanced_headers_layout ) {
				// Add markup.
				astra_addon_get_template( 'advanced-headers/template/' . $advanced_headers_layout . '.php' );
			}

			echo '</div>';

			// Page Header with no content is selected.
			if ( $advanced_headers_layout && 'disable' !== $advanced_headers_layout ) {
				add_filter( 'astra_the_title_enabled', '__return_false' );
			}
		}

		/**
		 * Custom Primary Menu
		 *
		 * If custom primary menu is selected.
		 *
		 * @param  array $args menu arguments.
		 * @return  array $args menu arguments.
		 */
		public function custom_primary_menu( $args ) {
			$transparent_header = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'merged' );

			if ( ! ( self::advanced_header_enabled() || $transparent_header ) || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) ) {
				return $args;
			}
			$custom_menu = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'custom-menu' );
			if ( ( '' != $custom_menu || 0 != $custom_menu ) && 'primary' == $args['theme_location'] ) {
				$args['menu'] = $custom_menu;
			}
			return $args;
		}


		/**
		 * Next Breadcrumbs
		 *
		 * If yoast SEO breadcrumbs are active loads their function else loads custom breadcrumbs.
		 *
		 * @since 1.0.0
		 */
		public static function advanced_headers_breadcrumbs_markup() {

			$show_breadcrumb = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'breadcrumb' );
			if ( ! $show_breadcrumb ) {
				return;
			}

			$id                     = Astra_Ext_Advanced_Headers_Data::get_current_page_header_ids();
			$breadcrumb_old_version = get_post_meta( $id, 'astra-breadcrumb-old', true );

			if ( true === apply_filters( 'astra_addon_advanced_headers_use_astra_breadcrumb_trail', false ) || 'true' !== $breadcrumb_old_version ) {
				astra_get_breadcrumb();
			} else {
				$wpseo_option = get_option( 'wpseo_internallinks' );

				if ( function_exists( 'yoast_breadcrumb' ) && $wpseo_option && true === $wpseo_option['breadcrumbs-enable'] ) {
					yoast_breadcrumb( '<div id="breadcrumbs" >', '</div>' );
				} else {
					astra_breadcrumb();
				}
			}
		}

		/**
		 * Add Styles
		 */
		public function add_scripts() {

			$advanced_headers_layout = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'layout' );

			if ( ! self::advanced_header_enabled() || 'disable' == $advanced_headers_layout || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) ) {
				return;
			}

			if ( SCRIPT_DEBUG ) {

				wp_enqueue_style( 'astra-advanced-headers-css', ASTRA_ADDON_EXT_ADVANCED_HEADERS_URL . 'assets/css/unminified/style.css', array(), ASTRA_EXT_VER );

				wp_enqueue_style( 'astra-advanced-headers-layout-css', ASTRA_ADDON_EXT_ADVANCED_HEADERS_URL . 'assets/css/unminified/' . $advanced_headers_layout . '.css', array(), ASTRA_EXT_VER );

				wp_enqueue_script( 'astra-advanced-headers-js', ASTRA_ADDON_EXT_ADVANCED_HEADERS_URL . 'assets/js/unminified/advanced-headers.js', array( 'jquery' ), ASTRA_EXT_VER, false );
			} else {
				wp_enqueue_style( 'astra-advanced-headers-css', ASTRA_ADDON_EXT_ADVANCED_HEADERS_URL . 'assets/css/minified/style.min.css', array(), ASTRA_EXT_VER );
				wp_enqueue_style( 'astra-advanced-headers-layout-css', ASTRA_ADDON_EXT_ADVANCED_HEADERS_URL . 'assets/css/minified/' . $advanced_headers_layout . '.min.css', array(), ASTRA_EXT_VER );
				wp_enqueue_script( 'astra-advanced-headers-js', ASTRA_ADDON_EXT_ADVANCED_HEADERS_URL . 'assets/js/minified/advanced-headers.min.js', array( 'jquery' ), ASTRA_EXT_VER, false );

			}
		}


		/**
		 * Check transparent header is enabled or not
		 */
		public static function transparent_header_disabled_archive() {
			$force_transparent_header = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'force-transparent-disabled' );
			if ( ! apply_filters( 'astra_transparent_header_disable', false ) && ! $force_transparent_header ) {
				return true;
			}
			return false;
		}

		/**
		 * Check page header is enabled or not
		 */
		public static function advanced_header_enabled() {

			$ids = Astra_Ext_Advanced_Headers_Data::get_current_page_header_ids();

			if ( false == $ids ) {
				return false;
			}

			return true;
		}

		/**
		 * Add Meta Options
		 *
		 * @param array $meta_option Page Meta.
		 * @return array
		 */
		public function add_options( $meta_option ) {

			$meta_option['adv-header-id-meta'] = array(
				'sanitize' => 'FILTER_SANITIZE_STRING',
				'default'  => astra_get_option_meta( 'adv-header-id-meta' ),
			);

			return $meta_option;
		}

		/**
		 * Sticky Header Meta Field markup
		 *
		 * Loads appropriate template file based on the style option selected in options panel.
		 *
		 * @param array $meta Page Meta.
		 * @since 1.0.0
		 */
		public function add_options_markup( $meta ) {

			/**
			 * Get options
			 */
			$header_id = ( isset( $meta['adv-header-id-meta']['default'] ) ) ? $meta['adv-header-id-meta']['default'] : '';

			$header_options  = Astra_Target_Rules_Fields::get_post_selection( 'astra_adv_header' );
			$show_meta_field = ! astra_check_is_bb_themer_layout();
			if ( empty( $header_options ) ) {
				$header_options = array(
					'' => __( 'No Page Headers Found', 'astra-addon' ),
				);
			}

			?>

			<?php if ( $show_meta_field ) { ?>
				<div class="adv-header-wrapper">
					<p class="post-attributes-label-wrapper">
						<strong> <?php esc_html_e( 'Page Header', 'astra-addon' ); ?> </strong><br/>
					</p>
					<select name="adv-header-id-meta" id="adv-header-id-meta">
						<?php foreach ( $header_options as $key => $value ) { ?>
							<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $header_id, $key ); ?>> <?php echo esc_html( $value ); ?></option>
						<?php } ?>
					</select>
				</div>
				<?php
			}
		}

		/**
		 * Page Header Logo
		 *
		 * @since 1.4.0
		 */
		public function page_header_logo() {

			// Update site Logo for Merge header.
			add_filter( 'astra_has_custom_logo', '__return_true', 10 );
			add_filter( 'get_custom_logo', array( $this, 'add_custom_logo' ), 10, 2 );
		}

		/**
		 * Get Page Header Image Alt Text
		 *
		 * @since 2.2.0
		 * @return string Alt text if provided for the image else post/archive title.
		 */
		public function get_header_background_image_alt_text() {
			$page_post_featured = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'page-post-featured' );
			$bg_image           = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'bg-image' );

			// If advanced header disabled.
			$title_bar_bg_img = '';

			if ( ( is_archive() || is_search() || is_404() || is_home() ) && $bg_image ) {
				$title_bar_bg_img = $bg_image;
			} else {
				// If selected Post / Page Featured image.
				if ( 'enabled' == $page_post_featured ) {

					if ( has_post_thumbnail( get_the_ID() ) ) {
							$src              = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail_size' );
							$title_bar_bg_img = $src[0];
					} else {
						// Custom Background Image.
						if ( $bg_image ) {
							$title_bar_bg_img = $bg_image;
						}
					}
				} else {
					// Custom Background Image.
					if ( $bg_image ) {
						$title_bar_bg_img = $bg_image;
					}
				}
			}

			$img_alt_text = get_post_meta( attachment_url_to_postid( $title_bar_bg_img ), '_wp_attachment_image_alt', true );

			if ( ! empty( $img_alt_text ) ) {
				return esc_attr( $img_alt_text );
			}
			return __return_empty_string();
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Advanced_Headers_Markup::get_instance();
