<template>
    <div class="playing-table">
        <div class="table-header">
            <div class="" v-if="selectedTeam != null">
                <div class="team-header">
                    <!-- <h2 v-if="selectedTeamExist">{{ selectedTeamName }}</h2> -->

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
                if(this.selectedTeam != null){
                    return this.selectedTeam.name;
                }
                else{
                    return ""
                }
            }
        },
        mounted() {
        },
        methods:{

        }
    }
</script>