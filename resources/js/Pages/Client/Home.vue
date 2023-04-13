<template>
    <Head title="Home"/>
    <div class="bg-white">
        <!-- Hero Section -->
        <Hero/>
        <main>
            <!-- Category section -->
            <section aria-labelledby="category-heading" class="bg-gray-50">
                <div class="max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-baseline sm:justify-between">
                        <h2 id="category-heading" class="text-2xl font-extrabold tracking-tight text-gray-900">Shop by Category</h2>
                        <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">Browse all categories<span aria-hidden="true"> &rarr;</span></a>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:grid-rows-2 sm:gap-x-6 lg:gap-8">
                        <div class="group aspect-w-2 aspect-h-1 rounded-lg overflow-hidden sm:aspect-h-1 sm:aspect-w-1 sm:row-span-2">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-featured-category.jpg" alt="Two models wearing women's black cotton crewneck tee and off-white cotton crewneck tee." class="object-center object-cover group-hover:opacity-75" />
                            <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50" />
                            <div class="p-6 flex items-end">
                                <div>
                                    <h3 class="font-semibold text-white">
                                        <a href="#">
                                            New Arrivals
                                        </a>
                                    </h3>
                                    <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                                </div>
                            </div>
                        </div>
                        <div class="group aspect-w-2 aspect-h-1 rounded-lg overflow-hidden sm:relative sm:aspect-none sm:h-full">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-01.jpg" alt="Wooden shelf with gray and olive drab green baseball caps, next to wooden clothes hanger with sweaters." class="object-center object-cover group-hover:opacity-75 sm:absolute sm:inset-0 sm:w-full sm:h-full" />
                            <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50 sm:absolute sm:inset-0" />
                            <div class="p-6 flex items-end sm:absolute sm:inset-0">
                                <div>
                                    <h3 class="font-semibold text-white">
                                        <a href="#">
                                            Accessories
                                        </a>
                                    </h3>
                                    <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                                </div>
                            </div>
                        </div>
                        <div class="group aspect-w-2 aspect-h-1 rounded-lg overflow-hidden sm:relative sm:aspect-none sm:h-full">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-02.jpg" alt="Walnut desk organizer set with white modular trays, next to porcelain mug on wooden desk." class="object-center object-cover group-hover:opacity-75 sm:absolute sm:inset-0 sm:w-full sm:h-full" />
                            <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50 sm:absolute sm:inset-0" />
                            <div class="p-6 flex items-end sm:absolute sm:inset-0">
                                <div>
                                    <h3 class="font-semibold text-white">
                                        <a href="#">
                                            Workspace
                                        </a>
                                    </h3>
                                    <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:hidden">
                        <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">Browse all categories<span aria-hidden="true"> &rarr;</span></a>
                    </div>
                </div>
            </section>

            <!-- Featured section -->
            <section aria-labelledby="cause-heading">
                <div class="relative bg-gray-800 py-32 px-6 sm:py-40 sm:px-12 lg:px-16">
                    <div class="absolute inset-0 overflow-hidden">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-feature-section-full-width.jpg" alt="" class="w-full h-full object-center object-cover" />
                    </div>
                    <div aria-hidden="true" class="absolute inset-0 bg-gray-900 bg-opacity-50" />
                    <div class="relative max-w-3xl mx-auto flex flex-col items-center text-center">
                        <h2 id="cause-heading" class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Long-term thinking</h2>
                        <p class="mt-3 text-xl text-white">We're committed to responsible, sustainable, and ethical manufacturing. Our small-scale approach allows us to focus on quality and reduce our impact. We're doing our best to delay the inevitable heat-death of the universe.</p>
                        <a href="#" class="mt-8 w-full block bg-white border border-transparent rounded-md py-3 px-8 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">Read our story</a>
                    </div>
                </div>
            </section>

            <!-- Favorites section -->
            <section aria-labelledby="favorites-heading">
                <div class="max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-baseline sm:justify-between">
                        <h2 id="favorites-heading" class="text-2xl font-extrabold tracking-tight text-gray-900">Our Favorites</h2>
                        <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">Browse all favorites<span aria-hidden="true"> &rarr;</span></a>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-10 sm:grid-cols-3 sm:gap-y-0 sm:gap-x-6 lg:gap-x-8">
                        <div v-for="favorite in favorites" :key="favorite.id" class="group relative">
                            <div class="w-full h-96 rounded-lg overflow-hidden group-hover:opacity-75 sm:h-auto sm:aspect-w-2 sm:aspect-h-3">
                                <img :src="favorite.imageSrc" :alt="favorite.imageAlt" class="w-full h-full object-center object-cover" />
                            </div>
                            <h3 class="mt-4 text-base font-semibold text-gray-900">
                                <a :href="favorite.href">
                                    <span class="absolute inset-0" />
                                    {{ favorite.name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ favorite.price }}</p>
                        </div>
                    </div>

                    <div class="mt-6 sm:hidden">
                        <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">Browse all favorites<span aria-hidden="true"> &rarr;</span></a>
                    </div>
                </div>
            </section>

            <!-- CTA section -->
            <section aria-labelledby="sale-heading">
                <div class="pt-32 overflow-hidden sm:pt-14">
                    <div class="bg-gray-800">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="relative pt-48 pb-16 sm:pb-24">
                                <div>
                                    <h2 id="sale-heading" class="text-4xl font-extrabold tracking-tight text-white md:text-5xl">
                                        Final Stock.
                                        <br />
                                        Up to 50% off.
                                    </h2>
                                    <div class="mt-6 text-base">
                                        <a href="#" class="font-semibold text-white">Shop the sale<span aria-hidden="true"> &rarr;</span></a>
                                    </div>
                                </div>

                                <div class="absolute -top-32 left-1/2 transform -translate-x-1/2 sm:top-6 sm:translate-x-0">
                                    <div class="ml-24 flex space-x-6 min-w-max sm:ml-3 lg:space-x-8">
                                        <div class="flex space-x-6 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                                            <div class="flex-shrink-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72" src="../../../assets/Hero/1.png" alt="" />
                                            </div>

                                            <div class="mt-6 flex-shrink-0 sm:mt-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72" src="../../../assets/Hero/3.png" alt="" />
                                            </div>
                                        </div>
                                        <div class="flex space-x-6 sm:-mt-20 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                                            <div class="flex-shrink-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72" src="../../../assets/Hero/4.png" alt="" />
                                            </div>

                                            <div class="mt-6 flex-shrink-0 sm:mt-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72" src="../../../assets/Hero/5.png" alt="" />
                                            </div>
                                        </div>
                                        <div class="flex space-x-6 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                                            <div class="flex-shrink-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72" src="../../../assets/Hero/6.png" alt="" />
                                            </div>

                                            <div class="mt-6 flex-shrink-0 sm:mt-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72" src="../../../assets/Hero/7.png" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import { ref } from 'vue'
import {
    Dialog,
    DialogOverlay,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { MenuIcon, SearchIcon, ShoppingBagIcon, XIcon } from '@heroicons/vue/outline'
import Header from "@/Shared/Header/Header.vue";
import Hero from "@/Shared/Home/Hero.vue";
import Footer from "@/Shared/Footer/Footer.vue";
import DefaultLayout from "@/Pages/Client/Shared/DefaultLayout.vue";

const favorites = [
    {
        id: 1,
        name: 'Black Basic Tee',
        price: '$32',
        href: '#',
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-01.jpg',
        imageAlt: "Model wearing women's black cotton crewneck tee.",
    },
    {
        id: 2,
        name: 'Off-White Basic Tee',
        price: '$32',
        href: '#',
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-02.jpg',
        imageAlt: "Model wearing women's off-white cotton crewneck tee.",
    },
    {
        id: 3,
        name: 'Mountains Artwork Tee',
        price: '$36',
        href: '#',
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-03.jpg',
        imageAlt:
            "Model wearing women's burgundy red crewneck artwork tee with small white triangle overlapping larger black triangle.",
    },
]

export default {
    layout: DefaultLayout,
    components: {
    Dialog,
    DialogOverlay,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
    MenuIcon,
    SearchIcon,
    ShoppingBagIcon,
    XIcon,
    Hero
},
    setup() {
        const open = ref(false)

        return {
            favorites,
            open,
        }
    },
}
</script>
