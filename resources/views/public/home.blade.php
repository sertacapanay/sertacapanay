@extends('public.layout')
@section('title', $isEn ? 'Sertac Apanay | Travel Storyteller' : 'Sertac Apanay | Kültürel Anlatıcı')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[85vh] flex items-center overflow-hidden">
    @if($places->first()?->cover_image)
        <img src="{{ asset('storage/'.$places->first()->cover_image) }}"
             alt="hero"
             class="absolute inset-0 w-full h-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-r from-stone-950/85 via-stone-900/60 to-transparent"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-32">
        <p class="text-amber-400 uppercase tracking-[0.25em] text-xs font-semibold mb-6">
            {{ $isEn ? 'Travel Companion · Cultural Storyteller' : 'Yol Arkadaşı · Kültürel Anlatıcı' }}
        </p>
        <h1 class="text-5xl md:text-7xl font-serif text-white mb-8 max-w-3xl leading-tight">
            {{ $isEn ? 'Every corner of the world has a story.' : 'Dünyanın her köşesinde yeni bir hikâye var.' }}
        </h1>
        <p class="text-xl text-stone-300 max-w-2xl mb-10 leading-relaxed">
            {{ $isEn
                ? 'From Europe to the Far East, from America to Africa, we discover cultures, history and human stories together.'
                : 'Avrupa\'dan Uzak Doğu\'ya, Amerika\'dan Afrika\'ya kadar kültürleri, tarihi ve insan hikâyelerini birlikte keşfediyoruz.' }}
        </p>
        <div class="flex flex-wrap gap-4">
            <a href="/{{ $locale }}/blog"
               class="inline-block bg-amber-500 hover:bg-amber-600 text-white px-8 py-4 rounded-full text-sm font-semibold transition">
                {{ $isEn ? 'Read Blog' : 'Blog\'u Oku' }}
            </a>
            <a href="/{{ $locale }}/places"
               class="inline-block border border-white/40 hover:border-white text-white px-8 py-4 rounded-full text-sm font-semibold transition">
                {{ $isEn ? 'Explore Places' : 'Yerleri Keşfet' }}
            </a>
        </div>
    </div>
</section>

{{-- Featured Places --}}
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex items-end justify-between mb-10">
        <h2 class="text-4xl font-serif">{{ $isEn ? 'Featured Places' : 'Öne Çıkan Yerler' }}</h2>
        <a href="/{{ $locale }}/places" class="text-sm text-amber-700 hover:underline">
            {{ $isEn ? 'See all →' : 'Tümünü gör →' }}
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach($places as $place)
            <a href="/{{ $locale }}/places/{{ $place->slug }}"
               class="group bg-white rounded-3xl shadow overflow-hidden hover:shadow-lg transition">
                @if($place->cover_image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/'.$place->cover_image) }}"
                             alt="{{ txt($place,'name',$locale) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-amber-100 to-stone-200 flex items-center justify-center">
                        <span class="text-stone-400 text-4xl">🗺</span>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-amber-700 transition">
                        {{ txt($place,'name',$locale) }}
                    </h3>
                    <p class="text-stone-500 text-sm leading-relaxed line-clamp-2">
                        {{ txt($place,'short_description',$locale) }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</section>

{{-- Latest Posts --}}
<section class="bg-stone-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-end justify-between mb-10">
            <h2 class="text-4xl font-serif">Blog</h2>
            <a href="/{{ $locale }}/blog" class="text-sm text-amber-700 hover:underline">
                {{ $isEn ? 'All posts →' : 'Tüm yazılar →' }}
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <a href="/{{ $locale }}/blog/{{ $post->slug }}"
                   class="group bg-white rounded-3xl shadow overflow-hidden hover:shadow-lg transition">
                    @if($post->cover_image)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/'.$post->cover_image) }}"
                                 alt="{{ txt($post,'title',$locale) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-amber-50 to-stone-100 flex items-center justify-center">
                            <span class="text-stone-300 text-5xl font-serif">"</span>
                        </div>
                    @endif
                    <div class="p-6">
                        @if(txt($post,'category',$locale))
                            <span class="inline-block text-xs font-semibold uppercase tracking-wider text-amber-700 mb-3">
                                {{ txt($post,'category',$locale) }}
                            </span>
                        @endif
                        <h3 class="text-xl font-bold mb-2 group-hover:text-amber-700 transition leading-snug">
                            {{ txt($post,'title',$locale) }}
                        </h3>
                        <p class="text-stone-500 text-sm leading-relaxed line-clamp-3">
                            {{ txt($post,'excerpt',$locale) }}
                        </p>
                        @if($post->published_at)
                            <p class="mt-4 text-xs text-stone-400">
                                {{ \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMMM YYYY') }}
                            </p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
