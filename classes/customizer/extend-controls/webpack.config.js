const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
    ...defaultConfig,
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules,
            {
                test: /\.js$/,
                exclude: /node_modules\/(?!react-sortablejs)/, // Include react-sortablejs
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [ '@babel/preset-env', '@babel/preset-react' ],
                        plugins: [ '@babel/plugin-proposal-class-properties' ],
                    },
                },
            },
        ],
    },
};
