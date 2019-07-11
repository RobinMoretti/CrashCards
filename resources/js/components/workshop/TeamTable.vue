<template>
    <div class="team-table">
        <div class="team-header">

            <axios-input 
            tag="h2"
            property="name"
            :content="selectedTeamName"
            default-content="New Team"
            object-to-update="Team"
            ></axios-input> 

            <div class="setting-page" v-on:click="toggleTeamSettings">
                <img src="/icons/settings.svg" alt="">
            </div>
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
            selectedTeamExist: function(){
                if(this.selectedTeam != null){
                    if(Object.entries(this.selectedTeam).length){
                        return true;
                    }
                }
                return false;
            },
            selectedTeamName: function(){
                if(this.selectedTeam != null){
                    return this.selectedTeam.name;
                }
                else{
                    return ""
                }
            }
        },
        mounted() {
            //correct reload router behavior
            if(this.selectedTeam == null && this.$route.name == 'team-table'){
                this.$router.push({ name: 'table'})
                console.log('ok')
            }
        },
        methods:{
        }
    }
</script>