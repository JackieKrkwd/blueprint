const path = require('path');

module.exports = ({ file, env }) => {
    const config = {
        plugins: {},
    };

    config.plugins['postcss-import'] = {};
    config.plugins['postcss-mixins'] = {};
	config.plugins['postcss-nested'] = {};
    config.plugins['postcss-preset-env'] = {
        stage: 0,
        autoprefixer: {
            grid: true,
        },
        features: {
            'custom-properties': false,
        },
    };

    config.plugins.cssnano =
        env === 'production'
            ? {
                preset: [
                    'default',
                    {
                        autoprefixer: false,
                        calc: {
                            precision: 8,
                        },
                        convertValues: true,
                        discardComments: {
                            removeAll: true,
                        },
                        mergeLonghand: false,
                        zindex: false,
                    },
                ],
            }
            : false;

    return config;
};
