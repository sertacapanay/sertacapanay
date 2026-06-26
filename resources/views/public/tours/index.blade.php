@extends('public.layout')

@section('title', $isEn ? 'Cruise Log — Sertaç Apanay' : 'Seyir Günlükleri — Sertaç Apanay')

@push('styles')
<style>
  .page-hero{position:relative;min-height:56vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center;color:var(--bone);
    background-image:linear-gradient(180deg,rgba(8,10,14,.45) 0%,rgba(8,10,14,.12) 40%,rgba(8,10,14,.62) 100%),
      url('{{ asset("images/cruise-hero.jpg") }}')}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,76px);font-style:italic;font-weight:400;line-height:1.05}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  .filter-bar{display:flex;gap:8px;flex-wrap:wrap;padding:28px 0;border-bottom:1px solid var(--line)}
  .filter-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .filter-btn:hover,.filter-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  .tgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px;padding:48px 0 60px}
  @media(max-width:900px){.tgrid{grid-template-columns:1fr 1fr}}
  @media(max-width:600px){.tgrid{grid-template-columns:1fr}}
  .tcard{position:relative;aspect-ratio:3/4;overflow:hidden;border-radius:4px;background:var(--ink);display:block}
  .tcard img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
  .tcard:hover img{transform:scale(1.05)}
  .tcard .tc-info{position:absolute;inset:0;display:flex;flex-direction:column;justify-content:flex-end;
    padding:28px 24px;
    background:linear-gradient(0deg,rgba(8,10,14,.85) 0%,rgba(8,10,14,.2) 60%,transparent 100%);
    color:var(--bone)}
  .tcard .tc-country{font-family:var(--mono);font-size:10px;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(243,239,230,.55);margin-bottom:6px}
  .tcard .tc-name{font-family:var(--display);font-size:22px;font-style:italic;line-height:1.2}
  .tcard .tc-price{font-size:15px;font-weight:600;color:var(--coral);margin-top:12px}
</style>
@endpush

@section('content')
<section class="page-hero">
  <div class="wrap">
    <div class="page-eyebrow"><span data-tr>DENİZ YOLCULUKLARI</span><span data-en>SEA JOURNEYS</span></div>
    <h1 class="page-title"><span data-tr>Seyir Günlükleri</span><span data-en>Cruise Log</span></h1>
    <p class="page-lead" data-tr>Ufukların ötesine, okyanusların derinliklerine — cruise deneyimleri ve gemi yolculukları.</p>
    <p class="page-lead b" data-en>Beyond the horizons, into the depths of oceans — cruise experiences and sea voyages.</p>
  </div>
</section>

<main class="page">
  <div class="wrap">
    <div class="filter-bar">
      <a href="/{{ $locale }}/tours" class="filter-btn {{ !$selectedCountry ? 'active' : '' }}">
        <span data-tr>Tümü</span><span data-en>All</span>
      </a>
      @foreach($countries as $country)
        <a href="/{{ $locale }}/tours?country={{ urlencode($country) }}"
           class="filter-btn {{ $selectedCountry === $country ? 'active' : '' }}">
          {{ $country }}
        </a>
      @endforeach
    </div>

    <div class="tgrid">
      @foreach($tours as $tour)
      <a href="/{{ $locale }}/tours/{{ $tour->slug }}" class="tcard">
        @if($tour->cover_image)
          <img src="{{ asset('storage/'.$tour->cover_image) }}" alt="{{ $isEn ? $tour->name_en : $tour->name_tr }}">
        @endif
        <div class="tc-info">
          <div class="tc-country">{{ $isEn ? ($tour->country_en ?? '') : ($tour->country_tr ?? '') }}</div>
          <div class="tc-name">{{ $isEn ? $tour->name_en : $tour->name_tr }}</div>
          @if($tour->price ?? false)
            <div class="tc-price">{{ number_format($tour->price) }} ₺</div>
          @endif
        </div>
      </a>
      @endforeach
    </div>

    @if($tours->hasPages())
    <div class="filter-bar" style="justify-content:center;border-top:1px solid var(--line);border-bottom:none;padding-bottom:48px">
      @if(!$tours->onFirstPage())
        <a href="{{ $tours->previousPageUrl() }}" class="filter-btn">← <span data-tr>Önceki</span><span data-en>Prev</span></a>
      @endif
      @if($tours->hasMorePages())
        <a href="{{ $tours->nextPageUrl() }}" class="filter-btn"><span data-tr>Sonraki</span><span data-en>Next</span> →</a>
      @endif
    </div>
    @endif
  </div>
</main>
@endsection
