@props(['tourId' => null, 'limit' => 6])

@php
    $query = \App\Models\Testimonial::approved()
        ->with('guestUser', 'tour')
        ->latest();

    if ($tourId) {
        $query->where('tour_id', $tourId);
    }

    $testimonials = $query->take($limit)->get();
@endphp

@if($testimonials->isNotEmpty())
<section class="testimonials-section section">
    <div class="container">
        <h2 class="section-title">{{ __('Katılımcılar Ne Dedi?') }}</h2>

        <div class="testimonials-grid">
            @foreach($testimonials as $t)
            <div class="testimonial-card">
                <div class="testimonial-body">
                    <svg class="quote-icon" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                        <path d="M11.192 15.757c0-.88-.23-1.618-.69-2.217-.326-.412-.768-.683-1.327-.812-.55-.128-1.07-.137-1.54-.028-.16-.95.1-1.956.76-3.022.66-1.065 1.515-1.867 2.558-2.403L9.373 5c-.8.396-1.56.898-2.26 1.505-.71.607-1.34 1.305-1.9 2.094s-.98 1.68-1.25 2.69-.346 2.04-.217 3.1c.168 1.4.62 2.52 1.356 3.35.735.84 1.652 1.26 2.748 1.26.965 0 1.766-.29 2.4-.878.628-.576.94-1.365.94-2.368l.002-.003zm9.124 0c0-.88-.23-1.618-.69-2.217-.326-.42-.77-.692-1.327-.817-.56-.124-1.074-.13-1.54-.022-.16-.94.09-1.95.75-3.02.66-1.06 1.514-1.86 2.557-2.4L18.49 5c-.8.396-1.555.898-2.26 1.505-.708.607-1.34 1.305-1.894 2.094-.556.79-.97 1.68-1.24 2.69-.273 1-.345 2.04-.217 3.1.168 1.4.62 2.52 1.356 3.35.735.84 1.652 1.26 2.748 1.26.965 0 1.766-.29 2.4-.878.628-.576.94-1.365.94-2.368l.002-.003z"/>
                    </svg>
                    <p class="testimonial-text">{{ $t->body }}</p>
                </div>
                <div class="testimonial-author">
                    @if($t->guestUser->avatar_url)
                        <img src="{{ $t->guestUser->avatar_url }}" alt="{{ $t->guestUser->name }}" class="testimonial-avatar">
                    @else
                        <div class="testimonial-avatar testimonial-avatar-placeholder">
                            {{ strtoupper(substr($t->guestUser->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="testimonial-author-info">
                        <strong>{{ $t->guestUser->name }}</strong>
                        @if($t->tour)
                            <span class="testimonial-tour">
                                {{ app()->getLocale() === 'tr' ? $t->tour->title_tr : $t->tour->title_en }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Yorum bırak butonu --}}
        <div style="text-align:center; margin-top: 40px;">
            <a href="{{ route('testimonial.create') }}" class="btn btn-outline">
                ✍️ Deneyimini Paylaş
            </a>
        </div>
    </div>
</section>

<style>
.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    margin-top: 40px;
}

.testimonial-card {
    background: var(--card-bg, #fff);
    border-radius: 12px;
    padding: 28px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.07);
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.quote-icon {
    color: var(--accent, #c8a96e);
    opacity: 0.6;
    margin-bottom: 8px;
}

.testimonial-text {
    font-size: 15px;
    line-height: 1.7;
    color: var(--text, #333);
    margin: 0;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 12px;
    border-top: 1px solid rgba(0,0,0,0.07);
    padding-top: 16px;
}

.testimonial-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
}

.testimonial-avatar-placeholder {
    background: var(--accent, #c8a96e);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 18px;
}

.testimonial-author-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.testimonial-author-info strong {
    font-size: 14px;
    color: var(--text);
}

.testimonial-tour {
    font-size: 12px;
    color: var(--text-muted, #888);
}
</style>
@endif
