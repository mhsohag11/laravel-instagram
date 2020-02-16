<template>
    <div>
        <button class="btn-sm btn-primary" @click="followAction" v-text="followText"></button>
    </div>
</template>

<script>

    export default {
        props : ['userId','followingStatus'],
        data : function () {
          return {
              status : this.followingStatus
          }
        },
        methods : {
            followAction() {

                //let a = this.userId;
                axios.post('/follow/'+ this.userId)
                    .then( response => {
                        let emitData = {
                            followed : this.status,

                        };
                        EventBus.$emit('sentStatusToCount', emitData);
                        this.status = !this.status;
                        console.log(response.data);
                    })
                    .catch( error => {
                        if (error.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        },
        computed : {
            followText () {
                return (!this.status) ? 'Follow' : 'Unfollow';
            }
        }

    }
</script>

<style scoped>

</style>