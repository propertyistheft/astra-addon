import PropTypes from 'prop-types';
import { useState } from 'react';
import { Button, ToggleControl, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const SelectorComponent = props => {

	const [selectedOptions, setSelectedOptions] = useState( [ props.default, false ] );
	const {
		label,
	} = props;
	let labelHtml = null;

	const onValueChange = ( value ) => {
		const options = [ value, selectedOptions[1] ];
		props.onChange( options );
		setSelectedOptions( options );
	};

	if (label) {
		labelHtml = <h3 className="customize-control-title">{ label }</h3>;
	}

	const optionsHtml = Object.entries( props.options ).map( ( [value, object] ) => {
		const html = (
			<div className="ast-alignment-inner-wrap active" key={ value }>
				<Button
					key={ value }
					onClick={ () => onValueChange( value ) }
					aria-pressed = { value === selectedOptions[0] }
					isPrimary = { value === selectedOptions[0] }
					label = { object.name }cl
					className = "ast-cl-popup"
				>
					<span className="ahfb-icon-set"> { object.icon }</span>
				</Button>
				<label>{ object.name }</label>
			</div>
		);
		return html;
	} );

	const toggleLabel = 'header' === selectedOptions[0] ? __( 'Sticky/Fixed - Header : ', 'astra-addon' ) : __( 'Sticky/Fixed - Footer : ', 'astra-addon' );

	return <>
		{labelHtml}
		<div className="ast-select-wrap"> { optionsHtml }</div>
	</>;
};

export default React.memo( SelectorComponent );
