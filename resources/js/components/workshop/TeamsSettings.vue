<template>
    <div class="teams-settings">
        <div class="table-header">
            <h2>Teams Settings</h2>
            <div class="setting-page" v-on:click="toggleTableSettings">
                <img src="/icons/settings.svg" alt="">
            </div>
        </div>

        <div class="participants-container mb-5">
            <h3>Participants</h3>
            <div class="participants mb-3" v-for="particpant in participants">
                <p>
                    {{particpant.id}}: {{particpant.username}} 
                    <span v-if="participantsWithoutTeam.includes(particpant)" class="info danger">not a team member</span>
                    <span v-if="particpant.fakePlayer" class="info">fake player</span>
                </p> 
            </div>
        </div>
    </div>
</template>

<script>
    import Validation from '../modals/Validation.vue'

    export default {
        props:{
        },
        data: function () {
            return {
            }
        },
        computed:{
            participants(){
                return this.$store.getters.participants;
            },
            participantsWithoutTeam(){
                return this.$store.getters.participantsWithoutTeam;
            }
        },
        mounted() {
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
        }
    }
</script>