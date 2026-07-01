@extends('public.layout')

@php
  $tourName = $isEn ? ($tour->title_en ?? $tour->title_tr) : $tour->title_tr;
  $tourDesc = $isEn ? ($tour->short_description_en ?? '') : ($tour->short_description_tr ?? '');
  $tourRegion = $isEn ? ($tour->region_en ?? $tour->country_en ?? '') : ($tour->region_tr ?? $tour->country_tr ?? '');
  $bookingUrl = $tour->booking_url ?: $bookingUrlDefault;
@endphp
@section('title', $tourName . ' — Sertaç Apanay')
@section('description', $tourDesc)
@if($tour->cover_image)@section('og_image', asset('storage/'.$tour->cover_image))@endif

@push('jsonld')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "TouristTrip",
  "name": {{ Js::from($tourName) }},
  "description": {{ Js::from(Str::limit(strip_tags($tourDesc), 200)) }},
  @if($tour->cover_image)
  "image": "{{ asset('storage/'.$tour->cover_image) }}",
  @endif
  @if($tourRegion)
  "location": {
    "@@type": "Place",
    "name": {{ Js::from($tourRegion) }}
  },
  @endif
  @if($tour->price)
  "offers": {
    "@@type": "Offer",
    "price": "{{ $tour->price }}",
    "priceCurrency": "{{ $tour->currency ?? 'EUR' }}",
    "availability": "https://schema.org/InStock",
    "url": "{{ $bookingUrl }}"
  },
  @endif
  @if($tour->duration_days)
  "duration": "P{{ $tour->duration_days }}D",
  @endif
  "touristType": "Group Tour",
  "provider": {
    "@@type": "Person",
    "name": "Sertaç Apanay",
    "url": "{{ rtrim(config('app.url'),'/') }}"
  },
  "inLanguage": "{{ $locale }}",
  "url": "{{ rtrim(config('app.url'),'/') }}{{ request()->getPathInfo() }}"
}
</script>
@endpush

@push('styles')
<style>
  .page-hero{position:relative;min-height:65vh;display:flex;align-items:flex-end;
    padding:140px 0 60px;background-size:cover;background-position:center;color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(40px,6vw,72px);font-style:italic;font-weight:400;line-height:1.06}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:560px;line-height:1.65}
  .tour-meta{display:flex;gap:24px;flex-wrap:wrap;margin-top:20px;font-family:var(--mono);
    font-size:11px;letter-spacing:.14em;color:rgba(243,239,230,.55)}
  .tour-meta strong{color:var(--coral);font-size:15px;font-family:var(--ui)}

  .tour-layout{display:grid;grid-template-columns:1fr 320px;gap:60px;
    max-width:1140px;margin:0 auto;padding:60px 44px 80px;align-items:start}
  @media(max-width:900px){.tour-layout{grid-template-columns:1fr;padding:40px 24px 60px}}
  .tour-body p{font-size:17px;line-height:1.85;margin-bottom:1.4em}
  .tour-body h2{font-family:var(--display);font-size:28px;font-style:italic;margin:2.4em 0 .8em}
  .tour-body img{width:100%;border-radius:3px;margin:2em 0}

  .booking-panel{background:var(--ink);color:var(--bone);border-radius:6px;padding:32px;position:sticky;top:100px}
  .booking-panel .price{font-family:var(--display);font-size:36px;color:var(--coral);margin-bottom:4px}
  .booking-panel .price-label{font-family:var(--mono);font-size:10px;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(243,239,230,.45);margin-bottom:24px}
  .booking-panel hr{border:none;border-top:1px solid rgba(243,239,230,.12);margin:20px 0}
  .booking-panel .detail-row{display:flex;justify-content:space-between;
    font-family:var(--mono);font-size:11px;letter-spacing:.1em;margin-bottom:12px;
    color:rgba(243,239,230,.6)}
  .booking-panel .detail-row span:last-child{color:var(--bone)}
  .btn-book{display:flex;align-items:center;justify-content:center;gap:10px;
    background:var(--coral);color:#fff;font-weight:600;font-size:14px;
    padding:14px 24px;border-radius:4px;margin-top:24px;transition:.2s}
  .btn-book:hover{opacity:.9}
  .book-note{font-size:11px;color:rgba(243,239,230,.5);line-height:1.6;margin-top:14px}

  .recs{padding:60px 0;background:var(--paper)}
  .recs .wrap{max-width:1240px;margin:0 auto;padding:0 44px}
  .recs h2{font-family:var(--display);font-size:32px;font-style:italic;margin-bottom:32px}
  .rec-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
  @media(max-width:768px){.rec-grid{grid-template-columns:1fr}}
  .rec{background:var(--bone);border:1px solid var(--line);border-radius:3px;overflow:hidden;display:block}
  .rec .rimg{aspect-ratio:3/2;overflow:hidden;background:var(--bone-2)}
  .rec .rimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .rec:hover .rimg img{transform:scale(1.04)}
  .rec .rpd{padding:18px}
  .rec .rcat{font-family:var(--mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--coral);margin-bottom:8px}
  .rec h3{font-family:var(--display);font-size:19px;font-style:italic}
</style>
@endpush

@section('content')
@php
  $body = $isEn ? ($tour->description_en ?? '') : ($tour->description_tr ?? '');
  $heroStyle = $tour->cover_image
    ? 'background-image:linear-gradient(180deg,rgba(8,10,14,.4) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),url("'.asset('storage/'.$tour->cover_image).'")'
    : 'background:var(--ink)';
@endphp

<section class="page-hero" style="{{ $heroStyle }}">
  <div class="wrap">
    @if($tourRegion)<div class="page-eyebrow">{{ $tourRegion }}</div>@endif
    <h1 class="page-title">{{ $tourName }}</h1>
    @if($tourDesc)<p class="page-lead">{{ $tourDesc }}</p>@endif
    <div class="tour-meta">
      @if($tour->duration_days)
        <span><span data-tr>Süre:</span><span data-en>Duration:</span> <strong>{{ $tour->duration_days }} <span data-tr>gün</span><span data-en>days</span></strong></span>
      @endif
      @if($tour->start_date)
        <span><span data-tr>Tarih:</span><span data-en>Date:</span> <strong>{{ \Carbon\Carbon::parse($tour->start_date)->locale($locale)->isoFormat('D MMM YYYY') }}</strong></span>
      @endif
      @if($tour->price)
        <span><span data-tr>Fiyat:</span><span data-en>Price:</span> <strong>{{ number_format($tour->price) }} {{ $tour->currency }}</strong></span>
      @endif
    </div>
  </div>
</section>

<main>
  <div class="tour-layout">
    <div class="tour-body">
      {!! sanitizeHtml($body) !!}
    </div>
    <aside class="booking-panel">
      @if($tour->price)
        <div class="price">{{ number_format($tour->price) }} {{ $tour->currency }}</div>
        <div class="price-label"><span data-tr>kişi başına</span><span data-en>per person</span></div>
      @endif
      <hr>
      @if($tour->duration_days)
      <div class="detail-row">
        <span><span data-tr>Süre</span><span data-en>Duration</span></span>
        <span>{{ $tour->duration_days }} <span data-tr>gün</span><span data-en>days</span></span>
      </div>
      @endif
      @if($tour->start_date)
      <div class="detail-row">
        <span><span data-tr>Tarih</span><span data-en>Date</span></span>
        <span>{{ \Carbon\Carbon::parse($tour->start_date)->locale($locale)->isoFormat('D MMM YYYY') }}</span>
      </div>
      @endif
      @if($tourRegion)
      <div class="detail-row">
        <span><span data-tr>Güzergah</span><span data-en>Route</span></span>
        <span>{{ $tourRegion }}</span>
      </div>
      @endif
      <hr>
      <a class="btn-book" href="{{ $bookingUrl }}" target="_blank" rel="noopener nofollow sponsored">
        <span data-tr>Gezi Kolay'da İncele</span><span data-en>View on Gezi Kolay</span>
      </a>
      <p class="book-note">
        <span data-tr>Bu turun satışı ve rezervasyonu iş ortağımız Gezi Kolay üzerinden yapılmaktadır.</span>
        <span data-en>This tour is sold and booked through our partner agency, Gezi Kolay.</span>
      </p>
    </aside>
  </div>

  @if($relatedTours->count())
  <section class="recs">
    <div class="wrap">
      <h2><span data-tr>Diğer Turlar</span><span data-en>Other Tours</span></h2>
      <div class="rec-grid">
        @foreach($relatedTours as $rel)
        <a href="/{{ $locale }}/tours/{{ $rel->slug }}" class="rec">
          <div class="rimg">
            @if($rel->cover_image)
              <img src="{{ asset('storage/'.$rel->cover_image) }}" alt="{{ $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr }}" loading="lazy">
            @endif
          </div>
          <div class="rpd">
            <div class="rcat">{{ $isEn ? ($rel->region_en ?? $rel->country_en ?? '') : ($rel->region_tr ?? $rel->country_tr ?? '') }}</div>
            <h3>{{ $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr }}</h3>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif
  {{-- ── İçerik altı widget'lar ── --}}
  @foreach(\App\Models\Widget::forPosition('content_bottom', 'tours') as $widget)
    <section class="wrap" style="padding:40px 0">
      <x-widget :widget="$widget" />
    </section>
  @endforeach

  <x-testimonials :tourId="$tour->id" :limit="4" />

</main>
@endsection
