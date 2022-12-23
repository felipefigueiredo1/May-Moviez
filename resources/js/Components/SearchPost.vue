<template>
        <form class="" @submit.prevent="form.post('/'+props.rota+'/buscando')">
            <input type="text" v-model="form.buscar" :placeholder="placeholder" name="buscar" class="text-white bg-dark-gray-sm focus:border-red-200 placeholder-white focus:ring-red-500 mr-1 py-0 w-full sm:w-96 rounded">
        </form>
</template>
<script>
import Button from '@/Components/Button.vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    props: {
        rota: String,
        placeholder: String
    },
    data() {
       return {
           form: this.$inertia.form({
               buscar: null
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
            this.form.post('/'+this.rota+'/buscando')
        },
    }

}
</script>

<style scoped>

</style>
