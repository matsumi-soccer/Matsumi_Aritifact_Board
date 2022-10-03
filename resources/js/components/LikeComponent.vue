<template>
    <div class="container">
        <div class="mt-1">
            <div class="like-component">
                <button @click="unfavorite()" class="btn btn-danger" v-if="result">
                    いいね取り消し
                </button>
                <button @click="favorite()" class="btn btn-success"v-else>
                    いいね
                </button>
                <p>「 いいね! 」 {{count}}件</p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['comment'],
        data(){
            return {
                count:"",
                result:"false"
            }
        },
        mounted () {
            this.hasfavorites();
            this.countfavorites();
        },
        methods: {
            favorite() {
                axios.get('/posts/' + this.comment.id +'/favorites')
                .then(res => {
                    this.result = res.data.result;
                    this.count = res.data.count;
                }).catch(function(error) {
                    console.log(error);
                });
            },
            unfavorite() {
                axios.get('/posts/' + this.comment.id +'/unfavorites')
                .then(res => {
                    this.result = res.data.result;
                    this.count = res.data.count;
                }).catch(function(error){
                    console.log(error);
                });
            },
            countfavorites() {
                axios.get('/posts/' + this.comment.id + '/countfavorites')
                .then(res => {
                    this.count = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            },
            hasfavorites() {
                axios.get('/posts/' + this.comment.id + '/hasfavorites')
                .then(res => {
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
     }
</script>

<style>
@import "/css/chat.css";
</style>