@extends('public.layout')

@section('title', $isEn ? 'Shop — Sertaç Apanay' : 'Çarşı — Sertaç Apanay')
@section('description', $isEn ? 'Travel-inspired objects and curated finds from around the world.' : 'Seyahatten ilham alınmış objeler ve dünyanın dört bir yanından özenle seçilmiş eserler.')

@push('styles')
<style>
  .page-head{padding:140px 0 50px;border-bottom:1px solid var(--line)}
  .page-head .wrap{padding-left:44px;width:100%;max-width:100%;margin:0}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:var(--coral);display:block;margin-bottom:16px}
  .page-title{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(42px,7vw,86px);line-height:1;margin:0}
  .page-lead{margin:18px 0 0;color:var(--muted);font-size:17px;max-width:560px;line-height:1.7}

  .filter-bar{display:flex;gap:8px;flex-wrap:wrap;padding:28px 0;border-bottom:1px solid var(--line)}
  .filter-btn{font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;
    padding:7px 18px;border-radius:20px;border:1px solid var(--line);background:transparent;
    color:var(--muted);cursor:pointer;transition:.2s;text-decoration:none}
  .filter-btn:hover,.filter-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  .shop-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:26px;padding:48px 0 90px}
  @media(max-width:1000px){.shop-grid{grid-template-columns:repeat(3,1fr)}}
  @media(max-width:700px){.shop-grid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:440px){.shop-grid{grid-template-columns:1fr}}

  .sprod{display:block;color:inherit}
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

  .empty-state{padding:80px 0;text-align:center;color:var(--muted);grid-column:1/-1}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}

  .pagination-wrap{display:flex;justify-content:center;gap:8px;padding:0 0 64px;grid-column:1/-1}
  .pagination-wrap a,.pagination-wrap span{font-family:var(--mono);font-size:12px;letter-spacing:.1em;
    padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)}
  .pagination-wrap .active-page{background:var(--ink);color:var(--bone);border-color:var(--ink)}
</style>
@endpush

@section('content')
<section class="page-head">
  <div class="wrap">
    <span class="page-eyebrow"><span data-tr>ÇARŞI</span><span data-en>SHOP</span></span>
    <h1 class="page-title"><span data-tr>Seyahat<br>Eşyaları</span><span data-en>Travel<br>Objects</span></h1>
    <p class="page-lead" data-tr>Seyahatten ilham alınmış, dünyanın dört bir yanından özenle seçilmiş eserler.</p>
    <p class="page-lead b" data-en>Travel-inspired objects and curated finds from around the world.</p>
  </div>
</section>

<main>
  <div class="wrap">
    @if($categories->isNotEmpty())
    <div class="filter-bar">
      <a href="/{{ $locale }}/shop" class="filter-btn {{ !$selectedCategory ? 'active' : '' }}">
        <span data-tr>Tümü</span><span data-en>All</span>
      </a>
      @foreach($categories as $cat)
        <a href="/{{ $locale }}/shop?category={{ urlencode($cat) }}"
           class="filter-btn {{ $selectedCategory === $cat ? 'active' : '' }}">{{ $cat }}</a>
      @endforeach
    </div>
    @endif

    <div class="shop-grid">
      @forelse($products as $product)
        @php $pname = $isEn ? ($product->title_en ?? $product->title_tr) : $product->title_tr; @endphp
        @php $psrc  = $isEn ? ($product->source_place_en ?? $product->source_place_tr) : $product->source_place_tr; @endphp
        @php $pcat  = $isEn ? ($product->category_en ?? $product->category_tr) : $product->category_tr; @endphp
        <a href="/{{ $locale }}/shop/{{ $product->slug }}" class="sprod">
          <div class="pimg">
            @if($product->image)
              <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $pname }}">
            @endif
          </div>
          @if($psrc)<div class="src">{{ $psrc }}</div>@endif
          <div class="pname">{{ $pname }}</div>
          <div class="prow">
            @if($product->price)
              <span class="price">{{ $product->currency }} {{ number_format($product->price, 0) }}</span>
            @endif
            @if($pcat)<span class="cat">{{ $pcat }}</span>@endif
          </div>
        </a>
      @empty
        <div class="empty-state">
          <p data-tr>Henüz ürün eklenmedi</p>
          <p class="b" data-en>No products yet. Coming soon.</p>
        </div>
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
</main>
@endsection
