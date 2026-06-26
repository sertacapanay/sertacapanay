@extends('public.layout')

@section('title', $isEn ? 'Blog — Sertaç Apanay' : 'Blog — Sertaç Apanay')
@section('description', $isEn ? 'Stories, insights, and reflections from the road.' : 'Yollardan hikâyeler, izlenimler ve düşünceler.')

@push('styles')
<style>
  /* PAGE HERO */
  .page-hero{
    position:relative;min-height:56vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center;
    background-image:linear-gradient(180deg,rgba(8,10,14,.4) 0%,rgba(8,10,14,.12) 42%,rgba(8,10,14,.62) 100%),
      url('{{ asset("images/blog-hero.jpg") }}');
    color:var(--bone)
  }
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:12px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(255,255,255,.85);margin-bottom:16px;display:block}
  .page-title{font-family:var(--display);font-size:clamp(40px,7vw,86px);font-style:italic;font-weight:500;line-height:1.05}
  .page-lead{font-size:17px;color:rgba(243,239,230,.88);margin-top:14px;max-width:520px;line-height:1.7}

  /* PAGE BODY */
  .page-body{padding:56px 0 90px}

  /* CATEGORY FILTERS */
  .cat-filters{display:flex;gap:8px;flex-wrap:wrap;padding:0 0 28px;border-bottom:1px solid var(--line);margin-bottom:48px}
  .cat-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .cat-btn:hover,.cat-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  /* POST GRID */
  .post-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:40px}
  @media(max-width:800px){.post-grid{grid-template-columns:1fr}}

  .post{display:block;color:inherit;text-decoration:none}
  .post .pthumb{aspect-ratio:16/10;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:18px}
  .post .pthumb img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .post:hover .pthumb img{transform:scale(1.04)}
  .post .pmeta{font-family:var(--mono);font-size:11px;letter-spacing:.08em;text-transform:uppercase;
    color:var(--coral);margin-bottom:10px;display:flex;align-items:center;flex-wrap:wrap;gap:0}
  .post .pmeta .dot{color:var(--muted);margin:0 7px}
  .post h3{font-family:var(--display);font-style:italic;font-weight:500;font-size:26px;
    line-height:1.15;margin:0 0 10px;color:var(--ink);transition:color .2s}
  .post:hover h3{color:var(--coral)}
  .post p{margin:0;color:var(--muted);font-size:15px;line-height:1.65}

  .pagination-wrap{display:flex;justify-content:center;gap:8px;padding:40px 0 0;grid-column:1/-1}
  .pagination-wrap a,.pagination-wrap span{font-family:var(--mono);font-size:12px;letter-spacing:.1em;
    padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)}
  .pagination-wrap .active-page{background:var(--ink);color:var(--bone);border-color:var(--ink)}
</style>
@endpush

@section('content')

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="wrap">
    <span class="page-eyebrow" data-tr>Blog</span><span class="page-eyebrow b" data-en>The Blog</span>
    <h1 class="page-title"><span data-tr>Blog</span><span data-en>The Blog</span></h1>
    <p class="page-lead"><span data-tr>Yollardan hikâyeler, izlenimler ve düşünceler.</span><span class="b" data-en>Stories, insights, and reflections from the road.</span></p>
  </div>
</section>

<main class="page">
  <section class="page-body">
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
            $pcat_tr  = $post->category_tr ?? '';
            $pcat_en  = $post->category_en ?? $pcat_tr;
            $pdate    = $post->published_at
              ? \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMM YYYY')
              : null;
            $pread    = $post->read_time ?? null;
          @endphp
          <a href="/{{ $locale }}/blog/{{ $post->slug }}" class="post">
            <div class="pthumb">
              @if($post->cover_image)
                <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $ptitle }}">
              @endif
            </div>
            <div class="pmeta">
              @if($pcat_tr)<span data-tr>{{ $pcat_tr }}</span>@endif
              @if($pcat_en)<span class="b" data-en>{{ $pcat_en }}</span>@endif
              @if($pdate)<span class="dot">·</span>{{ $pdate }}@endif
              @if($pread)<span class="dot">·</span><span data-tr>{{ $pread }} dk</span><span data-en>{{ $pread }} min</span>@endif
            </div>
            <h3>{{ $ptitle }}</h3>
            @if($pexcerpt)<p>{{ Str::limit($pexcerpt, 140) }}</p>@endif
          </a>
        @empty
          {{-- Static placeholders --}}
          @php
            $post1Img = asset('images/blog-post1.jpg');
            $post2Img = asset('images/blog-post2.jpg');
          @endphp
          @foreach([
            [
              'img'      => $post1Img,
              'cat_tr'   => 'yemek',
              'cat_en'   => 'food',
              'date'     => '14 Haz 2026',
              'read_tr'  => '5 dk',
              'read_en'  => '5 min',
              'title_tr' => 'Her Gezgin Yurt Dışında Yemek Yapmayı Öğrenmeli',
              'title_en' => 'Why Every Traveler Should Learn to Cook Abroad',
              'desc_tr'  => 'Asıl müze, pazarın kendisi. Yerel mutfağı öğrenmek seni turistten geçici bir sakine dönüştürür.',
              'desc_en'  => 'The market is the real museum. Learning to cook local cuisine transforms you from tourist to temporary resident.',
            ],
            [
              'img'      => $post2Img,
              'cat_tr'   => 'seyahat hikâyeleri',
              'cat_en'   => 'travel stories',
              'date'     => '14 Haz 2026',
              'read_tr'  => '6 dk',
              'read_en'  => '6 min',
              'title_tr' => 'Destinasyonlar Arasındaki Sessizlik',
              'title_en' => 'The Silence Between Destinations',
              'desc_tr'  => 'Seyahat, vardığın yerlerle değil; kalkış ile varış arasındaki o dönüştürücü boşlukla ilgilidir.',
              'desc_en'  => 'Travel isn\'t about the places you arrive at — it\'s about the transformative space between departure and arrival.',
            ],
          ] as $ph)
          <div class="post">
            <div class="pthumb">
              <img src="{{ $ph['img'] }}" alt="">
            </div>
            <div class="pmeta">
              <span data-tr>{{ $ph['cat_tr'] }}</span><span class="b" data-en>{{ $ph['cat_en'] }}</span>
              <span class="dot">·</span>{{ $ph['date'] }}
              <span class="dot">·</span><span data-tr>{{ $ph['read_tr'] }}</span><span data-en>{{ $ph['read_en'] }}</span>
            </div>
            <h3>
              <span data-tr>{{ $ph['title_tr'] }}</span>
              <span class="b" data-en>{{ $ph['title_en'] }}</span>
            </h3>
            <p>
              <span data-tr>{{ $ph['desc_tr'] }}</span>
              <span class="b" data-en>{{ $ph['desc_en'] }}</span>
            </p>
          </div>
          @endforeach
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
  </section>
</main>
@endsection
