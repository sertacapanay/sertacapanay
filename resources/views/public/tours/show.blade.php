@extends('public.layout')

@section('title', ($isEn ? $tour->name_en : $tour->name_tr) . ' — Sertaç Apanay')
@section('description', $isEn ? ($tour->short_description_en ?? '') : ($tour->short_description_tr ?? ''))

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
  .btn-wa{display:flex;align-items:center;justify-content:center;gap:10px;
    background:#25d366;color:#fff;font-weight:600;font-size:14px;
    padding:14px 24px;border-radius:4px;margin-top:24px;transition:.2s}
  .btn-wa:hover{background:#20ba5a}

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
  $name = $isEn ? $tour->name_en : $tour->name_tr;
  $country = $isEn ? ($tour->country_en ?? '') : ($tour->country_tr ?? '');
  $desc = $isEn ? ($tour->short_description_en ?? '') : ($tour->short_description_tr ?? '');
  $body = $isEn ? ($tour->body_en ?? '') : ($tour->body_tr ?? '');
  $heroStyle = $tour->cover_image
    ? 'background-image:linear-gradient(180deg,rgba(8,10,14,.4) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),url("'.asset('storage/'.$tour->cover_image).'")'
    : 'background:var(--ink)';
@endphp

<section class="page-hero" style="{{ $heroStyle }}">
  <div class="wrap">
    @if($country)<div class="page-eyebrow">{{ $country }}</div>@endif
    <h1 class="page-title">{{ $name }}</h1>
    @if($desc)<p class="page-lead">{{ $desc }}</p>@endif
    <div class="tour-meta">
      @if($tour->duration ?? false)
        <span><span data-tr>Süre:</span><span data-en>Duration:</span> <strong>{{ $tour->duration }}</strong></span>
      @endif
      @if($tour->price ?? false)
        <span><span data-tr>Fiyat:</span><span data-en>Price:</span> <strong>{{ number_format($tour->price) }} ₺</strong></span>
      @endif
    </div>
  </div>
</section>

<main>
  <div class="tour-layout">
    <div class="tour-body">
      {!! nl2br(e($body)) !!}
    </div>
    <aside class="booking-panel">
      @if($tour->price ?? false)
        <div class="price">{{ number_format($tour->price) }} ₺</div>
        <div class="price-label"><span data-tr>kişi başına</span><span data-en>per person</span></div>
      @endif
      <hr>
      @if($tour->duration ?? false)
      <div class="detail-row">
        <span><span data-tr>Süre</span><span data-en>Duration</span></span>
        <span>{{ $tour->duration }}</span>
      </div>
      @endif
      @if($country)
      <div class="detail-row">
        <span><span data-tr>Güzergah</span><span data-en>Route</span></span>
        <span>{{ $country }}</span>
      </div>
      @endif
      <hr>
      <a class="btn-wa"
         href="https://wa.me/905000000000?text={{ urlencode(($isEn ? 'I am interested in: ' : 'Hakkında bilgi almak istiyorum: ').$name) }}"
         target="_blank" rel="noopener">
        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        WhatsApp
      </a>
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
  {{-- ── İçerik altı widget'lar ── --}}
  @foreach(\App\Models\Widget::forPosition('content_bottom', 'tours') as $widget)
    <section class="wrap" style="padding:40px 0">
      <x-widget :widget="$widget" />
    </section>
  @endforeach
</main>
@endsection
