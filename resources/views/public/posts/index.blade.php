@extends('public.layout')

@section('title', $isEn ? 'Blog — Sertaç Apanay' : 'Blog — Sertaç Apanay')

@push('styles')
<style>
  .page-hero{position:relative;min-height:52vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center;
    background-image:linear-gradient(180deg,rgba(8,10,14,.4) 0%,rgba(8,10,14,.12) 42%,rgba(8,10,14,.62) 100%),
      url('{{ asset("images/blog-hero.jpg") }}');color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,76px);font-style:italic;font-weight:400;line-height:1.05}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  .filter-bar{display:flex;gap:8px;flex-wrap:wrap;padding:28px 0;border-bottom:1px solid var(--line)}
  .filter-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .filter-btn:hover,.filter-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  .post-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px;padding:48px 0}
  @media(max-width:900px){.post-grid{grid-template-columns:1fr 1fr}}
  @media(max-width:600px){.post-grid{grid-template-columns:1fr}}
  .card{background:var(--paper);border:1px solid var(--line);border-radius:4px;overflow:hidden;
    display:flex;flex-direction:column;transition:box-shadow .25s}
  .card:hover{box-shadow:0 8px 32px rgba(8,10,14,.1)}
  .card .pimg{aspect-ratio:16/9;overflow:hidden;background:var(--bone-2)}
  .card .pimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .card:hover .pimg img{transform:scale(1.04)}
  .card .pd{padding:22px;flex:1;display:flex;flex-direction:column}
  .card .cat{font-family:var(--mono);font-size:10px;letter-spacing:.2em;text-transform:uppercase;color:var(--coral);margin-bottom:10px}
  .card h3{font-family:var(--display);font-size:22px;font-style:italic;line-height:1.2;margin-bottom:10px}
  .card .lede{font-size:14px;color:var(--muted);line-height:1.6;flex:1}
  .card .meta{font-family:var(--mono);font-size:11px;color:var(--muted);margin-top:16px;
    padding-top:16px;border-top:1px solid var(--line)}

  .pagination-wrap{display:flex;justify-content:center;gap:8px;padding:32px 0 64px}
  .pagination-wrap a,.pagination-wrap span{font-family:var(--mono);font-size:12px;letter-spacing:.1em;
    padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)}
  .pagination-wrap .active-page{background:var(--ink);color:var(--bone);border-color:var(--ink)}
</style>
@endpush

@section('content')
<section class="page-hero">
  <div class="wrap">
    <div class="page-eyebrow"><span data-tr>YAZILI BELLEK</span><span data-en>WRITTEN MEMORY</span></div>
    <h1 class="page-title">Blog</h1>
    <p class="page-lead" data-tr>Seyahatten yansımalar, kültürel gözlemler ve yol notları.</p>
    <p class="page-lead b" data-en>Reflections from travel, cultural observations and road notes.</p>
  </div>
</section>

<main class="page">
  <div class="wrap">
    <div class="filter-bar">
      <a href="/{{ $locale }}/blog"
         class="filter-btn {{ !$selectedCategory ? 'active' : '' }}">
        <span data-tr>Tümü</span><span data-en>All</span>
      </a>
      @foreach($categories as $cat)
        <a href="/{{ $locale }}/blog?category={{ urlencode($cat) }}"
           class="filter-btn {{ $selectedCategory === $cat ? 'active' : '' }}">
          {{ $cat }}
        </a>
      @endforeach
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

    @if($posts->hasPages())
    <div class="pagination-wrap">
      @if($posts->onFirstPage())
        <span>←</span>
      @else
        <a href="{{ $posts->previousPageUrl() }}">←</a>
      @endif
      @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
        @if($page == $posts->currentPage())
          <span class="active-page">{{ $page }}</span>
        @else
          <a href="{{ $url }}">{{ $page }}</a>
        @endif
      @endforeach
      @if($posts->hasMorePages())
        <a href="{{ $posts->nextPageUrl() }}">→</a>
      @else
        <span>→</span>
      @endif
    </div>
    @endif
  </div>
</main>
@endsection
