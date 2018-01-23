/* eslint-disable */
const path = require('path');

module.exports = {
    rootDir: path.resolve(__dirname, '../../../../'),
    moduleFileExtensions: [
        'js',
        'json',
        'vue'
    ],
    moduleNameMapper: {
        '^@/(.*)$': '<rootDir>/app/js/src/$1'
    },
    transform: {
        '^.+\\.js$': '<rootDir>/node_modules/babel-jest',
        '.*\\.(vue)$': '<rootDir>/node_modules/vue-jest'
    },
    snapshotSerializers: ['<rootDir>/node_modules/jest-serializer-vue'],
    setupFiles: ['<rootDir>/app/js/test/jest/setup'],
    mapCoverage: true,
    coverageDirectory: '<rootDir>/test/unit/coverage',
    collectCoverageFrom: [
        'src/**/*.{js,vue}',
        '!src/main.js',
        '!**/node_modules/**'
    ],
    testRegex: 'jest/fixtures/.*',
};
