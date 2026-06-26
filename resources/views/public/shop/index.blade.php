@extends('public.layout')

@section('title', $isEn ? 'Shop — Sertaç Apanay' : 'Çarşı — Sertaç Apanay')
@section('description', $isEn ? 'Every item carries a story — curated from destinations around the world.' : 'Her parça bir hikâye taşır — dünyanın dört bir yanından derlendi.')

@push('styles')
<style>
  /* PAGE HERO */
  .page-hero{
    position:relative;min-height:56vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center;color:var(--bone);
    background-image:linear-gradient(180deg,rgba(8,10,14,.4) 0%,rgba(8,10,14,.12) 42%,rgba(8,10,14,.62) 100%),
      url('{{ asset("images/shop-hero.jpg") }}')
  }
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:12px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(255,255,255,.85);margin-bottom:16px;display:block}
  .page-title{font-family:var(--display);font-size:clamp(40px,7vw,86px);font-style:italic;font-weight:500;line-height:1.05;margin:0}
  .page-lead{font-size:17px;color:rgba(243,239,230,.88);margin-top:14px;max-width:520px;line-height:1.7}

  /* PAGE BODY */
  .page-body{padding:56px 0 90px}

  /* CATEGORY FILTERS */
  .cat-filters{display:flex;gap:8px;flex-wrap:wrap;padding:0 0 28px;border-bottom:1px solid var(--line);margin-bottom:48px}
  .cat-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .cat-btn:hover,.cat-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  /* SHOP GRID */
  .shop-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:26px}
  @media(max-width:1000px){.shop-grid{grid-template-columns:repeat(3,1fr)}}
  @media(max-width:700px){.shop-grid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:440px){.shop-grid{grid-template-columns:1fr}}

  .sprod{display:block;color:inherit;text-decoration:none}
  .sprod .pimg{aspect-ratio:3/4;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:14px}
  .sprod .pimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .sprod:hover .pimg img{transform:scale(1.04)}
  .sprod .src{font-family:var(--mono);font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--coral);display:block;margin-bottom:6px}
  .sprod .pname{font-family:var(--display);font-style:italic;font-size:20px;margin:0 0 6px;
    color:var(--ink);line-height:1.15;transition:color .2s}
  .sprod:hover .pname{color:var(--coral)}
  .sprod .prow{display:flex;justify-content:space-between;align-items:center}
  .sprod .price{font-family:var(--mono);font-size:13px;color:var(--muted)}
  .sprod .cat{font-family:var(--mono);font-size:10px;letter-spacing:.08em;text-transform:uppercase;
    color:var(--muted);border:1px solid var(--line);padding:3px 8px;border-radius:30px}

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
    <span class="page-eyebrow" data-tr>Çarşı</span><span class="page-eyebrow b" data-en>Shop</span>
    <h1 class="page-title"><span data-tr>Çarşı</span><span data-en>Shop</span></h1>
    <p class="page-lead"><span data-tr>Her parça bir hikâye taşır — dünyanın dört bir yanından derlendi.</span><span class="b" data-en>Every item carries a story — curated from destinations around the world.</span></p>
  </div>
</section>

<main class="page">
  <section class="page-body">
    <div class="wrap">

      @if($categories->isNotEmpty())
      <div class="cat-filters">
        <a href="/{{ $locale }}/shop" class="cat-btn {{ !$selectedCategory ? 'active' : '' }}">
          <span data-tr>Tümü</span><span data-en>All</span>
        </a>
        @foreach($categories as $cat)
          <a href="/{{ $locale }}/shop?category={{ urlencode($cat) }}"
             class="cat-btn {{ $selectedCategory === $cat ? 'active' : '' }}">{{ $cat }}</a>
        @endforeach
      </div>
      @endif

      <div class="shop-grid">
        @forelse($products as $product)
          @php
            $pname = $isEn ? ($product->title_en ?? $product->title_tr) : $product->title_tr;
            $psrc  = $isEn ? ($product->source_place_en ?? $product->source_place_tr) : $product->source_place_tr;
            $pcat  = $isEn ? ($product->category_en ?? $product->category_tr) : $product->category_tr;
          @endphp
          <a href="/{{ $locale }}/shop/{{ $product->slug }}" class="sprod">
            <div class="pimg">
              @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $pname }}" loading="lazy">
              @else
                @php $fi = (($loop->index % 4) + 1); @endphp
                <img src="{{ asset('images/shop-prod'.$fi.'.jpg') }}" alt="{{ $pname }}" loading="lazy">
              @endif
            </div>
            @if($psrc)<span class="src">{{ $psrc }}</span>@endif
            <div class="pname">{{ $pname }}</div>
            <div class="prow">
              @if($product->price)
                <span class="price">{{ $product->currency ?? '$' }} {{ number_format($product->price, 2) }}</span>
              @endif
              @if($pcat)<span class="cat">{{ $pcat }}</span>@endif
            </div>
          </a>
        @empty
          {{-- Static placeholders --}}
          @php
            $p1 = asset('images/shop-prod1.jpg');
            $p2 = asset('images/shop-prod2.jpg');
            $p3 = asset('images/shop-prod3.jpg');
            $p4 = asset('images/shop-prod4.jpg');
          @endphp
          @foreach([
            ['img'=>$p1,'src_tr'=>'Kaynak: Ubud, Bali','src_en'=>'Sourced in Ubud, Bali','name_tr'=>'El Dokuması İkat Atkı','name_en'=>'Handwoven Ikat Scarf','price'=>'$95.00','cat_tr'=>'tekstil','cat_en'=>'apparel'],
            ['img'=>$p2,'src_tr'=>'Kaynak: Marakeş, Fas','src_en'=>'Sourced in Marrakech, Morocco','name_tr'=>'Zellige Seramik Kâse','name_en'=>'Zellige Ceramic Bowl','price'=>'$52.00','cat_tr'=>'el sanatı','cat_en'=>'local crafts'],
            ['img'=>$p3,'src_tr'=>'Kaynak: İstanbul, Türkiye','src_en'=>'Sourced in Istanbul, Turkey','name_tr'=>'Antika Pirinç Pusula','name_en'=>'Vintage Brass Compass','price'=>'$145.00','cat_tr'=>'aksesuar','cat_en'=>'accessories'],
            ['img'=>$p4,'src_tr'=>'Kaynak: Fez, Fas','src_en'=>'Sourced in Fez, Morocco','name_tr'=>'El Yapımı Deri Seyahat Defteri','name_en'=>'Artisan Leather Travel Journal','price'=>'$68.00','cat_tr'=>'aksesuar','cat_en'=>'accessories'],
          ] as $ph)
          <div class="sprod">
            <div class="pimg">
              <img src="{{ $ph['img'] }}" alt="" loading="lazy">
            </div>
            <span class="src">
              <span data-tr>{{ $ph['src_tr'] }}</span><span class="b" data-en>{{ $ph['src_en'] }}</span>
            </span>
            <div class="pname">
              <span data-tr>{{ $ph['name_tr'] }}</span><span class="b" data-en>{{ $ph['name_en'] }}</span>
            </div>
            <div class="prow">
              <span class="price">{{ $ph['price'] }}</span>
              <span class="cat"><span data-tr>{{ $ph['cat_tr'] }}</span><span class="b" data-en>{{ $ph['cat_en'] }}</span></span>
            </div>
          </div>
          @endforeach
        @endforelse

        @if($products->hasPages())
        <div class="pagination-wrap">
          @if($products->onFirstPage())<span>←</span>@else<a href="{{ $products->previousPageUrl() }}">←</a>@endif
          @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if($page == $products->currentPage())
              <span class="active-page">{{ $page }}</span>
            @else
              <a href="{{ $url }}">{{ $page }}</a>
            @endif
          @endforeach
          @if($products->hasMorePages())<a href="{{ $products->nextPageUrl() }}">→</a>@else<span>→</span>@endif
        </div>
        @endif
      </div>

    </div>
  </section>
</main>
@endsection
