<template>
    <div class="playing-table">
        <h3>TeamSettings</h3>

        <button v-on:click="deleteSelectedTeam">Delete this team</button>

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