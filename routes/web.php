<?php

use App\Models\News;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'Storage linked!';
});

Route::get('/', function () {
    $trending = News::with('category')->orderBy('id', 'asc')->get();

    return view('welcome', compact('trending'));
});

Route::get('category/{id}', [CategoryController::class, 'categoryPage'])->name('category.page');
Route::get('post/{slug}', [NewsController::class, 'show'])->name('post.show');
