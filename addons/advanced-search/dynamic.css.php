<?php
/**
 * Search CSS - Addon is updated and theme is not updated to v3.2.0.
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_addon_advanced_search_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_addon_advanced_search_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$parse_css = '';

	$adv_search_css = '
	.astra-hfb-header .ast-search-box.full-screen.full-screen ::-webkit-input-placeholder {
		opacity: 0.5;
	}

	.astra-hfb-header .ast-search-box.full-screen.full-screen ::-moz-placeholder {
		/* Firefox 19+ */
		opacity: 0.5;
	}

	.astra-hfb-header .ast-search-box.full-screen.full-screen :-ms-input-placeholder {
		/* IE 10+ */
		opacity: 0.5;
	}

	.astra-hfb-header .ast-search-box.full-screen.full-screen :-moz-placeholder {
		/* Firefox 18- */
		opacity: 0.5;
	}';

	if ( is_rtl() ) {

		$adv_search_css .= '
		.astra-hfb-header .ast-search-box.full-screen.full-screen ::-webkit-input-placeholder {
			opacity: 0.5;
		}

		.astra-hfb-header .ast-search-box.full-screen.full-screen ::-moz-placeholder {
			/* Firefox 19+ */
			opacity: 0.5;
		}

		.astra-hfb-header .ast-search-box.full-screen.full-screen :-ms-input-placeholder {
			/* IE 10+ */
			opacity: 0.5;
		}

		.astra-hfb-header .ast-search-box.full-screen.full-screen :-moz-placeholder {
			/* Firefox 18- */
			opacity: 0.5;
		}
		';
	}

	$parse_css .= Astra_Enqueue_Scripts::trim_css( $adv_search_css );

	return $dynamic_css . $parse_css;
}
