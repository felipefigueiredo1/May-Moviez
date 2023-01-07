<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1 justify-center">
            <template v-for="(link, key) in links"  :key="key" >
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-red-600 font-extrabold border rounded" v-html="link.label" />
                <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border text-red-600 font-bold font-extrabol rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" ></Link>
            </template>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';


export default {
    props: {
        links: Array,
    },
    components : {
        Link
    }
}
</script>
