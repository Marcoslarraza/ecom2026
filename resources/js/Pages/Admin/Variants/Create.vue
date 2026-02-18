<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const form = useForm({
    name: '',
    type: 'select',
    is_active: true,
    options: [{ name: '', value: '', price_adjustment: 0 }],
});

const addOption = () => {
    form.options.push({ name: '', value: '', price_adjustment: 0 });
};

const removeOption = (index) => {
    form.options.splice(index, 1);
};

const submit = () => {
    form.post(route('admin.variants.store'));
};
</script>

<template>
    <Head title="Nueva Variante" />
    
    <AdminLayout>
        <template #header>Nueva Variante</template>
        
        <div class="max-w-3xl">
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm p-6">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre de la Variante</label>
                        <input v-model="form.name" type="text" class="mt-1 block w-full rounded-lg border-gray-300" placeholder="Ej: Color, Tamaño, Almacenamiento" />
                        <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo de Visualización</label>
                        <select v-model="form.type" class="mt-1 block w-full rounded-lg border-gray-300">
                            <option value="select">Dropdown (Select)</option>
                            <option value="color">Círculos de Color</option>
                            <option value="button">Botones</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input v-model="form.is_active" type="checkbox" class="rounded border-gray-300 text-blue-600" />
                            <span class="ml-2 text-sm text-gray-700">Activa</span>
                        </label>
                    </div>
                    
                    <div class="border-t pt-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Opciones</h3>
                            <button type="button" @click="addOption" class="text-blue-500 hover:text-blue-700 text-sm">
                                + Agregar Opción
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div v-for="(option, index) in form.options" :key="index" class="border rounded-lg p-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                        <input v-model="option.name" type="text" class="mt-1 block w-full rounded-lg border-gray-300" placeholder="Ej: Rojo, XL, 128GB" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Valor</label>
                                        <input v-model="option.value" type="text" class="mt-1 block w-full rounded-lg border-gray-300" placeholder="Ej: #FF0000, xl, 128" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Precio Adicional ($)</label>
                                        <input v-model="option.price_adjustment" type="number" step="0.01" class="mt-1 block w-full rounded-lg border-gray-300" />
                                    </div>
                                </div>
                                <button v-if="form.options.length > 1" type="button" @click="removeOption(index)" class="mt-2 text-sm text-red-500 hover:text-red-700">
                                    Eliminar opción
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <Link :href="route('admin.variants.index')" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancelar</Link>
                    <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50">
                        Crear Variante
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
