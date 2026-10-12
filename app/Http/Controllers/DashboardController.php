<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function userDashboard(): View
    {
        $stats = [
            'titles' => Book::query()->count(),
            'stock' => Book::query()->sum('stock'),
            'categories' => Category::query()->count(),
        ];

        $books = Book::query()
            ->with('category:id,name')
            ->latest()
            ->paginate(12);

        return view('user.dashboard', compact('stats', 'books'));
    }

    public function adminDashboard(): View
    {
        return view('admin.dashboard', [
            'categories' => Category::query()->withCount('books')->orderBy('name')->get(),
            'books' => Book::query()->with('category:id,name')->latest()->paginate(10),
        ]);
    }
}
