@extends('public.layout')

@section('title', $isEn ? 'Destinations — Sertaç Apanay' : 'Destinasyonlar — Sertaç Apanay')
@section('description', $isEn ? 'Every country explored, every city wandered — a living cartography of experience.' : 'Gezilen her ülke, dolaşılan her şehir — yaşayan bir deneyim kartografyası.')

@push('styles')
<style>
  /* HERO */
  .hero{position:relative;min-height:78vh;display:flex;align-items:flex-end;color:var(--bone);overflow:hidden}
  .hero-bg{position:absolute;inset:0;z-index:0;
    background:url('{{ asset("images/destinations-hero.jpg") }}') center/cover no-repeat}
  .hero::after{content:"";position:absolute;inset:0;z-index:1;
    background:linear-gradient(180deg,rgba(8,10,14,.5) 0%,rgba(8,10,14,.08) 35%,rgba(8,10,14,.55) 75%,rgba(8,10,14,.8) 100%)}
  .hero .wrap{position:relative;z-index:2;padding-bottom:64px;padding-top:120px;padding-left:44px;
    width:100%;max-width:100%;margin-left:0;margin-right:0}
  .hero-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.32em;text-transform:uppercase;
    color:rgba(243,239,230,.6);margin-bottom:18px}
  .hero h1{font-family:var(--display);font-weight:500;font-style:italic;
    font-size:clamp(54px,9vw,116px);line-height:.9;letter-spacing:.01em;margin-bottom:26px}
  .hero-lead{font-size:clamp(15px,1.6vw,18px);color:#d8cfc3;max-width:500px;line-height:1.65}

  /* FILTER */
  .filter-section{padding:36px 0 0}
  .filter-bar{display:flex;gap:6px;flex-wrap:wrap}
  .filter-btn{font-family:var(--mono);font-size:10.5px;letter-spacing:.14em;text-transform:uppercase;
    padding:8px 16px;border:1px solid var(--line);border-radius:2px;background:transparent;
    color:var(--muted);cursor:pointer;transition:all .2s;text-decoration:none}
  .filter-btn:hover{border-color:var(--ink);color:var(--ink)}
  .filter-btn.active{background:var(--ink);color:var(--bone);border-color:var(--ink)}

  /* COUNTRY GRID */
  .country-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:3px;margin-top:3px}
  @media(max-width:1024px){.country-grid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:768px){.country-grid{grid-template-columns:1fr}}

  .c-card{position:relative;overflow:hidden;aspect-ratio:4/3;display:block;color:var(--bone)}
  .c-card-img{position:absolute;inset:0;background-size:cover;background-position:center;
    transition:transform .6s ease}
  .c-card:hover .c-card-img{transform:scale(1.05)}
  .c-card::after{content:"";position:absolute;inset:0;
    background:linear-gradient(180deg,rgba(8,10,14,.1) 0%,rgba(8,10,14,0) 25%,rgba(8,10,14,.45) 65%,rgba(8,10,14,.78) 100%)}
  .c-body{position:absolute;bottom:0;left:0;right:0;z-index:2;padding:22px 26px 26px}
  .c-badge{font-family:var(--mono);font-size:10px;letter-spacing:.22em;text-transform:uppercase;
    color:rgba(243,239,230,.65);margin-bottom:8px}
  .c-name{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(30px,3.8vw,48px);color:#fff;line-height:.95;margin-bottom:8px}
  .c-tag{font-size:13px;color:rgba(243,239,230,.7);line-height:1.45}

  /* CITIES */
  .cities-sec{padding:72px 0 80px}
  .cities-head{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(32px,4.5vw,56px);color:var(--ink);margin-bottom:32px}
  .cities-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:2px}
  @media(max-width:1024px){.cities-grid{grid-template-columns:repeat(4,1fr)}}
  @media(max-width:768px){.cities-grid{grid-template-columns:repeat(3,1fr)}}
  @media(max-width:560px){.cities-grid{grid-template-columns:repeat(2,1fr)}}

  .city-card{padding:18px 20px;background:var(--paper);border:1px solid var(--line);
    transition:border-color .2s,background .2s;display:block;color:inherit}
  .city-card:hover{border-color:var(--coral);background:var(--bone-2)}
  .city-code{font-family:var(--mono);font-size:10px;letter-spacing:.16em;color:var(--coral);margin-bottom:7px}
  .city-name{font-size:14px;color:var(--ink);font-weight:500;letter-spacing:.01em}

  .empty-state{padding:80px 0;text-align:center;color:var(--muted)}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}

  .pagination-wrap{display:flex;justify-content:center;gap:8px;padding:40px 0 64px}
  .pagination-wrap a,.pagination-wrap span{font-family:var(--mono);font-size:12px;letter-spacing:.1em;
    padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)}
  .pagination-wrap .active-page{background:var(--ink);color:var(--bone);border-color:var(--ink)}
</style>
@endpush

@section('content')

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="wrap">
    <div class="hero-eyebrow"><span data-tr>DÜNYA İNDEKSİ</span><span data-en>THE WORLD INDEX</span></div>
    <h1 data-tr>Destinasyonlar</h1><h1 class="b" data-en>Destinations</h1>
    <p class="hero-lead" data-tr>Gezilen her ülke, dolaşılan her şehir — yaşayan bir deneyim kartografyası.</p>
    <p class="hero-lead b" data-en>Every country explored, every city wandered — a living cartography of experience.</p>
  </div>
</section>

<!-- FILTER -->
<section class="filter-section">
  <div class="wrap">
    <div class="filter-bar">
      <a href="/{{ $locale }}/places" class="filter-btn {{ !$selectedCountry ? 'active' : '' }}">
        <span data-tr>TÜMÜ</span><span data-en>ALL</span>
      </a>
      @foreach($countries as $country)
        <a href="/{{ $locale }}/places?country={{ urlencode($country) }}"
           class="filter-btn {{ $selectedCountry === $country ? 'active' : '' }}">
          {{ strtoupper($country) }}
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- COUNTRY GRID -->
<div class="wrap">
  <div class="country-grid">
    @forelse($places as $place)
      @php
        $pname   = $isEn ? ($place->name_en ?? $place->name_tr) : $place->name_tr;
        $country = $isEn ? ($place->country_en ?? $place->country_tr) : $place->country_tr;
        $excerpt = $isEn ? ($place->short_description_en ?? $place->short_description_tr ?? '') : ($place->short_description_tr ?? '');
        $imgUrl  = $place->cover_image ? asset('storage/'.$place->cover_image) : asset('images/destinations-hero.jpg');
        $ccode   = strtoupper(substr($country ?? '', 0, 2));
        $cregion = $country ?? '';
      @endphp
      <a href="/{{ $locale }}/places/{{ $place->slug }}" class="c-card">
        <div class="c-card-img" style="background-image:url('{{ $imgUrl }}')"></div>
        <div class="c-body">
          <div class="c-badge">
            @if($ccode)<span data-tr>{{ $ccode }} · {{ $cregion }}</span><span class="b" data-en>{{ $ccode }} · {{ $cregion }}</span>@endif
          </div>
          <div class="c-name">{{ $pname }}</div>
          @if($excerpt)<div class="c-tag">{{ Str::limit($excerpt, 90) }}</div>@endif
        </div>
      </a>
    @empty
      {{-- Static placeholders when DB is empty (local assets — external Unsplash hotlinks were unreliable) --}}
      @php
        $moroccoImg = asset('images/morocco.jpg');
        $peruImg = asset('images/dest-peru.jpg');
        $jordanImg = asset('images/dest-jordan.jpg');
        $japanImg = asset('images/dest-japan.jpg');
        $italyImg = asset('images/dest-italy.jpg');
        $indonesiaImg = asset('images/destinations-hero.jpg');
      @endphp
      @foreach([
        ['img'=>$peruImg,'badge_tr'=>'PE · GÜNEY AMERİKA','badge_en'=>'PE · SOUTH AMERICA','name_tr'=>'Peru','name_en'=>'Peru','tag_tr'=>'And Dağları, zamandan daha eski sırlar barındırır','tag_en'=>'The Andes hold secrets older than time'],
        ['img'=>$jordanImg,'badge_tr'=>'JO · ASYA','badge_en'=>'JO · ASIA','name_tr'=>'Ürdün','name_en'=>'Jordan','tag_tr'=>'Kumtaşı şehirler bin yıllık tarihi fısıldar','tag_en'=>'Where sandstone cities whisper millennia of history'],
        ['img'=>$japanImg,'badge_tr'=>'JP · ASYA','badge_en'=>'JP · ASIA','name_tr'=>'Japonya','name_en'=>'Japan','tag_tr'=>'Her ayrıntıda hassasiyet, güzellik ve derinlik','tag_en'=>'Precision, beauty, and depth in every detail'],
        ['img'=>$italyImg,'badge_tr'=>'IT · AVRUPA','badge_en'=>'IT · EUROPE','name_tr'=>'İtalya','name_en'=>'Italy','tag_tr'=>'Her meydanda ve tabakta tatlı hayat','tag_en'=>'La dolce vita in every piazza and plate'],
        ['img'=>$indonesiaImg,'badge_tr'=>'ID · ASYA','badge_en'=>'ID · ASIA','name_tr'=>'Endonezya','name_en'=>'Indonesia','tag_tr'=>'17.000 adada anlatılmamış hikâyeler','tag_en'=>'17,000 islands of untold stories'],
        ['img'=>$moroccoImg,'badge_tr'=>'MA · AFRİKA','badge_en'=>'MA · AFRICA','name_tr'=>'Fas','name_en'=>'Morocco','tag_tr'=>'Afrika ile Akdeniz ruhunun buluştuğu yer','tag_en'=>'Where Africa meets the Mediterranean soul'],
      ] as $ph)
      <div class="c-card">
        <div class="c-card-img" style="background-image:url('{{ $ph['img'] }}')"></div>
        <div class="c-body">
          <div class="c-badge"><span data-tr>{{ $ph['badge_tr'] }}</span><span class="b" data-en>{{ $ph['badge_en'] }}</span></div>
          <div class="c-name"><span data-tr>{{ $ph['name_tr'] }}</span><span data-en>{{ $ph['name_en'] }}</span></div>
          <div class="c-tag"><span data-tr>{{ $ph['tag_tr'] }}</span><span data-en>{{ $ph['tag_en'] }}</span></div>
        </div>
      </div>
      @endforeach
    @endforelse
  </div>
</div>

@if($places->hasPages())
<div class="wrap">
  <div class="pagination-wrap">
    @if($places->onFirstPage())<span>←</span>@else<a href="{{ $places->previousPageUrl() }}">←</a>@endif
    @foreach($places->getUrlRange(1, $places->lastPage()) as $page => $url)
      @if($page == $places->currentPage())<span class="active-page">{{ $page }}</span>
      @else<a href="{{ $url }}">{{ $page }}</a>@endif
    @endforeach
    @if($places->hasMorePages())<a href="{{ $places->nextPageUrl() }}">→</a>@else<span>→</span>@endif
  </div>
</div>
@endif

<!-- CITIES -->
<section class="cities-sec">
  <div class="wrap">
    <h2 class="cities-head"><span data-tr>Gezilen Şehirler</span><span class="b" data-en>Cities Explored</span></h2>
    <div class="cities-grid">
      @if($places->isNotEmpty())
        @foreach($places as $place)
          @php
            $pname  = $isEn ? ($place->name_en ?? $place->name_tr) : $place->name_tr;
            $ccode  = strtoupper(substr($isEn ? ($place->country_en ?? $place->country_tr ?? '') : ($place->country_tr ?? ''), 0, 2));
          @endphp
          <a href="/{{ $locale }}/places/{{ $place->slug }}" class="city-card">
            <div class="city-code">{{ $ccode }}</div>
            <div class="city-name">{{ $pname }}</div>
          </a>
        @endforeach
      @else
        @foreach([
          ['code'=>'MA','city'=>'Chefchaouen'],
          ['code'=>'IT','city'=>'Florence'],
          ['code'=>'JP','city'=>'Osaka'],
          ['code'=>'MA','city'=>'Marrakech'],
          ['code'=>'PE','city'=>'Cusco'],
          ['code'=>'IT','city'=>'Venice'],
          ['code'=>'ID','city'=>'Ubud'],
          ['code'=>'ID','city'=>'Jakarta'],
          ['code'=>'MA','city'=>'Fez'],
          ['code'=>'PE','city'=>'Lima'],
          ['code'=>'JP','city'=>'Kyoto'],
          ['code'=>'JP','city'=>'Tokyo'],
          ['code'=>'JO','city'=>'Amman'],
          ['code'=>'IT','city'=>'Rome'],
          ['code'=>'JO','city'=>'Petra'],
          ['code'=>'ID','city'=>'Denpasar'],
        ] as $c)
        <div class="city-card">
          <div class="city-code">{{ $c['code'] }}</div>
          <div class="city-name">{{ $c['city'] }}</div>
        </div>
        @endforeach
      @endif
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
  // Client-side filter (mirrors destinations.html behaviour)
  document.querySelectorAll('.filter-btn').forEach(function(btn){
    btn.addEventListener('click',function(e){
      // If it's a plain button (not a link), do JS filter; links already navigate via href
      if(btn.tagName === 'BUTTON'){
        e.preventDefault();
        document.querySelectorAll('.filter-btn').forEach(function(b){b.classList.remove('active');});
        btn.classList.add('active');
      }
    });
  });

  // Align hero wrap left to header brand mark
  function alignHero(){
    var brand = document.querySelector('.brand');
    var hw    = document.querySelector('.hero .wrap');
    if(!brand || !hw) return;
    hw.style.paddingLeft = Math.round(brand.getBoundingClientRect().left) + 'px';
  }
  window.addEventListener('load', alignHero);
  window.addEventListener('resize', alignHero);
  alignHero();
</script>
@endpush
