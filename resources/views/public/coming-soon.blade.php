<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Çok Yakında — Sertaç Apanay</title>
  <meta name="description" content="Sertaç Apanay'ın yeni sitesi çok yakında yayında.">
  <meta name="robots" content="noindex, nofollow">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Public+Sans:wght@300;400&display=swap" rel="stylesheet">
  <style>
    :root {
      --ink:   #1a1a18;
      --bone:  #f5f2eb;
      --coral: #c0574a;
      --gold:  #b8972a;
      --muted: #6b6b60;
      --line:  #dedad2;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      height: 100%;
      font-family: 'Public Sans', sans-serif;
      background: var(--bone);
      color: var(--ink);
    }

    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 40px 24px;
      text-align: center;
    }

    /* Decorative compass / radial mark */
    .mark {
      width: 64px;
      height: 64px;
      margin-bottom: 36px;
      opacity: .55;
    }

    .eyebrow {
      font-family: 'Public Sans', sans-serif;
      font-size: 11px;
      font-weight: 400;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 20px;
    }

    h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(36px, 7vw, 68px);
      font-weight: 300;
      line-height: 1.1;
      letter-spacing: -.5px;
      margin-bottom: 10px;
    }

    h1 em {
      font-style: italic;
      color: var(--coral);
    }

    .sub {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(18px, 3vw, 26px);
      font-weight: 300;
      font-style: italic;
      color: var(--muted);
      margin-bottom: 40px;
    }

    .divider {
      width: 48px;
      height: 1px;
      background: var(--gold);
      margin: 0 auto 36px;
      opacity: .5;
    }

    .desc {
      font-size: 15px;
      line-height: 1.8;
      color: var(--muted);
      max-width: 420px;
      margin-bottom: 48px;
    }

    .lang-toggle {
      display: flex;
      gap: 0;
      border: 1px solid var(--line);
      border-radius: 2px;
      overflow: hidden;
      margin-bottom: 56px;
    }

    .lang-toggle button {
      background: none;
      border: none;
      padding: 8px 20px;
      font-family: 'Public Sans', sans-serif;
      font-size: 12px;
      letter-spacing: .1em;
      text-transform: uppercase;
      cursor: pointer;
      color: var(--muted);
      transition: background .18s, color .18s;
    }

    .lang-toggle button.active,
    .lang-toggle button:hover {
      background: var(--ink);
      color: var(--bone);
    }

    .contact-note {
      font-size: 13px;
      color: var(--muted);
    }

    .contact-note a {
      color: var(--coral);
      text-decoration: none;
      border-bottom: 1px solid transparent;
      transition: border-color .18s;
    }

    .contact-note a:hover { border-color: var(--coral); }

    /* Language switching */
    [data-en] { display: none; }
    body.en [data-tr] { display: none; }
    body.en [data-en] { display: inline; }
    body.en [data-en].block-display { display: block; }
  </style>
</head>
<body>

  <svg class="mark" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
    <circle cx="32" cy="32" r="30" stroke="#b8972a" stroke-width="1"/>
    <circle cx="32" cy="32" r="2.5" fill="#b8972a"/>
    <line x1="32" y1="4"  x2="32" y2="14" stroke="#b8972a" stroke-width="1"/>
    <line x1="32" y1="50" x2="32" y2="60" stroke="#b8972a" stroke-width="1"/>
    <line x1="4"  y1="32" x2="14" y2="32" stroke="#b8972a" stroke-width="1"/>
    <line x1="50" y1="32" x2="60" y2="32" stroke="#b8972a" stroke-width="1"/>
    <polygon points="32,8 30,20 32,18 34,20" fill="#c0574a" opacity=".8"/>
    <polygon points="32,56 30,44 32,46 34,44" fill="#b8972a" opacity=".5"/>
  </svg>

  <p class="eyebrow">Sertaç Apanay</p>

  <h1>
    <span data-tr>Çok <em>Yakında</em></span>
    <span data-en>Coming <em>Soon</em></span>
  </h1>

  <p class="sub">
    <span data-tr>Yeni site hazırlanıyor…</span>
    <span data-en>A new journey is being prepared…</span>
  </p>

  <div class="divider"></div>

  <p class="desc">
    <span data-tr>Rehberlik, seyahat ve dünyanın dört bir yanından getirdiğim hikâyeleri yakında burada paylaşıyor olacağım.</span>
    <span data-en>Stories, guides and travels from every corner of the world — coming here soon.</span>
  </p>

  <div class="lang-toggle">
    <button id="btn-tr" class="active" onclick="setLang('tr')">TR</button>
    <button id="btn-en" onclick="setLang('en')">EN</button>
  </div>

  <p class="contact-note">
    <span data-tr>İletişim için: </span>
    <span data-en>Contact: </span>
    {!! obfuscateEmail('merhaba@sertacapanay.net') !!}
  </p>

  <script>
    function setLang(l) {
      document.body.classList.toggle('en', l === 'en');
      document.getElementById('btn-tr').classList.toggle('active', l === 'tr');
      document.getElementById('btn-en').classList.toggle('active', l === 'en');
      localStorage.setItem('sa_lang', l);
    }
    // Restore saved language
    const saved = localStorage.getItem('sa_lang');
    if (saved === 'en') setLang('en');

    (function() {
      function decode(hex) {
        var key = parseInt(hex.substr(0, 2), 16), out = '';
        for (var i = 2; i < hex.length; i += 2) {
          out += String.fromCharCode(parseInt(hex.substr(i, 2), 16) ^ key);
        }
        return out;
      }
      document.querySelectorAll('.cf-email').forEach(function(el) {
        var email = decode(el.getAttribute('data-cfe'));
        var label = el.getAttribute('data-cfl') ? decode(el.getAttribute('data-cfl')) : email;
        el.setAttribute('href', 'mailto:' + email);
        el.textContent = label;
      });
    })();
  </script>
</body>
</html>
