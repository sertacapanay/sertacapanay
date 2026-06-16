@extends('public.layout')
@section('title', ($isEn ? 'Blog' : 'Blog').' | Sertac Apanay')

@section('content')

{{-- Page Header --}}
<section class="bg-stone-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-amber-400 uppercase tracking-widest text-xs font-semibold mb-4">
            {{ $isEn ? 'Stories & Discoveries' : 'Hikâyeler & Keşifler' }}
        </p>
        <h1 class="text-5xl md:text-6xl font-serif">Blog</h1>
    </div>
</section>

{{-- Category Filter --}}
@if($categories->isNotEmpty())
<div class="border-b bg-white sticky top-[57px] z-40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex gap-3 overflow-x-auto">
        <a href="/{{ $locale }}/blog"
           class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium transition
                  {{ !$selectedCategory ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
            {{ $isEn ? 'All' : 'Tümü' }}
        </a>
        @foreach($categories as $cat)
            <a href="/{{ $locale }}/blog?category={{ urlencode($cat) }}"
               class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium transition
                      {{ $selectedCategory === $cat ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>
</div>
@endif

{{-- Posts Grid --}}
<section class="max-w-7xl mx-auto px-6 py-16">

    @if($posts->isEmpty())
        <p class="text-stone-500 text-lg">
            {{ $isEn ? 'No posts found.' : 'Henüz yazı yok.' }}
        </p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <a href="/{{ $locale }}/blog/{{ $post->slug }}"
                   class="group bg-white rounded-3xl shadow overflow-hidden hover:shadow-lg transition flex flex-col">

                    {{-- Cover Image --}}
                    @if($post->cover_image)
                        <div class="h-52 overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/'.$post->cover_image) }}"
                                 alt="{{ txt($post,'title',$locale) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="h-52 bg-gradient-to-br from-amber-50 to-stone-100 flex-shrink-0 flex items-center justify-center">
                            <span class="text-stone-200 text-7xl font-serif leading-none">"</span>
                        </div>
                    @endif

                    {{-- Content --}}
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            @if(txt($post,'category',$locale))
                                <span class="text-xs font-semibold uppercase tracking-wider text-amber-700">
                                    {{ txt($post,'category',$locale) }}
                                </span>
                            @endif
                            @if($post->published_at)
                                <span class="text-xs text-stone-400">
                                    {{ \Carbon\Carbon::parse($post->published_at)->locale($locale)->isoFormat('D MMM YYYY') }}
                                </span>
                            @endif
                        </div>

                        <h2 class="text-xl font-bold mb-3 group-hover:text-amber-700 transition leading-snug">
                            {{ txt($post,'title',$locale) }}
                        </h2>

                        @if(txt($post,'excerpt',$locale))
                            <p class="text-stone-500 text-sm leading-relaxed line-clamp-3 flex-1">
                                {{ txt($post,'excerpt',$locale) }}
                            </p>
                        @endif

                        <span class="mt-5 text-sm font-semibold text-amber-700 group-hover:underline">
                            {{ $isEn ? 'Read more →' : 'Devamını oku →' }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    @endif

</section>

@endsection
