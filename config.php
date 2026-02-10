<?php
/**
 * potrzebuje.pl — central configuration
 *
 * Keep ALL tunable parameters here.
 * Recommended: set OPENAI_API_KEY as an environment variable in your hosting panel.
 */

# === OpenAI ===
$OPENAI_API_KEY =
    getenv('OPENAI_API_KEY')
    ?: ($_ENV['OPENAI_API_KEY'] ?? null)
    ?: ($_SERVER['OPENAI_API_KEY'] ?? null);

if (!$OPENAI_API_KEY) {
    // Fallback for shared-hosting: keep secret outside repo and outside public_html
    $secret_file = '/home/potrzebu/secrets/openai_key.php';
    if (file_exists($secret_file)) {
        $OPENAI_API_KEY = require $secret_file;
    }
}

$OPENAI_API_KEY = is_string($OPENAI_API_KEY) ? trim($OPENAI_API_KEY) : '';

if ($OPENAI_API_KEY === '') {
    // UWAGA: nie echo, tylko die — i najlepiej bez HTML, bo demo_api oczekuje JSON.
    // Jeśli to wyskoczy, demo_api.php złapie brak klucza i zwróci błąd JSON.
    define('OPENAI_API_KEY', '');
} else {
    define('OPENAI_API_KEY', $OPENAI_API_KEY);
}

define('OPENAI_MODEL', 'o4-mini');   // model id (e.g. o4-mini)



error_log("OPENAI_API_KEY length=" . strlen(OPENAI_API_KEY));




# === Mini-demo limits ===
define('DEMO_MAX_INPUT_WORDS', 20);      // max words in user question
define('DEMO_MAX_OUTPUT_WORDS', 100);    // max words in assistant answer
define('DEMO_MAX_DAILY_CALLS', 100);     // max demo calls per day per IP
define('DEMO_MAX_TRANSLATIONS', 10);     // max translation requests/day per IP

# === Content / safety constraints (server-enforced) ===
define('DEMO_STYLE_MAX_BULLETS', 5);     // style: max 5 bullet points
define('DEMO_DISALLOW_TOPICS', 'medical, legal, financial advice; illegal; political; erotic');

# === Languages ===
define('DEMO_ALLOWED_LANGS', 'pl,en,de'); // supported demo languages (page language)

# === Localized UI strings used by JS + server ===
$GLOBALS['PP_I18N'] = [
  'pl' => [
    'badge_ready' => 'gotowe',
    'badge_work'  => 'analiza',
    'badge_err'   => 'błąd',
    'badge_limit' => 'limit',
    'demo_placeholder' => 'Np. Zespół chce używać AI, ale każdy robi to inaczej. Nie wiemy od czego zacząć, jakie procesy wybrać i jak mierzyć efekt.',
    'demo_intro' => 'Wpisz problem po lewej i kliknij „Pokaż przykład analizy AI”.',
    'demo_btn'   => 'Pokaż przykład analizy AI',
    'demo_btn_ex'=> 'Wstaw przykład',
    'err_empty'  => 'Wpisz krótkie pytanie (max 20 słów).',
    'err_words'  => 'Limit przekroczony: maksymalnie 20 słów w pytaniu.',
    'err_daily'  => 'Limit dzienny demo został przekroczony. Spróbuj jutro lub użyj KONTAKT.',
    'err_server' => 'Błąd serwera. Spróbuj ponownie później.',
    'err_api_key'=> 'Błąd konfiguracji: brak klucza API (OPENAI_API_KEY).',
  ],
  'en' => [
    'badge_ready' => 'ready',
    'badge_work'  => 'thinking',
    'badge_err'   => 'error',
    'badge_limit' => 'limit',
    'demo_placeholder' => 'E.g. The team wants to use AI, but everyone does it differently. We do not know where to start.',
    'demo_intro' => 'Type your question on the left and click “Run AI demo”.',
    'demo_btn'   => 'Run AI demo',
    'demo_btn_ex'=> 'Insert example',
    'err_empty'  => 'Please type a short question (max 20 words).',
    'err_words'  => 'Limit exceeded: max 20 words per question.',
    'err_daily'  => 'Daily demo limit reached. Try tomorrow or use CONTACT.',
    'err_server' => 'Server error. Please try again later.',
    'err_api_key'=> 'Configuration error: missing API key (OPENAI_API_KEY).',
  ],
  'de' => [
    'badge_ready' => 'bereit',
    'badge_work'  => 'analyse',
    'badge_err'   => 'fehler',
    'badge_limit' => 'limit',
    'demo_placeholder' => 'Z.B. Das Team will KI nutzen, aber jeder macht es anders. Wir wissen nicht, wo wir anfangen.',
    'demo_intro' => 'Gib links eine kurze Frage ein und klicke „KI‑Demo starten“.',
    'demo_btn'   => 'KI‑Demo starten',
    'demo_btn_ex'=> 'Beispiel einfügen',
    'err_empty'  => 'Bitte gib eine kurze Frage ein (max. 20 Wörter).',
    'err_words'  => 'Limit überschritten: max. 20 Wörter pro Frage.',
    'err_daily'  => 'Tageslimit erreicht. Versuche es morgen oder nutze KONTAKT.',
    'err_server' => 'Serverfehler. Bitte später erneut versuchen.',
    'err_api_key'=> 'Konfigurationsfehler: fehlender API‑Schlüssel (OPENAI_API_KEY).',
  ],
];

function pp_lang_from_request($fallback='pl'){
  $lang = isset($_GET['lang']) ? strtolower(trim($_GET['lang'])) : '';
  if (!$lang) {
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (strpos($uri, '/en/') !== false) $lang = 'en';
    if (strpos($uri, '/de/') !== false) $lang = 'de';
  }
  if (!$lang) $lang = $fallback;

  $allowed = explode(',', DEMO_ALLOWED_LANGS);
  if (!in_array($lang, $allowed, true)) $lang = $fallback;
  return $lang;
}

function pp_t($key, $lang='pl'){
  $i18n = $GLOBALS['PP_I18N'] ?? [];
  if (isset($i18n[$lang]) && array_key_exists($key, $i18n[$lang])) return $i18n[$lang][$key];
  if (isset($i18n['pl']) && array_key_exists($key, $i18n['pl'])) return $i18n['pl'][$key];
  return '';
}
?>
