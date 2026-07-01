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
  .fstat-sub{font-family:var(--mono);font-size:11px;color:var(--coral);margin-top:8px;letter-spacing:.04em}

  .flog-body{padding:48px 0 90px}
  .fl-list{display:flex;flex-direction:column;gap:10px}

  .fcard{display:flex;align-items:center;gap:24px;flex-wrap:wrap;
    padding:20px 24px;border:1px solid var(--line);border-radius:4px;background:var(--paper);transition:box-shadow .2s}
  .fcard:hover{box-shadow:0 4px 18px rgba(8,10,14,.08)}

  .fcard-code{display:flex;align-items:center;gap:8px;flex-shrink:0;width:76px}
  .fcard-code svg{width:16px;height:16px;color:var(--muted);flex-shrink:0}
  .fcard-code span{font-family:var(--mono);font-size:12px;letter-spacing:.04em;color:var(--coral)}

  .fcard-route{flex:1 1 260px;display:flex;align-items:center;gap:16px;min-width:0}
  .fcard-airport{flex-shrink:0}
  .fcard-airport .code{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted)}
  .fcard-airport .city{font-family:var(--ui);font-size:17px;color:var(--ink);margin-top:2px;white-space:nowrap}
  .fcard-line{flex:1 1 auto;min-width:32px;height:1px;background:var(--line);position:relative}
  .fcard-line svg{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) rotate(90deg);
    width:15px;height:15px;color:var(--muted);background:var(--paper);padding:0 6px}

  .fcard-stats{display:flex;align-items:center;gap:28px;flex-shrink:0;margin-left:auto;
    font-family:var(--mono);font-size:12px;color:var(--muted);white-space:nowrap}
  .fcard-stats .item{text-align:right}

  .empty-state{padding:80px 0;text-align:center;color:var(--muted)}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}

  @media (max-width:860px){
    .fcard{gap:16px}
    .fcard-stats{width:100%;margin-left:0;justify-content:space-between;padding-top:14px;border-top:1px solid var(--line)}
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
    @php $worldTours = $total > 0 ? $km / 40075 : 0; @endphp
    <div class="fstat-sub">
      <span data-tr>Dünyanın etrafını {{ number_format($worldTours, 1) }} kez turladı</span>
      <span data-en>Circled the globe {{ number_format($worldTours, 1) }} times</span>
    </div>
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
        @php
          $idx = 1;
          $airportCodes = [
            'İstanbul' => 'IST', 'Ankara' => 'ESB', 'Antalya' => 'AYT', 'Gazipaşa' => 'GZP',
            'Kayseri' => 'ASR', 'Cenova' => 'GOA', 'Singapur' => 'SIN', 'Sao Paulo' => 'GRU',
            'Nevşehir' => 'NAV', 'Barselona' => 'BCN', 'Nice' => 'NCE', 'Torino' => 'TRN',
            'Malta' => 'MLA', 'Catania' => 'CTA', 'Palermo' => 'PMO', 'Marsilya' => 'MRS',
            'Cancun' => 'CUN', 'Havana' => 'HAV', 'Mexico City' => 'MEX', 'Miami' => 'MIA',
            'Mumbai' => 'BOM', 'Male' => 'MLE', 'Katmandu' => 'KTM', 'Delhi' => 'DEL',
            'Bologna' => 'BLQ', 'Helsinki' => 'HEL', 'Vilnius' => 'VNO', 'Amsterdam' => 'AMS',
            'Atina' => 'ATH', 'Madrid' => 'MAD', 'Lizbon' => 'LIS', 'Napoli' => 'NAP',
            'Venedik' => 'VCE', 'Berlin' => 'TXL', 'Oslo' => 'OSL', 'Bangkok' => 'BKK',
            'Varanasi' => 'VNS', 'Londra' => 'LHR', 'Edinburgh' => 'EDI', 'Johannesburg' => 'JNB',
            'Cape Town' => 'CPT', 'Ho Chi Minh' => 'SGN', 'Hanoi' => 'HAN', 'Osaka' => 'KIX',
            'Tokyo' => 'NRT', 'Roma' => 'FCO', 'Stockholm' => 'ARN', 'Kopenhag' => 'CPH',
            'Moskova' => 'VKO', 'St. Petersburg' => 'LED', 'Milano' => 'MXP', 'Hamburg' => 'HAM',
            'Buenos Aires' => 'EZE', 'Rovaniemi' => 'RVN', 'Brüksel' => 'CRL', 'İzmir' => 'ADB',
            'Bakü' => 'GYD',
          ];
        @endphp
        @foreach($flights as $flight)
        @php
          $code = $flight->flight_number ?? str_pad($total - $idx + 1, 3, '0', STR_PAD_LEFT);
          $fromCode = $airportCodes[$flight->from_city] ?? null;
          $toCode = $airportCodes[$flight->to_city] ?? null;
        @endphp
        <div class="fcard">
          <div class="fcard-code">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
              <path d="M10.5 21l1.5-6.5L21 10l-1-2-9 2.5L7 5H5l2 7.5L2 14l1 2 5-1.5L9.5 21z"/>
            </svg>
            <span>{{ $code }}</span>
          </div>
          <div class="fcard-route">
            <div class="fcard-airport">
              @if($fromCode)<div class="code">{{ $fromCode }}</div>@endif
              <div class="city">{{ $flight->from_city ?? '—' }}</div>
            </div>
            <div class="fcard-line">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                <path d="M10.5 21l1.5-6.5L21 10l-1-2-9 2.5L7 5H5l2 7.5L2 14l1 2 5-1.5L9.5 21z"/>
              </svg>
            </div>
            <div class="fcard-airport">
              @if($toCode)<div class="code">{{ $toCode }}</div>@endif
              <div class="city">{{ $flight->to_city ?? '—' }}</div>
            </div>
          </div>
          <div class="fcard-stats">
            @if($flight->distance_km)
              <div class="item">{{ number_format($flight->distance_km) }} km</div>
              <div class="item">{{ round($flight->distance_km / 850, 1) }}{{ $isEn ? 'h' : 's' }}</div>
            @endif
            @if($flight->flight_date)
              <div class="item">{{ \Carbon\Carbon::parse($flight->flight_date)->locale($locale)->isoFormat('D MMM YYYY') }}</div>
            @endif
            @if($flight->airline)
              <div class="item">{{ $flight->airline }}</div>
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
