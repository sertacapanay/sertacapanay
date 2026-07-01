<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

  {{-- Static pages --}}
  @foreach($staticPages as $page)
  <url>
    <loc>{{ $page['loc'] }}</loc>
    <xhtml:link rel="alternate" hreflang="tr" href="{{ $page['loc'] }}"/>
    <xhtml:link rel="alternate" hreflang="en" href="{{ $page['alt_en'] }}"/>
    <xhtml:link rel="alternate" hreflang="x-default" href="{{ $page['loc'] }}"/>
    <changefreq>{{ $page['changefreq'] }}</changefreq>
    <priority>{{ $page['priority'] }}</priority>
  </url>
  @endforeach

  {{-- Blog posts --}}
  @foreach($posts as $post)
  <url>
    <loc>{{ $baseUrl }}/tr/blog/{{ $post->slug }}</loc>
    <xhtml:link rel="alternate" hreflang="tr" href="{{ $baseUrl }}/tr/blog/{{ $post->slug }}"/>
    <xhtml:link rel="alternate" hreflang="en" href="{{ $baseUrl }}/en/blog/{{ $post->slug }}"/>
    <lastmod>{{ $post->updated_at->toDateString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  @endforeach

  {{-- Products --}}
  @foreach($products as $product)
  <url>
    <loc>{{ $baseUrl }}/tr/shop/{{ $product->slug }}</loc>
    <xhtml:link rel="alternate" hreflang="tr" href="{{ $baseUrl }}/tr/shop/{{ $product->slug }}"/>
    <xhtml:link rel="alternate" hreflang="en" href="{{ $baseUrl }}/en/shop/{{ $product->slug }}"/>
    <lastmod>{{ $product->updated_at->toDateString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  @endforeach

  {{-- Places --}}
  @foreach($places as $place)
  <url>
    <loc>{{ $baseUrl }}/tr/places/{{ $place->slug }}</loc>
    <xhtml:link rel="alternate" hreflang="tr" href="{{ $baseUrl }}/tr/places/{{ $place->slug }}"/>
    <xhtml:link rel="alternate" hreflang="en" href="{{ $baseUrl }}/en/places/{{ $place->slug }}"/>
    <lastmod>{{ $place->updated_at->toDateString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  @endforeach

  {{-- Tours --}}
  @foreach($tours as $tour)
  <url>
    <loc>{{ $baseUrl }}/tr/tours/{{ $tour->slug }}</loc>
    <xhtml:link rel="alternate" hreflang="tr" href="{{ $baseUrl }}/tr/tours/{{ $tour->slug }}"/>
    <xhtml:link rel="alternate" hreflang="en" href="{{ $baseUrl }}/en/tours/{{ $tour->slug }}"/>
    <lastmod>{{ $tour->updated_at->toDateString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  @endforeach

  {{-- Cruises --}}
  @foreach($cruises as $cruise)
  <url>
    <loc>{{ $baseUrl }}/tr/cruiselog/{{ $cruise->slug }}</loc>
    <xhtml:link rel="alternate" hreflang="tr" href="{{ $baseUrl }}/tr/cruiselog/{{ $cruise->slug }}"/>
    <xhtml:link rel="alternate" hreflang="en" href="{{ $baseUrl }}/en/cruiselog/{{ $cruise->slug }}"/>
    <lastmod>{{ $cruise->updated_at->toDateString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.4</priority>
  </url>
  @endforeach

  {{-- Guides (city guides) --}}
  @foreach($guides as $guide)
  <url>
    <loc>{{ $baseUrl }}/tr/guides/{{ $guide->slug }}</loc>
    <xhtml:link rel="alternate" hreflang="tr" href="{{ $baseUrl }}/tr/guides/{{ $guide->slug }}"/>
    <xhtml:link rel="alternate" hreflang="en" href="{{ $baseUrl }}/en/guides/{{ $guide->slug }}"/>
    <lastmod>{{ $guide->updated_at->toDateString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  @endforeach

</urlset>
