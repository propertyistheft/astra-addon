import { registerPlugin } from '@wordpress/plugins';
import customLayout from './settings';
import { __ } from '@wordpress/i18n';

registerPlugin( 'astra-custom-layout', { render: customLayout } );
