@extends('public.layout')

@section('title', $isEn ? 'Contact — Sertaç Apanay' : 'İletişim — Sertaç Apanay')
@section('description', $isEn ? 'Get in touch for travel design, guided tours or speaking engagements.' : 'Seyahat tasarımı, rehberli turlar veya konuşma davetleri için iletişime geçin.')

@push('styles')
<style>
  .page-head{padding:150px 0 50px;border-bottom:1px solid var(--line)}
  .page-head .wrap{padding-left:44px;width:100%;max-width:100%;margin:0}
  .page-eyebrow{font-family:var(--mono);font-size:12px;letter-spacing:.26em;text-transform:uppercase;
    color:var(--coral);display:block;margin-bottom:16px}
  .page-title{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(40px,7vw,86px);line-height:1;margin:0}
  .page-lead{margin:20px 0 0;color:var(--muted);font-size:17px;max-width:560px;line-height:1.7}

  .page-body{padding:56px 0 90px}
  .contact-wrap{display:grid;grid-template-columns:1.2fr .8fr;gap:60px}

  .alert{padding:14px 18px;border-radius:3px;font-size:15px;margin-bottom:22px}
  .alert-success{background:#f0faf2;border:1px solid #6fcf97;color:#1a7b3c}
  .alert-error{background:#fff5f5;border:1px solid #fc8181;color:#9b2c2c}

  .cform label{display:block;font-family:var(--mono);font-size:11px;letter-spacing:.1em;
    text-transform:uppercase;color:var(--muted);margin:0 0 8px}
  .cfield{margin-bottom:22px}
  .cform input,.cform textarea{width:100%;border:1px solid var(--line);background:var(--paper);
    padding:13px 14px;font:inherit;color:var(--ink);border-radius:3px;transition:border-color .2s}
  .cform input:focus,.cform textarea:focus{outline:none;border-color:var(--coral)}
  .cform input.is-invalid,.cform textarea.is-invalid{border-color:#fc8181}
  .field-error{font-size:12px;color:#e53e3e;margin-top:4px}
  .cform textarea{min-height:130px;resize:vertical}
  .cbtn{background:var(--ink);color:var(--bone);border:0;padding:14px 30px;
    font-family:var(--mono);font-size:12px;letter-spacing:.12em;text-transform:uppercase;
    cursor:pointer;transition:background .2s}
  .cbtn:hover{background:var(--coral)}
  .form-note{font-size:13px;color:var(--muted);margin-top:12px}

  .cinfo h4{font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;
    color:var(--muted);margin:0 0 8px}
  .cinfo p{margin:0 0 26px;color:var(--ink);font-size:16px}
  .cinfo a{color:var(--coral);transition:opacity .2s}
  .cinfo a:hover{opacity:.75}

  @media(max-width:800px){.contact-wrap{grid-template-columns:1fr;gap:34px}}

  /* ── About Section ── */
  .about-section{background:var(--bone-2);padding:80px 0;border-top:1px solid var(--line)}
  .about-intro{display:grid;grid-template-columns:1.05fr .95fr;gap:50px;align-items:center}
  .ab-eye{font-family:var(--mono);font-size:11px;letter-spacing:.24em;text-transform:uppercase;
    color:var(--coral);display:block;margin-bottom:14px}
  .ab-h{font-family:var(--display);font-style:italic;font-weight:500;
    font-size:clamp(30px,4.4vw,52px);line-height:1.05;letter-spacing:.01em;margin:0 0 26px}
  .about-intro .txt p{margin:0 0 16px;color:var(--muted);font-size:16px;line-height:1.78}
  .about-img{position:relative;aspect-ratio:4/5;border-radius:4px;overflow:hidden;background:var(--bone-2)}
  .about-img img{width:100%;height:100%;object-fit:cover;display:block}
  .roles3{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-top:54px}
  .role3{border:1px solid var(--line);border-radius:4px;padding:26px;background:var(--paper)}
  .role3 h3{font-family:var(--display);font-style:italic;font-size:23px;margin:0 0 6px;color:var(--ink)}
  .role3 p{margin:0;font-size:13.5px;color:var(--muted);line-height:1.5}

  @media(max-width:900px){
    .about-intro{grid-template-columns:1fr;gap:30px}
    .roles3{grid-template-columns:1fr}
  }
  @media(max-width:640px){.roles3{grid-template-columns:1fr 1fr}}
</style>
@endpush

@section('content')
<main class="page">

  {{-- ── Sayfa Başlığı ── --}}
  <section class="page-head">
    <div class="wrap">
      <span class="page-eyebrow">
        <span data-tr>İletişim</span><span data-en>Contact</span>
      </span>
      <h1 class="page-title">
        <span data-tr>Yolculuğunu<br>Planlayalım</span>
        <span data-en>Let's Plan<br>Your Journey</span>
      </h1>
      <p class="page-lead">
        <span data-tr>İster özel bir seyahat tasarımı, ister rehberli bir tur, ister bir konuşma daveti — ya da sadece tanışmak istersen, senden haber almak isterim.</span>
        <span class="b" data-en>Whether you're looking for a custom travel design, a guided tour, a speaking engagement, or simply want to connect — I'd love to hear from you.</span>
      </p>
    </div>
  </section>

  {{-- ── İletişim Formu + Bilgiler ── --}}
  <section class="page-body">
    <div class="wrap">
      <div class="contact-wrap">

        <div class="cform">

          {{-- Success / Error alerts --}}
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if($errors->any())
            <div class="alert alert-error">
              @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
            </div>
          @endif

          <form method="POST" action="/{{ $locale }}/contact">
            @csrf
            <div class="cfield">
              <label><span data-tr>Ad Soyad</span><span data-en>Name</span></label>
              <input type="text" name="name" value="{{ old('name') }}"
                class="{{ $errors->has('name') ? 'is-invalid' : '' }}" required>
              @error('name')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div class="cfield">
              <label>E-posta</label>
              <input type="email" name="email" value="{{ old('email') }}"
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required>
              @error('email')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div class="cfield">
              <label><span data-tr>Mesaj</span><span data-en>Message</span></label>
              <textarea name="message" class="{{ $errors->has('message') ? 'is-invalid' : '' }}"
                required>{{ old('message') }}</textarea>
              @error('message')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <button class="cbtn" type="submit">
              <span data-tr>Gönder</span><span data-en>Send Message</span>
            </button>
            <p class="form-note">
              <span data-tr>Genellikle 24–48 saat içinde yanıt veririm.</span>
              <span data-en>I typically respond within 24–48 hours.</span>
            </p>
          </form>
        </div>

        <div class="cinfo">
          <h4><span data-tr>Konum</span><span data-en>Based in</span></h4>
          <p>
            <span data-tr>Her yerde ve hiçbir yerde — şu an yollarda</span>
            <span data-en>Everywhere & nowhere — currently on the road</span>
          </p>
          <h4>E-mail</h4>
          <p><a href="mailto:merhaba@sertacapanay.net">merhaba@sertacapanay.net</a></p>
          <h4><span data-tr>Sosyal</span><span data-en>Social</span></h4>
          <p>
            <a href="#">Instagram</a> &nbsp;·&nbsp; <a href="#">Facebook</a>
          </p>
        </div>

      </div>
    </div>
  </section>

  {{-- ── Hakkımda ── --}}
  <section class="about-section" id="about">
    <div class="wrap">
      <div class="about-intro">
        <div class="txt">
          <span class="ab-eye"><span data-tr>HAKKIMDA</span><span data-en>ABOUT</span></span>
          <h2 class="ab-h">
            <span data-tr>Tur Rehberi.<br>Destinasyon Anlatıcısı.<br>Seyahat Tasarımcısı.</span>
            <span data-en>Tour Guide.<br>Destination Lecturer.<br>Travel Designer.</span>
          </h2>
          <p>
            <span data-tr>Kıtalar boyunca sıra dışı yolculuklar tasarlıyorum. Her destinasyonun kendine özgü bir ruhu, tarihi ve sesi var — bu sesleri dinlemeyi ve aktarmayı seviyorum.</span>
            <span class="b" data-en>I design extraordinary journeys across continents. Every destination has its own spirit, history and voice — I love listening to them and passing them on.</span>
          </p>
          <p>
            <span data-tr>Kültürel anlatı, doğa yürüyüşleri ve lüks deniz yolculuklarından nehir gemisi turlarına kadar uzanan bir deneyim yelpazesiyle, seyahati bir turizm eyleminden çıkarıp gerçek bir keşfe dönüştürüyorum.</span>
            <span class="b" data-en>From cultural storytelling and trekking to luxury ocean voyages and river cruises — I transform travel from a tourism act into a genuine discovery.</span>
          </p>

          <div class="roles3">
            <div class="role3">
              <h3><span data-tr>Tur Rehberi</span><span data-en>Tour Guide</span></h3>
              <p>
                <span data-tr>Yıllar içinde yüzlerce grup ile Türkiye ve dünya genelinde rehberlik yaptım.</span>
                <span class="b" data-en>Led hundreds of groups across Turkey and the world over the years.</span>
              </p>
            </div>
            <div class="role3">
              <h3><span data-tr>Seyahat Yazarı</span><span data-en>Travel Writer</span></h3>
              <p>
                <span data-tr>Destinasyonları, kültürleri ve yol hikâyelerini kaleme alıyorum.</span>
                <span class="b" data-en>Writing about destinations, cultures and stories from the road.</span>
              </p>
            </div>
            <div class="role3">
              <h3><span data-tr>Seyahat Tasarımcısı</span><span data-en>Travel Designer</span></h3>
              <p>
                <span data-tr>Özel, kişiselleştirilmiş seyahat programları tasarlıyorum.</span>
                <span class="b" data-en>Designing bespoke, personalised travel itineraries.</span>
              </p>
            </div>
          </div>
        </div>

        <div class="about-img">
          <img src="{{ asset('images/about-sertac.jpg') }}" alt="Sertaç Apanay" loading="lazy">
        </div>
      </div>
    </div>
  </section>

</main>
@endsection
