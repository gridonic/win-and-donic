const path = require('path');

function resolve(dir) {
    return path.join(__dirname, '..', dir);
}

// https://storybook.js.org/configurations/custom-webpack-config/#full-control-mode--default
module.exports = (baseConfig, env, defaultConfig) => {
    Object.assign(baseConfig.resolve, {
            extensions: ['.js', '.vue', '.json'],
            alias: {
                'vue$': 'vue/dist/vue.esm.js',
                '@': resolve('app/js/src')
            }
    });

    return baseConfig;
};
