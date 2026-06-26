<!DOCTYPE html>
<html lang="{{ $locale ?? 'tr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Sertaç Apanay')</title>
  <meta name="description" content="@yield('description', 'Kültürel anlatıcı, seyahat uzmanı ve yol arkadaşı.')">
  <meta property="og:title"       content="@yield('title', 'Sertaç Apanay')">
  <meta property="og:description" content="@yield('description', 'Kültürel anlatıcı, seyahat uzmanı.')">
  <meta property="og:type"        content="website">
  <meta name="twitter:card"       content="summary_large_image">
  {{-- Telif Hakkı / Copyright --}}
  <meta name="author"             content="Sertaç Apanay">
  <meta name="copyright"          content="© {{ date('Y') }} Sertaç Apanay. Tüm hakları saklıdır.">
  <meta name="rights"             content="All content on this site is the exclusive property of Sertaç Apanay. Unauthorized reproduction, copying, scraping or redistribution is strictly prohibited.">
  <meta name="robots"             content="index, follow, noodp, noydir">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Public+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  <style>

  :root{
    --ink:hsl(130 8% 10%);--bone:hsl(40 27% 93%);--bone-2:hsl(40 15% 88%);--paper:hsl(40 20% 96%);
    --coral:hsl(24 76% 44%);--coral-2:hsl(24 76% 52%);--gold:hsl(24 70% 55%);--moss:hsl(93 11% 34%);--muted:hsl(100 6% 40%);--line:hsl(40 15% 82%);
    --display:'Cormorant Garamond',Georgia,serif;
    --mono:'JetBrains Mono',ui-monospace,monospace;
    --ui:'Public Sans',system-ui,sans-serif;
  }
  *{box-sizing:border-box;margin:0;padding:0}
  html{scroll-behavior:smooth}
  body{font-family:var(--ui);color:var(--ink);background:var(--bone);line-height:1.65;-webkit-font-smoothing:antialiased}
  img{max-width:100%;display:block}
  a{color:inherit;text-decoration:none}
  .wrap{max-width:1240px;margin:0 auto;padding:0 44px}
  .eyebrow{font-family:var(--mono);font-size:12px;letter-spacing:.26em;text-transform:uppercase;color:var(--coral)}
  .arrow{font-family:var(--mono);font-size:13px;letter-spacing:.1em;text-transform:lowercase;transition:color .25s;white-space:nowrap}
  .arrow:hover{color:var(--coral)}
  .mark{width:34px;height:34px;border:1.5px solid currentColor;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;flex:0 0 auto}
  .mark .pin{width:7px;height:7px;border-radius:50%;background:var(--coral)}

  header{position:fixed;top:0;left:0;right:0;z-index:60;background:transparent;border-bottom:1px solid transparent;transition:background .4s ease,border-color .4s ease}
  header.scrolled{background:rgba(243,239,230,.9);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border-bottom-color:rgba(216,207,190,.55)}
  .topline{display:none}
  .nav{display:flex;align-items:center;justify-content:space-between;height:64px}
  .brand{display:flex;align-items:center;gap:12px}
  .brand .mark{width:24px;height:24px;border:1px solid rgba(243,239,230,.55);border-radius:50%;display:flex;align-items:center;justify-content:center;transition:border-color .25s}
  .brand:hover .mark{border-color:var(--coral)}
  .brand .mark .pin{width:4px;height:4px;border-radius:50%;background:var(--coral)}
  .brand .wm{font-family:var(--mono);font-size:11px;letter-spacing:.25em;text-transform:uppercase;color:rgba(243,239,230,.85);transition:color .4s ease}
  .menu{display:flex;gap:32px;list-style:none}
  .menu a{font-family:var(--ui);font-size:14px;letter-spacing:.02em;color:rgba(243,239,230,.72);transition:color .2s}
  .menu a:hover{color:#fff}
  .nav-right{display:flex;align-items:center;gap:18px}
  .lang{display:flex;border:1px solid rgba(243,239,230,.4);border-radius:40px;overflow:hidden;font-family:var(--mono);font-size:11px;font-weight:700;letter-spacing:.1em;transition:border-color .4s ease}
  .lang button{background:none;border:0;padding:6px 11px;cursor:pointer;color:rgba(243,239,230,.75);transition:all .2s}
  .lang button.active{background:rgba(243,239,230,.9);color:var(--ink)}
  .menu-btn{position:relative;width:44px;height:44px;display:flex;align-items:center;justify-content:center;background:none;border:0;cursor:pointer}
  .menu-btn .ring{width:28px;height:28px;border:1px solid rgba(243,239,230,.7);border-radius:50%;display:flex;align-items:center;justify-content:center;transition:border-color .25s}
  .menu-btn:hover .ring{border-color:#fff}
  .menu-btn .ring .pin{width:6px;height:6px;border-radius:50%;background:var(--coral)}
  .menu-btn .caret{position:absolute;bottom:6px;left:50%;transform:translateX(-50%);width:0;height:0;border-left:3px solid transparent;border-right:3px solid transparent;border-top:5px solid rgba(243,239,230,.6)}
  header.scrolled .brand .mark{border-color:rgba(28,26,24,.5)}
  header.scrolled .brand .wm{color:rgba(28,26,24,.8)}
  header.scrolled .menu a{color:rgba(28,26,24,.6)}
  header.scrolled .menu a:hover{color:var(--ink)}
  header.scrolled .lang{border-color:var(--line)}
  header.scrolled .lang button{color:var(--muted)}
  header.scrolled .lang button.active{background:var(--ink);color:var(--bone)}
  header.scrolled .menu-btn .ring{border-color:rgba(28,26,24,.6)}
  header.scrolled .menu-btn:hover .ring{border-color:var(--ink)}
  header.scrolled .menu-btn .caret{border-top-color:rgba(28,26,24,.55)}
  .overlay{position:fixed;inset:0;z-index:70;background:rgba(220,215,205,.50);backdrop-filter:blur(28px) saturate(1.4);-webkit-backdrop-filter:blur(28px) saturate(1.4);opacity:0;visibility:hidden;transition:opacity .4s ease,visibility .4s}
  .overlay.open{opacity:1;visibility:visible}
  .overlay .ov-close{position:absolute;top:22px;right:26px;width:46px;height:46px;border:1px solid rgba(120,110,95,.5);border-radius:8px;background:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--ink);transition:border-color .2s;z-index:3}
  .overlay .ov-close:hover{border-color:var(--coral)}
  .radial{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:clamp(330px,72vmin,600px);aspect-ratio:1}
  .radial::before,.radial::after{content:"";position:absolute;border-radius:50%;border:1px solid rgba(120,110,95,.32);top:50%;left:50%;transform:translate(-50%,-50%)}
  .radial::before{width:100%;height:100%}
  .radial::after{width:84%;height:84%;border-color:rgba(120,110,95,.2)}
  .r-dot{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:9px;height:9px;border-radius:50%;background:var(--coral)}
  .r-item{position:absolute;transform:translate(-50%,-50%);text-align:center;display:flex;flex-direction:column;align-items:center;gap:5px;color:var(--ink);transition:color .2s;white-space:nowrap;text-shadow:0 1px 16px rgba(0,0,0,.28)}
  .r-item .r-lab{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(19px,2.5vw,32px);line-height:1.02}
  .r-item .r-num{font-family:var(--mono);font-size:11px;letter-spacing:.18em;color:var(--muted);transition:color .2s}
  .r-item:hover,.r-item.active{color:var(--coral)}
  .r-item:hover .r-num,.r-item.active .r-num{color:var(--coral)}
  .r-wm{position:absolute;bottom:50px;left:0;right:0;text-align:center;pointer-events:none;font-family:var(--mono);font-size:12px;letter-spacing:.34em;text-transform:uppercase;color:var(--muted)}
  .r-lang{position:absolute;bottom:22px;left:0;right:0;pointer-events:none;text-align:center;font-family:var(--mono);font-size:11px;letter-spacing:.12em;color:var(--muted)}
  .r-lang a{color:var(--muted);text-decoration:none;padding:4px 7px}
  .r-lang a:hover{color:var(--coral)}
  .r-lang a.active{color:var(--coral)}

  .hero{position:relative;min-height:94vh;display:flex;align-items:center;color:var(--bone);overflow:hidden}
  .hero::before{content:"";position:absolute;inset:0;z-index:0;background:linear-gradient(90deg,rgba(8,10,14,.55) 0%,rgba(8,10,14,.22) 42%,rgba(8,10,14,0) 68%),linear-gradient(180deg,rgba(8,10,14,.5) 0%,rgba(8,10,14,0) 24%,rgba(8,10,14,0) 66%,rgba(8,10,14,.45) 100%),none;background-size:cover;background-position:center 42%}
  .topline{position:absolute;top:30px;left:44px;right:44px;display:flex;justify-content:space-between;align-items:center;z-index:2;font-family:var(--display);font-style:italic;font-size:16px;color:rgba(243,239,230,.8)}
  .topline .pin{width:7px;height:7px;border-radius:50%;background:var(--coral);display:inline-block;margin-right:11px;vertical-align:middle}
  .topline .r .pin{margin:0}
  .hero .wrap{position:relative;z-index:2;padding:96px 44px}
  .roleline{font-family:var(--mono);font-size:12.5px;letter-spacing:.24em;text-transform:uppercase;color:rgba(243,239,230,.78)}
  .hero h1{font-family:var(--display);font-weight:500;font-style:italic;font-size:clamp(46px,7.5vw,104px);line-height:.9;margin:22px 0 0;letter-spacing:.01em}
  .hero h1 .em{color:var(--gold)}
  .hero .sub{font-size:clamp(16px,1.9vw,20px);max-width:600px;margin-top:30px;color:#ece4d6;line-height:1.55}
  .hero-cta{display:flex;gap:20px;margin-top:42px;flex-wrap:wrap;align-items:center}
  .btn{font-family:var(--mono);font-size:13px;letter-spacing:.08em;text-transform:uppercase;padding:17px 30px;cursor:pointer;border:1.5px solid transparent;transition:all .25s;display:inline-flex;align-items:center;gap:10px}
  .btn-coral{background:var(--coral);color:#fff}
  .btn-coral:hover{background:var(--coral-2)}
  .btn-link{background:none;color:#fff;border-bottom:1.5px solid rgba(243,239,230,.55);padding:6px 2px}
  .btn-link:hover{border-color:#fff}
  .scroll-explore{position:absolute;left:26px;top:50%;transform:translateY(-50%) rotate(180deg);writing-mode:vertical-rl;font-family:var(--mono);font-size:11px;letter-spacing:.32em;text-transform:uppercase;color:rgba(243,239,230,.5);z-index:2}
  @media(max-width:900px){.scroll-explore{display:none}}
  .scrollcue{position:absolute;bottom:26px;left:50%;transform:translateX(-50%);z-index:2;color:rgba(243,239,230,.6)}

  .stats{background:var(--paper);border-bottom:1px solid var(--line)}
  .stats .grid{display:grid;grid-template-columns:repeat(4,1fr)}
  .stat{padding:66px 24px;text-align:center;border-right:1px solid var(--line)}
  .stat:last-child{border-right:0}
  .stat .num{font-family:var(--display);font-size:64px;font-weight:500;line-height:1;font-feature-settings:"onum" 1}
  .stat .lbl{font-family:var(--mono);font-size:11.5px;letter-spacing:.15em;text-transform:uppercase;color:var(--muted);margin-top:18px;line-height:1.8}

  .sec{padding:104px 0}
  .sec-head{display:flex;justify-content:space-between;align-items:flex-end;gap:24px;margin-bottom:46px}
  .sec-head .eyebrow{color:var(--muted);display:block;margin-bottom:14px}
  .sec-head h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(40px,6vw,76px);line-height:.98}
  .sec-head .lead{color:var(--muted);font-size:16px;max-width:420px;margin-top:14px}

  .masonry{column-count:2;column-gap:18px}
  .card{position:relative;overflow:hidden;display:flex;align-items:flex-end;padding:28px;color:#fff;break-inside:avoid;margin-bottom:18px;width:100%}
  .card.r34{aspect-ratio:3/4}
  .card.r43{aspect-ratio:4/3}
  .card::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,0) 38%,rgba(10,10,8,.8) 100%);z-index:1}
  .card .bg{position:absolute;inset:0;background-size:cover;background-position:center}
  .card .bg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .9s ease}
  .card:hover .bg img{transform:scale(1.06)}
  .card .meta{position:relative;z-index:2}
  .card .tag{font-family:var(--mono);font-size:11px;letter-spacing:.2em;text-transform:uppercase;color:rgba(243,239,230,.72);display:block;margin-bottom:8px}
  .card .name{font-family:var(--display);font-style:italic;font-weight:500;font-size:40px;line-height:1;margin-bottom:8px}
  .card .desc{font-size:14.5px;color:#e8e0d2;max-width:340px;line-height:1.45}

  .notes{background:var(--bone-2)}
  .notes-grid{display:grid;grid-template-columns:1fr 1fr;gap:46px}
  .note .nimg{position:relative;aspect-ratio:16/11;overflow:hidden;background:linear-gradient(160deg,#5a4a3a,#b0895a);margin-bottom:22px}
  .note .nimg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
  .note .loc{font-family:var(--mono);font-size:11.5px;letter-spacing:.15em;text-transform:uppercase;color:var(--coral);display:flex;align-items:center;gap:8px;margin-bottom:12px}
  .note h3{font-family:var(--display);font-style:italic;font-weight:500;font-size:30px;line-height:1.08;margin-bottom:10px}
  .note.alt h3{color:var(--coral)}
  .note p{font-size:15.5px;color:var(--muted)}
  .note:hover h3{color:var(--coral)}

  .bazaar-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px}
  .prod{cursor:pointer}
  .prod .pimg{position:relative;aspect-ratio:3/4;overflow:hidden;margin-bottom:18px}
  .prod .pimg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
  .prod:hover .pimg img{transform:scale(1.02)}
  .prod .src{font-family:var(--mono);font-size:10.5px;letter-spacing:.16em;text-transform:uppercase;color:var(--coral);display:block;margin-bottom:8px}
  .prod .pname{font-family:var(--display);font-style:italic;font-weight:600;font-size:23px;line-height:1.1;margin-bottom:5px}
  .prod.alt .pname{color:var(--coral)}
  .prod .price{font-family:var(--mono);font-size:13px;color:var(--muted)}

  .comm{text-align:center}
  .comm .eyebrow{color:var(--muted)}
  .comm h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(42px,6vw,74px);line-height:1;margin:16px 0 22px}
  .comm .lead{max-width:560px;margin:0 auto 44px;color:var(--muted);font-size:17px}
  .comm .socials{display:flex;gap:18px;justify-content:center;margin-bottom:56px}
  .comm .socials a{display:flex;flex-direction:column;align-items:center;gap:12px;font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:var(--muted)}
  .comm .socials .box{width:66px;height:66px;border:1px solid var(--line);display:flex;align-items:center;justify-content:center;transition:all .25s}
  .comm .socials a:hover .box{border-color:var(--coral);background:var(--coral)}
  .comm .socials a:hover .box svg{stroke:#fff}
  .comm .socials svg{width:24px;height:24px;stroke:var(--ink)}
  .news{max-width:620px;margin:0 auto;border:1px solid var(--line);padding:46px 40px;background:var(--paper)}
  .news h3{font-family:var(--display);font-style:italic;font-weight:500;font-size:28px;margin-bottom:10px}
  .news p{color:var(--muted);font-size:15px;margin-bottom:26px}
  .news .row{display:flex;gap:0}
  .news input{flex:1;border:1px solid var(--line);background:var(--bone-2);padding:16px 18px;font-family:var(--ui);font-size:15px;color:var(--ink)}
  .news input:focus{outline:none;border-color:var(--coral)}
  .news button{background:var(--ink);color:var(--bone);border:0;padding:0 28px;font-family:var(--mono);font-size:12px;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;transition:background .2s}
  .news button:hover{background:var(--coral)}

  footer{background:var(--ink);color:#cdc7ba;padding:84px 0 0}
  .foot{display:grid;grid-template-columns:1.7fr 1fr 1fr;gap:48px;padding-bottom:60px}
  .foot .brand{color:#e9e3d6;margin-bottom:26px}
  .foot .roles{font-family:var(--display);font-style:italic;font-size:26px;line-height:1.3;color:#e9e3d6;margin-bottom:20px}
  .foot .blurb{font-size:15px;max-width:380px;color:#9a9384}
  .foot h4{font-family:var(--mono);font-size:11.5px;letter-spacing:.2em;text-transform:uppercase;color:#8a8474;margin-bottom:22px}
  .foot ul{list-style:none;display:flex;flex-direction:column;gap:14px}
  .foot ul a{font-size:16px;color:#cdc7ba;transition:color .2s}
  .foot ul a:hover{color:var(--coral-2)}
  .foot-bottom{border-top:1px solid rgba(243,239,230,.12);padding:24px 0;display:flex;justify-content:space-between;font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:#7d7768}

  @media(max-width:1024px){.menu{display:none}}
  @media(max-width:1024px){
    .stats .grid{grid-template-columns:1fr 1fr}
    .stat:nth-child(2){border-right:0}
    .stat{border-bottom:1px solid var(--line)}
    .notes-grid{grid-template-columns:1fr;gap:38px}
    .bazaar-grid{grid-template-columns:repeat(2,1fr);gap:28px}
    .foot{grid-template-columns:1fr 1fr}
  }
  @media(max-width:640px){
    .wrap{padding:0 22px}.nav{height:64px}
    .brand .wm{display:none}
    .hero .wrap{padding:80px 22px}
    .stats .grid{grid-template-columns:1fr}.stat{border-right:0}
    .masonry{column-count:1}
    .bazaar-grid{grid-template-columns:1fr 1fr;gap:20px}
    .foot{grid-template-columns:1fr}
    .foot-bottom{flex-direction:column;gap:8px}
    .news .row{flex-direction:column;gap:12px}.news button{padding:15px}
  }
  @media(prefers-reduced-motion:reduce){*{transition:none!important;animation:none!important}}
  :focus-visible{outline:2px solid var(--coral);outline-offset:3px}
  html [data-en]{display:none}
  html[lang="en"] [data-tr]{display:none}
  html[lang="en"] [data-en]{display:inline}
  html[lang="en"] [data-en].b{display:block}
  .about .ab-eye{display:block;color:var(--muted);margin-bottom:12px}
  .ab-h{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(30px,4.4vw,52px);line-height:1.05;letter-spacing:.01em;margin:0 0 26px}
  .about-intro{display:grid;grid-template-columns:1.05fr .95fr;gap:50px;align-items:center}
  .about-intro .txt p{margin:0 0 16px;color:var(--muted);font-size:16px;line-height:1.78}
  .about-intro .intro-lead{color:var(--ink)}
  .about-img{position:relative;aspect-ratio:4/5;border-radius:4px;overflow:hidden;background:var(--bone-2)}
  .about-img img{width:100%;height:100%;object-fit:cover;display:block}
  .roles3{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-top:54px}
  .role3{border:1px solid var(--line);border-radius:4px;padding:26px;background:var(--paper)}
  .role3 h3{font-family:var(--display);font-style:italic;font-size:23px;margin:0 0 6px;color:var(--ink)}
  .role3 p{margin:0;font-size:13.5px;color:var(--muted)}
  .tsec{margin-top:66px}
  .tgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:30px;margin-top:18px}
  .tcard{border-top:1px solid var(--ink);padding-top:22px}
  .tcard .q{font-family:var(--display);font-style:italic;font-size:18px;line-height:1.5;color:var(--ink);margin:0 0 18px}
  .tcard .who{font-family:var(--mono);font-size:12px;letter-spacing:.04em;color:var(--ink)}
  .tcard .trip{font-family:var(--mono);font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-top:5px}
  @media(max-width:840px){.about-intro{grid-template-columns:1fr;gap:30px}.roles3,.tgrid{grid-template-columns:1fr}}

  body.sub{padding-top:0}
  .page-head{padding:150px 0 50px;border-bottom:1px solid var(--line)}
  .page-eyebrow{font-family:var(--mono);font-size:12px;letter-spacing:.26em;text-transform:uppercase;color:var(--coral);display:block;margin-bottom:16px}
  .page-title{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(40px,7vw,86px);line-height:1;margin:0}
  .page-lead{margin:20px 0 0;color:var(--muted);font-size:17px;max-width:560px;line-height:1.7}
  .page-body{padding:56px 0 90px}
  .page-hero{position:relative;min-height:56vh;display:flex;align-items:flex-end;padding:120px 0 56px;background-size:cover;background-position:center}
  .page-hero .wrap{padding-left:44px;width:100%;max-width:100%;margin-left:0;margin-right:0}
  .page-hero .page-eyebrow{color:rgba(255,255,255,.85)}
  .page-hero .page-title{color:#fff}
  .page-hero .page-lead{color:rgba(255,255,255,.88)}
  .post-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:40px}
  .post{display:block}
  .post .pthumb{aspect-ratio:16/10;overflow:hidden;border-radius:4px;margin-bottom:18px;background:var(--bone-2)}
  .post .pthumb img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .post:hover .pthumb img{transform:scale(1.04)}
  .post .pmeta{font-family:var(--mono);font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:var(--coral);margin-bottom:10px}
  .post .pmeta .dot{color:var(--muted);margin:0 7px}
  .post h3{font-family:var(--display);font-style:italic;font-weight:500;font-size:26px;line-height:1.15;margin:0 0 10px;color:var(--ink)}
  .post p{margin:0;color:var(--muted);font-size:15px;line-height:1.65}
  @media(max-width:700px){.post-grid{grid-template-columns:1fr}}
  .guide-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:40px}
  .guide{display:block}
  .guide .gimg{aspect-ratio:16/10;overflow:hidden;border-radius:4px;margin-bottom:18px;background:var(--bone-2)}
  .guide .gimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .guide:hover .gimg img{transform:scale(1.04)}
  .guide .gloc{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--coral)}
  .guide .gtag{font-family:var(--mono);font-size:9.5px;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);border:1px solid var(--line);padding:2px 7px;border-radius:20px;margin-left:6px}
  .guide h3{font-family:var(--display);font-style:italic;font-weight:500;font-size:25px;line-height:1.15;margin:12px 0 8px;color:var(--ink)}
  .guide p{margin:0;color:var(--muted);font-size:15px;line-height:1.6}
  @media(max-width:700px){.guide-grid{grid-template-columns:1fr}}
  .article{max-width:760px;margin:0 auto;padding:54px 0 70px}
  .article .back{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);display:inline-block;margin-bottom:30px}
  .article .ameta{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--coral);margin-bottom:14px}
  .article .ameta .dot{color:var(--muted);margin:0 7px}
  .article h1{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(34px,5.5vw,56px);line-height:1.05;margin:0 0 18px;color:var(--ink)}
  .article .lede{font-size:19px;line-height:1.7;color:var(--ink);margin:0 0 10px}
  .article h2{font-family:var(--display);font-style:italic;font-weight:500;font-size:28px;margin:38px 0 12px;color:var(--ink)}
  .article p{font-size:16.5px;line-height:1.8;color:var(--muted);margin:0 0 16px}
  .article .ahero{aspect-ratio:16/9;border-radius:4px;overflow:hidden;margin:30px 0 8px;background:var(--bone-2)}
  .article .ahero img{width:100%;height:100%;object-fit:cover}
  .atags{margin-top:34px;display:flex;gap:8px;flex-wrap:wrap}
  .atags .gtag{font-family:var(--mono);font-size:10px;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);border:1px solid var(--line);padding:4px 10px;border-radius:20px}
  .recs{max-width:760px;margin:0 auto 80px}
  .recs h2{font-family:var(--display);font-style:italic;font-size:28px;margin:0 0 8px;color:var(--ink)}
  .rec{display:flex;gap:16px;align-items:baseline;padding:18px 0;border-top:1px solid var(--line)}
  .rec .rcat{font-family:var(--mono);font-size:10px;letter-spacing:.1em;text-transform:uppercase;color:var(--coral);min-width:74px}
  .rec h3{font-family:var(--display);font-style:italic;font-size:21px;margin:0 0 3px;color:var(--ink)}
  .rec p{margin:0;color:var(--muted);font-size:14.5px}
  .pd{display:grid;grid-template-columns:1fr 1fr;gap:56px;padding:54px 0 46px;align-items:start}
  .pd .pdimg{aspect-ratio:4/5;border-radius:4px;overflow:hidden;background:var(--bone-2)}
  .pd .pdimg img{width:100%;height:100%;object-fit:cover}
  .pd .pdsrc{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--coral)}
  .pd h1{font-family:var(--display);font-style:italic;font-weight:500;font-size:clamp(32px,4.5vw,48px);margin:10px 0 6px;color:var(--ink)}
  .pd .pdprice{font-size:20px;color:var(--ink);margin-bottom:20px}
  .pd .pddesc{color:var(--muted);font-size:16px;line-height:1.75;margin-bottom:26px}
  .origin{max-width:760px;margin:0 auto;padding:40px 0 80px;border-top:1px solid var(--line)}
  .origin h2{font-family:var(--display);font-style:italic;font-size:26px;margin:0 0 14px;color:var(--ink)}
  .origin p{color:var(--muted);font-size:16.5px;line-height:1.8}
  @media(max-width:800px){.pd{grid-template-columns:1fr;gap:28px}}
  .contact-wrap{display:grid;grid-template-columns:1.2fr .8fr;gap:60px}
  .cform label{display:block;font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin:0 0 8px}
  .cfield{margin-bottom:22px}
  .cform input,.cform textarea{width:100%;border:1px solid var(--line);background:var(--paper);padding:13px 14px;font:inherit;color:var(--ink);border-radius:3px}
  .cform textarea{min-height:130px;resize:vertical}
  .cbtn{background:var(--ink);color:var(--bone);border:0;padding:14px 30px;font-family:var(--mono);font-size:12px;letter-spacing:.12em;text-transform:uppercase;cursor:pointer}
  .cinfo h4{font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:var(--muted);margin:0 0 8px}
  .cinfo p{margin:0 0 26px;color:var(--ink);font-size:16px}
  .cinfo a{color:var(--coral)}
  @media(max-width:800px){.contact-wrap{grid-template-columns:1fr;gap:34px}}

  /* Tours listing */
  .tours-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:32px}
  .tour-card{display:block;background:var(--paper);border:1px solid var(--line)}
  .tour-card .timg{aspect-ratio:3/4;overflow:hidden;background:var(--bone-2)}
  .tour-card .timg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .tour-card:hover .timg img{transform:scale(1.04)}
  .tour-card .tbody{padding:20px}
  .tour-card .tcountry{font-family:var(--mono);font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:var(--coral);margin-bottom:8px}
  .tour-card h3{font-family:var(--display);font-style:italic;font-size:22px;line-height:1.1;margin:0 0 8px;color:var(--ink)}
  .tour-card .tprice{font-family:var(--mono);font-size:13px;color:var(--muted)}
  @media(max-width:900px){.tours-grid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:580px){.tours-grid{grid-template-columns:1fr}}

  /* Places listing */
  .places-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
  .place-card{display:block}
  .place-card .pimg{aspect-ratio:4/3;overflow:hidden;border-radius:4px;background:var(--bone-2);margin-bottom:14px}
  .place-card .pimg img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .place-card:hover .pimg img{transform:scale(1.04)}
  .place-card .pcountry{font-family:var(--mono);font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:var(--coral);margin-bottom:6px}
  .place-card h3{font-family:var(--display);font-style:italic;font-size:22px;line-height:1.1;margin:0;color:var(--ink)}
  @media(max-width:900px){.places-grid{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:580px){.places-grid{grid-template-columns:1fr}}

  /* Filter bar */
  .filter-bar{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px}
  .filter-btn{font-family:var(--mono);font-size:11px;letter-spacing:.1em;text-transform:uppercase;padding:8px 16px;border:1px solid var(--line);background:transparent;color:var(--muted);cursor:pointer;text-decoration:none;transition:all .2s}
  .filter-btn.active,.filter-btn:hover{border-color:var(--coral);color:var(--coral)}

  /* Tour detail */
  .tour-detail{display:grid;grid-template-columns:1fr 340px;gap:56px;padding:54px 0 90px;align-items:start}
  .tour-detail .td-body h2{font-family:var(--display);font-style:italic;font-size:28px;margin:34px 0 12px;color:var(--ink)}
  .tour-detail .td-body p{font-size:16px;line-height:1.8;color:var(--muted);margin:0 0 16px}
  .booking-panel{position:sticky;top:84px;border:1px solid var(--line);padding:28px;background:var(--paper)}
  .booking-panel h3{font-family:var(--display);font-style:italic;font-size:24px;margin:0 0 6px;color:var(--ink)}
  .booking-panel .bp-price{font-size:22px;font-weight:600;color:var(--ink);margin:0 0 18px}
  .booking-panel .bp-info{font-size:14px;color:var(--muted);margin:0 0 22px;line-height:1.6}
  .booking-panel .wa-btn{display:block;background:#25D366;color:#fff;text-align:center;padding:15px;font-family:var(--mono);font-size:12px;letter-spacing:.1em;text-transform:uppercase;transition:background .2s}
  .booking-panel .wa-btn:hover{background:#20b858}
  @media(max-width:900px){.tour-detail{grid-template-columns:1fr}}

  </style>
  @stack('styles')
</head>
<body>

<header id="site-header">
  <div class="wrap nav">
    <a href="/{{ $locale ?? 'tr' }}" class="brand">
      <span class="mark"><span class="pin"></span></span>
      <span class="wm">Sertaç Apanay</span>
    </a>
    <ul class="menu">
      <li><a href="/{{ $locale ?? 'tr' }}/places"><span data-tr>Destinasyonlar</span><span data-en>Destinations</span></a></li>
      <li><a href="/{{ $locale ?? 'tr' }}/flights"><span data-tr>Uçuşlar</span><span data-en>Flights</span></a></li>
      <li><a href="/{{ $locale ?? 'tr' }}/tours"><span data-tr>Seyirler</span><span data-en>Cruises</span></a></li>
      <li><a href="/{{ $locale ?? 'tr' }}/guides"><span data-tr>Rehberler</span><span data-en>Guides</span></a></li>
      <li><a href="/{{ $locale ?? 'tr' }}/blog">Blog</a></li>
      <li><a href="/{{ $locale ?? 'tr' }}/shop"><span data-tr>Çarşı</span><span data-en>Shop</span></a></li>
    </ul>
    <div class="nav-right">
      @php $loc = $locale ?? 'tr'; $currentPath = preg_replace('#^/(tr|en)#','',request()->getPathInfo()); @endphp
      <div class="lang">
        <button onclick="window.location='/tr{{ $currentPath }}'" class="{{ $loc==='tr'?'active':'' }}">TR</button>
        <button onclick="window.location='/en{{ $currentPath }}'" class="{{ $loc==='en'?'active':'' }}">EN</button>
      </div>
      <button class="menu-btn" aria-label="Menü" onclick="toggleMenu(true)">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
          <circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/>
        </svg>
      </button>
    </div>
  </div>
</header>

<div class="overlay" id="overlay">
  <button class="ov-close" aria-label="Kapat" onclick="toggleMenu(false)">
    <svg width="20" height="20" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" fill="none"><path d="M6 6l12 12M18 6L6 18"/></svg>
  </button>
  <div class="radial">
    <span class="r-dot"></span>
    @php
      $loc = $locale ?? 'tr';
      $currentPath = preg_replace('#^/(tr|en)#', '', request()->getPathInfo());
      $otherLocale = $loc === 'tr' ? 'en' : 'tr';
    @endphp
    <a class="r-item {{ request()->is($loc) || request()->is($loc.'/') ? 'active' : '' }}"
       style="left:50.0%;top:10.0%" href="/{{ $loc }}" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>Ana&nbsp;Sayfa</span><span data-en>Home</span></span>
      <span class="r-num">01</span>
    </a>
    <a class="r-item {{ request()->is($loc.'/places*') ? 'active' : '' }}"
       style="left:75.7%;top:19.4%" href="/{{ $loc }}/places" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>Destinasyonlar</span><span data-en>Destinations</span></span>
      <span class="r-num">02</span>
    </a>
    <a class="r-item {{ request()->is($loc.'/tours*') ? 'active' : '' }}"
       style="left:89.4%;top:43.1%" href="/{{ $loc }}/tours" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>Seyir&nbsp;Günlükleri</span><span data-en>Cruise&nbsp;Log</span></span>
      <span class="r-num">03</span>
    </a>
    <a class="r-item {{ request()->is($loc.'/flights*') ? 'active' : '' }}"
       style="left:84.6%;top:70.0%" href="/{{ $loc }}/flights" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>Uçuşlar</span><span data-en>Flights</span></span>
      <span class="r-num">04</span>
    </a>
    <a class="r-item {{ request()->is($loc.'/guides*') ? 'active' : '' }}"
       style="left:63.7%;top:87.6%" href="/{{ $loc }}/guides" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>Rehberler</span><span data-en>Guides</span></span>
      <span class="r-num">05</span>
    </a>
    <a class="r-item {{ request()->is($loc.'/blog*') ? 'active' : '' }}"
       style="left:36.3%;top:87.6%" href="/{{ $loc }}/blog" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>Blog</span><span data-en>Blog</span></span>
      <span class="r-num">06</span>
    </a>
    <a class="r-item {{ request()->is($loc.'/shop*') ? 'active' : '' }}"
       style="left:15.4%;top:70.0%" href="/{{ $loc }}/shop" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>Çarşı</span><span data-en>Shop</span></span>
      <span class="r-num">07</span>
    </a>
    <a class="r-item {{ request()->is($loc.'/about*') ? 'active' : '' }}"
       style="left:10.6%;top:43.1%" href="/{{ $loc }}/about" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>Hakkımda</span><span data-en>About</span></span>
      <span class="r-num">08</span>
    </a>
    <a class="r-item {{ request()->is($loc.'/contact*') ? 'active' : '' }}"
       style="left:24.3%;top:19.4%" href="/{{ $loc }}/contact" onclick="toggleMenu(false)">
      <span class="r-lab"><span data-tr>İletişim</span><span data-en>Contact</span></span>
      <span class="r-num">09</span>
    </a>
    <div class="r-wm">Sertaç Apanay</div>
    <div class="r-lang">
      <a href="/tr{{ $currentPath }}" class="{{ $loc === 'tr' ? 'active' : '' }}">TR</a>
      /
      <a href="/en{{ $currentPath }}" class="{{ $loc === 'en' ? 'active' : '' }}">EN</a>
    </div>
  </div>
</div>

@yield('content')

<footer id="footer">
  <div class="wrap">
    <div class="foot">
      <div>
        <a href="/{{ $locale ?? 'tr' }}" class="brand">
          <span class="mark"><span class="pin"></span></span>
          <span class="wm">Sertaç Apanay</span>
        </a>
        <div class="roles">
          <span data-tr>Tur rehberi. Destinasyon anlatıcısı.<br>Seyahat tasarımcısı.</span>
          <span class="b" data-en>Tour guide. Destination lecturer.<br>Travel designer.</span>
        </div>
        <p class="blurb" data-tr>Kıtalar boyunca sıra dışı yolculuklar tasarlıyorum. Her destinasyonun bir hikâyesi var — seninkini keşfetmene yardım edeyim.</p>
        <p class="blurb b" data-en>Curating extraordinary journeys across continents. Every destination has a story — let me help you discover yours.</p>
      </div>
      <div>
        <h4><span data-tr>Keşfet</span><span data-en>Explore</span></h4>
        <ul>
          <li><a href="/{{ $locale ?? 'tr' }}/places"><span data-tr>Destinasyonlar</span><span data-en>Destinations</span></a></li>
          <li><a href="/{{ $locale ?? 'tr' }}/tours"><span data-tr>Seyir Günlükleri</span><span data-en>Cruise Log</span></a></li>
          <li><a href="/{{ $locale ?? 'tr' }}/guides"><span data-tr>Şehir Rehberleri</span><span data-en>City Guides</span></a></li>
          <li><a href="/{{ $locale ?? 'tr' }}/blog">Blog</a></li>
        </ul>
      </div>
      <div>
        <h4><span data-tr>İletişim</span><span data-en>Connect</span></h4>
        <ul>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">Facebook</a></li>
          <li><a href="/{{ $locale ?? 'tr' }}/about"><span data-tr>Hakkımda</span><span data-en>About Me</span></a></li>
          <li><a href="/{{ $locale ?? 'tr' }}/contact"><span data-tr>İletişim</span><span data-en>Contact</span></a></li>
        </ul>
      </div>
    </div>
    <div class="foot-bottom">
      <span data-tr>© {{ date('Y') }} Sertaç Apanay — Tüm hakları saklıdır</span>
      <span data-en>© {{ date('Y') }} Sertaç Apanay — All rights reserved</span>
      <span data-tr>Meraklılar için tasarlandı</span>
      <span data-en>Designed for the curious</span>
    </div>
  </div>
</footer>

<script>
function toggleMenu(open) {
  document.getElementById('overlay').classList.toggle('open', open);
  document.body.style.overflow = open ? 'hidden' : '';
}
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') toggleMenu(false); });

(function() {
  var h = document.getElementById('site-header');
  function s() { h.classList.toggle('scrolled', window.scrollY > 30); }
  window.addEventListener('scroll', s, { passive: true });
  s();
})();

function alignHero() {
  var brand = document.querySelector('.brand');
  var hw = document.querySelector('.hero .wrap, .page-hero .wrap, .page-head .wrap');
  if (!brand || !hw) return;
  hw.style.paddingLeft = Math.round(brand.getBoundingClientRect().left) + 'px';
}
window.addEventListener('load', alignHero);
window.addEventListener('resize', alignHero);
alignHero();
</script>

@stack('scripts')
</body>
</html>
