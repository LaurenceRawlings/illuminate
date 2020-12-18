const path = require('path');
const webpack = require("webpack");

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    plugins: [
        new webpack.ProvidePlugin({
            Vue: ['vue/dist/vue.esm.js', 'default'],
            jQuery: 'jquery',
            $: 'jquery',
            'window.jQuery': 'jquery',
        }),
    ],
};
