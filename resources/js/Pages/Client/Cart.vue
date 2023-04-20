<template>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>
            <form class="mt-12 lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                    <ul v-if="carts.length > 0" role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                        <li v-for="product in carts" :key="product.id" class="flex py-6 sm:py-10">
                            <div class="flex-shrink-0">
                                <img :src="imagePath + product.products.image.src" class="w-24 h-24 rounded-md object-center object-cover sm:w-48 sm:h-48" />
                            </div>

                            <div class="ml-4 flex-1 flex flex-col justify-between sm:ml-6">
                                <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                    <div>
                                        <div class="flex justify-between">
                                            <h3 class="text-sm">
                                                <a class="font-medium text-gray-700 hover:text-gray-800">
                                                    {{ product.products.name }}
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="mt-1 text-sm font-medium text-gray-900">${{ product.products.price }}</p>
                                        <p class="text-sm mt-2 text-gray-600 truncate">{{product.products.description}}</p>
                                    </div>

                                    <div class="mt-4 sm:mt-0 sm:pr-9">
                                        <label :for="`quantity-${product.products.name}`" class="sr-only">Quantity, {{ product.products.name }}</label>
                                        <select v-on:change="selectQuantity(product.id, $event)" :id="`quantity-${product.products.name}`" :name="`quantity-${product.products.name}`" class="max-w-full rounded-md border border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>

                                        <div class="absolute top-0 right-0">
                                            <Link as="button" method="DELETE" :href="'cart/' + product.id" class="-m-2 p-2 inline-flex text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Remove</span>
                                                <XIcon class="h-5 w-5" aria-hidden="true" />
                                            </Link>
                                        </div>
                                    </div>
                                </div>

                                <p class="mt-4 flex text-sm text-gray-700 space-x-2">
                                    <CheckIcon v-if="product.inStock" class="flex-shrink-0 h-5 w-5 text-green-500" aria-hidden="true" />
                                    <ClockIcon v-else class="flex-shrink-0 h-5 w-5 text-gray-300" aria-hidden="true" />
                                    <span>{{ product.inStock ? 'In stock' : `Out stock` }}</span>
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div v-else>
                        <NotFound>Your Cart is Empty</NotFound>
                    </div>
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="mt-16 bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                    <dl class="mt-6 space-y-4">
                        <div v-for="product in carts" class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">
                                <p>{{product.products.name}}</p>
                                <span class="text-xs">Quantity: {{product.quantity > 1 ? product.quantity + ' packs' : product.quantity + ' pack' }}</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">${{product.products.totalPrice}}</dd>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-medium text-gray-900">${{total_price}}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-primary/70 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-primary/50">Checkout</button>
                    </div>
                </section>
            </form>
        </div>
    </div>
</template>

<script>

import DefaultLayout from "@/Pages/Client/Shared/DefaultLayout.vue";
import { CheckIcon, ClockIcon, QuestionMarkCircleIcon, XIcon } from '@heroicons/vue/solid'
import product from "../../Components/Product.vue";
import NotFound from "@/Pages/Admin/Shared/NotFound.vue";
import {ref} from "vue";

export default {
    name: "Cart",
    layout: DefaultLayout,
    data() {
        return {
            productId: '',
            quantity: 1
        }
    },
    methods: {
        selectQuantity(productId, e) {
            this.quantity = e.target.value
            this.productId = productId
        }
    },
    components: {
        NotFound,
        CheckIcon,
        ClockIcon,
        QuestionMarkCircleIcon,
        XIcon,
    },
    props: {
        carts: Array,
        total_price: Number
    },
    computed: {
        product() {
            return product
        },
        imagePath() {
            return 'http://127.0.0.1:8000/storage/productImages/'
        }
    },
    watch: {
        quantity: function() {
            this.$inertia.patch('/cart/' + this.productId, {
                quantity: this.quantity
            })
        }
    }
}
</script>

<style scoped>

</style>
