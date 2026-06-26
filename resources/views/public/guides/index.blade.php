@extends('public.layout')

@section('title', $isEn ? 'City Guides — Sertaç Apanay' : 'Şehir Rehberleri — Sertaç Apanay')
@section('description', $isEn ? 'Deep-dive explorations into the world\'s most compelling destinations.' : 'Dünyanın en etkileyici destinasyonlarına derinlemesine yolculuklar.')

@push('styles')
<style>
  /* PAGE HERO */
  .page-hero{
    position:relative;min-height:56vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center 40%;
    background-image:linear-gradient(180deg,rgba(8,10,14,.45) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),
      url('{{ asset("images/guide-hero.jpg") }}');
    color:var(--bone)
  }
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px;display:block}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,80px);font-style:italic;font-weight:400;line-height:1.05}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  /* FILTER */
  .filter-bar{display:flex;gap:8px;flex-wrap:wrap;padding:28px 0;border-bottom:1px solid var(--line)}
  .filter-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .filter-btn:hover,.filter-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  /* GUIDE GRID */
  .guide-section{padding:48px 0 90px}
  .guide-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:48px}
  @media(max-width:900px){.guide-grid{grid-template-columns:1fr}}

  .guide{display:block;color:inherit;text-decoration:none}
  .guide .gimg{aspect-ratio:16/10;overflow:hidden;border-radius:4px;margin-bottom:20px;background:var(--bone-2)}
  .guide .gimg img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
  .guide:hover .gimg img{transform:scale(1.04)}
  .guide .gloc{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--coral);margin-bottom:12px;display:flex;align-items:center;flex-wrap:wrap;gap:6px}
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

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="wrap">
    <span class="page-eyebrow"><span data-tr>SAHA NOTLARI</span><span data-en>FIELD NOTES</span></span>
    <h1 class="page-title"><span data-tr>Şehir Rehberleri</span><span data-en>City Guides</span></h1>
    <p class="page-lead" data-tr>Dünyanın en etkileyici destinasyonlarına derinlemesine yolculuklar.</p>
    <p class="page-lead b" data-en>Deep-dive explorations into the world's most compelling destinations.</p>
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

    <div class="guide-section">
      <div class="guide-grid">
        @forelse($places as $place)
          @php
            $title   = $isEn ? ($place->title_en ?? $place->title_tr) : $place->title_tr;
            $country = $isEn ? ($place->country_en ?? $place->country_tr) : $place->country_tr;
            $excerpt = $isEn ? ($place->excerpt_en ?? $place->excerpt_tr ?? $place->description_en ?? $place->description_tr)
                             : ($place->excerpt_tr ?? $place->description_tr);
          @endphp
          <a href="/{{ $locale }}/guides/{{ $place->slug }}" class="guide">
            <div class="gimg">
              @if($place->image)
                <img src="{{ asset('storage/'.$place->image) }}" alt="{{ $title }}" loading="lazy">
              @endif
            </div>
            <div class="gloc">
              @if($country)<span>{{ $country }}</span>@endif
            </div>
            <h3>{{ $title }}</h3>
            @if($excerpt)<p>{{ Str::limit($excerpt, 160) }}</p>@endif
          </a>
        @empty
          {{-- Static placeholders when DB is empty --}}
          @php
            $kyotoImg     = asset('images/kyoto.jpg');
            $marrakechImg = asset('images/marrakech.jpg');
          @endphp
          @foreach([
            [
              'img'      => $marrakechImg,
              'loc_tr'   => 'Marakeş, Fas',
              'loc_en'   => 'Marrakech, Morocco',
              'tags_tr'  => ['ekonomik','kültür'],
              'tags_en'  => ['budget','culture'],
              'title_tr' => 'Medina\'da Kaybolmak: Bir Marakeş Rehberi',
              'title_en' => 'Lost in the Medina: A Marrakech Guide',
              'desc_tr'  => 'Marakeş, sanata dönüşmüş düzenli bir kaostur. Medina seni şaşırtır, zorlar ve sonunda dünyanın en canlı duyusal deneyimlerinden bazılarıyla ödüllendirir.',
              'desc_en'  => 'Marrakech is organized chaos elevated to an art form. The medina will disorient you, challenge you, and ultimately reward you with some of the most vivid sensory experiences on Earth.',
            ],
            [
              'img'      => $kyotoImg,
              'loc_tr'   => 'Kyoto, Japonya',
              'loc_en'   => 'Kyoto, Japan',
              'tags_tr'  => ['orta segment','kültür'],
              'tags_en'  => ['mid-range','culture'],
              'title_tr' => 'Kyoto\'da Sessizliğin Sanatı',
              'title_en' => 'The Art of Stillness in Kyoto',
              'desc_tr'  => 'Kyoto fethedilen değil, teslim olunan bir şehirdir. Altın tapınakların ve bambu korularının ötesinde; sabrı, sessizliği ve en küçük ayrıntılara özeni ödüllendiren bir yaşam felsefesi yatar.',
              'desc_en'  => 'Kyoto is not a city you conquer — it\'s one you surrender to. Beyond the golden pavilions and bamboo groves lies a philosophy of living that rewards patience, silence, and attention to the smallest details.',
            ],
          ] as $g)
          <div class="guide">
            <div class="gimg">
              <img src="{{ $g['img'] }}" alt="" loading="lazy">
            </div>
            <div class="gloc">
              <span data-tr>{{ $g['loc_tr'] }}</span>
              <span class="b" data-en>{{ $g['loc_en'] }}</span>
              @foreach($g['tags_tr'] as $i => $tag)
                <span class="gtag" data-tr>{{ $tag }}</span>
              @endforeach
              @foreach($g['tags_en'] as $i => $tag)
                <span class="gtag b" data-en>{{ $tag }}</span>
              @endforeach
            </div>
            <h3>
              <span data-tr>{{ $g['title_tr'] }}</span>
              <span class="b" data-en>{{ $g['title_en'] }}</span>
            </h3>
            <p>
              <span data-tr>{{ $g['desc_tr'] }}</span>
              <span class="b" data-en>{{ $g['desc_en'] }}</span>
            </p>
          </div>
          @endforeach
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

  </div>
</main>
@endsection
