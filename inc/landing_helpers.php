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

function pp_canonical_url($lang) {
    $base = 'https://potrzebuje.pl/3pillars';
    return ($lang === 'pl') ? $base . '/' : $base . '/' . $lang . '/';
}

function pp_base_prefix($lang) {
    return ($lang === 'pl') ? '' : '../';
}

