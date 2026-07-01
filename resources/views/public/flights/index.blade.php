@extends('public.layout')

@section('title', $isEn ? 'Flight Log — Sertaç Apanay' : 'Uçuş Günlüğü — Sertaç Apanay')
@section('description', $isEn ? 'A log of flights taken across the world.' : 'Dünya genelindeki uçuşların kaydı.')

@push('styles')
<style>
  .page-hero{
    position:relative;min-height:56vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center 30%;
    background-image:linear-gradient(180deg,rgba(8,10,14,.45) 0%,rgba(8,10,14,.1) 42%,rgba(8,10,14,.65) 100%),
      url('{{ asset("images/flights-hero.jpg") }}');
    color:var(--bone)
  }
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,80px);font-style:italic;font-weight:400;line-height:1.05}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  .fstats{display:grid;grid-template-columns:repeat(4,1fr);background:var(--paper);border-bottom:1px solid var(--line)}
  .fstat{padding:40px 24px;text-align:center;border-right:1px solid var(--line)}
  .fstat:last-child{border-right:0}
  .fstat-num{font-family:var(--display);font-size:54px;font-weight:500;line-height:1;color:var(--ink)}
  .fstat-lbl{font-family:var(--mono);font-size:11px;letter-spacing:.15em;text-transform:uppercase;color:var(--muted);margin-top:10px;line-height:1.4}

  .flog-body{padding:48px 0 90px}
  .fl-list{display:flex;flex-direction:column;gap:3px}
  .fcard{display:grid;grid-template-columns:80px 1fr auto;gap:0 28px;align-items:center;
    padding:20px 22px;border:1px solid var(--line);border-radius:4px;background:var(--paper);transition:box-shadow .2s}
  .fcard:hover{box-shadow:0 4px 18px rgba(8,10,14,.08)}
  .fcard-num{font-family:var(--mono);font-size:12px;letter-spacing:.06em;color:var(--coral)}
  .fcard-route{font-family:var(--display);font-style:italic;font-size:26px;color:var(--ink)}
  .fcard-route .arr{color:var(--muted);margin:0 12px;font-style:normal;font-size:20px}
  .fcard-meta{text-align:right;font-family:var(--mono);font-size:11px;color:var(--muted);line-height:1.8}
  .fcard-meta strong{display:block;font-weight:400;color:var(--ink);font-family:var(--ui)}

  .empty-state{padding:80px 0;text-align:center;color:var(--muted)}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}
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
    <div class="fstat-num">{{ $total }}</div>
    <div class="fstat-lbl"><span data-tr>Toplam Uçuş</span><span data-en>Total Flights</span></div>
  </div>
  <div class="fstat">
    <div class="fstat-num">{{ $total > 0 ? number_format($km) : 0 }}</div>
    <div class="fstat-lbl"><span data-tr>Toplam km</span><span data-en>Distance km</span></div>
  </div>
  <div class="fstat">
    <div class="fstat-num">{{ $total > 0 ? round($km / 850) : 0 }}</div>
    <div class="fstat-lbl"><span data-tr>Tahmini Saat</span><span data-en>Hours Airborne</span></div>
  </div>
  <div class="fstat">
    <div class="fstat-num">{{ $flights->pluck('airline')->filter()->unique()->count() }}</div>
    <div class="fstat-lbl"><span data-tr>Havayolu</span><span data-en>Airlines</span></div>
  </div>
</div>

<main class="page">
  <div class="wrap flog-body">
    @if($flights->isEmpty())
      <div class="empty-state">
        <p data-tr>Henüz uçuş kaydı yok</p>
        <p class="b" data-en>No flights logged yet</p>
      </div>
    @else
      <div class="fl-list">
        @php $idx = 1; @endphp
        @foreach($flights as $flight)
        <div class="fcard">
          <div class="fcard-num">
            {{ $flight->flight_number ?? str_pad($idx, 3, '0', STR_PAD_LEFT) }}
          </div>
          <div class="fcard-route">
            {{ $flight->from_city ?? '—' }}
            <span class="arr">→</span>
            {{ $flight->to_city ?? '—' }}
          </div>
          <div class="fcard-meta">
            @if($flight->airline)
              <strong>{{ $flight->airline }}</strong>
            @endif
            @if($flight->distance_km)
              {{ number_format($flight->distance_km) }} km · {{ round($flight->distance_km / 850) }} {{ $isEn ? 'hr' : 'sa' }}
            @endif
            @if($flight->flight_date)
              {{ \Carbon\Carbon::parse($flight->flight_date)->locale($locale)->isoFormat('D MMM YYYY') }}
            @endif
          </div>
        </div>
        @php $idx++; @endphp
        @endforeach
      </div>
    @endif
  </div>
</main>
@endsection
