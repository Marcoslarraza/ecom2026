<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function products(Request $request)
    {
        $query = Product::with('category')
            ->where('is_active', true);

        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        if ($request->featured) {
            $query->where('is_featured', true);
        }

        if ($request->new) {
            $query->where('is_new', true);
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::where('is_active', true)->orderBy('order')->get();

        return Inertia::render('Shop/Products', [
            'products' => $products,
            'categories' => $categories,
            'filters' => $request->only(['category', 'search', 'featured', 'new']),
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'variantOptions.variant']);
        
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return Inertia::render('Shop/ProductDetail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function category(Category $category)
    {
        $products = Product::with('category')
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        $categories = Category::where('is_active', true)->orderBy('order')->get();

        return Inertia::render('Shop/Category', [
            'category' => $category,
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
