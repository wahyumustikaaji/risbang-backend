<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('statements')->orderBy('order_number')->get();

        return view('problem-statement.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|integer|unique:categories,order_number',
            'name'         => 'required|string|max:255',
            'image'        => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ], [
            'order_number.required' => 'Nomor urutan wajib diisi.',
            'order_number.integer'  => 'Nomor urutan harus berupa angka.',
            'order_number.unique'   => 'Nomor urutan sudah digunakan.',
            'name.required'         => 'Nama kategori wajib diisi.',
            'name.max'              => 'Nama kategori maksimal 255 karakter.',
            'image.required'        => 'Logo wajib diupload.',
            'image.image'           => 'File harus berupa gambar.',
            'image.mimes'           => 'Format gambar harus: png, jpg, jpeg, atau webp.',
            'image.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Upload image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('problem-statement.category.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'order_number' => 'required|integer|unique:categories,order_number,' . $category->id,
            'name'         => 'required|string|max:255',
            'image'        => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ], [
            'order_number.required' => 'Nomor urutan wajib diisi.',
            'order_number.integer'  => 'Nomor urutan harus berupa angka.',
            'order_number.unique'   => 'Nomor urutan sudah digunakan.',
            'name.required'         => 'Nama kategori wajib diisi.',
            'name.max'              => 'Nama kategori maksimal 255 karakter.',
            'image.required'        => 'Logo wajib diupload.',
            'image.image'           => 'File harus berupa gambar.',
            'image.mimes'           => 'Format gambar harus: png, jpg, jpeg, atau webp.',
            'image.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('image')) {
            // Hapus image lama
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('problem-statement.category.index')
            ->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
