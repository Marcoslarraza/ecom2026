<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variant;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalProducts' => Product::count(),
            'activeProducts' => Product::where('is_active', true)->count(),
            'totalCategories' => Category::count(),
            'totalVariants' => Variant::count(),
            'totalUsers' => User::count(),
            'lowStock' => Product::where('stock', '<', 10)->count(),
        ];

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentProducts' => $recentProducts,
        ]);
    }
}
