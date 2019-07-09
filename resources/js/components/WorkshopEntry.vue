<template>
    <div class="">
        <p>Workshop</p>
        <p>PROUT</p>
        <!-- <router-view></router-view> -->
    </div>
</template>

<script>
    import { CoolSelect } from 'vue-cool-select'

    export default {
        components: { CoolSelect },
        props:['workshop', 'urlAjax', 'author', 'decks'],
        data: function () {
            return {
                allDecks: this.decks,
                editMode: false,
                deck: null,
            }
        },
        watch:{
            deck: function(val){ 
               this.workshop.deck_id = this.deck;
               this.updateWorkshop();
            }
        },
        computed:{
        },
        mounted() {
            if(this.workshop.deck_id != null){
                this.deck = this.workshop.deck_id;
            }
            console.log('mounted')
        },
        methods:{
            updateWorkshop:function(){
                var vueApp = this;

                axios.post(this.urlAjax + '/update', {
                  _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                  _data: this.workshop,
                })
                .then(response => {
                    console.log
                    if(response.data == 'true')
                    {
                        console.log('success')
                    }
                    else{
                        console.log('failed')
                    }
                })
                .catch(e => {
                  console.log(e)
                })
            },
            findDeck: function(deck){
                for (var i = 0; i < this.allDecks.length; i++) {
                    if(this.allDecks[i].id = deck){
                        return this.allDecks[i].name;
                    }
                }
                return 'no deck';
            }
        }
    }
    
</script>


<style scoped lang="scss">


</style>