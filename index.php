<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>potrzebuje.pl – szkolenia AI/LLM, praktyczne wdrożenia</title>

  <meta name="description" content="Praktyczne szkolenia AI/LLM dla firm i osób. Pokazujemy jak używać AI w codziennych zadaniach – od analizy potrzeb, przez workflow, po wdrożenia." />

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
      padding: 10px 0 8px 0;
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
        padding: 8px 10px;
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


  </style>
  
  <!-- WSPÓLNY CSS MENU MOBILNEGO DLA WSZYSTKICH JĘZYKÓW -->
  <link rel="stylesheet" href="/nav-mobile.css">
</head>

<body>

  <!-- Sticky NAV -->
  <!-- Sticky NAV -->
  <?php
    // Wersja polska
    $lang = 'pl';
    require __DIR__ . '/nav.php';
  ?>





  <div id="top" class="page">

    <!-- HERO -->
    <div class="hero">
      <div>
        <h1>AI jest wszędzie. Ale większość ludzi nie wie, jak użyć jej sensownie w pracy.</h1>
        <p>
          Prowadzimy <strong>praktyczne szkolenia AI/LLM</strong> i pomagamy wdrażać narzędzia,
          które realnie usprawniają codzienne zadania. Bez lania wody, bez “pokazu slajdów”.
        </p>

        <div class="hero-actions">
          <a class="btn btn-primary" href="/contact.php?lang=pl">Umów rozmowę / zapytanie</a>
          <a class="btn btn-secondary" href="#demo">Zobacz mini-demo</a>
        </div>

        <div class="note" style="margin-top:10px;">
          Jeśli nie wiesz, od czego zacząć – opisz sytuację, a my ją uporządkujemy i zaproponujemy sensowny kierunek.
        </div>
      </div>

      <div class="hero-card">
        <img src="/Images/logo.svg" alt="potrzebuje.pl logo" class="logo" />
        <ul class="hero-bullets">
          <li><strong>Pod klienta:</strong> dopasowanie do roli, branży i poziomu zespołu</li>
          <li><strong>Praktyka:</strong> workflow, prompt engineering, automatyzacje</li>
          <li><strong>Bezpiecznie:</strong> ograniczenia, ryzyka, polityki, dobre praktyki</li>
        </ul>
      </div>
    </div>

    <!-- OFERTA -->
    <div id="oferta" class="section">
      <div class="section-title">Oferta – praktyczne szkolenia i wdrożenia</div>
      <div class="section-sub">
        Skupiamy się na tym, co przynosi efekt: procesy, narzędzia i mierzalne usprawnienia.
        Poniżej najczęstsze formaty współpracy.
      </div>

      <div class="grid">
        <div class="card">
          <h3>1) Szkolenie “AI w codziennej pracy”</h3>
          <p>Od podstaw po praktykę: jak używać LLM do analizy, pisania, streszczania, planowania i automatyzacji zadań.</p>
          <div class="chip-row">
            <span class="chip">2–6h</span><span class="chip">online / onsite</span><span class="chip">hands-on</span>
          </div>
        </div>

        <div class="card">
          <h3>2) Prompt engineering jako proces</h3>
          <p>Uczymy projektowania promptów, weryfikacji wyników i budowy powtarzalnych szablonów pod Wasze use-case’y.</p>
          <div class="chip-row">
            <span class="chip">warsztat</span><span class="chip">szablony</span><span class="chip">checklisty</span>
          </div>
        </div>

        <div class="card">
          <h3>3) Mini-wdrożenia (workflow + automatyzacje)</h3>
          <p>Mapujemy proces, wybieramy 2–3 miejsca do usprawnienia i wdrażamy rozwiązanie (bez “wielkiego projektu”).</p>
          <div class="chip-row">
            <span class="chip">2–4 tyg.</span><span class="chip">MVP</span><span class="chip">szybki efekt</span>
          </div>
        </div>
      </div>
    </div>

    <!-- MINI DEMO -->
    <div id="demo" class="section">
      <div class="section-title">Mini-demo: jak AI/LLM porządkuje problem</div>
      <div class="section-sub">
        Wpisz krótko swój problem (2–6 zdań). Pokażemy przykładowy styl analizy i dopytań.
        To demo działa na żywo przez LLM (o4-mini) z limitami: 20 słów w pytaniu, do 100 słów w odpowiedzi, 100 zapytań dziennie.
      </div>

      <div class="demo">
        <div>
          <textarea id="demoInput" placeholder="Np. Zespół chce używać AI, ale każdy robi to inaczej. Nie wiemy od czego zacząć, jakie procesy wybrać i jak mierzyć efekt."></textarea>

          <div class="hero-actions" style="margin-top:12px;">
            <button class="btn btn-primary" type="button" id="demoBtn">Pokaż przykład analizy AI</button>
            <button class="btn btn-secondary" type="button" id="demoExampleBtn">Wstaw przykład</button>
          </div>

          <div class="note">
            W docelowej wersji (nowe Potrzebuje.pl) to będzie działało automatycznie przez LLM oraz zapis wyników.
          </div>
        </div>

        <div class="demo-panel">
          <div class="demo-panel-head">
            <strong>Wynik (przykład)</strong>
            <span class="chip" id="demoBadge">gotowe</span>
          <span id="demoLimits" style="font-size:6px;color:var(--muted2);line-height:1; text-align:right; white-space:nowrap;"></span></div>
          <div class="demo-output" id="demoOutput">
Wpisz problem po lewej i kliknij „Pokaż przykład analizy AI”.
</div>
        </div>
      </div>
    </div>

    <!-- O NAS -->
    <div id="o-nas" class="section">
      <div class="section-title">O nas – jak naprawdę pracujemy z AI/LLM</div>
      <div class="section-sub">
        Nie uczymy “jak rozmawiać z ChatGPT”. Uczymy jak budować powtarzalne rozwiązania i bezpieczne workflow.
      </div>

      <div class="grid">
        <div class="card">
          <h3>Co robimy</h3>
          <p>
            Projektujemy szkolenia “pod rolę”: inne dla managerów, inne dla specjalistów, inne dla zespołów IT.
            Bazujemy na praktycznych zadaniach z Waszego kontekstu.
          </p>
        </div>

        <div class="card">
          <h3>Co pokazujemy (konkretnie)</h3>
          <p>
            Różnice: model vs narzędzie, prompt jako proces, weryfikacja jakości, ograniczenia (halucynacje, bias),
            koszty i dobre praktyki bezpieczeństwa.
          </p>
        </div>

        <div class="card">
          <h3>Co dostajesz po szkoleniu</h3>
          <p>
            Checklisty, szablony promptów, przykładowe workflow i plan wdrożenia 2–3 usprawnień “na jutro”.
          </p>
        </div>
      </div>
    </div>

    <!-- CTA końcowe -->
    <div class="section">
      <div class="section-title">Chcesz szkolenie “tak, żeby się nauczyć”?</div>
      <div class="section-sub">
        Napisz krótko: kto jest odbiorcą, jaki problem chcesz rozwiązać i jaki masz czas/budżet.
        Odpowiemy z propozycją formatu (online/onsite) i planem.
      </div>
      <div class="hero-actions">
        <a class="btn btn-primary" href="/contact.php?lang=pl">Przejdź do kontaktu</a>
        <a class="btn btn-secondary" href="#demo">Najpierw zobacz demo</a>
      </div>
    </div>

    <div class="footer">
      <div>© potrzebuje.pl</div>
      <div>AI/LLM – szkolenia i praktyczne wdrożenia</div>
    </div>

  </div>

  <script>
    // Mini-demo – LIVE przez API (o4-mini) z limitami:
    // - max 20 słów pytania
    // - max ~200 słów odpowiedzi (serwer dodatkowo ucina)
    // - max 100 zapytań dziennie (po stronie przeglądarki + serwera)
    document.addEventListener("DOMContentLoaded", function () {
      var LANG = "pl";
      var I18N = {
        pl:{ready:"gotowe",work:"analiza",err:"błąd",limit:"limit",
            empty:"Wpisz krótkie pytanie (max 20 słów).",
            words:"Limit przekroczony: maksymalnie 20 słów w pytaniu.",
            daily:"Limit dzienny demo został przekroczony. Spróbuj jutro lub użyj KONTAKT.",
            conn:"Błąd połączenia. Sprawdź internet lub serwer.",
            server:"Błąd serwera."},
        en:{ready:"ready",work:"thinking",err:"error",limit:"limit",
            empty:"Please type a short question (max 20 words).",
            words:"Limit exceeded: max 20 words per question.",
            daily:"Daily demo limit reached. Try tomorrow or use CONTACT.",
            conn:"Connection error. Check internet or server.",
            server:"Server error."},
        de:{ready:"bereit",work:"analyse",err:"fehler",limit:"limit",
            empty:"Bitte gib eine kurze Frage ein (max. 20 Wörter).",
            words:"Limit überschritten: max. 20 Wörter pro Frage.",
            daily:"Tageslimit erreicht. Versuche es morgen oder nutze KONTAKT.",
            conn:"Verbindungsfehler. Prüfe Internet oder Server.",
            server:"Serverfehler."}
      };
      var T = I18N[LANG] || I18N.pl;
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

      var exampleText = "Zespół chce używać AI, ale każdy robi to inaczej. Nie wiemy od czego zacząć.";

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
        var inLeft = Math.max(0, MAX_INPUT_WORDS - w);
        var used = getDailyUsed();
        var callsLeft = Math.max(0, MAX_DAILY_CALLS - used);

        var outLeft = MAX_OUTPUT_WORDS;
        if (typeof outputText === "string" && outputText.trim()){
          outLeft = Math.max(0, MAX_OUTPUT_WORDS - countWords(outputText));
        }

        limitsEl.textContent =
          "pytanie: " + inLeft + "/" + MAX_INPUT_WORDS + " słów  |  odp.: " +
          outLeft + "/" + MAX_OUTPUT_WORDS + " słów  |  dziennie: " +
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
        raw = trimToWords(raw, MAX_INPUT_WORDS).trim(); // twarde przycięcie tylko przy wysyłce
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
        out.textContent = "Analizuję...";
        updateLimitsDisplay(out.textContent);

        try {
          const res = await fetch("/demo_api.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ question: raw, lang: "pl" })
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
          out.textContent = (data && data.answer) ? data.answer : (LANG==="de" ? "Keine Antwort." : (LANG==="en" ? "No answer." : "Brak odpowiedzi."));
          updateLimitsDisplay(out.textContent);
        } catch (e) {
          badge.textContent = T.err;
          out.textContent = T.conn;
          updateLimitsDisplay(out.textContent);
        }
      });
    });
  </script>

</body>
</html>
