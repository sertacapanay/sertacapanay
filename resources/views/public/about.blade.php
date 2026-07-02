@extends('public.layout')

@section('title', $isEn ? 'About — Sertaç Apanay' : 'Hakkımda — Sertaç Apanay')
@section('description', $isEn
  ? 'Group tour guide, destination lecturer and travel companion — I don\'t just take people to a place, I walk with them, share stories and become part of their journey.'
  : 'Grup tur rehberi, destinasyon anlatıcısı ve seyahat arkadaşı — insanları sadece bir yere götürmem, onlarla yürür, hikâyeler paylaşır ve yolculuklarının parçası olurum.'
)

@push('styles')
<style>
  /* ── Hero: 2 sütun (fotoğraf sol sticky, metin sağ) ── */
  .about-hero { padding: 120px 0 80px; }
  .about-grid {
    display: grid;
    grid-template-columns: 1fr 1.1fr;
    gap: 80px;
    align-items: start;
  }
  .about-photo-col { position: sticky; top: 100px; }
  .about-photo {
    aspect-ratio: 3 / 4;
    overflow: hidden;
    border-radius: 3px;
    background: var(--bone-2);
  }
  .about-photo img { width: 100%; height: 100%; object-fit: cover; display: block; }

  .about-text-col { }
  .about-eyebrow {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: .28em;
    text-transform: uppercase;
    color: var(--muted);
    display: block;
    margin-bottom: 16px;
  }
  .about-h1 {
    font-family: var(--display);
    font-style: italic;
    font-weight: 500;
    font-size: clamp(38px, 5.5vw, 68px);
    line-height: 1.08;
    letter-spacing: -.01em;
    margin: 0 0 36px;
    color: var(--ink);
  }
  .about-body { margin-bottom: 44px; }
  .about-body p {
    font-size: 16.5px;
    line-height: 1.78;
    color: var(--muted);
    margin: 0 0 18px;
  }
  .about-body p:last-child { margin-bottom: 0; }
  .about-body strong { color: var(--ink); font-weight: 600; }

  /* Rol kartları */
  .role-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    border-top: 1px solid var(--line);
    padding-top: 36px;
    margin-bottom: 44px;
  }
  .role-card { }
  .role-card h3 {
    font-family: var(--display);
    font-style: italic;
    font-size: 20px;
    margin: 0 0 6px;
    color: var(--ink);
  }
  .role-card p {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: .15em;
    text-transform: uppercase;
    color: var(--muted);
    margin: 0;
    line-height: 1.5;
  }

  /* CTA'lar */
  .about-ctas { display: flex; align-items: center; gap: 24px; flex-wrap: wrap; }
  .cta-primary {
    background: var(--ink);
    color: var(--bone);
    padding: 14px 28px;
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: .14em;
    text-transform: uppercase;
    text-decoration: none;
    transition: background .2s;
    border-radius: 2px;
  }
  .cta-primary:hover { background: var(--coral); }
  .cta-secondary {
    font-family: var(--body);
    font-size: 14px;
    color: var(--muted);
    text-decoration: none;
    border-bottom: 1px solid var(--line);
    padding-bottom: 2px;
    transition: color .2s, border-color .2s;
  }
  .cta-secondary:hover { color: var(--ink); border-color: var(--ink); }

  /* ── Testimonials ── */
  .about-testimonials {
    border-top: 1px solid var(--line);
    padding: 80px 0 90px;
  }
  .tsec2 { }
  .tgrid2 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 18px;
  }
  .tcard2 { border-top: 1px solid var(--ink); padding-top: 22px; }
  .tcard2 .qt { font-size: 64px; font-family: var(--display); color: var(--coral); line-height: .8; margin: 0 0 8px; }
  .tcard2 .q  {
    font-family: var(--display);
    font-style: italic;
    font-size: 17.5px;
    line-height: 1.55;
    color: var(--ink);
    margin: 0 0 18px;
  }
  .tcard2 .who  { font-family: var(--mono); font-size: 12px; letter-spacing: .04em; color: var(--ink); }
  .tcard2 .trip {
    font-family: var(--mono);
    font-size: 10.5px;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
    margin-top: 5px;
  }

  /* Responsive */
  @media (max-width: 960px) {
    .about-grid { grid-template-columns: 1fr; gap: 40px; }
    .about-photo-col { position: static; }
    .about-photo { aspect-ratio: 4 / 3; max-height: 400px; }
    .role-grid { grid-template-columns: 1fr 1fr; }
    .tgrid2 { grid-template-columns: 1fr; }
  }
  @media (max-width: 600px) {
    .about-hero { padding: 100px 0 60px; }
    .role-grid { grid-template-columns: 1fr; }
    .about-ctas { flex-direction: column; align-items: flex-start; }
  }
</style>
@endpush

@section('content')
<main class="page">

  {{-- ── Hero: Fotoğraf + Metin ── --}}
  <section class="about-hero">
    <div class="wrap">
      <div class="about-grid">

        {{-- Sol: Fotoğraf (sticky) --}}
        <div class="about-photo-col">
          <div class="about-photo">
            <img src="{{ asset('images/about-sertac.jpg') }}" alt="Sertaç Apanay" loading="eager">
          </div>
        </div>

        {{-- Sağ: Metin --}}
        <div class="about-text-col">
          <span class="about-eyebrow">
            <span data-tr>Hakkımda</span><span data-en>About</span>
          </span>

          <h1 class="about-h1">
            <span data-tr>Seninle Yolculuk<br>Eden Kişi</span>
            <span data-en>The Person Who<br>Travels With You</span>
          </h1>

          <div class="about-body">
            <p>
              <span data-tr>Ben bir grup tur rehberi, destinasyon anlatıcısı ve seyahat arkadaşıyım — en güzel yolculukların yalnız çıkılmadığına inanan biri. Amacım insanları bir araya getirmek, onlara dünyayı gezdirmek ve hikâyelerinin bir parçası olmak.</span>
              <span data-en>I am a group tour guide, destination lecturer, and travel companion — someone who believes the greatest journeys aren't taken alone. My mission is to bring people together, lead them through the world, and become part of their story.</span>
            </p>
            <p>
              <span data-tr>Yıllar içinde altı kıtada gruplara rehberlik ettim — elinde bayrak ve mikrofon tutan bir yabancı olarak değil, gerçek bir yol arkadaşı olarak. Gittiğimiz her yerde derin bağlar, paylaşılan keşifler ve ortak anılar yaşadık.</span>
              <span data-en>Over the years, I've guided groups across six continents — not as a stranger with a flag and a microphone, but as a fellow traveler who eats at the same table, walks the same cobblestones, and shares in the wonder alongside everyone.</span>
            </p>
            <p>
              <span data-tr><strong>Destinasyon anlatıcısı</strong> olarak gezdiğimiz her köşeye tarih, kültür ve bağlam katarım — güzel bir manzarayı seninle kalan bir ana dönüştürürüm. <strong>Grup seyahat tasarımcısı</strong> olarak asla jenerik olmayan, kişisel hissettiren rotalar kurarım. <strong>Yol arkadaşı</strong> olarak gruptaki hiç kimsenin turist gibi hissettirmemesini sağlarım — herkes ait olur.</span>
              <span data-en>As a <strong>destination lecturer</strong>, I bring history, culture, and context to every corner we explore — turning a beautiful view into a moment that stays with you. As a <strong>group travel designer</strong>, I craft itineraries that feel personal, never generic. And as a <strong>travel companion</strong>, I make sure no one in the group feels like a tourist — everyone belongs.</span>
            </p>
            <p>
              <span data-tr>Bu arşiv, birlikte gittiğimiz her yerin kaydı — rehberler, rotalar, hikâyeler ve gruplarımızın bir süreliğine de olsa ev diye andığı yerlerden derlenen parçalar.</span>
              <span data-en>This archive is a record of everywhere we've gone together — the guides, the routes, the stories, and the collected pieces from the places our groups have called home, even if only for a few days.</span>
            </p>
          </div>

          {{-- Rol kartları --}}
          <div class="role-grid">
            <div class="role-card">
              <h3><span data-tr>Grup Rehberi</span><span data-en>Group Guide</span></h3>
              <p><span data-tr>Yürekten ve var olarak rehberlik</span><span data-en>Leading with heart &amp; presence</span></p>
            </div>
            <div class="role-card">
              <h3><span data-tr>Anlatıcı</span><span data-en>Lecturer</span></h3>
              <p><span data-tr>Derinlik, bağlam ve hikâye</span><span data-en>Depth, context &amp; storytelling</span></p>
            </div>
            <div class="role-card">
              <h3><span data-tr>Yol Arkadaşı</span><span data-en>Companion</span></h3>
              <p><span data-tr>Her zaman gruptan biri</span><span data-en>One of the group, always</span></p>
            </div>
          </div>

          {{-- CTA'lar --}}
          <div class="about-ctas">
            <a class="cta-primary" href="{{ route('tours', ['locale' => $locale]) }}">
              <span data-tr>Tura Katıl</span><span data-en>Join a Tour</span>
            </a>
            <a class="cta-secondary" href="/{{ $locale }}/places">
              <span data-tr>Destinasyonları keşfet</span><span data-en>Explore our destinations</span>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ── Testimonials ── --}}
  @php
    $aboutTestimonials = \App\Models\Testimonial::approved()->with('guestUser','tour')->latest()->get();
    $aboutLocale = app()->getLocale();
    $aboutIsEn = $aboutLocale === 'en';
  @endphp
  @if($aboutTestimonials->isNotEmpty())
  <section class="about-testimonials">
    <div class="wrap">
      <div class="sec-head" style="margin-bottom:28px">
        <div>
          <span class="eyebrow"><span data-tr>Katılımcılar</span><span data-en>Travelers</span></span>
          <h2><span data-tr>Gezginlerden Sözler</span><span data-en>Words from Travelers</span></h2>
        </div>
        <a href="{{ route('testimonial.create') }}" style="font-family:var(--mono);font-size:12px;letter-spacing:.06em;text-transform:uppercase;color:var(--ink);text-decoration:none;border-bottom:1px solid var(--ink);padding-bottom:2px;">
          <span data-tr>✍ Deneyimini Paylaş</span><span data-en>✍ Share Experience</span>
        </a>
      </div>
      <div class="tgrid2">
        @foreach($aboutTestimonials as $t)
        <div class="tcard2">
          <p class="q">"{{ Str::limit($t->body, 260) }}"</p>
          <div class="who">{{ $t->guestUser->name }}</div>
          <div class="trip">{{ $t->tour ? ($aboutIsEn ? ($t->tour->title_en ?? $t->tour->title_tr) : $t->tour->title_tr) : ($aboutIsEn ? 'General Experience' : 'Genel Deneyim') }}</div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

</main>
@endsection
