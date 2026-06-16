@extends('public.layout')
@section('title', ($isEn ? 'Tours' : 'Turlar').' | Sertac Apanay')

@section('content')

@php
    $currencySymbols = ['EUR' => '€', 'USD' => '$', 'TRY' => '₺', 'GBP' => '£'];
@endphp

{{-- Page Header --}}
<section class="bg-stone-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-amber-400 uppercase tracking-widest text-xs font-semibold mb-4">
            {{ $isEn ? 'Guided Experiences' : 'Rehberli Deneyimler' }}
        </p>
        <h1 class="text-5xl md:text-6xl font-serif">
            {{ $isEn ? 'Tours' : 'Turlar' }}
        </h1>
    </div>
</section>

{{-- Country Filter --}}
@if($countries->isNotEmpty())
<div class="border-b bg-white sticky top-[57px] z-40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex gap-3 overflow-x-auto">
        <a href="/{{ $locale }}/tours"
           class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium transition
                  {{ !$selectedCountry ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
            {{ $isEn ? 'All' : 'Tümü' }}
        </a>
        @foreach($countries as $country)
            <a href="/{{ $locale }}/tours?country={{ urlencode($country) }}"
               class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium transition
                      {{ $selectedCountry === $country ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                {{ $country }}
            </a>
        @endforeach
    </div>
</div>
@endif

{{-- Tours Grid --}}
<section class="max-w-7xl mx-auto px-6 py-16">

    @if($tours->isEmpty())
        <p class="text-stone-500 text-lg">
            {{ $isEn ? 'No tours found.' : 'Henüz tur yok.' }}
        </p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($tours as $tour)
                @php
                    $symbol = $currencySymbols[$tour->currency] ?? $tour->currency;
                    $locationParts = array_filter([
                        txt($tour,'region',$locale),
                        txt($tour,'country',$locale),
                    ]);
                @endphp
                <a href="/{{ $locale }}/tours/{{ $tour->slug }}"
                   class="group bg-white rounded-3xl shadow overflow-hidden hover:shadow-lg transition flex flex-col">

                    {{-- Cover Image --}}
                    @if($tour->cover_image)
                        <div class="h-52 overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/'.$tour->cover_image) }}"
                                 alt="{{ txt($tour,'title',$locale) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="h-52 bg-gradient-to-br from-amber-100 to-stone-200 flex-shrink-0 flex items-center justify-center">
                            <span class="text-stone-400 text-5xl">✈</span>
                        </div>
                    @endif

                    {{-- Content --}}
                    <div class="p-6 flex flex-col flex-1">
                        {{-- Location + Duration --}}
                        <div class="flex items-center gap-3 mb-3 flex-wrap">
                            @if($locationParts)
                                <span class="text-xs font-semibold uppercase tracking-wider text-amber-700">
                                    {{ implode(' · ', $locationParts) }}
                                </span>
                            @endif
                            @if($tour->duration_days)
                                <span class="text-xs text-stone-400">
                                    {{ $tour->duration_days }} {{ $isEn ? 'days' : 'gün' }}
                                </span>
                            @endif
                        </div>

                        {{-- Title --}}
                        <h2 class="text-xl font-bold mb-2 group-hover:text-amber-700 transition leading-snug">
                            {{ txt($tour,'title',$locale) }}
                        </h2>

                        {{-- Excerpt --}}
                        @if(txt($tour,'short_description',$locale))
                            <p class="text-stone-500 text-sm leading-relaxed line-clamp-2 flex-1">
                                {{ txt($tour,'short_description',$locale) }}
                            </p>
                        @endif

                        {{-- Footer: price + start date + CTA --}}
                        <div class="mt-5 pt-5 border-t border-stone-100 flex items-end justify-between gap-2">
                            <div>
                                @if($tour->price)
                                    <p class="text-2xl font-bold text-stone-900">
                                        {{ $symbol }}{{ number_format($tour->price, 0, ',', '.') }}
                                    </p>
                                @endif
                                @if($tour->start_date)
                                    <p class="text-xs text-stone-400 mt-0.5">
                                        {{ \Carbon\Carbon::parse($tour->start_date)->locale($locale)->isoFormat('D MMM YYYY') }}
                                    </p>
                                @endif
                            </div>
                            <span class="text-sm font-semibold text-amber-700 group-hover:underline flex-shrink-0">
                                {{ $isEn ? 'Details →' : 'İncele →' }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $tours->links() }}
        </div>
    @endif

</section>

@endsection
