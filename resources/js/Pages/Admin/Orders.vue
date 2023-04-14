<template>
    <Head title="Orders"/>
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
                                <tr> <!-- add orders loop here -->
                                    <td class="py-6 pr-8">
                                        <div class="flex items-center">
                                            <img class="w-16 h-16 object-center object-cover rounded mr-6" />
                                            <div>
                                                <div class="font-medium text-gray-900"></div>
                                                <div class="mt-1 sm:hidden"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                    </td>
                                    <td class="hidden py-6 pr-8 sm:table-cell">
                                    </td>
                                    <td class="py-6 font-medium text-right whitespace-nowrap">
                                        <a class="text-indigo-600"
                                        >View<span class="hidden lg:inline"> Order</span><span class="sr-only">, </span></a
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

export default {
    name: "Orders",
    layout: Layout,
    components: {
        Pagination,
        Filters,
        CheckIcon,
    },
    props: {
        orders: Object,
        filters: Object,
        sorts: Object
    }
}
</script>

<style scoped>

</style>
