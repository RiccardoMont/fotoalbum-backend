<?php

use App\Http\Controllers\Admin\BestShootController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DraftController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\SearchPhotoController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function () {


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('photos/categories/filter', [FilterController::class, 'category_filter'])->name('photos.categories.filter');

    Route::get('photos/title', [SearchPhotoController::class, 'search'])->name('photos.title');

    Route::get('drafts', [DraftController::class, 'index'])->name('drafts');

    Route::resource('leads', LeadController::class);

    Route::resource('photos', PhotoController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('best-shoots', BestShootController::class);




});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
