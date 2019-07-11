<template>
    <div class="teams-container">
        <h2>teams</h2> 
        <div class="team" v-for="team in teams" v-on:click="toggleSelected(team)" :class="selectedTeam == team ? 'selected' : '' ">
            <h3 v-if="team['name']">{{team['name']}}</h3>
            <h3 v-else>Nouvelle équipe</h3>
            <!-- <img v-for="user in team" :src="user.image.url"> -->
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
                return this.$store.getters.teams;
            }
        },
        mounted() {
        },
        methods:{
            createTeam:function(){
                this.$store.dispatch('createTeam').then(
                    resolve => {
                        console.log('success')
                    }, 
                    reject => {
                        console.log('reject')
                        this.flash('Something was wrong, try later.', 'error');
                    }
                )
            },
            toggleSelected: function(team){
                if(team == this.selectedTeam){
                    team = null
                }
                this.$store.dispatch("toggleSelectedTeam", team);
                this.goTeamTable(team);
            },
        }
    }
</script>
