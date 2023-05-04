<template>
    <div class="wrapper grid grid-cols-1 md:grid-cols-5">
        <div class="mt-6 md:col-start-2 md:col-end-5 px-4">
            <h1 class="text-xl my-3">Profile</h1>
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
                        <img v-if="formData.image" class="h-12 w-12 rounded-full" :src="(previewImage ? previewImage : imagePath + formData.image)" alt="">
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
                    <label for="password" class="block text-sm font-medium text-gray-700"> Old Password </label>
                    <div class="mt-1">
                        <input v-model="formData.old_password" id="password" name="password" type="password" autocomplete="current-password"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                    </div>
                    <p v-if="formData.errors.old_password" v-text="formData.errors.old_password" class="text-sm text-red-500"></p>
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

                <div class="flex gap-4">
                    <button type="submit" class="w-1/2 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white border border-indigo-500 hover:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">Cancel</button>
                    <button type="submit" class="w-1/2 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "@/Pages/Client/Shared/DefaultLayout.vue";
import SelectMenu from "@/Shared/SelectMenu.vue";
import {useForm} from "@inertiajs/vue3";
import {cities, regions} from "morocco-cities";

export default {
    layout: DefaultLayout,
    components: {SelectMenu},
    data() {
        return {
            formData: useForm({
                name: this.user.name,
                image: null,
                email: this.user.email,
                old_password: '',
                password: '',
                password_confirmation: '',
                birth_date: this.user.birth_date,
                phone_number: this.user.phone_number,
                region: this.user.region,
                city: this.user.city,
                zip_code: this.user.zip_code,
                street_address: this.user.street_address
            }),
            previewImage: '',
            cities: []
        }
    },
    props: {
        user: Object
    },
    computed: {
        image() {
            return this.$page.props.auth?.user.image
        },
        imagePath() {
            return 'http://127.0.0.1:8000/storage/usersImages/'
        },
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
            this.formData.patch('/profile/' + this.user.id)
        }
    },
    setup() {
        return {
            regions
        }
    }
}
//import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid'
</script>
