import { useState } from 'react';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { Button } from '@wordpress/components';
import parse from 'html-react-parser';
import svgIcons from '../../../../assets/svg/svgs.json';
import { __ } from '@wordpress/i18n';


const AstPluginInstallNotice = () => {

	// Icon for panel button
    const buttonIcon =  parse( svgIcons['cl-uag-icon'] );

	// Initializing empty object to store text
	let currentTextObject = [];

	// Text object if plugin is only installed and not activated
	if ( ! astCustomLayout.isPluginActivated && astCustomLayout.isPluginInstalled ) {
		currentTextObject = {
			InitalText 		: 'Activate Spectra',
			progressText 	: 'Activating Spectra...',
			errorText 		: 'Error activating Spectra',
			SuccessText 	: 'Spectra Activated',
		}
	}

	// Text object if plugin is not installed
	if ( ! astCustomLayout.isPluginInstalled && ! astCustomLayout.isPluginActivated ) {
		currentTextObject = {
			InitalText 		: 'Install Spectra',
			progressText 	: 'Installing Spectra...',
			errorText 		: 'Error installing Spectra',
			SuccessText 	: 'Spectra Installed',
		}
	}

	// Destructuring set object to access variables directly
	const { InitalText, progressText, errorText, SuccessText } = currentTextObject;

	// Sets button state to change button behaviour accordingly
	const [ buttonState, setButtonState ] = useState( false );

	// Sets button inner text
	const [ buttonText, setButtonText ] = useState( InitalText );

	// Sets button state disable or re-enable button
	const [ disableButton, setDisableButton ] = useState( false );

	// Function to activate plugin
	const activatePlugin = async ( pluginInitSlug ) => {

		// Setting up post request to activate plugin
		const requestActivation = {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
			},
			body: `action=bsf-extention-activate&init=${pluginInitSlug}&security=${astCustomLayout.installPluginNoticeNonce}`
		};

		// Sends a request to activate the plugin
		const reqResponse = await fetch( ajaxurl, requestActivation );

		if ( 200 === reqResponse.status ) {

			// Shows the users that the plugin is successfully installed and reloads the page
			setButtonState( false );
			setButtonText( SuccessText );
			location.reload();

		} else {

			// Shows the user that there an error has occured
			setButtonText( errorText );
			setButtonState( false );

			// Resets state so that the user can retry again
			setTimeout( () => {
				setButtonText( SuccessText );
				setButtonState( false );
				setDisableButton( false );
			}, 2000 );
		}

	}

	// Handles on click to install set plugin
	const handleSubmit = async ( slug, pluginInit, e ) => {

		// Checks if button disabled so that the button can be only clicked once
		if ( false === disableButton ) {

			// Sets all required useStates
			setButtonText( progressText );
			setButtonState( true );
			setDisableButton( true );

			// Checks if plguin is only installed and not activated
			if ( ! astCustomLayout.isPluginActivated && astCustomLayout.isPluginInstalled ) {

				// Activates the set plugin
				activatePlugin( pluginInit );

			} else {

				try {

					// Gets the plugin files if not downloaded
					await wp.updates.installPlugin( {
						slug: slug
					} );

					// Activates the set plugin
					activatePlugin( pluginInit );

				} catch(e) {

					// If the plugin is already downloaded then this check that and activates the set plugin
					if ( 'folder_exists' === e.errorCode ) {

						// Activates the set plugin
						activatePlugin( pluginInit );
					}
				}
			}
		}
	}

	return (
		<>
			<PluginDocumentSettingPanel
				name="ast-plugin-install-panel"
				title={ __( 'Spectra – Gutenberg Blocks', 'astra-addon' ) }
			>
				<p>
					{ __(
						'Spectra – WordPress Gutenberg Blocks plugin can help you take full advantage of Custom Layouts.',
						'astra-addon'
					) }
				</p>
				<Button
					className={ `ast-custom-button-with-padding ${ true === buttonState ? 'is-busy ' : '' } `}
					onClick={ () => handleSubmit( 'ultimate-addons-for-gutenberg', 'ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php' ) }
					isPrimary={ true }
					aria-disabled={ disableButton }
					icon={ buttonIcon }
				>{ __( buttonText, 'astra-addon' ) }</Button>
			</PluginDocumentSettingPanel>
		</>
	)

}

export default AstPluginInstallNotice;
