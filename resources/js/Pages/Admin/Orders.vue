<template>
    <Head title="Orders"/>
    <div class="mt-5">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Orders</h1>
            </div>
        </div>

<!--        <Filters :link="'/orders'" :filters="filters" :sort="sorts" />-->

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
                                    <th scope="col" class="sm:w-2/5 lg:w-1/3 pr-2 py-3 font-normal">Product</th>
                                    <th scope="col" class="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">Price</th>
                                    <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Status</th>
                                    <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Delivery Date</th>
                                    <th scope="col" class="w-0 py-3 font-normal">Info</th>
                                    <th scope="col" class="w-0 py-3 font-normal text-right">Options</th>
                                </tr>
                                </thead>
                                <tbody class="border-b border-gray-200 divide-y divide-gray-200 text-sm sm:border-t">
                                <tr v-for="order in orders.data"> <!-- add orders loop here -->
                                    <td class="py-6 pr-3">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="font-medium text-gray-900">Order #{{order.id}}</div>
                                                <div class="mt-1 sm:hidden"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                        ${{order.totalPrice}}
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                        <span :class='order.status === "pending" ? "bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500" : "bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400" '>
                                            <svg v-if="order.status === 'pending'" aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                                            <svg v-else aria-hidden="true" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                            {{order.status}}
                                        </span>
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                        by {{order.deliveryDate}}
                                    </td>
                                    <td class="py-6 font-medium text-right whitespace-nowrap">
                                        <Link :href="'/admin/orders/' + order.id" class="text-indigo-600"
                                        >View<span class="hidden lg:inline"> Order</span><span class="sr-only">, </span></Link
                                        >
                                    </td>
                                    <td class="py-6 font-medium text-right whitespace-nowrap">
                                        <select @change="changeStatus(order.id, $event)" class="text-xs ml-5 rounded">
                                            <option value="pending">Pending</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="shipped">Shipped</option>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <Pagination :links="orders.links"/>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import { CheckIcon } from '@heroicons/vue/outline'
import Filters from "@/Components/Filters.vue";
import Pagination from "@/Components/Pagination.vue";
import {MenuButton, MenuItem, MenuItems} from "@headlessui/vue";

export default {
    name: "Orders",
    layout: Layout,
    components: {
        MenuItem,
        MenuItems,
        MenuButton,
        Pagination,
        Filters,
        CheckIcon,
    },
    props: {
        orders: Object,
        filters: Object,
        sorts: Object
    },
    methods: {
        changeStatus(orderId, e) {
            console.log(orderId,e.target.value)
            this.$inertia.patch('/admin/orders/' + orderId, {
                status: e.target.value
            }, {
                preserveScroll: true,
                preserveState: true
            })
            //admin/orders/{order}
        }
    }
}
</script>

<style scoped>

</style>
