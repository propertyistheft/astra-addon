import { registerPlugin } from '@wordpress/plugins';
import customLayout from './settings';
import AstPluginInstallNotice from './ast-plugin-install-notice';
import { __ } from '@wordpress/i18n';

registerPlugin( 'astra-custom-layout', { render: customLayout } );

// Checking if plugin is activated, If false then registers the plugin
if( ! astCustomLayout.isPluginActivated ) {

	// Registers plugin
	registerPlugin( 'astra-plugin-install-notice', {
		render: AstPluginInstallNotice,
		icon: false
	} );

	// Set plugin slug
	const pluginSlug = 'astra-plugin-install-notice/ast-plugin-install-panel';

	// Variable to check if the panel is opened
	const isPanelOpened = wp.data.select( 'core/edit-post' ).isEditorPanelOpened( pluginSlug );

	// Toggles the panel open if its closed
	if( ! isPanelOpened ) {
		wp.data
		.dispatch( 'core/edit-post' )
		.toggleEditorPanelOpened(
			pluginSlug
		);
	}
}
