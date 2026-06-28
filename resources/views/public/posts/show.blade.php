@extends('public.layout')

@php
  $title   = $isEn ? ($post->title_en ?? $post->title_tr) : $post->title_tr;
  $excerpt = $isEn ? ($post->excerpt_en ?? $post->excerpt_tr ?? '') : ($post->excerpt_tr ?? '');
  $body    = $isEn ? ($post->content_en ?? $post->content_tr ?? '') : ($post->content_tr ?? '');
  $cat_tr  = $post->category_tr ?? '';
  $cat_en  = $post->category_en ?? $cat_tr;
  $pdate_tr = $post->published_at
    ? \Carbon\Carbon::parse($post->published_at)->locale('tr')->isoFormat('D MMMM YYYY')
    : null;
  $pdate_en = $post->published_at
    ? \Carbon\Carbon::parse($post->published_at)->locale('en')->isoFormat('D MMMM YYYY')
    : null;
  // Compute read time from plain-text word count
  $wordCount = str_word_count(strip_tags($body ?: $excerpt));
  $readMin   = max(1, (int) ceil($wordCount / 200));
@endphp

@section('title', $title.' — Sertaç Apanay')
@section('description', Str::limit(strip_tags($excerpt ?: $body), 155))

@push('styles')
<style>
  .article{max-width:760px;margin:0 auto;padding:54px 0 70px}
  .back{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--muted);display:inline-block;margin-bottom:30px;transition:color .2s}
  .back:hover{color:var(--coral)}
  .ameta{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--coral);margin-bottom:14px}
  .ameta .dot{color:var(--muted);margin:0 7px}
  .article h1{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(34px,5.5vw,56px);line-height:1.05;margin:0 0 18px;color:var(--ink)}
  .lede{font-size:19px;line-height:1.7;color:var(--ink);margin:0 0 10px}
  .ahero{aspect-ratio:16/9;border-radius:4px;overflow:hidden;margin:30px 0 8px;background:var(--bone-2)}
  .ahero img{width:100%;height:100%;object-fit:cover}
  .article h2{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:28px;margin:38px 0 12px;color:var(--ink)}
  .article h3{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:22px;margin:2em 0 .6em;color:var(--ink)}
  .article p{font-size:16.5px;line-height:1.8;color:var(--muted);margin:0 0 16px}
  .article blockquote{border-left:2px solid var(--coral);padding-left:24px;
    font-family:var(--display);font-size:22px;font-style:italic;color:var(--ink);margin:2em 0}
  .article img{width:100%;border-radius:3px;margin:2em 0}
  .atags{display:flex;gap:8px;flex-wrap:wrap;margin-top:48px;padding-top:32px;border-top:1px solid var(--line)}
  .gtag{font-family:var(--mono);font-size:10px;letter-spacing:.16em;text-transform:uppercase;
    padding:5px 14px;border:1px solid var(--line);border-radius:20px;color:var(--muted)}

  /* Related posts */
  .related{padding:64px 0;border-top:1px solid var(--line);background:var(--bone-2)}
  .related .wrap{max-width:1240px;margin:0 auto;padding:0 44px}
  .related h2{font-family:var(--display);font-style:italic;font-size:32px;margin:0 0 32px;color:var(--ink)}
  .rel-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
  .rpost{display:block;color:inherit}
  .pthumb{aspect-ratio:16/10;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:16px}
  .pthumb img{width:100%;height:100%;object-fit:cover;transition:transform .5s;loading:lazy}
  .rpost:hover .pthumb img{transform:scale(1.04)}
  .rcat{font-family:var(--mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;
    color:var(--coral);margin-bottom:8px}
  .rpost h3{font-family:var(--display);font-style:italic;font-size:20px;
    font-weight:500;line-height:1.2;margin:0;color:var(--ink);transition:color .2s}
  .rpost:hover h3{color:var(--coral)}

  @media(max-width:900px){.article{padding:48px 44px 60px}}
  @media(max-width:640px){.article{padding:40px 22px 56px}.rel-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<main class="page">
  <div class="wrap">
    <article class="article">
      <a href="/{{ $locale }}/blog" class="back">
        <span data-tr>← Blog'a Dön</span><span data-en>← Back to Blog</span>
      </a>

      <div class="ameta">
        @if($cat_tr)
          <span data-tr>{{ $cat_tr }}</span>@if($cat_en !== $cat_tr)<span data-en>{{ $cat_en }}</span>@endif
        @endif
        @if($cat_tr && $pdate_tr)<span class="dot">·</span>@endif
        @if($pdate_tr)
          <span data-tr>{{ $pdate_tr }}</span>
          @if($pdate_en)<span data-en>{{ $pdate_en }}</span>@endif
        @endif
        @if($pdate_tr || $cat_tr)<span class="dot">·</span>@endif
        <span data-tr>{{ $readMin }} dk okuma</span><span data-en>{{ $readMin }} min read</span>
      </div>

      <h1>
        <span data-tr>{{ $post->title_tr }}</span>
        @if($post->title_en)<span data-en>{{ $post->title_en }}</span>@endif
      </h1>

      @if($excerpt)
        <p class="lede">
          <span data-tr>{{ $post->excerpt_tr }}</span>
          @if($post->excerpt_en)<span class="b" data-en>{{ $post->excerpt_en }}</span>@endif
        </p>
      @endif

      @php
        $slugCoverMap = [
          'her-gezgin-yurt-disinda-yemek-yapmayi-ogrenmeli' => 'blog-post1.jpg',
          'destinasyonlar-arasindaki-sessizlik'              => 'blog-post2.jpg',
        ];
        $coverFallback = $slugCoverMap[$post->slug] ?? 'blog-post1.jpg';
      @endphp
      <div class="ahero">
        @if($post->cover_image)
          <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $title }}" loading="lazy">
        @else
          <img src="{{ asset('images/'.$coverFallback) }}" alt="{{ $title }}" loading="lazy">
        @endif
      </div>

      @if($body)
        <div class="article-body">
          {!! nl2br(e($body)) !!}
        </div>
      @endif

      @if(!empty($post->tags))
        <div class="atags">
          @foreach(explode(',', $post->tags) as $tag)
            @if(trim($tag))
              <span class="gtag">{{ trim($tag) }}</span>
            @endif
          @endforeach
        </div>
      @endif
    </article>
  </div>
</main>

@if(isset($relatedPosts) && $relatedPosts->isNotEmpty())
<section class="related">
  <div class="wrap">
    <h2 data-tr>Benzer Yazılar</h2>
    <h2 class="b" data-en>Related Posts</h2>
    <div class="rel-grid">
      @foreach($relatedPosts as $rel)
        @php
          $rt = $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr;
          $rc_tr = $rel->category_tr ?? '';
          $rc_en = $rel->category_en ?? $rc_tr;
        @endphp
        <a href="/{{ $locale }}/blog/{{ $rel->slug }}" class="rpost">
          <div class="pthumb">
            @php
              $relCoverMap = ['her-gezgin-yurt-disinda-yemek-yapmayi-ogrenmeli'=>'blog-post1.jpg','destinasyonlar-arasindaki-sessizlik'=>'blog-post2.jpg'];
              $relFallback = $relCoverMap[$rel->slug] ?? 'blog-post1.jpg';
            @endphp
            @if($rel->cover_image)
              <img src="{{ asset('storage/'.$rel->cover_image) }}" alt="{{ $rt }}" loading="lazy">
            @else
              <img src="{{ asset('images/'.$relFallback) }}" alt="{{ $rt }}" loading="lazy">
            @endif
          </div>
          @if($rc_tr)
            <div class="rcat">
              <span data-tr>{{ $rc_tr }}</span>
              @if($rc_en !== $rc_tr)<span data-en>{{ $rc_en }}</span>@endif
            </div>
          @endif
          <h3>
            <span data-tr>{{ $rel->title_tr }}</span>
            @if($rel->title_en)<span data-en>{{ $rel->title_en }}</span>@endif
          </h3>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
