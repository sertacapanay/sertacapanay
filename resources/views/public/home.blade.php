@extends('public.layout')

@section('title', $isEn ? 'Sertaç Apanay | Tour Guide & Travel Companion' : 'Sertaç Apanay | Tur Rehberi & Seyahat Arkadaşı')
@section('description', $isEn
  ? 'Group tour guide, destination lecturer and travel companion. Six continents of shared journeys.'
  : 'Grup tur rehberi, destinasyon anlatıcısı ve seyahat arkadaşı. Altı kıtada paylaşılan yolculuklar.')

@push('jsonld')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebSite",
  "name": "Sertaç Apanay",
  "url": "{{ rtrim(config('app.url'),'/') }}",
  "description": {{ Js::from($isEn ? 'Group tour guide, destination lecturer and travel companion. Six continents of shared journeys.' : 'Grup tur rehberi, destinasyon anlatıcısı ve seyahat arkadaşı. Altı kıtada paylaşılan yolculuklar.') }},
  "inLanguage": ["tr", "en"],
  "potentialAction": {
    "@@type": "SearchAction",
    "target": {
      "@@type": "EntryPoint",
      "urlTemplate": "{{ rtrim(config('app.url'),'/') }}/{{ $locale }}/blog?q={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@@type": "ListItem",
      "position": 1,
      "name": {{ Js::from($isEn ? 'Home' : 'Ana Sayfa') }},
      "item": "{{ rtrim(config('app.url'),'/') }}/{{ $locale }}"
    }
  ]
}
</script>
@endpush

@push('styles')
<style>
  /* ── Hero ── */
  .hero{position:relative;min-height:100vh;display:flex;align-items:center;color:var(--bone);overflow:hidden}
  .hero-bg-img{position:absolute;inset:0;z-index:-1;object-fit:cover;width:100%;height:100%}
  .hero::before{content:"";position:absolute;inset:0;z-index:0;
    background:linear-gradient(90deg,rgba(8,10,14,.65) 0%,rgba(8,10,14,.28) 50%,rgba(8,10,14,.05) 100%),
               linear-gradient(180deg,rgba(8,10,14,.45) 0%,rgba(8,10,14,0) 20%,rgba(8,10,14,0) 70%,rgba(8,10,14,.5) 100%)}
  .hero .wrap{position:relative;z-index:2;padding:120px 44px 80px;width:100%;max-width:100%;margin:0}
  .roleline{font-family:var(--mono);font-size:11.5px;letter-spacing:.22em;text-transform:uppercase;
    color:rgba(243,239,230,.72);margin-bottom:22px}
  .hero h1{font-family:var(--display);font-size:clamp(72px,12vw,140px);font-weight:500;font-style:italic;
    line-height:.92;letter-spacing:-.01em;margin:0 0 28px}
  .hero .sub{font-size:clamp(15px,1.6vw,18px);max-width:520px;color:rgba(243,239,230,.85);line-height:1.65;margin-bottom:0}
  .hero-cta{display:flex;gap:16px;flex-wrap:wrap;margin-top:36px}
  .scrollcue{position:absolute;bottom:30px;left:50%;transform:translateX(-50%);z-index:2;
    color:rgba(243,239,230,.55);transition:color .25s}
  .scrollcue:hover{color:rgba(243,239,230,.9)}

  /* ── Stats ── */
  .stats{background:var(--paper);border-bottom:1px solid var(--line)}
  .stats .grid{display:grid;grid-template-columns:repeat(4,1fr)}
  .stat{padding:56px 24px;text-align:center;border-right:1px solid var(--line)}
  .stat:last-child{border-right:0}
  .stat .num{font-family:var(--display);font-size:clamp(48px,7vw,80px);font-weight:500;line-height:1;
    font-feature-settings:"onum" 1}
  .stat .lbl{font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;
    color:var(--muted);margin-top:14px;line-height:1.9}

  /* ── About ── */
  .sec{padding:104px 0}
  .sec-head{display:flex;justify-content:space-between;align-items:flex-end;gap:24px;margin-bottom:46px}
  .sec-head .eyebrow{color:var(--muted);display:block;margin-bottom:14px}
  .sec-head h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(40px,6vw,76px);line-height:.98}
  .sec-head .lead{color:var(--muted);font-size:16px;max-width:420px;margin-top:14px}
  .about-intro{display:grid;grid-template-columns:1.05fr .95fr;gap:50px;align-items:center}
  .about-intro .txt p{margin:0 0 16px;color:var(--muted);font-size:16px;line-height:1.78}
  .about-intro .intro-lead{color:var(--ink);font-size:17px}
  .about-img{position:relative;aspect-ratio:4/5;border-radius:4px;overflow:hidden;background:var(--bone-2)}
  .about-img img{width:100%;height:100%;object-fit:cover;display:block}
  .roles3{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-top:54px}
  .role3{border:1px solid var(--line);border-radius:4px;padding:26px;background:var(--paper)}
  .role3 h3{font-family:var(--display);font-style:italic;font-size:23px;margin:0 0 6px;color:var(--ink)}
  .role3 p{margin:0;font-size:13.5px;color:var(--muted);line-height:1.5}
  .tsec{margin-top:66px}
  .tgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:30px;margin-top:18px}
  .tcard{border-top:1px solid var(--ink);padding-top:22px}
  .tcard .q{font-family:var(--display);font-style:italic;font-size:18px;line-height:1.5;color:var(--ink);margin:0 0 18px}
  .tcard .who{font-family:var(--mono);font-size:12px;letter-spacing:.04em;color:var(--ink)}
  .tcard .trip{font-family:var(--mono);font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-top:5px}

  /* ── Destinations masonry ── */
  .masonry{column-count:2;column-gap:18px}
  .card{position:relative;overflow:hidden;display:flex;align-items:flex-end;padding:28px;color:#fff;
    break-inside:avoid;margin-bottom:18px;width:100%;text-decoration:none}
  .card.r34{aspect-ratio:3/4}
  .card.r43{aspect-ratio:4/3}
  .card::after{content:"";position:absolute;inset:0;
    background:linear-gradient(180deg,rgba(0,0,0,0) 38%,rgba(10,10,8,.82) 100%);z-index:1}
  .card .bg{position:absolute;inset:0;background:var(--ink)}
  .card .bg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .9s ease}
  .card:hover .bg img{transform:scale(1.06)}
  .card .meta{position:relative;z-index:2}
  .card .tag{font-family:var(--mono);font-size:11px;letter-spacing:.2em;text-transform:uppercase;
    color:rgba(243,239,230,.72);display:block;margin-bottom:8px}
  .card .name{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(30px,3.5vw,44px);line-height:1;margin-bottom:8px}
  .card .desc{font-size:14.5px;color:#e8e0d2;max-width:340px;line-height:1.45}

  /* ── Notes / Field Guides ── */
  .notes{background:var(--bone-2)}
  .notes-grid{display:grid;grid-template-columns:1fr 1fr;gap:46px}
  .note{display:block;color:inherit;text-decoration:none}
  .note .nimg{position:relative;aspect-ratio:16/11;overflow:hidden;background:var(--bone-2);margin-bottom:22px;border-radius:3px}
  .note .nimg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .6s}
  .note:hover .nimg img{transform:scale(1.04)}
  .note .loc{font-family:var(--mono);font-size:11.5px;letter-spacing:.15em;text-transform:uppercase;
    color:var(--coral);display:flex;align-items:center;gap:8px;margin-bottom:12px}
  .note h3{font-family:var(--display);font-style:italic;font-weight:500;font-size:30px;line-height:1.08;
    margin-bottom:10px;transition:color .25s}
  .note:hover h3{color:var(--coral)}
  .note.alt h3{color:var(--coral)}
  .note p{font-size:15.5px;color:var(--muted);line-height:1.65;margin:0}

  /* ── Bazaar / Shop ── */
  .bazaar-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px}
  .prod{cursor:pointer;display:block;color:inherit;text-decoration:none}
  .prod .pimg{position:relative;aspect-ratio:3/4;overflow:hidden;margin-bottom:18px;background:var(--bone-2);border-radius:3px}
  .prod .pimg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
  .prod:hover .pimg img{transform:scale(1.04)}
  .prod .src{font-family:var(--mono);font-size:10.5px;letter-spacing:.16em;text-transform:uppercase;
    color:var(--coral);display:block;margin-bottom:8px}
  .prod .pname{font-family:var(--display);font-style:italic;font-weight:600;font-size:22px;line-height:1.1;
    margin-bottom:5px;transition:color .25s}
  .prod:hover .pname{color:var(--coral)}
  .prod .price{font-family:var(--mono);font-size:13px;color:var(--muted)}

  /* ── Comm / Newsletter ── */
  .comm{text-align:center}
  .comm .eyebrow{color:var(--muted)}
  .comm h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(42px,6vw,74px);
    line-height:1;margin:16px 0 22px}
  .comm .lead{max-width:560px;margin:0 auto 44px;color:var(--muted);font-size:17px;line-height:1.7}
  .comm .socials{display:flex;gap:18px;justify-content:center;margin-bottom:56px}
  .comm .socials a{display:flex;flex-direction:column;align-items:center;gap:12px;font-family:var(--mono);
    font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:var(--muted);text-decoration:none}
  .comm .socials .box{width:66px;height:66px;border:1px solid var(--line);display:flex;align-items:center;
    justify-content:center;transition:all .25s}
  .comm .socials a:hover .box{border-color:var(--coral);background:var(--coral)}
  .comm .socials a:hover .box svg{stroke:#fff}
  .comm .socials svg{width:24px;height:24px;stroke:var(--ink);transition:stroke .25s}
  .news{max-width:620px;margin:0 auto;border:1px solid var(--line);padding:46px 40px;background:var(--paper)}
  .news h3{font-family:var(--display);font-style:italic;font-weight:500;font-size:28px;margin-bottom:10px}
  .news p{color:var(--muted);font-size:15px;margin-bottom:26px;line-height:1.6}
  .news .row{display:flex;gap:0}
  .news input{flex:1;border:1px solid var(--line);background:var(--bone-2);padding:16px 18px;
    font-family:var(--ui);font-size:15px;color:var(--ink)}
  .news input:focus{outline:none;border-color:var(--coral)}
  .news button{background:var(--ink);color:var(--bone);border:0;padding:0 28px;font-family:var(--mono);
    font-size:12px;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;transition:background .2s}
  .news button:hover{background:var(--coral)}

  @media(max-width:1024px){
    .stats .grid{grid-template-columns:1fr 1fr}
    .stat:nth-child(2){border-right:0}
    .stat{border-bottom:1px solid var(--line)}
    .notes-grid{grid-template-columns:1fr;gap:38px}
    .bazaar-grid{grid-template-columns:repeat(2,1fr);gap:28px}
    .about-intro{grid-template-columns:1fr;gap:30px}
    .roles3,.tgrid{grid-template-columns:1fr}
  }
  @media(max-width:640px){
    .hero .wrap{padding:100px 22px 70px}
    .stats .grid{grid-template-columns:1fr}
    .stat{border-right:0}
    .masonry{column-count:1}
    .bazaar-grid{grid-template-columns:1fr 1fr;gap:16px}
    .news{padding:32px 22px}
    .news .row{flex-direction:column;gap:12px}
    .news button{padding:15px}
  }
</style>
@endpush

@section('content')

{{-- ════════════════════════════════════════
     HERO
════════════════════════════════════════ --}}
<section class="hero" id="top">
  <img class="hero-bg-img" src="{{ isset($heroImage) ? $heroImage : asset('images/hero.jpg') }}" alt="hero" loading="eager">

  <div class="scroll-explore">
    <span data-tr>Keşfetmek için kaydır</span><span data-en>Scroll to Explore</span>
  </div>

  <div class="wrap">
    <div class="roleline" data-tr>Grup Tur Rehberi &nbsp;·&nbsp; Destinasyon Anlatıcısı &nbsp;·&nbsp; Seyahat Arkadaşı</div>
    <div class="roleline b" data-en>Group Tour Guide &nbsp;·&nbsp; Destination Lecturer &nbsp;·&nbsp; Travel Companion</div>

    <h1>Sertaç<br>Apanay</h1>

    <p class="sub" data-tr>İnsanları sadece bir yere götürmem — onlarla yürür, hikâyeler paylaşır, yolculuklarının parçası olurum. Altı kıtada grup seyahati, her seferinde bir anı.</p>
    <p class="sub b" data-en>I don't just take people to places — I walk with them, share stories, and become part of their journey. Six continents of group travel, one memory at a time.</p>

    <div class="hero-cta">
      <a href="#dest" class="btn btn-coral">
        <span data-tr>Gittiğimiz Yerler</span><span data-en>Our Destinations</span>
      </a>
      <a href="#about" class="btn btn-link">
        <span data-tr>Ben Kimim</span><span data-en>Who I Am</span>
      </a>
    </div>
  </div>

  <a href="#stats" class="scrollcue" aria-label="Aşağı kaydır">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="6 9 12 15 18 9"></polyline>
    </svg>
  </a>
</section>

{{-- ── Hero altı widget'lar ── --}}
@php $heroWidgets = \App\Models\Widget::forPosition('home_hero', 'home'); @endphp
@if($heroWidgets->isNotEmpty())
<section style="padding:40px 0;border-bottom:1px solid var(--line)">
  <div class="wrap" style="display:flex;gap:40px;flex-wrap:wrap">
    @foreach($heroWidgets as $widget)
      <div style="flex:1;min-width:220px"><x-widget :widget="$widget" /></div>
    @endforeach
  </div>
</section>
@endif

{{-- ════════════════════════════════════════
     STATS
════════════════════════════════════════ --}}
<section class="stats" id="stats">
  <div class="wrap">
    <div class="grid">
      <div class="stat">
        <div class="num">6</div>
        <div class="lbl">
          <span data-tr>Birlikte gezilen<br>ülke</span>
          <span data-en>Countries explored<br>together</span>
        </div>
      </div>
      <div class="stat">
        <div class="num">16</div>
        <div class="lbl">
          <span data-tr>Grupla görülen<br>şehir</span>
          <span data-en>Cities visited<br>with groups</span>
        </div>
      </div>
      <div class="stat">
        <div class="num">10</div>
        <div class="lbl">
          <span data-tr>Uçulan grup<br>yolculuğu</span>
          <span data-en>Group journeys<br>flown</span>
        </div>
      </div>
      <div class="stat">
        <div class="num">6</div>
        <div class="lbl">
          <span data-tr>Gezilen<br>kıta</span>
          <span data-en>Continents<br>covered</span>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ════════════════════════════════════════
     HAKKIMDA / ABOUT
════════════════════════════════════════ --}}
<section class="sec" id="about">
  <div class="wrap">
    <div class="about-intro">
      <div class="txt">
        <span class="eyebrow"><span data-tr>Hakkımda</span><span data-en>About</span></span>
        <h2 style="font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(32px,4.5vw,54px);line-height:1.05;margin:14px 0 26px">
          <span data-tr>Seninle Yolculuk<br>Eden Kişi</span>
          <span data-en>The Person Who<br>Travels With You</span>
        </h2>

        <p class="intro-lead" data-tr>Ben bir grup tur rehberi, destinasyon anlatıcısı ve seyahat arkadaşıyım — en güzel yolculukların yalnız çıkılmadığına inanan biri. Amacım insanları bir araya getirmek, onlara dünyayı gezdirmek ve hikâyelerinin bir parçası olmak.</p>
        <p class="intro-lead b" data-en>I am a group tour guide, destination lecturer, and travel companion — someone who believes the greatest journeys aren't taken alone. My mission is to bring people together, lead them through the world, and become part of their story.</p>

        <p data-tr>Yıllar içinde altı kıtada gruplara rehberlik ettim — elinde bayrak ve mikrofon tutan bir yabancı olarak değil, gerçek bir yol arkadaşı olarak. Gittiğimiz her yerde derin bağlar, paylaşılan keşifler ve ortak anılar yaşadık.</p>
        <p class="b" data-en>Over the years, I've guided groups across six continents — not as a stranger with a flag and a microphone, but as a genuine travel companion. In every destination, we've forged deep connections, shared discoveries, and created memories together.</p>

        <p data-tr>Destinasyon anlatıcısı olarak gezdiğimiz her köşeye tarih, kültür ve bağlam katarım. Bir tapınak, bir pazar yeri ya da gün batımını izlediğimiz bir tepe — her yer bir hikâye taşır ve o hikâyeleri birlikte keşfetmek en büyük zevkim.</p>
        <p class="b" data-en>As a destination lecturer, I bring history, culture, and context to every corner we visit. A temple, a marketplace, a hilltop at sunset — every place carries a story, and discovering those stories together is my greatest joy.</p>

        <div class="roles3">
          <div class="role3">
            <h3 data-tr>Grup Rehberi</h3>
            <h3 class="b" data-en>Group Guide</h3>
            <p data-tr>Yürekten ve var olarak rehberlik</p>
            <p class="b" data-en>Leading with heart &amp; presence</p>
          </div>
          <div class="role3">
            <h3 data-tr>Anlatıcı</h3>
            <h3 class="b" data-en>Lecturer</h3>
            <p data-tr>Derinlik, bağlam ve hikâye</p>
            <p class="b" data-en>Depth, context &amp; storytelling</p>
          </div>
          <div class="role3">
            <h3 data-tr>Yol Arkadaşı</h3>
            <h3 class="b" data-en>Companion</h3>
            <p data-tr>Her zaman gruptan biri</p>
            <p class="b" data-en>One of the group, always</p>
          </div>
        </div>
      </div>

      <div>
        <div style="display:flex;justify-content:flex-end;margin-bottom:14px">
          <a class="arrow" href="/{{ $locale }}/about">
            <span data-tr>hakkımda →</span><span data-en>about me →</span>
          </a>
        </div>
        <div class="about-img">
          <img src="{{ asset('images/about-sertac.jpg') }}" alt="Sertaç Apanay" loading="lazy">
        </div>
      </div>
    </div>

    {{-- Testimonials --}}
    <div class="tsec">
      <div class="sec-head" style="margin-bottom:28px">
        <div>
          <span class="eyebrow"><span data-tr>Müşteri Sözleri</span><span data-en>Client Voices</span></span>
          <h2><span data-tr>Gezginlerden Sözler</span><span data-en>Words from Travelers</span></h2>
        </div>
      </div>
      <div class="tgrid">
        <div class="tcard">
          <p class="q" data-tr>"Bir akademisyenin derinliği ve bir hikâye anlatıcısının yeteneğiyle olağanüstü bir rehber. Fas yolculuğumuz tam anlamıyla dönüştürücüydü…"</p>
          <p class="q b" data-en>"An extraordinary guide with an academic's depth and a storyteller's gift. Our Morocco journey was nothing short of transformational…"</p>
          <div class="who">Sophia Harrington</div>
          <div class="trip"><span data-tr>Özel Fas Turu · 2024</span><span data-en>Private Morocco Tour · 2024</span></div>
        </div>
        <div class="tcard">
          <p class="q" data-tr>"Japonya gezimiz için hazırlanan özel rota kusursuzdu. Her ayrıntıda özen ve derin bir kültür anlayışı hissediliyordu…"</p>
          <p class="q b" data-en>"The bespoke itinerary crafted for our Japan trip was flawless. Every detail reflected care and a deep understanding of culture…"</p>
          <div class="who">James &amp; Elaine Park</div>
          <div class="trip"><span data-tr>Japonya Seyahat Tasarımı · 2025</span><span data-en>Japan Travel Design · 2025</span></div>
        </div>
        <div class="tcard">
          <p class="q" data-tr>"Birçok anlatılı seyahate katıldım ama hiçbiri bu deneyimin entelektüel zenginliğine yaklaşamadı…"</p>
          <p class="q b" data-en>"I've joined several lecture voyages and none have come close to the intellectual richness of this experience…"</p>
          <div class="who">Dr. Margaret Osei</div>
          <div class="trip"><span data-tr>Akdeniz Anlatı Seferi · 2025</span><span data-en>Mediterranean Lecture Voyage · 2025</span></div>
        </div>
      </div>
    </div>

  </div>
</section>

{{-- ════════════════════════════════════════
     DESTİNASYONLAR / DESTINATIONS
════════════════════════════════════════ --}}
<section class="sec" id="dest" style="padding-top:0">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><span data-tr>Grup Rotaları</span><span data-en>Group Destinations</span></span>
        <h2><span data-tr>Birlikte gittiğimiz yerler</span><span data-en>Where We've Gone</span></h2>
      </div>
      <a class="arrow" href="/{{ $locale }}/places">
        <span data-tr>tümünü gör →</span><span data-en>View all →</span>
      </a>
    </div>
  </div>

  @if($places->count())
  <div class="wrap">
    <div class="masonry">
      @foreach($places as $i => $place)
        @php
          $pname = $isEn ? ($place->title_en ?? $place->title_tr) : $place->title_tr;
          $pcountry = $isEn ? ($place->country_en ?? $place->country_tr ?? '') : ($place->country_tr ?? '');
          $pdesc = $isEn ? ($place->description_en ?? $place->description_tr ?? '') : ($place->description_tr ?? '');
          $aspect = $i % 2 === 0 ? 'r43' : 'r34';
        @endphp
        <a href="/{{ $locale }}/places/{{ $place->slug }}" class="card {{ $aspect }}">
          <div class="bg">
            @if($place->image)
              <img src="{{ asset('storage/'.$place->image) }}" alt="{{ $pname }}" loading="lazy">
            @endif
          </div>
          <div class="meta">
            @if($pcountry)<span class="tag">{{ $pcountry }}</span>@endif
            <div class="name">{{ $pname }}</div>
            @if($pdesc)<div class="desc">{{ Str::limit(strip_tags($pdesc), 90) }}</div>@endif
          </div>
        </a>
      @endforeach
    </div>
  </div>
  @else
  {{-- Statik placeholder ─ veri girilene kadar gösterilir --}}
  <div class="wrap">
    <div class="masonry">
      <a href="/{{ $locale }}/places" class="card r43">
        <div class="bg"><img src="{{ asset('images/dest-japan.jpg') }}" alt="Japonya" loading="lazy"></div>
        <div class="meta">
          <span class="tag"><span data-tr>Asya · 6 ziyaret</span><span data-en>Asia · 6 visits</span></span>
          <div class="name"><span data-tr>Japonya</span><span data-en>Japan</span></div>
          <div class="desc"><span data-tr>Her ayrıntıda incelik, güzellik ve derinlik.</span><span data-en>Precision, beauty, and depth in every detail.</span></div>
        </div>
      </a>
      <a href="/{{ $locale }}/places" class="card r34">
        <div class="bg"><img src="{{ asset('images/dest-peru.jpg') }}" alt="Peru" loading="lazy"></div>
        <div class="meta">
          <span class="tag"><span data-tr>Güney Amerika · 2 ziyaret</span><span data-en>South America · 2 visits</span></span>
          <div class="name"><span data-tr>Peru</span><span data-en>Peru</span></div>
          <div class="desc"><span data-tr>And'lar zamandan eski sırlar saklar.</span><span data-en>The Andes hold secrets older than time.</span></div>
        </div>
      </a>
      <a href="/{{ $locale }}/places" class="card r43">
        <div class="bg"><img src="{{ asset('images/dest-jordan.jpg') }}" alt="Ürdün" loading="lazy"></div>
        <div class="meta">
          <span class="tag"><span data-tr>Asya · 3 ziyaret</span><span data-en>Asia · 3 visits</span></span>
          <div class="name"><span data-tr>Ürdün</span><span data-en>Jordan</span></div>
          <div class="desc"><span data-tr>Kumtaşı şehirlerin binyılları fısıldadığı yer.</span><span data-en>Where sandstone cities whisper millennia of history.</span></div>
        </div>
      </a>
      <a href="/{{ $locale }}/places" class="card r34">
        <div class="bg"><img src="{{ asset('images/dest-italy.jpg') }}" alt="İtalya" loading="lazy"></div>
        <div class="meta">
          <span class="tag"><span data-tr>Avrupa · 8 ziyaret</span><span data-en>Europe · 8 visits</span></span>
          <div class="name"><span data-tr>İtalya</span><span data-en>Italy</span></div>
          <div class="desc"><span data-tr>Her meydanda ve tabakta la dolce vita.</span><span data-en>La dolce vita in every piazza and plate.</span></div>
        </div>
      </a>
    </div>
  </div>
  @endif
</section>

{{-- ════════════════════════════════════════
     SAHA NOTLARI / FIELD NOTES (GUIDES)
════════════════════════════════════════ --}}
<section class="sec notes" id="notes">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><span data-tr>Grup Rehberleri</span><span data-en>Group Travel Guides</span></span>
        <h2><span data-tr>Paylaşılan saha notları</span><span data-en>Shared Field Notes</span></h2>
      </div>
      <a class="arrow" href="/{{ $locale }}/guides">
        <span data-tr>tüm rehberler →</span><span data-en>All guides →</span>
      </a>
    </div>

    @if($notes->count())
    <div class="notes-grid">
      @foreach($notes as $i => $note)
        @php
          $ntitle   = $isEn ? ($note->title_en ?? $note->title_tr) : $note->title_tr;
          $ncountry = $isEn ? ($note->country_en ?? $note->country_tr ?? '') : ($note->country_tr ?? '');
          $nexcerpt = $isEn ? ($note->description_en ?? $note->description_tr ?? '') : ($note->description_tr ?? '');
        @endphp
        <a href="/{{ $locale }}/guides/{{ $note->slug }}" class="note {{ $i % 2 !== 0 ? 'alt' : '' }}">
          <div class="nimg">
            @if($note->image)
              <img src="{{ asset('storage/'.$note->image) }}" alt="{{ $ntitle }}" loading="lazy">
            @endif
          </div>
          @if($ncountry)
          <div class="loc">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--coral)" stroke="none"><circle cx="12" cy="12" r="6"/></svg>
            {{ $ncountry }}
          </div>
          @endif
          <h3>{{ $ntitle }}</h3>
          @if($nexcerpt)<p>{{ Str::limit(strip_tags($nexcerpt), 120) }}</p>@endif
        </a>
      @endforeach
    </div>
    @else
    {{-- Statik placeholder --}}
    <div class="notes-grid">
      <a href="/{{ $locale }}/guides" class="note">
        <div class="nimg"><img src="{{ asset('images/marrakech.jpg') }}" alt="Marakeş" loading="lazy"></div>
        <div class="loc">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--coral)" stroke="none"><circle cx="12" cy="12" r="6"/></svg>
          <span data-tr>Marakeş, Fas</span><span data-en>Marrakech, Morocco</span>
        </div>
        <h3><span data-tr>Medina'da Kaybolmak: Bir Marakeş Rehberi</span><span data-en>Lost in the Medina: A Marrakech Guide</span></h3>
        <p data-tr>Marakeş, sanata dönüşmüş düzenli bir kaos. Medina seni şaşırtır, zorlar ve sonunda kendine hayran bırakır…</p>
        <p class="b" data-en>Marrakech is organized chaos elevated to an art form. The medina will disorient you, challenge you, and ultimately…</p>
      </a>
      <a href="/{{ $locale }}/guides" class="note alt">
        <div class="nimg"><img src="{{ asset('images/kyoto.jpg') }}" alt="Kyoto" loading="lazy"></div>
        <div class="loc">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--coral)" stroke="none"><circle cx="12" cy="12" r="6"/></svg>
          <span data-tr>Kyoto, Japonya</span><span data-en>Kyoto, Japan</span>
        </div>
        <h3><span data-tr>Kyoto'da Sessizliğin Sanatı</span><span data-en>The Art of Stillness in Kyoto</span></h3>
        <p data-tr>Kyoto fethedilen değil, teslim olunan bir şehir. Altın tapınakların ve bambu korularının ötesinde…</p>
        <p class="b" data-en>Kyoto is not a city you conquer — it's one you surrender to. Beyond the golden pavilions and bamboo groves lies a…</p>
      </a>
    </div>
    @endif
  </div>
</section>

{{-- ════════════════════════════════════════
     ÇARŞI / BAZAAR
════════════════════════════════════════ --}}
<section class="sec" id="shop">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><span data-tr>Çarşı</span><span data-en>The Bazaar</span></span>
        <h2><span data-tr>Toplanmış kökenler</span><span data-en>Collected Origins</span></h2>
        <p class="lead" data-tr>Her parça kendi kökeninden bir hikâye taşır — dünyanın dört bir yanından derlendi.</p>
        <p class="lead b" data-en>Every item carries a story from its origin — curated from destinations around the world.</p>
      </div>
      <a class="arrow" href="/{{ $locale }}/shop">
        <span data-tr>dükkâna git →</span><span data-en>Visit shop →</span>
      </a>
    </div>

    @if($products->count())
    <div class="bazaar-grid">
      @foreach($products as $product)
        @php
          $pname = $isEn ? ($product->title_en ?? $product->title_tr) : $product->title_tr;
          $psrc  = $isEn ? ($product->source_place_en ?? $product->source_place_tr ?? '') : ($product->source_place_tr ?? '');
          $price = $product->price ? ($product->currency.' '.number_format($product->price, 2)) : '';
        @endphp
        <a href="/{{ $locale }}/shop/{{ $product->slug }}" class="prod">
          <div class="pimg">
            @if($product->image)
              <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $pname }}" loading="eager">
            @else
              <img src="{{ asset('images/shop-prod'.($loop->index % 4 + 1).'.jpg') }}" alt="{{ $pname }}" loading="eager">
            @endif
          </div>
          @if($psrc)<span class="src">{{ $psrc }}</span>@endif
          <div class="pname">{{ $pname }}</div>
          @if($price)<div class="price">{{ $price }}</div>@endif
        </a>
      @endforeach
    </div>
    @else
    {{-- Statik placeholder --}}
    <div class="bazaar-grid">
      @foreach([
        ['img'=>'shop-prod1.jpg','src_tr'=>'Kaynak: Ubud, Bali','src_en'=>'Sourced in Ubud, Bali','name_tr'=>'El Dokuması İkat Atkı','name_en'=>'Handwoven Ikat Scarf','price'=>'$95.00'],
        ['img'=>'shop-prod2.jpg','src_tr'=>'Kaynak: Marakeş, Fas','src_en'=>'Sourced in Marrakech, Morocco','name_tr'=>'Zellige Seramik Kâse','name_en'=>'Zellige Ceramic Bowl','price'=>'$52.00'],
        ['img'=>'shop-prod3.jpg','src_tr'=>'Kaynak: İstanbul, Türkiye','src_en'=>'Sourced in Istanbul, Turkey','name_tr'=>'Antika Pirinç Pusula','name_en'=>'Vintage Brass Compass','price'=>'$145.00'],
        ['img'=>'shop-prod4.jpg','src_tr'=>'Kaynak: Fez, Fas','src_en'=>'Sourced in Fez, Morocco','name_tr'=>'El Yapımı Deri Seyahat Defteri','name_en'=>'Artisan Leather Travel Journal','price'=>'$68.00'],
      ] as $item)
      <a href="/{{ $locale }}/shop" class="prod">
        <div class="pimg"><img src="{{ asset('images/'.$item['img']) }}" alt="" loading="lazy"></div>
        <span class="src"><span data-tr>{{ $item['src_tr'] }}</span><span data-en>{{ $item['src_en'] }}</span></span>
        <div class="pname"><span data-tr>{{ $item['name_tr'] }}</span><span data-en>{{ $item['name_en'] }}</span></div>
        <div class="price">{{ $item['price'] }}</div>
      </a>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ════════════════════════════════════════
     TOPLULUK / COMMUNITY
════════════════════════════════════════ --}}
<section class="sec comm" id="comm">
  <div class="wrap">
    <span class="eyebrow" data-tr>Yolculuğu Takip Et</span>
    <span class="eyebrow b" data-en>Follow our journey</span>
    <h2>
      <span data-tr>Topluluğa Katıl</span>
      <span data-en>Join the Community</span>
    </h2>
    <p class="lead" data-tr>Grup yolculuklarından hikâyeler, kamera arkası anlar ve birlikte yarattığımız anılardan kareler için takip et.</p>
    <p class="lead b" data-en>Follow along for group travel stories, behind-the-scenes moments with our travelers, and glimpses of the shared memories we create together.</p>

    <div class="socials">
      <a href="#">
        <span class="box">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
          </svg>
        </span>
        Instagram
      </a>
      <a href="#">
        <span class="box">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
          </svg>
        </span>
        Facebook
      </a>
    </div>

    <div class="news">
      <h3>
        <span data-tr>Haberdar ol</span>
        <span data-en>Stay in the loop</span>
      </h3>
      <p data-tr>Destinasyon önerileri, rehberler ve seçilmiş tavsiyeler için abone ol.</p>
      <p class="b" data-en>Subscribe for destination insights, travel guides, and curated recommendations.</p>
      <div class="row">
        <input type="email" placeholder="E-posta adresin" aria-label="E-posta">
        <button type="button" onclick="this.textContent=document.documentElement.lang==='en'?'Thanks!':'Teşekkürler!'">
          <span data-tr>Abone ol</span><span data-en>Subscribe</span>
        </button>
      </div>
    </div>
  </div>
</section>

@endsection
