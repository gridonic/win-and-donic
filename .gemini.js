const geminiTestPath = 'app/js/test/gemini';

const path = require('path');
const resolve = (subPath) => path.resolve(geminiTestPath, subPath);

module.exports = {
    rootUrl: 'http://localhost:6006',
    gridUrl: 'http://localhost:4444',

    screenshotsDir: resolve('screens'),

    system: {
        plugins: {
            'html-reporter': {
                enabled: true,
                path: resolve('report')
            }
        }
    },

    browsers: {
        chrome: {
            desiredCapabilities: {
                browserName: 'chrome',
                version: '59.0',
                chromeOptions: {
                    args: ['headless']
                }
            }
        }
    },

    sets: {
        all: {
            files: [
                resolve('fixtures')
            ]
        }
    }
};
