@extends('public.layout')

@php
  $title   = $isEn ? ($place->title_en ?? $place->title_tr) : $place->title_tr;
  $country = $isEn ? ($place->country_en ?? $place->country_tr) : $place->country_tr;
  $body    = $isEn ? ($place->description_en ?? $place->description_tr) : $place->description_tr;
  $excerpt = $isEn ? ($place->excerpt_en ?? $place->excerpt_tr ?? '') : ($place->excerpt_tr ?? '');
@endphp

@section('title', $title.' — Şehir Rehberi — Sertaç Apanay')
@section('description', Str::limit(strip_tags($excerpt ?: $body), 155))

@push('styles')
<style>
  /* Article layout — no hero, pure content */
  .article{max-width:760px;margin:0 auto;padding:80px 44px 80px}
  .back{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--muted);display:inline-block;margin-bottom:32px;transition:color .2s}
  .back:hover{color:var(--coral)}
  .ameta{font-family:var(--mono);font-size:11px;letter-spacing:.12em;color:var(--coral);
    text-transform:uppercase;margin-bottom:20px;display:flex;align-items:center;flex-wrap:wrap;gap:0}
  .ameta .dot{color:var(--muted);margin:0 10px}
  .article h1{font-family:var(--display);font-style:italic;font-size:clamp(34px,5vw,56px);
    font-weight:500;line-height:1.05;margin:0 0 20px;color:var(--ink)}
  .lede{font-size:19px;color:var(--muted);line-height:1.7;margin:0 0 36px}
  .ahero{aspect-ratio:16/9;border-radius:4px;overflow:hidden;background:var(--bone-2);margin:0 0 48px}
  .ahero img{width:100%;height:100%;object-fit:cover}
  .article-body p{font-size:16.5px;line-height:1.85;color:var(--muted);margin:0 0 20px}
  .article-body h2{font-family:var(--display);font-style:italic;font-size:28px;
    font-weight:500;color:var(--ink);margin:2.4em 0 .8em}
  .article-body h3{font-family:var(--display);font-style:italic;font-size:22px;
    font-weight:500;color:var(--ink);margin:2em 0 .6em}
  .atags{display:flex;gap:8px;flex-wrap:wrap;margin-top:48px;padding-top:32px;border-top:1px solid var(--line)}
  .gtag{font-family:var(--mono);font-size:10px;letter-spacing:.16em;text-transform:uppercase;
    padding:5px 14px;border:1px solid var(--line);border-radius:20px;color:var(--muted)}

  /* Recommendations section */
  .recs{max-width:760px;margin:0 auto;padding:0 44px 80px}
  .recs h2{font-family:var(--display);font-style:italic;font-size:28px;
    font-weight:500;margin:0 0 28px;color:var(--ink);border-top:1px solid var(--line);padding-top:40px}
  .rec{display:flex;gap:20px;margin-bottom:22px;padding-bottom:22px;border-bottom:1px solid var(--line)}
  .rec:last-child{border-bottom:0}
  .rcat{font-family:var(--mono);font-size:10px;letter-spacing:.16em;text-transform:uppercase;
    color:var(--coral);min-width:80px;margin-top:3px;flex-shrink:0}
  .rec h3{font-family:var(--display);font-style:italic;font-size:21px;
    font-weight:500;margin:0 0 6px;color:var(--ink)}
  .rec p{font-size:14.5px;color:var(--muted);line-height:1.6;margin:0}

  /* Related guides */
  .guide-related{background:var(--bone-2);padding:56px 0;border-top:1px solid var(--line)}
  .guide-related h2{font-family:var(--display);font-style:italic;font-size:32px;margin:0 0 32px;color:var(--ink)}
  .rel-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
  .rel-card{display:block;color:inherit}
  .rel-card .ri{aspect-ratio:16/10;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:14px}
  .rel-card .ri img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .rel-card:hover .ri img{transform:scale(1.04)}
  .rel-card .gloc{font-family:var(--mono);font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:var(--coral);margin-bottom:6px}
  .rel-card h3{font-family:var(--display);font-style:italic;font-size:20px;line-height:1.1;margin:0;color:var(--ink);transition:color .2s}
  .rel-card:hover h3{color:var(--coral)}
  @media(max-width:700px){.rel-grid{grid-template-columns:1fr}}
  @media(max-width:640px){.article,.recs{padding-left:22px;padding-right:22px}}
</style>
@endpush

@section('content')
<main class="page">
  <div class="wrap">
    <article class="article">
      <a href="/{{ $locale }}/guides" class="back">← <span data-tr>Tüm Rehberler</span><span data-en>All Guides</span></a>

      <div class="ameta">
        @if($country)<span data-tr>ŞEHİR REHBERİ</span><span data-en>CITY GUIDE</span>@endif
        @if($country)<span class="dot">·</span>{{ $country }}@endif
      </div>

      <h1>{{ $title }}</h1>

      @if($excerpt)
        <p class="lede">{{ $excerpt }}</p>
      @endif

      @if($place->image)
        <div class="ahero">
          <img src="{{ asset('storage/'.$place->image) }}" alt="{{ $title }}">
        </div>
      @endif

      @if($body)
        <div class="article-body">
          {!! nl2br(e($body)) !!}
        </div>
      @endif

      @if(!empty($place->tags))
        <div class="atags">
          @foreach(explode(',', $place->tags) as $tag)
            @if(trim($tag))
              <span class="gtag">{{ trim($tag) }}</span>
            @endif
          @endforeach
        </div>
      @endif
    </article>
  </div>

  {{-- Recommendations: use highlights / tips if available, else show categories from related --}}
  <div class="wrap">
    <div class="recs">
      <h2 data-tr>En İyi Öneriler</h2>
      <h2 class="b" data-en>Top Recommendations</h2>

      @if(!empty($place->highlights))
        @foreach($place->highlights as $i => $h)
          <div class="rec">
            <div class="rcat">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
            <div>
              <h3>{{ $h['title'] ?? '' }}</h3>
              @if(!empty($h['desc']))<p>{{ $h['desc'] }}</p>@endif
            </div>
          </div>
        @endforeach
      @elseif($related->isNotEmpty())
        @foreach($related->take(4) as $i => $rel)
          @php $rt = $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr; @endphp
          @php $re = $isEn ? ($rel->excerpt_en ?? $rel->excerpt_tr ?? '') : ($rel->excerpt_tr ?? ''); @endphp
          <div class="rec">
            <div class="rcat">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
            <div>
              <h3><a href="/{{ $locale }}/guides/{{ $rel->slug }}" style="color:inherit">{{ $rt }}</a></h3>
              @if($re)<p>{{ Str::limit($re, 120) }}</p>@endif
            </div>
          </div>
        @endforeach
      @else
        {{-- Placeholder recs --}}
        @foreach([
          ['cat'=>'01','title'=>'Tarihi Merkez','desc'=>'Şehrin kalbinde yüzyıllık sokaklar ve yapılar.'],
          ['cat'=>'02','title'=>'Yerel Lezzetler','desc'=>'Mutlaka denenmesi gereken yerel yemek ve içecekler.'],
          ['cat'=>'03','title'=>'Kültürel Mekânlar','desc'=>'Müzeler, galeriler ve sanat alanları.'],
        ] as $ph)
          <div class="rec">
            <div class="rcat">{{ $ph['cat'] }}</div>
            <div>
              <h3>{{ $ph['title'] }}</h3>
              <p>{{ $ph['desc'] }}</p>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</main>

@if($related->isNotEmpty())
<section class="guide-related">
  <div class="wrap">
    <h2 data-tr>Diğer Rehberler</h2>
    <h2 class="b" data-en>More Guides</h2>
    <div class="rel-grid">
      @foreach($related as $rel)
        @php $rt = $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr; @endphp
        @php $rc = $isEn ? ($rel->country_en ?? $rel->country_tr) : $rel->country_tr; @endphp
        <a href="/{{ $locale }}/guides/{{ $rel->slug }}" class="rel-card">
          <div class="ri">
            @if($rel->image)<img src="{{ asset('storage/'.$rel->image) }}" alt="{{ $rt }}">@endif
          </div>
          @if($rc)<div class="gloc">{{ $rc }}</div>@endif
          <h3>{{ $rt }}</h3>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
