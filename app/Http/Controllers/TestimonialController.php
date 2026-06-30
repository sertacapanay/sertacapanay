<?php

namespace App\Http\Controllers;

use App\Models\GuestUser;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (! session('guest_user_id')) {
            session(['url.intended' => route('testimonial.create')]);
            return redirect()->route('auth.google');
        }

        $tours = Tour::where('is_active', true)->get(['id', 'title_tr', 'title_en']);

        return view('public.testimonial.create', compact('tours'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (! session('guest_user_id')) {
            return redirect()->route('auth.google');
        }

        $validated = $request->validate([
            'body'    => 'required|string|min:20|max:1000',
            'tour_id' => 'nullable|exists:tours,id',
        ]);

        Testimonial::create([
            'guest_user_id' => session('guest_user_id'),
            'tour_id'       => $validated['tour_id'] ?? null,
            'body'          => $validated['body'],
            'is_approved'   => false,
        ]);

        return redirect()->back()->with('success', 'Teşekkürler! Yorumunuz incelendikten sonra yayınlanacak.');
    }
}
