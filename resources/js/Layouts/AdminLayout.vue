<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-gray-900">
            <div class="flex items-center justify-center h-16 bg-gray-800">
                <Link href="/" class="flex items-center">
                    <span class="text-2xl font-bold text-blue-500">e</span>
                    <span class="text-2xl font-bold text-white">Commax</span>
                </Link>
            </div>
            
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <Link 
                        :href="route('admin.dashboard')" 
                        class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 transition"
                        :class="{ 'bg-gray-800 text-white': route().current('admin.dashboard') }"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </Link>
                    
                    <Link 
                        :href="route('admin.products.index')" 
                        class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 transition"
                        :class="{ 'bg-gray-800 text-white': route().current('admin.products.*') }"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Productos
                    </Link>
                    
                    <Link 
                        :href="route('admin.variants.index')" 
                        class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 transition"
                        :class="{ 'bg-gray-800 text-white': route().current('admin.variants.*') }"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                        Variantes
                    </Link>
                    
                    <Link 
                        :href="route('admin.categories.index')" 
                        class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 transition"
                        :class="{ 'bg-gray-800 text-white': route().current('admin.categories.*') }"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Categorías
                    </Link>
                </div>
                
                <div class="px-4 mt-8">
                    <div class="border-t border-gray-700 pt-4">
                        <Link 
                            href="/" 
                            class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 transition"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Ver Tienda
                        </Link>
                        
                        <Link 
                            :href="route('logout')" 
                            method="post" 
                            as="button"
                            class="w-full flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 transition"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Cerrar Sesión
                        </Link>
                    </div>
                </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="ml-64">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">
                        <slot name="header">Admin Panel</slot>
                    </h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ user?.name }}</span>
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ user?.name?.charAt(0) }}
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
