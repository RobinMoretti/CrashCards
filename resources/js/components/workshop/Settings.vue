<template>
    <div class="settings-container">
        <h2>Setting</h2>
        <div class="settings-column">
            <h3>Réglage généraux:</h3>
            
            <div>
                <h3>Sharable link:</h3>
                <p>{{ baseUrl }}/join/{{workshop.sharable_link}}</p>
            </div>

            <axios-input 
            tag="p"
            property="private"
            :content="workshop.private"
            inputTag="checkbox"
            label="Le workshop est-il privée?"
            :editable="false"
            ></axios-input> 
            <hr> 

            <h6>select Deck</h6>

            <v-select 
            v-model="selectedDeck" 
            :options="decks"
            label="name"
            @input="updateDeck"
            ></v-select>
        </div>
    </div>
</template>

<script>
    import EventBus from '../../event-bus';

    import vSelect from 'vue-select'

    export default {
        components:{
            vSelect
        },
        mounted() {
            var app = this;

            EventBus.$on('workshop-initied', function() {
              app.setWorkOptions();
            }.bind(app));
        },
        props:{
        },
        computed: {
            baseUrl () {
                return this.$store.getters.baseUrl
            },
            decks () {
                return this.$store.getters.availableDecks;
            },
        },
        data: function () {
            return {
                selectedDeck: {},
                workshopBaseUrl: window.workshopBaseUrl
            }
        },
        methods: {
            updateDeck: function(data){

                this.selectedDeck = data;

                const payload = {
                    "deck": this.selectedDeck,
                }

                this.$store.dispatch('setWorkshopDeck', payload).then(
                    resolve => {
                        console.log('success')
                    }, 
                    reject => {
                        console.log('reject')
                        this.flash('Something was wrong, try later.', 'error');
                    }
                )
            },
            setWorkOptions: function(){
                console.log('setWorkOptions')
                // this.$set(this.selectedDeck,this.workshop.deck)
                this.selectedDeck = this.workshop.deck;
            },
        }
    }
</script>


<style scoped  lang="scss">
</style>
