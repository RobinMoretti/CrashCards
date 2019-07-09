<template>
    <div class="playing-table">
        <div class="table-header">
            <div>
                <h2 v-if="selectedTeamExist">{{ selectedTeamName }}</h2>
            </div>

            <div class="setting-page" v-on:click="toggleTeamSettings" v-if="isAuthor && selectedTeamExist">
                <img src="/icons/settings.svg" alt="">
            </div>
        </div>

        <router-view></router-view>
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
                if(this.selectedTeam.name != null){
                    return this.selectedTeam['name'];
                }
                else{
                    return "Nouvelle équipe"
                }
            },
        },
        mounted() {
        },
        methods:{

        }
    }
</script>