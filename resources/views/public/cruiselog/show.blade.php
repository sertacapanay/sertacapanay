@extends('public.layout')

@php
  $name = $isEn ? ($cruise->title_en ?? $cruise->title_tr) : $cruise->title_tr;
  $country = $isEn ? ($cruise->country_en ?? '') : ($cruise->country_tr ?? '');
  $desc = $isEn ? ($cruise->short_description_en ?? '') : ($cruise->short_description_tr ?? '');
  $body = $isEn ? ($cruise->description_en ?? '') : ($cruise->description_tr ?? '');
  $fromPort = $isEn ? ($cruise->from_port_en ?? $cruise->from_port_tr ?? '') : ($cruise->from_port_tr ?? '');
  $toPort = $isEn ? ($cruise->to_port_en ?? $cruise->to_port_tr ?? '') : ($cruise->to_port_tr ?? '');
@endphp

@section('title', $name . ' — Sertaç Apanay')
@section('description', $desc)
@if($cruise->cover_image)@section('og_image', asset('storage/'.$cruise->cover_image))@endif

@push('jsonld')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "TravelAction",
  "name": {{ Js::from($name) }},
  "description": {{ Js::from(Str::limit(strip_tags($desc), 200)) }},
  "agent": {
    "@@type": "Person",
    "name": "Sertaç Apanay"
  },
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

  .tour-layout{display:grid;grid-template-columns:1fr 320px;gap:60px;
    max-width:1140px;margin:0 auto;padding:60px 44px 80px;align-items:start}
  @media(max-width:900px){.tour-layout{grid-template-columns:1fr;padding:40px 24px 60px}}
  .tour-body p{font-size:17px;line-height:1.85;margin-bottom:1.4em}
  .tour-body h2{font-family:var(--display);font-size:28px;font-style:italic;margin:2.4em 0 .8em}
  .tour-body img{width:100%;border-radius:3px;margin:2em 0}

  .booking-panel{background:var(--ink);color:var(--bone);border-radius:6px;padding:32px;position:sticky;top:100px}
  .booking-panel .price-label{font-family:var(--mono);font-size:10px;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(243,239,230,.45);margin-bottom:18px}
  .booking-panel hr{border:none;border-top:1px solid rgba(243,239,230,.12);margin:16px 0}
  .booking-panel .detail-row{display:flex;justify-content:space-between;
    font-family:var(--mono);font-size:11px;letter-spacing:.1em;margin-bottom:12px;
    color:rgba(243,239,230,.6)}
  .booking-panel .detail-row span:last-child{color:var(--bone);text-align:right}

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
  $heroStyle = $cruise->cover_image
    ? 'background-image:linear-gradient(180deg,rgba(8,10,14,.4) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),url("'.asset('storage/'.$cruise->cover_image).'")'
    : 'background:var(--ink)';
@endphp

<section class="page-hero" style="{{ $heroStyle }}">
  <div class="wrap">
    @if($country)<div class="page-eyebrow">{{ $country }}</div>@endif
    <h1 class="page-title">{{ $name }}</h1>
    @if($desc)<p class="page-lead">{{ $desc }}</p>@endif
  </div>
</section>

<main>
  <div class="tour-layout">
    <div class="tour-body">
      {!! sanitizeHtml($body) !!}
    </div>
    <aside class="booking-panel">
      <div class="price-label"><span data-tr>SEYİR BİLGİLERİ</span><span data-en>VOYAGE DETAILS</span></div>
      @if($cruise->ship_name)
      <div class="detail-row">
        <span><span data-tr>Gemi</span><span data-en>Ship</span></span>
        <span>{{ $cruise->ship_name }}</span>
      </div>
      @endif
      @if($cruise->cruise_line)
      <div class="detail-row">
        <span><span data-tr>Gemi Şirketi</span><span data-en>Cruise Line</span></span>
        <span>{{ $cruise->cruise_line }}</span>
      </div>
      @endif
      @if($fromPort || $toPort)
      <div class="detail-row">
        <span><span data-tr>Güzergah</span><span data-en>Route</span></span>
        <span>{{ $fromPort }} → {{ $toPort }}</span>
      </div>
      @endif
      @if($cruise->nights)
      <div class="detail-row">
        <span><span data-tr>Gece Sayısı</span><span data-en>Nights</span></span>
        <span>{{ $cruise->nights }}</span>
      </div>
      @endif
      @if($cruise->departure_date)
      <div class="detail-row">
        <span><span data-tr>Kalkış Tarihi</span><span data-en>Departure</span></span>
        <span>{{ \Carbon\Carbon::parse($cruise->departure_date)->locale($locale)->isoFormat('D MMM YYYY') }}</span>
      </div>
      @endif
      <hr>
      <p style="font-size:11px;color:rgba(243,239,230,.5);line-height:1.6">
        <span data-tr>Bu, tamamlanmış bir seyahatin günlüğüdür — satışa sunulan bir tur değildir.</span>
        <span data-en>This is a log of a completed journey — not a tour for sale.</span>
      </p>
    </aside>
  </div>

  @if($relatedCruises->count())
  <section class="recs">
    <div class="wrap">
      <h2><span data-tr>Diğer Seyirler</span><span data-en>Other Cruises</span></h2>
      <div class="rec-grid">
        @foreach($relatedCruises as $rel)
        <a href="/{{ $locale }}/cruiselog/{{ $rel->slug }}" class="rec">
          <div class="rimg">
            @if($rel->cover_image)
              <img src="{{ asset('storage/'.$rel->cover_image) }}" alt="{{ $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr }}" loading="lazy">
            @endif
          </div>
          <div class="rpd">
            <div class="rcat">{{ $isEn ? ($rel->country_en ?? '') : ($rel->country_tr ?? '') }}</div>
            <h3>{{ $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr }}</h3>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif
</main>
@endsection
