<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    product: Object,
    categories: Array,
    variants: Array,
});

const form = useForm({
    name: props.product.name,
    category_id: props.product.category_id,
    description: props.product.description || '',
    short_description: props.product.short_description || '',
    price: props.product.price,
    sale_price: props.product.sale_price,
    sku: props.product.sku || '',
    stock: props.product.stock,
    is_active: props.product.is_active,
    is_featured: props.product.is_featured,
    is_new: props.product.is_new,
    variant_options: props.product.variant_options?.map(o => o.id) || [],
});

const toggleVariantOption = (optionId) => {
    const index = form.variant_options.indexOf(optionId);
    if (index > -1) {
        form.variant_options.splice(index, 1);
    } else {
        form.variant_options.push(optionId);
    }
};

const submit = () => {
    form.put(route('admin.products.update', props.product.id));
};
</script>

<template>
    <Head title="Editar Producto" />
    
    <AdminLayout>
        <template #header>Editar Producto</template>
        
        <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-2 bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Producto</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input v-model="form.name" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select v-model="form.category_id" class="mt-1 block w-full rounded-lg border-gray-300">
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Descripción Corta</label>
                            <input v-model="form.short_description" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Descripción Completa</label>
                            <textarea v-model="form.description" rows="4" class="mt-1 block w-full rounded-lg border-gray-300"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Precio y Stock</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Precio ($)</label>
                                <input v-model="form.price" type="number" step="0.01" class="mt-1 block w-full rounded-lg border-gray-300" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Precio de Oferta ($)</label>
                                <input v-model="form.sale_price" type="number" step="0.01" class="mt-1 block w-full rounded-lg border-gray-300" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">SKU</label>
                                <input v-model="form.sku" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                <input v-model="form.stock" type="number" class="mt-1 block w-full rounded-lg border-gray-300" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Estado</h3>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input v-model="form.is_active" type="checkbox" class="rounded border-gray-300 text-blue-600" />
                                <span class="ml-2 text-sm text-gray-700">Activo</span>
                            </label>
                            <label class="flex items-center">
                                <input v-model="form.is_featured" type="checkbox" class="rounded border-gray-300 text-blue-600" />
                                <span class="ml-2 text-sm text-gray-700">Destacado</span>
                            </label>
                            <label class="flex items-center">
                                <input v-model="form.is_new" type="checkbox" class="rounded border-gray-300 text-blue-600" />
                                <span class="ml-2 text-sm text-gray-700">Nuevo</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Asignar Variantes</h3>
                
                <div v-for="variant in variants" :key="variant.id" class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-3">{{ variant.name }}</h4>
                    <div class="flex flex-wrap gap-3">
                        <button 
                            v-for="option in variant.options" 
                            :key="option.id"
                            type="button"
                            @click="toggleVariantOption(option.id)"
                            :class="[
                                'px-4 py-2 border rounded-lg text-sm transition',
                                form.variant_options.includes(option.id) 
                                    ? 'border-blue-500 bg-blue-50 text-blue-700' 
                                    : 'border-gray-300 hover:border-gray-400'
                            ]"
                        >
                            <span v-if="variant.type === 'color'" 
                                  class="inline-block w-4 h-4 rounded-full mr-2 border"
                                  :style="{ backgroundColor: option.value }">
                            </span>
                            {{ option.name }}
                            <span v-if="option.price_adjustment > 0" class="text-green-600 ml-1">+${{ option.price_adjustment }}</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <Link :href="route('admin.products.index')" class="px-6 py-2 border rounded-lg hover:bg-gray-50">Cancelar</Link>
                <button type="submit" :disabled="form.processing" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </AdminLayout>
</template>
