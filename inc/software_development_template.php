<?php
if (!isset($currentLang)) {
    $currentLang = 'pl';
}

require_once __DIR__ . '/landing_helpers.php';
require_once __DIR__ . '/landing_texts.php';

$ppLanguages = ['pl','en','de','fr','zh','hi'];
$ppCurrentRoute = 'software-development';

$homeUrl = pp_language_path($currentLang);
$contactUrl = pp_contact_path($currentLang);
$methodUrl = $homeUrl . '#jak-pracujemy';

$ppNavItems = [
    [
        'href' => $homeUrl,
        'key' => 'software.nav.home',
    ],
    [
        'href' => $contactUrl,
        'key' => 'nav.contact',
        'cta' => true,
    ],
];

$capabilities = [
    ['software.capabilities.ai.title','software.capabilities.ai.text'],
    ['software.capabilities.custom.title','software.capabilities.custom.text'],
    ['software.capabilities.cloud.title','software.capabilities.cloud.text'],
    ['software.capabilities.devops.title','software.capabilities.devops.text'],
    ['software.capabilities.data.title','software.capabilities.data.text'],
    ['software.capabilities.mobile.title','software.capabilities.mobile.text'],
    ['software.capabilities.web.title','software.capabilities.web.text'],
    ['software.capabilities.qa.title','software.capabilities.qa.text'],
    ['software.capabilities.consulting.title','software.capabilities.consulting.text'],
];

$mainCases = [
    [
        'software.experience.transformation.title',
        'software.experience.transformation.need',
        'software.experience.transformation.solution',
        [
            'software.capabilities.ai.title',
            'software.capabilities.custom.title',
            'software.capabilities.data.title',
            'software.capabilities.cloud.title',
        ],
    ],
    [
        'software.experience.operations.title',
        'software.experience.operations.need',
        'software.experience.operations.solution',
        [
            'software.capabilities.ai.title',
            'software.capabilities.custom.title',
            'software.capabilities.web.title',
            'software.capabilities.cloud.title',
        ],
    ],
    [
        'software.experience.knowledge.title',
        'software.experience.knowledge.need',
        'software.experience.knowledge.solution',
        [
            'software.capabilities.ai.title',
            'software.capabilities.custom.title',
            'software.capabilities.data.title',
            'software.capabilities.cloud.title',
        ],
    ],
];

$smallCases = [
    [
        'software.experience.education.title',
        'software.experience.education.text',
        [
            'software.capabilities.ai.title',
            'software.capabilities.web.title',
            'software.capabilities.data.title',
        ],
    ],
    [
        'software.experience.vision.title',
        'software.experience.vision.text',
        [
            'software.capabilities.ai.title',
            'software.capabilities.custom.title',
            'software.capabilities.data.title',
        ],
    ],
    [
        'software.experience.automation.title',
        'software.experience.automation.text',
        [
            'software.capabilities.ai.title',
            'software.capabilities.custom.title',
        ],
    ],
];

$startSteps = [
    [
        'software.start.step1.number',
        'software.start.step1.title',
        'software.start.step1.text',
    ],
    [
        'software.start.step2.number',
        'software.start.step2.title',
        'software.start.step2.text',
    ],
    [
        'software.start.step3.number',
        'software.start.step3.title',
        'software.start.step3.text',
    ],
];
?>
<!DOCTYPE html>
<html lang="<?= pp_h(pp_html_lang($currentLang)) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?= pp_h(pp_t('software.meta.title')) ?></title>

  <meta
    name="description"
    content="<?= pp_h(pp_t('software.meta.description')) ?>"
  >

  <link
    rel="canonical"
    href="<?= pp_h(pp_route_url($currentLang, $ppCurrentRoute)) ?>"
  >

  <?php foreach ($ppLanguages as $ppAltLang): ?>
    <link
      rel="alternate"
      hreflang="<?= pp_h(pp_html_lang($ppAltLang)) ?>"
      href="<?= pp_h(pp_route_url($ppAltLang, $ppCurrentRoute)) ?>"
    >
  <?php endforeach; ?>

  <link
    rel="alternate"
    hreflang="x-default"
    href="<?= pp_h(pp_route_url('pl', $ppCurrentRoute)) ?>"
  >

  <link
    rel="stylesheet"
    href="<?= pp_h(pp_asset_path('assets/site-shell.css')) ?>"
  >

  <link
    rel="stylesheet"
    href="<?= pp_h(pp_asset_path('assets/software-development.css')) ?>"
  >
</head>

<body>

<?php require __DIR__ . '/site_nav.php'; ?>

<main class="page">

  <section class="software-hero">

    <div>
      <div class="software-eyebrow">
        <?= pp_h(pp_t('software.hero.eyebrow')) ?>
      </div>

      <h1><?= pp_h(pp_t('software.hero.title')) ?></h1>

      <p class="software-lead">
        <?= pp_h(pp_t('software.hero.lead')) ?>
      </p>

      <div class="hero-actions">
        <a
          class="btn btn-primary"
          href="<?= pp_h($contactUrl) ?>"
        ><?= pp_h(pp_t('software.hero.cta')) ?></a>
      </div>
    </div>

    <div class="software-visual" aria-hidden="true">
      <div class="visual-stack">
        <div class="visual-line"></div>
        <div class="visual-line"></div>
        <div class="visual-line"></div>
      </div>
    </div>

  </section>

  <section class="section" id="capabilities">

    <h2 class="section-title">
      <?= pp_h(pp_t('software.capabilities.title')) ?>
    </h2>

    <p class="section-sub">
      <?= pp_h(pp_t('software.capabilities.lead')) ?>
    </p>

    <div class="capability-grid">

      <?php foreach ($capabilities as $capability): ?>

        <article class="capability">

          <span
            class="capability-index"
            aria-hidden="true"
          ></span>

          <h3><?= pp_h(pp_t($capability[0])) ?></h3>

          <p><?= pp_h(pp_t($capability[1])) ?></p>

        </article>

      <?php endforeach; ?>

    </div>

  </section>

  <section class="section" id="experience">

    <h2 class="section-title">
      <?= pp_h(pp_t('software.experience.title')) ?>
    </h2>

    <p class="section-sub">
      <?= pp_h(pp_t('software.experience.lead')) ?>
    </p>

    <div class="experience-grid">

      <?php foreach ($mainCases as $caseIndex => $case): ?>

        <article
          class="experience-card<?= $caseIndex === 0 ? ' featured' : '' ?>"
        >

          <h3><?= pp_h(pp_t($case[0])) ?></h3>

          <div class="case-block">

            <span class="case-label">
              <?= pp_h(pp_t('software.experience.need_label')) ?>
            </span>

            <p><?= pp_h(pp_t($case[1])) ?></p>

          </div>

          <div class="case-block">

            <span class="case-label">
              <?= pp_h(pp_t('software.experience.solution_label')) ?>
            </span>

            <p><?= pp_h(pp_t($case[2])) ?></p>

          </div>

          <div
            class="tags"
            aria-label="<?= pp_h(pp_t('software.experience.capabilities_label')) ?>"
          >
            <?php foreach ($case[3] as $tagKey): ?>
              <span class="tag">
                <?= pp_h(pp_t($tagKey)) ?>
              </span>
            <?php endforeach; ?>
          </div>

        </article>

      <?php endforeach; ?>

    </div>

    <div class="experience-small-grid">

      <?php foreach ($smallCases as $case): ?>

        <article class="experience-small">

          <h3><?= pp_h(pp_t($case[0])) ?></h3>

          <p><?= pp_h(pp_t($case[1])) ?></p>

          <div
            class="tags"
            aria-label="<?= pp_h(pp_t('software.experience.capabilities_label')) ?>"
          >
            <?php foreach ($case[2] as $tagKey): ?>
              <span class="tag">
                <?= pp_h(pp_t($tagKey)) ?>
              </span>
            <?php endforeach; ?>
          </div>

        </article>

      <?php endforeach; ?>

    </div>

  </section>

  <section class="section" id="start">

    <div class="start-panel">

      <h2 class="section-title">
        <?= pp_h(pp_t('software.start.title')) ?>
      </h2>

      <p class="section-sub">
        <?= pp_h(pp_t('software.start.lead')) ?>
      </p>

      <div class="start-grid">

        <?php foreach ($startSteps as $step): ?>

          <article class="start-step">

            <span class="step-number">
              <?= pp_h(pp_t($step[0])) ?>
            </span>

            <h3><?= pp_h(pp_t($step[1])) ?></h3>

            <p><?= pp_h(pp_t($step[2])) ?></p>

          </article>

        <?php endforeach; ?>

      </div>

      <div class="start-link">
        <a
          class="btn btn-secondary"
          href="<?= pp_h($methodUrl) ?>"
        ><?= pp_h(pp_t('software.start.method_link')) ?></a>
      </div>

    </div>

  </section>

  <section class="cta-panel">

    <div class="cta-copy">

      <h2><?= pp_h(pp_t('software.cta.title')) ?></h2>

      <p><?= pp_h(pp_t('software.cta.text')) ?></p>

    </div>

    <a
      class="btn btn-primary"
      href="<?= pp_h($contactUrl) ?>"
    ><?= pp_h(pp_t('software.cta.button')) ?></a>

  </section>

  <footer class="footer">

    <a href="<?= pp_h($homeUrl) ?>">

      <img
        class="brand-logo"
        src="<?= pp_h(pp_asset_path('Images/logo.svg')) ?>"
        alt="<?= pp_h(pp_t('site.brand.name')) ?>"
      >

    </a>

    <span><?= pp_h(pp_t('page.text_068')) ?></span>

  </footer>

</main>

</body>
</html>
