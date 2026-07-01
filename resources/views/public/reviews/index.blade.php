@extends('public.layout')

@section('title', $isEn ? 'Reviews — Words from Travelers' : 'Yorumlar — Gezginlerden Sözler')

@section('content')

<style>
  .reviews-hero { padding: 80px 0 48px; border-bottom: 1px solid var(--line); }
  .reviews-hero h1 { font-size: clamp(32px, 5vw, 52px); line-height: 1.1; margin: 0 0 14px; }
  .reviews-hero p { font-family: var(--body); font-size: 17px; color: var(--muted); max-width: 520px; margin: 0; }

  .reviews-grid-wrap { padding: 60px 0 100px; }
  .reviews-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 60px;
  }
  @media (max-width: 960px) { .reviews-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 600px) { .reviews-grid { grid-template-columns: 1fr; } }

  .rev-card { border-top: 1px solid var(--ink); padding-top: 22px; }
  .rev-card .q {
    font-family: var(--display);
    font-style: italic;
    font-size: 17px;
    line-height: 1.55;
    color: var(--ink);
    margin: 0 0 18px;
  }
  .rev-card .who { font-family: var(--mono); font-size: 12px; letter-spacing: .04em; color: var(--ink); display: flex; align-items: center; gap: 8px; }
  .rev-card .trip { font-family: var(--mono); font-size: 10.5px; letter-spacing: .1em; text-transform: uppercase; color: var(--muted); margin-top: 5px; }
  .rev-card .google-tag {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 10px;
    color: var(--muted);
    border: 1px solid var(--line);
    border-radius: 4px;
    padding: 1px 5px;
    vertical-align: middle;
  }

  .static-section { border-top: 1px solid var(--line); padding-top: 48px; margin-top: 12px; }
  .static-section h3 { font-family: var(--mono); font-size: 11px; letter-spacing: .12em; text-transform: uppercase; color: var(--muted); margin: 0 0 32px; }

  .cta-box { border-top: 1px solid var(--line); padding-top: 48px; display: flex; align-items: center; gap: 32px; flex-wrap: wrap; }
  .cta-box p { font-family: var(--body); font-size: 15px; color: var(--muted); margin: 0; flex: 1; min-width: 200px; }
</style>

{{-- HERO --}}
<section class="reviews-hero">
  <div class="wrap">
    <span class="eyebrow"><span data-tr>Müşteri Sözleri</span><span data-en>Client Voices</span></span>
    <h1><span data-tr>Gezginlerden Sözler</span><span data-en>Words from Travelers</span></h1>
    <p>
      <span data-tr>Birlikte çıktığımız yolculuklarda yaşananlar, en iyi onların ağzından anlatılır.</span>
      <span data-en>What happened on our journeys together is best told by those who were there.</span>
    </p>
  </div>
</section>

{{-- DB TESTIMONIALS --}}
<section class="reviews-grid-wrap">
  <div class="wrap">

    @if($testimonials->isNotEmpty())
    <div class="reviews-grid">
      @foreach($testimonials as $t)
      <div class="rev-card">
        <p class="q">"{{ $t->body }}"</p>
        <div class="who">
          {{ $t->guestUser->name }}
          <span class="google-tag">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none">
              <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
              <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
              <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
              <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            via Google
          </span>
        </div>
        @if($t->tour)
        <div class="trip">{{ $isEn ? ($t->tour->title_en ?? $t->tour->title_tr) : $t->tour->title_tr }}</div>
        @else
        <div class="trip"><span data-tr>Genel Deneyim</span><span data-en>General Experience</span></div>
        @endif
      </div>
      @endforeach
    </div>
    @endif

    {{-- STATIC REVIEWS --}}
    <div class="static-section">
      <h3><span data-tr>Seçilmiş Yorumlar</span><span data-en>Featured Reviews</span></h3>
      <div class="reviews-grid">
        <div class="rev-card">
          <p class="q" data-tr>"Bir akademisyenin derinliği ve bir hikâye anlatıcısının yeteneğiyle olağanüstü bir rehber. Fas yolculuğumuz tam anlamıyla dönüştürücüydü…"</p>
          <p class="q b" data-en>"An extraordinary guide with an academic's depth and a storyteller's gift. Our Morocco journey was nothing short of transformational…"</p>
          <div class="who">Sophia Harrington</div>
          <div class="trip"><span data-tr>Özel Fas Turu · 2024</span><span data-en>Private Morocco Tour · 2024</span></div>
        </div>
        <div class="rev-card">
          <p class="q" data-tr>"Japonya gezimiz için hazırlanan özel rota kusursuzdu. Her ayrıntıda özen ve derin bir kültür anlayışı hissediliyordu…"</p>
          <p class="q b" data-en>"The bespoke itinerary crafted for our Japan trip was flawless. Every detail reflected care and a deep understanding of culture…"</p>
          <div class="who">James &amp; Elaine Park</div>
          <div class="trip"><span data-tr>Japonya Seyahat Tasarımı · 2025</span><span data-en>Japan Travel Design · 2025</span></div>
        </div>
        <div class="rev-card">
          <p class="q" data-tr>"Birçok anlatılı seyahate katıldım ama hiçbiri bu deneyimin entelektüel zenginliğine yaklaşamadı…"</p>
          <p class="q b" data-en>"I've joined several lecture voyages and none have come close to the intellectual richness of this experience…"</p>
          <div class="who">Dr. Margaret Osei</div>
          <div class="trip"><span data-tr>Akdeniz Anlatı Seferi · 2025</span><span data-en>Mediterranean Lecture Voyage · 2025</span></div>
        </div>
        <div class="rev-card">
          <p class="q" data-tr>"Her seyahati sadece bir gezi değil, bir yaşam deneyimine dönüştürüyor. Unutulmaz anlar ve derin kültürel anlayış…"</p>
          <p class="q b" data-en>"He turns every journey into not just a trip, but a life experience. Unforgettable moments and deep cultural insight…"</p>
          <div class="who">Elena Rossi</div>
          <div class="trip"><span data-tr>İtalya Kültür Turu · 2024</span><span data-en>Italy Cultural Tour · 2024</span></div>
        </div>
        <div class="rev-card">
          <p class="q" data-tr>"Sertaç'ın rehberliğinde her destinasyon bambaşka bir anlam kazanıyor. Tarih, kültür ve insan hikayeleri iç içe geçiyor…"</p>
          <p class="q b" data-en>"Under Sertaç's guidance, every destination takes on a whole new meaning. History, culture and human stories intertwine…"</p>
          <div class="who">Thomas Müller</div>
          <div class="trip"><span data-tr>Anadolu Medeniyetleri · 2025</span><span data-en>Anatolian Civilizations · 2025</span></div>
        </div>
        <div class="rev-card">
          <p class="q" data-tr>"Grupla seyahat etmekten pek hoşlanmam ama bu deneyim tüm beklentilerimi alt üst etti. Harika bir topluluk ruhu…"</p>
          <p class="q b" data-en>"I'm not usually a fan of group travel, but this experience turned all my expectations upside down. Wonderful community spirit…"</p>
          <div class="who">Amara Diallo</div>
          <div class="trip"><span data-tr>Batı Afrika Seferi · 2024</span><span data-en>West Africa Expedition · 2024</span></div>
        </div>
      </div>
    </div>

    {{-- CTA --}}
    <div class="cta-box">
      <p>
        <span data-tr>Birlikte bir yolculuk yaptıysak, deneyimini paylaş. Diğer gezginlere ilham ver.</span>
        <span data-en>If we've traveled together, share your experience. Inspire other travelers.</span>
      </p>
      <a href="{{ route('testimonial.create') }}" class="btn btn-primary">
        <span data-tr>✍ Deneyimini Paylaş</span><span data-en>✍ Share Your Experience</span>
      </a>
    </div>

  </div>
</section>

@endsection
