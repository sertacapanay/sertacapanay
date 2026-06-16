@extends('public.layout')
@section('title', txt($tour,'title',$locale).' | Sertac Apanay')
@section('description', txt($tour,'short_description',$locale))

@section('content')

@php
    $currencySymbols = ['EUR' => '€', 'USD' => '$', 'TRY' => '₺', 'GBP' => '£'];
    $symbol = $currencySymbols[$tour->currency] ?? $tour->currency;
@endphp

{{-- Hero --}}
<div class="relative w-full h-[60vh] min-h-[380px] overflow-hidden bg-stone-900">
    @if($tour->cover_image)
        <img src="{{ asset('storage/'.$tour->cover_image) }}"
             alt="{{ txt($tour,'title',$locale) }}"
             class="absolute inset-0 w-full h-full object-cover opacity-65">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-900/30 to-transparent"></div>

    <div class="absolute bottom-0 left-0 right-0 max-w-7xl mx-auto px-6 pb-12">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-stone-400 mb-6">
            <a href="/{{ $locale }}" class="hover:text-white transition">
                {{ $isEn ? 'Home' : 'Anasayfa' }}
            </a>
            <span>/</span>
            <a href="/{{ $locale }}/tours" class="hover:text-white transition">
                {{ $isEn ? 'Tours' : 'Turlar' }}
            </a>
            <span>/</span>
            <span class="text-stone-300 truncate max-w-xs">{{ txt($tour,'title',$locale) }}</span>
        </nav>

        {{-- Badges --}}
        <div class="flex flex-wrap items-center gap-3 mb-5">
            @php
                $locationParts = array_filter([
                    txt($tour,'region',$locale),
                    txt($tour,'country',$locale),
                ]);
            @endphp
            @if($locationParts)
                <span class="bg-amber-500 text-white text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full">
                    {{ implode(' · ', $locationParts) }}
                </span>
            @endif
            @if($tour->duration_days)
                <span class="border border-white/40 text-white text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $tour->duration_days }} {{ $isEn ? 'days' : 'gün' }}
                </span>
            @endif
            @if($tour->is_featured)
                <span class="border border-amber-400 text-amber-400 text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full">
                    {{ $isEn ? 'Featured' : 'Öne Çıkan' }}
                </span>
            @endif
        </div>

        <h1 class="text-4xl md:text-6xl font-serif text-white leading-tight max-w-4xl">
            {{ txt($tour,'title',$locale) }}
        </h1>
    </div>
</div>

{{-- Main Content --}}
<div class="max-w-7xl mx-auto px-6 py-16">
    <div class="lg:grid lg:grid-cols-3 lg:gap-12">

        {{-- Left: Description --}}
        <div class="lg:col-span-2">
            {{-- Lead --}}
            @if(txt($tour,'short_description',$locale))
                <p class="text-xl md:text-2xl text-stone-500 font-serif italic leading-relaxed mb-12 pb-12 border-b border-stone-200">
                    {{ txt($tour,'short_description',$locale) }}
                </p>
            @endif

            {{-- Full Description --}}
            @if(txt($tour,'description',$locale))
                <div class="text-stone-700 text-lg leading-9 whitespace-pre-line">
                    {{ txt($tour,'description',$locale) }}
                </div>
            @endif

            {{-- Back link --}}
            <div class="mt-16 pt-8 border-t border-stone-200">
                <a href="/{{ $locale }}/tours"
                   class="text-sm font-semibold text-stone-600 hover:text-stone-900 transition">
                    ← {{ $isEn ? 'Back to Tours' : 'Turlara Dön' }}
                </a>
            </div>
        </div>

        {{-- Right: Booking Card --}}
        <aside class="mt-12 lg:mt-0">
            <div class="lg:sticky lg:top-24 bg-white rounded-3xl shadow-xl p-8 border border-stone-100">

                {{-- Price --}}
                @if($tour->price)
                    <div class="mb-6">
                        <p class="text-xs uppercase tracking-widest text-stone-400 mb-1">
                            {{ $isEn ? 'Price per person' : 'Kişi başı fiyat' }}
                        </p>
                        <p class="text-4xl font-bold text-stone-900">
                            {{ $symbol }}{{ number_format($tour->price, 0, ',', '.') }}
                        </p>
                    </div>
                @endif

                {{-- Details --}}
                <ul class="space-y-4 mb-8 text-sm">
                    @if($tour->duration_days)
                        <li class="flex justify-between items-center py-3 border-b border-stone-100">
                            <span class="text-stone-500">{{ $isEn ? 'Duration' : 'Süre' }}</span>
                            <span class="font-semibold">
                                {{ $tour->duration_days }} {{ $isEn ? 'days' : 'gün' }}
                            </span>
                        </li>
                    @endif
                    @if($tour->start_date)
                        <li class="flex justify-between items-center py-3 border-b border-stone-100">
                            <span class="text-stone-500">{{ $isEn ? 'Departure' : 'Kalkış' }}</span>
                            <span class="font-semibold">
                                {{ \Carbon\Carbon::parse($tour->start_date)->locale($locale)->isoFormat('D MMMM YYYY') }}
                            </span>
                        </li>
                    @endif
                    @if($locationParts)
                        <li class="flex justify-between items-center py-3 border-b border-stone-100">
                            <span class="text-stone-500">{{ $isEn ? 'Destination' : 'Gidilecek Yer' }}</span>
                            <span class="font-semibold text-right">{{ implode(', ', $locationParts) }}</span>
                        </li>
                    @endif
                </ul>

                {{-- WhatsApp CTA --}}
                <a href="https://wa.me/905000000000?text={{ urlencode(($isEn ? 'Hello, I am interested in the tour: ' : 'Merhaba, bu tur hakkında bilgi almak istiyorum: ') . txt($tour,'title',$locale)) }}"
                   target="_blank"
                   rel="noopener"
                   class="flex items-center justify-center gap-3 w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-4 rounded-2xl transition text-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    {{ $isEn ? 'Ask on WhatsApp' : 'WhatsApp ile Sor' }}
                </a>

                <p class="mt-4 text-xs text-center text-stone-400">
                    {{ $isEn ? 'Free consultation · No commitment' : 'Ücretsiz danışma · Yükümlülük yok' }}
                </p>
            </div>
        </aside>

    </div>
</div>

{{-- Related Tours --}}
@if($relatedTours->isNotEmpty())
<section class="bg-stone-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-serif mb-10">
            {{ $isEn ? 'More Tours' : 'Diğer Turlar' }}
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($relatedTours as $related)
                @php
                    $relatedLocation = array_filter([
                        txt($related,'region',$locale),
                        txt($related,'country',$locale),
                    ]);
                @endphp
                <a href="/{{ $locale }}/tours/{{ $related->slug }}"
                   class="group bg-white rounded-3xl shadow overflow-hidden hover:shadow-lg transition flex flex-col">

                    @if($related->cover_image)
                        <div class="h-48 overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/'.$related->cover_image) }}"
                                 alt="{{ txt($related,'title',$locale) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-amber-100 to-stone-200 flex-shrink-0 flex items-center justify-center">
                            <span class="text-stone-400 text-5xl">✈</span>
                        </div>
                    @endif

                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-2 mb-3 flex-wrap">
                            @if($relatedLocation)
                                <span class="text-xs font-semibold uppercase tracking-wider text-amber-700">
                                    {{ implode(' · ', $relatedLocation) }}
                                </span>
                            @endif
                            @if($related->duration_days)
                                <span class="text-xs text-stone-400">
                                    {{ $related->duration_days }} {{ $isEn ? 'days' : 'gün' }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold mb-2 group-hover:text-amber-700 transition leading-snug flex-1">
                            {{ txt($related,'title',$locale) }}
                        </h3>

                        <div class="mt-4 flex items-center justify-between">
                            @if($related->price)
                                <span class="text-lg font-bold text-stone-900">
                                    {{ $symbol }}{{ number_format($related->price, 0, ',', '.') }}
                                </span>
                            @endif
                            <span class="text-sm font-semibold text-amber-700 group-hover:underline ml-auto">
                                {{ $isEn ? 'Details →' : 'İncele →' }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
