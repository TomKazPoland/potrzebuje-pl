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

$heroChips = [
    'AI & GenAI',
    'Custom Software',
    'Web & Mobile',
    'Data',
    'Cloud & DevOps',
];

$capabilities = [
    ['software.capabilities.ai.title','software.capabilities.ai.text'],
    ['software.capabilities.custom.title','software.capabilities.custom.text'],
    ['software.capabilities.web.title','software.capabilities.web.text'],
    ['software.capabilities.data.title','software.capabilities.data.text'],
    ['software.capabilities.cloud.title','software.capabilities.cloud.text'],
    ['software.capabilities.qa.title','software.capabilities.qa.text'],
];

$mainCases = [
    [
        'letter' => 'A',
        'title' => 'software.experience.transformation.title',
        'text' => 'software.experience.transformation.need',
        'enables' => 'software.experience.transformation.solution',
        'tags' => [
            'Multi-agent architecture',
            'FastAPI',
            'Next.js',
            'PostgreSQL',
            'Redis',
            'Governance',
            'Automated reporting',
        ],
    ],
    [
        'letter' => 'B',
        'title' => 'software.experience.operations.title',
        'text' => 'software.experience.operations.need',
        'enables' => 'software.experience.operations.solution',
        'tags' => [
            'Multi-tenancy',
            'Workflow engine',
            'OCR',
            'Real-time AI',
            'Integrations',
            'Encrypted credentials',
            'Controlled AI changes',
        ],
    ],
    [
        'letter' => 'C',
        'title' => 'software.experience.knowledge.title',
        'text' => 'software.experience.knowledge.need',
        'enables' => 'software.experience.knowledge.solution',
        'tags' => [
            '15 microservices',
            'WebRTC / MediaSoup',
            'RAG',
            'Kafka',
            'OpenFGA',
            'AWS EKS',
            'Terraform',
            'CI/CD',
        ],
    ],
];

$smallCases = [
    ['software.experience.automation.title','software.experience.automation.text'],
    ['software.experience.social.title','software.experience.social.text'],
    ['software.experience.education.title','software.experience.education.text'],
    ['software.experience.vision.title','software.experience.vision.text'],
    ['software.experience.healthcare.title','software.experience.healthcare.text'],
    ['software.experience.restaurant.title','software.experience.restaurant.text'],
    ['software.experience.react_laravel.title','software.experience.react_laravel.text'],
];

$aiTypes = [
    'Chatbots',
    'RAG Systems',
    'AI Agents',
    'LLM Applications',
    'Document Processing',
    'Computer Vision',
    'Predictive Analytics',
    'Recommendation Systems',
    'AIOps',
];

$engineeringCards = [
    ['Architecture','software.engineering.architecture.text'],
    ['Security','software.engineering.security.text'],
    ['Cloud & DevOps','software.engineering.cloud.text'],
    ['AI Engineering','software.engineering.ai.text'],
    ['Data & Integration','software.engineering.data.text'],
];

$collaborationModels = [
    ['software.start.step1.title','software.start.step1.text'],
    ['software.start.step2.title','software.start.step2.text'],
    ['software.start.step3.title','software.start.step3.text'],
    ['software.start.step4.title','software.start.step4.text'],
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
    href="<?= pp_h(pp_asset_path('assets/software-development.css') . '?v=ce0b45f07b18e542') ?>"
  >
</head>

<body>

<?php require __DIR__ . '/site_nav.php'; ?>

<main class="page software-v42">

  <section class="sd-hero">
    <div class="sd-wrap sd-hero-grid">

      <div>
        <div class="sd-eyebrow">
          <?= pp_h(pp_t('software.hero.eyebrow')) ?>
        </div>

        <h1><?= pp_h(pp_t('software.hero.title')) ?></h1>

        <p class="sd-lead">
          <?= pp_h(pp_t('software.hero.lead')) ?>
        </p>

        <a
          class="btn btn-primary"
          href="<?= pp_h($contactUrl) ?>"
        ><?= pp_h(pp_t('software.hero.cta')) ?></a>

        <div class="sd-chip-row">
          <?php foreach ($heroChips as $chip): ?>
            <span class="sd-chip"><?= pp_h($chip) ?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <aside class="sd-hero-note">
        <h2><?= pp_h(pp_t('software.hero.note.title')) ?></h2>
        <p><?= pp_h(pp_t('software.hero.note.text')) ?></p>
      </aside>

    </div>
  </section>

  <section class="sd-section">
    <div class="sd-wrap">

      <div class="sd-eyebrow">
        <?= pp_h(pp_t('software.bridge.eyebrow')) ?>
      </div>

      <h2 class="sd-section-title">
        <?= pp_h(pp_t('software.bridge.title')) ?>
      </h2>

      <div class="sd-two-col">

        <div class="sd-copy">
          <p><?= pp_h(pp_t('software.bridge.text1')) ?></p>
          <p><?= pp_h(pp_t('software.bridge.text2')) ?></p>
        </div>

        <article class="sd-soft-card">
          <h3><?= pp_h(pp_t('software.bridge.model.title')) ?></h3>
          <p><?= pp_h(pp_t('software.bridge.model.text')) ?></p>
          <p><?= pp_h(pp_t('software.bridge.model.scope')) ?></p>
        </article>

      </div>
    </div>
  </section>

  <section class="sd-section sd-section-soft">
    <div class="sd-wrap">

      <div class="sd-eyebrow">
        <?= pp_h(pp_t('software.capabilities.eyebrow')) ?>
      </div>

      <h2 class="sd-section-title">
        <?= pp_h(pp_t('software.capabilities.title')) ?>
      </h2>

      <p class="sd-section-lead">
        <?= pp_h(pp_t('software.capabilities.lead')) ?>
      </p>

      <div class="sd-grid sd-grid-3">
        <?php foreach ($capabilities as $capability): ?>
          <article class="sd-card">
            <h3><?= pp_h(pp_t($capability[0])) ?></h3>
            <p><?= pp_h(pp_t($capability[1])) ?></p>
          </article>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <section class="sd-section">
    <div class="sd-wrap">

      <div class="sd-eyebrow">
        <?= pp_h(pp_t('software.experience.eyebrow')) ?>
      </div>

      <h2 class="sd-section-title">
        <?= pp_h(pp_t('software.experience.title')) ?>
      </h2>

      <div class="sd-case-list">

        <?php foreach ($mainCases as $case): ?>
          <article class="sd-case">

            <div class="sd-case-label">
              <?= pp_h(pp_t('software.experience.project_label')) ?>
              <?= pp_h($case['letter']) ?>
            </div>

            <h3><?= pp_h(pp_t($case['title'])) ?></h3>

            <p><?= pp_h(pp_t($case['text'])) ?></p>

            <p class="sd-case-impact">
              <strong>
                <?= pp_h(pp_t('software.experience.need_label')) ?>
              </strong>
              <?= pp_h(pp_t($case['enables'])) ?>
            </p>

            <div class="sd-case-tech">
              <strong>
                <?= pp_h(pp_t('software.experience.solution_label')) ?>
              </strong>

              <div class="sd-tag-row">
                <?php foreach ($case['tags'] as $tag): ?>
                  <span class="sd-tag"><?= pp_h($tag) ?></span>
                <?php endforeach; ?>
              </div>
            </div>

          </article>
        <?php endforeach; ?>

      </div>
    </div>
  </section>

  <section class="sd-section sd-section-soft">
    <div class="sd-wrap">

      <div class="sd-eyebrow">
        <?= pp_h(pp_t('software.experience.more.eyebrow')) ?>
      </div>

      <h2 class="sd-section-title">
        <?= pp_h(pp_t('software.experience.more.title')) ?>
      </h2>

      <p class="sd-section-lead">
        <?= pp_h(pp_t('software.experience.more.lead')) ?>
      </p>

      <div class="sd-grid sd-grid-2">
        <?php foreach ($smallCases as $case): ?>
          <article class="sd-card sd-small-case">
            <h3><?= pp_h(pp_t($case[0])) ?></h3>
            <p><?= pp_h(pp_t($case[1])) ?></p>
          </article>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <section class="sd-dark">
    <div class="sd-wrap">

      <div class="sd-dark-block">

        <div class="sd-eyebrow">
          <?= pp_h(pp_t('software.ai.eyebrow')) ?>
        </div>

        <h2 class="sd-section-title">
          <?= pp_h(pp_t('software.ai.title')) ?>
        </h2>

        <p class="sd-section-lead">
          <?= pp_h(pp_t('software.ai.lead')) ?>
        </p>

        <div class="sd-dark-tags">
          <?php foreach ($aiTypes as $type): ?>
            <span><?= pp_h($type) ?></span>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="sd-dark-block">

        <div class="sd-eyebrow">
          <?= pp_h(pp_t('software.engineering.eyebrow')) ?>
        </div>

        <h2 class="sd-section-title">
          <?= pp_h(pp_t('software.engineering.title')) ?>
        </h2>

        <div class="sd-grid sd-grid-3">
          <?php foreach ($engineeringCards as $card): ?>
            <article class="sd-dark-card">
              <h3><?= pp_h($card[0]) ?></h3>
              <p><?= pp_h(pp_t($card[1])) ?></p>
            </article>
          <?php endforeach; ?>
        </div>

      </div>

    </div>
  </section>

  <section class="sd-section">
    <div class="sd-wrap">

      <div class="sd-eyebrow">
        <?= pp_h(pp_t('software.start.eyebrow')) ?>
      </div>

      <h2 class="sd-section-title">
        <?= pp_h(pp_t('software.start.title')) ?>
      </h2>

      <div class="sd-grid sd-grid-2">
        <?php foreach ($collaborationModels as $model): ?>
          <article class="sd-card">
            <h3><?= pp_h(pp_t($model[0])) ?></h3>
            <p><?= pp_h(pp_t($model[1])) ?></p>
          </article>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <section class="sd-final-cta">
    <div class="sd-wrap sd-cta-inner">

      <h2><?= pp_h(pp_t('software.cta.title')) ?></h2>

      <p><?= pp_h(pp_t('software.cta.text')) ?></p>

      <a
        class="btn btn-primary"
        href="<?= pp_h($contactUrl) ?>"
      ><?= pp_h(pp_t('software.cta.button')) ?></a>

    </div>
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
