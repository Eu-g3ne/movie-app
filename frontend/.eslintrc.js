module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: ['plugin:vue/essential', 'airbnb-base','prettier'],
  parserOptions: {
    ecmaVersion: 'latest',
    parser: '@typescript-eslint/parser',
    sourceType: 'module',
  },
  plugins: ['vue', '@typescript-eslint','prettier'],
  rules: {
    "vue/max-attributes-per-line": ["error", {
      "singleline": {
        "max": 2
      },      
      "multiline": {
        "max": 1
      }
    }],
    'linebreak-style': 0,
    'import/no-extraneous-dependencies': ['error', {
      'devDependencies': true
    }]
  },
};
