<template>
        <form @submit.prevent="form.get('/'+props.rota)">
            <input type="text" v-model="form.buscar" :placeholder="placeholder" name="buscar" class="text-white bg-dark-gray-sm focus:border-red-200 placeholder-white focus:ring-red-500 mr-1 py-0 w-full sm:w-96 rounded">
        </form>
</template>
<script>
import Button from '@/Components/Button.vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    props: {
        rota: String,
        placeholder: String,
        search: String,
    },
    data() {
       return {
           form: this.$inertia.form({
               buscar: this.search
           })
       }
    },
    components: {
        Button
    },
    watch: {
        'form.buscar': {
            handler() {
                this.send()
            },
        }
    },
    methods: {
        send() {
            this.form.get('/'+this.rota, {preserveState: true})
        },
    }

}
</script>

<style scoped>

</style>
