@extends('public.layout')

@section('title', $isEn ? 'Flight Log — Sertaç Apanay' : 'Uçuş Günlüğü — Sertaç Apanay')
@section('description', $isEn ? 'A log of flights taken across the world.' : 'Dünya genelindeki uçuşların kaydı.')

@push('styles')
<style>
  /* Hero */
  .page-hero{position:relative;min-height:56vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center 30%;
    background-image:linear-gradient(180deg,rgba(8,10,14,.45) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),
      url('{{ asset("images/flights-hero.jpg") }}');color:var(--bone)}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,80px);font-style:italic;font-weight:400;line-height:1.05}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  /* Stats strip — 4-col per HTML reference */
  .fstats{display:grid;grid-template-columns:repeat(4,1fr);background:var(--paper);border-bottom:1px solid var(--line)}
  .fstat{padding:40px 24px;text-align:center;border-right:1px solid var(--line)}
  .fstat:last-child{border-right:0}
  .fstat .n{font-family:var(--display);font-size:54px;font-weight:500;line-height:1;
    font-feature-settings:"onum" 1;color:var(--ink)}
  .fstat .l{font-family:var(--mono);font-size:11px;letter-spacing:.15em;text-transform:uppercase;
    color:var(--muted);margin-top:10px;line-height:1.4}
  @media(max-width:720px){.fstats{grid-template-columns:repeat(2,1fr)}.fstat:nth-child(2){border-right:0}}
  @media(max-width:400px){.fstats{grid-template-columns:1fr}.fstat{border-right:0}}

  /* Flight list */
  .page-body{padding:48px 0 90px}
  .fl-list{display:flex;flex-direction:column;gap:3px}

  .fcard{display:grid;grid-template-columns:auto 1fr auto;gap:20px 28px;align-items:center;
    padding:20px 22px;border:1px solid var(--line);border-radius:4px;background:var(--paper);
    transition:box-shadow .2s}
  .fcard:hover{box-shadow:0 4px 18px rgba(8,10,14,.08)}
  .fl-no{font-family:var(--mono);font-size:12px;letter-spacing:.06em;color:var(--coral);
    display:flex;align-items:center;gap:8px}
  .fl-no svg{width:16px;height:16px;opacity:.6}
  .fl-route{display:flex;align-items:center;gap:0}
  .fl-end{text-align:center}
  .fl-end .code{font-family:var(--display);font-style:italic;font-size:28px;
    font-weight:500;line-height:1;color:var(--ink)}
  .fl-end .city{font-family:var(--mono);font-size:10px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--muted);margin-top:4px}
  .fl-mid{flex:1;display:flex;align-items:center;justify-content:center;color:var(--line);padding:0 16px}
  .fl-mid svg{width:24px;height:24px}
  .fl-meta{text-align:right;font-family:var(--mono);font-size:11px;color:var(--muted);line-height:1.7}
  .fl-meta strong{display:block;font-weight:400;color:var(--ink)}

  .empty-state{padding:80px 0;text-align:center;color:var(--muted)}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}

  @media(max-width:680px){
    .fcard{grid-template-columns:1fr auto;grid-template-rows:auto auto}
    .fl-no{grid-column:1;grid-row:2}
    .fl-route{grid-column:1/-1;grid-row:1}
    .fl-meta{grid-column:2;grid-row:2;text-align:right}
    .fl-end .code{font-size:22px}
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

<div class="fstats">
  <div class="fstat">
    <div class="n">{{ $total }}</div>
    <div class="l"><span data-tr>Toplam Uçuş</span><span data-en>Total Flights</span></div>
  </div>
  <div class="fstat">
    <div class="n">{{ $total > 0 ? number_format($km) : 0 }}</div>
    <div class="l"><span data-tr>Toplam km</span><span data-en>Distance km</span></div>
  </div>
  <div class="fstat">
    <div class="n">{{ $total > 0 ? round($km / 850) : 0 }}</div>
    <div class="l"><span data-tr>Tahmini Saat</span><span data-en>Hours Airborne</span></div>
  </div>
  <div class="fstat">
    <div class="n">{{ $flights->pluck('airline')->filter()->unique()->count() }}</div>
    <div class="l"><span data-tr>Havayolu</span><span data-en>Airlines</span></div>
  </div>
</div>

<main class="page">
  <div class="wrap page-body">
    @if($flights->isEmpty())
      <div class="empty-state">
        <p data-tr>Henüz uçuş kaydı yok</p>
        <p class="b" data-en>No flights logged yet</p>
      </div>
    @else
      <div class="fl-list" id="fl-list">
        @foreach($flights as $i => $flight)
        <div class="fcard">
          <div class="fl-no">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
            </svg>
            {{ $flight->flight_number ?? str_pad($i+1, 3, '0', STR_PAD_LEFT) }}
          </div>
          <div class="fl-route">
            <div class="fl-end from">
              <div class="code">{{ $flight->from_code ?? strtoupper(substr($flight->from_city ?? '---', 0, 3)) }}</div>
              <div class="city">{{ $flight->from_city ?? '—' }}</div>
            </div>
            <div class="fl-mid">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                <path d="M5 12h14M15 7l5 5-5 5"/>
              </svg>
            </div>
            <div class="fl-end to">
              <div class="code">{{ $flight->to_code ?? strtoupper(substr($flight->to_city ?? '---', 0, 3)) }}</div>
              <div class="city">{{ $flight->to_city ?? '—' }}</div>
            </div>
          </div>
          <div class="fl-meta">
            @if($flight->airline)<strong>{{ $flight->airline }}</strong>@endif
            @if($flight->distance_km){{ number_format($flight->distance_km) }} km@endif
            @if($flight->flight_date)
              {{ \Carbon\Carbon::parse($flight->flight_date)->locale($locale)->isoFormat('D MMM YYYY') }}
            @endif
          </div>
        </div>
        @endforeach
      </div>
    @endif
  </div>
</main>
@endsection
