<template>
    <!-- Mobile menu -->
    <TransitionRoot as="template" :show="open" class="z-50">
        <Dialog as="div" class="fixed inset-0 flex z-40 lg:hidden" @close="open = false">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                <DialogOverlay class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                <div class="relative max-w-xs w-full bg-white shadow-xl pb-12 flex flex-col overflow-y-auto">
                    <div class="px-4 pt-5 pb-2 flex">
                        <button type="button" class="-m-2 p-2 rounded-md inline-flex items-center justify-center text-gray-400" @click="open = false">
                            <span class="sr-only">Close menu</span>
                            <XIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>

                    <!-- Links -->
                    <TabGroup as="div" class="mt-2">
                        <div class="border-b border-gray-200">
                            <TabList class="-mb-px flex px-4 space-x-8">
                                <Tab as="template" v-for="category in categories" :key="category.name" v-slot="{ selected }">
                                    <Link>{{category.name}}</Link>
                                </Tab>
                            </TabList>
                        </div>
                        <TabPanels as="template">
                            <TabPanel v-for="category in categories" :key="category.name" class="pt-10 pb-8 px-4 space-y-10">
                                <Link>{{category.name}}</Link>
                            </TabPanel>
                        </TabPanels>
                    </TabGroup>

                    <div class="border-t border-gray-200 py-6 px-4 space-y-6">
                        <div v-for="page in navigation.pages" :key="page.name" class="flow-root">
                            <Link :href="page.href" class="-m-2 p-2 block font-medium text-gray-900">{{ page.name }}</Link>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 py-6 px-4 space-y-6">
                        <div class="flow-root">
                            <Link href="/signin" class="-m-2 p-2 block font-medium text-gray-900">Sign in</Link>
                        </div>
                        <div class="flow-root">
                            <Link href="/signup" class="-m-2 p-2 block font-medium text-gray-900">Create account</Link>
                        </div>
                    </div>

                    <!-- Profile dropdown -->
                    <Menu as="div" class="relative ml-3 z-50" :class="user ? 'block relative ml-3 z-50': 'hidden relative ml-3 z-50'">
                        <div>
                            <MenuButton class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" :src="imagePath + image" alt="" />
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <MenuItem>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                                </MenuItem>
                                <MenuItem>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                                </MenuItem>
                                <MenuItem>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700">Sign out</a>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>

                    <div class="border-t border-gray-200 py-6 px-4">
                        <a href="#" class="-m-2 p-2 flex items-center">
                            <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt="" class="w-5 h-auto block flex-shrink-0" />
                            <span class="ml-3 block text-base font-medium text-gray-900"> CAD </span>
                            <span class="sr-only">, change currency</span>
                        </a>
                    </div>
                </div>
            </TransitionChild>
        </Dialog>
    </TransitionRoot>

    <header class="relative z-50">
        <!-- Top navigation -->
        <nav aria-label="Top" class="relative bg-white bg-opacity-90 backdrop-filter backdrop-blur-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-16 flex items-center">
                    <button type="button" class="bg-white p-2 rounded-md text-gray-400 lg:hidden" @click="open = true">
                        <span class="sr-only">Open menu</span>
                        <MenuIcon class="h-6 w-6" aria-hidden="true" />
                    </button>

                    <!-- Logo -->
                    <div class="ml-4 flex lg:ml-0">
                        <a href="#">
                            <span class="sr-only">Workflow</span>
                            <img class="h-16 w-auto" :src="logo" alt="" />
                        </a>
                    </div>

                    <!-- Flyout menus -->
                    <PopoverGroup class="hidden lg:ml-8 lg:block lg:self-stretch">
                        <div class="h-full flex space-x-8">
                            <Popover v-for="category in categories" :key="category.name" class="flex" v-slot="{ open }">
                                <div class="relative flex">
                                    <PopoverButton :class="[open ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-700 hover:text-gray-800', 'relative z-10 flex items-center transition-colors ease-out duration-200 text-sm font-medium border-b-2 -mb-px pt-px']">
                                        {{ category.name }}
                                    </PopoverButton>
                                </div>

                                <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
                                    <PopoverPanel class="absolute top-full inset-x-0 bg-white text-sm text-gray-500">
                                        <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                        <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true" />
                                        <!-- Fake border when menu is open -->
                                        <div class="absolute inset-0 top-0 h-px max-w-7xl mx-auto px-8" aria-hidden="true">
                                            <div :class="[open ? 'bg-gray-200' : 'bg-transparent', 'w-full h-px transition-colors ease-out duration-200']" />
                                        </div>
                                    </PopoverPanel>
                                </transition>
                            </Popover>

                            <Link v-for="page in navigation.pages" :key="page.name" :href="page.href" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{ page.name }}</Link>
                        </div>
                    </PopoverGroup>

                    <div class="ml-auto flex items-center">
                        <div :class="user ? 'hidden lg:hidden lg:flex-1 lg:items-center lg:justify-end lg:space-x-6' : 'hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6'">
                            <Link href="/signin" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</Link>
                            <span class="h-6 w-px bg-gray-200" aria-hidden="true" />
                            <Link href="/signup" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create account</Link>
                        </div>

                        <!-- Profile dropdown -->
                        <Menu as="div" :class="user ? 'block relative ml-3 z-50': 'hidden relative ml-3 z-50'">
                            <div>
                                <MenuButton class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" :src="imagePath + image" alt="" />
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute right-0 z-20 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                                    </MenuItem>
                                    <MenuItem>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                                    </MenuItem>
                                    <MenuItem>
                                        <Link as="button" method="post" href="/logout" class="block px-4 py-2 text-sm text-gray-700">Sign out</Link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>

                        <!-- Cart -->
                        <div class="ml-4 flow-root lg:ml-6">
                            <Link href="/cart" class="group -m-2 p-2 flex items-center">
                                <ShoppingBagIcon class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                                <span class="sr-only">items in cart, view bag</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>
<script>
import { ref } from 'vue'
import {
    Dialog,
    DialogOverlay, Menu, MenuButton, MenuItem, MenuItems,
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
import logo from '../../../assets/pink-logo.svg'

const navigation = {
    pages: [
        { name: 'Home', href: '/' },
        { name: 'Products', href: '/our-products' },
    ],
}
export default {
    components: {
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
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
    props: {
        categories: Array
    },
    computed: {
        user(){
            return this.$page.props.auth?.user
        },
        image() {
            return this.$page.props.auth?.user.image
        },
        imagePath() {
            return 'http://127.0.0.1:8000/storage/usersImages/'
        }
    },
    setup() {
        const open = ref(false)

        return {
            navigation,
            logo,
            open,
        }
    },
}
</script>
