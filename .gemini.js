module.exports = {
    rootUrl: 'http://lo.win-and-donic.ch',
    gridUrl: 'http://localhost:4444',

    browsers: {
        'chrome-headless': {
            desiredCapabilities: {
                browserName: 'chrome',
                version: '59.0',
                chromeOptions: {
                    args: ['headless']
                }
            }
        }
    },

    system: {
        plugins: {
            'html-reporter': {
                enabled: true,
                path: 'gemini/report'
            }
        }
    }
};
