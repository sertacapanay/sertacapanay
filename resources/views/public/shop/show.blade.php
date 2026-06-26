@extends('public.layout')

@php
  $pname = $isEn ? ($product->title_en ?? $product->title_tr) : $product->title_tr;
  $psrc  = $isEn ? ($product->source_place_en ?? $product->source_place_tr) : $product->source_place_tr;
  $pcat  = $isEn ? ($product->category_en ?? $product->category_tr) : $product->category_tr;
  $pdesc = $isEn ? ($product->description_en ?? $product->description_tr) : $product->description_tr;
@endphp

@section('title', $pname.' — Çarşı — Sertaç Apanay')
@section('description', Str::limit(strip_tags($pdesc), 155))

@push('styles')
<style>
  .pd-section{padding:90px 0 60px}
  .pd{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start}
  .pd .pdimg{aspect-ratio:4/5;border-radius:4px;overflow:hidden;background:var(--bone-2)}
  .pd .pdimg img{width:100%;height:100%;object-fit:cover}
  .back-link{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--muted);display:inline-block;margin-bottom:30px;transition:color .2s}
  .back-link:hover{color:var(--coral)}
  .pd .pdsrc{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--coral)}
  .pd .pdcat{font-family:var(--mono);font-size:10px;letter-spacing:.08em;text-transform:uppercase;
    color:var(--muted);border:1px solid var(--line);padding:3px 10px;border-radius:30px;display:inline-block;margin-top:8px}
  .pd h1{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(32px,4.5vw,50px);margin:14px 0 8px;color:var(--ink)}
  .pd .pdprice{font-size:22px;color:var(--ink);margin-bottom:22px;font-weight:500}
  .pd .pddesc{color:var(--muted);font-size:16px;line-height:1.78;margin-bottom:28px}
  .pd .wa-btn{display:inline-block;background:#25D366;color:#fff;padding:15px 30px;
    font-family:var(--mono);font-size:12px;letter-spacing:.1em;text-transform:uppercase;
    transition:background .2s;border-radius:3px}
  .pd .wa-btn:hover{background:#20b858}

  .origin{max-width:760px;margin:0 auto;padding:40px 44px 80px;border-top:1px solid var(--line)}
  .origin h2{font-family:var(--display);font-style:italic;font-size:26px;margin:0 0 14px;color:var(--ink)}
  .origin p{color:var(--muted);font-size:16px;line-height:1.8}

  .related-products{background:var(--bone-2);padding:56px 0}
  .related-products h2{font-family:var(--display);font-style:italic;font-size:30px;margin:0 0 30px;color:var(--ink)}
  .rel-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
  .sprod{display:block;color:inherit}
  .sprod .pimg{aspect-ratio:3/4;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:12px}
  .sprod .pimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .sprod:hover .pimg img{transform:scale(1.04)}
  .sprod .pname{font-family:var(--display);font-style:italic;font-size:18px;margin:0 0 4px;color:var(--ink);transition:color .2s}
  .sprod:hover .pname{color:var(--coral)}
  .sprod .price{font-family:var(--mono);font-size:12px;color:var(--muted)}

  @media(max-width:900px){.pd{grid-template-columns:1fr;gap:28px}.rel-grid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:500px){.rel-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<main>
  <div class="wrap pd-section">
    <a href="/{{ $locale }}/shop" class="back-link">← <span data-tr>Çarşıya Dön</span><span data-en>Back to Shop</span></a>
    <div class="pd">
      <div class="pdimg">
        @if($product->image)
          <img src="{{ asset('storage/'.$product- loading="lazy">image) }}" alt="{{ $pname }}">
        @endif
      </div>
      <div class="pd-info">
        @if($psrc)<div class="pdsrc">{{ $psrc }}</div>@endif
        @if($pcat)<div class="pdcat">{{ $pcat }}</div>@endif
        <h1>{{ $pname }}</h1>
        @if($product->price)
          <div class="pdprice">{{ $product->currency }} {{ number_format($product->price, 0) }}</div>
        @endif
        @if($pdesc)<div class="pddesc">{{ $pdesc }}</div>@endif
        <a href="https://wa.me/905XXXXXXXXX?text={{ urlencode($pname.' hakkında bilgi almak istiyorum.') }}"
           target="_blank" rel="noopener" class="wa-btn">
          <span data-tr>WhatsApp ile Sor</span><span data-en>Ask via WhatsApp</span>
        </a>
      </div>
    </div>
  </div>
</main>

@if($related->isNotEmpty())
<section class="related-products">
  <div class="wrap">
    <h2 data-tr>Diğer Ürünler</h2>
    <h2 class="b" data-en>More Products</h2>
    <div class="rel-grid">
      @foreach($related as $rel)
        @php $rn = $isEn ? ($rel->title_en ?? $rel->title_tr) : $rel->title_tr; @endphp
        <a href="/{{ $locale }}/shop/{{ $rel->slug }}" class="sprod">
          <div class="pimg">
            @if($rel->image)<img src="{{ asset('storage/'.$rel- loading="lazy">image) }}" alt="{{ $rn }}">@endif
          </div>
          <div class="pname">{{ $rn }}</div>
          @if($rel->price)<div class="price">{{ $rel->currency }} {{ number_format($rel->price, 0) }}</div>@endif
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
