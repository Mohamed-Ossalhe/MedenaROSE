<template>
    <Head title="Orders"/>
    <div class="mt-5">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Orders</h1>
            </div>
        </div>

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
                                    <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Quantity</th>
                                    <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Stock</th>
                                </tr>
                                </thead>
                                <tbody class="border-b border-gray-200 divide-y divide-gray-200 text-sm sm:border-t">
                                <tr v-for="product in products"> <!-- add orders loop here -->
                                    <td class="py-6 pr-8">
                                        <div class="flex items-center">
                                            <img class="w-16 h-16 object-center object-cover rounded mr-6" />
                                            <div>
                                                <div class="font-medium text-gray-900">
                                                    {{product.name}}
                                                </div>
                                                <div class="mt-1 sm:hidden"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                        ${{product.price}} unit
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                        Qty {{product.pivot.quantity}}
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                        {{product.quantity}} unit rest
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <Pagination links=""/>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import { CheckIcon } from '@heroicons/vue/outline'
import Filters from "@/Components/Filters.vue";
import Pagination from "@/Components/Pagination.vue";

export default {
    name: "ViewOrders",
    layout: Layout,
    components: {
        Pagination,
        Filters,
        CheckIcon,
    },
    props: {
        products: Object,
    }
}
</script>

<style scoped>

</style>
