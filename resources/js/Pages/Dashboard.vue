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
        posts: Array,
        errors: Object,
        userId: String,
    },
}
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <Search rota="dashboard" placeholder="Buscar minhas análises"/>

                <label for="post-modal" class="btn btn-sm font-bold border border-red-800 btn-sm bg-red-500 cursor-pointer">Novo Post</label>
            </div>
            <PostModal :errors="errors" :user="userId"/>
        </template>
        <div>

        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" style="background: #EDF4F5">
                        Bem vindo ao May Moviez <span class="text-red-700"><strong>{{ user }}</strong></span> !
                    </div>
                </div>
                <h3 class="text-center p-3 text-red-600"><strong>Suas analises</strong></h3>
                <Card :posts="posts" :carregar="carregarCard"/>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
