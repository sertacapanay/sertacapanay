@php $cfg = $widget->config ?? []; @endphp

@switch($widget->type)

  {{-- ── YouTube ── --}}
  @case('youtube')
    <div class="widget widget-youtube">
      @if($widget->title_tr || $widget->title_en)
        <h4 class="widget-title">
          <span data-tr>{{ $widget->title_tr }}</span>
          <span data-en>{{ $widget->title_en ?? $widget->title_tr }}</span>
        </h4>
      @endif
      @if(!empty($cfg['video_id']))
        <div class="yt-wrap">
          <iframe
            src="https://www.youtube.com/embed/{{ $cfg['video_id'] }}?rel=0"
            title="{{ $widget->title_tr ?? 'YouTube Video' }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy">
          </iframe>
        </div>
      @elseif(!empty($cfg['channel_url']))
        <a href="{{ $cfg['channel_url'] }}" target="_blank" rel="noopener" class="widget-channel-btn yt-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31.5 31.5 0 0 0 0 12a31.5 31.5 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31.5 31.5 0 0 0 24 12a31.5 31.5 0 0 0-.5-5.8zM9.7 15.5V8.5l6.3 3.5-6.3 3.5z"/></svg>
          <span data-tr>{{ $widget->title_tr ?? 'YouTube Kanalım' }}</span>
          <span data-en>{{ $widget->title_en ?? 'My YouTube Channel' }}</span>
        </a>
      @endif
    </div>
  @break

  {{-- ── Instagram ── --}}
  @case('instagram')
    <div class="widget widget-instagram">
      @if(!empty($cfg['url']))
        <a href="{{ $cfg['url'] }}" target="_blank" rel="noopener" class="widget-channel-btn ig-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 3.3.1 4.8 1.7 4.9 4.9.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 3.2-1.7 4.8-4.9 4.9-1.3.1-1.6.1-4.9.1s-3.6 0-4.8-.1c-3.3-.1-4.8-1.7-4.9-4.9C2.2 15.6 2.2 15.3 2.2 12s0-3.6.1-4.8C2.4 3.9 4 2.3 7.2 2.3c1.3-.1 1.6-.1 4.8-.1zm0-2.2C8.7 0 8.3 0 7 .1 2.7.3.3 2.7.1 7 0 8.3 0 8.7 0 12s0 3.7.1 5c.2 4.3 2.6 6.7 7 6.9 1.3.1 1.7.1 5 .1s3.7 0 5-.1c4.3-.2 6.7-2.6 6.9-6.9.1-1.3.1-1.7.1-5s0-3.7-.1-5c-.2-4.3-2.6-6.7-6.9-6.9C15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4A6.2 6.2 0 0 0 12 5.8zm0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.8a1.4 1.4 0 1 0 0 2.8 1.4 1.4 0 0 0 0-2.8z"/></svg>
          <span data-tr>{{ $widget->title_tr ?? 'Instagram' }}</span>
          <span data-en>{{ $widget->title_en ?? 'Instagram' }}</span>
        </a>
      @endif
    </div>
  @break

  {{-- ── HTML / Reklam ── --}}
  @case('html')
  @case('ad')
    <div class="widget widget-html">
      @if($widget->title_tr)
        <h4 class="widget-title">
          <span data-tr>{{ $widget->title_tr }}</span>
          <span data-en>{{ $widget->title_en ?? $widget->title_tr }}</span>
        </h4>
      @endif
      @if(!empty($cfg['code']))
        {!! $cfg['code'] !!}
      @endif
    </div>
  @break

  {{-- ── Newsletter ── --}}
  @case('newsletter')
    <div class="widget widget-newsletter">
      <h4 class="widget-title">
        <span data-tr>{{ $widget->title_tr ?? 'Bülten' }}</span>
        <span data-en>{{ $widget->title_en ?? 'Newsletter' }}</span>
      </h4>
      @if(!empty($cfg['description_tr']))
        <p class="widget-desc">
          <span data-tr>{{ $cfg['description_tr'] }}</span>
          <span data-en>{{ $cfg['description_en'] ?? $cfg['description_tr'] }}</span>
        </p>
      @endif
      <form class="nl-form" action="{{ $cfg['action_url'] ?? '#' }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="{{ $cfg['placeholder_tr'] ?? 'E-posta adresiniz' }}" required>
        <button type="submit">
          <span data-tr>{{ $cfg['button_tr'] ?? 'Abone Ol' }}</span>
          <span data-en>{{ $cfg['button_en'] ?? 'Subscribe' }}</span>
        </button>
      </form>
    </div>
  @break

  {{-- ── WhatsApp Floating ── --}}
  @case('whatsapp')
    @if(!empty($cfg['number']))
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cfg['number']) }}?text={{ urlencode($cfg['message_tr'] ?? 'Merhaba!') }}"
       class="wa-float"
       target="_blank"
       rel="noopener"
       aria-label="WhatsApp ile iletişim">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.3-.1-.5-.1-.7.1-.2.3-.8.9-1 1.1-.2.2-.4.2-.7.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.5-.6c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5-.1-.2-.7-1.7-.9-2.3-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 2-1.4.2-.6.2-1.2.1-1.3z"/><path d="M12 2a10 10 0 0 0-8.6 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2zm0 18.3a8.3 8.3 0 0 1-4.2-1.1l-.3-.2-3.1.8.8-3-.2-.3A8.3 8.3 0 1 1 12 20.3z"/></svg>
    </a>
    @endif
  @break

  {{-- ── Sosyal İkonlar ── --}}
  @case('social')
    <div class="widget widget-social">
      @if($widget->title_tr)
        <h4 class="widget-title">
          <span data-tr>{{ $widget->title_tr }}</span>
          <span data-en>{{ $widget->title_en ?? $widget->title_tr }}</span>
        </h4>
      @endif
      <div class="social-icons">
        @if(setting('social.instagram'))
          <a href="{{ setting('social.instagram') }}" target="_blank" rel="noopener" aria-label="Instagram">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 3.3.1 4.8 1.7 4.9 4.9.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 3.2-1.7 4.8-4.9 4.9-1.3.1-1.6.1-4.9.1s-3.6 0-4.8-.1c-3.3-.1-4.8-1.7-4.9-4.9C2.2 15.6 2.2 15.3 2.2 12s0-3.6.1-4.8C2.4 3.9 4 2.3 7.2 2.3c1.3-.1 1.6-.1 4.8-.1zm0-2.2C8.7 0 8.3 0 7 .1 2.7.3.3 2.7.1 7 0 8.3 0 8.7 0 12s0 3.7.1 5c.2 4.3 2.6 6.7 7 6.9 1.3.1 1.7.1 5 .1s3.7 0 5-.1c4.3-.2 6.7-2.6 6.9-6.9.1-1.3.1-1.7.1-5s0-3.7-.1-5c-.2-4.3-2.6-6.7-6.9-6.9C15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4A6.2 6.2 0 0 0 12 5.8zm0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.8a1.4 1.4 0 1 0 0 2.8 1.4 1.4 0 0 0 0-2.8z"/></svg>
          </a>
        @endif
        @if(setting('social.youtube'))
          <a href="{{ setting('social.youtube') }}" target="_blank" rel="noopener" aria-label="YouTube">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31.5 31.5 0 0 0 0 12a31.5 31.5 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31.5 31.5 0 0 0 24 12a31.5 31.5 0 0 0-.5-5.8zM9.7 15.5V8.5l6.3 3.5-6.3 3.5z"/></svg>
          </a>
        @endif
        @if(setting('social.facebook'))
          <a href="{{ setting('social.facebook') }}" target="_blank" rel="noopener" aria-label="Facebook">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12a12 12 0 1 0-13.9 11.9v-8.4H7.1V12h3V9.4c0-3 1.8-4.7 4.5-4.7 1.3 0 2.7.2 2.7.2v3h-1.5c-1.5 0-2 1-2 1.9V12h3.4l-.5 3.5H13.8v8.4A12 12 0 0 0 24 12z"/></svg>
          </a>
        @endif
        @if(setting('social.twitter'))
          <a href="{{ setting('social.twitter') }}" target="_blank" rel="noopener" aria-label="X">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M18.2 2h3.4l-7.4 8.5L23 22h-6.8l-5.3-7-6.1 7H1.4l7.9-9.1L1 2h7l4.8 6.4L18.2 2zm-1.2 18h1.9L7.1 4H5.1L17 20z"/></svg>
          </a>
        @endif
      </div>
    </div>
  @break

@endswitch

@once
@push('styles')
<style>
.widget{margin-bottom:28px}
.widget-title{font-family:var(--mono);font-size:11px;letter-spacing:.18em;text-transform:uppercase;color:var(--muted);margin-bottom:14px}
.widget-desc{font-size:14px;color:var(--muted);margin-bottom:12px;line-height:1.6}
.yt-wrap{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:3px}
.yt-wrap iframe{position:absolute;top:0;left:0;width:100%;height:100%}
.widget-channel-btn{display:inline-flex;align-items:center;gap:10px;padding:12px 20px;border:1.5px solid var(--line);font-family:var(--mono);font-size:12px;letter-spacing:.1em;text-transform:uppercase;color:var(--ink);transition:all .2s;border-radius:2px}
.yt-btn:hover{background:#FF0000;color:#fff;border-color:#FF0000}
.ig-btn:hover{background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);color:#fff;border-color:transparent}
.nl-form{display:flex;gap:8px}
.nl-form input{flex:1;border:1px solid var(--line);padding:10px 14px;font:inherit;font-size:14px;color:var(--ink);background:var(--paper);border-radius:2px}
.nl-form button{background:var(--coral);color:#fff;border:0;padding:10px 18px;font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;white-space:nowrap;transition:background .2s}
.nl-form button:hover{background:var(--coral-2)}
.wa-float{position:fixed;bottom:28px;right:28px;z-index:100;width:56px;height:56px;border-radius:50%;background:#25D366;color:#fff;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(0,0,0,.2);transition:transform .2s,box-shadow .2s}
.wa-float:hover{transform:scale(1.08);box-shadow:0 6px 20px rgba(0,0,0,.25)}
.social-icons{display:flex;gap:14px;flex-wrap:wrap}
.social-icons a{color:var(--muted);transition:color .2s}
.social-icons a:hover{color:var(--coral)}
</style>
@endpush
@endonce
