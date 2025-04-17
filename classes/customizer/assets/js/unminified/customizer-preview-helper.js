const { tabletBreakPoint = 768, mobileBreakPoint = 544 } = astraPreviewHelper;

/**
 * Helper function to generate responsive dynamic CSS.
 *
 * @param {string} section    Section identifier.
 * @param {string} settingKey Customizer setting key.
 * @param {string} selector   CSS selector for the element.
 * @param {Array}  properties CSS properties (e.g. width, height, color, background).
 * @param {string} unit       CSS unit. default ''.
 */
function astraGenerateResponsiveStyle( section, settingKey, selector, properties, unit = '' ) {
	wp.customize( `astra-settings[${ settingKey }]`, function ( value ) {
		value.bind( ( settingValue ) => {
			if ( ! settingValue.desktop && ! settingValue.tablet && ! settingValue.mobile ) return;

			const deviceSpecific = ( device ) => {
				let style = selector + ' {\n';
				properties.forEach( ( property ) => {
					style += property + ': ' + settingValue?.[ device ] + unit + ';\n';
				} );
				style += '}\n';
				return style;
			};

			const dynamicStyle = deviceSpecific( 'desktop' ) +
				'@media ( max-width: ' + tabletBreakPoint + 'px ) { ' + deviceSpecific( 'tablet' ) + ' }\n' +
				'@media ( max-width: ' + mobileBreakPoint + 'px ) { ' + deviceSpecific( 'mobile' ) + ' }\n';

			astra_add_dynamic_css( `${ section }-${ settingKey }`, dynamicStyle );
		} );
	} );
}

/**
 * Helper function to generate responsive spacing dynamic CSS.
 *
 * @param {string} section    Section identifier.
 * @param {string} settingKey Customizer setting key.
 * @param {string} selector   CSS selector for the element.
 * @param {string} property   CSS property for spacing (e.g., margin, padding, border-radius).
 */
function astraGenerateResponsiveSpacingStyle( section, settingKey, selector, property ) {
	wp.customize( `astra-settings[${ settingKey }]`, function ( value ) {
		value.bind( ( settingValue ) => {
			if ( ! settingValue.desktop && ! settingValue.tablet && ! settingValue.mobile ) return;

			const properties = property === 'border-radius'
				? [
					'border-top-left-radius',
					'border-top-right-radius',
					'border-bottom-right-radius',
					'border-bottom-left-radius',
				]
				: [
					`${ property }-top`,
					`${ property }-right`,
					`${ property }-bottom`,
					`${ property }-left`,
				];

			const deviceSpecific = ( device ) => {
				return selector + ' {\n' +
					properties[ 0 ] + ': ' + settingValue?.[ device ]?.top + settingValue?.[ device + '-unit' ] + ';\n' +
					properties[ 1 ] + ': ' + settingValue?.[ device ]?.right + settingValue?.[ device + '-unit' ] + ';\n' +
					properties[ 2 ] + ': ' + settingValue?.[ device ]?.bottom + settingValue?.[ device + '-unit' ] + ';\n' +
					properties[ 3 ] + ': ' + settingValue?.[ device ]?.left + settingValue?.[ device + '-unit' ] + ';\n' +
				'}\n';
			};

			const dynamicStyle = deviceSpecific( 'desktop' ) +
				'@media ( max-width: ' + tabletBreakPoint + 'px ) { ' + deviceSpecific( 'tablet' ) + ' }\n' +
				'@media ( max-width: ' + mobileBreakPoint + 'px ) { ' + deviceSpecific( 'mobile' ) + ' }\n';

			astra_add_dynamic_css( `${ section }-${ settingKey }`, dynamicStyle );
		} );
	} );
}

/**
 * Helper function to generate visibility dynamic CSS.
 *
 * @param {string} section    Section identifier.
 * @param {string} settingKey Customizer setting key.
 * @param {string} selector   CSS selector for the element.
 */
function astraGenerateVisibilityStyle( section, settingKey, selector ) {
	wp.customize( `astra-settings[${ settingKey }]`, function ( value ) {
		value.bind( ( visibility ) => {
			const deviceSpecific = ( device ) => `${ selector } { display: ${ ! visibility[ device ] ? 'none' : 'block' } }`;

			const dynamicStyle = deviceSpecific( 'desktop' ) +
				'@media ( max-width: ' + tabletBreakPoint + 'px ) { ' + deviceSpecific( 'tablet' ) + ' }\n' +
				'@media ( max-width: ' + mobileBreakPoint + 'px ) { ' + deviceSpecific( 'mobile' ) + ' }\n';

			astra_add_dynamic_css( `${ section }-${ settingKey }`, dynamicStyle );
		} );
	} );
}
