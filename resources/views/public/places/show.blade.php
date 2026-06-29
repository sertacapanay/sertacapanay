@extends('public.layout')

@section('title', ($isEn ? $place->name_en : $place->name_tr) . ' — Sertaç Apanay')
@section('description', $isEn ? ($place->short_description_en ?? '') : ($place->short_description_tr ?? ''))

@push('styles')
<style>
  .page-hero{position:relative;min-height:60vh;display:flex;align-items:flex-end;
    padding:140px 0 60px;background-size:cover;background-position:center;color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(40px,6vw,72px);font-style:italic;font-weight:400;line-height:1.06}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:560px;line-height:1.65}

  .page-body{max-width:800px;margin:0 auto;padding:60px 44px 80px}
  .page-body p{font-size:17px;line-height:1.85;margin-bottom:1.4em}
  .page-body h2{font-family:var(--display);font-size:28px;font-style:italic;margin:2.4em 0 .8em}
  .page-body img{width:100%;border-radius:3px;margin:2em 0}

  .recs{padding:60px 0;background:var(--paper)}
  .recs .wrap{max-width:1240px;margin:0 auto;padding:0 44px}
  .recs h2{font-family:var(--display);font-size:32px;font-style:italic;margin-bottom:32px}
  .rec-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
  @media(max-width:768px){.rec-grid{grid-template-columns:1fr}}
  .rec{background:var(--bone);border:1px solid var(--line);border-radius:3px;overflow:hidden;display:block}
  .rec .rimg{aspect-ratio:4/3;overflow:hidden;background:var(--bone-2)}
  .rec .rimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .rec:hover .rimg img{transform:scale(1.04)}
  .rec .rpd{padding:18px}
  .rec .rcat{font-family:var(--mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--coral);margin-bottom:8px}
  .rec h3{font-family:var(--display);font-size:19px;font-style:italic;line-height:1.25}
</style>
@endpush

@section('content')
@php
  $name = $isEn ? $place->name_en : $place->name_tr;
  $country = $isEn ? ($place->country_en ?? '') : ($place->country_tr ?? '');
  $desc = $isEn ? ($place->short_description_en ?? '') : ($place->short_description_tr ?? '');
  $body = $isEn ? ($place->body_en ?? '') : ($place->body_tr ?? '');
  $heroStyle = $place->cover_image
    ? 'background-image:linear-gradient(180deg,rgba(8,10,14,.35) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),url("'.asset('storage/'.$place->cover_image).'")'
    : 'background:var(--ink)';
@endphp

<section class="page-hero" style="{{ $heroStyle }}">
  <div class="wrap">
    @if($country)<div class="page-eyebrow">{{ $country }}</div>@endif
    <h1 class="page-title">{{ $name }}</h1>
    @if($desc)<p class="page-lead">{{ $desc }}</p>@endif
  </div>
</section>

<main>
  <div class="page-body">
    {!! nl2br(e($body)) !!}
  </div>

  @if($relatedPlaces->count())
  <section class="recs">
    <div class="wrap">
      <h2><span data-tr>İlgili Destinasyonlar</span><span data-en>Related Destinations</span></h2>
      <div class="rec-grid">
        @foreach($relatedPlaces as $rel)
        <a href="/{{ $locale }}/places/{{ $rel->slug }}" class="rec">
          <div class="rimg">
            @if($rel->cover_image)
              <img src="{{ asset('storage/'.$rel->cover_image) }}" alt="{{ $isEn ? $rel->name_en : $rel->name_tr }}" loading="lazy">
            @endif
          </div>
          <div class="rpd">
            <div class="rcat">{{ $isEn ? ($rel->country_en ?? '') : ($rel->country_tr ?? '') }}</div>
            <h3>{{ $isEn ? $rel->name_en : $rel->name_tr }}</h3>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif
  @foreach(\App\Models\Widget::forPosition('content_bottom', 'places') as $widget)
    <section class="wrap" style="padding:40px 0">
      <x-widget :widget="$widget" />
    </section>
  @endforeach
</main>
@endsection
