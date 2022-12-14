<template>
    <Transition>
        <div class="" v-if="show == true">
            <div class="grid grid-cols-3 gap-8 ">
                <div v-for="(post, index) in posts.data" :key="index" class="max-w-sm rounded overflow-hidden shadow-lg bg-white h-auto mb-3" >
                    <div class="px-6 py-4">
                        <p class="text-sm italic mb-2 border p-1 border-gray-300 rounded">{{ post.user.name }} <span class="text-gray-400 "> postou...</span></p>
                        <div v-if="post.linkImage">
                            <Link :href="route('post.show', post.id)"><img :src="post.linkImage" style="max-height:350px; width:330px;" class="rounded-lg"></Link>
                        </div>
                        <div class="font-bold text-xl ">
                            <Link :href="route('post.show', post.id)">{{ post.name }}</Link>
                        </div>
                        <div class="flex mt-3">
                            <div v-for="n in post.rating">
                                <span><img src="/img/star.png" style="height:15px;"></span>
                            </div>
                        </div>

                        <div class="text-gray-700 text-sm mt-3">
                            {{ post.body }}
                        </div>
                        <div class="flex">
                            <div class="mr-2">
                                <form @submit.prevent="deletePost(post.id)">
                                    <button type="submit"><span class="font-bold text-red-700 text-sm">Excluir</span></button>
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
    </Transition>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue'

export default {
    name: "Card",
    data() {
        return {
            id: '',
            show: false
        }
    },
    components: {
        Link,
        Pagination
    },
    props: {
        posts: Object,
        response: String,
        carregar: Boolean
    },
    mounted() {
        this.setId();

        setTimeout(() => this.show = true, 100);
    },
    methods: {
        deletePost($id) {
            this.$inertia.delete('/post/'+$id)
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
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

</style>
