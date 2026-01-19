<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('statements')->orderBy('order_number')->get();

        return view('recommendation.category', compact('categories'));
    }

    public function show(Category $category)
    {
        // Nanti akan diisi dengan logic untuk menampilkan rekomendasi berdasarkan kategori
        return view('recommendation.show', compact('category'));
    }
}
