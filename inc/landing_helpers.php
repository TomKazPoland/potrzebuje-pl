<?php
function pp_h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function pp_html_lang($lang) {
    $map = [
        'pl' => 'pl',
        'en' => 'en',
        'de' => 'de',
        'fr' => 'fr',
        'zh' => 'zh-Hans',
        'hi' => 'hi',
    ];
    return $map[$lang] ?? 'en';
}

function pp_site_prefix() {
    $scriptName = (string)($_SERVER['SCRIPT_NAME'] ?? '');
    return (strpos($scriptName, '/3pillars/') === 0) ? '/3pillars' : '';
}

function pp_language_path($lang) {
    $prefix = pp_site_prefix();
    return ($lang === 'pl') ? $prefix . '/' : $prefix . '/' . $lang . '/';
}

function pp_canonical_url($lang) {
    return 'https://potrzebuje.pl' . pp_language_path($lang);
}

function pp_base_prefix($lang) {
    return ($lang === 'pl') ? '' : '../';
}

