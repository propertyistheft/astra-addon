/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package Astra Addon
 * @since  1.0.0
 */

function astra_refresh_customizer_iframe( control ) {
	wp.customize( control, function( value ) {
		value.bind( function( value ) {
			wp.customize.preview.send( 'refresh' );
		} );
	} );
}

( function( $ ) {

	const tablet_break_point    = AstraAddon.tablet_break_point || 768;
    const mobile_break_point    = AstraAddon.mobile_break_point || 544;
    const is_site_rtl = AstraAddon.rtl;
	const ltr_left    = is_site_rtl ? 'right' : 'left';
	const ltr_right   = is_site_rtl ? 'left' : 'right';
	const socPosition = AstraAddon.soc_position;
	const is_social_fixed = 'left-content' === socPosition || 'right-content' === socPosition;
	const marginRvsLeft = is_social_fixed ? 'top' : ltr_left;
	const marginRvsRight = is_social_fixed ? 'bottom' : ltr_right;


    // Space Between Posts.
    wp.customize( 'astra-settings[blog-space-bet-posts]', function( value ) {
        value.bind( function( value ) {
            if ( value ) {
                jQuery( '.ast-archive-post' ).addClass('ast-separate-posts');

				var dynamicStyle  = '.ast-separate-container .ast-grid-2 > .site-main > .ast-row, .ast-separate-container .ast-grid-3 > .site-main > .ast-row, .ast-separate-container .ast-grid-4 > .site-main > .ast-row {';
					dynamicStyle += '	margin-left: -1em;';
					dynamicStyle += '	margin-right: -1em;';
					dynamicStyle += '}';
				astra_add_dynamic_css( 'archive-title-spacing-layout', dynamicStyle );

            } else {
                jQuery( '.ast-archive-post' ).removeClass('ast-separate-posts');

				var dynamicStyle  = '.ast-separate-container .ast-grid-2 > .site-main > .ast-row, .ast-separate-container .ast-grid-3 > .site-main > .ast-row, .ast-separate-container .ast-grid-4 > .site-main > .ast-row {';
					dynamicStyle += '	margin-left: 0;';
					dynamicStyle += '	margin-right: 0;';
					dynamicStyle += '}';
				astra_add_dynamic_css( 'archive-title-spacing-layout', dynamicStyle );
            }
        } );
    } );


	const context = 'ss'; // Short for social sharing.
	const selector = '.ast-post-social-sharing';
	const selector2 = '.ast-author-box-sharing';

	// Icon Color.
	astra_color_responsive_css(
		context + '-soc-color',
		'astra-settings[single-post-social-sharing-icon-color]',
		'fill',
		selector + ' .ast-social-color-type-custom .ast-social-icon-a svg' + ', ' + selector2 + ' .ast-social-color-type-custom .ast-social-icon-a svg'
	);

	astra_color_responsive_css(
		context + '-soc-svg-color-h',
		'astra-settings[single-post-social-sharing-icon-h-color]',
		'fill',
		selector + ' .ast-social-color-type-custom .ast-social-icon-a:hover svg' + ', ' + selector2 + ' .ast-social-color-type-custom .ast-social-icon-a:hover svg'
	);

	// Icon Background Color.
	astra_color_responsive_css(
		context + '-soc-bg-color',
		'astra-settings[single-post-social-sharing-icon-background-color]',
		'background-color',
		selector + ' .ast-social-color-type-custom .ast-social-element' + ', ' + selector2 + ' .ast-social-color-type-custom .ast-social-element'
	);

	astra_color_responsive_css(
		context + '-soc-bg-color-h',
		'astra-settings[single-post-social-sharing-icon-background-h-color]',
		'background-color',
		selector + ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element' + ', ' + selector2 + ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element'
	);

	// Icon Label Color.
	astra_color_responsive_css(
		context + '-soc-label-color',
		'astra-settings[single-post-social-sharing-icon-label-color]',
		'color',
		selector + ' .ast-social-icon-a span.social-item-label' + ', ' + selector2 + ' .ast-social-icon-a span.social-item-label'
	);

	astra_color_responsive_css(
		context + '-soc-label-color-h',
		'astra-settings[single-post-social-sharing-icon-label-h-color]',
		'color',
		selector + ' .ast-social-icon-a:hover span.social-item-label' + ', ' + selector2 + ' .ast-social-icon-a:hover span.social-item-label'
	);

	// Heading Color.
	astra_color_responsive_css(
		context + '-soc-heading-color',
		'astra-settings[single-post-social-sharing-heading-color]',
		'color',
		selector + ' .ast-social-sharing-heading' + ', ' + selector2 + ' .ast-social-sharing-heading'
	);

	astra_color_responsive_css(
		context + '-soc-heading-color-h',
		'astra-settings[single-post-social-sharing-heading-h-color]',
		'color',
		selector + ' .ast-social-sharing-heading:hover' + ', ' + selector2 + ' .ast-social-sharing-heading:hover'
	);

	astra_color_responsive_css(
		context + '-soc-background-color',
		'astra-settings[single-post-social-sharing-background-color]',
		'background-color',
		selector + ' .ast-social-inner-wrap' + ', ' + selector2 + ' .ast-social-inner-wrap'
	);

	// Social sharing alignment.
	wp.customize( 'astra-settings[single-post-social-sharing-alignment]', function( value ) {
		value.bind( function( alignment ) {
			const alignment_rtl = alignment === ltr_left ? 'flex-start' : 'flex-end';
			const social_alignment = alignment === 'center' ? 'center' : alignment_rtl
			let dynamicStyle = '';
			dynamicStyle += selector + ', ' + selector2 + '{';
			dynamicStyle += 'align-items: ' + social_alignment + ';';
			dynamicStyle += '} ';

			astra_add_dynamic_css( context + '-soc-alignment', dynamicStyle );
		});
	});

	// Icon Size.
	wp.customize( 'astra-settings[single-post-social-sharing-icon-size]', function( value ) {
		value.bind( function( size ) {


			if( size.desktop != '' || size.tablet != '' || size.mobile != '' ) {
				let dynamicStyle = '';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element svg, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element svg {';
				dynamicStyle += 'height: ' + size.desktop + 'px;';
				dynamicStyle += 'width: ' + size.desktop + 'px;';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element svg, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element svg {';
				dynamicStyle += 'height: ' + size.tablet + 'px;';
				dynamicStyle += 'width: ' + size.tablet + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element svg, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element svg {';
				dynamicStyle += 'height: ' + size.mobile + 'px;';
				dynamicStyle += 'width: ' + size.mobile + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-soc-icon-size', dynamicStyle );
			}
		} );
	} );

	// Icon Space.
	wp.customize( 'astra-settings[single-post-social-sharing-icon-spacing]', function( value ) {
		value.bind( function( spacing ) {
			let space = '';
			let dynamicStyle = '';
			if ( spacing.desktop != '' ) {
				space = spacing.desktop/2;
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a {';
				dynamicStyle += 'margin-'+ marginRvsLeft + ': ' + space + 'px;';
				dynamicStyle += 'margin-'+ marginRvsRight + ': ' + space + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a:first-child {';
				dynamicStyle += 'margin-'+ marginRvsLeft + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a:last-child {';
				dynamicStyle += 'margin-'+ marginRvsRight + ': 0;';
				dynamicStyle += '} ';

				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a {';
				dynamicStyle += 'margin-'+ ltr_left + ': ' + space + 'px;';
				dynamicStyle += 'margin-'+ ltr_right + ': ' + space + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a:first-child {';
				dynamicStyle += 'margin-'+ ltr_left + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a:last-child {';
				dynamicStyle += 'margin-'+ ltr_right + ': 0;';
				dynamicStyle += '} ';
			}

			if ( spacing.tablet != '' ) {
				space = spacing.tablet/2;
				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a {';
				dynamicStyle += 'margin-'+ marginRvsLeft + ': ' + space + 'px;';
				dynamicStyle += 'margin-'+ marginRvsRight + ': ' + space + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a:first-child {';
				dynamicStyle += 'margin-'+ marginRvsLeft + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a:last-child {';
				dynamicStyle += 'margin-'+ marginRvsRight + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a {';
				dynamicStyle += 'margin-'+ ltr_left + ': ' + space + 'px;';
				dynamicStyle += 'margin-'+ ltr_right + ': ' + space + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a:first-child {';
				dynamicStyle += 'margin-'+ ltr_left + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a:last-child {';
				dynamicStyle += 'margin-'+ ltr_right + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';
			}

			if ( spacing.mobile != '' ) {
				space = spacing.mobile/2;
				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a {';
				dynamicStyle += 'margin-'+ marginRvsLeft + ': ' + space + 'px;';
				dynamicStyle += 'margin-'+ marginRvsRight + ': ' + space + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a:first-child {';
				dynamicStyle += 'margin-'+ marginRvsLeft + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-icon-a:last-child {';
				dynamicStyle += 'margin-'+ marginRvsRight + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a {';
				dynamicStyle += 'margin-'+ ltr_left + ': ' + space + 'px;';
				dynamicStyle += 'margin-'+ ltr_right + ': ' + space + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a:first-child {';
				dynamicStyle += 'margin-'+ ltr_left + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += selector2 + ' .ast-social-inner-wrap .ast-social-icon-a:last-child {';
				dynamicStyle += 'margin-'+ ltr_right + ': 0;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';
			}

			astra_add_dynamic_css( context + '-soc-icon-spacing', dynamicStyle );
		} );
	} );

	// Icon Border Radius.
	wp.customize( 'astra-settings[single-post-social-sharing-icon-radius]', function( value ) {
		value.bind( function( size ) {

			if( size.desktop != '' || size.tablet != '' || size.mobile != '' ) {
				let dynamicStyle = '';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element {';
				dynamicStyle += 'border-radius: ' + size.desktop + 'px;';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element {';
				dynamicStyle += 'border-radius: ' + size.tablet + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element {';
				dynamicStyle += 'border-radius: ' + size.mobile + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-soc-icon-radius', dynamicStyle );
			}
		} );
	} );

	// Icon Background Spacing
	wp.customize( 'astra-settings[single-post-social-sharing-icon-background-spacing]', function( value ) {
		value.bind( function( size ) {

			if( size.desktop != '' || size.tablet != '' || size.mobile != '' ) {
				let dynamicStyle = '';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element {';
				dynamicStyle += 'padding: ' + size.desktop + 'px;';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element {';
				dynamicStyle += 'padding: ' + size.tablet + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap .ast-social-element, ' + selector2 + ' .ast-social-inner-wrap .ast-social-element {';
				dynamicStyle += 'padding: ' + size.mobile + 'px;';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-soc-icon-bg-spacing', dynamicStyle );
			}
		} );
	} );

	// Padding.
	wp.customize( 'astra-settings[single-post-social-sharing-padding]', function( value ) {
		value.bind( function( padding ) {
			if(
				padding.desktop.bottom != '' || padding.desktop.top != '' || padding.desktop.left != '' || padding.desktop.right != '' ||
				padding.tablet.bottom != '' || padding.tablet.top != '' || padding.tablet.left != '' || padding.tablet.right != '' ||
				padding.mobile.bottom != '' || padding.mobile.top != '' || padding.mobile.left != '' || padding.mobile.right != ''
			) {
				let dynamicStyle = '';
				dynamicStyle += 'body ' + selector + ' .ast-social-inner-wrap, body ' + selector2 + ' .ast-social-inner-wrap {';
				dynamicStyle += 'padding-left: ' + padding['desktop']['left'] + padding['desktop-unit'] + ';';
				dynamicStyle += 'padding-right: ' + padding['desktop']['right'] + padding['desktop-unit'] + ';';
				dynamicStyle += 'padding-top: ' + padding['desktop']['top'] + padding['desktop-unit'] + ';';
				dynamicStyle += 'padding-bottom: ' + padding['desktop']['bottom'] + padding['desktop-unit'] + ';';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap, ' + selector2 + ' .ast-social-inner-wrap { {';
				dynamicStyle += 'padding-left: ' + padding['tablet']['left'] + padding['tablet-unit'] + ';';
				dynamicStyle += 'padding-right: ' + padding['tablet']['right'] + padding['tablet-unit'] + ';';
				dynamicStyle += 'padding-top: ' + padding['tablet']['top'] + padding['tablet-unit'] + ';';
				dynamicStyle += 'padding-bottom: ' + padding['tablet']['bottom'] + padding['tablet-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap, ' + selector2 + ' .ast-social-inner-wrap { {';
				dynamicStyle += 'padding-left: ' + padding['mobile']['left'] + padding['mobile-unit'] + ';';
				dynamicStyle += 'padding-right: ' + padding['mobile']['right'] + padding['mobile-unit'] + ';';
				dynamicStyle += 'padding-top: ' + padding['mobile']['top'] + padding['mobile-unit'] + ';';
				dynamicStyle += 'padding-bottom: ' + padding['mobile']['bottom'] + padding['mobile-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-soc-padding', dynamicStyle );
			}
		} );
	} );

	// Margin.
	wp.customize( 'astra-settings[single-post-social-sharing-margin]', function( value ) {
		value.bind( function( margin ) {
			if(
				margin.desktop.bottom != '' || margin.desktop.top != '' || margin.desktop.left != '' || margin.desktop.right != '' ||
				margin.tablet.bottom != '' || margin.tablet.top != '' || margin.tablet.left != '' || margin.tablet.right != '' ||
				margin.mobile.bottom != '' || margin.mobile.top != '' || margin.mobile.left != '' || margin.mobile.right != ''
			) {
				let dynamicStyle = '';
				dynamicStyle += selector + ' .ast-social-inner-wrap, ' + selector2 + ' .ast-social-inner-wrap {';
				dynamicStyle += 'margin-left: ' + margin['desktop']['left'] + margin['desktop-unit'] + ';';
				dynamicStyle += 'margin-right: ' + margin['desktop']['right'] + margin['desktop-unit'] + ';';
				dynamicStyle += 'margin-top: ' + margin['desktop']['top'] + margin['desktop-unit'] + ';';
				dynamicStyle += 'margin-bottom: ' + margin['desktop']['bottom'] + margin['desktop-unit'] + ';';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap, ' + selector2 + ' .ast-social-inner-wrap {';
				dynamicStyle += 'margin-left: ' + margin['tablet']['left'] + margin['tablet-unit'] + ';';
				dynamicStyle += 'margin-right: ' + margin['tablet']['right'] + margin['tablet-unit'] + ';';
				dynamicStyle += 'margin-top: ' + margin['tablet']['top'] + margin['tablet-unit'] + ';';
				dynamicStyle += 'margin-bottom: ' + margin['tablet']['bottom'] + margin['tablet-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap, ' + selector2 + ' .ast-social-inner-wrap {';
				dynamicStyle += 'margin-left: ' + margin['mobile']['left'] + margin['mobile-unit'] + ';';
				dynamicStyle += 'margin-right: ' + margin['mobile']['right'] + margin['mobile-unit'] + ';';
				dynamicStyle += 'margin-top: ' + margin['mobile']['top'] + margin['mobile-unit'] + ';';
				dynamicStyle += 'margin-bottom: ' + margin['mobile']['bottom'] + margin['mobile-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-soc-margin', dynamicStyle );
			}
		} );
	} );

	// Border Radius.
	wp.customize( 'astra-settings[single-post-social-sharing-border-radius]', function( value ) {
		value.bind( function( radius ) {
			if(
				radius.desktop.bottom != '' || radius.desktop.top != '' || radius.desktop.left != '' || radius.desktop.right != '' ||
				radius.tablet.bottom != '' || radius.tablet.top != '' || radius.tablet.left != '' || radius.tablet.right != '' ||
				radius.mobile.bottom != '' || radius.mobile.top != '' || radius.mobile.left != '' || radius.mobile.right != ''
			) {
				let dynamicStyle = '';
				dynamicStyle += selector + ' .ast-social-inner-wrap, ' + selector2 + ' .ast-social-inner-wrap {';
				dynamicStyle += 'border-top-left-radius: ' + radius['desktop']['top_left'] + radius['desktop-unit'] + ';';
				dynamicStyle += 'border-top-right-radius: ' + radius['desktop']['top_right'] + radius['desktop-unit'] + ';';
				dynamicStyle += 'border-bottom-left-radius: ' + radius['desktop']['bottom_left'] + radius['desktop-unit'] + ';';
				dynamicStyle += 'border-bottom-right-radius: ' + radius['desktop']['bottom_right'] + radius['desktop-unit'] + ';';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap, ' + selector2 + ' .ast-social-inner-wrap {';
				dynamicStyle += 'border-top-left-radius: ' + radius['tablet']['top_left'] + radius['tablet-unit'] + ';';
				dynamicStyle += 'border-top-right-radius: ' + radius['tablet']['top_right'] + radius['tablet-unit'] + ';';
				dynamicStyle += 'border-bottom-left-radius: ' + radius['tablet']['bottom_left'] + radius['tablet-unit'] + ';';
				dynamicStyle += 'border-bottom-right-radius: ' + radius['tablet']['bottom_right'] + radius['tablet-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += selector + ' .ast-social-inner-wrap, ' + selector2 + ' .ast-social-inner-wrap {';
				dynamicStyle += 'border-top-left-radius: ' + radius['mobile']['top_left'] + radius['mobile-unit'] + ';';
				dynamicStyle += 'border-top-right-radius: ' + radius['mobile']['top_right'] + radius['mobile-unit'] + ';';
				dynamicStyle += 'border-bottom-left-radius: ' + radius['mobile']['bottom_left'] + radius['mobile-unit'] + ';';
				dynamicStyle += 'border-bottom-right-radius: ' + radius['mobile']['bottom_right'] + radius['mobile-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-soc-border-radius', dynamicStyle );
			}
		} );
	} );

	wp.customize( 'astra-settings[single-post-social-sharing-heading-text]', function( setting ) {
		setting.bind( function( text ) {
			const SocialHeadingText = document.querySelector('.ast-social-sharing-heading');
			if( SocialHeadingText ) {
				SocialHeadingText.textContent = text;
			}
		} );
	} );

	wp.customize( 'astra-settings[author-box-background]', function( value ) {
		value.bind( function( bg_obj ) {
			astra_background_obj_css( wp.customize, bg_obj, 'author-box-background', '.single .ast-single-author-box .ast-author-meta, .single.ast-separate-container .site-main .ast-author-meta { {{css}} } ' );
		} );
	} );

	astra_border_spacing_advanced_css( 'ast-sub-section-author-box', '.single .ast-single-author-box .ast-author-meta' );

	// Blog and and blog meta.
	astra_refresh_customizer_iframe( 'astra-settings[blog-post-structure]' );
	astra_refresh_customizer_iframe( 'astra-settings[blog-meta-author-avatar-prefix-label]' );
	astra_refresh_customizer_iframe( 'astra-settings[blog-meta-author-avatar]' );
	astra_refresh_customizer_iframe( 'astra-settings[blog-read-more-as-button]' );
	astra_refresh_customizer_iframe( 'astra-settings[blog-excerpt-count]' );

	wp.customize( 'astra-settings[blog-meta-author-avatar-size]', function( setting ) {
		setting.bind( function( size ) {
			if( size != '' ) {
				let dynamicStyle = '';
				dynamicStyle += '.ast-article-post .ast-author-image {';
				dynamicStyle += 'width: ' + size + 'px;';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-bm-author-img-size', dynamicStyle );
			}
		});
	} );

	wp.customize( 'astra-settings[blog-read-more-text]', function( setting ) {
		setting.bind( function( text ) {
			const target = document.querySelectorAll('.ast-article-post .read-more a');
			target.forEach(element => {
				if( element ) {
					element.textContent = text;
				}
			});
		} );
	} );



	/**
	 * Blog: Box Shadow
	*/
	wp.customize( 'astra-settings[blog-item-box-shadow-control]', function( value ) {
		value.bind( function( shadow ) {
			var dynamicStyle = '';

			if( shadow.x != '' && shadow.y != '' && shadow.blur != '' && shadow.spread != '' ) {
				const current_blog_layout = wp.customize( 'astra-settings[blog-layout]' ).get();
				if( current_blog_layout ) {
					const position = wp.customize( 'astra-settings[blog-item-box-shadow-position]' ).get();
					const color = wp.customize( 'astra-settings[blog-item-box-shadow-color]' ).get();
					const blog_grid = wp.customize( 'astra-settings[blog-grid]' ).get();
					let blog_archive_bs_class = '';
					if( 1 === blog_grid ) {
						blog_archive_bs_class = '.ast-separate-container .ast-blog-layout-4-grid .ast-article-post, .ast-separate-container .ast-blog-layout-5-grid .ast-article-post, .ast-separate-container .ast-blog-layout-6-grid .ast-article-post';
					} else {
						blog_archive_bs_class = '.ast-separate-container .ast-blog-layout-4-grid .ast-article-inner, .ast-separate-container .ast-blog-layout-5-grid .ast-article-inner, .ast-separate-container .ast-blog-layout-6-grid .ast-article-inner';
					}

					dynamicStyle = astra_addon_get_shop_items_shadow_css( blog_archive_bs_class, shadow, position, color );
				}
			}
			astra_add_dynamic_css( 'blog-item-box-shadow-control', dynamicStyle );

		} );
	} );

	/**
	* Blog Box Shadow Color.
	*/
	wp.customize( 'astra-settings[blog-item-box-shadow-color]', function( value ) {
		value.bind( function( color ) {
			let dynamicStyle = '';

			if( '' != color ) {
				const current_blog_layout = wp.customize( 'astra-settings[blog-layout]' ).get();
				if( current_blog_layout ) {
					const shadow = wp.customize( 'astra-settings[blog-item-box-shadow-control]' ).get();
					const position = wp.customize( 'astra-settings[blog-item-box-shadow-position]' ).get();
					const blog_grid = wp.customize( 'astra-settings[blog-grid]' ).get();
					let blog_archive_bs_class = '';
					if( 1 === blog_grid ) {
						blog_archive_bs_class = '.ast-separate-container .ast-blog-layout-4-grid .ast-article-post, .ast-separate-container .ast-blog-layout-5-grid .ast-article-post, .ast-separate-container .ast-blog-layout-6-grid .ast-article-post';
					} else {
						blog_archive_bs_class = '.ast-separate-container .ast-blog-layout-4-grid .ast-article-inner, .ast-separate-container .ast-blog-layout-5-grid .ast-article-inner, .ast-separate-container .ast-blog-layout-6-grid .ast-article-inner';
					}

					dynamicStyle = astra_addon_get_shop_items_shadow_css( blog_archive_bs_class, shadow, position, color );
				}
			}
			astra_add_dynamic_css( 'blog-item-box-shadow-color', dynamicStyle );
		} );
	} );

	/**
	* Blog Box Shadow Position.
	*/
	wp.customize( 'astra-settings[blog-item-box-shadow-position]', function( value ) {
		value.bind( function( position ) {
			let dynamicStyle = '';

			if( '' != position ) {
				const current_blog_layout = wp.customize( 'astra-settings[blog-layout]' ).get();
				if( current_blog_layout ){
					const shadow = wp.customize( 'astra-settings[blog-item-box-shadow-control]' ).get();
					const color = wp.customize( 'astra-settings[blog-item-box-shadow-color]' ).get();
					const blog_grid = wp.customize( 'astra-settings[blog-grid]' ).get();
					let blog_archive_bs_class = '';
					if( 1 === blog_grid ) {
						blog_archive_bs_class = '.ast-separate-container .ast-blog-layout-4-grid .ast-article-post, .ast-separate-container .ast-blog-layout-5-grid .ast-article-post, .ast-separate-container .ast-blog-layout-6-grid .ast-article-post';
					} else {
						blog_archive_bs_class = '.ast-separate-container .ast-blog-layout-4-grid .ast-article-inner, .ast-separate-container .ast-blog-layout-5-grid .ast-article-inner, .ast-separate-container .ast-blog-layout-6-grid .ast-article-inner';
					}

					dynamicStyle = astra_addon_get_shop_items_shadow_css( blog_archive_bs_class, shadow, position, color );
				}
			}
			astra_add_dynamic_css( 'blog-item-box-shadow-position', dynamicStyle );
		} );
	} );

	// Typography CSS Generation.
	astra_generate_outside_font_family_css( 'astra-settings[single-post-social-sharing-icon-label-font-family]', selector + ' .social-item-label' );
	astra_generate_font_weight_css( 'astra-settings[single-post-social-sharing-icon-label-font-family]', 'astra-settings[single-post-social-sharing-icon-label-font-weight]', 'font-weight', selector + ' .social-item-label' );
	astra_responsive_font_size( 'astra-settings[single-post-social-sharing-icon-label-font-size]', selector + ' .social-item-label' );
	astra_font_extras_css( 'single-post-social-sharing-icon-label-font-extras', selector + ' .social-item-label' );

	// Social Sharing Heading.
	astra_generate_outside_font_family_css( 'astra-settings[single-post-social-sharing-heading-font-family]', selector + ' .ast-social-sharing-heading' );
	astra_generate_font_weight_css( 'astra-settings[single-post-social-sharing-heading-font-family]', 'astra-settings[single-post-social-sharing-heading-font-weight]', 'font-weight', selector + ' .ast-social-sharing-heading' );
	astra_responsive_font_size( 'astra-settings[single-post-social-sharing-heading-font-size]', selector + ' .ast-social-sharing-heading' );
	astra_font_extras_css( 'single-post-social-sharing-heading-font-extras', selector + ' .ast-social-sharing-heading' );

	// Post navigation.
	astra_css( 'astra-settings[navigation-link-text-color]', 'color', '.single .post-navigation a' );
	astra_css( 'astra-settings[navigation-link-text-h-color]', 'color', '.single .post-navigation a:hover' );
	astra_css( 'astra-settings[navigation-link-bg-color]', 'background-color', '.single .post-navigation a' );
	astra_css( 'astra-settings[navigation-link-bg-h-color]', 'background-color', '.single .post-navigation a:hover' );

	// Blog filter
	const blog_filter_selector = 'li.ast-post-filter-single';
	const blog_filter_parent_selector = '.ast-post-filter ul';
	const blog_filter_main_parent = '.ast-post-filter';


	astra_generate_outside_font_family_css( 'astra-settings[font-family-blog-filter-taxonomy]', blog_filter_selector );
	astra_generate_font_weight_css( 'astra-settings[font-family-blog-filter-taxonomy]', 'astra-settings[font-weight-blog-filter-taxonomy]', 'font-weight', blog_filter_selector );
	astra_responsive_font_size( 'astra-settings[font-size-blog-filter-taxonomy]', blog_filter_selector );
	astra_font_extras_css( 'font-extras-blog-filter-taxonomy', blog_filter_selector );

	astra_css(
		'astra-settings[blog-filter-taxonomy-text-normal-color]',
		'color',
		blog_filter_selector + ':not(.active)'
	);

	astra_css(
		'astra-settings[blog-filter-taxonomy-text-hover-color]',
		'color',
		blog_filter_selector + ':not(.active):hover'
	);

	astra_css(
		'astra-settings[blog-filter-taxonomy-text-active-color]',
		'color',
		blog_filter_selector + '.active'
	);

	astra_css(
		'astra-settings[blog-filter-taxonomy-bg-normal-color]',
		'background-color',
		blog_filter_selector + ':not(.active)'
	);

	astra_css(
		'astra-settings[blog-filter-taxonomy-bg-hover-color]',
		'background-color',
		blog_filter_selector + ':not(.active):hover'
	);

	astra_css(
		'astra-settings[blog-filter-taxonomy-bg-active-color]',
		'background-color',
		blog_filter_selector + '.active'
	);

	// Padding.
	wp.customize( 'astra-settings[blog-filter-inside-spacing]', function( value ) {

		value.bind( function( padding ) {
			if(
				padding.desktop.bottom != '' || padding.desktop.top != '' || padding.desktop.left != '' || padding.desktop.right != '' ||
				padding.tablet.bottom != '' || padding.tablet.top != '' || padding.tablet.left != '' || padding.tablet.right != '' ||
				padding.mobile.bottom != '' || padding.mobile.top != '' || padding.mobile.left != '' || padding.mobile.right != ''
			) {
				let dynamicStyle = '';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'padding-left: ' + padding['desktop']['left'] + padding['desktop-unit'] + ';';
				dynamicStyle += 'padding-right: ' + padding['desktop']['right'] + padding['desktop-unit'] + ';';
				dynamicStyle += 'padding-top: ' + padding['desktop']['top'] + padding['desktop-unit'] + ';';
				dynamicStyle += 'padding-bottom: ' + padding['desktop']['bottom'] + padding['desktop-unit'] + ';';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'padding-left: ' + padding['tablet']['left'] + padding['tablet-unit'] + ';';
				dynamicStyle += 'padding-right: ' + padding['tablet']['right'] + padding['tablet-unit'] + ';';
				dynamicStyle += 'padding-top: ' + padding['tablet']['top'] + padding['tablet-unit'] + ';';
				dynamicStyle += 'padding-bottom: ' + padding['tablet']['bottom'] + padding['tablet-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'padding-left: ' + padding['mobile']['left'] + padding['mobile-unit'] + ';';
				dynamicStyle += 'padding-right: ' + padding['mobile']['right'] + padding['mobile-unit'] + ';';
				dynamicStyle += 'padding-top: ' + padding['mobile']['top'] + padding['mobile-unit'] + ';';
				dynamicStyle += 'padding-bottom: ' + padding['mobile']['bottom'] + padding['mobile-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-bf-padding', dynamicStyle );
			}
		} );
	} );

	// Border Radius.
	wp.customize( 'astra-settings[blog-filter-border-radius]', function( value ) {
		value.bind( function( radius ) {

			if(
				radius.desktop.bottom != '' || radius.desktop.top != '' || radius.desktop.left != '' || radius.desktop.right != '' ||
				radius.tablet.bottom != '' || radius.tablet.top != '' || radius.tablet.left != '' || radius.tablet.right != '' ||
				radius.mobile.bottom != '' || radius.mobile.top != '' || radius.mobile.left != '' || radius.mobile.right != ''
			) {
				let dynamicStyle = '';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'border-top-left-radius: ' + radius['desktop']['top_left'] + radius['desktop-unit'] + ';';
				dynamicStyle += 'border-top-right-radius: ' + radius['desktop']['top_right'] + radius['desktop-unit'] + ';';
				dynamicStyle += 'border-bottom-left-radius: ' + radius['desktop']['bottom_left'] + radius['desktop-unit'] + ';';
				dynamicStyle += 'border-bottom-right-radius: ' + radius['desktop']['bottom_right'] + radius['desktop-unit'] + ';';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'border-top-left-radius: ' + radius['tablet']['top_left'] + radius['tablet-unit'] + ';';
				dynamicStyle += 'border-top-right-radius: ' + radius['tablet']['top_right'] + radius['tablet-unit'] + ';';
				dynamicStyle += 'border-bottom-left-radius: ' + radius['tablet']['bottom_left'] + radius['tablet-unit'] + ';';
				dynamicStyle += 'border-bottom-right-radius: ' + radius['tablet']['bottom_right'] + radius['tablet-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'border-top-left-radius: ' + radius['mobile']['top_left'] + radius['mobile-unit'] + ';';
				dynamicStyle += 'border-top-right-radius: ' + radius['mobile']['top_right'] + radius['mobile-unit'] + ';';
				dynamicStyle += 'border-bottom-left-radius: ' + radius['mobile']['bottom_left'] + radius['mobile-unit'] + ';';
				dynamicStyle += 'border-bottom-right-radius: ' + radius['mobile']['bottom_right'] + radius['mobile-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-bf-border-radius', dynamicStyle );
			}
		} );
	} );

		// Outer Spacing Margin.
		wp.customize( 'astra-settings[blog-filter-outer-parent-spacing]', function( value ) {
			value.bind( function( margin ) {
				if(
					margin.desktop.bottom != '' || margin.desktop.top != '' || margin.desktop.left != '' || margin.desktop.right != '' ||
					margin.tablet.bottom != '' || margin.tablet.top != '' || margin.tablet.left != '' || margin.tablet.right != '' ||
					margin.mobile.bottom != '' || margin.mobile.top != '' || margin.mobile.left != '' || margin.mobile.right != ''
				) {
					let dynamicStyle = '';
					dynamicStyle += blog_filter_main_parent + ' {';
					dynamicStyle += 'margin-left: ' + margin['desktop']['left'] + margin['desktop-unit'] + ';';
					dynamicStyle += 'margin-right: ' + margin['desktop']['right'] + margin['desktop-unit'] + ';';
					dynamicStyle += 'margin-top: ' + margin['desktop']['top'] + margin['desktop-unit'] + ';';
					dynamicStyle += 'margin-bottom: ' + margin['desktop']['bottom'] + margin['desktop-unit'] + ';';
					dynamicStyle += '} ';

					dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
					dynamicStyle += blog_filter_main_parent + ' {';
					dynamicStyle += 'margin-left: ' + margin['tablet']['left'] + margin['tablet-unit'] + ';';
					dynamicStyle += 'margin-right: ' + margin['tablet']['right'] + margin['tablet-unit'] + ';';
					dynamicStyle += 'margin-top: ' + margin['tablet']['top'] + margin['tablet-unit'] + ';';
					dynamicStyle += 'margin-bottom: ' + margin['tablet']['bottom'] + margin['tablet-unit'] + ';';
					dynamicStyle += '} ';
					dynamicStyle += '} ';

					dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
					dynamicStyle += blog_filter_main_parent + ' {';
					dynamicStyle += 'margin-left: ' + margin['mobile']['left'] + margin['mobile-unit'] + ';';
					dynamicStyle += 'margin-right: ' + margin['mobile']['right'] + margin['mobile-unit'] + ';';
					dynamicStyle += 'margin-top: ' + margin['mobile']['top'] + margin['mobile-unit'] + ';';
					dynamicStyle += 'margin-bottom: ' + margin['mobile']['bottom'] + margin['mobile-unit'] + ';';
					dynamicStyle += '} ';
					dynamicStyle += '} ';

					astra_add_dynamic_css( context + '-bf-outer-margin', dynamicStyle );
				}
			} );
		} );

	// Margin.
	wp.customize( 'astra-settings[blog-filter-outside-spacing]', function( value ) {
		value.bind( function( margin ) {
			if(
				margin.desktop.bottom != '' || margin.desktop.top != '' || margin.desktop.left != '' || margin.desktop.right != '' ||
				margin.tablet.bottom != '' || margin.tablet.top != '' || margin.tablet.left != '' || margin.tablet.right != '' ||
				margin.mobile.bottom != '' || margin.mobile.top != '' || margin.mobile.left != '' || margin.mobile.right != ''
			) {
				let dynamicStyle = '';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'margin-left: ' + margin['desktop']['left'] + margin['desktop-unit'] + ';';
				dynamicStyle += 'margin-right: ' + margin['desktop']['right'] + margin['desktop-unit'] + ';';
				dynamicStyle += 'margin-top: ' + margin['desktop']['top'] + margin['desktop-unit'] + ';';
				dynamicStyle += 'margin-bottom: ' + margin['desktop']['bottom'] + margin['desktop-unit'] + ';';
				dynamicStyle += '} ';

				dynamicStyle += blog_filter_parent_selector + ' {';
				dynamicStyle += 'margin-left: -' + margin['desktop']['left'] + margin['desktop-unit'] + ';';
				dynamicStyle += 'margin-right: -' + margin['desktop']['right'] + margin['desktop-unit'] + ';';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'margin-left: ' + margin['tablet']['left'] + margin['tablet-unit'] + ';';
				dynamicStyle += 'margin-right: ' + margin['tablet']['right'] + margin['tablet-unit'] + ';';
				dynamicStyle += 'margin-top: ' + margin['tablet']['top'] + margin['tablet-unit'] + ';';
				dynamicStyle += 'margin-bottom: ' + margin['tablet']['bottom'] + margin['tablet-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += blog_filter_parent_selector + ' {';
				dynamicStyle += 'margin-left: -' + margin['tablet']['left'] + margin['tablet-unit'] + ';';
				dynamicStyle += 'margin-right: -' + margin['tablet']['right'] + margin['tablet-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
				dynamicStyle += blog_filter_selector + ' {';
				dynamicStyle += 'margin-left: ' + margin['mobile']['left'] + margin['mobile-unit'] + ';';
				dynamicStyle += 'margin-right: ' + margin['mobile']['right'] + margin['mobile-unit'] + ';';
				dynamicStyle += 'margin-top: ' + margin['mobile']['top'] + margin['mobile-unit'] + ';';
				dynamicStyle += 'margin-bottom: ' + margin['mobile']['bottom'] + margin['mobile-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += blog_filter_parent_selector + ' {';
				dynamicStyle += 'margin-left: -' + margin['mobile']['left'] + margin['mobile-unit'] + ';';
				dynamicStyle += 'margin-right: -' + margin['mobile']['right'] + margin['mobile-unit'] + ';';
				dynamicStyle += '} ';
				dynamicStyle += '} ';

				astra_add_dynamic_css( context + '-bf-margin', dynamicStyle );
			}
		} );
	} );

		// Social sharing alignment.
		wp.customize( 'astra-settings[blog-filter-alignment]', function( value ) {
			value.bind( function( alignment ) {
				if( alignment.desktop != '' || alignment.tablet != '' || alignment.mobile != '' ) {
					let dynamicStyle = '';
					dynamicStyle += blog_filter_parent_selector + ' {';
					dynamicStyle += 'justify-content: ' + rtl_alignment(alignment['desktop'],'flex-start','flex-end') + ';';
					dynamicStyle += '} ';
					dynamicStyle +=  '@media (max-width: ' + tablet_break_point + 'px) {';
					dynamicStyle += blog_filter_parent_selector + ' {';
					dynamicStyle += 'justify-content: ' + rtl_alignment(alignment['tablet'],'flex-start','flex-end') + ';';
					dynamicStyle += '} ';
					dynamicStyle += '} ';
					dynamicStyle +=  '@media (max-width: ' + mobile_break_point + 'px) {';
					dynamicStyle += blog_filter_parent_selector + ' {';
					dynamicStyle += 'justify-content: ' + rtl_alignment(alignment['mobile'],'flex-start','flex-end') + ';';
					dynamicStyle += '} ';
					dynamicStyle += '} ';
					astra_add_dynamic_css( context + '-bf-alignment', dynamicStyle );
				}
			});
		});

	/*
	 * Responsive Blog filter Visibility
	 */
		wp.customize( 'astra-settings[responsive-blog-filter-visibility]', function( setting ) {
			setting.bind( function( visibility ) {
				const desktopTitleVisibility  = ( visibility['desktop'] ) ? 'block' : 'none';
				const tabletTitleVisibility  = ( visibility['tablet'] ) ? 'block' : 'none';
				const mobileTitleVisibility  = ( visibility['mobile'] ) ? 'block' : 'none';
				const tabletBreakPoint    = astraBuilderPreview.tablet_break_point || 921,
					mobileBreakPoint    = astraBuilderPreview.mobile_break_point || 544;
				const dynamicStyle = '.ast-post-filter { display: ' + desktopTitleVisibility + ';} @media( max-width: ' + tabletBreakPoint + 'px) { .ast-post-filter { display: ' + tabletTitleVisibility + ';} } @media( max-width: ' + mobileBreakPoint + 'px) { .ast-post-filter { display: ' + mobileTitleVisibility + ';} }';
				astra_add_dynamic_css( 'responsive-blog-filter-visibility', dynamicStyle );
			} );
		} );

} )( jQuery );


function rtl_alignment(value, optionLeft, optionRight) {
	const isSiteRtl = AstraAddon.rtl;
	const rtlLeft    = isSiteRtl ? 'right' : 'left';
	const alignmentRtl = ( value === rtlLeft ) ? optionLeft : optionRight;
	return ( value === 'center' ) ? 'center' : alignmentRtl;
}

/**
 * Button Component CSS.
 *
 * @param string builder_type Builder Type.
 * @param string button_count Button Count.
 *
 */
function astra_addon_get_shop_items_shadow_css( selector, shadow, position, color ) {

	var dynamicStyle = '';

	if( shadow.x != '' && shadow.y != '' && shadow.blur != '' && shadow.spread != '' ) {
		var box_shadow_color = ( '' !== color ) ? color + ' ' : 'rgba(0,0,0,0.5) ';
		var shadow_position = ( 'undefined' != typeof position && 'inset' == position ) ? 'inset' : '';
		var x_val = ( '' !== shadow.x ) ? ( shadow.x + 'px ' ) : '0px ';
		var y_val = ( '' !== shadow.y ) ? ( shadow.y + 'px ' ) : '0px ';
		var blur_val = ( '' !== shadow.blur ) ? ( shadow.blur + 'px ' ) : '0px ';
		var spread_val = ( '' !== shadow.spread ) ? ( shadow.spread + 'px ' ) : '0px ';

		dynamicStyle = selector + ' {';
		dynamicStyle += 'box-shadow:' + x_val + y_val + blur_val + spread_val + box_shadow_color + shadow_position + ';';
		dynamicStyle += '}';
	}

	return dynamicStyle;
}
