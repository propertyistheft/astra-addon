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

            } else {
                jQuery( '.ast-archive-post' ).removeClass('ast-separate-posts');
            }
        } );
    } );
} )( jQuery );