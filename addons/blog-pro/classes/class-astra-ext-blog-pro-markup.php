<?php
/**
 * Blog Pro Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Blog_Pro_Markup' ) ) {

	/**
	 * Blog Pro Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Blog_Pro_Markup {
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
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

			add_filter( 'body_class', array( $this, 'astra_ext_blog_pro_body_classes' ) );
			add_filter( 'post_class', array( $this, 'astra_post_class_blog_grid' ) );
			add_filter( 'astra_primary_class', array( $this, 'astra_primary_class_blog_grid' ) );
			add_filter( 'astra_blog_layout_class', array( $this, 'add_blog_layout_class' ) );
			add_action( 'astra_addon_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ), 1 );
			add_action( 'wp_head', array( $this, 'blog_customization' ) );

			add_filter( 'astra_blog_post_featured_image_after', array( $this, 'date_box' ), 10, 1 );
			add_filter( 'astra_related_post_featured_image_after', array( $this, 'date_box' ), 10, 1 );
			add_action( 'astra_entry_after', array( $this, 'author_info_markup' ), 9 );
			add_action( 'astra_entry_bottom', array( $this, 'author_box_within_container' ) );
			add_action( 'astra_entry_after', array( $this, 'single_post_navigation_markup' ), 9 );

			add_filter( 'astra_theme_js_localize', array( $this, 'blog_js_localize' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ) );

			// Blog Pagination.
			add_filter( 'astra_pagination_markup', array( $this, 'astra_blog_pagination' ) );

			add_filter( 'astra_meta_case_read-time', array( $this, 'reading_time_content' ), 10, 3 );

			add_action( 'init', array( $this, 'init_action' ) );

			// Load Google fonts.
			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );

			// Social Sharing.
			add_action( 'wp', array( $this, 'astra_social_sharing' ) );

			// Blog Post filter.
			add_action( 'wp', array( $this, 'blog_post_filter' ) );
		}

		/**
		 * Infinite Posts Show on scroll
		 *
		 * @since 1.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		public function blog_js_localize( $localize ) {

			global $wp_query;

			$pagination_enabled                 = apply_filters( 'astra_pagination_enabled', true );
			$blog_masonry                       = astra_get_option( 'blog-masonry' );
			$blog_pagination                    = $pagination_enabled ? astra_get_option( 'blog-pagination' ) : '';
			$blog_infinite_scroll_event         = astra_get_option( 'blog-infinite-scroll-event' );
			$blog_grid                          = astra_addon_get_blog_grid_columns();
			$blog_grid_layout                   = astra_get_option( 'blog-grid-layout' );
			$blog_layout                        = astra_addon_get_blog_layout();
			$grid_layout                        = 'blog-layout-1' == $blog_layout || 'blog-layout-4' == $blog_layout || 'blog-layout-6' == $blog_layout ? $blog_grid : $blog_grid_layout;
			$localize['revealEffectEnable']     = astra_addon_check_reveal_effect_condition( 'blog' ) || ( astra_addon_check_reveal_effect_condition( 'cpt' ) && ( is_archive() || is_tax() ) );
			$localize['edit_post_url']          = admin_url( 'post.php?post={{id}}&action=edit' );
			$localize['ajax_url']               = admin_url( 'admin-ajax.php' );
			$localize['infinite_count']         = 2;
			$localize['infinite_total']         = $wp_query->max_num_pages;
			$localize['pagination']             = $blog_pagination;
			$localize['infinite_scroll_event']  = $blog_infinite_scroll_event;
			$localize['no_more_post_message']   = apply_filters( 'astra_blog_no_more_post_text', __( 'No more posts to show.', 'astra-addon' ) );
			$localize['grid_layout']            = $grid_layout;
			$localize['site_url']               = get_site_url();
			$localize['blogArchiveTitleLayout'] = astra_get_option( 'ast-dynamic-archive-post-layout' );
			$localize['blogArchiveTitleOn']     = astra_get_option( 'ast-dynamic-archive-post-banner-on-blog' );
			$localize['show_comments']          = __( 'Show Comments', 'astra-addon' );

			// If woocommerce page template.
			if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
				$localize['masonryEnabled'] = false;
			} else {
				$localize['masonryEnabled']        = $blog_masonry;
				$localize['blogMasonryBreakPoint'] = absint( apply_filters( 'astra_blog_masonry_break_point', 0 ) );
			}

			return $localize;
		}

		/**
		 * Astra Blog Pagination
		 *
		 * @since 1.0
		 * @param html $output Pagination markup.
		 * @return html
		 */
		public function astra_blog_pagination( $output ) {

			global $wp_query;

			$pagination     = astra_get_option( 'blog-pagination' );
			$infinite_event = astra_get_option( 'blog-infinite-scroll-event' );
			$load_more_text = astra_get_i18n_option( 'blog-load-more-text', _x( '%astra%', 'Blogs: Load More Text', 'astra-addon' ) );

			if ( '' === $load_more_text ) {
				$load_more_text = __( 'Load More', 'astra-addon' );
			}

			if ( 'infinite' == $pagination ) {
				ob_start();
				?>
				<div class="ast-ajax-pagination-wrapper">
				<?php
				if ( $wp_query->max_num_pages > 1 ) {

					?>
						<nav class="ast-pagination-infinite" data-page="<?php echo esc_attr( 2 ); ?>" data-total="<?php echo esc_attr( $wp_query->max_num_pages ); ?>">
							<div class="ast-loader">
									<div class="ast-loader-1"></div>
									<div class="ast-loader-2"></div>
									<div class="ast-loader-3"></div>
							</div>
							<?php if ( 'click' == $infinite_event ) { ?>
								<span class="ast-load-more active">
									<?php
										$load_more_text = apply_filters( 'astra_load_more_text', $load_more_text );
										echo esc_html( $load_more_text );
									?>
								</span>
							<?php } ?>
						</nav>
					<?php
				}
				?>
				</div>
				<?php
				$output .= ob_get_clean();
			}

			return $output;
		}

		/**
		 * Function to get author info for default post only
		 */
		public function author_info_markup() {
			$author_box_placement = astra_get_option( 'author-box-placement', 'outside' );
			if ( astra_get_option( 'ast-author-info' ) && 'outside' === $author_box_placement && is_singular( 'post' ) ) {
				astra_addon_get_template( 'blog-pro/template/author-info.php' );
			}
		}

		/**
		 * Function to get author info box within the post container.
		 *
		 * @since 4.6.0
		 */
		public function author_box_within_container() {
			$author_box_placement = astra_get_option( 'author-box-placement', 'outside' );
			if ( astra_get_option( 'ast-author-info' ) && 'inside' === $author_box_placement && is_singular( 'post' ) ) {
				astra_addon_get_template( 'blog-pro/template/author-info.php' );
			}
		}

		/**
		 * Enable/Disable Single Post Navigation
		 *
		 * Checks the customizer option `Disable Single Post Navigation` and Enable/Disable the single post navigation.
		 *
		 * @since 1.3.3
		 *
		 * @return void
		 */
		public function single_post_navigation_markup() {
			$enable_post_navigation = astra_get_option( 'ast-single-post-navigation' );

			if ( $enable_post_navigation ) {
				remove_action( 'astra_entry_after', 'astra_single_post_navigation_markup' );
			}
		}

		/**
		 * Add 'Date Box' in featured section
		 *
		 * @since 1.0
		 *
		 * @param  string $output Post content.
		 * @return string content.
		 */
		public function date_box( $output ) {

			$blog_layout = astra_addon_get_blog_layout();
			if ( 'astra_blog_post_featured_image_after' === current_filter() && ( 'blog-layout-4' === $blog_layout || 'blog-layout-6' === $blog_layout || 'blog-layout-5' === $blog_layout ) ) {
				return $output;
			}

			$enable_date_box = astra_get_option( 'blog-date-box' );
			$date_box_style  = astra_get_option( 'blog-date-box-style' );

			if ( 'astra_related_post_featured_image_after' === current_filter() ) {
				$enable_date_box = apply_filters( 'astra_related_post_enable_date_box', $enable_date_box );
				$date_box_style  = apply_filters( 'astra_related_post_date_box_style', $date_box_style );
			}

			if ( $enable_date_box ) {

				$date_type   = astra_get_option( 'blog-meta-date-type', 'published' );
				$time_string = '<time class="entry-date published" datetime="%1$s"><span class="date-month">%2$s</span> <span class="date-day">%3$s</span> <span class="date-year">%4$s</span></time>';

				$time_string = sprintf(
					$time_string,
					'updated' === $date_type ? esc_attr( get_the_modified_date( 'c' ) ) : esc_attr( get_the_date( 'c' ) ),
					'updated' === $date_type ? esc_attr( get_the_modified_date( 'M' ) ) : esc_html( get_the_date( 'M' ) ),
					'updated' === $date_type ? esc_attr( get_the_modified_date( 'j' ) ) : esc_html( get_the_date( 'j' ) ),
					'updated' === $date_type ? esc_attr( get_the_modified_date( 'Y' ) ) : esc_html( get_the_date( 'Y' ) )
				);

				/**
				 * Filters the Date Box time format.
				 *
				 * @since 1.5.0
				 *
				 * @param string posted date format for the posts.
				 */
				$posted_on = apply_filters(
					'astra_date_box_time_format',
					sprintf(
						esc_html( '%s' ),
						$time_string
					)
				);

				ob_start();
				?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" >
					<div class="ast-date-meta <?php echo esc_attr( $date_box_style ); ?>">
						<span class="posted-on">
							<?php
								echo wp_kses(
									$posted_on,
									array(
										'time' => array(
											'class'    => array(),
											'datetime' => array(),
										),
										'span' => array( 'class' => array() ),
									)
								);
							?>
						</span>
					</div>
				</a>
				<?php
				$posted_on_data = ob_get_clean();

				/**
				 * Filters the Date Box markup.
				 *
				 * @since 1.5.0
				 *
				 * @param string $posted_on_data the posted date markup for the posts.
				 */
				$output .= apply_filters( 'astra_date_box_markup', $posted_on_data );
			}

			return $output;
		}

		/**
		 * Add Body Classes
		 *
		 * @param array $classes Blog Layout Class Array.
		 * @return array
		 */
		public function add_blog_layout_class( $classes ) {
			$display_date_box = astra_get_option( 'blog-date-box' );

			if ( ! $display_date_box ) {
				$classes[] = 'ast-no-date-box';
			}

			return $classes;
		}

		/**
		 * Blog Customization
		 */
		public function blog_customization() {

			$blog_layout = astra_addon_get_blog_layout();

			if ( ( 'blog-layout-2' === $blog_layout ) || ( 'blog-layout-3' === $blog_layout ) ) {
				remove_action( 'astra_entry_content_blog', 'astra_entry_content_blog_template' );
				add_action( 'astra_entry_content_blog', array( $this, 'blog_template' ) );
			}
		}

		/**
		 * Blog Template Markup
		 */
		public function blog_template() {
			astra_addon_get_template( 'blog-pro/template/' . esc_attr( astra_addon_get_blog_layout() ) . '.php' );
		}

		/**
		 * Add Blog Grid Class
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function astra_primary_class_blog_grid( $classes ) {

			// Apply grid class to archive page.
			if ( is_home() || is_archive() || is_search() ) {

				$blog_grid        = astra_addon_get_blog_grid_columns();
				$blog_grid_layout = astra_get_option( 'blog-grid-layout' );
				$blog_layout      = astra_addon_get_blog_layout();
				if ( 'blog-layout-1' === $blog_layout || 'blog-layout-4' === $blog_layout || 'blog-layout-6' === $blog_layout ) {
					$classes[] = 'ast-grid-' . esc_attr( $blog_grid['desktop'] );
					$classes[] = 'ast-grid-md-' . esc_attr( $blog_grid['tablet'] ); // For tablet.
					$classes[] = 'ast-grid-sm-' . esc_attr( $blog_grid['mobile'] ); // For mobile.
				} else {
					$classes[] = 'ast-grid-' . esc_attr( $blog_grid_layout );
				}
				$classes = apply_filters( 'astra_primary_class_blog_grid', $classes );
			}

			return $classes;
		}

		/**
		 * Add Post Class Blog Grid
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function astra_post_class_blog_grid( $classes ) {

			$wp_doing_ajax = wp_doing_ajax();

			if ( is_archive() || is_home() || is_search() || $wp_doing_ajax ) {

				global $wp_query;
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

				$blog_grid        = astra_addon_get_blog_grid_columns( 'desktop' );
				$blog_grid_layout = astra_get_option( 'blog-grid-layout' );
				$blog_layout      = astra_addon_get_blog_layout();

				$first_post_full_width = astra_get_option( 'first-post-full-width' );
				$blog_masonry          = astra_get_option( 'blog-masonry' );

				$remove_featured_padding = astra_get_option( 'blog-featured-image-padding' );
				$blog_space_bet_posts    = astra_get_option( 'blog-space-bet-posts' );

				if ( $wp_doing_ajax ) {
					$classes[] = 'ast-col-sm-12';
					$classes[] = 'ast-article-post';
				}

				if ( 'blog-layout-1' == $blog_layout || 'blog-layout-4' == $blog_layout || 'blog-layout-6' == $blog_layout ) {

					if ( $remove_featured_padding ) {
						$classes[] = 'remove-featured-img-padding';
					}

					if ( $blog_grid > 1 && $first_post_full_width && ! $blog_masonry && 0 == $wp_query->current_post && 1 == $paged ) {

						// Feature Post.
						if ( 3 == $blog_grid ) {
							$classes[] = Astra_Addon_Builder_Helper::apply_flex_based_css() ? 'ast-width-md-66' : 'ast-col-md-8';
						} elseif ( 4 == $blog_grid ) {
							$classes[] = Astra_Addon_Builder_Helper::apply_flex_based_css() ? 'ast-width-50' : 'ast-col-md-6';
						} else {
							$classes[] = Astra_Addon_Builder_Helper::apply_flex_based_css() ? 'ast-grid-common-col' : 'ast-col-md-12';
						}

						$classes[] = 'ast-featured-post';
					} else {
						$classes[] = Astra_Addon_Builder_Helper::apply_flex_based_css() ? 'ast-width-md-' . ( 12 / $blog_grid ) : 'ast-col-md-' . ( 12 / $blog_grid );
					}
				} else {

					if ( $blog_grid_layout > 1 && $first_post_full_width && ! $blog_masonry && 0 == $wp_query->current_post && 1 == $paged ) {

						// Feature Post.
						$classes[] = 'ast-col-md-12';
						$classes[] = 'ast-featured-post';
					} else {
						$classes[] = Astra_Addon_Builder_Helper::apply_flex_based_css() ? 'ast-width-md-' . ( 12 / $blog_grid_layout ) : 'ast-col-md-' . ( 12 / $blog_grid_layout );
					}
				}
				if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
					$classes[] = 'ast-archive-post';
				}
				if ( $blog_space_bet_posts ) {
					$classes[] = 'ast-separate-posts';
				}

				if ( astra_addon_check_reveal_effect_condition( 'blog' ) || ( astra_addon_check_reveal_effect_condition( 'cpt' ) && ( is_archive() || is_tax() ) ) ) {
					$classes[] = 'ast-fade-up';
				}
			} elseif ( is_singular() ) {

				$blog_layout             = astra_addon_get_blog_layout();
				$remove_featured_padding = astra_get_option( 'single-featured-image-padding' );

				if ( 'blog-layout-1' == $blog_layout && $remove_featured_padding ) {
					$classes[] = 'remove-featured-img-padding';
				}
			}

			return $classes;
		}

		/**
		 * Add Body Classes
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function astra_ext_blog_pro_body_classes( $classes ) {

			if ( is_archive() || is_home() || is_search() ) {

				global $wp_query;
				$blog_layout      = astra_addon_get_blog_layout();
				$blog_masonry     = astra_get_option( 'blog-masonry' );
				$blog_grid        = astra_addon_get_blog_grid_columns( 'desktop' );
				$blog_grid_layout = astra_get_option( 'blog-grid-layout' );
				$blog_pagination  = astra_get_option( 'blog-pagination' );

				// Masonry layout for blog.
				if ( $blog_masonry && $wp_query->posts ) {
					$classes[] = 'blog-masonry';
				}

				// Blog layout.
				if ( 'blog-layout-1' == $blog_layout || 'blog-layout-4' == $blog_layout || 'blog-layout-5' == $blog_layout || 'blog-layout-6' == $blog_layout ) {
					$classes[] = 'ast-blog-grid-' . esc_attr( $blog_grid );
				} else {
					$classes[] = 'ast-blog-grid-' . esc_attr( $blog_grid_layout );
				}

				// Blog layout.
				$classes[] = 'ast-' . esc_attr( $blog_layout );

				if ( 'infinite' === $blog_pagination ) {
					// Pagination type.
					$classes[] = 'ast-blog-pagination-type-infinite';
				}

				if ( 'number' === $blog_pagination ) {

					$blog_pagination_style = astra_get_option( 'blog-pagination-style' );

					$classes[] = 'ast-pagination-' . esc_attr( $blog_pagination_style );
				}
			}

			return $classes;
		}

		/**
		 * Add style.
		 *
		 * @since 1.0
		 *
		 * @return void.
		 */
		public function add_styles() {

			$author_info          = astra_get_option( 'ast-author-info' );
			$enable_related_posts = astra_get_option( 'enable-related-posts' );
			$blog_layout          = astra_addon_get_blog_layout();
			$blog_layout_path     = '';

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_BLOG_PRO_URI . 'assets/css/';
			$path = ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'assets/css/';
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

			/* Add style.css */
			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );

			if ( $author_info ) {
				Astra_Minify::add_css( $gen_path . 'post-author' . $file_prefix . '.css' );
			}

			if ( $enable_related_posts ) {
				Astra_Minify::add_css( $gen_path . 'related-posts' . $file_prefix . '.css' );
			}

			/* Blog Layouts */
			if ( true === Astra_Addon_Builder_Helper::apply_flex_based_css() && ( 'blog-layout-2' == $blog_layout || 'blog-layout-3' == $blog_layout ) ) {
				$blog_layout_path = $blog_layout . '-flex';
			} else {
				$blog_layout_path = $blog_layout;
			}

			if ( 'blog-layout-1' == $blog_layout || 'blog-layout-2' == $blog_layout || 'blog-layout-3' == $blog_layout ) {
				Astra_Minify::add_css( $gen_path . $blog_layout_path . $file_prefix . '.css' );
			}
		}

		/**
		 * Add scripts.
		 *
		 * @since 1.0
		 *
		 * @return void.
		 */
		public function add_scripts() {

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_BLOG_PRO_URI . 'assets/js/';
			$path = ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'assets/js/';

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

			$blog_layout        = astra_addon_get_blog_layout();
			$blog_grid          = astra_addon_get_blog_grid_columns( 'desktop' );
			$blog_grid_layout   = astra_get_option( 'blog-grid-layout' );
			$astra_blog_masonry = astra_get_option( 'blog-masonry' );
			$blog_filter        = astra_get_option( 'blog-filter' );

			if ( ( 'blog-layout-1' == $blog_layout && 1 != $blog_grid ) || ( 'blog-layout-1' != $blog_layout && 1 != $blog_grid_layout ) || ( 'blog-layout-4' == $blog_layout && 1 != $blog_grid ) || ( 'blog-layout-6' == $blog_layout && 1 != $blog_grid ) ) {
				// Enqueue scripts.
				if ( $astra_blog_masonry ) {
					Astra_Minify::add_dependent_js( 'jquery' );
					Astra_Minify::add_dependent_js( 'jquery-masonry' );

					Astra_Minify::add_js( $gen_path . 'ast-ext-blog-pro' . $file_prefix . '.js' );
				}
			}

			if ( $blog_filter ) {
				Astra_Minify::add_js( $gen_path . 'filter' . $file_prefix . '.js' );
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

			$blog_pagination = astra_get_option( 'blog-pagination' );

			/* Directory and Extension */
			$file_prefix = '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = '';
				$dir_name    = 'unminified';
			}

			$js_gen_path  = ASTRA_ADDON_EXT_BLOG_PRO_URI . 'assets/js/' . $dir_name . '/';
			$css_gen_path = ASTRA_ADDON_EXT_BLOG_PRO_URI . 'assets/css/' . $dir_name . '/';

			if ( astra_get_option( 'ast-auto-prev-post' ) && is_singular() ) {

				if ( SCRIPT_DEBUG ) {
					wp_enqueue_script( 'astra-scrollspy', $js_gen_path . 'scrollspy' . $file_prefix . '.js', array( 'jquery' ), ASTRA_EXT_VER, true );
					wp_enqueue_script( 'astra-history', $js_gen_path . 'jquery-history' . $file_prefix . '.js', array( 'jquery' ), ASTRA_EXT_VER, true );
					wp_enqueue_script( 'astra-single-infinite', $js_gen_path . 'single-infinite' . $file_prefix . '.js', array( 'astra-scrollspy' ), ASTRA_EXT_VER, true );
				} else {
					wp_enqueue_script( 'astra-single-infinite', $js_gen_path . 'single-autopost-infinite.min.js', array( 'jquery' ), ASTRA_EXT_VER, true );
				}
			}
			// Load infinite js only if option is used.
			if ( ( is_home() || is_archive() || is_search() ) && 'infinite' === $blog_pagination ) {

				wp_enqueue_script( 'astra-pagination-infinite', $js_gen_path . 'pagination-infinite' . $file_prefix . '.js', array( 'jquery', 'astra-addon-js' ), ASTRA_EXT_VER, true );

			}
		}

		/**
		 * Calculate reading time.
		 *
		 * @since 1.0
		 *
		 * @param  int $post_id Post content.
		 * @return int read time.
		 */
		public function calculate_reading_time( $post_id ) {

			$post_content       = get_post_field( 'post_content', $post_id );
			$stripped_content   = strip_shortcodes( $post_content );
			$strip_tags_content = wp_strip_all_tags( $stripped_content );
			$word_count         = count( preg_split( '/\s+/', $strip_tags_content ) );
			return ceil( $word_count / 220 );
		}

		/**
		 * Reading Time Meta.
		 *
		 * @since 1.3.3 Updated post reading time strings.
		 * @since 1.0
		 *
		 * @param  string $content Post content.
		 * @param  string $loop_count Post meta loop count.
		 * @param  string $separator Separator text.
		 * @return string content
		 */
		public function reading_time_content( $content = '', $loop_count = '', $separator = '' ) {
			$read_time                 = (int) $this->calculate_reading_time( get_the_ID() );
			$singular_min_reading_text = apply_filters( 'astra_post_minute_of_reading_text', __( 'minute of reading', 'astra-addon' ) );
			$plural_mins_reading_text  = apply_filters( 'astra_post_minutes_of_reading_text', __( 'minutes of reading', 'astra-addon' ) );

			$content .= 1 != $loop_count && '' != $content ? ' ' . $separator . ' ' : '';

			/* translators: %1$s: $read_time the time to read the article, %2%s: $singular_min_reading_text the singular minute reading time text, %3%s: $plural_mins_reading_text the plural minutes reading time text */
			$content .= '<span class="ast-reading-time">' . sprintf( _n( '%1$s %2$s', '%1$s %3$s', $read_time, 'astra-addon' ), $read_time, $singular_min_reading_text, $plural_mins_reading_text ) . '</span>'; // phpcs:ignore WordPress.WP.I18n.MismatchedPlaceholders

			return $content;
		}

		/**
		 * Init action.
		 *
		 * @return void
		 */
		public function init_action() {

			$this->single_post_add_endpoint();

			if ( 'excerpt' === astra_get_option( 'blog-post-content' ) ) {
				// Excerpt Filter.
				add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ) );

				add_filter( 'astra_post_read_more', array( $this, 'read_more_text' ) );
				add_filter( 'astra_post_read_more_class', array( $this, 'read_more_class' ) );
			}
		}

		/**
		 * Single post rewrite endpoint.
		 *
		 * @return void
		 */
		public function single_post_add_endpoint() {

			if ( astra_get_option( 'ast-auto-prev-post' ) || is_customize_preview() ) {

				add_rewrite_endpoint( 'partial-prev', EP_PERMALINK );

				add_action( 'template_redirect', array( $this, 'single_post_template_redirect' ) );

				add_action( 'astra_before_content_partial_loop', array( $this, 'auto_prev_post_wp_bakery_compatibility' ) );
			}
		}

		/**
		 * Added shortcode rendering compatibility for WP Bakery plugin.
		 *
		 * WP Bakery plugin shortcodes were not rendering when auto prev post option was enable.
		 *
		 * @return void
		 */
		public function auto_prev_post_wp_bakery_compatibility() {
			// Make sure all vc shortcodes are loaded (needed for ajax previous post pagination).
			if ( is_callable( 'WPBMap::addAllMappedShortcodes' ) ) {
				WPBMap::addAllMappedShortcodes();
			}
		}

		/**
		 * Single post template redirect.
		 */
		public function single_post_template_redirect() {
			global $wp_query;

			// if this is not a request for partial or a singular object then bail.
			if ( ( isset( $wp_query->query_vars['partial-prev'] ) || isset( $_GET['partial-prev'] ) ) && is_singular() ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				// include custom template.
				include ASTRA_ADDON_EXT_BLOG_PRO_DIR . '/template/content-partial.php';

				exit;
			}
		}

		/**
		 * Excerpt count.
		 *
		 * @param int $length default count of words.
		 * @return int count of words
		 */
		public function custom_excerpt_length( $length ) {

			$excerpt_length = astra_get_option( 'blog-excerpt-count' );

			if ( '' != $excerpt_length ) {
				$length = $excerpt_length;
			}

			return $length;
		}

		/**
		 * Read more text.
		 *
		 * @param string $text default read more text.
		 * @return string read more text
		 */
		public function read_more_text( $text ) {

			$read_more = astra_get_i18n_option( 'blog-read-more-text', _x( '%astra%', 'Blogs: Read More Text', 'astra-addon' ) );

			if ( '' != $read_more ) {
				$text = $read_more;
			}

			return $text;
		}

		/**
		 * Read more class.
		 *
		 * @param array $class default classes.
		 * @return array classes
		 */
		public function read_more_class( $class ) {

			$read_more_button = astra_get_option( 'blog-read-more-as-button' );

			if ( $read_more_button ) {
				$class[] = 'ast-button';
			}

			return $class;
		}

		/**
		 * Social sharing.
		 *
		 * @since 4.1.0
		 */
		public function astra_social_sharing() {
			$social_sharing_position   = astra_get_option( 'single-post-social-sharing-icon-position' );
			$is_social_sharing_enabled = astra_get_option( 'single-post-social-sharing-icon-enable' );
			if ( $is_social_sharing_enabled ) {
				if ( is_single() ) {
					if ( 'below-post-title' === $social_sharing_position ) {
						add_action( 'astra_single_post_banner_after', array( $this, 'astra_render_social_sharing' ) );
					} else {
						add_action( 'astra_entry_bottom', array( $this, 'astra_render_social_sharing' ) );
					}
				}
			}
		}

		/**
		 * Enqueue google fonts.
		 *
		 * @return void
		 */
		public function add_fonts() {

			// Single post social sharing - Label font.
			$label_font_family = astra_get_option( 'single-post-social-sharing-icon-label-font-family' );
			$label_font_weight = astra_get_option( 'single-post-social-sharing-icon-label-font-weight' );
			Astra_Fonts::add_font( $label_font_family, $label_font_weight );

			// Single post social sharing - Label font.
			$heading_font_family = astra_get_option( 'single-post-social-sharing-heading-font-family' );
			$heading_font_weight = astra_get_option( 'single-post-social-sharing-heading-font-weight' );
			Astra_Fonts::add_font( $heading_font_family, $heading_font_weight );
		}

		/**
		 * Render Author Box sharing.
		 *
		 * @since 4.6.0
		 * @return mixed HTML markup
		 */
		public function astra_render_author_box_sharing() {
			$is_author_box_enabled  = astra_get_option( 'ast-author-info' );
			$social_sharing_enabled = astra_get_option( 'author-box-socials' );
			if ( ! is_single() || ! $is_author_box_enabled || ! $social_sharing_enabled ) {
				return;
			}

			$prefix     = 'author-box';
			$title      = get_the_title();
			$show_label = false;
			$items      = astra_get_option( 'author-box-social-icon-list' );

			$items                 = isset( $items['items'] ) ? $items['items'] : array();
			$post_categories       = wp_strip_all_tags( get_the_category_list( ',' ) );
			$post_title            = $title;
			$post_link             = urlencode( get_the_permalink() ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.urlencode_urlencode
			$email_title           = str_replace( '&', '%26', $title );
			$enable_heading        = astra_get_option( 'single-post-social-sharing-heading-enable' );
			$heading_text          = astra_get_i18n_option( 'single-post-social-sharing-heading-text', _x( '%astra%', 'Single Post: Social Sharing: Heading Text', 'astra-addon' ) );
			$heading_position      = astra_get_option( 'single-post-social-sharing-heading-position' );
			$show_label            = $show_label;
			$show_label_class      = $show_label ? 'social-show-label-true' : 'social-show-label-false';
			$color_type            = astra_get_option( 'single-post-social-sharing-icon-color-type' );
			$label_position        = astra_get_option( 'single-post-social-sharing-icon-label-position' );
			$social_icon_condition = array( 'facebook', 'pinterest', 'linkedin', 'reddit', 'whatsapp', 'sms', 'telegram' );

			$markup = '<div class="ast-author-box-sharing"> <div class="ast-social-inner-wrap element-social-inner-wrap ' . esc_attr( $show_label_class ) . ' ast-social-color-type-' . esc_attr( $color_type ) . '">';

			if ( is_array( $items ) && ! empty( $items ) ) {
				foreach ( $items as $item ) {
					if ( $item['enabled'] ) {
						$link = $item['url'];
						switch ( $item['id'] ) {
							case 'phone':
								$link = 'tel:' . $item['url'];
								break;

							case 'email':
								$link = 'mailto:' . $item['url'];
								break;

							case 'whatsapp':
								$link = 'https://api.whatsapp.com/send?phone=' . $item['url'];
								break;
						}

						$link = apply_filters( 'astra_addon_author_social_sharing_link', $link, $item['id'] );

						$aria_label        = $item['label'] ? $item['label'] : $item['id'];
						$is_phone_or_email = 'phone' === $item['id'] || 'email' === $item['id'];
						$add_target        = $is_phone_or_email ? '' : '_blank';
						$add_rel           = $is_phone_or_email ? '' : 'noopener noreferrer';

						$icon_color            = ! empty( $item['color'] ) ? $item['color'] : '#3a3a3a';
						$icon_background_color = ! empty( $item['background'] ) ? $item['background'] : 'transparent';

						$markup .= '<a href="' . esc_url( $link ) . '" aria-label="' . esc_attr( $aria_label ) . '" target="' . esc_attr( $add_target ) . '" rel="' . esc_attr( $add_rel ) . '" class="ast-inline-flex ast-social-icon-a">
								<div style="--color: ' . esc_attr( $icon_color ) . '; --background-color:' . esc_attr( $icon_background_color ) . ';" class="ast-social-element ast-' . esc_attr( $item['id'] ) . '-social-item">
									' . Astra_Builder_UI_Controller::fetch_svg_icon( in_array( $item['icon'], $social_icon_condition ) ? $item['icon'] . '-fill' : $item['icon'] ) . '
								</div>
							</a>';
					}
				}
			}

			return $markup . '</div></div>';
		}

		/**
		 * Render social sharing.
		 *
		 * @since 4.1.0
		 */
		public function astra_render_social_sharing() {

			$items                 = astra_get_option( 'single-post-social-sharing-icon-list' );
			$items                 = isset( $items['items'] ) ? $items['items'] : array();
			$post_categories       = wp_strip_all_tags( get_the_category_list( ',' ) );
			$post_title            = get_the_title();
			$post_link             = urlencode( get_the_permalink() ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.urlencode_urlencode
			$email_title           = str_replace( '&', '%26', $post_title );
			$enable_heading        = astra_get_option( 'single-post-social-sharing-heading-enable' );
			$heading_text          = astra_get_i18n_option( 'single-post-social-sharing-heading-text', _x( '%astra%', 'Single Post: Social Sharing: Heading Text', 'astra-addon' ) );
			$heading_position      = astra_get_option( 'single-post-social-sharing-heading-position' );
			$show_label            = astra_get_option( 'single-post-social-sharing-icon-label' );
			$show_label_class      = $show_label ? 'social-show-label-true' : 'social-show-label-false';
			$color_type            = astra_get_option( 'single-post-social-sharing-icon-color-type' );
			$label_position        = astra_get_option( 'single-post-social-sharing-icon-label-position' );
			$social_icon_condition = array( 'facebook', 'pinterest', 'linkedin', 'reddit', 'whatsapp', 'sms' );

			if ( $items ) {
				ob_start();
				?>
					<div class="ast-post-social-sharing">
						<?php if ( $enable_heading && 'above' === $heading_position ) { ?>
							<h3 class="ast-social-sharing-heading"> <?php echo esc_html( $heading_text ); ?></h3>
						<?php } ?>
						<div class="ast-social-inner-wrap element-social-inner-wrap <?php echo esc_attr( $show_label_class ); ?> ast-social-color-type-<?php echo esc_attr( $color_type ); ?>">
							<?php
							if ( is_array( $items ) && ! empty( $items ) ) {

								foreach ( $items as $item ) {

									if ( $item['enabled'] ) {

										$link = $item['url'];

										switch ( $item['id'] ) {
											case 'facebook':
												$link = add_query_arg(
													array(
														'u' => $post_link,
													),
													'https://www.facebook.com/sharer.php'
												);
												break;
											case 'twitter':
											case 'twitter-x':
												$link = add_query_arg(
													array(
														'url'      => $post_link,
														'text'     => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) ),
														'hashtags' => $post_categories,
													),
													'http://twitter.com/share'
												);
												break;
											case 'email':
												$link = add_query_arg(
													array(
														'subject' => wp_strip_all_tags( $email_title ),
														'body'    => $post_link,
													),
													'mailto:'
												);
												break;
											case 'pinterest':
												$link = 'https://pinterest.com/pin/create/bookmarklet/?media=' . get_the_post_thumbnail_url() . '&url=' . $post_link . '&description=' . $post_title;
												break;
											case 'linkedin':
												$link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_link . '&title=' . urlencode( $post_title ) . '&source=' . urlencode( get_bloginfo( 'name' ) ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.urlencode_urlencode
												break;
											case 'tumblr':
												$link = 'http://www.tumblr.com/share/link?url=' . $post_link . '&title=' . $post_title;
												break;
											case 'reddit':
												$link = 'https://reddit.com/submit?url=' . $post_link . '&title=' . $post_title;
												break;
											case 'whatsapp':
												$link = 'https://wa.me/?text=' . $post_link;
												break;
											case 'sms':
												$link = 'sms://?&body=' . $post_title . ' - ' . $post_link;
												break;
											case 'vk':
												$link = 'http://vk.com/share.php?url=' . urlencode( $post_link ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.urlencode_urlencode
												break;
											case 'telegram':
												// The `Post_link` variable has already been encoded above.
												$link = 'https://t.me/share/url?url=' . $post_link . '&text=' . rawurlencode( $post_title );
												break;
										}

										$aria_label        = $item['label'] ? $item['label'] : $item['id'];
										$is_phone_or_email = 'phone' === $item['id'] || 'email' === $item['id'];
										$add_target        = $is_phone_or_email ? '' : '_blank';
										$add_rel           = $is_phone_or_email ? '' : apply_filters( 'astra_social_rel_attribute', 'noopener noreferrer' );
										?>
											<a href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>" target="<?php echo esc_attr( $add_target ); ?>" rel="<?php echo esc_attr( $add_rel ); ?>" class="ast-inline-flex ast-social-icon-a">
											<?php
											if ( $show_label && $label_position && 'above' === $label_position ) {
												?>
												<span class="social-item-label"> <?php echo esc_html( $item['label'] ); ?> </span>
											<?php } ?>
												<?php
													$icon_color            = ! empty( $item['color'] ) ? $item['color'] : '#3a3a3a';
													$icon_background_color = ! empty( $item['background'] ) ? $item['background'] : 'transparent';
												?>
												<div style="--color: <?php echo esc_attr( $icon_color ); ?>; --background-color:<?php echo esc_attr( $icon_background_color ); ?>;" class="ast-social-element ast-<?php echo esc_attr( $item['id'] ); ?>-social-item">
													<?php echo do_shortcode( Astra_Builder_UI_Controller::fetch_svg_icon( in_array( $item['icon'], $social_icon_condition ) ? $item['icon'] . '-fill' : $item['icon'] ) ); ?>
												</div>
												<?php
												if ( $show_label && $label_position && 'below' === $label_position ) {
													?>
														<span class="social-item-label"> <?php echo esc_html( $item['label'] ); ?> </span>
												<?php } ?>
											</a>
										<?php
									}
								}
							}
							?>
						</div>
						<?php if ( $enable_heading && 'below' === $heading_position ) { ?>
							<h3 class="ast-social-sharing-heading"> <?php echo esc_html( $heading_text ); ?></h3>
						<?php } ?>
					</div>
				<?php
				echo do_shortcode( ob_get_clean() );
			}
		}

		/**
		 * Blog Post Filter.
		 *
		 * @since 4.4.0
		 * @return void
		 */
		public function blog_post_filter() {
			$post_filter = astra_get_option( 'blog-filter' );

			if ( ! $post_filter ) {
				return;
			}

			if ( is_home() || is_category() || is_tag() ) {
				add_action( 'astra_primary_content_top', array( $this, 'blog_post_filter_markup' ), 100 );
			}
		}

		/**
		 * Blog Post Filter.
		 *
		 * @since 4.4.0
		 * @return mixed
		 */
		public function blog_post_filter_markup() {
			$blog_filter_layout     = astra_get_option( 'blog-filter-layout' );
			$blog_filter_by         = astra_get_option( 'blog-filter-by' );
			$category_include       = astra_get_option( 'blog-filter-category-exclude' );
			$tag_include            = astra_get_option( 'blog-filter-tag-exclude' );
			$category_include_array = array();
			$tag_include_array      = array();

			if ( $category_include ) {
				if ( strpos( $category_include, ',' ) !== false ) {
					$category_include_array = explode( ',', $category_include );
				} else {
					$category_include_array = array( $category_include );
				}
			}

			if ( $tag_include ) {
				if ( strpos( $tag_include, ',' ) !== false ) {
					$tag_include_array = explode( ',', $tag_include );
				} else {
					$tag_include_array = array( $tag_include );
				}
			}

			if ( is_category() || ( is_home() && 'categories' === $blog_filter_by ) ) {
				$taxonomy_name = 'category';
				if ( isset( $category_include ) ) {
					$term_args = array(
						'hide_empty' => true,
					);
				} else {
					$term_args = array(
						'hide_empty' => true,
					);
				}
			}

			if ( is_tag() || ( is_home() && 'tags' === $blog_filter_by ) ) {
				$taxonomy_name = 'post_tag';
				if ( isset( $tag_include ) ) {
					$term_args = array(
						'hide_empty' => true,
					);
				} else {
					$term_args = array(
						'hide_empty' => true,
					);
				}
			}

			$terms = get_terms( $taxonomy_name, $term_args ); // Get all terms of a taxonomy.

			if ( $terms && ! is_wp_error( $terms ) ) {

				if ( is_category() && 'tags' === $blog_filter_by ) {
					return false;
				}

				if ( is_tag() && 'categories' === $blog_filter_by ) {
					return false;
				}

				if ( is_category() && in_array( get_queried_object_id(), $category_include_array ) ) {
					return false;
				}

				if ( is_tag() && in_array( get_queried_object_id(), $tag_include_array ) ) {
					return false;
				}

				ob_start();
				?>
				<div class="ast-post-filter">
					<ul>
					<?php
						$blog_filter_layout_2_classes = 'blog-filter-layout-2' === $blog_filter_layout ? 'ast-button' : '';
						$category_tag_page_classes    = ! ( is_category() || is_tag() ) ? 'active' : '';
						$add_spacing                  = $category_tag_page_classes ? ' ' : '';
						$classes                      = $blog_filter_layout_2_classes || $category_tag_page_classes ? ' ' . $blog_filter_layout_2_classes . $add_spacing . $category_tag_page_classes : '';
					?>
					<li class="ast-post-filter-single<?php echo esc_attr( $classes ); ?>" value="all" data-filter="<?php echo esc_attr( get_post_type_archive_link( 'post' ) ); ?>" ><?php echo esc_html( __( 'All', 'astra-addon' ) ); ?></li>
						<?php
						foreach ( $terms as $term ) {
								$term_name = isset( $term->name ) ? $term->name : '';
								$term_id   = isset( $term->term_id ) ? $term->term_id : '';

							$active_category_tag = '';
							if ( is_tag() || is_category() ) {
								$active_category_tag = get_queried_object_id() && get_queried_object_id() === $term_id ? 'active' : '';
								$add_spacing         = $active_category_tag ? ' ' : '';
							}
							$classes = $blog_filter_layout_2_classes || $active_category_tag ? ' ' . $blog_filter_layout_2_classes . $add_spacing . $active_category_tag : '';

							if ( ( 'categories' === $blog_filter_by && isset( $category_include_array ) && ! in_array( $term_id, $category_include_array ) ) || ( 'tags' === $blog_filter_by && isset( $tag_include_array ) && ! in_array( $term_id, $tag_include_array ) ) ) {
								?>
								<li class="ast-post-filter-single<?php echo esc_attr( $classes ); ?>" value="<?php echo esc_attr( $term_id ); ?>" data-filter="<?php echo esc_attr( get_category_link( $term_id ) ); ?>" ><?php echo esc_html( $term_name ); ?></li>

								<?php
							}
						}
						?>
					</ul>
				</div>
				<?php
				echo wp_kses_post( ob_get_clean() );
			}
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Blog_Pro_Markup::get_instance();
