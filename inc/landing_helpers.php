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


function pp_route_path($lang, $route = '') {
    $base = pp_language_path($lang);
    $route = trim((string)$route, '/');
    return ($route === '') ? $base : $base . $route . '/';
}

function pp_route_url($lang, $route = '') {
    return 'https://potrzebuje.pl' . pp_route_path($lang, $route);
}

function pp_contact_path($lang) {
    return pp_site_prefix() . '/contact.php?lang=' . rawurlencode((string)$lang);
}

function pp_asset_path($path) {
    return pp_site_prefix() . '/' . ltrim((string)$path, '/');
}
