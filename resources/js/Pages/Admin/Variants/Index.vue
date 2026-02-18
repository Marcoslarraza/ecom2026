<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref } from 'vue';

defineProps({
    variants: Object,
});

const editingPrice = ref(null);
const priceValue = ref(0);

const deleteVariant = (id) => {
    if (confirm('¿Estás seguro de eliminar esta variante?')) {
        router.delete(route('admin.variants.destroy', id));
    }
};

const startEditPrice = (option) => {
    editingPrice.value = option.id;
    priceValue.value = option.price_adjustment;
};

const savePrice = (optionId) => {
    router.patch(route('admin.variant-options.update-price', optionId), {
        price_adjustment: priceValue.value
    }, {
        preserveScroll: true,
        onSuccess: () => {
            editingPrice.value = null;
        }
    });
};
</script>

<template>
    <Head title="Variantes" />
    
    <AdminLayout>
        <template #header>Variantes y Precios</template>
        
        <div class="mb-6 flex justify-between items-center">
            <p class="text-gray-600">Gestiona las variantes (colores, tamaños, etc.) y sus precios</p>
            <Link :href="route('admin.variants.create')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Nueva Variante
            </Link>
        </div>
        
        <div class="space-y-6">
            <div v-for="variant in variants.data" :key="variant.id" class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ variant.name }}</h3>
                        <span class="text-sm text-gray-500">Tipo: {{ variant.type }}</span>
                    </div>
                    <div class="space-x-2">
                        <Link :href="route('admin.variants.edit', variant.id)" class="text-blue-600 hover:text-blue-900">Editar</Link>
                        <button @click="deleteVariant(variant.id)" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </div>
                </div>
                
                <div class="p-6">
                    <h4 class="text-sm font-medium text-gray-500 mb-4">Opciones y Precios Adicionales</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div v-for="option in variant.options" :key="option.id" 
                             class="border rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div v-if="variant.type === 'color'" 
                                     class="w-8 h-8 rounded-full border-2 border-gray-200"
                                     :style="{ backgroundColor: option.value }">
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ option.name }}</p>
                                    <p class="text-sm text-gray-500">{{ option.value }}</p>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <div v-if="editingPrice === option.id" class="flex items-center space-x-2">
                                    <input 
                                        v-model="priceValue" 
                                        type="number" 
                                        step="0.01"
                                        class="w-24 px-2 py-1 border rounded text-sm"
                                    />
                                    <button @click="savePrice(option.id)" class="text-green-600 hover:text-green-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button @click="editingPrice = null" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                                <div v-else>
                                    <p class="font-bold text-green-600">+${{ option.price_adjustment }}</p>
                                    <button @click="startEditPrice(option)" class="text-xs text-blue-500 hover:text-blue-700">
                                        Cambiar precio
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div v-if="variants.data.length === 0" class="bg-white rounded-xl shadow-sm p-12 text-center">
            <p class="text-gray-500">No hay variantes creadas aún</p>
            <Link :href="route('admin.variants.create')" class="text-blue-500 hover:text-blue-700 mt-2 inline-block">
                Crear primera variante
            </Link>
        </div>
    </AdminLayout>
</template>
