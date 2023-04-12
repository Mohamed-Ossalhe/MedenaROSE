<template>
    <div class="min-h-full flex">
        <slot/>
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" :src="image" alt="" />
        </div>
    </div>
</template>

<script>
import image from "../../assets/Hero/1.png"
export default {
    name: "AuthLayout",
    data() {
        return {
            image: image
        }
    }
}
</script>

<style scoped>

</style>
