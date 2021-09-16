/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package Astra Addon
 * @since  1.0.0
 */

( function( $ ) {

	astra_responsive_font_size( 'astra-settings[font-size-primary-menu]', '.main-navigation, .ast-header-sections-navigation, .ast-above-header-menu-items, .ast-below-header-menu-items' );
	astra_responsive_font_size( 'astra-settings[font-size-post-meta]', '.entry-meta, .read-more' );
	astra_responsive_font_size( 'astra-settings[font-size-post-pagination]', '.ast-pagination .page-numbers, .ast-pagination .page-navigation' );
	astra_responsive_font_size( 'astra-settings[font-size-widget-title]', '.secondary .widget-title' );
	astra_responsive_font_size( 'astra-settings[font-size-widget-content]', '.secondary .widget > *:not(.widget-title)' );
	astra_responsive_font_size( 'astra-settings[font-size-footer-content]', '.ast-small-footer' );

	astra_generate_outside_font_family_css( 'astra-settings[font-family-archive-summary-title]', '.ast-archive-description .ast-archive-title' );
	astra_generate_font_weight_css( 'astra-settings[font-family-archive-summary-title]', 'astra-settings[font-weight-archive-summary-title]', 'font-weight', '.ast-archive-description .ast-archive-title' );
	astra_css( 'astra-settings[line-height-archive-summary-title]', 'line-height', '.ast-archive-description .ast-archive-title' );
	astra_css( 'astra-settings[text-transform-archive-summary-title]', 'text-transform', '.ast-archive-description .ast-archive-title' );

	astra_generate_outside_font_family_css( 'astra-settings[font-family-page-title]', '.blog .entry-title, .blog .entry-title a, .archive .entry-title, .archive .entry-title a, .search .entry-title, .search .entry-title a' );
	astra_generate_font_weight_css( 'astra-settings[font-family-page-title]', 'astra-settings[font-weight-page-title]', 'font-weight', '.blog .entry-title, .blog .entry-title a, .archive .entry-title, .archive .entry-title a, .search .entry-title, .search .entry-title a' );
	astra_css( 'astra-settings[font-weight-page-title]', 'font-weight', '.blog .entry-title, .blog .entry-title a, .archive .entry-title, .archive .entry-title a, .search .entry-title, .search .entry-title a' );
	astra_css( 'astra-settings[line-height-page-title]', 'line-height', '.blog .entry-title, .blog .entry-title a, .archive .entry-title, .archive .entry-title a, .search .entry-title, .search .entry-title a' );
	astra_css( 'astra-settings[text-transform-page-title]', 'text-transform', '.blog .entry-title, .blog .entry-title a, .archive .entry-title, .archive .entry-title a, .search .entry-title, .search .entry-title a' );

	astra_generate_outside_font_family_css( 'astra-settings[font-family-entry-title]', '.ast-single-post .entry-title, .page-title' );
	astra_generate_font_weight_css( 'astra-settings[font-family-entry-title]', 'astra-settings[font-weight-entry-title]', 'font-weight', '.ast-single-post .entry-title, .page-title' );
	astra_css( 'astra-settings[line-height-entry-title]', 'line-height', '.ast-single-post .entry-title, .page-title' );
	astra_css( 'astra-settings[text-transform-entry-title]', 'text-transform', '.ast-single-post .entry-title, .page-title' );

	astra_generate_outside_font_family_css( 'astra-settings[font-family-post-meta]', '.entry-meta, .read-more' );
	astra_generate_font_weight_css( 'astra-settings[font-family-post-meta]', 'astra-settings[font-weight-post-meta]', 'font-weight', '.entry-meta, .read-more' );
	astra_css( 'astra-settings[line-height-post-meta]', 'line-height', '.entry-meta, .read-more' );
	astra_css( 'astra-settings[text-transform-post-meta]', 'text-transform', '.entry-meta, .read-more' );

	astra_css( 'astra-settings[text-transform-post-pagination]', 'text-transform', '.ast-pagination .page-numbers, .ast-pagination .page-navigation' );

	astra_css( 'astra-settings[line-height-footer-content]', 'line-height', '.ast-small-footer' );
	astra_css( 'astra-settings[text-transform-footer-content]', 'text-transform', '.ast-small-footer' );

	astra_css( 'astra-settings[line-height-site-title]', 'line-height', '.site-title a' );
	astra_css( 'astra-settings[text-transform-site-title]', 'text-transform', '.site-title a' );

	astra_css( 'astra-settings[line-height-site-tagline]', 'line-height', '.site-header .site-description' );
	astra_css( 'astra-settings[text-transform-site-tagline]', 'text-transform', '.site-header .site-description' );

	astra_css( 'astra-settings[line-height-widget-title]', 'line-height', '.secondary .widget-title' );
	astra_css( 'astra-settings[text-transform-widget-title]', 'text-transform', '.secondary .widget-title' );

	astra_css( 'astra-settings[line-height-widget-content]', 'line-height', '.secondary .widget > *:not(.widget-title)' );
	astra_css( 'astra-settings[text-transform-widget-content]', 'text-transform', '.secondary .widget > *:not(.widget-title)' );

	// Page builder elementor CSS for line height.
	if( astTypography.addon_page_builder_button_style_css ) {
		// Check if anchors should be loaded in the CSS for headings.
		if (true == astraCustomizer.includeAnchorsInHeadindsCss) {
			astra_css('astra-settings[line-height-h4]', 'line-height', 'h4, .entry-content h4, .entry-content h4 a, .elementor-widget-heading h4.elementor-heading-title');
			astra_css('astra-settings[line-height-h5]', 'line-height', 'h5, .entry-content h5, .entry-content h5 a, .elementor-widget-heading h5.elementor-heading-title');
			astra_css('astra-settings[line-height-h6]', 'line-height', 'h6, .entry-content h6, .entry-content h6 a, .elementor-widget-heading h6.elementor-heading-title');
		} else {
			astra_css('astra-settings[line-height-h4]', 'line-height', 'h4, .entry-content h4, .elementor-widget-heading h4.elementor-heading-title');
			astra_css('astra-settings[line-height-h5]', 'line-height', 'h5, .entry-content h5, .elementor-widget-heading h5.elementor-heading-title');
			astra_css('astra-settings[line-height-h6]', 'line-height', 'h6, .entry-content h6, .elementor-widget-heading h6.elementor-heading-title');
		}
	} else {
		// Check if anchors should be loaded in the CSS for headings.
		if (true == astraCustomizer.includeAnchorsInHeadindsCss) {
			astra_css('astra-settings[line-height-h4]', 'line-height', 'h4, .entry-content h4, .entry-content h4 a');
			astra_css('astra-settings[line-height-h5]', 'line-height', 'h5, .entry-content h5, .entry-content h5 a');
			astra_css('astra-settings[line-height-h6]', 'line-height', 'h6, .entry-content h6, .entry-content h6 a');
		} else {
			astra_css('astra-settings[line-height-h4]', 'line-height', 'h4, .entry-content h4');
			astra_css('astra-settings[line-height-h5]', 'line-height', 'h5, .entry-content h5');
			astra_css('astra-settings[line-height-h6]', 'line-height', 'h6, .entry-content h6');
		}
	}
	// Add widget title support to font-weight preview CSS.
	var h4_widget_title, h5_widget_title, h6_widget_title = '';
	if (true == astraCustomizer.font_weight_support_widget_title) {
		h4_widget_title = 'h4.widget-title';
		h5_widget_title = 'h5.widget-title';
		h6_widget_title = 'h6.widget-title';
	}
	// Check if anchors should be loaded in the CSS for headings.
	if (true == astraCustomizer.includeAnchorsInHeadindsCss) {
		astra_generate_outside_font_family_css( 'astra-settings[font-family-h1]', 'h1, .entry-content h1, .entry-content h1 a' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h1]', 'astra-settings[font-weight-h1]', 'font-weight', 'h1, .entry-content h1, .entry-content h1 a' );
		astra_css('astra-settings[line-height-h1]', 'line-height', 'h1, .entry-content h1, .entry-content h1 a');
		astra_css('astra-settings[text-transform-h1]', 'text-transform', 'h1, .entry-content h1, .entry-content h1 a');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h2]', 'h2, .entry-content h2, .entry-content h2 a' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h2]', 'astra-settings[font-weight-h2]', 'font-weight', 'h2, .entry-content h2, .entry-content h2 a' );
		astra_css('astra-settings[line-height-h2]', 'line-height', 'h2, .entry-content h2, .entry-content h2 a');
		astra_css('astra-settings[text-transform-h2]', 'text-transform', 'h2, .entry-content h2, .entry-content h2 a');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h3]', 'h3, .entry-content h3, .entry-content h3 a' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h3]', 'astra-settings[font-weight-h3]', 'font-weight', 'h3, .entry-content h3, .entry-content h3 a' );
		astra_css('astra-settings[line-height-h3]', 'line-height', 'h3, .entry-content h3, .entry-content h3 a');
		astra_css('astra-settings[text-transform-h3]', 'text-transform', 'h3, .entry-content h3, .entry-content h3 a');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h4]', 'h4, .entry-content h4, .entry-content h4 a' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h4]', 'astra-settings[font-weight-h4]', 'font-weight', 'h4, .entry-content h4, .entry-content h4 a, ' + h4_widget_title );
		astra_css('astra-settings[text-transform-h4]', 'text-transform', 'h4, .entry-content h4, .entry-content h4 a');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h5]', 'h5, .entry-content h5, .entry-content h5 a' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h5]', 'astra-settings[font-weight-h5]', 'font-weight', 'h5, .entry-content h5, .entry-content h5 a, ' + h5_widget_title );
		astra_css('astra-settings[text-transform-h5]', 'text-transform', 'h5, .entry-content h5, .entry-content h5 a');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h6]', 'h6, .entry-content h6, .entry-content h6 a' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h6]', 'astra-settings[font-weight-h6]', 'font-weight', 'h6, .entry-content h6, .entry-content h6 a, ' + h6_widget_title );
		astra_css('astra-settings[text-transform-h6]', 'text-transform', 'h6, .entry-content h6, .entry-content h6 a');
	} else {
		astra_generate_outside_font_family_css( 'astra-settings[font-family-h1]', 'h1, .entry-content h1' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h1]', 'astra-settings[font-weight-h1]', 'font-weight', 'h1, .entry-content h1' );
		astra_css('astra-settings[line-height-h1]', 'line-height', 'h1, .entry-content h1');
		astra_css('astra-settings[text-transform-h1]', 'text-transform', 'h1, .entry-content h1');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h2]', 'h2, .entry-content h2' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h2]', 'astra-settings[font-weight-h2]', 'font-weight', 'h2, .entry-content h2' );
		astra_css('astra-settings[line-height-h2]', 'line-height', 'h2, .entry-content h2');
		astra_css('astra-settings[text-transform-h2]', 'text-transform', 'h2, .entry-content h2');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h3]', 'h3, .entry-content h3' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h3]', 'astra-settings[font-weight-h3]', 'font-weight', 'h3, .entry-content h3' );
		astra_css('astra-settings[line-height-h3]', 'line-height', 'h3, .entry-content h3');
		astra_css('astra-settings[text-transform-h3]', 'text-transform', 'h3, .entry-content h3');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h4]', 'h4, .entry-content h4' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h4]', 'astra-settings[font-weight-h4]', 'font-weight', 'h4, .entry-content h4, ' + h4_widget_title );
		astra_css('astra-settings[text-transform-h4]', 'text-transform', 'h4, .entry-content h4');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h5]', 'h5, .entry-content h5' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h5]', 'astra-settings[font-weight-h5]', 'font-weight', 'h5, .entry-content h5, ' + h5_widget_title );
		astra_css('astra-settings[text-transform-h5]', 'text-transform', 'h5, .entry-content h5');

		astra_generate_outside_font_family_css( 'astra-settings[font-family-h6]', 'h6, .entry-content h6' );
		astra_generate_font_weight_css( 'astra-settings[font-family-h6]', 'astra-settings[font-weight-h6]', 'font-weight', 'h6, .entry-content h6, ' + h6_widget_title );
		astra_css('astra-settings[text-transform-h6]', 'text-transform', 'h6, .entry-content h6');
	}

	astra_css( 'astra-settings[text-transform-button]', 'text-transform', 'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );
	astra_responsive_font_size( 'astra-settings[font-size-button]', 'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

	astra_css( 'astra-settings[outside-menu-line-height]', 'line-height', '.ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items *' );

	var selector = '.main-navigation';

	if ( '' != ast_enabled_addons['header-sections'] ) {
		selector += ', .ast-header-sections-navigation, .ast-above-header-menu-items, .ast-below-header-menu-items';
	}

	astra_generate_outside_font_family_css( 'astra-settings[font-family-primary-menu]', selector );

	var selector = '.main-navigation';

	if ( '' != ast_enabled_addons['header-sections'] ) {
		selector += ', .ast-header-sections-navigation, .ast-above-header-menu-items, .ast-below-header-menu-items';
	}

	astra_css( 'astra-settings[font-weight-primary-menu]', 'font-weight', selector );

	var selector = '.main-header-menu > .menu-item > .sub-menu:first-of-type, .main-header-menu > .menu-item > .astra-full-megamenu-wrapper:first-of-type';

	astra_generate_outside_font_family_css( 'astra-settings[font-family-primary-dropdown-menu]', selector );

	astra_css( 'astra-settings[text-transform-primary-menu]', 'text-transform', '.main-header-bar .main-header-bar-navigation' );

	astra_responsive_font_size( 'astra-settings[font-size-primary-menu]', '.main-navigation, .ast-header-sections-navigation, .ast-above-header-menu-items, .ast-below-header-menu-items' );

	astra_css( 'astra-settings[line-height-primary-menu]', 'line-height', '.main-header-bar' );

	astra_css( 'astra-settings[font-weight-primary-dropdown-menu]', 'font-weight', '.main-header-menu > .menu-item > .sub-menu:first-of-type, .main-header-menu > .menu-item > .astra-full-megamenu-wrapper:first-of-type' );

	astra_css( 'astra-settings[text-transform-primary-dropdown-menu]', 'text-transform', '.main-header-bar .main-header-bar-navigation .sub-menu, .ast-header-sections-navigation .sub-menu, .ast-above-header-menu-items .sub-menu, .ast-below-header-menu-items .sub-menu' );

	astra_responsive_font_size( 'astra-settings[font-size-primary-dropdown-menu]', '.main-header-menu > .menu-item > .sub-menu:first-of-type, .ast-header-sections-navigation li > .sub-menu:first-of-type, .ast-above-header-menu-items .menu-item > .sub-menu:first-of-type, .ast-below-header-menu-items li > .sub-menu:first-of-type, .main-header-menu > .menu-item > .astra-full-megamenu-wrapper:first-of-type' );

	astra_css( 'astra-settings[line-height-primary-dropdown-menu]', 'line-height', '.main-header-bar .main-header-bar-navigation .sub-menu, .ast-header-sections-navigation .sub-menu, .ast-above-header-menu-items .sub-menu, .ast-below-header-menu-items .sub-menu' );

	// Footer Typo

	var selector = '.main-header-menu > .menu-item > .sub-menu:first-of-type, .main-header-menu > .menu-item > .astra-full-megamenu-wrapper:first-of-type';

	astra_generate_outside_font_family_css( 'astra-settings[font-family-footer-content]', '.ast-small-footer' );

	astra_css( 'astra-settings[font-weight-footer-content]', 'font-weight', '.ast-small-footer' );

	astra_css( 'astra-settings[text-transform-footer-content]', 'text-transform', '.ast-small-footer' );

	astra_responsive_font_size( 'astra-settings[font-size-footer-content]', '.ast-small-footer' );

	astra_css( 'astra-settings[line-height-footer-content]', 'line-height', '.ast-small-footer' );

	// Button Typo

	astra_generate_outside_font_family_css( 'astra-settings[font-family-button]', 'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

	astra_generate_font_weight_css( 'astra-settings[font-family-button]', 'astra-settings[font-weight-button]', 'font-weight', 'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

	astra_css( 'astra-settings[text-transform-button]', 'text-transform', 'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

	astra_responsive_font_size( 'astra-settings[font-size-button]', 'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

	astra_css( 'astra-settings[line-height-button]', 'line-height', 'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

	// Sidebar Title Typo

	astra_generate_outside_font_family_css( 'astra-settings[font-family-widget-title]', '.secondary .widget-title' );

	astra_generate_font_weight_css( 'astra-settings[font-family-widget-title]', 'astra-settings[font-weight-widget-title]', 'font-weight', '.secondary .widget-title' );

	astra_css( 'astra-settings[text-transform-widget-title]', 'text-transform', '.secondary .widget-title' );

	astra_responsive_font_size( 'astra-settings[font-size-widget-title]', '.secondary .widget-title' );

	astra_css( 'astra-settings[line-height-widget-title]', 'line-height', '.secondary .widget-title' );

	// Sidebar Content Typo

	astra_generate_outside_font_family_css( 'astra-settings[font-family-widget-content]', '.secondary .widget > *:not(.widget-title)' );

	astra_generate_font_weight_css( 'astra-settings[font-family-widget-content]', 'astra-settings[font-weight-widget-content]', 'font-weight', '.secondary .widget > *:not(.widget-title)' );

	astra_css( 'astra-settings[text-transform-widget-content]', 'text-transform', '.secondary .widget > *:not(.widget-title)' );

	astra_responsive_font_size( 'astra-settings[font-size-widget-content]', '.secondary .widget > *:not(.widget-title)' );

	astra_css( 'astra-settings[line-height-widget-content]', 'line-height', '.secondary .widget > *:not(.widget-title)' );

	// Primary outside menu item Typo
	astra_responsive_font_size( 'astra-settings[outside-menu-font-size]', '.ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items *' );

	astra_css( 'astra-settings[outside-menu-line-height]', 'line-height', '.ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items *' );

	/**
	 * Header - Menu - Typography.
	 */
	for ( var index = 1; index <= astTypography.component_limit; index++ ) {

		var prefix = 'menu' + index;
		var selector = '.ast-hfb-header .ast-builder-menu-' + index + '.ast-builder-menu .main-header-menu';

		if ( astTypography.astra_not_updated ) {
			selector = '.astra-hfb-header .ast-builder-menu-' + index + '.ast-builder-menu .main-header-menu';
		}

		// Sub-Menu Typography.
		astra_generate_outside_font_family_css(
			'astra-settings[header-font-family-' + prefix + '-sub-menu]',
			selector + ' .sub-menu .menu-item .menu-link'
		);
		astra_generate_font_weight_css(
			'astra-settings[header-font-family-' + prefix + '-sub-menu]',
			'astra-settings[header-font-weight-' + prefix + '-sub-menu]',
			'font-weight',
			selector + ' .sub-menu .menu-item .menu-link'
		);
		astra_css(
			'astra-settings[header-text-transform-' + prefix + '-sub-menu]',
			'text-transform',
			selector + ' .sub-menu .menu-item .menu-link'
		);
		astra_responsive_font_size(
			'astra-settings[header-font-size-' + prefix + '-sub-menu]',
			selector + ' .sub-menu .menu-item .menu-link'
		);
		astra_css(
			'astra-settings[header-line-height-' + prefix + '-sub-menu]',
			'line-height',
			selector + ' .sub-menu .menu-item .menu-link'
		);
		astra_css(
			'astra-settings[header-letter-spacing-' + prefix + '-sub-menu]',
			'letter-spacing',
			selector + ' .sub-menu .menu-item .menu-link',
			'px'
		);

		if ( 3 > index ) {

			// Mega Menu Typography.
			astra_generate_outside_font_family_css(
				'astra-settings[header-' + prefix + '-megamenu-heading-font-family]',
				selector + ' .menu-item.menu-item-heading > .menu-link'
			);
			astra_generate_font_weight_css(
				'astra-settings[header-' + prefix + '-megamenu-heading-font-family]',
				'astra-settings[header-' + prefix + '-megamenu-heading-font-weight]',
				'font-weight',
				selector + ' .menu-item.menu-item-heading > .menu-link'
			);
			astra_css(
				'astra-settings[header-' + prefix + '-megamenu-heading-text-transform]',
				'text-transform',
				selector + ' .menu-item.menu-item-heading > .menu-link'
			);
			astra_responsive_font_size(
				'astra-settings[header-' + prefix + '-megamenu-heading-font-size]',
				selector + ' .menu-item.menu-item-heading > .menu-link'
			);
		}
	}
	/**
	 * Mobile menu - Typography
	 */

	var selector = '.ast-hfb-header .ast-builder-menu-mobile .main-header-menu';

	if ( astTypography.astra_not_updated ) {
		selector = '.astra-hfb-header .ast-builder-menu-mobile .main-header-menu';
	}

	// Sub-Menu Typography.
	astra_generate_outside_font_family_css(
		'astra-settings[header-font-family-mobile-menu-sub-menu]',
		selector + ' .sub-menu .menu-item .menu-link'
	);
	astra_generate_font_weight_css(
		'astra-settings[header-font-family-mobile-menu-sub-menu]',
		'astra-settings[header-font-weight-mobile-menu-sub-menu]',
		'font-weight',
		selector + ' .sub-menu .menu-item .menu-link'
	);
	astra_css(
		'astra-settings[header-text-transform-mobile-menu-sub-menu]',
		'text-transform',
		selector + ' .sub-menu .menu-item .menu-link'
	);
	astra_responsive_font_size(
		'astra-settings[header-font-size-mobile-menu-sub-menu]',
		selector + '.ast-nav-menu .sub-menu .menu-item .menu-link'
	);
	astra_css(
		'astra-settings[header-line-height-mobile-menu-sub-menu]',
		'line-height',
		selector + ' .sub-menu .menu-item .menu-link'
	);
	astra_css(
		'astra-settings[header-letter-spacing-mobile-menu-sub-menu]',
		'letter-spacing',
		selector + ' .sub-menu .menu-item .menu-link',
		'px'
	);


	function prepare_html_preview( index ) {

		var prefix = 'html' + index;
		var section = 'section-hb-html-' + index;
		var selector = '.site-header-section .ast-builder-layout-element.ast-header-html-' + index + ' .ast-builder-html-element'

		astra_generate_outside_font_family_css(
			'astra-settings[font-family-' + section + ']',
			selector
		);
		astra_generate_font_weight_css(
			'astra-settings[font-family-' + section + ']',
			'astra-settings[font-weight-' + section + ']',
			'font-weight',
			selector
		);
		astra_css(
			'astra-settings[text-transform-' + section + ']',
			'text-transform',
			selector
		);
		astra_css(
			'astra-settings[line-height-' + section + ']',
			'line-height',
			selector
		);



	}

	function prepare_button_preview(index) {

		// Header.
		var prefix = 'button' + index;
		var selector = '.ast-header-button-' + index + ' .ast-builder-button-wrap';

		astra_generate_outside_font_family_css(
			'astra-settings[header-' + prefix + '-font-family]',
			selector + ' .ast-custom-button'
		);
		astra_generate_font_weight_css(
			'astra-settings[header-' + prefix + '-font-family]',
			'astra-settings[header-' + prefix + '-font-weight]',
			'font-weight',
			selector + ' .ast-custom-button'
		);
		astra_css(
			'astra-settings[header-' + prefix + '-text-transform]',
			'text-transform',
			selector + ' .ast-custom-button'
		);
		astra_css(
			'astra-settings[header-' + prefix + '-line-height]',
			'line-height',
			selector + ' .ast-custom-button'
		);
		astra_css(
			'astra-settings[header-' + prefix + '-letter-spacing]',
			'letter-spacing',
			selector + ' .ast-custom-button',
			'px'
		);

		// Footer.
		var prefix = 'button' + index;
		var selector = '.ast-footer-button-' + index + ' .ast-builder-button-wrap';

		astra_generate_outside_font_family_css(
			'astra-settings[footer-' + prefix + '-font-family]',
			selector + ' .ast-custom-button'
		);
		astra_generate_font_weight_css(
			'astra-settings[footer-' + prefix + '-font-family]',
			'astra-settings[footer-' + prefix + '-font-weight]',
			'font-weight',
			selector + ' .ast-custom-button'
		);
		astra_css(
			'astra-settings[footer-' + prefix + '-text-transform]',
			'text-transform',
			selector + ' .ast-custom-button'
		);
		astra_css(
			'astra-settings[footer-' + prefix + '-line-height]',
			'line-height',
			selector + ' .ast-custom-button'
		);
		astra_css(
			'astra-settings[footer-' + prefix + '-letter-spacing]',
			'letter-spacing',
			selector + ' .ast-custom-button',
			'px'
		);
	}

	function prepare_social_icon_preview(index) {

		// Header.
		var section = 'section-hb-social-icons-' + index;
		var selector = '.ast-builder-layout-element .ast-header-social-' + index + '-wrap';

		astra_generate_outside_font_family_css(
			'astra-settings[font-family-' + section + ']',
			selector
		);
		astra_generate_font_weight_css(
			'astra-settings[font-family-' + section + ']',
			'astra-settings[font-weight-' + section + ']',
			'font-weight',
			selector
		);
		astra_css(
			'astra-settings[text-transform-' + section + ']',
			'text-transform',
			selector
		);
		astra_css(
			'astra-settings[line-height-' + section + ']',
			'line-height',
			selector
		);

		// Footer.
		var section = 'section-fb-social-icons-' + index;
		var selector = '.ast-builder-layout-element .ast-footer-social-' + index + '-wrap';

		astra_generate_outside_font_family_css(
			'astra-settings[font-family-' + section + ']',
			selector
		);
		astra_generate_font_weight_css(
			'astra-settings[font-family-' + section + ']',
			'astra-settings[font-weight-' + section + ']',
			'font-weight',
			selector
		);
		astra_css(
			'astra-settings[text-transform-' + section + ']',
			'text-transform',
			selector
		);
		astra_css(
			'astra-settings[line-height-' + section + ']',
			'line-height',
			selector
		);

	}

	for ( var index = 1; index <= astTypography.component_limit; index++ ) {

		prepare_html_preview(index);
		prepare_button_preview(index);
		prepare_social_icon_preview(index);
		prepare_header_widget_preview(index);
		prepare_footer_widget_preview(index);

	}

	function prepare_header_widget_preview(index) {

		/**
		 * Header - Widget - Typography
		 */

		for ( var index = 1; index <= astTypography.component_limit; index++ ) {

			var prefix = 'widget-' + index;
			var selector = '.header-widget-area[data-section="sidebar-widgets-header-widget-' + index + '"]';

			/**
			 * Widget Title
			 */
			astra_generate_outside_font_family_css(
				'astra-settings[header-' + prefix + '-font-family]',
				selector + ' .widget-title'
			);
			astra_generate_font_weight_css(
				'astra-settings[header-' + prefix + '-font-family]',
				'astra-settings[header-' + prefix + '-font-weight]',
				'font-weight',
				selector + ' .widget-title'
			);
			astra_css(
				'astra-settings[header-' + prefix + '-text-transform]',
				'text-transform',
				selector + ' .widget-title'
			);
			astra_css(
				'astra-settings[header-' + prefix + '-line-height]',
				'line-height',
				selector + ' .widget-title'
			);
			astra_css(
				'astra-settings[header-' + prefix + '-letter-spacing]',
				'letter-spacing',
				selector + ' .widget-title',
				'px'
			);

			/**
			 * Widget Content
			 */
			astra_generate_outside_font_family_css(
				'astra-settings[header-' + prefix + '-content-font-family]',
				selector + ' .header-widget-area-inner'
			);
			astra_generate_font_weight_css(
				'astra-settings[header-' + prefix + '-content-font-family]',
				'astra-settings[header-' + prefix + '-content-font-weight]',
				'font-weight',
				selector + ' .header-widget-area-inner'
			);
			astra_css(
				'astra-settings[header-' + prefix + '-content-transform]',
				'text-transform',
				selector + ' .header-widget-area-inner'
			);
			astra_css(
				'astra-settings[header-' + prefix + '-content-line-height]',
				'line-height',
				selector + ' .header-widget-area-inner'
			);
			astra_css(
				'astra-settings[header-' + prefix + '-content-letter-spacing]',
				'letter-spacing',
				selector + ' .header-widget-area-inner',
				'px'
			);
		}
	}

	function prepare_footer_widget_preview(index) {

		/**
		 * Footer - Widget - Typography
		 */

		for ( var index = 1; index <= astTypography.component_limit; index++ ) {

			var prefix = 'widget-' + index;
			var selector = '.footer-widget-area[data-section="sidebar-widgets-footer-widget-' + index + '"]';

			/**
			 * Widget Title
			 */
			astra_generate_outside_font_family_css(
				'astra-settings[footer-' + prefix + '-font-family]',
				selector + ' .widget-title'
			);
			astra_generate_font_weight_css(
				'astra-settings[footer-' + prefix + '-font-family]',
				'astra-settings[footer-' + prefix + '-font-weight]',
				'font-weight',
				selector + ' .widget-title'
			);
			astra_css(
				'astra-settings[footer-' + prefix + '-text-transform]',
				'text-transform',
				selector + ' .widget-title'
			);
			astra_css(
				'astra-settings[footer-' + prefix + '-line-height]',
				'line-height',
				selector + ' .widget-title'
			);
			astra_css(
				'astra-settings[footer-' + prefix + '-letter-spacing]',
				'letter-spacing',
				selector + ' .widget-title',
				'px'
			);

			/**
			 * Widget Content
			 */
			astra_generate_outside_font_family_css(
				'astra-settings[footer-' + prefix + '-content-font-family]',
				selector + ' .footer-widget-area-inner'
			);
			astra_generate_font_weight_css(
				'astra-settings[footer-' + prefix + '-content-font-family]',
				'astra-settings[footer-' + prefix + '-content-font-weight]',
				'font-weight',
				selector + ' .footer-widget-area-inner'
			);
			astra_css(
				'astra-settings[footer-' + prefix + '-content-transform]',
				'text-transform',
				selector + ' .footer-widget-area-inner'
			);
			astra_css(
				'astra-settings[footer-' + prefix + '-content-line-height]',
				'line-height',
				selector + ' .footer-widget-area-inner'
			);
			astra_css(
				'astra-settings[footer-' + prefix + '-content-letter-spacing]',
				'letter-spacing',
				selector + ' .footer-widget-area-inner',
				'px'
			);
		}
	}

	/**
	 * Footer - HTML - Typography
	 */

	for ( var index = 1; index <= astTypography.component_limit; index++ ) {

		var prefix = 'html' + index;
		var section = 'section-fb-html-' + index;
		var selector = '.site-footer-section .ast-footer-html-' + index + ' .ast-builder-html-element';

		astra_generate_outside_font_family_css(
			'astra-settings[font-family-' + section + ']',
			selector
		);
		astra_generate_font_weight_css(
			'astra-settings[font-family-' + section + ']',
			'astra-settings[font-weight-' + section + ']',
			'font-weight',
			selector
		);
		astra_css(
			'astra-settings[text-transform-' + section + ']',
			'text-transform',
			selector
		);
		astra_css(
			'astra-settings[line-height-' + section + ']',
			'line-height',
			selector
		);
	}

	/**
	 * Header - Language switcher - Typography
	 */
	var lswitcher_section = 'section-hb-language-switcher';
	var lswitcher_selector = '.ast-lswitcher-item-header';

	astra_responsive_font_size(
		'astra-settings[font-size-' + lswitcher_section + ']',
		lswitcher_selector
	);
	astra_generate_outside_font_family_css(
		'astra-settings[font-family-' + lswitcher_section + ']',
		lswitcher_selector
	);
	astra_generate_font_weight_css(
		'astra-settings[font-family-' + lswitcher_section + ']',
		'astra-settings[font-weight-' + lswitcher_section + ']',
		'font-weight',
		lswitcher_selector
	);
	astra_css(
		'astra-settings[text-transform-' + lswitcher_section + ']',
		'text-transform',
		lswitcher_selector
	);
	astra_css(
		'astra-settings[line-height-' + lswitcher_section + ']',
		'line-height',
		lswitcher_selector
	);


	/**
	 * Footer - Language switcher - Typography
	 */
	var lswitcher_fb_section = 'section-fb-language-switcher';
	var lswitcher_fb_selector = '.ast-lswitcher-item-footer';

	astra_responsive_font_size(
		'astra-settings[font-size-' + lswitcher_fb_section + ']',
		lswitcher_fb_selector
	);
	astra_generate_outside_font_family_css(
		'astra-settings[font-family-' + lswitcher_fb_section + ']',
		lswitcher_fb_selector
	);
	astra_generate_font_weight_css(
		'astra-settings[font-family-' + lswitcher_fb_section + ']',
		'astra-settings[font-weight-' + lswitcher_fb_section + ']',
		'font-weight',
		lswitcher_fb_selector
	);
	astra_css(
		'astra-settings[text-transform-' + lswitcher_fb_section + ']',
		'text-transform',
		lswitcher_fb_selector
	);
	astra_css(
		'astra-settings[line-height-' + lswitcher_fb_section + ']',
		'line-height',
		lswitcher_fb_selector
	);

	/**
	 * Footer - Copyright - Typography
	 */

	var selector = '.ast-footer-copyright';
	var section = 'section-footer-copyright';

	astra_responsive_font_size(
		'astra-settings[font-size-' + section + ']',
		selector
	);

	astra_generate_outside_font_family_css(
		'astra-settings[font-family-' + section + ']',
		selector
	);
	astra_generate_font_weight_css(
		'astra-settings[font-family-' + section + ']',
		'astra-settings[font-weight-' + section + ']',
		'font-weight',
		selector
	);
	astra_css(
		'astra-settings[text-transform-' + section + ']',
		'text-transform',
		selector
	);
	astra_css(
		'astra-settings[line-height-' + section + ']',
		'line-height',
		selector
	);

	/**
	 * Header - Account - Typography
	 */

	var selector = '.ast-header-account-wrap';
	var section = 'section-header-account';

	astra_generate_outside_font_family_css(
		'astra-settings[font-family-' + section + ']',
		selector + ' .ast-header-account-text'
	);
	astra_generate_font_weight_css(
		'astra-settings[font-family-' + section + ']',
		'astra-settings[font-weight-' + section + ']',
		'font-weight',
		selector + ' .ast-header-account-text'
	);
	astra_css(
		'astra-settings[text-transform-' + section + ']',
		'text-transform',
		selector + ' .ast-header-account-text'
	);
	astra_css(
		'astra-settings[line-height-' + section + ']',
		'line-height',
		selector + ' .ast-header-account-text'
	);

	// Menu Typography.
	astra_generate_outside_font_family_css(
		'astra-settings[' + section + '-menu-font-family]',
		selector + ' .main-header-menu.ast-account-nav-menu .menu-link'
	);
	astra_generate_font_weight_css(
		'astra-settings[' + section + '-menu-font-family]',
		'astra-settings[' + section + '-menu-font-weight]',
		'font-weight',
		selector + ' .main-header-menu.ast-account-nav-menu .menu-link'
	);
	astra_css(
		'astra-settings[' + section + '-menu-text-transform]',
		'text-transform',
		selector + ' .main-header-menu.ast-account-nav-menu .menu-link'
	);
	astra_responsive_font_size(
		'astra-settings[' + section + '-menu-font-size]',
		selector + ' .main-header-menu.ast-account-nav-menu .menu-link'
	);
	astra_css(
		'astra-settings[' + section + '-menu-line-height]',
		'line-height',
		selector + ' .main-header-menu.ast-account-nav-menu .menu-link'
	);
	astra_css(
		'astra-settings[' + section + '-menu-letter-spacing]',
		'letter-spacing',
		selector + ' .main-header-menu.ast-account-nav-menu .menu-link',
		'px'
	);

	// Login Popup Typography.
	astra_responsive_font_size(
		'astra-settings[' + section + '-popup-font-size]',
		selector + ' .ast-hb-account-login-form input[type=text], ' + selector + ' .ast-hb-account-login-form input[type=password], ' + selector + ' .ast-hb-account-login-form label,'  + selector + ' .ast-hb-account-login-form-footer .ast-header-account-footer-link'
	);
	astra_responsive_font_size(
		'astra-settings[' + section + '-popup-button-font-size]',
		selector + ' .ast-hb-account-login-form input[type="submit"]'
	);

	/**
     * Footer - Menu - Typography.
     */

	var selector = '#astra-footer-menu';

    astra_generate_outside_font_family_css(
        'astra-settings[footer-menu-font-family]',
        selector + ' .menu-item > a'
	);
	astra_generate_font_weight_css(
		'astra-settings[footer-menu-font-family]',
		'astra-settings[footer-menu-font-weight]',
		'font-weight',
		selector + ' .menu-item > a'
	);
    astra_css(
        'astra-settings[footer-menu-text-transform]',
        'text-transform',
        selector + ' .menu-item > a'
    );
    astra_css(
        'astra-settings[footer-menu-line-height]',
        'line-height',
        selector + ' .menu-item > a'
    );
    astra_css(
        'astra-settings[footer-menu-letter-spacing]',
        'letter-spacing',
        selector + ' .menu-item > a',
        'px'
	);

	/**
	 * Header - Mobile Trigger - Typography.
	 */

	astra_generate_outside_font_family_css(
		'astra-settings[mobile-header-label-font-family]',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu'
	);
	astra_generate_font_weight_css(
		'astra-settings[mobile-header-label-font-family]',
		'astra-settings[mobile-header-label-font-weight]',
		'font-weight',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu'
	);
	astra_css(
		'astra-settings[mobile-header-label-text-transform]',
		'text-transform',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu'
	);
	astra_css(
		'astra-settings[mobile-header-label-line-height]',
		'line-height',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu'
	);

} )( jQuery );
