<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Button from '@/Components/Button.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref, reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Button
    },
    props: {
        user: Number,
        errors: Object,
        flash: Object,
        dadosPostEditar: Object,
    },
    setup() {
        const form = useForm({
            name: null,
            body: null,
            user_id: null,
            movie: null,
            rating: null,
            id: null,
        })

        const closeModalLabel = ref(null)
        let sendPut = ref(false)

        function submit() {
            if(sendPut && form.id !== undefined) {
                form.put('/post/'+form.id )
            } else {
                form.post('/post', {
                     onSuccess: () => form.reset('name', 'body', 'movie', 'rating'),
                })
            }

        }

        function closeModal() {
            closeModalLabel.value.click()
        }

        return { form, submit, closeModal, closeModalLabel, sendPut }
    },
    mounted() {
        setTimeout(() => {
            this.form.user_id = this.user
        }, 500)

        if(this.dadosPostEditar) {
            console.log(this.dadosPostEditar)
        }
    },
    watch: {
        '$page.props.flash.message' : {
            handler() {
                if(this.$page.props.flash.message != null) {
                    this.closeModal()
                }
            },
        },
        'dadosPostEditar' : {
            handler(newVal, oldVal) { // watch it
                this.form.name = newVal.name;
                this.form.body = newVal.body;
                this.form.rating = newVal.rating;
                this.form.id = newVal.id;
                this.sendPut = true;
                console.log(this.dadosPostEditar.id)
                if(this.dadosPostEditar.id === undefined) {
                    this.sendPut = false;
                }
            }
        }
    },
}

</script>

<template>
    <input type="checkbox" id="post-modal" class="modal-toggle" />
    <div class="modal rounded-none">
        <div class="modal-box relative bg-dark-gray rounded-none">
            <label for="post-modal" class="btn btn-sm hover:bg-red-600 bg-dark-gray-sm absolute right-2 top-2">✕</label>
            <label class="mr-1 text-sm text-white" for="name">Título</label>
            <input type="text"  class="input mt-3  w-full rounded-none max-w focus:border-red-500  input-sm bg-dark-gray-sm text-white" id="name" v-model="form.name">
            <div v-if="errors.name"><span class="text-red-700 text-sm">{{ errors.name }}</span></div>
            <form @submit.prevent="submit" class="mt-4" id="post_form">
                <div class="">
                    <label for="body" class="mr-1 text-white text-sm">Descrição</label>
                    <div>
                        <textarea name="body"
                                  class="textarea focus:border-red-500
                                  rounded-none mt-3 input-bordered w-full max-w bg-dark-gray-sm text-white"
                                  v-model="form.body">
                        </textarea>
                        <div v-if="errors.body"><span class="text-red-700 text-sm">{{ errors.body }}</span></div>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="text-sm text-white">Nota</label>
                    <div class="flex justify-between w-60">
                        <select v-model="form.rating" class="mt-3 focus:border-red-500   bg-dark-gray-sm select py-0
                         input-bordered w-full max-w-xs select-xs text-white rounded-none">
                            <option disabled selected>Selecione</option>
                            <option value="0">0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div v-if="errors.rating"><span class="text-red-700 text-sm">{{ errors.rating }}</span></div>
                </div>
            </form>
            <div class="modal-action">
                <label for="post-modal" ref="closeModalLabel"></label>
                <Button type="submit" form="post_form" class="rounded-none bg-dark-gray-sm btn-sm">{{ sendPut ? 'Editar' : 'Publicar' }}</Button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
