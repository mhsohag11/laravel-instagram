<template>
    <div>
        <button class="btn-sm btn-primary" @click="test">Follow</button>
    </div>
</template>

<script>
    export default {
        props : ['userId'],
        methods : {
            test() {
                //let a = this.userId;
                axios.post('/follow/1')
                    .then( response => console.log(response.data))
            }
        },
        mounted() {
            console.log('ssss');
        }
    }
</script>

<style scoped>

</style>