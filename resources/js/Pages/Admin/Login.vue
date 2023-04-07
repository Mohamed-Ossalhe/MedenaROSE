<template>
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-32 w-auto" src="../../../assets/pink-logo.svg" alt="Workflow" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Admin Panel</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700"> Email address </label>
                        <div class="mt-1">
                            <input id="email" v-model="formData.email" name="email" type="email" autocomplete="email" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <p v-if="formData.errors.email" v-text="formData.errors.email" class="text-red-500 text-sm"></p>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                        <div class="mt-1">
                            <input id="password" v-model="formData.password" name="password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <p v-if="formData.errors.password" v-text="formData.errors.password" class="text-red-500 text-sm"></p>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <Footer/>
</template>
<script>
import { useForm } from "@inertiajs/vue3";
import Footer from "@/Pages/Admin/Shared/Footer.vue";
export default {
    data() {
        return {
            formData: useForm({
                email: '',
                password: ''
            })
        }
    },
    components: {
        Footer
    },
    methods: {
        submit() {
            this.formData.post('/admin-login')
        }
    }
}
</script>
<style></style>
