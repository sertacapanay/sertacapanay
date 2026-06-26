@extends('public.layout')

@section('title', ($isEn ? $post->title_en : $post->title_tr) . ' — Sertaç Apanay')
@section('description', $isEn ? $post->excerpt_en : $post->excerpt_tr)

@push('styles')
<style>
  .page-hero{position:relative;min-height:60vh;display:flex;align-items:flex-end;
    padding:140px 0 60px;background-size:cover;background-position:center;color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(36px,5vw,64px);font-style:italic;
    font-weight:400;line-height:1.08;max-width:820px}
  .ameta{font-family:var(--mono);font-size:11px;letter-spacing:.12em;color:rgba(243,239,230,.5);
    margin-top:18px;display:flex;gap:24px;flex-wrap:wrap}

  .article{max-width:740px;margin:0 auto;padding:60px 44px 80px}
  .article p{font-size:17px;line-height:1.85;margin-bottom:1.4em;color:var(--ink)}
  .article h2{font-family:var(--display);font-size:28px;font-style:italic;margin:2.4em 0 .8em}
  .article h3{font-family:var(--display);font-size:22px;font-style:italic;margin:2em 0 .6em}
  .article img{width:100%;border-radius:3px;margin:2em 0}
  .article blockquote{border-left:2px solid var(--coral);padding-left:24px;
    font-family:var(--display);font-size:22px;font-style:italic;color:var(--ink);margin:2em 0}
  .atags{display:flex;gap:8px;flex-wrap:wrap;margin-top:40px;padding-top:32px;border-top:1px solid var(--line)}
  .tag{font-family:var(--mono);font-size:10px;letter-spacing:.16em;text-transform:uppercase;
    padding:5px 14px;border:1px solid var(--line);border-radius:20px;color:var(--muted)}

  .recs{padding:60px 0;background:var(--paper)}
  .recs .wrap{max-width:1240px;margin:0 auto;padding:0 44px}
  .recs h2{font-family:var(--display);font-size:32px;font-style:italic;margin-bottom:32px}
  .rec-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
  @media(max-width:768px){.rec-grid{grid-template-columns:1fr}}
  .rec{background:var(--bone);border:1px solid var(--line);border-radius:3px;overflow:hidden}
  .rec .rimg{aspect-ratio:16/9;overflow:hidden;background:var(--bone-2)}
  .rec .rimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .rec:hover .rimg img{transform:scale(1.04)}
  .rec .rpd{padding:18px}
  .rec .rcat{font-family:var(--mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--coral);margin-bottom:8px}
  .rec h3{font-family:var(--display);font-size:19px;font-style:italic;line-height:1.25}
</style>
@endpush

@section('content')
@php
  $title = $isEn ? $post->title_en : $post->title_tr;
  $excerpt = $isEn ? $post->excerpt_en : $post->excerpt_tr;
  $body = $isEn ? $post->body_en : $post->body_tr;
  $cat = $isEn ? ($post->category_en ?? '') : ($post->category_tr ?? '');
  $heroStyle = $post->cover_image
    ? 'background-image:linear-gradient(180deg,rgba(8,10,14,.35) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),url("'.asset('storage/'.$post->cover_image).'")'
    : 'background:var(--ink)';
@endphp

<section class="page-hero" style="{{ $heroStyle }}">
  <div class="wrap">
    @if($cat)<div class="page-eyebrow">{{ $cat }}</div>@endif
    <h1 class="page-title">{{ $title }}</h1>
    <div class="ameta">
      @if($post->published_at)
        <span>{{ \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMMM YYYY') }}</span>
      @endif
    </div>
  </div>
</section>

<main>
  <article class="article">
    @if($excerpt)
      <p style="font-size:19px;line-height:1.7;color:var(--muted);margin-bottom:2em">{{ $excerpt }}</p>
    @endif
    <div>{!! $body !!}</div>
    @if($post->tags ?? false)
      <div class="atags">
        @foreach(explode(',', $post->tags) as $t)
          <span class="tag">{{ trim($t) }}</span>
        @endforeach
      </div>
    @endif
  </article>

  @if($relatedPosts->count())
  <section class="recs">
    <div class="wrap">
      <h2><span data-tr>İlgili Yazılar</span><span data-en>Related Posts</span></h2>
      <div class="rec-grid">
        @foreach($relatedPosts as $rel)
        <a href="/{{ $locale }}/blog/{{ $rel->slug }}" class="rec">
          <div class="rimg">
            @if($rel->cover_image)
              <img src="{{ asset('storage/'.$rel->cover_image) }}" alt="{{ $isEn ? $rel->title_en : $rel->title_tr }}">
            @endif
          </div>
          <div class="rpd">
            @php $rc = $isEn ? ($rel->category_en ?? '') : ($rel->category_tr ?? ''); @endphp
            @if($rc)<div class="rcat">{{ $rc }}</div>@endif
            <h3>{{ $isEn ? $rel->title_en : $rel->title_tr }}</h3>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif
</main>
@endsection
