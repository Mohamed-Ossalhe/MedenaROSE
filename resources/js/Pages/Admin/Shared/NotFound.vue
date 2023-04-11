<template>
    <div class="flex flex-col items-center justify-center">
        <img class="h-64 mt-10" :src="noFileFound" alt="">
        <h2 class="capitalize text-lg text-red-900"><slot/></h2>
        <Link v-if="buttonText" :href="toLink" class="py-2 px-4 rounded bg-primary hover:bg-primary/80 focus:ring-primary/50 text-white mt-4" v-text="buttonText"></Link>
    </div>
</template>

<script>
import noFileFound from "../../../../assets/Dashboard/no-file-found.jpg";

export default {
    name: "NotFound",
    data() {
        return {
            // TODO: Fix the sort default value after refresh
            noFileFound: noFileFound,
        }
    },
    props: {
        toLink: String,
        buttonText: String
    }
}
</script>

<style scoped>

</style>
