@extends('public.layout')

@section('title', $isEn ? 'City Guides — Sertaç Apanay' : 'Şehir Rehberleri — Sertaç Apanay')
@section('description', $isEn ? 'In-depth city guides for curious travellers.' : 'Meraklı gezginler için derinlemesine şehir rehberleri.')

@push('styles')
<style>
  .page-hero{position:relative;min-height:52vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center;
    background-image:linear-gradient(180deg,rgba(8,10,14,.45) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),
      url('{{ asset("images/places-hero.jpg") }}');color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,80px);font-style:italic;font-weight:400;line-height:1.05}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  .filter-bar{display:flex;gap:8px;flex-wrap:wrap;padding:28px 0;border-bottom:1px solid var(--line)}
  .filter-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .filter-btn:hover,.filter-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  .guide-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:48px;padding:48px 0 90px}
  @media(max-width:900px){.guide-grid{grid-template-columns:1fr}}

  .guide{display:block;color:inherit}
  .guide .gimg{aspect-ratio:16/10;overflow:hidden;border-radius:4px;margin-bottom:20px;background:var(--bone-2)}
  .guide .gimg img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
  .guide:hover .gimg img{transform:scale(1.04)}
  .guide-head{display:flex;align-items:center;gap:10px;margin-bottom:12px}
  .guide .gloc{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--coral)}
  .guide .gtag{font-family:var(--mono);font-size:9.5px;letter-spacing:.08em;text-transform:uppercase;
    color:var(--muted);border:1px solid var(--line);padding:2px 7px;border-radius:20px}
  .guide h3{font-family:var(--display);font-style:italic;font-weight:500;font-size:26px;
    line-height:1.15;margin:0 0 10px;color:var(--ink);transition:color .2s}
  .guide:hover h3{color:var(--coral)}
  .guide p{margin:0;color:var(--muted);font-size:15px;line-height:1.6}

  .empty-state{padding:80px 0;text-align:center;color:var(--muted);grid-column:1/-1}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}

  .pagination-wrap{display:flex;justify-content:center;gap:8px;padding:0 0 64px;grid-column:1/-1}
  .pagination-wrap a,.pagination-wrap span{font-family:var(--mono);font-size:12px;letter-spacing:.1em;
    padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)}
  .pagination-wrap .active-page{background:var(--ink);color:var(--bone);border-color:var(--ink)}
</style>
@endpush

@section('content')
<section class="page-hero">
  <div class="wrap">
    <div class="page-eyebrow"><span data-tr>ŞEHİR REHBERLERİ</span><span data-en>CITY GUIDES</span></div>
    <h1 class="page-title"><span data-tr>Şehirleri<br>Keşfet</span><span data-en>Discover<br>Cities</span></h1>
    <p class="page-lead" data-tr>Sokakları, lezzetleri ve gizli köşeleriyle şehirlere derinlemesine bir bakış.</p>
    <p class="page-lead b" data-en>A deep look into cities — their streets, flavours and hidden corners.</p>
  </div>
</section>

<main>
  <div class="wrap">
    @if($countries->isNotEmpty())
    <div class="filter-bar">
      <a href="/{{ $locale }}/guides" class="filter-btn {{ !$selectedCountry ? 'active' : '' }}">
        <span data-tr>Tümü</span><span data-en>All</span>
      </a>
      @foreach($countries as $country)
        <a href="/{{ $locale }}/guides?country={{ urlencode($country) }}"
           class="filter-btn {{ $selectedCountry === $country ? 'active' : '' }}">{{ $country }}</a>
      @endforeach
    </div>
    @endif

    <div class="guide-grid">
      @forelse($places as $place)
        @php $title = $isEn ? ($place->title_en ?? $place->title_tr) : $place->title_tr; @endphp
        @php $country = $isEn ? ($place->country_en ?? $place->country_tr) : $place->country_tr; @endphp
        @php $excerpt = $isEn ? ($place->excerpt_en ?? $place->excerpt_tr ?? $place->description_en ?? $place->description_tr) : ($place->excerpt_tr ?? $place->description_tr); @endphp
        <a href="/{{ $locale }}/guides/{{ $place->slug }}" class="guide">
          <div class="gimg">
            @if($place->image)
              <img src="{{ asset('storage/'.$place->image) }}" alt="{{ $title }}">
            @endif
          </div>
          <div class="guide-head">
            @if($country)<span class="gloc">{{ $country }}</span>@endif
          </div>
          <h3>{{ $title }}</h3>
          @if($excerpt)<p>{{ Str::limit($excerpt, 120) }}</p>@endif
        </a>
      @empty
        <div class="empty-state">
          <p data-tr>Henüz rehber eklenmedi</p>
          <p data-tr>Yakında burada şehir rehberleri olacak.</p>
          <p class="b" data-en>No guides yet. City guides coming soon.</p>
        </div>
      @endforelse

      @if($places->hasPages())
      <div class="pagination-wrap">
        @if($places->onFirstPage())<span>←</span>@else<a href="{{ $places->previousPageUrl() }}">←</a>@endif
        @foreach($places->getUrlRange(1, $places->lastPage()) as $page => $url)
          @if($page == $places->currentPage())
            <span class="active-page">{{ $page }}</span>
          @else
            <a href="{{ $url }}">{{ $page }}</a>
          @endif
        @endforeach
        @if($places->hasMorePages())<a href="{{ $places->nextPageUrl() }}">→</a>@else<span>→</span>@endif
      </div>
      @endif
    </div>
  </div>
</main>
@endsection
