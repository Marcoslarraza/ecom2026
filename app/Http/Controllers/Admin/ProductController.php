<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variant;
use App\Models\VariantOption;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $variants = Variant::with('options')->where('is_active', true)->get();

        return Inertia::render('Admin/Products/Create', [
            'categories' => $categories,
            'variants' => $variants,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
            'variant_options' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $product = Product::create($validated);

        if (!empty($validated['variant_options'])) {
            foreach ($validated['variant_options'] as $optionId) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'variant_option_id' => $optionId,
                    'stock' => 0,
                    'is_active' => true,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado correctamente');
    }

    public function edit(Product $product)
    {
        $product->load('variantOptions');
        $categories = Category::where('is_active', true)->get();
        $variants = Variant::with('options')->where('is_active', true)->get();

        return Inertia::render('Admin/Products/Edit', [
            'product' => $product,
            'categories' => $categories,
            'variants' => $variants,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
            'variant_options' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $product->update($validated);

        // Actualizar variantes
        if (isset($validated['variant_options'])) {
            $product->productVariants()->delete();
            foreach ($validated['variant_options'] as $optionId) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'variant_option_id' => $optionId,
                    'stock' => 0,
                    'is_active' => true,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
