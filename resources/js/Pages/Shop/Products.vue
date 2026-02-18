<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    products: Object,
    categories: Array,
    filters: Object,
});

const search = ref(props.filters?.search || '');

const doSearch = () => {
    router.get(route('shop.products'), { search: search.value }, { preserveState: true });
};
</script>

<template>
    <Head title="Productos" />
    
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <Link :href="route('home')" class="text-2xl font-bold text-blue-600">eCommax</Link>
                    
                    <form @submit.prevent="doSearch" class="flex-1 max-w-xl mx-8">
                        <div class="relative">
                            <input v-model="search" type="text" placeholder="Buscar productos..." 
                                   class="w-full px-4 py-2 border rounded-lg pr-10" />
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                🔍
                            </button>
                        </div>
                    </form>
                    
                    <div class="flex items-center space-x-4">
                        <Link :href="route('login')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Ingresar
                        </Link>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex gap-8">
                <!-- Sidebar Categorías -->
                <aside class="w-64 flex-shrink-0">
                    <div class="bg-white rounded-xl shadow-sm p-4">
                        <h3 class="font-semibold text-gray-900 mb-4">Categorías</h3>
                        <ul class="space-y-2">
                            <li>
                                <Link :href="route('shop.products')" 
                                      :class="['block px-3 py-2 rounded-lg transition', !filters?.category ? 'bg-blue-50 text-blue-600' : 'hover:bg-gray-50']">
                                    Todas las categorías
                                </Link>
                            </li>
                            <li v-for="category in categories" :key="category.id">
                                <Link :href="route('shop.category', category.slug)" 
                                      :class="['block px-3 py-2 rounded-lg transition', filters?.category === category.slug ? 'bg-blue-50 text-blue-600' : 'hover:bg-gray-50']">
                                    {{ category.icon }} {{ category.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </aside>

                <!-- Productos -->
                <main class="flex-1">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ filters?.search ? `Resultados para "${filters.search}"` : 'Todos los productos' }}
                        </h1>
                        <span class="text-gray-500">{{ products.total }} productos</span>
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <Link v-for="product in products.data" :key="product.id" 
                              :href="route('shop.product', product.id)"
                              class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                            <div class="aspect-square bg-gray-100 relative">
                                <img v-if="product.image" :src="product.image" :alt="product.name" class="w-full h-full object-cover" />
                                <div v-else class="w-full h-full flex items-center justify-center text-gray-400 text-4xl">
                                    📦
                                </div>
                                <span v-if="product.is_new" class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">NUEVO</span>
                                <span v-if="product.sale_price" class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">OFERTA</span>
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-gray-500 mb-1">{{ product.category?.name }}</p>
                                <h3 class="font-medium text-gray-900 group-hover:text-blue-600 transition">{{ product.name }}</h3>
                                <div class="mt-2 flex items-center gap-2">
                                    <span v-if="product.sale_price" class="text-lg font-bold text-red-600">${{ product.sale_price }}</span>
                                    <span :class="['text-lg font-bold', product.sale_price ? 'line-through text-gray-400 text-sm' : 'text-gray-900']">
                                        ${{ product.price }}
                                    </span>
                                </div>
                            </div>
                        </Link>
                    </div>

                    <!-- Paginación -->
                    <div v-if="products.links.length > 3" class="mt-8 flex justify-center gap-2">
                        <Link v-for="link in products.links" :key="link.label"
                              :href="link.url || '#'"
                              :class="['px-4 py-2 rounded-lg', link.active ? 'bg-blue-500 text-white' : 'bg-white hover:bg-gray-50', !link.url && 'opacity-50 cursor-not-allowed']"
                              v-html="link.label">
                        </Link>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
