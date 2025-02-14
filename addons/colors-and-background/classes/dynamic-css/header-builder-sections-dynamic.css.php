<?php
/**
 * Colors & Background - Dynamic CSS
 *
 * @package Astra Addon
 * @since 3.5.7
 */

add_filter( 'astra_addon_dynamic_css', 'astra_addon_header_builder_sections_colors_dynamic_css', 99 );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 * @since 3.5.7
 */
function astra_addon_header_builder_sections_colors_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$parse_css = '';

	/**
	 * Header - Menu
	 */
	$num_of_header_menu = astra_addon_builder_helper()->num_of_header_menu;
	for ( $index = 1; $index <= $num_of_header_menu; $index++ ) {

		if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'menu-' . $index, 'header' ) ) {
			continue;
		}

		$_prefix  = 'menu' . $index;
		$_section = 'section-hb-menu-' . $index;

		$selector         = '.ast-builder-menu-' . $index . ' .main-header-menu';
		$selector_desktop = '.ast-desktop .ast-builder-menu-' . $index . ' .main-header-menu';

		$submenu_resp_color           = astra_get_option( 'header-' . $_prefix . '-submenu-color-responsive' );
		$submenu_resp_bg_color        = astra_get_option( 'header-' . $_prefix . '-submenu-bg-color-responsive' );
		$submenu_resp_color_hover     = astra_get_option( 'header-' . $_prefix . '-submenu-h-color-responsive' );
		$submenu_resp_bg_color_hover  = astra_get_option( 'header-' . $_prefix . '-submenu-h-bg-color-responsive' );
		$submenu_resp_color_active    = astra_get_option( 'header-' . $_prefix . '-submenu-a-color-responsive' );
		$submenu_resp_bg_color_active = astra_get_option( 'header-' . $_prefix . '-submenu-a-bg-color-responsive' );

		$submenu_resp_color_desktop = isset( $submenu_resp_color['desktop'] ) ? $submenu_resp_color['desktop'] : '';
		$submenu_resp_color_tablet  = isset( $submenu_resp_color['tablet'] ) ? $submenu_resp_color['tablet'] : '';
		$submenu_resp_color_mobile  = isset( $submenu_resp_color['mobile'] ) ? $submenu_resp_color['mobile'] : '';

		$submenu_resp_bg_color_desktop = isset( $submenu_resp_bg_color['desktop'] ) ? $submenu_resp_bg_color['desktop'] : '';
		$submenu_resp_bg_color_tablet  = isset( $submenu_resp_bg_color['tablet'] ) ? $submenu_resp_bg_color['tablet'] : '';
		$submenu_resp_bg_color_mobile  = isset( $submenu_resp_bg_color['mobile'] ) ? $submenu_resp_bg_color['mobile'] : '';

		$submenu_resp_color_hover_desktop = isset( $submenu_resp_color_hover['desktop'] ) ? $submenu_resp_color_hover['desktop'] : '';
		$submenu_resp_color_hover_tablet  = isset( $submenu_resp_color_hover['tablet'] ) ? $submenu_resp_color_hover['tablet'] : '';
		$submenu_resp_color_hover_mobile  = isset( $submenu_resp_color_hover['mobile'] ) ? $submenu_resp_color_hover['mobile'] : '';

		$submenu_resp_bg_color_hover_desktop = isset( $submenu_resp_bg_color_hover['desktop'] ) ? $submenu_resp_bg_color_hover['desktop'] : '';
		$submenu_resp_bg_color_hover_tablet  = isset( $submenu_resp_bg_color_hover['tablet'] ) ? $submenu_resp_bg_color_hover['tablet'] : '';
		$submenu_resp_bg_color_hover_mobile  = isset( $submenu_resp_bg_color_hover['mobile'] ) ? $submenu_resp_bg_color_hover['mobile'] : '';

		$submenu_resp_color_active_desktop = isset( $submenu_resp_color_active['desktop'] ) ? $submenu_resp_color_active['desktop'] : '';
		$submenu_resp_color_active_tablet  = isset( $submenu_resp_color_active['tablet'] ) ? $submenu_resp_color_active['tablet'] : '';
		$submenu_resp_color_active_mobile  = isset( $submenu_resp_color_active['mobile'] ) ? $submenu_resp_color_active['mobile'] : '';

		$submenu_resp_bg_color_active_desktop = isset( $submenu_resp_bg_color_active['desktop'] ) ? $submenu_resp_bg_color_active['desktop'] : '';
		$submenu_resp_bg_color_active_tablet  = isset( $submenu_resp_bg_color_active['tablet'] ) ? $submenu_resp_bg_color_active['tablet'] : '';
		$submenu_resp_bg_color_active_mobile  = isset( $submenu_resp_bg_color_active['mobile'] ) ? $submenu_resp_bg_color_active['mobile'] : '';

		if ( 3 > $index ) {
			$css_megamenu_output_desktop = array(

				// Mega Menu.
				$selector_desktop . ' .menu-item.menu-item-heading > .menu-link' => array(
					'color' => esc_attr( astra_get_option( 'header-' . $_prefix . '-header-megamenu-heading-color' ) ),
				),
				$selector_desktop . ' .astra-megamenu-li .menu-item.menu-item-heading > .menu-link:hover, ' . $selector_desktop . ' .astra-megamenu-li .menu-item.menu-item-heading:hover > .menu-link' => array(
					'color' => esc_attr( astra_get_option( 'header-' . $_prefix . '-header-megamenu-heading-h-color' ) ),
				),
			);
			$parse_css                  .= astra_parse_css( $css_megamenu_output_desktop );
		}
		$css_output_desktop = array(
			// Sub Menu.
			$selector . ' .sub-menu'            => array(
				'background' => $submenu_resp_bg_color_desktop,
			),
			$selector . ' .sub-menu .menu-link' => array(
				'color' => $submenu_resp_color_desktop,
			),
			$selector . ' .sub-menu .menu-item > .ast-menu-toggle' => array(
				'color' => $submenu_resp_color_desktop,
			),
			$selector . ' .sub-menu .menu-item .menu-link:hover' => array(
				'color'      => $submenu_resp_color_hover_desktop,
				'background' => $submenu_resp_bg_color_hover_desktop,
			),
			$selector . ' .sub-menu .menu-item:hover > .menu-link,' . $selector . ' .inline-on-mobile .menu-item:hover > .ast-menu-toggle' => array(
				'color'      => $submenu_resp_color_hover_desktop,
				'background' => $submenu_resp_bg_color_hover_desktop,
			),
			$selector . ' .sub-menu .menu-item:hover > .ast-menu-toggle' => array(
				'color' => $submenu_resp_color_desktop,
			),
			$selector . ' .sub-menu .current-menu-item > .menu-link' => array(
				'color'      => $submenu_resp_color_active_desktop,
				'background' => $submenu_resp_bg_color_active_desktop,
			),
			$selector . ' .sub-menu .current-menu-item > .ast-menu-toggle' => array(
				'color' => $submenu_resp_color_active_desktop,
			),
		);

		$css_output_tablet = array(

			$selector . '.ast-nav-menu .sub-menu' => array(
				'background' => $submenu_resp_bg_color_tablet,
			),
			$selector . '.ast-nav-menu .sub-menu' => array(
				'background' => $submenu_resp_bg_color_tablet,
			),
			$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
				'color' => $submenu_resp_color_tablet,
			),
			$selector . ' .sub-menu .menu-item > .ast-menu-toggle' => array(
				'color' => $submenu_resp_color_tablet,
			),
			$selector . ' .ast-nav-menu .sub-menu .menu-item:hover > .menu-link' => array(
				'color'      => $submenu_resp_color_hover_tablet,
				'background' => $submenu_resp_bg_color_hover_tablet,
			),
			$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link:hover' => array(
				'color'      => $submenu_resp_color_hover_tablet,
				'background' => $submenu_resp_bg_color_hover_tablet,
			),
			$selector . ' .sub-menu .menu-item:hover > .ast-menu-toggle' => array(
				'color'      => $submenu_resp_color_hover_tablet,
				'background' => $submenu_resp_bg_color_hover_tablet,
			),
			$selector . '.ast-nav-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
				'color'      => $submenu_resp_color_active_tablet,
				'background' => $submenu_resp_bg_color_active_tablet,
			),
			$selector . ' .sub-menu .current-menu-item > .ast-menu-toggle' => array(
				'color' => $submenu_resp_color_active_tablet,
			),
		);

		$css_output_mobile = array(

			$selector . '.ast-nav-menu .sub-menu' => array(
				'background' => $submenu_resp_bg_color_mobile,
			),
			$selector . '.ast-nav-menu .sub-menu' => array(
				'background' => $submenu_resp_bg_color_mobile,
			),
			$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
				'color' => $submenu_resp_color_mobile,
			),
			$selector . ' .sub-menu .menu-item  > .ast-menu-toggle' => array(
				'color' => $submenu_resp_color_mobile,
			),
			$selector . ' .ast-nav-menu .sub-menu .menu-item:hover > .menu-link' => array(
				'color'      => $submenu_resp_color_hover_mobile,
				'background' => $submenu_resp_bg_color_hover_mobile,
			),
			$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link:hover' => array(
				'color'      => $submenu_resp_color_hover_mobile,
				'background' => $submenu_resp_bg_color_hover_mobile,
			),
			$selector . ' .sub-menu .menu-item:hover  > .ast-menu-toggle' => array(
				'color' => $submenu_resp_color_hover_mobile,
			),
			$selector . '.ast-nav-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
				'color'      => $submenu_resp_color_active_mobile,
				'background' => $submenu_resp_bg_color_active_mobile,
			),
			$selector . ' .sub-menu .current-menu-item  > .ast-menu-toggle' => array(
				'color' => $submenu_resp_color_active_mobile,
			),
		);

		$parse_css .= astra_parse_css( $css_output_desktop );
		$parse_css .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
		$parse_css .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
	}

	/**
	 * Mobile Menu
	 */
	$_section = 'section-header-mobile-menu';

	$selector = '.ast-builder-menu-mobile .main-header-menu';

	if ( version_compare( ASTRA_THEME_VERSION, '3.2.0', '<' ) ) {
		$selector = '.astra-hfb-header .ast-builder-menu-mobile .main-header-menu';
	}

	$submenu_resp_color           = astra_get_option( 'header-mobile-menu-submenu-color-responsive' );
	$submenu_resp_bg_color        = astra_get_option( 'header-mobile-menu-submenu-bg-color-responsive' );
	$submenu_resp_color_hover     = astra_get_option( 'header-mobile-menu-submenu-h-color-responsive' );
	$submenu_resp_bg_color_hover  = astra_get_option( 'header-mobile-menu-submenu-h-bg-color-responsive' );
	$submenu_resp_color_active    = astra_get_option( 'header-mobile-menu-submenu-a-color-responsive' );
	$submenu_resp_bg_color_active = astra_get_option( 'header-mobile-menu-submenu-a-bg-color-responsive' );

	$submenu_resp_color_desktop = isset( $submenu_resp_color['desktop'] ) ? $submenu_resp_color['desktop'] : '';
	$submenu_resp_color_tablet  = isset( $submenu_resp_color['tablet'] ) ? $submenu_resp_color['tablet'] : '';
	$submenu_resp_color_mobile  = isset( $submenu_resp_color['mobile'] ) ? $submenu_resp_color['mobile'] : '';

	$submenu_resp_bg_color_desktop = isset( $submenu_resp_bg_color['desktop'] ) ? $submenu_resp_bg_color['desktop'] : '';
	$submenu_resp_bg_color_tablet  = isset( $submenu_resp_bg_color['tablet'] ) ? $submenu_resp_bg_color['tablet'] : '';
	$submenu_resp_bg_color_mobile  = isset( $submenu_resp_bg_color['mobile'] ) ? $submenu_resp_bg_color['mobile'] : '';

	$submenu_resp_color_hover_desktop = isset( $submenu_resp_color_hover['desktop'] ) ? $submenu_resp_color_hover['desktop'] : '';
	$submenu_resp_color_hover_tablet  = isset( $submenu_resp_color_hover['tablet'] ) ? $submenu_resp_color_hover['tablet'] : '';
	$submenu_resp_color_hover_mobile  = isset( $submenu_resp_color_hover['mobile'] ) ? $submenu_resp_color_hover['mobile'] : '';

	$submenu_resp_bg_color_hover_desktop = isset( $submenu_resp_bg_color_hover['desktop'] ) ? $submenu_resp_bg_color_hover['desktop'] : '';
	$submenu_resp_bg_color_hover_tablet  = isset( $submenu_resp_bg_color_hover['tablet'] ) ? $submenu_resp_bg_color_hover['tablet'] : '';
	$submenu_resp_bg_color_hover_mobile  = isset( $submenu_resp_bg_color_hover['mobile'] ) ? $submenu_resp_bg_color_hover['mobile'] : '';

	$submenu_resp_color_active_desktop = isset( $submenu_resp_color_active['desktop'] ) ? $submenu_resp_color_active['desktop'] : '';
	$submenu_resp_color_active_tablet  = isset( $submenu_resp_color_active['tablet'] ) ? $submenu_resp_color_active['tablet'] : '';
	$submenu_resp_color_active_mobile  = isset( $submenu_resp_color_active['mobile'] ) ? $submenu_resp_color_active['mobile'] : '';

	$submenu_resp_bg_color_active_desktop = isset( $submenu_resp_bg_color_active['desktop'] ) ? $submenu_resp_bg_color_active['desktop'] : '';
	$submenu_resp_bg_color_active_tablet  = isset( $submenu_resp_bg_color_active['tablet'] ) ? $submenu_resp_bg_color_active['tablet'] : '';
	$submenu_resp_bg_color_active_mobile  = isset( $submenu_resp_bg_color_active['mobile'] ) ? $submenu_resp_bg_color_active['mobile'] : '';

	$css_output_desktop = array(

		$selector . '.ast-nav-menu .sub-menu' => array(
			'background' => $submenu_resp_bg_color_desktop,
		),
		$selector . '.ast-nav-menu .sub-menu' => array(
			'background' => $submenu_resp_bg_color_desktop,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
			'color' => $submenu_resp_color_desktop,
		),
		$selector . ' .sub-menu .menu-item > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_desktop,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link:hover' => array(
			'color'      => $submenu_resp_color_hover_desktop,
			'background' => $submenu_resp_bg_color_hover_desktop,
		),
		$selector . ' .sub-menu .menu-item:hover > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_hover_desktop,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'color'      => $submenu_resp_color_active_desktop,
			'background' => $submenu_resp_bg_color_active_desktop,
		),
		$selector . ' .sub-menu .current-menu-item > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_active_desktop,
		),
	);

	$css_output_tablet = array(

		$selector . '.ast-nav-menu .sub-menu' => array(
			'background' => $submenu_resp_bg_color_tablet,
		),
		$selector . '.ast-nav-menu .sub-menu' => array(
			'background' => $submenu_resp_bg_color_tablet,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
			'color' => $submenu_resp_color_tablet,
		),
		$selector . ' .sub-menu .menu-item > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_tablet,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link:hover' => array(
			'color'      => $submenu_resp_color_hover_tablet,
			'background' => $submenu_resp_bg_color_hover_tablet,
		),
		$selector . ' .sub-menu .menu-item:hover > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_hover_tablet,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'color'      => $submenu_resp_color_active_tablet,
			'background' => $submenu_resp_bg_color_active_tablet,
		),
		$selector . ' .sub-menu .current-menu-item > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_active_tablet,
		),
	);

	$css_output_mobile = array(

		$selector . '.ast-nav-menu .sub-menu' => array(
			'background' => $submenu_resp_bg_color_mobile,
		),
		$selector . '.ast-nav-menu .sub-menu' => array(
			'background' => $submenu_resp_bg_color_mobile,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
			'color' => $submenu_resp_color_mobile,
		),
		$selector . ' .sub-menu .menu-item  > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_mobile,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link:hover' => array(
			'color'      => $submenu_resp_color_hover_mobile,
			'background' => $submenu_resp_bg_color_hover_mobile,
		),
		$selector . ' .sub-menu .menu-item:hover  > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_hover_mobile,
		),
		$selector . '.ast-nav-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'color'      => $submenu_resp_color_active_mobile,
			'background' => $submenu_resp_bg_color_active_mobile,
		),
		$selector . ' .sub-menu .current-menu-item  > .ast-menu-toggle' => array(
			'color' => $submenu_resp_color_active_mobile,
		),
	);

	$parse_css .= astra_parse_css( $css_output_desktop );
	$parse_css .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
	$parse_css .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

	/**
	 * Footer - Copyright
	 */

	$css_output = array(
		// Copyright Link.
		'.ast-footer-copyright a'       => array(
			'color' => esc_attr( astra_get_option( 'footer-copyright-link-color' ) ),
		),
		'.ast-footer-copyright a:hover' => array(
			'color' => esc_attr( astra_get_option( 'footer-copyright-link-h-color' ) ),
		),
	);

	$parse_css .= astra_parse_css( $css_output );

	if ( Astra_Addon_Builder_Helper::is_component_loaded( 'account', 'header' ) ) {

		$_section     = 'section-header-account';
		$selector     = '.ast-header-account-wrap';
		$adv_selector = '.ast-advanced-headers .ast-header-account-wrap';

		/**
		 * Header - Account
		 */
		$login_label_color        = astra_get_option( 'header-account-popup-label-color' );
		$login_input_text_color   = astra_get_option( 'header-account-popup-input-text-color' );
		$login_input_border_color = astra_get_option( 'header-account-popup-input-border-color' );
		$login_button_text_color  = astra_get_option( 'header-account-popup-button-text-color' );
		$login_button_bg_color    = astra_get_option( 'header-account-popup-button-bg-color' );
		$popup_bg_color           = astra_get_option( 'header-account-popup-bg-color' );

		// Menu colors.
		$menu_color           = astra_get_option( 'header-account-menu-color' );
		$menu_bg_color        = astra_get_option( 'header-account-menu-bg-obj' );
		$menu_color_hover     = astra_get_option( 'header-account-menu-h-color' );
		$menu_bg_color_hover  = astra_get_option( 'header-account-menu-h-bg-color' );
		$menu_color_active    = astra_get_option( 'header-account-menu-a-color' );
		$menu_bg_color_active = astra_get_option( 'header-account-menu-a-bg-color' );

		if ( false === Astra_Icons::is_svg_icons() ) {
			$account__menu_css = array(
				'.ast-desktop .ast-account-nav-menu .menu-item-has-children > .menu-link:after' => array(
					'content'        => '"\e900"',
					'display'        => 'inline-block',
					'font-family'    => 'Astra',
					'font-size'      => '.6rem',
					'font-weight'    => '700',
					'text-rendering' => 'auto',
					'margin-left'    => '10px',
					'line-height'    => 'normal',
				),
			);
		} else {
			$account__menu_css = array(
				'.account-main-header-bar-navigation .menu-item.menu-item-has-children > .menu-link .icon-arrow svg' => array(
					'position'  => 'absolute',
					'right'     => '.60em',
					'top'       => '50%',
					'transform' => 'translate(0, -50%) rotate( 270deg )',
				),
			);
		}

		/**
		 * Account CSS.
		 */
		$account_css_desktop = array(
			'.ast-hb-account-login-wrapper .ast-hb-account-login-form input[type="submit"]' => array(
				'color'            => esc_attr( $login_button_text_color ),
				'background-color' => esc_attr( $login_button_bg_color ),
			),
			'.ast-hb-account-login-wrapper .ast-hb-account-login-form label, .ast-hb-account-login-wrapper .ast-hb-account-login-form-footer .ast-header-account-footer-link' => array(
				'color' => esc_attr( $login_label_color ),
			),
			'.ast-hb-account-login-wrapper .ast-hb-account-login-form #loginform input[type=text], .ast-hb-account-login-wrapper .ast-hb-account-login-form #loginform input[type=password]' => array(
				'color'        => esc_attr( $login_input_text_color ),
				'border-color' => esc_attr( $login_input_border_color ),
			),
			'.ast-hb-account-login-wrapper .ast-hb-account-login' => array(
				'background' => $popup_bg_color,
			),
			$selector . ' .main-header-menu.ast-account-nav-menu .menu-item .menu-link, ' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .menu-item .menu-link' => array(
				'color' => $menu_color,
			),
			$selector . ' .ast-account-nav-menu .menu-item:hover > .menu-link, ' . $selector . ' .ast-account-nav-menu .menu-item > .menu-link:hover,' . $selector . ' .ast-account-nav-menu .menu-item.current-menu-item:hover > .menu-link, ' . $selector . ' .ast-account-nav-menu .woocommerce-MyAccount-navigation-link.is-active:hover > .menu-link, ' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .menu-item:hover > .menu-link, ' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .menu-item > .menu-link:hover,' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .menu-item.current-menu-item:hover > .menu-link, ' . $adv_selector . ' .ast-account-nav-menu .woocommerce-MyAccount-navigation-link.is-active:hover > .menu-link' => array(
				'color'      => $menu_color_hover,
				'background' => $menu_bg_color_hover,
			),
			$selector . ' .ast-account-nav-menu .menu-item.current-menu-item > .menu-link, ' . $selector . ' .main-header-menu.ast-account-nav-menu .woocommerce-MyAccount-navigation-link.is-active > .menu-link, ' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .menu-item.current-menu-item > .menu-link, ' . $adv_selector . ' .main-header-menu.ast-account-nav-menu .woocommerce-MyAccount-navigation-link.is-active > .menu-link' => array(
				'color'      => $menu_color_active,
				'background' => $menu_bg_color_active,
			),

			$selector . ' .account-main-navigation ul, ' . $selector . ' .account-main-navigation .main-header-menu .menu-link, ' . $selector . ' .account-woo-navigation ul, ' . $adv_selector . ' .account-main-navigation ul, ' . $adv_selector . ' .account-woo-navigation ul' => array(
				'background' => $menu_bg_color,
			),
			$selector . ' .menu-item .menu-link' => array(
				'border-style' => 'none',
			),
		);

		$parse_css .= astra_parse_css( $account__menu_css );
		$parse_css .= astra_parse_css( $account_css_desktop );
	}

	/**
	 * Header - language switcher
	 */
	if ( Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'header' ) ) {
		$_section = 'section-hb-language-switcher';

		$selector = '.ast-header-language-switcher';

		$css_output = array(
			'.ast-lswitcher-item-header' => array(
				'color' => astra_get_option( $_section . '-color' ),
			),
		);

		$parse_css .= astra_parse_css( $css_output );
	}

	/**
	 * Footer - language switcher
	 */
	if ( Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'footer' ) ) {
		$_section = 'section-fb-language-switcher';

		$selector = '.ast-footer-language-switcher';

		$css_output = array(
			'.ast-lswitcher-item-footer' => array(
				'color' => astra_get_option( $_section . '-color' ),
			),
		);

		$parse_css .= astra_parse_css( $css_output );
	}

	return $dynamic_css . $parse_css;
}
