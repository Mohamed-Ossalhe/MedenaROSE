<template>
    <footer aria-labelledby="footer-heading" class="bg-white">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-20 xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                    <div class="space-y-16 md:space-y-0 md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Shop</h3>
                            <ul role="list" class="mt-6 space-y-6">
                                <li v-for="item in footerNavigation.shop" :key="item.name" class="text-sm">
                                    <a :href="item.href" class="text-gray-500 hover:text-gray-600">
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Company</h3>
                            <ul role="list" class="mt-6 space-y-6">
                                <li v-for="item in footerNavigation.company" :key="item.name" class="text-sm">
                                    <a :href="item.href" class="text-gray-500 hover:text-gray-600">
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="space-y-16 md:space-y-0 md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Account</h3>
                            <ul role="list" class="mt-6 space-y-6">
                                <li v-for="item in footerNavigation.account" :key="item.name" class="text-sm">
                                    <a :href="item.href" class="text-gray-500 hover:text-gray-600">
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Connect</h3>
                            <ul role="list" class="mt-6 space-y-6">
                                <li v-for="item in footerNavigation.connect" :key="item.name" class="text-sm">
                                    <a :href="item.href" class="text-gray-500 hover:text-gray-600">
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mt-16 md:mt-16 xl:mt-0">
                    <h3 class="text-sm font-medium text-gray-900">Sign up for our newsletter</h3>
                    <p class="mt-6 text-sm text-gray-500">The latest deals and savings, sent to your inbox weekly.</p>
                    <form class="mt-2 flex sm:max-w-md">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" type="text" autocomplete="email" required="" class="appearance-none min-w-0 w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 text-base text-indigo-500 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" />
                        <div class="ml-4 flex-shrink-0">
                            <button type="submit" class="w-full bg-primary border border-transparent rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-primary/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-200 py-10">
                <p class="text-sm text-gray-500">Copyright &copy; 2022 - {{date.getFullYear()}} MedenaROSE Inc.</p>
            </div>
        </div>
    </footer>
</template>

<script>
import {
    Dialog,
    DialogOverlay,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup, TabList, TabPanel, TabPanels, TransitionChild, TransitionRoot
} from "@headlessui/vue";
import {MenuIcon, SearchIcon, ShoppingBagIcon, XIcon} from "@heroicons/vue/outline";
import {ref} from "vue";

const footerNavigation = {
    shop: [
        { name: 'Bags', href: '#' },
        { name: 'Tees', href: '#' },
        { name: 'Objects', href: '#' },
        { name: 'Home Goods', href: '#' },
        { name: 'Accessories', href: '#' },
    ],
    company: [
        { name: 'Who we are', href: '#' },
        { name: 'Sustainability', href: '#' },
        { name: 'Press', href: '#' },
        { name: 'Careers', href: '#' },
        { name: 'Terms & Conditions', href: '#' },
        { name: 'Privacy', href: '#' },
    ],
    account: [
        { name: 'Manage Account', href: '#' },
        { name: 'Returns & Exchanges', href: '#' },
        { name: 'Redeem a Gift Card', href: '#' },
    ],
    connect: [
        { name: 'Contact Us', href: '#' },
        { name: 'Twitter', href: '#' },
        { name: 'Instagram', href: '#' },
        { name: 'Pinterest', href: '#' },
    ],
}

export default {
    data() {
        return {
            date: new Date()
        }
    },
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
    },
    setup() {
        const open = ref(false)

        return {
            footerNavigation,
            open,
        }
    },
}
</script>

<style scoped>

</style>
