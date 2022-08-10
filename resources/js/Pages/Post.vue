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
    }
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
