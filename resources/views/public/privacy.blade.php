@extends('public.layout')

@section('title', ($isEn ? 'Privacy Policy' : 'Gizlilik Politikası & KVKK Aydınlatma Metni').' — Sertaç Apanay')
@section('description', $isEn
  ? 'Privacy policy and data protection notice for sertacapanay.net.'
  : 'sertacapanay.net gizlilik politikası ve KVKK aydınlatma metni.')

@push('styles')
<style>
  .legal{max-width:760px;margin:0 auto;padding:140px 0 90px}
  .legal h1{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(32px,5vw,48px);margin:0 0 8px;color:var(--ink)}
  .legal .updated{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:40px}
  .legal h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:24px;margin:40px 0 12px;color:var(--ink)}
  .legal p, .legal li{font-size:15.5px;line-height:1.75;color:var(--muted);margin:0 0 14px}
  .legal ul{padding-left:20px;margin:0 0 14px}
  .legal strong{color:var(--ink)}
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
        <h1>Privacy Policy &amp; Data Protection Notice</h1>
        <div class="updated">Last updated: {{ date('d.m.Y') }}</div>

        <p>This notice explains how <strong>Emin Sertaç Apanay</strong> ("we", "us"), as data controller, processes personal data collected through sertacapanay.net, in accordance with the Turkish Personal Data Protection Law No. 6698 (KVKK) and, where applicable to visitors from the European Economic Area, the General Data Protection Regulation (GDPR).</p>

        <h2>Data Controller</h2>
        <p>
          <strong>Emin Sertaç Apanay</strong><br>
          Güllerpınarı Mah. Bulut Sok. No:2B, Alanya / Antalya, Türkiye<br>
          Tax office: Alanya Vergi Dairesi — Tax No: 0570075313<br>
          Contact: {!! obfuscateEmail('sertac@hotmail.com') !!}
        </p>

        <h2>What Data We Collect and Why</h2>
        <table>
          <tr><th>Purpose</th><th>Data collected</th><th>Legal basis</th></tr>
          <tr><td>Responding to contact form inquiries</td><td>Name, email address, message content</td><td>Legitimate interest / pre-contractual communication</td></tr>
          <tr><td>Publishing traveler testimonials</td><td>Name, email, profile photo (via Google Sign-In), review text, tour name</td><td>Explicit consent (you initiate sign-in and submission)</td></tr>
          <tr><td>Newsletter</td><td>Email address</td><td>Explicit consent (opt-in)</td></tr>
          <tr><td>Site analytics (Google Analytics)</td><td>Usage data, approximate location, device/browser type, cookies</td><td>Consent (see our <a href="/{{ $locale }}/cookies">Cookie Policy</a>)</td></tr>
          <tr><td>Security &amp; abuse prevention</td><td>IP address, request logs</td><td>Legitimate interest</td></tr>
        </table>

        <h2>How Long We Keep Your Data</h2>
        <p>Contact form messages are retained only as long as needed to handle your inquiry and are periodically deleted. Testimonials are kept until you request removal or we archive them. Analytics data is retained per Google Analytics' default retention window. We do not sell or rent your personal data to third parties.</p>

        <h2>Who We Share Data With</h2>
        <p>We use the following processors, each bound by their own data processing terms: Google (Sign-In, Analytics, Maps/embeds where used), our hosting provider (InMotion Hosting), and, if you contact us via WhatsApp, Meta/WhatsApp under its own privacy policy. We do not share your data with any other third party for marketing purposes.</p>

        <h2>Your Rights</h2>
        <p>Under KVKK Article 11 and, where applicable, GDPR Articles 15–22, you have the right to: learn whether your data is processed; request information about processing; learn the purpose of processing and whether it is used accordingly; know third parties to whom data is transferred; request correction of incomplete or inaccurate data; request erasure or destruction of your data; object to a result arising from automated processing that is to your detriment; and request compensation for damages caused by unlawful processing.</p>
        <p>To exercise these rights, write to {!! obfuscateEmail('sertac@hotmail.com') !!}. We will respond within 30 days at the latest, as required by law.</p>

        <h2>Children</h2>
        <p>This site is not directed at children under 13, and we do not knowingly collect personal data from them.</p>

        <h2>Changes to This Policy</h2>
        <p>We may update this notice from time to time. The "last updated" date above reflects the most recent revision.</p>
      @else
        <h1>Gizlilik Politikası &amp; KVKK Aydınlatma Metni</h1>
        <div class="updated">Son güncelleme: {{ date('d.m.Y') }}</div>

        <p>Bu aydınlatma metni, 6698 sayılı Kişisel Verilerin Korunması Kanunu ("KVKK") uyarınca, sertacapanay.net üzerinden toplanan kişisel verilerin veri sorumlusu <strong>Emin Sertaç Apanay</strong> tarafından nasıl işlendiğini açıklar. Avrupa Ekonomik Alanı'ndan gelen ziyaretçiler için, uygun olduğu ölçüde Genel Veri Koruma Tüzüğü (GDPR) hükümleri de dikkate alınır.</p>

        <h2>Veri Sorumlusu</h2>
        <p>
          <strong>Emin Sertaç Apanay</strong><br>
          Güllerpınarı Mah. Bulut Sok. No:2B, Alanya / Antalya<br>
          Vergi Dairesi: Alanya Vergi Dairesi — Vergi No: 0570075313<br>
          İletişim: {!! obfuscateEmail('sertac@hotmail.com') !!}
        </p>

        <h2>Hangi Verileri, Neden İşliyoruz</h2>
        <table>
          <tr><th>Amaç</th><th>Toplanan veri</th><th>Hukuki sebep</th></tr>
          <tr><td>İletişim formu taleplerine yanıt verme</td><td>Ad, e-posta, mesaj içeriği</td><td>Meşru menfaat / sözleşme öncesi iletişim</td></tr>
          <tr><td>Gezgin yorumlarının yayınlanması</td><td>Google ile giriş üzerinden ad, e-posta, profil fotoğrafı, yorum metni, tur adı</td><td>Açık rıza (giriş ve gönderim sizin inisiyatifinizle gerçekleşir)</td></tr>
          <tr><td>Bülten (newsletter)</td><td>E-posta adresi</td><td>Açık rıza (opt-in)</td></tr>
          <tr><td>Site analitiği (Google Analytics)</td><td>Kullanım verisi, yaklaşık konum, cihaz/tarayıcı bilgisi, çerezler</td><td>Rıza (bkz. <a href="/{{ $locale }}/cookies">Çerez Politikası</a>)</td></tr>
          <tr><td>Güvenlik ve kötüye kullanım önleme</td><td>IP adresi, istek kayıtları</td><td>Meşru menfaat</td></tr>
        </table>

        <h2>Verileriniz Ne Kadar Süre Saklanır</h2>
        <p>İletişim formu mesajları yalnızca talebinizi yanıtlamak için gerekli süre boyunca tutulur ve düzenli olarak silinir. Yorumlar, siz silinmesini talep edene ya da arşivlenene kadar tutulur. Analitik veriler Google Analytics'in varsayılan saklama süresine tabidir. Kişisel verileriniz üçüncü taraflara satılmaz veya kiralanmaz.</p>

        <h2>Verileriniz Kimlerle Paylaşılır</h2>
        <p>Kendi veri işleme koşullarına tabi olan şu hizmet sağlayıcıları kullanıyoruz: Google (Giriş, Analytics, kullanılıyorsa Harita gömme), hosting sağlayıcımız (InMotion Hosting) ve bizimle WhatsApp üzerinden iletişime geçerseniz kendi gizlilik politikasına tabi olan Meta/WhatsApp. Verileriniz pazarlama amacıyla başka hiçbir üçüncü tarafla paylaşılmaz.</p>

        <h2>Haklarınız</h2>
        <p>KVKK'nın 11. maddesi uyarınca; kişisel verinizin işlenip işlenmediğini öğrenme, işlenmişse buna ilişkin bilgi talep etme, işlenme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme, yurt içinde/yurt dışında aktarıldığı üçüncü kişileri bilme, eksik veya yanlış işlenmişse düzeltilmesini isteme, silinmesini veya yok edilmesini isteme, işlemenin yalnızca otomatik sistemler yoluyla analiz edilmesi suretiyle aleyhinize bir sonucun ortaya çıkmasına itiraz etme ve kanuna aykırı işleme nedeniyle zarara uğramanız hâlinde zararın giderilmesini talep etme haklarına sahipsiniz.</p>
        <p>Bu haklarınızı kullanmak için {!! obfuscateEmail('sertac@hotmail.com') !!} adresine yazabilirsiniz. Talebiniz, kanunun öngördüğü şekilde en geç 30 gün içinde yanıtlanacaktır.</p>

        <h2>Çocuklar</h2>
        <p>Bu site 13 yaşından küçük çocuklara yönelik değildir ve bilerek bu kişilerden veri toplanmaz.</p>

        <h2>Bu Metindeki Değişiklikler</h2>
        <p>Bu aydınlatma metni zaman zaman güncellenebilir. Yukarıdaki "son güncelleme" tarihi en son revizyonu yansıtır.</p>
      @endif
    </article>
  </div>
</main>
@endsection
