<script setup lang="ts">
import { defineProps, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useRouter } from 'vue-router';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'; 

const props = defineProps({
    cart: Array,
});

const cart = ref(props.cart);

const totalPrice = computed(() => {
    return cart.value.reduce((sum, item) => sum + item.total, 0);
});

const updateQuantity = (productId: number, newQuantity: number) => {
    axios.post('/cart/update-quantity', {
        product_id: productId,
        quantity: newQuantity,
    })
    .then(response => {

        if (response.data.cart && typeof response.data.cart === 'object') {
            const updatedCart = Object.values(response.data.cart);
            const updatedItem = updatedCart.find(item => item.product.id === productId);
            if (updatedItem) {
                const itemIndex = cart.value.findIndex(item => item.product.id === productId);
                if (itemIndex !== -1) {
                    cart.value[itemIndex] = updatedItem;
                }
            }
        } else {
            console.error('Returned data is not in expected format:', response.data);
            alert('Failed to update cart.');
        }
    })
    .catch(error => {
        console.error('Error updating cart:', error);
        alert('Failed to update cart.');
    });
};
const checkout = () => {
    axios.post('/orders')
        .then(response => {
            alert('Order placed successfully!');
            window.location.href = '/orders';
        })
        .catch(error => {
            console.error('Error creating order:', error);
            alert('Failed to create order.');
        });
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Your Cart
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div v-if="cart.length">
                            <ul>
                                <li v-for="item in cart" :key="item.product.id" class="mb-4 border-b pb-4">
                                    <div class="flex items-center">
                                        <img :src="item.product.image" alt="Product Image" class="w-16 h-16 object-cover rounded-md mr-4">
                                        <div>
                                            <h4 class="text-lg font-semibold">{{ item.product.name }}</h4>
                                            <div class="flex items-center mt-2">
                                                <label for="quantity" class="mr-2 text-gray-600">Quantity:</label>
                                                <input
                                                    id="quantity"
                                                    type="number"
                                                    :value="item.quantity"
                                                    min="1"
                                                    class="w-16 border rounded-md p-1"
                                                    @input="updateQuantity(item.product.id, $event.target.value)"
                                                />
                                            </div>
                                            <p class="text-gray-800 font-bold">Total: ${{ item.total }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-4 text-right">
                                <h3 class="text-xl font-bold">Total Price: ${{ totalPrice }}</h3>
                            </div>
                        </div>
                        <div v-else>
                            <p>Your cart is empty.</p>
                        </div>
                    </div>
                </div>
                <button
                    class="px-4 py-2 bg-blue-500 text-white rounded-md"
                    @click="checkout"
                >
                    Checkout
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
