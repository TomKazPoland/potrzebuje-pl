<?php
// contact.php — multilingual contact form (PL/EN/DE/FR/ZH/HI)
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/inc/i18n_runtime.php';

$requestedLang = isset($_GET['lang'])
  ? strtolower(trim((string)$_GET['lang']))
  : '';

if ($requestedLang === '') {
  $uri = $_SERVER['REQUEST_URI'] ?? '';

  if (
    preg_match(
      '#/(en|de|fr|zh|hi)/#',
      $uri,
      $langMatch
    )
  ) {
    $requestedLang = $langMatch[1];
  }
}

$lang = pp_i18n_normalize_lang(
  $requestedLang !== '' ? $requestedLang : 'pl',
  'pl'
);

$pageTitle = pp_i18n_t('contact.page.title', $lang);
$backText = pp_i18n_t('contact.back_home', $lang);

$titleText = preg_replace(
  '/^potrzebuje\.pl\s+—\s+/u',
  '',
  $pageTitle
);

$tr = [
  'title' => $titleText,
  'lead' => pp_i18n_t('contact.form.intro', $lang),
  'email' => pp_i18n_t('contact.sender_email.label', $lang),
  'subject' => pp_i18n_t('contact.subject.label', $lang),
  'message' => pp_i18n_t('contact.message.label', $lang),
  'send' => pp_i18n_t('contact.submit', $lang),
  'ok' => pp_i18n_t('contact.success', $lang),
  'err_required' => pp_i18n_t('contact.error.required', $lang),
  'err_email' => pp_i18n_t('contact.error.invalid_email', $lang),
  'err_send' => pp_i18n_t('contact.error.send_failed', $lang),
  'whatsapp_intro' => pp_i18n_t('contact.whatsapp.intro', $lang),
  'whatsapp_label' => pp_i18n_t('contact.whatsapp.cta', $lang),
];
$to = pp_i18n_t('contact.email.address', $lang);

$successMessage = "";
$errorMessage   = "";

// POST handler
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $senderEmail = isset($_POST["sender_email"]) ? trim($_POST["sender_email"]) : "";
  $subject     = isset($_POST["subject"])      ? trim($_POST["subject"])      : "";
  $message     = isset($_POST["message"])      ? trim($_POST["message"])      : "";

  if (empty($senderEmail) || empty($subject) || empty($message)) {
    $errorMessage = $tr['err_required'];
  } elseif (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
    $errorMessage = $tr['err_email'];
  } else {
    $ip = $_SERVER["REMOTE_ADDR"] ?? "unknown";
    $ua = $_SERVER["HTTP_USER_AGENT"] ?? "unknown";

    $emailSubject = "[potrzebuje.pl] " . $subject;
    $emailBody = "From: " . $senderEmail . "\n"
               . "IP: " . $ip . "\n"
               . "UA: " . $ua . "\n\n"
               . $message . "\n";

    $headers = "From: kontakt@potrzebuje.pl\r\n"
             . "Reply-To: " . $senderEmail . "\r\n"
             . "MIME-Version: 1.0\r\n"
             . "Content-Type: text/plain; charset=UTF-8\r\n";

    $sent = mail($to, $emailSubject, $emailBody, $headers, "-fkontakt@potrzebuje.pl");

    if ($sent) $successMessage = $tr['ok'];
    else $errorMessage = $tr['err_send'];
        $logLine = date("c")
            . " | Reply-To: " . $senderEmail
            . " | IP: " . ($_SERVER["REMOTE_ADDR"] ?? "unknown")
            . " | UA: " . ($_SERVER["HTTP_USER_AGENT"] ?? "unknown")
            . PHP_EOL;
        file_put_contents("/home/potrzebuje/logs/contact_mail_errors.log", $logLine, FILE_APPEND | LOCK_EX);
  }
}

function h($s){ return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8"); }

// homepage target per language
$home = ($lang === 'pl') ? '/' : '/' . $lang . '/';
// KONFIGURACJA WHATSAPP – PODMIEŃ NA SWÓJ NUMER
$whatsNumber  = '48601201900';        // numer do URL, np. 48501234567 (BEZ spacji)
$whatsDisplay = '+48 601 201 900';    // jak ma się wyświetlać użytkownikowi

$whatsTextCurrent = pp_i18n_t('contact.whatsapp.prefill', $lang);

?><!DOCTYPE html>
<html lang="<?=h($lang)?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?=h($pageTitle)?></title>
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:#f7f7f7;color:#111}
    .page{max-width:820px;margin:0 auto;padding:16px}
    a{color:#0a66c2;text-decoration:none}
    a:hover{text-decoration:underline}
    .card{background:#fff;border:1px solid #eaeaea;border-radius:16px;padding:18px;margin-top:12px}
    h1{font-size:2rem;margin:6px 0 8px}
    p{color:#555;line-height:1.55}
    label{display:block;font-weight:700;margin:16px 0 6px}
    input,textarea{width:100%;padding:12px;border:1px solid #d9d9d9;border-radius:12px;font:inherit}
    textarea{min-height:180px;resize:vertical}
    .btn{margin-top:16px;background:#0077cc;color:#fff;border:none;border-radius:999px;padding:12px 18px;font-weight:800;letter-spacing:.04em;text-transform:uppercase;cursor:pointer}
    .btn:hover{background:#005fa3}
    .msg-ok{padding:12px 14px;border-radius:12px;background:#e9f7ef;color:#0b6b2f;margin-top:12px;border:1px solid #cfe9da}
    .msg-err{padding:12px 14px;border-radius:12px;background:#fdecec;color:#8a1f17;margin-top:12px;border:1px solid #f5caca}

    /* NOWE: blok WhatsApp, stylistyka spójna z resztą strony */
    .whatsapp-block{margin-top:20px}
    .btn-whatsapp{
      background:#25D366;
      color:#fff;
      padding:10px 16px;
      border-radius:999px;
      font-weight:600;
      display:inline-block;
      text-decoration:none;
      margin-top:8px;
    }
    .btn-whatsapp:hover{
      opacity:0.9;
      color:#fff;
      text-decoration:none;
    }
  </style>
</head>
<body>
  <div class="page">
    <a href="<?=h($home)?>"><?=h($backText)?></a>

    <div class="card">
      <h1><?=h($tr['title'])?></h1>
      <p><?=h($tr['lead'])?></p>

      <?php if ($successMessage): ?>
        <div class="msg-ok"><?=h($successMessage)?></div>
      <?php endif; ?>

      <?php if ($errorMessage): ?>
        <div class="msg-err"><?=h($errorMessage)?></div>
      <?php endif; ?>

      <form method="POST" action="contact.php?lang=<?=h($lang)?>">
        <label><?=h($tr['email'])?> *</label>
        <input type="email" name="sender_email" required data-validation-required="<?=h($tr['err_required'])?>" data-validation-email="<?=h($tr['err_email'])?>" value="<?=h($_POST["sender_email"] ?? "")?>"/>

        <label><?=h($tr['subject'])?> *</label>
        <input type="text" name="subject" required data-validation-required="<?=h($tr['err_required'])?>" value="<?=h($_POST["subject"] ?? "")?>"/>

        <label><?=h($tr['message'])?> *</label>
        <textarea name="message" required data-validation-required="<?=h($tr['err_required'])?>"><?=h($_POST["message"] ?? "")?></textarea>

        <button class="btn" type="submit"><?=h($tr['send'])?></button>
      </form>

      <!-- NOWOŚĆ: WhatsApp kontakt, nie psuje układu lądowania -->
      <div class="whatsapp-block">
        <p><?=h($tr['whatsapp_intro'])?></p>
        <a
          class="btn-whatsapp"
          href="https://wa.me/<?=h($whatsNumber)?>?text=<?=rawurlencode($whatsTextCurrent)?>"
          target="_blank"
          rel="noopener noreferrer"
        >
        <?=h($tr['whatsapp_label'])?>
        </a>
      </div>

    </div>
  </div>

<script>
(() => {
  const fields = document.querySelectorAll(
    'form [required]'
  );

  fields.forEach((field) => {
    field.addEventListener('invalid', () => {
      field.setCustomValidity('');

      if (field.validity.valueMissing) {
        field.setCustomValidity(
          field.dataset.validationRequired || ''
        );
      } else if (
        field.validity.typeMismatch
        && field.dataset.validationEmail
      ) {
        field.setCustomValidity(
          field.dataset.validationEmail
        );
      }
    });

    field.addEventListener('input', () => {
      field.setCustomValidity('');
    });
  });
})();
</script>

</body>
</html>
