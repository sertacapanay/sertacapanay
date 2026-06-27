<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SitemapController;

Route::redirect('/', '/tr');

// TEMPORARY DEBUG — kaldırılacak
Route::get('/debug-err', function() {
    try {
        $view = view('public.home', [
            'locale'    => 'tr',
            'isEn'      => false,
            'heroImage' => asset('images/hero.jpg'),
            'places'    => \App\Models\Place::latest()->take(4)->get(),
            'notes'     => \App\Models\Place::latest()->skip(4)->take(2)->get(),
            'products'  => \App\Models\Product::where('is_active', true)->latest()->take(4)->get(),
            'posts'     => \App\Models\Post::published()->latest()->take(2)->get(),
        ]);
        return $view->render();
    } catch (\Throwable $e) {
        // Try to read compiled file around error line
        $compiledFile = $e->getFile();
        $errorLine = $e->getLine();
        $compiledSnippet = [];
        if (file_exists($compiledFile)) {
            $lines = file($compiledFile);
            $start = max(0, $errorLine - 15);
            $end   = min(count($lines), $errorLine + 5);
            for ($i = $start; $i < $end; $i++) {
                $compiledSnippet[$i + 1] = rtrim($lines[$i]);
            }
        }
        return response()->json([
            'error'    => $e->getMessage(),
            'file'     => str_replace(base_path(), '', $e->getFile()),
            'line'     => $errorLine,
            'compiled' => $compiledSnippet,
        ]);
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
