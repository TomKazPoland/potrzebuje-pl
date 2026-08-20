<?php
if (!isset($currentLang)) {
    $currentLang = 'pl';
}
require_once __DIR__ . '/landing_helpers.php';
require_once __DIR__ . '/landing_texts.php';

$basePrefix = pp_base_prefix($currentLang);
$contactUrl = $basePrefix . 'contact.php?lang=' . $currentLang;
$demoApiUrl = $basePrefix . 'demo_api.php';
?>
<!DOCTYPE html>
<html lang="<?= pp_h(pp_html_lang($currentLang)) ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= pp_h(pp_t('page.text_001')) ?></title>

  <meta name="description" content="<?= pp_h(pp_t('site.meta.description')) ?>" />

  <style>
    /* ===== Reset ===== */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    :root{
      --bg: #ffffff;
      --text: #111111;
      --muted: #555555;
      --muted2:#777777;
      --line:#eaeaea;
      --card:#fafafa;

      --primary:#0077cc;
      --primary2:#005fa3;

      --shadow: 0 12px 32px rgba(0,0,0,0.08);
      --shadow2: 0 8px 24px rgba(0,0,0,0.06);

      --radius: 16px;
      --radius2: 12px;
    }

    body{
      min-height:100vh;
      background:var(--bg);
      color:var(--text);
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    /* ===== Layout container ===== */
    .page{
      width: min(1100px, calc(100% - 32px));
      margin: 0 auto;
      padding: 18px 0 48px 0;
    }

    /* ===== Top nav ===== */
    .nav{
      position: sticky;
      top: 0;
      background: rgba(255,255,255,0.88);
      backdrop-filter: blur(8px);
      border-bottom: 1px solid var(--line);
      z-index: 1000;
    }

    .nav-inner{
      width: min(1100px, calc(100% - 32px));
      margin: 0 auto;
      padding: 7px 0 6px 0;
      display:flex;
      flex-direction: column;  /* GÓRA: logo+menu, DÓŁ: języki */
      gap: 6px;
    }



    .nav-top-row{
      display:flex;
      align-items:center;
      justify-content: space-between;
      gap: 12px;
    }

    .nav-left{
      display:flex;
      align-items:center;
      gap: 10px;
      min-width: 220px;
    }

    .brand-mini{
      font-weight: 700;
      letter-spacing: 0.02em;
      color: var(--text);
      text-decoration:none;
      white-space: nowrap;
    }

    .nav-links{
      display:flex;
      align-items:center;
      gap: 16px;
      flex-wrap: wrap;
      justify-content: flex-end;
    }

    .nav-link{
      font-size: 0.95rem;
      text-decoration:none;
      color: var(--muted);
      letter-spacing: 0.02em;
      padding: 8px 10px;
      border-radius: 999px;
      transition: background .15s ease, color .15s ease;
    }

    .nav-link:hover{
      background: #f2f6fb;
      color: var(--text);
    }

    .nav-cta{
      background: var(--primary);
      color: #fff !important;
      border-radius: 999px;
      padding: 10px 14px;
      font-weight: 700;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      box-shadow: 0 10px 24px rgba(0,119,204,0.22);
    }

    .nav-cta:hover{
      background: var(--primary2);
    }

    /* DOMYŚLNIE (DESKTOP): CTA w pierwszym wierszu, brak CTA w drugim */
    .nav-cta-desktop{
      display:inline-flex;
    }

    .nav-cta-mobile{
      display:none;
    }


    .nav-langs{
      display:flex;
      align-items:center;
      justify-content: space-between; /* języki po lewej, Kontakt po prawej */
      gap: 8px;
      flex-wrap: wrap;
      font-size: 0.95rem; /* podobnie jak .nav-link */
    }

    .nav-langs-left{
      display:flex;
      align-items:center;
      gap: 8px;
      flex-wrap: wrap;
    }
    
    .nav-lang{
      text-decoration:none;
      color: var(--muted);
      padding: 4px 10px;
      border-radius: 999px;
      letter-spacing: 0.03em;
    }
    
    .nav-lang[aria-current="page"]{
      background:#f2f6fb;
      color: var(--text);
      font-weight:600;
    }




    /* ===== Hero ===== */
    .hero{
      padding: 26px 0 10px 0;
      display:grid;
      grid-template-columns: 1.15fr 0.85fr;
      gap: 22px;
      align-items: center;
    }

    .hero h1{
      font-size: clamp(1.6rem, 2.6vw, 2.6rem);
      line-height: 1.15;
      margin-bottom: 12px;
      letter-spacing: -0.02em;
    }

    .hero p{
      color: var(--muted);
      font-size: 1.05rem;
      line-height: 1.55;
      margin-bottom: 16px;
    }

    .hero-actions{
      display:flex;
      gap: 12px;
      flex-wrap: wrap;
      align-items:center;
      margin-top: 6px;
    }

    .btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      border: 1px solid transparent;
      border-radius: 999px;
      padding: 12px 18px;
      font-weight: 800;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      cursor:pointer;
      text-decoration:none;
      transition: background .15s ease, border .15s ease, transform .05s ease;
      user-select:none;
      font-size: 0.95rem;
    }

    .btn:active{ transform: translateY(1px); }

    .btn-primary{
      background: var(--primary);
      color: #fff;
      box-shadow: 0 10px 24px rgba(0,119,204,0.22);
    }
    .btn-primary:hover{ background: var(--primary2); }

    .btn-secondary{
      background: #ffffff;
      border-color: var(--line);
      color: var(--text);
    }
    .btn-secondary:hover{ background: #f6f6f6; }

    /* Right hero card with logo */
    .hero-card{
      background: var(--card);
      border: 1px solid var(--line);
      border-radius: var(--radius);
      box-shadow: var(--shadow2);
      padding: 18px;
      text-align:center;
    }

    .logo{
      display:block;
      width: 100%;
      height:auto;
      max-height: 260px;
      margin: 2px auto 10px auto;
    }

    .hero-bullets{
      margin-top: 10px;
      text-align:left;
      color: var(--muted);
      font-size: 0.95rem;
      line-height: 1.5;
    }

    .hero-bullets li{ margin: 8px 0; }

    /* ===== Sections ===== */
    .section{
      padding: 22px 0;
      border-top: 1px solid var(--line);
    }

    .section-title{
      font-size: 1.35rem;
      letter-spacing: -0.01em;
      margin-bottom: 10px;
    }

    .section-sub{
      color: var(--muted);
      line-height: 1.6;
      margin-bottom: 14px;
      max-width: 80ch;
    }

    /* ===== Cards grid ===== */
    .grid{
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
    }

    .card{
      background: #fff;
      border: 1px solid var(--line);
      border-radius: var(--radius);
      padding: 16px;
      box-shadow: 0 10px 26px rgba(0,0,0,0.05);
    }

    .card h3{
      font-size: 1.05rem;
      margin-bottom: 8px;
    }

    .card p{
      color: var(--muted);
      line-height: 1.55;
      font-size: 0.95rem;
    }

    .chip-row{
      display:flex;
      gap: 8px;
      flex-wrap: wrap;
      margin-top: 10px;
    }

    .chip{
      font-size: 0.78rem;
      padding: 6px 10px;
      border-radius: 999px;
      border: 1px solid var(--line);
      background: #fbfbfb;
      color: var(--muted);
      letter-spacing: 0.02em;
    }

    /* ===== Mini demo ===== */
    .demo{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
      align-items: start;
    }

    .demo textarea{
      width: 100%;
      min-height: 180px;
      resize: vertical;
      padding: 12px 12px;
      border-radius: 14px;
      border: 1px solid var(--line);
      font-family: inherit;
      font-size: 1rem;
      line-height: 1.5;
      outline: none;
    }

    .demo textarea:focus{
      border-color: rgba(0,119,204,0.55);
      box-shadow: 0 0 0 4px rgba(0,119,204,0.10);
    }

    .demo-panel{
      border: 1px solid var(--line);
      border-radius: var(--radius);
      background: #ffffff;
      box-shadow: var(--shadow2);
      overflow: hidden;
    }

    .demo-panel-head{
      padding: 12px 14px;
      border-bottom: 1px solid var(--line);
      background: #fbfbfb;
      display:flex;
      justify-content: space-between;
      align-items: center;
      gap: 10px;
    }

    .demo-panel-head strong{
      font-size: 0.95rem;
      letter-spacing: 0.02em;
    }

    .demo-output{
      padding: 14px;
      color: var(--text);
      line-height: 1.55;
      font-size: 0.96rem;
      white-space: pre-wrap;
    }

    .note{
      color: var(--muted2);
      font-size: 0.88rem;
      line-height: 1.5;
      margin-top: 10px;
    }

    /* ===== Footer ===== */
    .footer{
      padding-top: 18px;
      color: var(--muted2);
      font-size: 0.9rem;
      display:flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      border-top: 1px solid var(--line);
      margin-top: 24px;
    }

    /* ===== Responsive ===== */
     @media (max-width: 920px){
      .hero{ grid-template-columns: 1fr; }
      .grid{ grid-template-columns: 1fr; }
      .demo{ grid-template-columns: 1fr; }
      .nav-left{ min-width: auto; }
    
      /* główne linki mogą się przewijać poziomo, jeśli się nie mieszczą */
      .nav-links{
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
    
      .nav-link{
        white-space: nowrap;
        font-size: 0.90rem;
        padding: 8px 8px;
      }

      /* MOBILE: CTA tylko w drugim wierszu */
      .nav-cta-desktop{
        display:none;
      }

      .nav-cta-mobile{
        display:inline-flex;
        font-size:0.95rem;
        padding:8px 14px;
      }
    }


  
/* 3PILLARS_GLOBAL_TYPOGRAPHY_V13_START */
/* Shared typography resilience for long multilingual texts.
   No per-language layout rules. */
.hero h1,
.pp-reset-title,
.section-title {
  text-wrap: balance;
  overflow-wrap: normal;
}

.pp-reset-lead,
.section-sub,
.card,
.card p,
.pp-trust-note,
.demo-note,
.demo-limits,
#demoOutput,
textarea {
  overflow-wrap: anywhere;
  word-break: normal;
  min-width: 0;
}

.card,
.hero,
.pp-reset-shell,
.pp-grid,
.pp-demo,
.pp-reset-panel {
  min-width: 0;
}

.btn,
.hero-actions a {
  white-space: normal;
  text-align: center;
}

#demoOutput {
  white-space: pre-wrap;
  line-height: 1.55;
}
/* 3PILLARS_GLOBAL_TYPOGRAPHY_V13_END */



/* 3PILLARS_BRAND_LOGO_P1_LOGO_2_START */
/* P1_LOGO_5: single clickable logo wordmark; no duplicated brand text. */
.brand {
  display: inline-flex;
  align-items: center;
  min-width: 0;
  line-height: 0;
}

.brand-logo {
  display: block;
  width: 168px;
  max-width: 36vw;
  height: auto;
  max-height: 52px;
  object-fit: contain;
  flex: 0 0 auto;
}

@media (max-width: 720px) {
  .brand-logo {
    width: 140px;
    max-width: 42vw;
    max-height: 44px;
  }
}

@media (max-width: 520px) {
  .brand-logo {
    width: 124px;
    max-width: 48vw;
    max-height: 38px;
  }
}
/* 3PILLARS_BRAND_LOGO_P1_LOGO_2_END */


    /* AP6_GENERATOR_PRESENTATION_START */
    #demo .pp-demo-reset {
      display: grid;
      grid-template-columns:
        minmax(0, .78fr)
        minmax(0, 1.22fr);
      gap: clamp(28px, 5vw, 72px);
      align-items: start;
    }

    #demo .pp-demo-intro {
      position: sticky;
      top: 112px;
      max-width: 560px;
    }

    #demo .pp-demo-intro .section-sub {
      margin-top: 14px;
      line-height: 1.72;
    }

    #demo .demo-box {
      padding: clamp(22px, 3.5vw, 36px);
      border: 1px solid var(--line);
      border-radius: 24px;
      background: #fff;
      box-shadow: var(--shadow2);
    }

    #demo #demoInput {
      width: 100%;
      min-height: 170px;
      resize: vertical;
      padding: 18px;
      border: 1px solid #dcdcdc;
      border-radius: 16px;
      background: #fbfbfb;
      color: var(--text);
      font: inherit;
      line-height: 1.6;
      transition:
        border-color .18s ease,
        box-shadow .18s ease,
        background .18s ease;
    }

    #demo #demoInput:focus {
      outline: none;
      border-color: var(--primary);
      background: #fff;
      box-shadow:
        0 0 0 4px rgba(0, 119, 204, .11);
    }

    #demo .pp-demo-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      margin-top: 16px;
    }

    #demo .pp-demo-actions .btn {
      min-height: 46px;
    }

    #demo .pp-demo-status {
      display: flex;
      gap: 10px;
      align-items: center;
      flex-wrap: wrap;
      margin-top: 16px;
    }

    #demo .pp-demo-status #demoLimits {
      margin: 0;
      font-size: .85rem;
    }

    #demo .demo-output {
      min-height: 126px;
      margin-top: 16px;
      padding: 18px;
      border: 1px solid var(--line);
      border-radius: 16px;
      background: #fafafa;
      white-space: pre-wrap;
      line-height: 1.65;
    }

    #demo .pp-demo-trust {
      margin-top: 16px;
      padding-top: 16px;
      border-top: 1px solid var(--line);
      font-size: .88rem;
      line-height: 1.6;
    }

    @media (max-width: 900px) {
      #demo .pp-demo-reset {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      #demo .pp-demo-intro {
        position: static;
        max-width: none;
      }
    }

    @media (max-width: 560px) {
      #demo .demo-box {
        padding: 18px;
        border-radius: 20px;
      }

      #demo .pp-demo-actions {
        flex-direction: column;
      }

      #demo .pp-demo-actions .btn {
        width: 100%;
      }

      #demo #demoInput {
        min-height: 150px;
      }
    }
    /* AP6_GENERATOR_PRESENTATION_END */

  </style>
  
  <!-- WSPÓLNY CSS MENU MOBILNEGO DLA WSZYSTKICH JĘZYKÓW -->
  <link rel="stylesheet" href="/nav-mobile.css">
  <link rel="canonical" href="<?= pp_h(pp_canonical_url($currentLang)) ?>">

  <!-- AP3_MOBILE_NAV_HIDE_SCROLL_CSS_START -->
  <style>
    @media (max-width: 920px) {
      .nav {
        transition: transform 220ms ease;
        will-change: transform;
      }

      .nav.pp-nav-hidden {
        transform: translateY(-100%);
      }
    }

    @media (prefers-reduced-motion: reduce) {
      .nav {
        transition: none;
      }
    }
  </style>
  <!-- AP3_MOBILE_NAV_HIDE_SCROLL_CSS_END -->

</head>

<body>
  <!-- Sticky NAV - localized 3pillars preview nav -->
  <nav class="nav" aria-label="<?= pp_h(pp_t('page.attribute_002')) ?>">
    <div class="nav-inner">
      <div class="nav-top-row">
        <div class="nav-left">
          <a class="brand" href="<?= pp_h(pp_canonical_url($currentLang)) ?>" aria-label="<?= pp_h(pp_t('site.brand.name')) ?>"><img class="brand-logo" src="/Images/logo.svg" alt="<?= pp_h(pp_t('site.brand.name')) ?>" loading="eager" decoding="async"></a>
        </div>

        <div class="nav-links">
          <a class="nav-link" href="#oferta"><?= pp_h(pp_t('nav.offer')) ?></a>
          <a class="nav-link" href="#demo"><?= pp_h(pp_t('nav.generator')) ?></a>
          <a class="nav-link" href="#jak-pracujemy"><?= pp_h(pp_t('nav.method')) ?></a>
          <a class="nav-link nav-cta nav-cta-desktop" href="<?= pp_h($contactUrl) ?>"><?= pp_h(pp_t('nav.contact')) ?></a>
        </div>
      </div>

      <div class="nav-langs">
        <div class="nav-langs-left">
          <?php
            $ppLangUrls = [];
            foreach (['pl', 'en', 'de', 'fr', 'zh', 'hi'] as $ppLangCode) {
              $ppLangUrls[$ppLangCode] = pp_language_path($ppLangCode);
            }
          ?>
          <?php foreach ($ppLangUrls as $ppLangCode => $ppLangUrl): ?>
            <a class="nav-lang" href="<?= pp_h($ppLangUrl) ?>" <?= $ppLangCode === $currentLang ? 'aria-current="page"' : '' ?>><?= pp_h(strtoupper($ppLangCode)) ?></a>
          <?php endforeach; ?>
        </div>

        <a class="nav-link nav-cta nav-cta-mobile" href="<?= pp_h($contactUrl) ?>"><?= pp_h(pp_t('nav.contact')) ?></a>
      </div>
    </div>
  </nav>






  <div id="top" class="page">

  <style>
    .pp-reset-hero {
      display: grid;
      grid-template-columns: minmax(0, 1.25fr) minmax(280px, .75fr);
      gap: 32px;
      align-items: start; /* P1_HERO_2: align hero content to top */
      margin: 38px 0 30px;
    }

    .pp-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: .78rem;
      font-weight: 800;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: #005bbb;
      margin-bottom: 14px;
    }

    .pp-reset-hero h1 {
      font-size: clamp(2.05rem, 4vw, 3.55rem);
      line-height: 1.03;
      letter-spacing: -.045em;
      margin: 0 0 18px;
    }

    .pp-reset-lead {
      font-size: 1.08rem;
      line-height: 1.58;
      color: var(--muted);
      max-width: 760px;
      margin: 0 0 20px;
    }

    .pp-trust-note {
      font-size: .94rem;
      line-height: 1.55;
      color: var(--muted);
      margin-top: 14px;
      max-width: 760px;
    }

    .pp-hero-panel {
      border: 1px solid var(--border);
      border-radius: 24px;
      background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
      box-shadow: var(--shadow);
      padding: 24px;
    }

    .pp-panel-title {
      font-weight: 900;
      font-size: 1.05rem;
      margin: 0 0 14px;
    }

    .pp-panel-list {
      display: grid;
      gap: 12px;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .pp-panel-list li {
      padding: 12px;
      border-radius: 16px;
      background: #fff;
      border: 1px solid var(--border);
      font-size: .93rem;
      line-height: 1.45;
    }

    .pp-section-tight {
      margin-top: 26px;
    }

    .pp-simple-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 16px;
      margin-top: 18px;
    }

    .pp-card-clean {
      border: 1px solid var(--border);
      border-radius: 22px;
      background: #fff;
      padding: 20px;
      box-shadow: 0 12px 28px rgba(15, 23, 42, .05);
    }

    .pp-card-clean h3 {
      margin: 8px 0 10px;
      font-size: 1.06rem;
    }

    .pp-card-clean p {
      margin: 0;
      color: var(--muted);
      line-height: 1.6;
    }

    .pp-card-question {
      font-size: .92rem;
      font-weight: 850;
      color: #005bbb;
      margin-bottom: 6px;
    }

    .pp-risk-box {
      border: 1px solid var(--border);
      border-radius: 22px;
      background: #f8fbff;
      padding: 22px;
      margin-top: 18px;
    }

    .pp-risk-steps {
      display: grid;
      grid-template-columns: repeat(5, minmax(0, 1fr));
      gap: 10px;
      margin-top: 14px;
    }

    .pp-risk-step {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 12px;
      font-size: .88rem;
      line-height: 1.45;
    }

    .pp-demo-reset {
      display: grid;
      grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);
      gap: 22px;
      align-items: start;
    }

    .pp-demo-reset .demo-box {
      margin-top: 0;
    }

    #demoLimits {
      opacity: .62;
      font-size: .78rem !important;
    }

    #demoBadge {
      opacity: .78;
    }

    /* AP4_THREE_PILLAR_CARDS_CSS_V1_START */
    #oferta .pp-simple-grid {
      gap: 20px;
      align-items: stretch;
    }

    #oferta .pp-card-clean {
      position: relative;
      display: flex;
      flex-direction: column;
      min-height: 100%;
      padding: 24px;
      overflow: hidden;
      border-color: #dfe7ef;
      box-shadow: 0 14px 34px rgba(15, 23, 42, .065);
    }

    #oferta .pp-card-clean .chip {
      order: 1;
      align-self: flex-start;
      margin: 0 42px 17px 0;
      padding: 5px 9px;
      border-color: #dbe6f0;
      background: #f7f9fb;
      color: #536579;
      font-size: .71rem;
      line-height: 1.25;
      font-weight: 750;
      letter-spacing: .035em;
    }

    #oferta .pp-card-clean h3 {
      order: 2;
      margin: 0 0 11px;
      font-size: 1.16rem;
      line-height: 1.25;
      letter-spacing: -.015em;
    }

    #oferta .pp-card-question {
      order: 3;
      margin: 0 0 14px;
      font-size: .94rem;
      line-height: 1.48;
      font-weight: 800;
      color: #005bbb;
    }

    #oferta .pp-card-clean p {
      order: 4;
      margin: 0;
      line-height: 1.65;
    }

    @media (max-width: 860px) {
      #oferta .pp-simple-grid {
        gap: 14px;
      }

      #oferta .pp-card-clean {
        min-height: auto;
        padding: 21px 20px;
      }

      #oferta .pp-card-clean .chip {
        margin-bottom: 15px;
      }
    }
    /* AP4_THREE_PILLAR_CARDS_CSS_V1_END */

    @media (max-width: 860px) {
      .pp-reset-hero,
      .pp-demo-reset {
        grid-template-columns: 1fr;
      }

      .pp-simple-grid,
      .pp-risk-steps {
        grid-template-columns: 1fr;
      }
    }
  

/* 3PILLARS_VISUAL_MAP_P1_GRAPHICS_4_START */
/* P1_VISUAL_1: premium business-readable AI adoption path panel. */
.pp-visual-map {
  position: relative;
  margin: 0 0 18px;
  padding: 22px;
  border: 1px solid rgba(0, 91, 187, .16);
  border-radius: 24px;
  background:
    radial-gradient(circle at 18% 0%, rgba(0, 91, 187, .10), transparent 30%),
    radial-gradient(circle at 92% 18%, rgba(0, 91, 187, .08), transparent 28%),
    linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
  box-shadow: 0 18px 42px rgba(15, 23, 42, .08);
  overflow: hidden;
}

.pp-visual-map::before {
  content: "";
  position: absolute;
  inset: 13px;
  border: 1px solid rgba(0, 91, 187, .10);
  border-radius: 19px;
  pointer-events: none;
}

.pp-visual-kicker {
  position: relative;
  z-index: 1;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 15px;
  padding: 7px 10px;
  border-radius: 999px;
  background: rgba(0, 91, 187, .08);
  color: #005bbb;
  font-size: .72rem;
  font-weight: 800;
  letter-spacing: .08em;
  text-transform: uppercase;
}

.pp-visual-kicker::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 999px;
  background: #005bbb;
  box-shadow: 0 0 0 5px rgba(0, 91, 187, .12);
}

.pp-visual-title {
  position: relative;
  z-index: 1;
  margin: 0 0 16px;
  font-size: clamp(1.12rem, 2vw, 1.45rem);
  line-height: 1.12;
  letter-spacing: -.025em;
  color: var(--text);
}

.pp-visual-path {
  position: relative;
  z-index: 1;
  display: grid;
  gap: 10px;
  margin: 0 0 16px;
}

.pp-v-node {
  display: grid;
  grid-template-columns: 38px minmax(0, 1fr);
  gap: 11px;
  align-items: center;
  padding: 13px 14px;
  border: 1px solid rgba(15, 23, 42, .08);
  border-radius: 18px;
  background: rgba(255, 255, 255, .92);
  box-shadow: 0 10px 26px rgba(15, 23, 42, .055);
}

.pp-v-node span {
  display: grid;
  place-items: center;
  width: 38px;
  height: 38px;
  border-radius: 14px;
  background: linear-gradient(180deg, rgba(0, 91, 187, .12), rgba(0, 91, 187, .06));
  color: #005bbb;
  font-size: .72rem;
  font-weight: 900;
}

.pp-v-node strong {
  display: block;
  margin-bottom: 3px;
  color: var(--text);
  font-size: .92rem;
  line-height: 1.12;
}

.pp-v-node small {
  display: block;
  color: var(--muted);
  font-size: .76rem;
  line-height: 1.28;
}

.pp-v-process {
  position: relative;
  z-index: 1;
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 7px;
  margin: 14px 0 0;
}

.pp-v-process span {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 36px;
  padding: 7px 8px;
  border-radius: 12px;
  background: #fff;
  border: 1px solid rgba(0, 91, 187, .12);
  color: var(--muted);
  font-size: .72rem;
  line-height: 1.15;
  text-align: center;
}

.pp-v-caption {
  position: relative;
  z-index: 1;
  margin: 13px 0 0;
  padding: 12px 13px;
  border-left: 3px solid #005bbb;
  border-radius: 12px;
  background: rgba(0, 91, 187, .06);
  color: var(--muted);
  font-size: .82rem;
  line-height: 1.42;
}

@media (max-width: 640px) {
  .pp-visual-map {
    padding: 18px;
  }

  .pp-v-process {
    grid-template-columns: 1fr 1fr;
  }
}
/* 3PILLARS_VISUAL_MAP_P1_GRAPHICS_4_END */



/* 3PILLARS_HERO_COMPOSITION_P1_HERO_3_START */
/* CSS-only composition override after DIAG. Does not change text/API/root. */
.pp-reset-hero {
  grid-template-columns: minmax(0, 1.34fr) minmax(300px, .66fr);
  gap: 24px;
  margin: 24px 0 18px;
}

.pp-reset-hero h1 {
  font-size: clamp(2.05rem, 3.65vw, 3.35rem);
  margin-bottom: 14px;
}

.pp-reset-lead {
  font-size: 1.04rem;
  line-height: 1.54;
  max-width: 720px;
  margin-bottom: 14px;
}

.pp-hero-panel {
  padding: 18px;
  border-radius: 22px;
}

.pp-visual-map {
  margin: 0;
  padding: 18px;
  border-radius: 22px;
  box-shadow: 0 14px 32px rgba(15, 23, 42, .07);
}

.pp-visual-title {
  margin-bottom: 12px;
  font-size: clamp(1.08rem, 1.75vw, 1.32rem);
}

.pp-visual-path {
  gap: 8px;
  margin-bottom: 12px;
}

.pp-v-node {
  grid-template-columns: 32px minmax(0, 1fr);
  gap: 9px;
  padding: 10px 11px;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(15, 23, 42, .045);
}

.pp-v-node span {
  width: 32px;
  height: 32px;
  border-radius: 12px;
  font-size: .68rem;
}

.pp-v-node strong {
  margin-bottom: 2px;
  font-size: .88rem;
  line-height: 1.1;
}

.pp-v-node small {
  font-size: .71rem;
  line-height: 1.22;
}

.pp-v-process {
  gap: 6px;
  margin-top: 10px;
}

.pp-v-process span {
  min-height: 30px;
  padding: 6px 7px;
  border-radius: 10px;
  font-size: .68rem;
  line-height: 1.12;
}

.pp-v-caption {
  margin-top: 10px;
  padding: 9px 10px;
  border-radius: 11px;
  font-size: .76rem;
  line-height: 1.34;
}

@media (max-width: 920px) {
  .pp-reset-hero {
    grid-template-columns: 1fr;
    gap: 20px;
    margin: 20px 0 18px;
  }

  .pp-hero-panel {
    padding: 16px;
  }
}
/* 3PILLARS_HERO_COMPOSITION_P1_HERO_3_END */



/* 3PILLARS_HERO_RIGHT_PANEL_SIMPLIFY_P1_PANEL_2_START */
/* Premium right-hero roadmap. Replaces repeated three-pillar diagram in hero. */
.pp-roadmap-card {
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(0, 91, 187, .18);
  border-radius: 24px;
  padding: 24px;
  background:
    radial-gradient(circle at 12% 0%, rgba(0, 91, 187, .13), transparent 28%),
    radial-gradient(circle at 100% 18%, rgba(0, 91, 187, .08), transparent 30%),
    linear-gradient(180deg, #ffffff 0%, #f6fbff 100%);
  box-shadow: 0 18px 42px rgba(15, 23, 42, .08);
}

.pp-roadmap-card::before {
  content: "";
  position: absolute;
  inset: 18px auto 18px 39px;
  width: 2px;
  border-radius: 999px;
  background: linear-gradient(180deg, rgba(0, 91, 187, .34), rgba(0, 91, 187, .05));
}

.pp-roadmap-kicker {
  position: relative;
  z-index: 1;
  display: inline-flex;
  align-items: center;
  gap: 7px;
  width: fit-content;
  margin-bottom: 12px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(0, 91, 187, .08);
  color: #005bbb;
  font-size: .72rem;
  font-weight: 900;
  letter-spacing: .055em;
  text-transform: uppercase;
}

.pp-roadmap-kicker::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 999px;
  background: #005bbb;
  box-shadow: 0 0 0 4px rgba(0, 91, 187, .12);
}

.pp-roadmap-title {
  position: relative;
  z-index: 1;
  margin: 0 0 18px;
  max-width: 13.5em;
  color: var(--text);
  font-size: clamp(1.22rem, 2vw, 1.55rem);
  line-height: 1.1;
  letter-spacing: -.03em;
}

.pp-roadmap-flow {
  position: relative;
  z-index: 1;
  display: grid;
  gap: 12px;
}

.pp-roadmap-step {
  display: grid;
  grid-template-columns: 38px minmax(0, 1fr);
  gap: 13px;
  align-items: center;
  padding: 13px 14px;
  border: 1px solid rgba(15, 23, 42, .08);
  border-radius: 18px;
  background: rgba(255, 255, 255, .92);
  box-shadow: 0 10px 26px rgba(15, 23, 42, .05);
}

.pp-roadmap-step-main {
  border-color: rgba(0, 91, 187, .24);
  background: linear-gradient(180deg, #ffffff 0%, #eef6ff 100%);
  box-shadow: 0 14px 30px rgba(0, 91, 187, .10);
}

.pp-roadmap-step span {
  display: grid;
  place-items: center;
  width: 38px;
  height: 38px;
  border-radius: 14px;
  color: #005bbb;
  background: linear-gradient(180deg, rgba(0, 91, 187, .13), rgba(0, 91, 187, .06));
  font-size: .72rem;
  font-weight: 900;
}

.pp-roadmap-step strong {
  display: block;
  margin-bottom: 3px;
  color: var(--text);
  font-size: .96rem;
  line-height: 1.12;
}

.pp-roadmap-step small {
  display: block;
  color: var(--muted);
  font-size: .78rem;
  line-height: 1.28;
}

.pp-roadmap-caption {
  position: relative;
  z-index: 1;
  margin: 14px 0 0;
  padding: 11px 12px;
  border-left: 3px solid #005bbb;
  border-radius: 12px;
  background: rgba(0, 91, 187, .055);
  color: var(--muted);
  font-size: .80rem;
  line-height: 1.38;
}

@media (max-width: 920px) {
  .pp-roadmap-card {
    padding: 18px;
  }

  .pp-roadmap-card::before {
    left: 33px;
  }

  .pp-roadmap-title {
    max-width: none;
  }
}
/* 3PILLARS_HERO_RIGHT_PANEL_SIMPLIFY_P1_PANEL_2_END */


        /* AP3_HERO_ROADMAP_LATE_OVERRIDE_V4_START */
        .pp-hero-panel {
            align-self: center;
            justify-self: end;
            width: 100%;
            max-width: 500px;
        }

        .pp-roadmap-card {
            width: 100%;
            max-width: none;
            padding: 30px 32px 24px;
            border-radius: 24px;
            box-shadow: 0 22px 52px rgba(15, 23, 42, .12);
        }

        .pp-roadmap-card::before {
            display: none !important;
        }

        .pp-roadmap-title {
            max-width: none;
            margin-top: 10px;
            margin-bottom: 22px;
            font-size: clamp(1.65rem, 2vw, 1.95rem);
            line-height: 1.1;
            letter-spacing: -.025em;
        }

        .pp-roadmap-flow {
            gap: 0;
        }

        .pp-roadmap-step {
            grid-template-columns: 42px minmax(0, 1fr);
            column-gap: 15px;
            row-gap: 6px;
            padding-top: 13px;
            padding-bottom: 13px;
        }

        .pp-roadmap-step-main {
            min-width: 0;
        }

        .pp-roadmap-caption {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            font-size: .84rem;
            line-height: 1.5;
            letter-spacing: 0;
        }

        @media (max-width: 980px) {
            .pp-hero-panel {
                justify-self: stretch;
                max-width: none;
            }
        }

        @media (max-width: 640px) {
            .pp-roadmap-card {
                padding: 24px 20px 20px;
                border-radius: 20px;
            }

            .pp-roadmap-title {
                margin-bottom: 18px;
                font-size: clamp(1.48rem, 8vw, 1.78rem);
            }

            .pp-roadmap-step {
                grid-template-columns: 40px minmax(0, 1fr);
                column-gap: 13px;
                padding-top: 11px;
                padding-bottom: 11px;
            }

            .pp-roadmap-caption {
                margin-top: 14px;
                padding-top: 14px;
            }
        }
        /* AP3_HERO_ROADMAP_LATE_OVERRIDE_V4_END */

/* AP5_FINAL_VISUAL_POLISH_V1_START */
#jak-pracujemy .pp-risk-box > strong {
  display: block;
  margin: 0 0 6px;
  line-height: 1.35;
}

#jak-pracujemy .pp-risk-steps {
  margin-top: 18px;
  gap: 12px;
}

#jak-pracujemy .pp-risk-step {
  min-height: 58px;
  display: flex;
  align-items: center;
  padding: 14px;
  border-radius: 18px;
  border-color: rgba(15, 23, 42, .10);
  box-shadow: 0 7px 18px rgba(15, 23, 42, .045);
}

@media (min-width: 861px) and (max-width: 1100px) {
  #jak-pracujemy .pp-risk-steps {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

@media (max-width: 860px) {
  #jak-pracujemy .pp-risk-box > strong {
    margin-bottom: 8px;
  }

  #jak-pracujemy .pp-risk-steps {
    margin-top: 20px;
    gap: 12px;
  }

  #jak-pracujemy .pp-risk-step {
    min-height: 0;
    padding: 15px 16px;
  }
}
/* AP5_FINAL_VISUAL_POLISH_V1_END */

</style>

  <section class="pp-reset-hero">
    <div>
      <div class="pp-eyebrow"><?= pp_h(pp_t('page.text_014')) ?></div>
      <h1><?= pp_h(pp_t('page.text_015')) ?></h1>
      <p class="pp-reset-lead"><?= pp_h(pp_t('page.text_016')) ?></p>

      <div class="hero-actions"><a class="btn btn-primary" href="<?= pp_h($contactUrl) ?>"><?= pp_h(pp_t('page.text_017')) ?></a>
        <a class="btn btn-secondary" href="#demo"><?= pp_h(pp_t('page.text_018')) ?></a>
      </div>

      <div class="pp-trust-note"><?= pp_h(pp_t('page.text_019')) ?></div>
    </div>

    <aside class="pp-hero-panel">

                        <!-- 3PILLARS_VISUAL_MAP_P1_GRAPHICS_4_START -->
        <!-- P1_PANEL_SIMPLIFY_2: premium roadmap, not a repeated three-pillar list -->
        <div class="pp-roadmap-card" aria-label="<?= pp_h(pp_t('page.attribute_020')) ?>">
          <div class="pp-roadmap-kicker"><?= pp_h(pp_t('page.text_021')) ?></div>
          <h2 class="pp-roadmap-title"><?= pp_h(pp_t('page.attribute_020')) ?></h2>

          <div class="pp-roadmap-flow">
            <div class="pp-roadmap-step">
              <span>01</span>
              <div>
                <strong><?= pp_h(pp_t('page.text_024')) ?></strong>
                <small><?= pp_h(pp_t('page.text_025')) ?></small>
              </div>
            </div>

            <div class="pp-roadmap-step">
              <span>02</span>
              <div>
                <strong><?= pp_h(pp_t('page.text_027')) ?></strong>
                <small><?= pp_h(pp_t('page.text_028')) ?></small>
              </div>
            </div>

            <div class="pp-roadmap-step pp-roadmap-step-main">
              <span>03</span>
              <div>
                <strong><?= pp_h(pp_t('page.text_030')) ?></strong>
                <small><?= pp_h(pp_t('page.text_031')) ?></small>
              </div>
            </div>
          </div>

          <p class="pp-roadmap-caption"><?= pp_h(pp_t('page.text_032')) ?></p>
        </div>
        <!-- 3PILLARS_VISUAL_MAP_P1_GRAPHICS_4_END -->

                <!-- P1_PANEL_3_REMOVED_DUPLICATED_THREE_AREAS_LIST -->
    </aside>
  </section>

  <section id="oferta" class="section pp-section-tight">
    <div class="section-title"><?= pp_h(pp_t('page.text_033')) ?></div>
    <div class="section-sub"><?= pp_h(pp_t('page.text_034')) ?></div>

    <div class="pp-simple-grid">
      <article class="pp-card-clean">
        <span class="chip"><?= pp_h(pp_t('page.text_035')) ?></span>
        <h3><?= pp_h(pp_t('page.text_036')) ?></h3>
        <div class="pp-card-question"><?= pp_h(pp_t('page.text_037')) ?></div>
        <p><?= pp_h(pp_t('page.text_038')) ?></p>
      </article>

      <article class="pp-card-clean">
        <span class="chip"><?= pp_h(pp_t('page.text_039')) ?></span>
        <h3><?= pp_h(pp_t('page.text_040')) ?></h3>
        <div class="pp-card-question"><?= pp_h(pp_t('page.text_041')) ?></div>
        <p><?= pp_h(pp_t('page.text_042')) ?></p>
      </article>

      <article class="pp-card-clean">
        <span class="chip"><?= pp_h(pp_t('page.text_043')) ?></span>
        <h3><?= pp_h(pp_t('page.text_044')) ?></h3>
        <div class="pp-card-question"><?= pp_h(pp_t('page.text_045')) ?></div>
        <p><?= pp_h(pp_t('page.text_046')) ?></p>
      </article>
    </div>
  </section>

  <section id="jak-pracujemy" class="section">
    <div class="section-title"><?= pp_h(pp_t('page.text_047')) ?></div>
    <div class="section-sub"><?= pp_h(pp_t('page.text_048')) ?></div>

    <div class="pp-risk-box">
      <strong><?= pp_h(pp_t('page.text_049')) ?></strong><?= pp_h(pp_t('page.text_050')) ?><div class="pp-risk-steps">
        <div class="pp-risk-step"><?= pp_h(pp_t('page.text_051')) ?></div>
        <div class="pp-risk-step"><?= pp_h(pp_t('page.text_052')) ?></div>
        <div class="pp-risk-step"><?= pp_h(pp_t('page.text_053')) ?></div>
        <div class="pp-risk-step"><?= pp_h(pp_t('page.text_054')) ?></div>
        <div class="pp-risk-step"><?= pp_h(pp_t('page.text_055')) ?></div>
      </div>
    </div>
  </section>

  <!-- QUESTION GENERATOR -->
    <section id="demo" class="section">
    <div class="pp-demo-reset">
      <div class="pp-demo-intro">
        <div class="section-title"><?= pp_h(pp_t('page.text_056')) ?></div>
        <div class="section-sub"><?= pp_h(pp_t('page.text_057')) ?></div>
      </div>

      <div class="demo-box">
        <textarea
          id="demoInput"
          aria-label="<?= pp_h(pp_t('page.attribute_059')) ?>"
          placeholder="<?= pp_h(pp_t('page.attribute_058')) ?>"
        ></textarea>

        <div class="hero-actions pp-demo-actions">
          <button
            id="demoBtn"
            class="btn btn-primary"
            type="button"
          ><?= pp_h(pp_t('page.text_060')) ?></button>

          <button
            id="demoExampleBtn"
            class="btn btn-secondary"
            type="button"
          ><?= pp_h(pp_t('page.text_061')) ?></button>
        </div>

        <div class="pp-demo-status">
          <span id="demoBadge" class="chip"><?= pp_h(pp_t('page.text_062')) ?></span>
          <span id="demoLimits" class="section-sub"></span>
        </div>

        <div
          id="demoOutput"
          class="demo-output"
          aria-live="polite"
          aria-atomic="true"
        ><?= pp_h(pp_t('page.text_063')) ?></div>

        <div class="section-sub pp-demo-trust"><?= pp_h(pp_t('page.text_064')) ?></div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="section-title"><?= pp_h(pp_t('page.text_065')) ?></div>
    <div class="section-sub"><?= pp_h(pp_t('page.text_066')) ?></div>
    <div class="hero-actions"><a class="btn btn-primary" href="<?= pp_h($contactUrl) ?>"><?= pp_h(pp_t('page.text_067')) ?></a>
    </div>
  </section>

  <div class="footer">
    <div><?= pp_h(pp_t('page.text_068')) ?></div>
    <div><?= pp_h(pp_t('page.text_069')) ?></div>
  </div>

</div>


<script>
    // Generator pytań – LIVE przez lokalne API z limitami:
    // - max 20 słów pytania
    // - max ~200 słów odpowiedzi (serwer dodatkowo ucina)
    // - max 100 zapytań dziennie (po stronie przeglądarki + serwera)
    document.addEventListener("DOMContentLoaded", function () {
      var LANG = <?= json_encode($currentLang, JSON_UNESCAPED_UNICODE) ?>;
      var demoApiUrl = <?= json_encode($demoApiUrl, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
      var I18N = <?php
      $__generatorJsMap = [
        'answer'     => 'generator.label.answer',
        'conn'       => 'generator.error.connection',
        'daily'      => 'generator.error.daily_limit',
        'dailyLabel' => 'generator.label.daily',
        'empty'      => 'generator.error.empty_input',
        'err'        => 'generator.status.error',
        'example'    => 'generator.example.input',
        'limit'      => 'generator.status.limit',
        'loading'    => 'generator.status.loading',
        'noAnswer'   => 'generator.error.no_answer',
        'question'   => 'generator.label.question',
        'ready'      => 'generator.status.ready',
        'server'     => 'generator.error.server',
        'words'      => 'generator.error.word_limit',
        'wordsLabel' => 'generator.label.words',
        'work'       => 'generator.status.working',
      ];
      $__generatorJsI18n = [];
      foreach (['pl','en','de','fr','zh','hi'] as $__generatorJsLang) {
        foreach ($__generatorJsMap as $__generatorJsField => $__generatorJsKey) {
          $__generatorJsI18n[$__generatorJsLang][$__generatorJsField] = pp_t($__generatorJsKey, $__generatorJsLang);
        }
      }
      echo json_encode(
        $__generatorJsI18n,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES |
        JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
      );
      unset($__generatorJsMap, $__generatorJsI18n, $__generatorJsLang, $__generatorJsField, $__generatorJsKey);
      ?>;
      var T = I18N[LANG] || I18N.en;
      var input = document.getElementById("demoInput");
      var out = document.getElementById("demoOutput");
      var btn = document.getElementById("demoBtn");
      var exBtn = document.getElementById("demoExampleBtn");
      var badge = document.getElementById("demoBadge");
      var limitsEl = document.getElementById("demoLimits");

      if (!input || !out || !btn || !exBtn || !badge || !limitsEl) return;

      var MAX_INPUT_WORDS = 20;
      var MAX_OUTPUT_WORDS = 100;
      var MAX_DAILY_CALLS = 100;

      var exampleText = T.example;

      function todayKey(prefix){
        var d = new Date();
        var yyyy = d.getFullYear();
        var mm = String(d.getMonth()+1).padStart(2,'0');
        var dd = String(d.getDate()).padStart(2,'0');
        return prefix + "_" + yyyy + "-" + mm + "-" + dd;
      }

      function countWords(s){
        var t = (s || "").trim();
        if (!t) return 0;
        return t.split(/\s+/).filter(Boolean).length;
      }

      function getDailyUsed(){
        return parseInt(localStorage.getItem(todayKey("pp_demo_calls")) || "0", 10);
      }

      function setDailyUsed(v){
        localStorage.setItem(todayKey("pp_demo_calls"), String(v));
      }

      function updateLimitsDisplay(outputText){
        var w = countWords(input.value);
        var inputUsed = w;
        var used = getDailyUsed();
        var callsLeft = Math.max(0, MAX_DAILY_CALLS - used);

        var outLeft = MAX_OUTPUT_WORDS;
        if (typeof outputText === "string" && outputText.trim()){
          outLeft = Math.max(0, MAX_OUTPUT_WORDS - countWords(outputText));
        }

        limitsEl.textContent =
          T.question + ": " +
          inputUsed + "/" + MAX_INPUT_WORDS +
          " " + T.wordsLabel + "  |  " +
          T.answer + ": " +
          outLeft + "/" + MAX_OUTPUT_WORDS +
          " " + T.wordsLabel + "  |  " +
          T.dailyLabel + ": " +
          callsLeft + "/" + MAX_DAILY_CALLS;
      }

      function trimToWords(text, maxWords){
        var words = (text || "").trim().split(/\s+/).filter(Boolean);
        if (words.length <= maxWords) return (text || "").trim();
        return words.slice(0, maxWords).join(" ");
      }

      // init counters
      updateLimitsDisplay("");

      input.addEventListener("input", function(){
      // NIE nadpisujemy wartości textarea podczas pisania (ważne dla iOS/IME),
      // bo to powoduje zlepianie słów i gubienie polskich znaków.
      updateLimitsDisplay(out.textContent || "");
        });


      exBtn.addEventListener("click", function(){
        input.value = exampleText;
        input.focus();
        updateLimitsDisplay(out.textContent || "");
      });

      btn.addEventListener("click", async function () {
        var raw = (input.value || "");
        raw = raw.trim(); // walidacja musi zobaczyć rzeczywistą liczbę słów
        input.value = raw; // jednorazowo, tu jest bezpiecznie
        var w = countWords(raw);


        // 1) Puste / za krótkie
        if (!raw) {
          badge.textContent = T.limit;
          out.textContent = T.empty;
          updateLimitsDisplay(out.textContent);
          return;
        }

        // 2) Limit słów (twardo)
        if (w > MAX_INPUT_WORDS) {
          badge.textContent = T.limit;
          out.textContent = T.words;
          updateLimitsDisplay(out.textContent);
          return;
        }

        // 3) Limit dzienny (po stronie przeglądarki – szybka blokada)
        var used = getDailyUsed();
        if (used >= MAX_DAILY_CALLS) {
          badge.textContent = T.limit;
          out.textContent = T.daily;
          updateLimitsDisplay(out.textContent);
          return;
        }

        badge.textContent = T.work;
        out.textContent = T.loading;
        updateLimitsDisplay(out.textContent);

        try {
          const res = await fetch(demoApiUrl, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ question: raw, lang: <?= json_encode($currentLang, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?> })
          });

          const data = await res.json();

          if (!res.ok || data.error) {
            badge.textContent = T.err;
            out.textContent = (data && data.error) ? data.error : T.server;
            updateLimitsDisplay(out.textContent);
            return;
          }

          // sukces → zwiększ licznik dzienny
          setDailyUsed(used + 1);

          badge.textContent = T.ready;
          out.textContent = (data && data.answer) ? data.answer : T.noAnswer;
          updateLimitsDisplay(out.textContent);
        } catch (e) {
          badge.textContent = T.err;
          out.textContent = T.conn;
          updateLimitsDisplay(out.textContent);
        }
      });
    });
  </script>


  <!-- AP3_MOBILE_NAV_HIDE_SCROLL_JS_START -->
  <script>
  (function () {
    "use strict";

    var nav = document.querySelector(".nav");

    if (!nav) {
      return;
    }

    var mobileQuery = window.matchMedia("(max-width: 920px)");
    var ticking = false;

    function showNav() {
      nav.classList.remove("pp-nav-hidden");
    }

    function hideNav() {
      nav.classList.add("pp-nav-hidden");
    }

    function updateNav() {
      var currentScrollY = Math.max(0, window.scrollY || 0);

      if (!mobileQuery.matches || currentScrollY <= 20) {
        showNav();
      } else {
        hideNav();
      }

      ticking = false;
    }

    function requestUpdate() {
      if (ticking) {
        return;
      }

      ticking = true;
      window.requestAnimationFrame(updateNav);
    }

    window.addEventListener("scroll", requestUpdate, { passive: true });
    window.addEventListener("resize", requestUpdate);

    if (typeof mobileQuery.addEventListener === "function") {
      mobileQuery.addEventListener("change", showNav);
    } else if (typeof mobileQuery.addListener === "function") {
      mobileQuery.addListener(showNav);
    }

    showNav();
  }());
  </script>
  <!-- AP3_MOBILE_NAV_HIDE_SCROLL_JS_END -->

</body>
</html>

