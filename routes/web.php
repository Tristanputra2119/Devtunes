<?php
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

//route fallback to home
Route::fallback(function () {
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\PagesController::class, 'index']);
Route::get('/playlist/', [App\Http\Controllers\PagesController::class, 'playlist']);
Route::get('/playlist/{id}/', [App\Http\Controllers\PagesController::class, 'detail']);
Route::get('/music/{track}', [App\Http\Controllers\PagesController::class, 'show']);
Route::post('/music/{id}/update-views', [App\Http\Controllers\PagesController::class, 'updateViews']);

//user route

//auth check
Auth::routes();

//admin route
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //definisikan route-admin here

    //dashboard
    Route::get('/dashboard', [App\Http\Controllers\PagesController::class, 'admin'])->name('dashboard.index');

    //playlist
    Route::prefix('playlist')->group(function () {
        Route::get('/', [PlaylistController::class, 'index'])->name('playlist.index');
        Route::post('/store', [PlaylistController::class, 'store'])->name('playlist.store');
        Route::get('/{id}', [PlaylistController::class, 'getPlaylist'])->name('playlist.getPlaylist');
        Route::post('/status', [PlaylistController::class, 'status'])->name('playlist.status');
        Route::put('/update/{id}', [PlaylistController::class, 'update'])->name('playlist.update');
        Route::delete('/delete/{id}', [PlaylistController::class, 'destroy'])->name('playlist.destroy');
    });

    //Music
    Route::prefix('music')->group(function () {
        Route::get('/list_music/{id}', [MusicController::class, 'listMusic'])->name('music.playlist_music');
        Route::get('/', [MusicController::class, 'index'])->name('music.index');
        Route::post('/store', [MusicController::class, 'store'])->name('music.store');
        Route::get('/{id}', [MusicController::class, 'getmusic'])->name('music.getmusic');
        Route::put('/update/{id}', [MusicController::class, 'update'])->name('music.update');
        Route::delete('/music/{id}', [MusicController::class, 'destroy'])->name('music.destroy');
    });

    //profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
    });
    //setting
    Route::prefix('setting')->group(function () {
        Route::get('/{id}', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/update/{id}', [SettingController::class, 'update'])->name('setting.update');
    });
});
