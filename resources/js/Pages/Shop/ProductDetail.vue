<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    product: Object,
    relatedProducts: Array,
});

const selectedOptions = ref({});
const quantity = ref(1);

// Agrupar opciones por variante
const variantGroups = computed(() => {
    const groups = {};
    if (props.product.variant_options && Array.isArray(props.product.variant_options)) {
        props.product.variant_options.forEach(option => {
            if (option && option.variant) {
                if (!groups[option.variant.id]) {
                    groups[option.variant.id] = {
                        variant: option.variant,
                        options: []
                    };
                }
                groups[option.variant.id].options.push(option);
            }
        });
    }
    return Object.values(groups);
});

const totalPrice = computed(() => {
    let price = props.product.sale_price || props.product.price;
    Object.values(selectedOptions.value).forEach(option => {
        price += parseFloat(option.price_adjustment || 0);
    });
    return price.toFixed(2);
});

const selectOption = (variantId, option) => {
    selectedOptions.value[variantId] = option;
};
</script>

<template>
    <Head :title="product.name" />
    
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <Link :href="route('home')" class="text-2xl font-bold text-blue-600">eCommax</Link>
                    
                    <nav class="flex items-center space-x-6">
                        <Link :href="route('shop.products')" class="text-gray-600 hover:text-gray-900">Productos</Link>
                        <Link :href="route('login')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Ingresar
                        </Link>
                    </nav>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 py-8">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-6">
                <ol class="flex items-center space-x-2">
                    <li><Link :href="route('home')" class="text-gray-500 hover:text-gray-700">Inicio</Link></li>
                    <li class="text-gray-400">/</li>
                    <li><Link :href="route('shop.products')" class="text-gray-500 hover:text-gray-700">Productos</Link></li>
                    <li class="text-gray-400">/</li>
                    <li v-if="product.category">
                        <Link :href="route('shop.category', product.category.slug)" class="text-gray-500 hover:text-gray-700">
                            {{ product.category.name }}
                        </Link>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li class="text-gray-900 font-medium">{{ product.name }}</li>
                </ol>
            </nav>

            <!-- Producto -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="grid grid-cols-2 gap-8 p-8">
                    <!-- Imagen -->
                    <div class="aspect-square bg-gray-100 rounded-lg relative">
                        <img v-if="product.image" :src="product.image" :alt="product.name" class="w-full h-full object-cover rounded-lg" />
                        <div v-else class="w-full h-full flex items-center justify-center text-gray-400 text-6xl">
                            📦
                        </div>
                        <span v-if="product.is_new" class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-lg">NUEVO</span>
                        <span v-if="product.sale_price" class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-lg">OFERTA</span>
                    </div>

                    <!-- Info -->
                    <div>
                        <p class="text-sm text-blue-600 mb-2">{{ product.category?.name }}</p>
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ product.name }}</h1>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <span v-if="product.sale_price" class="text-3xl font-bold text-red-600">${{ totalPrice }}</span>
                            <span v-else class="text-3xl font-bold text-gray-900">${{ totalPrice }}</span>
                            <span v-if="product.sale_price" class="text-xl line-through text-gray-400">${{ product.price }}</span>
                        </div>

                        <p class="text-gray-600 mb-6">{{ product.description || product.short_description }}</p>

                        <!-- Variantes -->
                        <div v-for="group in variantGroups" :key="group.variant.id" class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ group.variant.name }}
                                <span v-if="selectedOptions[group.variant.id]" class="text-blue-600">
                                    : {{ selectedOptions[group.variant.id].name }}
                                    <span v-if="selectedOptions[group.variant.id].price_adjustment > 0" class="text-green-600">
                                        (+${{ selectedOptions[group.variant.id].price_adjustment }})
                                    </span>
                                </span>
                            </label>
                            <div class="flex flex-wrap gap-2">
                                <button v-for="option in group.options" :key="option.id"
                                        @click="selectOption(group.variant.id, option)"
                                        :class="[
                                            'px-4 py-2 border rounded-lg transition',
                                            selectedOptions[group.variant.id]?.id === option.id 
                                                ? 'border-blue-500 bg-blue-50 text-blue-700' 
                                                : 'border-gray-300 hover:border-gray-400'
                                        ]">
                                    <span v-if="group.variant.type === 'color'" 
                                          class="inline-block w-4 h-4 rounded-full mr-2 border"
                                          :style="{ backgroundColor: option.value }">
                                    </span>
                                    {{ option.name }}
                                    <span v-if="option.price_adjustment > 0" class="text-green-600 text-sm">+${{ option.price_adjustment }}</span>
                                </button>
                            </div>
                        </div>

                        <!-- Cantidad y Comprar -->
                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex items-center border rounded-lg">
                                <button @click="quantity > 1 && quantity--" class="px-4 py-2 text-gray-600 hover:bg-gray-100">-</button>
                                <span class="px-4 py-2 font-medium">{{ quantity }}</span>
                                <button @click="quantity++" class="px-4 py-2 text-gray-600 hover:bg-gray-100">+</button>
                            </div>
                            <span class="text-sm text-gray-500">{{ product.stock }} disponibles</span>
                        </div>

                        <div class="flex gap-4">
                            <button class="flex-1 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 font-medium">
                                Agregar al Carrito
                            </button>
                            <button class="bg-gray-100 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-200">
                                ❤️
                            </button>
                        </div>

                        <div class="mt-6 text-sm text-gray-500">
                            <p v-if="product.sku">SKU: {{ product.sku }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Productos Relacionados -->
            <div v-if="relatedProducts.length" class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Productos Relacionados</h2>
                <div class="grid grid-cols-4 gap-6">
                    <Link v-for="related in relatedProducts" :key="related.id" 
                          :href="route('shop.product', related.id)"
                          class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                        <div class="aspect-square bg-gray-100">
                            <img v-if="related.image" :src="related.image" :alt="related.name" class="w-full h-full object-cover" />
                            <div v-else class="w-full h-full flex items-center justify-center text-gray-400 text-4xl">📦</div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-medium text-gray-900 group-hover:text-blue-600 transition">{{ related.name }}</h3>
                            <p class="text-lg font-bold text-gray-900 mt-1">${{ related.sale_price || related.price }}</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
