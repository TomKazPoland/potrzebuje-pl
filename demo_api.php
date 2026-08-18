<?php
// demo_api.php — backend for the "Mini-demo AI" widget (PL/EN/DE)
// Server-enforced limits + safety constraints.
// IMPORTANT: this file requires PHP on the server. It will NOT work when opened from disk.

header('Content-Type: application/json; charset=UTF-8');

require_once '/home/potrzebuje/Projects/Secrets/chatgpt.php';
require_once '/home/potrzebuje/public_html/config.php';
require_once __DIR__ . '/inc/i18n_runtime.php';
/**
 * Prosty logger do pliku demo_api.log w tym samym katalogu.
 * Loguje m.in. przypadki "Brak odpowiedzi", błędy HTTP, błędy cURL.
 */
function log_demo_event($type, $question, $info = []){
  $entry = [
    'ts'       => gmdate('c'),
    'ip'       => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'type'     => $type,
    'question' => $question,
    'info'     => $info,
  ];
  $line = json_encode($entry, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  if ($line !== false){
    @file_put_contents('/home/potrzebuje/logs/demo_api.log', $line . "\n", FILE_APPEND | LOCK_EX);
  }
}

/**
 * Osobny log pytań wpisywanych przez użytkowników do pola mini-demo.
 * Format: JSON Lines (jeden wpis na linię).
 */
function log_demo_user_input($question, $lang){
  $q = trim((string)$question);
  if ($q === '') return; // pomijamy puste wpisy

  $entry = [
    'ts'       => gmdate('c'),
    'ip'       => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'lang'     => (string)$lang,
    'question' => $q,
  ];

  $line = json_encode($entry, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  if ($line !== false){
    @file_put_contents(__DIR__ . '/demo_user_inputs.log', $line . "\n", FILE_APPEND | LOCK_EX);
  }
}

function json_out($status, $payload){
  http_response_code($status);
  echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}

function count_words($s){
  $s = trim((string)$s);
  if ($s === '') return 0;
  // Split on any whitespace
  $parts = preg_split('/\s+/u', $s, -1, PREG_SPLIT_NO_EMPTY);
  return $parts ? count($parts) : 0;
}

function trim_to_words($text, $maxWords){
  $text = trim((string)$text);
  if ($text === '') return '';
  $parts = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
  if (!$parts) return '';
  if (count($parts) <= $maxWords) return $text;
  return implode(' ', array_slice($parts, 0, $maxWords));
}

// --- read JSON ---
$raw = file_get_contents('php://input');
$req = json_decode($raw, true);
if (!is_array($req)) $req = [];

$question = isset($req['question']) ? trim((string)$req['question']) : '';
$lang = isset($req['lang']) ? strtolower(trim((string)$req['lang'])) : '';
if (!$lang) $lang = pp_lang_from_request('pl');
$lang = pp_i18n_normalize_lang($lang, 'pl');

// Dodatkowy log: co użytkownicy wpisują w polu demo.
log_demo_user_input($question, $lang);

// --- API key validation ---
$apiKey = OPENAI_API_KEY;
if (
  !$apiKey ||
  $apiKey === 'PUT_YOUR_OPENAI_API_KEY_HERE' ||
  strpos($apiKey, 'PUT_YOUR_') !== false ||
  strpos($apiKey, '...') !== false
){
  log_demo_event('config_error', $question, ['reason' => 'missing_or_placeholder_api_key']);
  json_out(500, ['error' => pp_i18n_t('generator.error.api_configuration', $lang)]);
}

// --- input limits ---
if ($question === ''){
  json_out(400, ['error' => pp_i18n_t('generator.error.empty_input', $lang)]);
}
if (count_words($question) > DEMO_MAX_INPUT_WORDS){
  json_out(400, ['error' => pp_i18n_t('generator.error.word_limit', $lang)]);
}

// --- daily limits per IP (lightweight file-based counter) ---
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$today = gmdate('Y-m-d'); // use UTC day for consistency
$counterDir = __DIR__ . '/_counters';
if (!is_dir($counterDir)) @mkdir($counterDir, 0755, true);

$counterFile = $counterDir . '/demo_' . preg_replace('/[^0-9A-Za-z_\-\.]/', '_', $ip) . '_' . $today . '.json';
$counter = ['calls'=>0, 'translations'=>0];

if (file_exists($counterFile)){
  $j = json_decode(@file_get_contents($counterFile), true);
  if (is_array($j)) $counter = array_merge($counter, $j);
}

if (($counter['calls'] ?? 0) >= DEMO_MAX_DAILY_CALLS){
  log_demo_event('limit_daily_calls', $question, [
    'calls' => $counter['calls'],
    'limit' => DEMO_MAX_DAILY_CALLS
  ]);
  json_out(429, ['error' => pp_i18n_t('generator.error.daily_limit', $lang)]);
}

// --- quick classification for "translation-only" requests (very simple heuristic) ---
$isTranslation = false;

// Safe lowercase: use mbstring if available, otherwise fall back to strtolower (ASCII-safe).
// For our keywords (pl/en/de trigger words), strtolower is sufficient as fallback.
$lower = is_string($question) ? trim($question) : '';
$lower = function_exists('mb_strtolower')
  ? mb_strtolower($lower, 'UTF-8')
  : strtolower($lower);

if (preg_match('/\b(tłumacz|przetłumacz|translate|übersetze)\b/u', $lower)) {
  $isTranslation = true;
}

if ($isTranslation && ($counter['translations'] ?? 0) >= DEMO_MAX_TRANSLATIONS) {
  log_demo_event('limit_translations', $question, [
    'translations' => $counter['translations'] ?? 0,
    'limit'        => DEMO_MAX_TRANSLATIONS
  ]);
  json_out(429, ['error' => pp_i18n_t('generator.error.translation_limit_exceeded', $lang)]);
}




// --- build system prompt (language-specific) ---
$siteContextPl = "potrzebuje.pl: szkolenia AI/LLM i praktyczne wdrożenia. Robimy to dobrze i pod klienta: ustalamy materiał, audytorium (rola, branża, doświadczenie), czas/budżet, termin, zdalnie czy na miejscu. Robimy szkolenie tak, żeby uczestnicy się NAUCZYLI, a nie tylko wysłuchali. Jeśli pytanie dotyczy tego co robi potrzebuje.pl – odpowiadaj na podstawie tego kontekstu i na końcu dodaj: \"__PP_CANONICAL_CONTACT_TAIL__\".";

$siteContextEn = "potrzebuje.pl: hands-on AI/LLM training and practical implementations. We tailor it to the client: we define the material, audience (role/industry/experience), time/budget, date, remote vs onsite. The goal is real learning, not a slide show. If the question is about what potrzebuje.pl does, answer using this context and end with: \"__PP_CANONICAL_CONTACT_TAIL__\".";

$siteContextDe = "potrzebuje.pl: praxisnahe KI/LLM-Schulungen und praktische Umsetzungen. Kundenspezifisch: Inhalte, Zielgruppe (Rolle/Branche/Erfahrung), Zeit/Budget, Termin, remote vs vor Ort. Ziel ist echtes Lernen, nicht nur Folien. Wenn die Frage das Angebot von potrzebuje.pl betrifft, antworte anhand dieses Kontexts und ende mit: \"__PP_CANONICAL_CONTACT_TAIL__\".";

$siteContext = ($lang === 'de') ? $siteContextDe
             : (($lang === 'en') ? $siteContextEn : $siteContextPl);

$contactTail = pp_i18n_t('generator.response.contact_tail', $lang);

$siteContext = str_replace(
    '__PP_CANONICAL_CONTACT_TAIL__',
    $contactTail,
    $siteContext
);

/**
 * Buduje system prompt zależny od języka, z jasnym opisem:
 * - co jest dozwolone,
 * - czego nie wolno (medycyna/prawo/finanse, nielegalne, erotyka, propaganda polityczna).
 * Pozwala na neutralne pytania faktograficzne (geografia, rola prezydenta itd.).
 */
function pp_ai_language_profile($lang){
  static $profiles = [
    'pl' => ['output_language' => 'Polish'],
    'en' => ['output_language' => 'English'],
    'de' => ['output_language' => 'German'],
    'fr' => ['output_language' => 'French'],
    'zh' => ['output_language' => 'Chinese'],
    'hi' => ['output_language' => 'Hindi'],
  ];

  return isset($profiles[$lang]) ? $profiles[$lang] : $profiles['pl'];
}

function pp_ai_compression_prompt($lang, $maxWords){
  $profile = pp_ai_language_profile($lang);
  $outputLanguage = $profile['output_language'];

  return
    "Shorten the answer to at most " . $maxWords . " words while preserving its meaning. " .
    "Output only in " . $outputLanguage . ". " .
    "The page language is the only source of truth for output language. " .
    "Do not infer or switch output language from the user's question or from the answer being shortened. " .
    "Do not add new facts. Do not output incomplete sentences or lists.";
}

function build_system_prompt($lang, $maxWords, $maxBullets, $siteContext){
  $profile = pp_ai_language_profile($lang);
  $outputLanguage = $profile['output_language'];

  return
    "You are a limited LLM module on the potrzebuje.pl website.\n" .
    "Task: generate starting questions for a first conversation about AI, processes and software delivery.\n" .
    "Important: use NO internet, NO RAG and no current external data.\n" .
    "Do not provide a diagnosis. Generate questions only.\n\n" .

    "Rules:\n" .
    "- Do not recommend an implementation.\n" .
    "- Do not choose tools, vendors or architecture.\n" .
    "- Do not decide which service path is best.\n" .
    "- Do not estimate price, timeline or promised results.\n" .
    "- Do not perform an audit or create an implementation plan.\n" .
    "- Do not provide medical, legal or financial advice.\n" .
    "- Do not generate political, illegal or erotic content.\n\n" .

    "Answer format, maximum " . $maxWords . " words:\n" .
    "- Use five sections equivalent to People/Roles, Process, Data/Tools, Risks, Prepare before conversation.\n" .
    "- Translate all section headings into the required output language.\n" .
    "- Keep lists concise and complete.\n\n" .

    "OUTPUT LANGUAGE CONTRACT:\n" .
    "- Output only in " . $outputLanguage . ".\n" .
    "- The page language is the only source of truth for output language.\n" .
    "- Do not infer, select or switch output language from the user's question.\n" .
    "- Translate all headings and prose into " . $outputLanguage . ".\n" .
    "- Remain in " . $outputLanguage . " for the complete answer.\n\n" .

    "Be concise, concrete and professional.";
}


$system = build_system_prompt($lang, DEMO_MAX_OUTPUT_WORDS, DEMO_STYLE_MAX_BULLETS, $siteContext);

// --- call OpenAI (Responses API) ---
// UWAGA: podnosimy max_output_tokens, żeby model miał zapas na "reasoning tokens".
$payload = [
  'model' => OPENAI_MODEL,
  'input' => [
    ['role' => 'system', 'content' => $system],
    ['role' => 'user',   'content' => $question],
  ],
  'max_output_tokens' => 1024,  // było 350 – to powodowało status "incomplete" + brak output_text
];

$ch = curl_init('https://api.openai.com/v1/responses');
curl_setopt_array($ch, [
  CURLOPT_POST => true,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
  ],
  CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
  CURLOPT_TIMEOUT => 25,
]);

$resp = curl_exec($ch);
$code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err  = curl_error($ch);
curl_close($ch);

if ($resp === false){
  log_demo_event('curl_error', $question, ['error' => $err]);
  json_out(500, ['error' => pp_i18n_t('generator.error.connection', $lang)]);
}

$data = json_decode($resp, true);
if (!is_array($data)){
  log_demo_event('decode_error', $question, [
    'http_code' => $code,
    'raw'       => mb_substr($resp, 0, 500)
  ]);
  json_out(500, ['error' => pp_i18n_t('generator.error.server', $lang)]);
}

if ($code < 200 || $code >= 300){
  // Technical upstream detail remains in logs only.
  $upstreamMsg = $data['error']['message'] ?? ('HTTP ' . $code);

  $msg = ($code === 401 || $code === 403)
    ? pp_i18n_t('generator.error.api_configuration', $lang)
    : pp_i18n_t('generator.error.server', $lang);

  log_demo_event('http_error', $question, [
    'http_code' => $code,
    'message'   => $upstreamMsg,
  ]);

  json_out(500, ['error' => $msg]);
}

// Extract text from Responses API
$answer = '';
if (isset($data['output']) && is_array($data['output'])){
  foreach ($data['output'] as $block){
    if (($block['type'] ?? '') === 'message'
        && isset($block['content'])
        && is_array($block['content'])){
      foreach ($block['content'] as $c){
        if (($c['type'] ?? '') === 'output_text'){
          $answer .= $c['text'] ?? '';
        }
      }
    }
  }
}
$answer = trim((string)$answer);
if ($answer === ''){
  // Logujemy przypadek "pusta odpowiedź" razem z tym, co przyszło z API
  log_demo_event('empty_answer', $question, [
    'status'     => $data['status'] ?? null,
    'incomplete' => $data['incomplete_details'] ?? null,
    'raw'        => $data,
  ]);

  $answer = pp_i18n_t('generator.error.no_answer', $lang);
}

// Enforce word limit WITHOUT blind truncation:
// Jeśli model przekroczył limit słów, prosimy go o skrócenie odpowiedzi,
// zamiast brutalnie ją uciąć.
if (count_words($answer) > DEMO_MAX_OUTPUT_WORDS){

  // 1) Prompt kompresujący zależny od języka
    $compressSys = pp_ai_compression_prompt(
      $lang,
      DEMO_MAX_OUTPUT_WORDS
    );

  // 2) Drugi call do API – model skraca własną odpowiedź
  $compressPayload = [
    'model' => OPENAI_MODEL,
    'input' => [
      ['role' => 'system', 'content' => $compressSys],
      [
        'role'    => 'user',
        'content' => "USER QUESTION:\n" . $question . "\n\nANSWER TO SHORTEN:\n" . $answer,
      ],
    ],
    'max_output_tokens' => 250,
  ];

  $ch2 = curl_init('https://api.openai.com/v1/responses');
  curl_setopt_array($ch2, [
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
      'Authorization: Bearer ' . $apiKey,
      'Content-Type: application/json',
    ],
    CURLOPT_POSTFIELDS     => json_encode($compressPayload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    CURLOPT_TIMEOUT        => 25,
  ]);
  $resp2 = curl_exec($ch2);
  $code2 = (int)curl_getinfo($ch2, CURLINFO_HTTP_CODE);
  $err2  = curl_error($ch2);
  curl_close($ch2);

  if ($resp2 === false){
    log_demo_event('compress_curl_error', $question, ['error' => $err2]);
  } elseif ($code2 < 200 || $code2 >= 300){
    log_demo_event('compress_http_error', $question, [
      'http_code' => $code2,
      'raw'       => mb_substr((string)$resp2, 0, 500),
    ]);
  } else {
    $data2 = json_decode((string)$resp2, true);
    if (is_array($data2) && isset($data2['output']) && is_array($data2['output'])) {
      $a2 = '';
      foreach ($data2['output'] as $block){
        if (($block['type'] ?? '') === 'message'
            && isset($block['content'])
            && is_array($block['content'])){
          foreach ($block['content'] as $c){
            if (($c['type'] ?? '') === 'output_text'){
              $a2 .= $c['text'] ?? '';
            }
          }
        }
      }
      $a2 = trim((string)$a2);
      if ($a2 !== '') {
        $answer = $a2;
      }
    }
  }

  // 3) Jeśli mimo wszystko dalej za długie – NIE ucinamy,
  // tylko prosimy użytkownika o bardziej konkretne pytanie.
  if (count_words($answer) > DEMO_MAX_OUTPUT_WORDS){
    $answer = str_replace(
      '{max_words}',
      (string) DEMO_MAX_OUTPUT_WORDS,
      pp_i18n_t('generator.error.answer_too_long', $lang)
    );
  }
}

// Update counters
$counter['calls'] = (int)($counter['calls'] ?? 0) + 1;
if ($isTranslation) {
  $counter['translations'] = (int)($counter['translations'] ?? 0) + 1;
}
@file_put_contents($counterFile, json_encode($counter));

json_out(200, ['answer' => $answer]);
?>
