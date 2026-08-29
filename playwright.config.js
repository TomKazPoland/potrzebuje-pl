const { defineConfig } = require('@playwright/test');

module.exports = defineConfig({
  testDir: './qa/browser',
  timeout: 30000,
  expect: {
    timeout: 5000,
  },
  fullyParallel: false,
  workers: 1,
  retries: 0,
  reporter: [
    ['list'],
    [
      'html',
      {
        outputFolder: 'qa-artifacts/playwright-report',
        open: 'never',
      },
    ],
  ],
  outputDir: 'qa-artifacts/test-results',
  use: {
    baseURL: 'http://127.0.0.1:8080',
    trace: 'retain-on-failure',
  },
  projects: [
    {
      name: 'desktop-1440',
      use: {
        viewport: {
          width: 1440,
          height: 900,
        },
      },
    },
    {
      name: 'tablet-768',
      use: {
        viewport: {
          width: 768,
          height: 1024,
        },
      },
    },
    {
      name: 'mobile-390',
      use: {
        viewport: {
          width: 390,
          height: 844,
        },
      },
    },
  ],
});
