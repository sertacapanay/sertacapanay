<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Place;
use App\Models\Tour;
use App\Models\Flight;
use App\Models\Product;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PublicController extends Controller
{
    private function locale(string $locale): string { return in_array($locale, ['tr','en']) ? $locale : 'tr'; }
    public function home(string $locale = 'tr')
    {
        $locale = $this->locale($locale);
        return view('public.home', [
            'locale'    => $locale,
            'isEn'      => $locale === 'en',
            'heroImage' => asset('images/hero.jpg'),
            'places'    => Place::latest()->take(4)->get(),
            'notes'     => Place::latest()->skip(4)->take(2)->get(),
            'products'  => Product::where('is_active', true)->latest()->take(4)->get(),
            'posts'     => Post::published()->latest()->take(2)->get(),
        ]);
    }

    public function posts(string $locale = 'tr', Request $request)
    {
        $locale = $this->locale($locale);
        $col    = $locale === 'en' ? 'category_en' : 'category_tr';

        $categories = Post::published()
            ->whereNotNull($col)
            ->where($col, '!=', '')
            ->select($col)
            ->distinct()
            ->orderBy($col)
            ->pluck($col);

        $query = Post::published()->latest();

        if ($request->filled('category')) {
            $query->where($col, $request->category);
        }

        return view('public.posts.index', [
            'locale'           => $locale,
            'isEn'             => $locale === 'en',
            'posts'            => $query->paginate(12)->withQueryString(),
            'categories'       => $categories,
            'selectedCategory' => $request->category,
        ]);
    }
    public function postShow(string $locale, string $slug)
    {
        $locale = $this->locale($locale);
        $post   = Post::published()->where('slug', $slug)->firstOrFail();
        $col    = $locale === 'en' ? 'category_en' : 'category_tr';

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->when($post->{$col}, fn($q) => $q->where($col, $post->{$col}))
            ->latest()
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $relatedPosts = Post::published()
                ->where('id', '!=', $post->id)
                ->latest()
                ->take(3)
                ->get();
        }

        return view('public.posts.show', compact('locale', 'post', 'relatedPosts') + ['isEn' => $locale === 'en']);
    }
    public function places(string $locale = 'tr', Request $request)
    {
        $locale = $this->locale($locale);
        $col    = $locale === 'en' ? 'country_en' : 'country_tr';

        $countries = Place::active()
            ->whereNotNull($col)
            ->where($col, '!=', '')
            ->select($col)
            ->distinct()
            ->orderBy($col)
            ->pluck($col);

        $query = Place::active()->latest();

        if ($request->filled('country')) {
            $query->where($col, $request->country);
        }

        return view('public.places.index', [
            'locale'          => $locale,
            'isEn'            => $locale === 'en',
            'places'          => $query->paginate(12)->withQueryString(),
            'countries'       => $countries,
            'selectedCountry' => $request->country,
        ]);
    }
    public function placeShow(string $locale, string $slug)
    {
        $locale = $this->locale($locale);
        $place  = Place::active()->where('slug', $slug)->firstOrFail();
        $col    = $locale === 'en' ? 'country_en' : 'country_tr';

        $relatedPlaces = Place::active()
            ->where('id', '!=', $place->id)
            ->when($place->{$col}, fn($q) => $q->where($col, $place->{$col}))
            ->latest()
            ->take(3)
            ->get();

        if ($relatedPlaces->count() < 3) {
            $relatedPlaces = Place::active()
                ->where('id', '!=', $place->id)
                ->latest()
                ->take(3)
                ->get();
        }

        return view('public.places.show', compact('locale', 'place', 'relatedPlaces') + ['isEn' => $locale === 'en']);
    }
    public function tours(string $locale = 'tr', Request $request)
    {
        $locale = $this->locale($locale);
        $col    = $locale === 'en' ? 'country_en' : 'country_tr';

        $countries = Tour::active()
            ->whereNotNull($col)
            ->where($col, '!=', '')
            ->select($col)
            ->distinct()
            ->orderBy($col)
            ->pluck($col);

        $query = Tour::active()->latest();

        if ($request->filled('country')) {
            $query->where($col, $request->country);
        }

        $allTours = Tour::active()->get();

        return view('public.tours.index', [
            'locale'          => $locale,
            'isEn'            => $locale === 'en',
            'tours'           => $query->paginate(12)->withQueryString(),
            'allTours'        => $allTours,
            'countries'       => $countries,
            'selectedCountry' => $request->country,
        ]);
    }
    public function tourShow(string $locale, string $slug)
    {
        $locale = $this->locale($locale);
        $tour   = Tour::active()->where('slug', $slug)->firstOrFail();
        $col    = $locale === 'en' ? 'country_en' : 'country_tr';

        $relatedTours = Tour::active()
            ->where('id', '!=', $tour->id)
            ->when($tour->{$col}, fn($q) => $q->where($col, $tour->{$col}))
            ->latest()
            ->take(3)
            ->get();

        if ($relatedTours->count() < 3) {
            $relatedTours = Tour::active()
                ->where('id', '!=', $tour->id)
                ->latest()
                ->take(3)
                ->get();
        }

        return view('public.tours.show', compact('locale', 'tour', 'relatedTours') + ['isEn' => $locale === 'en']);
    }

    public function flights(string $locale = 'tr')
    {
        $locale = $this->locale($locale);
        $flights = Flight::latest('flight_date')->get();
        return view('public.flights.index', [
            'locale'  => $locale,
            'isEn'    => $locale === 'en',
            'flights' => $flights,
            'total'   => $flights->count(),
            'km'      => $flights->sum('distance_km'),
        ]);
    }

    public function guides(string $locale = 'tr', Request $request)
    {
        $locale = $this->locale($locale);
        $col    = $locale === 'en' ? 'country_en' : 'country_tr';
        $countries = Place::active()
            ->whereNotNull($col)->where($col, '!=', '')
            ->select($col)->distinct()->orderBy($col)->pluck($col);
        $query = Place::active()->latest();
        if ($request->filled('country')) {
            $query->where($col, $request->country);
        }
        return view('public.guides.index', [
            'locale'          => $locale,
            'isEn'            => $locale === 'en',
            'places'          => $query->paginate(12)->withQueryString(),
            'countries'       => $countries,
            'selectedCountry' => $request->country,
        ]);
    }

    public function guideShow(string $locale, string $slug)
    {
        $locale = $this->locale($locale);
        $place  = Place::active()->where('slug', $slug)->firstOrFail();
        $col    = $locale === 'en' ? 'country_en' : 'country_tr';
        $related = Place::active()
            ->where('id', '!=', $place->id)
            ->when($place->{$col}, fn($q) => $q->where($col, $place->{$col}))
            ->latest()->take(3)->get();
        if ($related->count() < 3) {
            $related = Place::active()->where('id', '!=', $place->id)->latest()->take(3)->get();
        }
        return view('public.guides.show', compact('locale', 'place', 'related') + ['isEn' => $locale === 'en']);
    }

    public function shop(string $locale = 'tr', Request $request)
    {
        $locale = $this->locale($locale);
        $col    = $locale === 'en' ? 'category_en' : 'category_tr';
        $categories = Product::where('is_active', true)
            ->whereNotNull($col)->where($col, '!=', '')
            ->select($col)->distinct()->orderBy($col)->pluck($col);
        $query = Product::where('is_active', true)->latest();
        if ($request->filled('category')) {
            $query->where($col, $request->category);
        }
        return view('public.shop.index', [
            'locale'           => $locale,
            'isEn'             => $locale === 'en',
            'products'         => $query->paginate(16)->withQueryString(),
            'categories'       => $categories,
            'selectedCategory' => $request->category,
        ]);
    }

    public function productShow(string $locale, string $slug)
    {
        $locale  = $this->locale($locale);
        $product = Product::where('is_active', true)->where('slug', $slug)->firstOrFail();
        $related = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->latest()->take(4)->get();
        return view('public.shop.show', compact('locale', 'product', 'related') + ['isEn' => $locale === 'en']);
    }

    public function contact(string $locale = 'tr')
    {
        $locale = $this->locale($locale);
        return view('public.contact', ['locale' => $locale, 'isEn' => $locale === 'en']);
    }

    public function about(string $locale = 'tr')
    {
        $locale = $this->locale($locale);
        return view('public.contact', ['locale' => $locale, 'isEn' => $locale === 'en', 'scrollToAbout' => true]);
    }

    public function contactSubmit(string $locale, Request $request)
    {
        $locale = $this->locale($locale);

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:200',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Inquiry::create([
            'name'    => strip_tags($request->name),
            'email'   => $request->email,
            'message' => strip_tags($request->message),
        ]);

        $success = $locale === 'en'
            ? 'Your message has been received. I will get back to you within 24–48 hours.'
            : 'Mesajınız alındı. 24–48 saat içinde yanıt vereceğim.';

        return back()->with('success', $success);
    }
}
