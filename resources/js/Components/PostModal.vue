<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Button from '@/Components/Button.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Button
    },
    data() {
        return {
            cover: '',
            capas: [],
        }
    },
    props: {
        user: String,
        errors: Object
    },
    setup() {
        const form = reactive({
            name: null,
            body: null,
            user_id: null,
            movie: null,
            rating: null,
        })

        function submit() {
            Inertia.post('/post', form)
        }

        return { form, submit }
    },
    mounted() {
        setTimeout(() => {
            this.form.user_id = this.user
        }, 500)
    },
    methods: {
        submitMovie() {
            self = this;

            self.covers(self.form.name);
        },
        set(){
            self = this;
            self.capas = [];
            self.cover.slice(0, 6).forEach(function(nome) {
                self.capas.push(nome)
            })
            console.log(self.form.name);
        },
        covers(param) {
            self = this;
            axios({
                method: 'GET',
                url: 'https://online-movie-database.p.rapidapi.com/auto-complete',
                params: {q: param},
                headers: {
                    'X-RapidAPI-Key': '26d3cdf5a6msh6299f99dec84365p1a7ab9jsnee627a64833e',
                    'X-RapidAPI-Host': 'online-movie-database.p.rapidapi.com'
                }
            }).then(function (response) {
                self.cover = response.data.d;
                self.set();
            })
        }
    },
}

</script>

<template>
    <input type="checkbox" id="post-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box relative">
            <label for="post-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <label class="mr-1" for="name"><strong>Título:</strong></label>
            <input type="text"  class="input input-bordered w-full max-w input-sm" id="name" v-model="form.name">
            <div v-if="errors.name"><span class="font-bold text-red-700">{{ errors.name }}</span></div>
            <form @submit.prevent="submit" class="mt-4" id="post_form">
                <div class="">
                    <label for="body" class="mr-1"><strong>Descrição: </strong></label>
                    <div>
                        <textarea name="body"
                                  class="textarea  input-bordered w-full max-w"
                                  v-model="form.body">
                        </textarea>
                        <div v-if="errors.body"><span class="font-bold text-red-700">{{ errors.body }}</span></div>
                    </div>
                </div>
                <div class="mb-2">
                    <label><strong>Nota!</strong></label>
                    <div class="flex justify-between w-60">
                        <select v-model="form.rating" class="select input-bordered w-full max-w-xs select-md">
                            <option disabled selected>Selecione</option>
                            <option value="0">0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div v-if="errors.rating"><span class="font-bold text-red-700">{{ errors.rating }}</span></div>
                </div>
            </form>
            <div class="modal-action">
                <Button type="submit" form="post_form">Enviar</Button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
