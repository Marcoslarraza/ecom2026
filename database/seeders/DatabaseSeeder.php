<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'markkusito@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        // Crear Categorías
        $categories = [
            ['name' => 'Tablets', 'slug' => 'tablets', 'icon' => '📱', 'order' => 1],
            ['name' => 'Smartphones', 'slug' => 'smartphones', 'icon' => '📲', 'order' => 2],
            ['name' => 'Game Consoles', 'slug' => 'game-consoles', 'icon' => '🎮', 'order' => 3],
            ['name' => 'Cameras', 'slug' => 'cameras', 'icon' => '📷', 'order' => 4],
            ['name' => 'Smartwatches', 'slug' => 'smartwatches', 'icon' => '⌚', 'order' => 5],
            ['name' => 'Drones', 'slug' => 'drones', 'icon' => '🚁', 'order' => 6],
            ['name' => 'Audio', 'slug' => 'audio', 'icon' => '🎧', 'order' => 7],
            ['name' => 'Computers', 'slug' => 'computers', 'icon' => '💻', 'order' => 8],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Crear Variantes
        $colorVariant = Variant::create(['name' => 'Color', 'type' => 'color']);
        $storageVariant = Variant::create(['name' => 'Almacenamiento', 'type' => 'select']);
        $sizeVariant = Variant::create(['name' => 'Tamaño', 'type' => 'button']);

        // Crear Opciones de Color
        $colors = [
            ['name' => 'Negro', 'value' => '#000000', 'price_adjustment' => 0, 'order' => 1],
            ['name' => 'Blanco', 'value' => '#FFFFFF', 'price_adjustment' => 0, 'order' => 2],
            ['name' => 'Azul', 'value' => '#0066CC', 'price_adjustment' => 10, 'order' => 3],
            ['name' => 'Rojo', 'value' => '#CC0000', 'price_adjustment' => 10, 'order' => 4],
            ['name' => 'Dorado', 'value' => '#FFD700', 'price_adjustment' => 50, 'order' => 5],
        ];

        foreach ($colors as $color) {
            VariantOption::create(array_merge($color, ['variant_id' => $colorVariant->id]));
        }

        // Crear Opciones de Almacenamiento
        $storages = [
            ['name' => '64GB', 'value' => '64', 'price_adjustment' => 0, 'order' => 1],
            ['name' => '128GB', 'value' => '128', 'price_adjustment' => 50, 'order' => 2],
            ['name' => '256GB', 'value' => '256', 'price_adjustment' => 100, 'order' => 3],
            ['name' => '512GB', 'value' => '512', 'price_adjustment' => 200, 'order' => 4],
            ['name' => '1TB', 'value' => '1024', 'price_adjustment' => 400, 'order' => 5],
        ];

        foreach ($storages as $storage) {
            VariantOption::create(array_merge($storage, ['variant_id' => $storageVariant->id]));
        }

        // Crear Opciones de Tamaño
        $sizes = [
            ['name' => 'S', 'value' => 'small', 'price_adjustment' => 0, 'order' => 1],
            ['name' => 'M', 'value' => 'medium', 'price_adjustment' => 0, 'order' => 2],
            ['name' => 'L', 'value' => 'large', 'price_adjustment' => 20, 'order' => 3],
            ['name' => 'XL', 'value' => 'xlarge', 'price_adjustment' => 40, 'order' => 4],
        ];

        foreach ($sizes as $size) {
            VariantOption::create(array_merge($size, ['variant_id' => $sizeVariant->id]));
        }

        // Crear Productos de ejemplo
        $products = [
            [
                'category_id' => 3,
                'name' => 'PlayStation 5 Controller',
                'slug' => 'playstation-5-controller',
                'description' => 'DualSense wireless controller for PS5. Experience haptic feedback and adaptive triggers.',
                'short_description' => 'Controller type: Wireless controller',
                'price' => 69.99,
                'sale_price' => null,
                'sku' => 'PS5-CTRL-001',
                'stock' => 150,
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => 7,
                'name' => 'BambooBuds Pro',
                'slug' => 'bamboobuds-pro',
                'description' => 'Premium wireless earbuds with active noise cancellation and spatial audio.',
                'short_description' => 'NEW ARRIVALS - Premium Audio',
                'price' => 249.99,
                'sale_price' => 199.99,
                'sku' => 'BBP-001',
                'stock' => 80,
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => 7,
                'name' => 'HomePod Pro',
                'slug' => 'homepod-pro',
                'description' => 'Smart speaker with incredible sound quality and voice assistant.',
                'short_description' => 'NEW ARRIVALS - Shop Now',
                'price' => 299.99,
                'sale_price' => null,
                'sku' => 'HPP-001',
                'stock' => 60,
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => 8,
                'name' => 'MacBook Pro 16',
                'slug' => 'macbook-pro-16',
                'description' => '2K Fullview Touch Display. Powerful performance for professionals.',
                'short_description' => '2K Fullview Touch Display',
                'price' => 2499.99,
                'sale_price' => 2299.99,
                'sku' => 'MBP-16-001',
                'stock' => 25,
                'is_featured' => true,
                'is_new' => false,
            ],
            [
                'category_id' => 7,
                'name' => 'Smart Speaker',
                'slug' => 'smart-speaker',
                'description' => 'Dual-Speaker True sound with voice control.',
                'short_description' => 'Dual-Speaker True sound',
                'price' => 199.99,
                'sale_price' => 149.99,
                'sku' => 'SS-001',
                'stock' => 100,
                'is_featured' => true,
                'is_new' => false,
            ],
            [
                'category_id' => 7,
                'name' => 'Bamboo Speaker',
                'slug' => 'bamboo-speaker',
                'description' => 'Sound that Speaks for itself. Premium bamboo finish.',
                'short_description' => 'Sound that Speaks for itself',
                'price' => 349.99,
                'sale_price' => null,
                'sku' => 'BS-001',
                'stock' => 45,
                'is_featured' => true,
                'is_new' => false,
            ],
            [
                'category_id' => 2,
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'description' => 'The most powerful iPhone ever with A17 Pro chip.',
                'short_description' => 'A17 Pro chip',
                'price' => 1199.99,
                'sale_price' => null,
                'sku' => 'IP15P-001',
                'stock' => 200,
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Samsung Galaxy S24',
                'slug' => 'samsung-galaxy-s24',
                'description' => 'Galaxy AI is here. Experience the future of mobile.',
                'short_description' => 'Galaxy AI',
                'price' => 999.99,
                'sale_price' => 899.99,
                'sku' => 'SGS24-001',
                'stock' => 180,
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Apple Watch Ultra',
                'slug' => 'apple-watch-ultra',
                'description' => 'Adventure awaits. The most rugged Apple Watch.',
                'short_description' => 'Adventure awaits',
                'price' => 799.99,
                'sale_price' => null,
                'sku' => 'AWU-001',
                'stock' => 75,
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'iPad Pro 12.9',
                'slug' => 'ipad-pro-12-9',
                'description' => 'Your next computer is not a computer. M2 chip.',
                'short_description' => 'M2 chip',
                'price' => 1099.99,
                'sale_price' => 999.99,
                'sku' => 'IPADP-001',
                'stock' => 90,
                'is_featured' => true,
                'is_new' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
