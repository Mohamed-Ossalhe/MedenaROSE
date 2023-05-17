<template>
    <Head title="Our Products" />
    <div class="bg-white">
        <div class="hero">
            <div class="bg-products-hero bg-cover bg-center">
                <div class="max-w-7xl bg-primary/40 mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-base font-semibold text-indigo-200 tracking-wide uppercase">Pricing</h2>
                        <p class="mt-1 text-4xl font-extrabold text-white sm:text-5xl sm:tracking-tight lg:text-6xl">Take control of your team.</p>
                        <p class="max-w-xl mt-5 mx-auto text-xl text-indigo-200">Start building for free, then add a site plan to go live. Account plans unlock additional features.</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <!-- Mobile filter dialog -->
            <TransitionRoot as="template" :show="mobileFiltersOpen">
                <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                    <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 z-40 flex">
                        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                                <div class="flex items-center justify-between px-4">
                                    <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                                    <button type="button" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400" @click="mobileFiltersOpen = false">
                                        <span class="sr-only">Close menu</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Filters -->
                                <form class="mt-4 border-t border-gray-200">
                                    <h3>Categories</h3>
                                    <Disclosure as="div" v-for="category in categories" :key="category.id" class="border-t border-gray-200 px-4 py-6">
                                        <h3 class="-mx-2 -my-3 flow-root">
                                            <DisclosureButton class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500">
                                                <Link :href="'/our-products?category=' + category.id" class="font-medium text-gray-900">{{ category.name }}</Link>
                                            </DisclosureButton>
                                        </h3>
                                    </Disclosure>
                                </form>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </Dialog>
            </TransitionRoot>

            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="md:flex items-center justify-between border-b border-gray-200 pb-6 pt-24">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">New Arrivals</h1>
                    <Filters :link="'/our-products'" :filters="filters" :sort="sort" />
                    <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden" @click="mobileFiltersOpen = true">
                        <span class="sr-only">Filters</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M3.792 2.938A49.069 49.069 0 0112 2.25c2.797 0 5.54.236 8.209.688a1.857 1.857 0 011.541 1.836v1.044a3 3 0 01-.879 2.121l-6.182 6.182a1.5 1.5 0 00-.439 1.061v2.927a3 3 0 01-1.658 2.684l-1.757.878A.75.75 0 019.75 21v-5.818a1.5 1.5 0 00-.44-1.06L3.13 7.938a3 3 0 01-.879-2.121V4.774c0-.897.64-1.683 1.542-1.836z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <h2 id="products-heading" class="sr-only">Products</h2>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <!-- Filters -->
                        <form class="hidden lg:block">
                            <h3>Categories</h3>
                            <Disclosure as="div" v-for="category in categories" :key="category.id" class="border-b border-gray-200 py-6" v-slot="{ open }">
                                <h3 class="-my-3 flow-root">
                                    <DisclosureButton class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                        <Link preserve-scroll @click="onClickChange" v-model="categoryId" :href="'?category=' + category.id" class="font-medium text-gray-900">{{ category.name }}</Link>
                                    </DisclosureButton>
                                </h3>
                            </Disclosure>
                        </form>

                        <!-- Product grid -->
                        <div v-if="products.data.length !== 0" class="lg:col-span-3">
                            <div class="bg-white">
                                <div class="max-w-2xl mx-auto py-4 px-4 sm:py-8 sm:px-6 lg:max-w-7xl lg:px-8">
                                    <div class="products grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                                        <div v-for="product in products.data" :key="product.id">
                                            <Product :product="product"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <Pagination :links="products.links" />
                        </div>
                        <NotFound v-else class="col-span-3  ">No Products Found!</NotFound>
                    </div>
                </section>
            </main>
        </div>
    </div>
</template>

<script>
import { ref, watch } from 'vue'
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import DefaultLayout from "@/Pages/Client/Shared/DefaultLayout.vue";
import Filters from "@/Components/Filters.vue";
import Product from "@/Components/Product.vue";
import Pagination from "@/Components/Pagination.vue";
import NotFound from "@/Pages/Admin/Shared/NotFound.vue";


const mobileFiltersOpen = ref(false)

export default {
    layout: DefaultLayout,
    data() {
        return {
            categoryId: ref(this.category.category)
        }
    },
    components: {
        NotFound,
        Pagination,
        Product,
        Filters,
        Dialog,
        DialogPanel,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot
    },
    props: {
        categories: Object,
        products: Object,
        filters: Object,
        sort: Object,
        category: Object
    },
    watch: {
        categoryId: function (value) {
            this.$inertia.get('/our-products', {category: value}, {
                preserveState: true,
                preserveScroll: true,
                replace: true
            })
        }
    },
    setup() {
        return {
            mobileFiltersOpen,
        }
    }
}
</script>
