<!DOCTYPE html>
<html lang="{{ $locale ?? 'tr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Sertac Apanay')</title>
    <meta name="description" content="@yield('description', 'Kültürel anlatıcı, seyahat uzmanı ve yol arkadaşı.')">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="@yield('title', 'Sertac Apanay')">
    <meta property="og:description" content="@yield('description', 'Kültürel anlatıcı, seyahat uzmanı ve yol arkadaşı.')">
    <meta property="og:locale"      content="{{ ($locale ?? 'tr') === 'en' ? 'en_US' : 'tr_TR' }}">
    <meta name="twitter:card"       content="summary_large_image">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .font-serif { font-family: 'Playfair Display', Georgia, serif; }
        body        { font-family: 'Inter', system-ui, sans-serif; }
        html        { scroll-behavior: smooth; }
    </style>
</head>

<body class="bg-[#fffaf3] text-stone-900 antialiased">

    {{-- Header --}}
    <header class="border-b border-stone-200 bg-white/90 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="/{{ $locale ?? 'tr' }}"
                   class="font-serif text-xl font-bold tracking-tight hover:text-amber-700 transition">
                    Sertac Apanay
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden md:flex items-center gap-1">
                    @php
                        $loc = $locale ?? 'tr';
                        $en  = $isEn ?? false;
                        $navLinks = [
                            ['href' => "/{$loc}/places", 'label' => $en ? 'Places' : 'Yerler',  'match' => "{$loc}/places*"],
                            ['href' => "/{$loc}/blog",   'label' => 'Blog',                      'match' => "{$loc}/blog*"],
                            ['href' => "/{$loc}/tours",  'label' => $en ? 'Tours' : 'Turlar',   'match' => "{$loc}/tours*"],
                        ];
                    @endphp

                    @foreach($navLinks as $link)
                        <a href="{{ $link['href'] }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition
                                  {{ request()->is($link['match'])
                                     ? 'bg-stone-900 text-white'
                                     : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    {{-- Locale Toggle --}}
                    <a href="/{{ $loc === 'tr' ? 'en' : 'tr' }}"
                       class="ml-2 px-3 py-1.5 rounded-full text-xs font-semibold border border-stone-200 text-stone-500 hover:border-stone-400 hover:text-stone-800 transition">
                        {{ $loc === 'tr' ? 'EN' : 'TR' }}
                    </a>
                </nav>

                {{-- Mobile: locale + hamburger --}}
                <div class="flex md:hidden items-center gap-3">
                    <a href="/{{ ($locale ?? 'tr') === 'tr' ? 'en' : 'tr' }}"
                       class="text-xs font-semibold text-stone-500 border border-stone-200 px-3 py-1.5 rounded-full hover:border-stone-400 transition">
                        {{ ($locale ?? 'tr') === 'tr' ? 'EN' : 'TR' }}
                    </a>
                    <button id="menu-toggle"
                            aria-label="Menu"
                            class="p-2 rounded-lg text-stone-600 hover:bg-stone-100 transition">
                        <svg id="icon-open"  class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg id="icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-stone-100 bg-white">
            <nav class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-1">
                @foreach($navLinks as $link)
                    <a href="{{ $link['href'] }}"
                       class="px-4 py-3 rounded-xl text-sm font-medium transition
                              {{ request()->is($link['match'])
                                 ? 'bg-stone-900 text-white'
                                 : 'text-stone-600 hover:bg-stone-100' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </header>

    {{-- Main --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-stone-950 text-stone-300 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-12 pb-12 border-b border-stone-800">

                {{-- Brand --}}
                <div>
                    <a href="/{{ $locale ?? 'tr' }}"
                       class="font-serif text-xl font-bold text-white hover:text-amber-400 transition">
                        Sertac Apanay
                    </a>
                    <p class="mt-3 text-sm text-stone-400 leading-relaxed">
                        {{ ($isEn ?? false)
                            ? 'Travel companion & cultural storyteller. Discovering the world\'s stories from Europe to the Far East.'
                            : 'Yol arkadaşı ve kültürel anlatıcı. Avrupa\'dan Uzak Doğu\'ya dünyanın hikâyelerini keşfediyoruz.' }}
                    </p>
                    {{-- Social / WhatsApp --}}
                    <a href="https://wa.me/905000000000"
                       target="_blank"
                       rel="noopener"
                       class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-green-400 hover:text-green-300 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        WhatsApp
                    </a>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-xs uppercase tracking-widest font-semibold text-stone-500 mb-5">
                        {{ ($isEn ?? false) ? 'Explore' : 'Keşfet' }}
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="/{{ $locale ?? 'tr' }}/places"
                               class="hover:text-white transition">
                                {{ ($isEn ?? false) ? 'Places' : 'Yerler' }}
                            </a>
                        </li>
                        <li>
                            <a href="/{{ $locale ?? 'tr' }}/blog"
                               class="hover:text-white transition">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="/{{ $locale ?? 'tr' }}/tours"
                               class="hover:text-white transition">
                                {{ ($isEn ?? false) ? 'Tours' : 'Turlar' }}
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Language --}}
                <div>
                    <h3 class="text-xs uppercase tracking-widest font-semibold text-stone-500 mb-5">
                        {{ ($isEn ?? false) ? 'Language' : 'Dil' }}
                    </h3>
                    <div class="flex gap-3">
                        <a href="/tr"
                           class="text-sm px-4 py-2 rounded-full border transition
                                  {{ ($locale ?? 'tr') === 'tr'
                                     ? 'border-amber-500 text-amber-400'
                                     : 'border-stone-700 text-stone-400 hover:border-stone-500 hover:text-stone-200' }}">
                            Türkçe
                        </a>
                        <a href="/en"
                           class="text-sm px-4 py-2 rounded-full border transition
                                  {{ ($locale ?? 'tr') === 'en'
                                     ? 'border-amber-500 text-amber-400'
                                     : 'border-stone-700 text-stone-400 hover:border-stone-500 hover:text-stone-200' }}">
                            English
                        </a>
                    </div>
                </div>

            </div>

            {{-- Bottom bar --}}
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-stone-500">
                <p>© {{ date('Y') }} Sertac Apanay. {{ ($isEn ?? false) ? 'All rights reserved.' : 'Tüm hakları saklıdır.' }}</p>
            </div>
        </div>
    </footer>

    {{-- Mobile menu toggle --}}
    <script>
        (function () {
            var toggle = document.getElementById('menu-toggle');
            var menu   = document.getElementById('mobile-menu');
            var open   = document.getElementById('icon-open');
            var close  = document.getElementById('icon-close');
            if (!toggle) return;
            toggle.addEventListener('click', function () {
                var hidden = menu.classList.toggle('hidden');
                open.classList.toggle('hidden', !hidden);
                close.classList.toggle('hidden', hidden);
            });
        })();
    </script>

</body>
</html>
