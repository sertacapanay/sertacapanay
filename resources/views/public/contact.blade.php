@extends('public.layout')

@section('title', $isEn ? 'Contact — Sertaç Apanay' : 'İletişim — Sertaç Apanay')
@section('description', $isEn ? 'Get in touch for travel design, guided tours or speaking engagements.' : 'Seyahat tasarımı, rehberli turlar veya konuşma davetleri için iletişime geçin.')

@push('styles')
<style>
  .page-head{padding:140px 0 50px;border-bottom:1px solid var(--line)}
  .page-head .wrap{padding-left:44px;width:100%;max-width:100%;margin:0}
  .page-eyebrow{font-family:var(--mono);font-size:11px;letter-spacing:.26em;text-transform:uppercase;
    color:var(--coral);display:block;margin-bottom:16px}
  .page-title{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(40px,7vw,86px);line-height:1;margin:0}
  .page-lead{margin:20px 0 0;color:var(--muted);font-size:17px;max-width:560px;line-height:1.7}

  .contact-section{padding:64px 0 90px}
  .contact-wrap{display:grid;grid-template-columns:1.2fr .8fr;gap:70px}
  .cform label{display:block;font-family:var(--mono);font-size:11px;letter-spacing:.1em;
    text-transform:uppercase;color:var(--muted);margin:0 0 8px}
  .cfield{margin-bottom:24px}
  .cform input,.cform textarea{width:100%;border:1px solid var(--line);background:var(--paper);
    padding:13px 14px;font:inherit;font-size:15px;color:var(--ink);border-radius:3px;
    transition:border-color .2s}
  .cform input:focus,.cform textarea:focus{outline:none;border-color:var(--coral)}
  .cform textarea{min-height:140px;resize:vertical}
  .cbtn{background:var(--ink);color:var(--bone);border:0;padding:15px 32px;
    font-family:var(--mono);font-size:12px;letter-spacing:.12em;text-transform:uppercase;
    cursor:pointer;transition:background .2s;border-radius:3px}
  .cbtn:hover{background:var(--coral)}
  .form-note{font-size:13px;color:var(--muted);margin-top:12px}

  .cinfo h4{font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;
    color:var(--muted);margin:0 0 8px}
  .cinfo p{margin:0 0 28px;color:var(--ink);font-size:16px;line-height:1.6}
  .cinfo a{color:var(--coral);transition:opacity .2s}
  .cinfo a:hover{opacity:.7}
  .cinfo .divider{border:0;border-top:1px solid var(--line);margin:32px 0}

  @media(max-width:800px){.contact-wrap{grid-template-columns:1fr;gap:44px}}

  .about-section{background:var(--bone-2);padding:80px 0;border-top:1px solid var(--line)}
  .about-intro{display:grid;grid-template-columns:1fr 380px;gap:60px;align-items:center}
  .about-intro .ab-eye{font-family:var(--mono);font-size:11px;letter-spacing:.24em;text-transform:uppercase;
    color:var(--coral);display:block;margin-bottom:14px}
  .about-intro h2{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(32px,5vw,56px);line-height:1.05;margin:0 0 26px}
  .about-intro p{font-size:16px;color:var(--muted);line-height:1.78;margin:0 0 16px}
  .about-img{aspect-ratio:4/5;border-radius:4px;overflow:hidden;background:var(--bone-2)}
  .about-img img{width:100%;height:100%;object-fit:cover}
  .roles3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:48px}
  .role3{border:1px solid var(--line);border-radius:4px;padding:24px;background:var(--paper)}
  .role3 h3{font-family:var(--display);font-style:italic;font-size:21px;margin:0 0 6px;color:var(--ink)}
  .role3 p{margin:0;font-size:13.5px;color:var(--muted);line-height:1.5}
  @media(max-width:900px){.about-intro{grid-template-columns:1fr}.about-img{max-width:400px}.roles3{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<section class="page-head">
  <div class="wrap">
    <span class="page-eyebrow"><span data-tr>İLETİŞİM</span><span data-en>CONTACT</span></span>
    <h1 class="page-title">
      <span data-tr>Yolculuğunu<br>Planlayalım</span>
      <span data-en>Let's Plan<br>Your Journey</span>
    </h1>
    <p class="page-lead" data-tr>İster özel bir seyahat tasarımı, ister rehberli bir tur, ister bir konuşma daveti — ya da sadece tanışmak istersen, senden haber almak isterim.</p>
    <p class="page-lead b" data-en>Whether you're looking for a custom travel design, a guided tour, a speaking engagement, or simply want to connect — I'd love to hear from you.</p>
  </div>
</section>

<main>
  <section class="contact-section">
    <div class="wrap">
      <div class="contact-wrap">
        <div class="cform">
          <form method="POST" action="/{{ $locale }}/contact">
            @csrf
            <div class="cfield">
              <label><span data-tr>Ad Soyad</span><span data-en>Full Name</span></label>
              <input type="text" name="name" required>
            </div>
            <div class="cfield">
              <label>E-posta / Email</label>
              <input type="email" name="email" required>
            </div>
            <div class="cfield">
              <label><span data-tr>Konu</span><span data-en>Subject</span></label>
              <input type="text" name="subject">
            </div>
            <div class="cfield">
              <label><span data-tr>Mesaj</span><span data-en>Message</span></label>
              <textarea name="message" required></textarea>
            </div>
            <button class="cbtn" type="submit">
              <span data-tr>Gönder</span><span data-en>Send Message</span>
            </button>
            <p class="form-note" data-tr>Genellikle 24-48 saat içinde yanıt veririm.</p>
            <p class="form-note b" data-en>I typically respond within 24–48 hours.</p>
          </form>
        </div>

        <div class="cinfo">
          <h4>E-posta</h4>
          <p><a href="mailto:sertac@sertacapanay.net">sertac@sertacapanay.net</a></p>
          <hr class="divider">
          <h4>WhatsApp</h4>
          <p><a href="https://wa.me/905XXXXXXXXX" target="_blank">+90 5XX XXX XX XX</a></p>
          <hr class="divider">
          <h4><span data-tr>Sosyal Medya</span><span data-en>Social</span></h4>
          <p>
            <a href="#">Instagram</a><br>
            <a href="#">Facebook</a>
          </p>
          <hr class="divider">
          <h4><span data-tr>Bölge</span><span data-en>Base</span></h4>
          <p data-tr>Türkiye · Dünya geneli</p>
          <p data-en>Turkey · Worldwide</p>
        </div>
      </div>
    </div>
  </section>

  <section class="about-section" id="about">
    <div class="wrap">
      <div class="about-intro">
        <div>
          <span class="ab-eye"><span data-tr>HAKKIMDA</span><span data-en>ABOUT</span></span>
          <h2>
            <span data-tr>Tur Rehberi.<br>Destinasyon Anlatıcısı.<br>Seyahat Tasarımcısı.</span>
            <span data-en>Tour Guide.<br>Destination Lecturer.<br>Travel Designer.</span>
          </h2>
          <p data-tr>Kıtalar boyunca sıra dışı yolculuklar tasarlıyorum. Her destinasyonun kendine özgü bir ruhu, tarihi ve sesi var — bu sesleri dinlemeyi ve aktarmayı seviyorum.</p>
          <p class="b" data-en>I design extraordinary journeys across continents. Every destination has its own spirit, history and voice — I love listening to them and passing them on.</p>
          <p data-tr>Kültürel anlatı, doğa yürüyüşleri ve lüks deniz yolculuklarından nehir gemisi turlarına kadar uzanan bir deneyim yelpazesiyle, seyahati bir turizm eyleminden çıkarıp gerçek bir keşfe dönüştürüyorum.</p>
          <p class="b" data-en>From cultural storytelling and trekking to luxury ocean voyages and river cruises — I transform travel from a tourism act into a genuine discovery.</p>

          <div class="roles3">
            <div class="role3">
              <h3 data-tr>Tur Rehberi</h3>
              <h3 class="b" data-en>Tour Guide</h3>
              <p data-tr>Yıllar içinde yüzlerce grup ile Türkiye ve dünya genelinde rehberlik yaptım.</p>
              <p class="b" data-en>Led hundreds of groups across Turkey and the world over the years.</p>
            </div>
            <div class="role3">
              <h3 data-tr>Seyahat Yazarı</h3>
              <h3 class="b" data-en>Travel Writer</h3>
              <p data-tr>Destinasyonları, kültürleri ve yol hikâyelerini kaleme alıyorum.</p>
              <p class="b" data-en>Writing about destinations, cultures and stories from the road.</p>
            </div>
            <div class="role3">
              <h3 data-tr>Seyahat Tasarımcısı</h3>
              <h3 class="b" data-en>Travel Designer</h3>
              <p data-tr>Özel, kişiselleştirilmiş seyahat programları tasarlıyorum.</p>
              <p class="b" data-en>Designing bespoke, personalised travel itineraries.</p>
            </div>
          </div>
        </div>
        <div class="about-img">
          {{-- Buraya profil fotoğrafı eklenecek --}}
        </div>
      </div>
    </div>
  </section>
</main>

@if(isset($scrollToAbout) && $scrollToAbout)
@push('scripts')
<script>
  window.addEventListener('load', function() {
    document.getElementById('about')?.scrollIntoView({ behavior: 'smooth' });
  });
</script>
@endpush
@endif
@endsection
