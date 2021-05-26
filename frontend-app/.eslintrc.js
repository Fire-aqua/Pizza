module.exports = {
  root: true,
  env: {
    node: true,
  },
  plugins: ['prettier', 'vuetify'],
  extends: [
    "plugin:vue/essential",
    "eslint:recommended",
    "@vue/typescript/recommended",
    "@vue/prettier",
    "@vue/prettier/@typescript-eslint",
  ],
  parserOptions: {
    ecmaVersion: 2020,
  },
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'vue/no-v-html': ['off'],
    '@typescript-eslint/camelcase': ['off'],
    '@typescript-eslint/no-non-null-assertion': ['off'],
    'import/prefer-default-export': ['off'],
    'no-param-reassign': ['error', { props: false }],
    'no-unused-expressions': 'off',
    'no-restricted-syntax': ['error', 'LabeledStatement', 'WithStatement'],
    'no-underscore-dangle': ['error', { allow: ['__typename'] }],
    'vue/max-attributes-per-line': ['error', {
      singleline: 1,
      multiline: {
        max: 1,
        allowFirstLine: false,
      },
    }],
    'max-len': [
      'error',
      {
        code: 120,
        tabWidth: 2,
      },
    ],
  },
};
