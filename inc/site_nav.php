<?php
$ppNavItems = isset($ppNavItems) && is_array($ppNavItems)
    ? $ppNavItems
    : [];

$ppCurrentRoute = isset($ppCurrentRoute)
    ? (string)$ppCurrentRoute
    : '';

$ppLanguages = ['pl','en','de','fr','zh','hi'];

$ppLanguageLabelKeys = [
    'pl' => 'page.text_007',
    'en' => 'page.text_008',
    'de' => 'page.text_009',
    'fr' => 'page.text_010',
    'zh' => 'page.text_011',
    'hi' => 'page.text_012',
];
?>
<nav class="nav" aria-label="<?= pp_h(pp_t('page.attribute_002')) ?>">
  <div class="nav-inner">
    <div class="nav-top-row">

      <a
        class="brand"
        href="<?= pp_h(pp_language_path($currentLang)) ?>"
        aria-label="<?= pp_h(pp_t('site.brand.name')) ?>"
      >
        <img
          class="brand-logo"
          src="<?= pp_h(pp_asset_path('Images/logo.svg')) ?>"
          alt="<?= pp_h(pp_t('site.brand.name')) ?>"
        >
      </a>

      <div class="nav-links">
        <?php foreach ($ppNavItems as $ppNavItem): ?>
          <a
            class="nav-link<?= !empty($ppNavItem['cta']) ? ' nav-cta' : '' ?>"
            href="<?= pp_h($ppNavItem['href']) ?>"
          ><?= pp_h(pp_t($ppNavItem['key'])) ?></a>
        <?php endforeach; ?>
      </div>

    </div>

    <div
      class="nav-langs"
      aria-label="<?= pp_h(pp_t('software.nav.languages_aria')) ?>"
    >
      <?php foreach ($ppLanguages as $ppLangCode): ?>
        <a
          class="nav-lang"
          href="<?= pp_h(pp_route_path($ppLangCode, $ppCurrentRoute)) ?>"
          <?= $ppLangCode === $currentLang ? 'aria-current="page"' : '' ?>
        ><?= pp_h(pp_t($ppLanguageLabelKeys[$ppLangCode], $currentLang)) ?></a>
      <?php endforeach; ?>
    </div>

  </div>
</nav>
