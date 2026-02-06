const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
    ...defaultConfig,
    entry: {
        'copyright-date/index': path.resolve(process.cwd(), 'src/copyright-date/index.js'),
        'call-to-action/index': path.resolve(process.cwd(), 'src/call-to-action/index.js'),
    },
    output: {
        filename: '[name].js',
        path: path.resolve(process.cwd(), 'build'),
    },
};
