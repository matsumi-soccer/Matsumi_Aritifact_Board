<template>
    <div class="my-profile">
        <h3>My Prifile</h3>
        <p>{{auth}}</p>
        <p>{{auth['name']}}</p>
        <div class="my-rank">
            <p>Apex：{{apex_rank}}</p>
            <p>Valorant：{{valorant_rank}}</p>
            <p>PUBG：{{pubg_rank}}</p>
            <p>{{id}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props:['auth'],
        data(){
            return {
                apex_rank:"",
                valorant_rank:"",
                pubg_rank:""
            }
        },
        created(){
            this.apexId = this.auth['apex_rank'];
            this.apex_rank = "";
        },
        mounted (){
            this.apex_search();
            this.valorant_search();
            this.pubg_search();
        },
        method:{
            apex_search(){
                axios.get('/search/' + this.apexId +'/apexrank_search')
                .then(res => {
                    this.apex_rank = res.data.apex_rank;
                    this.id = res.data.id;
                }).catch(function(error){
                    console.log(error);
                });
            },
            valorant_search(){
                axios.get('/search/' + this.auth.valorant_rank+'/valorantrank_search')
                .then(res => {
                    this.valorant_rank = res.data.valorant_rank;
                }).catch(function(error){
                    console.log(error);
                });
            },
            pubg_search(){
                axios.get('/search/' + this.auth.pubg_rank+'/pubgrank_search')
                .then(res => {
                    this.pubg_rank = res.data.pubg_rank;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>

<style>
    
</style>