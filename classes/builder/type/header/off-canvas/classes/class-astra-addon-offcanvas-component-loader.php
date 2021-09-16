<?php
/**
 * Button Styling Loader for Astra theme.
 *
 * @package     Astra Builder
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Initialization
 *
 * @since 3.3.0
 */
class Astra_Addon_Offcanvas_Component_Loader {

	/**
	 * Constructor
	 *
	 * @since 3.3.0
	 */
	public function __construct() {
		add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
		add_filter( 'astra_theme_dynamic_css', array( $this, 'dynamic_css' ) );
		add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 110 );
	}

	/**
	 * Dynamic CSS for Toggle Button on desktop.
	 *
	 * @param  string $dynamic_css  Dynmamically generated CSS string.
	 *
	 * @since 3.3.0
	 * @return string $dynamic_css Appended dynamic CSS.
	 */
	public function dynamic_css( $dynamic_css ) {

		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'mobile-trigger', 'header', 'desktop' ) || is_customize_preview() ) {

			$dynamic_css .= Astra_Enqueue_Scripts::trim_css( self::load_toggle_for_desktop_static_css() );
		}

		return $dynamic_css;
	}

	/**
	 * Default customizer configs.
	 *
	 * @param  array $defaults  Astra options default value array.
	 *
	 * @since 3.3.0
	 */
	public function theme_defaults( $defaults ) {

		$defaults['off-canvas-width'] = array(
			'desktop' => 35,
			'tablet'  => 90,
			'mobile'  => 90,
		);

		return $defaults;
	}

	/**
	 * Load static Toggle for Desktop CSS.
	 *
	 * @since 3.3.0
	 * @return string static css for Toggle for Desktop.
	 */
	public static function load_toggle_for_desktop_static_css() {

		if ( false === Astra_Icons::is_svg_icons() ) {
			$toggle_for_desktop_static_css = '.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation ul.sub-menu .menu-item .menu-link:before,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation ul.sub-menu .menu-item .menu-link:before {
				content: "\e900";
				font-family: "Astra";
				font-size: .65em;
				text-decoration: inherit;
				display: inline-block;
				transform: translate(0, -2px) rotateZ(270deg);
				margin-right: 5px;
			}
			.ast-desktop-header-content .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle::before {
				font-weight: bold;
				content: "\e900";
				font-family: "Astra";
				text-decoration: inherit;
				display: inline-block;
			}';
		} else {
			$toggle_for_desktop_static_css = '
			.ast-desktop-popup-content .menu-link > .menu-text + .icon-arrow, .ast-desktop-popup-content .menu-link > .dropdown-menu-toggle, .ast-desktop-header-content .menu-link > .menu-text + .icon-arrow, .ast-desktop-header-content .menu-link > .dropdown-menu-toggle {
				display: none;
			}
			.ast-desktop-popup-content .sub-menu .menu-link > .icon-arrow:first-of-type, .ast-desktop-header-content .sub-menu .menu-link > .icon-arrow:first-of-type {
				display: inline-block;
				margin-right: 5px;
			}
			.ast-desktop-popup-content .sub-menu .menu-link > .icon-arrow:first-of-type svg, .ast-desktop-header-content .sub-menu .menu-link > .icon-arrow:first-of-type svg {
				top: .2em;
				margin-top: 0px;
				margin-left: 0px;
				width: .65em;
				transform: translate(0,-2px) rotateZ( 270deg );
			}
			.ast-desktop-popup-content .main-header-menu .sub-menu .menu-item:not(.menu-item-has-children) .menu-link .icon-arrow:first-of-type, .ast-desktop-header-content .main-header-menu .sub-menu .menu-item:not(.menu-item-has-children) .menu-link .icon-arrow:first-of-type {
				display: inline-block;
			}
			.ast-desktop-popup-content .ast-submenu-expanded > .ast-menu-toggle, .ast-desktop-header-content .ast-submenu-expanded > .ast-menu-toggle {
				transform: rotateX( 180deg );
			}
			#ast-desktop-header .ast-desktop-header-content .main-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link .icon-arrow svg {
				position: relative;
				right: 0;
				top: 0;
				transform: translate(0, 0%) rotate( 270deg );
			}';
		}

		$toggle_for_desktop_static_css .= '
		/** Toggle on Desktop Feature */
		.ast-desktop-header-content .ast-builder-menu-mobile .ast-builder-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .ast-builder-menu {
		width: 100%;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .ast-main-header-bar-alignment,
		.ast-desktop-popup-content .ast-builder-menu-mobile .ast-main-header-bar-alignment {
		display: block;
		width: 100%;
		flex: auto;
		order: 4;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation {
		width: 100%;
		margin: 0;
		line-height: 3;
		flex: auto;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation {
		display: block;
		width: 100%;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .ast-flex.main-header-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .ast-flex.main-header-menu {
		flex-wrap: wrap;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-menu {
		border-top-width: 1px;
		border-style: solid;
		border-color: #eaeaea;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation li.menu-item,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation li.menu-item {
		width: 100%;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation .menu-item .menu-link,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation .menu-item .menu-link {
		border-bottom-width: 1px;
		border-color: #eaeaea;
		border-style: solid;
		}
		.ast-builder-menu-mobile .main-navigation ul .menu-item .menu-link,
		.ast-builder-menu-mobile .main-navigation ul .menu-item .menu-link {
		padding: 0 20px;
		display: inline-block;
		width: 100%;
		border: 0;
		border-bottom-width: 1px;
		border-style: solid;
		border-color: #eaeaea;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle {
		display: inline-block;
		position: absolute;
		font-size: inherit;
		top: 0px;
		right: 20px;
		cursor: pointer;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		padding: 0 0.907em;
		font-weight: normal;
		line-height: inherit;
		transition: all .2s;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children .sub-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children .sub-menu {
		display: none;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .menu-item-has-children .sub-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .menu-item-has-children .sub-menu {
		display: block;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .ast-nav-menu .sub-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .ast-nav-menu .sub-menu {
		line-height: 3;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .submenu-with-border .sub-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .submenu-with-border .sub-menu {
		border: 0;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-menu .sub-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-menu .sub-menu {
		position: static;
		opacity: 1;
		visibility: visible;
		border: 0;
		width: auto;
		left: auto;
		right: auto;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children > .menu-link:after,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children > .menu-link:after {
		display: none;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .ast-submenu-expanded.menu-item .sub-menu,
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .menu-item-has-children .sub-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .ast-submenu-expanded.menu-item .sub-menu,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .menu-item-has-children .sub-menu,
		.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .astra-full-megamenu-wrapper,
		.ast-desktop-popup-content .ast-builder-menu-mobile .ast-submenu-expanded .astra-full-megamenu-wrapper {
		box-shadow: unset;
		opacity: 1;
		visibility: visible;
		transition: none;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation .sub-menu .menu-item .menu-link,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation .sub-menu .menu-item .menu-link {
		padding-left: 30px;
		}
		.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation .sub-menu .menu-item .sub-menu .menu-link,
		.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation .sub-menu .menu-item .sub-menu .menu-link {
		padding-left: 40px;
		}
		.ast-desktop .main-header-menu > .menu-item .sub-menu:before,
		.ast-desktop .main-header-menu > .menu-item .astra-full-megamenu-wrapper:before {
		position: absolute;
		content: "";
		top: 0;
		left: 0;
		width: 100%;
		transform: translateY(-100%);
		}
		.menu-toggle .ast-close-svg {
		display: none;
		}

		.menu-toggle.toggled .ast-mobile-svg {
		display: none;
		}

		.menu-toggle.toggled .ast-close-svg {
		display: block;
		}

		/** Desktop Off-Canvas CSS */
		.ast-desktop .ast-mobile-popup-drawer .ast-mobile-popup-inner {
		max-width: 20%;
		}

		.ast-desktop .ast-mobile-popup-drawer.ast-mobile-popup-full-width .ast-mobile-popup-inner {
		width: 100%;
		max-width: 100%;
		}

		.ast-desktop .ast-mobile-popup-drawer .ast-mobile-popup-overlay {
		visibility: hidden;
		opacity: 0;
		}

		.ast-off-canvas-active body.ast-main-header-nav-open.ast-desktop {
		overflow: auto;
		}

		body.admin-bar.ast-desktop .ast-mobile-popup-drawer .ast-mobile-popup-inner {
		top: 32px;
		}

		/** Default Spacing for Mobile Header elements except Menu */
		.ast-mobile-popup-content .ast-builder-layout-element:not(.ast-builder-menu):not(.ast-header-divider-element),
		.ast-desktop-popup-content .ast-builder-layout-element:not(.ast-builder-menu):not(.ast-header-divider-element),
		.ast-mobile-header-content .ast-builder-layout-element:not(.ast-builder-menu):not(.ast-header-divider-element),
		.ast-desktop-header-content .ast-builder-layout-element:not(.ast-builder-menu):not(.ast-header-divider-element) {
		padding: 15px 20px;
		}

		.ast-header-break-point .main-navigation .menu-link {
		border: 0;
		}';

		if ( is_rtl() ) {
			$toggle_for_desktop_static_css .= '
			/** Toggle on Desktop Feature */
			.ast-desktop-header-content .ast-builder-menu-mobile .ast-builder-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .ast-builder-menu {
			width: 100%;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .ast-main-header-bar-alignment,
			.ast-desktop-popup-content .ast-builder-menu-mobile .ast-main-header-bar-alignment {
			display: block;
			width: 100%;
			flex: auto;
			order: 4;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation {
			width: 100%;
			margin: 0;
			line-height: 3;
			flex: auto;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation {
			display: block;
			width: 100%;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .ast-flex.main-header-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .ast-flex.main-header-menu {
			flex-wrap: wrap;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-header-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-menu {
			border-top-width: 1px;
			border-style: solid;
			border-color: #eaeaea;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation li.menu-item,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation li.menu-item {
			width: 100%;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation .menu-item .menu-link,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation .menu-item .menu-link {
			border-bottom-width: 1px;
			border-color: #eaeaea;
			border-style: solid;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation ul .menu-item .menu-link,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation ul .menu-item .menu-link {
			padding: 0 20px;
			display: inline-block;
			width: 100%;
			border: 0;
			border-bottom-width: 1px;
			border-style: solid;
			border-color: #eaeaea;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle {
			display: inline-block;
			position: absolute;
			font-size: inherit;
			top: 0px;
			left: 20px;
			cursor: pointer;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			padding: 0 0.907em;
			font-weight: normal;
			line-height: inherit;
			transition: all .2s;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children .sub-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children .sub-menu {
			display: none;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .menu-item-has-children .sub-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .menu-item-has-children .sub-menu {
			display: block;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .ast-nav-menu .sub-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .ast-nav-menu .sub-menu {
			line-height: 3;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .submenu-with-border .sub-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .submenu-with-border .sub-menu {
			border: 0;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-header-menu .sub-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-menu .sub-menu {
			position: static;
			opacity: 1;
			visibility: visible;
			border: 0;
			width: auto;
			right: auto;
			left: auto;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children > .menu-link:after,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .menu-item-has-children > .menu-link:after {
			display: none;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .ast-submenu-expanded.menu-item .sub-menu,
			.ast-desktop-header-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .menu-item-has-children .sub-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .ast-submenu-expanded.menu-item .sub-menu,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-header-bar-navigation .toggled .menu-item-has-children .sub-menu {
			box-shadow: unset;
			opacity: 1;
			visibility: visible;
			transition: none;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation .sub-menu .menu-item .menu-link,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation .sub-menu .menu-item .menu-link {
			padding-right: 30px;
			}
			.ast-desktop-header-content .ast-builder-menu-mobile .main-navigation .sub-menu .menu-item .sub-menu .menu-link,
			.ast-desktop-popup-content .ast-builder-menu-mobile .main-navigation .sub-menu .menu-item .sub-menu .menu-link {
			padding-right: 40px;
			}
			.ast-desktop .main-header-menu > .menu-item .sub-menu:before,
			.ast-desktop .main-header-menu > .menu-item .astra-full-megamenu-wrapper:before {
			position: absolute;
			content: "";
			top: 0;
			right: 0;
			width: 100%;
			transform: translateY(-100%);
			}
			.menu-toggle .ast-close-svg {
			display: none;
			}

			.menu-toggle.toggled .ast-mobile-svg {
			display: none;
			}

			.menu-toggle.toggled .ast-close-svg {
			display: block;
			}

			/** Desktop Off-Canvas CSS */
			.ast-desktop .ast-mobile-popup-drawer .ast-mobile-popup-inner {
			max-width: 20%;
			}

			.ast-desktop .ast-mobile-popup-drawer.ast-mobile-popup-full-width .ast-mobile-popup-inner {
			width: 100%;
			max-width: 100%;
			}

			.ast-desktop .ast-mobile-popup-drawer .ast-mobile-popup-overlay {
			visibility: hidden;
			opacity: 0;
			}

			.ast-off-canvas-active body.ast-main-header-nav-open.ast-desktop {
			overflow: auto;
			}

			body.admin-bar.ast-desktop .ast-mobile-popup-drawer .ast-mobile-popup-inner {
			top: 32px;
			}

			/** Default Spacing for Mobile Header elements except Menu */
			.ast-mobile-popup-content .ast-builder-layout-element:not(.ast-builder-menu):not(.ast-header-divider-element),
			.ast-desktop-popup-content .ast-builder-layout-element:not(.ast-builder-menu):not(.ast-header-divider-element),
			.ast-mobile-header-content .ast-builder-layout-element:not(.ast-builder-menu):not(.ast-header-divider-element),
			.ast-desktop-header-content .ast-builder-layout-element:not(.ast-builder-menu):not(.ast-header-divider-element) {
			margin: 15px 20px;
			}

			.ast-header-break-point .main-navigation .menu-link {
			border: 0;
			}';
		}

		return $toggle_for_desktop_static_css;
	}

	/**
	 * Customizer Preview
	 *
	 * @since 3.3.0
	 */
	public function preview_scripts() {
		/**
		 * Load unminified if SCRIPT_DEBUG is true.
		 */
		/* Directory and Extension */
		$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_script( 'astra-addon-offcanvas-customizer-preview-js', ASTRA_ADDON_OFFCANVAS_URI . '/assets/js/' . $dir_name . '/customizer-preview' . $file_prefix . '.js', array( 'customize-preview', 'ahfb-addon-base-customizer-preview' ), ASTRA_EXT_VER, true );
	}
}

/**
*  Kicking this off by creating the object of the class.
*/
new Astra_Addon_Offcanvas_Component_Loader();
