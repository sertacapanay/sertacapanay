<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GuestUser;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Google girişi başarısız oldu.');
        }

        $guestUser = GuestUser::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name'       => $googleUser->getName(),
                'email'      => $googleUser->getEmail(),
                'avatar_url' => $googleUser->getAvatar(),
            ]
        );

        session(['guest_user_id' => $guestUser->id]);

        $redirect = session()->pull('url.intended', route('testimonial.create'));

        return redirect($redirect)->with('success', 'Google ile giriş yapıldı.');
    }

    public function logout(): RedirectResponse
    {
        session()->forget('guest_user_id');

        return redirect()->back()->with('success', 'Çıkış yapıldı.');
    }
}
