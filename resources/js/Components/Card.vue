<template>
    <div class="">
        <div class="flex flex-wrap">
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-1 w-96 h-auto " v-for="(post, index) in posts.data" :key="index" >
                <div class="px-6 py-4">
                    <div v-if="post.linkImage">
                        <Link :href="route('post.show', post.id)"><img :src="post.linkImage" style="max-height:380px; width:330px;" class="rounded-lg"></Link>
                    </div>
                    <div class="font-bold text-xl ">
                        <Link :href="route('post.show', post.id)">{{ post.name }}</Link>
                    </div>
                    <div class="flex">
                        <div v-for="n in post.rating">
                            <span><img src="/img/star.png" style="height:15px;"></span>
                        </div>
                    </div>

                    <div class="text-gray-700 text-base">
                        {{ post.body }}
                    </div>
                    <div class="flex">
                        <div class="mr-2">
                            <form @submit.prevent="deletePost(post.id)">
                                <button type="submit"><span class="font-bold text-red-700">Excluir</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<!--            <div class="px-6 pt-4 pb-2">-->
<!--                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>-->
<!--                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>-->
<!--                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>-->
<!--            </div>-->
        </div>
        <Pagination :links="posts.links" />
    </div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue'

export default {
    name: "Card",
    data() {
        return {
            id: '',
        }
    },
    components: {
        Link,
        Pagination
    },
    props: {
        posts: Object,
        response: String
    },
    mounted() {
        this.setId();
    },
    methods: {
        deletePost($id) {
            this.$inertia.delete('post/'+$id)
        },
        setId() {
            this.id = this.posts.id
        }
    }
}
</script>

<style scoped>
.flex > div {
    background: #EDF4F5
}
</style>
