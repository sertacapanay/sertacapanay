@extends('public.layout')

@section('title', $isEn ? 'Sertaç Apanay | Travel Storyteller' : 'Sertaç Apanay | Kültürel Anlatıcı')
@section('description', $isEn
  ? 'Travel companion & cultural storyteller. Discovering the world\'s stories from Europe to the Far East.'
  : 'Yol arkadaşı ve kültürel anlatıcı. Avrupa\'dan Uzak Doğu\'ya dünyanın hikâyelerini birlikte keşfediyoruz.')

@push('styles')
<style>
  /* ── Ana Sayfa Hero ── */
  .hero{position:relative;min-height:94vh;display:flex;align-items:center;color:var(--bone);overflow:hidden}
  .hero::before{content:"";position:absolute;inset:0;z-index:0;
    background:linear-gradient(90deg,rgba(8,10,14,.55) 0%,rgba(8,10,14,.22) 42%,rgba(8,10,14,0) 68%),
               linear-gradient(180deg,rgba(8,10,14,.5) 0%,rgba(8,10,14,0) 24%,rgba(8,10,14,0) 66%,rgba(8,10,14,.45) 100%);
    background-size:cover;background-position:center 42%}
  .hero-bg-img{position:absolute;inset:0;z-index:-1;object-fit:cover;width:100%;height:100%}
  .hero .wrap{position:relative;z-index:2;padding:96px 44px;width:100%;max-width:100%;margin:0}
  .roleline{font-family:var(--mono);font-size:11px;letter-spacing:.28em;text-transform:uppercase;
    color:rgba(243,239,230,.6);margin-bottom:18px}
  .roles{display:flex;gap:18px;flex-wrap:wrap;margin-top:12px}
  .role3{font-family:var(--mono);font-size:10px;letter-spacing:.2em;text-transform:uppercase;
    color:rgba(243,239,230,.45);border:1px solid rgba(243,239,230,.2);padding:5px 14px;border-radius:20px;background:transparent}
  .hero h1{font-family:var(--display);font-size:clamp(46px,7vw,90px);font-weight:400;
    line-height:1.04;letter-spacing:-.01em;margin:20px 0 28px;max-width:740px}
  .hero-cta{display:flex;gap:14px;flex-wrap:wrap;margin-top:32px}
  .scroll-explore{position:absolute;bottom:36px;left:50%;transform:translateX(-50%);
    font-family:var(--mono);font-size:10px;letter-spacing:.22em;text-transform:uppercase;
    color:rgba(243,239,230,.4);display:flex;flex-direction:column;align-items:center;gap:8px}
  .scroll-explore::after{content:"";width:1px;height:32px;background:rgba(243,239,230,.25)}

  /* ── Destinasyonlar section ── */
  .dest-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2px;margin-top:2px}
  @media(max-width:768px){.dest-grid{grid-template-columns:1fr 1fr}}
  .dest-card{position:relative;aspect-ratio:4/3;overflow:hidden;background:var(--ink)}
  .dest-card img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
  .dest-card:hover img{transform:scale(1.06)}
  .dest-card .dc-info{position:absolute;bottom:0;left:0;right:0;padding:20px 22px;
    background:linear-gradient(0deg,rgba(8,10,14,.75) 0%,transparent 100%);color:var(--bone)}
  .dest-card .dc-name{font-family:var(--display);font-size:20px;font-style:italic}
  .dest-card .dc-country{font-family:var(--mono);font-size:10px;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(243,239,230,.6);margin-top:4px}

  /* ── Blog section ── */
  .post-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
  @media(max-width:768px){.post-grid{grid-template-columns:1fr}}
  .card{background:var(--paper);border:1px solid var(--line);border-radius:4px;overflow:hidden;
    display:flex;flex-direction:column;transition:box-shadow .25s}
  .card:hover{box-shadow:0 8px 32px rgba(8,10,14,.1)}
  .card .pimg{aspect-ratio:16/9;overflow:hidden;background:var(--bone-2)}
  .card .pimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .card:hover .pimg img{transform:scale(1.04)}
  .card .pd{padding:22px;flex:1;display:flex;flex-direction:column}
  .card .cat{font-family:var(--mono);font-size:10px;letter-spacing:.2em;text-transform:uppercase;
    color:var(--coral);margin-bottom:10px}
  .card h3{font-family:var(--display);font-size:22px;font-style:italic;line-height:1.2;
    margin-bottom:10px}
  .card .lede{font-size:14px;color:var(--muted);line-height:1.6;flex:1}
  .card .meta{font-family:var(--mono);font-size:11px;color:var(--muted);margin-top:16px;
    padding-top:16px;border-top:1px solid var(--line)}

  /* ── Tours section ── */
  .tgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
  @media(max-width:768px){.tgrid{grid-template-columns:1fr}}
  .tcard{position:relative;aspect-ratio:3/4;overflow:hidden;border-radius:4px;background:var(--ink)}
  .tcard img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
  .tcard:hover img{transform:scale(1.05)}
  .tcard .tc-info{position:absolute;inset:0;display:flex;flex-direction:column;justify-content:flex-end;
    padding:28px 24px;
    background:linear-gradient(0deg,rgba(8,10,14,.85) 0%,rgba(8,10,14,.2) 60%,transparent 100%);
    color:var(--bone)}
  .tcard .tc-name{font-family:var(--display);font-size:22px;font-style:italic;line-height:1.2}
  .tcard .tc-meta{font-family:var(--mono);font-size:10px;letter-spacing:.18em;
    text-transform:uppercase;color:rgba(243,239,230,.55);margin-top:6px}
  .tcard .tc-price{font-size:15px;font-weight:600;color:var(--coral);margin-top:12px}

  .sec{padding:80px 0}
  .sec-head{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:44px}
  .sec-head h2{font-family:var(--display);font-size:clamp(32px,4vw,52px);font-style:italic;font-weight:400}
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero" id="top">
  @if(isset($heroImage))
    <img class="hero-bg-img" src="{{ $heroImage }}" alt="hero">
  @endif
  <div class="scroll-explore">
    <span data-tr>Keşfetmek için kaydır</span><span data-en>Scroll to Explore</span>
  </div>
  <div class="wrap">
    <div class="roleline">
      <span data-tr>Kültürel anlatıcı &amp; seyahat uzmanı</span>
      <span data-en>Cultural storyteller &amp; travel expert</span>
    </div>
    <h1>
      <span data-tr>Dünyanın her köşesinde yeni bir hikâye var.</span>
      <span class="b" data-en>Every corner of the world has a story.</span>
    </h1>
    <div class="roles">
      <span class="role3" data-tr>Tur rehberi</span><span class="role3 b" data-en>Tour guide</span>
      <span class="role3" data-tr>Destinasyon uzmanı</span><span class="role3 b" data-en>Destination expert</span>
      <span class="role3" data-tr>Seyahat tasarımcısı</span><span class="role3 b" data-en>Travel designer</span>
    </div>
    <div class="hero-cta">
      <a class="btn btn-coral" href="/{{ $locale }}/blog">
        <span data-tr>Yazıları Oku</span><span data-en>Read Blog</span>
      </a>
      <a class="btn" href="/{{ $locale }}/places">
        <span data-tr>Destinasyonlar</span><span data-en>Destinations</span>
      </a>
    </div>
  </div>
</section>

{{-- ÖNCÜ DESTINASYONLAR --}}
@if($places->count())
<section class="sec" id="dest">
  <div class="wrap">
    <div class="sec-head">
      <h2><span data-tr>Destinasyonlar</span><span data-en>Destinations</span></h2>
      <a class="arrow" href="/{{ $locale }}/places">
        <span data-tr>Tümünü gör →</span><span data-en>View all →</span>
      </a>
    </div>
  </div>
  <div class="dest-grid">
    @foreach($places->take(6) as $place)
    <a href="/{{ $locale }}/places/{{ $place->slug }}" class="dest-card">
      @if($place->cover_image)
        <img src="{{ asset('storage/'.$place->cover_image) }}" alt="{{ $isEn ? $place->name_en : $place->name_tr }}">
      @endif
      <div class="dc-info">
        <div class="dc-name">{{ $isEn ? $place->name_en : $place->name_tr }}</div>
        <div class="dc-country">{{ $isEn ? ($place->country_en ?? '') : ($place->country_tr ?? '') }}</div>
      </div>
    </a>
    @endforeach
  </div>
</section>
@endif

{{-- BLOG --}}
@if($posts->count())
<section class="sec" style="background:var(--paper)">
  <div class="wrap">
    <div class="sec-head">
      <h2>Blog</h2>
      <a class="arrow" href="/{{ $locale }}/blog">
        <span data-tr>Tüm yazılar →</span><span data-en>All posts →</span>
      </a>
    </div>
    <div class="post-grid">
      @foreach($posts as $post)
      <a href="/{{ $locale }}/blog/{{ $post->slug }}" class="card">
        <div class="pimg">
          @if($post->cover_image)
            <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $isEn ? $post->title_en : $post->title_tr }}">
          @endif
        </div>
        <div class="pd">
          @php $cat = $isEn ? ($post->category_en ?? '') : ($post->category_tr ?? ''); @endphp
          @if($cat)<div class="cat">{{ $cat }}</div>@endif
          <h3>{{ $isEn ? $post->title_en : $post->title_tr }}</h3>
          <p class="lede">{{ $isEn ? $post->excerpt_en : $post->excerpt_tr }}</p>
          @if($post->published_at)
            <div class="meta">{{ \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMMM YYYY') }}</div>
          @endif
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- TURLAR --}}
@if($tours->count())
<section class="sec" id="tours">
  <div class="wrap">
    <div class="sec-head">
      <h2><span data-tr>Seyir Günlükleri</span><span data-en>Cruise Log</span></h2>
      <a class="arrow" href="/{{ $locale }}/tours">
        <span data-tr>Tümünü gör →</span><span data-en>View all →</span>
      </a>
    </div>
    <div class="tgrid">
      @foreach($tours as $tour)
      <a href="/{{ $locale }}/tours/{{ $tour->slug }}" class="tcard">
        @if($tour->cover_image)
          <img src="{{ asset('storage/'.$tour->cover_image) }}" alt="{{ $isEn ? $tour->name_en : $tour->name_tr }}">
        @endif
        <div class="tc-info">
          <div class="tc-name">{{ $isEn ? $tour->name_en : $tour->name_tr }}</div>
          <div class="tc-meta">{{ $isEn ? ($tour->country_en ?? '') : ($tour->country_tr ?? '') }}</div>
          @if($tour->price ?? false)
            <div class="tc-price">{{ number_format($tour->price) }} ₺</div>
          @endif
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
