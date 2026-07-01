@extends('public.layout')

@section('title', ($isEn ? 'Cookie Policy' : 'Çerez Politikası').' — Sertaç Apanay')
@section('description', $isEn ? 'Cookie policy for sertacapanay.net.' : 'sertacapanay.net çerez politikası.')

@push('styles')
<style>
  .legal{max-width:760px;margin:0 auto;padding:140px 0 90px}
  .legal h1{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(32px,5vw,48px);margin:0 0 8px;color:var(--ink)}
  .legal .updated{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:40px}
  .legal h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:24px;margin:40px 0 12px;color:var(--ink)}
  .legal p, .legal li{font-size:15.5px;line-height:1.75;color:var(--muted);margin:0 0 14px}
  .legal table{width:100%;border-collapse:collapse;margin:16px 0 20px;font-size:14px}
  .legal th,.legal td{text-align:left;padding:8px 12px;border-bottom:1px solid var(--line);color:var(--muted)}
  .legal th{color:var(--ink);font-weight:600}
  @media(max-width:640px){.legal{padding:110px 22px 70px}}
</style>
@endpush

@section('content')
<main class="page">
  <div class="wrap">
    <article class="legal">
      @if($isEn)
        <h1>Cookie Policy</h1>
        <div class="updated">Last updated: {{ date('d.m.Y') }}</div>

        <p>Cookies are small text files stored on your device that help websites function and, in some cases, understand how they are used. This page lists the cookies sertacapanay.net uses.</p>

        <h2>Strictly Necessary Cookies</h2>
        <table>
          <tr><th>Cookie</th><th>Purpose</th><th>Duration</th></tr>
          <tr><td>laravel_session</td><td>Keeps you logged in and maintains your session while browsing</td><td>Session / 2 hours</td></tr>
          <tr><td>XSRF-TOKEN</td><td>Protects forms (contact, testimonial) against cross-site request forgery</td><td>Session / 2 hours</td></tr>
        </table>
        <p>These cookies are essential for the site to work and cannot be disabled without breaking core functionality (forms, admin panel, Google sign-in).</p>

        <h2>Analytics Cookies</h2>
        <table>
          <tr><th>Cookie</th><th>Purpose</th><th>Provider</th></tr>
          <tr><td>_ga, _ga_*</td><td>Distinguishes users and sessions for aggregate traffic statistics</td><td>Google Analytics (GA4)</td></tr>
        </table>
        <p>These cookies help us understand which pages are popular and how visitors navigate the site. They do not identify you personally. You can opt out at any time using the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Browser Add-on</a>, or by blocking cookies in your browser settings.</p>

        <h2>Managing Cookies in Your Browser</h2>
        <p>Most browsers let you view, delete, and block cookies through their settings. Blocking all cookies may prevent some parts of the site (such as submitting a testimonial or the contact form) from working correctly.</p>

        <h2>Third-Party Content</h2>
        <p>If a page embeds third-party content (e.g. a map or a WhatsApp chat link), that provider may set its own cookies once you interact with it, governed by its own privacy and cookie policy.</p>

        <p>For more information about how we handle personal data, see our <a href="/{{ $locale }}/privacy">Privacy Policy</a>.</p>
      @else
        <h1>Çerez Politikası</h1>
        <div class="updated">Son güncelleme: {{ date('d.m.Y') }}</div>

        <p>Çerezler, cihazınızda saklanan ve web sitelerinin çalışmasına, bazı durumlarda da nasıl kullanıldığının anlaşılmasına yardımcı olan küçük metin dosyalarıdır. Bu sayfa sertacapanay.net'in kullandığı çerezleri listeler.</p>

        <h2>Zorunlu Çerezler</h2>
        <table>
          <tr><th>Çerez</th><th>Amaç</th><th>Süre</th></tr>
          <tr><td>laravel_session</td><td>Gezinme sırasında oturumunuzu korur</td><td>Oturum / 2 saat</td></tr>
          <tr><td>XSRF-TOKEN</td><td>Formları (iletişim, yorum) siteler arası istek sahteciliğine karşı korur</td><td>Oturum / 2 saat</td></tr>
        </table>
        <p>Bu çerezler sitenin çalışması için gereklidir; devre dışı bırakılması formlar, admin paneli ve Google ile giriş gibi temel işlevleri bozar.</p>

        <h2>Analitik Çerezler</h2>
        <table>
          <tr><th>Çerez</th><th>Amaç</th><th>Sağlayıcı</th></tr>
          <tr><td>_ga, _ga_*</td><td>Toplu trafik istatistikleri için kullanıcı ve oturumları ayırt eder</td><td>Google Analytics (GA4)</td></tr>
        </table>
        <p>Bu çerezler hangi sayfaların popüler olduğunu ve ziyaretçilerin sitede nasıl gezindiğini anlamamıza yardımcı olur; sizi kişisel olarak tanımlamaz. <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Eklentisi</a> ile ya da tarayıcı ayarlarınızdan çerezleri engelleyerek istediğiniz zaman devre dışı bırakabilirsiniz.</p>

        <h2>Tarayıcınızda Çerez Yönetimi</h2>
        <p>Çoğu tarayıcı, ayarlar üzerinden çerezleri görüntülemenize, silmenize ve engellemenize izin verir. Tüm çerezleri engellemek, sitenin bazı bölümlerinin (yorum gönderme, iletişim formu gibi) düzgün çalışmamasına neden olabilir.</p>

        <h2>Üçüncü Taraf İçerikleri</h2>
        <p>Bir sayfada üçüncü taraf içerik (ör. harita veya WhatsApp sohbet bağlantısı) gömülüyse, o sağlayıcı sizinle etkileşime geçtiğinizde kendi çerezlerini kendi gizlilik ve çerez politikası kapsamında ayarlayabilir.</p>

        <p>Kişisel verilerinizi nasıl işlediğimiz hakkında daha fazla bilgi için <a href="/{{ $locale }}/privacy">Gizlilik Politikası</a> sayfamıza bakabilirsiniz.</p>
      @endif
    </article>
  </div>
</main>
@endsection
