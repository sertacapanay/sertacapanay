@extends('public.layout')

@section('title', $isEn ? 'Blog — Sertaç Apanay' : 'Blog — Sertaç Apanay')
@section('description', $isEn ? 'Reflections from travel, cultural observations and road notes.' : 'Seyahatten yansımalar, kültürel gözlemler ve yol notları.')

@push('styles')
<style>
  .page-hero{position:relative;min-height:56vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center;
    background-image:linear-gradient(180deg,rgba(8,10,14,.4) 0%,rgba(8,10,14,.12) 42%,rgba(8,10,14,.62) 100%),
      url('{{ asset("images/blog-hero.jpg") }}');color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(40px,6vw,86px);font-style:italic;font-weight:400;line-height:1.05}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  /* Category filters */
  .cat-filters{display:flex;gap:8px;flex-wrap:wrap;padding:28px 0;border-bottom:1px solid var(--line)}
  .cat-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .cat-btn:hover,.cat-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  /* Post grid — 2-col per HTML reference */
  .post-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:40px;padding:48px 0 80px}
  @media(max-width:800px){.post-grid{grid-template-columns:1fr}}

  .post{display:block;color:inherit}
  .pthumb{aspect-ratio:16/10;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:18px}
  .pthumb img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
  .post:hover .pthumb img{transform:scale(1.04)}
  .pmeta{font-family:var(--mono);font-size:11px;letter-spacing:.1em;color:var(--coral);
    text-transform:uppercase;margin-bottom:12px;display:flex;align-items:center;gap:0}
  .pmeta .dot{color:var(--muted);margin:0 10px}
  .post h3{font-family:var(--display);font-style:italic;font-size:26px;font-weight:500;
    line-height:1.15;margin:0 0 10px;color:var(--ink);transition:color .2s}
  .post:hover h3{color:var(--coral)}
  .post p{font-size:15px;color:var(--muted);line-height:1.6;margin:0}

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
    <div class="page-eyebrow"><span data-tr>YAZILI BELLEK</span><span data-en>WRITTEN MEMORY</span></div>
    <h1 class="page-title">Blog</h1>
    <p class="page-lead" data-tr>Seyahatten yansımalar, kültürel gözlemler ve yol notları.</p>
    <p class="page-lead b" data-en>Reflections from travel, cultural observations and road notes.</p>
  </div>
</section>

<main class="page">
  <div class="wrap">
    <div class="cat-filters">
      <a href="/{{ $locale }}/blog" class="cat-btn {{ !$selectedCategory ? 'active' : '' }}">
        <span data-tr>Tümü</span><span data-en>All</span>
      </a>
      @foreach($categories as $cat)
        <a href="/{{ $locale }}/blog?category={{ urlencode($cat) }}"
           class="cat-btn {{ $selectedCategory === $cat ? 'active' : '' }}">{{ $cat }}</a>
      @endforeach
    </div>

    <div class="post-grid">
      @forelse($posts as $post)
        @php
          $ptitle   = $isEn ? ($post->title_en ?? $post->title_tr) : $post->title_tr;
          $pexcerpt = $isEn ? ($post->excerpt_en ?? $post->excerpt_tr ?? '') : ($post->excerpt_tr ?? '');
          $pcat     = $isEn ? ($post->category_en ?? '') : ($post->category_tr ?? '');
          $pdate    = $post->published_at ? \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMM YYYY') : null;
        @endphp
        <a href="/{{ $locale }}/blog/{{ $post->slug }}" class="post">
          <div class="pthumb">
            @if($post->cover_image)
              <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $ptitle }}">
            @endif
          </div>
          <div class="pmeta">
            @if($pcat){{ $pcat }}@endif
            @if($pcat && $pdate)<span class="dot">·</span>@endif
            @if($pdate){{ $pdate }}@endif
          </div>
          <h3>{{ $ptitle }}</h3>
          @if($pexcerpt)<p>{{ Str::limit($pexcerpt, 140) }}</p>@endif
        </a>
      @empty
        <div class="empty-state">
          <p data-tr>Henüz yazı yok</p>
          <p class="b" data-en>No posts yet. Coming soon.</p>
        </div>
      @endforelse

      @if($posts->hasPages())
      <div class="pagination-wrap">
        @if($posts->onFirstPage())<span>←</span>@else<a href="{{ $posts->previousPageUrl() }}">←</a>@endif
        @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
          @if($page == $posts->currentPage())<span class="active-page">{{ $page }}</span>
          @else<a href="{{ $url }}">{{ $page }}</a>@endif
        @endforeach
        @if($posts->hasMorePages())<a href="{{ $posts->nextPageUrl() }}">→</a>@else<span>→</span>@endif
      </div>
      @endif
    </div>
  </div>
</main>
@endsection
