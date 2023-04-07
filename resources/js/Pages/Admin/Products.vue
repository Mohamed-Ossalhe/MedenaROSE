<template>
    <div class="px-4 sm:px-6 lg:px-8 mt-5">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Products</h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <Link href="/products/create" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 sm:w-auto">Add New Product</Link>
            </div>
        </div>

        <div>
            <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Pinned Projects</h2>
            <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <li v-for="project in projects" :key="project.name" class="col-span-1 flex shadow-sm rounded-md">
                    <div :class="[project.bgColor, 'flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded-l-md']">
                        {{ project.initials }}
                    </div>
                    <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                        <div class="flex-1 px-4 py-2 text-sm truncate">
                            <a :href="project.href" class="text-gray-900 font-medium hover:text-gray-600">{{ project.name }}</a>
                            <p class="text-gray-500">{{ project.members }} Members</p>
                        </div>
                        <div class="flex-shrink-0 pr-2">
                            <button type="button" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Open options</span>
                                <DotsVerticalIcon class="w-5 h-5" aria-hidden="true" />
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

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
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="product in products.data" :key="product.email">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img v-for="pic in product.images" class="h-10 w-10 rounded-full" :src="image + pic.src" alt="" />
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
        <div v-else class="flex flex-col items-center justify-center">
            <img class="h-80 mt-10" :src="noFileFound" alt="">
            <h2 class="capitalize text-lg text-red-900">no product found, add new product</h2>
        </div>
    </div>
</template>

<script>
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import Pagination from "@/Components/Pagination.vue";
import noFileFound from '../../../assets/Dashboard/no-file-found.jpg';
import { DotsVerticalIcon } from '@heroicons/vue/solid'

const projects = [
    { name: 'Graph API', initials: 'GA', href: '#', members: 16, bgColor: 'bg-pink-600' },
    { name: 'Component Design', initials: 'CD', href: '#', members: 12, bgColor: 'bg-purple-600' },
    { name: 'Templates', initials: 'T', href: '#', members: 16, bgColor: 'bg-yellow-500' }
]

export default {
    name: 'Products',
    layout: Layout,
    data() {
        return {
            noFileFound: noFileFound
        }
    },
    components: {
        Pagination,
        DotsVerticalIcon
    },
    props: {
        products: Object
    },
    computed: {
        image() {
            return 'http://127.0.0.1:8000/storage/productImages/'
        }
    },
    setup() {
        return {
            projects,
        }
    },
}
</script>
