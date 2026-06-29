<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SitemapController;

Route::redirect('/', '/tr');

// TEMP DEBUG - sonra silinecek
Route::get('/debug-test', function () {
    try {
        $db = \DB::select('SELECT 1');
        $posts = \App\Models\Post::count();
        $settings = \App\Models\Setting::count();
        $widgets = \App\Models\Widget::count();
        $helper = function_exists('setting') ? 'OK' : 'MISSING';
        return response()->json([
            'db' => 'OK',
            'posts' => $posts,
            'settings' => $settings,
            'widgets' => $widgets,
            'setting_helper' => $helper,
            'setting_value' => setting('design.color_coral', 'default'),
        ]);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
    }
});


Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/{locale}', [PublicController::class, 'home'])->whereIn('locale', ['tr','en'])->name('home');
Route::get('/{locale}/blog', [PublicController::class, 'posts'])->whereIn('locale', ['tr','en'])->name('blog');
Route::get('/{locale}/blog/{slug}', [PublicController::class, 'postShow'])->whereIn('locale', ['tr','en'])->name('blog.show');
Route::get('/{locale}/places', [PublicController::class, 'places'])->whereIn('locale', ['tr','en'])->name('places');
Route::get('/{locale}/places/{slug}', [PublicController::class, 'placeShow'])->whereIn('locale', ['tr','en'])->name('places.show');
Route::get('/{locale}/tours', [PublicController::class, 'tours'])->whereIn('locale', ['tr','en'])->name('tours');
Route::get('/{locale}/tours/{slug}', [PublicController::class, 'tourShow'])->whereIn('locale', ['tr','en'])->name('tours.show');
Route::get('/{locale}/flights', [PublicController::class, 'flights'])->whereIn('locale', ['tr','en'])->name('flights');
Route::get('/{locale}/guides', [PublicController::class, 'guides'])->whereIn('locale', ['tr','en'])->name('guides');
Route::get('/{locale}/guides/{slug}', [PublicController::class, 'guideShow'])->whereIn('locale', ['tr','en'])->name('guides.show');
Route::get('/{locale}/shop', [PublicController::class, 'shop'])->whereIn('locale', ['tr','en'])->name('shop');
Route::get('/{locale}/shop/{slug}', [PublicController::class, 'productShow'])->whereIn('locale', ['tr','en'])->name('shop.show');
Route::get('/{locale}/contact', [PublicController::class, 'contact'])->whereIn('locale', ['tr','en'])->name('contact');
Route::post('/{locale}/contact', [PublicController::class, 'contactSubmit'])->whereIn('locale', ['tr','en'])->name('contact.submit')->middleware('throttle:5,1');
Route::get('/{locale}/about', [PublicController::class, 'about'])->whereIn('locale', ['tr','en'])->name('about');
