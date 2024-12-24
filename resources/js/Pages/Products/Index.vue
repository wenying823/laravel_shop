<script setup lang="ts">
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useRouter } from 'vue-router';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'; 


const cartCount = ref(0);

const props = defineProps({
    products: Array,
});

onMounted(() => {
    fetchCartCount();
});


const addToCart = (productId: number) => {

    axios.post('/cart/add', { product_id: productId })
        .then(response => {
            alert('Product added to cart!');
            fetchCartCount();
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
            alert('Failed to add product to cart.');
        });
};

function fetchCartCount() {
    axios.get('/cart/count')
        .then(response => {
            cartCount.value = response.data.count;
        })
        .catch(error => {
            console.error('Error fetching cart count:', error);
        });
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                All Products
            </h2>
            <div>
                <Link href="/cart" class="text-indigo-600 hover:text-indigo-800">
                    Cart ({{ cartCount }})
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <li v-for="product in props.products" :key="product.id" class="bg-white p-4 shadow rounded-lg">
                                <img :src="product.image" alt="Product Image" class="w-full h-48 object-cover rounded-md">
                                <h4 class="mt-4 text-xl font-semibold">{{ product.name }}</h4>
                                <p class="text-gray-600">{{ product.description }}</p>
                                <p class="text-gray-800 font-bold mt-2">${{ product.price }}</p>
                                <button @click="addToCart(product.id)" class="mt-4 bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-800">
                                    Add to Cart
                                </button>
                                <Link :href="`/products/${product.id}`" class="text-indigo-600 hover:text-indigo-800">View Details</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
