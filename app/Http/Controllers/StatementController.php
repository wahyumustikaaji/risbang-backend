<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class StatementController extends Controller
{
    public function index(Category $category)
    {
        $statements = $category->statements()->orderBy('order_number', 'asc')->get();

        return view('problem-statement.statement', compact('category', 'statements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        $validated = $request->validate([
            'order_number' => 'required|numeric|min:0.1',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
        ], [
            'order_number.required' => 'Nomor statement wajib diisi.',
            'order_number.numeric'  => 'Nomor statement harus berupa angka.',
            'order_number.min'      => 'Nomor statement minimal 0.1.',
            'title.required'        => 'Judul wajib diisi.',
            'title.max'             => 'Judul maksimal 255 karakter.',
        ]);

        // Generate full_number: category.order_number + user input
        $fullNumber = $category->order_number . '.' . $validated['order_number'];

        // Check if full_number already exists in this category
        $exists = $category->statements()->where('full_number', $fullNumber)->exists();
        if ($exists) {
            return back()->withErrors([
                'order_number' => 'Nomor statement ' . $fullNumber . ' sudah digunakan dalam kategori ini.'
            ])->withInput();
        }

        $category->statements()->create([
            'order_number' => $validated['order_number'],
            'full_number'  => $fullNumber,
            'title'        => $validated['title'],
            'description'  => $validated['description'] ?? null,
        ]);

        return redirect()->route('problem-statement.category.statements.index', $category->slug)
            ->with('success', 'Statement berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $statement)
    {
        $statement = \App\Models\Statement::findOrFail($statement);
        
        $validated = $request->validate([
            'order_number' => 'required|numeric|min:0.1',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
        ], [
            'order_number.required' => 'Nomor statement wajib diisi.',
            'order_number.numeric'  => 'Nomor statement harus berupa angka.',
            'order_number.min'      => 'Nomor statement minimal 0.1.',
            'title.required'        => 'Judul wajib diisi.',
            'title.max'             => 'Judul maksimal 255 karakter.',
        ]);

        // Regenerate full_number with category order_number
        $fullNumber = $statement->category->order_number . '.' . $validated['order_number'];

        // Check if full_number already exists in this category (excluding current statement)
        $exists = $statement->category->statements()
            ->where('full_number', $fullNumber)
            ->where('id', '!=', $statement->id)
            ->exists();
            
        if ($exists) {
            return back()->withErrors([
                'order_number' => 'Nomor statement ' . $fullNumber . ' sudah digunakan dalam kategori ini.'
            ])->withInput();
        }

        $statement->update([
            'order_number' => $validated['order_number'],
            'full_number'  => $fullNumber,
            'title'        => $validated['title'],
            'description'  => $validated['description'] ?? null,
        ]);

        return redirect()->route('problem-statement.category.statements.index', $statement->category->slug)
            ->with('success', 'Statement berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($statement)
    {
        $statement = \App\Models\Statement::findOrFail($statement);
        $categorySlug = $statement->category->slug;
        
        $statement->delete();

        return redirect()->route('problem-statement.category.statements.index', $categorySlug)
            ->with('success', 'Statement berhasil dihapus.');
    }
}
