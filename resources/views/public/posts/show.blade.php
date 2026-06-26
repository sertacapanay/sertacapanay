@extends('public.layout')

@php
  $title   = $isEn ? ($post->title_en ?? $post->title_tr) : $post->title_tr;
  $excerpt = $isEn ? ($post->excerpt_en ?? $post->excerpt_tr ?? '') : ($post->excerpt_tr ?? '');
  $body    = $isEn ? ($post->body_en ?? $post->body_tr ?? '') : ($post->body_tr ?? '');
  $cat     = $isEn ? ($post->category_en ?? '') : ($post->category_tr ?? '');
  $loc     = $isEn ? ($post->location_en ?? $post->location_tr ?? '') : ($post->location_tr ?? '');
  $pdate   = $post->published_at ? \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMM YYYY') : null;
@endphp

@section('title', $title.' — Sertaç Apanay')
@section('description', Str::limit(strip_tags($excerpt ?: $body), 155))

@push('styles')
<style>
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
  .article-body blockquote{border-left:2px solid var(--coral);padding-left:24px;
    font-family:var(--display);font-size:22px;font-style:italic;color:var(--ink);margin:2em 0}
  .article-body img{width:100%;border-radius:3px;margin:2em 0}
  .atags{display:flex;gap:8px;flex-wrap:wrap;margin-top:48px;padding-top:32px;border-top:1px solid var(--line)}
  .gtag{font-family:var(--mono);font-size:10px;letter-spacing:.16em;text-transform:uppercase;
    padding:5px 14px;border:1px solid var(--line);border-radius:20px;color:var(--muted)}

  /* Related posts */
  .related{padding:64px 0;border-top:1px solid var(--line);background:var(--bone-2)}
  .related .wrap{max-width:1240px;margin:0 auto;padding:0 44px}
  .related h2{font-family:var(--display);font-style:italic;font-size:32px;margin:0 0 32px;color:var(--ink)}
  .rel-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
  @media(max-width:768px){.rel-grid{grid-template-columns:1fr}}
  .rpost{display:block;color:inherit}
  .pthumb{aspect-ratio:16/10;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:16px}
  .pthumb img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .rpost:hover .pthumb img{transform:scale(1.04)}
  .rcat{font-family:var(--mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;
    color:var(--coral);margin-bottom:8px}
  .rpost h3{font-family:var(--display);font-style:italic;font-size:20px;
    font-weight:500;line-height:1.2;margin:0;color:var(--ink);transition:color .2s}
  .rpost:hover h3{color:var(--coral)}

  @media(max-width:640px){.article{padding:56px 22px 60px}}
</style>
@endpush

@section('content')
<main class="page">
  <div class="wrap">
    <article class="article">
      <a href="/{{ $locale }}/blog" class="back">← <span data-tr>Blog'a Dön</span><span data-en>Back to Blog</span></a>

      <div class="ameta">
        @if($cat){{ $cat }}@endif
        @if($cat && ($loc || $pdate))<span class="dot">·</span>@endif
        @if($loc){{ $loc }}@endif
        @if($loc && $pdate)<span class="dot">·</span>@endif
        @if($pdate){{ $pdate }}@endif
      </div>

      <h1>{{ $title }}</h1>

      @if($excerpt)
        <p class="lede">{{ $excerpt }}</p>
      @endif

      @if($post->cover_image)
        <div class="ahero">
          <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $title }}">
        </div>
      @endif

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
          $rc = $isEn ? ($rel->category_en ?? '') : ($rel->category_tr ?? '');
        @endphp
        <a href="/{{ $locale }}/blog/{{ $rel->slug }}" class="rpost">
          <div class="pthumb">
            @if($rel->cover_image)
              <img src="{{ asset('storage/'.$rel->cover_image) }}" alt="{{ $rt }}">
            @endif
          </div>
          @if($rc)<div class="rcat">{{ $rc }}</div>@endif
          <h3>{{ $rt }}</h3>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
