@extends('public.layout')
@section('title', txt($place,'name',$locale).' | Sertac Apanay')
@section('description', txt($place,'short_description',$locale))

@section('content')

{{-- Hero --}}
<div class="relative w-full h-[60vh] min-h-[380px] overflow-hidden bg-stone-900">
    @if($place->cover_image)
        <img src="{{ asset('storage/'.$place->cover_image) }}"
             alt="{{ txt($place,'name',$locale) }}"
             class="absolute inset-0 w-full h-full object-cover opacity-65">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-900/30 to-transparent"></div>

    <div class="absolute bottom-0 left-0 right-0 max-w-5xl mx-auto px-6 pb-12">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-stone-400 mb-6">
            <a href="/{{ $locale }}" class="hover:text-white transition">
                {{ $isEn ? 'Home' : 'Anasayfa' }}
            </a>
            <span>/</span>
            <a href="/{{ $locale }}/places" class="hover:text-white transition">
                {{ $isEn ? 'Places' : 'Yerler' }}
            </a>
            <span>/</span>
            <span class="text-stone-300 truncate max-w-xs">{{ txt($place,'name',$locale) }}</span>
        </nav>

        {{-- Type + Location --}}
        <div class="flex flex-wrap items-center gap-3 mb-5">
            @if($place->type)
                <span class="bg-amber-500 text-white text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full">
                    {{ $place->type }}
                </span>
            @endif
            @php
                $locationParts = array_filter([
                    txt($place,'city',$locale),
                    txt($place,'region',$locale),
                    txt($place,'country',$locale),
                ]);
            @endphp
            @if($locationParts)
                <span class="text-stone-300 text-sm">
                    {{ implode(' · ', $locationParts) }}
                </span>
            @endif
            @if($place->is_featured)
                <span class="border border-amber-400 text-amber-400 text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full">
                    {{ $isEn ? 'Featured' : 'Öne Çıkan' }}
                </span>
            @endif
        </div>

        <h1 class="text-4xl md:text-6xl font-serif text-white leading-tight">
            {{ txt($place,'name',$locale) }}
        </h1>
    </div>
</div>

{{-- Article --}}
<article class="max-w-5xl mx-auto px-6 py-16">

    {{-- Short Description / Lead --}}
    @if(txt($place,'short_description',$locale))
        <p class="text-xl md:text-2xl text-stone-500 font-serif italic leading-relaxed mb-16 pb-16 border-b border-stone-200">
            {{ txt($place,'short_description',$locale) }}
        </p>
    @endif

    {{-- Content Sections --}}
    @php
        $sections = [
            ['key' => 'history',    'en' => 'History',         'tr' => 'Tarihçe'],
            ['key' => 'stories',    'en' => 'Stories',         'tr' => 'Hikâyeler'],
            ['key' => 'what_to_see','en' => 'What to See',     'tr' => 'Görülecek Yerler'],
        ];
    @endphp

    <div class="space-y-16">
        @foreach($sections as $section)
            @if(txt($place, $section['key'], $locale))
                <section>
                    <h2 class="text-3xl font-serif mb-6 flex items-center gap-4">
                        <span class="w-8 h-px bg-amber-500 inline-block"></span>
                        {{ $isEn ? $section['en'] : $section['tr'] }}
                    </h2>
                    <div class="text-stone-700 text-lg leading-9 whitespace-pre-line">
                        {{ txt($place, $section['key'], $locale) }}
                    </div>
                </section>
            @endif
        @endforeach
    </div>

    {{-- Map --}}
    @if($place->latitude && $place->longitude)
        <div class="mt-16 pt-16 border-t border-stone-200">
            <h2 class="text-3xl font-serif mb-6 flex items-center gap-4">
                <span class="w-8 h-px bg-amber-500 inline-block"></span>
                {{ $isEn ? 'Location' : 'Konum' }}
            </h2>
            <div class="rounded-2xl overflow-hidden shadow-md">
                <iframe
                    src="https://www.openstreetmap.org/export/embed.html?bbox={{ $place->longitude - 0.15 }},{{ $place->latitude - 0.15 }},{{ $place->longitude + 0.15 }},{{ $place->latitude + 0.15 }}&layer=mapnik&marker={{ $place->latitude }},{{ $place->longitude }}"
                    class="w-full h-72 border-0"
                    loading="lazy"
                    title="{{ txt($place,'name',$locale) }}">
                </iframe>
            </div>
            <a href="https://www.openstreetmap.org/?mlat={{ $place->latitude }}&mlon={{ $place->longitude }}#map=14/{{ $place->latitude }}/{{ $place->longitude }}"
               target="_blank"
               rel="noopener"
               class="inline-block mt-3 text-sm text-amber-700 hover:underline">
                {{ $isEn ? 'Open in OpenStreetMap →' : 'OpenStreetMap\'de aç →' }}
            </a>
        </div>
    @endif

    {{-- Footer --}}
    <div class="mt-16 pt-8 border-t border-stone-200 flex justify-between items-center flex-wrap gap-4">
        @if($locationParts)
            <span class="text-sm text-stone-400">{{ implode(' · ', $locationParts) }}</span>
        @endif
        <a href="/{{ $locale }}/places"
           class="text-sm font-semibold text-stone-600 hover:text-stone-900 transition">
            ← {{ $isEn ? 'Back to Places' : 'Yerlere Dön' }}
        </a>
    </div>

</article>

{{-- Related Places --}}
@if($relatedPlaces->isNotEmpty())
<section class="bg-stone-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-serif mb-10">
            {{ $isEn ? 'More Places' : 'Diğer Yerler' }}
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($relatedPlaces as $related)
                <a href="/{{ $locale }}/places/{{ $related->slug }}"
                   class="group bg-white rounded-3xl shadow overflow-hidden hover:shadow-lg transition flex flex-col">

                    @if($related->cover_image)
                        <div class="h-48 overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/'.$related->cover_image) }}"
                                 alt="{{ txt($related,'name',$locale) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-amber-100 to-stone-200 flex-shrink-0 flex items-center justify-center">
                            <span class="text-stone-400 text-4xl">🗺</span>
                        </div>
                    @endif

                    <div class="p-6 flex flex-col flex-1">
                        @php
                            $relatedLocation = array_filter([
                                txt($related,'city',$locale),
                                txt($related,'country',$locale),
                            ]);
                        @endphp
                        @if($related->type || $relatedLocation)
                            <div class="flex items-center gap-2 mb-3 flex-wrap">
                                @if($related->type)
                                    <span class="text-xs font-semibold uppercase tracking-wider text-amber-700">
                                        {{ $related->type }}
                                    </span>
                                @endif
                                @if($relatedLocation)
                                    <span class="text-xs text-stone-400">
                                        {{ implode(' · ', $relatedLocation) }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        <h3 class="text-lg font-bold mb-2 group-hover:text-amber-700 transition leading-snug flex-1">
                            {{ txt($related,'name',$locale) }}
                        </h3>

                        @if(txt($related,'short_description',$locale))
                            <p class="text-stone-500 text-sm leading-relaxed line-clamp-2 mb-4">
                                {{ txt($related,'short_description',$locale) }}
                            </p>
                        @endif

                        <span class="mt-auto text-sm font-semibold text-amber-700 group-hover:underline">
                            {{ $isEn ? 'Explore →' : 'Keşfet →' }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
