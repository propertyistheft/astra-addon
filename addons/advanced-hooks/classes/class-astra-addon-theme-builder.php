<?php
/**
 * Astra Site Builder
 *
 * @package Astra Addon
 */

// Return if WP_REST_Controller class does not exist.
if ( ! class_exists( 'WP_REST_Controller' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Addon_Theme_Builder' ) ) {

	/**
	 * Site Builder Pro.
	 *
	 * @since 4.5.0
	 */
	class Astra_Addon_Theme_Builder extends WP_REST_Controller {
		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Plugin slug
		 *
		 * @since 4.5.0
		 * @var string $plugin_slug
		 */
		public static $plugin_slug = 'astra';

		/**
		 *  Initiator
		 *
		 * @since 4.5.0
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 *
		 * @since 4.5.0
		 * @return void
		 */
		public function __construct() {
			if ( method_exists( 'Astra_Menu', 'get_theme_page_slug' ) ) {
				self::$plugin_slug = Astra_Menu::get_theme_page_slug();
			}
			add_action( 'admin_enqueue_scripts', array( $this, 'theme_builder_admin_enqueue_scripts' ) );
			add_action( 'admin_body_class', array( $this, 'admin_body_class' ) );
			add_action( 'admin_menu', array( $this, 'setup_menu' ) );
			add_action( 'rest_api_init', array( $this, 'register_routes' ) );
			add_action( 'admin_init', array( $this, 'astra_theme_builder_redirect' ) );
			add_action( 'admin_init', array( $this, 'astra_theme_builder_disable_notices' ) );
		}

		/**
		 *  Enqueue scripts and styles.
		 *
		 * @since 4.5.0
		 * @return void
		 */
		public function theme_builder_admin_enqueue_scripts() {
			$file_prefix = '';
			if ( is_rtl() ) {
				$file_prefix .= '.rtl';
			}

			wp_enqueue_style( 'wp-components' );

			if ( isset( $_GET['page'] ) && $_GET['page'] === 'theme-builder' ) {
				/**
				 * Enqueue advanced-hook-admin-edit styles for the design consistency for Display Condition Modal.
				 */
				if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
					wp_enqueue_style( 'advanced-hook-admin-edit', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/css/unminified/astra-advanced-hooks-admin-edit.css', null, ASTRA_EXT_VER );
				} else {
					wp_enqueue_style( 'advanced-hook-admin-edit', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'assets/css/minified/astra-advanced-hooks-admin-edit.min.css', null, ASTRA_EXT_VER );
				}
			}

			wp_enqueue_style( 'astra-theme-builder-style', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'theme-builder/build/index' . $file_prefix . '.css', array(), ASTRA_EXT_VER );
			wp_enqueue_script( 'astra-theme-builder-script', ASTRA_ADDON_EXT_ADVANCED_HOOKS_URL . 'theme-builder/build/index.js', array( 'react', 'react-dom', 'wp-api-fetch', 'wp-components', 'wp-element', 'wp-i18n' ), ASTRA_EXT_VER, true );
			wp_enqueue_style( 'dashicons' );

			if ( function_exists( 'astra_is_white_labelled' ) ) {
				$white_labelled = astra_is_white_labelled();
			}

			$localized_data = array(
				'title'                      => __( 'Site Builder', 'astra-addon' ),
				'rest_url'                   => get_rest_url( '', '/astra-addon/v1/custom-layouts/' ),
				'new_custom_layout_base_url' => admin_url( 'post-new.php?post_type=astra-advanced-hook' ),
				'astra_pricing_page_url'     => 'https://wpastra.com/pricing/',
				'astra_docs_page_url'        => 'https://wpastra.com/docs/site-builder/',
				'admin_url'                  => admin_url(),
				'spectra_pro_url'            => 'https://wpspectra.com/pricing/',
				'uae_pro_url'                => 'https://ultimateelementor.com/pricing/',
				'show_notice_for'            => $this->show_theme_builder_notice(),
				'table_view_url'             => admin_url( 'edit.php?post_type=astra-advanced-hook&view=table-view' ),
				'nonce'                      => wp_create_nonce( 'wp_rest' ),
				'logo_url'                   => apply_filters( 'astra_admin_menu_icon', '' ),
				'white_labelled'             => isset( $white_labelled ) ? $white_labelled : false,
				'quick_view'                 => array(
					'url'              => admin_url( 'admin-ajax.php' ),
					'quick_view_nonce' => wp_create_nonce( 'astra-addon-quick-layout-view-nonce' ),
					'nonce'            => wp_create_nonce( 'astra-addon-enable-tgl-nonce' ),
				),
			);

			wp_localize_script( 'astra-theme-builder-script', 'astra_theme_builder', $localized_data );
			wp_set_script_translations( 'astra-theme-builder-script', 'astra-addon' );

			if ( ! get_post_type() ) {
				/**
				 * Here, only localize needed "astCustomLayout" compatible values when on Layout List page.
				 */
				wp_localize_script(
					'astra-theme-builder-script',
					'astCustomLayout',
					array(
						'userRoles'           => Astra_Target_Rules_Fields::get_user_selections(),
						'displayRules'        => Astra_Target_Rules_Fields::get_location_selections(),
						'singleDisplayRules'  => Astra_Target_Rules_Fields::get_location_selections( 'single' ),
						'archiveDisplayRules' => Astra_Target_Rules_Fields::get_location_selections( 'archive' ),
						'ajax_nonce'          => wp_create_nonce( 'astra-addon-get-posts-by-query' ),
					)
				);
			}
		}

		/**
		 * Admin Body Classes
		 *
		 * @since 4.5.0
		 * @param string $classes Space separated class string.
		 * @return void
		 */
		public function admin_body_class( $classes = '' ) {
			$theme_builder_class = isset( $_GET['page'] ) && 'theme-builder' === $_GET['page'] ? 'ast-theme-builder' : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Fetching a $_GET value, no nonce available to validate.
			$classes            .= ' ' . $theme_builder_class . ' ';

			return $classes;
		}

		/**
		 * Renders the admin settings.
		 *
		 * @since 4.5.0
		 * @return void
		 */
		public function render_theme_builder() {
			?>
				<div class="ast-tb-menu-page-wrapper">
					<div id="ast-tb-menu-page">
						<div class="ast-tb-menu-page-content">
							<div id="ast-tb-app-root" class="ast-tb-app-root"></div>
						</div>
					</div>
				</div>
			<?php
		}

		/**
		 * Setup menu.
		 *
		 * @since 4.5.0
		 * @return void
		 */
		public function setup_menu() {

			$is_astra_addon_active = Astra_Ext_Extension::is_active( 'advanced-hooks' );

			if ( $is_astra_addon_active ) {
				add_submenu_page(
					self::$plugin_slug,
					__( 'Site Builder', 'astra-addon' ),
					__( 'Site Builder', 'astra-addon' ),
					'manage_options',
					'theme-builder',
					array( $this, 'render_theme_builder' ),
					2
				);
			}
		}

		/**
		 * Register API routes.
		 *
		 * @since 4.5.0
		 * @return void
		 */
		public function register_routes() {
			register_rest_route(
				'astra-addon/v1',
				'custom-layouts',
				array(
					array(
						'methods'             => WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_custom_layouts' ),
						'permission_callback' => array( $this, 'get_permissions_check' ),
						'args'                => array(),
					),
					'schema' => array( $this, 'get_public_item_schema' ),
				)
			);

			register_rest_route(
				'astra-addon/v1',
				'custom-layouts/(?P<id>\d+)',
				array(
					'methods'             => WP_REST_Server::DELETABLE,
					'callback'            => array( $this, 'delete_custom_layout' ),
					'permission_callback' => array( $this, 'delete_permissions_check' ),
					'args'                => array(
						'id' => array(
							'validate_callback' => 'rest_validate_request_arg',
							'required'          => true,
							'type'              => 'integer',
						),
					),
				)
			);
		}

		/**
		 * Get Custom Layouts.
		 *
		 * @since 4.5.0
		 * @param WP_REST_Request $request Full details about the request.
		 * @return array $updated_option defaults + set DB option data.
		 */
		public function get_custom_layouts( $request ) {
			$custom_layouts = new WP_Query(
				array(
					'post_type'      => 'astra-advanced-hook',
					'orderby'        => 'ID',
					'post_status'    => array( 'publish', 'draft', 'private', 'pending', 'future' ),
					'posts_per_page' => -1,
				)
			);

			$results = array();

			foreach ( $custom_layouts->posts as $post ) {

				// Get the author information for each post
				$author_id = $post->post_author;
				$author    = get_userdata( $author_id );

				// Get the author's avatar URL
				$author_avatar_url = get_avatar_url( $author_id );

				// Generate the edit link manually
				$edit_post_link = admin_url( 'post.php?post=' . $post->ID . '&action=edit' );

				// Get the post preview link
				$post_preview_link = get_preview_post_link( $post );

				// Get the custom field values
				$layout_value  = get_post_meta( $post->ID, 'ast-advanced-hook-layout', true );
				$template_type = get_post_meta( $post->ID, 'ast-advanced-hook-template-type', true );
				$is_enabled    = get_post_meta( $post->ID, 'ast-advanced-hook-enabled', 'yes' );

				// Get the post preview link if type is template.
				$post_preview_link = $this->get_template_preview_link( $post, $post_preview_link, $layout_value, $template_type );

				$layout_data = array(
					'ID'             => $post->ID,
					'post_author'    => $post->post_author,
					'post_title'     => $post->post_title,
					'author_name'    => $author->display_name,
					'author_image'   => $author_avatar_url,
					'post_modified'  => date( 'Y-m-d', strtotime( $post->post_modified ) ),
					'post_name'      => $post->post_name,
					'post_status'    => $post->post_status,
					'post_link'      => $post_preview_link,
					'edit_post_link' => $edit_post_link,
					'layout_value'   => $layout_value,
					'template_type'  => $template_type,
					'enabled'        => $is_enabled,
				);

				$results[] = $layout_data;
			}

			return $results;
		}

		/**
		 * Check whether a given request has permission access route.
		 *
		 * @since 4.5.0
		 * @param  WP_REST_Request $request Full details about the request.
		 * @return WP_Error|bool
		 */
		public function get_permissions_check( $request ) {
			if ( ! current_user_can( 'edit_theme_options' ) ) {
				return new WP_Error( 'astra_rest_cannot_view', __( 'Sorry, you cannot list resources.', 'astra-addon' ), array( 'status' => rest_authorization_required_code() ) );
			}
			return true;
		}

		/**
		 * Delete custom layout
		 *
		 * @since 4.5.0
		 * @param  WP_REST_Request $request Full details about the request.
		 * @return WP_Error|bool
		 */
		public function delete_custom_layout( $request ) {
			$post_id = $request['id'];
			if ( get_post_status( $post_id ) ) {
				if ( ! current_user_can( 'delete_post', $post_id ) ) {
					wp_die( esc_html__( 'Sorry, you are not allowed to move this item to the Trash.', 'astra-addon' ) );
				}
				wp_trash_post( $post_id );
				return new WP_REST_Response( array( 'message' => 'Post deleted successfully' ), 200 );
			}

			return new WP_Error( 'post_not_found', 'Post not found', array( 'status' => 404 ) );
		}

		/**
		 * Check whether a given request has permission to delete route.
		 *
		 * @since 4.5.0
		 * @param  WP_REST_Request $request Full details about the request.
		 * @return WP_Error|bool
		 */
		public function delete_permissions_check( $request ) {
			$post_id = $request['id'];
			if ( current_user_can( 'delete_post', $post_id ) ) {
				return true;
			}

			return new WP_Error(
				'rest_forbidden',
				__( 'You do not have permission to delete this item.', 'astra-addon' ),
				array( 'status' => 403 )
			);
		}

		/**
		 * Determines which notice to show for Site Builder.
		 *
		 * @since 4.5.0
		 * @return string The required plugin name to show install notice for.
		 */
		public function show_theme_builder_notice() {
			$is_uagb_installed      = defined( 'UAGB_VER' );
			$is_spectra_pro         = defined( 'SPECTRA_PRO_VER' );
			$is_elementor_installed = defined( 'ELEMENTOR_VERSION' );
			$is_uael_installed      = defined( 'UAEL_VER' );

			if ( $is_uagb_installed && ! $is_spectra_pro ) {
				return 'spectra';
			}

			if ( $is_elementor_installed && ! $is_uael_installed ) {
				return 'uae_pro';
			}

			return '';
		}

		/**
		 * Redirect conditionally as per current page.
		 * Redirect to Site Builder create new page if user accessing create new custom layout page.
		 *
		 * @since 4.5.0
		 * @return void
		 */
		public function astra_theme_builder_redirect() {
			global $pagenow;
			$custom_layout_page = isset( $_GET['post_type'] ) && $_GET['post_type'] === 'astra-advanced-hook';
			if ( isset( $pagenow ) && 'post-new.php' === $pagenow && $custom_layout_page ) {
				if ( isset( $_GET['type'] ) ) {
					return;
				}
				wp_safe_redirect( admin_url( 'admin.php?page=theme-builder&path=create-new' ) );
				exit;
			}
		}

		/**
		 * Disable notices for Site Builder page.
		 *
		 * @since 4.5.0
		 * @return void
		 */
		public function astra_theme_builder_disable_notices() {

			if ( isset( $_GET['page'] ) && 'theme-builder' === $_GET['page'] ) {
				remove_all_actions( 'admin_notices' );
				remove_all_actions( 'all_admin_notices' );
			}
		}

		/**
		 * Gets the specific preview link for the template.
		 *
		 * @since 4.5.0
		 * @return string Preview link.
		 */
		public function get_template_preview_link( $post, $post_preview_link, $layout_value, $template_type ) {

			if ( 'template' === $layout_value ) {

				/**
				 * Get the display conditions.
				 * Based on the display conditions get the appropriate preview link.
				 * Return the preview link.
				 */

				$display_conditions = get_post_meta( $post->ID, 'ast-advanced-hook-location', true );

				if ( 'single' === $template_type ) {
					if ( isset( $display_conditions['rule'] ) ) {
						$display_rule = $display_conditions['rule'];
						if ( isset( $display_rule ) && isset( $display_rule[0] ) ) {
							$ruleParts = explode( '|', $display_rule[0] );
							if ( isset( $ruleParts ) && $ruleParts[0] ) {
								$pageValue = $ruleParts[0];
								if ( isset( $pageValue ) ) {
									if ( 'basic-global' === $pageValue || 'basic-singulars' === $pageValue ) {
										$pageValue = 'post';
									} elseif ( 'specifics' === $pageValue ) {
										$specific_post = $display_conditions['specific'];
										if ( isset( $specific_post ) && isset( $specific_post[0] ) ) {
											$specific_post = explode( '-', $specific_post[0] );
											if ( isset( $specific_post[1] ) ) {
												$specific_post_id = (int) $specific_post[1];
												$args             = array(
													'p' => $specific_post_id,
												);
												$specific_post    = get_posts( $args );
												if ( isset( $specific_post ) && isset( $specific_post[0] ) ) {
													$post_preview_link = get_preview_post_link( $specific_post[0]->ID );
												}
											}
										}
									} else {
										$args        = array(
											'posts_per_page' => 1,
											'orderby'   => 'rand',
											'post_type' => $pageValue,
										);
										$random_post = get_posts( $args );
										if ( isset( $random_post ) && isset( $random_post[0] ) ) {
											$post_preview_link = get_preview_post_link( $random_post[0]->ID );
										}
									}
								}
							}
						}
					}
				} elseif ( 'archive' === $template_type ) {
					$display_rule = isset( $display_conditions['rule'] ) ? $display_conditions['rule'] : array();
					if ( isset( $display_rule ) && isset( $display_rule[0] ) ) {
						$display_rule = $display_rule[0];

						if ( 'basic-global' === $display_rule || 'basic-archives' === $display_rule || 'special-blog' === $display_rule ) {

							// URL for the entire site
							$post_preview_link = home_url();
						} elseif ( 'special-404' === $display_rule ) {

							// URL for the 404 Page
							$post_preview_link = home_url( '/hshsh' );
						} elseif ( 'special-search' === $display_rule ) {

							// URL for the Search Page
							$post_preview_link = home_url( '/?s=' );
						} elseif ( 'special-front' === $display_rule ) {

							// URL for the Front Page
							$post_preview_link = home_url();
						} elseif ( 'special-date' === $display_rule ) {

							// URL for the Date Archive
							$year  = date( 'Y' );
							$month = date( 'm' );
							if ( isset( $year ) && isset( $month ) ) {
								$post_preview_link = get_month_link( $year, $month );
							} else {
								$post_preview_link = get_preview_post_link( $post );
							}
						} elseif ( 'special-author' === $display_rule ) {

							// URL for the Author Archive
							$author_id = 1;
							$author    = get_userdata( $author_id );
							if ( isset( $author ) ) {
								$author_slug       = $author->user_nicename;
								$post_preview_link = home_url( '/author/' . $author_slug );
							} else {
								$post_preview_link = get_preview_post_link( $post );
							}
						} elseif ( 'post|all|archive' === $display_rule ) {

							// URL for All Posts Archive
							$post_preview_link = get_post_type_archive_link( 'post' );
						} elseif ( 'post|all|taxarchive|category' === $display_rule ) {

							// URL for All Categories Archive
							$categories = get_categories( array( 'number' => 1 ) );
							if ( ! empty( $categories ) ) {
								$category_slug     = $categories[0]->slug;
								$post_preview_link = get_term_link( $category_slug, 'category' );
							}
						} elseif ( 'post|all|taxarchive|post_tag' === $display_rule ) {

							// URL for All Tags Archive
							$tags = get_tags( array( 'number' => 1 ) );
							if ( ! empty( $tags ) ) {
								$tag_slug          = $tags[0]->slug;
								$post_preview_link = get_term_link( $tag_slug, 'post_tag' );
							}
						}
					}
				}
			}

			return $post_preview_link;
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Addon_Theme_Builder::get_instance();
