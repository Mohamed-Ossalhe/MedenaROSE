<template>
    <Head title="Products"/>
    <div class="mt-5">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Products</h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <Link href="/admin/products/create" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 sm:w-auto">Add New Product</Link>
            </div>
        </div>

        <Filters :link="'/admin/products'" :sort="sort" :filters="filters" />

        <div v-if="products.data.length > 0">
            <div class="h-96">
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Quantity</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="product in products.data" :key="product.id">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full" :src="image + product.images[0].src" alt="" />
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{ product.name }}</div>
                                                    <div class="text-gray-500">{{ product.quantity }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-900">${{ product.price }}</div>
                                            <div class="text-gray-500">{{ product.sold ? product.sold : 'no sold' }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span :class="[{'bg-green-100 text-green-800': product.quantity > 0}, {'bg-red-100 text-red-800': product.quantity === 0}, 'inline-flex rounded-full px-2 text-xs font-semibold leading-5']">{{ product.quantity }}</span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">In Stock</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                            >Edit<span class="sr-only">, {{ product.name }}</span></a
                                            >
                                            <Link preserve-scroll as="button" method="DELETE" :href="'/admin/products/'+ product.id" class="text-red-600 hover:text-red-900 ml-2"
                                            >Delete<span class="sr-only">, {{ product.name }}</span></Link
                                            >
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination :links="products.links"/>
        </div>
        <NotFound v-else :toLink="'/admin/products/create'" :buttonText="'Add New Product'">no product found, add new product</NotFound>
    </div>
</template>

<script>
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import Pagination from "@/Components/Pagination.vue";
import noFileFound from '../../../assets/Dashboard/no-file-found.jpg';
import {
    Dialog,
    DialogOverlay,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'
import { ChevronDownIcon } from '@heroicons/vue/solid'
import Filters from "@/Components/Filters.vue";
import NotFound from "@/Pages/Admin/Shared/NotFound.vue";

export default {
    name: 'Products',
    layout: Layout,
    data() {
        return {
            noFileFound: noFileFound
        }
    },
    components: {
        NotFound,
        Filters,
        Pagination,
        Dialog,
        DialogOverlay,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        Popover,
        PopoverButton,
        PopoverGroup,
        PopoverPanel,
        TransitionChild,
        TransitionRoot,
        ChevronDownIcon,
        XIcon,
    },
    props: {
        products: Object,
        filters: Object,
        sort: Object
    },
    computed: {
        image() {
            return 'http://127.0.0.1:8000/storage/productImages/'
        }
    }
}
</script>
