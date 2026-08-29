const {
  test,
  expect,
} = require('@playwright/test');

const fs = require('fs');
const path = require('path');

const routes = [
  {
    id: 'home-pl',
    path: '/',
    lang: 'pl',
    type: 'home',
    softwareHref: '/software-development/',
  },
  {
    id: 'home-en',
    path: '/en/',
    lang: 'en',
    type: 'home',
    softwareHref: '/en/software-development/',
  },
  {
    id: 'home-de',
    path: '/de/',
    lang: 'de',
    type: 'home',
    softwareHref: '/de/software-development/',
  },
  {
    id: 'home-fr',
    path: '/fr/',
    lang: 'fr',
    type: 'home',
    softwareHref: '/fr/software-development/',
  },
  {
    id: 'home-zh',
    path: '/zh/',
    lang: 'zh-Hans',
    type: 'home',
    softwareHref: '/zh/software-development/',
  },
  {
    id: 'home-hi',
    path: '/hi/',
    lang: 'hi',
    type: 'home',
    softwareHref: '/hi/software-development/',
  },
  {
    id: 'software-pl',
    path: '/software-development/',
    lang: 'pl',
    type: 'software',
  },
  {
    id: 'software-en',
    path: '/en/software-development/',
    lang: 'en',
    type: 'software',
  },
  {
    id: 'software-de',
    path: '/de/software-development/',
    lang: 'de',
    type: 'software',
  },
  {
    id: 'software-fr',
    path: '/fr/software-development/',
    lang: 'fr',
    type: 'software',
  },
  {
    id: 'software-zh',
    path: '/zh/software-development/',
    lang: 'zh-Hans',
    type: 'software',
  },
  {
    id: 'software-hi',
    path: '/hi/software-development/',
    lang: 'hi',
    type: 'software',
  },
];

for (const route of routes) {
  test(`${route.id} browser contract`, async ({
    page,
  }, testInfo) => {
    const consoleErrors = [];
    const pageErrors = [];
    const failedRequests = [];
    const badResponses = [];

    page.on('console', (msg) => {
      if (msg.type() === 'error') {
        consoleErrors.push(msg.text());
      }
    });

    page.on('pageerror', (error) => {
      pageErrors.push(String(error));
    });

    page.on('requestfailed', (request) => {
      failedRequests.push(
        `${request.resourceType()} ${request.url()}`
      );
    });

    page.on('response', (response) => {
      if (response.status() >= 400) {
        badResponses.push(
          `${response.status()} ${response.url()}`
        );
      }
    });

    const response = await page.goto(
      route.path,
      {
        waitUntil: 'networkidle',
      }
    );

    expect(response).not.toBeNull();
    expect(response.status()).toBe(200);

    await expect(
      page.locator('html')
    ).toHaveAttribute(
      'lang',
      route.lang
    );

    await page.evaluate(async () => {
      const step = Math.max(
        300,
        Math.floor(window.innerHeight * 0.8)
      );

      for (
        let y = 0;
        y < document.body.scrollHeight;
        y += step
      ) {
        window.scrollTo(0, y);

        await new Promise(
          (resolve) => setTimeout(resolve, 20)
        );
      }

      window.scrollTo(0, 0);
    });

    await page.waitForTimeout(250);

    const brokenImages = await page.locator('img').evaluateAll(
      (images) => images
        .filter(
          (img) =>
            !img.complete ||
            img.naturalWidth <= 0 ||
            img.naturalHeight <= 0
        )
        .map(
          (img) =>
            img.currentSrc ||
            img.getAttribute('src') ||
            'NO_SRC'
        )
    );

    expect(
      brokenImages,
      `Broken images: ${brokenImages.join(', ')}`
    ).toEqual([]);

    const overflow = await page.evaluate(() => {
      const html = document.documentElement;
      const body = document.body;

      return {
        viewport: window.innerWidth,
        htmlScrollWidth: html.scrollWidth,
        bodyScrollWidth: body.scrollWidth,
      };
    });

    expect(
      overflow.htmlScrollWidth
    ).toBeLessThanOrEqual(
      overflow.viewport + 1
    );

    expect(
      overflow.bodyScrollWidth
    ).toBeLessThanOrEqual(
      overflow.viewport + 1
    );

    if (route.type === 'home') {
      await expect(
        page.locator('article.pp-card-clean')
      ).toHaveCount(3);

      const detailLink = page.locator(
        'a.pp-pillar-detail-link'
      );

      await expect(
        detailLink
      ).toHaveCount(1);

      await expect(
        detailLink
      ).toHaveAttribute(
        'href',
        route.softwareHref
      );
    }

    if (route.type === 'software') {
      await expect(
        page.locator('.capability')
      ).toHaveCount(9);

      await expect(
        page.locator('.experience-card')
      ).toHaveCount(3);

      await expect(
        page.locator('.experience-small')
      ).toHaveCount(3);

      await expect(
        page.locator('.start-step')
      ).toHaveCount(3);

      await expect(
        page.locator('.nav-lang')
      ).toHaveCount(6);
    }

    expect(
      consoleErrors,
      `Console errors: ${consoleErrors.join(' | ')}`
    ).toEqual([]);

    expect(
      pageErrors,
      `Page errors: ${pageErrors.join(' | ')}`
    ).toEqual([]);

    expect(
      failedRequests,
      `Failed requests: ${failedRequests.join(' | ')}`
    ).toEqual([]);

    expect(
      badResponses,
      `HTTP >=400: ${badResponses.join(' | ')}`
    ).toEqual([]);

    const screenshotDir = path.join(
      'qa-artifacts',
      'screenshots',
      testInfo.project.name
    );

    fs.mkdirSync(
      screenshotDir,
      {
        recursive: true,
      }
    );

    await page.screenshot({
      path: path.join(
        screenshotDir,
        `${route.id}.png`
      ),
      fullPage: true,
    });
  });
}
