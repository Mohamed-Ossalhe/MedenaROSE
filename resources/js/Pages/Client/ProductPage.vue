<template>
    <main class="max-w-7xl mx-auto sm:pt-16 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto lg:max-w-none">
            <!-- Product -->
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
                <!-- Image gallery -->
                <TabGroup as="div" class="flex flex-col-reverse">
                    <!-- Image selector -->
                    <div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                        <TabList class="grid grid-cols-4 gap-6">
                            <Tab v-for="image in product.images" :key="image.id" class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-offset-4 focus:ring-opacity-50"> <!--v-slot="{ selected = true }"-->
                  <span class="sr-only">
                    {{ image.name }}
                  </span>
                                <span class="absolute inset-0 rounded-md overflow-hidden">
                    <img :src="imagePath + image.src" alt="image" class="w-full h-full object-center object-cover" />
                  </span>
                                <span :class="[selected ? 'ring-indigo-500' : 'ring-transparent', 'absolute inset-0 rounded-md ring-2 ring-offset-2 pointer-events-none']" aria-hidden="true" />
                            </Tab>
                        </TabList>
                    </div>

                    <TabPanels class="w-full aspect-w-1 aspect-h-1">
                        <TabPanel v-for="image in product.images" :key="image.id">
                            <img :src="imagePath + image.src" alt="image" class="w-full h-96 object-center object-cover sm:rounded-lg" />
                        </TabPanel>
                    </TabPanels>
                </TabGroup>

                <!-- Product info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ product.name }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl text-gray-900">${{ product.price }}</p>
                    </div>

                    <!-- Reviews -->
                    <div class="mt-3">
                        <h3 class="sr-only">Reviews</h3>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[product.rating > rating ? 'text-indigo-500' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                            </div>
                            <p class="sr-only">{{ product.rating }} out of 5 stars</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>

                        <div class="text-base text-gray-700 space-y-6" v-html="product.description" />
                    </div>

                    <form class="mt-6">
                        <div class="mt-10 flex sm:flex-col1">
                            <button @click="addToBag" type="submit" class="max-w-xs flex-1 bg-primary border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-primary/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 sm:w-full">Add to bag</button>

                            <button type="button" class="ml-4 py-3 px-3 rounded-md flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                                <HeartIcon class="h-6 w-6 flex-shrink-0" aria-hidden="true" />
                                <span class="sr-only">Add to favorites</span>
                            </button>
                        </div>
                    </form>

<!--                    <section aria-labelledby="details-heading" class="mt-12">-->
<!--                        <h2 id="details-heading" class="sr-only">Additional details</h2>-->

<!--                        <div class="border-t divide-y divide-gray-200">-->
<!--                            <Disclosure as="div" v-for="detail in product" :key="detail.name" v-slot="{ open }">-->
<!--                                <h3>-->
<!--                                    <DisclosureButton class="group relative w-full py-6 flex justify-between items-center text-left">-->
<!--                                      <span :class="[open ? 'text-indigo-600' : 'text-gray-900', 'text-sm font-medium']">-->
<!--                                        {{ detail.name }}-->
<!--                                      </span>-->
<!--                                        <span class="ml-6 flex items-center">-->
<!--                                            <PlusSmIcon v-if="!open" class="block h-6 w-6 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />-->
<!--                                            <MinusSmIcon v-else class="block h-6 w-6 text-indigo-400 group-hover:text-indigo-500" aria-hidden="true" />-->
<!--                                        </span>-->
<!--                                    </DisclosureButton>-->
<!--                                </h3>-->
<!--                                <DisclosurePanel as="div" class="pb-6 prose prose-sm">-->
<!--                                    <ul role="list">-->
<!--                                        <li v-for="item in detail.items" :key="item">{{ item }}</li>-->
<!--                                    </ul>-->
<!--                                </DisclosurePanel>-->
<!--                            </Disclosure>-->
<!--                        </div>-->
<!--                    </section>-->
                </div>
            </div>

            <section aria-labelledby="related-heading" class="mt-10 border-t border-gray-200 py-16 px-4 sm:px-0">
                <h2 id="related-heading" class="text-xl font-bold text-gray-900">Customers also bought</h2>

                <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                    <div v-for="product in relatedProducts" :key="product.id">
                        <Product :product="product"/>
<!--                        <div class="relative">-->
<!--                            <div class="relative w-full h-72 rounded-lg overflow-hidden">-->
<!--                                <img :src="imagePath + product.images[0].src" alt="image" class="w-full h-full object-center object-cover" />-->
<!--                            </div>-->
<!--                            <div class="relative mt-4">-->
<!--                                <h3 class="text-sm font-medium text-gray-900">{{ product.name }}</h3>-->
<!--                            </div>-->
<!--                            <div class="absolute top-0 inset-x-0 h-72 rounded-lg p-4 flex items-end justify-end overflow-hidden">-->
<!--                                <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50" />-->
<!--                                <p class="relative text-lg font-semibold text-white">{{ product.price }}</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="mt-6">-->
<!--                            <a :href="product.href" class="relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200"-->
<!--                            >Add to bag<span class="sr-only">, {{ product.name }}</span></a-->
<!--                            >-->
<!--                        </div>-->
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>

<script>
import DefaultLayout from "@/Pages/Client/Shared/DefaultLayout.vue";
import {
    Dialog,
    DialogOverlay,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    HeartIcon,
    MenuIcon,
    MinusSmIcon,
    PlusSmIcon,
    SearchIcon,
    ShoppingBagIcon,
    UserIcon,
    XIcon,
} from '@heroicons/vue/outline'
import { StarIcon } from '@heroicons/vue/solid'
import Product from "@/Components/Product.vue";
import product from "@/Components/Product.vue";

export default {
    name: "ProductPage",
    layout: DefaultLayout,
    data() {
        return {
            selected: false
        }
    },
    props: {
        product: Object,
        relatedProducts: Array
    },
    computed: {
        imagePath() {
            return 'http://127.0.0.1:8000/storage/productImages/'
        }
    },
    components: {
        Product,
        Dialog,
        DialogOverlay,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Popover,
        PopoverButton,
        PopoverGroup,
        PopoverPanel,
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        Tab,
        TabGroup,
        TabList,
        TabPanel,
        TabPanels,
        TransitionChild,
        TransitionRoot,
        HeartIcon,
        MenuIcon,
        MinusSmIcon,
        PlusSmIcon,
        SearchIcon,
        ShoppingBagIcon,
        StarIcon,
        UserIcon,
        XIcon,
    },
    methods: {
        addToBag() {
            let orderData = {
                total_price: this.product.price,
                status: 'inCart'
            }
            this.$inertia.post('/cart', {
                id: this.product.id,
                quantity: 1
            }, {
                preserveState: true,
                preserveScroll: true
            })
        }
    }
}
</script>

<style scoped>

</style>
