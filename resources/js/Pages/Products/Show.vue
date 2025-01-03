<!-- resources/js/Pages/Products/Show.vue -->
<script setup lang="ts">
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    product: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Product Details
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div>
                            <img :src="props.product.image" alt="Product Image" class="w-full h-96 object-cover rounded-md">
                            <h4 class="mt-4 text-2xl font-semibold">{{ props.product.name }}</h4>
                            <p class="text-gray-600 mt-2">{{ props.product.description }}</p>
                            <p class="text-gray-800 font-bold mt-4">{{ props.product.price | currency }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
