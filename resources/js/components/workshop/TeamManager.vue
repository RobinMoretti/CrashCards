<template>
    <div class="teams-container">
        <h2>teams</h2>

        <div class="team" v-for="team in teams">
            <h3>{{team.name}}</h3>
            <img v-for="user in team" :src="user.image.url">
        </div>
        
        <div class="team adding-team" v-on:click="createTeam">
            <img src="/icons/add.svg" alt="">
            <p>ADD TEAM</p>
        </div>
    </div>
</template>

<script>
    export default { 
        props:{
        },
        data: function () {
            return {
            }
        },
        computed:{
            teams: function(){
                this.$store.getters.teams;
            }
        },
        mounted() {
        },
        methods:{
            createTeam:function(){


                // this.$store.dispatch('createTeam').then(
                //     resolve => {
                //         console.log('success')
                //     }, 
                //     reject => {
                //         console.log('reject')
                //         this.flash('Something was wrong, try later.', 'error');
                //     }
                // )
            }
        }
    }
</script>
