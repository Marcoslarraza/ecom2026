<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    category: Object,
});

const form = useForm({
    name: props.category.name,
    icon: props.category.icon || '',
    is_active: props.category.is_active,
    order: props.category.order,
});

const submit = () => {
    form.put(route('admin.categories.update', props.category.id));
};
</script>

<template>
    <Head title="Editar Categoría" />
    
    <AdminLayout>
        <template #header>Editar Categoría</template>
        
        <div class="max-w-xl">
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input v-model="form.name" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Icono (emoji)</label>
                        <input v-model="form.icon" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Orden</label>
                        <input v-model="form.order" type="number" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input v-model="form.is_active" type="checkbox" class="rounded border-gray-300 text-blue-600" />
                            <span class="ml-2 text-sm text-gray-700">Activa</span>
                        </label>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <Link :href="route('admin.categories.index')" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancelar</Link>
                    <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
