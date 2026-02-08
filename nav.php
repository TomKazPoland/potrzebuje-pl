<?php
// nav.php — wspólne menu dla wszystkich języków (PL / EN / DE)

// Oczekujemy, że w pliku wywołującym będzie ustawione $lang = 'pl' / 'en' / 'de'.
if (!isset($lang)) {
    $lang = 'pl';
}
if (!in_array($lang, ['pl','en','de'], true)) {
    $lang = 'pl';
}

// Tłumaczenia etykiet menu
$NAV_T = [
    'pl' => [
        'offer'   => 'Oferta',
        'demo'    => 'Mini-demo AI',
        'about'   => 'O nas',
        'contact' => 'Kontakt',
    ],
    'en' => [
        'offer'   => 'Offer',
        'demo'    => 'Mini AI demo',
        'about'   => 'About',
        'contact' => 'Contact',
    ],
    'de' => [
        'offer'   => 'Angebot',
        'demo'    => 'Mini-AI-Demo',
        'about'   => 'Über uns',
        'contact' => 'Kontakt',
    ],
];

$nav = $NAV_T[$lang] ?? $NAV_T['pl'];

// Ścieżki do wersji językowych (zakładamy: / , /en/ , /de/)
$langPaths = [
    'pl' => '/index.php',
    'en' => '/en/index.php',
    'de' => '/de/index.php',
];


$contactHref = '/contact.php?lang=' . $lang;

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
        <a class="nav-link" href="#o-nas"><?=h($nav['about'])?></a>
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
      </div>

      <!-- Kontakt – wersja mobilna -->
      <a class="nav-lang nav-cta nav-cta-mobile" href="<?=h($contactHref)?>"><?=h($nav['contact'])?></a>
    </div>
  </div>
</div>
