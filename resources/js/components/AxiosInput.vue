<template>
    <div class="axios-input">
        <div class="static" v-on:click="toggleEditMode" v-if="!editMode">
            <component :is="tag" class="m-0 mr-3">
                {{content}}
            </component>
            <img src="/icons/edit.svg" alt="">
        </div>

        <div class="edit" v-else>
            <input 
            type="text" 
            id="content-input" 
            name="content-input" 
            maxlength="50" 
            v-model="content"
            v-on:keydown.enter="update"
            v-if="inputTag == 'input'"
            >

            <textarea 
            id="story" 
            name="story"
            v-model="content"
            rows="5" cols="60"
            v-if="inputTag == 'textarea'">
            </textarea>

            <img src="/icons/save.svg" alt="" class="save" v-on:click="update">
        </div>
    </div>
</template>

<script>
    import EventBus from '../event-bus';

    export default {
        mounted() {
            var app = this;

            EventBus.$on('updatedWorkshop', function(data){
                if(data[0] == app.property && data[1] == true){
                    this.editMode = false;
                }
            }.bind(app));

        },
        props:{
            tag: {
                default: 'p',
                type: String
            },
            inputTag: {
                default: 'input',
                type: String
            },
            originalContent:{
                type: String
            }, 
            property: {
                type: String
            }
        },
        data: function () {
            return {
                editMode: false,
                content: this.originalContent,
            }
        },
        methods: {
            toggleEditMode: function(){
                this.editMode = !this.editMode;
            },
            update: function(){
                if(this.content.length > 0 ){
                    console.log('emited');
                    EventBus.$emit('updateWorkshop', [this.property, this.content]);
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .axios-input{
        .static{
            display: flex;
            justify-content: flex-start;
            align-items: center;
            cursor: pointer;
        }

        .save{
            cursor: pointer;
        }
    }

</style>