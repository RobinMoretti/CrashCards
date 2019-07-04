<template>
    <div class="workshop-input">
        <axios-input 
        tag="h1"
        property="name"
        :originalContent="modifiedWorkshop.name"
        ></axios-input> 

        <axios-input 
        tag="p"
        property="description"
        :originalContent="modifiedWorkshop.description"
        inputTag="textarea"
        ></axios-input> 

        <h3 class="mt-0">Hosted by {{ modifiedWorkshop.author.name }}</h3>
        
        <p>
            Start 
            <date-picker-input :date="modifiedWorkshop.start_date" property="start_date"></date-picker-input> 
            finish at 
            <date-picker-input :date="modifiedWorkshop.end_date" property="start_date"></date-picker-input> 
        </p>

    </div>
</template>

<script>
    import EventBus from '../../event-bus';

    export default {
        mounted() {
            var app = this;

            EventBus.$on('updateWorkshop', function(data){
                app.updateWorkshop(data)
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
            updateWorkshop: function(data){
                if(data){
                    this.modifiedWorkshop[data[0]] = data[1];
                }

                axios.post(this.urlAjax, {
                  _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                  _data: this.modifiedWorkshop,
                })
                .then(response => {
                    if(response.data){
                        EventBus.$emit('updatedWorkshop', [data[0], true]);
                    }else{
                        this.flash('Something was wrong, try later.', 'error');
                    }
                })
                .catch(e => {
                  console.log(e)
                })
            },
        }
    }
</script>

<style scoped lang="scss">

</style>