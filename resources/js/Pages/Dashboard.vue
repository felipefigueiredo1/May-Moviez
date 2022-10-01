<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Card from '@/Components/Card.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Search from '@/Components/SearchPost.vue'


export default {
    components: {
        Head,
        BreezeAuthenticatedLayout,
        Card,
        Link,
        Search
    },
    props: {
        user: String,
        posts: Array
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <Search rota="dashboard" placeholder="Buscar minhas análises"/>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" style="background: #EDF4F5">
                        Bem vindo ao May Moviez <span class="text-red-700"><strong>{{ user }}</strong></span> !
                    </div>
                </div>
                <h3 class="text-center p-3 text-red-600"><strong>Suas analises</strong></h3>
<!--                {{ posts }}-->
                <Card :posts="posts"/>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
