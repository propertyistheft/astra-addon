/**
 * WordPress dependencies
 */
 import { __ } from '@wordpress/i18n';
 import { __experimentalGetSettings, format } from '@wordpress/date'; // eslint-disable-line

 export default function AstFormatDateLabel(
     date,
     fallback = __( 'Click To Pick Date', 'astra-addon' )
 ) {
     const dateSettings = __experimentalGetSettings();
     let label = fallback;

     if ( date ) {
         label = format(
             `${ dateSettings.formats.date } ${ dateSettings.formats.time }`,
             date
         );
     }

     return label;
 }
