@extends('public.layout')

@section('title', ($isEn ? 'Distance Sales & Returns' : 'Mesafeli Satış ve İade Koşulları').' — Sertaç Apanay')
@section('description', $isEn
  ? 'Distance sales, cancellation and return terms for the sertacapanay.net shop.'
  : 'sertacapanay.net çarşısı için mesafeli satış, cayma ve iade koşulları.')

@push('styles')
<style>
  .legal{max-width:760px;margin:0 auto;padding:140px 0 90px}
  .legal h1{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(32px,5vw,48px);margin:0 0 8px;color:var(--ink)}
  .legal .updated{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:40px}
  .legal h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:24px;margin:40px 0 12px;color:var(--ink)}
  .legal p, .legal li{font-size:15.5px;line-height:1.75;color:var(--muted);margin:0 0 14px}
  .legal ul{padding-left:20px;margin:0 0 14px}
  .legal strong{color:var(--ink)}
  .notice{background:var(--bone-2);border:1px solid var(--line);border-radius:6px;padding:18px 22px;margin-bottom:32px;font-size:14.5px;color:var(--ink)}
  @media(max-width:640px){.legal{padding:110px 22px 70px}}
</style>
@endpush

@section('content')
<main class="page">
  <div class="wrap">
    <article class="legal">
      @if($isEn)
        <h1>Distance Sales &amp; Returns</h1>
        <div class="updated">Last updated: {{ date('d.m.Y') }}</div>

        <div class="notice"><strong>Current status:</strong> The Bazaar (Shop) currently works on an inquiry basis only — clicking "Ask to Buy" sends a message, and no online payment is processed on sertacapanay.net. Once online checkout is enabled, this page will be replaced with a complete Distance Contract covering the item, price, and delivery terms of each specific order, as required by Turkish Consumer Protection Law No. 6502 and the Distance Contracts Regulation.</div>

        <h2>How Purchases Work Today</h2>
        <p>When you inquire about an item, we will contact you directly (by email or WhatsApp) to confirm availability, final price (including any shipping cost), payment method, and estimated delivery time before any payment is requested or taken.</p>

        <h2>Right of Withdrawal (14-Day Cooling-Off Period)</h2>
        <p>Once online ordering is available, and except where the product is excluded by law (e.g. made-to-order or personalized items), you will have the right to withdraw within 14 days of receiving the product without giving any reason, and to receive a full refund once the item is returned in its original condition, in line with Turkish consumer protection legislation.</p>

        <h2>Damaged or Incorrect Items</h2>
        <p>If an item arrives damaged or does not match its description, contact us at {!! obfuscateEmail('sertac@hotmail.com') !!} within 14 days of delivery with photos of the item, and we will arrange a replacement or refund.</p>

        <h2>Contact</h2>
        <p>For any question about an order, write to {!! obfuscateEmail('sertac@hotmail.com') !!}.</p>
      @else
        <h1>Mesafeli Satış ve İade Koşulları</h1>
        <div class="updated">Son güncelleme: {{ date('d.m.Y') }}</div>

        <div class="notice"><strong>Güncel durum:</strong> Çarşı şu anda yalnızca soru-cevap temelinde çalışıyor — "Satın Almak İçin Sor" butonuna tıklamak bir mesaj gönderir, sertacapanay.net üzerinden hiçbir online ödeme alınmaz. Online ödeme (checkout) devreye girdiğinde, bu sayfa 6502 sayılı Tüketicinin Korunması Hakkında Kanun ve Mesafeli Sözleşmeler Yönetmeliği'nin gerektirdiği şekilde her siparişe özgü ürün, fiyat ve teslimat koşullarını kapsayan tam bir Mesafeli Satış Sözleşmesi ile değiştirilecektir.</div>

        <h2>Bugün Satın Alma Nasıl İşliyor</h2>
        <p>Bir ürünle ilgili soru sorduğunuzda, herhangi bir ödeme talep edilmeden veya alınmadan önce sizinle doğrudan (e-posta veya WhatsApp üzerinden) iletişime geçilerek müsaitlik, kargo dahil nihai fiyat, ödeme yöntemi ve tahmini teslimat süresi teyit edilir.</p>

        <h2>Cayma Hakkı (14 Günlük Değerlendirme Süresi)</h2>
        <p>Online sipariş verme özelliği devreye girdiğinde, kanunen istisna tutulan ürünler (ör. kişiye özel/ısmarlama üretilen ürünler) hariç olmak üzere, ürünü teslim aldığınız tarihten itibaren 14 gün içinde herhangi bir gerekçe göstermeksizin cayma hakkına ve ürünü orijinal haliyle iade ettiğinizde tam iade alma hakkına, Türk tüketici mevzuatına uygun şekilde sahip olacaksınız.</p>

        <h2>Hasarlı veya Yanlış Ürünler</h2>
        <p>Bir ürün hasarlı ulaşırsa veya açıklamasıyla uyuşmuyorsa, teslimattan itibaren 14 gün içinde ürünün fotoğraflarıyla birlikte {!! obfuscateEmail('sertac@hotmail.com') !!} adresine yazın; değişim veya iade süreci başlatılsın.</p>

        <h2>İletişim</h2>
        <p>Bir sipariş hakkında sorularınız için {!! obfuscateEmail('sertac@hotmail.com') !!} adresine yazabilirsiniz.</p>
      @endif
    </article>
  </div>
</main>
@endsection
