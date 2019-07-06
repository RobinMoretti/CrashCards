<template>
    <div class="settings-container">
        <h2>Setting</h2>
        <div class="settings-column">
            <h3>Réglage généraux:</h3>
<!-- 
            <axios-input 
            tag="p"
            property="private"
            :originalContent="modifiedWorkshop.name"
            inputTag="checkbox"
            ></axios-input>  -->

        </div>
    </div>
</template>

<script>
    import EventBus from '../../event-bus';
    export default {
        mounted() {
            var app = this;

            EventBus.$on('updateWorkshopSettings', function(data){
                app.updateWorkshopSettings(data)
            }.bind(app));
        },
        props:{
            urlAjax: {
                type: String
            },
            workshop: {
                type: Object
            }
        },
        data: function () {
            return {
                modifiedWorkshop: this.workshop,
            }
        },
        methods: {
            updateWorkshopSettings: function(data){
                // if(data){
                //     this.modifiedWorkshop[data[0]] = data[1];
                // }

                // axios.post(this.urlAjax, {
                //   _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                //   _data: this.modifiedWorkshop,
                // })
                // .then(response => {
                //     if(response.data){
                //         EventBus.$emit('updateWorkshopSettings', [data[0], true]);
                //     }else{
                //         this.flash('Something was wrong, try later.', 'error');
                //     }
                // })
                // .catch(e => {
                //   console.log(e)
                // })
            },
            getWorkshopObj: function(){

                // axios.post(this.urlAjax, {
                //   _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                //   _data: this.modifiedWorkshop,
                // })
                // .then(response => {
                //     if(response.data){
                //         EventBus.$emit('updateWorkshopSettings', [data[0], true]);
                //     }else{
                //         this.flash('Something was wrong, try later.', 'error');
                //     }
                // })
                // .catch(e => {
                //   console.log(e)
                // })
            }
        }
    }
</script>


<style scoped  lang="scss">
</style>
