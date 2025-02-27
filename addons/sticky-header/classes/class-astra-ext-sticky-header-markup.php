<?php
/**
 * Sticky Header Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Sticky_Header_Markup' ) ) {

	/**
	 * Sticky Header Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Sticky_Header_Markup {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
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

			add_action( 'body_class', array( $this, 'add_body_class' ) );

			/* Fixed header markup */
			add_action( 'astra_header', array( $this, 'none_header_markup' ), 5 );
			add_action( 'astra_sticky_header_markup', array( $this, 'fixed_header_markup' ) );
			add_action( 'wp_footer', array( $this, 'render_header_svg_mask' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'astra_addon_get_js_files', array( $this, 'add_scripts' ) );
			add_filter( 'astra_addon_js_localize', array( $this, 'localize_variables' ) );

			/**
			 * Metabox setup
			 */
			add_filter( 'astra_meta_box_options', array( $this, 'add_options' ) );
			add_action( 'astra_meta_box_markup_after', array( $this, 'add_options_markup' ) );

			add_action( 'astra_customizer_save', array( $this, 'customizer_save' ) );
		}

		/**
		 * Add Body Classes
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function add_body_class( $classes ) {

			/**
			 * Add class 'ast-transparent-header' if page / post meta != 'disabled'
			 */
			$main_stick        = astra_get_option( 'header-main-stick' );
			$above_stick       = astra_get_option( 'header-above-stick' );
			$below_stick       = astra_get_option( 'header-below-stick' );
			$shrink_main       = astra_get_option( 'header-main-shrink' );
			$header_logo       = astra_get_option( 'sticky-header-logo' );
			$inherit_desk_logo = astra_get_option( 'different-sticky-logo', false );

			$sticky_header_meta              = astra_get_option_meta( 'stick-header-meta' );
			$sticky_primary_header_meta      = astra_get_option_meta( 'header-main-stick-meta' );
			$astra_main_header_shrink_status = apply_filters( 'astra_main_header_shrink_disable', false );

			if ( ! $astra_main_header_shrink_status && '1' == $main_stick && '1' == $shrink_main ) {
				$classes[] = 'ast-sticky-main-shrink';
			}

			if ( ! $astra_main_header_shrink_status && '1' == $above_stick && '1' == $shrink_main ) {
				$classes[] = 'ast-sticky-above-shrink';
			}

			if ( ! $astra_main_header_shrink_status && '1' == $below_stick && '1' == $shrink_main ) {
				$classes[] = 'ast-sticky-below-shrink';
			}

			if ( Astra_Ext_Extension::is_active( 'sticky-header' ) && $shrink_main ) {
				$classes[] = 'ast-sticky-header-shrink';
			}

			if ( '1' !== $inherit_desk_logo ) {
				$classes[] = 'ast-inherit-site-logo-sticky';
			}

			if ( '1' == $inherit_desk_logo && '1' == $main_stick && '' !== $header_logo ) {
				$classes[] = 'ast-sticky-custom-logo';
			}

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active && '1' == $inherit_desk_logo && '' !== $header_logo ) {
				$classes[] = 'ast-sticky-custom-logo';
			}

			if ( ( '1' == $main_stick || ( 'enabled' == $sticky_header_meta && ( 'on' == $sticky_primary_header_meta || 'disabled' == $sticky_primary_header_meta ) ) ) ) {
				$classes[] = 'ast-primary-sticky-enabled';
			}

			return $classes;
		}

		/**
		 * Site Header - <header>
		 *
		 * @since 1.0.0
		 */
		public function none_header_markup() {

			$main_stick        = astra_get_option( 'header-main-stick' );
			$header_style      = astra_get_option( 'sticky-header-style' );
			$inherit_desk_logo = astra_get_option( 'different-sticky-logo', false );

			$sticky_header_meta         = astra_get_option_meta( 'stick-header-meta' );
			$sticky_primary_header_meta = astra_get_option_meta( 'header-main-stick-meta' );

			if ( '1' == $inherit_desk_logo && ( '1' == $main_stick || ( 'enabled' == $sticky_header_meta && ( 'on' == $sticky_primary_header_meta || 'disabled' == $sticky_primary_header_meta ) ) ) && 'none' == $header_style ) {
				// Logo For None Effect.
				add_filter( 'astra_has_custom_logo', '__return_true' );
				add_filter( 'get_custom_logo', array( $this, 'none_custom_logo' ), 10, 2 );
			}

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active && 'none' == $header_style ) {

				// Logo For None Effect.
				add_filter( 'astra_has_custom_logo', '__return_true' );
				add_filter( 'get_custom_logo', array( $this, 'none_custom_logo' ), 10, 2 );
			}
		}

		/**
		 * Method to return string 'disabled'.
		 *
		 * @return string Returns 'disabled' string literal.
		 * @since 4.6.9
		 */
		public function disabled() {
			return 'disabled';
		}

		/**
		 * Site Header - <header>
		 *
		 * @since 1.0.0
		 */
		public function fixed_header_markup() {

			if ( apply_filters( 'astra_fixed_header_markup_enabled', true ) ) {
				$main_stick = astra_get_option( 'header-main-stick' );

				$above_stick       = astra_get_option( 'header-above-stick' );
				$below_stick       = astra_get_option( 'header-below-stick' );
				$inherit_desk_logo = astra_get_option( 'different-sticky-logo', false );

				$sticky_header_meta         = astra_get_option_meta( 'stick-header-meta' );
				$sticky_primary_header_meta = astra_get_option_meta( 'header-main-stick-meta' );
				$sticky_above_header_meta   = astra_get_option_meta( 'header-above-stick-meta' );
				$sticky_below_header_meta   = astra_get_option_meta( 'header-below-stick-meta' );

				if ( ! (
						( '1' == $main_stick || ( 'enabled' == $sticky_header_meta && ( 'on' == $sticky_primary_header_meta || 'disabled' == $sticky_primary_header_meta ) ) ) ||
						( '1' == $above_stick || ( 'enabled' == $sticky_header_meta && ( 'on' == $sticky_above_header_meta || 'disabled' == $sticky_above_header_meta ) ) ) ||
						( '1' == $below_stick || ( 'enabled' == $sticky_header_meta && ( 'on' == $sticky_below_header_meta || 'disabled' == $sticky_below_header_meta ) ) )
					) ) {
					return;
				}

				$sticky_header_style   = astra_get_option( 'sticky-header-style' );
				$sticky_hide_on_scroll = astra_get_option( 'sticky-hide-on-scroll' );
				if ( 'none' == $sticky_header_style && ! $sticky_hide_on_scroll ) {
					return;
				}

				$header_logo = astra_get_option( 'sticky-header-logo' );

				if ( '1' == $inherit_desk_logo && '' != $header_logo ) {
					add_filter( 'astra_has_custom_logo', '__return_true' );
					add_filter( 'astra_disable_site_identity', '__return_true' );
					add_filter( 'astra_main_header_retina', '__return_false' );
					add_filter( 'astra_replace_logo_width', '__return_false' );
					add_filter( 'get_custom_logo', array( $this, 'sticky_custom_logo' ), 10, 2 );
				}

				add_filter( 'astra_show_site_title_h1_tag', '__return_false' );

				// Filters to make header & component ID unique.
				add_filter( 'astra_header_site_navigation_id', array( $this, 'update_navigation_id' ), 10, 1 );
				add_filter( 'astra_header_menu_ul_id', array( $this, 'update_menu_ul_id' ), 10, 1 );

				// Check if globally enabled or specific post/page enabled.
				$disable_above_markup = ! $above_stick && ! ( 'enabled' == $sticky_header_meta && ( 'on' === $sticky_above_header_meta || 'disabled' === $sticky_above_header_meta ) );
				$disable_main_markup  = ! $main_stick && ! ( 'enabled' == $sticky_header_meta && ( 'on' === $sticky_primary_header_meta || 'disabled' === $sticky_primary_header_meta ) );
				$disable_below_markup = ! $below_stick && ! ( 'enabled' == $sticky_header_meta && ( 'on' === $sticky_below_header_meta || 'disabled' === $sticky_below_header_meta ) );

				?>
				<header id="ast-fixed-header" <?php astra_header_classes(); ?> style="visibility: hidden;" data-type="fixed-header">

					<?php
					// Render above sticky header markup only if enabled.
					if ( $disable_above_markup ) {
						add_filter( 'astra_above_header_display', array( $this, 'disabled' ) );
					}
					// Render main sticky header markup only if enabled.
					if ( $disable_main_markup ) {
						add_filter( 'astra_main_header_display', array( $this, 'disabled' ) );
					}
					// Render below sticky header markup only if enabled.
					if ( $disable_below_markup ) {
						add_filter( 'astra_below_header_display', array( $this, 'disabled' ) );
					}
					?>

					<?php astra_masthead_top(); ?>

					<?php astra_masthead(); ?>

					<?php astra_masthead_bottom(); ?>

					<?php
					// Remove filters.
					if ( $disable_above_markup ) {
						remove_filter( 'astra_above_header_display', array( $this, 'disabled' ) );
					}
					if ( $disable_main_markup ) {
						remove_filter( 'astra_main_header_display', array( $this, 'disabled' ) );
					}
					if ( $disable_below_markup ) {
						remove_filter( 'astra_below_header_display', array( $this, 'disabled' ) );
					}
					?>

				</header><!-- #astra-fixed-header -->

				<?php

				if ( '1' == $inherit_desk_logo && '' != $header_logo ) {
					remove_filter( 'astra_has_custom_logo', '__return_true' );
					remove_filter( 'astra_disable_site_identity', '__return_true' );
					remove_filter( 'astra_main_header_retina', '__return_false' );
					remove_filter( 'astra_replace_logo_width', '__return_false' );
					remove_filter( 'get_custom_logo', array( $this, 'sticky_custom_logo' ), 10 );
				}

				remove_filter( 'astra_show_site_title_h1_tag', '__return_false' );

				// Filters to make header & component ID unique.
				remove_filter( 'astra_header_site_navigation_id', array( $this, 'update_navigation_id' ), 10, 1 );
				remove_filter( 'astra_header_menu_ul_id', array( $this, 'update_menu_ul_id' ), 10, 1 );
			}
		}

		/**
		 * Render Svg Mask for Header logo
		 *
		 * @since 4.3.0
		 * @return void
		 */
		public function render_header_svg_mask() {

			$header_sticky_logo_color = astra_get_option( 'sticky-header-builder-logo-color' );

			if ( $header_sticky_logo_color && 'unset' !== $header_sticky_logo_color ) {
				astra_render_svg_mask( 'ast-img-color-filter-3', 'sticky_header_logo_color', $header_sticky_logo_color );
			}
		}

		/**
		 * Update Navigation ID
		 *
		 * @param string $id Navigation ID.
		 * @return string
		 */
		public function update_navigation_id( $id ) {
			return $id . '-sticky';
		}

		/**
		 * Update Menu UL ID
		 *
		 * @param string $id Menu UL ID.
		 * @return string
		 */
		public function update_menu_ul_id( $id ) {
			return $id . '-sticky';
		}

		/**
		 * Filter the output of logo to fix Googles Error about itemprop logo.
		 *
		 * @since  1.0.0
		 * @param  String $html    HTML Markup of the logo.
		 *
		 * @return String          Custom logo HTML output
		 */
		public function none_custom_logo( $html ) {

			$header_logo = astra_get_option( 'sticky-header-logo' );

			if ( '' !== $header_logo ) {

				add_filter( 'wp_get_attachment_image_attributes', array( $this, 'sticky_replace_header_logo_attr' ), 10, 3 );

				$custom_logo_id = attachment_url_to_postid( $header_logo );

				$size = 'ast-sticky-logo-size';

				if ( is_customize_preview() ) {
					$size = 'full';
				}

				$logo = sprintf(
					'<a href="%1$s" class="sticky-custom-logo" rel="home" %3$s>%2$s</a>',
					esc_url( home_url( '/' ) ),
					wp_get_attachment_image(
						$custom_logo_id,
						$size,
						false,
						array(
							'class' => 'custom-logo',
						)
					),
					astra_attr(
						'site-title-none-sticky-custom-link',
						array(
							'class' => '',
						)
					)
				);

				remove_filter( 'wp_get_attachment_image_attributes', array( $this, 'sticky_replace_header_logo_attr' ) );

				$html .= $logo;
			}

			return $html;
		}

		/**
		 * Filter the output of logo to fix Googles Error about itemprop logo.
		 *
		 * @since  1.0.0
		 * @param  String $html    HTML Markup of the logo.
		 * @param  int    $blog_id ID of the blog to get the custom logo for.
		 *
		 * @return String          Custom logo HTML output
		 */
		public function sticky_custom_logo( $html, $blog_id ) {

			$header_logo = astra_get_option( 'sticky-header-logo' );

			if ( '' !== $header_logo ) {

				/* Replace sticky header logo and width */
				add_filter( 'wp_get_attachment_image_attributes', array( $this, 'sticky_replace_header_logo_attr' ), 10, 3 );

				$custom_logo_id = attachment_url_to_postid( $header_logo );

				$size = 'ast-sticky-logo-size';

				if ( is_customize_preview() ) {
					$size = 'full';
				}

				$html = sprintf(
					'<a href="%1$s" class="sticky-custom-logo" rel="home" %3$s>%2$s</a>',
					esc_url( home_url( '/' ) ),
					wp_get_attachment_image(
						$custom_logo_id,
						$size,
						false,
						array(
							'class' => 'custom-logo',
						)
					),
					astra_attr(
						'site-title-sticky-custom-logo-link',
						array(
							'class' => '',
						)
					)
				);

				remove_filter( 'wp_get_attachment_image_attributes', array( $this, 'sticky_replace_header_logo_attr' ) );
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
		public function sticky_replace_header_logo_attr( $attr, $attachment, $size ) {

			$custom_logo    = astra_get_option( 'sticky-header-logo' );
			$custom_logo_id = attachment_url_to_postid( $custom_logo );

			if ( $custom_logo_id == $attachment->ID ) {

				$attach_data = array();
				if ( ! is_customize_preview() ) {
					$attach_data = wp_get_attachment_image_src( $attachment->ID, 'ast-sticky-logo-size' );

					if ( isset( $attach_data[0] ) ) {
						$attr['src'] = $attach_data[0];
					}
				}

				$file_type      = wp_check_filetype( $attr['src'] );
				$file_extension = $file_type['ext'];

				if ( 'svg' == $file_extension ) {
					$attr['width']  = '100%';
					$attr['height'] = '100%';
					$attr['class']  = 'astra-logo-svg';
				}

				$diff_retina_logo = astra_get_option( 'different-sticky-retina-logo' );

				if ( '1' == $diff_retina_logo ) {

					$retina_logo    = astra_get_option( 'sticky-header-retina-logo' );
					$custom_logo    = $attr['src'];
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
		 * Enqueue Admin Scripts Callback
		 *
		 * @param String $hook Screen name where the hook is fired.
		 */
		public function admin_enqueue_scripts( $hook ) {
			if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
				$post_types = get_post_types( array( 'public' => true ) );
				$screen     = get_current_screen();
				$post_type  = $screen->id;

				if ( in_array( $post_type, (array) $post_types ) ) {
					/* Directory and Extension */
					$file_prefix = '.min';
					$dir_name    = 'minified';

					if ( SCRIPT_DEBUG ) {
						$file_prefix = '';
						$dir_name    = 'unminified';
					}

					wp_enqueue_script( 'astra-ext-sticky-header-metabox', ASTRA_ADDON_EXT_STICKY_HEADER_URI . 'assets/js/' . $dir_name . '/metabox' . $file_prefix . '.js', array( 'jquery' ), ASTRA_EXT_VER, true );
				}
			}
		}

		/**
		 * Add Scripts Callback
		 */
		public function add_scripts() {

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_STICKY_HEADER_URI . 'assets/js/';
			$path = ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'assets/js/';

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

			/* End Path Logic */
			Astra_Minify::add_dependent_js( 'jquery' );

			if ( version_compare( '1.0.17', ASTRA_THEME_VERSION ) > -1 ) {
				Astra_Minify::add_js( $gen_path . 'sticky-header-compatibility' . $file_prefix . '.js' );
			}

			Astra_Minify::add_js( $gen_path . 'sticky-header' . $file_prefix . '.js' );
		}

		/**
		 * Add Localize variables
		 *
		 * @param  array $localize_vars Localize variables array.
		 * @return array
		 */
		public function localize_variables( $localize_vars ) {

			$site_layout = '';
			if ( Astra_Ext_Extension::is_active( 'site-layouts' ) ) {
				$site_layout = astra_get_option( 'site-layout' );
			}

			/**
			 * Stick Header
			 */
			$localize_vars['header_main_stick'] = astra_get_option( 'header-main-stick' );

			$localize_vars['header_above_stick']      = astra_get_option( 'header-above-stick' );
			$localize_vars['header_below_stick']      = astra_get_option( 'header-below-stick' );
			$localize_vars['stick_header_meta']       = astra_get_option_meta( 'stick-header-meta' );
			$localize_vars['header_main_stick_meta']  = astra_get_option_meta( 'header-main-stick-meta' );
			$localize_vars['header_above_stick_meta'] = astra_get_option_meta( 'header-above-stick-meta' );
			$localize_vars['header_below_stick_meta'] = astra_get_option_meta( 'header-below-stick-meta' );

			/**
			 * Sticky Header on Devices
			 */
			$localize_vars['sticky_header_on_devices'] = astra_get_option_meta( 'sticky-header-on-devices' );

			/**
			 * Sticky Header Style
			 */
			$localize_vars['sticky_header_style'] = astra_get_option_meta( 'sticky-header-style' );

			$localize_vars['sticky_hide_on_scroll'] = astra_get_option_meta( 'sticky-hide-on-scroll' );

			/**
			 * Breakpoint
			 */
			$localize_vars['break_point']        = astra_header_break_point();
			$localize_vars['tablet_break_point'] = astra_addon_get_tablet_breakpoint();
			$localize_vars['mobile_break_point'] = astra_addon_get_mobile_breakpoint();

			$localize_vars['header_main_shrink']           = astra_get_option( 'header-main-shrink' );
			$localize_vars['header_logo_width']            = astra_get_option( 'ast-header-logo-width' );
			$localize_vars['responsive_header_logo_width'] = astra_get_option( 'ast-header-responsive-logo-width' );
			$localize_vars['stick_origin_position']        = apply_filters( 'astra_addon_sticky_header_stick_origin_position', false );

			/**
			 * Site Layout
			 */
			$localize_vars['site_layout']              = esc_attr( $site_layout );
			$localize_vars['site_content_width']       = ASTRA_THEME_CONTAINER_PADDING_TWICE + astra_get_option( 'site-content-width' );
			$localize_vars['site_layout_padded_width'] = astra_get_option( 'site-layout-padded-width', 1200 );
			$localize_vars['site_layout_box_width']    = astra_get_option( 'site-layout-box-width', 1200 );

			/**
			 * Is new header builder active.
			 */
			$localize_vars['header_builder_active'] = astra_addon_builder_helper()->is_header_footer_builder_active;
			$localize_vars['component_limit']       = astra_addon_builder_helper()->component_limit;

			return $localize_vars;
		}

		/**
		 * Add Meta Options
		 *
		 * @param array $meta_option Page Meta.
		 * @return array
		 */
		public function add_options( $meta_option ) {

			$meta_option['stick-header-meta'] = array(
				'sanitize' => 'FILTER_SANITIZE_STRING',
				'default'  => astra_get_option_meta( 'stick-header-meta' ),
			);

			$meta_option['header-main-stick-meta'] = array(
				'sanitize' => 'FILTER_SANITIZE_STRING',
				'default'  => astra_get_option_meta( 'header-main-stick-meta' ),
			);

			if ( Astra_Ext_Extension::is_active( 'header-sections' ) ) {
				$meta_option['header-above-stick-meta'] = array(
					'sanitize' => 'FILTER_SANITIZE_STRING',
					'default'  => astra_get_option_meta( 'header-above-stick-meta' ),
				);
				$meta_option['header-below-stick-meta'] = array(
					'sanitize' => 'FILTER_SANITIZE_STRING',
					'default'  => astra_get_option_meta( 'header-below-stick-meta' ),
				);
			}

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
			$sticky_main       = isset( $meta['header-main-stick-meta']['default'] ) ? $meta['header-main-stick-meta']['default'] : 'on';
			$stick_header_meta = isset( $meta['stick-header-meta']['default'] ) ? $meta['stick-header-meta']['default'] : 'default';
			$show_meta_field   = ! astra_check_is_bb_themer_layout();

			if ( Astra_Ext_Extension::is_active( 'header-sections' ) ) {
				$sticky_top   = isset( $meta['header-above-stick-meta']['default'] ) ? $meta['header-above-stick-meta']['default'] : 'on';
				$sticky_below = isset( $meta['header-below-stick-meta']['default'] ) ? $meta['header-below-stick-meta']['default'] : 'on';
			}
			?>

			<?php if ( $show_meta_field ) { ?>
				<div class="stick-header-wrapper">
					<p class="post-attributes-label-wrapper">
						<strong> <?php esc_html_e( 'Sticky Header', 'astra-addon' ); ?> </strong><br/>
					</p>
						<select name="stick-header-meta" id="stick-header-meta">
							<option value="default" <?php selected( $stick_header_meta, 'default' ); ?>> <?php esc_html_e( 'Customizer Setting', 'astra-addon' ); ?> </option>
							<option value="enabled" <?php selected( $stick_header_meta, 'enabled' ); ?>> <?php esc_html_e( 'Enabled', 'astra-addon' ); ?> </option>
							<option value="disabled" <?php selected( $stick_header_meta, 'disabled' ); ?>> <?php esc_html_e( 'Disabled', 'astra-addon' ); ?> </option>
						</select>

					<div id="stick-header-meta-options">
						<?php
						if ( Astra_Ext_Extension::is_active( 'header-sections' ) ) {
							// Above Header Layout.
							$above_header_layout = astra_get_option( 'above-header-layout' );
							if ( 'disabled' != $above_header_layout ) {
								?>
									<div class="sticky-above-header-meta-wrapper" >
									<p class="post-attributes-label-wrapper">
										<input type="checkbox" id="header-above-stick-meta" name="header-above-stick-meta" value="on" <?php checked( $sticky_top, 'on' ); ?> />
										<label for="header-above-stick-meta"><?php esc_html_e( 'Stick Above Header', 'astra-addon' ); ?></label>
									</p>
									</div>
								<?php
							}
						}
						// Main Header Layout.
						$header_layouts = astra_get_option( 'header-layouts' );
						if ( 'header-main-layout-5' != $header_layouts ) {
							?>

						<div class="stick-main-header-meta-wrapper">
							<p class="post-attributes-label-wrapper">
							<input type="checkbox" id="header-main-stick-meta" name="header-main-stick-meta" value="on" <?php checked( $sticky_main, 'on' ); ?> />
							<label for="header-main-stick-meta"><?php esc_html_e( 'Stick Primary Header', 'astra-addon' ); ?></label>
							</p>
						</div>
							<?php
						}
						if ( Astra_Ext_Extension::is_active( 'header-sections' ) ) {
							// Below Header Layout.
							$below_header_layout = astra_get_option( 'below-header-layout' );
							if ( 'disabled' != $below_header_layout ) {
								?>
									<div class="sticky-below-header-meta-wrapper" >
									<p class="post-attributes-label-wrapper">
										<input type="checkbox" id="header-below-stick-meta" name="header-below-stick-meta" value="on" <?php checked( $sticky_below, 'on' ); ?> />
										<label for="header-below-stick-meta"><?php esc_html_e( 'Stick Below Header', 'astra-addon' ); ?></label>
									</p>
									</div>
								<?php
							}
						}
						?>

					</div>
				</div>
			<?php } ?>
			<?php
		}

		/**
		 * Add Styles Callback
		 */
		public function add_styles() {
			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_STICKY_HEADER_URI . 'assets/css/';
			$path = ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'assets/css/';
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

			/* End Path Logic */

			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );
		}

		/**
		 * Add Styles Callback
		 */
		public function customizer_save() {

			/* Generate Sticky Header Logo */
			$sticky_logo = astra_get_option( 'sticky-header-logo' );

			if ( '' !== $sticky_logo ) {
				add_filter( 'intermediate_image_sizes_advanced', array( $this, 'sticky_logo_image_sizes' ), 10, 2 );
				$sticky_logo_id = attachment_url_to_postid( $sticky_logo );
				Astra_Customizer::generate_logo_by_width( $sticky_logo_id );
			}
		}

		/**
		 * Add logo image sizes in filter.
		 *
		 * @since 1.0.0
		 * @param array $sizes Sizes.
		 * @param array $metadata attachment data.
		 *
		 * @return array
		 */
		public function sticky_logo_image_sizes( $sizes, $metadata ) {

			$logo_width = astra_get_option( 'sticky-header-logo-width' );

			if ( is_array( $sizes ) && '' !== $logo_width['desktop'] ) {
				$max_value                     = max( $logo_width );
				$sizes['ast-sticky-logo-size'] = array(
					'width'  => (int) $max_value,
					'height' => 0,
					'crop'   => false,
				);
			}

			return $sizes;
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Sticky_Header_Markup::get_instance();
