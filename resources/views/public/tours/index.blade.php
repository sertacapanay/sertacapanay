@extends('public.layout')

@section('title', $isEn ? 'Cruise Log — Sertaç Apanay' : 'Seyir Günlükleri — Sertaç Apanay')
@section('description', $isEn ? 'Beyond the horizons, into the depths of oceans — cruise experiences and sea voyages.' : 'Ufukların ötesine, okyanusların derinliklerine — cruise deneyimleri ve gemi yolculukları.')

@push('styles')
<style>
  /* Hero */
  .page-hero{position:relative;min-height:56vh;display:flex;align-items:flex-end;
    padding:120px 0 56px;background-size:cover;background-position:center;color:var(--bone);
    background-image:linear-gradient(180deg,rgba(8,10,14,.45) 0%,rgba(8,10,14,.12) 40%,rgba(8,10,14,.62) 100%),
      url('{{ asset("images/cruise-hero.jpg") }}')}
  .page-hero .wrap{width:100%;max-width:100%;margin:0;padding-left:44px}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:rgba(243,239,230,.55);margin-bottom:14px}
  .page-title{font-family:var(--display);font-size:clamp(42px,6vw,76px);font-style:italic;font-weight:400;line-height:1.05}
  .page-lead{font-size:16px;color:rgba(243,239,230,.75);margin-top:14px;max-width:520px;line-height:1.6}

  /* Stats strip — 4-col per cruises.html reference */
  .stats{background:var(--paper);border-bottom:1px solid var(--line)}
  .stats .grid{display:grid;grid-template-columns:repeat(4,1fr)}
  .stat{padding:40px 24px;text-align:center;border-right:1px solid var(--line)}
  .stat:last-child{border-right:0}
  .stat .num{font-family:var(--display);font-size:54px;font-weight:500;line-height:1;
    font-feature-settings:"onum" 1;color:var(--ink)}
  .stat .lbl{font-family:var(--mono);font-size:11px;letter-spacing:.15em;text-transform:uppercase;
    color:var(--muted);margin-top:10px;line-height:1.4}
  @media(max-width:720px){.stats .grid{grid-template-columns:repeat(2,1fr)}.stat:nth-child(2){border-right:0}}
  @media(max-width:400px){.stats .grid{grid-template-columns:1fr}.stat{border-right:0}}

  /* Cruise list */
  .sec{padding:48px 0 90px}
  .clist{display:flex;flex-direction:column;gap:3px}

  .ccard{display:grid;grid-template-columns:auto 1fr auto;gap:20px 28px;align-items:center;
    padding:20px 22px;border:1px solid var(--line);border-radius:4px;background:var(--paper);
    transition:box-shadow .2s;text-decoration:none;color:inherit}
  .ccard:hover{box-shadow:0 4px 18px rgba(8,10,14,.08)}

  .c-header{font-family:var(--mono);font-size:12px;letter-spacing:.06em;color:var(--coral)}
  .c-ship{font-size:13px;color:var(--muted)}

  .c-route{display:flex;align-items:center}
  .c-port{text-align:center}
  .c-port .code{font-family:var(--display);font-style:italic;font-size:28px;
    font-weight:500;line-height:1;color:var(--ink)}
  .c-port .city{font-family:var(--mono);font-size:10px;letter-spacing:.1em;text-transform:uppercase;
    color:var(--muted);margin-top:4px}
  .c-route-mid{flex:1;display:flex;align-items:center;justify-content:center;color:var(--line);padding:0 16px}
  .ship-icon svg{width:28px;height:28px}

  .c-meta{text-align:right;font-family:var(--mono);font-size:11px;color:var(--muted);line-height:1.7}
  .c-meta strong{display:block;font-weight:400;color:var(--ink)}

  .empty-state{padding:80px 0;text-align:center;color:var(--muted)}
  .empty-state p{font-family:var(--display);font-style:italic;font-size:28px;margin-bottom:12px;color:var(--ink)}

  @media(max-width:680px){
    .ccard{grid-template-columns:1fr auto;grid-template-rows:auto auto}
    .c-header{grid-column:1;grid-row:2}
    .c-route{grid-column:1/-1;grid-row:1}
    .c-meta{grid-column:2;grid-row:2;text-align:right}
    .c-port .code{font-size:22px}
  }
</style>
@endpush

@section('content')
<section class="page-hero">
  <div class="wrap">
    <div class="page-eyebrow"><span data-tr>DENİZ YOLCULUKLARI</span><span data-en>SEA JOURNEYS</span></div>
    <h1 class="page-title"><span data-tr>Seyir Günlükleri</span><span data-en>Cruise Log</span></h1>
    <p class="page-lead" data-tr>Ufukların ötesine, okyanusların derinliklerine — cruise deneyimleri ve gemi yolculukları.</p>
    <p class="page-lead b" data-en>Beyond the horizons, into the depths of oceans — cruise experiences and sea voyages.</p>
  </div>
</section>

<section class="stats">
  <div class="wrap">
    <div class="grid">
      <div class="stat">
        <div class="num">{{ $allTours->count() }}</div>
        <div class="lbl"><span data-tr>Toplam Seyir</span><span data-en>Total Cruises</span></div>
      </div>
      <div class="stat">
        <div class="num">{{ $allTours->sum('nights') ?? 0 }}</div>
        <div class="lbl"><span data-tr>Toplam Gece</span><span data-en>Total Nights</span></div>
      </div>
      <div class="stat">
        <div class="num">{{ $allTours->pluck('ship_name')->filter()->unique()->count() }}</div>
        <div class="lbl"><span data-tr>Gemi</span><span data-en>Ships</span></div>
      </div>
      <div class="stat">
        <div class="num">{{ $allTours->pluck('country_tr')->filter()->unique()->count() }}</div>
        <div class="lbl"><span data-tr>Ülke / Bölge</span><span data-en>Countries</span></div>
      </div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    @if($tours->isEmpty())
      <div class="empty-state">
        <p data-tr>Henüz seyir kaydı yok</p>
        <p class="b" data-en>No cruises logged yet</p>
      </div>
    @else
      <div class="clist" id="cruise-list">
        @foreach($tours as $tour)
          @php
            $tname   = $isEn ? ($tour->title_en ?? $tour->title_tr) : $tour->title_tr;
            $tfrom   = $isEn ? ($tour->from_port_en ?? $tour->from_port_tr ?? '') : ($tour->from_port_tr ?? '');
            $tto     = $isEn ? ($tour->to_port_en ?? $tour->to_port_tr ?? '') : ($tour->to_port_tr ?? '');
            $tcountry = $isEn ? ($tour->country_en ?? $tour->country_tr ?? '') : ($tour->country_tr ?? '');
          @endphp
          <a href="/{{ $locale }}/tours/{{ $tour->slug }}" class="ccard">
            <div>
              <div class="c-header">{{ $tname }}</div>
              @if($tour->cruise_line ?? null)
                <div class="c-ship">{{ $tour->cruise_line }}</div>
              @endif
            </div>
            <div class="c-route">
              <div class="c-port from">
                <div class="code">{{ strtoupper(substr($tfrom ?: '---', 0, 3)) }}</div>
                <div class="city">{{ $tfrom ?: '—' }}</div>
              </div>
              <div class="c-route-mid">
                <div class="ship-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                    <path d="M3 17l9 4 9-4V9l-9-4-9 4v8z"/>
                    <path d="M12 5v16M3 9l9 4 9-4"/>
                  </svg>
                </div>
              </div>
              <div class="c-port to">
                <div class="code">{{ strtoupper(substr($tto ?: '---', 0, 3)) }}</div>
                <div class="city">{{ $tto ?: '—' }}</div>
              </div>
            </div>
            <div class="c-meta">
              @if($tour->nights ?? null)<strong>{{ $tour->nights }} <span data-tr>gece</span><span data-en>nights</span></strong>@endif
              @if($tcountry){{ $tcountry }}@endif
              @if($tour->departure_date)
                {{ \Carbon\Carbon::parse($tour->departure_date)->locale($locale)->isoFormat('D MMM YYYY') }}
              @endif
            </div>
          </a>
        @endforeach
      </div>
    @endif

    @if($tours->hasPages())
    <div style="display:flex;justify-content:center;gap:8px;padding:40px 0;font-family:var(--mono);font-size:12px">
      @if($tours->onFirstPage())<span style="padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--muted)">←</span>
      @else<a href="{{ $tours->previousPageUrl() }}" style="padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)">←</a>@endif
      @if($tours->hasMorePages())<a href="{{ $tours->nextPageUrl() }}" style="padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--ink)">→</a>
      @else<span style="padding:8px 16px;border:1px solid var(--line);border-radius:3px;color:var(--muted)">→</span>@endif
    </div>
    @endif
  </div>
</section>
@endsection
