<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Models\News;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $trending = News::with('category')->orderBy('id', 'asc')->get();

    return view('welcome', compact('trending'));
});

Route::get('category/{id}', [CategoryController::class, 'categoryPage'])->name('category.page');
Route::get('post/{slug}', [NewsController::class, 'show'])->name('post.show');
