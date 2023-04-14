<template>
    <Head title="Categories"/>
    <div class="sm:flex sm:items-center my-5">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Categories</h1>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <Link href="/admin/categories/create" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 sm:w-auto">Add New Category</Link>
        </div>
    </div>

    <Filters :link="'/admin/categories'" :sort="sort" :filters="filters" />

    <div v-if="categories.data.length > 0">
        <div class="h-96">
            <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                <li v-for="category in categories.data" :key="category.id" class="relative">
                    <div class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                        <img v-for="pic in category.images" :src="image + pic.src" alt="" class="h-48 w-full object-cover pointer-events-none group-hover:opacity-75" />
                        <button type="button" class="absolute inset-0 focus:outline-none">
                            <span class="sr-only">View details for {{ category.name }}</span>
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="mt-2 block text-sm font-medium text-gray-900 truncate pointer-events-none">{{ category.name }}</p>
                            <p class="block text-sm font-medium text-gray-500 pointer-events-none">{{ category.products === 1 ? category.products + ' Product' : category.products + ' Products' }}</p>
                        </div>
                        <Link preserve-scroll as="button" method="DELETE" :href="'/admin/categories/' + category.id">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute bottom-2 cursor-pointer right-0 w-6 h-6 text-red-600 hover:text-red-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </Link>
                    </div>
                </li>
            </ul>
        </div>
        <Pagination :links="categories.links" />
    </div>
    <NotFound v-else :toLink="'/admin/categories/create'" :buttonText="'Add New Category'">
        No Categories Found, Add New Category
    </NotFound>
</template>

<script>
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import Pagination from "@/Components/Pagination.vue";
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
    name: "Categories",
    layout: Layout,
    props: {
        categories: Object,
        filters: Object,
        sort: Object
    },
    components: {
        NotFound,
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
        Filters
    },
    computed: {
        image() {
            return 'http://127.0.0.1:8000/storage/categoryImages/'
        }
    }
}
</script>

<style scoped>

</style>
