<script setup lang="ts">
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    orders: Array,
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Your Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div v-if="orders.length">
                            <ul>
                                <li v-for="order in orders" :key="order.id" class="mb-4 border-b pb-4">
                                    <h3 class="text-lg font-semibold">Order #{{ order.id }}</h3>
                                    <p>Total: ${{ order.total_price }}</p>
                                    <p>Status: {{ order.status }}</p>

                                    <!-- 商品列表下拉 -->
                                    <details class="mt-2">
                                        <summary class="cursor-pointer text-blue-600 hover:text-blue-800">
                                            View Order Items
                                        </summary>
                                        <ul class="list-disc pl-6">
                                            <li v-for="item in order.items" :key="item.id">
                                                <div>{{ item.product.name }}</div>
                                                <div>Quantity: {{ item.quantity }}</div>
                                                <div>Price: ${{ item.price }}</div>
                                            </li>
                                        </ul>
                                    </details>
                                </li>
                            </ul>
                        </div>
                        <div v-else>
                            <p>You have no orders.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
