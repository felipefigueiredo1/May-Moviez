<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import RichardLogo from '@/Components/RichardLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <Link href="/">
                <!--<BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />-->
                <RichardLogo class="w-20 h-20 fill-current text-gray-500 rounded-lg" />
            </Link>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 dark:bg-gray-700 shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
