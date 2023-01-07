<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'


export default {
    data() {
        return {
            carregarCard: false,
            dadosPostEditar: {}
        }
    },
    components: {
        Head,
        BreezeAuthenticatedLayout,
        Link,
    },
    props: {
        user: String,
        posts: Object,
        errors: Object,
        userId: Number,
        search: String,
    },
    methods: {
        pegarDadosPost(event) {
            this.dadosPostEditar = event
        },

        removeDadosPost() {
            this.dadosPostEditar = {}
        }
    },
    mounted() {
        this.$swal('Hello Vue world!!!');
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-center flex-wrap">
                <div v-if="$page.props.flash.message"  class="px-2 text-sm
                     font-bold border border-red-800 bg-red-500 text-white">
                    {{ $page.props.flash.message }}
                </div>
            </div>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
