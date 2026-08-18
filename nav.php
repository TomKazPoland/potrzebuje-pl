<?php
// nav.php — wspólne menu dla wszystkich języków (PL / EN / DE / FR / ZH / HI)

// Oczekujemy, że w pliku wywołującym będzie ustawione $lang = 'pl' / 'en' / 'de' / 'fr' / 'zh' / 'hi'.
if (!isset($lang)) {
    $lang = 'pl';
}

if (!in_array($lang, ['pl','en','de','fr','zh','hi'], true)) {
    $lang = 'pl';
}

// Tłumaczenia etykiet menu
$NAV_T = [
    'pl' => [
        'offer' => 'Oferta',
        'demo' => 'Generator',
        'about' => 'Jak pracujemy',
        'contact' => 'Kontakt',
    ],
    'en' => [
        'offer' => 'Offer',
        'demo' => 'Generator',
        'about' => 'How we work',
        'contact' => 'Contact',
    ],
    'de' => [
        'offer' => 'Angebot',
        'demo' => 'Generator',
        'about' => 'Arbeitsweise',
        'contact' => 'Kontakt',
    ],
    'fr' => [
        'offer' => 'Offre',
        'demo' => 'Générateur',
        'about' => 'Méthode',
        'contact' => 'Contact',
    ],
    'zh' => [
        'offer' => '服务',
        'demo' => '问题生成器',
        'about' => '工作方式',
        'contact' => '联系',
    ],
    'hi' => [
        'offer' => 'सेवाएँ',
        'demo' => 'प्रश्न जनरेटर',
        'about' => 'कार्य पद्धति',
        'contact' => 'संपर्क',
    ],
];

$nav = $NAV_T[$lang] ?? $NAV_T['pl'];

// Ścieżki do wersji językowych.
// W preview /3pillars linki zostają w /3pillars.
// W produkcji prefix jest pusty i linki prowadzą do roota domeny.
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$prefix = (strpos($requestUri, '/3pillars') === 0) ? '/3pillars' : '';

$langPaths = [
    'pl' => $prefix . '/index.php',
    'en' => $prefix . '/en/index.php',
    'de' => $prefix . '/de/index.php',
    'fr' => $prefix . '/fr/index.php',
    'zh' => $prefix . '/zh/index.php',
    'hi' => $prefix . '/hi/index.php',
];

$contactHref = $prefix . '/contact.php?lang=' . rawurlencode($lang);

// Helper do escapu
if (!function_exists('h')) {
    function h($s){ return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8"); }
}
?>
<div class="nav">
  <div class="nav-inner">
    <!-- WIERSZ 1: logo + główne linki -->
    <div class="nav-top-row">
      <div class="nav-left">
        <a class="brand-mini" href="#top">potrzebuje.pl</a>
      </div>

      <div class="nav-links">
        <a class="nav-link" href="#oferta"><?=h($nav['offer'])?></a>
        <a class="nav-link" href="#demo"><?=h($nav['demo'])?></a>
        <a class="nav-link" href="#top"><?=h($nav['about'])?></a>
        <!-- Kontakt – wersja desktop -->
        <a class="nav-link nav-cta nav-cta-desktop" href="<?=h($contactHref)?>"><?=h($nav['contact'])?></a>
      </div>
    </div>

    <!-- WIERSZ 2: języki po lewej, Kontakt po prawej (mobile) -->
    <div class="nav-langs">
      <div class="nav-langs-left">
        <a
          class="nav-lang"
          href="<?=h($langPaths['pl'])?>"
          <?= $lang === 'pl' ? 'aria-current="page"' : '' ?>
        >PL</a>

        <a
          class="nav-lang"
          href="<?=h($langPaths['en'])?>"
          <?= $lang === 'en' ? 'aria-current="page"' : '' ?>
        >EN</a>

        <a
          class="nav-lang"
          href="<?=h($langPaths['de'])?>"
          <?= $lang === 'de' ? 'aria-current="page"' : '' ?>
        >DE</a>

        <a
          class="nav-lang"
          href="<?=h($langPaths['fr'])?>"
          <?= $lang === 'fr' ? 'aria-current="page"' : '' ?>
        >FR</a>

        <a
          class="nav-lang"
          href="<?=h($langPaths['zh'])?>"
          <?= $lang === 'zh' ? 'aria-current="page"' : '' ?>
        >ZH</a>

        <a
          class="nav-lang"
          href="<?=h($langPaths['hi'])?>"
          <?= $lang === 'hi' ? 'aria-current="page"' : '' ?>
        >HI</a>
      </div>

      <!-- Kontakt – wersja mobilna -->
      <a class="nav-lang nav-cta nav-cta-mobile" href="<?=h($contactHref)?>"><?=h($nav['contact'])?></a>
    </div>
  </div>
</div>
