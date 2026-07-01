@extends('public.layout')

@section('title', ($isEn ? 'Terms of Use' : 'Kullanım Koşulları').' — Sertaç Apanay')
@section('description', $isEn ? 'Terms of use for sertacapanay.net.' : 'sertacapanay.net kullanım koşulları.')

@push('styles')
<style>
  .legal{max-width:760px;margin:0 auto;padding:140px 0 90px}
  .legal h1{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(32px,5vw,48px);margin:0 0 8px;color:var(--ink)}
  .legal .updated{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:40px}
  .legal h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:24px;margin:40px 0 12px;color:var(--ink)}
  .legal p, .legal li{font-size:15.5px;line-height:1.75;color:var(--muted);margin:0 0 14px}
  .legal ul{padding-left:20px;margin:0 0 14px}
  .legal strong{color:var(--ink)}
  @media(max-width:640px){.legal{padding:110px 22px 70px}}
</style>
@endpush

@section('content')
<main class="page">
  <div class="wrap">
    <article class="legal">
      @if($isEn)
        <h1>Terms of Use</h1>
        <div class="updated">Last updated: {{ date('d.m.Y') }}</div>

        <p>These terms govern your use of sertacapanay.net (the "Site"), operated by <strong>Emin Sertaç Apanay</strong>, Güllerpınarı Mah. Bulut Sok. No:2B, Alanya / Antalya, Türkiye. By using the Site, you agree to these terms.</p>

        <h2>Content Ownership</h2>
        <p>All text, photographs, itineraries, and design elements on this Site are the property of Emin Sertaç Apanay unless otherwise credited, and are protected by copyright law. You may not reproduce, republish, or redistribute this content without prior written permission.</p>

        <h2>Traveler Testimonials</h2>
        <p>If you submit a testimonial via Google Sign-In, you confirm that the content is truthful and your own, and you grant us permission to publish it (including your name) on the Site and in related marketing materials. We reserve the right to edit for length or clarity, decline, or remove any testimonial at our discretion, including after publication.</p>

        <h2>Acceptable Use</h2>
        <ul>
          <li>Do not attempt to disrupt, scrape at scale, or gain unauthorized access to the Site or its systems.</li>
          <li>Do not submit false, defamatory, or unlawful content through any form on the Site.</li>
          <li>Do not use automated tools to extract content beyond normal search-engine indexing.</li>
        </ul>

        <h2>Tours, Products &amp; Availability</h2>
        <p>Destinations, tours, and shop items shown on the Site are illustrative of past and planned journeys and available items. Availability, pricing, and departure dates are confirmed individually via direct contact and are not a binding offer until confirmed in writing.</p>

        <h2>No Warranty &amp; Limitation of Liability</h2>
        <p>The Site and its content are provided "as is". While we take reasonable care to keep information accurate, we do not guarantee that all content is free of errors or always up to date. To the maximum extent permitted by law, Emin Sertaç Apanay is not liable for indirect or consequential damages arising from use of the Site.</p>

        <h2>External Links</h2>
        <p>The Site may link to third-party services (Instagram, WhatsApp, Google). We are not responsible for the content or privacy practices of external sites.</p>

        <h2>Governing Law</h2>
        <p>These terms are governed by the laws of the Republic of Türkiye. Any dispute shall be subject to the exclusive jurisdiction of the courts and enforcement offices of Alanya, Antalya, unless mandatory consumer-protection rules require otherwise.</p>

        <h2>Contact</h2>
        <p>Questions about these terms can be sent to <a href="mailto:sertac@hotmail.com">sertac@hotmail.com</a>.</p>
      @else
        <h1>Kullanım Koşulları</h1>
        <div class="updated">Son güncelleme: {{ date('d.m.Y') }}</div>

        <p>Bu koşullar, <strong>Emin Sertaç Apanay</strong> (Güllerpınarı Mah. Bulut Sok. No:2B, Alanya / Antalya) tarafından işletilen sertacapanay.net'i ("Site") kullanımınızı düzenler. Siteyi kullanarak bu koşulları kabul etmiş sayılırsınız.</p>

        <h2>İçerik Sahipliği</h2>
        <p>Sitedeki tüm metin, fotoğraf, gezi güzergâhları ve tasarım öğeleri, aksi belirtilmedikçe Emin Sertaç Apanay'a aittir ve telif hakkı yasalarıyla korunur. Önceden yazılı izin alınmadan bu içerikler çoğaltılamaz, yeniden yayınlanamaz veya dağıtılamaz.</p>

        <h2>Gezgin Yorumları</h2>
        <p>Google ile giriş yaparak bir yorum gönderdiğinizde, içeriğin doğru ve size ait olduğunu onaylamış ve bunu (isminiz dahil) Sitede ve ilgili pazarlama materyallerinde yayınlamamıza izin vermiş olursunuz. Uzunluk veya netlik açısından düzenleme, yayınlamama ya da yayından sonra dahi kaldırma hakkımızı saklı tutarız.</p>

        <h2>Kabul Edilebilir Kullanım</h2>
        <ul>
          <li>Siteyi veya sistemlerini bozmaya, toplu kazımaya (scraping) ya da yetkisiz erişime çalışmayın.</li>
          <li>Sitedeki herhangi bir form aracılığıyla yanlış, hakaret içeren veya hukuka aykırı içerik göndermeyin.</li>
          <li>Normal arama motoru taramasının ötesinde içerik çekmek için otomatik araçlar kullanmayın.</li>
        </ul>

        <h2>Turlar, Ürünler ve Müsaitlik</h2>
        <p>Sitede gösterilen destinasyonlar, turlar ve çarşı ürünleri geçmiş/planlanan yolculukların ve mevcut ürünlerin gösterimidir. Müsaitlik, fiyat ve kalkış tarihleri doğrudan iletişim yoluyla ayrı ayrı teyit edilir ve yazılı olarak onaylanana kadar bağlayıcı bir teklif niteliği taşımaz.</p>

        <h2>Garanti Vermeme ve Sorumluluk Sınırlaması</h2>
        <p>Site ve içeriği "olduğu gibi" sunulmaktadır. Bilgilerin doğru tutulmasına makul özen gösterilse de, tüm içeriğin hatasız veya her zaman güncel olduğu garanti edilmez. Kanunun izin verdiği azami ölçüde, Emin Sertaç Apanay'ın site kullanımından doğan dolaylı zararlardan sorumluluğu bulunmamaktadır.</p>

        <h2>Harici Bağlantılar</h2>
        <p>Site, üçüncü taraf hizmetlere (Instagram, WhatsApp, Google) bağlantı verebilir. Harici sitelerin içeriğinden veya gizlilik uygulamalarından sorumlu değiliz.</p>

        <h2>Uygulanacak Hukuk</h2>
        <p>Bu koşullar Türkiye Cumhuriyeti kanunlarına tabidir. Zorunlu tüketici koruma kuralları aksini gerektirmedikçe, uyuşmazlıklarda Alanya (Antalya) Mahkemeleri ve İcra Daireleri yetkilidir.</p>

        <h2>İletişim</h2>
        <p>Bu koşullarla ilgili sorularınızı <a href="mailto:sertac@hotmail.com">sertac@hotmail.com</a> adresine gönderebilirsiniz.</p>
      @endif
    </article>
  </div>
</main>
@endsection
