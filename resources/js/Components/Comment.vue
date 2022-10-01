<script>
import {Inertia} from "@inertiajs/inertia";
import Pagination  from '@/Components/Pagination.vue';

export default {
    props: ['comments', 'user_id', 'post_user_id'],
    components: {
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
        <div v-for="(comment, index) in comments.data" :key="index" class="bg-gray-400 rounded-lg my-2" id="body">
                <p class="text-red-700 font-bold">{{ comment.user.name }}</p>
                <p class="text-white ml-2 p-2">{{ comment.body }}</p>

            <div v-if="comment.user.id == user_id || post_user_id == user_id">
                <form @submit.prevent="deleteComment(comment.id)">
                    <button :value="comment.id" class="text-red-700 ml-2 p-2 hover:text-white hover:transition hover:duration-1000 duration-1000">Excluir</button>
                </form>
            </div>
        </div>
        <Pagination :links="comments.links" />
    </div>


</template>

<style scoped>
#body{
background: #242526;
}
p{
    padding: 5px;
}
</style>
