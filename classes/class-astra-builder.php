<?php
/**
 * Astra Builder
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Builder' ) ) {

	/**
	 * Astra_Builder initial setup
	 *
	 * @since 3.0.0
	 */
	class Astra_Builder {

		/**
		 * Member Variable
		 *
		 * @var instance
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

			add_filter(
				'astra_footer_row_layout',
				function( $layout ) {
					// Modify Layouts here.
					return $layout;
				}
			);

			add_filter( 'astra_header_desktop_items', array( $this, 'update_header_builder_desktop_items' ) );
			add_filter( 'astra_header_mobile_items', array( $this, 'update_header_builder_mobile_items' ) );
			add_filter( 'astra_footer_desktop_items', array( $this, 'update_footer_builder_desktop_items' ) );

			add_action( 'astra_render_header_components', array( $this, 'render_header_components' ) );
			add_action( 'astra_render_footer_components', array( $this, 'render_footer_dynamic_components' ) );
		}

		/**
		 * Update default header builder's desktop components.
		 *
		 * @param array $header_items array of header elements which will load in customizer builder layout.
		 * @return array Array of desktop components.
		 *
		 * @since 3.0.0
		 */
		public function update_header_builder_desktop_items( $header_items ) {

			$cloned_component_track = astra_addon_builder_helper()->component_count_array;

			$num_of_header_divider = astra_addon_builder_helper()->num_of_header_divider;
			for ( $index = 1; $index <= $num_of_header_divider; $index++ ) {

				$header_divider_section = 'section-hb-divider-' . $index;

				if ( isset( $cloned_component_track['removed-items'] ) && in_array( $header_divider_section, $cloned_component_track['removed-items'], true ) ) {
					continue;
				}

				$header_items[ 'divider-' . $index ] = array(
					'name'    => ( 1 === $num_of_header_divider ) ? 'Divider' : 'Divider ' . $index,
					'icon'    => 'minus',
					'section' => $header_divider_section,
					'clone'   => true,
					'type'    => 'divider',
					'builder' => 'header',
				);
			}

			$header_items['language-switcher'] = array(
				'name'    => __( 'Language Switcher', 'astra-addon' ),
				'icon'    => 'translation',
				'section' => 'section-hb-language-switcher',
			);

			if ( version_compare( ASTRA_THEME_VERSION, '3.2.0', '>' ) ) {

				$header_items['mobile-trigger'] = array(
					'name'    => __( 'Toggle Button', 'astra-addon' ),
					'icon'    => 'menu-alt',
					'section' => 'section-header-mobile-trigger',
				);
			}

			$header_items['mobile-menu'] = array(
				'name'    => __( 'Off-Canvas Menu', 'astra-addon' ),
				'icon'    => 'menu-alt',
				'section' => 'section-header-mobile-menu',
			);

			return $header_items;
		}

		/**
		 * Update default header builder's mobile components.
		 *
		 * @param array $mobile_items array of mobile elements which will load in customizer builder layout.
		 * @return array Array of mobile components.
		 *
		 * @since 3.0.0
		 */
		public function update_header_builder_mobile_items( $mobile_items ) {

			$cloned_component_track = astra_addon_builder_helper()->component_count_array;

			$num_of_header_divider = astra_addon_builder_helper()->num_of_header_divider;
			for ( $index = 1; $index <= $num_of_header_divider; $index++ ) {

				$header_mobile_divider_section = 'section-hb-divider-' . $index;

				if ( isset( $cloned_component_track['removed-items'] ) && in_array( $header_mobile_divider_section, $cloned_component_track['removed-items'], true ) ) {
					continue;
				}

				$mobile_items[ 'divider-' . $index ] = array(
					'name'    => ( 1 === $num_of_header_divider ) ? 'Divider' : 'Divider ' . $index,
					'icon'    => 'minus',
					'section' => $header_mobile_divider_section,
					'clone'   => true,
					'type'    => 'divider',
					'builder' => 'header',
				);
			}

			$mobile_items['language-switcher'] = array(
				'name'    => __( 'Language Switcher', 'astra-addon' ),
				'icon'    => 'translation',
				'section' => 'section-hb-language-switcher',
			);

			return $mobile_items;
		}

		/**
		 * Update default footer builder's components.
		 *
		 * @param array $footer_items array of footer elements which will load in customizer builder layout.
		 * @return array Array of footer components.
		 *
		 * @since 3.0.0
		 */
		public function update_footer_builder_desktop_items( $footer_items ) {

			$cloned_component_track = astra_addon_builder_helper()->component_count_array;

			$num_of_footer_divider = astra_addon_builder_helper()->num_of_footer_divider;
			for ( $index = 1; $index <= $num_of_footer_divider; $index++ ) {

				$footer_divider_section = 'section-fb-divider-' . $index;

				if ( isset( $cloned_component_track['removed-items'] ) && in_array( $footer_divider_section, $cloned_component_track['removed-items'], true ) ) {
					continue;
				}

				$footer_items[ 'divider-' . $index ] = array(
					'name'    => ( 1 === $num_of_footer_divider ) ? 'Divider' : 'Divider ' . $index,
					'icon'    => 'minus',
					'section' => $footer_divider_section,
					'clone'   => true,
					'type'    => 'divider',
					'builder' => 'footer',
				);
			}

			$footer_items['language-switcher'] = array(
				'name'    => __( 'Language Switcher', 'astra-addon' ),
				'icon'    => 'translation',
				'section' => 'section-fb-language-switcher',
			);

			return $footer_items;
		}

		/**
		 * Render header component.
		 *
		 * @param string $slug component slug.
		 */
		public function render_header_components( $slug ) {

			$this->render_header_dynamic_components( $slug );
		}

		/**
		 * Render header dynamic components.
		 *
		 * @param string $slug slug.
		 */
		public function render_header_dynamic_components( $slug ) {

			if ( 0 === strpos( $slug, 'html' ) ) {
				?>
				<div class="ast-builder-layout-element site-header-focus-item ast-header-<?php echo esc_attr( $slug ); ?>" data-section="section-hb-<?php echo esc_attr( $slug ); ?>">
					<?php
					$action_name = 'astra_header_' . str_replace( '-', '_', $slug );
					do_action( $action_name );
					?>
				</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'button' ) ) {
				?>
				<div class="ast-builder-layout-element site-header-focus-item ast-header-<?php echo esc_attr( $slug ); ?>" data-section="section-hb-<?php echo esc_attr( $slug ); ?>">
					<?php
					$action_name = 'astra_header_' . str_replace( '-', '_', $slug );
					do_action( $action_name );
					?>
				</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'widget' ) ) {
				?>
				<aside
					<?php
					echo astra_attr(
						'header-widget-area-inner',
						array(
							'class'        => 'header-widget-area widget-area site-header-focus-item',
							'data-section' => 'sidebar-widgets-header-' . esc_attr( $slug ),
						)
					);
					?>
					>
					<?php
					if ( is_customize_preview() && class_exists( 'Astra_Builder_UI_Controller' ) ) {
						Astra_Builder_UI_Controller::render_customizer_edit_button();
					}
					echo function_exists( 'astra_markup_open' ) ? astra_markup_open( 'header-widget-div', array( 'echo' => false ) ) : '<div class="header-widget-area-inner site-info-inner">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					astra_get_sidebar( 'header-' . str_replace( '_', '-', $slug ) );
					echo function_exists( 'astra_markup_close' ) ? astra_markup_close( 'header-widget-div', array( 'echo' => false ) ) : '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</aside>
				<?php
			} elseif ( 0 === strpos( $slug, 'menu' ) ) {
				?>
				<div class="ast-builder-<?php echo esc_attr( $slug ); ?> ast-builder-menu ast-builder-<?php echo esc_attr( $slug ); ?>-focus-item ast-builder-layout-element site-header-focus-item" data-section="section-hb-<?php echo esc_attr( $slug ); ?>">
					<?php
					$action_name = 'astra_header_' . str_replace( '-', '_', $slug );
					do_action( $action_name );
					?>
				</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'social-icons' ) ) {
				$index = str_replace( 'social-icons-', '', $slug );
				?>
				<div class="ast-builder-layout-element site-header-focus-item" data-section="section-hb-social-icons-<?php echo esc_attr( $index ); ?>">
					<?php
					$action_name = 'astra_header_social_' . $index;
					do_action( $action_name );
					?>
				</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'divider' ) ) {
				$layout_class = astra_get_option( 'header-' . $slug . '-layout' );
				?>
					<div class="ast-builder-layout-element site-header-focus-item ast-header-divider-element ast-header-<?php echo esc_attr( $slug ); ?> ast-hb-divider-layout-<?php echo esc_attr( $layout_class ); ?>" data-section="section-hb-<?php echo esc_attr( $slug ); ?>">
					<?php
						$action_name = 'astra_header_' . str_replace( '-', '_', $slug );
						do_action( $action_name );
					?>
					</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'language-switcher' ) ) {
				$layout_class = astra_get_option( 'header-' . $slug . '-layout' );
				?>
					<div class="ast-builder-layout-element site-header-focus-item ast-header-language-switcher-element ast-header-<?php echo esc_attr( $slug ); ?> ast-hb-language-switcher-layout-<?php echo esc_attr( $layout_class ); ?>" data-section="section-hb-<?php echo esc_attr( $slug ); ?>">
					<?php
						$action_name = 'astra_header_' . str_replace( '-', '_', $slug );
						do_action( $action_name );
					?>
					</div>
				<?php
			}

		}

		/**
		 * Render footer dynamic components.
		 *
		 * @param string $slug slug.
		 */
		public function render_footer_dynamic_components( $slug ) {

			if ( 0 === strpos( $slug, 'html' ) ) {
				?>
				<div class="footer-widget-area widget-area site-footer-focus-item ast-footer-<?php echo esc_attr( $slug ); ?>" data-section="section-fb-<?php echo esc_attr( $slug ); ?>">
					<?php
					$action_name = 'astra_footer_' . str_replace( '-', '_', $slug );
					do_action( $action_name );
					?>
				</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'button' ) ) {
				?>
				<div class="ast-builder-layout-element site-footer-focus-item ast-footer-<?php echo esc_attr( $slug ); ?>" data-section="section-fb-<?php echo esc_attr( $slug ); ?>">
					<?php
					$action_name = 'astra_footer_' . str_replace( '-', '_', $slug );
					do_action( $action_name );
					?>
				</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'widget' ) ) {
				?>
				<aside
				<?php
				echo astra_attr(
					'footer-widget-area-inner',
					array(
						'class'        => 'footer-widget-area widget-area site-footer-focus-item',
						'data-section' => 'sidebar-widgets-footer-' . esc_attr( $slug ),
					)
				);
				?>
				>
				<?php
					echo function_exists( 'astra_markup_open' ) ? astra_markup_open( 'footer-widget-div', array( 'echo' => false ) ) : '<div class="footer-widget-area-inner site-info-inner">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					astra_get_sidebar( 'footer-' . str_replace( '_', '-', $slug ) );
					echo function_exists( 'astra_markup_close' ) ? astra_markup_close( 'footer-widget-div', array( 'echo' => false ) ) : '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
				</aside>
				<?php
			} elseif ( 0 === strpos( $slug, 'social-icons' ) ) {
				$index = str_replace( 'social-icons-', '', $slug );
				?>
				<div class="ast-builder-layout-element site-footer-focus-item" data-section="section-fb-social-icons-<?php echo esc_attr( $index ); ?>">
					<?php
					$action_name = 'astra_footer_social_' . $index;
					do_action( $action_name );
					?>
				</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'divider' ) ) {
				$layout_class = astra_get_option( 'footer-' . $slug . '-layout' );
				?>
					<div class="footer-widget-area widget-area site-footer-focus-item ast-footer-divider-element ast-footer-<?php echo esc_attr( $slug ); ?> ast-fb-divider-layout-<?php echo esc_attr( $layout_class ); ?>" data-section="section-fb-<?php echo esc_attr( $slug ); ?>">
					<?php
						$action_name = 'astra_footer_' . str_replace( '-', '_', $slug );
						do_action( $action_name );
					?>
					</div>
				<?php
			} elseif ( 0 === strpos( $slug, 'language-switcher' ) ) {
				$layout_class = astra_get_option( 'footer-' . $slug . '-layout' );
				?>
					<div class="ast-builder-layout-element site-footer-focus-item ast-footer-language-switcher-element ast-footer-<?php echo esc_attr( $slug ); ?> ast-fb-language-switcher-layout-<?php echo esc_attr( $layout_class ); ?>" data-section="section-fb-<?php echo esc_attr( $slug ); ?>">
					<?php
						$action_name = 'astra_footer_' . str_replace( '-', '_', $slug );
						do_action( $action_name );
					?>
					</div>
				<?php
			}

		}

	}
}

/**
 *  Prepare if class 'Astra_Builder' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Builder::get_instance();
