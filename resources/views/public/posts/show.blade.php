@extends('public.layout')
@section('title', txt($post,'seo_title',$locale) ?: txt($post,'title',$locale))
@section('description', txt($post,'seo_description',$locale) ?: txt($post,'excerpt',$locale))

@section('content')

@php
    $content     = txt($post, 'content', $locale) ?? '';
    $wordCount   = str_word_count(strip_tags($content));
    $readingTime = max(1, ceil($wordCount / 200));
@endphp

{{-- Hero --}}
<div class="relative w-full h-[55vh] min-h-[340px] overflow-hidden bg-stone-900">
    @if($post->cover_image)
        <img src="{{ asset('storage/'.$post->cover_image) }}"
             alt="{{ txt($post,'title',$locale) }}"
             class="absolute inset-0 w-full h-full object-cover opacity-60">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-900/40 to-transparent"></div>

    <div class="absolute bottom-0 left-0 right-0 max-w-4xl mx-auto px-6 pb-12">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-stone-400 mb-6">
            <a href="/{{ $locale }}" class="hover:text-white transition">
                {{ $isEn ? 'Home' : 'Anasayfa' }}
            </a>
            <span>/</span>
            <a href="/{{ $locale }}/blog" class="hover:text-white transition">Blog</a>
            <span>/</span>
            <span class="text-stone-300 truncate max-w-xs">{{ txt($post,'title',$locale) }}</span>
        </nav>

        {{-- Meta --}}
        <div class="flex flex-wrap items-center gap-4 mb-5">
            @if(txt($post,'category',$locale))
                <span class="bg-amber-500 text-white text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full">
                    {{ txt($post,'category',$locale) }}
                </span>
            @endif
            @if($post->published_at)
                <span class="text-stone-300 text-sm">
                    {{ \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMMM YYYY') }}
                </span>
            @endif
            <span class="text-stone-400 text-sm">
                {{ $readingTime }} {{ $isEn ? 'min read' : 'dk okuma' }}
            </span>
        </div>

        <h1 class="text-4xl md:text-5xl font-serif text-white leading-tight">
            {{ txt($post,'title',$locale) }}
        </h1>
    </div>
</div>

{{-- Article --}}
<article class="max-w-4xl mx-auto px-6 py-16">

    {{-- Excerpt / Lead --}}
    @if(txt($post,'excerpt',$locale))
        <p class="text-xl md:text-2xl text-stone-500 font-serif italic leading-relaxed mb-12 pb-12 border-b border-stone-200">
            {{ txt($post,'excerpt',$locale) }}
        </p>
    @endif

    {{-- Content --}}
    <div class="prose-content text-stone-800 text-lg leading-9 whitespace-pre-line">
        {{ $content }}
    </div>

    {{-- Footer Meta --}}
    <div class="mt-16 pt-8 border-t border-stone-200 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3 flex-wrap">
            @if(txt($post,'category',$locale))
                <a href="/{{ $locale }}/blog?category={{ urlencode(txt($post,'category',$locale)) }}"
                   class="text-xs font-semibold uppercase tracking-wider text-amber-700 hover:underline">
                    {{ txt($post,'category',$locale) }}
                </a>
            @endif
            @if($post->published_at)
                <span class="text-stone-400 text-sm">
                    {{ \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMMM YYYY') }}
                </span>
            @endif
        </div>
        <a href="/{{ $locale }}/blog"
           class="text-sm font-semibold text-stone-600 hover:text-stone-900 transition">
            ← {{ $isEn ? 'Back to Blog' : 'Blog\'a Dön' }}
        </a>
    </div>

</article>

{{-- Related Posts --}}
@if($relatedPosts->isNotEmpty())
<section class="bg-stone-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-serif mb-10">
            {{ $isEn ? 'More Stories' : 'Diğer Yazılar' }}
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($relatedPosts as $related)
                <a href="/{{ $locale }}/blog/{{ $related->slug }}"
                   class="group bg-white rounded-3xl shadow overflow-hidden hover:shadow-lg transition flex flex-col">

                    @if($related->cover_image)
                        <div class="h-48 overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/'.$related->cover_image) }}"
                                 alt="{{ txt($related,'title',$locale) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-amber-50 to-stone-100 flex-shrink-0 flex items-center justify-center">
                            <span class="text-stone-200 text-7xl font-serif leading-none">"</span>
                        </div>
                    @endif

                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            @if(txt($related,'category',$locale))
                                <span class="text-xs font-semibold uppercase tracking-wider text-amber-700">
                                    {{ txt($related,'category',$locale) }}
                                </span>
                            @endif
                            @if($related->published_at)
                                <span class="text-xs text-stone-400">
                                    {{ \Carbon\Carbon::parse($related->published_at)->locale($locale)->isoFormat('D MMM YYYY') }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold mb-2 group-hover:text-amber-700 transition leading-snug flex-1">
                            {{ txt($related,'title',$locale) }}
                        </h3>

                        <span class="mt-4 text-sm font-semibold text-amber-700 group-hover:underline">
                            {{ $isEn ? 'Read →' : 'Oku →' }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
