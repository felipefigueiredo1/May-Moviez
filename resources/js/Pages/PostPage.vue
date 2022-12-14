<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Button from '@/Components/Button.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import Comment from "@/Components/Comment.vue"
import ButtonComment from "@/Components/ButtonComment.vue";

export default {
    data() {
        return {
            starWars: [],
            hairName: '',
            cover: [],
            movie: '',
        }
    },
    props: {
        user: Object,
        post: Object,
        comments: Object
    },
    setup() {
        const form = reactive({
            body: null,
            user_id: null,
            post_id: null,
        })

        function submitComment() {
            Inertia.post('/comment', form,  {preserveState: false, preserveScroll: true})
            this.form.body = ''
        }

        return { form, submitComment }
    },
    mounted() {
        setTimeout(() => {
            this.form.user_id = this.user,
            this.form.post_id = this.post.id
        }, 500)
        this.star();
    },
    watch: {
      //'form.body':'api',
    },
    methods: {
      api() {
          let self = this

          // self.starWars.forEach(function(nome) {
          //     if(nome.name == self.form.body) {
          //         self.hairName = nome.hair_color;
          //     }
          // })

          self.covers(self.form.body)


          if(self.form.body == '') {
              self.hairName = ''
          }



          // axios({
          //     method: 'get',
          //     url: "https://jsonplaceholder.typicode.com/todos",
          //     responseType: 'stream'
          // })
          //     .then(function (response) {
          //         //this.form.body = response.data;
          //         console.log(response)
          //         self.form.body = response.data;
          // });
      },
      star() {
        let self = this
        axios({
            method: 'get',
            url: "https://swapi.dev/api/people",
            responseType: 'stream'
        })
        .then(function (response) {
            //this.form.body = response.data;
            console.log(response)
            self.starWars = response.data.results;
        });
      },
    },
    components: {
        ButtonComment,
        BreezeAuthenticatedLayout,
        Head,
        Link,
        Button,
        Comment
    }
}

</script>

<template>
    <BreezeAuthenticatedLayout>
        <Head title="Page" />
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-sm">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex  flex-wrap justify-between mb-5">
                            <h1 class="text-3xl mb-2" style="font-family: 'Helvetica Neue'">{{ post.name }}</h1>
                            <div class="flex">
                                <div v-for="n in post.rating">
                                    <span><img src="/img/star.png" style="height:35px;"></span>
                                </div>
                            </div>
                        </div>
                        <div style="width:700px">
                            <p class="mt-6 mb-4">{{ post.body }}</p>
                        </div>
<!--                        <div class="flex flex-wrap gap-5">-->
<!--                            <img :src="post.linkImage" class="rounded-sm" style="max-height:350px; width:330px;">-->
<!--                            -->
<!--                        </div>-->
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div >
                            <Comment :comments="comments" :user_id="user" :post_user_id="post.user_id"/>
                        </div>
                        <div>
                            <form @submit.prevent="submitComment" >
                                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Comente Aqui!</label>
                                <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900
                                bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-200 focus:border-red-200
                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                dark:focus:ring-blue-500
                                dark:focus:border-blue-500" placeholder="Deixe um comentario..." v-model="form.body"></textarea>
                                <ButtonComment type="submit" class="mt-2 ml-0" texto="Comentar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<style scoped>
.bg-white-ice{
    background: #EDF4F5
}
</style>
