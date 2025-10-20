<?php

use App\Models\Post;
use App\Models\Unit;
use App\Models\User;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/post', function () {
    $unit = Unit::all();
    return view('post', ['title' => 'Unit', 'units' => $unit]);
});

Route::get('/author/{user:username}', function (User $user) {
    return view('post', ['title' => 'Article by : ' . $user->name, 'posts' => $user->posts]);
});

Route::get('/category/{category:slug}', function (Category $category) {
    return view('post', ['title' => 'Category : ' . $category->name, 'posts' => $category->posts]);
});

Route::get('/unit/{unit:id}', function (Unit $unit) {
    return view('unit-detail', ['title' => $unit['title'], 'post' => $unit]);
});


Route::get('/', [UnitController::class, 'index'])->name('home');
// ] {
//     $unit = Unit::all();
//     return view('home', ['title' => 'Home', 'units' => $unit]);
// })->middleware(['auth', 'verified'])->name('home');


// {
//     return view('dashboard', [
//         'user' => $user,
//         'businesses' => $user->businesses,
//         'title' => 'business',
//     ]);
// });

// Route::get('/business/{business:id}', function (User $user) {
//     return view('dashboard', [
//         'user' => $user,
//         'businesses' => $user->businesses,
//     ]);
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/business', [BusinessController::class, 'store'])->name('business.store');
    Route::get('/business/{user:username}', [BusinessController::class, 'index'])
        ->name('business.index');
    Route::get('/business/{user:username}/{business}', [BusinessController::class, 'show'])
        ->name('business.show');
});

// Route::get('/business/{user:username}', [BusinessController::class, 'index'])->name('business.index');


Route::post("/upload", function () {
    return 'ok';
});

require __DIR__ . '/auth.php';
