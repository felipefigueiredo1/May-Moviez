<template>
        <form class="mt-4" @submit.prevent="form.post('/'+props.rota+'/buscando')">
            <label for="buscar">Buscar: </label>
            <input type="text" v-model="form.buscar" :placeholder="placeholder" name="buscar" class="focus:border-red-200 focus:ring-red-500 mr-1 w-full sm:w-96 rounded mb-2">
            <Button type="submit">Pesquisar</Button> 
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
    // setup (props) {
    //     const form = useForm({
    //         buscar: null,
    //     })
    //
    //     const teste = function send() {
    //     }
    //
    // return {form, teste}
    // },
    components: {
        Button
    },
    watch: {
        //'form.buscar': 'send',

        'form.buscar': {
            handler() {
                this.send()
            },
            //handler: 'sendHandler',
            // deep:true,
        }
    },
    methods: {
        send() {
            this.form.post('/'+this.rota+'/buscando')
        },
        sendHandler() {
            console.log('zacarias')
        }
    }

}
</script>

<style scoped>

</style>
