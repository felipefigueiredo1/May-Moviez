<script>
import {Inertia} from "@inertiajs/inertia";
import Pagination  from '@/Components/Pagination.vue';
import ButtonComment from "@/Components/Post/Comment/Button.vue";

export default {
    props: ['comments', 'user_id', 'post_user_id'],
    components: {
        ButtonComment,
        Pagination
    },
    data() {
        return {
            form: this.$inertia.form({
                user_id: null,
                comment_id: null,
            }),
        }
    },
    methods: {
        deleteComment(id) {
            Inertia.delete('/comment/'+id,  {preserveState: false, preserveScroll: true})
        },
        likeComment(id) {
            this.form.comment_id = id;
            this.form.user_id = this.user_id;
            this.form.post('/commentLike');
        },
        dislikeComment(likes) {
            const commentId = likes.filter(like => like.user_id === this.user_id);
            this.form.delete('/commentLike/'+commentId[0].id);
        },
        alreadyLiked(likes) {
            return  likes.some(like => like.user_id === this.user_id);
        }
    }
}
</script>

<template>
    <div v-if="comments != null" class="mb-6">
        <div v-for="(comment, index) in comments.data" :key="index" class="bg-dark-gray-es rounded-lg my-2 p-1" id="body">
                <div class="flex items-center">
                    <p class="text-red-700 font-bold ml-1">{{ comment.user.name }} </p>
                    <span class="italic text-gray-500"> disse...</span>
                </div>
                <p class="text-white ml-2 p-2 mt-2">{{ comment.body }}</p>

            <div class="flex mt-2 items-center gap-2">
                <div v-if="comment.user.id == user_id || post_user_id == user_id" class="mt-1">
                    <form @submit.prevent="deleteComment(comment.id)">
                        <ButtonComment :value="comment.id" color="text-red-600" title="tem certeza?" texto="Excluir"/>
                    </form>
                </div>
                <div class="mt-1">
                    <ButtonComment :value="comment.id" color="text-white" title="Responder esse comentário?" texto="Responder"/>
                </div>
                <div class="flex gap-2 text-white">
                    <form @submit.prevent="likeComment(comment.id)" v-if="!alreadyLiked(comment.comment_likes)">
                        <button type="submit"><i class="fa-regular fa-thumbs-up cursor-pointer" ></i></button>
                    </form>
                    <form @submit.prevent="dislikeComment(comment.comment_likes)" v-else>
                        <button type="submit"><i class="fa-regular fa-thumbs-down cursor-pointer" ></i></button>
                    </form>
                    {{ comment.comment_likes.length }}
                </div>
            </div>
        </div>
        <Pagination :links="comments.links" />
    </div>


</template>

<style scoped>
p{
    padding: 5px;
}
</style>
