@extends('public.layout')

@php
  $placeName = $isEn ? ($place->name_en ?? $place->name_tr) : $place->name_tr;
  $placeDesc = $isEn ? ($place->short_description_en ?? '') : ($place->short_description_tr ?? '');
  $placeCountry = $isEn ? ($place->country_en ?? $place->country_tr ?? '') : ($place->country_tr ?? '');
  $placeCity = $isEn ? ($place->city_en ?? $place->city_tr ?? '') : ($place->city_tr ?? '');
  $placeRegion = $isEn ? ($place->region_en ?? $place->region_tr ?? '') : ($place->region_tr ?? '');
@endphp
@section('title', $placeName . ' — Sertaç Apanay')
@section('description', $placeDesc)
@if($place->cover_image)@section('og_image', rtrim(config('app.url'),'/').'/storage/'.$place->cover_image)@endif

@push('jsonld')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "TouristAttraction",
  "name": {{ Js::from($placeName) }},
  "description": {{ Js::from(Str::limit(strip_tags($placeDesc), 200)) }},
  @if($place->cover_image)
  "image": "{{ rtrim(config('app.url'),'/') }}/storage/{{ $place->cover_image }}",
  @endif
  @if($placeCountry)
  "address": {
    "@@type": "PostalAddress",
    "addressCountry": {{ Js::from($placeCountry) }}
    @if($placeCity), "addressLocality": {{ Js::from($placeCity) }}@endif
  },
  @endif
  @if($place->latitude && $place->longitude)
  "geo": {
    "@@type": "GeoCoordinates",
    "latitude": {{ $place->latitude }},
    "longitude": {{ $place->longitude }}
  },
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
  .page-hero{position:relative;min-height:60vh;display:flex;align-items:flex-end;
    padding:140px 0 60px;background-size:cover;background-position:center;color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(40px,6vw,72px);font-style:italic;font-weight:400;line-height:1.06}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:560px;line-height:1.65}

  .page-layout{display:grid;grid-template-columns:1fr 300px;gap:60px;
    max-width:1140px;margin:0 auto;padding:60px 44px 80px;align-items:start}
  @media(max-width:900px){.page-layout{grid-template-columns:1fr;padding:40px 24px 60px}}
  .page-body{max-width:800px}
  .page-body p{font-size:17px;line-height:1.85;margin-bottom:1.4em;white-space:pre-line}
  .page-body h2{font-family:var(--display);font-size:28px;font-style:italic;margin:2.4em 0 .8em}
  .page-body h2:first-child{margin-top:0}
  .page-body img{width:100%;border-radius:3px;margin:2em 0}

  .info-panel{background:var(--paper);border:1px solid var(--line);border-radius:6px;padding:28px;position:sticky;top:100px}
  .info-panel .lbl{font-family:var(--mono);font-size:10px;letter-spacing:.2em;text-transform:uppercase;color:var(--muted);margin-bottom:20px}
  .info-panel .row{display:flex;justify-content:space-between;font-size:13px;margin-bottom:14px;padding-bottom:14px;border-bottom:1px solid var(--line)}
  .info-panel .row:last-of-type{border-bottom:0;margin-bottom:0;padding-bottom:0}
  .info-panel .row span:first-child{color:var(--muted)}
  .info-panel .row span:last-child{color:var(--ink);font-weight:500;text-align:right}
  .info-panel .map-link{display:block;text-align:center;margin-top:20px;padding:12px;background:var(--ink);color:var(--bone);
    border-radius:4px;font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase}
  .info-panel .map-link:hover{background:var(--coral)}

  .recs{padding:60px 0;background:var(--paper)}
  .recs .wrap{max-width:1240px;margin:0 auto;padding:0 44px}
  .recs h2{font-family:var(--display);font-size:32px;font-style:italic;margin-bottom:32px}
  .rec-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
  @media(max-width:768px){.rec-grid{grid-template-columns:1fr}}
  .rec{background:var(--bone);border:1px solid var(--line);border-radius:3px;overflow:hidden;display:block}
  .rec .rimg{aspect-ratio:4/3;overflow:hidden;background:var(--bone-2)}
  .rec .rimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .rec:hover .rimg img{transform:scale(1.04)}
  .rec .rpd{padding:18px}
  .rec .rcat{font-family:var(--mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--coral);margin-bottom:8px}
  .rec h3{font-family:var(--display);font-size:19px;font-style:italic;line-height:1.25}
</style>
@endpush

@section('content')
@php
  $name = $isEn ? $place->name_en : $place->name_tr;
  $country = $isEn ? ($place->country_en ?? $place->country_tr ?? '') : ($place->country_tr ?? '');
  $city = $isEn ? ($place->city_en ?? $place->city_tr ?? '') : ($place->city_tr ?? '');
  $region = $isEn ? ($place->region_en ?? $place->region_tr ?? '') : ($place->region_tr ?? '');
  $desc = $isEn ? ($place->short_description_en ?? '') : ($place->short_description_tr ?? '');
  $history = $isEn ? ($place->history_en ?? '') : ($place->history_tr ?? '');
  $stories = $isEn ? ($place->stories_en ?? '') : ($place->stories_tr ?? '');
  $whatToSee = $isEn ? ($place->what_to_see_en ?? '') : ($place->what_to_see_tr ?? '');
  $heroStyle = $place->cover_image
    ? 'background-image:linear-gradient(180deg,rgba(8,10,14,.35) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),url("'.asset('storage/'.$place->cover_image).'")'
    : 'background:var(--ink)';
@endphp

<section class="page-hero" style="{{ $heroStyle }}">
  <div class="wrap">
    @if($country)<div class="page-eyebrow">{{ $city ? $city.' · '.$country : $country }}</div>@endif
    <h1 class="page-title">{{ $name }}</h1>
    @if($desc)<p class="page-lead">{{ $desc }}</p>@endif
  </div>
</section>

<main>
  <div class="page-layout">
    <div class="page-body">
      @if($history)
        <h2><span data-tr>Tarihçe</span><span data-en>History</span></h2>
        <p>{{ $history }}</p>
      @endif
      @if($stories)
        <h2><span data-tr>Hikâyeler</span><span data-en>Stories</span></h2>
        <p>{{ $stories }}</p>
      @endif
      @if($whatToSee)
        <h2><span data-tr>Ne Görmeli</span><span data-en>What to See</span></h2>
        <p>{{ $whatToSee }}</p>
      @endif
      @if(!$history && !$stories && !$whatToSee)
        <p data-tr>Bu destinasyon için detaylı içerik yakında eklenecek.</p>
        <p class="b" data-en>Detailed content for this destination is coming soon.</p>
      @endif
    </div>
    <aside class="info-panel">
      <div class="lbl"><span data-tr>DESTİNASYON BİLGİSİ</span><span data-en>DESTINATION INFO</span></div>
      @if($country)
      <div class="row"><span><span data-tr>Ülke</span><span data-en>Country</span></span><span>{{ $country }}</span></div>
      @endif
      @if($city)
      <div class="row"><span><span data-tr>Şehir</span><span data-en>City</span></span><span>{{ $city }}</span></div>
      @endif
      @if($region)
      <div class="row"><span><span data-tr>Bölge</span><span data-en>Region</span></span><span>{{ $region }}</span></div>
      @endif
      @if($place->latitude && $place->longitude)
      <a class="map-link" href="https://www.google.com/maps?q={{ $place->latitude }},{{ $place->longitude }}" target="_blank" rel="noopener">
        <span data-tr>Haritada Gör</span><span data-en>View on Map</span>
      </a>
      @endif
    </aside>
  </div>

  @if($relatedPlaces->count())
  <section class="recs">
    <div class="wrap">
      <h2><span data-tr>İlgili Destinasyonlar</span><span data-en>Related Destinations</span></h2>
      <div class="rec-grid">
        @foreach($relatedPlaces as $rel)
        <a href="/{{ $locale }}/places/{{ $rel->slug }}" class="rec">
          <div class="rimg">
            @if($rel->cover_image)
              <img src="{{ asset('storage/'.$rel->cover_image) }}" alt="{{ $isEn ? $rel->name_en : $rel->name_tr }}" loading="lazy">
            @endif
          </div>
          <div class="rpd">
            <div class="rcat">{{ $isEn ? ($rel->country_en ?? '') : ($rel->country_tr ?? '') }}</div>
            <h3>{{ $isEn ? $rel->name_en : $rel->name_tr }}</h3>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif
  @foreach(\App\Models\Widget::forPosition('content_bottom', 'places') as $widget)
    <section class="wrap" style="padding:40px 0">
      <x-widget :widget="$widget" />
    </section>
  @endforeach
</main>
@endsection
