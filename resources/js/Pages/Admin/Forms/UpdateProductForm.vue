<template>
    <form @submit.prevent="submit">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900 my-5">Update Product: {{ product.name }} #{{ product.id}}</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" v-model="formData.name" name="name" id="name" autocomplete="name" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Product name" />
                            </div>
                            <p v-if="formData.errors.name" v-text="formData.errors.name" class="text-red-500 text-sm"></p>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Product Description</label>
                        <div class="mt-2">
                            <textarea id="description" v-model="formData.description" :aria-placeholder="product.description" name="description" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" />
                        </div>
                        <p v-if="formData.errors.description" v-text="formData.errors.description" class="text-red-500 text-sm"></p>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about the Product.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category" v-on:change="onSelectChange" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option v-for="category in categories" v-text="category.name" :value="category.id" :selected="product.category_id === category.id"></option>
                        </select>
                        <p v-if="formData.errors.category_id" v-text="formData.errors.category_id" class="text-sm text-red-500"></p>
                    </div>

<!--                    <div class="col-span-full">-->
<!--                        <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photos</label>-->
<!--                        <div class="mt-2 flex items-center gap-x-3">-->
<!--                            <div class="col-span-full">-->
<!--                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">-->
<!--                                    <div class="text-center">-->
<!--                                        <div v-if="formData.image" class="flex items-center gap-1">-->
<!--                                            <div v-for="image in previewImages" class="relative">-->
<!--                                                <XCircleIcon class="absolute -top-5 right-0 mx-auto h-5 w-5 text-red-600 cursor-pointer" @click="()=>removeImage(image)" />-->
<!--                                                <img class="h-24 w-full" :src="image" alt="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <PhotographIcon v-else class="mx-auto h-12 w-12 text-gray-300" aria-hidden="true" />-->
<!--                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">-->
<!--                                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">-->
<!--                                                <span>Upload a files</span>-->
<!--                                                <input id="file-upload" v-on:change="onImageSelect" name="file-upload" type="file" class="sr-only" multiple />-->
<!--                                            </label>-->
<!--                                        </div>-->
<!--                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <p v-if="formData.errors.image" v-text="formData.errors.image" class="text-red-500 text-sm"></p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="sm:col-span-4">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Product Price</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="number" name="price" v-model="formData.price" id="price" autocomplete="price" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Product Price" />
                            </div>
                        </div>
                        <p v-if="formData.errors.price" v-text="formData.errors.price" class="text-red-500 text-sm"></p>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="quatity" class="block text-sm font-medium leading-6 text-gray-900">Product Quantity</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="number" name="quatity" v-model="formData.quantity" id="quatity" autocomplete="quatity" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Product Price" />
                            </div>
                        </div>
                        <p v-if="formData.errors.quantity" v-text="formData.errors.quantity" class="text-red-500 text-sm"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <Link href="/admin/products" class="text-sm font-semibold leading-6 text-gray-900">Cancel</Link>
            <button type="submit" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary/50">Update</button>
        </div>
    </form>
</template>

<script>
import {PhotographIcon} from "@heroicons/vue/solid";
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import {useForm} from "@inertiajs/vue3";
import {XCircleIcon} from "@heroicons/vue/outline";
import {ref} from "vue";

export default {
    name: "UpdateProductForm",
    layout: Layout,
    data() {
        return {
            formData:useForm({
                name: this.product.name,
                description: this.product.description,
                //image: this.product.image,
                price: this.product.price,
                quantity: this.product.quantity,
                category_id: this.product.category_id
            }),
            previewImages: []
        }
    },
    props: {
        categories: Array,
        product: Object
    },
    components: {
        PhotographIcon,
        XCircleIcon
    },
    methods: {
        onImageSelect(e) {
            this.formData.image = e.target.files
            for (let image of this.formData.image) {
                this.previewImages.push(URL.createObjectURL(image))
            }
        },
        onSelectChange(e) {
            this.formData.category_id = e.target.value
        },
        submit() {
            //console.log(this.formData);
            this.formData.patch(`/admin/products/${this.product.id}`)
        },
        removeImage(image) {
            //this.formData.image = Array.from(this.formData.image).filter((e) => e !== URL.revokeObjectURL(image))
            let imageUrl = this.previewImages.find((previewImage) => previewImage === image);
            this.previewImages = this.previewImages.filter((e) => e !== image)
            this.formData.image = Array.from(this.formData.image).filter((file) => {
                const fileUrl = URL.createObjectURL(file);
                const shouldRemove = fileUrl === imageUrl;
                if (shouldRemove) {
                    URL.revokeObjectURL(fileUrl);
                }
                return !shouldRemove;
            });
            console.log(this.formData.image)
        }
    }
}
</script>

<style scoped>

</style>
