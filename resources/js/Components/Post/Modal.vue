<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Button from '@/Components/Button.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref, reactive } from 'vue'

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
    setup(props) {
        const form = useForm({
            name: null,
            body: null,
            user_id: null,
            movie: null,
            rating: null,
            id: null,
            img: {
                name: null,
                link: null,
            },
        })

        let urlFile = reactive({link: null});
        const closeModalLabel = ref(null)
        let sendPut = ref(false)

        async function submit() {
            if(sendPut && form.id !== undefined) {
                form.put('/post/'+form.id )
            } else {
                await form.post('/post', {
                     onSuccess: () => {form.reset('name', 'body', 'movie', 'rating'); closeModal()},
                })
            }
        }

        function closeModal() {
            closeModalLabel.value.click()
        }

        function onFileChange(e) {
            const file = e.target.files[0];
            urlFile.link = URL.createObjectURL(file);
        }

        return { form, submit, closeModal, closeModalLabel, sendPut, onFileChange, urlFile }
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
        'dadosPostEditar' : {
            handler(newVal, oldVal) { // watch it
                this.form.name = newVal.name;
                this.form.body = newVal.body;
                this.form.rating = newVal.rating;
                this.form.id = newVal.id;
                this.sendPut = true;
                if(this.dadosPostEditar.id === undefined) {
                    this.sendPut = false;
                }
            },
        },
        'form.img' : {
            handler(newVal, oldVal) {
                console.log(newVal);
            }
        }
    },
}

</script>

<template>
    <input type="checkbox" id="post-modal" class="modal-toggle" />
    <div class="modal rounded-none">
        <div class="modal-box relative bg-dark-gray rounded-none">
            <label for="post-modal" class="btn btn-sm hover:bg-red-600 bg-dark-gray-sm absolute right-2 top-2" ref="closeModalLabel" >✕</label>
            <label class="mr-1 text-sm text-white" for="name">Título</label>
            <input type="text"  class="input mt-3  w-full rounded-none max-w focus:border-red-500  input-sm bg-dark-gray-sm text-white" id="name" v-model="form.name">
            <div v-if="errors.name"><span class="text-red-700 text-sm">{{ errors.name }}</span></div>
            <form @submit.prevent="submit" class="mt-4" id="post_form">
                <label for="body" class="mr-1 text-white text-sm">Descrição</label>
                <textarea name="body"
                          class="textarea focus:border-red-500
                          rounded-none mt-3 input-bordered w-full max-w bg-dark-gray-sm text-white"
                          v-model="form.body">
                </textarea>
                <template v-if="errors.body"><span class="text-red-700 text-sm">{{ errors.body }}</span></template>
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
                    <template v-if="errors.rating"><span class="text-red-700 text-sm">{{ errors.rating }}</span></template>
                </div>
                <div>
                    <label class="text-sm text-white">Imagem</label>
                    <div class="mt-2">
                        <label class="text-white border-red-800 cursor-pointer rounded">
                            <div class="inline-block">
                                <span class="px-4 py-2 bg-gray-800 border border-transparent
                                 rounded-md font-semibold text-xs text-white
                                 uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none
                                 focus:border-red-900 focus:shadow-outline-gray transition ease-in-out duration-150
                                  rounded-none bg-dark-gray-sm btn-sm">Foto</span> <i class="fa fa-image ml-2"></i>
                                <input type="file" style="display: none;" @input="form.img = $event.target.files[0]" @change="onFileChange">
                            </div>
                        </label>
                        <template v-if="form.img.name" >
                            <div id="preview" class="mt-4">
                                <img :src="urlFile.link" class="rounded-lg"/>
                            </div>
                            <div class="mt-2 text-white break-words">{{ form.img.name }}</div>
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                        </template>
                    </div>
                </div>
            </form>
            <div class="modal-action">
                <label for="post-modal" ></label>
                <Button type="submit" form="post_form" class="rounded-none bg-dark-gray-sm btn-sm">{{ sendPut ? 'Editar' : 'Publicar' }}</Button>
            </div>
        </div>
    </div>
</template>
