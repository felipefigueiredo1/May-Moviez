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
        user: Number,
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
        //this.star();
    },
    methods: {
      star() {
        this.$refs.ldsRing.style.display = 'block';
        axios({
            method: 'get',
            url: "https://swapi.dev/api/people",
            })
        .then((response) => {
            this.$refs.ldsRing.style.display = 'none';
            this.starWars = response.data.results;
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
        <Head :title="post.name" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 text-white">
            <div class="overflow-hidden shadow-sm sm:rounded-sm">
                <div class="p-6 bg-dark-gray-sm rounded">
                    <div class="flex flex-wrap justify-between mb-5">
                        <h1 class="text-3xl mb-2">{{ post.name }}</h1>
                        <div class="flex">
                            <div v-for="n in post.rating">
                                <span><img src="/img/star.png" style="height:35px;"></span>
                            </div>
                        </div>
                    </div>
                    <div style="width:700px">
                        <p class="mt-6 mb-4">{{ post.body }}</p>
                        {{ starWars.length === 0 ? '' : starWars[0]  }}
                        <div id="loading" class="lds-ring" style="display:none;" ref="ldsRing"><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-dark-gray-sm ">
                        <Comment :comments="comments" :user_id="user" :post_user_id="post.user_id"/>
                    <div>
                        <form @submit.prevent="submitComment" >
                            <textarea id="message" rows="4" class="w-full rounded bg-dark-gray-es text-white focus:border-red-500 focus:ring-red-700"
                                      placeholder="Deixe um comentario..." v-model="form.body"></textarea>
                            <ButtonComment type="submit" class="mt-2 ml-0" color="text-white" texto="Comentar" />
                        </form>
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
.lds-ring {
    display: inline-block;
    position: relative;
    width: 64px;
    height: 64px;
}
.lds-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 51px;
    height: 51px;
    margin: 6px;
    border: 6px solid #ccc;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #ccc transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
}
@keyframes lds-ring {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
