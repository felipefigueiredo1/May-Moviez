<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Card from '@/Components/Card.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Search from '@/Components/SearchPost.vue'
import PostModal from '@/Components/PostModal.vue'


export default {
    data() {
        return {
            carregarCard: false
        }
    },
    components: {
        PostModal,
        Head,
        BreezeAuthenticatedLayout,
        Card,
        Link,
        Search
    },
    props: {
        user: String,
        posts: Object,
        errors: Object,
        userId: Number,
    },
}
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <Search rota="dashboard" placeholder="Buscar minhas análises"/>

                <div>
                    <label for="post-modal" class="btn-sm mx-2
                     font-bold border border-red-800 bg-red-500 cursor-pointer text-white">
                        Novo Post</label>
                </div>
                <div v-if="$page.props.flash.message"  class="ml-4 bg-red-500 px-1 rounded font-bold">
                    {{ $page.props.flash.message }}
                </div>
            </div>
            <PostModal :errors="errors" :user="userId"/>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3 class="text-center p-3 text-red-600"><strong>Suas analises</strong></h3>
                <Card :posts="posts" :carregar="carregarCard"/>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
