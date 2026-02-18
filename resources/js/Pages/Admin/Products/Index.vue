<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    products: Object,
});

const deleteProduct = (id) => {
    if (confirm('¿Estás seguro de eliminar este producto?')) {
        router.delete(route('admin.products.destroy', id));
    }
};
</script>

<template>
    <Head title="Productos" />
    
    <AdminLayout>
        <template #header>Productos</template>
        
        <div class="mb-6 flex justify-between items-center">
            <p class="text-gray-600">Gestiona tus productos</p>
            <Link :href="route('admin.products.create')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Nuevo Producto
            </Link>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="product in products.data" :key="product.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ product.name }}</div>
                                <div class="text-sm text-gray-500">SKU: {{ product.sku }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ product.category?.name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">${{ product.price }}</div>
                                <div v-if="product.sale_price" class="text-sm text-green-600">${{ product.sale_price }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm" :class="product.stock < 10 ? 'text-red-600 font-bold' : 'text-gray-500'">
                                {{ product.stock }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-2 py-1 text-xs font-medium rounded-full', product.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800']">
                                    {{ product.is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <Link :href="route('admin.products.edit', product.id)" class="text-blue-600 hover:text-blue-900 mr-3">Editar</Link>
                                <button @click="deleteProduct(product.id)" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
