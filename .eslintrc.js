// https://eslint.org/docs/user-guide/configuring

module.exports = {
    root: true,
    parserOptions: {
        parser: 'babel-eslint'
    },
    env: {
        browser: true,
    },
    // https://github.com/vuejs/eslint-plugin-vue#priority-a-essential-error-prevention
    // consider switching to `plugin:vue/strongly-recommended` or `plugin:vue/recommended` for stricter rules.
    extends: ['plugin:vue/strongly-recommended', 'airbnb-base'],
    // required to lint *.vue files
    plugins: [
        'vue'
    ],
    // check if imports actually resolve
    settings: {
        'import/resolver': {
            webpack: {
                config: 'build/webpack.base.conf.js'
            }
        }
    },
    // add your custom rules here
    rules: {
        // don't require .vue extension when importing
        'import/extensions': ['error', 'always', {
            js: 'never',
            vue: 'never'
        }],
        // disallow reassignment of function parameters
        // disallow parameter object manipulation except for specific exclusions
        'no-param-reassign': ['error', {
            props: true,
            ignorePropertyModificationsFor: [
                'state', // for vuex state
                'acc', // for reduce accumulators
                'e' // for e.returnvalue
            ]
        }],
        // allow optionalDependencies
        'import/no-extraneous-dependencies': ['error', {
            optionalDependencies: ['test/unit/index.js']
        }],
        // allow debugger during development
        'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',

        // Gridonic coding rules from https://github.com/gridonic/coding
        "indent": ["error", 4, {
            "SwitchCase": 1,
            "VariableDeclarator": 1
        }],
        'class-methods-use-this': 0,
        "comma-dangle": ["error", "never"],
        'no-underscore-dangle': 0,
        "no-console": 0,
        "max-len": ["error", 160, 2, {
            "ignoreUrls": true,
            "ignoreComments": false
        }],

        // Additional customizations of eslint-plugin-vue to adhere to gridonic coding guidelines
        // @see https://github.com/vuejs/eslint-plugin-vue
        "vue/html-indent": ["error", 4],
        // Conflicts with `indent` from eslint :(
        // "vue/script-indent": ["error", 4, {
        //   "baseIndent": 1
        // }],
        "vue/max-attributes-per-line": [2, {
            "singleline": 2,
            "multiline": {
                "max": 2,
                "allowFirstLine": false
            }
        }]
    }
}
