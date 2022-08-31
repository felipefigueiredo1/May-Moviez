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
      user: String
    },
    setup() {
        const form = reactive({
            name: null,
            body: null,
            user_id: null,
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

            self.covers(self.movie);
        },
        set(){
            self = this;
            self.capas = [];
            self.cover.slice(0, 6).forEach(function(nome) {
                    self.capas.push(nome)
            })
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
                    <div class="m-2">
                        <label class="mr-1"><strong>Buscar capa</strong></label>
                        <form @submit.prevent="submitMovie">
                            <input type="text" class="rounded-md bg-gray-50 focus:border-red-200 focus:ring-red-500 mr-1" v-model="movie">
                            <Button :type="submit" class="mt-2">Pesquisar</Button>
                        </form>
                    </div>
                    <div class="flex justify-between flex-wrap">
                        <div v-for="(capa, index) in capas" :key="index">
                            <div v-if="capa.hasOwnProperty('i')" class="flex flex-col justify-center">
                                <h2 class="text-center">{{ capa.l }}</h2>
                                <img :src="capa.i.imageUrl" class="object-contain h-48 rounded-sm">
                                <div class="flex justify-center">
                                    <input type="radio" name="capa">
                                </div>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="m-2">
                            <label for="name" class="mr-1"><strong>Titulo: </strong></label>
                            <div>
                                <input type="text" class="rounded-md bg-gray-50 focus:border-red-200 focus:ring-red-500" name="name" v-model="form.name">
                            </div>
                        </div>
                        <div class="m-2">
                            <label for="body" class="mr-1"><strong>Descrição: </strong></label>
                            <div>
                                <textarea name="body" class="rounded-md bg-gray-50 focus:border-red-200 focus:ring-red-500" rows="4" cols="50" v-model="form.body"></textarea>
                            </div>
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
#div-form{
    background: #EDF4F5
}
</style>
