<template>
    <div class="playing-table">
        <h2>Team Settings</h2>
        
        <div class="players-container mb-5">
            <h3>Team players</h3>
            
            <div class="players mb-3" v-for="player in players">
                <p>{{player.id}}: {{player.username}}</p>
            </div>

            <div>
                <v-select 
                taggable
                v-model="newPlayer" 
                :options="potentialPlayers"
                label="username"
                ></v-select>

                <!-- <input type="text" ref="newPlayerTeam" v-model="newPlayer" placeholder="New team player" list="potentialPlayers"> -->

                <img src="/icons/add.svg" alt="" v-on:click="addNewPlayer">
            </div>
        </div>
        

        <button v-on:click="deleteSelectedTeam">Delete this team</button>

    </div>
</template>

<script>
    import Validation from '../modals/Validation.vue'

    import vSelect from 'vue-select'

    export default {
        components:{
            vSelect
        },
        props:{
        },
        data: function () {
            return {
                newPlayer: null
            }
        },
        computed:{
            players(){
                var players = [];

                if(this.selectedTeam != null){
                    players = this.selectedTeam.players;
                }

                return players;
            },
            potentialPlayers(){
                return this.$store.getters.participantsWithoutTeam;
            }

        },
        mounted() {
            //correct reload router behavior
            if(this.selectedTeam == null && this.$route.name == 'team-settings'){
                this.$router.push({ name: 'table'})
            }
        },
        methods:{
            deleteSelectedTeam: function(){
                this.$modal.show(Validation, {
                  text: 'This text is passed as a property',
                  data: this.selectedTeam,
                  storeDispatchFunction: "deleteSelectedTeam",
                }, {
                  draggable: true
                })
            },
            addNewPlayer: function(){
                console.log('add player')
                var payloads = {
                    team: this.selectedTeam,
                    newPlayer: this.newPlayer,
                }
                this.$store.dispatch('addPlayerToTeam', payloads)
            }
        }
    }
</script>