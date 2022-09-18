<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Card from '@/Components/Card.vue'
import { Head } from '@inertiajs/inertia-vue3'
import Search from '@/Components/SearchPost.vue'

export default {
    components: {
        Head,
        BreezeAuthenticatedLayout,
        Card,
        Search
    },
    props: {
        user: String,
        posts: Object,
        postsSearch: Object,
        response: String
    }
}

</script>

<template>

<Head title="Moviez" />

<BreezeAuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Todas as análises
        </h2>
        <Search rota="moviez"/>
    </template>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <Card :posts="posts" :response="response"/>
    </div>
</BreezeAuthenticatedLayout>


</template>
