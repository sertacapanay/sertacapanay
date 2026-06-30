@extends('public.layout')

@section('title', 'Deneyimini Paylaş')

@section('content')
<section class="section">
    <div class="container" style="max-width: 640px; margin: 0 auto; padding: 60px 20px;">

        <h1 class="section-title" style="text-align:center; margin-bottom: 8px;">Deneyimini Paylaş</h1>
        <p style="text-align:center; color: var(--text-muted); margin-bottom: 40px;">
            Birlikte çıktığımız yolculuğu anlatmak ister misin?
        </p>

        @if(session('success'))
            <div class="alert-success" style="background:#d4edda; color:#155724; border-radius:8px; padding:16px; margin-bottom:24px; text-align:center;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error" style="background:#f8d7da; color:#721c24; border-radius:8px; padding:16px; margin-bottom:24px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('testimonial.store') }}" style="background: var(--card-bg, #fff); border-radius: 12px; padding: 36px; box-shadow: 0 2px 20px rgba(0,0,0,0.08);">
            @csrf

            {{-- Hangi tur? --}}
            <div style="margin-bottom: 24px;">
                <label style="display:block; font-weight:600; margin-bottom:8px;">Hangi Tur? <span style="color:var(--text-muted); font-weight:400;">(opsiyonel)</span></label>
                <select name="tour_id" style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:15px; background:#fff;">
                    <option value="">— Genel Deneyim —</option>
                    @foreach($tours as $tour)
                        <option value="{{ $tour->id }}" {{ old('tour_id') == $tour->id ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'tr' ? $tour->title_tr : $tour->title_en }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Yorum --}}
            <div style="margin-bottom: 28px;">
                <label style="display:block; font-weight:600; margin-bottom:8px;">Yorumun</label>
                <textarea
                    name="body"
                    rows="6"
                    placeholder="Bu yolculukta ne hissettin? Ne öğrendin? Başkalarına ne söylerdin?"
                    style="width:100%; padding:12px 14px; border:1px solid #ddd; border-radius:8px; font-size:15px; resize:vertical; box-sizing:border-box;"
                >{{ old('body') }}</textarea>
                <small style="color:var(--text-muted);">En az 20, en fazla 1000 karakter</small>
            </div>

            {{-- Giriş yapan kullanıcı bilgisi --}}
            @php $guestId = session('guest_user_id'); $guest = $guestId ? \App\Models\GuestUser::find($guestId) : null; @endphp
            @if($guest)
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding:12px; background:#f8f9fa; border-radius:8px;">
                @if($guest->avatar_url)
                    <img src="{{ $guest->avatar_url }}" alt="{{ $guest->name }}" style="width:36px; height:36px; border-radius:50%; object-fit:cover;">
                @endif
                <div>
                    <div style="font-weight:600; font-size:14px;">{{ $guest->name }}</div>
                    <div style="font-size:12px; color:var(--text-muted);">{{ $guest->email }}</div>
                </div>
                <a href="{{ route('auth.google.logout') }}" style="margin-left:auto; font-size:12px; color:var(--text-muted);">Çıkış</a>
            </div>
            @endif

            <button type="submit" class="btn btn-primary" style="width:100%; padding:14px; font-size:16px; font-weight:600;">
                Gönder
            </button>
        </form>
    </div>
</section>
@endsection
