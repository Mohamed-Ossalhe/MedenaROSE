<template>
    <Head title="Sign up" />
    <div class="min-h-full flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <div class="flex items-center">
                        <img class="h-16 w-auto" :src="MedenaRoseLogo" alt="Workflow" />
                        <div>
                            <h1 class="text-2xl font-medium text-primary">MedenaROSE</h1>
                            <p class="text-sm">Medenarose Quality you can see.</p>
                        </div>
                    </div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Sign up for a free account</h2>
                </div>

                <div class="mt-8">
<!--                    <div>-->
<!--                        <div>-->
<!--                            <p class="text-sm font-medium text-gray-700">Sign in with</p>-->

<!--                            <div class="mt-1 grid grid-cols-3 gap-3">-->
<!--                                <div>-->
<!--                                    <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">-->
<!--                                        <span class="sr-only">Sign in with Facebook</span>-->
<!--                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">-->
<!--                                            <path fill-rule="evenodd" d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd" />-->
<!--                                        </svg>-->
<!--                                    </a>-->
<!--                                </div>-->

<!--                                <div>-->
<!--                                    <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">-->
<!--                                        <span class="sr-only">Sign in with Twitter</span>-->
<!--                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">-->
<!--                                            <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />-->
<!--                                        </svg>-->
<!--                                    </a>-->
<!--                                </div>-->

<!--                                <div>-->
<!--                                    <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">-->
<!--                                        <span class="sr-only">Sign in with GitHub</span>-->
<!--                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">-->
<!--                                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />-->
<!--                                        </svg>-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="mt-6 relative">-->
<!--                            <div class="absolute inset-0 flex items-center" aria-hidden="true">-->
<!--                                <div class="w-full border-t border-gray-300" />-->
<!--                            </div>-->
<!--                            <div class="relative flex justify-center text-sm">-->
<!--                                <span class="px-2 bg-white text-gray-500"> Or continue with </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="mt-6">
                        <form @submit.prevent="onSubmit" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700"> Full Name </label>
                                <div class="mt-1">
                                    <input v-model="formData.name" id="name" name="name" type="text" autocomplete="name"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                                <p v-if="formData.errors.name" v-text="formData.errors.name" class="text-sm text-red-500"></p>
                            </div>

                            <div>
                                <p class="block text-sm font-medium text-gray-700"> Photo </p>
                                <div class="mt-1 flex items-center">
                                    <img v-if="formData.image" class="h-12 w-12 rounded-full" :src="previewImage" alt="">
                                    <span v-else class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                          <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                    <label for="photo" type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">Change</label>
                                    <input v-on:change="onSelectImage" name="image" class="hidden" id="photo" type="file" aria-hidden="true">
                                </div>
                                <p v-if="formData.errors.image" v-text="formData.errors.image" class="text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700"> Email address </label>
                                <div class="mt-1">
                                    <input v-model="formData.email" id="email" name="email" type="email" autocomplete="email"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                                <p v-if="formData.errors.email" v-text="formData.errors.email" class="text-sm text-red-500"></p>
                            </div>

                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                                <div class="mt-1">
                                    <input v-model="formData.password" id="password" name="password" type="password" autocomplete="current-password"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                                <p v-if="formData.errors.password" v-text="formData.errors.password" class="text-sm text-red-500"></p>
                            </div>

                            <div class="space-y-1">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700"> Confirm Password </label>
                                <div class="mt-1">
                                    <input v-model="formData.password_confirmation" id="password_confirmation" name="password_confirmation" type="password" autocomplete="password_confirmation" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                            </div>

                            <div>
                                <label for="birth_date" class="block text-sm font-medium text-gray-700"> Birth Date </label>
                                <div class="mt-1">
                                    <input v-model="formData.birth_date" id="birth_date" name="birth_date" type="date" autocomplete="birth_date"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                                <p v-if="formData.errors.birth_date" v-text="formData.errors.birth_date" class="text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700"> Phone Number </label>
                                <div class="mt-1">
                                    <input v-model="formData.phone_number" id="phone_number" pattern="[]" name="phone_number" type="number" autocomplete="phone_number"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                                <p v-if="formData.errors.phone_number" v-text="formData.errors.phone_number" class="text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label for="region" class="block text-sm font-medium text-gray-700"> Region </label>
                                <div class="mt-1">
                                    <SelectMenu :list="regions" :onSelectChange="onSelectRegion"/>
                                </div>
                                <p v-if="formData.errors.region" v-text="formData.errors.region" class="text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700"> City </label>
                                <div class="mt-1">
                                    <select v-on:change="onSelectCity" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                        <option v-if="formData.region" v-for="city in cities" :value="city">{{ city }}</option>
                                    </select>
                                </div>
                                <p v-if="formData.errors.city" v-text="formData.errors.city" class="text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label for="zip_code" class="block text-sm font-medium text-gray-700"> Zip Code </label>
                                <div class="mt-1">
                                    <input v-model="formData.zip_code" id="zip_code" name="zip_code" type="number" autocomplete="zip_code"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                                <p v-if="formData.errors.zip_code" v-text="formData.errors.zip_code" class="text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700"> Street Address </label>
                                <div class="mt-1">
                                    <input v-model="formData.street_address" id="address" name="address" type="text" autocomplete="address"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                                <p v-if="formData.errors.street_address" v-text="formData.errors.street_address" class="text-sm text-red-500"></p>
                            </div>

                            <div>
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">Sign in</button>
                            </div>
                        </form>
                        <p class="text-md mt-3 text-center capitalize">Already have an account? come <Link href="/signin" class="text-primary underline decoration-dashed">Sign in</Link></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import AuthLayout from "@/Shared/AuthLayout.vue";
import SelectMenu from "@/Shared/SelectMenu.vue";
import MedenaRoseLogo from "../../../assets/pink-logo.svg";
import {useForm} from "@inertiajs/vue3";
import {cities, regions} from "morocco-cities";

export default {
    name: "Signup",
    components: {SelectMenu},
    layout: AuthLayout,
    data() {
        return {
            MedenaRoseLogo: MedenaRoseLogo,
            formData: useForm({
                name: '',
                image: null,
                email: '',
                password: '',
                password_confirmation: '',
                birth_date: '',
                phone_number: '',
                region: '',
                city: '',
                zip_code: '',
                street_address: ''
            }),
            previewImage: '',
            cities: [],
            toast: useToast()
        }
    },
    methods: {
        onSelectImage: function(e) {
            this.formData.image = e.target.files[0]
            this.previewImage = URL.createObjectURL(this.formData.image)
        },
        onSelectRegion: function(e) {
            this.formData.region = e.target.value
            for(let region of regions) {
                if(region.name === e.target.value) {
                    this.cities = region.cities_list
                }
            }
        },
        onSelectCity: function(e) {
            this.formData.city = e.target.value
        },
        onSubmit: function () {
            this.formData.post('/signup')
        }
    },
    setup() {
        return {
            regions
        }
    }
}
</script>

<style scoped>

</style>
