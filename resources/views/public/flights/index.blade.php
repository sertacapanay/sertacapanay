@extends('public.layout')

@section('title', $isEn ? 'Flight Log — Sertaç Apanay' : 'Uçuş Günlüğü — Sertaç Apanay')
@section('description', $isEn ? 'A log of flights taken across the world.' : 'Dünya genelindeki uçuşların kaydı.')

@push('styles')
<style>
  .page-hero{position:relative;min-height:52vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center 30%;
    background-image:linear-gradient(180deg,rgba(8,10,14,.45) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),
      url('{{ asset("images/hero.jpg") }}');color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,80px);font-style:italic;font-weight:400;line-height:1.05}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  .stats-row{display:grid;grid-template-columns:repeat(3,1fr);border-bottom:1px solid var(--line);background:var(--paper)}
  .stat-item{padding:48px 24px;text-align:center;border-right:1px solid var(--line)}
  .stat-item:last-child{border-right:0}
  .stat-item .num{font-family:var(--display);font-size:56px;font-weight:500;line-height:1;font-feature-settings:"onum" 1}
  .stat-item .lbl{font-family:var(--mono);font-size:11px;letter-spacing:.15em;text-transform:uppercase;color:var(--muted);margin-top:12px}
  @media(max-width:640px){.stats-row{grid-template-columns:1fr}.stat-item{border-right:0;border-bottom:1px solid var(--line)}}

  .flog-wrap{padding:48px 0 90px}
  .flog{border-top:1px solid var(--line)}
  .frow{display:grid;grid-template-columns:90px 1fr auto;gap:24px;align-items:center;
    padding:22px 4px;border-bottom:1px solid var(--line);transition:background .15s}
  .frow:hover{background:var(--paper)}
  .frow .fno{font-family:var(--mono);font-size:13px;letter-spacing:.06em;color:var(--coral)}
  .frow .fair{color:var(--ink);font-size:15px;line-height:1.3}
  .frow .fair small{display:block;font-size:12px;color:var(--muted);margin-top:3px;font-family:var(--mono)}
  .frow .froute{font-family:var(--display);font-style:italic;font-size:24px;color:var(--ink);white-space:nowrap}
  .frow .froute .ar{color:var(--muted);margin:0 10px}
  .empty-state{padding:80px 0;text-align:center;color:var(--muted)}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}
  .empty-state span{font-size:15px}
  @media(max-width:600px){
    .frow{grid-template-columns:70px 1fr;gap:6px 16px}
    .frow .froute{grid-column:1/-1;font-size:19px}
  }
</style>
@endpush

@section('content')
<section class="page-hero">
  <div class="wrap">
    <div class="page-eyebrow"><span data-tr>UÇUŞ GÜNLÜĞÜ</span><span data-en>FLIGHT LOG</span></div>
    <h1 class="page-title"><span data-tr>Gökyüzü<br>Yolculukları</span><span data-en>Sky<br>Journeys</span></h1>
    <p class="page-lead" data-tr>Dünya semalarında iz bırakan uçuşlar, rotalar ve anlar.</p>
    <p class="page-lead b" data-en>Flights that left a mark across the world's skies — routes, moments and miles.</p>
  </div>
</section>

@if($total > 0)
<div class="stats-row">
  <div class="stat-item">
    <div class="num">{{ $total }}</div>
    <div class="lbl"><span data-tr>Toplam Uçuş</span><span data-en>Total Flights</span></div>
  </div>
  <div class="stat-item">
    <div class="num">{{ number_format($km) }}</div>
    <div class="lbl"><span data-tr>Toplam km</span><span data-en>Total km</span></div>
  </div>
  <div class="stat-item">
    <div class="num">{{ $flights->unique(fn($f) => implode('|', array_filter([$f->from_city, $f->to_city])))->count() }}</div>
    <div class="lbl"><span data-tr>Farklı Rota</span><span data-en>Unique Routes</span></div>
  </div>
</div>
@endif

<main>
  <div class="wrap flog-wrap">
    @if($flights->isEmpty())
      <div class="empty-state">
        <p data-tr>Henüz uçuş kaydı yok</p>
        <p class="b" data-en>No flights logged yet</p>
        <span data-tr>Yakında eklenecek...</span>
        <span data-en>Coming soon...</span>
      </div>
    @else
      <div class="flog">
        @foreach($flights as $i => $flight)
        <div class="frow">
          <div class="fno">{{ str_pad($i+1, 3, '0', STR_PAD_LEFT) }}</div>
          <div class="fair">
            {{ $flight->airline }}
            @if($flight->flight_number)<small>{{ $flight->flight_number }}</small>@endif
            @if($flight->flight_date)<small>{{ \Carbon\Carbon::parse($flight->flight_date)->locale($locale)->isoFormat('D MMM YYYY') }}</small>@endif
          </div>
          <div class="froute">
            {{ $flight->from_city ?? '—' }}
            <span class="ar">→</span>
            {{ $flight->to_city ?? '—' }}
          </div>
        </div>
        @endforeach
      </div>
    @endif
  </div>
</main>
@endsection
