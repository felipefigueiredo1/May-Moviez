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
            Inertia.delete('/comment/'+id)
        }
    }
}
</script>

<template>
    <div>
        <div v-for="(comment, index) in comments.data" :key="index">
            <p>{{ comment.user.name }}</p>
            <p>{{ comment.body }}</p>
            <div v-if="comment.user.id == user_id || post_user_id == user_id">
                <form @submit.prevent="deleteComment(comment.id)">
                    <button :value="comment.id">Excluir</button>
                </form>
            </div>
        </div>
        <Pagination :links="comments.links" />
    </div>


</template>

<style scoped>
div{

}
p{
    padding: 5px;
}
</style>
