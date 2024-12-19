const path = require( 'path' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	resolve: {
		alias: {
			...defaultConfig.resolve.alias,
			'@addon-hooks': path.resolve( '../../../src/hooks/' ),
			'@addon-utils': path.resolve( '../../../src/utils/' ),
		},
	},
};
