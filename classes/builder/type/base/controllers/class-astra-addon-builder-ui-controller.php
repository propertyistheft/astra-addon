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

							<nav class="ast-builder-language-switcher" aria-label="<?php esc_html_e( 'Language Switcher', 'astra-addon' ); ?>"><ul class="ast-builder-language-switcher-menu">
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
					} elseif ( 'polylang' === $lang_type && is_callable( 'pll_the_languages' ) ) {
						// Polylang languages items.
						$languages = pll_the_languages( array( 'raw' => true ) );
						$show_code = astra_get_option( $index . '-show-code' );

						if ( ! empty( $languages ) ) {
							?>
							<nav class="ast-builder-language-switcher" aria-label="<?php esc_html_e( 'Language Switcher', 'astra-addon' ); ?>">
								<ul class="ast-builder-language-switcher-menu">
									<?php foreach ( $languages as $language ) { ?>
										<li class="ast-builder-language-switcher-menu-item-<?php echo esc_attr( $builder_type ); ?>">
											<?php $current_class = isset( $language['current_lang'] ) && '1' === $language['current_lang'] ? 'ast-builder-language-switcher-item__active' : ''; ?>

											<a href="<?php echo esc_url( $language['url'] ); ?>" class="ast-builder-language-switcher-item <?php echo esc_attr( $current_class ); ?>">
												<?php if ( $show_flag ) { ?>
													<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?>">
														<img src="<?php echo esc_url( $language['flag'] ); ?>" alt="<?php echo esc_attr( $language['slug'] ); ?>" width="18" height="12" />
													</span>
												<?php } ?>

												<?php if ( $show_label ) { ?>
													<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?> ast-builder-language-switcher-native-name"><?php echo esc_html( $language['name'] ); ?></span>
												<?php } ?>

												<?php if ( $show_code ) { ?>
													<span class="ast-lswitcher-item-<?php echo esc_attr( $builder_type ); ?> ast-builder-language-switcher-language-code"><?php echo '('; ?><?php echo esc_html( $language['slug'] ); ?><?php echo ')'; ?></span>
												<?php } ?>
											</a>
										</li>
									<?php } ?>
								</ul>
							</nav>
							<?php
						}
					} else {

						$items = astra_get_option( $index . '-options' );
						$items = isset( $items['items'] ) ? $items['items'] : array();

						if ( is_array( $items ) && ! empty( $items ) ) {
							?>
							<nav class="ast-builder-language-switcher" aria-label="<?php esc_html_e( 'Language Switcher', 'astra-addon' ); ?>"><ul class="ast-builder-language-switcher-menu">
								<?php
								foreach ( $items as $item ) {
									if ( $item['enabled'] ) {

										$link = '' !== $item['url'] ? $item['url'] : '';
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
		 * Render color switcher markup.
		 *
		 * @param string $index       The index of the color switcher.
		 * @param string $builder_type The type of the builder.
		 *
		 * @since x.x.
		 */
		public static function render_color_switcher_markup( $index = 'header-color-switcher', $builder_type = 'header' ) {
			$default_icon  = astra_get_option( 'color-switcher-icon' );
			$switched_icon = astra_get_option( 'color-switcher-icon-switched' );
			$default_text  = astra_get_i18n_option( 'color-switcher-text', _x( '%astra%', 'Color Switcher: Default Text', 'astra-addon' ) );
			$switched_text = astra_get_i18n_option( 'color-switcher-text-switched', _x( '%astra%', 'Color Switcher: Switched Text', 'astra-addon' ) );
			$is_switched   = Astra_Header_Color_Switcher_Component_Loader::is_switched();

			/* Translators: %s is the name of the default color palette text. */
			$aria_label_default_text = sprintf( __( 'Switch to %s palette', 'astra-addon' ), $switched_text ?: __( 'default', 'astra-addon' ) );

			/* Translators: %s is the name of the switched palette text. */
			$aria_label_switched_text = sprintf( __( 'Switch to %s palette', 'astra-addon' ), $default_text ?: __( 'next', 'astra-addon' ) );

			$aria_label = $is_switched ? $aria_label_default_text : $aria_label_switched_text;

			?>
			<div class="ast-color-switcher-wrapper">
				<?php
				if ( is_customize_preview() ) {
					self::render_customizer_edit_button();
				}
				?>
				<div class="ast-builder-color-switcher">
					<button
						class="ast-switcher-button"
						aria-pressed="<?php echo $is_switched ? 'true' : 'false'; ?>"
						aria-label="<?php echo esc_attr( $aria_label ); ?>"
						data-default-text="<?php echo esc_attr( $aria_label_default_text ); ?>"
						data-switched-text="<?php echo esc_attr( $aria_label_switched_text ); ?>"
					>
						<span class="ast-switcher-icon <?php echo esc_attr( $is_switched ? '' : 'ast-current' ); ?>">
							<?php astra_icon_selector_svg( $default_icon, true ); ?>
							<?php echo empty( $default_text ) ? '' : '<span class="ast-switcher-text">' . esc_html( $default_text ) . '</span>'; ?>
						</span>
						<span class="ast-switcher-icon <?php echo esc_attr( $is_switched ? 'ast-current' : '' ); ?>">
							<?php astra_icon_selector_svg( $switched_icon, true ); ?>
							<?php echo empty( $switched_text ) ? '' : '<span class="ast-switcher-text">' . esc_html( $switched_text ) . '</span>'; ?>
						</span>
					</button>
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
