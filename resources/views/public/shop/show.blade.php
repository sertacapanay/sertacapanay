@extends('public.layout')

@php
  $pname = $isEn ? ($product->title_en ?? $product->title_tr) : $product->title_tr;
  $psrc  = $isEn ? ($product->source_place_en ?? $product->source_place_tr) : $product->source_place_tr;
  $pcat  = $isEn ? ($product->category_en ?? $product->category_tr) : $product->category_tr;
  $pdesc = $isEn ? ($product->description_en ?? $product->description_tr) : $product->description_tr;
  $pstory = $isEn ? ($product->story_en ?? $product->story_tr ?? '') : ($product->story_tr ?? '');
@endphp

@section('title', $pname.' — Çarşı — Sertaç Apanay')
@section('description', Str::limit(strip_tags($pdesc), 155))

@push('styles')
<style>
  .back{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--muted);display:inline-block;margin-top:120px;margin-bottom:0;transition:color .2s;text-decoration:none}
  .back:hover{color:var(--coral)}

  .pd{display:grid;grid-template-columns:1fr 1fr;gap:56px;padding:54px 0 46px;align-items:start}
  .pd .pdimg{aspect-ratio:4/5;border-radius:4px;overflow:hidden;background:var(--bone-2)}
  .pd .pdimg img{width:100%;height:100%;object-fit:cover}
  .pd .pdsrc{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--coral)}
  .pd h1{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(32px,4.5vw,48px);
    margin:10px 0 6px;color:var(--ink)}
  .pd .pdprice{font-size:20px;color:var(--ink);margin-bottom:20px}
  .pd .pdprice .pdcat{font-family:var(--mono);font-size:11px;letter-spacing:.08em;text-transform:uppercase;
    color:var(--muted)}
  .pd .pddesc{color:var(--muted);font-size:16px;line-height:1.75;margin-bottom:26px}
  .cbtn{background:var(--ink);color:var(--bone);border:0;padding:14px 30px;font-family:var(--mono);
    font-size:12px;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;display:inline-block;
    text-decoration:none;transition:background .2s}
  .cbtn:hover{background:var(--coral)}

  .origin{max-width:760px;margin:0 auto;padding:40px 0 80px;border-top:1px solid var(--line)}
  .origin h2{font-family:var(--display);font-style:italic;font-size:26px;margin:0 0 14px;color:var(--ink)}
  .origin p{color:var(--muted);font-size:16.5px;line-height:1.8;margin-bottom:1.4em}

  .related-sec{background:var(--bone-2);padding:56px 0}
  .related-sec h2{font-family:var(--display);font-style:italic;font-size:30px;margin:0 0 30px;color:var(--ink)}
  .rel-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
  .sprod{display:block;color:inherit;text-decoration:none}
  .sprod .pimg{aspect-ratio:3/4;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:12px}
  .sprod .pimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .sprod:hover .pimg img{transform:scale(1.04)}
  .sprod .pname{font-family:var(--display);font-style:italic;font-size:18px;margin:0 0 4px;
    color:var(--ink);transition:color .2s}
  .sprod:hover .pname{color:var(--coral)}
  .sprod .pprice{font-family:var(--mono);font-size:12px;color:var(--muted)}

  @media(max-width:800px){.pd{grid-template-columns:1fr;gap:28px}}
  @media(max-width:600px){.rel-grid{grid-template-columns:repeat(2,1fr)}}
</style>
@endpush

@section('content')
<main class="page">

  {{-- ── Ürün Detay ── --}}
  <div class="wrap">
    <a class="back" href="/{{ $locale }}/shop">
      ← <span data-tr>Çarşıya Dön</span><span data-en>Back to Shop</span>
    </a>

    <div class="pd">
      <div class="pdimg">
        @php
          $slugImgMap = [
            'el-dokumasi-ikat-atki'          => 'shop-prod1.jpg',
            'zellige-seramik-kase'           => 'shop-prod2.jpg',
            'antika-princ-pusula'            => 'shop-prod3.jpg',
            'el-yapimi-deri-seyahat-defteri' => 'shop-prod4.jpg',
          ];
          $fallbackImg = $slugImgMap[$product->slug] ?? 'shop-prod1.jpg';
        @endphp
        @if($product->image)
          <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $pname }}" loading="lazy">
        @else
          <img src="{{ asset('images/'.$fallbackImg) }}" alt="{{ $pname }}" loading="lazy">
        @endif
      </div>

      <div class="pdinfo">
        @if($psrc)
          <span class="pdsrc">
            <span data-tr>Kaynak: {{ $psrc }}</span>
            <span data-en>Sourced in {{ $psrc }}</span>
          </span>
        @endif

        <h1>{{ $pname }}</h1>

        <div class="pdprice">
          @if($product->price)
            {{ $product->currency }} {{ number_format($product->price, 2) }}
          @endif
          @if($pcat)
            &nbsp;·&nbsp; <span class="pdcat">{{ $pcat }}</span>
          @endif
        </div>

        @if($pdesc)
          <p class="pddesc">{{ $pdesc }}</p>
        @endif

        <a class="cbtn" href="/{{ $locale }}/contact">
          <span data-tr>Satın Almak İçin Sor</span>
          <span data-en>Inquire to Purchase</span>
        </a>
      </div>
    </div>
  </div>

  {{-- ── Kökeni / Origin Story ── --}}
  @php $originText = $pstory ?: $pdesc; @endphp
  @if($originText)
  <div class="wrap">
    <section class="origin">
      <h2>
        <span data-tr>Kökeni</span>
        <span data-en>The Origin Story</span>
      </h2>
      <p>{{ $originText }}</p>
    </section>
  </div>
  @endif

</main>

{{-- ── İlgili Ürünler ── --}}
@if($related->isNotEmpty())
<section class="related-sec">
  <div class="wrap">
    <h2>
      <span data-tr>Diğer Ürünler</span>
      <span data-en>More Products</span>
    </h2>
    <div class="rel-grid">
      @foreach($related as $rel)
        @php $rn = $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr; @endphp
        <a href="/{{ $locale }}/shop/{{ $rel->slug }}" class="sprod">
          <div class="pimg">
            @if($rel->image)
              <img src="{{ asset('storage/'.$rel->image) }}" alt="{{ $rn }}" loading="lazy">
            @endif
          </div>
          <div class="pname">{{ $rn }}</div>
          @if($rel->price)
            <div class="pprice">{{ $rel->currency }} {{ number_format($rel->price, 2) }}</div>
          @endif
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
