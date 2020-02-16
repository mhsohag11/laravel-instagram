<template>
    <div class="count-val">
        <h6 class="d-inline-flex pr-4"> {{ getPosts }} posts</h6>
        <h6 class="d-inline-flex pr-4">{{ getFollowers }} followers</h6>
        <h6 class="d-inline-flex pr-4">{{ getFollowing}} following</h6>
    </div>
</template>

<script>
    export default {
        name: "CountValue",
        props: ['followers','posts','following'],
        computed: {
            getFollowers () {
                return this.$store.state.userInfoCounts.title;
            },
            getFollowing () {
                return this.following;
            },
            getPosts () {
                return this.posts;
            }
        },
        created() {
            this.$store.dispatch('userInfoCounts/valueFromServer',this.followers);
            let insideThis = this;

            let followersValue = this.getFollowers;
            EventBus.$on('sentStatusToCount', function (data) {

                followersValue = (data.followed== true || data.folowed==1) ? parseInt(followersValue)-1 : parseInt(followersValue)+1 ;

                insideThis.$store.dispatch('userInfoCounts/valueFromServer',followersValue)
            });
        }

    }
</script>

<style scoped>

</style>