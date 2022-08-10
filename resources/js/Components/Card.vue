<template>
    <div class="flex">
        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-1" v-for="(post, index) in posts" :key="index">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">
                    <Link :href="route('post.show', post.id)">{{ post.name }}</Link>
                </div>
                <div class="text-gray-700 text-base">
                    {{ post.body }}
                </div>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
            </div>
        </div>
    </div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: "Card",
    components: {
        Link
    },
    props: {
        posts: Object,
        response: String
    },
    methods: {

    }
}
</script>

<style scoped>
.flex > div {
    background: #EDF4F5
}
</style>
