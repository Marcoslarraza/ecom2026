<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    categories: Object,
});

const deleteCategory = (id) => {
    if (confirm('¿Estás seguro de eliminar esta categoría?')) {
        router.delete(route('admin.categories.destroy', id));
    }
};
</script>

<template>
    <Head title="Categorías" />
    
    <AdminLayout>
        <template #header>Categorías</template>
        
        <div class="mb-6 flex justify-between items-center">
            <p class="text-gray-600">Gestiona las categorías de productos</p>
            <Link :href="route('admin.categories.create')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Nueva Categoría
            </Link>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Icono</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Productos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Orden</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="category in categories.data" :key="category.id">
                            <td class="px-6 py-4 whitespace-nowrap text-2xl">
                                {{ category.icon }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ category.name }}</div>
                                <div class="text-sm text-gray-500">{{ category.slug }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ category.products_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ category.order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-2 py-1 text-xs font-medium rounded-full', category.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800']">
                                    {{ category.is_active ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <Link :href="route('admin.categories.edit', category.id)" class="text-blue-600 hover:text-blue-900 mr-3">Editar</Link>
                                <button @click="deleteCategory(category.id)" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
