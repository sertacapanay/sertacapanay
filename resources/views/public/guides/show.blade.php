@extends('public.layout')

@php
  $title   = $isEn ? ($place->title_en ?? $place->title_tr) : $place->title_tr;
  $country = $isEn ? ($place->country_en ?? $place->country_tr) : $place->country_tr;
  $body    = $isEn ? ($place->description_en ?? $place->description_tr) : $place->description_tr;
@endphp

@section('title', $title.' — Sertaç Apanay')
@section('description', Str::limit(strip_tags($body), 155))

@push('styles')
<style>
  .page-head{padding:140px 0 56px;border-bottom:1px solid var(--line);background:var(--bone)}
  .page-head .wrap{padding-left:44px;width:100%;max-width:100%;margin:0}
  .back-link{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--muted);display:inline-block;margin-bottom:28px;transition:color .2s}
  .back-link:hover{color:var(--coral)}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:var(--coral);display:block;margin-bottom:14px}
  .page-title{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(38px,6vw,78px);line-height:1.02;margin:0}

  .article{max-width:780px;margin:0 auto;padding:54px 44px 80px}
  .ahero{aspect-ratio:16/9;border-radius:4px;overflow:hidden;margin:0 0 48px;background:var(--bone-2)}
  .ahero img{width:100%;height:100%;object-fit:cover}
  .article-body p{font-size:16.5px;line-height:1.85;color:var(--muted);margin:0 0 18px}
  .article-body h2{font-family:var(--display);font-style:italic;font-size:28px;margin:38px 0 12px;color:var(--ink)}

  .guide-related{background:var(--bone-2);padding:56px 0}
  .guide-related h2{font-family:var(--display);font-style:italic;font-size:32px;margin:0 0 32px;color:var(--ink)}
  .rel-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
  .rel-card{display:block;color:inherit}
  .rel-card .ri{aspect-ratio:4/3;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:14px}
  .rel-card .ri img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .rel-card:hover .ri img{transform:scale(1.04)}
  .rel-card .rc{font-family:var(--mono);font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:var(--coral);margin-bottom:6px}
  .rel-card h3{font-family:var(--display);font-style:italic;font-size:20px;line-height:1.1;margin:0;color:var(--ink);transition:color .2s}
  .rel-card:hover h3{color:var(--coral)}
  @media(max-width:700px){.rel-grid{grid-template-columns:1fr}}
  @media(max-width:640px){.article{padding:40px 22px 60px}}
</style>
@endpush

@section('content')
<section class="page-head">
  <div class="wrap">
    <a href="/{{ $locale }}/guides" class="back-link">← <span data-tr>Tüm Rehberler</span><span data-en>All Guides</span></a>
    @if($country)<span class="page-eyebrow">{{ $country }}</span>@endif
    <h1 class="page-title">{{ $title }}</h1>
  </div>
</section>

<main>
  <div class="article">
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
          @if($rc)<div class="rc">{{ $rc }}</div>@endif
          <h3>{{ $rt }}</h3>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
