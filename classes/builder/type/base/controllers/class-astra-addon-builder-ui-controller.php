<?php
/**
 * Astra Builder UI Controller.
 *
 * @package astra-builder
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Addon_Builder_UI_Controller' ) ) {

	/**
	 * Class Astra_Addon_Builder_UI_Controller.
	 */
	final class Astra_Addon_Builder_UI_Controller {

		/**
		 * Astra Flags SVGs.
		 *
		 * @var ast_flags
		 */
		private static $ast_flags = null;

		/**
		 * Prepare divider Markup.
		 *
		 * @param string $index Key of the divider Control.
		 */
		public static function render_divider_markup( $index = 'header-divider-1' ) {

			$layout = astra_get_option( $index . '-layout' );
			?>

			<div class="ast-divider-wrapper ast-divider-layout-<?php echo esc_attr( $layout ); ?>">
				<?php
				if ( is_customize_preview() ) {
					self::render_customizer_edit_button();
				}
				?>
				<div class="ast-builder-divider-element"></div>
			</div>

			<?php
		}

		/**
		 * Prepare language switcher Markup.
		 *
		 * @param string $index Key of the language switcher Control.
		 * @param string $builder_type builder type.
		 */
		public static function render_language_switcher_markup( $index = 'header-language-switcher', $builder_type = 'header' ) {

			$lang_type  = astra_get_option( $index . '-type' );
			$layout     = astra_get_option( $index . '-layout' );
			$show_flag  = astra_get_option( $index . '-show-flag' );
			$show_label = astra_get_option( $index . '-show-name' );
			?>

			<div class="ast-builder-language-switcher-wrapper ast-builder-language-switcher-layout-<?php echo esc_attr( $layout ); ?>">
				<?php
				if ( is_customize_preview() ) {
					self::render_customizer_edit_button();
				}
				?>
				<div class="ast-builder-language-switcher-element">
					<?php
					if ( 'wpml' === $lang_type ) {
						$show_tname = astra_get_option( $index . '-show-tname' );
						$show_code  = astra_get_option( $index . '-show-code' );
						$languages  = apply_filters(
							'wpml_active_languages', // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
							null,
							array(
								'skip_missing' => 0,
							)
						);

						if ( ! empty( $languages ) ) {
							?>

							<nav class="ast-builder-language-switcher"><ul class="ast-builder-language-switcher-menu">
							<?php foreach ( $languages as $language ) { ?>
								<li class="ast-builder-language-switcher-menu-item-<?php echo esc_attr( $builder_type ); ?>">

									<?php if ( isset( $language['active'] ) && '1' === $language['active'] ) { ?>
										<a href="<?php echo esc_url( $language['url'] ); ?>" class="ast-builder-language-switcher-item ast-builder-language-switcher-item__active">
									<?php } else { ?>
										<a href="<?php echo esc_url( $language['url'] ); ?>" class="ast-builder-language-switcher-item">
									<?php } ?>
										<?php if ( $show_flag ) { ?>
											<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?>"><img src="<?php echo esc_url( $language['country_flag_url'] ); ?>" alt="<?php echo esc_attr( $language['language_code'] ); ?>" width="18" height="12" /></span>
										<?php } ?>

										<?php if ( $show_label ) { ?>
											<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?> ast-builder-language-switcher-native-name"><?php echo esc_html( $language['native_name'] ); ?></span>
										<?php } ?>

										<?php if ( $show_tname ) { ?>
											<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?> ast-builder-language-switcher-translated-name"><?php echo esc_html( $language['translated_name'] ); ?></span>
										<?php } ?>

										<?php if ( $show_code ) { ?>
											<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?> ast-builder-language-switcher-language-code"><?php echo '('; ?><?php echo esc_html( $language['language_code'] ); ?><?php echo ')'; ?></span>
										<?php } ?>
									</a>
								</li>
								<?php } ?>
							</ul></nav>
							<?php
						}
					} else {

						$items      = astra_get_option( $index . '-options' );
						$items      = isset( $items['items'] ) ? $items['items'] : array();
						$image_link = '';

						if ( is_array( $items ) && ! empty( $items ) ) {
							?>
							<nav class="ast-builder-language-switcher"><ul class="ast-builder-language-switcher-menu">
								<?php
								foreach ( $items as $item ) {
									if ( $item['enabled'] ) {

										$link = ( '' !== $item['url'] ) ? $item['url'] : '';
										?>
										<li class="ast-builder-language-switcher-menu-item-<?php echo esc_attr( $builder_type ); ?>">
											<a href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr( $item['label'] ); ?>" class="ast-builder-language-switcher-item">
												<?php if ( $show_flag && 'zz-other' !== $item['id'] ) { ?>
													<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?>">
														<?php
															echo wp_kses(
																self::fetch_flags_svg( $item['id'] ),
																Astra_Addon_Kses::astra_addon_svg_kses_protocols()
															);
														?>
													</span>
												<?php } ?>
												<?php if ( $show_label ) { ?>
													<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?> ast-builder-language-switcher-native-name"> <?php echo esc_html( $item['label'] ); ?></span>
												<?php } ?>
											</a>
										</li>
										<?php
									}
								}
								?>
							</ul></nav>
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php
		}

		/**
		 * Prepare Edit icon inside customizer.
		 */
		public static function render_customizer_edit_button() {
			if ( ! is_callable( 'Astra_Builder_UI_Controller::fetch_svg_icon' ) ) {
				return;
			}
			?>
			<div class="customize-partial-edit-shortcut" data-id="ahfb">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'astra-addon' ); ?>"
						title="<?php esc_attr_e( 'Click to edit this element.', 'astra-addon' ); ?>"
						class="customize-partial-edit-shortcut-button item-customizer-focus">
					<?php
					echo wp_kses(
						Astra_Builder_UI_Controller::fetch_svg_icon( 'edit' ),
						array(
							'svg'   => array(
								'xmlns:xlink'       => array(),
								'version'           => array(),
								'x'                 => array(),
								'y'                 => array(),
								'enable-background' => array(),
								'xml:space'         => array(),
								'class'             => array(),
								'aria-hidden'       => array(),
								'aria-labelledby'   => array(),
								'role'              => array(),
								'xmlns'             => array(),
								'width'             => array(),
								'fill'              => array(),
								'height'            => array(),
								'viewbox'           => array(),
							),
							'g'     => array(
								'fill'      => array(),
								'clip-path' => array(),
							),
							'title' => array( 'title' => array() ),
							'path'  => array(
								'd'            => array(),
								'fill'         => array(),
								'stroke'       => array(),
								'stroke-width' => array(),
							),
						)
					);
					?>
				</button>
			</div>
			<?php
		}

		/**
		 * Get an SVG Icon
		 *
		 * @param string $icon the icon name.
		 * @param bool   $base if the baseline class should be added.
		 */
		public static function fetch_flags_svg( $icon = '', $base = true ) {
			$output = '<span class="ahfb-svg-iconset ast-inline-flex' . ( $base ? ' svg-baseline' : '' ) . '">';

			if ( ! self::$ast_flags ) {
				ob_start();
				include_once ASTRA_EXT_DIR . 'assets/flags/svgs.json'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
				self::$ast_flags = json_decode( ob_get_clean(), true );
				self::$ast_flags = apply_filters( 'astra_addon_flags_svg', self::$ast_flags );
				self::$ast_flags = self::$ast_flags;
			}

			$output .= isset( self::$ast_flags[ $icon ] ) ? self::$ast_flags[ $icon ] : '';
			$output .= '</span>';

			return $output;
		}
	}
}
