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
} )( jQuery );
