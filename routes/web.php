<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
Route::redirect('/', '/tr');
Route::get('/{locale}', [PublicController::class, 'home'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/blog', [PublicController::class, 'posts'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/blog/{slug}', [PublicController::class, 'postShow'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/places', [PublicController::class, 'places'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/places/{slug}', [PublicController::class, 'placeShow'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/tours', [PublicController::class, 'tours'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/tours/{slug}', [PublicController::class, 'tourShow'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/flights', [PublicController::class, 'flights'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/guides', [PublicController::class, 'guides'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/guides/{slug}', [PublicController::class, 'guideShow'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/shop', [PublicController::class, 'shop'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/shop/{slug}', [PublicController::class, 'productShow'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/contact', [PublicController::class, 'contact'])->whereIn('locale', ['tr','en']);
Route::get('/{locale}/about', [PublicController::class, 'about'])->whereIn('locale', ['tr','en']);
