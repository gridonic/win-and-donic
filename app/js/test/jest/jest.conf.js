/* eslint-disable */
const path = require('path');

const rootDir = path.resolve(__dirname, '../../../../');
const srcDir = path.join(rootDir, 'app/js/src');

module.exports = {
    rootDir,
    moduleFileExtensions: [
        'js',
        'json',
        'vue'
    ],
    moduleNameMapper: {
        '^@/(.*)$': `${srcDir}/$1`
    },
    transform: {
        '^.+\\.js$': '<rootDir>/node_modules/babel-jest',
        '.*\\.(vue)$': '<rootDir>/node_modules/vue-jest'
    },
    snapshotSerializers: ['<rootDir>/node_modules/jest-serializer-vue'],
    setupFiles: ['<rootDir>/app/js/test/jest/setup'],
    mapCoverage: true,
    coverageDirectory: '<rootDir>/reports/jest/coverage',
    collectCoverageFrom: [
        'src/**/*.{js,vue}',
        '!src/main.js',
        '!**/*.spec.js',
        '!**/node_modules/**',
        "!**/vendor/**"
    ],
    testRegex: 'jest/fixtures/.*',
};
