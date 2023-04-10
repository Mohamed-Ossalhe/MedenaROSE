<template>
    <div class="mt-5">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Orders</h1>
            </div>
        </div>

        <Filters :link="'/orders'" :filters="filters" :sort="sorts" />

        <div class="bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="">
                    <div class="space-y-20">
                        <div>
                            <table class="w-full text-gray-500 sm:mt-6">
                                <caption class="sr-only">
                                    Products
                                </caption>
                                <thead class="sr-only text-sm text-gray-500 text-left sm:not-sr-only">
                                <tr>
                                    <th scope="col" class="sm:w-2/5 lg:w-1/3 pr-8 py-3 font-normal">Product</th>
                                    <th scope="col" class="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">Price</th>
                                    <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Status</th>
                                    <th scope="col" class="w-0 py-3 font-normal text-right">Info</th>
                                </tr>
                                </thead>
                                <tbody class="border-b border-gray-200 divide-y divide-gray-200 text-sm sm:border-t">
                                <tr v-for="order in orders" :key="order.number">
                                    <td class="py-6 pr-8">
                                        <div class="flex items-center">
                                            <img :src="order.products.imageSrc" :alt="order.products.imageAlt" class="w-16 h-16 object-center object-cover rounded mr-6" />
                                            <div>
                                                <div class="font-medium text-gray-900">{{ order.products.name }}</div>
                                                <div class="mt-1 sm:hidden">{{ order.products.price }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                        {{ order.products.price }}
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                        {{ order.products.status }}
                                    </td>
                                    <td class="py-6 font-medium text-right whitespace-nowrap">
                                        <a :href="order.products.href" class="text-indigo-600"
                                        >View<span class="hidden lg:inline"> Order</span><span class="sr-only">, {{ order.products.name }}</span></a
                                        >
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <Pagination />
            </div>
        </div>
    </div>
</template>

<script>
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import { CheckIcon } from '@heroicons/vue/outline'
import Filters from "@/Components/Filters.vue";
import Pagination from "@/Components/Pagination.vue";

const orders = [
    {
        number: 'WU88191111',
        date: 'January 22, 2021',
        datetime: '2021-01-22',
        href: '#',
        invoiceHref: '#',
        total: '$302.00',
        products: [
            {
                id: 1,
                name: 'Nomad Tumbler',
                description:
                    "This durable double-walled insulated tumbler keeps your beverages at the perfect temperature all day long. Hot, cold, or even lukewarm if you're weird like that, this bottle is ready for your next adventure.",
                href: '#',
                price: '$35.00',
                status: 'out-for-delivery',
                date: 'January 5, 2021',
                datetime: '2021-01-05',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/order-history-page-06-product-01.jpg',
                imageAlt: 'Olive drab green insulated bottle with flared screw lid and flat top.',
            },
            // More products...
        ],
    },
    {
        number: 'WU88191111',
        date: 'January 22, 2021',
        datetime: '2021-01-22',
        href: '#',
        invoiceHref: '#',
        total: '$302.00',
        products: [
            {
                id: 1,
                name: 'Nomad Tumbler',
                description:
                    "This durable double-walled insulated tumbler keeps your beverages at the perfect temperature all day long. Hot, cold, or even lukewarm if you're weird like that, this bottle is ready for your next adventure.",
                href: '#',
                price: '$35.00',
                status: 'out-for-delivery',
                date: 'January 5, 2021',
                datetime: '2021-01-05',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/order-history-page-06-product-01.jpg',
                imageAlt: 'Olive drab green insulated bottle with flared screw lid and flat top.',
            },
            // More products...
        ],
    },
    {
        number: 'WU88191111',
        date: 'January 22, 2021',
        datetime: '2021-01-22',
        href: '#',
        invoiceHref: '#',
        total: '$302.00',
        products: [
            {
                id: 1,
                name: 'Nomad Tumbler',
                description:
                    "This durable double-walled insulated tumbler keeps your beverages at the perfect temperature all day long. Hot, cold, or even lukewarm if you're weird like that, this bottle is ready for your next adventure.",
                href: '#',
                price: '$35.00',
                status: 'out-for-delivery',
                date: 'January 5, 2021',
                datetime: '2021-01-05',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/order-history-page-06-product-01.jpg',
                imageAlt: 'Olive drab green insulated bottle with flared screw lid and flat top.',
            },
            // More products...
        ],
    },
    // More orders...
]

export default {
    name: "Orders",
    layout: Layout,
    components: {
        Pagination,
        Filters,
        CheckIcon,
    },
    props: {
        filters: Object,
        sorts: Object
    },
    setup() {
        return {
            orders,
        }
    },
}
</script>

<style scoped>

</style>
