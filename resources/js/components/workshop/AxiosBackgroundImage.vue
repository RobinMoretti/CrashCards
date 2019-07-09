<template>
    <div>
        <div class="img-container" :style="'background: url(' + workshop.image_header + ') no-repeat center center'">
            <img src="/icons/edit.svg" alt="" class="edit-button" v-on:click="openDialog" v-if="isAuthor">

            <div class="invisible">
                <input type="file" size="1048576" v-on:change="updateWorkshop" ref="fileInput">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        props:{
        },
        computed: {
            isAuthor () {
                return this.$store.getters.isAuthorOfWorkshop
            },
            workshop () {
                return this.$store.getters.workshop
            }
        },
        data: function () {
            return {
            }
        },
        methods: {
            openDialog: function(){
                this.$refs.fileInput.click()
            },
            updateWorkshop: function(event){
                if(event && this.isAuthor){
                    let formData = new FormData();

                    formData.append('file', event.target.files[0]);

                    const payload = {
                        "property": this.property,
                        "formData": formData,
                    }

                    this.$store.dispatch('setWorkshopImage', payload).then(
                        resolve => {
                            console.log('success')
                        }, 
                        reject => {
                            console.log('reject')
                            this.flash('Something was wrong, try later.', 'error');
                        }
                    )
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