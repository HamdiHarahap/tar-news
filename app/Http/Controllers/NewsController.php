<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show(string $slug)
    {
        $data = News::with('category')->where('slug', $slug)->first();

        return view('post', compact('data'));
    }
}
