<template>
    <form @submit.prevent="submit">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900 my-5">New Category</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Category Name</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" v-model="formData.name" name="name" id="name" autocomplete="name" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Cartegory name" />
                            </div>
                            <p v-if="formData.errors.name" v-text="formData.errors.name" class="text-red-500 text-sm"></p>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Category Description</label>
                        <div class="mt-2">
                            <textarea id="description" v-model="formData.description" name="description" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" />
                            <p v-if="formData.errors.description" v-text="formData.errors.description" class="text-red-500 text-sm"></p>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about the category.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <div class="col-span-full">
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <img v-if="formData.image" class="h-24 w-full" :src="previewImage" alt="">
                                        <PhotographIcon v-else class="mx-auto h-12 w-12 text-gray-300" aria-hidden="true" />
                                        <div class="mt-4 flex items-center text-sm leading-6 text-gray-600">
                                            <label for="file-upload" class="relative text-center cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="file-upload" v-on:change="onImageSelected" name="file-upload" type="file" class="sr-only" />
                                            </label>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                                <p v-if="formData.errors.image" v-text="formData.errors.image" class="text-red-500 text-sm"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <Link href="/categories" class="text-sm font-semibold leading-6 text-gray-900">Cancel</Link>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</template>

<script>
import { PhotographIcon} from "@heroicons/vue/solid";
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import {useForm} from "@inertiajs/vue3";

export default {
    name: "AddCategoryForm",
    layout: Layout,
    data() {
        return {
            formData: useForm({
                name: '',
                description: '',
                image: null
            }),
            previewImage: ''
        }
    },
    components: {
        PhotographIcon
    },
    methods: {
        onImageSelected(e) {
            this.formData.image = e.target.files[0]
            this.previewImage = URL.createObjectURL(e.target.files[0])
        },
        submit() {
            this.formData.post('/admin/categories')
        }
    }
}
</script>

<style scoped>

</style>
