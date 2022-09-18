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

<Head title="Novo post" />

<BreezeAuthenticatedLayout>

    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Post
        </h2>
    </template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg" id="div-form">

                <div class="p-6 border-b border-gray-200">
                    <div class="">
                        <label class="mr-1"><strong>Título:</strong></label>
                        <form @submit.prevent="submitMovie">
                            <input type="text" class="focus:border-red-200 focus:ring-red-500 mr-1 w-full sm:w-96 rounded" id="name" v-model="form.name">
                            <Button :type="submit" class="mt-2">Pesquisar Capa</Button>
                        </form>
                        <div v-if="errors.name"><span class="font-bold text-red-700">{{ errors.name }}</span></div>
                    </div>
                    <div class="flex justify-between flex-wrap">
                        <div v-for="(capa, index) in capas" :key="index">
                            <div v-if="capa.hasOwnProperty('i')" class="flex flex-col justify-center">
                                <h2 class="text-center">{{ capa.l }}</h2>
                                <img :src="capa.i.imageUrl" class="object-contain h-48 rounded-sm">
                                <div class="flex justify-center">
                                    <input type="radio" v-model="form.movie" name="movie" :value="capa">
                                </div>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="">
                            <label for="body" class="mr-1"><strong>Descrição: </strong></label>
                            <div>
                                <textarea name="body" class="focus:border-red-200 rounded focus:ring-red-500 w-full sm:w-96" rows="4" v-model="form.body"></textarea>
                                <div v-if="errors.body"><span class="font-bold text-red-700">{{ errors.body }}</span></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label><strong>Nota!</strong></label>
                            <div class="flex justify-between w-60">
                                <div>
                                    0 <input type="radio" v-model="form.rating" name="nota" value="0">
                                </div>
                                <div>
                                    1 <input type="radio" v-model="form.rating" name="nota" value="1">
                                </div>
                                <div>
                                    2 <input type="radio" v-model="form.rating" name="nota" value="2">
                                </div>
                                <div>
                                    3 <input type="radio" v-model="form.rating" name="nota" value="3">
                                </div>
                                <div>
                                    4 <input type="radio" v-model="form.rating" name="nota" value="4">
                                </div>
                                <div>
                                    5 <input type="radio" v-model="form.rating" name="nota" value="5">
                                </div>
                            </div>
                            <div v-if="errors.rating"><span class="font-bold text-red-700">{{ errors.rating }}</span></div>
                        </div>
                        <div class="flex items-center">
                            <Button type="submit">Enviar</Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</BreezeAuthenticatedLayout>


</template>

<style scopde>
input[type="text"], #div-form, textarea{
    background: #EDF4F5
}

</style>
