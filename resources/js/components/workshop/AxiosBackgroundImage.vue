<template>
    <div>
        <div class="img-container" :style="'background: url(' + imageModified + ') no-repeat center center'">
            <img src="/icons/edit.svg" alt="" class="edit-button" v-on:click="openDialog">

            <div class="invisible">
                <input type="file" size="1048576" v-on:change="updateWorkshop" ref="fileInput">
            </div>
        </div>
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
            image: {
                type: String
            },
            workshop: {
                type: Object
            },
            urlAjax: {
                type: String
            }
        },
        data: function () {
            return {
                imageModified: this.image,
                imageFile: null
            }
        },
        methods: {
            openDialog: function(){
                this.$refs.fileInput.click()
            },
            updateWorkshop: function(event){
                if(event){
                    let formData = new FormData();
                    formData.append('file', event.target.files[0]);

                    console.log(formData)
                    let settings = { headers: { 'content-type': 'multipart/form-data' } }

                    axios.post(this.urlAjax, formData, {
                      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                      headers: { 'content-type': 'multipart/form-data' } 
                    })
                    .then(response => {
                        this.imageModified = response.data;
                    })
                    .catch(e => {
                      console.log(e)
                    })
                }
            },
        }
    }
</script>

<style scoped lang="scss">
    .edit-button{
        background-color: white;
        border: 1px grey solid;
        border-radius: 100%;
        cursor: pointer;
    }
</style>