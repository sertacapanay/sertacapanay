@extends('public.layout')

@section('title', $isEn ? 'Tours — Sertaç Apanay' : 'Turlar — Sertaç Apanay')
@section('description', $isEn ? 'This year\'s guided tours and group journeys.' : 'Bu yılki rehberli turlar ve grup yolculukları.')
@if($tours->isEmpty())
@section('robots', 'noindex, follow')
@endif

@push('styles')
<style>
  .page-hero{position:relative;min-height:44vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background:var(--ink);color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,76px);font-style:italic;font-weight:400;line-height:1.05}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:560px;line-height:1.6}

  .notice-strip{background:var(--bone-2);border-bottom:1px solid var(--line);padding:16px 0}
  .notice-strip .wrap{font-size:13.5px;color:var(--muted);line-height:1.6}
  .notice-strip strong{color:var(--ink)}

  .sec{padding:48px 0 90px}
  .tgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
  @media(max-width:1000px){.tgrid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:680px){.tgrid{grid-template-columns:1fr}}

  .tcard{display:block;border:1px solid var(--line);border-radius:5px;overflow:hidden;
    background:var(--paper);text-decoration:none;color:inherit;transition:box-shadow .2s}
  .tcard:hover{box-shadow:0 6px 22px rgba(8,10,14,.1)}
  .tcard .timg{aspect-ratio:4/3;overflow:hidden;background:var(--bone-2);position:relative}
  .tcard .timg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .tcard:hover .timg img{transform:scale(1.04)}
  .tbadge{position:absolute;top:14px;left:14px;background:var(--coral);color:#fff;
    font-family:var(--mono);font-size:10px;letter-spacing:.14em;text-transform:uppercase;
    padding:5px 10px;border-radius:2px}
  .tbody{padding:20px 22px}
  .tcat{font-family:var(--mono);font-size:10.5px;letter-spacing:.16em;text-transform:uppercase;color:var(--coral);margin-bottom:8px}
  .tcard h3{font-family:var(--display);font-size:22px;font-style:italic;margin-bottom:8px;color:var(--ink)}
  .texc{font-size:14px;color:var(--muted);line-height:1.6;margin-bottom:14px}
  .tmeta{display:flex;justify-content:space-between;align-items:center;font-family:var(--mono);
    font-size:11.5px;color:var(--muted);border-top:1px solid var(--line);padding-top:14px}
  .tmeta .price{color:var(--ink);font-family:var(--ui);font-size:15px;font-weight:600}

  .empty-state{padding:80px 0;text-align:center;color:var(--muted)}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}

  .filters{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:32px}
  .filters a{font-family:var(--mono);font-size:11.5px;letter-spacing:.08em;text-transform:uppercase;
    padding:8px 16px;border:1px solid var(--line);border-radius:20px;color:var(--muted);text-decoration:none}
  .filters a.active,.filters a:hover{background:var(--ink);color:var(--bone);border-color:var(--ink)}
</style>
@endpush

@section('content')
<section class="page-hero">
  <div class="wrap">
    <div class="page-eyebrow"><span data-tr>BU YILKİ PROGRAM</span><span data-en>THIS YEAR'S PROGRAM</span></div>
    <h1 class="page-title"><span data-tr>Turlar</span><span data-en>Tours</span></h1>
    <p class="page-lead" data-tr>Bu yıl düzenlediğim rehberli turlar ve grup yolculukları.</p>
    <p class="page-lead b" data-en>This year's guided tours and group journeys.</p>
  </div>
</section>

<section class="notice-strip">
  <div class="wrap">
    <span data-tr>Turların satışı ve rezervasyonu, iş ortağımız <strong>Gezi Kolay</strong> üzerinden yapılmaktadır. Detaylar ve rezervasyon için ilgili tura tıklayın.</span>
    <span data-en>Tour sales and bookings are processed through our partner agency <strong>Gezi Kolay</strong>. Click a tour for details and booking.</span>
  </div>
</section>

<section class="sec">
  <div class="wrap">

    @if($countries->count() > 1)
    <div class="filters">
      <a href="/{{ $locale }}/tours" class="{{ !$selectedCountry ? 'active' : '' }}"><span data-tr>Tümü</span><span data-en>All</span></a>
      @foreach($countries as $c)
        <a href="/{{ $locale }}/tours?country={{ urlencode($c) }}" class="{{ $selectedCountry === $c ? 'active' : '' }}">{{ $c }}</a>
      @endforeach
    </div>
    @endif

    @if($tours->isEmpty())
      <div class="empty-state">
        <p data-tr>Şu anda listelenen tur yok</p>
        <p class="b" data-en>No tours listed right now</p>
      </div>
    @else
      <div class="tgrid">
        @foreach($tours as $tour)
          @php
            $tname  = $isEn ? ($tour->title_en ?? $tour->title_tr) : $tour->title_tr;
            $texc   = $isEn ? ($tour->short_description_en ?? '') : ($tour->short_description_tr ?? '');
            $tregion = $isEn ? ($tour->region_en ?? $tour->country_en ?? '') : ($tour->region_tr ?? $tour->country_tr ?? '');
            $isUpcoming = $tour->start_date && \Carbon\Carbon::parse($tour->start_date)->isFuture();
          @endphp
          <a href="/{{ $locale }}/tours/{{ $tour->slug }}" class="tcard">
            <div class="timg">
              @if($tour->cover_image)
                <img src="{{ asset('storage/'.$tour->cover_image) }}" alt="{{ $tname }}" loading="lazy">
              @endif
              @if($tour->is_featured)
                <span class="tbadge"><span data-tr>Öne Çıkan</span><span data-en>Featured</span></span>
              @elseif($isUpcoming)
                <span class="tbadge"><span data-tr>Yaklaşan</span><span data-en>Upcoming</span></span>
              @endif
            </div>
            <div class="tbody">
              @if($tregion)<div class="tcat">{{ $tregion }}</div>@endif
              <h3>{{ $tname }}</h3>
              @if($texc)<p class="texc">{{ Str::limit($texc, 90) }}</p>@endif
              <div class="tmeta">
                <span>
                  @if($tour->duration_days){{ $tour->duration_days }} <span data-tr>gün</span><span data-en>days</span>@endif
                  @if($tour->start_date)
                    &nbsp;·&nbsp;{{ \Carbon\Carbon::parse($tour->start_date)->locale($locale)->isoFormat('D MMM YYYY') }}
                  @endif
                </span>
                @if($tour->price)
                  <span class="price">{{ number_format($tour->price) }} {{ $tour->currency }}</span>
                @endif
              </div>
            </div>
          </a>
        @endforeach
      </div>
    @endif

    @if($tours->hasPages())
    <div style="display:flex;justify-content:center;gap:8px;padding:40px 0;font-family:var(--mono);font-size:12px">
      @if($tours->onFirstPage())<span style="padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--muted)">←</span>
      @else<a href="{{ $tours->previousPageUrl() }}" style="padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)">←</a>@endif
      @if($tours->hasMorePages())<a href="{{ $tours->nextPageUrl() }}" style="padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)">→</a>
      @else<span style="padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--muted)">→</span>@endif
    </div>
    @endif
  </div>
</section>
@endsection
