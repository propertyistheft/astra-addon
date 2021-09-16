<?php
/**
 * Astra Advanced Headers Bar Post Meta Box
 *
 * @package   Astra Pro
 */

if ( ! class_exists( 'Astra_Ext_Advanced_Headers_Meta' ) ) {

	/**
	 * Meta Boxes setup
	 */
	class Astra_Ext_Advanced_Headers_Meta {


		/**
		 * Instance
		 *
		 * @var $instance
		 */
		private static $instance;

		/**
		 * Meta Option
		 *
		 * @var $meta_option
		 */
		private static $meta_option;

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
		 * Constructor
		 */
		public function __construct() {
			add_action( 'admin_head', array( $this, 'menu_highlight' ) );
			add_action( 'load-post.php', array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
			add_action( 'astra_adv_headers_tabs_page-header_action', array( $this, 'page_header_tab' ), 10, 1 );

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				add_action( 'astra_adv_headers_tabs_site-header_action', array( $this, 'hfb_site_header_tab' ), 10, 1 );
			} else {
				add_action( 'astra_adv_headers_tabs_site-header_action', array( $this, 'site_header_tab' ), 10, 1 );
			}

			add_action( 'astra_adv_headers_tabs_display-rules_action', array( $this, 'display_rules_tab' ), 10, 1 );
			add_action( 'astra_advanced_headers_settings_markup_after', array( $this, 'current_tab_holder' ) );
			add_filter( 'redirect_post_location', array( $this, 'retain_currnt_tab' ) );
		}

		/**
		 * Add a hidden field in the Advanced Headers meta box for holding the current tab id.
		 *
		 * @return void
		 */
		public function current_tab_holder() {
			?>
				<input type="hidden" id="advanced-headers-current-tab" name="advanced-headers-current-tab">
				<?php wp_nonce_field( 'advanced_header_post_update', 'advanced_header_post_update' ); ?>
			<?php
		}

		/**
		 * Add query arg for the current tab.
		 * This is only added if we are on the 'astra_adv_header' post type edit screen.
		 *
		 * @since  1.0.0
		 * @param  String $location URL where the page is redirected after post is saved.
		 *
		 * @return String           Redirect URL with the added query arg for the current tab.
		 */
		public function retain_currnt_tab( $location ) {

			// bail early if we are on any different post type.
			if ( 'astra_adv_header' !== get_post_type() || ! is_admin() ) {
				return $location;
			}

			if ( isset( $_POST['advanced_header_post_update'] ) && wp_verify_nonce( $_POST['advanced_header_post_update'], 'advanced_header_post_update' ) ) {

				$current_tab = isset( $_POST['advanced-headers-current-tab'] ) ? esc_attr( $_POST['advanced-headers-current-tab'] ) : '';

				if ( '' !== $current_tab ) {
					$location = add_query_arg(
						array(
							'current-tab' => $current_tab,
						),
						$location
					);
				}
			}

			return $location;
		}

		/**
		 * Keep the Astra menu open when editing the advanced headers.
		 * Highlights the wanted admin (sub-) menu items for the CPT.
		 *
		 * @since  1.0.0
		 */
		public function menu_highlight() {
			global $parent_file, $submenu_file, $post_type;
			if ( 'astra_adv_header' == $post_type ) :
				$parent_file  = 'themes.php'; // phpcs:ignoreFile WordPress.WP.GlobalVariablesOverride.Prohibited
				$submenu_file = 'edit.php?post_type=astra_adv_header'; // phpcs:ignoreFile WordPress.WP.GlobalVariablesOverride.Prohibited

				/* Same display rule assign notice */
				$option = array(
					'location'  => 'ast-advanced-headers-location',
					'exclusion' => 'ast-advanced-headers-exclusion',
					'users'     => 'ast-advanced-headers-users',
				);
				Astra_Target_Rules_Fields::same_display_on_notice( 'astra_adv_header', $option );
			endif;

		}


		/**
		 *  Init Metabox
		 */
		public function init_metabox() {
			add_action( 'add_meta_boxes', array( $this, 'setup_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_meta_box' ) );

			$default_above_header = $this->get_default_header_sections( 'above-header-layout' );
			$default_below_header = $this->get_default_header_sections( 'below-header-layout' );
			/**
			 * Set metabox options
			 *
			 * @see https://php.net/manual/en/filter.filters.sanitize.php
			 */
			self::$meta_option = apply_filters(
				'astra_advanced_headers_meta_box_options',
				array(
					'ast-advanced-headers-layout'    => array(
						'default'  => array(
							'layout'                     => 'advanced-headers-layout-2',
							'breadcrumb'                 => '',
							'force-transparent-disabled' => 'yes',
							'above-header-enabled'       => $default_above_header,
							'below-header-enabled'       => $default_below_header,
						),
						'sanitize' => 'FILTER_DEFAULT',
					),
					'ast-advanced-headers-design'    => array(
						'default'  => array(
							'title-color'                  => '#ffffff',
							'b-text-color'                 => '',
							'b-link-color'                 => '',
							'b-link-hover-color'           => '',
							'background-color'             => 'rgba(44,62,80,0.50)',
							'bg-image-id'                  => '',
							'bg-image'                     => '',
							'page-post-featured'           => 'enabled',
							'logo-id'                      => '',
							'logo-url'                     => '',
							'retina-logo-id'               => '',
							'retina-logo-url'              => '',
							'header-logo-width'            => '',
							'header-bg-color'              => '',
							'site-title-color'             => '',
							'site-title-h-color'           => '',
							'site-tagline-color'           => '',
							'primary-menu-bg-color'        => '',
							'primary-menu-color'           => '',
							'primary-menu-h-color'         => '',
							'primary-menu-a-color'         => '',
							'primary-submenu-bg-color'     => '',
							'primary-submenu-color'        => '',
							'primary-submenu-h-color'      => '',
							'primary-submenu-a-color'	   => '',

							'above-header-bg-color'        => '',
							'above-header-text-link-color' => '',
							'above-header-h-color'         => '',
							'above-header-a-color'         => '',
							'above-header-submenu-bg-color' => '',
							'above-header-submenu-link-color' => '',
							'above-header-submenu-h-color' => '',
							'above-header-submenu-a-color' => '',

							'below-header-bg-color'        => '',
							'below-header-text-link-color' => '',
							'below-header-h-color'         => '',
							'below-header-a-color'         => '',
							'below-header-submenu-bg-color'=> '',
							'below-header-submenu-link-color' => '',
							'below-header-submenu-h-color' => '',
							'below-header-submenu-a-color' => '',

							'header-main-sep'              => '',
							'header-main-sep-color'        => '',
							'bg-size'                      => 'custom-bg-size',
							'bg-custom-size-top-padding'   => '5',
							'bg-custom-size-bottom-padding' => '5',
							'parallax-device'              => 'none',
							'overlay-bg-color'             => '',
							'custom-menu'                  => '',
							'custom-menu-item'             => 'default',
							'custom-menu-item-outside'     => '',
							'custom-menu-item-text-html'   => '',
							'search-style'                 => 'default',
						),
						'sanitize' => 'FILTER_DEFAULT',
					),
					'ast-advanced-headers-location'  => array(
						'default'  => array(),
						'sanitize' => 'FILTER_DEFAULT',
					),
					'ast-advanced-headers-exclusion' => array(
						'default'  => array(),
						'sanitize' => 'FILTER_DEFAULT',
					),
					'ast-advanced-headers-users'     => array(
						'default'  => array(),
						'sanitize' => 'FILTER_DEFAULT',
					),
				)
			);
		}

		/**
		 *  Setup Metabox
		 */
		public function setup_meta_box() {

			// Get all posts.
			$post_types = get_post_types();

			if ( 'astra_adv_header' == get_post_type() ) {
				// Enable for all posts.
				foreach ( $post_types as $type ) {

					if ( 'attachment' !== $type ) {
						add_meta_box(
							'astra_advanced_headers_settings',              // Id.
							__( 'Page Headers Settings', 'astra-addon' ), // Title.
							array( $this, 'markup_meta_box' ),    // Callback.
							$type,                                // Post_type.
							'normal',                               // Context.
							'default'                             // Priority.
						);
					}
				}
			}
		}

		/**
		 * Get metabox options
		 */
		public static function get_meta_option() {
			return self::$meta_option;
		}

		/**
		 * Get Default Header enabled sections
		 *
		 * @param string $header_section header section key.
		 * @return string $section enabled | ''.
		 */
		public function get_default_header_sections( $header_section ) {

			$section        = '';
			$section_option = astra_get_option( $header_section );
			if ( Astra_Ext_Extension::is_active( 'header-sections' ) && 'disabled' != $section_option ) {
				$section = 'enabled';
			}

			return $section;
		}

		/**
		 * Metabox Markup
		 *
		 * @param  object $post Post object.
		 *
		 * @return void
		 */
		public function markup_meta_box( $post ) {

			wp_nonce_field( basename( __FILE__ ), 'astra-advanced-headers' );
			$stored = get_post_meta( $post->ID );

			$advanced_headers_meta = array(
				'ast-advanced-headers-layout',
				'ast-advanced-headers-design',
				'ast-advanced-headers-location',
				'ast-advanced-headers-exclusion',
				'ast-advanced-headers-users',
			);

			// Set stored and override defaults.
			foreach ( $stored as $key => $value ) {
				if ( in_array( $key, $advanced_headers_meta ) ) {
					self::$meta_option[ $key ]['default'] = ( isset( $stored[ $key ][0] ) ) ? maybe_unserialize( $stored[ $key ][0] ) : '';
				} else {
					self::$meta_option[ $key ]['default'] = ( isset( $stored[ $key ][0] ) ) ? $stored[ $key ][0] : '';
				}
			}

			// Get defaults.
			$meta = self::get_meta_option();

			$default_above_header = $this->get_default_header_sections( 'above-header-layout' );
			$default_below_header = $this->get_default_header_sections( 'below-header-layout' );

			/**
			 * Get options
			 */
			$ast_advanced_headers_layout = ( isset( $meta['ast-advanced-headers-layout']['default'] ) ) ? $meta['ast-advanced-headers-layout']['default'] : array(
				'layout'                     => 'advanced-headers-layout-2',
				'breadcrumb'                 => '',
				'force-transparent-disabled' => 'yes',
				'above-header-enabled'       => $default_above_header,
				'below-header-enabled'       => $default_below_header,
			);
			$ast_advanced_headers_design = ( isset( $meta['ast-advanced-headers-design']['default'] ) ) ? $meta['ast-advanced-headers-design']['default'] : array(
				'title-color'                   => '#ffffff',
				'b-text-color'                  => '',
				'b-link-color'                  => '',
				'b-link-hover-color'            => '',
				'background-color'              => 'rgba(44,62,80,0.50)',
				'bg-image-id'                   => '',
				'bg-image'                      => '',
				'page-post-featured'            => 'enabled',
				'logo-id'                       => '',
				'logo-url'                      => '',
				'retina-logo-id'                => '',
				'retina-logo-url'               => '',
				'header-logo-width'             => '',
				'header-bg-color'               => '',
				'site-title-color'              => '',
				'site-title-h-color'            => '',
				'site-tagline-color'            => '',
				'primary-menu-bg-color'         => '',
				'primary-menu-color'            => '',
				'primary-menu-h-color'          => '',
				'primary-menu-a-color'          => '',
				'primary-submenu-bg-color'      => '',
				'primary-submenu-color'         => '',
				'primary-submenu-h-color'       => '',
				'primary-submenu-a-color'		=> '',

				'above-header-bg-color'         => '',
				'above-header-text-link-color'  => '',
				'above-header-h-color'          => '',
				'above-header-a-color'         => '',
				'above-header-submenu-bg-color' => '',
				'above-header-submenu-link-color' => '',
				'above-header-submenu-h-color' => '',
				'above-header-submenu-a-color' => '',

				'below-header-bg-color'         => '',
				'below-header-text-link-color'  => '',
				'below-header-h-color'          => '',
				'below-header-a-color'         => '',
				'below-header-submenu-bg-color'=> '',
				'below-header-submenu-link-color' => '',
				'below-header-submenu-h-color' => '',
				'below-header-submenu-a-color' => '',

				'header-main-sep'               => '',
				'header-main-sep-color'         => '',
				'bg-size'                       => 'custom-bg-size',
				'bg-custom-size-top-padding'    => '5',
				'bg-custom-size-bottom-padding' => '5',
				'parallax-device'               => 'none',
				'overlay-bg-color'              => '',
				'custom-menu'                   => '',
				'custom-menu-item'              => 'default',
				'custom-menu-item-outside'      => '',
				'custom-menu-item-text-html'    => '',
				'search-style'                  => 'default',
			);

			$display_locations = ( isset( $meta['ast-advanced-headers-location']['default'] ) ) ? $meta['ast-advanced-headers-location']['default'] : '';
			$exclude_locations = ( isset( $meta['ast-advanced-headers-exclusion']['default'] ) ) ? $meta['ast-advanced-headers-exclusion']['default'] : '';
			$user_roles        = ( isset( $meta['ast-advanced-headers-users']['default'] ) ) ? $meta['ast-advanced-headers-users']['default'] : '';

			// settings added after published/updated the meta.
			$unsaved_array           = array();
			$independent_addon_array = array(
				'site-title-color'             => '',
				'site-title-h-color'           => '',
				'site-tagline-color'           => '',

				'above-header-bg-color'        => '',
				'above-header-text-link-color' => '',
				'above-header-h-color'         => '',
				'above-header-a-color'         => '',
				'above-header-submenu-bg-color' => '',
				'above-header-submenu-link-color' => '',
				'above-header-submenu-h-color' => '',
				'above-header-submenu-a-color' => '',

				'below-header-bg-color'        => '',
				'below-header-text-link-color' => '',
				'below-header-h-color'         => '',
				'below-header-a-color'         => '',
				'below-header-submenu-bg-color'=> '',
				'below-header-submenu-link-color' => '',
				'below-header-submenu-h-color' => '',
				'below-header-submenu-a-color' => '',

				'custom-menu-item'             => '',
			);

			foreach ( $independent_addon_array as $key => $value ) {
				// key not exist then set a key to existing unsaved array.
				if ( ! isset( $ast_advanced_headers_design[ $key ] ) ) {
					$unsaved_array[ $key ] = $value;
				}
			}
			// Merge array if new key added after updated/published.
			$ast_advanced_headers_design = array_merge( $ast_advanced_headers_design, $unsaved_array );

			$ast_advanced_headers = array(
				'layouts'           => $ast_advanced_headers_layout,
				'designs'           => $ast_advanced_headers_design,
				'include_locations' => $display_locations,
				'exclude_locations' => $exclude_locations,
				'user_roles'        => $user_roles,
			);
			do_action( 'astra_advanced_headers_settings_markup_before', $meta );

			?>

			<!-- Advanced Headers Tabs -->
			<div id="ast-advanced-headers-tabs">
				<div class="nav-tab-wrapper">
					<ul>
						<?php
						$actions      = array(
							'page-header'   => array(
								'label' => __( 'Page Header', 'astra-addon' ),
								'show'  => ! is_network_admin(),
							),
							'site-header'   => array(
								'label' => __( 'Site Header', 'astra-addon' ),
								'show'  => ! is_network_admin(),
							),
							'display-rules' => array(
								'label' => __( 'Display Rules', 'astra-addon' ),
								'show'  => ! is_network_admin(),
							),
						);
						$view_actions = apply_filters( 'astra_adv_headers_tab_options', $actions );

						$count = 0;
						foreach ( $view_actions as $slug => $data ) {

							if ( ! $data['show'] ) {
								continue;
							}

							$class       = '';
							$current_tab = isset( $_GET['current-tab'] ) ? esc_attr( $_GET['current-tab'] ) : '';

							if ( '' != $current_tab && 'ast-adv-headers-tab-' . esc_attr( $slug ) == $current_tab ) {
								$class = 'nav-tab-active';
							} elseif ( '' == $current_tab && esc_attr( $slug ) == 'page-header' ) {
								$class = 'nav-tab-active';
							}

							?>
							<li><a class='nav-tab <?php echo esc_attr( $class ); ?>'
								href='#ast-adv-headers-<?php echo esc_attr( $slug ); ?>'
								id='ast-adv-headers-tab-<?php echo esc_attr( $slug ); ?>'> <?php echo esc_html( $data['label'] ); ?> </a>
							</li>
							<?php
							$count ++;
						}
						?>
					</ul>
				</div><!-- .nav-tab-wrapper -->

				<?php
				$count = 0;
				foreach ( $view_actions as $slug => $data ) {

					if ( ! $data['show'] ) {
						continue;
					}
					$class = '';

					if ( '' != $current_tab && 'ast-adv-headers-tab-' . esc_attr( $slug ) == $current_tab ) {
						$class = 'tab-active';
					} elseif ( '' == $current_tab && esc_attr( $slug ) == 'page-header' ) {
						$class = 'tab-active';
					}

					?>
					<div id='ast-adv-headers-<?php echo esc_attr( $slug ); ?>' class="ast-adv-headers-tabs-section <?php echo esc_attr( $class ); ?>" >
						<!-- Advanced Headers Tabs -->
						<?php do_action( 'astra_adv_headers_tabs_' . esc_attr( $slug ) . '_action', $ast_advanced_headers ); ?>
					</div>
					<?php
					$count ++;
				}
				?>
			</div> <!-- #ast-advanced-headers-tabs -->


			<?php
			do_action( 'astra_advanced_headers_settings_markup_after', $meta );
		}

		/**
		 * Metabox Save
		 *
		 * @param  number $post_id Post ID.
		 *
		 * @return void
		 */
		public function save_meta_box( $post_id ) {

			// Checks save status.
			$is_autosave = wp_is_post_autosave( $post_id );
			$is_revision = wp_is_post_revision( $post_id );

			$is_valid_nonce = ( isset( $_POST['astra-advanced-headers'] ) && wp_verify_nonce( $_POST['astra-advanced-headers'], basename( __FILE__ ) ) ) ? true : false;

			// Exits script depending on save status.
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			/**
			 * Get meta options
			 */
			$post_meta             = self::get_meta_option();
			$advanced_headers_meta = array(
				'ast-advanced-headers-layout',
				'ast-advanced-headers-design',
			);

			foreach ( $post_meta as $key => $data ) {
				if ( in_array( $key, $advanced_headers_meta ) ) {
					$meta_value = array_map( 'esc_attr', $_POST[ $key ] );
					$meta_value = array_map( 'stripslashes', $_POST[ $key ] );
				} elseif ( in_array( $key, array( 'ast-advanced-headers-users' ) ) ) {
					$index = array_search( '', $_POST[ $key ] );
					if ( false !== $index ) {
						unset( $_POST[ $key ][ $index ] );
					}
					$meta_value = array_map( 'esc_attr', $_POST[ $key ] );
					$meta_value = array_map( 'stripslashes', $_POST[ $key ] );
				} elseif ( in_array(
					$key,
					array(
						'ast-advanced-headers-location',
						'ast-advanced-headers-exclusion',
					)
				) ) {
						$meta_value = Astra_Target_Rules_Fields::get_format_rule_value( $_POST, $key );
				} else {
					// Sanitize values.
					$sanitize_filter = ( isset( $data['sanitize'] ) ) ? $data['sanitize'] : 'FILTER_DEFAULT';

					switch ( $sanitize_filter ) {

						case 'FILTER_SANITIZE_STRING':
							$meta_value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_STRING );
							break;

						case 'FILTER_SANITIZE_URL':
							$meta_value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_URL );
							break;

						case 'FILTER_SANITIZE_NUMBER_INT':
							$meta_value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_NUMBER_INT );
							break;

						default:
							$meta_value = filter_input( INPUT_POST, $key, FILTER_DEFAULT );
							break;
					}
				}

				// Store values.
				if ( $meta_value ) {
					update_post_meta( $post_id, $key, $meta_value );
				} else {
					delete_post_meta( $post_id, $key );
				}
			}

			$logo_id = sanitize_key( $_POST['ast-advanced-headers-design']['logo-id'] );
			if ( '' != $logo_id ) {
				self::generate_logo_by_width( $logo_id );
			}
		}

		/**
		 * Markup for the Page Header Tab.
		 *
		 * @since  1.0.0
		 *
		 * @param  array $options Post meta.
		 */
		public function page_header_tab( $options ) {
			$layout     = $options['layouts'];
			$design     = $options['designs'];
			$layout_opt = isset( $layout['layout'] ) ? $layout['layout'] : '';
			?>
			<table class="ast-advanced-headers-table widefat">
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading">
						<label><?php esc_html_e( 'Layout', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content ast-advanced-header-layout-radio-button-wrap">
						<!-- Layout Radio Images -->
						<label
							for="ast-advanced-headers-layout-2" <?php checked( 'advanced-headers-layout-2', $layout_opt ); ?> class="ast-advanced-headers-heading-img-help">
							<input type="radio" name="ast-advanced-headers-layout[layout]"
									id="ast-advanced-headers-layout-2"
									value="advanced-headers-layout-2"<?php checked( 'advanced-headers-layout-2', $layout_opt ); ?> />
							<img
								src="<?php echo esc_url( ASTRA_EXT_ADVANCED_HEADERS_URL . 'assets/images/advanced-header-1-77x48.png' ); ?>"
								alt="<?php echo esc_attr__( 'Page Header: Center Aligned', 'astra-addon' ); ?>"
								title="<?php echo esc_attr__( 'Page Header: Center Aligned', 'astra-addon' ); ?>" />
						</label>
						<label
							for="ast-advanced-headers-layout-1" <?php checked( 'advanced-headers-layout-1', $layout_opt ); ?> class="ast-advanced-headers-heading-img-help">
							<input type="radio" name="ast-advanced-headers-layout[layout]"
									id="ast-advanced-headers-layout-1"
									value="advanced-headers-layout-1"<?php checked( 'advanced-headers-layout-1', $layout_opt ); ?> />
							<img
								src="<?php echo esc_url( ASTRA_EXT_ADVANCED_HEADERS_URL . 'assets/images/advanced-header-2-77x48.png' ); ?>"
								alt="<?php echo esc_attr__( 'Page Header: Inline', 'astra-addon' ); ?>"
								title="<?php echo esc_attr__( 'Page Header: Inline', 'astra-addon' ); ?>" />
						</label>
						<label
							for="ast-advanced-header-layout-disable" <?php checked( 'disable', $layout_opt ); ?> class="ast-advanced-headers-heading-img-help" >
							<input type="radio" name="ast-advanced-headers-layout[layout]"
									id="ast-advanced-header-layout-disable"
									value="disable"<?php checked( 'disable', $layout_opt ); ?> />
							<img
								src="<?php echo esc_url( ASTRA_EXT_ADVANCED_HEADERS_URL . 'assets/images/disabled-77x48.png' ); ?>"
								alt="<?php echo esc_attr__( 'No Page Header', 'astra-addon' ); ?>"
								title="<?php echo esc_attr__( 'No Page Header', 'astra-addon' ); ?>" />
						</label>

					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-advanced-header-layout-breadcrumb-wrap">
					<td class="ast-advanced-headers-row-heading">
						<label><?php esc_html_e( 'Display Breadcrumb', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="checkbox" id="ast-advanced-header-layout-breadcrumb"
								name="ast-advanced-headers-layout[breadcrumb]"
								value="enabled" <?php checked( isset( $layout['breadcrumb'] ) ? $layout['breadcrumb'] : '', 'enabled' ); ?> />
					</td>
				</tr>
			</table>
			<!-- Design -->
			<table class="ast-advanced-headers-table design-wrap widefat">
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading title">
						<label><?php esc_html_e( 'Title', 'astra-addon' ); ?></label>
					</td>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Text Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
								name="ast-advanced-headers-design[title-color]"
								value="<?php echo esc_attr( $design['title-color'] ); ?>" />
					</td>
				</tr>
				<tr class="ast-advanced-headers-row breadcrumb-row">
					<td class="ast-advanced-headers-row-heading title">
						<label><?php esc_html_e( 'Breadcrumb', 'astra-addon' ); ?></label>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row breadcrumb-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Text Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
								name="ast-advanced-headers-design[b-text-color]"
								value="<?php echo esc_attr( $design['b-text-color'] ); ?>" />
					</td>
				</tr>
				<tr class="ast-advanced-headers-row breadcrumb-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Link Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
								name="ast-advanced-headers-design[b-link-color]"
								value="<?php echo esc_attr( $design['b-link-color'] ); ?>" />
					</td>
				</tr>

				<tr class="ast-advanced-headers-row breadcrumb-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Link Hover Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
								name="ast-advanced-headers-design[b-link-hover-color]"
								value="<?php echo esc_attr( $design['b-link-hover-color'] ); ?>" />
					</td>
				</tr>

				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading title">
						<label><?php esc_html_e( 'Size ', 'astra-addon' ); ?></label>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Background Size', 'astra-addon' ); ?></label>
						<i class="ast-advanced-headers-heading-help dashicons dashicons-editor-help"
							title="<?php echo esc_attr__( 'Custom Size can be given any positive number with or without units as "5" or "5px". Default unit is "%"', 'astra-addon' ); ?>"></i>
					</td>
					<td class="ast-advanced-headers-row-content">
						<select name="ast-advanced-headers-design[bg-size]" id="ast-advanced-header-design-bg-size"
								style="width:210px;">
							<option
								value="custom-bg-size" <?php selected( $design['bg-size'], 'custom-bg-size' ); ?> > <?php esc_html_e( 'Custom Size', 'astra-addon' ); ?></option>
							<option
								value="full-screen" <?php selected( $design['bg-size'], 'full-screen' ); ?> > <?php esc_html_e( 'Full screen', 'astra-addon' ); ?></option>
						</select>
						<div class="ast-advanced-haeders-design-bg-custom-size-wrap">
							<input type="text" name="ast-advanced-headers-design[bg-custom-size-top-padding]"
									id="ast-advanced-haeders-design-bg-custom-size-top-padding"
									value="<?php echo esc_attr( $design['bg-custom-size-top-padding'] ); ?>"
									placeholder="<?php echo esc_attr( $design['bg-custom-size-top-padding'] ); ?>"
									style="width:110px;"/>
							<label for="ast-advanced-haeders-design-bg-custom-size-top-padding"><?php esc_html_e( 'Top Padding', 'astra-addon' ); ?></label>
							<br><input type="text" name="ast-advanced-headers-design[bg-custom-size-bottom-padding]"
									id="ast-advanced-haeders-design-bg-custom-size-bottom-padding"
									value="<?php echo esc_attr( $design['bg-custom-size-bottom-padding'] ); ?>"
									placeholder="<?php echo esc_attr( $design['bg-custom-size-bottom-padding'] ); ?>"
									style="width:110px;"/>
							<label
								for="ast-advanced-haeders-design-bg-custom-size-bottom-padding"><?php esc_html_e( 'Bottom Padding', 'astra-addon' ); ?></label>
						</div>

					</td>
				</tr>


				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading title">
						<label><?php esc_html_e( 'Background ', 'astra-addon' ); ?></label>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true" data-rgba="true"
								name="ast-advanced-headers-design[background-color]"
								value="<?php echo esc_attr( $design['background-color'] ); ?>" />
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Image', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<div id="ast-advanced-headers-preview-img">
							<?php if ( isset( $design['bg-image'] ) && '' != $design['bg-image'] ) { ?>
								<img class="ast-advanced-headers-bg-image saved-image"
									src="<?php echo esc_url( $design['bg-image'] ); ?>" width="150"
									style="margin-bottom:12px;"/>
							<?php } ?>
						</div>
						<input type="hidden" id="ast-advanced-headers-bg-image-id"
								class="ast-advanced-headers-bg-image-id" name="ast-advanced-headers-design[bg-image-id]"
								value="<?php echo esc_attr( $design['bg-image-id'] ); ?>"/>
						<input type="hidden" id="ast-advanced-headers-bg-image" class="ast-advanced-headers-bg-image"
								name="ast-advanced-headers-design[bg-image]"
								value="<?php echo esc_attr( $design['bg-image'] ); ?>"/>

						<a class="ast-advanced-headers-bg-image-select button-secondary"
							href="#"><?php esc_html_e( 'Select Image', 'astra-addon' ); ?></a>
						<?php
						// Remove button based on image is selected or not.
						$remove_button = ( isset( $design['bg-image'] ) && '' != $design['bg-image'] ) ? 'display:inline-block' : 'display:none';
						?>
						<button class="ast-advanced-headers-bg-image-remove button" type="button"
								style="<?php echo esc_attr( $remove_button ); ?>">
							<?php esc_html_e( 'Remove Image', 'astra-addon' ); ?>
						</button>
						<br><br>
						<input type="checkbox" id="ast-advanced-header-page-post-featured"
								name="ast-advanced-headers-design[page-post-featured]"
								value="enabled" <?php checked( isset( $design['page-post-featured'] ) ? $design['page-post-featured'] : '', 'enabled' ); ?> />

						<label for="ast-advanced-header-page-post-featured">
							<?php esc_html_e( 'Override this image with the featured image on individual posts & pages. ', 'astra-addon' ); ?>
						</label>

						<br><br>
						<input type="checkbox" id="ast-advanced-header-overlay-bg-color"
								name="ast-advanced-headers-design[overlay-bg-color]"
								value="enabled" <?php checked( isset( $design['overlay-bg-color'] ) ? $design['overlay-bg-color'] : '', 'enabled' ); ?> />

						<label for="ast-advanced-header-overlay-bg-color">
							<?php esc_html_e( 'Overlay Background Color', 'astra-addon' ); ?>
						</label>

					</td>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Parallax', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<!-- Deprecated checkbox to enable Parallax effect, this is now replaced by select box to enable parallax effect on responsive devices from version 2.3.0 This option should be removed after 4 major updates. -->
						<input type="hidden" name="ast-advanced-headers-design[parallax]"
								value="<?php echo esc_attr( ( 'none' !== $design['parallax-device'] ) ? 'enabled' : '' ); ?>" />
						<select name="ast-advanced-headers-design[parallax-device]" id="ast-advanced-header-design-parallax-device"
								style="width:210px;">
							<option value="none" <?php selected( $design['parallax-device'], 'none' ); ?> > <?php esc_html_e( 'None', 'astra-addon' ); ?></option>
							<option value="both" <?php selected( $design['parallax-device'], 'both' ); ?> > <?php esc_html_e( 'Desktop + Mobile', 'astra-addon' ); ?></option>
							<option value="desktop" <?php selected( $design['parallax-device'], 'desktop' ); ?> > <?php esc_html_e( 'Desktop', 'astra-addon' ); ?></option>
							<option value="mobile" <?php selected( $design['parallax-device'], 'mobile' ); ?> > <?php esc_html_e( 'Mobile', 'astra-addon' ); ?></option>
						</select>
					</td>
				</tr>
			</table>
			<?php
		}

		/**
		 * Markup for Site Header Tabs
		 *
		 * @since  1.0.0
		 *
		 * @param  array $options Post meta.
		 */
		public function site_header_tab( $options ) {
			$layout = $options['layouts'];
			$design = $options['designs'];

			?>
			<table class="ast-advanced-headers-table widefat ast-required-advanced-headers">
				<tr class="ast-advanced-headers-row ast-advanced-header-layout-merge-wrap">
					<td class="ast-advanced-headers-row-heading">
						<label><?php esc_html_e( 'Merge Page Header with Site Header', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="checkbox" id="ast-advanced-header-layout-merged"
								name="ast-advanced-headers-layout[merged]"
								value="enabled" <?php checked( isset( $layout['merged'] ) ? $layout['merged'] : '', 'enabled' ); ?> />
					</td>
				</tr>
			</table>

			<table class="ast-advanced-headers-table require-merge-ast-advanced-header widefat">
				<!-- Site Identity  -->
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading title">
						<label><?php esc_html_e( 'Site Identity', 'astra-addon' ); ?></label>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row diff-logo-wrap">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Different Logo for Page Header?', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="checkbox" id="ast-advanced-header-diff-header-logo"
								name="ast-advanced-headers-layout[diff-header-logo]"
								value="enabled" <?php checked( isset( $layout['diff-header-logo'] ) ? $layout['diff-header-logo'] : '', 'enabled' ); ?> />
					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-logo-settings-wrap">

					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Logo', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<div id="ast-advanced-headers-preview-logo">
							<?php if ( isset( $design['logo-url'] ) && '' != $design['logo-url'] ) { ?>
								<img class="ast-advanced-headers-logo saved-image"
									src="<?php echo esc_url( $design['logo-url'] ); ?>"
									style="margin-bottom:12px;max-width:150px;"/>
							<?php } ?>
						</div>
						<input type="hidden" id="ast-advanced-headers-logo-id" class="ast-advanced-headers-logo-id"
								name="ast-advanced-headers-design[logo-id]"
								value="<?php echo esc_attr( $design['logo-id'] ); ?>"/>
						<input type="hidden" id="ast-advanced-headers-logo" class="ast-advanced-headers-logo"
								name="ast-advanced-headers-design[logo-url]"
								value="<?php echo esc_attr( $design['logo-url'] ); ?>"/>

						<a class="ast-advanced-header-logo-select button-secondary"
							href="#"><?php esc_html_e( 'Select logo', 'astra-addon' ); ?></a>
						<?php
						// Remove button based on image is selected or not.
						$remove_logo_button = ( isset( $design['logo-url'] ) && '' != $design['logo-url'] ) ? 'display:inline-block;' : 'display:none;';
						?>
						<button class="ast-advanced-headers-logo-remove button" type="button"
								style="<?php echo esc_attr( $remove_logo_button ); ?>">
							<?php esc_html_e( 'Remove Logo', 'astra-addon' ); ?>
						</button>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-diff-header-retina-logo">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Different Logo for retina devices?', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="checkbox" id="ast-advanced-header-diff-header-retina-logo"
								name="ast-advanced-headers-layout[diff-header-retina-logo]"
								value="enabled" <?php checked( isset( $layout['diff-header-retina-logo'] ) ? $layout['diff-header-retina-logo'] : '', 'enabled' ); ?> />
					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-retina-logo-settings-wrap">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Retina Logo', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<div id="ast-advanced-headers-preview-logo">
							<?php if ( isset( $design['retina-logo-url'] ) && '' != $design['retina-logo-url'] ) { ?>
								<img class="ast-advanced-headers-logo saved-image"
									src="<?php echo esc_url( $design['retina-logo-url'] ); ?>"
									style="margin-bottom:12px;max-width:150px;"/>
							<?php } ?>
						</div>
						<input type="hidden" id="ast-advanced-headers-logo-id" class="ast-advanced-headers-logo-id"
								name="ast-advanced-headers-design[retina-logo-id]"
								value="<?php echo esc_attr( $design['retina-logo-id'] ); ?>"/>
						<input type="hidden" id="ast-advanced-headers-logo" class="ast-advanced-headers-logo"
								name="ast-advanced-headers-design[retina-logo-url]"
								value="<?php echo esc_attr( $design['retina-logo-url'] ); ?>"/>

						<a class="ast-advanced-header-logo-select button-secondary"
							href="#"><?php esc_html_e( 'Select logo', 'astra-addon' ); ?></a>
						<?php
						// Remove button based on image is selected or not.
						$remove_logo_button = ( isset( $design['retina-logo-url'] ) && '' != $design['retina-logo-url'] ) ? 'display:inline-block;' : 'display:none;';
						?>
						<button class="ast-advanced-headers-logo-remove button" type="button"
								style="<?php echo esc_attr( $remove_logo_button ); ?>">
							<?php esc_html_e( 'Remove Logo', 'astra-addon' ); ?>
						</button>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-logo-settings-wrap">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Logo Width', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="number" min="0" step="1" max="600"
								name="ast-advanced-headers-design[header-logo-width]"
								value="<?php echo esc_attr( $design['header-logo-width'] ); ?>" placeholder='0'/>
					</td>
				</tr>
				<!-- Header Colors  -->
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading title">
						<label><?php esc_html_e( 'Customize Site Header', 'astra-addon' ); ?></label>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Background Overlay Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
								name="ast-advanced-headers-design[header-bg-color]"
								value="<?php echo esc_attr( $design['header-bg-color'] ); ?>" />
					</td>
				</tr>

				<?php
				if ( is_astra_theme_3_5_0_version() ) {
					$site_title = astra_get_option( 'display-site-title' );
				}else{
					$site_title_setting = astra_get_option( 'display-site-title-responsive' );
					$site_title         = ( $site_title_setting['desktop'] || $site_title_setting['tablet'] || $site_title_setting['mobile'] ) ? true : false;
				}
				if ( $site_title ) {
					?>
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Site Title Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[site-title-color]"
									value="<?php echo esc_attr( $design['site-title-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Site Title Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[site-title-h-color]"
									value="<?php echo esc_attr( $design['site-title-h-color'] ); ?>" />
						</td>
					</tr>
					<?php
				}
				if ( is_astra_theme_3_5_0_version() ) {
					$display_site_tagline = astra_get_option( 'display-site-tagline' );
				}else{
					$site_tagline_setting = astra_get_option( 'display-site-tagline-responsive' );
					$display_site_tagline         = ( $site_tagline_setting['desktop'] || $site_tagline_setting['tablet'] || $site_tagline_setting['mobile'] ) ? true : false;
				}
				if ( $display_site_tagline ) {
					?>

					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Site Tagline Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[site-tagline-color]"
									value="<?php echo esc_attr( $design['site-tagline-color'] ); ?>" />
						</td>
					</tr>
					<?php
				}
				?>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Border Bottom Size', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="number" min="0" step="1" max="600"
								name="ast-advanced-headers-design[header-main-sep]"
								value="<?php echo esc_attr( $design['header-main-sep'] ); ?>" placeholder='0'/>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Bottom Border Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
							name="ast-advanced-headers-design[header-main-sep-color]"
							value="<?php echo esc_attr( $design['header-main-sep-color'] ); ?>" />
					</td>
				</tr>
				</table>
				<!-- Primary menu Colors  -->
				<table class="ast-advanced-headers-table widefat">
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-heading title">
							<label><?php esc_html_e( 'Primary Menu', 'astra-addon' ); ?></label>
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-menu-bg-color]"
									value="<?php echo esc_attr( $design['primary-menu-bg-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-menu-color]"
									value="<?php echo esc_attr( $design['primary-menu-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-menu-h-color]"
									value="<?php echo esc_attr( $design['primary-menu-h-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-menu-a-color]"
									value="<?php echo ( isset( $design['primary-menu-a-color'] ) ) ? esc_attr( $design['primary-menu-a-color'] ) : ''; ?>" />
						</td>
					</tr>

					<!-- Primary menu -> submenu Colors  -->
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-submenu-bg-color]"
									value="<?php echo ( isset( $design['primary-submenu-bg-color'] ) ) ? esc_attr( $design['primary-submenu-bg-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-submenu-color]"
									value="<?php echo ( isset( $design['primary-submenu-color'] ) ) ? esc_attr( $design['primary-submenu-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-submenu-h-color]"
									value="<?php echo ( isset( $design['primary-submenu-h-color'] ) ) ? esc_attr( $design['primary-submenu-h-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-submenu-a-color]"
									value="<?php echo ( isset( $design['primary-submenu-a-color'] ) ) ? esc_attr( $design['primary-submenu-a-color'] ) : ''; ?>" />
						</td>
					</tr>
					<?php
					// Get all nav menus.
					$menu_locations = get_nav_menu_locations();
					?>

					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Select Primary Menu', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<?php
							if ( isset( $design['custom-menu'] ) ) {
								$primary_manu = isset( $menu_locations['primary'] ) ? $menu_locations['primary'] : '';
								$custom_menu  = ( ( isset( $design['custom-menu'] ) && '' == $design['custom-menu'] ) ) ? $primary_manu : $design['custom-menu'];
								$nav_menus    = wp_get_nav_menus();
							}
							?>

							<select name="ast-advanced-headers-design[custom-menu]" style="width: auto" ;>
								<option
									value="0"><?php printf( '&mdash; %s &mdash;', esc_html__( 'Default', 'astra-addon' ) ); ?></option>
								<?php
								if ( isset( $design['custom-menu'] ) && ! empty( $nav_menus ) ) {
									foreach ( $nav_menus as $menu ) :
										?>
									<option <?php selected( $custom_menu == $menu->term_id ); ?>
										value="<?php echo esc_attr( $menu->term_id ); ?>">
										<?php echo esc_html( $menu->name ); ?>
									</option>
										<?php
								endforeach;
								}
								?>
							</select>
						</td>
					</tr>
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Custom Menu Item', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<?php
							$custom_menu_item         = isset( $design['custom-menu-item'] ) ? $design['custom-menu-item'] : 'default';
							$primary_custom_menu_item = apply_filters(
								'astra_header_section_elements',
								array(
									'default'   => __( 'Customizer Setting', 'astra-addon' ),
									'none'      => __( 'None', 'astra-addon' ),
									'search'    => __( 'Search', 'astra-addon' ),
									'text-html' => __( 'Text / HTML', 'astra-addon' ),
									'widget'    => __( 'Widget', 'astra-addon' ),
								),
								'primary-header'
							);
							?>
							<select id="ast-advanced-headers-design-custom-menu-item" name="ast-advanced-headers-design[custom-menu-item]" style="width: auto" ;>
								<?php foreach ( $primary_custom_menu_item as $custom_menu_item_key => $custom_menu_item_value ) { ?>
									<option <?php selected( $custom_menu_item, $custom_menu_item_key ); ?> value="<?php echo esc_attr( $custom_menu_item_key ); ?>"> <?php echo esc_html( $custom_menu_item_value ); ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Search Style', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<?php
							$current_search_style = isset( $design['search-style'] ) ? $design['search-style'] : 'default';

							$search_styles = array(
								'default'      => __( 'Customizer Setting', 'astra-addon' ),
								'slide-search' => __( 'Slide Search', 'astra-addon' ),
								'full-screen'  => __( 'Full Screen Search', 'astra-addon' ),
								'header-cover' => __( 'Header Cover Search', 'astra-addon' ),
								'search-box'   => __( 'Search Box', 'astra-addon' ),
							);
							?>
							<select id="ast-advanced-headers-design-search-style" name="ast-advanced-headers-design[search-style]" style="width: auto" ;>
								<?php foreach ( $search_styles as $style_slug => $style_title ) { ?>
									<option <?php selected( $current_search_style, $style_slug ); ?> value="<?php echo esc_attr( $style_slug ); ?>"> <?php echo esc_html( $style_title ); ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-custom-menu-item-enabled">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Take custom menu item outside', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="checkbox" id="ast-advanced-header-custom-menu-item-outside"
									name="ast-advanced-headers-design[custom-menu-item-outside]"
									value="enabled" <?php checked( isset( $design['custom-menu-item-outside'] ) ? $design['custom-menu-item-outside'] : '', 'enabled' ); ?> />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-custom-menu-item-text-enabled">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Custom Menu Text / HTML', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<textarea type="checkbox" id="ast-advanced-header-custom-menu-item-text-html" name="ast-advanced-headers-design[custom-menu-item-text-html]" ><?php echo esc_textarea( isset( $design['custom-menu-item-text-html'] ) ? $design['custom-menu-item-text-html'] : '' ); ?></textarea>
						</td>
					</tr>
				</table>
				<?php

				$above_header_layout = astra_get_option( 'above-header-layout' );

				if ( Astra_Ext_Extension::is_active( 'header-sections' ) && 'disabled' != $above_header_layout ) {
					?>

				<!-- Above Header Colors  -->
				<table class="ast-advanced-headers-table widefat">
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-heading title">
							<label><?php esc_html_e( 'Above Header', 'astra-addon' ); ?></label>
						</td>
						<tr class="ast-advanced-headers-row">
							<td class="ast-advanced-headers-row-sub-heading">
								<label><?php esc_html_e( 'Display Above Header', 'astra-addon' ); ?></label>
							</td>
							<td class="ast-advanced-headers-row-content">
								<input type="checkbox" id="ast-advanced-header-layout-above-header"
										name="ast-advanced-headers-layout[above-header-enabled]"
										value="enabled" <?php checked( isset( $layout['above-header-enabled'] ) ? $layout['above-header-enabled'] : '', 'enabled' ); ?> />
							</td>
						</tr>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-bg-color]"
									value="<?php echo esc_attr( $design['above-header-bg-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-text-link-color]"
									value="<?php echo esc_attr( $design['above-header-text-link-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-h-color]"
									value="<?php echo esc_attr( $design['above-header-h-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-a-color]"
									value="<?php echo ( isset( $design['above-header-a-color'] ) ) ? esc_attr( $design['above-header-a-color'] ) : ''; ?>" />
						</td>
					</tr>
					<!-- Above menu -> submenu Colors  -->
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-submenu-bg-color]"
									value="<?php echo ( isset( $design['above-header-submenu-bg-color'] ) ) ? esc_attr( $design['above-header-submenu-bg-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-submenu-link-color]"
									value="<?php echo ( isset( $design['above-header-submenu-link-color'] ) ) ? esc_attr( $design['above-header-submenu-link-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-submenu-h-color]"
									value="<?php echo ( isset( $design['above-header-submenu-h-color'] ) ) ? esc_attr( $design['above-header-submenu-h-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-submenu-a-color]"
									value="<?php echo ( isset( $design['above-header-submenu-a-color'] ) ) ? esc_attr( $design['above-header-submenu-a-color'] ) : ''; ?>" />
						</td>
					</tr>
				</table>
					<?php
				}

				$below_header_layout = astra_get_option( 'below-header-layout' );

				if ( Astra_Ext_Extension::is_active( 'header-sections' ) && 'disabled' != $below_header_layout ) {
					?>

				<!-- Below Header Colors  -->
				<table class="ast-advanced-headers-table widefat">
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-heading title">
							<label><?php esc_html_e( 'Below Header', 'astra-addon' ); ?></label>
						</td>
						<tr class="ast-advanced-headers-row">
							<td class="ast-advanced-headers-row-sub-heading">
								<label><?php esc_html_e( 'Display Below Header', 'astra-addon' ); ?></label>
							</td>
							<td class="ast-advanced-headers-row-content">
								<input type="checkbox" id="ast-advanced-header-layout-below-header"
										name="ast-advanced-headers-layout[below-header-enabled]"
										value="enabled" <?php checked( isset( $layout['below-header-enabled'] ) ? $layout['below-header-enabled'] : '', 'enabled' ); ?> />
							</td>
						</tr>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-bg-color]"
									value="<?php echo esc_attr( $design['below-header-bg-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-text-link-color]"
									value="<?php echo esc_attr( $design['below-header-text-link-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-h-color]"
									value="<?php echo esc_attr( $design['below-header-h-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-a-color]"
									value="<?php echo ( isset( $design['below-header-a-color'] ) ) ? esc_attr( $design['below-header-a-color'] ) : ''; ?>" />
						</td>
					</tr>
					<!-- Below menu -> submenu Colors  -->
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-submenu-bg-color]"
									value="<?php echo ( isset( $design['below-header-submenu-bg-color'] ) ) ? esc_attr( $design['below-header-submenu-bg-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-submenu-link-color]"
									value="<?php echo ( isset( $design['below-header-submenu-link-color'] ) ) ? esc_attr( $design['below-header-submenu-link-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-submenu-h-color]"
									value="<?php echo ( isset( $design['below-header-submenu-h-color'] ) ) ? esc_attr( $design['below-header-submenu-h-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-submenu-a-color]"
									value="<?php echo ( isset( $design['below-header-submenu-a-color'] ) ) ? esc_attr( $design['below-header-submenu-a-color'] ) : ''; ?>" />
						</td>
					</tr>
				</table>
					<?php
				}
		}

		/**
		 * Markup for Site Header Tabs.
		 *
		 * @since 3.0.0
		 *
		 * @param  array $options Post meta.
		 */
		public function hfb_site_header_tab( $options ) {
			$layout = $options['layouts'];
			$design = $options['designs'];

			?>
			<table class="ast-advanced-headers-table widefat ast-required-advanced-headers">
				<tr class="ast-advanced-headers-row ast-advanced-header-layout-merge-wrap">
					<td class="ast-advanced-headers-row-heading">
						<label><?php esc_html_e( 'Merge Page Header with Site Header', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="checkbox" id="ast-advanced-header-layout-merged"
								name="ast-advanced-headers-layout[merged]"
								value="enabled" <?php checked( isset( $layout['merged'] ) ? $layout['merged'] : '', 'enabled' ); ?> />
					</td>
				</tr>
			</table>

			<table class="ast-advanced-headers-table require-merge-ast-advanced-header widefat">
				<!-- Site Identity  -->
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading title">
						<label><?php esc_html_e( 'Site Identity', 'astra-addon' ); ?></label>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row diff-logo-wrap">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Different Logo for Page Header?', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="checkbox" id="ast-advanced-header-diff-header-logo"
								name="ast-advanced-headers-layout[diff-header-logo]"
								value="enabled" <?php checked( isset( $layout['diff-header-logo'] ) ? $layout['diff-header-logo'] : '', 'enabled' ); ?> />
					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-logo-settings-wrap">

					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Logo', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<div id="ast-advanced-headers-preview-logo">
							<?php if ( isset( $design['logo-url'] ) && '' != $design['logo-url'] ) { ?>
								<img class="ast-advanced-headers-logo saved-image"
									src="<?php echo esc_url( $design['logo-url'] ); ?>"
									style="margin-bottom:12px;max-width:150px;"/>
							<?php } ?>
						</div>
						<input type="hidden" id="ast-advanced-headers-logo-id" class="ast-advanced-headers-logo-id"
								name="ast-advanced-headers-design[logo-id]"
								value="<?php echo esc_attr( $design['logo-id'] ); ?>"/>
						<input type="hidden" id="ast-advanced-headers-logo" class="ast-advanced-headers-logo"
								name="ast-advanced-headers-design[logo-url]"
								value="<?php echo esc_attr( $design['logo-url'] ); ?>"/>

						<a class="ast-advanced-header-logo-select button-secondary"
							href="#"><?php esc_html_e( 'Select logo', 'astra-addon' ); ?></a>
						<?php
						// Remove button based on image is selected or not.
						$remove_logo_button = ( isset( $design['logo-url'] ) && '' != $design['logo-url'] ) ? 'display:inline-block;' : 'display:none;';
						?>
						<button class="ast-advanced-headers-logo-remove button" type="button"
								style="<?php echo esc_attr( $remove_logo_button ); ?>">
							<?php esc_html_e( 'Remove Logo', 'astra-addon' ); ?>
						</button>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-diff-header-retina-logo">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Different Logo for retina devices?', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="checkbox" id="ast-advanced-header-diff-header-retina-logo"
								name="ast-advanced-headers-layout[diff-header-retina-logo]"
								value="enabled" <?php checked( isset( $layout['diff-header-retina-logo'] ) ? $layout['diff-header-retina-logo'] : '', 'enabled' ); ?> />
					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-retina-logo-settings-wrap">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Retina Logo', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<div id="ast-advanced-headers-preview-logo">
							<?php if ( isset( $design['retina-logo-url'] ) && '' != $design['retina-logo-url'] ) { ?>
								<img class="ast-advanced-headers-logo saved-image"
									src="<?php echo esc_url( $design['retina-logo-url'] ); ?>"
									style="margin-bottom:12px;max-width:150px;"/>
							<?php } ?>
						</div>
						<input type="hidden" id="ast-advanced-headers-logo-id" class="ast-advanced-headers-logo-id"
								name="ast-advanced-headers-design[retina-logo-id]"
								value="<?php echo esc_attr( $design['retina-logo-id'] ); ?>"/>
						<input type="hidden" id="ast-advanced-headers-logo" class="ast-advanced-headers-logo"
								name="ast-advanced-headers-design[retina-logo-url]"
								value="<?php echo esc_attr( $design['retina-logo-url'] ); ?>"/>

						<a class="ast-advanced-header-logo-select button-secondary"
							href="#"><?php esc_html_e( 'Select logo', 'astra-addon' ); ?></a>
						<?php
						// Remove button based on image is selected or not.
						$remove_logo_button = ( isset( $design['retina-logo-url'] ) && '' != $design['retina-logo-url'] ) ? 'display:inline-block;' : 'display:none;';
						?>
						<button class="ast-advanced-headers-logo-remove button" type="button"
								style="<?php echo esc_attr( $remove_logo_button ); ?>">
							<?php esc_html_e( 'Remove Logo', 'astra-addon' ); ?>
						</button>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row ast-logo-settings-wrap">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Logo Width', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="number" min="0" step="1" max="600"
								name="ast-advanced-headers-design[header-logo-width]"
								value="<?php echo esc_attr( $design['header-logo-width'] ); ?>" placeholder='0'/>
					</td>
				</tr>
				<!-- Header Colors  -->
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading title">
						<label><?php esc_html_e( 'Customize Site Header', 'astra-addon' ); ?></label>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Background Overlay Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
								name="ast-advanced-headers-design[header-bg-color]"
								value="<?php echo esc_attr( $design['header-bg-color'] ); ?>" />
					</td>
				</tr>

				<?php
				if ( is_astra_theme_3_5_0_version() ) {
					$site_title = astra_get_option( 'display-site-title' );
				}else{
					$site_title_setting = astra_get_option( 'display-site-title-responsive' );
					$site_title         = ( $site_title_setting['desktop'] || $site_title_setting['tablet'] || $site_title_setting['mobile'] ) ? true : false;
				}
				if ( $site_title ) {
					?>
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Site Title Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[site-title-color]"
									value="<?php echo esc_attr( $design['site-title-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Site Title Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[site-title-h-color]"
									value="<?php echo esc_attr( $design['site-title-h-color'] ); ?>" />
						</td>
					</tr>
					<?php
				}
				if ( is_astra_theme_3_5_0_version() ) {
					$display_site_tagline = astra_get_option( 'display-site-tagline' );
				}else{
					$site_tagline_setting = astra_get_option( 'display-site-tagline-responsive' );
					$display_site_tagline         = ( $site_tagline_setting['desktop'] || $site_tagline_setting['tablet'] || $site_tagline_setting['mobile'] ) ? true : false;
				}
				if ( $display_site_tagline ) {
					?>

					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Site Tagline Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[site-tagline-color]"
									value="<?php echo esc_attr( $design['site-tagline-color'] ); ?>" />
						</td>
					</tr>
					<?php
				}
				?>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Border Bottom Size', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="number" min="0" step="1" max="600"
								name="ast-advanced-headers-design[header-main-sep]"
								value="<?php echo esc_attr( $design['header-main-sep'] ); ?>" placeholder='0'/>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-sub-heading">
						<label><?php esc_html_e( 'Bottom Border Color', 'astra-addon' ); ?></label>
					</td>
					<td class="ast-advanced-headers-row-content">
						<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
							name="ast-advanced-headers-design[header-main-sep-color]"
							value="<?php echo esc_attr( $design['header-main-sep-color'] ); ?>" />
					</td>
				</tr>
				</table>
				<!-- Primary menu Colors  -->
				<table class="ast-advanced-headers-table widefat">
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-heading title">
							<label><?php esc_html_e( 'Primary Header', 'astra-addon' ); ?></label>
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-menu-bg-color]"
									value="<?php echo esc_attr( $design['primary-menu-bg-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-menu-color]"
									value="<?php echo esc_attr( $design['primary-menu-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-menu-h-color]"
									value="<?php echo esc_attr( $design['primary-menu-h-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-menu-a-color]"
									value="<?php echo ( isset( $design['primary-menu-a-color'] ) ) ? esc_attr( $design['primary-menu-a-color'] ) : ''; ?>" />
						</td>
					</tr>

					<!-- Primary menu -> submenu Colors  -->
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-submenu-bg-color]"
									value="<?php echo ( isset( $design['primary-submenu-bg-color'] ) ) ? esc_attr( $design['primary-submenu-bg-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-submenu-color]"
									value="<?php echo ( isset( $design['primary-submenu-color'] ) ) ? esc_attr( $design['primary-submenu-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-submenu-h-color]"
									value="<?php echo ( isset( $design['primary-submenu-h-color'] ) ) ? esc_attr( $design['primary-submenu-h-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row require-merge-ast-advanced-header">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[primary-submenu-a-color]"
									value="<?php echo ( isset( $design['primary-submenu-a-color'] ) ) ? esc_attr( $design['primary-submenu-a-color'] ) : ''; ?>" />
						</td>
					</tr>
					<?php
					// Get all nav menus.
					$menu_locations = get_nav_menu_locations();
					?>

					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Select Primary Menu', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<?php
							if ( isset( $design['custom-menu'] ) ) {
								$primary_manu = isset( $menu_locations['primary'] ) ? $menu_locations['primary'] : '';
								$custom_menu  = ( ( isset( $design['custom-menu'] ) && '' == $design['custom-menu'] ) ) ? $primary_manu : $design['custom-menu'];
								$nav_menus    = wp_get_nav_menus();
							}
							?>

							<select name="ast-advanced-headers-design[custom-menu]" style="width: auto" ;>
								<option
									value="0"><?php printf( '&mdash; %s &mdash;', esc_html__( 'Default', 'astra-addon' ) ); ?></option>
								<?php
								if ( isset( $design['custom-menu'] ) && ! empty( $nav_menus ) ) {
									foreach ( $nav_menus as $menu ) :
										?>
									<option <?php selected( $custom_menu == $menu->term_id ); ?>
										value="<?php echo esc_attr( $menu->term_id ); ?>">
										<?php echo esc_html( $menu->name ); ?>
									</option>
										<?php
								endforeach;
								}
								?>
							</select>
						</td>
					</tr>
				</table>
				<?php

				if ( Astra_Addon_Builder_Helper::is_row_empty( 'above', 'header', 'desktop' ) ) {
					?>

				<!-- Above Header Colors  -->
				<table class="ast-advanced-headers-table widefat">
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-heading title">
							<label><?php esc_html_e( 'Above Header', 'astra-addon' ); ?></label>
						</td>
						<tr class="ast-advanced-headers-row">
							<td class="ast-advanced-headers-row-sub-heading">
								<label><?php esc_html_e( 'Display Above Header', 'astra-addon' ); ?></label>
							</td>
							<td class="ast-advanced-headers-row-content">
								<input type="checkbox" id="ast-advanced-header-layout-above-header"
										name="ast-advanced-headers-layout[above-header-enabled]"
										value="enabled" <?php checked( isset( $layout['above-header-enabled'] ) ? $layout['above-header-enabled'] : '', 'enabled' ); ?> />
							</td>
						</tr>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-bg-color]"
									value="<?php echo esc_attr( $design['above-header-bg-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-text-link-color]"
									value="<?php echo esc_attr( $design['above-header-text-link-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-h-color]"
									value="<?php echo esc_attr( $design['above-header-h-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-a-color]"
									value="<?php echo ( isset( $design['above-header-a-color'] ) ) ? esc_attr( $design['above-header-a-color'] ) : ''; ?>" />
						</td>
					</tr>
					<!-- Above menu -> submenu Colors  -->
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-submenu-bg-color]"
									value="<?php echo ( isset( $design['above-header-submenu-bg-color'] ) ) ? esc_attr( $design['above-header-submenu-bg-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-submenu-link-color]"
									value="<?php echo ( isset( $design['above-header-submenu-link-color'] ) ) ? esc_attr( $design['above-header-submenu-link-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-submenu-h-color]"
									value="<?php echo ( isset( $design['above-header-submenu-h-color'] ) ) ? esc_attr( $design['above-header-submenu-h-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[above-header-submenu-a-color]"
									value="<?php echo ( isset( $design['above-header-submenu-a-color'] ) ) ? esc_attr( $design['above-header-submenu-a-color'] ) : ''; ?>" />
						</td>
					</tr>
				</table>
					<?php
				}

				if ( Astra_Addon_Builder_Helper::is_row_empty( 'below', 'header', 'desktop' ) ) {
					?>

				<!-- Below Header Colors  -->
				<table class="ast-advanced-headers-table widefat">
					<tr class="ast-advanced-headers-row">
						<td class="ast-advanced-headers-row-heading title">
							<label><?php esc_html_e( 'Below Header', 'astra-addon' ); ?></label>
						</td>
						<tr class="ast-advanced-headers-row">
							<td class="ast-advanced-headers-row-sub-heading">
								<label><?php esc_html_e( 'Display Below Header', 'astra-addon' ); ?></label>
							</td>
							<td class="ast-advanced-headers-row-content">
								<input type="checkbox" id="ast-advanced-header-layout-below-header"
										name="ast-advanced-headers-layout[below-header-enabled]"
										value="enabled" <?php checked( isset( $layout['below-header-enabled'] ) ? $layout['below-header-enabled'] : '', 'enabled' ); ?> />
							</td>
						</tr>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-bg-color]"
									value="<?php echo esc_attr( $design['below-header-bg-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-text-link-color]"
									value="<?php echo esc_attr( $design['below-header-text-link-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-h-color]"
									value="<?php echo esc_attr( $design['below-header-h-color'] ); ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-a-color]"
									value="<?php echo ( isset( $design['below-header-a-color'] ) ) ? esc_attr( $design['below-header-a-color'] ) : ''; ?>" />
						</td>
					</tr>
					<!-- Below menu -> submenu Colors  -->
					<tr class="ast-advanced-headers-row ast-above-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Background Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-submenu-bg-color]"
									value="<?php echo ( isset( $design['below-header-submenu-bg-color'] ) ) ? esc_attr( $design['below-header-submenu-bg-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link / Text Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-submenu-link-color]"
									value="<?php echo ( isset( $design['below-header-submenu-link-color'] ) ) ? esc_attr( $design['below-header-submenu-link-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Hover Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-submenu-h-color]"
									value="<?php echo ( isset( $design['below-header-submenu-h-color'] ) ) ? esc_attr( $design['below-header-submenu-h-color'] ) : ''; ?>" />
						</td>
					</tr>
					<tr class="ast-advanced-headers-row ast-below-header-required">
						<td class="ast-advanced-headers-row-sub-heading">
							<label><?php esc_html_e( 'Submenu Link Active Color', 'astra-addon' ); ?></label>
						</td>
						<td class="ast-advanced-headers-row-content">
							<input type="text" class="ast-advanced-headers-color-picker" data-alpha="true"
									name="ast-advanced-headers-design[below-header-submenu-a-color]"
									value="<?php echo ( isset( $design['below-header-submenu-a-color'] ) ) ? esc_attr( $design['below-header-submenu-a-color'] ) : ''; ?>" />
						</td>
					</tr>
				</table>
					<?php
				}
		}

		/**
		 * Markup for Display Rules Tabs.
		 *
		 * @since  1.0.0
		 *
		 * @param  array $options Post meta.
		 */
		public function display_rules_tab( $options ) {
			// Load Target Rule assets.
			Astra_Target_Rules_Fields::get_instance()->admin_styles();

			$layout            = $options['layouts'];
			$design            = $options['designs'];
			$include_locations = $options['include_locations'];
			$exclude_locations = $options['exclude_locations'];
			$users             = $options['user_roles'];
			?>
			<table class="ast-advanced-headers-table widefat">
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading">
						<label><?php esc_html_e( 'Display On', 'astra-addon' ); ?></label>
						<i class="ast-advanced-headers-heading-help dashicons dashicons-editor-help"
							title="<?php echo esc_attr__( 'Add locations for where this Advanced Header should appear.', 'astra-addon' ); ?>"></i>
					</td>
					<td class="ast-advanced-headers-row-content">
						<?php
						Astra_Target_Rules_Fields::target_rule_settings_field(
							'ast-advanced-headers-location',
							array(
								'title'          => __( 'Display Rules', 'astra-addon' ),
								'value'          => '[{"type":"basic-global","specific":null}]',
								'tags'           => 'site,enable,target,pages',
								'rule_type'      => 'display',
								'add_rule_label' => __( 'Add Display Rule', 'astra-addon' ),
							),
							$include_locations
						);
						?>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading">
						<label><?php esc_html_e( 'Do Not Display On', 'astra-addon' ); ?></label>
						<i class="ast-advanced-headers-heading-help dashicons dashicons-editor-help"
							title="<?php echo esc_attr__( 'This Advanced Header will not appear at these locations.', 'astra-addon' ); ?>"></i>
					</td>
					<td class="ast-advanced-headers-row-content">
						<?php
						Astra_Target_Rules_Fields::target_rule_settings_field(
							'ast-advanced-headers-exclusion',
							array(
								'title'          => __( 'Exclude On', 'astra-addon' ),
								'value'          => '[]',
								'tags'           => 'site,enable,target,pages',
								'add_rule_label' => __( 'Add Exclusion Rule', 'astra-addon' ),
								'rule_type'      => 'exclude',
							),
							$exclude_locations
						);
						?>
					</td>
				</tr>
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading">
						<label><?php esc_html_e( 'User Roles', 'astra-addon' ); ?></label>
						<i class="ast-advanced-headers-heading-help dashicons dashicons-editor-help" title="<?php echo esc_attr__( 'Targer header based on user role.', 'astra-addon' ); ?>"></i>
					</td>
					<td class="ast-advanced-headers-row-content">
						<?php
						Astra_Target_Rules_Fields::target_user_role_settings_field(
							'ast-advanced-headers-users',
							array(
								'title'          => __( 'Users', 'astra-addon' ),
								'value'          => '[]',
								'tags'           => 'site,enable,target,pages',
								'add_rule_label' => __( 'Add User Rule', 'astra-addon' ),
							),
							$users
						);
						?>
					</td>
				</tr>
			</table>
			<!-- Transparent header notice -->
			<table class="ast-advanced-headers-table ast-transparent-notice-wrap widefat">
				<tr class="ast-advanced-headers-row">
					<td class="ast-advanced-headers-row-heading">
						<label><?php esc_html_e( 'Force Disable Transparency on Archives?', 'astra-addon' ); ?></label>
						<i class="ast-advanced-headers-heading-help dashicons dashicons-editor-help"
							title="<?php echo esc_attr__( 'Merge Page Header with Site Header is generally not recommended on achieve pages such as search, 404, etc. If you would like to enable it, use this setting.', 'astra-addon' ); ?>"></i>
					</td>

					<td class="ast-advanced-headers-row-content">
						<input type="checkbox" id="ast-advanced-headers-layout-force-transparent-yes"
								name="ast-advanced-headers-layout[force-transparent-disabled]"
								value="yes" <?php checked( isset( $layout['force-transparent-disabled'] ) ? $layout['force-transparent-disabled'] : '', 'yes' ); ?> />
						<label
							for="ast-advanced-headers-layout-force-transparent-yes"><?php esc_html_e( 'Yes', 'astra-addon' ); ?></label><br>
					</td>
				</tr>
			</table>
			<?php
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
		public static function logo_image_sizes( $sizes, $metadata ) {

			$logo_width = sanitize_key( $_POST['ast-advanced-headers-design']['header-logo-width'] );

			if ( is_array( $sizes ) && '' != $logo_width ) {

				$sizes['ast-adv-header-logo-size'] = array(
					'width'  => (int) $logo_width,
					'height' => 0,
					'crop'   => false,
				);
			}

			return $sizes;
		}

		/**
		 * Generate logo image by its width.
		 *
		 * @since 1.0.0
		 * @param int $custom_logo_id Logo id.
		 */
		public static function generate_logo_by_width( $custom_logo_id ) {
			if ( $custom_logo_id ) {

				add_filter( 'intermediate_image_sizes_advanced', 'Astra_Ext_Advanced_Headers_Meta::logo_image_sizes', 10, 2 );

				$image = get_post( $custom_logo_id );

				if ( $image ) {
					$fullsizepath = get_attached_file( $image->ID );

					if ( false !== $fullsizepath || file_exists( $fullsizepath ) ) {

						$metadata = wp_generate_attachment_metadata( $image->ID, $fullsizepath );

						if ( ! is_wp_error( $metadata ) && ! empty( $metadata ) ) {
							wp_update_attachment_metadata( $image->ID, $metadata );
						}
					}
				}

				remove_filter( 'intermediate_image_sizes_advanced', 'Astra_Ext_Advanced_Headers_Meta::logo_image_sizes', 10 );
			}
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Advanced_Headers_Meta::get_instance();
