<?php
// contact.php — multilingual contact form (PL/EN/DE)
require_once __DIR__ . '/config.php';

$lang = pp_lang_from_request('pl');

$T = [
  'pl' => [
    'back' => 'Powrót na stronę główną',
    'title' => 'Kontakt',
    'lead' => 'Wypełnij formularz, aby wysłać zapytanie lub komentarz. Pola oznaczone * są obowiązkowe.',
    'email' => 'Email Nadawcy',
    'subject' => 'Temat',
    'message' => 'Treść Zapytania/Komentarza',
    'send' => 'Wyślij',
    'ok' => 'Dziękujemy! Wiadomość została wysłana.',
    'err_required' => 'Wszystkie pola oznaczone jako obowiązkowe muszą być wypełnione.',
    'err_email' => 'Adres e-mail nadawcy jest nieprawidłowy.',
    'err_send' => 'Błąd wysyłki wiadomości. Spróbuj ponownie później.',
    // NOWE: WhatsApp
    'whatsapp_intro' => 'Możesz też napisać do nas na WhatsApp:',
    'whatsapp_label' => 'Napisz na WhatsApp',
  ],
  'en' => [
    'back' => 'Back to homepage',
    'title' => 'Contact',
    'lead' => 'Fill in the form to send a question or comment. Fields marked with * are required.',
    'email' => 'Sender Email',
    'subject' => 'Subject',
    'message' => 'Message',
    'send' => 'Send',
    'ok' => 'Thank you! Your message has been sent.',
    'err_required' => 'Please fill in all required fields.',
    'err_email' => 'Sender email address is invalid.',
    'err_send' => 'Message could not be sent. Please try again later.',
    // NEW: WhatsApp
    'whatsapp_intro' => 'You can also contact us via WhatsApp:',
    'whatsapp_label' => 'Message us on WhatsApp',
  ],
  'de' => [
    'back' => 'Zurück zur Startseite',
    'title' => 'Kontakt',
    'lead' => 'Fülle das Formular aus, um eine Anfrage oder einen Kommentar zu senden. Felder mit * sind Pflichtfelder.',
    'email' => 'E-Mail Absender',
    'subject' => 'Betreff',
    'message' => 'Nachricht',
    'send' => 'Senden',
    'ok' => 'Danke! Die Nachricht wurde gesendet.',
    'err_required' => 'Bitte alle Pflichtfelder ausfüllen.',
    'err_email' => 'Die E-Mail-Adresse ist ungültig.',
    'err_send' => 'Senden fehlgeschlagen. Bitte später erneut versuchen.',
    // NEU: WhatsApp
    'whatsapp_intro' => 'Du kannst uns auch per WhatsApp erreichen:',
    'whatsapp_label' => 'Schreib uns auf WhatsApp',
  ],
];

$tr = $T[$lang] ?? $T['pl'];

$to = "potrzebuje.pl@gmail.com"; // destination inbox

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

    $headers = "From: " . $senderEmail . "\r\n"
             . "Reply-To: " . $senderEmail . "\r\n"
             . "Content-Type: text/plain; charset=UTF-8\r\n";

    $sent = @mail($to, $emailSubject, $emailBody, $headers);

    if ($sent) $successMessage = $tr['ok'];
    else $errorMessage = $tr['err_send'];
  }
}

function h($s){ return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8"); }

// homepage target per language
$home = ($lang === 'de') ? '/de/' : (($lang === 'en') ? '/en/' : '/');

// KONFIGURACJA WHATSAPP – PODMIEŃ NA SWÓJ NUMER
$whatsNumber  = '48601201900';        // numer do URL, np. 48501234567 (BEZ spacji)
$whatsDisplay = '+48 601 201 900';    // jak ma się wyświetlać użytkownikowi

$whatsText = [
  'pl' => 'Dzień dobry, piszę z potrzebuje.pl',
  'en' => 'Hello, I am writing from potrzebuje.pl',
  'de' => 'Guten Tag, ich schreibe von potrzebuje.pl',
];
$whatsTextCurrent = $whatsText[$lang] ?? $whatsText['pl'];

?><!DOCTYPE html>
<html lang="<?=h($lang)?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>potrzebuje.pl — <?=h($tr['title'])?></title>
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
    <a href="<?=h($home)?>">← <?=h($tr['back'])?></a>

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
        <input type="email" name="sender_email" required value="<?=h($_POST["sender_email"] ?? "")?>"/>

        <label><?=h($tr['subject'])?> *</label>
        <input type="text" name="subject" required value="<?=h($_POST["subject"] ?? "")?>"/>

        <label><?=h($tr['message'])?> *</label>
        <textarea name="message" required><?=h($_POST["message"] ?? "")?></textarea>

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
</body>
</html>
