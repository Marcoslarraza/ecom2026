<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    categories: Array,
    featuredProducts: Array,
    newProducts: Array,
});

const currentSlide = ref(0);
</script>

<template>
    <Head title="eCommax - Electronics Store" />
    
    <div class="min-h-screen bg-white">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4">
                <!-- Top Bar -->
                <div class="flex items-center justify-between py-4">
                    <!-- Logo -->
                    <Link href="/" class="flex items-center">
                        <span class="text-2xl font-bold text-blue-500">e</span>
                        <span class="text-2xl font-bold text-gray-800">Commax</span>
                    </Link>
                    
                    <!-- Shop Now Button -->
                    <button class="bg-blue-500 text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-blue-600 transition">
                        SHOP NOW
                    </button>
                    
                    <!-- Search Bar -->
                    <div class="flex-1 max-w-xl mx-8">
                        <div class="relative">
                            <input 
                                type="text" 
                                placeholder="ENTER YOUR KEYWORD..."
                                class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-full text-sm focus:outline-none focus:border-blue-500"
                            />
                            <button class="absolute right-3 top-1/2 -translate-y-1/2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Right Icons -->
                    <div class="flex items-center space-x-4">
                        <button class="p-2 hover:bg-gray-100 rounded-full">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                        <Link :href="route('login')" class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </Link>
                        <button class="relative p-2 bg-blue-500 text-white rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="absolute -top-1 -right-1 bg-yellow-400 text-xs text-gray-800 w-5 h-5 rounded-full flex items-center justify-center font-bold">0</span>
                        </button>
                        <span class="text-green-500 font-bold">$0.00</span>
                    </div>
                </div>
                
                <!-- Trending Search -->
                <div class="flex items-center space-x-4 pb-3 text-sm">
                    <span class="text-yellow-500 font-medium">★ SEARCH TRENDING:</span>
                    <a href="#" class="text-gray-600 hover:text-blue-500">iPhone</a>
                    <a href="#" class="text-gray-600 hover:text-blue-500">Huawei Metebook</a>
                    <a href="#" class="text-gray-600 hover:text-blue-500">GoPro</a>
                    <a href="#" class="text-gray-600 hover:text-blue-500">Headphone</a>
                    <a href="#" class="text-gray-600 hover:text-blue-500">Macbook Pro</a>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="border-t">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex items-center justify-between">
                        <nav class="flex space-x-8 py-4">
                            <a href="#" class="text-blue-500 font-medium">HOME</a>
                            <a href="#" class="text-gray-600 hover:text-blue-500">COLLECTIONS</a>
                            <a href="#" class="text-gray-600 hover:text-blue-500">PRODUCTS</a>
                            <a href="#" class="text-gray-600 hover:text-blue-500">OTHER PAGES</a>
                            <a href="#" class="text-gray-600 hover:text-blue-500">BLOG PAGES</a>
                        </nav>
                        <div class="flex items-center space-x-6 text-sm">
                            <a href="#" class="flex items-center text-gray-600 hover:text-blue-500">
                                <span class="text-red-500 mr-1">🔥</span> Hot Deals
                            </a>
                            <a href="#" class="flex items-center text-gray-600 hover:text-blue-500">
                                <span class="mr-1">📦</span> Track Your Order
                            </a>
                            <a href="#" class="flex items-center text-gray-600 hover:text-blue-500">
                                <span class="mr-1">📍</span> Store Locator
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="py-6">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-3 gap-4">
                    <!-- Main Banner -->
                    <div class="col-span-2 relative rounded-2xl overflow-hidden bg-gradient-to-r from-blue-600 to-blue-400 h-96">
                        <div class="absolute inset-0 flex items-center">
                            <div class="p-8 text-white z-10">
                                <span class="text-sm font-medium bg-white/20 px-3 py-1 rounded">GAMING GEAR</span>
                                <h2 class="text-4xl font-bold mt-4 mb-2">GAME CONTROLLER</h2>
                                <p class="text-white/80 mb-6">Controller type: Wireless controller</p>
                                <button class="bg-white text-blue-600 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition">
                                    SHOP NOW
                                </button>
                            </div>
                        </div>
                        <img 
                            src="https://images.unsplash.com/photo-1592840496694-26d035b52b48?w=600" 
                            alt="Game Controller" 
                            class="absolute right-0 bottom-0 w-2/3 h-full object-contain"
                        />
                        <!-- Slider dots -->
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                            <button class="w-8 h-2 bg-white rounded-full"></button>
                            <button class="w-2 h-2 bg-white/50 rounded-full"></button>
                            <button class="w-2 h-2 bg-white/50 rounded-full"></button>
                            <button class="w-2 h-2 bg-white/50 rounded-full"></button>
                        </div>
                    </div>
                    
                    <!-- Side Banners -->
                    <div class="space-y-4">
                        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-purple-100 to-blue-100 h-44">
                            <div class="p-4">
                                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded">NEW ARRIVALS</span>
                                <h3 class="text-lg font-bold mt-2">BAMBOOBUDS</h3>
                                <a href="#" class="text-blue-500 text-sm flex items-center mt-2">
                                    Shop Now <span class="ml-1">→</span>
                                </a>
                            </div>
                            <img 
                                src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=200" 
                                alt="Earbuds" 
                                class="absolute right-0 bottom-0 w-24 h-24 object-contain"
                            />
                        </div>
                        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-pink-100 to-purple-100 h-44">
                            <div class="p-4">
                                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded">NEW ARRIVALS</span>
                                <h3 class="text-lg font-bold mt-2">HOMEPOD PRO</h3>
                                <a href="#" class="text-blue-500 text-sm flex items-center mt-2">
                                    Shop Now <span class="ml-1">→</span>
                                </a>
                            </div>
                            <img 
                                src="https://images.unsplash.com/photo-1589003077984-894e133dabab?w=200" 
                                alt="HomePod" 
                                class="absolute right-0 bottom-0 w-32 h-32 object-contain"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-8 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between">
                    <button class="p-2 bg-white rounded-full shadow hover:bg-gray-50">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    
                    <div class="flex-1 flex justify-center space-x-12">
                        <div v-for="category in categories" :key="category.id" class="flex flex-col items-center cursor-pointer group">
                            <div class="w-20 h-20 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-2 group-hover:shadow-md transition">
                                <span class="text-3xl">{{ category.icon }}</span>
                            </div>
                            <span class="text-sm text-gray-600 group-hover:text-blue-500">{{ category.name }}</span>
                        </div>
                    </div>
                    
                    <button class="p-2 bg-white rounded-full shadow hover:bg-gray-50">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-8 border-b">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-4 gap-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">FREE US DELIVERY</h4>
                            <p class="text-sm text-gray-500">For US customers (including Alaska and Hawaii) or orders over $200</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">SECURE PAYMENT</h4>
                            <p class="text-sm text-gray-500">We accept Visa, American Express, Paypal, Payoneer Mastercard and Discover</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">1 YEAR WARRANTY</h4>
                            <p class="text-sm text-gray-500">All of our products are made with care and covered for one year against manufacturing defects</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">SUPPORT 24/7</h4>
                            <p class="text-sm text-gray-500">Contact us 24 hours a day, 7 days a week. Call Us: 0123-456-789</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-3 gap-6">
                    <div v-for="product in featuredProducts.slice(0, 3)" :key="product.id" 
                         class="relative rounded-2xl overflow-hidden group cursor-pointer"
                         :class="[
                             product.id === 1 ? 'bg-gradient-to-br from-blue-100 to-blue-50' :
                             product.id === 2 ? 'bg-gradient-to-br from-gray-900 to-gray-800' :
                             'bg-gradient-to-br from-amber-100 to-orange-50'
                         ]">
                        <div class="p-6 h-80 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold" :class="product.id === 2 ? 'text-white' : 'text-gray-800'">
                                    {{ product.name }}
                                </h3>
                                <p class="text-sm mt-1" :class="product.id === 2 ? 'text-gray-300' : 'text-gray-500'">
                                    {{ product.short_description }}
                                </p>
                            </div>
                            <img 
                                :src="`https://picsum.photos/seed/${product.id}/300/200`" 
                                :alt="product.name" 
                                class="w-full h-48 object-contain group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Top Smartphone Trends -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-2xl font-bold text-center mb-8">TOP SMARTPHONE TRENDS</h2>
                <div class="grid grid-cols-5 gap-6">
                    <div v-for="product in newProducts" :key="product.id" 
                         class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-md transition cursor-pointer">
                        <div class="relative">
                            <span v-if="product.is_new" class="absolute top-0 left-0 bg-green-500 text-white text-xs px-2 py-1 rounded">New</span>
                            <img 
                                :src="`https://picsum.photos/seed/${product.id + 10}/200/200`" 
                                :alt="product.name" 
                                class="w-full h-40 object-contain mb-4"
                            />
                        </div>
                        <div class="text-center">
                            <p class="text-xs text-gray-400 mb-1">{{ product.category?.name }}</p>
                            <h3 class="font-medium text-gray-800 text-sm mb-2">{{ product.name }}</h3>
                            <div class="flex items-center justify-center space-x-2">
                                <span v-if="product.sale_price" class="text-gray-400 line-through text-sm">${{ product.price }}</span>
                                <span class="text-blue-500 font-bold">${{ product.sale_price || product.price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center mb-4">
                            <span class="text-2xl font-bold text-blue-500">e</span>
                            <span class="text-2xl font-bold">Commax</span>
                        </div>
                        <p class="text-gray-400 text-sm">Your one-stop shop for all electronics and gadgets.</p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-white">Home</a></li>
                            <li><a href="#" class="hover:text-white">Products</a></li>
                            <li><a href="#" class="hover:text-white">Categories</a></li>
                            <li><a href="#" class="hover:text-white">About Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Support</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-white">FAQ</a></li>
                            <li><a href="#" class="hover:text-white">Shipping</a></li>
                            <li><a href="#" class="hover:text-white">Returns</a></li>
                            <li><a href="#" class="hover:text-white">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Contact Us</h4>
                        <p class="text-gray-400 text-sm">Email: support@ecommax.com</p>
                        <p class="text-gray-400 text-sm">Phone: 0123-456-789</p>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                    <p>© 2026 eCommax. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
