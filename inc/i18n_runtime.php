<?php

function pp_i18n_catalog()
{
    static $catalog = null;

    if ($catalog === null) {
        $loaded = require __DIR__ . '/i18n_master.php';
        $catalog = is_array($loaded) ? $loaded : [];
    }

    return $catalog;
}

function pp_i18n_languages()
{
    static $languages = null;

    if ($languages !== null) {
        return $languages;
    }

    $languages = [];

    foreach (pp_i18n_catalog() as $translations) {
        if (!is_array($translations) || !$translations) {
            continue;
        }

        foreach (array_keys($translations) as $language) {
            $language = strtolower(trim((string) $language));

            if ($language !== '') {
                $languages[$language] = true;
            }
        }
    }

    $languages = array_keys($languages);
    sort($languages, SORT_STRING);

    return $languages;
}

function pp_i18n_normalize_lang($language, $fallback = 'pl')
{
    $languages = pp_i18n_languages();

    $language = strtolower(trim((string) $language));
    $fallback = strtolower(trim((string) $fallback));

    if (in_array($language, $languages, true)) {
        return $language;
    }

    if (in_array($fallback, $languages, true)) {
        return $fallback;
    }

    return isset($languages[0]) ? $languages[0] : '';
}

function pp_i18n_t($key, $language = 'pl')
{
    $catalog = pp_i18n_catalog();
    $key = (string) $key;
    $language = pp_i18n_normalize_lang($language, 'pl');

    if (
        isset($catalog[$key])
        && is_array($catalog[$key])
        && array_key_exists($language, $catalog[$key])
    ) {
        return (string) $catalog[$key][$language];
    }

    if (
        isset($catalog[$key])
        && is_array($catalog[$key])
        && array_key_exists('pl', $catalog[$key])
    ) {
        return (string) $catalog[$key]['pl'];
    }

    return '';
}
