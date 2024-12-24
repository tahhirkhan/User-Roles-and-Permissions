<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PerimissionController;
use App\Http\Controllers\PermissionTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/debug-checkbox', [RolesController::class, 'debug'])->name('debug-checkbox');
    Route::get('/debug-accordian', [RolesController::class, 'debug'])->name('debug-accordian');

    // Permission Routes
    Route::get('/all-permissions', [PerimissionController::class, 'index'])->name('all-permissions');
    Route::post('/create-permission', [PerimissionController::class, 'store'])->name('create-permission');
    Route::patch('/update-permission', [PerimissionController::class, 'update'])->name('update-permission');
    Route::get('/delete-permission/{id}', [PerimissionController::class, 'destroy'])->name('delete-permission');

    // Permission Catergory Routes
    Route::get('/all-permission-categories', [PermissionTypeController::class, 'index'])->name('all-permission-categories');
    Route::post('/create-permission-category', [PermissionTypeController::class, 'store'])->name('all-permission-types');
    Route::patch('/update-permission-category', [PermissionTypeController::class, 'update'])->name('update-permission-category');
    Route::get('/delete-permission-category/{id}', [PermissionTypeController::class, 'destroy'])->name('delete-permission-category');


    // Role Routes
    Route::get('/all-roles', [RolesController::class, 'index'])->name('all-roles');
    Route::get('/create-role', [RolesController::class, 'create'])->name('create-role');
    Route::post('/create-role', [RolesController::class, 'store'])->name('create-role.post');
    Route::get('/edit-role/{id}', [RolesController::class, 'edit'])->name('edit-role');
    Route::patch('/update-role/{id}', [RolesController::class, 'update'])->name('update-role');
    Route::get('/delete-role/{id}', [RolesController::class, 'destroy'])->name('delete-role');

    // Article Routes
    Route::get('/all-articles', [ArticleController::class, 'index'])->name('all-articles');
    Route::get('/create-article', [ArticleController::class, 'create'])->name('create-article');
    Route::post('/create-article', [ArticleController::class, 'store'])->name('create-article.post');
    Route::get('/show-article/{id}', [ArticleController::class, 'show'])->name('show-article');
    Route::get('/edit-article/{id}', [ArticleController::class, 'edit'])->name('edit-article');
    Route::patch('/edit-article/{id}', [ArticleController::class, 'update'])->name('edit-article');
    Route::delete('/delete-article/{id}', [ArticleController::class, 'destroy'])->name('delete-article');

    // User Routes
    Route::get('/all-users', [UserController::class, 'index'])->name('all-users');
    Route::get('/create-user', [UserController::class, 'create'])->name('create-user');
    Route::post('/create-user', [UserController::class, 'store'])->name('create-user.post');
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('create-user');
    Route::patch('/edit-user/{id}', [UserController::class, 'update'])->name('edit-user');
    Route::get('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');

});

require __DIR__.'/auth.php';
