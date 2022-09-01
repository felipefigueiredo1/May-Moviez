<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import MyMoviezCover from '@/Components/MyMoviezCover.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>
    <Head title="Home" />

    <div class=" flex justify-between bg-black dark:bg-gray-900 sm:items-center">
        <div class="left-0 p-4">
            <p class="text-red-600">May Moviez</p>
        </div>
        <div v-if="canLogin" class="px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-red-700 underline">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-red-700 underline">
                    Log in
                </Link>


                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-red-700 underline">
                    Register
                </Link>

            </template>

            <Link :href="route('teste')" class="ml-4 text-sm text-red-700 underline">
                Teste
            </Link>
        </div>
    </div>
    <div class="sm:items-center flex justify-center flex-wrap">
        <h1 style="font-size:50px;" class="max-w-7xl bg-black p-5 rounded-lg m-2 text-red-600"><strong>MyMoviez</strong></h1>
        <MyMoviezCover></MyMoviezCover>
    </div>

</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>
