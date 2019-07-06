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
            v-model="inputContent"
            v-on:keydown.enter="update"
            v-if="inputTag == 'input'"
            >

            <textarea 
            id="story" 
            name="story"
            v-model="inputContent"
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
        props:{
            tag: {
                default: 'p',
                type: String
            },
            inputTag: {
                default: 'input',
                type: String
            },
            content:{
                type: String
            }, 
            property: {
                type: String
            }
        },
        data: function () {
            return {
                editMode: false,
                inputContent: this.content,
            }
        },
        methods: {
            toggleEditMode: function(){
                this.editMode = !this.editMode;
                this.inputContent = this.content;
            },
            update: function(){
                if(this.content.length > 0 ){
                    console.log('emited');

                    const payload = {
                        "property": this.property,
                        "content": this.inputContent,
                    }

                    this.$store.dispatch('setWorkshopProperty', payload).then(
                        resolve => {
                            console.log('success')
                        }, 
                        reject => {
                            console.log('reject')
                            this.flash('Something was wrong, try later.', 'error');
                        }
                    )

                }
                
                this.toggleEditMode();
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