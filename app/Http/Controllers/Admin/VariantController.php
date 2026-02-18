<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use App\Models\VariantOption;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::with('options')
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Variants/Index', [
            'variants' => $variants,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Variants/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:select,color,button',
            'is_active' => 'boolean',
            'options' => 'nullable|array',
            'options.*.name' => 'required|string|max:255',
            'options.*.value' => 'nullable|string|max:255',
            'options.*.price_adjustment' => 'nullable|numeric|min:0',
        ]);

        $variant = Variant::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        if (!empty($validated['options'])) {
            foreach ($validated['options'] as $index => $option) {
                VariantOption::create([
                    'variant_id' => $variant->id,
                    'name' => $option['name'],
                    'value' => $option['value'] ?? null,
                    'price_adjustment' => $option['price_adjustment'] ?? 0,
                    'order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }

        return redirect()->route('admin.variants.index')
            ->with('success', 'Variante creada correctamente');
    }

    public function edit(Variant $variant)
    {
        $variant->load('options');

        return Inertia::render('Admin/Variants/Edit', [
            'variant' => $variant,
        ]);
    }

    public function update(Request $request, Variant $variant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:select,color,button',
            'is_active' => 'boolean',
            'options' => 'nullable|array',
            'options.*.id' => 'nullable|exists:variant_options,id',
            'options.*.name' => 'required|string|max:255',
            'options.*.value' => 'nullable|string|max:255',
            'options.*.price_adjustment' => 'nullable|numeric|min:0',
        ]);

        $variant->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Eliminar opciones existentes y recrear
        $variant->options()->delete();

        if (!empty($validated['options'])) {
            foreach ($validated['options'] as $index => $option) {
                VariantOption::create([
                    'variant_id' => $variant->id,
                    'name' => $option['name'],
                    'value' => $option['value'] ?? null,
                    'price_adjustment' => $option['price_adjustment'] ?? 0,
                    'order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }

        return redirect()->route('admin.variants.index')
            ->with('success', 'Variante actualizada correctamente');
    }

    public function destroy(Variant $variant)
    {
        $variant->delete();

        return redirect()->route('admin.variants.index')
            ->with('success', 'Variante eliminada correctamente');
    }

    // Actualizar precio de una opción específica
    public function updateOptionPrice(Request $request, VariantOption $option)
    {
        $validated = $request->validate([
            'price_adjustment' => 'required|numeric|min:0',
        ]);

        $option->update($validated);

        return back()->with('success', 'Precio actualizado correctamente');
    }
}
