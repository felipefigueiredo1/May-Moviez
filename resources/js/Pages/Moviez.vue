<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Card from '@/Components/Card.vue'
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Head,
        BreezeAuthenticatedLayout,
        Card
    },
    props: {
        user: String,
        posts: Object,
        response: String
    }
}

</script>

<template>

<Head title="Moviez" />

<BreezeAuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Postagens
        </h2>
    </template>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <Card :posts="posts" :response="response"/>
    </div>
</BreezeAuthenticatedLayout>


</template>
