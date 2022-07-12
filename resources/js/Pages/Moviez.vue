<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    user: String,
    hey: String,
})

</script>

<template>

<Head title="Moviez" />

<BreezeAuthenticatedLayout>

    <div>
        {{ hey }}
    </div>



</BreezeAuthenticatedLayout>


</template>
