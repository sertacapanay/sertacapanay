@extends('public.layout')

@section('title', $isEn ? 'Destinations — Sertaç Apanay' : 'Destinasyonlar — Sertaç Apanay')

@push('styles')
<style>
  .page-hero{position:relative;min-height:52vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center;color:var(--bone);
    background-image:linear-gradient(180deg,rgba(8,10,14,.4) 0%,rgba(8,10,14,.12) 42%,rgba(8,10,14,.62) 100%),
      url('{{ asset("images/places-hero.jpg") }}')}
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

  .guide-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2px;padding:2px 0 60px}
  @media(max-width:900px){.guide-grid{grid-template-columns:1fr 1fr}}
  @media(max-width:600px){.guide-grid{grid-template-columns:1fr}}
  .guide{position:relative;aspect-ratio:4/3;overflow:hidden;background:var(--ink);display:block}
  .guide img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
  .guide:hover img{transform:scale(1.06)}
  .guide .ginfo{position:absolute;bottom:0;left:0;right:0;padding:20px 22px;
    background:linear-gradient(0deg,rgba(8,10,14,.8) 0%,transparent 100%);color:var(--bone)}
  .guide .gloc{font-family:var(--mono);font-size:10px;letter-spacing:.2em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:6px}
  .guide .gname{font-family:var(--display);font-size:21px;font-style:italic}
</style>
@endpush

@section('content')
<section class="page-hero">
  <div class="wrap">
    <div class="page-eyebrow"><span data-tr>DÜNYA İNDEKSİ</span><span data-en>THE WORLD INDEX</span></div>
    <h1 class="page-title"><span data-tr>Destinasyonlar</span><span data-en>Destinations</span></h1>
    <p class="page-lead" data-tr>Gezilen her ülke, dolaşılan her şehir — yaşayan bir deneyim kartografyası.</p>
    <p class="page-lead b" data-en>Every country explored, every city wandered — a living cartography of experience.</p>
  </div>
</section>

<main class="page">
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

  <div class="guide-grid">
    @foreach($places as $place)
    <a href="/{{ $locale }}/places/{{ $place->slug }}" class="guide">
      @if($place->cover_image)
        <img src="{{ asset('storage/'.$place->cover_image) }}" alt="{{ $isEn ? $place->name_en : $place->name_tr }}">
      @endif
      <div class="ginfo">
        <div class="gloc">{{ $isEn ? ($place->country_en ?? '') : ($place->country_tr ?? '') }}</div>
        <div class="gname">{{ $isEn ? $place->name_en : $place->name_tr }}</div>
      </div>
    </a>
    @endforeach
  </div>

  @if($places->hasPages())
  <div class="wrap">
    <div class="filter-bar" style="justify-content:center;border-top:1px solid var(--line);border-bottom:none;padding-bottom:48px">
      @if(!$places->onFirstPage())
        <a href="{{ $places->previousPageUrl() }}" class="filter-btn">← <span data-tr>Önceki</span><span data-en>Prev</span></a>
      @endif
      @if($places->hasMorePages())
        <a href="{{ $places->nextPageUrl() }}" class="filter-btn"><span data-tr>Sonraki</span><span data-en>Next</span> →</a>
      @endif
    </div>
  </div>
  @endif
</main>
@endsection
