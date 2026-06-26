@extends('public.layout')

@section('title', $isEn ? 'Destinations — Sertaç Apanay' : 'Destinasyonlar — Sertaç Apanay')
@section('description', $isEn ? 'Every country explored, every city wandered — a living cartography of experience.' : 'Gezilen her ülke, dolaşılan her şehir — yaşayan bir deneyim kartografyası.')

@push('styles')
<style>
  /* Hero */
  .hero{position:relative;min-height:78vh;display:flex;align-items:flex-end;
    padding:140px 0 70px;color:var(--bone);overflow:hidden}
  .hero-bg{position:absolute;inset:0;background:url('{{ asset("images/places-hero.jpg") }}') center/cover no-repeat}
  .hero-bg::after{content:'';position:absolute;inset:0;
    background:linear-gradient(180deg,rgba(8,10,14,.25) 0%,rgba(8,10,14,.1) 40%,rgba(8,10,14,.72) 100%)}
  .hero .wrap{position:relative;z-index:1;width:100%;max-width:100%;margin:0;padding-left:44px}
  .hero-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .hero h1{font-family:var(--display);font-size:clamp(54px,9vw,116px);font-style:italic;
    font-weight:500;line-height:.92;margin:0 0 18px}
  .hero-lead{font-size:16px;color:rgba(243,239,230,.75);max-width:540px;line-height:1.6}

  /* Filter */
  .filter-section{border-bottom:1px solid var(--line);background:var(--paper)}
  .filter-bar{display:flex;gap:6px;flex-wrap:wrap;padding:22px 0}
  .filter-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .filter-btn:hover,.filter-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  /* Country grid */
  .country-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:3px;padding:3px 0 0}
  @media(max-width:900px){.country-grid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:580px){.country-grid{grid-template-columns:1fr}}

  .c-card{position:relative;aspect-ratio:4/3;overflow:hidden;background:var(--ink);display:block;color:var(--bone)}
  .c-card-img{position:absolute;inset:0;background:center/cover no-repeat;transition:transform .7s}
  .c-card::after{content:'';position:absolute;inset:0;
    background:linear-gradient(0deg,rgba(8,10,14,.82) 0%,rgba(8,10,14,.1) 60%,transparent 100%)}
  .c-card:hover .c-card-img{transform:scale(1.06)}
  .c-body{position:absolute;bottom:0;left:0;right:0;padding:22px 24px;z-index:1}
  .c-badge{font-family:var(--mono);font-size:10px;letter-spacing:.2em;text-transform:uppercase;
    color:rgba(243,239,230,.5);margin-bottom:6px}
  .c-name{font-family:var(--display);font-size:clamp(22px,3vw,36px);font-style:italic;
    font-weight:500;line-height:1.05;margin:0 0 6px}
  .c-tag{font-size:13px;color:rgba(243,239,230,.6);line-height:1.4}

  /* Cities section */
  .cities-sec{padding:48px 0 72px;border-top:3px solid var(--ink)}
  .cities-head{margin-bottom:28px}
  .cities-head h2{font-family:var(--display);font-style:italic;font-size:clamp(26px,3.5vw,42px);
    font-weight:500;margin:0}
  .cities-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:2px}
  @media(max-width:1000px){.cities-grid{grid-template-columns:repeat(4,1fr)}}
  @media(max-width:680px){.cities-grid{grid-template-columns:repeat(3,1fr)}}
  @media(max-width:440px){.cities-grid{grid-template-columns:repeat(2,1fr)}}
  .city-card{display:block;padding:18px 4px;border-top:1px solid var(--line);
    transition:background .15s;color:inherit}
  .city-card:hover{background:var(--paper)}
  .city-code{font-family:var(--mono);font-size:10.5px;letter-spacing:.18em;text-transform:uppercase;
    color:var(--coral);margin-bottom:6px}
  .city-name{font-family:var(--display);font-style:italic;font-size:18px;line-height:1.1;color:var(--ink)}

  .empty-state{padding:80px 0;text-align:center;color:var(--muted);grid-column:1/-1}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}

  .pagination-wrap{display:flex;justify-content:center;gap:8px;padding:40px 0 64px}
  .pagination-wrap a,.pagination-wrap span{font-family:var(--mono);font-size:12px;letter-spacing:.1em;
    padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)}
  .pagination-wrap .active-page{background:var(--ink);color:var(--bone);border-color:var(--ink)}
</style>
@endpush

@section('content')

<section class="hero">
  <div class="hero-bg"></div>
  <div class="wrap">
    <div class="hero-eyebrow"><span data-tr>DÜNYA İNDEKSİ</span><span data-en>THE WORLD INDEX</span></div>
    <h1><span data-tr>Destinasyonlar</span><span data-en>Destinations</span></h1>
    <p class="hero-lead" data-tr>Gezilen her ülke, dolaşılan her şehir — yaşayan bir deneyim kartografyası.</p>
    <p class="hero-lead b" data-en>Every country explored, every city wandered — a living cartography of experience.</p>
  </div>
</section>

<div class="filter-section">
  <div class="wrap">
    <div class="filter-bar">
      <a href="/{{ $locale }}/places" class="filter-btn {{ !$selectedCountry ? 'active' : '' }}">
        <span data-tr>Tümü</span><span data-en>All</span>
      </a>
      @foreach($countries as $country)
        <a href="/{{ $locale }}/places?country={{ urlencode($country) }}"
           class="filter-btn {{ $selectedCountry === $country ? 'active' : '' }}">
          {{ $country }}
        </a>
      @endforeach
    </div>
  </div>
</div>

<div class="wrap">
  <div class="country-grid">
    @forelse($places as $place)
      @php
        $pname   = $isEn ? ($place->title_en ?? $place->title_tr) : $place->title_tr;
        $country = $isEn ? ($place->country_en ?? $place->country_tr) : $place->country_tr;
        $excerpt = $isEn ? ($place->excerpt_en ?? $place->excerpt_tr ?? '') : ($place->excerpt_tr ?? '');
        $imgUrl  = $place->image ? asset('storage/'.$place->image) : asset('images/places-hero.jpg');
      @endphp
      <a href="/{{ $locale }}/places/{{ $place->slug }}" class="c-card">
        <div class="c-card-img" style="background-image:url('{{ $imgUrl }}')"></div>
        <div class="c-body">
          @if($country)<div class="c-badge">{{ $country }}</div>@endif
          <div class="c-name">{{ $pname }}</div>
          @if($excerpt)<div class="c-tag">{{ Str::limit($excerpt, 80) }}</div>@endif
        </div>
      </a>
    @empty
      {{-- Placeholder when DB is empty --}}
      @foreach([
        ['name'=>'Japonya','country'=>'ASYA','desc'=>'Gelenekle modernitenin buluştuğu yer'],
        ['name'=>'Peru','country'=>'G. AMERİKA','desc'=>'Kayıp uygarlıkların izinde Andes\'te'],
        ['name'=>'Ürdün','country'=>'ORTA DOĞU','desc'=>'Petra\'dan Vadi Rum\'a çöl masalı'],
        ['name'=>'İtalya','country'=>'AVRUPA','desc'=>'Roma\'dan Sicilya\'ya tarihin dokusu'],
        ['name'=>'Fas','country'=>'AFRİKA','desc'=>'Medine sokaklarında renk cümbüşü'],
        ['name'=>'Yeni Zelanda','country'=>'OKYANUSYA','desc'=>'Shire\'dan fiyortlara uçsuz yollar'],
      ] as $ph)
      <div class="c-card" style="cursor:default">
        <div class="c-card-img" style="background:var(--ink)"></div>
        <div class="c-body">
          <div class="c-badge">{{ $ph['country'] }}</div>
          <div class="c-name">{{ $ph['name'] }}</div>
          <div class="c-tag">{{ $ph['desc'] }}</div>
        </div>
      </div>
      @endforeach
    @endforelse
  </div>
</div>

@if($places->hasPages())
<div class="wrap">
  <div class="pagination-wrap">
    @if($places->onFirstPage())<span>←</span>@else<a href="{{ $places->previousPageUrl() }}">←</a>@endif
    @foreach($places->getUrlRange(1, $places->lastPage()) as $page => $url)
      @if($page == $places->currentPage())<span class="active-page">{{ $page }}</span>
      @else<a href="{{ $url }}">{{ $page }}</a>@endif
    @endforeach
    @if($places->hasMorePages())<a href="{{ $places->nextPageUrl() }}">→</a>@else<span>→</span>@endif
  </div>
</div>
@endif

@if($places->isNotEmpty())
<section class="cities-sec">
  <div class="wrap">
    <div class="cities-head">
      <h2><span data-tr>Şehirler</span><span data-en>Cities</span></h2>
    </div>
    <div class="cities-grid">
      @foreach($places->take(12) as $place)
        @php $pname = $isEn ? ($place->title_en ?? $place->title_tr) : $place->title_tr; @endphp
        @php $code  = strtoupper(Str::limit(preg_replace('/[^a-zA-Z]/','',$pname),3,''));  @endphp
        <a href="/{{ $locale }}/places/{{ $place->slug }}" class="city-card">
          <div class="city-code">{{ $code }}</div>
          <div class="city-name">{{ $pname }}</div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
