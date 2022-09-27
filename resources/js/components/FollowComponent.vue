<template>
    <span>
      <button v-if="!followed" type="button" class="btn btn-success" @click="follow()">フォロー</button>
      <button  v-else type="button" class="btn btn-danger" @click="unfollow()">フォロー解除</button>
      <p>フォロワー：{{followCount}}人</p>
    </span>
</template>

<script>
    export default {
        props:['user', 'defaultFollowed', 'defaultCount'],
        data() {
          return{
              followed: false,
              followCount: 0,
          };
        },
        created() {
          this.followed = this.defaultFollowed
          this.followCount = this.defaultCount
        },

        methods: {
          follow() {
            let url = '/users/'+ this.user.id +'/follow'

            axios.post(url)
            .then(response => {
                this.followed = true;
                this.followCount = response.data.followCount;
            })
            .catch(error => {
              alert(error)
            });
          },
          unfollow() {
            let url = '/users/'+ this.user.id +'/unfollow'

            axios.post(url)
            .then(response => {
                this.followed = false;
                this.followCount = response.data.followCount;
            })
            .catch(error => {
              alert(error)
            });
          }
        }
    }
</script>