<template>
    <Transition>
        <div class="" v-if="show == true">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 md:gap-4 lg:gap-8 ">
                <div v-for="(post, index) in posts.data" :key="index" class="w-full rounded overflow-hidden shadow-lg h-auto mb-3" id="card">
                    <div class="px-6 py-4 w-full" >
                        <p class="text-sm italic mb-2 border p-1 border-gray-300 rounded text-white">{{ post.user.name }} <span class="text-gray-400 "> postou...</span></p>
                        <div v-if="post.linkImage">
                            <Link :href="route('post.show', post.id)"><img :src="post.linkImage" style="max-height:350px; width:330px;" class="rounded-lg"></Link>
                        </div>
                        <div class="font-bold text-xl text-white">
                            <Link :href="route('post.show', post.id)">{{ post.name }}</Link>
                        </div>
                        <div class="flex mt-3">
                            <div v-for="n in post.rating">
                                <span><img src="/img/star.png" style="height:15px;"></span>
                            </div>
                        </div>
                        <div class="text-gray-700 text-sm mt-3 text-white">
                            {{ post.body }}
                        </div>
                        <div class="flex mt-8" v-if="userOwner == post.user_id">
                            <div class="mr-2">
                                <form @submit.prevent="deletePost(post.id)">
                                    <button type="submit"><span class="font-bold text-red-700 text-sm" >Excluir</span></button>
                                </form>
                            </div>
                            <div class="mr-2">
                                <label for="post-modal" class="border-none text-white text-sm cursor-pointer"
                                @click="editPost(post)">
                                    Editar Post
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination :links="posts.links"/>
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
        carregar: Boolean,
        userOwner: String
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
        },
        editPost(post) {
            this.$emit("editPost", post)
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
#card, button, img, label {
    background: #242526
}
</style>
