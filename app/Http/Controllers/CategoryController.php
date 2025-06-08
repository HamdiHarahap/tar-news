<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryPage(string $id)
    {
        $data = News::with('category')->where('category_id', $id)->get();
        $categoryName = $data->first()?->category->name ?? 'Kategori';

        return view('category', compact('data', 'categoryName'));
    }
}
