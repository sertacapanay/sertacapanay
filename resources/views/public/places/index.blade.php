@extends('public.layout')
@section('title', ($isEn ? 'Places' : 'Yerler').' | Sertac Apanay')

@section('content')

{{-- Page Header --}}
<section class="bg-stone-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-amber-400 uppercase tracking-widest text-xs font-semibold mb-4">
            {{ $isEn ? 'Destinations & Cultures' : 'Destinasyonlar & Kültürler' }}
        </p>
        <h1 class="text-5xl md:text-6xl font-serif">
            {{ $isEn ? 'Places' : 'Yerler' }}
        </h1>
    </div>
</section>

{{-- Country Filter --}}
@if($countries->isNotEmpty())
<div class="border-b bg-white sticky top-[57px] z-40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex gap-3 overflow-x-auto">
        <a href="/{{ $locale }}/places"
           class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium transition
                  {{ !$selectedCountry ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
            {{ $isEn ? 'All' : 'Tümü' }}
        </a>
        @foreach($countries as $country)
            <a href="/{{ $locale }}/places?country={{ urlencode($country) }}"
               class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium transition
                      {{ $selectedCountry === $country ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                {{ $country }}
            </a>
        @endforeach
    </div>
</div>
@endif

{{-- Places Grid --}}
<section class="max-w-7xl mx-auto px-6 py-16">

    @if($places->isEmpty())
        <p class="text-stone-500 text-lg">
            {{ $isEn ? 'No places found.' : 'Henüz yer yok.' }}
        </p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($places as $place)
                @php
                    $locationParts = array_filter([
                        txt($place,'city',$locale),
                        txt($place,'country',$locale),
                    ]);
                @endphp
                <a href="/{{ $locale }}/places/{{ $place->slug }}"
                   class="group bg-white rounded-3xl shadow overflow-hidden hover:shadow-lg transition flex flex-col">

                    {{-- Cover Image --}}
                    @if($place->cover_image)
                        <div class="h-52 overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/'.$place->cover_image) }}"
                                 alt="{{ txt($place,'name',$locale) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="h-52 bg-gradient-to-br from-amber-100 to-stone-200 flex-shrink-0 flex items-center justify-center">
                            <span class="text-stone-400 text-4xl">🗺</span>
                        </div>
                    @endif

                    {{-- Content --}}
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-3 mb-3 flex-wrap">
                            @if($place->type)
                                <span class="text-xs font-semibold uppercase tracking-wider text-amber-700">
                                    {{ $place->type }}
                                </span>
                            @endif
                            @if($locationParts)
                                <span class="text-xs text-stone-400">
                                    {{ implode(' · ', $locationParts) }}
                                </span>
                            @endif
                            @if($place->is_featured)
                                <span class="text-xs border border-amber-400 text-amber-600 px-2 py-0.5 rounded-full">
                                    {{ $isEn ? 'Featured' : 'Öne Çıkan' }}
                                </span>
                            @endif
                        </div>

                        <h2 class="text-xl font-bold mb-2 group-hover:text-amber-700 transition leading-snug">
                            {{ txt($place,'name',$locale) }}
                        </h2>

                        @if(txt($place,'short_description',$locale))
                            <p class="text-stone-500 text-sm leading-relaxed line-clamp-3 flex-1">
                                {{ txt($place,'short_description',$locale) }}
                            </p>
                        @endif

                        <span class="mt-5 text-sm font-semibold text-amber-700 group-hover:underline">
                            {{ $isEn ? 'Explore →' : 'Keşfet →' }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $places->links() }}
        </div>
    @endif

</section>

@endsection
