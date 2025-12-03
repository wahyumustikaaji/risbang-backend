<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProblemStatementApiController extends Controller
{
    public function index()
    {
        $categories = Category::with('statements')
            ->orderBy('order_number')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories,
        ], 200);
    }
}
