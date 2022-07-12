<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
defineProps({
    user: String,
    posts: Array,
})
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Bem vindo ao maravilhoso May Moviez <span class="text-blue-500"><strong>{{ user }}</strong></span> !
                    </div>
                </div>
                <h3 class="text-center p-3 text-red-400"><strong>Analises abaixo</strong></h3>
                <div v-for="(post, index) in posts" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   <p class="p-2">  Análise:  {{index}} - {{ post.name }}</p>
                    <div v-for="comment in post.comments">
                        <p class="p-2 ">Comentários: <span class="text-blue-500">{{ comment.name }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
