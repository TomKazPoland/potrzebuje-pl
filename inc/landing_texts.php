<?php

declare(strict_types=1);

require_once __DIR__ . '/i18n_runtime.php';

if (!function_exists('pp_t')) {
    function pp_t(
        $key,
        $language = null,
        $parameters = []
    ) {
        global $currentLang;

        $lang =
            $language
            ?? ($currentLang ?? 'pl');

        $value = pp_i18n_t(
            (string)$key,
            (string)$lang
        );

        if (!is_array($parameters) || $parameters === []) {
            return $value;
        }

        $replace = [];

        foreach ($parameters as $name => $replacement) {
            $name = trim(
                (string)$name,
                " \t\n\r\0\x0B{}"
            );

            if ($name === '') {
                continue;
            }

            if (
                !is_scalar($replacement)
                && $replacement !== null
            ) {
                continue;
            }

            $replace[
                '{' . $name . '}'
            ] = (string)$replacement;
        }

        return strtr(
            $value,
            $replace
        );
    }
}
