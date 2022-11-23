<script>
import {Inertia} from "@inertiajs/inertia";
import Pagination  from '@/Components/Pagination.vue';
import ButtonComment from "@/Components/ButtonComment.vue";

export default {
    props: ['comments', 'user_id', 'post_user_id'],
    components: {
        ButtonComment,
        Pagination
    },
    methods: {
        deleteComment(id) {
            Inertia.delete('/comment/'+id,  {preserveState: false, preserveScroll: true})
        }
    }
}
</script>

<template>
    <div v-if="comments != null" class="mb-6">
        <div v-for="(comment, index) in comments.data" :key="index" class="bg-white rounded-lg my-2 border border-gray-400 p-1" id="body">
                <p class="text-red-700 font-bold ml-1">{{ comment.user.name }} <b class="text-gray-300 italic"> disse...</b></p>
                <p class="text-black ml-2 p-2">{{ comment.body }}</p>

            <div class="flex">
                <div v-if="comment.user.id == user_id || post_user_id == user_id" class="mt-1">
                    <form @submit.prevent="deleteComment(comment.id)">
                        <ButtonComment :value="comment.id" color="red" hover="red" title="tem certeza?" texto="Excluir"/>
                    </form>
                </div>
                <div class="mt-1">
                    <ButtonComment :value="comment.id" color="black" title="Responder esse comentário?" texto="Responder"/>
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
