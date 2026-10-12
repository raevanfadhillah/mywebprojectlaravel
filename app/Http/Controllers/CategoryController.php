<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        Category::create($request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]));

        return redirect()->route('admin.dashboard')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category),
            ],
        ]));

        return redirect()->route('admin.dashboard')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->books()->exists()) {
            return redirect()->route('admin.dashboard')
                ->withErrors(['category' => 'Kategori masih digunakan buku. Pindahkan atau hapus buku terkait terlebih dahulu.']);
        }

        $category->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Kategori berhasil dihapus.');
    }
}
