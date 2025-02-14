<?php
/**
 * Mega Menu - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_addon_adv_search_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_addon_adv_search_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {
	$css = '';
	if ( false === Astra_Icons::is_svg_icons() ) {
		$search_close_btn = array(
			'.ast-search-box.header-cover #close::before, .ast-search-box.full-screen #close::before' => array(
				'font-family' => 'Astra',
				'content'     => '"\e5cd"',
				'display'     => 'inline-block',
				'transition'  => 'transform .3s ease-in-out',
			),
		);

		/* Parse CSS from array() */
		$css .= astra_parse_css( $search_close_btn );
	}

	$search_style = astra_get_option( 'header-search-box-type' );
	$search_modal = astra_get_option( 'fullsearch-modal-color-mode', 'dark' );
	if ( 'full-screen' === $search_style ) {
		$css .= '
			@media (min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px) {
				.ast-search-box.full-screen a.ast-search-item {
					display: inline-flex;
					width: 50%;
				}
			}
		';

		if ( Astra_Addon_Update_Filter_Function::astra_addon_upgrade_fullscreen_search_submit_style() ) {
			$link_hover_color = astra_get_option( 'link-h-color' );
			$theme_color      = astra_get_option( 'theme-color' );

			$btn_text_color = astra_get_option( 'button-color' );
			if ( empty( $btn_text_color ) ) {
				$btn_text_color = astra_get_foreground_color( $theme_color );
			}
			$btn_bg_color     = astra_get_option( 'button-bg-color', $theme_color );
			$btn_preset_style = astra_get_option( 'button-preset-style' );

			if ( 'button_04' === $btn_preset_style || 'button_05' === $btn_preset_style || 'button_06' === $btn_preset_style ) {

				if ( '' === astra_get_option( 'button-bg-color' ) && '' === astra_get_option( 'button-color' ) ) {
					$btn_text_color = $theme_color;
				} elseif ( '' === astra_get_option( 'button-color' ) ) {
					$btn_text_color = $btn_bg_color;
				}

				$btn_bg_color = 'transparent';
			}

			$btn_bg_h_color   = astra_get_option( 'button-bg-h-color', $link_hover_color );
			$btn_text_h_color = astra_get_option( 'button-h-color' );
			if ( empty( $btn_text_h_color ) ) {
				$btn_text_h_color = astra_get_foreground_color( $link_hover_color );
			}

			$css .= '
				:root {
					--ast-fs-search-submit-background: ' . $btn_bg_color . ';
					--ast-fs-search-text-color: ' . $btn_text_color . ';
					--ast-fs-search-font-size: 1.3em;
				}
				.ast-search-box.full-screen .ast-search-wrapper .search-submit {
					width: 40px;
					height: 40px;
				}
				.ast-search-box.full-screen .ast-icon.icon-search svg {
					margin-top: 4px;
					margin-right: 0;
				}
				.ast-search-box.full-screen .ast-search-wrapper .search-submit:hover {
					background-color: ' . $btn_bg_h_color . ';
					color: ' . $btn_text_h_color . ';
				}
			';
		}

		if ( true === astra_get_option( 'live-search' ) ) {
			$css .= '
				.ast-search-box.full-screen .ast-search-wrapper {
					top: 40%;
				}
				.ast-search-box.full-screen a.ast-search-item:hover {
					background-color: transparent;
				}
				.ast-search-box.full-screen .ast-search--posttype-heading {
					padding-top: 24px;
				}
				.ast-search-box.full-screen .ast-search-item + .ast-search--posttype-heading {
					margin-top: 16px;
				}
				.ast-search-box.full-screen .ast-live-search-results {
					background: transparent;
					box-shadow: none;
					max-height: 300px;
					border: none;
					padding: 5px;
				}
			';
		}

		if ( 'dark' === $search_modal ) {
			$css .= '
				.full-screen label.ast-search--posttype-heading {
					border-color: #9E9E9E;
					color: #fafafa;
					font-size: 1.2em;
				}
				.ast-search-box.full-screen a.ast-search-item {
					color: #e2e2e2;
					font-size: 1em;
				}
				.full-screen label.ast-search--no-results-heading {
					padding: 1em 0;
					color: #e2e2e2;
				}
			';
		} else {
			$css .= '
				.ast-search-box.full-screen a.ast-search-item {
					font-size: 1em;
				}
				.ast-search-box.full-screen .ast-search-wrapper .large-search-text,
				.ast-search-box.full-screen .icon-close {
					color: #000;
				}
				.full-screen label.ast-search--posttype-heading {
					border-color: #1e1e1e;
					color: #000;
					font-size: 1.2em;
				}
				.ast-search-box.full-screen .ast-search-wrapper .search-field,
				.ast-search-box.full-screen .ast-search-wrapper .search-field::placeholder,
				.ast-search-box.full-screen .ast-search-item {
					color: #1e1e1e;
				}
				.ast-search-box.ast-full-search-style--light .search-form fieldset {
					border-color: #1e1e1e;
				}
				.ast-search-box.full-screen .ast-search-wrapper {
					top: 40%;
				}
				.full-screen label.ast-search--no-results-heading {
					padding: 1em 0;
				}
			';
			if ( '' === astra_get_option( 'header-search-overlay-color' ) ) {
				$css .= '
					.ast-search-box.full-screen {
						background:rgb(250, 250, 250, 0.94);
					}
				';
			}
		}
	}

	/* Added width auto for search box style to handle old builder case. */
	if ( astra_addon_builder_helper()->is_header_footer_builder_active === false ) {
		$css .= '
				.site-header .ast-inline-search.ast-search-menu-icon .search-field {
					width: auto;
				}
			';
	}

	return $dynamic_css . $css;
}
