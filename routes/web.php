<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
	$articles = \App\Models\Article::with('user')->latest()->limit(10)->get();
    return view('dashboard', compact('articles'));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('users', \App\Http\Controllers\UserController::class);
Route::resource('articles', \App\Http\Controllers\ArticleController::class);

Route::view('profile', 'profile')
	->middleware('can:view-profile')
	->name('profile.show');
Route::put('profile', \App\Http\Controllers\ProfileController::class)
	->middleware('can:update-profile')
	->name('profile.update');
